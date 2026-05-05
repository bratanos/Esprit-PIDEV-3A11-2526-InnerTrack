<?php

namespace App\Tests\Unit\Service;

use App\Service\AiEventCopilotService;
use App\Service\OpenAiClientService;
use App\Service\PromptBuilderService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AiEventCopilotServiceTest extends TestCase
{
    private AiEventCopilotService $service;
    private PromptBuilderService $promptBuilder;
    private OpenAiClientService&MockObject $mockClient;

    protected function setUp(): void
    {
        $this->promptBuilder = new PromptBuilderService();
        $this->mockClient    = $this->createMock(OpenAiClientService::class);
        $this->service       = new AiEventCopilotService($this->promptBuilder, $this->mockClient);
    }

    public function testGenerateEventParsesValidJsonResponse(): void
    {
        $json = '{"titre":"Atelier Yoga","description":"Un super événement","type":2,"capacite":30}';
        $this->mockClient->method('chat')->willReturn($json);

        $result = $this->service->generateEvent('yoga');

        $this->assertIsArray($result);
        $this->assertSame('Atelier Yoga', $result['titre']);
        $this->assertSame(30, $result['capacite']);
        $this->assertSame(2, $result['type']);
    }

    public function testGenerateEventStripsJsonMarkdownFences(): void
    {
        $json = "```json\n{\"titre\":\"Conférence\",\"description\":\"Desc\",\"type\":1,\"capacite\":50}\n```";
        $this->mockClient->method('chat')->willReturn($json);

        $result = $this->service->generateEvent('conférence');

        $this->assertIsArray($result);
        $this->assertSame('Conférence', $result['titre']);
    }

    public function testGenerateEventStripsPlainMarkdownFences(): void
    {
        $json = "```\n{\"titre\":\"Forum\",\"type\":3,\"capacite\":100}\n```";
        $this->mockClient->method('chat')->willReturn($json);

        $result = $this->service->generateEvent('forum');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('titre', $result);
    }

    public function testGenerateEventThrowsRuntimeExceptionOnInvalidJson(): void
    {
        $this->mockClient->method('chat')->willReturn('This is not JSON at all.');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('AI returned invalid JSON.');

        $this->service->generateEvent('bad response');
    }

    public function testGenerateEventThrowsOnEmptyResponse(): void
    {
        $this->mockClient->method('chat')->willReturn('');

        $this->expectException(\RuntimeException::class);

        $this->service->generateEvent('empty');
    }

    public function testRegenerateFieldReturnsTrimmedResult(): void
    {
        $this->mockClient->method('chat')->willReturn("  Nouveau titre pour yoga  \n");

        $result = $this->service->regenerateField('titre', 'yoga', 'Old title');

        $this->assertSame('Nouveau titre pour yoga', $result);
    }

    public function testRegenerateFieldCallsClientWithCorrectArguments(): void
    {
        $this->mockClient
            ->expects($this->once())
            ->method('chat')
            ->with(
                $this->stringContains('yoga'),
                $this->equalTo(400),
                $this->equalTo(0.85)
            )
            ->willReturn('New title');

        $this->service->regenerateField('titre', 'yoga', 'Old');
    }

    public function testGenerateEventCallsClientWithCorrectTokenCount(): void
    {
        $validJson = '{"titre":"T","description":"D","type":1,"capacite":10}';
        $this->mockClient
            ->expects($this->once())
            ->method('chat')
            ->with(
                $this->anything(),
                $this->equalTo(1200),
                $this->equalTo(0.75)
            )
            ->willReturn($validJson);

        $this->service->generateEvent('test');
    }
}
