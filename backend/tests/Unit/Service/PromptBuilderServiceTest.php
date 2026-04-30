<?php

namespace App\Tests\Unit\Service;

use App\Service\PromptBuilderService;
use PHPUnit\Framework\TestCase;

class PromptBuilderServiceTest extends TestCase
{
    private PromptBuilderService $service;

    protected function setUp(): void
    {
        $this->service = new PromptBuilderService();
    }

    public function testBuildEventCopilotPromptContainsIdea(): void
    {
        $prompt = $this->service->buildEventCopilotPrompt('atelier yoga mental');
        $this->assertStringContainsString('atelier yoga mental', $prompt);
    }

    public function testBuildEventCopilotPromptContainsAllJsonFields(): void
    {
        $prompt = $this->service->buildEventCopilotPrompt('yoga');
        $this->assertStringContainsString('"titre"', $prompt);
        $this->assertStringContainsString('"description"', $prompt);
        $this->assertStringContainsString('"type"', $prompt);
        $this->assertStringContainsString('"capacite"', $prompt);
    }

    public function testBuildEventCopilotPromptInstructsJsonOnly(): void
    {
        $prompt = $this->service->buildEventCopilotPrompt('test');
        $this->assertStringContainsString('Return ONLY valid JSON', $prompt);
        $this->assertStringContainsString('no markdown', $prompt);
    }

    public function testBuildEventCopilotPromptDefinesTypeValues(): void
    {
        $prompt = $this->service->buildEventCopilotPrompt('test');
        $this->assertStringContainsString('1=Conférence', $prompt);
        $this->assertStringContainsString('2=Atelier', $prompt);
        $this->assertStringContainsString('3=Forum', $prompt);
        $this->assertStringContainsString('4=Webinaire', $prompt);
    }

    public function testBuildMetaPromptContainsIdea(): void
    {
        $prompt = $this->service->buildMetaPrompt('conférence stress professionnel');
        $this->assertStringContainsString('conférence stress professionnel', $prompt);
    }

    public function testBuildMetaPromptHasCompactJsonTemplate(): void
    {
        $prompt = $this->service->buildMetaPrompt('test');
        $this->assertStringContainsString('"titre"', $prompt);
        $this->assertStringContainsString('"type"', $prompt);
        $this->assertStringContainsString('"capacite"', $prompt);
        $this->assertStringNotContainsString('"description"', $prompt);
    }

    public function testBuildDescriptionStreamPromptContainsIdea(): void
    {
        $prompt = $this->service->buildDescriptionStreamPrompt('forum santé mentale');
        $this->assertStringContainsString('forum santé mentale', $prompt);
    }

    public function testBuildDescriptionStreamPromptForbidsJson(): void
    {
        $prompt = $this->service->buildDescriptionStreamPrompt('test');
        $this->assertStringContainsString('no JSON', $prompt);
    }

    public function testBuildDescriptionStreamPromptRequestsFrenchText(): void
    {
        $prompt = $this->service->buildDescriptionStreamPrompt('test');
        $this->assertStringContainsString('French', $prompt);
    }

    public function testBuildRegenerateFieldPromptWithTitreContainsCharacterLimit(): void
    {
        $prompt = $this->service->buildRegenerateFieldPrompt('titre', 'yoga event', 'Old title');
        $this->assertStringContainsString('255 characters', $prompt);
        $this->assertStringContainsString('yoga event', $prompt);
        $this->assertStringContainsString('Old title', $prompt);
    }

    public function testBuildRegenerateFieldPromptWithDescriptionRequiresSentences(): void
    {
        $prompt = $this->service->buildRegenerateFieldPrompt('description', 'yoga event', 'Old desc');
        $this->assertStringContainsString('3–4 sentences', $prompt);
        $this->assertStringContainsString('yoga event', $prompt);
        $this->assertStringContainsString('Old desc', $prompt);
    }

    public function testBuildRegenerateFieldPromptWithUnknownFieldUsesGenericInstruction(): void
    {
        $prompt = $this->service->buildRegenerateFieldPrompt('capacite', 'yoga event', '50');
        $this->assertStringContainsString('capacite', $prompt);
        $this->assertStringContainsString('yoga event', $prompt);
        $this->assertStringContainsString('50', $prompt);
        $this->assertStringContainsString('Regenerate', $prompt);
    }

    public function testBuildRegenerateFieldPromptIncludesCurrentValue(): void
    {
        $currentValue = 'Current value for testing';
        $prompt = $this->service->buildRegenerateFieldPrompt('titre', 'some idea', $currentValue);
        $this->assertStringContainsString($currentValue, $prompt);
    }
}
