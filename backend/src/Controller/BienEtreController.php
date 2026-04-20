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

        $statsHabitude = $this->habitudeRepo->getStatsByUserId($user->getId());
        $statsEntree   = $this->entreeRepo->getStatsByUserId($user->getId());

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

        $statsHabitude = $this->habitudeRepo->getStatsByUserId($user->getId());
        $statsEntree   = $this->entreeRepo->getStatsByUserId($user->getId());

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

private function callGroq(string $prompt): array
{
    $apiKey = $_ENV['GROQ_API_KEY'] ?? '';

    if (empty($apiKey)) {
        return ['debug' => 'GROQ API KEY MANQUANTE'];
    }

    $ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
        ],
        CURLOPT_POSTFIELDS => json_encode([
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
        ]),
    ]);

    $result    = curl_exec($ch);
    $curlError = curl_error($ch);
    curl_close($ch);

    $data = json_decode($result, true);

    if (!$data) {
        return ['debug' => 'curl_error: ' . $curlError];
    }

    if (isset($data['error'])) {
        return ['debug' => 'API error: ' . $data['error']['message']];
    }

    $text    = $data['choices'][0]['message']['content'] ?? '{}';
    $parsed  = json_decode(trim($text), true);

    if (!$parsed) {
        return ['debug' => 'JSON parse failed', 'raw_text' => $text];
    }

    return $parsed;
}
}