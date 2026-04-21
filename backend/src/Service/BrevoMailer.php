<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BrevoMailer
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $brevoApiKey,
    ) {}

    public function sendEmail(
        string $toEmail,
        string $toName,
        string $subject,
        string $htmlContent,
    ): bool {
        $response = $this->httpClient->request('POST', 'https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'api-key'      => $this->brevoApiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'json' => [
                'sender' => [
                    'name'  => 'InnerTrack',
                    'email' => 'salmahamemy.1006@gmail.com',
                ],
                'to' => [[
                    'email' => $toEmail,
                    'name'  => $toName,
                ]],
                'subject'     => $subject,
                'htmlContent' => $htmlContent,
            ],
        ]);

        return $response->getStatusCode() === 201;
    }
}