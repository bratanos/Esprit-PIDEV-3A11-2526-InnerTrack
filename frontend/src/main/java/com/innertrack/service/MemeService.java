package com.innertrack.service;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

/**
 * Fetches random meme images from the imgflip API.
 */
public class MemeService {

    private static final String API_URL = "https://api.imgflip.com/get_memes";
    private final HttpClient httpClient = HttpClient.newHttpClient();

    /**
     * Returns the URL of a random meme image.
     */
    public String getRandomMemeUrl() {
        try {
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(URI.create(API_URL))
                    .GET()
                    .build();

            HttpResponse<String> response = httpClient.send(request,
                    HttpResponse.BodyHandlers.ofString());

            if (response.statusCode() == 200) {
                JsonObject root = JsonParser.parseString(response.body()).getAsJsonObject();
                if (root.get("success").getAsBoolean()) {
                    JsonArray memes = root.getAsJsonObject("data").getAsJsonArray("memes");
                    if (!memes.isEmpty()) {
                        int idx = (int) (Math.random() * memes.size());
                        return memes.get(idx).getAsJsonObject().get("url").getAsString();
                    }
                }
            }
        } catch (Exception e) {
            System.err.println("Meme API error: " + e.getMessage());
        }
        return null;
    }
}
