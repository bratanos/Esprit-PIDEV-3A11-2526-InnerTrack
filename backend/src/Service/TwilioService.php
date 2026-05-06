<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TwilioService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $accountSid,
        private readonly string $authToken,
        private readonly string $fromNumber,
    ) {}

<<<<<<< HEAD
    // ══════════════════════════════════════════
    // MÉTHODE DE BASE — WhatsApp
    // ══════════════════════════════════════════
=======
    /** @return array<string, mixed> */
>>>>>>> origin/feature/salma-TestSymphony+java
    public function envoyerWhatsApp(string $numero, string $message): array
    {
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}/Messages.json";

        $response = $this->httpClient->request('POST', $url, [
            'auth_basic' => [$this->accountSid, $this->authToken],
            'body' => [
                'From' => 'whatsapp:' . $this->fromNumber,
                'To'   => 'whatsapp:' . $numero,
                'Body' => $message,
            ],
        ]);

        $data = $response->toArray(false);

        if ($response->getStatusCode() >= 400) {
            throw new \RuntimeException('Twilio error: ' . ($data['message'] ?? 'Unknown error'));
        }

        return $data;
    }

<<<<<<< HEAD
    // ══════════════════════════════════════════
    // ALERTE NOUVEAU TEST
    // ══════════════════════════════════════════
=======
    /** @return array<string, mixed> */
>>>>>>> origin/feature/salma-TestSymphony+java
    public function envoyerAlerteNouveauTest(string $numero, string $prenom, string $titreTest, string $typeTest): array
    {
        $message = sprintf(
            "🧠 *Psychology App*\n\n" .
            "Bonjour *%s* ! 👋\n\n" .
            "🆕 *Nouveau test disponible :*\n" .
            "📋 %s\n" .
            "🏷 Type : %s\n\n" .
            "Connectez-vous pour le passer ! ✅",
            $prenom, $titreTest, $typeTest
        );

        return $this->envoyerWhatsApp($numero, $message);
    }

<<<<<<< HEAD
    // ══════════════════════════════════════════
    // RÉSULTAT DE TEST
    // ══════════════════════════════════════════
=======
    /** @return array<string, mixed> */
>>>>>>> origin/feature/salma-TestSymphony+java
    public function envoyerResultatTest(
        string $numero,
        string $prenom,
        string $titreTest,
        int    $score,
        int    $scoreMax,
        string $niveau
    ): array {
        $pct = $scoreMax > 0 ? round(($score / $scoreMax) * 100) : 0;

        $message = sprintf(
            "🧠 *Psychology App*\n\n" .
            "Bonjour *%s* ! 🎉\n\n" .
            "📊 *Vos résultats :*\n" .
            "📋 Test : %s\n" .
            "🎯 Score : *%d/%d* (%d%%)\n" .
            "📈 Niveau : *%s*\n\n" .
            "Consultez vos recommandations IA dans l'application ! 🤖",
            $prenom, $titreTest, $score, $scoreMax, $pct, $niveau
        );

        return $this->envoyerWhatsApp($numero, $message);
    }

<<<<<<< HEAD
    // ══════════════════════════════════════════
    // RAPPEL J+30
    // ══════════════════════════════════════════
=======
    /** @return array<string, mixed> */
>>>>>>> origin/feature/salma-TestSymphony+java
    public function envoyerRappel(string $numero, string $prenom, string $titreTest, string $dateTest): array
    {
        $message = sprintf(
            "🧠 *Innertrack*\n\n" .
            "Bonjour *%s* ! ⏰\n\n" .
            "📅 *Rappel — 30 jours écoulés !*\n\n" .
            "Vous avez passé le test *%s*\n" .
            "le %s.\n\n" .
            "🔄 *Il est temps de le repasser !*\n\n" .
            "💡 Pourquoi ?\n" .
            "• Mesurer votre évolution\n" .
            "• Nouvelles recommandations IA\n" .
            "• Suivre votre progression\n\n" .
            "Connectez-vous maintenant ! ✅",
            $prenom, $titreTest, $dateTest
        );

        return $this->envoyerWhatsApp($numero, $message);
    }
}