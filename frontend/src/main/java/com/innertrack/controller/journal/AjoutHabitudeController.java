package com.innertrack.controller.journal;

import com.innertrack.model.Habitude;
import com.innertrack.service.HabitudeService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import java.sql.SQLException;
import java.time.LocalDate;

public class AjoutHabitudeController {

    @FXML
    private TextField nomHabitudeField;
    @FXML
    private ComboBox<String> emotionComboBox;
    @FXML
    private TextArea noteTextArea;
    @FXML
    private Slider energieSlider;
    @FXML
    private Slider stressSlider;
    @FXML
    private Slider sommeilSlider;
    @FXML
    private DatePicker datePicker;

    @FXML
    private Label nomErrorLabel;
    @FXML
    private Label emotionErrorLabel;
    @FXML
    private Label dateErrorLabel;

    @FXML
    private Label energieValueLabel;
    @FXML
    private Label stressValueLabel;
    @FXML
    private Label sommeilValueLabel;

    @FXML
    private Label energieIndicateurLabel;
    @FXML
    private Label stressIndicateurLabel;
    @FXML
    private Label sommeilIndicateurLabel;

    private HabitudeService habitudeService;
    private com.innertrack.service.TranscriptionService transcriptionService;
    private boolean isRecording = false;

    @FXML
    private Button btnVoice;

    private int getCurrentUserId() {
        return SessionManager.getInstance().getCurrentUser().getId();
    }

    @FXML
    public void initialize() {
        habitudeService = new HabitudeService();
        transcriptionService = com.innertrack.service.TranscriptionService.getInstance();
        datePicker.setValue(LocalDate.now());

        emotionComboBox.getItems().addAll(
                "\uD83D\uDE0A Joy", "\uD83D\uDE14 Sadness", "\uD83D\uDE20 Anger",
                "\uD83D\uDE30 Anxiety", "\uD83E\uDD14 Confusion", "\uD83D\uDE0C Calm",
                "\uD83D\uDE25 Frustration", "\uD83E\uDD29 Excitement", "\uD83D\uDE34 Tired",
                "\uD83D\uDE0D Love");

        // Energy slider listener (0-10)
        energieSlider.valueProperty().addListener((obs, oldVal, newVal) -> {
            int val = newVal.intValue();
            String emoji, label, couleur;
            if (val >= 7) {
                emoji = "\uD83D\uDFE2";
                label = "Vitality";
                couleur = "#48bb78";
            } else if (val >= 4) {
                emoji = "\uD83D\uDFE1";
                label = "Average";
                couleur = "#f6ad55";
            } else {
                emoji = "\uD83D\uDD34";
                label = "Empty";
                couleur = "#ff4444";
            }
            energieValueLabel.setText(emoji + " " + val);
            energieValueLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: " + couleur + ";");
            energieIndicateurLabel.setVisible(true);
            energieIndicateurLabel.setText(emoji + " " + label);
            energieIndicateurLabel.setStyle("-fx-font-size: 12px; -fx-font-weight: bold; -fx-background-radius: 12; " +
                    "-fx-padding: 3 12 3 12; -fx-text-fill: " + couleur + "; -fx-background-color: " + couleur + "22;");
        });

        // Stress slider listener (0-10)
        stressSlider.valueProperty().addListener((obs, oldVal, newVal) -> {
            int val = newVal.intValue();
            String emoji, label, couleur;
            if (val >= 7) {
                emoji = "\uD83D\uDD34";
                label = "Alarm";
                couleur = "#ff4444";
            } else if (val >= 4) {
                emoji = "\uD83D\uDFE1";
                label = "Tense";
                couleur = "#f6ad55";
            } else {
                emoji = "\uD83D\uDD35";
                label = "Zen";
                couleur = "#63b3ed";
            }
            stressValueLabel.setText(emoji + " " + val);
            stressValueLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: " + couleur + ";");
            stressIndicateurLabel.setVisible(true);
            stressIndicateurLabel.setText(emoji + " " + label);
            stressIndicateurLabel.setStyle("-fx-font-size: 12px; -fx-font-weight: bold; -fx-background-radius: 12; " +
                    "-fx-padding: 3 12 3 12; -fx-text-fill: " + couleur + "; -fx-background-color: " + couleur + "22;");
        });

        // Sleep slider listener (0-10)
        sommeilSlider.valueProperty().addListener((obs, oldVal, newVal) -> {
            int val = newVal.intValue();
            String emoji, label, couleur;
            if (val >= 7) {
                emoji = "\uD83D\uDFE3";
                label = "Recovered";
                couleur = "#b794f4";
            } else if (val >= 4) {
                emoji = "\uD83D\uDD35";
                label = "Rested";
                couleur = "#4299e1";
            } else {
                emoji = "\u26AA";
                label = "Tired";
                couleur = "#a0aec0";
            }
            sommeilValueLabel.setText(emoji + " " + val);
            sommeilValueLabel.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: " + couleur + ";");
            sommeilIndicateurLabel.setVisible(true);
            sommeilIndicateurLabel.setText(emoji + " " + label);
            sommeilIndicateurLabel.setStyle("-fx-font-size: 12px; -fx-font-weight: bold; -fx-background-radius: 12; " +
                    "-fx-padding: 3 12 3 12; -fx-text-fill: " + couleur + "; -fx-background-color: " + couleur + "22;");
        });
    }

    @FXML
    void ajouterHabitude() {
        boolean valide = true;

        if (nomHabitudeField.getText() == null || nomHabitudeField.getText().trim().isEmpty()) {
            nomErrorLabel.setVisible(true);
            valide = false;
        } else {
            nomErrorLabel.setVisible(false);
        }

        if (emotionComboBox.getValue() == null) {
            emotionErrorLabel.setVisible(true);
            valide = false;
        } else {
            emotionErrorLabel.setVisible(false);
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
            Habitude habitude = new Habitude(
                    nomHabitudeField.getText().trim(),
                    emotionComboBox.getValue(),
                    noteTextArea.getText(),
                    (int) energieSlider.getValue(),
                    (int) stressSlider.getValue(),
                    (int) sommeilSlider.getValue(),
                    datePicker.getValue(),
                    getCurrentUserId());
            habitudeService.create(habitude);

            Alert alert = new Alert(Alert.AlertType.INFORMATION);
            alert.setTitle("Success");
            alert.setContentText("Habit added successfully !");
            alert.showAndWait();

            ViewManager.loadView("journal/AffichageHabitude");
        } catch (SQLException e) {
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Error");
            alert.setContentText("Error : " + e.getMessage());
            alert.show();
        }
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

    @FXML
    void afficherHabitudes() {
        ViewManager.loadView("journal/AffichageHabitude");
    }
}
