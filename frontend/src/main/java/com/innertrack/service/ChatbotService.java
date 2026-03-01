package com.innertrack.service;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.ArrayList;
import java.util.List;
import java.util.function.Consumer;

/**
 * Calls the OpenRouter API directly (GPT-4.1) — no Python server needed.
 * Manages conversation history per-session in Java.
 */
public class ChatbotService {

    private static final String API_URL = "https://openrouter.ai/api/v1/chat/completions";
    private static final String MODEL = "openai/gpt-4.1";
    private static final String SYSTEM_PROMPT = "Tu es un assistant bienveillant pour InnerTrack, une application de bien-être mental. "
            +
            "Tu aides les utilisateurs avec leurs questions sur la santé mentale, le journal émotionnel, " +
            "les habitudes, et la gestion du stress. Réponds de manière concise et empathique.";

    private final HttpClient httpClient;
    private final String apiKey;
    private final List<JsonObject> conversationHistory = new ArrayList<>();

    public ChatbotService() {
        this.httpClient = HttpClient.newBuilder()
                .connectTimeout(Duration.ofSeconds(10))
                .build();

        // Load API key from .env via Dotenv
        String key = "";
        try {
            key = com.innertrack.app.MainApp.getEnv("OPENROUTER_API_KEY");
        } catch (Exception e) {
            System.err.println("Could not load OPENROUTER_API_KEY from .env: " + e.getMessage());
        }
        this.apiKey = key != null ? key : "";

        // Add system prompt
        JsonObject systemMsg = new JsonObject();
        systemMsg.addProperty("role", "system");
        systemMsg.addProperty("content", SYSTEM_PROMPT);
        conversationHistory.add(systemMsg);
    }

    /**
     * Sends a message to OpenRouter asynchronously.
     */
    public void sendMessage(String sessionId, String message, int userId,
            Consumer<String> onSuccess, Consumer<String> onError) {

        // Add user message to history
        JsonObject userMsg = new JsonObject();
        userMsg.addProperty("role", "user");
        userMsg.addProperty("content", message);
        conversationHistory.add(userMsg);

        // Trim history to last 20 exchanges + system prompt
        trimHistory();

        new Thread(() -> {
            try {
                if (apiKey == null || apiKey.isBlank()) {
                    javafx.application.Platform.runLater(() -> onError
                            .accept("Clé API manquante. Ajoutez OPENROUTER_API_KEY dans votre fichier .env"));
                    return;
                }

                // Build messages array
                JsonArray messages = new JsonArray();
                for (JsonObject msg : conversationHistory) {
                    messages.add(msg);
                }

                // Build request body
                JsonObject body = new JsonObject();
                body.addProperty("model", MODEL);
                body.add("messages", messages);
                body.addProperty("max_tokens", 500);
                body.addProperty("temperature", 0.4);

                HttpRequest request = HttpRequest.newBuilder()
                        .uri(URI.create(API_URL))
                        .header("Content-Type", "application/json")
                        .header("Authorization", "Bearer " + apiKey)
                        .header("HTTP-Referer", "http://localhost")
                        .header("X-Title", "InnerTrack")
                        .timeout(Duration.ofSeconds(30))
                        .POST(HttpRequest.BodyPublishers.ofString(body.toString()))
                        .build();

                HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());

                if (response.statusCode() == 200) {
                    JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
                    String reply = json.getAsJsonArray("choices")
                            .get(0).getAsJsonObject()
                            .getAsJsonObject("message")
                            .get("content").getAsString()
                            .trim();

                    // Add assistant reply to history
                    JsonObject assistantMsg = new JsonObject();
                    assistantMsg.addProperty("role", "assistant");
                    assistantMsg.addProperty("content", reply);
                    conversationHistory.add(assistantMsg);

                    javafx.application.Platform.runLater(() -> onSuccess.accept(reply));
                } else {
                    javafx.application.Platform.runLater(() -> onError.accept("Erreur API: " + response.statusCode()));
                }
            } catch (Exception e) {
                javafx.application.Platform.runLater(() -> onError.accept("Erreur de connexion: " + e.getMessage()));
            }
        }).start();
    }

    private void trimHistory() {
        int maxMessages = 1 + (20 * 2); // system + 20 user/assistant pairs
        if (conversationHistory.size() > maxMessages) {
            JsonObject systemMsg = conversationHistory.get(0);
            List<JsonObject> recent = new ArrayList<>(
                    conversationHistory.subList(conversationHistory.size() - (20 * 2), conversationHistory.size()));
            conversationHistory.clear();
            conversationHistory.add(systemMsg);
            conversationHistory.addAll(recent);
        }
    }

    /**
     * Checks if the API key is configured.
     */
    public void checkHealth(Consumer<Boolean> callback) {
        javafx.application.Platform.runLater(() -> callback.accept(apiKey != null && !apiKey.isBlank()));
    }
}
