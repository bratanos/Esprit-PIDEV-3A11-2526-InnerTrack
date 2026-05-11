package com.innertrack.service;

import com.innertrack.app.MainApp;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;

/**
 * Service for sending test report emails via Brevo (Sendinblue) API.
 * Requires BREVO_API_KEY or SENDINBLUE_API_KEY environment variable.
 */
public class EmailTestService {

    private static final String API_URL = "https://api.brevo.com/v3/smtp/email";
    private static final String API_KEY = getApiKey();
    private final HttpClient httpClient = HttpClient.newHttpClient();

    private static String getApiKey() {
        String key = MainApp.getEnv("BREVO_API_KEY");
        if (key == null || key.isEmpty()) {
            key = MainApp.getEnv("SENDINBLUE_API_KEY");
        }
        return key;
    }

    public void envoyerRapport(String destinataire, String nomUtilisateur,
                               String titreTest, String contenuRapport) {

        if (API_KEY == null || API_KEY.isEmpty()) {
            System.err.println("⚠️ BREVO_API_KEY non configurée — email non envoyé");
            return;
        }

        try {
            String htmlContent = buildHtmlEmail(nomUtilisateur, titreTest, contenuRapport);

            // Construire le JSON proprement avec Gson
            com.google.gson.JsonObject sender = new com.google.gson.JsonObject();
            sender.addProperty("name", "InnerTrack");
            sender.addProperty("email", "salmahamemy.1006@gmail.com");

            com.google.gson.JsonObject toObj = new com.google.gson.JsonObject();
            toObj.addProperty("email", destinataire);
            toObj.addProperty("name", nomUtilisateur);

            com.google.gson.JsonArray toArray = new com.google.gson.JsonArray();
            toArray.add(toObj);

            com.google.gson.JsonObject body = new com.google.gson.JsonObject();
            body.add("sender", sender);
            body.add("to", toArray);
            body.addProperty("subject", "📊 Rapport : " + titreTest);
            body.addProperty("htmlContent", htmlContent);

            String json = new com.google.gson.Gson().toJson(body);

            System.out.println("📤 Envoi email à : " + destinataire);

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
            e.printStackTrace();
        }
    }

    // =========================================================================
    //  HTML BUILDER
    // =========================================================================

    /**
     * Builds a beautiful, mail-client-compatible HTML email.
     *
     * @param nomUtilisateur  Recipient's display name
     * @param titreTest       Name of the psychological test
     * @param contenuRapport  Main report body (already formatted HTML or plain text)
     */
    private String buildHtmlEmail(String nomUtilisateur,
                                  String titreTest,
                                  String contenuRapport) {
        return "<!DOCTYPE html>" +
                "<html lang='fr'>" +
                "<head>" +
                "  <meta charset='UTF-8'/>" +
                "  <meta name='viewport' content='width=device-width,initial-scale=1.0'/>" +
                "</head>" +
                "<body style='margin:0;padding:0;background:#eef2ff;" +
                "             font-family:Segoe UI,Helvetica,Arial,sans-serif;'>" +

                // ── Outer wrapper ────────────────────────────────────────────
                "<table width='100%' cellpadding='0' cellspacing='0'" +
                "       style='background:#eef2ff;padding:40px 0;'>" +
                "<tr><td align='center'>" +

                // ── Card ─────────────────────────────────────────────────────
                "<table width='620' cellpadding='0' cellspacing='0'" +
                "       style='background:#ffffff;border-radius:20px;overflow:hidden;" +
                "              box-shadow:0 8px 40px rgba(102,126,234,0.15);'>" +

                // ── Header gradient ──────────────────────────────────────────
                "<tr><td style='background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);" +
                "               padding:36px 40px 20px;text-align:center;'>" +
                "  <div style='font-size:42px;margin-bottom:10px;'>🧠</div>" +
                "  <h1 style='margin:0;color:#ffffff;font-size:26px;font-weight:700;" +
                "             letter-spacing:-0.5px;'>Rapport de Test Psychologique</h1>" +
                "  <p style='margin:8px 0 0;color:rgba(255,255,255,0.75);font-size:13px;" +
                "            letter-spacing:1.5px;text-transform:uppercase;'>" +
                "    InnerTrack &middot; Bien-être Mental" +
                "  </p>" +
                "</td></tr>" +

                // ── Title badge ──────────────────────────────────────────────
                "<tr><td style='background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);" +
                "               padding:0 40px 30px;text-align:center;'>" +
                "  <div style='display:inline-block;background:rgba(255,255,255,0.2);" +
                "              border:2px solid rgba(255,255,255,0.45);border-radius:50px;" +
                "              padding:9px 28px;'>" +
                "    <span style='color:#ffffff;font-size:15px;font-weight:600;'>" +
                "      📋 " + titreTest +
                "    </span>" +
                "  </div>" +
                "</td></tr>" +

                // ── Greeting ─────────────────────────────────────────────────
                "<tr><td style='padding:32px 40px 0;'>" +
                "  <p style='margin:0 0 6px;color:#4a4a6a;font-size:16px;'>" +
                "    Bonjour <strong style='color:#667eea;'>" + nomUtilisateur + "</strong>," +
                "  </p>" +
                "  <p style='margin:0 0 28px;color:#6b7280;font-size:15px;line-height:1.65;'>" +
                "    Voici votre rapport pour le test" +
                "    <strong style='color:#374151;'> " + titreTest + "</strong>." +
                "  </p>" +

                // ── Report content card ───────────────────────────────────────
                "  <div style='background:linear-gradient(135deg,#f0f4ff 0%,#faf5ff 100%);" +
                "              border-left:4px solid #667eea;border-radius:14px;" +
                "              padding:24px 28px;margin-bottom:28px;" +
                "              box-shadow:0 2px 12px rgba(102,126,234,0.08);'>" +
                "    <p style='margin:0 0 6px;font-size:11px;font-weight:700;color:#9ca3af;" +
                "              text-transform:uppercase;letter-spacing:1.2px;'>Résultat</p>" +
                "    <div style='color:#374151;font-size:15px;line-height:1.75;'>" +
                contenuRapport +
                "    </div>" +
                "  </div>" +

                // ── Divider tip ───────────────────────────────────────────────
                "  <div style='background:#f0fdf4;border-left:4px solid #10b981;" +
                "              border-radius:10px;padding:14px 20px;margin-bottom:32px;'>" +
                "    <p style='margin:0;color:#065f46;font-size:13px;line-height:1.6;'>" +
                "      💡 <strong>Conseil :</strong> Revenez régulièrement pour suivre " +
                "      l'évolution de votre bien-être mental." +
                "    </p>" +
                "  </div>" +

                "</td></tr>" +

                // ── Footer gradient ───────────────────────────────────────────
                "<tr><td style='background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);" +
                "               padding:26px 40px;text-align:center;" +
                "               border-radius:0 0 20px 20px;'>" +
                "  <p style='margin:0 0 5px;color:rgba(255,255,255,0.95);" +
                "            font-size:14px;font-weight:700;'>🧠 InnerTrack</p>" +
                "  <p style='margin:0;color:rgba(255,255,255,0.6);font-size:12px;'>" +
                "    Ce rapport est généré par InnerTrack — votre partenaire bien-être mental." +
                "  </p>" +
                "</td></tr>" +

                "</table>" + // end card
                "</td></tr>" +
                "</table>" + // end outer wrapper
                "</body></html>";
    }
}
