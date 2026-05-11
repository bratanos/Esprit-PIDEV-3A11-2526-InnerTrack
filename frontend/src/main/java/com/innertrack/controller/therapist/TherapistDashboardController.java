package com.innertrack.controller.therapist;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.model.TherapistProfile;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import com.innertrack.session.SessionManager;

import java.util.List;

public class TherapistDashboardController {

    @FXML
    private Label welcomeLabel;
    @FXML
    private Label totalPatientsLabel;
    @FXML
    private Label appointmentsTodayLabel;
    @FXML
    private Label totalConsultationsLabel;
    @FXML
    private Label pendingRequestsLabel;
    @FXML
    private javafx.scene.shape.Circle profileCircle;
    @FXML
    private Label userFullNameLabel;
    @FXML
    private Label notifBadge;
    @FXML
    private HBox pendingAlert;
    @FXML
    private Label pendingAlertLabel;
    @FXML
    private VBox profileIncompleteCard;

    private final MessagingDao messagingDao = new MessagingDao();
    private final TherapistProfileDao profileDao = new TherapistProfileDao();

    @FXML
    public void initialize() {
        com.innertrack.model.User psych = SessionManager.getInstance().getCurrentUser();
        welcomeLabel.setText("Bonjour, Dr. " + psych.getFullName());
        userFullNameLabel.setText(psych.getFullName());
        updateProfileImage(psych.getProfilePicture());

        MainLayoutController.getInstance().setNavbarVisible(false);
        MainLayoutController.getInstance().setFooterVisible(false);

        // Dummy fixed stats
        totalPatientsLabel.setText("—");
        appointmentsTodayLabel.setText("0");
        totalConsultationsLabel.setText("—");

        // Load real data in background
        new Thread(() -> {
            int pending = messagingDao.getPendingRequests(psych.getId()).size();
            List<?> convs = messagingDao.getConversationsForUser(psych.getId());
            TherapistProfile profile = profileDao.findByUserId(psych.getId());

            Platform.runLater(() -> {
                // Pending requests badge
                pendingRequestsLabel.setText(String.valueOf(pending));
                if (pending > 0) {
                    notifBadge.setVisible(true);
                    notifBadge.setText(String.valueOf(pending));
                    pendingAlert.setVisible(true);
                    pendingAlert.setManaged(true);
                    pendingAlertLabel.setText(pending + " demande(s) en attente");
                }

                // Active conversations count
                totalConsultationsLabel.setText(String.valueOf(convs.size()));

                // Profile completeness warning
                boolean incomplete = profile == null
                        || profile.getSpecialization() == null
                        || profile.getBio() == null
                        || !profile.hasLocation();
                if (incomplete) {
                    profileIncompleteCard.setVisible(true);
                    profileIncompleteCard.setManaged(true);
                }
            });
        }, "therapist-dash-data").start();
    }

    // ── Navigation ────────────────────────────────────────────

    @FXML
    private void handleGoToProfile() {
        ViewManager.loadView("psychologue/therapist_profile_setup");
    }

    @FXML
    private void handleGoToLocation() {
        ViewManager.loadView("psychologue/therapist_location");
    }

    @FXML
    private void handleGoToNotifications() {
        ViewManager.loadView("psychologue/therapist_notifications");
    }

    @FXML
    private void handleGoToMessages() {
        ViewManager.loadView("chat/messaging_chat");
    }

    @FXML
    private void handleGoToSettings() {
        ViewManager.loadView("profile/settings_main");
    }

    @FXML
    private void handleGoToTests() {
        ViewManager.loadView("tests/listeTests");
    }

    @FXML
    private void handleGoToCommunity() {
        ViewManager.loadView("community/community");
    }

    @FXML
    private void handleGoToArticles() {
        ViewManager.loadView("article/ArticleView");
    }

    @FXML
    private void handleGoToEvents() {
        ViewManager.loadView("event/AfficherEvenement");
    }

    @FXML
    private void handleGoToChatbot() {
        ViewManager.loadView("chatbot/ChatbotView");
    }

    @FXML
    private void handleLogout() {
        SessionManager.getInstance().cleanSession();
        ViewManager.loadView("login");
    }

    // ── Helpers ───────────────────────────────────────────────

    private void updateProfileImage(String picPath) {
        try {
            javafx.scene.image.Image defaultImage = new javafx.scene.image.Image(getClass().getResource("/images/user.png").toExternalForm());
            profileCircle.setFill(new javafx.scene.paint.ImagePattern(defaultImage, 0, 0, 1, 1, true));

            if (picPath == null || picPath.isEmpty()) {
                return;
            }

            if (picPath.startsWith("http://") || picPath.startsWith("https://")) {
                javafx.scene.image.Image image = new javafx.scene.image.Image(picPath, true);
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
                if (!file.exists()) return;
                javafx.scene.image.Image image = new javafx.scene.image.Image(file.toURI().toString());
                if (!image.isError()) {
                    profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                }
            }
        } catch (Exception e) {
            System.err.println("Error loading profile image: " + e.getMessage());
        }
    }
}