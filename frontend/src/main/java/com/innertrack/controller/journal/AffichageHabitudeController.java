package com.innertrack.controller.journal;

import com.innertrack.model.Habitude;
import com.innertrack.service.HabitudeService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.PdfExporter;
import com.innertrack.util.ViewManager;
import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.FileChooser;
import javafx.stage.Stage;
import javafx.geometry.Insets;
import javafx.geometry.Pos;

import java.io.File;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.List;

public class AffichageHabitudeController {

    @FXML
    private TableView<Habitude> habitudeTable;
    @FXML
    private TableColumn<Habitude, String> nomColumn;
    @FXML
    private TableColumn<Habitude, String> emotionColumn;
    @FXML
    private TableColumn<Habitude, String> noteColumn;
    @FXML
    private TableColumn<Habitude, Integer> energieColumn;
    @FXML
    private TableColumn<Habitude, Integer> stressColumn;
    @FXML
    private TableColumn<Habitude, Integer> sommeilColumn;
    @FXML
    private TableColumn<Habitude, LocalDate> dateColumn;
    @FXML
    private TableColumn<Habitude, Void> qrColumn;

    @FXML
    private Label totalHabitudesLabel;
    @FXML
    private Label moyenneEnergieLabel;
    @FXML
    private Label moyenneStressLabel;
    @FXML
    private Label moyenneSommeilLabel;
    @FXML
    private Label statusLabel;
    @FXML
    private TextField searchField;
    @FXML
    private Button clearButton;

    private HabitudeService habitudeService;

    private int getCurrentUserId() {
        return SessionManager.getInstance().getCurrentUser().getId();
    }

    private String getCouleurEnergie(int v) {
        return v >= 7 ? "#48bb78" : v >= 4 ? "#f6ad55" : "#ff4444";
    }

    private String getLabelEnergie(int v) {
        return v >= 7 ? "Vitalite" : v >= 4 ? "Moyenne" : "Vide";
    }

    private String getCouleurStress(int v) {
        return v >= 7 ? "#ff4444" : v >= 4 ? "#f6ad55" : "#63b3ed";
    }

    private String getLabelStress(int v) {
        return v >= 7 ? "Alarme" : v >= 4 ? "Tension" : "Zen";
    }

    private String getCouleurSommeil(int v) {
        return v >= 7 ? "#b794f4" : v >= 4 ? "#4299e1" : "#a0aec0";
    }

    private String getLabelSommeil(int v) {
        return v >= 7 ? "Recupere" : v >= 4 ? "Repose" : "Fatigue";
    }

    @FXML
    public void initialize() {
        habitudeService = new HabitudeService();

        clearButton.setVisible(false);
        clearButton.setOnAction(e -> searchField.clear());
        searchField.textProperty().addListener((obs, oldVal, newVal) -> {
            clearButton.setVisible(!newVal.isEmpty());
            rechercherHabitude();
        });

        nomColumn.setCellValueFactory(new PropertyValueFactory<>("nomHabitude"));
        emotionColumn.setCellValueFactory(new PropertyValueFactory<>("emotionDominantes"));
        noteColumn.setCellValueFactory(new PropertyValueFactory<>("noteTextuelle"));
        energieColumn.setCellValueFactory(new PropertyValueFactory<>("niveauEnergie"));
        stressColumn.setCellValueFactory(new PropertyValueFactory<>("niveauStress"));
        sommeilColumn.setCellValueFactory(new PropertyValueFactory<>("qualiteSommeil"));
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("dateCreation"));

        energieColumn.setCellFactory(col -> buildBadgeCell("energie"));
        stressColumn.setCellFactory(col -> buildBadgeCell("stress"));
        sommeilColumn.setCellFactory(col -> buildBadgeCell("sommeil"));

        dateColumn.setCellFactory(column -> new TableCell<Habitude, LocalDate>() {
            private final java.time.format.DateTimeFormatter formatter = java.time.format.DateTimeFormatter
                    .ofPattern("dd/MM/yyyy");

            @Override
            protected void updateItem(LocalDate date, boolean empty) {
                super.updateItem(date, empty);
                setText(empty || date == null ? null : formatter.format(date));
            }
        });

        qrColumn.setCellFactory(param -> new TableCell<>() {
            private final Button btn = new Button("\uD83D\uDC41 Voir");
            {
                btn.setStyle("-fx-background-color: #4CAF50; -fx-text-fill: white; -fx-background-radius: 5;");
                btn.setOnAction(event -> showHabitudeDetails(getTableView().getItems().get(getIndex())));
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : btn);
            }
        });

        chargerHabitudes();
    }

    private TableCell<Habitude, Integer> buildBadgeCell(String type) {
        return new TableCell<Habitude, Integer>() {
            @Override
            protected void updateItem(Integer val, boolean empty) {
                super.updateItem(val, empty);
                if (empty || val == null) {
                    setGraphic(null);
                    setText(null);
                    setStyle("");
                    return;
                }
                String couleur, label;
                switch (type) {
                    case "energie" -> {
                        couleur = getCouleurEnergie(val);
                        label = getLabelEnergie(val);
                    }
                    case "stress" -> {
                        couleur = getCouleurStress(val);
                        label = getLabelStress(val);
                    }
                    default -> {
                        couleur = getCouleurSommeil(val);
                        label = getLabelSommeil(val);
                    }
                }
                Label badge = new Label(val + " - " + label);
                badge.setStyle("-fx-background-color: " + couleur + "22; -fx-text-fill: " + couleur +
                        "; -fx-font-weight: bold; -fx-font-size: 11px; -fx-background-radius: 15; -fx-padding: 3 8 3 8;");
                badge.setAlignment(Pos.CENTER);
                setGraphic(badge);
                setText(null);
                setAlignment(Pos.CENTER);
            }
        };
    }

    private void chargerHabitudes() {
        try {
            List<Habitude> habitudes = habitudeService.findByUserId(getCurrentUserId());
            habitudeTable.setItems(FXCollections.observableArrayList(habitudes));
            int total = habitudes.size();
            totalHabitudesLabel.setText(String.valueOf(total));
            if (total > 0) {
                double avgE = habitudes.stream().mapToInt(Habitude::getNiveauEnergie).average().orElse(0);
                double avgS = habitudes.stream().mapToInt(Habitude::getNiveauStress).average().orElse(0);
                double avgSm = habitudes.stream().mapToInt(Habitude::getQualiteSommeil).average().orElse(0);
                moyenneEnergieLabel.setText(String.format("%.1f", avgE));
                moyenneStressLabel.setText(String.format("%.1f", avgS));
                moyenneSommeilLabel.setText(String.format("%.1f", avgSm));
            } else {
                moyenneEnergieLabel.setText("\u2014");
                moyenneStressLabel.setText("\u2014");
                moyenneSommeilLabel.setText("\u2014");
            }
            statusLabel.setText(total + " habitude(s) chargee(s)");
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur chargement : " + e.getMessage());
        }
    }

    @FXML
    void ajouterHabitude(ActionEvent event) {
        ViewManager.loadView("journal/AjoutHabitude");
    }

    @FXML
    void supprimerHabitude(ActionEvent event) {
        Habitude selected = habitudeTable.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "Please select a habit!");
            return;
        }
        try {
            habitudeService.delete(selected.getIdHabit());
            showAlert(Alert.AlertType.INFORMATION, "Success", "Habit deleted!");
            chargerHabitudes();
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Error", e.getMessage());
        }
    }

    @FXML
    void modifierHabitude(ActionEvent event) {
        Habitude selected = habitudeTable.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "Please select a habit!");
            return;
        }

        javafx.stage.Stage popup = new javafx.stage.Stage();
        popup.initModality(javafx.stage.Modality.APPLICATION_MODAL);
        popup.setResizable(false);
        popup.initStyle(javafx.stage.StageStyle.UNDECORATED);

        VBox header = new VBox(6);
        header.setAlignment(Pos.CENTER_LEFT);
        header.setPadding(new Insets(22, 28, 18, 28));
        header.setStyle("-fx-background-color: linear-gradient(to right, #5a3ea1, #7c5cbf);");
        Label titreLabel = new Label("\u270F\uFE0F  Edit Habit");
        titreLabel.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        header.getChildren().add(titreLabel);

        VBox form = new VBox(12);
        form.setPadding(new Insets(18, 28, 10, 28));

        TextField nomField = new TextField(selected.getNomHabitude());
        nomField.setPromptText("Habit Name");

        TextField emotionField = new TextField(selected.getEmotionDominantes());
        emotionField.setPromptText("Emotion");

        TextArea noteArea = new TextArea(selected.getNoteTextuelle());
        noteArea.setWrapText(true);
        noteArea.setPrefRowCount(3);

        Spinner<Integer> energieSpinner = new Spinner<>(0, 10, selected.getNiveauEnergie());
        Spinner<Integer> stressSpinner = new Spinner<>(0, 10, selected.getNiveauStress());
        Spinner<Integer> sommeilSpinner = new Spinner<>(0, 10, selected.getQualiteSommeil());

        form.getChildren().addAll(
                new Label("Name :"), nomField,
                new Label("Emotion :"), emotionField,
                new Label("Notes :"), noteArea,
                new HBox(10, new Label("Energy:"), energieSpinner, new Label("Stress:"), stressSpinner,
                        new Label("Sleep:"), sommeilSpinner));

        Button btnSave = new Button("\u2705  Save");
        btnSave.setStyle(
                "-fx-background-color: #5a3ea1; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        Button btnCancel = new Button("\u2715  Cancel");
        btnCancel.setStyle(
                "-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568; -fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        btnCancel.setOnAction(e -> popup.close());
        btnSave.setOnAction(e -> {
            selected.setNomHabitude(nomField.getText());
            selected.setEmotionDominantes(emotionField.getText());
            selected.setNoteTextuelle(noteArea.getText());
            selected.setNiveauEnergie(energieSpinner.getValue());
            selected.setNiveauStress(stressSpinner.getValue());
            selected.setQualiteSommeil(sommeilSpinner.getValue());
            try {
                habitudeService.update(selected);
                popup.close();
                chargerHabitudes();
                statusLabel.setText("\u2705 Habit edited !");
            } catch (SQLException ex) {
                showAlert(Alert.AlertType.ERROR, "Error", ex.getMessage());
            }
        });

        HBox footerBox = new HBox(10);
        footerBox.setAlignment(Pos.CENTER_RIGHT);
        footerBox.setPadding(new Insets(10, 28, 20, 28));
        footerBox.getChildren().addAll(btnCancel, btnSave);

        ScrollPane scroll = new ScrollPane(form);
        scroll.setFitToWidth(true);
        scroll.setStyle("-fx-background: white;");

        VBox root = new VBox();
        root.setStyle("-fx-background-color: white;");
        root.getChildren().addAll(header, scroll, footerBox);

        javafx.scene.Scene scene = new javafx.scene.Scene(root, 550, 500);
        popup.setScene(scene);
        popup.showAndWait();
    }

    private void showHabitudeDetails(Habitude h) {
        javafx.stage.Stage popup = new javafx.stage.Stage();
        popup.initModality(javafx.stage.Modality.APPLICATION_MODAL);
        popup.initStyle(javafx.stage.StageStyle.UNDECORATED);

        VBox header = new VBox(6);
        header.setAlignment(Pos.CENTER_LEFT);
        header.setPadding(new Insets(22, 28, 18, 28));
        header.setStyle("-fx-background-color: linear-gradient(to right, #5a3ea1, #7c5cbf);");
        Label titre = new Label("\uD83C\uDF3F  " + h.getNomHabitude());
        titre.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        Label date = new Label("\uD83D\uDCC5  " + (h.getDateCreation() != null
                ? h.getDateCreation()
                        .format(java.time.format.DateTimeFormatter.ofPattern("dd MMMM yyyy", java.util.Locale.FRENCH))
                : "\u2014"));
        date.setStyle("-fx-text-fill: #d8ccf5; -fx-font-size: 12px;");
        header.getChildren().addAll(titre, date);

        VBox body = new VBox(12);
        body.setPadding(new Insets(16, 28, 16, 28));

        String info = "\uD83D\uDCAD Emotion: " + h.getEmotionDominantes() + "\n"
                + "\u26A1 Energie: " + h.getNiveauEnergie() + "/10 - " + getLabelEnergie(h.getNiveauEnergie()) + "\n"
                + "\uD83D\uDE30 Stress: " + h.getNiveauStress() + "/10 - " + getLabelStress(h.getNiveauStress()) + "\n"
                + "\uD83D\uDE34 Sommeil: " + h.getQualiteSommeil() + "/10 - " + getLabelSommeil(h.getQualiteSommeil());
        Label infoLabel = new Label(info);
        infoLabel.setWrapText(true);
        infoLabel.setStyle(
                "-fx-font-size: 13px; -fx-text-fill: #2d3748; -fx-background-color: #f7fafc; -fx-background-radius: 8; -fx-padding: 12 14 12 14;");

        Label noteTitre = new Label("\uD83D\uDCDD  Notes:");
        noteTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        Label noteContenu = new Label(h.getNoteTextuelle() != null ? h.getNoteTextuelle() : "Aucune note.");
        noteContenu.setWrapText(true);
        noteContenu.setStyle("-fx-font-size: 13px; -fx-text-fill: #2d3748;");

        body.getChildren().addAll(infoLabel, noteTitre, noteContenu);

        Button btnFermer = new Button("\u2715  Close");
        btnFermer.setStyle(
                "-fx-background-color: #5a3ea1; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 8; -fx-padding: 8 24 8 24; -fx-cursor: hand;");
        btnFermer.setOnAction(e -> popup.close());
        HBox footerBox = new HBox();
        footerBox.setAlignment(Pos.CENTER_RIGHT);
        footerBox.setPadding(new Insets(0, 28, 20, 28));
        footerBox.getChildren().add(btnFermer);

        VBox root = new VBox();
        root.setStyle("-fx-background-color: white;");
        root.getChildren().addAll(header, body, footerBox);

        javafx.scene.Scene scene = new javafx.scene.Scene(root, 480, 400);
        popup.setScene(scene);
        popup.showAndWait();
    }

    private void rechercherHabitude() {
        try {
            String keyword = searchField.getText();
            if (keyword == null || keyword.isEmpty()) {
                habitudeTable
                        .setItems(FXCollections.observableArrayList(habitudeService.findByUserId(getCurrentUserId())));
            } else {
                habitudeTable.setItems(
                        FXCollections.observableArrayList(habitudeService.search(keyword, getCurrentUserId())));
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    void allerAuJournal(ActionEvent event) {
        ViewManager.loadView("journal/AffichageJournal");
    }

    @FXML
    void allerAuDashboard(ActionEvent event) {
        ViewManager.loadView("user/dashboard");
    }

    @FXML
    void exporterPDF() {
        try {
            FileChooser fileChooser = new FileChooser();
            fileChooser.setTitle("Save PDF File");
            fileChooser.getExtensionFilters().add(new FileChooser.ExtensionFilter("PDF Files", "*.pdf"));
            fileChooser.setInitialDirectory(new java.io.File(System.getProperty("user.home") + "/Downloads"));
            fileChooser.setInitialFileName("My Habits.pdf");

            Stage stage = (Stage) habitudeTable.getScene().getWindow();
            File file = fileChooser.showSaveDialog(stage);
            if (file == null)
                return;

            List<Habitude> habitudes = habitudeService.findByUserId(getCurrentUserId());
            PdfExporter.exportHabitudes(habitudes, file.getAbsolutePath());
            statusLabel.setText("\u2705 PDF saved !");
        } catch (Exception e) {
            statusLabel.setText("\u274C Error exporting PDF");
            e.printStackTrace();
        }
    }

    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.show();
    }
}
