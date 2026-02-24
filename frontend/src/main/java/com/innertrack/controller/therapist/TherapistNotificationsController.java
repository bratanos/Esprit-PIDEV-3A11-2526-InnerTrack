package com.innertrack.controller.therapist;

import com.innertrack.dao.MessagingDao;
import com.innertrack.model.ContactRequest;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;

import java.time.format.DateTimeFormatter;
import java.util.List;

public class TherapistNotificationsController {

    @FXML private VBox requestsList;
    @FXML private Label emptyLabel;

    private final MessagingDao messagingDao = new MessagingDao();
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML
    public void initialize() {
        loadRequests();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("psychologue/dashboard");
    }

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
        HBox card = new HBox(16);
        card.setAlignment(Pos.CENTER_LEFT);
        card.setPadding(new Insets(16));
        card.setStyle("-fx-background-color: white; -fx-background-radius: 10;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.06), 6, 0, 0, 2);");

        // Avatar circle placeholder
        Label avatar = new Label(cr.getClientName() != null && !cr.getClientName().isBlank()
                ? String.valueOf(cr.getClientName().charAt(0)).toUpperCase() : "?");
        avatar.setStyle("-fx-background-color: #FF69B4; -fx-text-fill: white;" +
                "-fx-font-size: 18px; -fx-font-weight: bold;" +
                "-fx-min-width: 48; -fx-min-height: 48;" +
                "-fx-background-radius: 50; -fx-alignment: center;");

        // Info
        VBox info = new VBox(4);
        HBox.setHgrow(info, Priority.ALWAYS);
        Label nameLabel = new Label(cr.getClientName() != null ? cr.getClientName() : "Patient");
        nameLabel.setStyle("-fx-font-weight: bold; -fx-font-size: 15px; -fx-text-fill: #2c3e50;");
        Label dateLabel = new Label(cr.getCreatedAt() != null ? cr.getCreatedAt().format(df) : "");
        dateLabel.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 12px;");
        String msgText = cr.getMessage() != null ? cr.getMessage() : "Demande de contact";
        Label msgLabel = new Label("\"" + msgText + "\"");
        msgLabel.setStyle("-fx-text-fill: #555; -fx-font-size: 13px; -fx-font-style: italic;");
        msgLabel.setWrapText(true);
        info.getChildren().addAll(nameLabel, dateLabel, msgLabel);

        // Actions
        Button acceptBtn = new Button("✓ Accepter");
        acceptBtn.setStyle("-fx-background-color: #27ae60; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-background-radius: 8;" +
                "-fx-padding: 8 20; -fx-cursor: hand;");

        Button declineBtn = new Button("✗ Refuser");
        declineBtn.setStyle("-fx-background-color: #e74c3c; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-background-radius: 8;" +
                "-fx-padding: 8 20; -fx-cursor: hand;");

        acceptBtn.setOnAction(e -> {
            messagingDao.acceptRequest(cr.getId());
            showAlert("Accepté", cr.getClientName() + " peut maintenant vous envoyer des messages.");
            loadRequests();
        });

        declineBtn.setOnAction(e -> {
            messagingDao.declineRequest(cr.getId());
            loadRequests();
        });

        VBox actions = new VBox(8, acceptBtn, declineBtn);
        actions.setAlignment(Pos.CENTER);

        card.getChildren().addAll(avatar, info, actions);
        return card;
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title); a.setHeaderText(null); a.setContentText(msg);
        a.showAndWait();
    }
}