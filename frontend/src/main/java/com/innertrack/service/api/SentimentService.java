package com.innertrack.service.api;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.innertrack.app.MainApp;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;

public class SentimentService {

    private static final String API_URL = "https://api.api-ninjas.com/v1/sentiment";
    private static final String API_KEY = MainApp.getEnv("SENTIMENT_API_KEY");
    private final HttpClient client = HttpClient.newHttpClient();

    public SentimentResult analyseSentiment(String text) throws Exception {
        String encoded = URLEncoder.encode(text, StandardCharsets.UTF_8);
        String url = API_URL + "?text=" + encoded;

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .header("X-Api-Key", API_KEY)
                .GET()
                .build();

        HttpResponse<String> response = client.send(request,
                HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("Sentiment API error: " + response.statusCode());
        }

        JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
        String sentiment = json.get("sentiment").getAsString();
        double score = json.get("score").getAsDouble();

        String label;
        double pos, neg, neutral;
        switch (sentiment) {
            case "POSITIVE":
                label = "pos"; pos = score; neg = 1 - score; neutral = 0.1; break;
            case "NEGATIVE":
                label = "neg"; pos = 1 - score; neg = score; neutral = 0.1; break;
            default:
                label = "neutral"; pos = 0.3; neg = 0.3; neutral = 0.4; break;
        }

        return new SentimentResult(label, pos, neg, neutral);
    }

    // ── Inner class — kept exactly as your original ──────────────────────────
    public static class SentimentResult {
        private final String label;
        private final double positive;
        private final double negative;
        private final double neutral;

        public SentimentResult(String label, double positive, double negative, double neutral) {
            this.label = label;
            this.positive = positive;
            this.negative = negative;
            this.neutral = neutral;
        }

        public String getLabel() { return label; }
        public double getPositive() { return positive; }
        public double getNegative() { return negative; }
        public double getNeutral() { return neutral; }

        public String getDisplayText() {
            switch (label) {
                case "pos": return "😊 Positif";
                case "neg": return "😞 Négatif";
                default:    return "😐 Neutre";
            }
        }
    }
}