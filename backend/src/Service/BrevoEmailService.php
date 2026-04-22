<?php

namespace App\Service;

use App\Entity\Testpsy\AIRecommandation;
use App\Entity\Testpsy\Resultat;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Sends test-result reports via the Brevo (Sendinblue) REST API.
 * Configuration is injected from .env:
 *   BREVO_API_KEY, BREVO_SENDER_EMAIL, BREVO_APP_NAME
 */
class BrevoEmailService
{
    private const API_URL = 'https://api.brevo.com/v3/smtp/email';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $apiKey,
        private readonly string $senderEmail,
        private readonly string $appName,
    ) {}

    /**
     * Envoie le rapport de résultat + recommandations IA par email.
     *
     * @throws \RuntimeException si l'API Brevo retourne une erreur
     */
    public function envoyerRapport(
        string           $emailDestinataire,
        string           $prenomUtilisateur,
        Resultat         $resultat,
        AIRecommandation $rec,
        string           $titreTest
    ): void {
        $htmlContent = $this->construireHtml($prenomUtilisateur, $resultat, $rec, $titreTest);
        $sujet       = 'Vos résultats — ' . $titreTest;

        $response = $this->httpClient->request('POST', self::API_URL, [
            'headers' => [
                'accept'       => 'application/json',
                'api-key'      => $this->apiKey,
                'content-type' => 'application/json',
            ],
            'json' => [
                'sender'      => ['name' => $this->appName, 'email' => $this->senderEmail],
                'to'          => [['email' => $emailDestinataire, 'name' => $prenomUtilisateur]],
                'subject'     => $sujet,
                'htmlContent' => $htmlContent,
            ],
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 201) {
            throw new \RuntimeException(
                sprintf(
                    'Échec envoi email via Brevo. Code HTTP : %d — %s',
                    $statusCode,
                    $response->getContent(false)
                )
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // HTML DE L'EMAIL
    // ─────────────────────────────────────────────────────────────
    private function construireHtml(
        string           $prenom,
        Resultat         $r,
        AIRecommandation $rec,
        string           $titreTest
    ): string {
        $couleur = ($r->getResultat() !== null && str_contains(strtolower($r->getResultat()), 'critique'))
            ? '#e53e3e'
            : '#667eea';

        // Blocs habitudes
        $habitudesHtml = '';
        foreach ($rec->getHabitudes() as $h) {
            $habitudesHtml .= sprintf(
                '<div style="background:#f8f9fa;border-left:4px solid #667eea;'
                . 'padding:12px;margin:8px 0;border-radius:4px;">'
                . '<strong>%s %s</strong> [%s]<br>'
                . '<span style="color:#555;font-size:13px;">%s</span>'
                . '</div>',
                htmlspecialchars($h['emoji']       ?? ''),
                htmlspecialchars($h['titre']       ?? ''),
                htmlspecialchars($h['frequence']   ?? ''),
                htmlspecialchars($h['description'] ?? '')
            );
        }

        return '<!DOCTYPE html>'
            . '<html><body style="font-family:Arial,sans-serif;background:#f5f7fa;padding:30px;margin:0;">'
            . '<div style="max-width:600px;margin:0 auto;background:white;'
            . 'border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.1);">'

            // ── En-tête coloré ──────────────────────────────────────
            . '<div style="background:' . $couleur . ';padding:30px;text-align:center;">'
            . '<h1 style="color:white;margin:0;font-size:24px;">&#128202; '
            . htmlspecialchars($r->getResultat() ?? 'Résultats') . '</h1>'
            . '<p style="color:rgba(255,255,255,0.9);margin:8px 0 0;">Score : '
            . $r->getScoreTotal() . ' / ' . $r->getScoreMaxPossible()
            . ' (' . number_format($r->getPourcentage(), 1) . '%)</p>'
            . '</div>'

            // ── Corps ───────────────────────────────────────────────
            . '<div style="padding:30px;">'
            . '<p style="font-size:16px;color:#333;">Bonjour <strong>' . htmlspecialchars($prenom) . '</strong>,</p>'
            . '<p style="color:#555;">Voici vos résultats au test <strong>' . htmlspecialchars($titreTest) . '</strong>.</p>'

            // Interprétation
            . '<div style="background:#f0f4ff;border-radius:10px;padding:20px;margin:20px 0;">'
            . '<h3 style="color:#667eea;margin:0 0 10px;">&#128203; Interprétation</h3>'
            . '<p style="color:#333;margin:0;">' . htmlspecialchars($r->getInterpretation() ?? 'N/A') . '</p>'
            . '</div>'

            // Profil IA
            . '<div style="background:#f0fff4;border-radius:10px;padding:20px;margin:20px 0;">'
            . '<h3 style="color:#38a169;margin:0 0 10px;">'
            . $rec->getEmojiCluster() . ' Profil IA : ' . htmlspecialchars($rec->getCluster() ?? '')
            . ' (confiance ' . $rec->getScoreConfiance() . '%)</h3>'
            . '<p style="color:#555;margin:0;">' . htmlspecialchars($rec->getAnalyseGlobale() ?? '') . '</p>'
            . '</div>'

            // Habitudes recommandées
            . '<h3 style="color:#333;margin:20px 0 10px;">&#128161; Habitudes recommandées</h3>'
            . $habitudesHtml

            // Plan semaine
            . '<h3 style="color:#333;margin:20px 0 10px;">&#128197; Plan de la semaine</h3>'
            . '<pre style="background:#f8f9fa;padding:15px;border-radius:8px;'
            . 'font-size:12px;color:#333;white-space:pre-wrap;">'
            . htmlspecialchars($rec->getPlanSemaine() ?? '') . '</pre>'
            . '</div>'

            // ── Pied de page ────────────────────────────────────────
            . '<div style="background:#f8f9fa;padding:20px;text-align:center;">'
            . '<p style="color:#999;font-size:12px;margin:0;">Rapport généré par '
            . htmlspecialchars($this->appName) . ' &middot; Ne pas répondre à cet email</p>'
            . '</div>'
            . '</div></body></html>';
    }
}
