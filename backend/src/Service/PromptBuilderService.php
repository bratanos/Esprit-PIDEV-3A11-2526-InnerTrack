<?php

namespace App\Service;

class PromptBuilderService
{
    public function buildEventCopilotPrompt(string $idea): string
    {
        return <<<PROMPT
You are an expert event organizer specialized in mental health, wellness, and professional development.

Generate a structured event from this idea: "$idea"

Return ONLY valid JSON — no markdown fences, no explanation, exactly this format:
{
  "titre": "",
  "description": "",
  "type": 1,
  "capacite": 50
}

Rules:
- "titre": short, catchy French title (max 255 characters)
- "description": engaging French description, 3-4 sentences
- "type": integer — 1=Conférence, 2=Atelier, 3=Forum, 4=Webinaire (pick the most fitting one)
- "capacite": suggested number of attendees as a positive integer

Return JSON only. Absolutely no markdown.
PROMPT;
    }

    public function buildMetaPrompt(string $idea): string
    {
        return <<<PROMPT
You are an event organizer. For this idea: "$idea"

Return ONLY this JSON (no markdown, no extra text):
{"titre":"","type":1,"capacite":50}

- titre: catchy French title, max 255 chars
- type: 1=Conférence, 2=Atelier, 3=Forum, 4=Webinaire (pick the best fit)
- capacite: realistic positive integer
PROMPT;
    }

    public function buildDescriptionStreamPrompt(string $idea): string
    {
        return <<<PROMPT
You are an event organizer. Write a 3–4 sentence engaging French description for this event: "$idea"

Return ONLY the description text. No title, no JSON, no bullet points, no formatting.
PROMPT;
    }

    public function buildRegenerateFieldPrompt(string $field, string $idea, string $currentValue): string
    {
        $instructions = match ($field) {
            'titre'       => 'Write a new short, catchy French event title (max 255 characters). Return ONLY the title text — no quotes, no explanation.',
            'description' => 'Write a new engaging French event description (3–4 sentences). Return ONLY the description text.',
            default       => "Regenerate the \"$field\" field in French. Return only the value.",
        };

        return <<<PROMPT
You are an expert event organizer.

Event idea: "$idea"
Current "$field" value: "$currentValue"

$instructions
PROMPT;
    }
}
