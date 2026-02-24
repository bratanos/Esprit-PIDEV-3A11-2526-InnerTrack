package com.innertrack.controller.user;

import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.util.ViewManager;
import javafx.concurrent.Worker;
import javafx.fxml.FXML;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;

import java.io.File;
import java.util.List;

public class TherapistMapController {

    @FXML
    private WebView mapWebView;

    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private final UserDao userDao = new UserDao();

    @FXML
    public void initialize() {
        List<TherapistProfile> therapists = profileDao.findAllWithLocation();

        WebEngine engine = mapWebView.getEngine();
        engine.setJavaScriptEnabled(true);

        // Fix flickering: disable JavaFX node caching on the WebView
        mapWebView.setCache(false);
        mapWebView.setCacheHint(javafx.scene.CacheHint.SPEED);
        mapWebView.setContextMenuEnabled(false);

        engine.getLoadWorker().stateProperty().addListener((obs, old, newState) -> {
            if (newState == Worker.State.SUCCEEDED) {
                // Inject each therapist marker after map is ready
                for (TherapistProfile t : therapists) {
                    String name = getTherapistName(t.getUserId());
                    String spec = t.getSpecialization() != null ? t.getSpecialization() : "Psychologue";
                    String addr = t.getAddress() != null ? t.getAddress() : "";
                    // Escape single quotes
                    name = name.replace("'", "\\'").replace("\n", " ");
                    spec = spec.replace("'", "\\'");
                    addr = addr.replace("'", "\\'");
                    engine.executeScript(String.format(
                            "addTherapist(%f, %f, '%s', '%s', '%s');",
                            t.getLatitude(), t.getLongitude(), name, spec, addr));
                }
            }
        });

        try {
            File mapFile = writeTempMapFile(buildMapHtml(therapists));
            engine.load(mapFile.toURI().toString());
        } catch (Exception e) {
            System.err.println("Failed to write map temp file: " + e.getMessage());
        }
    }

    private File writeTempMapFile(String html) throws Exception {
        File temp = File.createTempFile("innertrack_map_", ".html");
        temp.deleteOnExit();
        try (java.io.FileWriter fw = new java.io.FileWriter(temp, java.nio.charset.StandardCharsets.UTF_8)) {
            fw.write(html);
        }
        return temp;
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("user/dashboard");
    }

    private String getTherapistName(int userId) {
        try {
            User user = userDao.read(userId);
            return user != null ? user.getFullName() : "Thérapeute";
        } catch (Exception e) {
            return "Thérapeute";
        }
    }

    private String buildMapHtml(List<TherapistProfile> therapists) {
        double centerLat = 34.7406;
        double centerLng = 10.7603;
        if (!therapists.isEmpty()) {
            centerLat = therapists.get(0).getLatitude();
            centerLng = therapists.get(0).getLongitude();
        }

        String leafletJs  = getClass().getResource("/leaflet/leaflet.js").toExternalForm();
        String leafletCss = getClass().getResource("/leaflet/leaflet.css").toExternalForm();

        return "<!DOCTYPE html><html><head>" +
                "<meta charset='utf-8'/>" +
                "<link rel='stylesheet' href='" + leafletCss + "'/>" +
                "<script src='" + leafletJs + "'></script>" +
                "<style>" +
                "  * { margin:0; padding:0; box-sizing:border-box; }" +
                "  html, body, #map { width:100%; height:100%; }" +
                "  .popup-box { font-family:'Segoe UI',sans-serif; min-width:170px; }" +
                "  .popup-box h3 { color:#C2185B; font-size:15px; margin-bottom:6px; }" +
                "  .popup-box .chip {" +
                "    display:inline-block; background:#FCE4EC; color:#C2185B;" +
                "    border-radius:12px; padding:2px 10px; font-size:12px;" +
                "  }" +
                "  .popup-box .addr { color:#666; font-size:12px; margin-top:6px; }" +
                "</style></head><body>" +
                "<div id='map'></div>" +
                "<script>" +
                "  var map = L.map('map', {" +
                "    preferCanvas: true," +
                "    zoomAnimation: false," +
                "    markerZoomAnimation: false" +
                "  }).setView([" + centerLat + "," + centerLng + "], 12);" +

                "  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {" +
                "    attribution: '© OpenStreetMap contributors'," +
                "    maxZoom: 19," +
                "    updateWhenIdle: false," +
                "    updateWhenZooming: false," +
                "    keepBuffer: 4," +
                "    crossOrigin: true" +
                "  }).addTo(map);" +

                "  var pinkIcon = L.divIcon({" +
                "    html: '<div style=\"width:22px;height:22px;background:#FF69B4;" +
                "           border:3px solid #C2185B;border-radius:50%;" +
                "           box-shadow:0 2px 8px rgba(194,24,91,0.4);\"></div>'," +
                "    className:''," +
                "    iconSize:[22,22]," +
                "    iconAnchor:[11,11]" +
                "  });" +

                "  var infoWindow = null;" +

                "  function addTherapist(lat, lng, name, spec, addr) {" +
                "    var marker = L.marker([lat, lng], {icon: pinkIcon}).addTo(map);" +
                "    var popup = '<div class=\"popup-box\">' +" +
                "      '<h3>' + name + '</h3>' +" +
                "      '<span class=\"chip\">' + spec + '</span>' +" +
                "      (addr ? '<p class=\"addr\">📍 ' + addr + '</p>' : '') +" +
                "      '</div>';" +
                "    marker.bindPopup(popup, {maxWidth: 250});" +
                "    marker.on('mouseover', function() { this.openPopup(); });" +
                "  }" +
                "</script>" +
                "</body></html>";
    }
}