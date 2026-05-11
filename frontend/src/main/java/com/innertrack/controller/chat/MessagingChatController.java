package com.innertrack.controller.chat;

import com.innertrack.dao.AdminUserDao;
import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.ReportDao;
import com.innertrack.model.Conversation;
import com.innertrack.model.Message;
import com.innertrack.model.Notification;
import com.innertrack.model.Report;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.geometry.Side;
import javafx.scene.control.*;
import javafx.scene.layout.*;

import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.TimeUnit;

public class MessagingChatController {

    @FXML
    private Label conversationTitleLabel;
    @FXML
    private Label conversationSubLabel;
    @FXML
    private Label unreadBanner;
    @FXML
    private Button menuButton; // ⋮ triple-dot
    @FXML
    private VBox conversationsList;
    @FXML
    private VBox messagesBox;
    @FXML
    private ScrollPane messagesScroll;
    @FXML
    private TextArea messageInput;
    @FXML
    private Button sendButton;

    private final MessagingDao messagingDao = new MessagingDao();
    private final ReportDao reportDao = new ReportDao();
    private final AdminUserDao adminDao = new AdminUserDao();

    private final DateTimeFormatter timeFmt = DateTimeFormatter.ofPattern("HH:mm");
    private final DateTimeFormatter dateFmt = DateTimeFormatter.ofPattern("dd/MM");
    private final DateTimeFormatter fullDate = DateTimeFormatter.ofPattern("dd/MM/yyyy");

    private int currentUserId;
    private String currentUserRole;
    private Conversation selectedConversation;
    private ScheduledExecutorService poller;

    @FXML
    public void initialize() {
        currentUserId = SessionManager.getInstance().getCurrentUser().getId();
        currentUserRole = SessionManager.getInstance().getCurrentUser().getRoles().get(0);

        // Hide menu button until a conversation is selected
        if (menuButton != null) {
            menuButton.setVisible(false);
            menuButton.setManaged(false);
        }

        loadConversationList();
        loadUnreadBanner();
        messagingDao.markAllNotificationsRead(currentUserId);

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

        messageInput.setOnKeyPressed(e -> {
            if (e.getCode().toString().equals("ENTER") && !e.isShiftDown()) {
                e.consume();
                handleSend();
            }
        });
    }

    // ── Back ─────────────────────────────────────────────────

    @FXML
    private void handleBack() {
        if (poller != null)
            poller.shutdownNow();
        if (currentUserRole.contains("PSYCHOLOGUE"))
            ViewManager.loadView("psychologue/dashboard");
        else
            ViewManager.loadView("user/dashboard");
    }

    // ── Triple-dot menu ───────────────────────────────────────

    @FXML
    private void handleMenuButton() {
        if (selectedConversation == null)
            return;

        boolean iAmTherapist = currentUserRole.contains("PSYCHOLOGUE");
        int otherUserId = iAmTherapist
                ? selectedConversation.getClientId()
                : selectedConversation.getTherapistId();
        String otherName = iAmTherapist
                ? selectedConversation.getClientName()
                : selectedConversation.getTherapistName();

        ContextMenu menu = new ContextMenu();

        // Determine exact clientId and therapistId based on role
        int clientId = iAmTherapist ? otherUserId : currentUserId;
        int therapistId = iAmTherapist ? currentUserId : otherUserId;

        // Check current block status
        boolean isBlocked = messagingDao.isBlocked(clientId, therapistId);

        if (isBlocked) {
            MenuItem unblockItem = new MenuItem("✅  Unblock " + otherName);
            unblockItem.setOnAction(e -> handleUnblock(clientId, therapistId, otherName));
            menu.getItems().add(unblockItem);
        } else {
            MenuItem blockItem = new MenuItem("🚫  Block " + otherName);
            blockItem.setOnAction(e -> handleBlock(clientId, therapistId, otherName));
            menu.getItems().add(blockItem);
        }
        menu.getItems().add(new SeparatorMenuItem());

        // Report — both sides
        MenuItem reportItem = new MenuItem("⚠  Report " + otherName);
        reportItem.setOnAction(e -> handleReport(otherUserId, otherName));
        menu.getItems().add(reportItem);

        menu.show(menuButton, Side.BOTTOM, 0, 4);
    }

    private void handleBlock(int clientId, int therapistId, String otherName) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
        confirm.setTitle("Block");
        confirm.setHeaderText("Block " + otherName + " ?");
        confirm.setContentText(
                "This user will no longer be able to contact you via messaging.\n\n" +
                        "Note: This does not suspend their account, but they will no longer be able to send you messages or new requests.");
        confirm.showAndWait().ifPresent(bt -> {
            if (bt != ButtonType.OK)
                return;

            boolean ok = messagingDao.updateBlockingStatus(clientId, therapistId, true);

            if (ok) {
                notifyAdmins("User blocked",
                        SessionManager.getInstance().getCurrentUser().getFullName()
                                + " has blocked messages from " + otherName + ".");

                showAlert("Blocked", otherName + " has been blocked. They can no longer contact you.");

                // Refresh views
                loadConversationList();
                messagesBox.getChildren().clear();
                selectedConversation = null;
                conversationTitleLabel.setText("Conversation");
                conversationSubLabel.setText("");
                if (menuButton != null) {
                    menuButton.setVisible(false);
                    menuButton.setManaged(false);
                }
            } else {
                showAlert("Error", "Unable to block the user.");
            }
        });
    }

    private void handleUnblock(int clientId, int therapistId, String otherName) {
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION);
        confirm.setTitle("Unblock");
        confirm.setHeaderText("Unblock " + otherName + " ?");
        confirm.setContentText("This user will be able to message you again.");
        confirm.showAndWait().ifPresent(bt -> {
            if (bt != ButtonType.OK)
                return;

            boolean ok = messagingDao.updateBlockingStatus(clientId, therapistId, false);

            if (ok) {
                showAlert("Unblocked", otherName + " has been unblocked.");
                // Refresh views
                loadConversationList();
            } else {
                showAlert("Error", "Unable to unblock the user.");
            }
        });
    }

    private void handleReport(int otherUserId, String otherName) {
        ChoiceDialog<String> reasonDialog = new ChoiceDialog<>(
                "Harassment", "Spam", "Harassment", "Inappropriate Content", "Other");
        reasonDialog.setTitle("Report");
        reasonDialog.setHeaderText("Report " + otherName);
        reasonDialog.setContentText("Reason :");

        reasonDialog.showAndWait().ifPresent(selectedLabel -> {
            String reasonCode = switch (selectedLabel) {
                case "Spam" -> "SPAM";
                case "Harcèlement" -> "HARASSMENT";
                case "Contenu inapproprié" -> "INAPPROPRIATE";
                default -> "OTHER";
            };

            TextInputDialog detailsDialog = new TextInputDialog();
            detailsDialog.setTitle("Details");
            detailsDialog.setHeaderText("Describe the problem (optional)");
            detailsDialog.setContentText("Details :");

            detailsDialog.showAndWait().ifPresent(details -> {
                Report report = new Report(currentUserId, otherUserId, reasonCode, details);
                boolean filed = reportDao.fileReport(report);
                if (filed) {
                    notifyAdmins("New report",
                            SessionManager.getInstance().getCurrentUser().getFullName()
                                    + " has reported " + otherName + " for : " + selectedLabel);
                    showAlert("Report sent", "Your report has been transmitted to the administrator.");
                } else {
                    showAlert("Error", "Unable to send the report.");
                }
            });
        });
    }

    private void notifyAdmins(String title, String body) {
        new Thread(() -> {
            try {
                adminDao.searchUsers(null, "ROLE_ADMIN", null, 0, 100)
                        .forEach(admin -> messagingDao.createNotification(
                                new Notification(admin.getId(), "SYSTEM", title, body, 0)));
            } catch (Exception e) {
                System.err.println("notifyAdmins: " + e.getMessage());
            }
        }, "notify-admins").start();
    }

    // ── Send ─────────────────────────────────────────────────

    @FXML
    private void handleSend() {
        if (selectedConversation == null)
            return;
        String text = messageInput.getText().trim();
        if (text.isBlank())
            return;
        messageInput.clear();
        messagingDao.sendMessage(selectedConversation.getId(), currentUserId, text);

        int otherId = selectedConversation.getClientId() == currentUserId
                ? selectedConversation.getTherapistId()
                : selectedConversation.getClientId();
        messagingDao.createNotification(new Notification(
                otherId, "MESSAGE", "New message",
                SessionManager.getInstance().getCurrentUser().getFullName()
                        + " sent you a message.",
                selectedConversation.getId()));

        refreshMessages();
        loadUnreadBanner();
    }

    // ── Unread banner ─────────────────────────────────────────

    private void loadUnreadBanner() {
        new Thread(() -> {
            int unread = messagingDao.countUnread(currentUserId);
            Platform.runLater(() -> {
                if (unreadBanner != null) {
                    if (unread > 0) {
                        unreadBanner.setText("💬 " + unread + " unread message(s) in your conversations");
                        unreadBanner.setVisible(true);
                        unreadBanner.setManaged(true);
                    } else {
                        unreadBanner.setVisible(false);
                        unreadBanner.setManaged(false);
                    }
                }
            });
        }, "unread-banner-thread").start();
    }

    // ── Conversation list ─────────────────────────────────────

    private void loadConversationList() {
        new Thread(() -> {
            List<Conversation> convs = messagingDao.getConversationsForUser(currentUserId);
            Platform.runLater(() -> {
                conversationsList.getChildren().clear();
                if (convs.isEmpty()) {
                    Label empty = new Label("No active conversations.");
                    empty.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px; -fx-padding: 20;");
                    conversationsList.getChildren().add(empty);
                } else {
                    for (Conversation c : convs)
                        conversationsList.getChildren().add(buildConversationRow(c));
                }
            });
        }, "load-convs").start();
    }

    private HBox buildConversationRow(Conversation conv) {
        HBox row = new HBox(12);
        row.setAlignment(Pos.CENTER_LEFT);
        row.setPadding(new Insets(12, 16, 12, 16));
        row.setStyle("-fx-cursor: hand; -fx-background-radius: 8;");

        String otherName = conv.getClientId() == currentUserId
                ? conv.getTherapistName()
                : conv.getClientName();
        String initial = otherName != null && !otherName.isBlank()
                ? String.valueOf(otherName.charAt(0)).toUpperCase()
                : "?";

        Label avatar = new Label(initial);
        avatar.getStyleClass().add("chat-avatar");

        VBox info = new VBox(2);
        Label nameL = new Label(otherName != null ? otherName : "Conversation");
        nameL.getStyleClass().add("chat-conv-name");

        String dateStr = conv.getCreatedAt() != null ? conv.getCreatedAt().format(dateFmt) : "";
        Label dateL = new Label(dateStr);
        dateL.getStyleClass().add("chat-conv-date");

        info.getChildren().addAll(nameL, dateL);
        row.getChildren().addAll(avatar, info);
        row.getStyleClass().add("chat-conv-row");

        row.setOnMouseClicked(e -> openConversation(conv, row));
        return row;
    }

    private void openConversation(Conversation conv, HBox row) {
        conversationsList.getChildren().forEach(n -> n.getStyleClass().remove("chat-conv-row-selected"));
        row.getStyleClass().add("chat-conv-row-selected");

        selectedConversation = conv;
        String otherName = conv.getClientId() == currentUserId
                ? conv.getTherapistName()
                : conv.getClientName();
        conversationTitleLabel.setText(otherName != null ? otherName : "Conversation");
        conversationSubLabel.setText("Active now");
        sendButton.setDisable(false);
        messageInput.setDisable(false);
        messageInput.setPromptText("Type a message...");

        // Show triple-dot now that a conversation is open
        if (menuButton != null) {
            menuButton.setVisible(true);
            menuButton.setManaged(true);
        }

        messagingDao.markMessagesRead(conv.getId(), currentUserId);
        refreshMessages();
        loadUnreadBanner();
    }

    private void refreshMessages() {
        if (selectedConversation == null)
            return;
        List<Message> messages = messagingDao.getMessages(selectedConversation.getId());
        Platform.runLater(() -> renderMessages(messages));
    }

    private void renderMessages(List<Message> messages) {
        messagesBox.getChildren().clear();

        if (messages.isEmpty()) {
            Label hint = new Label("Start the conversation by sending a message below.");
            hint.setStyle("-fx-text-fill: #7f8c8d; -fx-font-size: 13px;");
            hint.setWrapText(true);
            messagesBox.getChildren().add(hint);
            return;
        }

        String lastDate = null;
        for (Message msg : messages) {
            boolean isMe = msg.getSenderId() == currentUserId;

            if (msg.getSentAt() != null) {
                String date = msg.getSentAt().format(fullDate);
                if (!date.equals(lastDate)) {
                    Label sep = new Label(date);
                    sep.getStyleClass().add("chat-date-separator");
                    HBox sepRow = new HBox(sep);
                    sepRow.setAlignment(Pos.CENTER);
                    sepRow.setPadding(new Insets(8, 0, 8, 0));
                    messagesBox.getChildren().add(sepRow);
                    lastDate = date;
                }
            }

            Label bubble = new Label(msg.getContent());
            bubble.setWrapText(true);
            bubble.setMaxWidth(380);
            bubble.getStyleClass().add(isMe ? "chat-bubble-me" : "chat-bubble-them");

            String timeStr = msg.getSentAt() != null ? msg.getSentAt().format(timeFmt) : "";
            Label timeLabel = new Label(timeStr);
            timeLabel.getStyleClass().add("chat-time-label");

            VBox bubbleCol = new VBox(2, bubble, timeLabel);
            bubbleCol.setMaxWidth(400);
            HBox rowBox = new HBox();
            rowBox.setPadding(new Insets(2, 16, 2, 16));
            Region spacer = new Region();
            HBox.setHgrow(spacer, Priority.ALWAYS);

            if (isMe) {
                bubbleCol.setAlignment(Pos.CENTER_RIGHT);
                timeLabel.setAlignment(Pos.CENTER_RIGHT);
                rowBox.getChildren().addAll(spacer, bubbleCol);
            } else {
                rowBox.getChildren().addAll(bubbleCol, spacer);
            }
            messagesBox.getChildren().add(rowBox);
        }

        messagesScroll.layout();
        messagesScroll.setVvalue(1.0);
    }

    private void showAlert(String title, String msg) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(title);
        a.setHeaderText(null);
        a.setContentText(msg);
        a.showAndWait();
    }
}