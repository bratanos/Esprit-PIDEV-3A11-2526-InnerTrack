package com.innertrack.service;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.innertrack.dto.WeatherInfo;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.time.Duration;
import java.util.concurrent.CompletableFuture;
import com.innertrack.dto.ForecastDay;
import com.fasterxml.jackson.databind.JsonNode;

import java.time.Instant;
import java.time.LocalDate;
import java.time.ZoneId;
import java.util.*;

public class OpenWeatherService {

    private final HttpClient http = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(6))
            .build();

    private final ObjectMapper mapper = new ObjectMapper();

    private final String apiKey;
    private final String city;
    private final String units;
    private final String lang;

    public OpenWeatherService(String apiKey, String city, String units, String lang) {
        this.apiKey = apiKey;
        this.city = city;
        this.units = units;
        this.lang = lang;
    }

    public CompletableFuture<WeatherInfo> fetchCurrent() {
        if (apiKey == null || apiKey.isBlank()) {
            return CompletableFuture.failedFuture(new IllegalStateException("OpenWeather apiKey is missing"));
        }

        String q = URLEncoder.encode(city, StandardCharsets.UTF_8);
        String url = "https://api.openweathermap.org/data/2.5/weather?q=" + q +
                "&appid=" + URLEncoder.encode(apiKey, StandardCharsets.UTF_8) +
                "&units=" + URLEncoder.encode(units, StandardCharsets.UTF_8) +
                "&lang=" + URLEncoder.encode(lang, StandardCharsets.UTF_8);

        HttpRequest req = HttpRequest.newBuilder(URI.create(url))
                .timeout(Duration.ofSeconds(8))
                .GET()
                .build();

        return http.sendAsync(req, HttpResponse.BodyHandlers.ofString())
                .thenApply(resp -> {
                    if (resp.statusCode() != 200) {
                        throw new RuntimeException("OpenWeather error: HTTP " + resp.statusCode() + " body=" + resp.body());
                    }
                    return resp.body();
                })
                .thenApply(this::parseCurrent);
    }

    private WeatherInfo parseCurrent(String json) {
        try {
            JsonNode root = mapper.readTree(json);

            String name = root.path("name").asText(city);
            double temp = root.path("main").path("temp").asDouble();
            int humidity = root.path("main").path("humidity").asInt();
            double wind = root.path("wind").path("speed").asDouble();

            JsonNode w0 = root.path("weather").isArray() && root.path("weather").size() > 0
                    ? root.path("weather").get(0)
                    : null;

            String desc = (w0 != null) ? w0.path("description").asText("") : "";
            String icon = (w0 != null) ? w0.path("icon").asText("") : "";

            return new WeatherInfo(name, temp, humidity, wind, desc, icon);

        } catch (Exception e) {
            throw new RuntimeException("Failed to parse OpenWeather JSON", e);
        }
    }

    public static String iconUrl(String iconId) {
        return "https://openweathermap.org/img/wn/" + iconId + "@2x.png";
    }

    public CompletableFuture<List<ForecastDay>> fetchWeekDaily() {
        if (apiKey == null || apiKey.isBlank()) {
            return CompletableFuture.failedFuture(new IllegalStateException("OpenWeather apiKey is missing"));
        }

        String q = URLEncoder.encode(city, StandardCharsets.UTF_8);
        String url = "https://api.openweathermap.org/data/2.5/forecast?q=" + q +
                "&appid=" + URLEncoder.encode(apiKey, StandardCharsets.UTF_8) +
                "&units=" + URLEncoder.encode(units, StandardCharsets.UTF_8) +
                "&lang=" + URLEncoder.encode(lang, StandardCharsets.UTF_8);

        HttpRequest req = HttpRequest.newBuilder(URI.create(url))
                .timeout(Duration.ofSeconds(10))
                .GET()
                .build();

        return http.sendAsync(req, HttpResponse.BodyHandlers.ofString())
                .thenApply(resp -> {
                    if (resp.statusCode() != 200) {
                        throw new RuntimeException("OpenWeather forecast error: HTTP " + resp.statusCode());
                    }
                    return resp.body();
                })
                .thenApply(this::parseForecastToDaily);
    }

    private List<ForecastDay> parseForecastToDaily(String json) {
        try {
            JsonNode root = mapper.readTree(json);
            JsonNode list = root.path("list");
            if (!list.isArray() || list.size() == 0) return List.of();

            // Group points by LocalDate
            Map<LocalDate, DayAgg> agg = new TreeMap<>();

            for (JsonNode item : list) {
                long dt = item.path("dt").asLong(0);
                if (dt == 0) continue;

                // dt is in UTC seconds
                LocalDate day = Instant.ofEpochSecond(dt).atZone(ZoneId.systemDefault()).toLocalDate();

                double tempMin = item.path("main").path("temp_min").asDouble(Double.NaN);
                double tempMax = item.path("main").path("temp_max").asDouble(Double.NaN);

                JsonNode w0 = item.path("weather").isArray() && item.path("weather").size() > 0
                        ? item.path("weather").get(0)
                        : null;
                String desc = (w0 != null) ? w0.path("description").asText("") : "";

                agg.computeIfAbsent(day, d -> new DayAgg(d))
                        .accept(tempMin, tempMax, desc);
            }

            List<ForecastDay> out = new ArrayList<>();
            for (DayAgg d : agg.values()) {
                out.add(new ForecastDay(d.date, d.min, d.max, d.bestDesc()));
            }
            return out;

        } catch (Exception e) {
            throw new RuntimeException("Failed to parse forecast JSON", e);
        }
    }

    private static class DayAgg {
        final LocalDate date;
        double min = Double.POSITIVE_INFINITY;
        double max = Double.NEGATIVE_INFINITY;
        final Map<String, Integer> descCount = new HashMap<>();

        DayAgg(LocalDate date) { this.date = date; }

        void accept(double tMin, double tMax, String desc) {
            if (!Double.isNaN(tMin)) min = Math.min(min, tMin);
            if (!Double.isNaN(tMax)) max = Math.max(max, tMax);
            if (desc != null && !desc.isBlank()) {
                descCount.merge(desc, 1, Integer::sum);
            }
        }

        String bestDesc() {
            return descCount.entrySet().stream()
                    .max(Map.Entry.comparingByValue())
                    .map(Map.Entry::getKey)
                    .orElse("");
        }
    }
}