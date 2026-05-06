<?php

namespace App\Controller\Testpsy;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
use App\Entity\Testpsy\Resultat;
use App\Entity\Testpsy\AIRecommandation;

class PredectionController extends AbstractController
{
    private const NB_FEATURES  = 7;
    private const NB_CLASSES   = 3;
    private const LEARNING_RATE = 0.1;
    private const NB_ITERATIONS = 1000;
    private const LABELS = ["Fragile", "Stable", "Résilient"];

    /** @var array<int, array<int, float>> */
    private array $poids = [];

    /** @var array<int, float> */
    private array $biais = [];
    private Connection $connection;

    // ── Données d'entraînement KNN ──────────────────────────────────────────
    private const KNN_DATA = [
        // [features(7), label]
        [[0.10,0.80,0.20,0.90,0.15,0.85,0.10], 0],
        [[0.15,0.75,0.25,0.85,0.20,0.80,0.15], 0],
        [[0.20,0.70,0.30,0.80,0.10,0.90,0.20], 0],
        [[0.12,0.85,0.15,0.95,0.05,0.88,0.08], 0],
        [[0.18,0.72,0.22,0.78,0.25,0.82,0.12], 0],
        [[0.08,0.90,0.10,0.92,0.12,0.91,0.07], 0],
        [[0.22,0.68,0.28,0.75,0.18,0.77,0.18], 0],
        [[0.50,0.40,0.55,0.45,0.50,0.45,0.55], 1],
        [[0.55,0.35,0.60,0.40,0.55,0.40,0.60], 1],
        [[0.45,0.45,0.50,0.50,0.45,0.50,0.50], 1],
        [[0.52,0.38,0.57,0.42,0.52,0.43,0.57], 1],
        [[0.48,0.42,0.53,0.47,0.48,0.47,0.53], 1],
        [[0.60,0.30,0.65,0.35,0.60,0.35,0.65], 1],
        [[0.42,0.48,0.47,0.52,0.42,0.52,0.48], 1],
        [[0.85,0.10,0.90,0.12,0.88,0.10,0.92], 2],
        [[0.90,0.08,0.92,0.10,0.90,0.08,0.95], 2],
        [[0.80,0.15,0.85,0.15,0.82,0.12,0.88], 2],
        [[0.88,0.09,0.91,0.11,0.89,0.09,0.93], 2],
        [[0.82,0.12,0.88,0.13,0.84,0.11,0.90], 2],
        [[0.92,0.06,0.94,0.08,0.92,0.07,0.96], 2],
        [[0.78,0.18,0.82,0.17,0.80,0.14,0.86], 2],
    ];

    private const TESTS_POSITIFS = [
        "résilience","resilience","estime","confiance",
        "intelligence émotionnelle","intelligence emotionnelle",
        "cognitif","cognitive","fonctionnement cognitif",
        "mbti","personnalité","personnalite","soft skills","emotionnel"
    ];
    private const TESTS_SYMPTOMES = [
        "dépression","depression","anxiét","anxiet",
        "bpd","borderline","adhd","déficit",
        "tspt","ptsd","traumat","schizo","stress"
    ];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->entrainer();
    }

    #[Route('/api/testpsy/prediction/{idResultat}', name: 'api_testpsy_prediction_ml', methods: ['GET'])]
    public function genererRecommandationsAPI(Resultat $resultat): JsonResponse
    {
        $rec = $this->genererPrediction($resultat);
        return $this->json([
            'cluster'           => $rec->getCluster(),
            'couleur_cluster'   => $rec->getCouleurCluster(),
            'emoji_cluster'     => $rec->getEmojiCluster(),
            'probabilites'      => $rec->getProbabilites(),
            'score_confiance'   => $rec->getScoreConfiance(),
            'features'          => $rec->getFeatures(),
            'analyse_globale'   => $rec->getAnalyseGlobale(),
            'habitudes'         => $rec->getHabitudes(),
            'plan_semaine'      => $rec->getPlanSemaine(),
            'alertes'           => $rec->getAlertes(),
            'votes_modeles'     => $rec->getVotesModeles(),
            'analyse_features'  => $rec->getAnalyseFeatures(),
            'niveau_confiance'  => $rec->getNiveauConfiance(),
        ]);
    }

    #[Route('/testpsy/prediction/{idResultat}', name: 'app_testpsy_prediction', methods: ['GET'])]
    public function genererRecommandationsPage(Resultat $resultat): \Symfony\Component\HttpFoundation\Response
    {
        $rec = $this->genererPrediction($resultat);
        return $this->render('pages/testpsy/prediction.html.twig', [
            'resultat' => $resultat,
            'rec'      => $rec,
        ]);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PREDICTION PRINCIPALE
    // ─────────────────────────────────────────────────────────────────────────
    private function genererPrediction(Resultat $resultat): AIRecommandation
    {
        $idUtilisateur = $resultat->getIdUtilisateur();
        $idTest        = $resultat->getIdTest();
        $infos         = $this->recupererInfosTest($idTest);
        $titre         = $infos['titre'];
        $titreLow      = strtolower($titre);
        $positif       = $this->estPositif($titreLow);

        $features = $this->extraireFeatures($resultat, $idUtilisateur);

        // Correction polarité
        if ($positif || $this->estSymptome($titreLow)) {
            $features[0] = 1.0 - $features[0];
        }

        // ── 3 modèles ──────────────────────────────────────────────────────
        $probas         = $this->softmax($features);           // Modèle 1 : Softmax
        $clusterSoftmax = $this->argmax($probas);

        $clusterKNN     = $this->knn($features, 5);            // Modèle 2 : KNN k=5
        $clusterArbre   = $this->arbreDecision($features, $positif); // Modèle 3 : Arbre

        // ── Vote majoritaire ────────────────────────────────────────────────
        $votes = [$clusterSoftmax, $clusterKNN, $clusterArbre];
        $tally = array_count_values($votes);
        arsort($tally);
        $cluster = (int) array_key_first($tally);

        // Accord entre modèles
        $accord = count(array_unique($votes)) === 1 ? 'total'
                : (count(array_unique($votes)) === 2 ? 'partiel' : 'divergent');

        $conf = (int)($probas[$cluster] * 100);

        // Niveau de confiance enrichi
        $niveauConfiance = match($accord) {
            'total'     => 'Très élevée — les 3 modèles sont unanimes',
            'partiel'   => 'Élevée — 2 modèles sur 3 sont d\'accord',
            default     => 'Modérée — les modèles divergent, interprétez avec nuance',
        };

        // ── Votes détaillés pour affichage ─────────────────────────────────
        $votesModeles = [
            ['modele' => 'Régression Softmax',    'prediction' => self::LABELS[$clusterSoftmax], 'confiance' => $conf . '%',         'description' => 'Régression logistique multiclasse entraînée par gradient descent'],
            ['modele' => 'K-Nearest Neighbors',   'prediction' => self::LABELS[$clusterKNN],     'confiance' => 'k=5 voisins',       'description' => 'Compare votre profil aux 5 profils les plus similaires'],
            ['modele' => 'Arbre de Décision',      'prediction' => self::LABELS[$clusterArbre],   'confiance' => 'Règles explicites', 'description' => 'Décision basée sur des seuils précis de vos 7 indicateurs'],
        ];

        // ── Analyse détaillée des features ─────────────────────────────────
        $analyseFeatures = $this->analyserFeatures($features, $positif);

        // ── Construction de l'objet ─────────────────────────────────────────
        $rec = new AIRecommandation();
        $rec->setCluster(self::LABELS[$cluster]);
        $rec->setProbabilites($probas);
        $rec->setScoreConfiance($conf);
        $rec->setFeatures($features);
        $rec->setAnalyseGlobale($this->analyse($cluster, $resultat, $probas, $titre, $positif, $accord, $votesModeles));
        $rec->setHabitudes($this->habitudes($cluster, $features, $titreLow));
        $rec->setPlanSemaine($this->planSemaine($cluster, $positif));
        $rec->setAlertes($this->alertes($cluster, $features, $positif));
        $rec->setVotesModeles($votesModeles);
        $rec->setAnalyseFeatures($analyseFeatures);
        $rec->setNiveauConfiance($niveauConfiance);

        return $rec;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODÈLE 2 : K-NEAREST NEIGHBORS
    // ─────────────────────────────────────────────────────────────────────────
    //private function knn(array $features, int $k): int

    /** @param array<int, float> $features */
    private function knn(array $features, int $k): int
    {
        $distances = [];
        foreach (self::KNN_DATA as [$x, $label]) {
            $dist = 0.0;
            for ($i = 0; $i < self::NB_FEATURES; $i++) {
                $dist += pow($features[$i] - $x[$i], 2);
            }
            $distances[] = ['dist' => sqrt($dist), 'label' => $label];
        }
        usort($distances, fn($a, $b) => $a['dist'] <=> $b['dist']);

        $votes = array_fill(0, self::NB_CLASSES, 0);
        for ($i = 0; $i < min($k, count($distances)); $i++) {
            $votes[$distances[$i]['label']]++;
        }
        return $this->argmax($votes);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // MODÈLE 3 : ARBRE DE DÉCISION
    // ─────────────────────────────────────────────────────────────────────────
    /** @param array<int, float> $f */
    private function arbreDecision(array $f, bool $positif): int
    {
        // f[0] = score normalisé, f[1] = variabilité, f[2] = cohérence,
        // f[3] = fatigue fin, f[4] = énergie début, f[5] = stabilité milieu, f[6] = consistance

        $scoreGlobal = ($f[0] + $f[2] + $f[4] + $f[6]) / 4;
        $stressGlobal = ($f[1] + (1 - $f[3]) + (1 - $f[5])) / 3;

        if ($scoreGlobal >= 0.65 && $stressGlobal < 0.40) return 2; // Résilient
        if ($scoreGlobal <= 0.35 || $stressGlobal >= 0.65)  return 0; // Fragile

        // Zone intermédiaire — règles fines
        if ($f[6] >= 0.7 && $f[2] >= 0.6) return 2; // Très cohérent → Résilient
        if ($f[1] >= 0.7 && $f[0] < 0.5)  return 0; // Très variable + faible score → Fragile
        return 1; // Stable
    }

    // ─────────────────────────────────────────────────────────────────────────
    // ANALYSE DÉTAILLÉE DES 7 FEATURES
    // ─────────────────────────────────────────────────────────────────────────
    //private function analyserFeatures(array $f, bool $positif): array

    /**
    * @param array<int, float> $f
    * @return array<int, array<string, mixed>>
    */
    private function analyserFeatures(array $f, bool $positif): array
    {
        $noms = [
            'Score global',
            'Variabilité des réponses',
            'Cohérence interne',
            'Énergie en fin de test',
            'Énergie en début de test',
            'Stabilité au milieu',
            'Consistance globale',
        ];

        $analyses = [];
        foreach ($f as $i => $val) {
            $pct = (int)($val * 100);
            $niveau = $pct >= 70 ? 'Élevé' : ($pct >= 40 ? 'Modéré' : 'Faible');
            $couleur = $pct >= 70 ? '#10b981' : ($pct >= 40 ? '#f59e0b' : '#ef4444');

            $interpretation = match($i) {
                0 => $pct >= 70 ? "Votre score global est solide ({$pct}%), traduisant une bonne maîtrise dans ce domaine."
                                : ($pct >= 40 ? "Score intermédiaire ({$pct}%) — des axes d'amélioration existent."
                                             : "Score faible ({$pct}%) — ce domaine nécessite une attention particulière."),
                1 => $pct >= 70 ? "Grande variabilité ({$pct}%) dans vos réponses — vos états émotionnels fluctuent selon les situations."
                                : ($pct >= 40 ? "Variabilité modérée ({$pct}%) — certaines situations vous déstabilisent plus que d'autres."
                                             : "Réponses très homogènes ({$pct}%) — vous percevez les situations de façon similaire."),
                2 => $pct >= 70 ? "Excellente cohérence ({$pct}%) — vos réponses sont logiques et non contradictoires."
                                : ($pct >= 40 ? "Cohérence acceptable ({$pct}%) — quelques incohérences mineures détectées."
                                             : "Faible cohérence ({$pct}%) — vos réponses sont contradictoires par endroits."),
                3 => $pct >= 70 ? "Bonne énergie en fin de test ({$pct}%) — vous restez concentré(e) même en fin d'effort."
                                : ($pct >= 40 ? "Légère baisse d'attention en fin de test ({$pct}%)."
                                             : "Fatigue significative détectée en fin de test ({$pct}%) — votre attention s'érode."),
                4 => $pct >= 70 ? "Bonne mobilisation initiale ({$pct}%) — vous démarrez avec engagement."
                                : ($pct >= 40 ? "Démarrage hésitant ({$pct}%) — vos premières réponses sont plus prudentes."
                                             : "Faible engagement initial ({$pct}%) — difficultés de mobilisation."),
                5 => $pct >= 70 ? "Stabilité excellente au milieu du test ({$pct}%) — vous maintenez le cap."
                                : ($pct >= 40 ? "Légères fluctuations en milieu de test ({$pct}%)."
                                             : "Instabilité marquée au milieu ({$pct}%) — moment de doute ou de fatigue."),
                6 => $pct >= 70 ? "Très bonne consistance ({$pct}%) — vos réponses sont régulières et fiables."
                                : ($pct >= 40 ? "Consistance moyenne ({$pct}%) — quelques irrégularités dans le patron de réponse."
                                             : "Faible consistance ({$pct}%) — le patron de réponse est irrégulier."),
                default => ''
            };

            $analyses[] = [
                'nom'            => $noms[$i],
                'valeur'         => $val,
                'pourcentage'    => $pct,
                'niveau'         => $niveau,
                'couleur'        => $couleur,
                'interpretation' => $interpretation,
            ];
        }
        return $analyses;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // ANALYSE GLOBALE ENRICHIE
    // ─────────────────────────────────────────────────────────────────────────
    //private function analyse(int $cl, Resultat $r, array $p, string $titre, bool $positif, string $accord, array $votes): string

    /**
    * @param array<int, float> $p
    * @param array<int, array<string, string>> $votes
    */
    private function analyse(int $cl, Resultat $r, array $p, string $titre, bool $positif, string $accord, array $votes): string    
    {
        $pct      = sprintf("%.0f%%", $r->getPourcentage());
        $conf     = sprintf("%.0f%%", $p[$cl] * 100);
        $unanime  = $accord === 'total' ? "Analyse effectuée avec une très haute fiabilité." : ($accord === 'partiel' ? "Analyse effectuée avec une fiabilité élevée." : "Résultat à interpréter avec nuance.");
        if ($positif) {
            return match($cl) {
                2 => "Analyse  — Test « {$titre} » | Score : {$pct} | Confiance  : {$conf}\n\n{$unanime}\n\nVotre profil est classé RÉSILIENT sur ce domaine. On détecte une grande cohérence dans vos réponses (peu de variabilité, fort maintien de l'attention) — signature caractéristique d'une compétence réellement intégrée et non superficielle. Votre score de {$pct} place votre profil dans le quartile supérieur. Continuez à relever des défis à la hauteur de votre niveau pour éviter la stagnation.",
                1 => "Analyse  — Test « {$titre} » | Score : {$pct} | Confiance : {$conf}\n\n{$unanime}\n\nVotre profil est classé STABLE sur ce domaine. Vous possédez de bonnes bases avec des zones d'amélioration identifiées. Le modèle détecte une légère variabilité dans vos réponses — certaines situations vous déstabilisent encore. Avec des habitudes ciblées sur vos points faibles, une progression vers le profil Résilient est réaliste en 2-3 mois.",
                default => "Analyse  — Test « {$titre} » | Score : {$pct} | Confiance  : {$conf}\n\n{$unanime}\n\nVotre profil est classé FRAGILE sur ce domaine. Ce résultat indique que des compétences spécifiques restent à développer. Il ne s'agit pas d'un jugement, mais d'un point de départ. On détecte une incohérence dans vos réponses qui suggère un manque de repères stables dans ce domaine. Les habitudes recommandées sont conçues pour construire ces fondations progressivement.",
            };
        }

        return match($cl) {
            0 => "Analyse  — Test « {$titre} » | Score : {$pct} | Confiance  : {$conf}\n\n{$unanime}\n\nVotre profil révèle un niveau de symptômes ÉLEVÉ. On détecte une forte intensité dans vos réponses et une variabilité importante — signature d'une détresse significative. Ce résultat ne constitue pas un diagnostic, mais indique fortement qu'un accompagnement professionnel serait bénéfique. Les recommandations ci-dessous sont basées sur les protocoles cliniques validés pour ce type de profil.",
            1 => "Analyse — Test « {$titre} » | Score : {$pct} | Confiance  : {$conf}\n\n{$unanime}\n\nVotre profil montre un niveau de symptômes MODÉRÉ. Quelques signaux à surveiller, mais la situation reste gérables avec les bonnes habitudes. Le modèle détecte une instabilité partielle dans certaines zones de vos réponses. Les recommandations ci-dessous ciblent précisément ces zones pour prévenir une aggravation.",
            default => "Analyse  — Test « {$titre} » | Score : {$pct} | Confiance  : {$conf}\n\n{$unanime}\n\nExcellente nouvelle : votre profil montre peu de symptômes significatifs (profil RÉSILIENT). On confirme une grande cohérence dans vos réponses et un maintien stable de l'attention tout au long du test — indicateurs d'un bon équilibre psychologique dans ce domaine. Maintenez vos pratiques actuelles et restez attentif(ve) aux signaux précoces.",
        };
    }

    // ─────────────────────────────────────────────────────────────────────────
    // SOFTMAX + ENTRAÎNEMENT
    // ─────────────────────────────────────────────────────────────────────────
    private function entrainer(): void
    {
        $X = array_column(self::KNN_DATA, 0);
        $Y = array_column(self::KNN_DATA, 1);

        mt_srand(42);
        for ($c = 0; $c < self::NB_CLASSES; $c++) {
            $this->biais[$c] = 0.0;
            for ($f = 0; $f < self::NB_FEATURES; $f++) {
                $this->poids[$c][$f] = ((mt_rand() / mt_getrandmax()) - 0.5) * 0.01;
            }
        }
        for ($iter = 0; $iter < self::NB_ITERATIONS; $iter++) {
            foreach ($X as $n => $x_n) {
                $p = $this->softmax($x_n);
                for ($c = 0; $c < self::NB_CLASSES; $c++) {
                    $g = $p[$c] - ($c === $Y[$n] ? 1.0 : 0.0);
                    $this->biais[$c] -= self::LEARNING_RATE * $g;
                    for ($f = 0; $f < self::NB_FEATURES; $f++) {
                        $this->poids[$c][$f] -= self::LEARNING_RATE * $g * $x_n[$f];
                    }
                }
            }
        }
    }

    //private function softmax(array $x): array
    /**
    * @param array<int, float> $x
    * @return array<int, float>
    */
    private function softmax(array $x): array
    {
        $lg = []; $mx = -INF;
        for ($c = 0; $c < self::NB_CLASSES; $c++) {
            $lg[$c] = $this->biais[$c];
            for ($f = 0; $f < self::NB_FEATURES; $f++) $lg[$c] += $this->poids[$c][$f] * $x[$f];
            if ($lg[$c] > $mx) $mx = $lg[$c];
        }
        $p = []; $s = 0;
        for ($c = 0; $c < self::NB_CLASSES; $c++) { $p[$c] = exp($lg[$c] - $mx); $s += $p[$c]; }
        for ($c = 0; $c < self::NB_CLASSES; $c++) $p[$c] /= $s;
        return $p;
    }

    //private function argmax(array $a): int
    /** @param array<int, float|int> $a */
    private function argmax(array $a): int
    {
        $m = 0;
        for ($i = 1; $i < count($a); $i++) if ($a[$i] > $a[$m]) $m = $i;
        return $m;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────────────────
    private function estPositif(string $t): bool { foreach (self::TESTS_POSITIFS as $m) if (str_contains($t, $m)) return true; return false; }
    private function estSymptome(string $t): bool { foreach (self::TESTS_SYMPTOMES as $m) if (str_contains($t, $m)) return true; return false; }

    //private function recupererInfosTest(int $idTest): array
    /** @return array<string, string> */
    private function recupererInfosTest(int $idTest): array
    {
        $row = $this->connection->executeQuery(
            "SELECT tp.titre, tt.libelle FROM test_psychologique tp JOIN type_test tt ON tp.id_type = tt.id_type WHERE tp.id_test = ?",
            [$idTest]
        )->fetchAssociative();
        return $row ?: ['titre' => 'Test inconnu', 'nom_type' => ''];
    }

    //private function extraireFeatures(Resultat $r, int $idU): array
    /** @return array<int, float> */
    private function extraireFeatures(Resultat $r, int $idU): array
    {
        $f = array_fill(0, self::NB_FEATURES, 0.5);
        $scoreMax = $r->getScoreMaxPossible();
        $f[0] = $scoreMax > 0 ? (float)$r->getScoreTotal() / $scoreMax : 0.5;

        $stmt = $this->connection->executeQuery(
            "SELECT rep.points FROM reponse_utilisateur ru 
             JOIN reponse rep ON ru.id_reponse = rep.id_reponse 
             JOIN question q ON ru.id_question = q.id_question 
             WHERE ru.id_utilisateur = ? AND q.id_test = ? ORDER BY q.id_question",
            [$idU, $r->getIdTest()]
        );
        $pts = [];
        while ($p = $stmt->fetchOne()) $pts[] = (int)$p;

        $size = count($pts);
        if ($size === 0) return $f;

        $max = max($pts) ?: 1; $min = min($pts); $moy = array_sum($pts) / $size;
        $sumVar = 0; foreach ($pts as $p) $sumVar += pow($p - $moy, 2);
        $var = $sumVar / $size; $maxVar = pow($max - $min, 2) / 4.0;

        $f[1] = $maxVar > 0 ? min(1.0, $var / $maxVar) : 0;
        $f[2] = 1.0 - $f[1];

        $sf = (int)($size * 0.7); $mf = 0; $cf = 0;
        for ($i = $sf; $i < $size; $i++) { $mf += $pts[$i]; $cf++; }
        $f[3] = ($cf > 0 && $max > 0) ? 1.0 - ($mf / $cf / $max) : 0.5;

        $ss = (int)($size * 0.3); $ms = 0;
        for ($i = 0; $i < min($ss, $size); $i++) $ms += $pts[$i];
        $f[4] = ($ss > 0 && $max > 0) ? $ms / ($ss * $max) : 0.5;

        $d = (int)($size * 0.3); $fn = (int)($size * 0.7); $mst = 0; $cst = 0;
        for ($i = $d; $i < $fn && $i < $size; $i++) { $mst += $pts[$i]; $cst++; }
        $f[5] = ($cst > 0 && $max > 0) ? 1.0 - ($mst / $cst / $max) : 0.5;

        $et = sqrt($var);
        $f[6] = ($max - $min) > 0 ? 1.0 - min(1.0, $et / ($max - $min)) : 1.0;
        return $f;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HABITUDES — (identiques à l'original, conservées)
    // ─────────────────────────────────────────────────────────────────────────
    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function habitudes(int $cl, array $f, string $tl): array
    {
        if (str_contains($tl, "anxiét") || str_contains($tl, "anxiet")) return $this->hAnxiete($cl, $f);
        if (str_contains($tl, "bpd") || str_contains($tl, "borderline")) return $this->hBPD($cl, $f);
        if (str_contains($tl, "adhd") || str_contains($tl, "déficit") || str_contains($tl, "attention")) return $this->hADHD($cl, $f);
        if (str_contains($tl, "tspt") || str_contains($tl, "ptsd") || str_contains($tl, "traumat")) return $this->hPTSD($cl, $f);
        if (str_contains($tl, "schizo")) return $this->hSchizo($cl, $f);
        if (str_contains($tl, "résilience") || str_contains($tl, "resilience")) return $this->hResilience($cl, $f);
        if (str_contains($tl, "estime") || str_contains($tl, "confiance")) return $this->hEstime($cl, $f);
        if (str_contains($tl, "intelligence") || str_contains($tl, "emotionnel")) return $this->hIE($cl, $f);
        if (str_contains($tl, "cognitif") || str_contains($tl, "cognitive")) return $this->hCognitif($cl, $f);
        if (str_contains($tl, "mbti") || str_contains($tl, "personnali")) return $this->hMBTI($cl, $f);
        return $this->hGenerique($cl, $f);
    }

    /** @return array<string, string> */
    private function H(string $e, string $t, string $d, string $fr, string $c, string $i): array
    {
        return ['emoji'=>$e,'titre'=>$t,'description'=>$d,'frequence'=>$fr,'categorie'=>$c,'impact'=>$i];
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hAnxiete(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🌬️","Cohérence cardiaque","3 séances/jour 5 min : inspirez 5s, expirez 5s. Réduit le cortisol de 20%.","3x / jour","Stress","CRITIQUE");
            $h[] = $this->H("🏥","Consultation TCC","La TCC est efficace à 85% pour l'anxiété en 12 séances.","Urgent","Suivi médical","CRITIQUE");
            $h[] = $this->H("🚫","Zéro caféine","Supprimez la caféine : amplifie les crises d'anxiété.","Quotidien","Nutrition","Élevé");
            $h[] = $this->H("🌙","Sommeil strict","Coucher fixe ±15 min, 18°C, aucun écran après 20h.","Quotidien","Sommeil","CRITIQUE");
            $h[] = $this->H("🥗","Nutrition anti-anxiété","Magnésium (amandes, épinards), oméga-3 (poisson gras). Évitez le sucre raffiné qui provoque des pics glycémiques anxiogènes.","Quotidien","Nutrition","Élevé");
$h[] = $this->H("🌞","Lumière matinale","20 min de lumière naturelle le matin régule le cortisol et améliore la sérotonine de 30%.","Quotidien (matin)","Bien-être","Élevé");
            if($f[4]<0.3) $h[] = $this->H("👥","Anti-isolement","1 contact humain/jour. L'isolement amplifie l'anxiété de 40%.","Quotidien","Lien social","CRITIQUE");
        } elseif ($cl==1) {
            $h[] = $this->H("🧘","Méditation guidée","10 min/matin. Réduit l'anxiété de 30% en 8 semaines.","Quotidien","Bien-être","Élevé");
            $h[] = $this->H("📵","Détox numérique","Pas de réseaux sociaux avant 9h et après 21h.","Quotidien","Hygiène mentale","Élevé");
            $h[] = $this->H("🏃","Cardio 3x/semaine","30 min course ou natation : libère des endorphines.","3x / semaine","Sport","Élevé");
            $h[] = $this->H("🫁","Cohérence cardiaque","5 min matin : inspirez 5s, expirez 5s. Régule le système nerveux autonome.","Quotidien (matin)","Stress","Élevé");
$h[] = $this->H("🌿","Nature therapy","30 min en nature 2x/semaine : réduit le cortisol de 15%.","2x / semaine","Bien-être","Moyen");
            $h[] = $this->H("📓","Journal d'inquiétudes","Chaque soir : écrivez vos préoccupations puis fermez le carnet.","Quotidien (soir)","Santé mentale","Moyen");
        } else {
            $h[] = $this->H("✅","Maintien de vos pratiques","Vos habitudes anti-stress fonctionnent. Continuez !","Quotidien","Prévention","Maintien");
            $h[] = $this->H("🌿","Pleine conscience","5-10 min mindfulness matin pour ancrer votre sérénité.","Quotidien","Bien-être","Maintien");
            $h[] = $this->H("📊","Suivi émotionnel","Notez votre humeur sur 1-10 chaque semaine. Anticipez les baisses avant qu'elles arrivent.","Hebdomadaire","Auto-monitoring","Maintien");
$h[] = $this->H("🎨","Activité créative","Dessin, musique, écriture : 20 min/semaine. La créativité est un régulateur émotionnel puissant.","Hebdomadaire","Épanouissement","Maintien");
            $h[] = $this->H("🤝","Soutien aux proches","Votre équilibre vous permet d'aider des personnes anxieuses.","Hebdomadaire","Impact social","Fort");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hBPD(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🏥","Thérapie DBT urgente","DBT = thérapie de référence pour le BPD.","Urgent","Suivi médical","CRITIQUE");
            $h[] = $this->H("🧊","Technique TIP","Temperature : glaçons dans les mains 30s pour stopper une crise émotionnelle intense immédiatement.","À chaque crise","Régulation","CRITIQUE");
$h[] = $this->H("📋","Fiche de crise personnelle","Préparez à froid : déclencheurs, signaux précoces, 3 actions à faire. Lisez-la en crise.","Cette semaine","Prévention","CRITIQUE");
            $h[] = $this->H("📞","Numéro 3114","En cas d'impulsions auto-destructrices : 3114 disponible 24h/24.","Si besoin","Sécurité","CRITIQUE");
            $h[] = $this->H("⏸️","Technique STOP","Face à émotion intense : Stopper — Temps — Observer — Prendre du recul.","À chaque crise","Régulation","CRITIQUE");
            $h[] = $this->H("🌊","Surf de l'émotion","L'émotion intense est une vague : elle monte, puis redescend.","Quotidien","Tolérance","Élevé");
        } elseif ($cl==1) {
            $h[] = $this->H("📚","Compétences DBT","Apprenez les 4 modules DBT : Pleine conscience, Tolérance, Régulation, Efficacité relationnelle.","Hebdomadaire","Thérapie","Élevé");
            $h[] = $this->H("📓","Journal DBT","Notez : déclencheur → émotion → envie → action choisie.","Quotidien","Auto-observation","Élevé");
            $h[] = $this->H("🤝","Réseau stable","2-3 personnes ressources à appeler en cas de crise.","Hebdomadaire","Lien social","Élevé");
            $h[] = $this->H("🎨","Art-thérapie","Expression artistique sans jugement : externalise les émotions difficiles à verbaliser.","2x / semaine","Expression","Élevé");
$h[] = $this->H("🌿","Routine apaisante","20 min d'activité sensorielle apaisante (bain chaud, musique douce) en fin de journée.","Quotidien (soir)","Régulation","Moyen");
        } else {
            $h[] = $this->H("✅","Équilibre préservé","Peu de traits BPD. Maintenez vos pratiques de régulation.","Quotidien","Prévention","Maintien");
            $h[] = $this->H("🧘","Pleine conscience","Observez vos émotions sans les juger.","Quotidien","Bien-être","Maintien");
            $h[] = $this->H("📈","Optimisation continue","Revoyez votre système d'organisation chaque mois. Ce qui fonctionne maintenant peut évoluer.","Mensuel","Organisation","Maintien");
$h[] = $this->H("🤝","Communauté ADHD","Rejoignez un groupe de soutien ADHD. Partager les stratégies accélère l'adaptation.","Hebdomadaire","Lien social","Fort");
        }
        return $h;
    }
    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hADHD(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🏥","Bilan psychiatrique ADHD","Tests neuropsychologiques + bilan complet.","Urgent","Suivi médical","CRITIQUE");
            $h[] = $this->H("⏱️","Pomodoro strict","25 min travail + 5 min pause. Cycles courts.","Chaque session","Productivité","CRITIQUE");
            $h[] = $this->H("🏃","Cardio matinal","30 min sport intense libère dopamine et noradrénaline.","Quotidien (matin)","Sport","CRITIQUE");
            $h[] = $this->H("📵","Élimination distractions","Mode avion pendant les sessions, bureau épuré.","Pendant le travail","Organisation","Élevé");
            $h[] = $this->H("📅","Externalisation totale","Agenda, rappels, listes visibles. Externalisez tout.","Quotidien","Organisation","CRITIQUE");
        } elseif ($cl==1) {
            $h[] = $this->H("⏱️","Pomodoro adapté","25 min + 5 min. Respectez les pauses.","Jours de travail","Productivité","Élevé");
            $h[] = $this->H("🎧","Musique de concentration","Bruit blanc ou lo-fi pendant le travail.","Pendant le travail","Focus","Moyen");
            $h[] = $this->H("🗂️","GTD simplifié","1 liste unique de toutes vos tâches.","Quotidien","Organisation","Élevé");
        } else {
            $h[] = $this->H("✅","Bonnes adaptations","Vos stratégies ADHD fonctionnent.","Quotidien","Productivité","Maintien");
            $h[] = $this->H("📈","Optimisation continue","Revoyez votre système d'organisation chaque mois. Ce qui fonctionne maintenant peut évoluer.","Mensuel","Organisation","Maintien");
$h[] = $this->H("🤝","Communauté ADHD","Rejoignez un groupe de soutien ADHD. Partager les stratégies accélère l'adaptation.","Hebdomadaire","Lien social","Fort");
            $h[] = $this->H("🎓","Aménagements formels","Renseignez-vous sur vos droits : temps supplémentaire aux examens.","Ponctuel","Droits","Fort");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hPTSD(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🏥","EMDR ou exposition","EMDR et exposition prolongée ont 80% d'efficacité.","Urgent","Suivi médical","CRITIQUE");
            $h[] = $this->H("🌬️","Respiration box","4s inspir — 4s pause — 4s expir — 4s pause. Stoppe la réponse de stress en 2 minutes.","À chaque flashback","Régulation","CRITIQUE");
$h[] = $this->H("🛡️","Environnement sécurisé","Identifiez et aménagez un espace physique où vous vous sentez en sécurité totale.","Cette semaine","Sécurité","CRITIQUE");
            $h[] = $this->H("🌬️","Grounding 5-4-3-2-1","En flashback : 5 vues, 4 sons, 3 textures, 2 odeurs, 1 goût.","À chaque flashback","Régulation","CRITIQUE");
            $h[] = $this->H("🚫","Pas d'alcool","L'alcool aggrave cauchemars et hypervigilance.","Quotidien","Santé","CRITIQUE");
        } elseif ($cl==1) {
            $h[] = $this->H("🧘","Yoga trauma-informé","Reconnecte avec le corps après un trauma.","3x / semaine","Corps","Élevé");
            $h[] = $this->H("🎵","Musicothérapie","Playlist apaisante 20 min/jour. La musique régule l'amygdale et réduit l'hypervigilance.","Quotidien","Régulation","Moyen");
$h[] = $this->H("📓","Journal de récupération","Notez chaque soir : 1 moment de sécurité ressenti aujourd'hui. Reconstruit le sentiment de sûreté.","Quotidien (soir)","Santé mentale","Élevé");
            $h[] = $this->H("😴","Protocole sommeil","Lumière bleue bloquée après 19h, routine 30 min avant coucher.","Quotidien (soir)","Sommeil","Élevé");
        } else {
            $h[] = $this->H("✅","Bonne récupération","Peu de symptômes TSPT. Votre résilience post-traumatique est un atout.","Quotidien","Prévention","Maintien");
            $h[] = $this->H("💪","Post-traumatic growth","Identifiez ce que le trauma vous a appris sur vous-même. La croissance post-traumatique est réelle.","Mensuel","Sens","Fort");
$h[] = $this->H("🌍","Engagement communautaire","Aidez d'autres survivants : transforme l'expérience en force et renforce le sens.","Hebdomadaire","Impact social","Fort");
            $h[] = $this->H("🤝","Entretenir le réseau social","Le soutien social est le meilleur bouclier contre le TSPT.","Hebdomadaire","Lien social","Maintien");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hSchizo(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🚨","Urgences psychiatriques","Consultez un psychiatre immédiatement.","Urgent","Suivi médical","CRITIQUE");
            $h[] = $this->H("👥","Ne restez pas seul","Prévenez un proche immédiatement.","Immédiat","Sécurité","CRITIQUE");
            $h[] = $this->H("📞","Ligne de crise","3114 disponible 24h/24, gratuit et confidentiel. N'attendez pas.","Si besoin","Sécurité","CRITIQUE");
$h[] = $this->H("📋","Plan de crise écrit","Avec votre psychiatre : signes précoces, personnes à appeler, hôpital de référence.","À préparer","Sécurité","CRITIQUE");

            $h[] = $this->H("🚫","Zéro substances","Cannabis et toutes substances : risque de décompensation.","Quotidien","Santé","CRITIQUE");
        } elseif ($cl==1) {
            $h[] = $this->H("🏥","Parlez à votre médecin","Signalez ces symptômes lors du prochain rendez-vous.","Prochain RDV","Suivi médical","Élevé");
            $h[] = $this->H("😴","Sommeil régulier","Même heure 7j/7. L'irrégularité est un déclencheur.","Quotidien","Sommeil","Élevé");
            $h[] = $this->H("🎨","Activité structurée","1 activité quotidienne à heure fixe (marche, dessin). La structure réduit le risque de décompensation.","Quotidien","Organisation","Élevé");
$h[] = $this->H("👥","Groupe de pairs","Groupes d'entraide pour personnes concernées par la psychose. Réduit l'isolement et la stigmatisation.","Hebdomadaire","Lien social","Élevé");
            $h[] = $this->H("🚫","Abstinence cannabis","Multiplie par 4 le risque de décompensation.","Quotidien","Santé","CRITIQUE");
        } else {
            $h[] = $this->H("🏃","Activité physique régulière","30 min de marche 5x/semaine. Réduit le risque de rechute et améliore le bien-être général.","5x / semaine","Sport","Fort");
            $h[] = $this->H("✅","Aucun signe significatif","Maintenez : sommeil régulier, pas de substances.","Quotidien","Prévention","Maintien");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hResilience(int $cl, array $f): array {
        $h = [];
        if ($cl==2) {
            $h[] = $this->H("📖","Lecture de développement","1 livre de développement personnel/mois. Nourrissez votre mindset de croissance.","Mensuel","Formation","Fort");
            $h[] = $this->H("🎯","OKR trimestriels","1 objectif + 3 résultats mesurables/trimestre.","Hebdomadaire","Performance","Maintien");
            $h[] = $this->H("🤝","Devenir mentor","Guidez un proche en difficulté.","2x / semaine","Impact social","Fort");
            $h[] = $this->H("💪","Hormèse volontaire","Douche froide, jeûne intermittent, sport intense.","3x / semaine","Résilience physique","Fort");
        } elseif ($cl==1) {
            $h[] = $this->H("🧘","Méditation de compassion","10 min/jour de loving-kindness meditation. Renforce la résilience émotionnelle face aux échecs.","Quotidien","Bien-être","Élevé");
$h[] = $this->H("🌞","Gratitude quotidienne","3 choses positives chaque soir. Recâble le cerveau vers la résilience en 21 jours.","Quotidien (soir)","Mindset","Moyen");
            $h[] = $this->H("🌱","Growth Mindset","Chaque échec = une information, pas un jugement.","Quotidien","Mindset","Élevé");
            $h[] = $this->H("📋","Plan de rebond","Pour chaque objectif : 2 obstacles possibles + 1 solution.","Hebdomadaire","Planification","Élevé");
            $h[] = $this->H("📓","Journal de résilience","Notez chaque jour 1 obstacle surmonté.","Quotidien","Auto-observation","Moyen");
        } else {
            $h[] = $this->H("🌱","Micro-habitude unique","Choisissez 1 seule habitude ultra-simple (2 min/jour). La résilience se construit une brique à la fois.","Quotidien","Démarrage","Élevé");
$h[] = $this->H("📞","Ligne d'écoute","Si vous vous sentez submergé(e) : 3114, disponible 24h/24, gratuit.","Si besoin","Sécurité","CRITIQUE");
            $h[] = $this->H("🔍","Vos preuves de force","Listez 3 difficultés passées surmontées.","Cette semaine","Mindset","Élevé");
            $h[] = $this->H("🤝","Réseau de soutien","Identifiez 3 personnes ressources.","Maintenant","Lien social","CRITIQUE");
            $h[] = $this->H("🏥","Accompagnement professionnel","Un psychologue vous aidera avec des outils concrets.","Consultez","Suivi médical","Élevé");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hEstime(int $cl, array $f): array {
        $h = [];
        if ($cl==2) {
            $h[] = $this->H("📝","Lettre à votre futur soi","Écrivez une lettre décrivant qui vous voulez devenir dans 1 an. Relisez-la chaque mois.","Mensuel","Vision","Fort");
$h[] = $this->H("🏅","Célébration des succès","Célébrez explicitement chaque réussite, même petite. L'estime se nourrit de la reconnaissance de soi.","Hebdomadaire","Confiance","Maintien");
            $h[] = $this->H("🌟","Défis qui font grandir","Cherchez des défis légèrement au-dessus de votre niveau.","Trimestriel","Épanouissement","Maintien");
            $h[] = $this->H("🤝","Mentorat","Aidez quelqu'un à développer sa confiance.","Hebdomadaire","Impact social","Fort");
        } elseif ($cl==1) {
            $h[] = $this->H("🪞","Miroir positif","Chaque matin : 1 qualité que vous vous reconnaissez. Simple, rapide, puissant sur 30 jours.","Quotidien (matin)","Auto-image","Moyen");
$h[] = $this->H("🚀","Sortie de zone de confort","1 petite action inconfortable/semaine. Chaque dépassement reconstruit l'estime progressivement.","Hebdomadaire","Défi","Élevé");
            $h[] = $this->H("🏆","Journal des victoires","Notez 1 chose accomplie/jour.","Quotidien (soir)","Confiance","Élevé");
            $h[] = $this->H("📵","Moins de comparaison","Instagram/TikTok → 20 min/jour max.","Quotidien","Hygiène mentale","Élevé");
        } else {
            $h[] = $this->H("❤️","Auto-compassion","Parlez-vous comme à un ami.","Quotidien","Bien-être","CRITIQUE");
            $h[] = $this->H("🛑","Arrêter l'autocritique","À chaque pensée négative sur vous : notez-la, puis écrivez 1 preuve du contraire.","Quotidien","Cognition","CRITIQUE");
$h[] = $this->H("👥","Environnement bienveillant","Réduisez le temps avec les personnes qui diminuent votre valeur. L'entourage façonne l'estime.","Immédiat","Lien social","CRITIQUE");
            $h[] = $this->H("🎯","Micro-succès quotidiens","1 objectif ultra-simple/jour.","Quotidien","Confiance","CRITIQUE");
            $h[] = $this->H("🏥","Thérapie ACT","Très efficace pour l'estime de soi effondrée.","Consultez","Suivi médical","CRITIQUE");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hIE(int $cl, array $f): array {
        $h = [];
        if ($cl==2) {
            $h[] = $this->H("🎓","CNV avancée","Communication Non Violente de Marshall Rosenberg.","Formation","Compétences","Fort");
            $h[] = $this->H("🎭","Jeu de rôle empathique","Imaginez-vous dans la situation d'une personne difficile. L'empathie cognitive se muscule.","Hebdomadaire","Empathie","Fort");
$h[] = $this->H("📚","Lectures IE avancées","«Emotional Agility» de Susan David ou «The Empathy Effect». Approfondissez votre maîtrise.","Mensuel","Formation","Maintien");
            $h[] = $this->H("🤝","Médiateur","Utilisez votre IE pour résoudre des conflits autour de vous.","Selon opportunités","Impact social","Fort");
        } elseif ($cl==1) {
            $h[] = $this->H("📓","Journal émotionnel","Soir : quelle émotion ? Pourquoi ? Aurais-je pu réagir différemment ?","Quotidien (soir)","Auto-observation","Élevé");
            $h[] = $this->H("🗣️","Feedback bienveillant","Entraînez-vous à donner du feedback en sandwich : positif → amélioration → positif.","Hebdomadaire","Communication","Élevé");
$h[] = $this->H("🌬️","Pause avant réaction","Comptez jusqu'à 10 avant toute réponse émotionnelle. Crée un espace de choix conscient.","Quotidien","Régulation","Élevé");
            $h[] = $this->H("⏸️","Règle des 90 secondes","Attendez 90s avant d'agir sur une émotion.","À chaque réaction","Régulation","Élevé");
        } else {
            $h[] = $this->H("🔍","Nommer ses émotions","Chaque soir : nommez les 3 émotions principales.","Quotidien","Conscience","Élevé");
            $h[] = $this->H("🎯","Roue des émotions","Téléchargez la roue de Plutchik. Chaque soir, pointez l'émotion exacte ressentie aujourd'hui.","Quotidien","Conscience","Élevé");
$h[] = $this->H("🤝","Conversation profonde","1 conversation authentique/semaine : partagez une émotion réelle avec un proche de confiance.","Hebdomadaire","Lien social","Élevé");
            $h[] = $this->H("📚","Livre de base","Lisez «L'Intelligence Émotionnelle» de Daniel Goleman.","1 mois","Formation","Élevé");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hCognitif(int $cl, array $f): array {
        $h = [];
        if ($cl==2) {
            $h[] = $this->H("🌍","Langue étrangère","20 min/jour sur Duolingo ou Babbel. L'apprentissage d'une langue est l'exercice cognitif le plus complet.","Quotidien","Cerveau","Fort");
$h[] = $this->H("✍️","Écriture réflexive","Écrivez 1 page manuscrite/jour. L'écriture active la mémoire de travail et la pensée critique.","Quotidien","Cognition","Maintien");
            $h[] = $this->H("🧠","Projets complexes","Programmation, langue étrangère, instrument : 1h/jour.","Quotidien 1h","Cognition","Maintien");
        } elseif ($cl==1) {
            $h[] = $this->H("😴","Sommeil prioritaire","Le sommeil consolide la mémoire et améliore les fonctions exécutives.","Quotidien","Sommeil","Élevé");
            $h[] = $this->H("🧪","Test des situations","Expérimentez consciemment des comportements atypiques pour votre profil. Élargissez votre palette.","Hebdomadaire","Adaptabilité","Élevé");
$h[] = $this->H("🤝","Collaboration types opposés","Travaillez intentionnellement avec des personnes de type très différent du vôtre.","Hebdomadaire","Développement","Élevé");
            $h[] = $this->H("🧩","Entraînement cognitif","Sudoku, échecs, Lumosity : 15 min/jour.","Quotidien","Cerveau","Moyen");
        } else {
            $h[] = $this->H("🏥","Bilan neuropsychologique","Identifiez précisément les zones fragiles.","Consultez","Suivi médical","CRITIQUE");
            $h[] = $this->H("📖","Bases du MBTI","Lisez la description complète de votre type sur 16personalities.com. La connaissance de soi débute ici.","Cette semaine","Formation","Élevé");
$h[] = $this->H("🌱","Acceptation de votre type","Votre type n'est pas une limitation — c'est votre architecture naturelle. Apprenez à la valoriser.","Quotidien","Mindset","Élevé");
            $h[] = $this->H("🥗","Nutrition cérébrale","Oméga-3, magnésium, vitamine B12.","Quotidien","Nutrition","Élevé");
        }
        return $h;
    }

    /**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hMBTI(int $cl, array $f): array {
        $h = [];
        if ($cl==2) {
            $h[] = $this->H("🎯","Alignement carrière-type","Analysez si votre métier correspond à votre type MBTI. L'alignement multiplie l'engagement.","Ce trimestre","Carrière","Fort");
$h[] = $this->H("📓","Journal de type","Notez les situations où votre type naturel vous a aidé ou limité. La conscience de soi est infinie.","Hebdomadaire","Connaissance de soi","Maintien");
            $h[] = $this->H("🌟","Exploitez votre profil","Orientez vos choix de carrière selon vos forces naturelles.","Quotidien","Connaissance de soi","Maintien");
            $h[] = $this->H("🧠","Développez votre ombre","Travaillez la dimension opposée à votre type.","Hebdomadaire","Développement","Fort");
        } elseif ($cl==1) {
            $h[] = $this->H("🔍","Approfondissez votre profil","Observez dans quelles situations chaque dimension s'exprime.","Hebdomadaire","Conscience de soi","Élevé");
            $h[] = $this->H("🧪","Test des situations","Expérimentez consciemment des comportements atypiques pour votre profil. Élargissez votre palette.","Hebdomadaire","Adaptabilité","Élevé");
$h[] = $this->H("🤝","Collaboration types opposés","Travaillez intentionnellement avec des personnes de type très différent du vôtre.","Hebdomadaire","Développement","Élevé");
        } else {
            $h[] = $this->H("🧘","Flexibilité cognitive","Sortez de votre zone MBTI : 1 event social/semaine.","Hebdomadaire","Adaptabilité","Élevé");
            $h[] = $this->H("📖","Bases du MBTI","Lisez la description complète de votre type sur 16personalities.com. La connaissance de soi débute ici.","Cette semaine","Formation","Élevé");
$h[] = $this->H("🌱","Acceptation de votre type","Votre type n'est pas une limitation — c'est votre architecture naturelle. Apprenez à la valoriser.","Quotidien","Mindset","Élevé");
            $h[] = $this->H("🤝","Coach MBTI","Un coach certifié transforme votre connaissance en avantages.","Consultez","Développement","Élevé");
        }
        return $h;
    }
/**
 * @param array<int, float> $f
 * @return array<int, array<string, string>>
 */
    private function hGenerique(int $cl, array $f): array {
        $h = [];
        if ($cl==0) {
            $h[] = $this->H("🧘","Méditation quotidienne","10 min/matin pour réduire le stress.","Quotidien","Bien-être","Élevé");
            $h[] = $this->H("😴","Sommeil réparateur","8h minimum, même heure coucher/lever. Le sommeil est la base de toute récupération.","Quotidien","Sommeil","CRITIQUE");
$h[] = $this->H("💧","Hydratation","2L d'eau/jour. La déshydratation amplifie les symptômes de stress et de fatigue mentale.","Quotidien","Santé","Élevé");
$h[] = $this->H("👥","Contact social","1 interaction positive/jour. L'isolement aggrave tous les états psychologiques difficiles.","Quotidien","Lien social","CRITIQUE");
$h[] = $this->H("🌿","Air frais","15 min dehors/jour minimum. La lumière naturelle et l'air frais régulent l'humeur.","Quotidien","Bien-être","Élevé");
            $h[] = $this->H("🏥","Consultation","Parlez à un professionnel de santé mentale.","Consultez","Suivi médical","CRITIQUE");
        } elseif ($cl==1) {
            $h[] = $this->H("📓","Journaling","15 min/soir : pensées, émotions, apprentissages.","Quotidien","Réflexion","Moyen");
            $h[] = $this->H("😴","Hygiène du sommeil","Routine 30 min avant coucher : pas d'écrans, lecture légère, température fraîche.","Quotidien (soir)","Sommeil","Élevé");
$h[] = $this->H("🧘","Pleine conscience","5 min/jour de scan corporel : observez vos sensations sans les juger.","Quotidien","Bien-être","Moyen");
$h[] = $this->H("🥗","Alimentation équilibrée","Légumes, protéines, bons gras à chaque repas. L'intestin est le deuxième cerveau.","Quotidien","Nutrition","Élevé");
$h[] = $this->H("🤝","Connexion sociale","1 repas ou activité avec un proche/semaine. Les relations sont le facteur n°1 de bien-être.","Hebdomadaire","Lien social","Élevé");
            $h[] = $this->H("🏃","Sport régulier","30 min 4x/semaine.","4x / semaine","Sport","Élevé");
        } else {
            $h[] = $this->H("🎯","Objectifs ambitieux","Des défis à la hauteur de votre potentiel.","Trimestriel","Performance","Maintien");
            $h[] = $this->H("📚","Apprentissage continu","30 min/jour : podcast, livre, formation. Maintenez votre cerveau en mode croissance.","Quotidien","Formation","Fort");
$h[] = $this->H("🌍","Impact communautaire","Bénévolat ou engagement local 1x/mois. Contribuer au collectif renforce le sens et le bien-être.","Mensuel","Impact social","Fort");
$h[] = $this->H("📊","Bilan mensuel","Évaluez chaque mois : énergie, relations, travail, santé sur 10. Pilotez votre vie avec des données.","Mensuel","Auto-monitoring","Maintien");
$h[] = $this->H("💪","Défi personnel","1 défi significatif par trimestre hors de votre zone de confort. La croissance exige l'inconfort.","Trimestriel","Défi","Fort");
            $h[] = $this->H("🤝","Transmission","Partagez vos stratégies avec ceux qui en ont besoin.","Hebdomadaire","Impact social","Fort");
        }
        return $h;
    }

    private function planSemaine(int $cl, bool $positif): string {
        if ($cl==2 && $positif) return "📅 PLAN DE PERFORMANCE\nLun : Défi cognitif ou compétence avancée (1h)\nMar : Mentorat ou partage de connaissance\nMer : Sport intense + suivi indicateurs personnels\nJeu : Projet ambitieux + réflexion stratégique\nVen : Bilan semaine + ajustement objectifs\nSam : Apprentissage libre + activité créative\nDim : Planification OKR semaine suivante\n🚀 Maintenez vos forces et partagez-les !";
        if ($cl==2) return "📅 PLAN DE MAINTIEN\nLun : Activité bien-être (sport, nature, méditation)\nMar : Connexion sociale de qualité\nMer : Activité créative ou apprentissage\nJeu : Routines de prévention (sommeil, nutrition)\nVen : Bilan émotionnel de la semaine\nSam : Temps pour soi, activité plaisir\nDim : Préparation sereine de la semaine\n✅ Continuez ce qui fonctionne pour vous !";
        if ($cl==1) return "📅 PLAN D'AMÉLIORATION\nLun : Habitude principale n°1 (15 min)\nMar : Sport 30 min + habitude n°2\nMer : Connexion sociale + journal du soir\nJeu : Habitude n°1 + lecture/podcast\nVen : Sport + bilan semaine\nSam : Activité plaisir + habitude n°2\nDim : Repos actif + planification semaine\n💡 Attachez chaque habitude à une existante.";
        return "📅 PLAN DE DÉMARRAGE\nLun : 1 seule habitude, 5 minutes — pas plus\nMar : Répétez + ajoutez 1 min\nMer : Contact avec un proche de confiance\nJeu : Répétez votre habitude de base\nVen : Bilan : comment vous sentez-vous ?\nSam : Activité plaisir simple, sans pression\nDim : Préparation + si besoin, RDV médical\n⚠️ Commencez micro. 2 min suffisent pour créer une habitude.";
    }

    /**
 * @param array<int, float> $f
 * @return array<int, string>
 */
    private function alertes(int $cl, array $f, bool $positif): array {
        $a = [];
        if ($cl==0) {
            if ($positif) {
                $a[] = "📈 Score faible — des progrès sont possibles avec de la pratique régulière.";
                $a[] = "🤝 Cherchez un mentor ou un modèle dans ce domaine.";
            } else {
                $a[] = "⚠️ Niveau de symptômes élevé — un suivi professionnel est fortement recommandé.";
                if ($f[4]<0.25) $a[] = "🚨 Isolement social détecté — contactez un proche de confiance cette semaine.";
                if ($f[1]>0.75) $a[] = "⚠️ Grande variabilité dans vos réponses — évaluation professionnelle conseillée.";
            }
        } elseif ($cl==1) {
            $a[] = "📌 Progression possible — des habitudes ciblées feront la différence.";
            if ($f[6]<0.4) $a[] = "🔄 Manque de régularité — la constance est la clé du changement durable.";
        } else {
            if ($positif) $a[] = "🌟 Excellent profil — partagez vos stratégies avec votre entourage.";
            else $a[] = "✅ Peu de symptômes — maintenez vos bonnes pratiques actuelles.";
            if ($f[3]>0.5) $a[] = "💤 Légère fatigue détectée en fin de test — veillez à votre récupération.";
        }
        return $a;
    }
}