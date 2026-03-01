package com.innertrack.controller.event;

import com.innertrack.model.TypeEvent;
import com.innertrack.service.TypeEventService;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Stage;

import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

public class AfficherTypeEventController {

    private final TypeEventService typeEventService = new TypeEventService();
    private final ObservableList<TypeEvent> data = FXCollections.observableArrayList();

    @FXML
    private TableView<TypeEvent> table_types;
    @FXML
    private TableColumn<TypeEvent, Number> col_id;
    @FXML
    private TableColumn<TypeEvent, String> col_libelle;
    @FXML
    private Label error_label;

    @FXML
    void initialize() {
        col_id.setCellValueFactory(cell -> new SimpleIntegerProperty(cell.getValue().getIdTypeEvent()));
        col_libelle.setCellValueFactory(cell -> new SimpleStringProperty(cell.getValue().getLibelle()));
        table_types.setItems(data);
        refresh();
    }

    @FXML
    public void refresh() {
        try {
            error_label.setVisible(false);
            data.clear();
            List<TypeEvent> list = typeEventService.recuperer();
            data.addAll(list);
        } catch (SQLException e) {
            showError("DB error: " + e.getMessage());
        }
    }

    @FXML
    void handleSupprimer(ActionEvent event) {
        TypeEvent selected = table_types.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showError("Sélectionne un type d'abord.");
            return;
        }

        try {
            typeEventService.supprimer(selected.getIdTypeEvent());
            refresh();
        } catch (SQLException e) {
            // Si FK utilisée par event => MySQL va refuser
            showError("Suppression impossible: " + e.getMessage());
        }
    }

    @FXML
    void handleAjouter(ActionEvent event) {
        openPage("/fxml/event/AjouterTypeEvent.fxml", "Ajouter TypeEvent");
    }

    @FXML
    void handleModifier(ActionEvent event) {
        TypeEvent selected = table_types.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showError("Sélectionne un type à modifier.");
            return;
        }

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/event/ModifierTypeEvent.fxml"));
            Parent root = loader.load();

            ModifierTypeEventController controller = loader.getController();
            controller.setTypeEvent(selected);

            Stage stage = (Stage) table_types.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Modifier TypeEvent");
            stage.show();
        } catch (Exception e) {
            showError("Erreur navigation: " + e.getMessage());
        }
    }

    private void openPage(String fxml, String title) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxml));
            Parent root = loader.load();
            Stage stage = (Stage) table_types.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle(title);
            stage.show();
        } catch (Exception e) {
            showError("Erreur navigation: " + e.getMessage());
        }
    }

    private void showError(String msg) {
        error_label.setText(msg);
        error_label.setVisible(true);
    }

    @FXML
    private void handleRetour(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/event/AfficherEvenement.fxml"));
            Parent root = loader.load();

            Stage stage = (Stage) ((Node) event.getSource()).getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.show();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}