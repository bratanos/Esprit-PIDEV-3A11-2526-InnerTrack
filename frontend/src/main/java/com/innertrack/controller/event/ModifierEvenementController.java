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
import javafx.scene.control.ComboBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.ListCell;
import javafx.scene.text.Text;
import com.innertrack.util.ViewManager;
import javafx.stage.Stage;

import java.sql.SQLException;

public class ModifierEvenementController {

    private final EventService eventService = new EventService();

    private Event eventToEdit; // ← receives selected event

    @FXML
    private TextField title_input;
    @FXML
    private TextArea description_input;
    @FXML
    private DatePicker date_input;
    @FXML
    private ComboBox<TypeEvent> type_combobox;
    @FXML
    private TextField capacity_input;
    @FXML
    private Text error;

    private final TypeEventService typeEventService = new TypeEventService();

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

        try {
            type_combobox.setItems(FXCollections.observableArrayList(typeEventService.recuperer()));
        } catch (SQLException e) {
            error.setText("Erreur chargement types: " + e.getMessage());
            error.setVisible(true);
        }
    }

    // =========================================================
    // RECEIVE EVENT FROM TABLE
    // =========================================================
    public void setEvent(Event e) {
        this.eventToEdit = e;

        title_input.setText(e.getTitre());
        description_input.setText(e.getDescription());
        date_input.setValue(e.getDateEvent());
        capacity_input.setText(String.valueOf(e.getCapacite()));

        if (e.getTypeEvent() != null) {
            // sélection par id
            for (TypeEvent t : type_combobox.getItems()) {
                if (t.getIdTypeEvent() == e.getTypeEvent().getIdTypeEvent()) {
                    type_combobox.getSelectionModel().select(t);
                    break;
                }
            }
        }
    }

    // =========================================================
    // UPDATE EVENT
    // =========================================================
    @FXML
    void modifier_event(ActionEvent event) throws SQLException {

        if (!validateForm())
            return;

        eventToEdit.setTitre(title_input.getText());
        eventToEdit.setDescription(description_input.getText());
        eventToEdit.setDateEvent(date_input.getValue());
        eventToEdit.setTypeEvent(type_combobox.getValue());
        eventToEdit.setCapacite(Integer.parseInt(capacity_input.getText()));
        eventService.modifier(eventToEdit);

        goBack();
    }

    private void goBack() {
        ViewManager.loadView("event/AfficherEvenement");
    }

    private boolean validateForm() {

        if (title_input.getText().isEmpty() ||
                description_input.getText().isEmpty() ||
                date_input.getValue() == null ||
                type_combobox.getValue() == null ||
                capacity_input.getText().isEmpty()) {

            error.setText("All fields must be filled");
            error.setVisible(true);
            return false;
        }

        try {
            int capacity = Integer.parseInt(capacity_input.getText());
            if (capacity <= 0) {
                error.setText("Capacity must be positive");
                error.setVisible(true);
                return false;
            }
        } catch (NumberFormatException e) {
            error.setText("Capacity must be a number");
            error.setVisible(true);
            return false;
        }

        return true;
    }

    @FXML
    void back(ActionEvent e) {
        ViewManager.loadView("event/AfficherEvenement");
    }

    private void showError(String s) {

    }
}