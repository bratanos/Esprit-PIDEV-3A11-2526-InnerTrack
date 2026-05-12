<?php

namespace App\Service;

use App\Entity\Article;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AiInsightService
{
    // Endpoint URL for the Python AI microservice that analyzes text
    public function __construct(
        private HttpClientInterface $client,
        #[Autowire(env: 'ARTICLE_AI_URL')] private string $apiUrl
    ) {}

    /**
     * Sends article content to the AI service for analysis
     * Returns emotions and key points extracted from the article, or null if the service is unavailable
     */
    /** @return array<string, mixed>|null */
public function analyze(Article $article): ?array
    {
        $text = $article->getTitre() . '. ' . $article->getContenu();

        try {
            $response = $this->client->request('POST', $this->apiUrl . '/analyze', [
                'json'    => ['text' => $text],
                'timeout' => 10,
            ]);

            if ($response->getStatusCode() === 200) {
                return $response->toArray(false);
                // returns: ['emotions' => [...], 'key_points' => [...]]
            }
        } catch (\Throwable) {
            // Python service not running — fail silently
        }

        return null;
    }

    /**
     * Health check utility that verifies if the Python AI service is running and responsive
     */
    public function isAvailable(): bool
    {
        try {
            $r = $this->client->request('GET', $this->apiUrl . '/health', ['timeout' => 1]);
            return $r->getStatusCode() === 200;
        } catch (\Throwable) {
            return false;
        }
    }
}