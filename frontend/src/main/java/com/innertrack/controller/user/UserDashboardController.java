package com.innertrack.controller.user;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.MessagingDao;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import com.innertrack.session.SessionManager;

public class UserDashboardController {

    @FXML
    private Label welcomeLabel;
    @FXML
    private Label streakLabel;
    @FXML
    private Label journalEntriesLabel;
    @FXML
    private Label habitsCompletedLabel;
    @FXML
    private Label activeConvLabel;
    @FXML
    private javafx.scene.shape.Circle profileCircle;
    @FXML
    private Label userFullNameLabel;
    @FXML
    private HBox acceptedAlert;
    @FXML
    private Label acceptedAlertLabel;

    private final MessagingDao messagingDao = new MessagingDao();

    @FXML
    public void initialize() {
        com.innertrack.model.User user = SessionManager.getInstance().getCurrentUser();
        welcomeLabel.setText("Ravi de vous revoir, " + user.getFullName());
        userFullNameLabel.setText(user.getFullName());
        updateProfileImage(user.getProfilePicture());

        MainLayoutController.getInstance().setNavbarVisible(false);
        MainLayoutController.getInstance().setFooterVisible(false);

        // Dummy stats
        streakLabel.setText("7 jours");
        journalEntriesLabel.setText("24");
        habitsCompletedLabel.setText("85%");

        // Load real messaging data
        new Thread(() -> {
            var convs = messagingDao.getConversationsForUser(user.getId());
            int unreadNotifs = messagingDao.countUnread(user.getId());

            Platform.runLater(() -> {
                activeConvLabel.setText(String.valueOf(convs.size()));
                if (unreadNotifs > 0) {
                    acceptedAlert.setVisible(true);
                    acceptedAlert.setManaged(true);
                    acceptedAlertLabel.setText(unreadNotifs + " nouvelle(s) notification(s) — cliquez pour voir");
                }
            });
        }, "user-dash-data").start();
    }

    @FXML
    private void handleGoToJournal() {
        System.out.println("Journal");
    }

    @FXML
    private void handleGoToHabits() {
        System.out.println("Habits");
    }

    @FXML
    private void handleGoToProfile() {
        ViewManager.loadView("profile/settings");
    }

    @FXML
    private void handleGoToSettings() {
        ViewManager.loadView("profile/settings_main");
    }

    @FXML
    private void handleGoToMap() {
        ViewManager.loadView("user/therapist_map");
    }

    @FXML
    private void handleGoToMessages() {
        ViewManager.loadView("chat/messaging_chat");
    }

    @FXML
    private void handleGoToTests() {
        ViewManager.loadView("tests/listeTests");
    }

    @FXML
    private void handleLogout() {
        SessionManager.getInstance().cleanSession();
        ViewManager.loadView("login");
    }

    private void updateProfileImage(String picPath) {
        if (picPath == null || picPath.isEmpty())
            return;
        try {
            java.io.File file = new java.io.File(picPath);
            if (file.exists()) {
                try (java.io.FileInputStream fis = new java.io.FileInputStream(file)) {
                    javafx.scene.image.Image image = new javafx.scene.image.Image(fis);
                    profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                }
            }
        } catch (Exception e) {
            System.err.println("Error loading profile image: " + e.getMessage());
        }
    }
}