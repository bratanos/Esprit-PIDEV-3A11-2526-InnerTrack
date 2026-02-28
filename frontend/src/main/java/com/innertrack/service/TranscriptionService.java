package com.innertrack.service;

import org.vosk.Model;
import org.vosk.Recognizer;
import javax.sound.sampled.*;
import java.io.IOException;
import java.util.function.Consumer;

public class TranscriptionService {

    private static TranscriptionService instance;

    static {
        // Essential for Windows: ensures JNA correctly decodes native STT strings
        // (French accents)
        System.setProperty("jna.encoding", "UTF-8");
    }

    private Model model;
    private boolean isRecording = false;
    private final javafx.beans.property.BooleanProperty loadingProperty = new javafx.beans.property.SimpleBooleanProperty(
            false);

    private TranscriptionService() {
        loadModelInBackground();
    }

    public static synchronized TranscriptionService getInstance() {
        if (instance == null) {
            instance = new TranscriptionService();
        }
        return instance;
    }

    private void loadModelInBackground() {
        javafx.application.Platform.runLater(() -> loadingProperty.set(true));
        new Thread(() -> {
            // Try multiple paths to find the model
            String[] possiblePaths = {
                    "frontend/src/main/java/com/innertrack/vosk/vosk-model-fr-0.22",
                    "src/main/java/com/innertrack/vosk/vosk-model-fr-0.22",
                    "com/innertrack/vosk/vosk-model-fr-0.22",
                    "vosk-model-fr-0.22"
            };

            String foundPath = null;
            for (String path : possiblePaths) {
                java.io.File file = new java.io.File(path);
                if (file.exists() && file.isDirectory()) {
                    foundPath = path;
                    break;
                }
            }

            if (foundPath != null) {
                try {
                    this.model = new Model(foundPath);
                    System.out.println("Vosk model loaded successfully from " + foundPath);
                } catch (IOException e) {
                    System.err.println("Could not create Vosk model from " + foundPath + ": " + e.getMessage());
                }
            } else {
                System.err.println("Vosk model not found in any expected location.");
            }
            javafx.application.Platform.runLater(() -> loadingProperty.set(false));
        }).start();
    }

    public javafx.beans.property.BooleanProperty loadingProperty() {
        return loadingProperty;
    }

    public boolean isModelReady() {
        return model != null && !loadingProperty.get();
    }

    public void startTranscription(Consumer<String> onResult) {
        if (!isModelReady()) {
            onResult.accept(
                    loadingProperty.get() ? "[Modèle en cours de chargement...]" : "[Erreur: Modèle Vosk non trouvé]");
            return;
        }

        AudioDeviceService deviceService = AudioDeviceService.getInstance();
        Mixer.Info selectedMixer = deviceService.getSelectedMixer();

        AudioFormat format = new AudioFormat(16000, 16, 1, true, false);
        DataLine.Info info = new DataLine.Info(TargetDataLine.class, format);

        new Thread(() -> {
            try (TargetDataLine line = (TargetDataLine) AudioSystem.getMixer(selectedMixer).getLine(info)) {
                line.open(format);
                line.start();
                isRecording = true;

                try (Recognizer recognizer = new Recognizer(model, 16000)) {
                    byte[] buffer = new byte[4096];
                    while (isRecording) {
                        int bytesRead = line.read(buffer, 0, buffer.length);
                        if (recognizer.acceptWaveForm(buffer, bytesRead)) {
                            String result = recognizer.getResult();
                            String text = extractText(result);
                            if (!text.isEmpty()) {
                                onResult.accept(text);
                            }
                        }
                    }
                    String finalResult = recognizer.getFinalResult();
                    String finalText = extractText(finalResult);
                    if (!finalText.isEmpty()) {
                        onResult.accept(finalText);
                    }
                }
            } catch (Exception e) {
                System.err.println("Transcription error: " + e.getMessage());
            }
        }).start();
    }

    public void stopTranscription() {
        isRecording = false;
    }

    private String extractText(String json) {
        // Vosk returns JSON like {"text": "hello"}
        // Simple extraction to avoid adding another JSON dependency if possible,
        // but Gson is already in pom.xml
        com.google.gson.JsonObject jsonObject = com.google.gson.JsonParser.parseString(json).getAsJsonObject();
        if (jsonObject.has("text")) {
            return jsonObject.get("text").getAsString();
        }
        return "";
    }
}
