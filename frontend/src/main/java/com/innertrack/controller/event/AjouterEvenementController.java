package com.innertrack.controller.event;

import com.innertrack.model.Event;
import com.innertrack.model.TypeEvent;
import com.innertrack.service.EventService;
import com.innertrack.service.TypeEventService;
import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.ListCell;
import com.innertrack.util.ViewManager;
import javafx.stage.Stage;
import java.sql.SQLException;
import java.time.LocalDate;

public class AjouterEvenementController {

    private final EventService eventService = new EventService();
    private final TypeEventService typeEventService = new TypeEventService();

    @FXML
    private TextField title_input;
    @FXML
    private TextArea description_input;
    @FXML
    private DatePicker date_input;

    // ✅ CHANGED
    @FXML
    private ComboBox<TypeEvent> type_combobox;

    @FXML
    private TextField capacity_input;
    @FXML
    private Label error;

    @FXML
    void initialize() {
        // Set CellFactory to display libelle
        type_combobox.setCellFactory(lv -> new ListCell<TypeEvent>() {
            @Override
            protected void updateItem(TypeEvent item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? "" : item.getLibelle());
            }
        });
        type_combobox.setButtonCell(new ListCell<TypeEvent>() {
            @Override
            protected void updateItem(TypeEvent item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? "" : item.getLibelle());
            }
        });

        loadTypeEvents();
    }

    private void loadTypeEvents() {
        try {
            type_combobox.setItems(FXCollections.observableArrayList(typeEventService.recuperer()));
        } catch (SQLException e) {
            showError("Erreur chargement types: " + e.getMessage());
        }
    }

    @FXML
    void submit_event(ActionEvent event) {
        try {
            if (!validateForm())
                return;

            Event ev = new Event();
            ev.setTitre(title_input.getText().trim());
            ev.setDescription(description_input.getText().trim());
            ev.setDateEvent(date_input.getValue());
            ev.setTypeEvent(type_combobox.getValue()); // ✅ objet TypeEvent
            ev.setDateCreation(LocalDate.now());
            ev.setCapacite(Integer.parseInt(capacity_input.getText().trim()));
            ev.setStatut(true);

            eventService.ajouter(ev);

            goToAfficher();
        } catch (SQLException e) {
            showError("DB error: " + e.getMessage());
        } catch (Exception e) {
            showError("Erreur: " + e.getMessage());
        }
    }

    private void goToAfficher() {
        ViewManager.loadView("event/AfficherEvenement");
    }

    @FXML
    void reset_input(ActionEvent event) {
        title_input.clear();
        description_input.clear();
        date_input.setValue(null);
        type_combobox.getSelectionModel().clearSelection();
        capacity_input.clear();
        error.setVisible(false);
        resetFieldStyles();
    }

    private boolean validateForm() {

        error.setVisible(false);
        resetFieldStyles();

        if (title_input.getText() == null || title_input.getText().trim().length() < 3) {
            showError("Title must contain at least 3 characters");
            markInvalid(title_input);
            return false;
        }

        if (description_input.getText() == null || description_input.getText().trim().length() < 10) {
            showError("Description must contain at least 10 characters");
            markInvalid(description_input);
            return false;
        }

        if (date_input.getValue() == null) {
            showError("Please select a date");
            markInvalid(date_input);
            return false;
        }

        if (date_input.getValue().isBefore(LocalDate.now())) {
            showError("Event date cannot be in the past");
            markInvalid(date_input);
            return false;
        }

        // ✅ TYPE OBJECT
        if (type_combobox.getValue() == null) {
            showError("Please select event type");
            markInvalid(type_combobox);
            return false;
        }

        if (capacity_input.getText() == null || !capacity_input.getText().trim().matches("\\d+")) {
            showError("Capacity must be a number");
            markInvalid(capacity_input);
            return false;
        }

        int capacity = Integer.parseInt(capacity_input.getText().trim());
        if (capacity <= 0) {
            showError("Capacity must be greater than 0");
            markInvalid(capacity_input);
            return false;
        }

        return true;
    }

    private void resetFieldStyles() {
        title_input.setStyle(null);
        description_input.setStyle(null);
        date_input.setStyle(null);
        type_combobox.setStyle(null);
        capacity_input.setStyle(null);
    }

    private void showError(String message) {
        error.setText(message);
        error.setVisible(true);
    }

    private void markInvalid(Control field) {
        field.setStyle("-fx-border-color: red; -fx-border-width: 2;");
    }

    // Si tu réutilises l'écran "Ajouter" pour edit
    public void setEventToEdit(Event selected) {

        title_input.setText(selected.getTitre());
        description_input.setText(selected.getDescription());
        date_input.setValue(selected.getDateEvent());
        capacity_input.setText(String.valueOf(selected.getCapacite()));

        // ✅ sélectionner le bon TypeEvent par id
        if (selected.getTypeEvent() != null) {
            for (TypeEvent t : type_combobox.getItems()) {
                if (t.getIdTypeEvent() == selected.getTypeEvent().getIdTypeEvent()) {
                    type_combobox.getSelectionModel().select(t);
                    break;
                }
            }
        }
    }

    @FXML
    void back(ActionEvent e) {
        ViewManager.loadView("event/AfficherEvenement");
    }
}