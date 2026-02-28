package com.innertrack.controller.journal;

import com.innertrack.model.EntreeJournal;
import com.innertrack.service.JournalService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import java.sql.SQLException;
import java.time.LocalDate;

public class AjoutJournalController {

    @FXML
    private Slider humeurSlider;
    @FXML
    private Label humeurValueLabel;
    @FXML
    private Label humeurIndicateurLabel;
    @FXML
    private TextArea noteTextArea;
    @FXML
    private DatePicker datePicker;
    @FXML
    private Label descErrorLabel;
    @FXML
    private Label dateErrorLabel;
    @FXML
    private Button btnVoice;

    private JournalService journalService;
    private com.innertrack.service.TranscriptionService transcriptionService;
    private boolean isRecording = false;

    private int getCurrentUserId() {
        return SessionManager.getInstance().getCurrentUser().getId();
    }

    @FXML
    public void initialize() {
        journalService = new JournalService();
        transcriptionService = com.innertrack.service.TranscriptionService.getInstance();
        datePicker.setValue(LocalDate.now());

        humeurSlider.valueProperty().addListener((obs, oldVal, newVal) -> {
            int val = newVal.intValue();
            String emoji, label, couleur;
            if (val >= 7) {
                emoji = "\u2600\uFE0F";
                label = "Joy";
                couleur = "#f6a623";
            } else if (val >= 4) {
                emoji = "\uD83D\uDFE2";
                label = "Stable";
                couleur = "#48bb78";
            } else {
                emoji = "\uD83D\uDD35";
                label = "Sad";
                couleur = "#2b6cb0";
            }

            humeurValueLabel.setText(emoji + " " + val);
            humeurValueLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: " + couleur + ";");

            humeurIndicateurLabel.setVisible(true);
            humeurIndicateurLabel.setText(emoji + " " + label);
            humeurIndicateurLabel.setStyle("-fx-font-size: 12px; -fx-font-weight: bold; -fx-background-radius: 12; " +
                    "-fx-padding: 3 12 3 12; -fx-text-fill: " + couleur + "; -fx-background-color: " + couleur + "22;");
        });
    }

    @FXML
    void ajouterJournal() {
        boolean valide = true;

        if (noteTextArea.getText() == null || noteTextArea.getText().trim().isEmpty()) {
            descErrorLabel.setVisible(true);
            valide = false;
        } else {
            descErrorLabel.setVisible(false);
        }

        if (datePicker.getValue() == null) {
            dateErrorLabel.setVisible(true);
            valide = false;
        } else {
            dateErrorLabel.setVisible(false);
        }

        if (!valide)
            return;

        try {
            EntreeJournal entree = new EntreeJournal(
                    (int) humeurSlider.getValue(),
                    noteTextArea.getText().trim(),
                    datePicker.getValue(),
                    getCurrentUserId());
            journalService.create(entree);

            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Success");
            alert.setContentText("Entry successfully added!");
            alert.showAndWait();

            ViewManager.loadView("journal/AffichageJournal");
        } catch (SQLException e) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setContentText("Error : " + e.getMessage());
            alert.show();
        }
    }

    @FXML
    void allerAuJournal() {
        ViewManager.loadView("journal/AffichageJournal");
    }

    @FXML
    void allerAuxHabitudes() {
        ViewManager.loadView("journal/AffichageHabitude");
    }

    @FXML
    void startVoiceInput() {
        if (!isRecording) {
            isRecording = true;
            btnVoice.setText("🛑");
            btnVoice.setStyle(
                    "-fx-font-size: 16px; -fx-background-radius: 50%; -fx-background-color: #f56565; -fx-text-fill: white;");

            transcriptionService.startTranscription(text -> {
                javafx.application.Platform.runLater(() -> {
                    String currentText = noteTextArea.getText();
                    if (currentText == null)
                        currentText = "";
                    noteTextArea.setText(currentText + (currentText.isEmpty() ? "" : " ") + text);
                });
            });
        } else {
            isRecording = false;
            transcriptionService.stopTranscription();
            btnVoice.setText("🎙");
            btnVoice.setStyle("-fx-font-size: 16px; -fx-background-radius: 50%;");
        }
    }
}
