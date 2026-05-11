package com.innertrack.service;

import com.innertrack.app.MainApp;

/**
 * Service for sending WhatsApp messages and SMS via Twilio API.
 * Requires environment variables: TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN.
 * 
 * NOTE: Twilio SDK dependency must be added to pom.xml.
 * If Twilio is not available, methods will print errors but not crash.
 */
public class SmsService {

    // APRÈS
    private static final String ACCOUNT_SID = MainApp.getEnv("TWILIO_ACCOUNT_SID");
    private static final String AUTH_TOKEN = MainApp.getEnv("TWILIO_AUTH_TOKEN");
    private static final String FROM_NUMBER = getFromNumber();

    private static String getFromNumber() {
        String val = MainApp.getEnv("TWILIO_FROM_NUMBER");
        if (val == null || val.isEmpty()) {
            System.out.println("⚠️ TWILIO_FROM_NUMBER non trouvé, utilisation valeur par défaut");
            return "+14155238886"; // valeur par défaut sandbox Twilio
        }
        // Enlever le préfixe whatsapp: si présent (il sera rajouté dans envoyerWhatsApp)
        return val.replace("whatsapp:", "");
    }

    private static SmsService instance;
    private boolean initialized = false;

    private SmsService() {
        if (ACCOUNT_SID != null && AUTH_TOKEN != null && !ACCOUNT_SID.isEmpty()) {
            try {
                com.twilio.Twilio.init(ACCOUNT_SID, AUTH_TOKEN);
                initialized = true;
                System.out.println("✅ Twilio initialisé");
            } catch (Exception e) {
                System.err.println("⚠️ Twilio init failed: " + e.getMessage());
            }
        } else {
            System.err.println("⚠️ Twilio non configuré — SMS/WhatsApp désactivé");
        }
    }

    public static SmsService getInstance() {
        if (instance == null)
            instance = new SmsService();
        return instance;
    }

    public void envoyerWhatsApp(String numeroDestinataire, String message) throws Exception {
        if (!initialized) {
            System.err.println("⚠️ Twilio non initialisé — WhatsApp non envoyé");
            return;
        }

        // Clean the phone number: remove spaces and non-digit characters except '+'
        String cleanedNumber = numeroDestinataire.replaceAll("[^+\\d]", "");

        com.twilio.rest.api.v2010.account.Message msg = com.twilio.rest.api.v2010.account.Message.creator(
                new com.twilio.type.PhoneNumber("whatsapp:" + cleanedNumber),
                new com.twilio.type.PhoneNumber("whatsapp:" + FROM_NUMBER),
                message).create();
        System.out.println("✅ WhatsApp envoyé — SID : " + msg.getSid());
    }

    public void envoyerSms(String numeroDestinataire, String message) throws Exception {
        if (!initialized) {
            System.err.println("⚠️ Twilio non initialisé — SMS non envoyé");
            return;
        }

        // Clean the phone number
        String cleanedNumber = numeroDestinataire.replaceAll("[^+\\d]", "");

        com.twilio.rest.api.v2010.account.Message msg = com.twilio.rest.api.v2010.account.Message.creator(
                new com.twilio.type.PhoneNumber(cleanedNumber),
                new com.twilio.type.PhoneNumber(FROM_NUMBER),
                message).create();
        System.out.println("✅ SMS envoyé — SID : " + msg.getSid());
    }

    public void envoyerAlerteNouveauTestWhatsApp(String numero, String prenomUser,
            String titreTest, String typeTest) throws Exception {
        String message = String.format(
                "🧠 *Psychology App*\n\nBonjour *%s* ! 👋\n\n🆕 *Nouveau test disponible :*\n📋 %s\n🏷 Type : %s\n\nConnectez-vous pour le passer ! ✅",
                prenomUser, titreTest, typeTest);
        envoyerWhatsApp(numero, message);
    }

    public void envoyerResultatTestWhatsApp(String numero, String prenomUser,
            String titreTest, int score,
            int scoreMax, String niveau) throws Exception {
        String message = String.format(
                "🧠 *Psychology App*\n\nBonjour *%s* ! 🎉\n\n📊 *Vos résultats :*\n📋 Test : %s\n🎯 Score : *%d/%d* (%.0f%%)\n📈 Niveau : *%s*\n\nConsultez vos recommandations IA dans l'application ! 🤖",
                prenomUser, titreTest, score, scoreMax, (score * 100.0 / scoreMax), niveau);
        envoyerWhatsApp(numero, message);
    }

    public void envoyerRappelWhatsApp(String numero, String prenomUser,
            String titreTest, String dateTest) throws Exception {
        String message = String.format(
                "🧠 *Psychology App*\n\nBonjour *%s* ! ⏰\n\n📅 *Rappel — 30 jours écoulés !*\n\nVous avez passé le test *%s*\nle %s.\n\n🔄 *Il est temps de le repasser !*\n\nConnectez-vous maintenant ! ✅",
                prenomUser, titreTest, dateTest);
        envoyerWhatsApp(numero, message);
    }

    public void envoyerMemeWhatsApp(String numero, String prenomUser, String memeUrl) throws Exception {
        if (!initialized) {
            System.err.println("⚠️ Twilio non initialisé — WhatsApp Meme non envoyé");
            return;
        }

        // Clean the phone number
        String cleanedNumber = numero.replaceAll("[^+\\d]", "");

        String message = String.format("🎉 Bonjour %s ! Voici un petit meme pour vous détendre après votre test ! ✨",
                prenomUser);

        com.twilio.rest.api.v2010.account.Message msg = com.twilio.rest.api.v2010.account.Message.creator(
                new com.twilio.type.PhoneNumber("whatsapp:" + cleanedNumber),
                new com.twilio.type.PhoneNumber("whatsapp:" + FROM_NUMBER),
                message)
                .setMediaUrl(java.util.Collections.singletonList(java.net.URI.create(memeUrl)))
                .create();

        System.out.println("✅ Meme WhatsApp envoyé — SID : " + msg.getSid());
    }

    public void envoyerResultatEtMemeWhatsApp(String numero, String prenomUser,
                                              String titreTest, int score, int scoreMax, String niveau,
                                              String interpretation, String memeUrl) throws Exception {

        String cleanedNumber = numero.replaceAll("[^+\\d]", "");

        // ✅ Message texte avec résultat
        String message = String.format(
                "🧠 *Psychology App*\n\nBonjour *%s* ! 🎉\n\n" +
                        "📊 *Résultats — %s*\n" +
                        "🎯 Score : *%d/%d* (%.0f%%)\n" +
                        "📈 Niveau : *%s*\n\n" +
                        "📋 %s\n\n" +
                        "Consultez vos recommandations IA dans l'application ! 🤖",
                prenomUser, titreTest, score, scoreMax,
                (score * 100.0 / scoreMax), niveau,
                interpretation != null ? interpretation : "");

        // Envoyer le message texte
        com.twilio.rest.api.v2010.account.Message msg1 =
                com.twilio.rest.api.v2010.account.Message.creator(
                        new com.twilio.type.PhoneNumber("whatsapp:" + cleanedNumber),
                        new com.twilio.type.PhoneNumber("whatsapp:" + FROM_NUMBER),
                        message).create();
        System.out.println("✅ Résultat WhatsApp envoyé — SID : " + msg1.getSid());

        // ✅ Envoyer le meme séparément si disponible
        if (memeUrl != null && !memeUrl.isBlank()) {
            String memeTxt = "😄 Et voici un petit meme pour détendre l'atmosphère !";
            com.twilio.rest.api.v2010.account.Message msg2 =
                    com.twilio.rest.api.v2010.account.Message.creator(
                                    new com.twilio.type.PhoneNumber("whatsapp:" + cleanedNumber),
                                    new com.twilio.type.PhoneNumber("whatsapp:" + FROM_NUMBER),
                                    memeTxt)
                            .setMediaUrl(java.util.Collections.singletonList(
                                    java.net.URI.create(memeUrl)))
                            .create();
            System.out.println("✅ Meme WhatsApp envoyé — SID : " + msg2.getSid());
        }
    }
}
