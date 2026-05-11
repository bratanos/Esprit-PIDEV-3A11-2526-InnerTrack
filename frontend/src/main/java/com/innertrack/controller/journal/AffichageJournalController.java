package com.innertrack.controller.journal;

import com.innertrack.model.EntreeJournal;
import com.innertrack.service.JournalService;
import com.innertrack.service.TTSService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.PdfExporter;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
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

public class AffichageJournalController {

    @FXML private TableView<EntreeJournal> journalTable;
    @FXML private TableColumn<EntreeJournal, Integer> humeurColumn;
    @FXML private TableColumn<EntreeJournal, String> noteColumn;
    @FXML private TableColumn<EntreeJournal, Void> sonColumn;
    @FXML private TableColumn<EntreeJournal, LocalDate> dateColumn;
    @FXML private TableColumn<EntreeJournal, Void> voirColumn;

    @FXML private Label statusLabel;
    @FXML private Label totalEntreesLabel;
    @FXML private Label moyenneHumeurLabel;
    @FXML private TextField searchField;
    @FXML private Button clearButton;

    private JournalService journalService;

    private int getCurrentUserId() {
        return SessionManager.getInstance().getCurrentUser().getId();
    }

    // ============================================================
    // COULEURS & LABELS
    // ============================================================

    private String getCouleurHumeur(int v) {
        return v >= 7 ? "#f6a623" : v >= 4 ? "#48bb78" : "#2b6cb0";
    }
    private String getEmojiHumeur(int v) {
        return v >= 7 ? "☀️" : v >= 4 ? "🟢" : "🔵";
    }
    private String getLabelHumeur(int v) {
        return v >= 7 ? "Joie" : v >= 4 ? "Stable" : "Triste";
    }

    // ============================================================
    // INITIALIZE
    // ============================================================

    @FXML
    public void initialize() {
        journalService = new JournalService();

        clearButton.setVisible(false);
        clearButton.setOnAction(e -> viderRecherche());
        searchField.textProperty().addListener((obs, oldVal, newVal) -> {
            clearButton.setVisible(!newVal.isEmpty());
            rechercherJournal();
        });

        humeurColumn.setCellValueFactory(new PropertyValueFactory<>("humeur"));
        noteColumn.setCellValueFactory(new PropertyValueFactory<>("noteTextuelle"));
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("dateSaisie"));

        humeurColumn.setCellFactory(col -> new TableCell<EntreeJournal, Integer>() {
            @Override
            protected void updateItem(Integer valeur, boolean empty) {
                super.updateItem(valeur, empty);
                if (empty || valeur == null) { setGraphic(null); setText(null); setStyle(""); return; }
                String couleur = getCouleurHumeur(valeur);
                Label badge = new Label(getEmojiHumeur(valeur) + " " + valeur + " – " + getLabelHumeur(valeur));
                badge.setStyle("-fx-background-color: " + couleur + "22; -fx-text-fill: " + couleur +
                        "; -fx-font-weight: bold; -fx-font-size: 12px; -fx-background-radius: 20; -fx-padding: 3 10 3 10;");
                badge.setAlignment(Pos.CENTER);
                setGraphic(badge); setText(null); setAlignment(Pos.CENTER); setStyle("");
            }
        });

        dateColumn.setCellFactory(column -> new TableCell<EntreeJournal, LocalDate>() {
            private final java.time.format.DateTimeFormatter formatter =
                    java.time.format.DateTimeFormatter.ofPattern("dd/MM/yyyy");
            @Override
            protected void updateItem(LocalDate date, boolean empty) {
                super.updateItem(date, empty);
                setText(empty || date == null ? null : formatter.format(date));
            }
        });

        voirColumn.setCellFactory(param -> new TableCell<>() {
            private final Button btn = new Button("👁 Voir");
            {
                btn.setStyle("-fx-background-color: #4CAF50; -fx-text-fill: white; -fx-background-radius: 5;");
                btn.setOnAction(event -> showJournalDetails(getTableView().getItems().get(getIndex())));
            }
            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : btn);
            }
        });

        sonColumn.setCellFactory(param -> new TableCell<>() {
            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || getIndex() >= getTableView().getItems().size()) { setGraphic(null); return; }
                EntreeJournal journal = getTableView().getItems().get(getIndex());
                setGraphic(creerBoutonSon(journal.getNoteTextuelle()));
            }
        });

        chargerJournaux();
    }

    // ============================================================
    // CHARGER
    // ============================================================

    private void chargerJournaux() {
        try {
            List<EntreeJournal> entrees = journalService.findByUserId(getCurrentUserId());
            journalTable.setItems(FXCollections.observableArrayList(entrees));
            int total = entrees.size();
            totalEntreesLabel.setText(String.valueOf(total));
            if (total > 0) {
                double moyenne = entrees.stream().mapToInt(EntreeJournal::getHumeur).average().orElse(0);
                moyenneHumeurLabel.setText(String.format("%.1f", moyenne));
                moyenneHumeurLabel.setStyle("-fx-text-fill: " + getCouleurHumeur((int) moyenne) + "; -fx-font-weight: bold;");
            } else {
                moyenneHumeurLabel.setText("—");
            }
            statusLabel.setText(total + " entry(s) loaded");
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Error", "Error loading data : " + e.getMessage());
        }
    }

    // ============================================================
    // VOIR DÉTAILS + QR CODE
    // ============================================================

    private void showJournalDetails(EntreeJournal j) {
        javafx.stage.Stage popup = new javafx.stage.Stage();
        popup.initModality(javafx.stage.Modality.APPLICATION_MODAL);
        popup.setResizable(false);
        popup.initStyle(javafx.stage.StageStyle.UNDECORATED);

        String couleur = getCouleurHumeur(j.getHumeur());
        String emoji   = getEmojiHumeur(j.getHumeur());
        String label   = getLabelHumeur(j.getHumeur());

        // EN-TÊTE
        VBox header = new VBox(6);
        header.setAlignment(Pos.CENTER_LEFT);
        header.setPadding(new Insets(22, 28, 18, 28));
        header.setStyle("-fx-background-color: linear-gradient(to right, #5a3ea1, #7c5cbf);");
        Label titreLabel = new Label("📓  Journal Entry");
        titreLabel.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        Label dateLabel = new Label("📅  " + (j.getDateSaisie() != null
                ? j.getDateSaisie().format(java.time.format.DateTimeFormatter.ofPattern("dd MMMM yyyy", java.util.Locale.FRENCH))
                : "—"));
        dateLabel.setStyle("-fx-text-fill: #d8ccf5; -fx-font-size: 12px;");
        header.getChildren().addAll(titreLabel, dateLabel);

        // CONTENU : humeur + QR
        HBox contentRow = new HBox(20);
        contentRow.setPadding(new Insets(16, 28, 8, 28));
        contentRow.setAlignment(Pos.CENTER_LEFT);

        // Colonne gauche : humeur
        VBox leftCol = new VBox(10);
        leftCol.setAlignment(Pos.TOP_LEFT);
        HBox.setHgrow(leftCol, javafx.scene.layout.Priority.ALWAYS);

        Label humeurTitre = new Label("Mood :");
        humeurTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");

        Label humeurBadge = new Label(emoji + "  " + j.getHumeur() + " / 10  —  " + label);
        humeurBadge.setStyle("-fx-background-color: " + couleur + "22; -fx-text-fill: " + couleur +
                "; -fx-font-weight: bold; -fx-font-size: 13px; -fx-background-radius: 20; -fx-padding: 5 14 5 14;");

        ProgressBar progressBar = new ProgressBar(j.getHumeur() / 10.0);
        progressBar.setPrefWidth(180);
        progressBar.setPrefHeight(8);
        progressBar.setStyle("-fx-accent: " + couleur + ";");

        HBox progressRow = new HBox(8);
        progressRow.setAlignment(Pos.CENTER_LEFT);
        Label progressLabel = new Label("Level :");
        progressLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #718096;");
        progressRow.getChildren().addAll(progressLabel, progressBar);

        leftCol.getChildren().addAll(humeurTitre, humeurBadge, progressRow);

        // Colonne droite : QR code
        VBox rightCol = new VBox(6);
        rightCol.setAlignment(Pos.TOP_CENTER);
        Label qrTitre = new Label("🔗 QR Code");
        qrTitre.setStyle("-fx-font-size: 11px; -fx-text-fill: #718096; -fx-font-weight: bold;");
        ImageView qrView = new ImageView();
        qrView.setFitWidth(150); qrView.setFitHeight(150); qrView.setPreserveRatio(true);
        Label qrLoading = new Label("⏳");
        qrLoading.setStyle("-fx-font-size: 20px;");
        rightCol.getChildren().addAll(qrTitre, qrLoading);

        String qrText = "Date: " + j.getDateSaisie() + "\n" +
                "Mood: " + j.getHumeur() + "/10 - " + label + "\n" +
                "Note: " + (j.getNoteTextuelle() != null ? j.getNoteTextuelle() : "");

        Thread qrThread = new Thread(() -> {
            Image qr = generateQRCode(qrText);
            Platform.runLater(() -> {
                rightCol.getChildren().remove(qrLoading);
                if (qr != null) { qrView.setImage(qr); rightCol.getChildren().add(qrView); }
                else rightCol.getChildren().add(new Label("❌"));
            });
        });
        qrThread.setDaemon(true);
        qrThread.start();

        contentRow.getChildren().addAll(leftCol, rightCol);

        Separator sep = new Separator();
        sep.setPadding(new Insets(0, 20, 0, 20));

        // NOTE
        VBox noteBox = new VBox(8);
        noteBox.setPadding(new Insets(14, 28, 20, 28));
        Label noteTitre = new Label("📝  Daily Note");
        noteTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        Label noteContenu = new Label(j.getNoteTextuelle() != null ? j.getNoteTextuelle() : "No note.");
        noteContenu.setWrapText(true);
        noteContenu.setMaxWidth(410);
        noteContenu.setStyle("-fx-font-size: 13px; -fx-text-fill: #2d3748;" +
                "-fx-background-color: #f7fafc; -fx-background-radius: 8; -fx-padding: 12 14 12 14;");
        ScrollPane scrollNote = new ScrollPane(noteContenu);
        scrollNote.setFitToWidth(true); scrollNote.setPrefHeight(150);
        scrollNote.setStyle("-fx-background: #f7fafc; -fx-background-color: #f7fafc;" +
                "-fx-border-color: #e2e8f0; -fx-border-radius: 8; -fx-border-width: 1;");
        scrollNote.setHbarPolicy(ScrollPane.ScrollBarPolicy.NEVER);
        scrollNote.setVbarPolicy(ScrollPane.ScrollBarPolicy.AS_NEEDED);
        noteBox.getChildren().addAll(noteTitre, scrollNote);

        // FOOTER
        Button btnFermer = new Button("✕  Close");
        btnFermer.setStyle("-fx-background-color: #5a3ea1; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-font-size: 13px;" +
                "-fx-background-radius: 8; -fx-padding: 8 24 8 24; -fx-cursor: hand;");
        btnFermer.setOnAction(e -> popup.close());
        HBox footerBox = new HBox();
        footerBox.setAlignment(Pos.CENTER_RIGHT);
        footerBox.setPadding(new Insets(0, 28, 20, 28));
        footerBox.getChildren().add(btnFermer);

        VBox root = new VBox();
        root.setStyle("-fx-background-color: white; -fx-background-radius: 12;");
        root.getChildren().addAll(header, contentRow, sep, noteBox, footerBox);
        javafx.scene.Scene scene = new javafx.scene.Scene(root, 500, 600);
        scene.setFill(javafx.scene.paint.Color.TRANSPARENT);
        popup.setScene(scene);
        popup.showAndWait();
    }

    // ============================================================
    // QR CODE — génération locale via ZXing
    // ============================================================

    private Image generateQRCode(String text) {
        try {
            if (text.length() > 300) text = text.substring(0, 297) + "...";
            com.google.zxing.common.BitMatrix matrix =
                    new com.google.zxing.MultiFormatWriter()
                            .encode(text, com.google.zxing.BarcodeFormat.QR_CODE, 120, 120);
            java.awt.image.BufferedImage bufferedImage =
                    com.google.zxing.client.j2se.MatrixToImageWriter.toBufferedImage(matrix);
            return javafx.embed.swing.SwingFXUtils.toFXImage(bufferedImage, null);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }

    // ============================================================
    // MODIFIER
    // ============================================================

    @FXML
    void modifierJournal(ActionEvent event) {
        EntreeJournal selected = journalTable.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "Please select an entry!");
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
        Label titreLabel = new Label("✏️  Edit Entry");
        titreLabel.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        Label sousTitre = new Label("Edit your mood and your note");
        sousTitre.setStyle("-fx-text-fill: #d8ccf5; -fx-font-size: 12px;");
        header.getChildren().addAll(titreLabel, sousTitre);

        VBox humeurSection = new VBox(10);
        humeurSection.setPadding(new Insets(18, 28, 10, 28));
        Label humeurTitre = new Label("😊  Level of Mood");
        humeurTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        Spinner<Integer> humeurSpinner = new Spinner<>(0, 10, selected.getHumeur());
        humeurSpinner.setEditable(true);
        humeurSpinner.setPrefWidth(100);

        Label indHumeur = new Label(getEmojiHumeur(selected.getHumeur()) + " " + getLabelHumeur(selected.getHumeur())
                + " (" + selected.getHumeur() + "/10)");
        indHumeur.setStyle("-fx-background-color: " + getCouleurHumeur(selected.getHumeur()) + "22; -fx-text-fill: "
                + getCouleurHumeur(selected.getHumeur()) +
                "; -fx-font-weight: bold; -fx-font-size: 12px; -fx-background-radius: 8; -fx-padding: 4 12 4 12;");

        humeurSpinner.valueProperty().addListener((obs, o, v) -> {
            String c = getCouleurHumeur(v);
            indHumeur.setText(getEmojiHumeur(v) + " " + getLabelHumeur(v) + " (" + v + "/10)");
            indHumeur.setStyle("-fx-background-color: " + c + "22; -fx-text-fill: " + c +
                    "; -fx-font-weight: bold; -fx-font-size: 12px; -fx-background-radius: 8; -fx-padding: 4 12 4 12;");
        });

        HBox spinnerRow = new HBox(12);
        spinnerRow.setAlignment(Pos.CENTER_LEFT);
        spinnerRow.getChildren().addAll(humeurSpinner, indHumeur);
        humeurSection.getChildren().addAll(humeurTitre, spinnerRow);

        Separator sep = new Separator();
        sep.setPadding(new Insets(0, 20, 0, 20));

        VBox noteSection = new VBox(8);
        noteSection.setPadding(new Insets(14, 28, 20, 28));
        Label noteTitre = new Label("📝  Daily Note");
        noteTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        TextArea noteTextArea = new TextArea(selected.getNoteTextuelle());
        noteTextArea.setWrapText(true);
        noteTextArea.setPrefRowCount(5);
        noteTextArea.setPrefWidth(420);
        noteSection.getChildren().addAll(noteTitre, noteTextArea);

        Button btnSave = new Button("✅  Save");
        btnSave.setStyle("-fx-background-color: #5a3ea1; -fx-text-fill: white; -fx-font-weight: bold; -fx-font-size: 13px; -fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        Button btnCancel = new Button("✕  Cancel");
        btnCancel.setStyle("-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568; -fx-font-weight: bold; -fx-font-size: 13px; -fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        btnCancel.setOnAction(e -> popup.close());
        btnSave.setOnAction(e -> {
            selected.setHumeur(humeurSpinner.getValue());
            selected.setNoteTextuelle(noteTextArea.getText());
            try {
                journalService.update(selected);
                popup.close();
                chargerJournaux();
                statusLabel.setText("✅ Entry edited!");
            } catch (SQLException ex) {
                showAlert(Alert.AlertType.ERROR, "Error", ex.getMessage());
            }
        });

        HBox footerBox = new HBox(10);
        footerBox.setAlignment(Pos.CENTER_RIGHT);
        footerBox.setPadding(new Insets(0, 28, 20, 28));
        footerBox.getChildren().addAll(btnCancel, btnSave);

        VBox root = new VBox();
        root.setStyle("-fx-background-color: white; -fx-background-radius: 12;");
        root.getChildren().addAll(header, humeurSection, sep, noteSection, footerBox);
        javafx.scene.Scene scene = new javafx.scene.Scene(root, 480, 420);
        scene.setFill(javafx.scene.paint.Color.TRANSPARENT);
        popup.setScene(scene);
        popup.showAndWait();
    }

    // ============================================================
    // ACTIONS
    // ============================================================

    @FXML
    void ajouterNouveauJournal(ActionEvent event) {
        ViewManager.loadView("journal/AjoutJournal");
    }

    @FXML
    void supprimerJournal(ActionEvent event) {
        EntreeJournal selected = journalTable.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showAlert(Alert.AlertType.WARNING, "Warning", "Please select an entry!");
            return;
        }
        try {
            journalService.delete(selected.getIdJournal());
            showAlert(Alert.AlertType.INFORMATION, "Success", "Entry deleted!");
            chargerJournaux();
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Error", e.getMessage());
        }
    }

    @FXML
    void allerAuxHabitudes(ActionEvent event) {
        ViewManager.loadView("journal/AffichageHabitude");
    }

    @FXML
    void allerAuDashboard(ActionEvent event) {
        ViewManager.loadView("user/dashboard");
    }

    // ============================================================
    // RECHERCHE
    // ============================================================

    @FXML
    void rechercherJournal() {
        try {
            String keyword = searchField.getText();
            if (keyword == null || keyword.isEmpty()) {
                journalTable.setItems(FXCollections.observableArrayList(journalService.findByUserId(getCurrentUserId())));
            } else {
                journalTable.setItems(FXCollections.observableArrayList(journalService.search(keyword, getCurrentUserId())));
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    void viderRecherche() {
        searchField.clear();
    }

    // ============================================================
    // EXPORT PDF
    // ============================================================

    @FXML
    void exporterPDF() {
        try {
            FileChooser fileChooser = new FileChooser();
            fileChooser.setTitle("Save PDF File");
            fileChooser.getExtensionFilters().add(new FileChooser.ExtensionFilter("PDF Files", "*.pdf"));
            fileChooser.setInitialDirectory(new java.io.File(System.getProperty("user.home") + "/Downloads"));
            fileChooser.setInitialFileName("My Journal.pdf");
            Stage stage = (Stage) journalTable.getScene().getWindow();
            File file = fileChooser.showSaveDialog(stage);
            if (file == null) return;
            List<EntreeJournal> entrees = journalService.findByUserId(getCurrentUserId());
            PdfExporter.exportJournal(entrees, file.getAbsolutePath());
            statusLabel.setText("✅ PDF saved!");
        } catch (Exception e) {
            statusLabel.setText("❌ Error exporting PDF");
            e.printStackTrace();
        }
    }

    // ============================================================
    // BOUTON TTS
    // ============================================================

    private Button creerBoutonSon(String texte) {
        Button btn = new Button("🔊");
        btn.setStyle("-fx-background-color: #edf2f7; -fx-text-fill: #4a5568; -fx-font-size: 14px;" +
                "-fx-border-radius: 8; -fx-background-radius: 8; -fx-padding: 4 8; -fx-cursor: hand; -fx-min-width: 32;");
        btn.setTooltip(new Tooltip("Read Out Loud"));
        TTSService tts = TTSService.getInstance();
        btn.setOnAction(e -> {
            if (tts.isEnCoursLecture()) {
                tts.arreter();
                btn.setText("🔊");
            } else {
                btn.setText("⏹️");
                tts.lire(texte);
                int duree = Math.max(2000, texte != null ? texte.length() * 65 : 2000);
                new javafx.animation.Timeline(
                        new javafx.animation.KeyFrame(javafx.util.Duration.millis(duree), ev -> btn.setText("🔊"))
                ).play();
            }
        });
        return btn;
    }

    public void rafraichir() {
        chargerJournaux();
    }

    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.show();
    }
}