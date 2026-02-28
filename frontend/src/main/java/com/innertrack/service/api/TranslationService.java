package com.innertrack.service.api;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;

public class TranslationService {

    private static final String API_URL = "https://api.mymemory.translated.net/get";

    public String translateToFrench(String text) throws Exception {
        return translate(text, "en|fr");
    }

    public String translateToEnglish(String text) throws Exception {
        return translate(text, "fr|en");
    }

    private String translate(String text, String langPair) throws Exception {
        String encodedText = URLEncoder.encode(text, StandardCharsets.UTF_8);
        String encodedLangPair = URLEncoder.encode(langPair, StandardCharsets.UTF_8);

        String url = API_URL + "?q=" + encodedText + "&langpair=" + encodedLangPair;

        HttpClient client = HttpClient.newHttpClient();
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .header("Accept", "application/json")
                .build();

        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("Erreur traduction : code " + response.statusCode());
        }

        JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
        JsonObject responseData = json.getAsJsonObject("responseData");
        return responseData.get("translatedText").getAsString();
    }
}
