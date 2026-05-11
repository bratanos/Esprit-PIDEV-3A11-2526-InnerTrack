package com.innertrack.controller.therapist;

import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.service.ImgBBService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.*;

import javafx.stage.FileChooser;
import javafx.scene.shape.Circle;
import javafx.scene.image.Image;
import javafx.scene.paint.ImagePattern;
import java.io.File;
import java.sql.SQLException;

public class TherapistProfileSetupController {

    // ── FXML fields ──────────────────────────────────────────
    @FXML
    private Circle profileCircle;
    @FXML
    private TextField emailField;
    @FXML
    private TextField firstNameField;
    @FXML
    private TextField lastNameField;
    @FXML
    private ComboBox<String> specializationCombo;
    @FXML
    private TextField licenseField;
    @FXML
    private TextArea bioArea;
    @FXML
    private Label bioCharCount;
    @FXML
    private TextField phoneField;
    @FXML
    private TextField rateField;
    @FXML
    private Label statusLabel;

    // Availability checkboxes
    @FXML
    private CheckBox monCheck;
    @FXML
    private CheckBox tueCheck;
    @FXML
    private CheckBox wedCheck;
    @FXML
    private CheckBox thuCheck;
    @FXML
    private CheckBox friCheck;
    @FXML
    private CheckBox satCheck;
    @FXML
    private CheckBox sunCheck;

    // ── DAOs ─────────────────────────────────────────────────
    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private final UserDao userDao = new UserDao();

    private TherapistProfile profile;
    private User currentUser;

    // ── Specializations ───────────────────────────────────────
    private static final String[] SPECIALIZATIONS = {
            "Psychologie clinique",
            "Psychothérapie cognitive et comportementale (TCC)",
            "Thérapie familiale et de couple",
            "Psychologie de l'enfant et de l'adolescent",
            "Psychologie du travail",
            "Thérapie EMDR (traumatisme)",
            "Hypnothérapie",
            "Thérapie humaniste",
            "Psychanalyse",
            "Neuropsychologie",
            "Autre"
    };

    @FXML
    public void initialize() {
        currentUser = SessionManager.getInstance().getCurrentUser();

        // Load profile
        profile = profileDao.findByUserId(currentUser.getId());
        if (profile == null) {
            profile = new TherapistProfile(currentUser.getId());
            profileDao.create(profile);
        }

        // Populate specialization combo
        specializationCombo.getItems().addAll(SPECIALIZATIONS);

        // Pre-fill from user table
        firstNameField.setText(safe(currentUser.getFirstName()));
        lastNameField.setText(safe(currentUser.getLastName()));
        emailField.setText(safe(currentUser.getEmail()));
        updateProfileImage();

        // Pre-fill from profile table
        if (profile.getSpecialization() != null)
            specializationCombo.setValue(profile.getSpecialization());
        licenseField.setText(safe(profile.getLicenseNumber()));
        bioArea.setText(safe(profile.getBio()));
        phoneField.setText(safe(profile.getPhone()));
        rateField.setText(profile.getSessionRate() != null
                ? String.valueOf(profile.getSessionRate())
                : "");

        // Load availability days
        String days = safe(profile.getAvailableDays());
        monCheck.setSelected(days.contains("MON"));
        tueCheck.setSelected(days.contains("TUE"));
        wedCheck.setSelected(days.contains("WED"));
        thuCheck.setSelected(days.contains("THU"));
        friCheck.setSelected(days.contains("FRI"));
        satCheck.setSelected(days.contains("SAT"));
        sunCheck.setSelected(days.contains("SUN"));

        // Bio character counter
        updateCharCount();
        bioArea.textProperty().addListener((obs, old, val) -> {
            if (val.length() > 500) {
                bioArea.setText(val.substring(0, 500));
            }
            updateCharCount();
        });
    }

    @FXML
    private void handleSave() throws SQLException {
        // Validate
        if (firstNameField.getText().trim().isEmpty() || lastNameField.getText().trim().isEmpty()) {
            showAlert("Champs requis", "Veuillez renseigner votre prénom et nom.");
            return;
        }

        // Save name to user table
        currentUser.setFirstName(firstNameField.getText().trim());
        currentUser.setLastName(lastNameField.getText().trim());
        userDao.update(currentUser);

        // Save extended profile
        profile.setSpecialization(specializationCombo.getValue());
        profile.setLicenseNumber(licenseField.getText().trim());
        profile.setBio(bioArea.getText().trim());
        profile.setPhone(phoneField.getText().trim());

        // Parse rate
        String rateText = rateField.getText().trim();
        if (!rateText.isEmpty()) {
            try {
                profile.setSessionRate(Integer.parseInt(rateText));
            } catch (NumberFormatException e) {
                showAlert("Tarif invalide", "Veuillez entrer un nombre entier pour le tarif.");
                return;
            }
        }

        // Build availability string
        StringBuilder days = new StringBuilder();
        if (monCheck.isSelected())
            days.append("MON,");
        if (tueCheck.isSelected())
            days.append("TUE,");
        if (wedCheck.isSelected())
            days.append("WED,");
        if (thuCheck.isSelected())
            days.append("THU,");
        if (friCheck.isSelected())
            days.append("FRI,");
        if (satCheck.isSelected())
            days.append("SAT,");
        if (sunCheck.isSelected())
            days.append("SUN,");
        String daysStr = days.length() > 0 ? days.substring(0, days.length() - 1) : "";
        profile.setAvailableDays(daysStr);

        if (profileDao.update(profile)) {
            statusLabel.setText("✓ Profil enregistré");
            statusLabel.setStyle("-fx-text-fill: #16a085; -fx-font-size: 13px;");
        } else {
            statusLabel.setText("⚠ Erreur lors de l'enregistrement");
            statusLabel.setStyle("-fx-text-fill: #e74c3c; -fx-font-size: 13px;");
        }
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("psychologue/dashboard");
    }

    private void updateCharCount() {
        int len = bioArea.getText().length();
        bioCharCount.setText(len + " / 500");
        bioCharCount.setStyle(len > 450
                ? "-fx-text-fill: #e67e22; -fx-font-size: 11px;"
                : "-fx-text-fill: #bdc3c7; -fx-font-size: 11px;");
    }

    private static String safe(String s) {
        return s == null ? "" : s;
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }

    @FXML
    private void handleChangePicture() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Sélectionner une photo de profil");
        fileChooser.getExtensionFilters().add(
                new FileChooser.ExtensionFilter("Images", "*.png", "*.jpg", "*.jpeg"));
        File selectedFile = fileChooser.showOpenDialog(profileCircle.getScene().getWindow());

        if (selectedFile != null) {
            try {
                // Upload to ImgBB and get the hosted URL
                String imageUrl = ImgBBService.getInstance().upload(selectedFile);

                // Save URL to user table (cross-platform, works with web backend too)
                currentUser.setProfilePicture(imageUrl);
                userDao.update(currentUser);
                updateProfileImage();
                showAlert("Succès", "Photo de profil mise à jour via ImgBB !");
            } catch (Exception e) {
                e.printStackTrace();
                showAlert("Erreur", "Impossible de mettre à jour la photo : " + e.getMessage());
            }
        }
    }

    private void updateProfileImage() {
        String picPath = currentUser.getProfilePicture();
        if (picPath != null && !picPath.isEmpty()) {
            try {
                Image image;
                if (picPath.startsWith("http://") || picPath.startsWith("https://")) {
                    // URL-based image (ImgBB or other hosted images)
                    image = new Image(picPath, true); // background loading
                } else {
                    // Legacy local file path
                    File file = new File(picPath);
                    if (!file.exists()) return;
                    image = new Image(file.toURI().toString());
                }
                if (!image.isError()) {
                    profileCircle.setFill(new ImagePattern(image, 0, 0, 1, 1, true));
                }
            } catch (Exception e) {
                System.err.println("Error loading profile image: " + e.getMessage());
            }
        }
    }
}