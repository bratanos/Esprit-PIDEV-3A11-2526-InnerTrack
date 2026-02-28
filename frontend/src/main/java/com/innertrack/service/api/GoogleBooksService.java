package com.innertrack.service.api;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.innertrack.model.Book;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.List;

public class GoogleBooksService {
    private static final String API_URL = "https://www.googleapis.com/books/v1/volumes";
    private final String apiKey;
    private final HttpClient client = HttpClient.newHttpClient();

    public GoogleBooksService(String apiKey) {
        this.apiKey = apiKey;
    }

    public List<Book> searchBooksByArticle(String articleTitle, int maxResults) throws Exception {
        String encodedTitle = URLEncoder.encode(articleTitle, StandardCharsets.UTF_8);
        String url = API_URL + "?q=" + encodedTitle
                + "&maxResults=" + maxResults
                + "&langRestrict=fr"
                + "&key=" + apiKey;

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .header("Accept", "application/json")
                .build();

        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("Erreur API Google Books : code " + response.statusCode());
        }

        JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
        JsonArray items = json.getAsJsonArray("items");
        List<Book> books = new ArrayList<>();

        if (items != null) {
            for (int i = 0; i < items.size(); i++) {
                JsonObject item = items.get(i).getAsJsonObject();
                JsonObject volumeInfo = item.getAsJsonObject("volumeInfo");

                Book book = new Book();
                book.setTitle(getJsonString(volumeInfo, "title"));
                book.setSubtitle(getJsonString(volumeInfo, "subtitle"));
                book.setDescription(getJsonString(volumeInfo, "description"));

                if (volumeInfo.has("authors")) {
                    JsonArray authors = volumeInfo.getAsJsonArray("authors");
                    List<String> authorList = new ArrayList<>();
                    for (int j = 0; j < authors.size(); j++) {
                        authorList.add(authors.get(j).getAsString());
                    }
                    book.setAuthors(authorList);
                }

                if (volumeInfo.has("imageLinks")) {
                    JsonObject images = volumeInfo.getAsJsonObject("imageLinks");
                    book.setThumbnailUrl(getJsonString(images, "thumbnail"));
                }

                book.setPreviewLink(getJsonString(volumeInfo, "previewLink"));
                books.add(book);
            }
        }
        return books;
    }

    private String getJsonString(JsonObject obj, String key) {
        return obj.has(key) && !obj.get(key).isJsonNull() ? obj.get(key).getAsString() : null;
    }
}
