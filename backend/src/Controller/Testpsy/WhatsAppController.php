<?php

namespace App\Controller\Testpsy;

use App\Entity\Testpsy\Resultat;
use App\Service\TwilioService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/testpsy/whatsapp', name: 'testpsy_whatsapp_')]
class WhatsAppController extends AbstractController
{
    public function __construct(
        private readonly TwilioService         $twilioService,
        private readonly EntityManagerInterface $em,
    ) {}

    /**
     * POST /testpsy/whatsapp/resultat/{idResultat}
     * Envoie les résultats du test sur WhatsApp via Twilio
     */
    #[Route('/resultat/{idResultat}', name: 'resultat', methods: ['POST'])]
    public function envoyerResultat(int $idResultat): JsonResponse
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['success' => false, 'message' => 'Non authentifié.'], Response::HTTP_UNAUTHORIZED);
        }

        // Charger le résultat
        $resultat = $this->em->getRepository(Resultat::class)->find($idResultat);
        if (!$resultat) {
            return $this->json(['success' => false, 'message' => 'Résultat introuvable.'], Response::HTTP_NOT_FOUND);
        }

        // Vérifier appartenance
        if ($resultat->getIdUtilisateur() !== $user->getId()) {
            return $this->json(['success' => false, 'message' => 'Accès refusé.'], Response::HTTP_FORBIDDEN);
        }

        // Récupérer le numéro depuis la BD
        $numero = $user->getPhoneNumber();
        if (empty($numero)) {
            return $this->json([
                'success' => false,
                'message' => 'Aucun numéro de téléphone enregistré dans votre profil.',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Récupérer le titre du test
        $titreTest = $this->em->getConnection()->fetchOne(
            'SELECT titre FROM test_psychologique WHERE id_test = :id',
            ['id' => $resultat->getIdTest()]
        ) ?: 'Test psychologique';

        $prenom = trim($user->getFirstName() . ' ' . $user->getLastName());
        if (empty($prenom)) {
            $prenom = $user->getEmail();
        }

        try {
            $this->twilioService->envoyerResultatTest(
                $numero,
                $prenom,
                $titreTest,
                $resultat->getScoreTotal(),
                $resultat->getScoreMaxPossible(),
                $resultat->getResultat()
            );

            return $this->json([
                'success' => true,
                'message' => 'Résultats envoyés sur WhatsApp au ' . $numero,
            ]);

        } catch (\Throwable $e) {
            return $this->json([
                'success' => false,
                'message' => 'Erreur Twilio : ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}