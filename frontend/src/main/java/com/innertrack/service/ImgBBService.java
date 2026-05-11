package com.innertrack.service;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.innertrack.app.MainApp;

import java.io.File;
import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.file.Files;
import java.util.Base64;

/**
 * Uploads images to ImgBB and returns the hosted URL.
 * Mirrors the approach used in the Symfony backend
 * (UserProfileController#uploadPicture).
 */
public class ImgBBService {

    private static final String API_URL = "https://api.imgbb.com/1/upload";
    private static final String API_KEY = MainApp.getEnv("IMGBB_API_KEY");
    private final HttpClient client = HttpClient.newHttpClient();

    private static ImgBBService instance;

    public static ImgBBService getInstance() {
        if (instance == null) {
            instance = new ImgBBService();
        }
        return instance;
    }

    /**
     * Uploads a local file to ImgBB.
     *
     * @param imageFile the local image file to upload
     * @return the public URL of the uploaded image
     * @throws IOException          if the file cannot be read
     * @throws InterruptedException if the HTTP request is interrupted
     * @throws RuntimeException     if the API returns an error
     */
    public String upload(File imageFile) throws IOException, InterruptedException {
        if (API_KEY == null || API_KEY.isBlank()) {
            throw new RuntimeException("IMGBB_API_KEY is not set in .env");
        }

        // ImgBB expects the image as a base64-encoded string in a form field
        byte[] fileBytes = Files.readAllBytes(imageFile.toPath());
        String base64Image = Base64.getEncoder().encodeToString(fileBytes);

        // Build multipart/form-data body
        String boundary = "----InnerTrack" + System.currentTimeMillis();
        String body = buildMultipartBody(boundary, base64Image, imageFile.getName());

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(API_URL + "?key=" + API_KEY))
                .header("Content-Type", "multipart/form-data; boundary=" + boundary)
                .POST(HttpRequest.BodyPublishers.ofString(body))
                .build();

        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new RuntimeException("ImgBB upload failed (HTTP " + response.statusCode() + "): " + response.body());
        }

        JsonObject json = JsonParser.parseString(response.body()).getAsJsonObject();
        if (!json.get("success").getAsBoolean()) {
            String errorMsg = json.has("error")
                    ? json.getAsJsonObject("error").get("message").getAsString()
                    : "Unknown error";
            throw new RuntimeException("ImgBB upload failed: " + errorMsg);
        }

        return json.getAsJsonObject("data").get("url").getAsString();
    }

    private String buildMultipartBody(String boundary, String base64Image, String fileName) {
        StringBuilder sb = new StringBuilder();

        // image field (base64)
        sb.append("--").append(boundary).append("\r\n");
        sb.append("Content-Disposition: form-data; name=\"image\"\r\n\r\n");
        sb.append(base64Image).append("\r\n");

        // optional name field
        sb.append("--").append(boundary).append("\r\n");
        sb.append("Content-Disposition: form-data; name=\"name\"\r\n\r\n");
        sb.append(fileName).append("\r\n");

        // closing boundary
        sb.append("--").append(boundary).append("--\r\n");

        return sb.toString();
    }
}
