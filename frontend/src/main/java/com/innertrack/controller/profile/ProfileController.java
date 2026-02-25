package com.innertrack.controller.profile;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.ClientProfileDao;
import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.ClientProfile;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.paint.ImagePattern;
import javafx.scene.shape.Circle;
import javafx.stage.FileChooser;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.nio.file.StandardCopyOption;
import java.sql.SQLException;

public class ProfileController {

    // ── Basic identity (read/write on user table) ─────────────
    @FXML
    private Circle profileCircle;
    @FXML
    private Label nameLabel;
    @FXML
    private Label roleLabel;
    @FXML
    private TextField firstNameField;
    @FXML
    private TextField lastNameField;
    @FXML
    private TextField emailField;

    // ── Extended profile fields ───────────────────────────────
    @FXML
    private TextArea bioField; // both roles
    @FXML
    private TextField specializationField; // therapist only (hidden for clients)
    @FXML
    private TextField licenseField; // therapist only (hidden for clients)

    private final UserDao userDao = new UserDao();
    private final ClientProfileDao clientProfileDao = new ClientProfileDao();
    private final TherapistProfileDao therapistProfileDao = new TherapistProfileDao();

    private User currentUser;
    private ClientProfile clientProfile;
    private TherapistProfile therapistProfile;

    @FXML
    public void initialize() {
        currentUser = SessionManager.getInstance().getCurrentUser();
        if (currentUser != null) {
            loadUserData();
            loadExtendedProfile();
        }
    }

    // ── Load ──────────────────────────────────────────────────

    private void loadUserData() {
        // These all read from the user table — unchanged behaviour
        nameLabel.setText(currentUser.getFullName());
        if (currentUser.getRoles() != null && !currentUser.getRoles().isEmpty()) {
            roleLabel.setText(currentUser.getRoles().get(0).replace("ROLE_", ""));
        }
        firstNameField.setText(currentUser.getFirstName());
        lastNameField.setText(currentUser.getLastName());
        emailField.setText(currentUser.getEmail());
        updateProfileImage();
    }

    private void loadExtendedProfile() {
        String role = currentUser.getRoles() != null && !currentUser.getRoles().isEmpty()
                ? currentUser.getRoles().get(0)
                : "";

        if (role.contains("PSYCHOLOGUE")) {
            therapistProfile = therapistProfileDao.findByUserId(currentUser.getId());
            if (therapistProfile == null) {
                // Create on the fly for legacy users
                therapistProfile = new TherapistProfile(currentUser.getId());
                therapistProfileDao.create(therapistProfile);
            }
            if (bioField != null)
                bioField.setText(therapistProfile.getBio() != null ? therapistProfile.getBio() : "");
            if (specializationField != null)
                specializationField.setText(therapistProfile.getSpecialization() != null
                        ? therapistProfile.getSpecialization()
                        : "");
            if (licenseField != null)
                licenseField.setText(therapistProfile.getLicenseNumber() != null
                        ? therapistProfile.getLicenseNumber()
                        : "");
            // Hide client-only fields in FXML if they exist
            setVisible(specializationField, true);
            setVisible(licenseField, true);

        } else if (role.contains("USER")) {
            clientProfile = clientProfileDao.findByUserId(currentUser.getId());
            if (clientProfile == null) {
                clientProfile = new ClientProfile(currentUser.getId());
                clientProfileDao.create(clientProfile);
            }
            if (bioField != null)
                bioField.setText(clientProfile.getBio() != null ? clientProfile.getBio() : "");
            // Hide therapist-only fields
            setVisible(specializationField, false);
            setVisible(licenseField, false);
        } else {
            // Admin — no extended profile
            setVisible(bioField, false);
            setVisible(specializationField, false);
            setVisible(licenseField, false);
        }
    }

    private void updateProfileImage() {
        String picPath = currentUser.getProfilePicture();
        if (picPath != null && !picPath.isEmpty()) {
            try {
                File file = new File(picPath);
                if (file.exists()) {
                    try (java.io.FileInputStream fis = new java.io.FileInputStream(file)) {
                        Image image = new Image(fis);
                        if (!image.isError()) {
                            profileCircle.setFill(new ImagePattern(image, 0, 0, 1, 1, true));
                        }
                    }
                }
            } catch (Exception e) {
                System.err.println("Error loading profile image: " + e.getMessage());
            }
        }
    }

    // ── Save ──────────────────────────────────────────────────

    @FXML
    private void handleUpdateProfile() {
        // 1. Save basic identity to user table (unchanged)
        currentUser.setFirstName(firstNameField.getText().trim());
        currentUser.setLastName(lastNameField.getText().trim());

        // 2. Save extended profile fields to the profile table
        String bio = bioField != null ? bioField.getText().trim() : null;
        String role = currentUser.getRoles() != null && !currentUser.getRoles().isEmpty()
                ? currentUser.getRoles().get(0)
                : "";

        if (role.contains("PSYCHOLOGUE") && therapistProfile != null) {
            therapistProfile.setBio(bio);
            if (specializationField != null)
                therapistProfile.setSpecialization(specializationField.getText().trim());
            if (licenseField != null)
                therapistProfile.setLicenseNumber(licenseField.getText().trim());
            therapistProfileDao.update(therapistProfile);
        } else if (role.contains("USER") && clientProfile != null) {
            clientProfile.setBio(bio);
            clientProfileDao.update(clientProfile);
        }

        try {
            if (userDao.update(currentUser)) {
                nameLabel.setText(currentUser.getFullName());
                MainLayoutController.getInstance().updateUiForSession();
                showFeedback("Succès", "Profil mis à jour avec succès !");
                handleBack();
            }
        } catch (SQLException e) {
            e.printStackTrace();
            showFeedback("Erreur", "Impossible de mettre à jour le profil.");
        }
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
                Path uploadPath = Paths.get("uploads/profiles").toAbsolutePath();
                Files.createDirectories(uploadPath);
                String fileName = currentUser.getId() + "_" + System.currentTimeMillis()
                        + "_" + selectedFile.getName();
                Path destPath = uploadPath.resolve(fileName);
                Files.copy(selectedFile.toPath(), destPath, StandardCopyOption.REPLACE_EXISTING);

                // Save path to user table — this is correct, picture is user-level data
                currentUser.setProfilePicture(destPath.toString());
                userDao.update(currentUser);
                updateProfileImage();
                showFeedback("Succès", "Photo de profil mise à jour avec succès !");
            } catch (IOException | SQLException e) {
                e.printStackTrace();
                showFeedback("Erreur", "Impossible de mettre à jour la photo.");
            }
        }
    }

    @FXML
    private void handleBack() {
        String role = currentUser.getRoles().get(0);
        if (role.contains("ADMIN"))
            ViewManager.loadView("admin/dashboard");
        else if (role.contains("PSYCHOLOGUE"))
            ViewManager.loadView("psychologue/dashboard");
        else
            ViewManager.loadView("user/dashboard");
    }

    // ── Helpers ───────────────────────────────────────────────

    private void setVisible(javafx.scene.Node node, boolean visible) {
        if (node != null) {
            node.setVisible(visible);
            node.setManaged(visible);
        }
    }

    private void showFeedback(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}