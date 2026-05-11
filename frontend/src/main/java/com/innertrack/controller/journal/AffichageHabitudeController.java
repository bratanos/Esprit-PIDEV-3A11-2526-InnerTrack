package com.innertrack.controller.journal;

import com.innertrack.model.Habitude;
import com.innertrack.service.HabitudeService;
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

public class AffichageHabitudeController {

    @FXML private TableView<Habitude> habitudeTable;
    @FXML private TableColumn<Habitude, String> nomColumn;
    @FXML private TableColumn<Habitude, String> emotionColumn;
    @FXML private TableColumn<Habitude, String> noteColumn;
    @FXML private TableColumn<Habitude, Integer> energieColumn;
    @FXML private TableColumn<Habitude, Integer> stressColumn;
    @FXML private TableColumn<Habitude, Integer> sommeilColumn;
    @FXML private TableColumn<Habitude, LocalDate> dateColumn;
    @FXML private TableColumn<Habitude, Void> qrColumn;

    @FXML private Label totalHabitudesLabel;
    @FXML private Label moyenneEnergieLabel;
    @FXML private Label moyenneStressLabel;
    @FXML private Label moyenneSommeilLabel;
    @FXML private Label statusLabel;
    @FXML private TextField searchField;
    @FXML private Button clearButton;

    private HabitudeService habitudeService;

    private int getCurrentUserId() {
        return SessionManager.getInstance().getCurrentUser().getId();
    }

    // ============================================================
    // COULEURS & LABELS
    // ============================================================

    private String getCouleurEnergie(int v) {
        return v >= 7 ? "#48bb78" : v >= 4 ? "#f6ad55" : "#ff4444";
    }
    private String getEmojiEnergie(int v) {
        return v >= 7 ? "🟢" : v >= 4 ? "🟡" : "🔴";
    }
    private String getLabelEnergie(int v) {
        return v >= 7 ? "Vitalité" : v >= 4 ? "Moyenne" : "Vide";
    }

    private String getCouleurStress(int v) {
        return v >= 7 ? "#ff4444" : v >= 4 ? "#f6ad55" : "#63b3ed";
    }
    private String getEmojiStress(int v) {
        return v >= 7 ? "🔴" : v >= 4 ? "🟡" : "🩵";
    }
    private String getLabelStress(int v) {
        return v >= 7 ? "Alarme" : v >= 4 ? "Tension" : "Zen";
    }

    private String getCouleurSommeil(int v) {
        return v >= 7 ? "#b794f4" : v >= 4 ? "#4299e1" : "#a0aec0";
    }
    private String getEmojiSommeil(int v) {
        return v >= 7 ? "💜" : v >= 4 ? "🔵" : "🔘";
    }
    private String getLabelSommeil(int v) {
        return v >= 7 ? "Récupéré" : v >= 4 ? "Reposé" : "Fatigué";
    }

    // ============================================================
    // INITIALIZE
    // ============================================================

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
        stressColumn.setCellFactory(col  -> buildBadgeCell("stress"));
        sommeilColumn.setCellFactory(col -> buildBadgeCell("sommeil"));

        dateColumn.setCellFactory(column -> new TableCell<Habitude, LocalDate>() {
            private final java.time.format.DateTimeFormatter formatter =
                    java.time.format.DateTimeFormatter.ofPattern("dd/MM/yyyy");
            @Override
            protected void updateItem(LocalDate date, boolean empty) {
                super.updateItem(date, empty);
                setText(empty || date == null ? null : formatter.format(date));
            }
        });

        qrColumn.setCellFactory(param -> new TableCell<>() {
            private final Button btn = new Button("👁 Voir");
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

    // ============================================================
    // BADGE CELL
    // ============================================================

    private TableCell<Habitude, Integer> buildBadgeCell(String type) {
        return new TableCell<Habitude, Integer>() {
            @Override
            protected void updateItem(Integer val, boolean empty) {
                super.updateItem(val, empty);
                if (empty || val == null) { setGraphic(null); setText(null); setStyle(""); return; }
                String couleur, emoji, label;
                switch (type) {
                    case "energie" -> { couleur = getCouleurEnergie(val); emoji = getEmojiEnergie(val); label = getLabelEnergie(val); }
                    case "stress"  -> { couleur = getCouleurStress(val);  emoji = getEmojiStress(val);  label = getLabelStress(val);  }
                    default        -> { couleur = getCouleurSommeil(val); emoji = getEmojiSommeil(val); label = getLabelSommeil(val); }
                }
                Label badge = new Label(emoji + " " + val + " - " + label);
                badge.setStyle("-fx-background-color: " + couleur + "22; -fx-text-fill: " + couleur +
                        "; -fx-font-weight: bold; -fx-font-size: 11px; -fx-background-radius: 15; -fx-padding: 3 8 3 8;");
                badge.setAlignment(Pos.CENTER);
                setGraphic(badge); setText(null); setAlignment(Pos.CENTER);
            }
        };
    }

    // ============================================================
    // CHARGER
    // ============================================================

    private void chargerHabitudes() {
        try {
            List<Habitude> habitudes = habitudeService.findByUserId(getCurrentUserId());
            habitudeTable.setItems(FXCollections.observableArrayList(habitudes));
            int total = habitudes.size();
            totalHabitudesLabel.setText(String.valueOf(total));
            if (total > 0) {
                double avgE  = habitudes.stream().mapToInt(Habitude::getNiveauEnergie).average().orElse(0);
                double avgS  = habitudes.stream().mapToInt(Habitude::getNiveauStress).average().orElse(0);
                double avgSm = habitudes.stream().mapToInt(Habitude::getQualiteSommeil).average().orElse(0);
                moyenneEnergieLabel.setText(String.format("%.1f", avgE));
                moyenneStressLabel.setText(String.format("%.1f", avgS));
                moyenneSommeilLabel.setText(String.format("%.1f", avgSm));
            } else {
                moyenneEnergieLabel.setText("—");
                moyenneStressLabel.setText("—");
                moyenneSommeilLabel.setText("—");
            }
            statusLabel.setText(total + " habitude(s) chargée(s)");
        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Erreur", "Erreur chargement : " + e.getMessage());
        }
    }

    // ============================================================
    // VOIR DÉTAILS + QR CODE
    // ============================================================

    private void showHabitudeDetails(Habitude h) {
        javafx.stage.Stage popup = new javafx.stage.Stage();
        popup.initModality(javafx.stage.Modality.APPLICATION_MODAL);
        popup.setResizable(false);
        popup.initStyle(javafx.stage.StageStyle.UNDECORATED);

        // EN-TÊTE
        VBox header = new VBox(6);
        header.setAlignment(Pos.CENTER_LEFT);
        header.setPadding(new Insets(22, 28, 18, 28));
        header.setStyle("-fx-background-color: linear-gradient(to right, #5a3ea1, #7c5cbf);");
        Label titre = new Label("🌿  " + h.getNomHabitude());
        titre.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        Label date = new Label("📅  " + (h.getDateCreation() != null
                ? h.getDateCreation().format(java.time.format.DateTimeFormatter.ofPattern("dd MMMM yyyy", java.util.Locale.FRENCH))
                : "—") + "   •   " + h.getEmotionDominantes());
        date.setStyle("-fx-text-fill: #d8ccf5; -fx-font-size: 12px;");
        header.getChildren().addAll(titre, date);

        // CONTENU : indicateurs + QR
        HBox contentRow = new HBox(20);
        contentRow.setPadding(new Insets(16, 28, 8, 28));
        contentRow.setAlignment(Pos.CENTER_LEFT);

        // Colonne gauche : indicateurs colorés
        VBox leftCol = new VBox(10);
        leftCol.setAlignment(Pos.TOP_LEFT);
        HBox.setHgrow(leftCol, javafx.scene.layout.Priority.ALWAYS);
        Label indTitre = new Label("📊  Niveaux du jour");
        indTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        leftCol.getChildren().addAll(
                indTitre,
                creerLigneIndicateur("⚡ Energie :", h.getNiveauEnergie(),
                        getCouleurEnergie(h.getNiveauEnergie()), getEmojiEnergie(h.getNiveauEnergie()), getLabelEnergie(h.getNiveauEnergie())),
                creerLigneIndicateur("😰 Stress :", h.getNiveauStress(),
                        getCouleurStress(h.getNiveauStress()), getEmojiStress(h.getNiveauStress()), getLabelStress(h.getNiveauStress())),
                creerLigneIndicateur("😴 Sommeil :", h.getQualiteSommeil(),
                        getCouleurSommeil(h.getQualiteSommeil()), getEmojiSommeil(h.getQualiteSommeil()), getLabelSommeil(h.getQualiteSommeil()))
        );

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

        Thread qrThread = new Thread(() -> {
            Image qr = generateQRCode(h);
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
        Label noteTitre = new Label("📝  Note personnelle");
        noteTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        Label noteContenu = new Label(h.getNoteTextuelle() != null ? h.getNoteTextuelle() : "Aucune note.");
        noteContenu.setWrapText(true);
        noteContenu.setMaxWidth(420);
        noteContenu.setStyle("-fx-font-size: 13px; -fx-text-fill: #2d3748;" +
                "-fx-background-color: #f7fafc; -fx-background-radius: 8; -fx-padding: 12 14 12 14;");
        ScrollPane scrollNote = new ScrollPane(noteContenu);
        scrollNote.setFitToWidth(true); scrollNote.setPrefHeight(120);
        scrollNote.setStyle("-fx-background: #f7fafc; -fx-background-color: #f7fafc;" +
                "-fx-border-color: #e2e8f0; -fx-border-radius: 8; -fx-border-width: 1;");
        scrollNote.setHbarPolicy(ScrollPane.ScrollBarPolicy.NEVER);
        scrollNote.setVbarPolicy(ScrollPane.ScrollBarPolicy.AS_NEEDED);
        noteBox.getChildren().addAll(noteTitre, scrollNote);

        // FOOTER
        Button btnFermer = new Button("✕  Fermer");
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

    private Image generateQRCode(Habitude h) {
        try {
            String date = h.getDateCreation() != null
                    ? h.getDateCreation().format(java.time.format.DateTimeFormatter.ofPattern("dd/MM/yyyy"))
                    : "-";
            String qrText = "Habitude: " + h.getNomHabitude() + "\n" +
                    "Date: " + date + "\n" +
                    "Emotion: " + h.getEmotionDominantes() + "\n" +
                    "Energie: " + h.getNiveauEnergie() + "/10\n" +
                    "Stress: " + h.getNiveauStress() + "/10\n" +
                    "Sommeil: " + h.getQualiteSommeil() + "/10\n" +
                    "Note: " + (h.getNoteTextuelle() != null ? h.getNoteTextuelle() : "");
            if (qrText.length() > 300) qrText = qrText.substring(0, 297) + "...";

            com.google.zxing.common.BitMatrix matrix =
                    new com.google.zxing.MultiFormatWriter()
                            .encode(qrText, com.google.zxing.BarcodeFormat.QR_CODE, 120, 120);
            java.awt.image.BufferedImage bufferedImage =
                    com.google.zxing.client.j2se.MatrixToImageWriter.toBufferedImage(matrix);
            return javafx.embed.swing.SwingFXUtils.toFXImage(bufferedImage, null);
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }

    // ============================================================
    // MODIFIER — ComboBox émotion + indicateurs colorés
    // ============================================================

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

        // EN-TÊTE
        VBox header = new VBox(6);
        header.setAlignment(Pos.CENTER_LEFT);
        header.setPadding(new Insets(22, 28, 18, 28));
        header.setStyle("-fx-background-color: linear-gradient(to right, #5a3ea1, #7c5cbf);");
        Label titreLabel = new Label("✏️  Edit Habit");
        titreLabel.setStyle("-fx-text-fill: white; -fx-font-size: 18px; -fx-font-weight: bold;");
        Label sousTitre = new Label("Edit your habit information");
        sousTitre.setStyle("-fx-text-fill: #d8ccf5; -fx-font-size: 12px;");
        header.getChildren().addAll(titreLabel, sousTitre);

        // SECTION NOM + ÉMOTION
        VBox infoSection = new VBox(8);
        infoSection.setPadding(new Insets(16, 28, 10, 28));

        Label nomTitre = new Label("🌿  Habit Name");
        nomTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        TextField nomField = new TextField(selected.getNomHabitude());
        nomField.setStyle("-fx-font-size: 13px; -fx-background-radius: 8;" +
                "-fx-border-color: #e2e8f0; -fx-border-radius: 8; -fx-border-width: 1; -fx-padding: 8;");
        nomField.setPrefWidth(420);

        Label emotionTitre = new Label("💭  Dominant Emotion");
        emotionTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        ComboBox<String> emotionCombo = new ComboBox<>();

        emotionCombo.getItems().addAll(
                "\uD83D\uDE0A Joy", "\uD83D\uDE14 Sadness", "\uD83D\uDE20 Anger",
                "\uD83D\uDE30 Anxiety", "\uD83E\uDD14 Confusion", "\uD83D\uDE0C Calm",
                "\uD83D\uDE25 Frustration", "\uD83E\uDD29 Excitement", "\uD83D\uDE34 Tired",
                "\uD83D\uDE0D Love");

        emotionCombo.setValue(selected.getEmotionDominantes());
        emotionCombo.setPrefWidth(420);
        emotionCombo.setStyle("-fx-font-size: 13px; -fx-background-radius: 8;");

        infoSection.getChildren().addAll(nomTitre, nomField, emotionTitre, emotionCombo);

        Separator sep1 = new Separator();
        sep1.setPadding(new Insets(0, 20, 0, 20));

        // SECTION NIVEAUX avec indicateurs colorés
        VBox niveauxSection = new VBox(10);
        niveauxSection.setPadding(new Insets(10, 28, 10, 28));
        Label niveauxTitre = new Label("📊  Daily Levels");
        niveauxTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");

        Spinner<Integer> energieSpinner = new Spinner<>(0, 10, selected.getNiveauEnergie());
        energieSpinner.setEditable(true); energieSpinner.setPrefWidth(90);
        Label indEnergie = creerLabelIndicateur(selected.getNiveauEnergie(),
                getCouleurEnergie(selected.getNiveauEnergie()), getEmojiEnergie(selected.getNiveauEnergie()), "Energy");
        energieSpinner.valueProperty().addListener((obs, o, v) ->
                mettreAJourIndicateur(indEnergie, v, getCouleurEnergie(v), getEmojiEnergie(v), "Energy"));

        Spinner<Integer> stressSpinner = new Spinner<>(0, 10, selected.getNiveauStress());
        stressSpinner.setEditable(true); stressSpinner.setPrefWidth(90);
        Label indStress = creerLabelIndicateur(selected.getNiveauStress(),
                getCouleurStress(selected.getNiveauStress()), getEmojiStress(selected.getNiveauStress()), "Stress");
        stressSpinner.valueProperty().addListener((obs, o, v) ->
                mettreAJourIndicateur(indStress, v, getCouleurStress(v), getEmojiStress(v), "Stress"));

        Spinner<Integer> sommeilSpinner = new Spinner<>(0, 10, selected.getQualiteSommeil());
        sommeilSpinner.setEditable(true); sommeilSpinner.setPrefWidth(90);
        Label indSommeil = creerLabelIndicateur(selected.getQualiteSommeil(),
                getCouleurSommeil(selected.getQualiteSommeil()), getEmojiSommeil(selected.getQualiteSommeil()), "Sleep");
        sommeilSpinner.valueProperty().addListener((obs, o, v) ->
                mettreAJourIndicateur(indSommeil, v, getCouleurSommeil(v), getEmojiSommeil(v), "Sleep"));

        niveauxSection.getChildren().addAll(
                niveauxTitre,
                creerSpinnerRow("⚡ Energy :", energieSpinner, indEnergie),
                creerSpinnerRow("😰 Stress :", stressSpinner, indStress),
                creerSpinnerRow("😴 Sleep :", sommeilSpinner, indSommeil)
        );

        Separator sep2 = new Separator();
        sep2.setPadding(new Insets(0, 20, 0, 20));

        // SECTION NOTE
        VBox noteSection = new VBox(8);
        noteSection.setPadding(new Insets(10, 28, 16, 28));
        Label noteTitre = new Label("📝  Personal Note");
        noteTitre.setStyle("-fx-font-size: 13px; -fx-text-fill: #4a5568; -fx-font-weight: bold;");
        TextArea noteArea = new TextArea(selected.getNoteTextuelle());
        noteArea.setWrapText(true); noteArea.setPrefRowCount(4); noteArea.setPrefWidth(420);
        noteArea.setStyle("-fx-font-size: 13px; -fx-text-fill: #2d3748;" +
                "-fx-background-color: #f7fafc; -fx-background-radius: 8; -fx-padding: 10;" +
                "-fx-border-color: #e2e8f0; -fx-border-radius: 8; -fx-border-width: 1;");
        noteSection.getChildren().addAll(noteTitre, noteArea);

        // BOUTONS
        Button btnSave = new Button("✅  Save");
        btnSave.setStyle("-fx-background-color: #5a3ea1; -fx-text-fill: white;" +
                "-fx-font-weight: bold; -fx-font-size: 13px;" +
                "-fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        Button btnCancel = new Button("✕  Cancel");
        btnCancel.setStyle("-fx-background-color: #e2e8f0; -fx-text-fill: #4a5568;" +
                "-fx-font-weight: bold; -fx-font-size: 13px;" +
                "-fx-background-radius: 8; -fx-padding: 8 20 8 20; -fx-cursor: hand;");
        btnCancel.setOnAction(e -> popup.close());
        btnSave.setOnAction(e -> {
            selected.setNomHabitude(nomField.getText());
            selected.setEmotionDominantes(emotionCombo.getValue());
            selected.setNoteTextuelle(noteArea.getText());
            selected.setNiveauEnergie(energieSpinner.getValue());
            selected.setNiveauStress(stressSpinner.getValue());
            selected.setQualiteSommeil(sommeilSpinner.getValue());
            try {
                habitudeService.update(selected);
                popup.close();
                chargerHabitudes();
                statusLabel.setText("✅ Habit edited!");
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
        root.getChildren().addAll(header, infoSection, sep1, niveauxSection, sep2, noteSection, footerBox);
        javafx.scene.Scene scene = new javafx.scene.Scene(root, 500, 580);
        scene.setFill(javafx.scene.paint.Color.TRANSPARENT);
        popup.setScene(scene);
        popup.showAndWait();
    }

    // ============================================================
    // ACTIONS
    // ============================================================

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
    void allerAuJournal(ActionEvent event) {
        ViewManager.loadView("journal/AffichageJournal");
    }

    @FXML
    void allerAuDashboard(ActionEvent event) {
        ViewManager.loadView("user/dashboard");
    }

    // ============================================================
    // RECHERCHE
    // ============================================================

    private void rechercherHabitude() {
        try {
            String keyword = searchField.getText();
            if (keyword == null || keyword.isEmpty()) {
                habitudeTable.setItems(FXCollections.observableArrayList(habitudeService.findByUserId(getCurrentUserId())));
            } else {
                habitudeTable.setItems(FXCollections.observableArrayList(habitudeService.search(keyword, getCurrentUserId())));
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
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
            fileChooser.setInitialFileName("My Habits.pdf");
            Stage stage = (Stage) habitudeTable.getScene().getWindow();
            File file = fileChooser.showSaveDialog(stage);
            if (file == null) return;
            List<Habitude> habitudes = habitudeService.findByUserId(getCurrentUserId());
            PdfExporter.exportHabitudes(habitudes, file.getAbsolutePath());
            statusLabel.setText("✅ PDF saved!");
        } catch (Exception e) {
            statusLabel.setText("❌ Error exporting PDF");
            e.printStackTrace();
        }
    }

    // ============================================================
    // HELPERS
    // ============================================================

    private HBox creerLigneIndicateur(String titre, int val, String couleur, String emoji, String libelle) {
        HBox row = new HBox(10);
        row.setAlignment(Pos.CENTER_LEFT);
        Label lblTitre = new Label(titre);
        lblTitre.setStyle("-fx-font-size: 12px; -fx-text-fill: #718096; -fx-min-width: 90;");
        Label badge = new Label(emoji + "  " + val + "/10  -  " + libelle);
        badge.setStyle("-fx-background-color: " + couleur + "22;" +
                "-fx-text-fill: " + couleur + ";" +
                "-fx-font-weight: bold; -fx-font-size: 12px;" +
                "-fx-background-radius: 20; -fx-padding: 4 12 4 12;");
        row.getChildren().addAll(lblTitre, badge);
        return row;
    }

    private HBox creerSpinnerRow(String titre, Spinner<Integer> spinner, Label indicateur) {
        HBox row = new HBox(12);
        row.setAlignment(Pos.CENTER_LEFT);
        Label lbl = new Label(titre);
        lbl.setStyle("-fx-font-size: 12px; -fx-text-fill: #718096; -fx-min-width: 90;");
        row.getChildren().addAll(lbl, spinner, indicateur);
        return row;
    }

    private Label creerLabelIndicateur(int valeur, String couleur, String emoji, String nom) {
        Label lbl = new Label(emoji + " " + nom + " : " + valeur + "/10");
        lbl.setStyle("-fx-background-color: " + couleur + "22;" +
                "-fx-text-fill: " + couleur + ";" +
                "-fx-font-weight: bold; -fx-font-size: 12px;" +
                "-fx-background-radius: 8; -fx-padding: 4 12 4 12;");
        return lbl;
    }

    private void mettreAJourIndicateur(Label lbl, int valeur, String couleur, String emoji, String nom) {
        lbl.setText(emoji + " " + nom + " : " + valeur + "/10");
        lbl.setStyle("-fx-background-color: " + couleur + "22;" +
                "-fx-text-fill: " + couleur + ";" +
                "-fx-font-weight: bold; -fx-font-size: 12px;" +
                "-fx-background-radius: 8; -fx-padding: 4 12 4 12;");
    }

    private void showAlert(Alert.AlertType type, String title, String message) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setContentText(message);
        alert.show();
    }
}