package com.innertrack.controller.therapist;

import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import com.sothawo.mapjfx.Coordinate;
import com.sothawo.mapjfx.MapType;
import com.sothawo.mapjfx.MapView;
import com.sothawo.mapjfx.Marker;
import com.sothawo.mapjfx.XYZParam;
import com.sothawo.mapjfx.event.MapViewEvent;
import com.sothawo.mapjfx.event.MarkerEvent;
import io.redlink.geocoding.LatLon;
import io.redlink.geocoding.Place;
import io.redlink.geocoding.nominatim.NominatimGeocoder;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import java.net.URL;
import java.util.List;
import java.util.Locale;

public class TherapistLocationController {

    private static final Coordinate TUNISIA_CENTER = new Coordinate(33.8869, 9.5375);
    private static final double TUNISIA_OVERVIEW_ZOOM = 6;
    private static final double SEARCH_ZOOM = 15;
    private static final String OSM_ENGLISH_TILES = "https://tile.openstreetmap.org/{z}/{x}/{y}.png";

    @FXML
    private MapView mapView;
    @FXML
    private TextField addressField;
    @FXML
    private Label coordsLabel;

    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private TherapistProfile profile;
    private Marker clinicMarker;
    private volatile boolean draggingMarker = false;

    private final NominatimGeocoder geocoder = NominatimGeocoder.builder()
            .setUserAgent("InnerTrack-JavaFX-App")
            .setStaticHeader("User-Agent", "InnerTrack-JavaFX-App")
            .setStaticQueryParam("countrycodes", "tn")
            .setQueryRateLimit(1)
            .create();

    @FXML
    public void initialize() {
        User user = SessionManager.getInstance().getCurrentUser();
        profile = profileDao.findByUserId(user.getId());
        if (profile == null) {
            profile = new TherapistProfile(user.getId());
            profileDao.create(profile);
        }

        if (profile.getAddress() != null) {
            addressField.setText(profile.getAddress());
        }
        coordsLabel.setText(profile.hasLocation()
                ? formatCoords(profile.getLatitude(), profile.getLongitude())
                : "Aucun emplacement sélectionné");

        configureMap();
    }

    private void configureMap() {
        // XYZ params must be set BEFORE initialize()
        XYZParam xyzParam = new XYZParam()
                .withUrl(OSM_ENGLISH_TILES)
                .withAttributions("© OpenStreetMap contributors")
                .withMaxZoom(19);
        mapView.setXYZParam(xyzParam);

        // ALL map operations go inside this listener — never outside
        mapView.initializedProperty().addListener((obs, oldV, initialized) -> {
            if (!initialized)
                return;

            // Step 1: set map type AFTER initialization
            mapView.setMapType(MapType.XYZ);

            // Step 2: position the viewport
            if (profile.hasLocation()) {
                mapView.setCenter(new Coordinate(profile.getLatitude(), profile.getLongitude()));
                mapView.setZoom(SEARCH_ZOOM);
            } else {
                mapView.setCenter(TUNISIA_CENTER);
                mapView.setZoom(TUNISIA_OVERVIEW_ZOOM);
            }

            // Step 3: create and add marker now that map is ready
            setupMarker();

            // Step 4: wire click/drag events now that map is ready
            wireInteractions();
        });

        // Block context menu
        mapView.setOnContextMenuRequested(javafx.event.Event::consume);
        mapView.zoomProperty().addListener((obs, oldZ, newZ) -> {
            if (newZ != null && newZ.intValue() > 18)
                mapView.setZoom(18);
        });

        mapView.initialize();
    }

    private void setupMarker() {
        URL markerUrl = getClass().getResource("/Images/marker-pink.svg");
        if (markerUrl == null) {
            System.err.println("TherapistLocationController: missing /Images/marker-pink.svg");
            return;
        }
        clinicMarker = new Marker(markerUrl, -15, -45);

        if (profile.hasLocation()) {
            clinicMarker.setPosition(new Coordinate(profile.getLatitude(), profile.getLongitude()));
            clinicMarker.setVisible(true);
        } else {
            clinicMarker.setVisible(false);
        }

        mapView.addMarker(clinicMarker);
    }

    private void wireInteractions() {
        mapView.addEventHandler(MapViewEvent.MAP_CLICKED, e -> {
            if (draggingMarker)
                return;
            setClinicLocation(e.getCoordinate(), true);
            reverseGeocodeToAddress(e.getCoordinate());
        });

        mapView.addEventHandler(MapViewEvent.MAP_POINTER_MOVED, e -> {
            if (!draggingMarker || clinicMarker == null || !clinicMarker.getVisible())
                return;
            setClinicLocation(e.getCoordinate(), false);
        });

        mapView.addEventHandler(MarkerEvent.MARKER_MOUSEDOWN, e -> {
            if (clinicMarker != null && clinicMarker.equals(e.getMarker())) {
                draggingMarker = true;
            }
        });

        mapView.addEventHandler(MarkerEvent.MARKER_MOUSEUP, e -> {
            if (clinicMarker != null && clinicMarker.equals(e.getMarker())) {
                draggingMarker = false;
                if (clinicMarker.getPosition() != null) {
                    reverseGeocodeToAddress(clinicMarker.getPosition());
                }
            }
        });
    }

    @FXML
    private void handleSearchAddress() {
        String query = addressField.getText() == null ? "" : addressField.getText().trim();
        if (query.isBlank()) {
            showAlert("Adresse requise", "Veuillez saisir une adresse en Tunisie.");
            return;
        }
        new Thread(() -> {
            try {
                List<Place> places = geocoder.geocode(query, Locale.ENGLISH);
                if (places == null || places.isEmpty()) {
                    Platform.runLater(() -> showAlert("Adresse introuvable", "Essayez une adresse plus précise."));
                    return;
                }
                Place best = places.get(0);
                LatLon ll = best.getLatLon();
                Coordinate c = new Coordinate(ll.lat(), ll.lon());
                String address = best.getAddress();
                Platform.runLater(() -> {
                    addressField.setText(address);
                    setClinicLocation(c, true);
                    mapView.setCenter(c);
                    mapView.setZoom(SEARCH_ZOOM);
                });
            } catch (Exception ex) {
                Platform.runLater(
                        () -> showAlert("Erreur réseau", "Impossible de rechercher l'adresse : " + ex.getMessage()));
            }
        }, "geocode-thread").start();
    }

    @FXML
    private void handleSave() {
        if (!profile.hasLocation()) {
            showAlert("Aucun emplacement", "Veuillez cliquer sur la carte ou rechercher une adresse.");
            return;
        }
        String addr = addressField.getText() == null ? "" : addressField.getText().trim();
        if (!addr.isBlank()) {
            profile.setAddress(addr);
        }
        boolean ok = profileDao.update(profile);
        if (ok)
            showAlert("Succès", "Emplacement enregistré !");
        else
            showAlert("Erreur", "Impossible d'enregistrer l'emplacement.");
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("psychologue/dashboard");
    }

    private void setClinicLocation(Coordinate c, boolean ensureVisible) {
        if (clinicMarker == null)
            return;
        clinicMarker.setPosition(c);
        if (ensureVisible)
            clinicMarker.setVisible(true);
        profile.setLatitude(c.getLatitude());
        profile.setLongitude(c.getLongitude());
        coordsLabel.setText(formatCoords(c.getLatitude(), c.getLongitude()));
    }

    private void reverseGeocodeToAddress(Coordinate c) {
        new Thread(() -> {
            try {
                List<Place> places = geocoder.reverseGeocode(
                        LatLon.create(c.getLatitude(), c.getLongitude()), Locale.ENGLISH);
                String addr = (places != null && !places.isEmpty()) ? places.get(0).getAddress() : null;
                if (addr == null || addr.isBlank())
                    return;
                Platform.runLater(() -> {
                    addressField.setText(addr);
                    profile.setAddress(addr);
                });
            } catch (Exception ignored) {
            }
        }, "reverse-geocode-thread").start();
    }

    private static String formatCoords(double lat, double lng) {
        return String.format(Locale.US, "📍 %.6f, %.6f", lat, lng);
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }
}