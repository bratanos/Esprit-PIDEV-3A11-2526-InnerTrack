package com.innertrack.controller.admin;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.AdminUserDao;
import com.innertrack.dao.MessagingDao;
import com.innertrack.dao.ReportDao;
import com.innertrack.model.Notification;
import com.innertrack.model.Report;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.XYChart;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Modality;
import javafx.stage.Stage;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Map;

public class AdminDashboardController {

    // ── Sidebar ───────────────────────────────────────────────
    @FXML
    private javafx.scene.shape.Circle profileCircle;
    @FXML
    private Label userFullNameLabel;
    @FXML
    private Label welcomeLabel;
    @FXML
    private Button btnDashboard;
    @FXML
    private Button btnUsers;
    @FXML
    private Button btnReports;
    @FXML
    private Label reportsBadge;

    // ── Panes ─────────────────────────────────────────────────
    @FXML
    private ScrollPane dashPane;
    @FXML
    private VBox usersPane;
    @FXML
    private VBox reportsPane;

    // ── Analytics ─────────────────────────────────────────────
    @FXML
    private Label totalUsersLabel;
    @FXML
    private Label totalClientsLabel;
    @FXML
    private Label totalTherapistsLabel;
    @FXML
    private Label newThisMonthLabel;
    @FXML
    private Label blockedLabel;
    @FXML
    private Label activeCountLabel;
    @FXML
    private Label pendingCountLabel;
    @FXML
    private Label blockedCountLabel;
    @FXML
    private BarChart<String, Number> registrationsChart;

    // ── Users ─────────────────────────────────────────────────
    @FXML
    private TextField searchField;
    @FXML
    private ComboBox<String> roleFilterCombo;
    @FXML
    private ComboBox<String> statusFilterCombo;
    @FXML
    private TableView<User> usersTable;
    @FXML
    private TableColumn<User, String> colId, colName, colEmail, colRole, colStatus, colJoined;
    @FXML
    private TableColumn<User, Void> colActions;
    @FXML
    private Label pageLabel;
    @FXML
    private Label totalLabel;

    // ── Reports ───────────────────────────────────────────────
    @FXML
    private Label reportsEmptyLabel;
    @FXML
    private Label reportsSummaryLabel;
    @FXML
    private VBox reportsListBox;

    // ── Active Locks ──────────────────────────────────────────
    @FXML
    private VBox locksListBox;
    @FXML
    private Label emptyLocksLabel;

    private final AdminUserDao adminDao = new AdminUserDao();
    private final ReportDao reportDao = new ReportDao();
    private final MessagingDao messagingDao = new MessagingDao();
    private final com.innertrack.dao.ChatLockDao chatLockDao = new com.innertrack.dao.ChatLockDao();
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("dd/MM/yyyy");
    private final DateTimeFormatter dfFull = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    private int currentPage = 0;
    private static final int PAGE_SIZE = 15;

    @FXML
    public void initialize() {
        User admin = SessionManager.getInstance().getCurrentUser();
        welcomeLabel.setText("Bonjour, " + admin.getFullName());
        userFullNameLabel.setText(admin.getFullName());
        updateProfileImage(admin.getProfilePicture());

        MainLayoutController.getInstance().setNavbarVisible(false);
        MainLayoutController.getInstance().setFooterVisible(false);

        new Thread(this::loadAnalytics, "admin-analytics").start();
        setupTable();
        setupFilters();
    }

    // ── Pane switching ────────────────────────────────────────

    private void setActiveBtn(Button active) {
        for (Button b : List.of(btnDashboard, btnUsers, btnReports)) {
            b.getStyleClass().remove("sidebar-button-active");
        }
        active.getStyleClass().add("sidebar-button-active");
    }

    @FXML
    private void showDashboard() {
        dashPane.setVisible(true);
        usersPane.setVisible(false);
        reportsPane.setVisible(false);
        setActiveBtn(btnDashboard);
    }

    @FXML
    private void showUsers() {
        dashPane.setVisible(false);
        usersPane.setVisible(true);
        reportsPane.setVisible(false);
        setActiveBtn(btnUsers);
        loadUsersPage();
    }

    @FXML
    private void showReports() {
        dashPane.setVisible(false);
        usersPane.setVisible(false);
        reportsPane.setVisible(true);
        setActiveBtn(btnReports);
        loadReports();
    }

    @FXML
    private void refreshReports() {
        loadReports();
    }

    // ── Analytics ─────────────────────────────────────────────

    private void loadAnalytics() {
        int total = adminDao.countAll();
        int clients = adminDao.countByRole("ROLE_USER");
        int therapists = adminDao.countByRole("ROLE_PSYCHOLOGUE");
        int newMonth = adminDao.countNewThisMonth();
        int blocked = adminDao.countByStatus("BLOCKED");
        int active = adminDao.countByStatus("ACTIVE");
        int pending = adminDao.countByStatus("PENDING");
        int pendingRep = reportDao.countPending();
        Map<String, Integer> monthly = adminDao.registrationsPerMonth();

        Platform.runLater(() -> {
            totalUsersLabel.setText(String.valueOf(total));
            totalClientsLabel.setText(String.valueOf(clients));
            totalTherapistsLabel.setText(String.valueOf(therapists));
            newThisMonthLabel.setText(String.valueOf(newMonth));
            blockedLabel.setText(String.valueOf(blocked));
            activeCountLabel.setText(String.valueOf(active));
            pendingCountLabel.setText(String.valueOf(pending));
            blockedCountLabel.setText(String.valueOf(blocked));
            buildChart(monthly);

            // Reports badge
            if (pendingRep > 0) {
                reportsBadge.setText(String.valueOf(pendingRep));
                reportsBadge.setVisible(true);
                reportsBadge.setManaged(true);
            }
        });
    }

    private void buildChart(Map<String, Integer> data) {
        registrationsChart.getData().clear();
        XYChart.Series<String, Number> series = new XYChart.Series<>();
        series.setName("Inscriptions");
        data.forEach((month, count) -> series.getData().add(new XYChart.Data<>(month, count)));
        registrationsChart.getData().add(series);
        registrationsChart.setLegendVisible(false);
        registrationsChart.setAnimated(false);
    }

    // ── Reports ───────────────────────────────────────────────

    private void loadReports() {
        new Thread(() -> {
            List<Report> reports = reportDao.getAllReports();
            int pending = reportDao.countPending();
            Platform.runLater(() -> {
                reportsSummaryLabel.setText(pending + " en attente · " + reports.size() + " au total");
                reportsListBox.getChildren().clear();
                if (reports.isEmpty()) {
                    reportsEmptyLabel.setVisible(true);
                    reportsEmptyLabel.setManaged(true);
                } else {
                    reportsEmptyLabel.setVisible(false);
                    reportsEmptyLabel.setManaged(false);
                    reports.forEach(r -> reportsListBox.getChildren().add(buildReportCard(r)));
                }
                if (pending > 0) {
                    reportsBadge.setText(String.valueOf(pending));
                    reportsBadge.setVisible(true);
                    reportsBadge.setManaged(true);
                } else {
                    reportsBadge.setVisible(false);
                    reportsBadge.setManaged(false);
                }
            });
        }, "load-reports").start();
    }

    @FXML
    private void loadActiveLocksTab(javafx.event.Event event) {
        if (event.getSource() instanceof javafx.scene.control.Tab selectedTab && selectedTab.isSelected()) {
            loadActiveLocks();
        }
    }

    private void loadActiveLocks() {
        new Thread(() -> {
            List<com.innertrack.model.ChatLock> locks = chatLockDao.getAllActiveLocks();
            Platform.runLater(() -> {
                locksListBox.getChildren().clear();
                if (locks.isEmpty()) {
                    emptyLocksLabel.setVisible(true);
                    emptyLocksLabel.setManaged(true);
                } else {
                    emptyLocksLabel.setVisible(false);
                    emptyLocksLabel.setManaged(false);
                    for (com.innertrack.model.ChatLock lock : locks) {
                        locksListBox.getChildren().add(buildLockCard(lock));
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

        header.getChildren().addAll(
                badge("🔒 LOCKED", "#fc8181"));

        Label nameLbl = new Label("Patient: " + lock.getUserName());
        nameLbl.setStyle("-fx-font-weight: bold; -fx-font-size: 14px; -fx-text-fill: #2d3748;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        header.getChildren().addAll(nameLbl, spacer);

        HBox details = new HBox(20);
        VBox reasonBox = labeledValue("Reason", lock.getReason());

        String duration = lock.isPermanent() ? "Permanent" : lock.getLockedUntil().format(dfFull);
        VBox durationBox = labeledValue("Locked Until", duration);

        VBox issuedBox = labeledValue("Issued At", lock.getLockedAt() != null ? lock.getLockedAt().format(df) : "—");

        details.getChildren().addAll(reasonBox, durationBox, issuedBox);

        HBox actions = new HBox(12);
        actions.setAlignment(Pos.CENTER_RIGHT);

        Button unlockBtn = actionBtn("🔓 Retirer la punition (Unlock)", "#48bb78");
        unlockBtn.setOnAction(e -> {
            chatLockDao.unlockUser(lock.getId());
            messagingDao.createNotification(new com.innertrack.model.Notification(
                    lock.getUserId(), "SYSTEM",
                    "Punishment Removed",
                    "Your community posting lock has been removed early by an administrator.",
                    0));
            loadActiveLocks();
        });

        actions.getChildren().add(unlockBtn);
        card.getChildren().addAll(header, new Separator(), details, actions);
        return card;
    }

    private VBox buildReportCard(Report report) {
        VBox card = new VBox(12);
        card.setPadding(new Insets(18));
        card.setStyle("-fx-background-color: white; -fx-background-radius: 12;" +
                "-fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.07), 8, 0, 0, 2);");

        String badgeColor = switch (report.getStatus()) {
            case "REVIEWED" -> "#48bb78";
            case "DISMISSED" -> "#a0aec0";
            default -> "#f6ad55";
        };

        // Header row
        HBox header = new HBox(10);
        header.setAlignment(Pos.CENTER_LEFT);

        boolean isCommunity = "COMMUNITY".equalsIgnoreCase(report.getContext());

        header.getChildren().addAll(
                badge("⚠ " + report.getReasonLabel(), "#fc8181"),
                badge(isCommunity ? "🌐 Communauté" : "💬 Message Privé", isCommunity ? "#8b5cf6" : "#4299e1"),
                badge(report.getStatus(), badgeColor));
        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        Label dateL = new Label(report.getCreatedAt() != null
                ? report.getCreatedAt().format(dfFull)
                : "");
        dateL.setStyle("-fx-text-fill: #a0aec0; -fx-font-size: 11px;");
        header.getChildren().addAll(spacer, dateL);

        // People
        HBox people = new HBox(20);
        people.setAlignment(Pos.CENTER_LEFT);
        people.getChildren().addAll(
                labeledValue("Signalé par", report.getReporterName()),
                new Label("→"),
                labeledValue("Patient signalé", report.getReportedName()));

        // Details
        VBox detailsBox = new VBox(4);
        if (report.getDetails() != null && !report.getDetails().isBlank()) {
            Label t = new Label("Détails :");
            t.setStyle("-fx-font-weight: bold; -fx-text-fill: #4a5568; -fx-font-size: 12px;");
            Label d = new Label(report.getDetails());
            d.setWrapText(true);
            d.setStyle("-fx-text-fill: #718096; -fx-font-size: 13px;");
            detailsBox.getChildren().addAll(t, d);
        }

        card.getChildren().addAll(header, new Separator(), people, detailsBox);

        // Actions — only PENDING
        if ("PENDING".equals(report.getStatus())) {
            HBox actions = new HBox(10);
            actions.setAlignment(Pos.CENTER_RIGHT);
            int adminId = SessionManager.getInstance().getCurrentUser().getId();

            if (!isCommunity) {
                Button chatBtn = actionBtn("💬 Voir messages", "#4299e1");
                chatBtn.setOnAction(e -> showChatDialog(report));
                actions.getChildren().add(chatBtn);
            }

            Button banBtn = actionBtn("🚫 Bannir le patient", "#fc8181");
            Button warnBtn = actionBtn("⚠ Avertir seulement", "#f6ad55");
            Button dismissBtn = actionBtn("✓ Rejeter", "#e2e8f0");
            dismissBtn.setStyle(dismissBtn.getStyle() + "-fx-text-fill: #4a5568;");

            banBtn.setOnAction(e -> {
                adminDao.setUserStatus(report.getReportedId(), "BLOCKED");
                messagingDao.createNotification(new Notification(
                        report.getReportedId(), "SYSTEM", "Compte bloqué",
                        "Votre compte a été bloqué suite à un signalement.", 0));
                reportDao.reviewReport(report.getId(), adminId, "REVIEWED");
                loadReports();
            });
            warnBtn.setOnAction(e -> {
                messagingDao.createNotification(new Notification(
                        report.getReportedId(), "SYSTEM", "Avertissement",
                        "Votre comportement a été signalé. Respectez les règles de la plateforme.", 0));
                reportDao.reviewReport(report.getId(), adminId, "REVIEWED");
                loadReports();
            });
            dismissBtn.setOnAction(e -> {
                reportDao.reviewReport(report.getId(), adminId, "DISMISSED");
                loadReports();
            });

            actions.getChildren().addAll(dismissBtn, warnBtn, banBtn);

            // Chat Lock button
            Button lockBtn = actionBtn("🔒 Lock Chat", "#8b5cf6");
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
                    chatLockDao.lockUser(report.getReportedId(),
                            "Report: " + report.getReasonLabel(), until, adminId);
                    messagingDao.createNotification(new com.innertrack.model.Notification(
                            report.getReportedId(), "SYSTEM",
                            "Community Posting Locked",
                            "Your community posting has been locked" +
                                    (until != null ? " until " + until.format(dfFull) : " permanently") +
                                    ". Reason: " + report.getReasonLabel(),
                            0));
                    reportDao.reviewReport(report.getId(), adminId, "REVIEWED");
                    loadReports();
                });
            });
            actions.getChildren().add(lockBtn);

            card.getChildren().add(actions);
        }

        return card;
    }

    private void showChatDialog(Report report) {
        com.innertrack.model.Conversation conv = messagingDao.getConversationBetween(report.getReporterId(),
                report.getReportedId());
        if (conv == null) {
            new Alert(Alert.AlertType.INFORMATION, "Aucune conversation trouvée entre ces deux utilisateurs.")
                    .showAndWait();
            return;
        }

        List<com.innertrack.model.Message> messages = messagingDao.getMessages(conv.getId());
        if (messages.isEmpty()) {
            new Alert(Alert.AlertType.INFORMATION, "La conversation est vide.").showAndWait();
            return;
        }

        Stage dialog = new Stage();
        dialog.initModality(Modality.APPLICATION_MODAL);
        dialog.setTitle("Historique des messages - Signalement");

        VBox chatBox = new VBox(10);
        chatBox.getStyleClass().add("chat-dialog-box");
        chatBox.setPadding(new Insets(15));

        for (com.innertrack.model.Message msg : messages) {
            VBox msgBox = new VBox(2);
            msgBox.getStyleClass().add("chat-message-container");
            Label senderLabel = new Label(msg.getSenderName() + " (" + msg.getSentAt().format(dfFull) + ")");
            senderLabel.getStyleClass().add("chat-message-sender");

            Label contentLabel = new Label(msg.getContent());
            contentLabel.setWrapText(true);
            contentLabel.getStyleClass().add("chat-message-content");

            // Align self vs other based on reported user
            if (msg.getSenderId() == report.getReportedId()) {
                msgBox.setAlignment(Pos.CENTER_LEFT);
                msgBox.getStyleClass().add("reported-user-message");
            } else {
                msgBox.setAlignment(Pos.CENTER_RIGHT);
                msgBox.getStyleClass().add("other-user-message");
            }

            msgBox.getChildren().addAll(senderLabel, contentLabel);
            chatBox.getChildren().add(msgBox);
        }

        ScrollPane scroll = new ScrollPane(chatBox);
        scroll.getStyleClass().add("chat-scroll-pane");
        scroll.setFitToWidth(true);
        Scene scene = new Scene(scroll, 500, 600);

        // Match main window theme
        if (profileCircle.getScene() != null) {
            scene.getStylesheets().addAll(profileCircle.getScene().getStylesheets());
        }

        dialog.setScene(scene);
        dialog.show();
    }

    // ── User management ───────────────────────────────────────

    private void setupFilters() {
        roleFilterCombo.setItems(FXCollections.observableArrayList(
                "", "ROLE_USER", "ROLE_PSYCHOLOGUE", "ROLE_ADMIN"));
        roleFilterCombo.setPromptText("Tous les rôles");
        statusFilterCombo.setItems(FXCollections.observableArrayList(
                "", "ACTIVE", "PENDING", "BLOCKED"));
        statusFilterCombo.setPromptText("Tous les statuts");
    }

    private void setupTable() {
        colId.setCellValueFactory(d -> new SimpleStringProperty(String.valueOf(d.getValue().getId())));
        colName.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getFullName()));
        colEmail.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getEmail()));
        colRole.setCellValueFactory(d -> {
            List<String> roles = d.getValue().getRoles();
            String role = (roles != null && !roles.isEmpty())
                    ? roles.get(0).replace("ROLE_", "")
                    : "—";
            return new SimpleStringProperty(role);
        });
        colStatus.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getStatus()));
        colJoined.setCellValueFactory(d -> {
            String date = d.getValue().getCreatedAt() != null
                    ? d.getValue().getCreatedAt().format(df)
                    : "—";
            return new SimpleStringProperty(date);
        });

        colStatus.setCellFactory(col -> new TableCell<>() {
            @Override
            protected void updateItem(String status, boolean empty) {
                super.updateItem(status, empty);
                if (empty || status == null) {
                    setText(null);
                    setStyle("");
                    return;
                }
                setText(status);
                switch (status) {
                    case "ACTIVE" -> setStyle("-fx-text-fill: #27ae60; -fx-font-weight: bold;");
                    case "PENDING" -> setStyle("-fx-text-fill: #e67e22; -fx-font-weight: bold;");
                    case "BLOCKED" -> setStyle("-fx-text-fill: #e74c3c; -fx-font-weight: bold;");
                    default -> setStyle("");
                }
            }
        });

        colActions.setCellFactory(col -> new TableCell<>() {
            private final Button blockBtn = new Button();
            private final Button deleteBtn = new Button("🗑");
            private final HBox box = new HBox(6, blockBtn, deleteBtn);
            {
                box.setAlignment(Pos.CENTER);
                deleteBtn.setStyle("-fx-background-color:#e74c3c; -fx-text-fill:white;" +
                        "-fx-font-size:11px; -fx-cursor:hand; -fx-background-radius:4; -fx-padding:3 8;");
                blockBtn.setOnAction(e -> {
                    User u = getTableView().getItems().get(getIndex());
                    String newStatus = "BLOCKED".equals(u.getStatus()) ? "ACTIVE" : "BLOCKED";
                    if (adminDao.setUserStatus(u.getId(), newStatus)) {
                        u.setStatus(newStatus);
                        getTableView().refresh();
                    }
                });
                deleteBtn.setOnAction(e -> {
                    User u = getTableView().getItems().get(getIndex());
                    new Alert(Alert.AlertType.CONFIRMATION,
                            "Supprimer " + u.getFullName() + " définitivement ?",
                            ButtonType.YES, ButtonType.NO)
                            .showAndWait()
                            .filter(bt -> bt == ButtonType.YES)
                            .ifPresent(bt -> {
                                adminDao.deleteUser(u.getId());
                                loadUsersPage();
                            });
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                    return;
                }
                User u = getTableView().getItems().get(getIndex());
                boolean isBlocked = "BLOCKED".equals(u.getStatus());
                blockBtn.setText(isBlocked ? "✓ Débloquer" : "🚫 Bloquer");
                blockBtn.setStyle("-fx-font-size:11px; -fx-cursor:hand; -fx-padding:3 8;" +
                        "-fx-background-radius:4;" +
                        (isBlocked ? "-fx-background-color:#27ae60; -fx-text-fill:white;"
                                : "-fx-background-color:#e67e22; -fx-text-fill:white;"));
                setGraphic(box);
            }
        });
    }

    private void loadUsersPage() {
        String search = searchField.getText();
        String role = roleFilterCombo.getValue();
        String status = statusFilterCombo.getValue();
        new Thread(() -> {
            List<User> users = adminDao.searchUsers(search, role, status, currentPage, PAGE_SIZE);
            int total = adminDao.countSearch(search, role, status);
            int pages = (int) Math.ceil((double) total / PAGE_SIZE);
            Platform.runLater(() -> {
                usersTable.setItems(FXCollections.observableArrayList(users));
                pageLabel.setText("Page " + (currentPage + 1) + " / " + Math.max(1, pages));
                totalLabel.setText("(" + total + " utilisateurs)");
            });
        }, "load-users-thread").start();
    }

    @FXML
    private void handleSearch() {
        currentPage = 0;
        loadUsersPage();
    }

    @FXML
    private void handleResetFilters() {
        searchField.clear();
        roleFilterCombo.setValue(null);
        statusFilterCombo.setValue(null);
        currentPage = 0;
        loadUsersPage();
    }

    @FXML
    private void handlePrevPage() {
        if (currentPage > 0) {
            currentPage--;
            loadUsersPage();
        }
    }

    @FXML
    private void handleNextPage() {
        currentPage++;
        loadUsersPage();
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
    private void handleLogout() {
        SessionManager.getInstance().cleanSession();
        ViewManager.loadView("login");
    }

    // ── Helpers ───────────────────────────────────────────────

    private Label badge(String text, String color) {
        Label l = new Label(text);
        l.setStyle("-fx-background-color: " + color + "; -fx-text-fill: white;" +
                "-fx-background-radius: 12; -fx-padding: 3 10;" +
                "-fx-font-size: 11px; -fx-font-weight: bold;");
        return l;
    }

    private Button actionBtn(String text, String bg) {
        Button b = new Button(text);
        b.setStyle("-fx-background-color: " + bg + "; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-background-radius: 8;" +
                "-fx-padding: 8 16; -fx-cursor: hand;");
        return b;
    }

    private VBox labeledValue(String label, String value) {
        VBox box = new VBox(2);
        Label l = new Label(label);
        l.setStyle("-fx-text-fill: #a0aec0; -fx-font-size: 11px;");
        Label v = new Label(value != null ? value : "—");
        v.setStyle("-fx-font-weight: bold; -fx-text-fill: #2d3748; -fx-font-size: 14px;");
        box.getChildren().addAll(l, v);
        return box;
    }

    private void updateProfileImage(String picPath) {
        if (picPath == null || picPath.isEmpty())
            return;
        try {
            java.io.File file = new java.io.File(picPath);
            if (file.exists()) {
                try (java.io.FileInputStream fis = new java.io.FileInputStream(file)) {
                    javafx.scene.image.Image image = new javafx.scene.image.Image(fis);
                    profileCircle.setFill(
                            new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                }
            }
        } catch (Exception e) {
            System.err.println("Error loading admin profile image: " + e.getMessage());
        }
    }
}