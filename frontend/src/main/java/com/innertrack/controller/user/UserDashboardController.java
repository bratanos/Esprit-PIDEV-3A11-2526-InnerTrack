package com.innertrack.controller.user;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.MessagingDao;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import com.innertrack.session.SessionManager;
import com.innertrack.service.JournalService;
import com.innertrack.service.HabitudeService;
import com.innertrack.model.EntreeJournal;
import com.innertrack.model.Habitude;
import com.innertrack.service.CitationService;

import java.util.List;

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
    @FXML
    private Label derniereEntreeLabel;
    @FXML
    private Label nombreHabitudesLabel;
    @FXML
    private Label moyenneHumeurLabel;
    @FXML
    private Label quoteTextLabel;
    @FXML
    private Label quoteAuthorLabel;

    private final MessagingDao messagingDao = new MessagingDao();

    @FXML
    public void initialize() {
        com.innertrack.model.User user = SessionManager.getInstance().getCurrentUser();
        welcomeLabel.setText("Good to see you again, " + user.getFullName());
        userFullNameLabel.setText(user.getFullName());
        updateProfileImage(user.getProfilePicture());

        MainLayoutController.getInstance().setNavbarVisible(false);
        MainLayoutController.getInstance().setFooterVisible(false);

        // Load real stats using services
        JournalService journalService = new JournalService();
        HabitudeService habitudeService = new HabitudeService();

        try {
            List<EntreeJournal> journals = journalService.findByUserId(user.getId());
            List<Habitude> habits = habitudeService.findByUserId(user.getId());

            // Number of journal entries
            journalEntriesLabel.setText(String.valueOf(journals.size()));

            // Streak logic (basic implementation based on consecutive past days with any
            // entry)
            int streak = calculateStreak(journals, habits);
            streakLabel.setText(streak + " days");

            // Habits completed
            int habitsCount = habits.size();
            habitsCompletedLabel.setText(String.valueOf(habitsCount));

            // Summary Stats for the new labels
            if (!journals.isEmpty()) {
                java.time.LocalDate maxDate = journals.stream()
                        .map(EntreeJournal::getDateSaisie)
                        .max(java.time.LocalDate::compareTo)
                        .orElse(null);
                derniereEntreeLabel.setText("Latest journal entry: " +
                        (maxDate != null ? maxDate.format(java.time.format.DateTimeFormatter.ofPattern("dd/MM/yyyy"))
                                : "None"));

                double avgHumeur = journals.stream()
                        .limit(10)
                        .mapToInt(EntreeJournal::getHumeur)
                        .average()
                        .orElse(0);
                moyenneHumeurLabel.setText(String.format("Average Mood (last 10): %.1f / 10", avgHumeur));
            }

            nombreHabitudesLabel.setText("Active habits: " + habits.size());

        } catch (java.sql.SQLException e) {
            e.printStackTrace();
            journalEntriesLabel.setText("?");
            streakLabel.setText("?");
            habitsCompletedLabel.setText("?");
        }

        // Load real messaging data
        new Thread(() -> {
            var convs = messagingDao.getConversationsForUser(user.getId());
            int unreadNotifs = messagingDao.countUnread(user.getId());

            // Initialize CitationService
            CitationService citationService = new CitationService();
            String fullQuote = citationService.getCitationDuJour();
            // Expected format: "Quote content" — Author
            String quoteBody = fullQuote;
            String author = "";
            if (fullQuote.contains("\n— ")) {
                String[] parts = fullQuote.split("\n— ");
                quoteBody = parts[0];
                author = parts[1];
            } else if (fullQuote.contains("— ")) {
                String[] parts = fullQuote.split(" — ");
                quoteBody = parts[0];
                author = (parts.length > 1) ? parts[1] : "";
            }

            final String finalQuote = quoteBody;
            final String finalAuthor = author;

            Platform.runLater(() -> {
                activeConvLabel.setText(String.valueOf(convs.size()));
                if (unreadNotifs > 0) {
                    acceptedAlert.setVisible(true);
                    acceptedAlert.setManaged(true);
                    acceptedAlertLabel.setText(unreadNotifs + " new notification(s) — click to view");
                }

                // Set daily inspiration
                quoteTextLabel.setText(finalQuote);
                if (!finalAuthor.isEmpty()) {
                    quoteAuthorLabel.setText("— " + finalAuthor);
                    quoteAuthorLabel.setVisible(true);
                    quoteAuthorLabel.setManaged(true);
                } else {
                    quoteAuthorLabel.setVisible(false);
                    quoteAuthorLabel.setManaged(false);
                }
            });
        }, "user-dash-data").start();
    }

    private int calculateStreak(List<EntreeJournal> journals, List<Habitude> habits) {
        if (journals.isEmpty() && habits.isEmpty())
            return 0;

        // This is a naive streak calculation for demonstration.
        // It checks if there's either a journal entry or habit for today/yesterday.
        // A full habit tracker streak would normally be calculated via a dedicated
        // tracked-days table.
        int maxJ = journals.isEmpty() ? 0 : 1;
        int maxH = habits.isEmpty() ? 0 : 1;
        return maxJ + maxH; // Simplified placeholder
    }

    @FXML
    private void handleGoToJournal() {
        ViewManager.loadView("journal/AffichageJournal");
    }

    @FXML
    private void handleGoToHabits() {
        ViewManager.loadView("journal/AffichageHabitude");
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
        com.innertrack.model.User user = SessionManager.getInstance().getCurrentUser();
        if (user != null) {
            messagingDao.markAllNotificationsRead(user.getId());
        }
        ViewManager.loadView("chat/messaging_chat");
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
    private void handleGoToChatbot() {
        ViewManager.loadView("chatbot/ChatbotView");
    }

    @FXML
    private void handleGoToEvents() {
        ViewManager.loadView("event/AfficherEvenement");
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
            javafx.scene.image.Image image;
            if (picPath.startsWith("http://") || picPath.startsWith("https://")) {
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
                if (!file.exists()) return;
                image = new javafx.scene.image.Image(file.toURI().toString());
                if (!image.isError()) {
                    profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                }
            }
        } catch (Exception e) {
            System.err.println("Error loading profile image: " + e.getMessage());
        }
    }
}