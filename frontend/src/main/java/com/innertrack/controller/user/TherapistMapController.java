package com.innertrack.controller.user;

import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import com.sothawo.mapjfx.Coordinate;
import com.sothawo.mapjfx.MapType;
import com.sothawo.mapjfx.MapView;
import com.sothawo.mapjfx.Marker;
import com.sothawo.mapjfx.XYZParam;
import com.sothawo.mapjfx.event.MarkerEvent;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.VBox;

import java.net.URL;
import java.sql.SQLException;
import java.util.ArrayList;
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
    private final MessagingDao messagingDao = new MessagingDao();

    // 🔒 Cached data (KEY FIX)
    private List<TherapistProfile> cachedTherapists;
    private final List<Marker> activeMarkers = new ArrayList<>();

    private final Map<String, TherapistProfile> markerIdToProfile = new HashMap<>();

    private TherapistProfile selectedProfile;

    // ──────────────────────────────────────────────

    @FXML
    public void initialize() {
        initInfoCardEmpty();
        configureMap();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("user/dashboard");
    }

    // ──────────────────────────────────────────────
    // MAP CONFIGURATION
    // ──────────────────────────────────────────────

    private void configureMap() {
        XYZParam xyzParam = new XYZParam()
                .withUrl(OSM_ENGLISH_TILES)
                .withAttributions("© OpenStreetMap contributors")
                .withMaxZoom(19);

        mapView.setXYZParam(xyzParam);

        mapView.initializedProperty().addListener((obs, oldV, initialized) -> {
            if (!initialized)
                return;

            mapView.setMapType(MapType.XYZ);
            mapView.setCenter(TUNISIA_CENTER);
            mapView.setZoom(TUNISIA_OVERVIEW_ZOOM);

            wireMarkerClicks();
            loadTherapistsOnce();
        });

        // 🔁 CRITICAL FIX: re-render markers on zoom
        mapView.zoomProperty().addListener((obs, oldZ, newZ) -> {
            if (cachedTherapists != null) {
                refreshMarkers();
            }
        });

        mapView.setOnContextMenuRequested(e -> e.consume());
        mapView.initialize();
    }

    // ──────────────────────────────────────────────
    // DATA LOADING
    // ──────────────────────────────────────────────

    private void loadTherapistsOnce() {
        Thread t = new Thread(() -> {
            cachedTherapists = profileDao.findAllWithLocation();
            Platform.runLater(this::refreshMarkers);
        }, "load-therapists-thread");

        t.setDaemon(true);
        t.start();
    }

    // ──────────────────────────────────────────────
    // MARKER MANAGEMENT (THE REAL FIX)
    // ──────────────────────────────────────────────

    private void refreshMarkers() {
        // Remove existing markers first
        for (Marker marker : activeMarkers) {
            mapView.removeMarker(marker);
        }
        activeMarkers.clear();
        markerIdToProfile.clear();

        URL icon = getClass().getResource("/Images/circle-pink.svg");
        if (icon == null) {
            System.err.println("❌ Missing marker icon: /Images/circle-pink.svg");
            return;
        }

        for (TherapistProfile t : cachedTherapists) {
            if (!t.hasLocation())
                continue;

            Marker m = new Marker(icon, -11, -11)
                    .setPosition(new Coordinate(
                            t.getLatitude(),
                            t.getLongitude()))
                    .setVisible(true);

            mapView.addMarker(m);
            activeMarkers.add(m);
            markerIdToProfile.put(m.getId(), t);
        }
    }

    private void wireMarkerClicks() {
        mapView.addEventHandler(MarkerEvent.MARKER_CLICKED, e -> {
            Marker m = e.getMarker();
            if (m == null)
                return;

            TherapistProfile profile = markerIdToProfile.get(m.getId());
            if (profile != null) {
                showTherapist(profile);
            }
        });
    }

    @FXML
    private javafx.scene.shape.Circle profileCircle;

    // ──────────────────────────────────────────────
    // INFO CARD
    // ──────────────────────────────────────────────

    private void initInfoCardEmpty() {
        nameLabel.setText("Choisissez un thérapeute");
        specializationLabel.setText("Cliquez sur un marqueur pour voir les détails.");
        addressLabel.setText("");
        bioLabel.setText("");
        contactButton.setDisable(true);
        if (profileCircle != null) {
            profileCircle.setFill(javafx.scene.paint.Color.web("#ecf0f1"));
        }
    }

    private void showTherapist(TherapistProfile profile) {
        selectedProfile = profile;

        contactButton.setText("Contacter");
        contactButton.setDisable(false);

        User client = SessionManager.getInstance().getCurrentUser();
        if (messagingDao.contactRequestExists(client.getId(), profile.getUserId())) {
            contactButton.setText("✓ Demande envoyée");
            contactButton.setDisable(true);
        }

        nameLabel.setText("Chargement…");
        specializationLabel.setText("");
        addressLabel.setText("");
        bioLabel.setText("");

        new Thread(() -> {
            try {
                User user = userDao.read(profile.getUserId());
                Platform.runLater(() -> {
                    nameLabel.setText(user != null ? user.getFullName() : "Thérapeute");
                    specializationLabel.setText(format("🩺 ", profile.getSpecialization()));
                    addressLabel.setText(format("📍 ", profile.getAddress()));
                    bioLabel.setText(profile.getBio() == null || profile.getBio().isBlank()
                            ? "Aucune bio renseignée."
                            : profile.getBio());

                    if (user != null && profileCircle != null) {
                        String picPath = user.getProfilePicture();
                        try {
                            javafx.scene.image.Image image;
                            if (picPath == null || picPath.isEmpty()) {
                                image = new javafx.scene.image.Image(getClass().getResource("/images/user.png").toExternalForm());
                                profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                            } else if (picPath.startsWith("http://") || picPath.startsWith("https://")) {
                                image = new javafx.scene.image.Image(picPath, true);
                                image.progressProperty().addListener((obs, o, n) -> {
                                    if (n.doubleValue() == 1.0 && !image.isError()) {
                                        profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                                    }
                                });
                                if (image.getProgress() == 1.0 && !image.isError()) {
                                    profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                                }
                            } else {
                                java.io.File file = new java.io.File(picPath);
                                if (file.exists()) {
                                    image = new javafx.scene.image.Image(file.toURI().toString());
                                    if (!image.isError()) {
                                        profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                                    }
                                }
                            }
                        } catch (Exception ignored) {}
                    }
                });
            } catch (SQLException e) {
                Platform.runLater(() -> {
                    nameLabel.setText("Erreur");
                    specializationLabel.setText("Impossible de charger les infos.");
                });
            }
        }, "load-therapist-thread").start();

    }

    // ──────────────────────────────────────────────
    // CONTACT
    // ──────────────────────────────────────────────

    @FXML
    private void handleContact() {
        if (selectedProfile == null)
            return;

        User client = SessionManager.getInstance().getCurrentUser();

        boolean sent = messagingDao.sendContactRequest(
                client.getId(),
                selectedProfile.getUserId(),
                "Bonjour, je souhaite prendre contact avec vous.");

        if (sent) {
            contactButton.setText("✓ Demande envoyée");
            contactButton.setDisable(true);
            showAlert("Demande envoyée",
                    "Votre demande a été envoyée au thérapeute.");
        } else {
            showAlert("Erreur",
                    "Impossible d'envoyer la demande.");
        }
    }

    // ──────────────────────────────────────────────

    private static String format(String prefix, String value) {
        return value == null || value.isBlank()
                ? prefix + "—"
                : prefix + value.trim();
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }
}