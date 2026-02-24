package com.innertrack.controller.therapist;

import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.concurrent.Worker;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import netscape.javascript.JSObject;

import java.io.File;

public class TherapistLocationController {

    @FXML
    private WebView mapWebView;
    @FXML
    private TextField addressField;
    @FXML
    private Label coordsLabel;

    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private TherapistProfile profile;
    private WebEngine engine;

    private File writeTempMapFile(String html) throws Exception {
        File temp = File.createTempFile("innertrack_map_", ".html");
        temp.deleteOnExit();
        try (java.io.FileWriter fw = new java.io.FileWriter(temp, java.nio.charset.StandardCharsets.UTF_8)) {
            fw.write(html);
        }
        return temp;
    }

    @FXML
    public void initialize() {
        User user = SessionManager.getInstance().getCurrentUser();
        profile = profileDao.findByUserId(user.getId());
        if (profile == null) {
            profile = new TherapistProfile(user.getId());
            profileDao.create(profile);
        }

        if (profile.getAddress() != null)
            addressField.setText(profile.getAddress());
        if (profile.hasLocation()) {
            coordsLabel.setText(String.format("📍 %.6f, %.6f",
                    profile.getLatitude(), profile.getLongitude()));
        }

        engine = mapWebView.getEngine();
        engine.setJavaScriptEnabled(true);

        // Fix flickering: disable JavaFX node caching on the WebView
        mapWebView.setCache(false);
        mapWebView.setCacheHint(javafx.scene.CacheHint.SPEED);
        mapWebView.setContextMenuEnabled(false);

        engine.getLoadWorker().stateProperty().addListener((obs, old, newState) -> {
            if (newState == Worker.State.SUCCEEDED) {
                // Register Java bridge so JS can call back into Java
                JSObject window = (JSObject) engine.executeScript("window");
                window.setMember("javaBridge", this);

                // If profile already has a saved location, restore the marker
                if (profile.hasLocation()) {
                    engine.executeScript(String.format(
                            "restoreMarker(%f, %f);",
                            profile.getLatitude(), profile.getLongitude()));
                }
            }
        });

        try {
            File mapFile = writeTempMapFile(buildMapHtml());
            engine.load(mapFile.toURI().toString());
        } catch (Exception e) {
            System.err.println("Failed to write map temp file: " + e.getMessage());
        }
    }

    /**
     * Called FROM JavaScript when the user clicks the map.
     * Must be public — JavaFX JSObject bridge requires it.
     */
    public void onLocationPicked(double lat, double lng) {
        Platform.runLater(() -> {
            profile.setLatitude(lat);
            profile.setLongitude(lng);
            coordsLabel.setText(String.format("📍 %.6f, %.6f", lat, lng));
        });
    }



    @FXML
    private void handleSearchAddress() {
        String address = addressField.getText().trim();
        if (address.isEmpty())
            return;

        // Run geocoding on a background thread — Nominatim is HTTP
        new Thread(() -> {
            try {
                String encoded = java.net.URLEncoder.encode(address, "UTF-8");
                String url = "https://nominatim.openstreetmap.org/search?format=json&limit=1&q=" + encoded;

                java.net.HttpURLConnection conn = (java.net.HttpURLConnection) new java.net.URL(url).openConnection();
                // Nominatim requires a User-Agent header
                conn.setRequestProperty("User-Agent", "InnerTrack-JavaFX-App");
                conn.setConnectTimeout(5000);
                conn.setReadTimeout(5000);

                java.io.BufferedReader reader = new java.io.BufferedReader(
                        new java.io.InputStreamReader(conn.getInputStream()));
                StringBuilder sb = new StringBuilder();
                String line;
                while ((line = reader.readLine()) != null)
                    sb.append(line);
                reader.close();

                String json = sb.toString();
                // Parse lat/lon from the JSON manually (no external lib needed)
                // Response looks like: [{"lat":"36.8065","lon":"10.1815",...}]
                if (json.startsWith("[{")) {
                    double lat = parseJsonDouble(json, "lat");
                    double lon = parseJsonDouble(json, "lon");

                    Platform.runLater(() -> {
                        profile.setLatitude(lat);
                        profile.setLongitude(lon);
                        profile.setAddress(address);
                        addressField.setText(address);
                        coordsLabel.setText(String.format("📍 %.6f, %.6f", lat, lon));
                        engine.executeScript(String.format("panAndMark(%f, %f);", lat, lon));
                    });
                } else {
                    Platform.runLater(() -> showAlert("Adresse introuvable", "Essayez une adresse plus précise."));
                }
            } catch (Exception e) {
                Platform.runLater(
                        () -> showAlert("Erreur réseau", "Impossible de rechercher l'adresse : " + e.getMessage()));
            }
        }, "geocode-thread").start();
    }

    @FXML
    private void handleSave() {
        if (!profile.hasLocation()) {
            showAlert("Aucun emplacement",
                    "Veuillez cliquer sur la carte ou rechercher une adresse.");
            return;
        }
        String addr = addressField.getText().trim();
        if (!addr.isEmpty())
            profile.setAddress(addr);

        if (profileDao.update(profile)) {
            showAlert("Succès", "Emplacement enregistré !");
        } else {
            showAlert("Erreur", "Impossible d'enregistrer l'emplacement.");
        }
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("psychologue/dashboard");
    }

    // ── Map HTML ──────────────────────────────────────────────

    private String buildMapHtml() {
        double defaultLat = 34.7406;
        double defaultLng = 10.7603;

        // Get local resource paths
        String leafletJs  = getClass().getResource("/leaflet/leaflet.js").toExternalForm();
        String leafletCss = getClass().getResource("/leaflet/leaflet.css").toExternalForm();

        return "<!DOCTYPE html><html><head>" +
                "<meta charset='utf-8'/>" +
                "<link rel='stylesheet' href='" + leafletCss + "'/>" +
                "<script src='" + leafletJs + "'></script>" +
                "<style>" +
                "  * { margin:0; padding:0; box-sizing:border-box; }" +
                "  html, body, #map { width:100%; height:100%; }" +
                "  #hint {" +
                "    position:absolute; top:12px; left:50%; transform:translateX(-50%);" +
                "    background:rgba(255,255,255,0.95); padding:8px 18px;" +
                "    border-radius:20px; font:13px/1 sans-serif; color:#555;" +
                "    box-shadow:0 2px 8px rgba(0,0,0,0.18); z-index:1000;" +
                "    pointer-events:none;" +
                "  }" +
                "</style></head><body>" +
                "<div id='hint'>Cliquez sur la carte pour marquer votre cabinet</div>" +
                "<div id='map'></div>" +
                "<script>" +
                "  var map = L.map('map', {" +
                "    preferCanvas: true," +         // use canvas renderer — far fewer flicker issues
                "    zoomAnimation: false," +        // disable zoom animation — main flicker cause
                "    markerZoomAnimation: false" +
                "  }).setView([" + defaultLat + "," + defaultLng + "], 13);" +

                "  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {" +
                "    attribution: '© OpenStreetMap contributors'," +
                "    maxZoom: 19," +
                "    updateWhenIdle: false," +       // load tiles during drag, not after
                "    updateWhenZooming: false," +    // don't reload during zoom
                "    keepBuffer: 4," +              // keep more tiles in memory
                "    crossOrigin: true" +
                "  }).addTo(map);" +

                "  var pinkIcon = L.divIcon({" +
                "    html: '<div style=\"width:22px;height:22px;background:#FF69B4;" +
                "           border:3px solid #C2185B;border-radius:50%;" +
                "           box-shadow:0 2px 6px rgba(0,0,0,0.3);\"></div>'," +
                "    className:''," +
                "    iconSize:[22,22]," +
                "    iconAnchor:[11,11]" +
                "  });" +

                "  var marker = null;" +

                "  function placeMarker(lat, lng) {" +
                "    if (marker) map.removeLayer(marker);" +
                "    marker = L.marker([lat, lng], {icon: pinkIcon, draggable: true}).addTo(map);" +
                "    marker.on('dragend', function(e) {" +
                "      var pos = e.target.getLatLng();" +
                "      if (window.javaBridge) window.javaBridge.onLocationPicked(pos.lat, pos.lng);" +
                "    });" +
                "    if (window.javaBridge) window.javaBridge.onLocationPicked(lat, lng);" +
                "  }" +

                "  function restoreMarker(lat, lng) {" +
                "    placeMarker(lat, lng);" +
                "    map.setView([lat, lng], 15);" +
                "  }" +

                "  function panAndMark(lat, lng) {" +
                "    map.setView([lat, lng], 16);" +
                "    placeMarker(lat, lng);" +
                "  }" +

                "  map.on('click', function(e) {" +
                "    placeMarker(e.latlng.lat, e.latlng.lng);" +
                "  });" +
                "</script>" +
                "</body></html>";
    }

    // ── Helpers ───────────────────────────────────────────────

    /** Minimal JSON double parser — avoids needing Gson for a single field. */
    private double parseJsonDouble(String json, String key) {
        String search = "\"" + key + "\":\"";
        int start = json.indexOf(search) + search.length();
        int end = json.indexOf("\"", start);
        return Double.parseDouble(json.substring(start, end));
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }
}