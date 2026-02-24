package com.innertrack.controller.admin;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.AdminUserDao;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.chart.BarChart;
import javafx.scene.chart.XYChart;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;

import java.time.format.DateTimeFormatter;
import java.util.List;
import java.util.Map;

public class AdminDashboardController {

    // ── Sidebar / Header ─────────────────────────────────────
    @FXML private javafx.scene.shape.Circle profileCircle;
    @FXML private Label userFullNameLabel;
    @FXML private Label welcomeLabel;

    // ── Pane switching ────────────────────────────────────────
    @FXML private ScrollPane dashPane;
    @FXML private VBox       usersPane;
    @FXML private Button     btnDashboard;
    @FXML private Button     btnUsers;

    // ── Analytics labels ─────────────────────────────────────
    @FXML private Label totalUsersLabel;
    @FXML private Label totalClientsLabel;
    @FXML private Label totalTherapistsLabel;
    @FXML private Label newThisMonthLabel;
    @FXML private Label blockedLabel;
    @FXML private Label activeCountLabel;
    @FXML private Label pendingCountLabel;
    @FXML private Label blockedCountLabel;
    @FXML private BarChart<String, Number> registrationsChart;

    // ── User management ───────────────────────────────────────
    @FXML private TextField searchField;
    @FXML private ComboBox<String> roleFilterCombo;
    @FXML private ComboBox<String> statusFilterCombo;
    @FXML private TableView<User> usersTable;
    @FXML private TableColumn<User, String> colId;
    @FXML private TableColumn<User, String> colName;
    @FXML private TableColumn<User, String> colEmail;
    @FXML private TableColumn<User, String> colRole;
    @FXML private TableColumn<User, String> colStatus;
    @FXML private TableColumn<User, String> colJoined;
    @FXML private TableColumn<User, Void>   colActions;
    @FXML private Label pageLabel;
    @FXML private Label totalLabel;

    private final AdminUserDao adminDao = new AdminUserDao();
    private final DateTimeFormatter df  = DateTimeFormatter.ofPattern("dd/MM/yyyy");

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

        // Load analytics on background thread
        new Thread(this::loadAnalytics, "admin-analytics").start();

        // Set up user table
        setupTable();
        setupFilters();
    }

    // ── Pane switching ────────────────────────────────────────

    @FXML
    private void showDashboard() {
        dashPane.setVisible(true);
        usersPane.setVisible(false);
        btnDashboard.getStyleClass().add("sidebar-button-active");
        btnUsers.getStyleClass().remove("sidebar-button-active");
    }

    @FXML
    private void showUsers() {
        dashPane.setVisible(false);
        usersPane.setVisible(true);
        btnUsers.getStyleClass().add("sidebar-button-active");
        btnDashboard.getStyleClass().remove("sidebar-button-active");
        loadUsersPage();
    }

    // ── Analytics ─────────────────────────────────────────────

    private void loadAnalytics() {
        int total       = adminDao.countAll();
        int clients     = adminDao.countByRole("ROLE_USER");
        int therapists  = adminDao.countByRole("ROLE_PSYCHOLOGUE");
        int newMonth    = adminDao.countNewThisMonth();
        int blocked     = adminDao.countByStatus("BLOCKED");
        int active      = adminDao.countByStatus("ACTIVE");
        int pending     = adminDao.countByStatus("PENDING");
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
        });
    }

    private void buildChart(Map<String, Integer> data) {
        registrationsChart.getData().clear();
        XYChart.Series<String, Number> series = new XYChart.Series<>();
        series.setName("Inscriptions");
        data.forEach((month, count) ->
                series.getData().add(new XYChart.Data<>(month, count)));
        registrationsChart.getData().add(series);
        registrationsChart.setLegendVisible(false);
        registrationsChart.setAnimated(false);
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
        colId.setCellValueFactory(d ->
                new SimpleStringProperty(String.valueOf(d.getValue().getId())));
        colName.setCellValueFactory(d ->
                new SimpleStringProperty(d.getValue().getFullName()));
        colEmail.setCellValueFactory(d ->
                new SimpleStringProperty(d.getValue().getEmail()));
        colRole.setCellValueFactory(d -> {
            List<String> roles = d.getValue().getRoles();
            String role = (roles != null && !roles.isEmpty())
                    ? roles.get(0).replace("ROLE_", "") : "—";
            return new SimpleStringProperty(role);
        });
        colStatus.setCellValueFactory(d ->
                new SimpleStringProperty(d.getValue().getStatus()));
        colJoined.setCellValueFactory(d -> {
            String date = d.getValue().getCreatedAt() != null
                    ? d.getValue().getCreatedAt().format(df) : "—";
            return new SimpleStringProperty(date);
        });

        // Status cell coloring
        colStatus.setCellFactory(col -> new TableCell<>() {
            @Override
            protected void updateItem(String status, boolean empty) {
                super.updateItem(status, empty);
                if (empty || status == null) { setText(null); setStyle(""); return; }
                setText(status);
                switch (status) {
                    case "ACTIVE"  -> setStyle("-fx-text-fill: #27ae60; -fx-font-weight: bold;");
                    case "PENDING" -> setStyle("-fx-text-fill: #e67e22; -fx-font-weight: bold;");
                    case "BLOCKED" -> setStyle("-fx-text-fill: #e74c3c; -fx-font-weight: bold;");
                    default        -> setStyle("");
                }
            }
        });

        // Actions column
        colActions.setCellFactory(col -> new TableCell<>() {
            private final Button blockBtn  = new Button();
            private final Button deleteBtn = new Button("🗑");
            private final HBox   box       = new HBox(6, blockBtn, deleteBtn);

            {
                box.setAlignment(Pos.CENTER);
                blockBtn.setStyle("-fx-font-size:11px; -fx-cursor:hand; -fx-padding:3 8;");
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
                    Alert confirm = new Alert(Alert.AlertType.CONFIRMATION,
                            "Supprimer " + u.getFullName() + " définitivement ?",
                            ButtonType.YES, ButtonType.NO);
                    confirm.setTitle("Confirmation");
                    confirm.showAndWait().ifPresent(bt -> {
                        if (bt == ButtonType.YES) {
                            adminDao.deleteUser(u.getId());
                            loadUsersPage();
                        }
                    });
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) { setGraphic(null); return; }
                User u = getTableView().getItems().get(getIndex());
                boolean isBlocked = "BLOCKED".equals(u.getStatus());
                blockBtn.setText(isBlocked ? "✓ Débloquer" : "🚫 Bloquer");
                blockBtn.setStyle(blockBtn.getStyle() +
                        (isBlocked ? "-fx-background-color:#27ae60; -fx-text-fill:white;"
                                : "-fx-background-color:#e67e22; -fx-text-fill:white;") +
                        "-fx-background-radius:4;");
                setGraphic(box);
            }
        });
    }

    private void loadUsersPage() {
        String search = searchField.getText();
        String role   = roleFilterCombo.getValue();
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

    @FXML private void handleSearch()       { currentPage = 0; loadUsersPage(); }
    @FXML private void handleResetFilters() {
        searchField.clear();
        roleFilterCombo.setValue(null);
        statusFilterCombo.setValue(null);
        currentPage = 0;
        loadUsersPage();
    }

    @FXML private void handlePrevPage() {
        if (currentPage > 0) { currentPage--; loadUsersPage(); }
    }

    @FXML private void handleNextPage() {
        currentPage++;
        loadUsersPage();
    }

    // ── Navigation ────────────────────────────────────────────

    @FXML private void handleGoToSettings() { ViewManager.loadView("profile/settings"); }
    @FXML private void handleLogout() {
        SessionManager.getInstance().cleanSession();
        ViewManager.loadView("login");
    }

    // ── Helpers ───────────────────────────────────────────────

    private void updateProfileImage(String picPath) {
        if (picPath == null || picPath.isEmpty()) return;
        try {
            java.io.File file = new java.io.File(picPath);
            if (file.exists()) {
                try (java.io.FileInputStream fis = new java.io.FileInputStream(file)) {
                    javafx.scene.image.Image image = new javafx.scene.image.Image(fis);
                    profileCircle.setFill(new javafx.scene.paint.ImagePattern(image, 0, 0, 1, 1, true));
                }
            }
        } catch (Exception e) {
            System.err.println("Error loading admin profile image: " + e.getMessage());
        }
    }
}