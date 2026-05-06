<?php

namespace App\Service;

use App\Entity\Article;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AiInsightService
{
    // Endpoint URL for the Python AI microservice that analyzes text
    private const API_URL = 'http://127.0.0.1:5001';

    // HTTP client utility for making requests to the AI service
    public function __construct(private HttpClientInterface $client) {}

    /**
     * Sends article content to the AI service for analysis
     * Returns emotions and key points extracted from the article, or null if the service is unavailable
     */
    /** @return array<string, mixed>|null */
public function analyze(Article $article): ?array
    {
        $text = $article->getTitre() . '. ' . $article->getContenu();

        try {
            $response = $this->client->request('POST', self::API_URL . '/analyze', [
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
            $r = $this->client->request('GET', self::API_URL . '/health', ['timeout' => 1]);
            return $r->getStatusCode() === 200;
        } catch (\Throwable) {
            return false;
        }
    }
}