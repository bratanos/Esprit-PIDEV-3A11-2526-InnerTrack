<?php

namespace App\Service;

class AiEventCopilotService
{
    public function __construct(
        private PromptBuilderService $promptBuilder,
        private OpenAiClientService  $client,
    ) {}

    /** @return array<string, mixed> */
    public function generateEvent(string $idea): array
    {
        $prompt  = $this->promptBuilder->buildEventCopilotPrompt($idea);
        $raw     = $this->client->chat($prompt, maxTokens: 1200, temperature: 0.75);
        $cleaned = $this->stripMarkdownFences($raw);
        $data    = json_decode($cleaned, true);

        if (!is_array($data)) {
            throw new \RuntimeException('AI returned invalid JSON.');
        }

        return $data;
    }

    /**
     * Yields SSE-ready events: meta → chunks → done.
     *
     * @return \Generator<int, array<string, mixed>, mixed, void>
     */
    public function streamEvent(string $idea): \Generator
    {
        // Quick non-streaming call for titre / type / capacite
        $raw  = $this->client->chat($this->promptBuilder->buildMetaPrompt($idea), 150, 0.7);
        $meta = json_decode($this->stripMarkdownFences($raw), true) ?? [];
        yield ['type' => 'meta', 'data' => $meta];

        // Stream the description word by word
        foreach ($this->client->chatStream($this->promptBuilder->buildDescriptionStreamPrompt($idea), 400, 0.75) as $chunk) {
            yield ['type' => 'chunk', 'text' => $chunk];
        }

        yield ['type' => 'done'];
    }

    public function regenerateField(string $field, string $idea, string $currentValue): string
    {
        $prompt = $this->promptBuilder->buildRegenerateFieldPrompt($field, $idea, $currentValue);

        return trim($this->client->chat($prompt, maxTokens: 400, temperature: 0.85));
    }

    private function stripMarkdownFences(string $text): string
    {
        return (string) preg_replace('/^```(?:json)?\s*|\s*```$/m', '', trim($text));
    }
}
