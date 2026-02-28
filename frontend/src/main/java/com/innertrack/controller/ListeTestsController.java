package com.innertrack.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import com.innertrack.model.Question;
import com.innertrack.model.Resultat;
import com.innertrack.model.TestPsychologique;
import com.innertrack.service.*;
import com.innertrack.util.DBConnection;
import com.innertrack.util.ViewManager;
import com.innertrack.session.SessionManager;

import java.io.IOException;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;
import java.util.ResourceBundle;

public class ListeTestsController implements Initializable {

    @FXML
    private TextField searchField;
    @FXML
    private Label totalTestsLabel;
    @FXML
    private Label totalQuestionsLabel;
    @FXML
    private VBox testsListContainer;
    @FXML
    private VBox questionsListContainer;
    @FXML
    private VBox detailsSection;
    @FXML
    private VBox emptyStateSection;
    @FXML
    private Label testTitreLabel;
    @FXML
    private Label testTypeLabel;
    @FXML
    private Label testDescriptionLabel;
    @FXML
    private Label testNbQuestionsLabel;
    @FXML
    private Label statusLabel;
    @FXML
    private javafx.scene.control.Button btnAjouterTest;
    @FXML
    private javafx.scene.layout.HBox crudButtonsBox;

    private TestPsychologiqueCrudService testService;
    private QuestionCrudService questionService;
    private ResultatService resultatService;
    private TestPsychologique testSelectionne;
    private List<TestPsychologique> tousLesTests;
    private List<Question> questionsActuelles;
    private int nbReponsesEnregistrees = 0;
    private Resultat resultat;

    private final String[] TYPES_TESTS = {
            "Test de Personnalité", "Test Cognitif", "Test d'Anxiété",
            "Test de Dépression", "Test d'Intelligence Émotionnelle",
            "Test de Mémoire", "Test d'Attention",
            "Évaluation Comportementale", "Test Projectif", "Autre"
    };

    private int getCurrentUserId() {
        try {
            return SessionManager.getInstance().getCurrentUser().getId();
        } catch (Exception e) {
            System.err.println("⚠️ No user session — defaulting to id=1");
            return 1;
        }
    }

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        testService = new TestPsychologiqueCrudService();
        questionService = new QuestionCrudService();
        resultatService = new ResultatService();
        chargerTests();
        afficherEtatVide();
        updateStatistiques();

        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        boolean isTherapist = user != null && user.getRoles().contains("ROLE_PSYCHOLOGUE");
        if (!isTherapist) {
            if (btnAjouterTest != null) {
                btnAjouterTest.setVisible(false);
                btnAjouterTest.setManaged(false);
            }
            if (crudButtonsBox != null) {
                crudButtonsBox.setVisible(false);
                crudButtonsBox.setManaged(false);
            }
        }
    }

    // ── Data loading ──

    private void chargerTests() {
        try {
            tousLesTests = testService.recuperer();
            afficherTests(tousLesTests);
            updateStatistiques();
            updateStatus("Tests chargés avec succès");
        } catch (SQLException e) {
            showError("Erreur", "Erreur lors du chargement des tests: " + e.getMessage());
        }
    }

    private void afficherTests(List<TestPsychologique> tests) {
        testsListContainer.getChildren().clear();
        if (tests.isEmpty()) {
            Label emptyLabel = new Label("Aucun test trouvé");
            emptyLabel.setStyle("-fx-text-fill: #a0aec0; -fx-font-style: italic;");
            testsListContainer.getChildren().add(emptyLabel);
            return;
        }
        for (TestPsychologique test : tests) {
            testsListContainer.getChildren().add(creerCarteTest(test));
        }
    }

    private VBox creerCarteTest(TestPsychologique test) {
        VBox card = new VBox(8);
        card.getStyleClass().add("test-card");
        card.setPadding(new Insets(15));

        Label titre = new Label(test.getTitre());
        titre.getStyleClass().add("test-card-title");
        titre.setWrapText(true);

        HBox infoBox = new HBox(15);
        infoBox.setAlignment(Pos.CENTER_LEFT);

        Label typeLabel = new Label(getTypeNom(test.getIdType()));
        typeLabel.getStyleClass().add("test-card-badge");

        Label nbQuestions = new Label(test.getNombreQuestions() + " questions");
        nbQuestions.getStyleClass().add("test-card-info");

        Button btnRetryQuick = new Button("🔄");
        btnRetryQuick.getStyleClass().add("btn-retry-quick");
        btnRetryQuick.setTooltip(new Tooltip("Réinitialiser mes réponses"));
        btnRetryQuick.setOnAction(e -> {
            testSelectionne = test;
            retryTest();
            e.consume();
        });

        Button btnViewResult = new Button("📊");
        btnViewResult.getStyleClass().add("btn-view-result");
        btnViewResult.setTooltip(new Tooltip("Voir mon dernier résultat"));
        btnViewResult.setVisible(false);
        btnViewResult.setManaged(false);

        try {
            int userId = getCurrentUserId();
            Resultat r = resultatService.recupererParUtilisateurEtTest(userId, test.getIdTest());
            if (r != null) {
                btnViewResult.setVisible(true);
                btnViewResult.setManaged(true);
                btnViewResult.setOnAction(e -> {
                    testSelectionne = test;
                    int total = test.getNombreQuestions();
                    afficherResultatBelle(r, total, total);
                    e.consume();
                });
            }
        } catch (SQLException e) {
            System.err.println("Erreur verif resultat existant: " + e.getMessage());
        }

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        infoBox.getChildren().addAll(typeLabel, nbQuestions, spacer, btnViewResult, btnRetryQuick);
        card.getChildren().addAll(titre, infoBox);

        card.setOnMouseClicked(event -> {
            testsListContainer.getChildren().forEach(node -> node.getStyleClass().remove("test-card-selected"));
            card.getStyleClass().add("test-card-selected");
            selectionnerTest(test);
        });
        return card;
    }

    private void selectionnerTest(TestPsychologique test) {
        nbReponsesEnregistrees = 0;
        testSelectionne = test;
        emptyStateSection.setVisible(false);
        emptyStateSection.setManaged(false);
        detailsSection.setVisible(true);
        detailsSection.setManaged(true);

        testTitreLabel.setText(test.getTitre());
        testTypeLabel.setText(getTypeNom(test.getIdType()));
        testDescriptionLabel.setText(test.getDescription());
        testNbQuestionsLabel.setText(String.valueOf(test.getNombreQuestions()));

        chargerQuestionsDuTest(test.getIdTest());

        // Show "View Results" in details if result exists
        try {
            int userId = getCurrentUserId();
            Resultat r = resultatService.recupererParUtilisateurEtTest(userId, test.getIdTest());
            if (r != null) {
                Button btnResult = new Button("📊 Voir mon dernier résultat");
                btnResult.getStyleClass().add("btn-view-result-large");
                btnResult.setMaxWidth(Double.MAX_VALUE);
                btnResult.setStyle(
                        "-fx-background-color: -it-primary; -fx-text-fill: white; -fx-padding: 10; -fx-background-radius: 8; -fx-cursor: hand; -fx-margin: 10 0;");
                btnResult.setOnAction(e -> {
                    int total = test.getNombreQuestions();
                    afficherResultatBelle(r, total, total);
                });
                questionsListContainer.getChildren().add(0, btnResult);
            }
        } catch (SQLException e) {
            System.err.println("Erreur details result: " + e.getMessage());
        }

        updateStatus("Test sélectionné: " + test.getTitre());
    }

    private void chargerQuestionsDuTest(int idTest) {
        try {
            questionsActuelles = questionService.recupererParTest(idTest);
            afficherQuestions(questionsActuelles);
        } catch (SQLException e) {
            showError("Erreur", "Erreur chargement questions: " + e.getMessage());
        }
    }

    private void afficherQuestions(List<Question> questions) {
        questionsListContainer.getChildren().clear();
        if (questions.isEmpty()) {
            Label emptyLabel = new Label("Aucune question pour ce test");
            emptyLabel.setStyle("-fx-text-fill: #a0aec0; -fx-font-style: italic; -fx-padding: 20;");
            questionsListContainer.getChildren().add(emptyLabel);
            return;
        }
        for (int i = 0; i < questions.size(); i++) {
            questionsListContainer.getChildren().add(creerCarteQuestion(questions.get(i), i + 1));
        }
    }

    private VBox creerCarteQuestion(Question question, int numero) {
        VBox card = new VBox(12);
        card.getStyleClass().add("question-card");
        card.setPadding(new Insets(15));

        HBox headerBox = new HBox(15);
        headerBox.setAlignment(Pos.TOP_LEFT);

        Label numeroLabel = new Label(String.valueOf(numero));
        numeroLabel.getStyleClass().add("question-number");
        numeroLabel.setMinWidth(35);
        numeroLabel.setMinHeight(35);
        numeroLabel.setAlignment(Pos.CENTER);

        Label contenuLabel = new Label(question.getContenu());
        contenuLabel.getStyleClass().add("question-text");
        contenuLabel.setWrapText(true);
        HBox.setHgrow(contenuLabel, Priority.ALWAYS);

        Button btnSon = creerBoutonSon("Question " + numero + " : " + question.getContenu());
        headerBox.getChildren().addAll(numeroLabel, contenuLabel, btnSon);

        // Answer buttons: Oui / Non / Parfois
        HBox reponsesBox = new HBox(10);
        reponsesBox.setAlignment(Pos.CENTER_LEFT);
        reponsesBox.setPadding(new Insets(10, 0, 0, 50));

        Button btnOui = new Button("✓ Oui");
        Button btnNon = new Button("✗ Non");
        Button btnParfois = new Button("~ Parfois");
        btnOui.getStyleClass().addAll("reponse-btn", "reponse-btn-oui");
        btnNon.getStyleClass().addAll("reponse-btn", "reponse-btn-non");
        btnParfois.getStyleClass().addAll("reponse-btn", "reponse-btn-parfois");

        int idUtilisateur = getCurrentUserId();
        com.innertrack.model.User currentUser = SessionManager.getInstance().getCurrentUser();
        boolean userIsTherapist = currentUser != null && currentUser.getRoles().contains("ROLE_PSYCHOLOGUE");

        if (userIsTherapist) {
            btnOui.setDisable(true);
            btnNon.setDisable(true);
            btnParfois.setDisable(true);
        }

        String choixExistant = recupererReponseExistante(idUtilisateur, question.getIdQuestion());

        btnOui.setOnAction(e -> {
            enregistrerReponseUtilisateur(idUtilisateur, question, "Oui");
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnOui.setStyle("-fx-opacity: 1; -fx-border-color: #2f855a; -fx-border-width: 2;");
        });
        btnNon.setOnAction(e -> {
            enregistrerReponseUtilisateur(idUtilisateur, question, "Non");
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnNon.setStyle("-fx-opacity: 1; -fx-border-color: #c53030; -fx-border-width: 2;");
        });
        btnParfois.setOnAction(e -> {
            enregistrerReponseUtilisateur(idUtilisateur, question, "Parfois");
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnParfois.setStyle("-fx-opacity: 1; -fx-border-color: #c05621; -fx-border-width: 2;");
        });

        // Restore previous state if it exists
        if ("Oui".equals(choixExistant)) {
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnOui.setStyle("-fx-opacity: 1; -fx-border-color: #2f855a; -fx-border-width: 2;");
            nbReponsesEnregistrees++; // increment counter for loaded answers
        } else if ("Non".equals(choixExistant)) {
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnNon.setStyle("-fx-opacity: 1; -fx-border-color: #c53030; -fx-border-width: 2;");
            nbReponsesEnregistrees++;
        } else if ("Parfois".equals(choixExistant)) {
            desactiverBoutons(btnOui, btnNon, btnParfois);
            btnParfois.setStyle("-fx-opacity: 1; -fx-border-color: #c05621; -fx-border-width: 2;");
            nbReponsesEnregistrees++;
        }

        reponsesBox.getChildren().addAll(btnOui, btnNon, btnParfois);

        com.innertrack.model.User user = null;
        try {
            user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        } catch (Exception ex) {
            // ignore
        }
        boolean isTherapist = user != null && user.getRoles().contains("ROLE_PSYCHOLOGUE");

        if (isTherapist) {
            // Edit/Delete buttons
            HBox actionsBox = new HBox(10);
            actionsBox.setAlignment(Pos.CENTER_RIGHT);
            actionsBox.setPadding(new Insets(10, 0, 0, 0));

            Button editBtn = new Button("✏️ Modifier");
            Button deleteBtn = new Button("🗑️ Supprimer");
            editBtn.getStyleClass().add("question-edit-btn");
            deleteBtn.getStyleClass().add("question-delete-btn");
            editBtn.setOnAction(e -> modifierQuestion(question));
            deleteBtn.setOnAction(e -> supprimerQuestion(question));

            actionsBox.getChildren().addAll(editBtn, deleteBtn);
            card.getChildren().addAll(headerBox, reponsesBox, actionsBox);
        } else {
            card.getChildren().addAll(headerBox, reponsesBox);
        }

        return card;
    }

    // ── Answer recording ──

    private String recupererReponseExistante(int idUtilisateur, int idQuestion) {
        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sql = "SELECT r.contenu FROM reponse_utilisateur ru " +
                    "JOIN reponse r ON ru.id_reponse = r.id_reponse " +
                    "WHERE ru.id_utilisateur = ? AND ru.id_question = ?";
            PreparedStatement ps = cnx.prepareStatement(sql);
            ps.setInt(1, idUtilisateur);
            ps.setInt(2, idQuestion);
            ResultSet rs = ps.executeQuery();
            if (rs.next()) {
                return rs.getString("contenu");
            }
        } catch (SQLException e) {
            System.err.println("Erreur recuperation reponse: " + e.getMessage());
        }
        return null;
    }

    private void enregistrerReponseUtilisateur(int idUtilisateur, Question question, String choix) {
        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sql = "SELECT id_reponse FROM reponse WHERE id_question = ? AND contenu = ?";
            PreparedStatement ps = cnx.prepareStatement(sql);
            ps.setInt(1, question.getIdQuestion());
            ps.setString(2, choix);
            ResultSet rs = ps.executeQuery();

            if (rs.next()) {
                int idReponse = rs.getInt("id_reponse");
                String insertSql = """
                            INSERT INTO reponse_utilisateur (id_utilisateur, id_question, id_reponse)
                            VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE id_reponse = VALUES(id_reponse)
                        """;
                PreparedStatement insertPs = cnx.prepareStatement(insertSql);
                insertPs.setInt(1, idUtilisateur);
                insertPs.setInt(2, question.getIdQuestion());
                insertPs.setInt(3, idReponse);
                insertPs.executeUpdate();

                nbReponsesEnregistrees++;
                int total = questionsActuelles != null ? questionsActuelles.size() : 0;
                updateStatus("Progression : " + nbReponsesEnregistrees + "/" + total);

                if (nbReponsesEnregistrees >= total && total > 0) {
                    afficherBoutonTerminer(idUtilisateur, testSelectionne.getIdTest(), total);
                }
            } else {
                showWarning("Attention", "Aucune réponse configurée pour ce choix.");
            }
        } catch (SQLException e) {
            showError("Erreur", "Impossible d'enregistrer la réponse: " + e.getMessage());
        }
    }

    private void afficherBoutonTerminer(int idUtilisateur, int idTest, int total) {
        boolean dejaPresent = questionsListContainer.getChildren().stream()
                .anyMatch(n -> "btn-terminer".equals(n.getId()));
        if (dejaPresent)
            return;

        Button btnTerminer = new Button("✅ Terminer le test et voir mes résultats");
        btnTerminer.setId("btn-terminer");
        btnTerminer.setMaxWidth(Double.MAX_VALUE);
        btnTerminer.setStyle("""
                -fx-background-color: #38a169; -fx-text-fill: white;
                -fx-font-size: 15px; -fx-font-weight: bold;
                -fx-padding: 15 30; -fx-background-radius: 12; -fx-cursor: hand;
                """);

        btnTerminer.setOnAction(e -> {
            try {
                ResultatService service = new ResultatService();
                Resultat r = service.calculerEtEnregistrer(idUtilisateur, idTest);
                afficherResultatBelle(r, total, total);
                chargerTests(); // Refresh the list to show the 📊 button on the card
            } catch (Exception ex) {
                showError("Erreur", "Impossible de calculer le résultat: " + ex.getMessage());
            }
        });

        Label msgLabel = new Label("🎉 Vous avez répondu à toutes les questions !");
        msgLabel.setStyle("-fx-font-size: 14px; -fx-text-fill: #276749; -fx-font-weight: bold; -fx-padding: 10 0 5 0;");

        VBox finBox = new VBox(10, msgLabel, btnTerminer);
        finBox.setId("btn-terminer");
        finBox.setPadding(new Insets(20, 10, 10, 10));
        questionsListContainer.getChildren().add(finBox);

        javafx.application.Platform.runLater(() -> {
            javafx.scene.Node node = questionsListContainer.getScene().lookup(".questions-scroll");
            if (node instanceof ScrollPane sp)
                sp.setVvalue(1.0);
        });
    }

    private void desactiverBoutons(Button... boutons) {
        for (Button b : boutons)
            b.setDisable(true);
    }

    // ── Result display ──

    private void afficherResultatBelle(Resultat resultat, int nbReponses, int nbQuestions) {
        this.resultat = resultat;
        Stage resultStage = new Stage();
        resultStage.setTitle("📊 Résultats du Test");
        resultStage.setMinWidth(560);
        resultStage.setMinHeight(500);

        VBox root = new VBox(20);
        root.setPadding(new Insets(30));
        root.setStyle("-fx-background-color: #f5f7fa;");

        String couleur = getCouleurNiveau(resultat.getResultat());
        String icone = getIconeNiveau(resultat.getResultat());

        // Header
        VBox header = new VBox(10);
        header.setPadding(new Insets(25));
        header.setAlignment(Pos.CENTER);
        header.setStyle("-fx-background-color: " + couleur + "; -fx-background-radius: 14;");

        Label iconLabel = new Label(icone);
        iconLabel.setStyle("-fx-font-size: 50px;");
        Label titreResultat = new Label(
                resultat.getResultat() != null ? resultat.getResultat() : "Résultat non défini");
        titreResultat.setStyle("-fx-font-size: 22px; -fx-font-weight: bold; -fx-text-fill: white;");
        titreResultat.setWrapText(true);
        Label scoreLabel = new Label("Score : " + resultat.getScoreTotal() + " / "
                + resultat.getScoreMaxPossible() + "   (" + String.format("%.1f", resultat.getPourcentage()) + "%)");
        scoreLabel.setStyle("-fx-font-size: 15px; -fx-text-fill: rgba(255,255,255,0.92);");
        header.getChildren().addAll(iconLabel, titreResultat, scoreLabel);

        // Progress
        VBox progressBox = new VBox(8);
        progressBox.setStyle("-fx-background-color: white; -fx-background-radius: 10; -fx-padding: 15;");
        Label progressTitle = new Label("📈 Progression du test");
        progressTitle.setStyle("-fx-font-weight: bold; -fx-text-fill: #4a5568;");
        javafx.scene.control.ProgressBar bar = new javafx.scene.control.ProgressBar(
                nbQuestions > 0 ? (double) nbReponses / nbQuestions : 0);
        bar.setMaxWidth(Double.MAX_VALUE);
        bar.setPrefHeight(18);
        bar.setStyle("-fx-accent: " + couleur + ";");
        Label progressText = new Label(nbReponses + " / " + nbQuestions + " questions répondues");
        progressText.setStyle("-fx-text-fill: #718096; -fx-font-size: 12px;");
        progressBox.getChildren().addAll(progressTitle, bar, progressText);

        // Result interpretation box
        VBox interpretBox = new VBox(10);
        interpretBox.setStyle("-fx-background-color: white; -fx-background-radius: 10; -fx-padding: 15;");
        Label interpretTitle = new Label("📋 Interprétation");
        interpretTitle.setStyle("-fx-font-weight: bold; -fx-font-size: 15px; -fx-text-fill: #2d3748;");
        String interpretation = resultat.getInterpretation();
        String texteALire = "Résultat : " + resultat.getResultat() + ". Score : " + resultat.getScoreTotal()
                + " sur " + resultat.getScoreMaxPossible() + ". Interprétation : " + interpretation;
        Button btnSonInterpret = creerBoutonSon(texteALire);
        HBox interpretTitleRow = new HBox(10, interpretTitle, btnSonInterpret);
        interpretTitleRow.setAlignment(Pos.CENTER_LEFT);
        Label interpretText = new Label((interpretation != null && !interpretation.isEmpty())
                ? interpretation
                : "Aucune interprétation disponible pour ce score.");
        interpretText.setWrapText(true);
        interpretText.setStyle("-fx-text-fill: #4a5568; -fx-font-size: 13px;");
        interpretBox.getChildren().addAll(interpretTitleRow, interpretText);

        // ML Recommendations button
        int idUtilisateurFinal = getCurrentUserId();
        Button btnML = new Button("🧠 Voir mes recommandations IA");
        btnML.setStyle("""
                -fx-background-color: #667eea; -fx-text-fill: white; -fx-font-weight: bold;
                -fx-padding: 12 30; -fx-background-radius: 10; -fx-cursor: hand; -fx-font-size: 13px;
                """);
        btnML.setOnAction(e -> {
            try {
                RecommandationMLService mlService = new RecommandationMLService();
                com.innertrack.model.AIRecommandation rec = mlService.genererRecommandations(resultat,
                        idUtilisateurFinal);
                afficherFenetreML(rec, resultStage);
            } catch (Exception ex) {
                new Alert(Alert.AlertType.ERROR, "Erreur ML : " + ex.getMessage()).showAndWait();
            }
        });

        // Retry Button
        Button btnRetry = new Button("🔄 Réessayer le test");
        btnRetry.setStyle("""
                -fx-background-color: transparent; -fx-text-fill: #f6ad55; -fx-font-weight: bold;
                -fx-padding: 11 29; -fx-background-radius: 10; -fx-cursor: hand; -fx-font-size: 13px;
                -fx-border-color: #f6ad55; -fx-border-width: 2px; -fx-border-radius: 10;
                """);
        btnRetry.setOnAction(e -> {
            resultStage.close();
            retryTest();
        });

        Button btnFermer = new Button("✓ Fermer");
        btnFermer.setStyle("-fx-background-color: " + couleur + "; -fx-text-fill: white; "
                + "-fx-font-weight: bold; -fx-padding: 12 40; -fx-background-radius: 10; -fx-cursor: hand;");
        btnFermer.setOnAction(e -> resultStage.close());

        HBox btnBox = new HBox(15, btnML, btnRetry, btnFermer);
        btnBox.setAlignment(Pos.CENTER);
        btnBox.setPadding(new Insets(20, 0, 10, 0));

        // Random Meme section
        com.innertrack.service.MemeService memeService = new com.innertrack.service.MemeService();
        String memeUrl = memeService.getRandomMemeUrl();
        VBox memeBox = new VBox(10);
        memeBox.setAlignment(Pos.CENTER);
        memeBox.setStyle("-fx-background-color: white; -fx-background-radius: 10; -fx-padding: 15;");
        Label memeTitle = new Label("😂 Pour détendre l'atmosphère :");
        memeTitle.setStyle("-fx-font-weight: bold; -fx-text-fill: #4a5568;");
        memeBox.getChildren().add(memeTitle);
        if (memeUrl != null) {
            try {
                javafx.scene.image.ImageView memeView = new javafx.scene.image.ImageView(
                        new javafx.scene.image.Image(memeUrl));
                memeView.setFitWidth(400);
                memeView.setPreserveRatio(true);
                memeBox.getChildren().add(memeView);

                Button btnWhatsAppMeme = new Button("📱 Partager ce meme sur WhatsApp");
                btnWhatsAppMeme.setStyle("""
                        -fx-background-color: #25D366; -fx-text-fill: white; -fx-font-weight: bold;
                        -fx-padding: 8 15; -fx-background-radius: 8; -fx-cursor: hand; -fx-font-size: 11px;
                        """);
                btnWhatsAppMeme.setOnAction(e -> envoyerMemeWhatsAppAction(memeUrl));
                memeBox.getChildren().add(btnWhatsAppMeme);
            } catch (Exception ignored) {
            }
        }

        // Random Quote
        com.innertrack.service.CitationService citationService = new com.innertrack.service.CitationService();
        String quote = citationService.getCitationDuJour();
        Label quoteLabel = new Label(quote);
        quoteLabel.setStyle(
                "-fx-font-style: italic; -fx-text-fill: #718096; -fx-font-size: 14px; -fx-padding: 20; -fx-alignment: center; -fx-text-alignment: center;");
        quoteLabel.setWrapText(true);
        quoteLabel.setMaxWidth(Double.MAX_VALUE);
        quoteLabel.setAlignment(Pos.CENTER);

        root.getChildren().addAll(header, progressBox, interpretBox, btnBox, memeBox, quoteLabel);

        ScrollPane scroll = new ScrollPane(root);
        scroll.setFitToWidth(true);
        scroll.setStyle("-fx-background-color: #f5f7fa;");
        resultStage.setScene(new Scene(scroll, 560, 600));
        resultStage.show();
    }

    private void envoyerMemeWhatsAppAction(String memeUrl) {
        try {
            com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
            String phone = user.getPhoneNumber();
            if (phone == null || phone.isEmpty()) {
                TextInputDialog dialog = new TextInputDialog();
                dialog.setTitle("WhatsApp");
                dialog.setHeaderText("Entrez votre numéro de téléphone :");
                dialog.setContentText("Numéro (+216...) :");
                dialog.showAndWait().ifPresent(p -> shareMeme(p, user.getFirstName(), memeUrl));
            } else {
                shareMeme(phone, user.getFirstName(), memeUrl);
            }
        } catch (Exception ex) {
            new Alert(Alert.AlertType.ERROR, "Erreur WhatsApp : " + ex.getMessage()).showAndWait();
        }
    }

    private void shareMeme(String phone, String name, String url) {
        try {
            // Sanitize number: remove spaces and non-digits (except +)
            String sanitizedPhone = phone.replaceAll("[^0-9+]", "");
            SmsService.getInstance().envoyerMemeWhatsApp(sanitizedPhone, name, url);
            new Alert(Alert.AlertType.INFORMATION, "Meme envoyé sur WhatsApp !").show();
        } catch (Exception ex) {
            new Alert(Alert.AlertType.ERROR, "Échec de l'envoi : " + ex.getMessage()).show();
        }
    }

    private void retryTest() {
        if (testSelectionne == null)
            return;
        try {
            int userId = getCurrentUserId();
            new com.innertrack.service.ResultatService().supprimerReponsesUtilisateurPourTest(
                    testSelectionne.getIdTest(),
                    userId);
            statusLabel.setText("Réponses réinitialisées. Vous pouvez recommencer le test.");
            chargerQuestionsDuTest(testSelectionne.getIdTest());
            chargerTests(); // Refresh the list to remove the 📊 button
        } catch (Exception e) {
            new Alert(Alert.AlertType.ERROR, "Impossible de réinitialiser le test : " + e.getMessage()).show();
        }
    }

    private void afficherFenetreML(com.innertrack.model.AIRecommandation rec, Stage parent) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/tests/recommandationML.fxml"));
            Parent root = loader.load();
            Recommandationmlcontroller ctrl = loader.getController();
            ctrl.setResultat(resultat, getCurrentUserId());

            Stage mlStage = new Stage();
            mlStage.setTitle("🧠 Recommandations IA — Profil " + rec.getCluster());
            mlStage.initOwner(parent);
            mlStage.setMinWidth(700);
            mlStage.setMinHeight(650);

            ScrollPane scroll = new ScrollPane(root);
            scroll.setFitToWidth(true);
            scroll.setStyle("-fx-background-color: #f5f7fb;");
            mlStage.setScene(new Scene(scroll, 720, 680));
            mlStage.show();
        } catch (IOException e) {
            new Alert(Alert.AlertType.ERROR,
                    "Impossible d'ouvrir les recommandations : " + e.getMessage()).showAndWait();
        }
    }

    private String getCouleurNiveau(String libelle) {
        if (libelle == null)
            return "#667eea";
        String l = libelle.toLowerCase();
        if (l.contains("critique") || l.contains("sévère") || l.contains("élevé"))
            return "#e53e3e";
        if (l.contains("modér"))
            return "#ed8936";
        if (l.contains("faible") || l.contains("léger") || l.contains("pas"))
            return "#48bb78";
        return "#667eea";
    }

    private String getIconeNiveau(String libelle) {
        if (libelle == null)
            return "📊";
        String l = libelle.toLowerCase();
        if (l.contains("critique") || l.contains("sévère"))
            return "🔴";
        if (l.contains("élevé") || l.contains("modér"))
            return "🟠";
        if (l.contains("faible") || l.contains("pas"))
            return "🟢";
        return "📊";
    }

    // ── Navigation ──

    @FXML
    private void ouvrirAjoutTest() {
        ViewManager.loadView("tests/ajouterTest");
    }

    @FXML
    private void ouvrirStatistiques() {
        Statistiquescontroller.ouvrirFenetre(getCurrentUserId());
    }

    @FXML
    private void actualiserListe() {
        chargerTests();
        afficherEtatVide();
        updateStatus("Liste actualisée");
    }

    @FXML
    private void retournerDashboard() {
        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        if (user != null && user.getRoles().contains("ROLE_PSYCHOLOGUE")) {
            com.innertrack.util.ViewManager.loadView("psychologue/dashboard");
        } else {
            com.innertrack.util.ViewManager.loadView("user/dashboard");
        }
    }

    // ── CRUD actions: Test ──

    @FXML
    private void modifierTest() {
        if (testSelectionne == null) {
            showWarning("Aucun test", "Sélectionnez un test.");
            return;
        }

        Dialog<TestPsychologique> dialog = new Dialog<>();
        dialog.setTitle("Modifier le Test");
        dialog.setHeaderText("Modification de: " + testSelectionne.getTitre());

        ButtonType btnValider = new ButtonType("Valider", ButtonBar.ButtonData.OK_DONE);
        dialog.getDialogPane().getButtonTypes().addAll(btnValider, ButtonType.CANCEL);

        VBox content = new VBox(15);
        content.setPadding(new Insets(20));
        TextField titreField = new TextField(testSelectionne.getTitre());
        ComboBox<String> typeCombo = new ComboBox<>();
        typeCombo.getItems().addAll(TYPES_TESTS);
        typeCombo.setValue(getTypeNom(testSelectionne.getIdType()));
        TextArea descArea = new TextArea(testSelectionne.getDescription());
        descArea.setPrefRowCount(4);
        descArea.setWrapText(true);
        content.getChildren().addAll(new Label("Titre:"), titreField,
                new Label("Type:"), typeCombo, new Label("Description:"), descArea);
        dialog.getDialogPane().setContent(content);

        dialog.setResultConverter(dialogButton -> {
            if (dialogButton == btnValider) {
                testSelectionne.setTitre(titreField.getText());
                testSelectionne.setIdType(typeCombo.getSelectionModel().getSelectedIndex() + 1);
                testSelectionne.setDescription(descArea.getText());
                return testSelectionne;
            }
            return null;
        });

        dialog.showAndWait().ifPresent(test -> {
            try {
                testService.modifier(test);
                showInfo("Succès", "Test modifié avec succès!");
                chargerTests();
                selectionnerTest(test);
            } catch (SQLException e) {
                showError("Erreur", "Impossible de modifier le test: " + e.getMessage());
            }
        });
    }

    @FXML
    private void supprimerTest() {
        if (testSelectionne == null) {
            showWarning("Aucun test", "Sélectionnez un test.");
            return;
        }

        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation de suppression");
        confirmation.setHeaderText("Supprimer: " + testSelectionne.getTitre());
        confirmation.setContentText("Cette action supprimera le test et toutes ses questions.");
        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                try {
                    testService.supprimer(testSelectionne.getIdTest());
                    showInfo("Succès", "Test supprimé avec succès!");
                    testSelectionne = null;
                    chargerTests();
                    afficherEtatVide();
                } catch (SQLException e) {
                    showError("Erreur", "Impossible de supprimer: " + e.getMessage());
                }
            }
        });
    }

    // ── CRUD actions: Question ──

    @FXML
    private void ajouterNouvelleQuestion() {
        if (testSelectionne == null) {
            showWarning("Aucun test", "Sélectionnez un test.");
            return;
        }

        TextInputDialog dialog = new TextInputDialog();
        dialog.setTitle("Nouvelle Question");
        dialog.setHeaderText("Ajouter une question à: " + testSelectionne.getTitre());
        dialog.setContentText("Contenu:");

        dialog.showAndWait().ifPresent(contenu -> {
            if (!contenu.trim().isEmpty()) {
                try {
                    Question q = new Question();
                    q.setIdTest(testSelectionne.getIdTest());
                    q.setContenu(contenu.trim());
                    questionService.ajouter(q);
                    testSelectionne.setNombreQuestions(testSelectionne.getNombreQuestions() + 1);
                    testService.modifier(testSelectionne);
                    chargerQuestionsDuTest(testSelectionne.getIdTest());
                    selectionnerTest(testSelectionne);
                    chargerTests();
                } catch (SQLException e) {
                    showError("Erreur", "Impossible d'ajouter: " + e.getMessage());
                }
            }
        });
    }

    private void modifierQuestion(Question question) {
        TextInputDialog dialog = new TextInputDialog(question.getContenu());
        dialog.setTitle("Modifier la Question");
        dialog.setContentText("Nouveau contenu:");
        dialog.showAndWait().ifPresent(contenu -> {
            if (!contenu.trim().isEmpty()) {
                try {
                    question.setContenu(contenu.trim());
                    questionService.modifier(question);
                    chargerQuestionsDuTest(testSelectionne.getIdTest());
                } catch (SQLException e) {
                    showError("Erreur", "Impossible de modifier: " + e.getMessage());
                }
            }
        });
    }

    private void supprimerQuestion(Question question) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation");
        confirmation.setHeaderText("Supprimer cette question?");
        confirmation.setContentText(question.getContenu());
        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                try {
                    questionService.supprimer(question.getIdQuestion());
                    testSelectionne.setNombreQuestions(testSelectionne.getNombreQuestions() - 1);
                    testService.modifier(testSelectionne);
                    chargerQuestionsDuTest(testSelectionne.getIdTest());
                    selectionnerTest(testSelectionne);
                    chargerTests();
                } catch (SQLException e) {
                    showError("Erreur", "Impossible de supprimer: " + e.getMessage());
                }
            }
        });
    }

    // ── Search ──

    @FXML
    private void rechercherTest() {
        String recherche = searchField.getText().toLowerCase().trim();
        if (recherche.isEmpty()) {
            afficherTests(tousLesTests);
            return;
        }
        List<TestPsychologique> filtres = tousLesTests.stream()
                .filter(t -> t.getTitre().toLowerCase().contains(recherche)).toList();
        afficherTests(filtres);
        updateStatus("Filtré: " + filtres.size() + " résultat(s)");
    }

    // ── Utilities ──

    private void afficherEtatVide() {
        detailsSection.setVisible(false);
        detailsSection.setManaged(false);
        emptyStateSection.setVisible(true);
        emptyStateSection.setManaged(true);
        testSelectionne = null;
    }

    private void updateStatistiques() {
        if (tousLesTests != null) {
            totalTestsLabel.setText(String.valueOf(tousLesTests.size()));
            totalQuestionsLabel.setText(String.valueOf(
                    tousLesTests.stream().mapToInt(TestPsychologique::getNombreQuestions).sum()));
        }
    }

    private void updateStatus(String message) {
        statusLabel.setText(message);
    }

    private String getTypeNom(int idType) {
        return (idType >= 1 && idType <= TYPES_TESTS.length) ? TYPES_TESTS[idType - 1] : "Autre";
    }

    public void rafraichirListe() {
        chargerTests();
    }

    private void showInfo(String t, String m) {
        Alert a = new Alert(Alert.AlertType.INFORMATION);
        a.setTitle(t);
        a.setHeaderText(null);
        a.setContentText(m);
        a.showAndWait();
    }

    private void showWarning(String t, String m) {
        Alert a = new Alert(Alert.AlertType.WARNING);
        a.setTitle(t);
        a.setHeaderText(null);
        a.setContentText(m);
        a.showAndWait();
    }

    private void showError(String t, String m) {
        Alert a = new Alert(Alert.AlertType.ERROR);
        a.setTitle(t);
        a.setHeaderText(null);
        a.setContentText(m);
        a.showAndWait();
    }

    private Button creerBoutonSon(String texte) {
        Button btn = new Button("🔊");
        btn.setStyle("""
                -fx-background-color: #edf2f7; -fx-text-fill: #4a5568; -fx-font-size: 14px;
                -fx-border-radius: 8; -fx-background-radius: 8; -fx-padding: 4 8;
                -fx-cursor: hand; -fx-min-width: 32;
                """);
        btn.setTooltip(new Tooltip("Lire à voix haute"));
        TTSService tts = TTSService.getInstance();
        btn.setOnAction(e -> {
            if (tts.isEnCoursLecture()) {
                tts.arreter();
                btn.setText("🔊");
            } else {
                btn.setText("⏹️");
                tts.lire(texte);
            }
        });
        return btn;
    }
}
