package com.innertrack.controller.user;

import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.util.ViewManager;
import com.sothawo.mapjfx.Coordinate;
import com.sothawo.mapjfx.MapType;
import com.sothawo.mapjfx.MapView;
import com.sothawo.mapjfx.Marker;
import com.sothawo.mapjfx.XYZParam;
import com.sothawo.mapjfx.event.MarkerEvent;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.VBox;

import java.net.URL;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class TherapistMapController {

    private static final Coordinate TUNISIA_CENTER = new Coordinate(33.8869, 9.5375);
    private static final double TUNISIA_OVERVIEW_ZOOM = 6;
    private static final String OSM_ENGLISH_TILES = "https://tile.openstreetmap.org/{z}/{x}/{y}.png";

    @FXML
    private MapView mapView;

    @FXML
    private VBox infoCard;

    @FXML
    private Label nameLabel;

    @FXML
    private Label specializationLabel;

    @FXML
    private Label addressLabel;

    @FXML
    private Label bioLabel;

    @FXML
    private Button contactButton;

    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private final UserDao userDao = new UserDao();

    private final Map<String, TherapistProfile> markerIdToProfile = new HashMap<>();

    @FXML
    public void initialize() {
        initInfoCardEmpty();
        configureMap();
        wireMarkerClicks();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("user/dashboard");
    }

    @FXML
    private void handleContact() {
        contactButton.setText("Bientôt disponible");
        contactButton.setDisable(true);
    }

    private void configureMap() {
        XYZParam xyzParam = new XYZParam()
                .withUrl(OSM_ENGLISH_TILES)
                .withAttributions("© OpenStreetMap contributors")
                .withMaxZoom(19);

        mapView.setMapType(MapType.XYZ);
        mapView.setXYZParam(xyzParam);

        mapView.initializedProperty().addListener((obs, oldV, initialized) -> {
            if (!initialized) {
                return;
            }
            mapView.setCenter(TUNISIA_CENTER);
            mapView.setZoom(TUNISIA_OVERVIEW_ZOOM);
            loadTherapistsOnMap();
        });

        mapView.initialize();
    }

    private void loadTherapistsOnMap() {
        Thread t = new Thread(() -> {
            List<TherapistProfile> therapists = profileDao.findAllWithLocation();
            Platform.runLater(() -> addMarkers(therapists));
        }, "load-therapists-thread");
        t.setDaemon(true);
        t.start();
    }

    private void addMarkers(List<TherapistProfile> therapists) {
        URL circleUrl = getClass().getResource("/Images/circle-pink.svg");
        if (circleUrl == null) {
            System.err.println("Missing resource: /Images/circle-pink.svg");
            return;
        }

        for (TherapistProfile t : therapists) {
            if (!t.hasLocation()) {
                continue;
            }
            Coordinate c = new Coordinate(t.getLatitude(), t.getLongitude());
            Marker m = new Marker(circleUrl, -10, -10)
                    .setPosition(c)
                    .setVisible(true);
            mapView.addMarker(m);
            markerIdToProfile.put(m.getId(), t);
        }
    }

    private void wireMarkerClicks() {
        mapView.addEventHandler(MarkerEvent.MARKER_CLICKED, e -> {
            Marker m = e.getMarker();
            if (m == null) {
                return;
            }
            TherapistProfile p = markerIdToProfile.get(m.getId());
            if (p == null) {
                return;
            }
            showTherapist(p);
        });
    }

    private void initInfoCardEmpty() {
        nameLabel.setText("Choisissez un thérapeute");
        specializationLabel.setText("Cliquez sur un marqueur rose pour voir les détails.");
        addressLabel.setText("");
        bioLabel.setText("");
        contactButton.setDisable(true);
    }

    private void showTherapist(TherapistProfile profile) {
        contactButton.setDisable(false);
        contactButton.setText("Contacter");

        nameLabel.setText("Chargement…");
        specializationLabel.setText("");
        addressLabel.setText("");
        bioLabel.setText("");

        Thread t = new Thread(() -> {
            try {
                User user = userDao.read(profile.getUserId());
                String fullName = user != null ? user.getFullName() : "Thérapeute";
                String spec = safe(profile.getSpecialization());
                String addr = safe(profile.getAddress());
                String bio = safe(profile.getBio());

                Platform.runLater(() -> {
                    nameLabel.setText(fullName);
                    specializationLabel.setText(spec.isBlank() ? "Spécialisation: —" : "Spécialisation: " + spec);
                    addressLabel.setText(addr.isBlank() ? "Adresse: —" : "Adresse: " + addr);
                    bioLabel.setText(bio.isBlank() ? "Bio: —" : bio);
                });
            } catch (Exception ex) {
                Platform.runLater(() -> {
                    nameLabel.setText("Erreur");
                    specializationLabel.setText(ex.getMessage());
                });
            }
        }, "load-therapist-thread");
        t.setDaemon(true);
        t.start();
    }

    private static String safe(String s) {
        return s == null ? "" : s.trim();
    }
}