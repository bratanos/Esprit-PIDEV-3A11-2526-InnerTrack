package com.innertrack.controller.admin;

import com.innertrack.dao.AdminUserDao;
import com.innertrack.dao.ChatLockDao;
import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.ReportDao;
import com.innertrack.model.Report;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class AdminReportsController {

    @FXML
    private VBox reportsList;
    @FXML
    private Label emptyLabel;
    @FXML
    private Label pendingCountLabel;

    // New tab elements
    @FXML
    private VBox locksList;
    @FXML
    private Label emptyLocksLabel;

    private final ReportDao reportDao = new ReportDao();
    private final AdminUserDao adminUserDao = new AdminUserDao();
    private final MessagingDao messagingDao = new MessagingDao();
    private final ChatLockDao chatLockDao = new ChatLockDao();
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        loadReports();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("admin/dashboard");
    }

    private void loadReports() {
        new Thread(() -> {
            List<Report> reports = reportDao.getAllReports();
            int pending = reportDao.countPending();
            Platform.runLater(() -> {
                if (pendingCountLabel != null)
                    pendingCountLabel.setText(pending + " en attente");
                reportsList.getChildren().clear();
                if (reports.isEmpty()) {
                    emptyLabel.setVisible(true);
                    emptyLabel.setManaged(true);
                } else {
                    emptyLabel.setVisible(false);
                    emptyLabel.setManaged(false);
                    for (Report r : reports)
                        reportsList.getChildren().add(buildCard(r));
                }
            });
        }, "load-reports-thread").start();
    }

    @FXML
    private void loadActiveLocksTab(javafx.event.Event event) {
        // Only trigger if we are selecting the tab, not unselecting it
        if (event.getSource() instanceof Tab selectedTab && selectedTab.isSelected()) {
            loadActiveLocks();
        }
    }

    private void loadActiveLocks() {
        new Thread(() -> {
            List<com.innertrack.model.ChatLock> locks = chatLockDao.getAllActiveLocks();
            Platform.runLater(() -> {
                locksList.getChildren().clear();
                if (locks.isEmpty()) {
                    emptyLocksLabel.setVisible(true);
                    emptyLocksLabel.setManaged(true);
                } else {
                    emptyLocksLabel.setVisible(false);
                    emptyLocksLabel.setManaged(false);
                    for (com.innertrack.model.ChatLock lock : locks) {
                        locksList.getChildren().add(buildLockCard(lock));
                    }
                }
            });
        }, "load-locks-thread").start();
    }

    private VBox buildLockCard(com.innertrack.model.ChatLock lock) {
        VBox card = new VBox(12);
        card.setPadding(new Insets(18));
        card.setStyle("-fx-background-color: white; -fx-background-radius: 12;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.07), 8, 0, 0, 2);");

        HBox header = new HBox(12);
        header.setAlignment(Pos.CENTER_LEFT);

        Label statusBadge = new Label("🔒 LOCKED");
        statusBadge.setStyle("-fx-background-color: #fc8181; -fx-text-fill: white;" +
                "-fx-background-radius: 12; -fx-padding: 3 10;" +
                "-fx-font-size: 11px; -fx-font-weight: bold;");

        Label nameLbl = new Label("Patient: " + lock.getUserName());
        nameLbl.setStyle("-fx-font-weight: bold; -fx-font-size: 14px; -fx-text-fill: #2d3748;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        header.getChildren().addAll(statusBadge, nameLbl, spacer);

        // Details
        HBox details = new HBox(20);
        VBox reasonBox = labeledValue("Reason", lock.getReason());

        String duration = lock.isPermanent() ? "Permanent" : lock.getLockedUntil().format(df);
        VBox durationBox = labeledValue("Locked Until", duration);

        VBox issuedBox = labeledValue("Issued At", lock.getLockedAt() != null ? lock.getLockedAt().format(df) : "—");

        details.getChildren().addAll(reasonBox, durationBox, issuedBox);

        // Actions
        HBox actions = new HBox(12);
        actions.setAlignment(Pos.CENTER_RIGHT);

        Button unlockBtn = new Button("🔓 Retirer la punition (Unlock)");
        unlockBtn.setStyle("-fx-background-color: #48bb78; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-background-radius: 8;" +
                "-fx-padding: 8 18; -fx-cursor: hand;");
        unlockBtn.setOnAction(e -> {
            chatLockDao.unlockUser(lock.getId());
            messagingDao.createNotification(new com.innertrack.model.Notification(
                    lock.getUserId(), "SYSTEM",
                    "Punishment Removed",
                    "Your community posting lock has been removed early by an administrator.",
                    0));
            loadActiveLocks(); // reload
        });

        actions.getChildren().add(unlockBtn);
        card.getChildren().addAll(header, new Separator(), details, actions);
        return card;
    }

    private VBox buildCard(Report report) {
        VBox card = new VBox(12);
        card.setPadding(new Insets(18));
        card.setStyle("-fx-background-color: white; -fx-background-radius: 12;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.07), 8, 0, 0, 2);");

        // Status badge color
        String badgeColor = switch (report.getStatus()) {
            case "REVIEWED" -> "#48bb78";
            case "DISMISSED" -> "#a0aec0";
            default -> "#f6ad55"; // PENDING
        };

        // Header row
        HBox header = new HBox(12);
        header.setAlignment(Pos.CENTER_LEFT);

        Label reasonBadge = new Label("⚠ " + report.getReasonLabel());
        reasonBadge.setStyle("-fx-background-color: #fc8181; -fx-text-fill: white;" +
                "-fx-background-radius: 12; -fx-padding: 3 10;" +
                "-fx-font-size: 11px; -fx-font-weight: bold;");

        Label statusBadge = new Label(report.getStatus());
        statusBadge.setStyle("-fx-background-color: " + badgeColor + "; -fx-text-fill: white;" +
                "-fx-background-radius: 12; -fx-padding: 3 10;" +
                "-fx-font-size: 11px; -fx-font-weight: bold;");

        // Context Badge
        boolean isCommunity = "COMMUNITY".equalsIgnoreCase(report.getContext());
        Label contextBadge = new Label(isCommunity ? "🌐 Communauté" : "💬 Message Privé");
        contextBadge.setStyle(
                "-fx-background-color: " + (isCommunity ? "#8b5cf6" : "#4299e1") + "; -fx-text-fill: white;" +
                        "-fx-background-radius: 12; -fx-padding: 3 10;" +
                        "-fx-font-size: 11px; -fx-font-weight: bold;");

        Label dateL = new Label(report.getCreatedAt() != null
                ? report.getCreatedAt().format(df)
                : "");
        dateL.setStyle("-fx-text-fill: #a0aec0; -fx-font-size: 11px;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        header.getChildren().addAll(reasonBadge, contextBadge, statusBadge, spacer, dateL);

        // People row
        HBox people = new HBox(20);
        people.setAlignment(Pos.CENTER_LEFT);
        VBox reporterBox = labeledValue("Signalé par (thérapeute)", report.getReporterName());
        VBox reportedBox = labeledValue("Patient signalé", report.getReportedName());
        people.getChildren().addAll(reporterBox, new Label("→"), reportedBox);

        // Details
        VBox detailsBox = new VBox(4);
        if (report.getDetails() != null && !report.getDetails().isBlank()) {
            Label detailsTitle = new Label("Détails :");
            detailsTitle.setStyle("-fx-font-weight: bold; -fx-text-fill: #4a5568; -fx-font-size: 12px;");
            Label detailsText = new Label(report.getDetails());
            detailsText.setWrapText(true);
            detailsText.setStyle("-fx-text-fill: #718096; -fx-font-size: 13px;");
            detailsBox.getChildren().addAll(detailsTitle, detailsText);
        }

        card.getChildren().addAll(header, new Separator(), people, detailsBox);

        // Action buttons — only for pending
        if ("PENDING".equals(report.getStatus())) {
            HBox actions = new HBox(12);
            actions.setAlignment(Pos.CENTER_RIGHT);

            if (!isCommunity) {
                Button logsBtn = new Button("📜 Voir l'historique");
                logsBtn.setStyle("-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568;" +
                        "-fx-font-weight: bold; -fx-background-radius: 8;" +
                        "-fx-padding: 8 18; -fx-cursor: hand;");
                logsBtn.setOnAction(e -> showChatLogs(report.getReporterId(), report.getReportedId()));
                actions.getChildren().add(logsBtn);
            }

            Button banBtn = new Button("🚫 Bannir le patient");
            banBtn.setStyle("-fx-background-color: #fc8181; -fx-text-fill: white;" +
                    "-fx-font-weight: bold; -fx-background-radius: 8;" +
                    "-fx-padding: 8 18; -fx-cursor: hand;");

            Button warnBtn = new Button("⚠ Avertir seulement");
            warnBtn.setStyle("-fx-background-color: #f6ad55; -fx-text-fill: white;" +
                    "-fx-font-weight: bold; -fx-background-radius: 8;" +
                    "-fx-padding: 8 18; -fx-cursor: hand;");

            Button dismissBtn = new Button("✓ Rejeter");
            dismissBtn.setStyle("-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568;" +
                    "-fx-font-weight: bold; -fx-background-radius: 8;" +
                    "-fx-padding: 8 18; -fx-cursor: hand;");

            banBtn.setOnAction(e -> {
                adminUserDao.setUserStatus(report.getReportedId(), "BLOCKED");
                messagingDao.createNotification(new com.innertrack.model.Notification(report.getReportedId(), "SYSTEM",
                        "Compte bloqué",
                        "Votre compte a été bloqué suite à un signalement. Contactez l'administration.",
                        0));
                reportDao.reviewReport(report.getId(),
                        SessionManager.getInstance().getCurrentUser().getId(), "REVIEWED");
                loadReports();
            });

            warnBtn.setOnAction(e -> {
                messagingDao.createNotification(new com.innertrack.model.Notification(report.getReportedId(), "SYSTEM",
                        "Avertissement",
                        "Votre comportement a été signalé. Veuillez respecter les règles de la plateforme.",
                        0));
                reportDao.reviewReport(report.getId(),
                        SessionManager.getInstance().getCurrentUser().getId(), "REVIEWED");
                loadReports();
            });

            dismissBtn.setOnAction(e -> {
                reportDao.reviewReport(report.getId(),
                        SessionManager.getInstance().getCurrentUser().getId(), "DISMISSED");
                loadReports();
            });

            actions.getChildren().addAll(dismissBtn, warnBtn, banBtn);

            // Chat Lock button
            Button lockBtn = new Button("🔒 Lock Chat");
            lockBtn.setStyle("-fx-background-color: #8b5cf6; -fx-text-fill: white;" +
                    "-fx-font-weight: bold; -fx-background-radius: 8;" +
                    "-fx-padding: 8 18; -fx-cursor: hand;");
            lockBtn.setOnAction(e -> {
                ChoiceDialog<String> durationDialog = new ChoiceDialog<>("24 hours",
                        "1 hour", "24 hours", "7 days", "Permanent");
                durationDialog.setTitle("Lock Chat");
                durationDialog.setHeaderText("Lock " + report.getReportedName() + "'s community posting");
                durationDialog.setContentText("Duration:");
                durationDialog.showAndWait().ifPresent(duration -> {
                    LocalDateTime until = switch (duration) {
                        case "1 hour" -> LocalDateTime.now().plusHours(1);
                        case "24 hours" -> LocalDateTime.now().plusHours(24);
                        case "7 days" -> LocalDateTime.now().plusDays(7);
                        default -> null; // Permanent
                    };
                    int adminId = SessionManager.getInstance().getCurrentUser().getId();
                    chatLockDao.lockUser(report.getReportedId(),
                            "Report: " + report.getReasonLabel(), until, adminId);
                    messagingDao.createNotification(new com.innertrack.model.Notification(
                            report.getReportedId(), "SYSTEM",
                            "Community Posting Locked",
                            "Your community posting has been locked" +
                                    (until != null ? " until " + until.format(df) : " permanently") +
                                    ". Reason: " + report.getReasonLabel(),
                            0));
                    reportDao.reviewReport(report.getId(), adminId, "REVIEWED");
                    loadReports();
                });
            });
            actions.getChildren().add(2, lockBtn);
            card.getChildren().add(actions);
        }

        return card;
    }

    private VBox labeledValue(String label, String value) {
        VBox box = new VBox(2);
        Label lbl = new Label(label);
        lbl.setStyle("-fx-text-fill: #a0aec0; -fx-font-size: 11px;");
        Label val = new Label(value != null ? value : "—");
        val.setStyle("-fx-font-weight: bold; -fx-text-fill: #2d3748; -fx-font-size: 14px;");
        box.getChildren().addAll(lbl, val);
        return box;
    }

    private void showChatLogs(int userA, int userB) {
        com.innertrack.model.Conversation conv = messagingDao.getConversationBetween(userA, userB);
        List<com.innertrack.model.Message> msgs = null;
        if (conv != null) {
            msgs = messagingDao.getMessages(conv.getId());
        }

        StringBuilder sb = new StringBuilder();
        if (msgs == null || msgs.isEmpty()) {
            sb.append("Aucun message trouvé entre ces deux utilisateurs.");
        } else {
            for (com.innertrack.model.Message m : msgs) {
                sb.append("[").append(m.getSentAt() != null ? m.getSentAt().format(df) : "")
                        .append("] ")
                        .append(m.getSenderId() == userA ? "Signaleur" : "Signalé")
                        .append(" : ")
                        .append(m.getContent()).append("\n");
            }
        }

        TextArea ta = new TextArea(sb.toString());
        ta.setEditable(false);
        ta.setWrapText(true);
        ta.setPrefSize(400, 300);

        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Historique de Chat");
        alert.setHeaderText("Messages entre les deux utilisateurs");
        alert.getDialogPane().setContent(ta);
        alert.showAndWait();
    }
}
