package com.innertrack.controller.chat;

import com.innertrack.dao.MessagingDao;
import com.innertrack.model.Conversation;
import com.innertrack.model.Message;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextArea;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;

import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.TimeUnit;

public class MessagingChatController {

    @FXML private Label      conversationTitleLabel;
    @FXML private Label      conversationSubLabel;
    @FXML private VBox       conversationsList;
    @FXML private VBox       messagesBox;
    @FXML private ScrollPane messagesScroll;
    @FXML private TextArea   messageInput;
    @FXML private Button     sendButton;
    @FXML private Label      emptyConvLabel;

    private final MessagingDao messagingDao = new MessagingDao();
    private final DateTimeFormatter timeFmt  = DateTimeFormatter.ofPattern("HH:mm");
    private final DateTimeFormatter dateFmt  = DateTimeFormatter.ofPattern("dd/MM");

    private int currentUserId;
    private Conversation selectedConversation;
    private ScheduledExecutorService poller;

    @FXML
    public void initialize() {
        currentUserId = SessionManager.getInstance().getCurrentUser().getId();
        loadConversationList();

        // Poll for new messages every 5 seconds when a conversation is open
        poller = Executors.newSingleThreadScheduledExecutor(r -> {
            Thread t = new Thread(r, "chat-poller");
            t.setDaemon(true);
            return t;
        });
        poller.scheduleWithFixedDelay(() -> {
            if (selectedConversation != null) {
                Platform.runLater(this::refreshMessages);
            }
        }, 5, 5, TimeUnit.SECONDS);

        // Ctrl+Enter or Enter to send
        messageInput.setOnKeyPressed(e -> {
            if (e.getCode().toString().equals("ENTER") && !e.isShiftDown()) {
                e.consume();
                handleSend();
            }
        });
    }

    @FXML
    private void handleBack() {
        if (poller != null) poller.shutdownNow();
        // Return to role-appropriate dashboard
        String role = SessionManager.getInstance().getCurrentUser().getRoles().get(0);
        if (role.contains("PSYCHOLOGUE")) ViewManager.loadView("psychologue/dashboard");
        else ViewManager.loadView("user/dashboard");
    }

    @FXML
    private void handleSend() {
        if (selectedConversation == null) return;
        String text = messageInput.getText().trim();
        if (text.isBlank()) return;

        messageInput.clear();
        messagingDao.sendMessage(selectedConversation.getId(), currentUserId, text);

        // Also notify the other party
        int otherId = selectedConversation.getClientId() == currentUserId
                ? selectedConversation.getTherapistId()
                : selectedConversation.getClientId();
        messagingDao.createNotification(new com.innertrack.model.Notification(
                otherId, "MESSAGE", "Nouveau message",
                SessionManager.getInstance().getCurrentUser().getFullName()
                        + " vous a envoyé un message.", selectedConversation.getId()));

        refreshMessages();
    }

    private void loadConversationList() {
        new Thread(() -> {
            List<Conversation> convs = messagingDao.getConversationsForUser(currentUserId);
            Platform.runLater(() -> {
                conversationsList.getChildren().clear();
                if (convs.isEmpty()) {
                    Label empty = new Label("Aucune conversation active.");
                    empty.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px; -fx-padding: 20;");
                    conversationsList.getChildren().add(empty);
                } else {
                    for (Conversation c : convs) {
                        conversationsList.getChildren().add(buildConversationRow(c));
                    }
                }
            });
        }, "load-convs").start();
    }

    private HBox buildConversationRow(Conversation conv) {
        HBox row = new HBox(12);
        row.setAlignment(Pos.CENTER_LEFT);
        row.setPadding(new Insets(12, 16, 12, 16));
        row.setStyle("-fx-cursor: hand; -fx-background-radius: 8;");

        // Determine the other person's name
        String otherName = conv.getClientId() == currentUserId
                ? conv.getTherapistName() : conv.getClientName();
        String initial = otherName != null && !otherName.isBlank()
                ? String.valueOf(otherName.charAt(0)).toUpperCase() : "?";

        Label avatar = new Label(initial);
        avatar.setStyle("-fx-background-color: #FF69B4; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-font-size: 16px;" +
                "-fx-min-width: 40; -fx-min-height: 40;" +
                "-fx-background-radius: 50; -fx-alignment: center;");

        VBox info = new VBox(2);
        Label nameL = new Label(otherName != null ? otherName : "Conversation");
        nameL.setStyle("-fx-font-weight: bold; -fx-text-fill: #2c3e50; -fx-font-size: 14px;");
        String dateStr = conv.getCreatedAt() != null ? conv.getCreatedAt().format(dateFmt) : "";
        Label dateL = new Label(dateStr);
        dateL.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 11px;");
        info.getChildren().addAll(nameL, dateL);

        row.getChildren().addAll(avatar, info);

        row.setOnMouseEntered(e -> row.setStyle("-fx-cursor: hand; -fx-background-color: #FFF0F5; -fx-background-radius: 8;"));
        row.setOnMouseExited(e -> {
            if (selectedConversation != null && selectedConversation.getId() == conv.getId()) {
                row.setStyle("-fx-cursor: hand; -fx-background-color: #FFD6E8; -fx-background-radius: 8;");
            } else {
                row.setStyle("-fx-cursor: hand; -fx-background-radius: 8;");
            }
        });
        row.setOnMouseClicked(e -> openConversation(conv, row));

        return row;
    }

    private void openConversation(Conversation conv, HBox row) {
        // Deselect previous
        conversationsList.getChildren().forEach(n ->
                n.setStyle("-fx-cursor: hand; -fx-background-radius: 8;"));
        row.setStyle("-fx-cursor: hand; -fx-background-color: #FFD6E8; -fx-background-radius: 8;");

        selectedConversation = conv;
        String otherName = conv.getClientId() == currentUserId
                ? conv.getTherapistName() : conv.getClientName();
        conversationTitleLabel.setText(otherName != null ? otherName : "Conversation");
        conversationSubLabel.setText("Conversation active");

        sendButton.setDisable(false);
        messageInput.setDisable(false);
        messageInput.setPromptText("Écrire un message…");

        messagingDao.markMessagesRead(conv.getId(), currentUserId);
        refreshMessages();
    }

    private void refreshMessages() {
        if (selectedConversation == null) return;
        List<Message> messages = messagingDao.getMessages(selectedConversation.getId());
        Platform.runLater(() -> renderMessages(messages));
    }

    private void renderMessages(List<Message> messages) {
        messagesBox.getChildren().clear();

        if (messages.isEmpty()) {
            Label hint = new Label("Commencez la conversation en envoyant un message ci-dessous.");
            hint.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px;");
            hint.setWrapText(true);
            messagesBox.getChildren().add(hint);
            return;
        }

        String lastDate = null;
        for (Message msg : messages) {
            boolean isMe = msg.getSenderId() == currentUserId;

            // Date separator
            if (msg.getSentAt() != null) {
                String date = msg.getSentAt().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"));
                if (!date.equals(lastDate)) {
                    Label sep = new Label(date);
                    sep.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 11px;" +
                            "-fx-background-color: #f1f1f1; -fx-background-radius: 10; -fx-padding: 2 10;");
                    HBox sepRow = new HBox(sep);
                    sepRow.setAlignment(Pos.CENTER);
                    sepRow.setPadding(new Insets(8, 0, 8, 0));
                    messagesBox.getChildren().add(sepRow);
                    lastDate = date;
                }
            }

            // Bubble
            Label bubble = new Label(msg.getContent());
            bubble.setWrapText(true);
            bubble.setMaxWidth(380);
            bubble.setStyle(isMe
                    ? "-fx-background-color: #FF69B4; -fx-text-fill: white;" +
                    "-fx-background-radius: 18 18 4 18; -fx-padding: 10 16; -fx-font-size: 14px;"
                    : "-fx-background-color: white; -fx-text-fill: #2c3e50;" +
                    "-fx-background-radius: 18 18 18 4; -fx-padding: 10 16; -fx-font-size: 14px;" +
                    "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.06), 4, 0, 0, 1);");

            String timeStr = msg.getSentAt() != null ? msg.getSentAt().format(timeFmt) : "";
            Label timeLabel = new Label(timeStr);
            timeLabel.setStyle("-fx-text-fill: #bdc3c7; -fx-font-size: 10px;");

            VBox bubbleCol = new VBox(2, bubble, timeLabel);
            bubbleCol.setMaxWidth(400);

            HBox row = new HBox();
            row.setPadding(new Insets(2, 16, 2, 16));
            if (isMe) {
                Region spacer = new Region();
                HBox.setHgrow(spacer, Priority.ALWAYS);
                bubbleCol.setAlignment(Pos.CENTER_RIGHT);
                timeLabel.setAlignment(javafx.geometry.Pos.CENTER_RIGHT);
                row.getChildren().addAll(spacer, bubbleCol);
            } else {
                Region spacer = new Region();
                HBox.setHgrow(spacer, Priority.ALWAYS);
                row.getChildren().addAll(bubbleCol, spacer);
            }

            messagesBox.getChildren().add(row);
        }

        // Scroll to bottom
        messagesScroll.layout();
        messagesScroll.setVvalue(1.0);
    }
}