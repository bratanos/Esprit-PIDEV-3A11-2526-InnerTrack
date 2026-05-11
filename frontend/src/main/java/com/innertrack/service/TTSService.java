package com.innertrack.service;

public class TTSService {

    private static TTSService instance;
    private volatile boolean enCoursLecture = false;
    private Process processActuel = null;
    private Thread threadActuel = null;

    private TTSService() {}

    public static TTSService getInstance() {
        if (instance == null)
            instance = new TTSService();
        return instance;
    }

    public void lire(String texte) {
        if (texte == null || texte.isBlank()) return;
        arreter();

        if (threadActuel != null && threadActuel.isAlive()) {
            try { threadActuel.join(2000); } catch (InterruptedException e) { /* ignore */ }
        }

        String textePropre = texte
                // Caractères typographiques
                .replace("\u2019", " ").replace("\u2018", " ")
                .replace("\u201C", " ").replace("\u201D", " ")
                .replace("\u2026", " ").replace("\u2013", " ").replace("\u2014", " ")
                .replace("\u00A9", " ")  // ©
                .replace("\u00AE", " ")  // ®
                .replace("\u2122", " ")  // ™
                .replace("\u00B0", " ")  // °
                .replace("\u20AC", " ")  // €
                .replace("\u00A3", " ")  // £
                .replace("\u00A5", " ")  // ¥
                .replace("\u00B1", " ")  // ±
                .replace("\u00D7", " ")  // ×
                .replace("\u00F7", " ")  // ÷
                .replace("\u00B2", " ")  // ²
                .replace("\u00B3", " ")  // ³
                .replace("\u2022", " ")  // •
                .replace("\u00B7", " ")  // ·
                .replace("\u2020", " ")  // †
                .replace("\u2021", " ")  // ‡
                .replace("\u00A7", " ")  // §
                .replace("\u00B6", " ")  // ¶
                .replace("\u00A6", " ")  // ¦
                // Caractères de base
                .replace("'", " ").replace("\"", " ").replace("`", " ")
                .replace("&", " et ").replace("<", " ").replace(">", " ")
                .replace("(", " ").replace(")", " ")
                .replace("[", " ").replace("]", " ")
                .replace("{", " ").replace("}", " ")
                .replace("$", " ").replace("#", " ").replace("@", " ")
                .replace("\\", " ").replace("/", " ")
                .replace("%", " pourcent ")
                .replace("+", " ")
                .replace("=", " ")
                .replace("*", " ")
                .replace("~", " ")
                .replace("^", " ")
                .replace("|", " ")
                // Supprimer tout ce qui reste hors whitelist stricte
                .replaceAll(
                        "[^a-zA-Z0-9"
                                + "\u00e0\u00e2\u00e4"
                                + "\u00e9\u00e8\u00ea\u00eb"
                                + "\u00ee\u00ef"
                                + "\u00f4"
                                + "\u00f9\u00fb\u00fc"
                                + "\u00e7"
                                + "\u00c0\u00c2\u00c4"
                                + "\u00c9\u00c8\u00ca\u00cb"
                                + "\u00ce\u00cf"
                                + "\u00d4"
                                + "\u00d9\u00db\u00dc"
                                + "\u00c7"
                                + " .,!?;:\\-]",
                        " ")
                .replaceAll("\\s+", " ")
                .trim();

        if (textePropre.length() > 300)
            textePropre = textePropre.substring(0, 297) + "...";

        final String texteFinale = textePropre;

        threadActuel = new Thread(() -> {
            enCoursLecture = true;
            java.io.File psFile = null;
            try {
                // Encoder le texte en Base64 UTF-16LE pour éviter tout problème d'encodage
                byte[] utf16Bytes = texteFinale.getBytes(java.nio.charset.StandardCharsets.UTF_16LE);
                String base64Text = java.util.Base64.getEncoder().encodeToString(utf16Bytes);

                String psContent =
                        "Add-Type -AssemblyName System.Speech\r\n" +
                                "$b64 = '" + base64Text + "'\r\n" +
                                "$bytes = [System.Convert]::FromBase64String($b64)\r\n" +
                                "$texte = [System.Text.Encoding]::Unicode.GetString($bytes)\r\n" +
                                "$synth = New-Object System.Speech.Synthesis.SpeechSynthesizer\r\n" +
                                "$synth.Volume = 100\r\n" +
                                "$synth.Rate = 0\r\n" +
                                "$synth.Speak($texte)\r\n" +
                                "$synth.Dispose()\r\n";

                String psPath = System.getenv("TEMP") + "\\tts_" + System.currentTimeMillis() + ".ps1";
                psFile = new java.io.File(psPath);

                try (java.io.OutputStreamWriter fw = new java.io.OutputStreamWriter(
                        new java.io.FileOutputStream(psFile),
                        java.nio.charset.StandardCharsets.UTF_8)) {
                    fw.write(psContent);
                }

                Thread.sleep(100);

                processActuel = new ProcessBuilder(
                        "C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe",
                        "-NoProfile", "-NonInteractive",
                        "-ExecutionPolicy", "Bypass",
                        "-WindowStyle", "Hidden",
                        "-File", psFile.getAbsolutePath())
                        .redirectErrorStream(true)
                        .start();

                processActuel.getInputStream().readAllBytes();
                processActuel.waitFor();

            } catch (InterruptedException e) {
                // Thread interrompu volontairement — normal
            } catch (Exception e) {
                System.err.println("TTS erreur : " + e.getMessage());
            } finally {
                enCoursLecture = false;
                if (psFile != null) psFile.delete();
            }
        });
        threadActuel.setDaemon(false);
        threadActuel.start();
    }

    public void arreter() {
        try {
            if (threadActuel != null && threadActuel.isAlive())
                threadActuel.interrupt();
            if (processActuel != null && processActuel.isAlive())
                processActuel.destroyForcibly();
        } catch (Exception e) { /* Silent */ }
        enCoursLecture = false;
    }

    public boolean isEnCoursLecture() {
        return enCoursLecture;
    }
}