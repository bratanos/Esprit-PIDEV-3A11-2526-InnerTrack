<?php

namespace App\Service;
use App\Entity\Article;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class OpenLibraryService
{
        private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
     /** @return array<int, array<string, mixed>> */
    public function searchBooks(string $query, int $limit = 3): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://openlibrary.org/search.json', [
                'query' => [
                    'q'      => $query,
                    'fields' => 'title,author_name,cover_i,key,first_publish_year',
                    'limit'  => $limit,
                ],
                'timeout' => 5,
            ]);
            $data  = $response->toArray();
            $books = [];
            foreach ($data['docs'] ?? [] as $doc) {
                $books[] = [
                    'title'  => $doc['title'] ?? 'Unknown',
                    'author' => $doc['author_name'][0] ?? 'Unknown author',
                    'year'   => $doc['first_publish_year'] ?? null,
                    'cover'  => isset($doc['cover_i'])
                        ? "https://covers.openlibrary.org/b/id/{$doc['cover_i']}-M.jpg"
                        : null,
                    'url'    => 'https://openlibrary.org' . ($doc['key'] ?? ''),
                ];
            }
            return $books;
        } catch (\Throwable $e) {
            return [];
        }
    }
}