<?php

namespace App\Service;

use App\Entity\Article;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FreeSoundService
{
    // More detailed mood-to-sound mapping for psychology topics
    private const MOOD_MAP = [
        // Anxiety / Stress
        'anxiety'     => 'calm meditation',
        'anxious'     => 'relaxing nature',
        'stress'      => 'peaceful piano',
        'burnout'     => 'soft ambient',
        
        // Depression / Sadness
        'depression'  => 'hopeful piano',
        'sadness'     => 'emotional ambient',
        'grief'       => 'melancholic strings',
        
        // Mindfulness / Meditation
        'mindfulness' => 'meditation bowl',
        'meditation'  => 'zen music',
        'relaxation'  => 'spa ambient',
        
        // Sleep / Insomnia
        'sleep'       => 'sleep sounds rain',
        'insomnia'    => 'white noise',
        
        // Focus / Cognitive
        'focus'       => 'study music',
        'concentration'=> 'binaural beats',
        'cognitive'   => 'lo-fi hip hop',
        
        // Self-care / Positivity
        'self-care'   => 'uplifting acoustic',
        'wellbeing'   => 'nature sounds',
        'gratitude'   => 'cheerful piano',
        
        // Relationships / Trauma
        'relationships'=> 'soft guitar',
        'trauma'      => 'healing ambient',
        'therapy'     => 'calm cello',
    ];

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey
    ) {}
    /** @return array<string, mixed>|null */
    public function findAmbientSound(Article $article): ?array
    {
        // 1. Collect all tag names from the article
        $tagNames = [];
        foreach ($article->getTags() as $tag) {
        $nom = $tag->getNom();
        if ($nom !== null) 
            {
            $tagNames[] = mb_strtolower($nom);
        }
    }

        // 2. If no tags, fallback to category or default
        if (empty($tagNames)) {
            $category = $article->getCategorie()?->getNom();
            if ($category) {
                $tagNames[] = mb_strtolower($category);
            } else {
                $tagNames[] = 'psychology';
            }
        }

        // 3. Build a search query: combine tags with "OR" and add "ambient/music"
        // Example: "anxiety OR stress OR relaxation ambient music"
        $query = implode(' OR ', $tagNames) . ' ambient music';

        // 4. Optional: add a mood mapping for better results
        // You can keep your MOOD_MAP to transform specific tags
        $mappedTerms = [];
        foreach ($tagNames as $tag) {
            if (isset(self::MOOD_MAP[$tag])) {
                $mappedTerms[] = self::MOOD_MAP[$tag];
            }
        }
        if (!empty($mappedTerms)) {
            $query = implode(' OR ', $mappedTerms) . ' ambient music';
        }

        // 5. Call Freesound API with this query
        try {
            $response = $this->httpClient->request('GET', 'https://freesound.org/apiv2/search/text/', [
                'query' => [
                    'query' => $query,
                    'filter' => 'tag:music AND duration:[20 TO 600]',
                    'page_size' => 5,
                    'fields' => 'name,previews,duration,downloads,num_scores',
                    'sort' => 'score',
                ],
                'headers' => ['Authorization' => 'Token ' . $this->apiKey],
                'timeout' => 10,
            ]);

            $data = $response->toArray();
            if (empty($data['results'])) {
                return $this->fallbackSound();
            }

            // Pick the best result (highest downloads + scores)
            usort($data['results'], function ($a, $b) {
                return ($b['downloads'] ?? 0) - ($a['downloads'] ?? 0);
            });
            $best = $data['results'][0];
            $preview = $best['previews']['preview-hq-mp3'] ?? $best['previews']['preview-lq-mp3'] ?? null;
            if (!$preview) return null;

            return [
                'title'    => $best['name'],
                'audio'    => $preview,
                'duration' => $best['duration'] ?? 0,
            ];
        } catch (\Throwable $e) {
            return $this->fallbackSound();
        }
    }

    /** @return array<string, mixed> */
    private function fallbackSound(): array
    {
        return [
            'title'    => 'Calm Study Music',
            'audio'    => 'https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3',
            'duration' => 120,
        ];
    }
}