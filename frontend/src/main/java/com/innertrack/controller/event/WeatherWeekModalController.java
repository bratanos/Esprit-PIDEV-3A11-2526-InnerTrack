package com.innertrack.controller.event;

import com.innertrack.dto.ForecastDay;
import com.innertrack.service.OpenWeatherService;
import javafx.application.Platform;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.stage.Stage;

import java.time.format.DateTimeFormatter;
import java.util.List;

public class WeatherWeekModalController {

    @FXML
    private Label statusLabel;
    @FXML
    private ProgressIndicator loading;

    @FXML
    private TableView<ForecastDay> weekTable;
    @FXML
    private TableColumn<ForecastDay, String> cDate;
    @FXML
    private TableColumn<ForecastDay, String> cMin;
    @FXML
    private TableColumn<ForecastDay, String> cMax;
    @FXML
    private TableColumn<ForecastDay, String> cDesc;

    private OpenWeatherService service;
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    public void init(OpenWeatherService service) {
        this.service = service;

        cDate.setCellValueFactory(c -> new SimpleStringProperty(c.getValue().date.format(df)));
        cMin.setCellValueFactory(c -> new SimpleStringProperty(String.format("%.1f", c.getValue().minC)));
        cMax.setCellValueFactory(c -> new SimpleStringProperty(String.format("%.1f", c.getValue().maxC)));
        cDesc.setCellValueFactory(c -> new SimpleStringProperty(c.getValue().description));

        loadWeek();
    }

    private void loadWeek() {
        loading.setVisible(true);
        statusLabel.setText("Chargement...");

        service.fetchWeekDaily()
                .thenAccept(days -> Platform.runLater(() -> {
                    weekTable.setItems(FXCollections.observableArrayList(days));
                    loading.setVisible(false);
                    statusLabel.setText(days.isEmpty() ? "Aucune donnée." : "OK");
                }))
                .exceptionally(ex -> {
                    Platform.runLater(() -> {
                        loading.setVisible(false);
                        statusLabel.setText("Indisponible (connexion / API key / ville).");
                        weekTable.setItems(FXCollections.observableArrayList(List.of()));
                    });
                    return null;
                });
    }

    @FXML
    private void close() {
        ((Stage) statusLabel.getScene().getWindow()).close();
    }
}