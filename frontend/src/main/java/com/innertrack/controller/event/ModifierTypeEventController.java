package com.innertrack.controller.event;

import com.innertrack.model.TypeEvent;
import com.innertrack.service.TypeEventService;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.stage.Stage;

import java.sql.SQLException;

public class ModifierTypeEventController {

    private final TypeEventService service = new TypeEventService();
    private TypeEvent typeToEdit;

    @FXML
    private TextField libelle_input;
    @FXML
    private Label error_label;

    public void setTypeEvent(TypeEvent t) {
        this.typeToEdit = t;
        libelle_input.setText(t.getLibelle());
    }

    @FXML
    void submit(ActionEvent e) {
        if (typeToEdit == null) {
            showError("Aucun type sélectionné.");
            return;
        }

        String lib = libelle_input.getText() == null ? "" : libelle_input.getText().trim();
        if (lib.length() < 3) {
            showError("Libellé min 3 caractères.");
            return;
        }

        try {
            typeToEdit.setLibelle(lib);
            service.modifier(typeToEdit);
            back(null);
        } catch (SQLException ex) {
            showError("DB error: " + ex.getMessage());
        }
    }

    @FXML
    void back(ActionEvent e) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/event/AfficherTypeEvent.fxml"));
            Parent root = loader.load();
            Stage stage = (Stage) libelle_input.getScene().getWindow();
            stage.setScene(new Scene(root));
            stage.setTitle("Liste TypeEvent");
            stage.show();
        } catch (Exception ex) {
            showError("Navigation error: " + ex.getMessage());
        }
    }

    private void showError(String msg) {
        error_label.setText(msg);
        error_label.setVisible(true);
    }
}