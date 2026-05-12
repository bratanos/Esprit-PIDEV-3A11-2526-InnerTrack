<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenAiClientService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        #[Autowire(env: 'default::OPENAI_API_KEY')]  private string $apiKey = '',
        #[Autowire(env: 'default::OPENAI_BASE_URL')] private string $baseUrl = 'https://api.openai.com/v1',
        #[Autowire(env: 'default::OPENAI_MODEL')]    private string $model = 'gpt-3.5-turbo',
        #[Autowire(env: 'default::REFERER_URL')]     private string $refererUrl = '',
    ) {}

    public function chat(string $prompt, int $maxTokens = 1000, float $temperature = 0.7): string
    {
        if (empty($this->apiKey)) {
            return '{"error": "AI configuration missing. Please set OPENAI_API_KEY."}';
        }

        try {
            $response = $this->httpClient->request('POST', rtrim($this->baseUrl, '/') . '/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type'  => 'application/json',
                    'HTTP-Referer'  => $this->refererUrl,
                    'X-Title'       => 'InnerTrack AI Copilot',
                ],
                'json' => [
                    'model'       => $this->model,
                    'messages'    => [['role' => 'user', 'content' => $prompt]],
                    'max_tokens'  => $maxTokens,
                    'temperature' => $temperature,
                ],
            ]);

            $data = $response->toArray();
            return $data['choices'][0]['message']['content'] ?? '';
        } catch (\Throwable $e) {
            return '{"error": "' . $e->getMessage() . '"}';
        }
    }

    /**
     * Streams response chunks from the API as a generator.
     *
     * @return \Generator<string>
     */
    public function chatStream(string $prompt, int $maxTokens = 500, float $temperature = 0.7): \Generator
    {
        $response = $this->httpClient->request('POST', rtrim($this->baseUrl, '/') . '/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
                'HTTP-Referer'  => $this->refererUrl,
                'X-Title'       => 'InnerTrack AI Copilot',
            ],
            'json' => [
                'model'       => $this->model,
                'messages'    => [['role' => 'user', 'content' => $prompt]],
                'max_tokens'  => $maxTokens,
                'temperature' => $temperature,
                'stream'      => true,
            ],
            'buffer' => false,
        ]);

        $buffer = '';
        foreach ($this->httpClient->stream($response) as $chunk) {
            if ($chunk->isLast()) {
                break;
            }

            $buffer .= $chunk->getContent();

            while (($pos = strpos($buffer, "\n")) !== false) {
                $line   = trim(substr($buffer, 0, $pos));
                $buffer = substr($buffer, $pos + 1);

                if (!str_starts_with($line, 'data: ')) {
                    continue;
                }

                $data = substr($line, 6);
                if ($data === '[DONE]') {
                    return;
                }

                $json = json_decode($data, true);
                $text = $json['choices'][0]['delta']['content'] ?? '';
                if ($text !== '') {
                    yield $text;
                }
            }
        }
    }
}
