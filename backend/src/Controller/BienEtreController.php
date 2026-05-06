<?php

namespace App\Controller;

use App\Repository\Journal\HabitudeRepository;
use App\Repository\Journal\EntreeJournalRepository;
use App\Service\BienEtreAnalyzer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

#[Route('/bienetre', name: 'bienetre_')]
class BienEtreController extends AbstractController
{
    public function __construct(
        private HabitudeRepository      $habitudeRepo,
        private EntreeJournalRepository $entreeRepo,
        private BienEtreAnalyzer        $analyzer,
        private Security                $security
    ) {}

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        /** @var User $user */
        $userId        = (int) $user->getId();
        $statsHabitude = $this->habitudeRepo->getStatsByUserId($userId);
        $statsEntree   = $this->entreeRepo->getStatsByUserId($userId);

        $avgEnergie  = (float)($statsHabitude['avgEnergie'] ?? 5);
        $avgStress   = (float)($statsHabitude['avgStress']  ?? 5);
        $avgSommeil  = (float)($statsHabitude['avgSommeil'] ?? 5);
        $avgHumeur   = (float)($statsEntree['avgHumeur']    ?? 5);
        $nbHabitudes = (int)($statsHabitude['total']        ?? 0);
        $nbEntrees   = (int)($statsEntree['total']          ?? 0);

        $score   = $this->analyzer->calculerScore($avgEnergie, $avgStress, $avgSommeil, $avgHumeur);
        $niveau  = $this->analyzer->getNiveau($score);
        $couleur = $this->analyzer->getCouleur($score);
        $emoji   = $this->analyzer->getEmoji($score);

        return $this->render('bienetre/dashboard.html.twig', [
            'score'       => $score,
            'niveau'      => $niveau,
            'couleur'     => $couleur,
            'emoji'       => $emoji,
            'avgEnergie'  => round($avgEnergie, 1),
            'avgStress'   => round($avgStress, 1),
            'avgSommeil'  => round($avgSommeil, 1),
            'avgHumeur'   => round($avgHumeur, 1),
            'nbHabitudes' => $nbHabitudes,
            'nbEntrees'   => $nbEntrees,
        ]);
    }

    #[Route('/analyser', name: 'analyser', methods: ['POST'])]
    public function analyser(Request $request): JsonResponse
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        /** @var User $user */
        $userId        = (int) $user->getId();
        $statsHabitude = $this->habitudeRepo->getStatsByUserId($userId);
        $statsEntree   = $this->entreeRepo->getStatsByUserId($userId);

        $avgEnergie  = (float)($statsHabitude['avgEnergie'] ?? 5);
        $avgStress   = (float)($statsHabitude['avgStress']  ?? 5);
        $avgSommeil  = (float)($statsHabitude['avgSommeil'] ?? 5);
        $avgHumeur   = (float)($statsEntree['avgHumeur']    ?? 5);
        $nbHabitudes = (int)($statsHabitude['total']        ?? 0);
        $nbEntrees   = (int)($statsEntree['total']          ?? 0);

        $score  = $this->analyzer->calculerScore($avgEnergie, $avgStress, $avgSommeil, $avgHumeur);
        $prompt = $this->analyzer->buildPrompt(
            $score, $avgEnergie, $avgStress, $avgSommeil, $avgHumeur, $nbHabitudes, $nbEntrees
        );

        $response = $this->callGroq($prompt);

        return new JsonResponse($response);
    }

    /**
     * @return array<string, mixed>
     */
    private function callGroq(string $prompt): array
    {
        $apiKey = $_ENV['GROQ_API_KEY'] ?? '';

        if (empty($apiKey)) {
            return ['debug' => 'GROQ API KEY MANQUANTE'];
        }

        $postData = json_encode([
            'model'    => 'llama-3.3-70b-versatile',
            'messages' => [
                [
                    'role'    => 'system',
                    'content' => 'Tu réponds UNIQUEMENT en JSON valide, sans texte avant ou après, sans balises markdown.'
                ],
                [
                    'role'    => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens'      => 1000,
            'temperature'     => 0.7,
            'response_format' => ['type' => 'json_object'],
        ]);

        if ($postData === false) {
            return ['debug' => 'json_encode failed'];
        }

        $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ],
            CURLOPT_POSTFIELDS     => $postData,
        ]);

        $result = curl_exec($ch);
        if (!is_string($result)) {
            curl_close($ch);
            return ['debug' => 'curl did not return a string'];
        }
        $data = json_decode($result, true);

        if (!is_array($data)) {
            return ['debug' => 'invalid json from API'];
        }

        if (isset($data['error'])) {
            return ['debug' => 'API error: ' . $data['error']['message']];
        }

        $text = $data['choices'][0]['message']['content'] ?? '{}';

        $parsed = json_decode(trim($text), true);

        if (!is_array($parsed)) {
            return [
                'debug'    => 'JSON parse failed',
                'raw_text' => $text
            ];
        }

        return $parsed;
    }
}