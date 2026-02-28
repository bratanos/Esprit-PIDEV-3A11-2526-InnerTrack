package com.innertrack.service;

public class TTSService {

    private static TTSService instance;
    private boolean enCoursLecture = false;
    private Process processActuel = null;

    private TTSService() {
    }

    public static TTSService getInstance() {
        if (instance == null)
            instance = new TTSService();
        return instance;
    }

    public void lire(String texte) {
        if (texte == null || texte.isBlank())
            return;
        arreter();

        String textePropre = texte
                .replace("\u2019", " ").replace("\u2018", " ")
                .replace("\u201C", " ").replace("\u201D", " ")
                .replace("\u2026", " ").replace("\u2013", " ").replace("\u2014", " ")
                .replace("'", " ").replace("\"", " ").replace("`", " ")
                .replace("&", " et ").replace("<", " ").replace(">", " ")
                .replace("(", " ").replace(")", " ")
                .replace("[", " ").replace("]", " ")
                .replace("{", " ").replace("}", " ")
                .replace("$", " ").replace("#", " ").replace("@", " ")
                .replace("\\", " ").replace("/", " ")
                .replace("%", " pourcent ")
                .replaceAll(
                        "[^a-zA-Z0-9\u00e0\u00e2\u00e4\u00e9\u00e8\u00ea\u00eb\u00ee\u00ef\u00f4\u00f9\u00fb\u00fc\u00e7\u00c0\u00c2\u00c4\u00c9\u00c8\u00ca\u00cb\u00ce\u00cf\u00d4\u00d9\u00db\u00dc\u00c7 .,!?;:\\-]",
                        " ")
                .replaceAll("\\s+", " ")
                .trim();

        if (textePropre.length() > 300) {
            textePropre = textePropre.substring(0, 297) + "...";
        }

        final String texteFinale = textePropre;

        Thread t = new Thread(() -> {
            enCoursLecture = true;
            try {
                String psContent = "Add-Type -AssemblyName System.Speech\r\n" +
                        "$synth = New-Object System.Speech.Synthesis.SpeechSynthesizer\r\n" +
                        "$synth.Volume = 100\r\n" +
                        "$synth.Rate = 0\r\n" +
                        "$synth.Speak(\"" + texteFinale + "\")\r\n" +
                        "$synth.Dispose()\r\n";

                java.io.File psFile = new java.io.File(
                        System.getenv("TEMP") + "\\tts.ps1");

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
                        "-File", psFile.getAbsolutePath()).redirectErrorStream(true).start();

                processActuel.getInputStream().readAllBytes();
                processActuel.waitFor();

            } catch (Exception e) {
                System.err.println("TTS erreur : " + e.getMessage());
            }
            enCoursLecture = false;
        });
        t.setDaemon(false);
        t.start();
    }

    public void arreter() {
        try {
            if (processActuel != null)
                processActuel.destroy();
            new ProcessBuilder("taskkill", "/F", "/IM", "powershell.exe", "/T").start();
        } catch (Exception e) {
            /* Silent */ }
        enCoursLecture = false;
    }

    public boolean isEnCoursLecture() {
        return enCoursLecture;
    }
}
