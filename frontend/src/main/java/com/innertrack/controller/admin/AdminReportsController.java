package com.innertrack.controller.admin;

import com.innertrack.dao.AdminUserDao;
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

import java.time.format.DateTimeFormatter;
import java.util.List;

public class AdminReportsController {

    @FXML
    private VBox reportsList;
    @FXML
    private Label emptyLabel;
    @FXML
    private Label pendingCountLabel;

    private final ReportDao reportDao = new ReportDao();
    private final AdminUserDao adminUserDao = new AdminUserDao();
    private final MessagingDao messagingDao = new MessagingDao();
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

        Label dateL = new Label(report.getCreatedAt() != null
                ? report.getCreatedAt().format(df)
                : "");
        dateL.setStyle("-fx-text-fill: #a0aec0; -fx-font-size: 11px;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        header.getChildren().addAll(reasonBadge, statusBadge, spacer, dateL);

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
}
