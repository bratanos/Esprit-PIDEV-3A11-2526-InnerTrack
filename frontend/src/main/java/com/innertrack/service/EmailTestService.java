package com.innertrack.service;

import com.innertrack.app.MainApp;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

/**
 * Service for sending test report emails via Brevo (Sendinblue) API.
 * Requires SENDINBLUE_API_KEY environment variable.
 */
public class EmailTestService {

    private static final String API_URL = "https://api.brevo.com/v3/smtp/email";
    private static final String API_KEY = MainApp.getEnv("BREVO_API_KEY");
    private final HttpClient httpClient = HttpClient.newHttpClient();

    public void envoyerRapport(String destinataire, String nomUtilisateur,
            String titreTest, String contenuRapport) {

        if (API_KEY == null || API_KEY.isEmpty()) {
            System.err.println("⚠️ SENDINBLUE_API_KEY non configurée — email non envoyé");
            return;
        }

        try {
            String htmlContent = String.format(
                    """
                            <html><body style="font-family: Arial, sans-serif; background: #f5f7fa; padding: 20px;">
                            <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; padding: 30px;">
                                <h1 style="color: #667eea;">🧠 Rapport de Test Psychologique</h1>
                                <p>Bonjour <strong>%s</strong>,</p>
                                <p>Voici votre rapport pour le test <strong>%s</strong> :</p>
                                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 15px 0;">
                                    %s
                                </div>
                                <p style="color: #7f8c8d; font-size: 12px;">
                                    Ce rapport est généré par InnerTrack — votre partenaire bien-être mental.
                                </p>
                            </div>
                            </body></html>
                            """,
                    nomUtilisateur, titreTest, contenuRapport);

            String json = String.format("""
                    {
                        "sender": {"name": "InnerTrack", "email": "noreply@innertrack.com"},
                        "to": [{"email": "%s", "name": "%s"}],
                        "subject": "📊 Rapport : %s",
                        "htmlContent": %s
                    }
                    """, destinataire, nomUtilisateur, titreTest,
                    com.google.gson.JsonParser.parseString("\"" + htmlContent
                            .replace("\\", "\\\\")
                            .replace("\"", "\\\"")
                            .replace("\n", "\\n") + "\""));

            HttpRequest request = HttpRequest.newBuilder()
                    .uri(URI.create(API_URL))
                    .header("accept", "application/json")
                    .header("api-key", API_KEY)
                    .header("content-type", "application/json")
                    .POST(HttpRequest.BodyPublishers.ofString(json))
                    .build();

            HttpResponse<String> response = httpClient.send(request,
                    HttpResponse.BodyHandlers.ofString());

            if (response.statusCode() == 201) {
                System.out.println("✅ Email rapport envoyé à " + destinataire);
            } else {
                System.err.println("❌ Erreur envoi email: " + response.statusCode()
                        + " — " + response.body());
            }
        } catch (Exception e) {
            System.err.println("❌ Exception envoi email: " + e.getMessage());
        }
    }
}
