package com.innertrack.service;

/**
 * Text-to-Speech service using Windows SAPI via VBScript.
 * Windows-only. Uses a daemon thread to avoid blocking the UI.
 */
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
                .replaceAll("[^\\p{L}\\p{N}\\p{P}\\p{Z}]", " ")
                .replace("'", " ")
                .replace("\u2019", " ")
                .replace("\u2018", " ")
                .replace("\"", " ")
                .replace("`", " ")
                .trim();

        Thread t = new Thread(() -> {
            enCoursLecture = true;
            try {
                String vbs = "Dim sapi\r\n" +
                        "Set sapi = CreateObject(\"SAPI.SpVoice\")\r\n" +
                        "sapi.Volume = 100\r\n" +
                        "sapi.Rate = 0\r\n" +
                        "sapi.Speak \"" + textePropre + "\"\r\n" +
                        "WScript.Sleep 100\r\n";

                java.io.File f = new java.io.File(
                        System.getenv("TEMP") + "\\tts.vbs");

                try (java.io.OutputStreamWriter fw = new java.io.OutputStreamWriter(
                        new java.io.FileOutputStream(f),
                        java.nio.charset.Charset.forName("windows-1252"))) {
                    fw.write(vbs);
                }

                Thread.sleep(200);

                System.out.println("TTS — lancement : " + f.getAbsolutePath());

                processActuel = Runtime.getRuntime().exec(new String[] {
                        "C:\\Windows\\System32\\wscript.exe",
                        "//Nologo",
                        "//B",
                        f.getAbsolutePath()
                });

                int exitCode = processActuel.waitFor();
                System.out.println("TTS — exit code : " + exitCode);

            } catch (Exception e) {
                System.err.println("TTS erreur : " + e.getMessage());
                e.printStackTrace();
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
            Runtime.getRuntime().exec("taskkill /F /IM wscript.exe /T");
        } catch (Exception e) {
            // Silent
        }
        enCoursLecture = false;
    }

    public boolean isEnCoursLecture() {
        return enCoursLecture;
    }
}
