package com.innertrack.service.api;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.innertrack.model.Sound;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.List;

public class FreesoundService {

    private static final String API_URL = "https://freesound.org/apiv2/search/text/";
    private final String apiKey;
    private final HttpClient client = HttpClient.newHttpClient();
    private final TranslationService translationService;

    public FreesoundService(String apiKey) {
        this.apiKey = apiKey;
        this.translationService = new TranslationService();
    }

    public List<Sound> searchByKeywords(List<String> keywords, int maxResults) throws Exception {
        if (keywords == null || keywords.isEmpty())
            return List.of();

        String frenchQuery = keywords.stream()
                .limit(10)
                .collect(java.util.stream.Collectors.joining(" "));

        String query;
        try {
            query = translationService.translateToEnglish(frenchQuery);
        } catch (Exception e) {
            query = frenchQuery;
        }

        query = simplifyForFreesound(query);

        String encodedQuery = URLEncoder.encode(query, StandardCharsets.UTF_8);
        String url = API_URL + "?query=" + encodedQuery +
                "&fields=id,name,previews,username,duration" +
                "&page_size=" + maxResults +
                "&token=" + apiKey;

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .header("Accept", "application/json")
                .header("Authorization", "Token " + apiKey)
                .build();

        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("Erreur API Freesound : code " + response.statusCode());
        }

        JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
        JsonArray results = json.getAsJsonArray("results");

        if ((results == null || results.size() == 0) && keywords.size() > 1) {
            return searchByKeywords(List.of(keywords.get(0)), maxResults);
        }

        List<Sound> sounds = new ArrayList<>();
        if (results != null) {
            for (int i = 0; i < results.size(); i++) {
                JsonObject item = results.get(i).getAsJsonObject();
                Sound sound = new Sound();
                sound.setId(item.get("id").getAsInt());
                sound.setName(item.get("name").getAsString());
                sound.setUsername(item.get("username").getAsString());
                sound.setDuration(item.get("duration").getAsDouble());

                if (item.has("previews") && !item.get("previews").isJsonNull()) {
                    JsonObject previews = item.getAsJsonObject("previews");
                    String previewUrl = null;
                    if (previews.has("preview-hq-mp3") && !previews.get("preview-hq-mp3").isJsonNull()) {
                        previewUrl = previews.get("preview-hq-mp3").getAsString();
                    } else if (previews.has("preview-lq-mp3") && !previews.get("preview-lq-mp3").isJsonNull()) {
                        previewUrl = previews.get("preview-lq-mp3").getAsString();
                    }
                    if (previewUrl != null) {
                        sound.setPreviewUrl(previewUrl + "?token=" + apiKey);
                    }
                }
                sounds.add(sound);
            }
        }
        return sounds;
    }

    private String simplifyForFreesound(String englishTitle) {
        String cleaned = englishTitle
                .toLowerCase()
                .replaceAll("\\?|!|,|\\.", "")
                .replaceAll(
                        "\\b(how to|what is|why|when|where|who|which|the|a|an|to|on|in|at|for|of|and|or|with|by|from|about|is|are|was|were|do|does|did|can|could|should|would|daily|basis|manage|understand|learn|discover|improve|tips|guide|ways|best|make|use|using|your|our|my|their|its)\\b",
                        " ")
                .replaceAll("\\s+", " ")
                .trim();

        String[] words = cleaned.split("\\s+");
        StringBuilder result = new StringBuilder();
        int count = 0;
        for (String word : words) {
            if (word.length() > 3) {
                if (count > 0)
                    result.append(" ");
                result.append(word);
                count++;
                if (count >= 4)
                    break;
            }
        }

        String finalQuery = result.toString().trim();
        return finalQuery.isEmpty() ? "ambient" : finalQuery;
    }
}
