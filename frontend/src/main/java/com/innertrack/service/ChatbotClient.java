package com.innertrack.service;

import com.fasterxml.jackson.databind.ObjectMapper;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.time.Duration;
import java.util.Map;

public class ChatbotClient {

    private final HttpClient http = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(5))
            .build();

    private final ObjectMapper mapper = new ObjectMapper();
    private final String baseUrl; // ex: http://127.0.0.1:8000

    public ChatbotClient(String baseUrl) {
        this.baseUrl = baseUrl;
    }

    public String sendMessage(String sessionId, String message, Integer userId) throws Exception {
        Map<String, Object> payload = Map.of(
                "session_id", sessionId,
                "message", message,
                "user_id", userId == null ? 0 : userId
        );

        String json = mapper.writeValueAsString(payload);

        HttpRequest req = HttpRequest.newBuilder()
                .uri(URI.create(baseUrl + "/interact"))
                .header("Content-Type", "application/json")
                .timeout(Duration.ofSeconds(30))
                .POST(HttpRequest.BodyPublishers.ofString(json, StandardCharsets.UTF_8))
                .build();

        HttpResponse<String> resp = http.send(req, HttpResponse.BodyHandlers.ofString());

        if (resp.statusCode() / 100 != 2) {
            throw new RuntimeException("API error " + resp.statusCode() + ": " + resp.body());
        }

        // response: {"response": "..."}
        Map<?, ?> body = mapper.readValue(resp.body(), Map.class);
        Object r = body.get("response");
        return r == null ? "" : r.toString();
    }
}