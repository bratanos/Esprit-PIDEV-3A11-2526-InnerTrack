package com.innertrack.controller.community;

import com.innertrack.dao.*;
import com.innertrack.model.*;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Popup;

import java.time.Duration;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Map;

public class CommunityController {

    @FXML
    private TreeView<CommunityComment> commentsTree;
    @FXML
    private TextField newCommentField;
    @FXML
    private TextField searchField;
    @FXML
    private Label lockBanner;
    @FXML
    private HBox lockBannerBox;

    // New FXML for Master/Detail architecture
    @FXML
    private StackPane mainStackPane;
    @FXML
    private VBox topicsView;
    @FXML
    private FlowPane topicsGrid;
    @FXML
    private VBox threadView;
    @FXML
    private VBox threadTopicBox;

    private CommunityComment currentTopic = null;

    private final CommunityCommentDao commentDao = new CommunityCommentDao();
    private final CommunityReactionDao reactionDao = new CommunityReactionDao();
    private final ChatLockDao chatLockDao = new ChatLockDao();
    private final ReportDao reportDao = new ReportDao();
    private final MessagingDao messagingDao = new MessagingDao();
    private final TherapistProfileDao therapistProfileDao = new TherapistProfileDao();

    private TreeItem<CommunityComment> root;
    private int currentUserId;
    private String currentUserName;
    private java.util.List<String> currentUserRoles;
    private List<CommunityComment> allComments;

    @FXML
    public void initialize() {
        User user = SessionManager.getInstance().getCurrentUser();
        currentUserId = user.getId();
        currentUserName = user.getFullName();
        currentUserRoles = user.getRoles();

        // Check chat lock
        ChatLock lock = chatLockDao.getActiveLock(currentUserId);
        if (lock != null) {
            lockBannerBox.setVisible(true);
            lockBannerBox.setManaged(true);
            newCommentField.setDisable(true);
            if (lock.isPermanent()) {
                lockBanner.setText("🔒 Your community access is locked. Reason: " + lock.getReason());
            } else {
                lockBanner.setText("🔒 Locked until " +
                        lock.getLockedUntil().format(DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm")) +
                        " — Reason: " + lock.getReason());
            }
        } else {
            lockBannerBox.setVisible(false);
            lockBannerBox.setManaged(false);
        }

        // Set up TreeView cell factory
        commentsTree.setCellFactory(tv -> new CommentTreeCell());

        // Load Topics Grid
        loadTopics();
    }

    private void loadTopics() {
        topicsView.setVisible(true);
        threadView.setVisible(false);
        new Thread(() -> {
            allComments = commentDao.getRootComments(currentUserId);
            Platform.runLater(() -> {
                topicsGrid.getChildren().clear();
                for (CommunityComment c : allComments) {
                    topicsGrid.getChildren().add(buildTopicCard(c));
                }
            });
        }, "community-load-topics").start();
    }

    private VBox buildTopicCard(CommunityComment topic) {
        VBox card = new VBox(8);
        card.setPrefWidth(350); // Set a fixed width for the grid items
        card.setStyle("-fx-background-color: white; -fx-background-radius: 8;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.05), 5, 0, 0, 1);" +
                "-fx-padding: 15; -fx-cursor: hand;");

        // Hover effect
        card.setOnMouseEntered(e -> card.setStyle("-fx-background-color: #f8f9fa; -fx-background-radius: 8;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.08), 8, 0, 0, 2);" +
                "-fx-padding: 15; -fx-cursor: hand;"));
        card.setOnMouseExited(e -> card.setStyle("-fx-background-color: white; -fx-background-radius: 8;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.05), 5, 0, 0, 1);" +
                "-fx-padding: 15; -fx-cursor: hand;"));

        // Click to open thread
        card.setOnMouseClicked(e -> openThread(topic));

        Label titleLbl = new Label(
                topic.getTitle() != null && !topic.getTitle().isEmpty() ? topic.getTitle() : "Topic");
        titleLbl.setStyle("-fx-font-weight: bold; -fx-font-size: 16px; -fx-text-fill: #1c1c1c;");
        titleLbl.setWrapText(true);

        Label contentPreview = new Label(topic.getContent());
        contentPreview.setWrapText(true);
        contentPreview.setMaxHeight(40); // limit preview lines
        contentPreview.setStyle("-fx-text-fill: #4a5568; -fx-font-size: 13px;");

        // Footer with author and date
        HBox footer = new HBox(10);
        footer.setAlignment(Pos.CENTER_LEFT);
        Label authorLbl = new Label("By " + topic.getAuthorName());
        authorLbl.setStyle("-fx-font-weight: bold; -fx-font-size: 11px; -fx-text-fill: #1c1c1c;");
        Label timeLbl = new Label("• " + formatTimeAgo(topic.getCreatedAt()));
        timeLbl.setStyle("-fx-text-fill: #787c7e; -fx-font-size: 11px;");
        footer.getChildren().addAll(authorLbl, timeLbl);

        card.getChildren().addAll(titleLbl, contentPreview, new Separator(), footer);
        return card;
    }

    private void openThread(CommunityComment topic) {
        currentTopic = topic;
        topicsView.setVisible(false);
        threadView.setVisible(true);

        threadTopicBox.getChildren().clear();

        // Build the top-level topic UI.
        threadTopicBox.getChildren().add(buildCommentNode(topic, null, true));

        loadThreadReplies(topic.getId());
    }

    private void loadThreadReplies(int parentId) {
        new Thread(() -> {
            List<CommunityComment> replies = commentDao.getReplies(parentId, currentUserId);
            Platform.runLater(() -> {
                root = new TreeItem<>();
                for (CommunityComment r : replies) {
                    root.getChildren().add(createItem(r));
                }
                commentsTree.setRoot(root);
                commentsTree.setShowRoot(false);
            });
        }, "community-load-thread").start();
    }

    private TreeItem<CommunityComment> createItem(CommunityComment comment) {
        TreeItem<CommunityComment> item = new TreeItem<>(comment);
        // Lazy-load placeholder
        item.getChildren().add(new TreeItem<>(null));

        item.addEventHandler(TreeItem.<CommunityComment>branchExpandedEvent(), e -> {
            TreeItem<CommunityComment> expanded = e.getTreeItem();
            if (expanded.getChildren().size() == 1 && expanded.getChildren().get(0).getValue() == null) {
                expanded.getChildren().clear();
                List<CommunityComment> replies = commentDao.getReplies(expanded.getValue().getId(), currentUserId);
                for (CommunityComment reply : replies) {
                    expanded.getChildren().add(createItem(reply));
                }
            }
        });

        return item;
    }

    @FXML
    private void handlePostComment() {
        if (currentTopic == null)
            return;
        String text = newCommentField.getText();
        if (text == null || text.isBlank())
            return;

        String censored = censorText(text);
        int parentId = currentTopic.getId();
        int id = commentDao.addReply(new CommunityComment(currentUserId, censored, parentId));
        if (id > 0) {
            CommunityComment c = commentDao.read(id, currentUserId);
            if (c != null && root != null) {
                // If it's a direct reply, add to root of comments tree
                root.getChildren().add(0, createItem(c));
            }
            newCommentField.clear();
        }
    }

    @FXML
    private void handleCreateTopic() {
        Dialog<CommunityComment> dialog = new Dialog<>();
        dialog.setTitle("Create New Topic");
        dialog.setHeaderText("Start a new discussion thread in the community.");

        ButtonType postButtonType = new ButtonType("Post", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(postButtonType, ButtonType.CANCEL);

        GridPane grid = new GridPane();
        grid.setHgap(10);
        grid.setVgap(10);
        grid.setPadding(new Insets(20, 150, 10, 10));

        TextField titleField = new TextField();
        titleField.setPromptText("Topic Title");
        titleField.setPrefWidth(300);

        TextArea contentArea = new TextArea();
        contentArea.setPromptText("Write the details here...");
        contentArea.setWrapText(true);
        contentArea.setPrefRowCount(4);

        grid.add(new Label("Title:"), 0, 0);
        grid.add(titleField, 1, 0);
        grid.add(new Label("Details:"), 0, 1);
        grid.add(contentArea, 1, 1);

        dialog.getDialogPane().setContent(grid);

        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == postButtonType) {
                CommunityComment topic = new CommunityComment(currentUserId, censorText(contentArea.getText()));
                topic.setTitle(censorText(titleField.getText()));
                return topic;
            }
            return null;
        });

        dialog.showAndWait().ifPresent(topic -> {
            if (topic.getTitle() == null || topic.getTitle().isEmpty() || topic.getContent().trim().isEmpty()) {
                Alert emptyAlert = new Alert(Alert.AlertType.WARNING, "Title and Details are required.");
                emptyAlert.show();
                return;
            }
            int id = commentDao.addComment(topic);
            if (id > 0) {
                // Refresh grid
                loadTopics();
            }
        });
    }

    @FXML
    private void handleBackToTopics() {
        currentTopic = null;
        threadTopicBox.getChildren().clear();
        if (root != null)
            root.getChildren().clear();
        loadTopics();
    }

    @FXML
    private void handleSearch() {
        if (topicsView.isVisible()) {
            String text = searchField.getText();
            if (text == null || text.isBlank()) {
                loadTopics();
                return;
            }
            new Thread(() -> {
                List<CommunityComment> results = commentDao.search(text, currentUserId);
                Platform.runLater(() -> {
                    topicsGrid.getChildren().clear();
                    for (CommunityComment c : results) {
                        topicsGrid.getChildren().add(buildTopicCard(c));
                    }
                });
            }, "community-search").start();
        }
    }

    @FXML
    private void handleBack() {
        if (currentUserRoles != null && currentUserRoles.contains("ROLE_PSYCHOLOGUE")) {
            ViewManager.loadView("psychologue/dashboard");
        } else {
            ViewManager.loadView("user/dashboard");
        }
    }

    // ── Profanity Filter (Local Implementation) ──
    private static final String[] BAD_WORDS = {
            "fuck", "shit", "bitch", "ass", "asshole", "cunt", "dick", "pussy", "slut", "whore"
    };

    private String censorText(String input) {
        if (input == null || input.isEmpty())
            return input;
        String censored = input;
        boolean found = false;

        for (String word : BAD_WORDS) {
            String regex = "(?i)\\b" + java.util.regex.Pattern.quote(word) + "\\b";
            if (java.util.regex.Pattern.compile(regex).matcher(censored).find()) {
                found = true;
                censored = censored.replaceAll(regex, "***");
            }
        }

        if (found) {
            Alert alert = new Alert(Alert.AlertType.WARNING);
            alert.setTitle("Warning");
            alert.setHeaderText("Profanity Detected!");
            alert.setContentText("Your input contained bad language.\nIt will be censored to: " + censored);
            alert.showAndWait();
        }
        return censored;
    }

    private String formatTimeAgo(LocalDateTime createdAt) {
        if (createdAt == null)
            return "";
        Duration duration = Duration.between(createdAt, LocalDateTime.now());
        long seconds = duration.getSeconds();
        if (seconds < 60)
            return seconds + "s ago";
        long minutes = seconds / 60;
        if (minutes < 60)
            return minutes + "m ago";
        long hours = minutes / 60;
        if (hours < 24)
            return hours + "h ago";
        long days = hours / 24;
        if (days < 30)
            return days + "d ago";
        long months = days / 30;
        return months + "mo ago";
    }

    // ──────────────────────────────────────────────────────
    // Unified UI Builder (For Topics and Comments)
    // ──────────────────────────────────────────────────────
    private VBox buildCommentNode(CommunityComment item, TreeItem<CommunityComment> treeContext, boolean isTopicBase) {
        VBox card = new VBox(10);
        card.setPadding(new Insets(14, 16, 14, 16));

        if (isTopicBase) {
            // No border for the top-level topic inside the detail view, just padding and
            // bottom border
            card.setStyle("-fx-background-color: transparent;");
        } else {
            card.setStyle(
                    "-fx-background-color: white; -fx-background-radius: 8; -fx-border-color: #edeff1; -fx-border-radius: 8; -fx-border-width: 1;");
            // subtle hover effect on the entire card
            card.setOnMouseEntered(e -> card.setStyle(
                    "-fx-background-color: white; -fx-background-radius: 8; -fx-border-color: #898989; -fx-border-radius: 8; -fx-border-width: 1;"));
            card.setOnMouseExited(e -> card.setStyle(
                    "-fx-background-color: white; -fx-background-radius: 8; -fx-border-color: #edeff1; -fx-border-radius: 8; -fx-border-width: 1;"));
        }

        // ── Header: Avatar Initial + Name + Role Tag + Time ──
        HBox header = new HBox(10);
        header.setAlignment(Pos.CENTER_LEFT);

        // Avatar circle
        String initial = item.getAuthorName() != null && !item.getAuthorName().isEmpty()
                ? item.getAuthorName().substring(0, 1).toUpperCase()
                : "?";
        Label initialLabel = new Label(initial);
        initialLabel.setStyle("-fx-text-fill: white; -fx-font-weight: bold; -fx-font-size: 14px;");
        StackPane avatar = new StackPane(initialLabel);
        avatar.setPrefSize(30, 30);
        String avatarColor = item.isTherapist() ? "#8b5cf6" : "#4299e1";
        avatar.setStyle("-fx-background-color: " + avatarColor + "; -fx-background-radius: 50;");

        Label nameLabel = new Label(item.getAuthorName() != null ? item.getAuthorName() : "Unknown");
        nameLabel.setStyle("-fx-font-weight: bold; -fx-font-size: 13px; -fx-text-fill: #1c1c1c; -fx-cursor: hand;");
        nameLabel.setOnMouseClicked(e -> showProfilePopup(item, nameLabel));

        Label roleTag = new Label(item.isTherapist() ? "🩺 Doctor" : "👤 User");
        roleTag.setStyle(item.isTherapist()
                ? "-fx-background-color: rgba(139,92,246,0.15); -fx-text-fill: #7c3aed; -fx-background-radius: 12; -fx-padding: 2 8; -fx-font-size: 10px; -fx-font-weight: bold;"
                : "-fx-background-color: rgba(66,153,225,0.15); -fx-text-fill: #2b6cb0; -fx-background-radius: 12; -fx-padding: 2 8; -fx-font-size: 10px; -fx-font-weight: bold;");

        Label timeLabel = new Label(formatTimeAgo(item.getCreatedAt()));
        timeLabel.setStyle("-fx-text-fill: #787c7e; -fx-font-size: 11px;");

        if (item.isModified()) {
            Label editedTag = new Label("(edited)");
            editedTag.setStyle("-fx-text-fill: #787c7e; -fx-font-size: 11px; -fx-font-style: italic;");
            header.getChildren().addAll(avatar, nameLabel, roleTag, editedTag, timeLabel);
        } else {
            header.getChildren().addAll(avatar, nameLabel, roleTag, timeLabel);
        }

        // ── Comment content ──
        VBox contentBox = new VBox(6);
        if (isTopicBase && item.getTitle() != null && !item.getTitle().isEmpty()) {
            Label titleLbl = new Label(item.getTitle());
            titleLbl.setStyle("-fx-font-weight: bold; -fx-font-size: 18px; -fx-text-fill: #1c1c1c;");
            titleLbl.setWrapText(true);
            contentBox.getChildren().add(titleLbl);
        }

        Label contentLabel = new Label(item.getContent());
        contentLabel.setWrapText(true);
        contentLabel.setStyle("-fx-text-fill: #1c1c1c; -fx-font-size: 14px; -fx-padding: 4 0 4 0;");
        contentLabel.setMaxWidth(Double.MAX_VALUE);
        contentBox.getChildren().add(contentLabel);

        // ── Reaction bar (Animated Reddit-style pills) ──
        HBox reactionBar = new HBox(8);
        reactionBar.setAlignment(Pos.CENTER_LEFT);

        // Nasty emojis replaced with nicer colorful emojis
        String[] emojis = { "💯", "💖", "🔥", "✨", "🙌" };
        Map<String, Integer> counts = reactionDao.getReactionCounts(item.getId());

        for (String emoji : emojis) {
            HBox pill = new HBox(6);
            pill.setAlignment(Pos.CENTER);
            pill.setPadding(new Insets(4, 10, 4, 10));

            boolean isSelected = emoji.equals(item.getCurrentReaction());
            String baseBg = isSelected ? "#e2e8f0" : "#f6f7f8";
            String hoverBg = isSelected ? "#cbd5e1" : "#e2e8f0";

            pill.setStyle("-fx-background-color: " + baseBg + "; -fx-background-radius: 16; -fx-cursor: hand;");

            Label emoLbl = new Label(emoji);
            emoLbl.setStyle("-fx-font-size: 14px;");

            int c = counts.getOrDefault(emoji, 0);
            Label cntLbl = new Label(c > 0 ? String.valueOf(c) : "");
            cntLbl.setStyle("-fx-font-size: 12px; -fx-font-weight: bold; -fx-text-fill: "
                    + (isSelected ? "#1c1c1c" : "#878a8c") + ";");

            if (c > 0) {
                pill.getChildren().addAll(emoLbl, cntLbl);
            } else {
                pill.getChildren().add(emoLbl);
            }

            // Hover Animation
            javafx.animation.ScaleTransition st = new javafx.animation.ScaleTransition(
                    javafx.util.Duration.millis(150), pill);
            pill.setOnMouseEntered(ev -> {
                st.setToX(1.1);
                st.setToY(1.1);
                st.playFromStart();
                pill.setStyle(
                        "-fx-background-color: " + hoverBg + "; -fx-background-radius: 16; -fx-cursor: hand;");
            });

            pill.setOnMouseExited(ev -> {
                st.setToX(1.0);
                st.setToY(1.0);
                st.playFromStart();
                pill.setStyle("-fx-background-color: " + baseBg + "; -fx-background-radius: 16; -fx-cursor: hand;");
            });

            // Click Animation & Action
            pill.setOnMouseClicked(ev -> {
                javafx.animation.ScaleTransition clickSt = new javafx.animation.ScaleTransition(
                        javafx.util.Duration.millis(100), pill);
                clickSt.setByX(0.2);
                clickSt.setByY(0.2);
                clickSt.setCycleCount(2);
                clickSt.setAutoReverse(true);
                clickSt.playFromStart();

                reactionDao.setReaction(currentUserId, item.getId(), isSelected ? null : emoji);
                // Refresh logic
                if (isTopicBase && currentTopic != null && currentTopic.getId() == item.getId()) {
                    currentTopic.setCurrentReaction(isSelected ? null : emoji);
                    openThread(currentTopic); // Redraw
                } else {
                    commentsTree.refresh();
                }
            });

            reactionBar.getChildren().add(pill);
        }

        // ── Action bar: reply, edit, delete, report ──
        HBox actionBar = new HBox(12);
        actionBar.setAlignment(Pos.CENTER_LEFT);
        actionBar.setPadding(new Insets(8, 0, 0, 0));

        // Reply input
        TextField replyField = new TextField();
        replyField.setPromptText("Reply to this...");
        replyField.setStyle(
                "-fx-background-color: #f6f7f8; -fx-border-color: transparent; -fx-background-radius: 16; -fx-border-radius: 16; -fx-padding: 4 12; -fx-font-size: 12px;");
        replyField.setPrefWidth(200);

        ChatLock lock = chatLockDao.getActiveLock(currentUserId);
        if (lock != null) {
            replyField.setDisable(true);
            replyField.setPromptText("🔒 Locked");
        }

        replyField.setOnAction(ev -> {
            String replyText = replyField.getText();
            if (replyText != null && !replyText.isBlank()) {
                String censored = censorText(replyText);
                int id = commentDao.addReply(new CommunityComment(currentUserId, censored, item.getId()));
                if (id > 0) {
                    CommunityComment reply = commentDao.read(id, currentUserId);
                    if (reply != null && treeContext != null) {
                        treeContext.getChildren().add(createItem(reply));
                        treeContext.setExpanded(true);
                    } else if (reply != null && isTopicBase) {
                        // Directly load tree
                        loadThreadReplies(currentTopic.getId());
                    }
                }
                replyField.clear();
            }
        });

        actionBar.getChildren().add(replyField);

        // Edit/Delete for own comments
        if (currentUserId == item.getUserId()) {
            Button editBtn = createFlatActionBtn("✏️ Edit");
            editBtn.setOnAction(ev -> {
                TextInputDialog dialog = new TextInputDialog(item.getContent());
                dialog.setTitle("Edit");
                dialog.setHeaderText(null);
                dialog.showAndWait().ifPresent(newText -> {
                    if (!newText.isBlank()) {
                        String censored = censorText(newText);
                        commentDao.updateContent(item.getId(), censored);
                        item.setContent(censored);
                        item.setModified(true);
                        if (isTopicBase)
                            openThread(currentTopic);
                        else
                            commentsTree.refresh();
                    }
                });
            });

            Button deleteBtn = createFlatActionBtn("🗑️ Delete");
            deleteBtn.setOnAction(ev -> {
                Alert confirm = new Alert(Alert.AlertType.CONFIRMATION, "Delete this and all replies?",
                        ButtonType.YES, ButtonType.NO);
                confirm.setHeaderText(null);
                confirm.showAndWait().ifPresent(bt -> {
                    if (bt == ButtonType.YES) {
                        commentDao.delete(item.getId());
                        if (isTopicBase) {
                            handleBackToTopics();
                        } else if (treeContext != null && treeContext.getParent() != null) {
                            treeContext.getParent().getChildren().remove(treeContext);
                        }
                    }
                });
            });

            actionBar.getChildren().addAll(editBtn, deleteBtn);
        } else {
            // Report button (for other people's comments)
            Button reportBtn = createFlatActionBtn(isTopicBase ? "🚩 Report Topic" : "🚩 Report");
            reportBtn.setStyle(reportBtn.getStyle() + "-fx-text-fill: #e53e3e;");
            reportBtn.setOnAction(ev -> handleReportComment(item));
            actionBar.getChildren().add(reportBtn);
        }

        // Combine reaction bar and action bar
        VBox bottomBox = new VBox(6);
        bottomBox.getChildren().addAll(reactionBar, actionBar);

        card.getChildren().addAll(header, contentBox, bottomBox);
        return card;
    }

    // ──────────────────────────────────────────────────────
    // TreeCell — renders each comment using the UI Builder
    // ──────────────────────────────────────────────────────
    private class CommentTreeCell extends TreeCell<CommunityComment> {
        @Override
        protected void updateItem(CommunityComment item, boolean empty) {
            super.updateItem(item, empty);
            if (empty || item == null) {
                setText(null);
                setGraphic(null);
                return;
            }

            setGraphic(buildCommentNode(item, getTreeItem(), false));
        }
    }

    private Button createFlatActionBtn(String text) {
        Button btn = new Button(text);
        btn.setStyle(
                "-fx-background-color: transparent; -fx-text-fill: #878a8c; -fx-font-size: 12px; -fx-font-weight: bold; -fx-cursor: hand; -fx-padding: 4 8;");
        btn.setOnMouseEntered(e -> btn.setStyle(
                "-fx-background-color: #f6f7f8; -fx-text-fill: #1c1c1c; -fx-font-size: 12px; -fx-font-weight: bold; -fx-cursor: hand; -fx-padding: 4 8; -fx-background-radius: 4;"));
        btn.setOnMouseExited(e -> btn.setStyle(
                "-fx-background-color: transparent; -fx-text-fill: #878a8c; -fx-font-size: 12px; -fx-font-weight: bold; -fx-cursor: hand; -fx-padding: 4 8;"));
        return btn;
    }

    // ── Report a comment ──
    private void handleReportComment(CommunityComment comment) {
        ChoiceDialog<String> dialog = new ChoiceDialog<>("SPAM",
                "SPAM", "HARASSMENT", "INAPPROPRIATE", "OTHER");
        dialog.setTitle("Report Comment");
        dialog.setHeaderText("Report " + comment.getAuthorName() + "'s comment");
        dialog.setContentText("Reason:");
        dialog.showAndWait().ifPresent(reason -> {
            TextInputDialog detailsDialog = new TextInputDialog();
            detailsDialog.setTitle("Report Details");
            detailsDialog.setHeaderText(null);
            detailsDialog.setContentText("Additional details (optional):");
            String details = detailsDialog.showAndWait().orElse("");

            // Append the actual reported comment to the details so the admin can see it
            String fullDetails = "Reported Comment: \"" + comment.getContent() + "\"\n\nUser Details: " + details;

            Report report = new Report(currentUserId, comment.getUserId(), reason, fullDetails, "COMMUNITY");
            reportDao.fileReport(report);

            // Notify admins
            messagingDao.createNotification(new Notification(
                    27, // admin user ID — ideally fetched dynamically
                    "SYSTEM",
                    "New Community Report",
                    currentUserName + " reported " + comment.getAuthorName() +
                            " for: " + reason + " (Community Forum)",
                    0));

            Alert success = new Alert(Alert.AlertType.INFORMATION);
            success.setTitle("Report Filed");
            success.setHeaderText(null);
            success.setContentText("Your report has been submitted. An admin will review it.");
            success.showAndWait();
        });
    }

    // ── Profile Popup ──
    private void showProfilePopup(CommunityComment comment, Label anchor) {
        VBox popupContent = new VBox(10);
        popupContent.setPadding(new Insets(16));
        popupContent.setStyle("-fx-background-color: -it-card; -fx-background-radius: 16; " +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.2), 20, 0, 0, 8); " +
                "-fx-border-color: -it-border; -fx-border-radius: 16; -fx-border-width: 1;");
        popupContent.setPrefWidth(280);

        // Name + role
        Label nameL = new Label(comment.getAuthorName());
        nameL.setStyle("-fx-font-size: 16px; -fx-font-weight: bold; -fx-text-fill: -it-text;");

        if (comment.isTherapist()) {
            Label badge = new Label("🩺 Therapist / Doctor");
            badge.setStyle("-fx-background-color: rgba(139,92,246,0.15); -fx-text-fill: #7c3aed; " +
                    "-fx-background-radius: 8; -fx-padding: 4 12; -fx-font-weight: bold;");
            popupContent.getChildren().addAll(nameL, badge, new Separator());

            // Load therapist profile
            TherapistProfile tp = therapistProfileDao.findByUserId(comment.getUserId());
            if (tp != null) {
                if (tp.getSpecialization() != null && !tp.getSpecialization().isBlank()) {
                    popupContent.getChildren().add(infoRow("Specialty", tp.getSpecialization()));
                }
                if (tp.getPhone() != null && !tp.getPhone().isBlank()) {
                    popupContent.getChildren().add(infoRow("Phone", tp.getPhone()));
                }
                if (tp.getBio() != null && !tp.getBio().isBlank()) {
                    Label bioL = new Label(tp.getBio());
                    bioL.setWrapText(true);
                    bioL.setStyle("-fx-text-fill: -it-text-muted; -fx-font-size: 12px;");
                    popupContent.getChildren().add(bioL);
                }
            }
        } else {
            Label badge = new Label("👤 Community Member");
            badge.setStyle("-fx-background-color: rgba(100,116,139,0.15); -fx-text-fill: #64748b; " +
                    "-fx-background-radius: 8; -fx-padding: 4 12; -fx-font-weight: bold;");
            popupContent.getChildren().addAll(nameL, badge, new Separator());

            // Show test count for normal users
            try {
                java.sql.Connection conn = com.innertrack.util.DBConnection.getInstance().getConnection();
                java.sql.PreparedStatement ps = conn.prepareStatement(
                        "SELECT COUNT(*) FROM historique_resultat WHERE id_utilisateur = ?");
                ps.setInt(1, comment.getUserId());
                java.sql.ResultSet rs = ps.executeQuery();
                int testCount = rs.next() ? rs.getInt(1) : 0;
                popupContent.getChildren().add(infoRow("Tests Taken", String.valueOf(testCount)));
            } catch (Exception ignored) {
            }
        }

        Popup popup = new Popup();
        popup.setAutoHide(true);
        popup.getContent().add(popupContent);
        popup.show(anchor,
                anchor.getScene().getWindow().getX() + anchor.localToScene(0, 0).getX() + anchor.getScene().getX(),
                anchor.getScene().getWindow().getY() + anchor.localToScene(0, 0).getY() + anchor.getScene().getY()
                        + 20);
    }

    private HBox infoRow(String label, String value) {
        Label lbl = new Label(label + ":");
        lbl.setStyle("-fx-text-fill: -it-text-muted; -fx-font-size: 11px;");
        Label val = new Label(value);
        val.setStyle("-fx-font-weight: bold; -fx-text-fill: -it-text; -fx-font-size: 13px;");
        HBox row = new HBox(8, lbl, val);
        row.setAlignment(Pos.CENTER_LEFT);
        return row;
    }
}
