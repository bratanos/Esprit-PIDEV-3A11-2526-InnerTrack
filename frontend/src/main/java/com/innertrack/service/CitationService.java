package com.innertrack.service;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import com.google.gson.JsonArray;
import com.google.gson.JsonParser;

public class CitationService {

    private static final String API_URL = "https://zenquotes.io/api/random";
    private final HttpClient httpClient = HttpClient.newHttpClient();

    public String getCitationDuJour() {
        try {
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(URI.create(API_URL))
                    .GET()
                    .build();

            HttpResponse<String> response = httpClient.send(request,
                    HttpResponse.BodyHandlers.ofString());

            if (response.statusCode() == 200) {
                JsonArray array = JsonParser.parseString(response.body()).getAsJsonArray();
                if (!array.isEmpty()) {
                    var obj = array.get(0).getAsJsonObject();
                    String content = obj.get("q").getAsString();
                    String author = obj.get("a").getAsString();
                    return "\"" + content + "\"\n— " + author;
                }
            }
        } catch (Exception e) {
            System.err.println("Citation API error: " + e.getMessage());
        }
        return "\"La seule façon de faire du bon travail est d'aimer ce que vous faites.\"\n— Steve Jobs";
    }
}
