package com.innertrack.controller.chatbot;

import com.innertrack.service.ChatbotService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;

public class ChatbotController {

    @FXML
    private VBox chatMessages;
    @FXML
    private ScrollPane chatScrollPane;
    @FXML
    private TextField messageField;
    @FXML
    private Button sendButton;
    @FXML
    private Label statusLabel;

    private final ChatbotService chatbotService = new ChatbotService();
    private String sessionId;

    @FXML
    public void initialize() {
        int userId = SessionManager.getInstance().getCurrentUser().getId();
        sessionId = "user_" + userId;

        // Auto-scroll to bottom when new messages are added
        chatMessages.heightProperty().addListener((obs, oldVal, newVal) -> chatScrollPane.setVvalue(1.0));

        // Check server health
        chatbotService.checkHealth(healthy -> {
            if (healthy) {
                statusLabel.setText("En ligne");
                statusLabel.setStyle("-fx-text-fill: #10b981; -fx-font-size: 11px;");
            } else {
                statusLabel.setText("Hors ligne — Lancez le serveur");
                statusLabel.setStyle("-fx-text-fill: #ef4444; -fx-font-size: 11px;");
            }
        });

        // Send on Enter key
        messageField.setOnAction(e -> handleSend());

        // Welcome message
        addBotMessage("Bonjour ! Je suis votre assistant InnerTrack. Comment puis-je vous aider aujourd'hui ?");
    }

    @FXML
    private void handleSend() {
        String text = messageField.getText().trim();
        if (text.isEmpty())
            return;

        messageField.clear();
        sendButton.setDisable(true);
        messageField.setDisable(true);

        addUserMessage(text);
        addTypingIndicator();

        int userId = SessionManager.getInstance().getCurrentUser().getId();
        chatbotService.sendMessage(sessionId, text, userId,
                reply -> {
                    removeTypingIndicator();
                    addBotMessage(reply);
                    sendButton.setDisable(false);
                    messageField.setDisable(false);
                    messageField.requestFocus();
                },
                error -> {
                    removeTypingIndicator();
                    addBotMessage("⚠ " + error);
                    sendButton.setDisable(false);
                    messageField.setDisable(false);
                    messageField.requestFocus();
                });
    }

    private void addUserMessage(String text) {
        Label label = new Label(text);
        label.setWrapText(true);
        label.setMaxWidth(350);
        label.setStyle("-fx-background-color: #8b5cf6; -fx-text-fill: white; " +
                "-fx-padding: 10 14; -fx-background-radius: 16 16 4 16; -fx-font-size: 13px;");

        HBox wrapper = new HBox(label);
        wrapper.setAlignment(Pos.CENTER_RIGHT);
        wrapper.setPadding(new Insets(3, 10, 3, 60));

        chatMessages.getChildren().add(wrapper);
    }

    private void addBotMessage(String text) {
        Label label = new Label(text);
        label.setWrapText(true);
        label.setMaxWidth(350);
        label.setStyle("-fx-background-color: #f1f5f9; -fx-text-fill: #1e293b; " +
                "-fx-padding: 10 14; -fx-background-radius: 16 16 16 4; -fx-font-size: 13px;");

        HBox wrapper = new HBox(label);
        wrapper.setAlignment(Pos.CENTER_LEFT);
        wrapper.setPadding(new Insets(3, 60, 3, 10));

        chatMessages.getChildren().add(wrapper);
    }

    private void addTypingIndicator() {
        Label dots = new Label("●  ●  ●");
        dots.setId("typingIndicator");
        dots.setStyle("-fx-background-color: #e2e8f0; -fx-text-fill: #94a3b8; " +
                "-fx-padding: 10 18; -fx-background-radius: 16; -fx-font-size: 14px;");

        HBox wrapper = new HBox(dots);
        wrapper.setId("typingWrapper");
        wrapper.setAlignment(Pos.CENTER_LEFT);
        wrapper.setPadding(new Insets(3, 60, 3, 10));

        chatMessages.getChildren().add(wrapper);
    }

    private void removeTypingIndicator() {
        chatMessages.getChildren().removeIf(node -> node instanceof HBox && "typingWrapper".equals(node.getId()));
    }

    @FXML
    private void handleBack() {
        String role = SessionManager.getInstance().getCurrentUser().getRoles().get(0);
        if (role.contains("ADMIN")) {
            ViewManager.loadView("admin/dashboard");
        } else if (role.contains("PSYCHOLOGUE")) {
            ViewManager.loadView("psychologue/dashboard");
        } else {
            ViewManager.loadView("user/dashboard");
        }
    }
}
