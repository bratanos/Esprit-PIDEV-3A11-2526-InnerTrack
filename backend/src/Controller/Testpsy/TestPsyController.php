<?php

namespace App\Controller\Testpsy;

use App\Entity\Testpsy\TestPsychologique;
use App\Entity\Testpsy\Question;
use App\Entity\Testpsy\Resultat;
use App\Entity\Testpsy\TrancheResultat;
use App\Entity\Testpsy\HistoriqueResultat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/testpsy')]
class TestPsyController extends AbstractController
{
    private function getTypes(EntityManagerInterface $em): array
    {
        return $em->getConnection()
            ->executeQuery('SELECT id_type, libelle FROM type_test ORDER BY libelle')
            ->fetchAllAssociative();
    }

    private function findTranche(EntityManagerInterface $em, int $idTest, int $score): ?array
    {
        $result = $em->getConnection()->executeQuery(
            'SELECT * FROM tranche_resultat 
             WHERE id_test = :id 
             AND score_min <= :score 
             AND score_max >= :score 
             LIMIT 1',
            ['id' => $idTest, 'score' => $score]
        )->fetchAssociative();

        return $result ?: null;
    }

    // ─────────────────────────────────────────────
    // INDEX
    // ─────────────────────────────────────────────
    #[Route('/', name: 'testpsy_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $tests = $em->getRepository(TestPsychologique::class)->findAll();
        $types = $this->getTypes($em);

        $typesMap = [];
        foreach ($types as $type) {
            $typesMap[$type['id_type']] = $type['libelle'];
        }

        $statsParType = [];
        foreach ($types as $type) {
            $total = count(array_filter($tests, fn($t) => $t->getIdType() === (int) $type['id_type']));
            if ($total > 0) {
                $statsParType[] = ['libelle' => $type['libelle'], 'total' => $total];
            }
        }

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $resultatsMap = [];
        $bienEtreGlobal = null;

        if ($user) {
            $resultats = $em->getRepository(Resultat::class)->findBy(
                ['idUtilisateur' => $user->getId()],
                ['datePassage' => 'DESC']
            );
            foreach ($resultats as $r) {
                if (!isset($resultatsMap[$r->getIdTest()])) {
                    $resultatsMap[$r->getIdTest()] = $r;
                }
            }

            $testsMapForScore = [];
            foreach ($tests as $t) {
                $testsMapForScore[$t->getIdTest()] = $t;
            }

            $bienEtreScore = 0;
            $bienEtreCount = 0;
            
            foreach ($resultatsMap as $idTest => $r) {
                $testObj = $testsMapForScore[$idTest] ?? null;
                if ($testObj) {
                    $titre = strtolower($testObj->getTitre());
                    if (str_contains($titre, 'mbti')) continue;

                    $pct = $r->getPourcentage();
                    $isPositive = (
                        str_contains($titre, 'estime') || 
                        str_contains($titre, 'resilience') || 
                        str_contains($titre, 'résilience') || 
                        str_contains($titre, 'emotionn') || 
                        str_contains($titre, 'émotionn')
                    );

                    // Si test négatif (ex: anxiété), on inverse le score (100% de détresse = 0% de bien-être)
                    if (!$isPositive) {
                        $pct = max(0, 100 - $pct);
                    }
                    $bienEtreScore += $pct;
                    $bienEtreCount++;
                }
            }
            if ($bienEtreCount > 0) {
                $bienEtreGlobal = (int) round($bienEtreScore / $bienEtreCount);
            }
        }

        return $this->render('pages/testpsy/index.html.twig', [
            'tests'          => $tests,
            'types_map'      => $typesMap,
            'stats_par_type' => $statsParType,
            'resultats_map'  => $resultatsMap,
            'bien_etre'      => $bienEtreGlobal,
        ]);
    }

    // ─────────────────────────────────────────────
    // SHOW
    // ─────────────────────────────────────────────
    #[Route('/{id}', name: 'testpsy_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $test = $em->getRepository(TestPsychologique::class)->find($id);
        if (!$test) throw $this->createNotFoundException('Test introuvable.');

        return $this->render('pages/testpsy/show.html.twig', ['test' => $test]);
    }

    // ─────────────────────────────────────────────
    // PASSER
    // ─────────────────────────────────────────────
    #[Route('/{id}/passer', name: 'testpsy_passer', methods: ['GET', 'POST'])]
    public function passer(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $test      = $em->getRepository(TestPsychologique::class)->find($id);
        if (!$test) throw $this->createNotFoundException('Test introuvable.');

        $questions = $em->getRepository(Question::class)->findBy(['test' => $test]);

        if ($request->isMethod('POST')) {
            $reponses = $request->request->all('reponses');

            // Validation
            $errors = [];
            foreach ($questions as $q) {
                if (!isset($reponses[$q->getIdQuestion()])) {
                    $errors[] = 'Veuillez répondre à toutes les questions.';
                    break;
                }
            }

            if (!empty($errors)) {
                return $this->render('pages/testpsy/passer.html.twig', [
                    'test'      => $test,
                    'questions' => $questions,
                    'errors'    => $errors,
                    'reponses'  => $reponses,
                ]);
            }

            $score    = array_sum($reponses);
            $scoreMax = count($questions) * 4;
            $pct      = $scoreMax > 0 ? round(($score / $scoreMax) * 100, 2) : 0;

            $isMBTI = stripos($test->getTitre(), 'mbti') !== false;

            if ($isMBTI) {
                // Tri par ID pour avoir Q1-5, Q6-10 etc...
                $qArray = $questions;
                if (is_array($qArray)) {
                    usort($qArray, fn($a, $b) => $a->getIdQuestion() <=> $b->getIdQuestion());
                }
                
                $axisE = 0; $axisS = 0; $axisT = 0; $axisJ = 0;
                $idx = 0;
                foreach ($qArray as $q) {
                    $v = (int) ($reponses[$q->getIdQuestion()] ?? 0);
                    if ($idx < 5) $axisE += $v;
                    elseif ($idx < 10) $axisS += $v;
                    elseif ($idx < 15) $axisT += $v;
                    else $axisJ += $v;
                    $idx++;
                }
                
                $typeStr = '';
                $typeStr .= ($axisE >= 13) ? 'E' : 'I';
                $typeStr .= ($axisS >= 13) ? 'S' : 'N';
                $typeStr .= ($axisT >= 13) ? 'T' : 'F';
                $typeStr .= ($axisJ >= 13) ? 'J' : 'P';
                
                $mbtiDescriptions = [
                    'INTJ' => 'Stratège, indépendant, orienté vers l\'avenir et analytique.',
                    'INTP' => 'Curieux, inventif, penseur abstrait, absorbé par les idées.',
                    'ENTJ' => 'Leader naturel, décisif, et orienté vers les objectifs.',
                    'ENTP' => 'Innovateur, adaptable, aime explorer les possibilités.',
                    'INFJ' => 'Perspicace, empathique, et profondément guidé par ses valeurs.',
                    'INFP' => 'Idéaliste, réfléchi, et guidé par des principes personnels.',
                    'ENFJ' => 'Charismatique, organisé, et axé sur l\'aide aux autres.',
                    'ENFP' => 'Enthousiaste, créatif, valorisant la croissance personnelle.',
                    'ISTJ' => 'Responsable, pratique, organisé et soucieux des détails.',
                    'ISFJ' => 'Loyal, consciencieux, chaleureux et d\'un grand soutien.',
                    'ESTJ' => 'Efficace, structuré, concret et décisif.',
                    'ESFJ' => 'Chaleureux, coopératif, et très attentif aux besoins des autres.',
                    'ISTP' => 'Analytique, adaptable, un résolveur de problèmes pratique.',
                    'ISFP' => 'Doux, flexible, ancré dans le présent et valorise l\'harmonie.',
                    'ESTP' => 'Énergique, orienté vers l\'action, et aime relever des défis.',
                    'ESFP' => 'Sociable, spontané, et aime interagir avec l\'environnement.'
                ];

                $libelle = 'Type ' . $typeStr;
                $interpretation = $mbtiDescriptions[$typeStr] ?? 'Personnalité unique.';
                $niveau = $typeStr; 
            } else {
                // Chercher la tranche via SQL direct
                $trancheMax = $em->getConnection()->executeQuery(
                    'SELECT MAX(score_max) FROM tranche_resultat WHERE id_test = :id',
                    ['id' => $id]
                )->fetchOne();

                $scoreNormalise = $trancheMax && $scoreMax > 0
                    ? (int) round(($score / $scoreMax) * $trancheMax)
                    : $score;

                $trancheData = $this->findTranche($em, $id, $scoreNormalise);

                $libelle        = $trancheData['libelle']        ?? 'Non évalué';
                $interpretation = $trancheData['interpretation'] ?? 'Aucune interprétation disponible pour ce score.';
                $niveau         = $trancheData['niveau']         ?? null;
            }

            /** @var \App\Entity\User $user */
            $user = $this->getUser();

            // Sauvegarder le résultat
            $resultat = new Resultat();
            $resultat->setIdTest($id)
                     ->setIdUtilisateur($user->getId())
                     ->setScoreTotal($score)
                     ->setScoreMaxPossible($scoreMax)
                     ->setPourcentage($pct)
                     ->setResultat($libelle)
                     ->setInterpretation($interpretation)
                     ->setDatePassage(new \DateTime());

            $em->persist($resultat);
            $em->flush();

            // Sauvegarder dans l'historique
            $historique = new HistoriqueResultat();
            $historique->setIdUser($user->getId())
                       ->setIdTest($id)
                       ->setScore($score)
                       ->setPourcentage($pct)
                       ->setNiveau($niveau)
                       ->setDatePassage(new \DateTime());

            $em->persist($historique);
            $em->flush();

            return $this->redirectToRoute('testpsy_resultat', ['id' => $resultat->getIdResultat()]);
        }

        return $this->render('pages/testpsy/passer.html.twig', [
            'test'      => $test,
            'questions' => $questions,
            'errors'    => [],
            'reponses'  => [],
        ]);
    }

    // ─────────────────────────────────────────────
    // RESULTAT
    // ─────────────────────────────────────────────
    #[Route('/resultat/{id}', name: 'testpsy_resultat')]
    public function resultat(int $id, EntityManagerInterface $em): Response
    {
        $resultat = $em->getRepository(Resultat::class)->find($id);
        if (!$resultat) throw $this->createNotFoundException('Résultat introuvable.');

        return $this->render('pages/testpsy/resultat.html.twig', ['resultat' => $resultat]);
    }

    // ─────────────────────────────────────────────
    // HISTORIQUE
    // ─────────────────────────────────────────────
    #[Route('/historique', name: 'testpsy_historique')]
    public function historique(EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\User $user */
        $user   = $this->getUser();
        $userId = $user ? $user->getId() : null;

        $historiques = $userId
            ? $em->getRepository(HistoriqueResultat::class)->findBy(
                ['idUser' => $userId],
                ['datePassage' => 'ASC'] // ASC pour les graphiques chronologiques
              )
            : [];

        $tests = $em->getRepository(TestPsychologique::class)->findAll();
        $testsMap = [];
        foreach ($tests as $t) {
            $testsMap[$t->getIdTest()] = $t->getTitre();
        }

        $stats = [
            'total' => count($historiques),
            'moyenne' => 0,
            'niveau_frequent' => 'N/A'
        ];

        if ($stats['total'] > 0) {
            $sumPct = 0;
            $niveauxCount = [];
            foreach ($historiques as $h) {
                $sumPct += $h->getPourcentage();
                $niveau = $h->getNiveau();
                if ($niveau) {
                    $niveauxCount[$niveau] = ($niveauxCount[$niveau] ?? 0) + 1;
                }
            }
            $stats['moyenne'] = round($sumPct / $stats['total'], 1);
            if (!empty($niveauxCount)) {
                arsort($niveauxCount);
                $stats['niveau_frequent'] = array_key_first($niveauxCount);
            }
        }

        return $this->render('pages/testpsy/historique.html.twig', [
            'historiques' => array_reverse($historiques), // DESC pour la liste
            'historiques_asc' => $historiques, // ASC pour les graphiques
            'stats' => $stats,
            'tests_map' => $testsMap,
        ]);
    }

    // ─────────────────────────────────────────────
    // RESET HISTORIQUE
    // ─────────────────────────────────────────────
    #[Route('/historique/reset', name: 'testpsy_historique_reset', methods: ['POST'])]
    public function resetHistorique(EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        $userId = $user->getId();
        $resultats = $em->getRepository(Resultat::class)->findBy(['idUtilisateur' => $userId]);
        $historiques = $em->getRepository(HistoriqueResultat::class)->findBy(['idUser' => $userId]);

        foreach ($resultats as $r) {
            $em->remove($r);
        }
        foreach ($historiques as $h) {
            $em->remove($h);
        }

        $em->flush();

        $this->addFlash('success', 'Votre historique a été réinitialisé avec succès.');
        return $this->redirectToRoute('testpsy_historique');
    }

    // ─────────────────────────────────────────────
    // STATISTIQUES GLOBALES
    // ─────────────────────────────────────────────
    #[Route('/statistiques', name: 'testpsy_statistiques')]
    public function statistiquesGlobales(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();

        $sqlPassages = "
            SELECT t.id_test, t.titre, COUNT(h.id_historique) as nb_passages 
            FROM test_psychologique t
            LEFT JOIN historique_resultat h ON t.id_test = h.id_test
            GROUP BY t.id_test, t.titre
            ORDER BY nb_passages DESC
        ";
        $passages = $conn->executeQuery($sqlPassages)->fetchAllAssociative();

        $sqlMoyennes = "
            SELECT t.id_test, t.titre, 
                   IFNULL(ROUND(AVG(h.pourcentage), 1), 0) as moyenne 
            FROM test_psychologique t
            JOIN historique_resultat h ON t.id_test = h.id_test
            GROUP BY t.id_test, t.titre
            ORDER BY moyenne DESC
        ";
        $moyennes = $conn->executeQuery($sqlMoyennes)->fetchAllAssociative();

        $stats = [
            'total_passages' => 0,
            'populaire' => null
        ];

        foreach ($passages as $p) {
            $stats['total_passages'] += (int) $p['nb_passages'];
        }
        
        if (!empty($passages) && (int) $passages[0]['nb_passages'] > 0) {
            $stats['populaire'] = $passages[0]['titre'];
        }

        return $this->render('pages/testpsy/statistiques_globales.html.twig', [
            'passages' => $passages,
            'moyennes' => $moyennes,
            'stats_globales' => $stats
        ]);
    }

    // ─────────────────────────────────────────────
    // CREATE
    // ─────────────────────────────────────────────
    #[Route('/create', name: 'testpsy_create', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_PSYCHOLOGUE')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $types  = $this->getTypes($em);
        $errors = [];
        $old    = [];

        if ($request->isMethod('POST')) {
            $titre       = trim($request->request->get('titre', ''));
            $idType      = $request->request->get('id_type', '');
            $description = trim($request->request->get('description', ''));
            $questions   = array_filter(
                array_map('trim', $request->request->all('questions')),
                fn($q) => $q !== ''
            );

            if ($titre === '') {
                $errors['titre'] = 'Le titre est obligatoire.';
            } elseif (mb_strlen($titre) < 3) {
                $errors['titre'] = 'Le titre doit contenir au moins 3 caractères.';
            } elseif (mb_strlen($titre) > 255) {
                $errors['titre'] = 'Le titre ne peut pas dépasser 255 caractères.';
            }

            if ($idType === '') {
                $errors['id_type'] = 'Veuillez sélectionner un type de test.';
            } else {
                $validIds = array_column($types, 'id_type');
                if (!in_array((int) $idType, array_map('intval', $validIds))) {
                    $errors['id_type'] = 'Type de test invalide.';
                }
            }

            if ($description !== '' && mb_strlen($description) > 2000) {
                $errors['description'] = 'La description ne peut pas dépasser 2000 caractères.';
            }

            if (count($questions) === 0) {
                $errors['questions'] = 'Ajoutez au moins une question.';
            }

            $old = [
                'titre'       => $titre,
                'id_type'     => $idType,
                'description' => $description,
                'questions'   => array_values($questions),
            ];

            if (empty($errors)) {
                $test = new TestPsychologique();
                $test->setTitre($titre)
                     ->setIdType((int) $idType)
                     ->setDescription($description ?: null)
                     ->setNombreQuestions(0);

                $em->persist($test);
                $em->flush();

                $count = 0;
                foreach ($questions as $contenu) {
                    $q = new Question();
                    $q->setTest($test)->setContenu($contenu);
                    $em->persist($q);
                    $count++;
                }

                $test->setNombreQuestions($count);
                $em->flush();

                $this->addFlash('success', 'Test créé avec succès !');
                return $this->redirectToRoute('testpsy_index');
            }
        }

        return $this->render('pages/testpsy/create.html.twig', [
            'types'  => $types,
            'errors' => $errors,
            'old'    => $old,
        ]);
    }

    // ─────────────────────────────────────────────
    // EDIT
    // ─────────────────────────────────────────────
    #[Route('/{id}/edit', name: 'testpsy_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_PSYCHOLOGUE')]
    public function edit(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $test   = $em->getRepository(TestPsychologique::class)->find($id);
        if (!$test) throw $this->createNotFoundException('Test introuvable.');

        $types  = $this->getTypes($em);
        $errors = [];

        if ($request->isMethod('POST')) {
            $titre       = trim($request->request->get('titre', ''));
            $idType      = $request->request->get('id_type', '');
            $description = trim($request->request->get('description', ''));
            $questions   = array_filter(
                array_map('trim', $request->request->all('questions')),
                fn($q) => $q !== ''
            );

            if ($titre === '') {
                $errors['titre'] = 'Le titre est obligatoire.';
            } elseif (mb_strlen($titre) < 3) {
                $errors['titre'] = 'Le titre doit contenir au moins 3 caractères.';
            } elseif (mb_strlen($titre) > 255) {
                $errors['titre'] = 'Le titre ne peut pas dépasser 255 caractères.';
            }

            if ($idType === '') {
                $errors['id_type'] = 'Veuillez sélectionner un type de test.';
            } else {
                $validIds = array_column($types, 'id_type');
                if (!in_array((int) $idType, array_map('intval', $validIds))) {
                    $errors['id_type'] = 'Type de test invalide.';
                }
            }

            if ($description !== '' && mb_strlen($description) > 2000) {
                $errors['description'] = 'La description ne peut pas dépasser 2000 caractères.';
            }

            if (count($questions) === 0) {
                $errors['questions'] = 'Ajoutez au moins une question.';
            }

            if (empty($errors)) {
                $test->setTitre($titre)
                     ->setDescription($description ?: null)
                     ->setIdType((int) $idType);

                foreach ($em->getRepository(Question::class)->findBy(['test' => $test]) as $eq) {
                    $em->remove($eq);
                }
                $em->flush();

                $count = 0;
                foreach ($questions as $contenu) {
                    $q = new Question();
                    $q->setTest($test)->setContenu($contenu);
                    $em->persist($q);
                    $count++;
                }

                $test->setNombreQuestions($count);
                $em->flush();

                $this->addFlash('success', 'Test modifié avec succès !');
                return $this->redirectToRoute('testpsy_index');
            }
        }

        return $this->render('pages/testpsy/edit.html.twig', [
            'test'      => $test,
            'questions' => $em->getRepository(Question::class)->findBy(['test' => $test]),
            'types'     => $types,
            'errors'    => $errors,
        ]);
    }

    // ─────────────────────────────────────────────
    // DELETE
    // ─────────────────────────────────────────────
    #[Route('/{id}/delete', name: 'testpsy_delete', methods: ['POST'])]
    #[IsGranted('ROLE_PSYCHOLOGUE')]
    public function delete(int $id, EntityManagerInterface $em): Response
    {
        $test = $em->getRepository(TestPsychologique::class)->find($id);
        if (!$test) throw $this->createNotFoundException('Test introuvable.');

        foreach ($em->getRepository(Question::class)->findBy(['test' => $test]) as $q) {
            $em->remove($q);
        }
        foreach ($em->getRepository(TrancheResultat::class)->findBy(['test' => $test]) as $t) {
            $em->remove($t);
        }

        $em->remove($test);
        $em->flush();

        $this->addFlash('success', 'Test supprimé avec succès.');
        return $this->redirectToRoute('testpsy_index');
    }

    // ─────────────────────────────────────────────
    // EDIT QUESTION
    // ─────────────────────────────────────────────
    #[Route('/question/{id}/edit', name: 'testpsy_question_edit', methods: ['POST'])]
    #[IsGranted('ROLE_PSYCHOLOGUE')]
    public function editQuestion(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $question = $em->getRepository(Question::class)->find($id);
        if (!$question) throw $this->createNotFoundException('Question introuvable.');

        $question->setContenu($request->request->get('contenu'));
        $em->flush();

        return $this->redirectToRoute('testpsy_edit', ['id' => $question->getTest()->getIdTest()]);
    }

    // ─────────────────────────────────────────────
    // DELETE QUESTION
    // ─────────────────────────────────────────────
    #[Route('/question/{id}/delete', name: 'testpsy_question_delete', methods: ['POST'])]
    #[IsGranted('ROLE_PSYCHOLOGUE')]
    public function deleteQuestion(int $id, EntityManagerInterface $em): Response
    {
        $question = $em->getRepository(Question::class)->find($id);
        if (!$question) throw $this->createNotFoundException('Question introuvable.');

        $test   = $question->getTest();
        $testId = $test->getIdTest();

        $em->remove($question);
        $test->setNombreQuestions($test->getNombreQuestions() - 1);
        $em->flush();

        return $this->redirectToRoute('testpsy_edit', ['id' => $testId]);
    }

    // ─────────────────────────────────────────────
    // SUPPRIMER ESSAI
    // ─────────────────────────────────────────────
    #[Route('/resultat/{id}/supprimer', name: 'testpsy_supprimer_essai', methods: ['POST'])]
    public function supprimerEssai(int $id, EntityManagerInterface $em): Response
    {
        $resultat = $em->getRepository(Resultat::class)->find($id);
        if (!$resultat) throw $this->createNotFoundException('Résultat introuvable.');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if ($resultat->getIdUtilisateur() !== $user->getId()) {
            throw $this->createAccessDeniedException();
        }

        $em->remove($resultat);
        $em->flush();

        $this->addFlash('success', 'Essai supprimé. Vous pouvez repasser le test.');
        return $this->redirectToRoute('testpsy_index');
    }
}