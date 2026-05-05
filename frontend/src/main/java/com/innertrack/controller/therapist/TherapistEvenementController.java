package com.innertrack.controller.therapist;

import com.innertrack.controller.auth.MainLayoutController;
import com.innertrack.dao.EvenementDao;
import com.innertrack.model.Evenement;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.scene.control.DatePicker;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class TherapistEvenementController {

    // ---- UI Components ----
    @FXML
    private TextField evenementSearchField;
    @FXML
    private ComboBox<String> evenementStatutCombo;
    @FXML
    private TableView<Evenement> evenementsTable;
    @FXML
    private TableColumn<Evenement, String> colEvenementId, colEvenementTitre, colEvenementDate, colEvenementLieu, colEvenementStatut, colEvenementParticipants;
    @FXML
    private TableColumn<Evenement, Void> colEvenementActions;
    @FXML
    private Label evenementPageLabel;
    @FXML
    private Label evenementTotalLabel;
    @FXML
    private Label welcomeLabel;
    @FXML
    private Button btnBack;

    private final EvenementDao evenementDao = new EvenementDao();
    private final DateTimeFormatter df = DateTimeFormatter.ofPattern("dd/MM/yyyy");
    private final DateTimeFormatter dfFull = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    private int evenementCurrentPage = 0;
    private static final int EVENEMENT_PAGE_SIZE = 10;

    @FXML
    public void initialize() {
        com.innertrack.model.User therapist = SessionManager.getInstance().getCurrentUser();
        welcomeLabel.setText("Bonjour, Dr. " + therapist.getFullName());

        MainLayoutController.getInstance().setNavbarVisible(false);
        MainLayoutController.getInstance().setFooterVisible(false);

        setupTable();
        setupFilters();
        loadEvenements();
    }

    private void setupTable() {
        // Evenements table setup
        colEvenementId.setCellValueFactory(d -> new SimpleStringProperty(String.valueOf(d.getValue().getId())));
        colEvenementTitre.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getTitre()));
        colEvenementDate.setCellValueFactory(d -> {
            String date = d.getValue().getDateDebut() != null
                    ? d.getValue().getDateDebut().format(df)
                    : "â";
            return new SimpleStringProperty(date);
        });
        colEvenementLieu.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getLieu()));
        colEvenementStatut.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getStatut()));
        colEvenementParticipants.setCellValueFactory(d -> {
            Integer current = d.getValue().getNombreParticipants();
            Integer max = d.getValue().getNombreMaxParticipants();
            if (current != null && max != null) {
                return new SimpleStringProperty(current + "/" + max);
            } else if (max != null) {
                return new SimpleStringProperty("0/" + max);
            } else {
                return new SimpleStringProperty("â");
            }
        });

        colEvenementStatut.setCellFactory(col -> new TableCell<>() {
            @Override
            protected void updateItem(String statut, boolean empty) {
                super.updateItem(statut, empty);
                if (empty || statut == null) {
                    setText(null);
                    setStyle("");
                    return;
                }
                setText(statut);
                switch (statut) {
                    case "ACTIF" -> setStyle("-fx-background-color: #48bb78; -fx-text-fill: white; -fx-background-radius: 12; -fx-padding: 2 8;");
                    case "ANNULE" -> setStyle("-fx-background-color: #f56565; -fx-text-fill: white; -fx-background-radius: 12; -fx-padding: 2 8;");
                    case "TERMINE" -> setStyle("-fx-background-color: #a0aec0; -fx-text-fill: white; -fx-background-radius: 12; -fx-padding: 2 8;");
                    default -> setStyle("-fx-background-color: #ed8936; -fx-text-fill: white; -fx-background-radius: 12; -fx-padding: 2 8;");
                }
            }
        });

        colEvenementActions.setCellFactory(col -> new TableCell<>() {
            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                    return;
                }

                Evenement evenement = getTableView().getItems().get(getIndex());
                HBox actions = new HBox(5);

                Button viewBtn = new Button("Voir");
                viewBtn.setStyle("-fx-background-color: #4299e1; -fx-text-fill: white; -fx-background-radius: 4; -fx-padding: 4 8; -fx-font-size: 11px;");
                viewBtn.setOnAction(e -> viewEvenement(evenement));

                actions.getChildren().add(viewBtn);
                setGraphic(actions);
            }
        });
    }

    private void setupFilters() {
        evenementStatutCombo.setItems(FXCollections.observableArrayList(
                "", "ACTIF", "ANNULE", "TERMINE"));
        evenementStatutCombo.setPromptText("Tous les statuts");
    }

    private void loadEvenements() {
        new Thread(() -> {
            String statut = evenementStatutCombo.getValue();
            List<Evenement> evenements = evenementDao.findAll(evenementCurrentPage + 1, EVENEMENT_PAGE_SIZE, statut);
            int total = evenementDao.getTotalCount(statut);
            
            Platform.runLater(() -> {
                evenementsTable.getItems().clear();
                evenementsTable.getItems().addAll(evenements);
                evenementPageLabel.setText("Page " + (evenementCurrentPage + 1));
                evenementTotalLabel.setText(total + " événements");
            });
        }, "load-evenements").start();
    }

    @FXML
    private void handleEvenementSearch() {
        evenementCurrentPage = 0;
        loadEvenements();
    }

    @FXML
    private void resetEvenementFilters() {
        evenementSearchField.clear();
        evenementStatutCombo.setValue(null);
        evenementCurrentPage = 0;
        loadEvenements();
    }

    @FXML
    private void handleEvenementPrevPage() {
        if (evenementCurrentPage > 0) {
            evenementCurrentPage--;
            loadEvenements();
        }
    }

    @FXML
    private void handleEvenementNextPage() {
        String statut = evenementStatutCombo.getValue();
        int total = evenementDao.getTotalCount(statut);
        if ((evenementCurrentPage + 1) * EVENEMENT_PAGE_SIZE < total) {
            evenementCurrentPage++;
            loadEvenements();
        }
    }

    private void viewEvenement(Evenement evenement) {
        Stage dialog = new Stage();
        dialog.initModality(Modality.APPLICATION_MODAL);
        dialog.setTitle("Détails de l'Événement");
        
        VBox dialogVBox = new VBox(15);
        dialogVBox.setPadding(new Insets(20));
        
        Label titleLabel = new Label("Titre: " + evenement.getTitre());
        titleLabel.setStyle("-fx-font-weight: bold; -fx-font-size: 16px;");
        
        TextArea descriptionArea = new TextArea(evenement.getDescription());
        descriptionArea.setPrefRowCount(4);
        descriptionArea.setEditable(false);
        
        Label dateDebutLabel = new Label("Date de début: " + 
            (evenement.getDateDebut() != null ? evenement.getDateDebut().format(dfFull) : "â"));
        Label dateFinLabel = new Label("Date de fin: " + 
            (evenement.getDateFin() != null ? evenement.getDateFin().format(dfFull) : "â"));
        Label lieuLabel = new Label("Lieu: " + evenement.getLieu());
        Label statutLabel = new Label("Statut: " + evenement.getStatut());
        
        String participantsText = evenement.getNombreMaxParticipants() != null ? 
            (evenement.getNombreParticipants() != null ? evenement.getNombreParticipants() : "0") + 
            "/" + evenement.getNombreMaxParticipants() : "Non limité";
        Label participantsLabel = new Label("Participants: " + participantsText);
        
        Button closeBtn = new Button("Fermer");
        closeBtn.setStyle("-fx-background-color: #718096; -fx-text-fill: white;");
        closeBtn.setOnAction(e -> dialog.close());
        
        dialogVBox.getChildren().addAll(
            titleLabel,
            new Separator(),
            new Label("Description:"), descriptionArea,
            dateDebutLabel, dateFinLabel, lieuLabel, statutLabel, participantsLabel,
            closeBtn
        );
        
        Scene scene = new Scene(dialogVBox, 400, 400);
        dialog.setScene(scene);
        dialog.showAndWait();
    }

    @FXML
    private void handleBack() {
        ViewManager.loadView("therapist/dashboard");
    }
}
