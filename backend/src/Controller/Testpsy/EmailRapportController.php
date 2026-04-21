<?php

namespace App\Controller\Testpsy;

use App\Entity\Testpsy\Resultat;
use App\Service\BrevoEmailService;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Contrôleur indépendant chargé uniquement de l'envoi du rapport
 * de résultats par email (via Brevo REST API).
 */
#[Route('/testpsy/email', name: 'testpsy_email_')]
class EmailRapportController extends AbstractController
{
    public function __construct(
        private readonly BrevoEmailService $emailService,
        private readonly Connection        $connection,
    ) {}

    /**
     * POST /testpsy/email/rapport/{idResultat}
     *
     * Envoie le rapport à l'adresse email de l'utilisateur connecté (depuis la BDD).
     * Aucun corps de requête n'est attendu.
     */
    #[Route('/rapport/{idResultat}', name: 'rapport', methods: ['POST'])]
    public function envoyerRapport(
        int     $idResultat,
        Request $request,
    ): JsonResponse {
        // ── Sécurité : utilisateur connecté obligatoire ──────────────────
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['success' => false, 'message' => 'Non authentifié.'], Response::HTTP_UNAUTHORIZED);
        }

        // ── Charger le résultat depuis la base ───────────────────────────
        $row = $this->connection->fetchAssociative(
            'SELECT r.*, t.titre AS titre_test
               FROM resultat r
               JOIN test_psychologique t ON r.id_test = t.id_test
              WHERE r.id_resultat = :id',
            ['id' => $idResultat]
        );

        if (!$row) {
            return $this->json(['success' => false, 'message' => 'Résultat introuvable.'], Response::HTTP_NOT_FOUND);
        }

        // ── Vérifier que ce résultat appartient bien à l'utilisateur ─────
        if ((int) $row['id_utilisateur'] !== $user->getId()) {
            return $this->json(['success' => false, 'message' => 'Accès refusé.'], Response::HTTP_FORBIDDEN);
        }

        // ── Reconstruire l'objet Resultat ────────────────────────────────
        $resultat = new Resultat();
        $resultat->setIdTest((int) $row['id_test'])
                 ->setIdUtilisateur((int) $row['id_utilisateur'])
                 ->setScoreTotal((int) $row['score_total'])
                 ->setScoreMaxPossible((int) $row['score_max_possible'])
                 ->setPourcentage((float) $row['pourcentage'])
                 ->setResultat($row['resultat'])
                 ->setInterpretation($row['interpretation']);

        $titreTest = $row['titre_test'] ?? 'Test psychologique';

        // ── Générer la recommandation IA via le PredectionController ─────
        $predController = new PredectionController($this->connection);
        $refMethod = new \ReflectionMethod(PredectionController::class, 'genererPrediction');
        $refMethod->setAccessible(true);
        $rec = $refMethod->invoke($predController, $resultat);

        // ── Email et prénom depuis la BDD (via l'utilisateur connecté) ───
        $emailDestinataire = $user->getEmail();
        $prenom = $user->getFirstName() ?? $user->getFullName();
        if (empty(trim($prenom))) {
            $prenom = $emailDestinataire;
        }

        // ── Envoi ────────────────────────────────────────────────────────
        try {
            $this->emailService->envoyerRapport($emailDestinataire, $prenom, $resultat, $rec, $titreTest);
        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi : ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->json([
            'success' => true,
            'message' => 'Rapport envoyé à ' . $emailDestinataire,
        ]);
    }
}
