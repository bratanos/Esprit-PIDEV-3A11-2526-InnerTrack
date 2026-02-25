package com.innertrack.controller.therapist;

import com.innertrack.dao.AdminUserDao;
import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.ReportDao;
import com.innertrack.model.ContactRequest;
import com.innertrack.model.Report;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;

import java.time.format.DateTimeFormatter;
import java.util.List;

public class TherapistNotificationsController {

    @FXML
    private VBox requestsList;
    @FXML
    private Label emptyLabel;
    @FXML
    private Label badgeLabel; // shows unread message count at top

    private final MessagingDao messagingDao = new MessagingDao();
    private final ReportDao reportDao = new ReportDao();
    private final AdminUserDao adminUserDao = new AdminUserDao();
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        loadRequests();
        loadUnreadMessageCount();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("psychologue/dashboard");
    }

    @FXML
    private void handleGoToMessages() {
        ViewManager.loadView("chat/messaging_chat");
    }

    // ── Unread message badge ───────────────────────────────────

    private void loadUnreadMessageCount() {
        int therapistId = SessionManager.getInstance().getCurrentUser().getId();
        new Thread(() -> {
            int unread = messagingDao.countUnread(therapistId);
            Platform.runLater(() -> {
                if (badgeLabel != null) {
                    if (unread > 0) {
                        badgeLabel.setText("💬 " + unread + " message(s) non lu(s)");
                        badgeLabel.setVisible(true);
                        badgeLabel.setManaged(true);
                    } else {
                        badgeLabel.setVisible(false);
                        badgeLabel.setManaged(false);
                    }
                }
            });
        }, "unread-count-thread").start();
    }

    // ── Contact requests ──────────────────────────────────────

    private void loadRequests() {
        int therapistId = SessionManager.getInstance().getCurrentUser().getId();
        new Thread(() -> {
            List<ContactRequest> requests = messagingDao.getPendingRequests(therapistId);
            Platform.runLater(() -> {
                requestsList.getChildren().clear();
                if (requests.isEmpty()) {
                    emptyLabel.setVisible(true);
                    emptyLabel.setManaged(true);
                } else {
                    emptyLabel.setVisible(false);
                    emptyLabel.setManaged(false);
                    for (ContactRequest cr : requests) {
                        requestsList.getChildren().add(buildCard(cr));
                    }
                }
            });
        }, "load-requests-thread").start();
    }

    private HBox buildCard(ContactRequest cr) {
        HBox card = new HBox(14);
        card.setAlignment(Pos.CENTER_LEFT);
        card.setPadding(new Insets(16));
        card.setStyle("-fx-background-color: white; -fx-background-radius: 10;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.06), 6, 0, 0, 2);");

        // Avatar
        String initial = cr.getClientName() != null && !cr.getClientName().isBlank()
                ? String.valueOf(cr.getClientName().charAt(0)).toUpperCase()
                : "?";
        Label avatar = new Label(initial);
        avatar.setStyle("-fx-background-color: #667eea; -fx-text-fill: white;" +
                "-fx-font-size: 18px; -fx-font-weight: bold;" +
                "-fx-min-width: 48; -fx-min-height: 48;" +
                "-fx-background-radius: 50; -fx-alignment: center;");

        // Info
        VBox info = new VBox(4);
        HBox.setHgrow(info, Priority.ALWAYS);
        Label nameL = new Label(cr.getClientName() != null ? cr.getClientName() : "Patient");
        nameL.setStyle("-fx-font-weight: bold; -fx-font-size: 15px; -fx-text-fill: #2d3748;");
        Label dateL = new Label(cr.getCreatedAt() != null ? cr.getCreatedAt().format(df) : "");
        dateL.setStyle("-fx-text-fill: #718096; -fx-font-size: 12px;");
        String msgText = cr.getMessage() != null ? cr.getMessage() : "Demande de contact";
        Label msgL = new Label("\"" + msgText + "\"");
        msgL.setStyle("-fx-text-fill: #555; -fx-font-size: 13px; -fx-font-style: italic;");
        msgL.setWrapText(true);
        info.getChildren().addAll(nameL, dateL, msgL);

        // Primary actions: Accept / Decline
        Button acceptBtn = styledButton("✓ Accepter",
                "-fx-background-color: #48bb78; -fx-text-fill: white;");
        Button declineBtn = styledButton("✗ Refuser",
                "-fx-background-color: #fc8181; -fx-text-fill: white;");

        // Secondary actions: Block / Report
        Button blockBtn = styledButton("🚫 Bloquer",
                "-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568;");
        Button reportBtn = styledButton("⚠ Signaler",
                "-fx-background-color: #f6ad55; -fx-text-fill: white;");

        acceptBtn.setOnAction(e -> {
            messagingDao.acceptRequest(cr.getId());
            showAlert("Accepté", cr.getClientName() + " peut maintenant vous envoyer des messages.");
            loadRequests();
        });

        declineBtn.setOnAction(e -> {
            messagingDao.declineRequest(cr.getId());
            loadRequests();
        });

        blockBtn.setOnAction(e -> handleBlock(cr));
        reportBtn.setOnAction(e -> handleReport(cr));

        VBox primaryActions = new VBox(8, acceptBtn, declineBtn);
        VBox secondaryActions = new VBox(8, blockBtn, reportBtn);
        primaryActions.setAlignment(Pos.CENTER);
        secondaryActions.setAlignment(Pos.CENTER);

        Separator sep = new Separator();
        sep.setStyle("-fx-orientation: vertical;");

        card.getChildren().addAll(avatar, info, sep, primaryActions, secondaryActions);
        return card;
    }

    // ── Block ─────────────────────────────────────────────────

    private void handleBlock(ContactRequest cr) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
        confirm.setTitle("Bloquer ce patient");
        confirm.setHeaderText("Bloquer " + cr.getClientName() + " ?");
        confirm.setContentText(
                "Ce patient ne pourra plus vous contacter. " +
                        "Son compte sera suspendu en attente de vérification par l'administrateur.");
        confirm.showAndWait().ifPresent(bt -> {
            if (bt != ButtonType.OK)
                return;

            // 1. Decline the contact request
            messagingDao.declineRequest(cr.getId());

            // 2. Suspend the client account
            adminUserDao.setUserStatus(cr.getClientId(), "BLOCKED");

            // 3. Notify the client
            messagingDao.createNotification(new com.innertrack.model.Notification(
                    cr.getClientId(), "SYSTEM",
                    "Compte suspendu",
                    "Votre compte a été temporairement suspendu suite à une signalement.",
                    0));

            // 4. Notify all admins
            notifyAdmins("Blocage signalé",
                    "Le thérapeute " + SessionManager.getInstance().getCurrentUser().getFullName() +
                            " a bloqué le patient " + cr.getClientName() + ".");

            showAlert("Bloqué", cr.getClientName() + " a été bloqué et l'administrateur a été notifié.");
            loadRequests();
        });
    }

    // ── Report ────────────────────────────────────────────────

    private void handleReport(ContactRequest cr) {
        // Reason picker
        ChoiceDialog<String> reasonDialog = new ChoiceDialog<>(
                "Harcèlement",
                "Spam", "Harcèlement", "Contenu inapproprié", "Autre");
        reasonDialog.setTitle("Signaler ce patient");
        reasonDialog.setHeaderText("Signaler " + cr.getClientName());
        reasonDialog.setContentText("Raison :");

        reasonDialog.showAndWait().ifPresent(selectedLabel -> {
            // Map French label back to DB code
            String reasonCode = switch (selectedLabel) {
                case "Spam" -> "SPAM";
                case "Harcèlement" -> "HARASSMENT";
                case "Contenu inapproprié" -> "INAPPROPRIATE";
                default -> "OTHER";
            };

            // Optional details
            TextInputDialog detailsDialog = new TextInputDialog();
            detailsDialog.setTitle("Détails du signalement");
            detailsDialog.setHeaderText("Décrivez le problème (optionnel)");
            detailsDialog.setContentText("Détails :");

            detailsDialog.showAndWait().ifPresent(details -> {
                int therapistId = SessionManager.getInstance().getCurrentUser().getId();
                Report report = new Report(therapistId, cr.getClientId(), reasonCode, details);
                boolean filed = reportDao.fileReport(report);

                if (filed) {
                    // Notify all admins
                    notifyAdmins("Nouveau signalement",
                            "Le thérapeute " +
                                    SessionManager.getInstance().getCurrentUser().getFullName() +
                                    " a signalé le patient " + cr.getClientName() +
                                    " pour : " + selectedLabel);

                    showAlert("Signalement envoyé",
                            "Votre signalement a été transmis à l'administrateur pour investigation.");
                } else {
                    showAlert("Erreur", "Impossible d'envoyer le signalement.");
                }
            });
        });
    }

    // ── Helpers ───────────────────────────────────────────────

    private void notifyAdmins(String title, String body) {
        // Notify every admin user — AdminUserDao already has the query infrastructure
        new Thread(() -> {
            try {
                // Get all admin user IDs
                var admins = adminUserDao.searchUsers(null, "ROLE_ADMIN", null, 0, 100);
                for (var admin : admins) {
                    messagingDao.createNotification(
                            new com.innertrack.model.Notification(admin.getId(), "SYSTEM", title, body, 0));
                }
            } catch (Exception e) {
                System.err.println("notifyAdmins error: " + e.getMessage());
            }
        }, "notify-admins-thread").start();
    }

    private Button styledButton(String text, String extraStyle) {
        Button btn = new Button(text);
        btn.setStyle("-fx-font-weight: bold; -fx-background-radius: 8;" +
                "-fx-padding: 7 16; -fx-cursor: hand; " + extraStyle);
        return btn;
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }
}