package com.innertrack.controller.event;

import com.innertrack.service.EventService;
import com.innertrack.util.ViewNavigator;
import javafx.beans.property.SimpleBooleanProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import com.innertrack.model.Event;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import com.innertrack.util.ViewManager;
import javafx.stage.Stage;

import java.io.IOException;
import java.sql.SQLException;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.List;

import com.innertrack.config.AppConfig;
import com.innertrack.service.OpenWeatherService;

import javafx.animation.KeyFrame;
import javafx.animation.Timeline;
import javafx.application.Platform;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import java.time.Duration;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;

import com.innertrack.service.ChatbotService;
import com.innertrack.session.SessionManager;
import java.util.UUID;

public class AfficherEvenementController {

    private final com.innertrack.service.EventService eventService = new EventService();
    private final ObservableList<Event> data = FXCollections.observableArrayList();

    @FXML
    private TableView<Event> table_events;

    @FXML
    private TableColumn<Event, Void> col_participer;
    @FXML
    private TableColumn<Event, Number> col_id;
    @FXML
    private TableColumn<Event, String> col_title;
    @FXML
    private TableColumn<Event, String> col_description;
    @FXML
    private TableColumn<Event, String> col_date;
    @FXML
    private TableColumn<Event, String> col_type;
    @FXML
    private TableColumn<Event, Number> col_capacity;
    @FXML
    private TableColumn<Event, Boolean> col_status;
    @FXML
    private TableColumn<Event, LocalDate> dateCreationColumn;

    @FXML
    private Label error_label;

    @FXML
    private ImageView weatherIcon;
    @FXML
    private Label weatherTitle;
    @FXML
    private Label weatherDetails;

    private OpenWeatherService weatherService;
    private Timeline weatherRefreshTimeline;

    @FXML
    private TextArea chatArea;
    @FXML
    private TextField chatInput;
    @FXML
    private Label chatStatus;

    private final ChatbotService chatbotService = new ChatbotService();
    private String chatSessionId;

    @FXML
    private HBox adminActions;
    @FXML
    private Menu menuTypeEvent;
    @FXML
    private Menu menuInscription;

    @FXML
    void initialize() {
        // Safety: if you forgot fx:id in FXML you’ll see it immediately
        if (table_events == null)
            throw new IllegalStateException("table_events is not injected. Check fx:id in FXML.");

        DateTimeFormatter fmt = DateTimeFormatter.ofPattern("yyyy-MM-dd");

        // Map Event -> table columns
        col_id.setCellValueFactory(cell -> new SimpleIntegerProperty(cell.getValue().getIdEvent()));

        col_title.setCellValueFactory(cell -> new SimpleStringProperty(cell.getValue().getTitre()));

        col_description.setCellValueFactory(cell -> new SimpleStringProperty(cell.getValue().getDescription()));

        col_date.setCellValueFactory(cell -> {
            if (cell.getValue().getDateEvent() == null)
                return new SimpleStringProperty("");
            return new SimpleStringProperty(cell.getValue().getDateEvent().format(fmt));
        });

        col_type.setCellValueFactory(cell -> new SimpleStringProperty(
                cell.getValue().getTypeEvent() == null ? "" : cell.getValue().getTypeEvent().getLibelle()));

        col_capacity.setCellValueFactory(cell -> new SimpleIntegerProperty(cell.getValue().getCapacite()));

        col_status.setCellValueFactory(cell -> new SimpleBooleanProperty(cell.getValue().isStatus()));

        dateCreationColumn.setCellValueFactory(
                cell -> new javafx.beans.property.SimpleObjectProperty<>(cell.getValue().getDateCreation()));

        table_events.setItems(data);
        addParticiperButtonToTable();

        // Load data
        refresh();

        initWeatherWidget();

        // Initialize chatbot session and health check
        chatSessionId = "event_chat_" + (SessionManager.getInstance().getCurrentUser() != null
                ? SessionManager.getInstance().getCurrentUser().getId()
                : UUID.randomUUID().toString());

        chatbotService.checkHealth(healthy -> {
            if (healthy) {
                chatStatus.setText("Assistant: En ligne");
                chatStatus.setStyle("-fx-text-fill: #10b981;");
            } else {
                chatStatus.setText("Assistant: Hors ligne (Clé API manquante)");
                chatStatus.setStyle("-fx-text-fill: #ef4444;");
            }
        });

        applyRolePermissions();
    }

    private void applyRolePermissions() {
        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        boolean isTherapist = user != null && user.getRoles() != null && user.getRoles().contains("ROLE_PSYCHOLOGUE");

        if (adminActions != null) {
            adminActions.setVisible(isTherapist);
            adminActions.setManaged(isTherapist);
        }
        if (menuTypeEvent != null) {
            menuTypeEvent.setVisible(isTherapist);
        }
        if (menuInscription != null) {
            menuInscription.setVisible(isTherapist);
        }
    }

    @FXML
    private void backToDashboard() {
        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        if (user == null) {
            ViewManager.loadView("login");
            return;
        }

        String dashboard = "user/dashboard";
        for (String r : user.getRoles()) {
            if (r.contains("ADMIN")) {
                dashboard = "admin/dashboard";
                break;
            } else if (r.contains("PSYCHOLOGUE")) {
                dashboard = "psychologue/dashboard";
                break;
            }
        }
        ViewManager.loadView(dashboard);
    }

    @FXML
    private void sendChatMessage() {
        String msg = chatInput.getText().trim();
        if (msg.isEmpty())
            return;

        chatInput.clear();
        appendChat("Vous: " + msg);

        chatInput.setDisable(true);

        int userId = SessionManager.getInstance().getCurrentUser() != null
                ? SessionManager.getInstance().getCurrentUser().getId()
                : 0;

        chatbotService.sendMessage(chatSessionId, msg, userId,
                reply -> {
                    appendChat("Assistant: " + reply);
                    chatInput.setDisable(false);
                    chatInput.requestFocus();
                },
                error -> {
                    appendChat("Assistant: ⚠ Erreur: " + error);
                    chatInput.setDisable(false);
                    chatInput.requestFocus();
                });
    }

    private void appendChat(String line) {
        if (chatArea != null)
            chatArea.appendText(line + "\n");
    }

    private void initWeatherWidget() {
        // Safety (si tu as oublié fx:id dans le FXML)
        if (weatherTitle == null || weatherDetails == null || weatherIcon == null) {
            System.out.println("Weather widget not injected (check fx:id weatherTitle/weatherDetails/weatherIcon).");
            return;
        }

        String apiKey = "";
        try {
            apiKey = com.innertrack.app.MainApp.getEnv("OPENWEATHER_API_KEY");
        } catch (Exception e) {
        }
        if (apiKey == null || apiKey.isEmpty())
            apiKey = "";
        String city = AppConfig.get("openweather.city");
        if (city == null || city.isEmpty())
            city = "Tunis";
        String units = AppConfig.get("openweather.units");
        if (units == null || units.isEmpty())
            units = "metric";
        String lang = AppConfig.get("openweather.lang");
        if (lang == null || lang.isEmpty())
            lang = "fr";

        weatherService = new OpenWeatherService(apiKey, city, units, lang);

        loadWeather();

        weatherRefreshTimeline = new Timeline(new KeyFrame(javafx.util.Duration.minutes(10), e -> loadWeather()));
        weatherRefreshTimeline.setCycleCount(Timeline.INDEFINITE);
        weatherRefreshTimeline.play();
    }

    private void loadWeather() {
        weatherTitle.setText("Météo (chargement...)");

        weatherService.fetchCurrent()
                .thenAccept(info -> Platform.runLater(() -> {
                    weatherTitle.setText("Météo — " + info.city);
                    weatherDetails.setText(String.format("%.1f°C • %s • Humidité %d%% • Vent %.1f m/s",
                            info.tempC, info.description, info.humidity, info.windMs));

                    if (info.iconId != null && !info.iconId.isBlank()) {
                        weatherIcon.setImage(new Image(OpenWeatherService.iconUrl(info.iconId), true));
                    } else {
                        weatherIcon.setImage(null);
                    }
                }))
                .exceptionally(ex -> {
                    Platform.runLater(() -> {
                        weatherTitle.setText("Météo (indisponible)");
                        weatherDetails.setText("Vérifie connexion / API key / ville.");
                        weatherIcon.setImage(null);
                    });
                    return null;
                });
    }

    @FXML
    private void openWeatherModal() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/event/WeatherWeekModal.fxml"));
            Parent root = loader.load();

            WeatherWeekModalController controller = loader.getController();
            controller.init(weatherService); // on réutilise ton service existant

            Stage dialog = new Stage();
            dialog.initOwner(table_events.getScene().getWindow());
            dialog.initModality(javafx.stage.Modality.WINDOW_MODAL);
            dialog.setTitle("Prévisions météo (5 jours)");
            dialog.setScene(new Scene(root));
            dialog.setResizable(false);
            dialog.showAndWait();

        } catch (IOException e) {
            e.printStackTrace();
            new Alert(Alert.AlertType.ERROR, "Impossible d’ouvrir la météo.").showAndWait();
        }
    }

    private void addParticiperButtonToTable() {
        col_participer.setCellFactory(param -> new TableCell<>() {
            private final Button btn = new Button("Participer");

            {
                btn.setOnAction(e -> {
                    Event ev = getTableView().getItems().get(getIndex());

                    // Option: bloquer si event inactif
                    if (!ev.isStatus()) {
                        new Alert(Alert.AlertType.WARNING, "Événement inactif.").showAndWait();
                        return;
                    }

                    TextInputDialog nomDialog = new TextInputDialog();
                    nomDialog.setTitle("Inscription");
                    nomDialog.setHeaderText("Participer à : " + ev.getTitre());
                    nomDialog.setContentText("Nom :");
                    var nomOpt = nomDialog.showAndWait();
                    String nom = nomOpt.get().trim();

                    if (!isValidName(nom)) {
                        new Alert(Alert.AlertType.WARNING,
                                "Nom invalide !\nSeulement des lettres, minimum 3 caractères.")
                                .showAndWait();
                        return;
                    }
                    TextInputDialog emailDialog = new TextInputDialog();
                    emailDialog.setTitle("Inscription");
                    emailDialog.setHeaderText("Participer à : " + ev.getTitre());
                    emailDialog.setContentText("Email :");
                    var emailOpt = emailDialog.showAndWait();
                    String email = emailOpt.get().trim();

                    if (!isValidEmail(email)) {
                        new Alert(Alert.AlertType.WARNING,
                                "Email invalide !\nExemple: test@gmail.com")
                                .showAndWait();
                        return;
                    }
                    try {
                        new com.innertrack.service.InscriptionService()
                                .participer(ev.getIdEvent(), nomOpt.get().trim(), emailOpt.get().trim());

                        new Alert(Alert.AlertType.INFORMATION, "Inscription réussie ✅").showAndWait();
                    } catch (java.sql.SQLIntegrityConstraintViolationException dup) {
                        new Alert(Alert.AlertType.WARNING, "Déjà inscrit avec cet email.").showAndWait();
                    } catch (Exception ex) {
                        new Alert(Alert.AlertType.ERROR, "Erreur: " + ex.getMessage()).showAndWait();
                    }
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : btn);
            }
        });
    }

    private boolean isValidName(String name) {
        return name.matches("^[A-Za-zÀ-ÿ ]{3,}$");
    }

    private boolean isValidEmail(String email) {
        return email.matches("^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+$");
    }

    @FXML
    public void refresh() {
        try {
            error_label.setText("");
            error_label.setVisible(false);

            data.clear();

            // IMPORTANT: you must have a method in EventService that returns List<Event>
            List<Event> events = eventService.recuperer();
            data.addAll(events);

        } catch (SQLException e) {
            error_label.setText("DB error: " + e.getMessage());
            error_label.setVisible(true);
            e.printStackTrace();
        }
    }

    @FXML
    public void deleteSelected() {
        Event selected = table_events.getSelectionModel().getSelectedItem();
        if (selected == null) {
            error_label.setText("Select an event first.");
            error_label.setVisible(true);
            return;
        }

        try {
            eventService.supprimer(selected.getIdEvent()); // you need supprimer(id)
            refresh();
        } catch (SQLException e) {
            error_label.setText("Delete error: " + e.getMessage());
            error_label.setVisible(true);
            e.printStackTrace();
        }

    }

    @FXML
    public void gotoDashboard() {
        ViewNavigator.navigateToDashboard();
    }

    @FXML
    public void handleAjouterEvenement(javafx.event.ActionEvent actionEvent) {
        ViewManager.loadView("event/AjouterEvenement");
    }

    @FXML
    public void handleModifierEvenement(ActionEvent actionEvent) {
        Event selected = table_events.getSelectionModel().getSelectedItem();

        if (selected == null) {
            error_label.setText("Select an event to modify.");
            error_label.setVisible(true);
            return;
        }

        ModifierEvenementController controller = ViewManager.loadView("event/ModifierEvenement");
        if (controller != null) {
            controller.setEvent(selected);
        }
    }

    @FXML
    public void handleTypeEvent(javafx.event.ActionEvent actionEvent) {
        ViewManager.loadView("event/AfficherTypeEvent");
    }

    @FXML
    public void goToInscriptions(ActionEvent actionEvent) {
        ViewManager.loadView("event/AfficherInscription");
    }

    @FXML
    private VBox chatOverlay;
    @FXML
    private Button chatBubble;

    @FXML
    private void toggleChat() {
        boolean show = !chatOverlay.isVisible();
        chatOverlay.setVisible(show);
        chatOverlay.setManaged(show); // important (sinon layout reserve place)

        // optionnel: changer l'icône/badge
        // chatBubble.setText(show ? "✕" : "💬");

        if (show) {
            chatInput.requestFocus();
        }
    }
}