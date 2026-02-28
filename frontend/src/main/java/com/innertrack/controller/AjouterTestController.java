package com.innertrack.controller;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.VBox;
import com.innertrack.model.Question;
import com.innertrack.model.TestPsychologique;
import com.innertrack.service.QuestionCrudService;
import com.innertrack.service.TestPsychologiqueCrudService;
import com.innertrack.service.SmsService;
import com.innertrack.util.DBConnection;
import com.innertrack.util.ViewManager;

import java.net.URL;
import java.sql.*;
import java.util.*;

/**
 * Controller for adding psychological tests with their questions.
 */
public class AjouterTestController implements Initializable {

    @FXML
    private TextField titreField;
    @FXML
    private ComboBox<String> typeComboBox;
    @FXML
    private TextArea descriptionArea;
    @FXML
    private Spinner<Integer> nombreQuestionsSpinner;
    @FXML
    private Label questionsCountLabel;
    @FXML
    private Button ajouterQuestionBtn;
    @FXML
    private VBox ajoutQuestionBox;
    @FXML
    private TextArea questionContentArea;
    @FXML
    private VBox questionsListBox;
    @FXML
    private Label noQuestionsLabel;

    private TestPsychologiqueCrudService testService;
    private QuestionCrudService questionService;
    private List<String> questionsList;
    private int editingQuestionIndex = -1;
    private ListeTestsController listeTestsController;
    private Map<Integer, String> typesTestsMap;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        testService = new TestPsychologiqueCrudService();
        questionService = new QuestionCrudService();
        questionsList = new ArrayList<>();
        chargerTypesTests();
        configurerTypeComboBox();
        configurerSpinner();
        updateQuestionsCount();
    }

    private void chargerTypesTests() {
        typesTestsMap = new LinkedHashMap<>();
        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sql = "SELECT id_type, libelle FROM type_test ORDER BY id_type";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(sql);
            while (rs.next()) {
                typesTestsMap.put(rs.getInt("id_type"), rs.getString("libelle"));
            }
            System.out.println("✅ " + typesTestsMap.size() + " types de tests chargés");
        } catch (SQLException e) {
            System.err.println("❌ Erreur chargement types: " + e.getMessage());
            typesTestsMap.put(1, "Test de Personnalité");
            typesTestsMap.put(2, "Test Cognitif");
            typesTestsMap.put(3, "Test d'Anxiété");
        }
    }

    private void configurerTypeComboBox() {
        typeComboBox.getItems().clear();
        for (String nomType : typesTestsMap.values()) {
            typeComboBox.getItems().add(nomType);
        }
        if (!typeComboBox.getItems().isEmpty()) {
            typeComboBox.getSelectionModel().selectFirst();
        }
    }

    private void configurerSpinner() {
        SpinnerValueFactory<Integer> valueFactory = new SpinnerValueFactory.IntegerSpinnerValueFactory(1, 100, 10, 1);
        nombreQuestionsSpinner.setValueFactory(valueFactory);
        nombreQuestionsSpinner.setEditable(true);
    }

    // ── Question management ──

    @FXML
    private void ajouterQuestion() {
        ajoutQuestionBox.setVisible(true);
        ajoutQuestionBox.setManaged(true);
        questionContentArea.clear();
        questionContentArea.requestFocus();
        editingQuestionIndex = -1;
    }

    @FXML
    private void validerQuestion() {
        String contenu = questionContentArea.getText().trim();
        if (contenu.isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Attention",
                    "Veuillez saisir le contenu de la question.");
            return;
        }

        // Check limit only if adding a new question (not editing)
        if (editingQuestionIndex < 0) {
            int limit = nombreQuestionsSpinner.getValue();
            if (questionsList.size() >= limit) {
                showAlert(Alert.AlertType.WARNING, "Limite atteinte",
                        "Vous avez déjà atteint le nombre maximum de questions (" + limit + ") défini pour ce test.");
                return;
            }
        }

        if (editingQuestionIndex >= 0) {
            questionsList.set(editingQuestionIndex, contenu);
            showAlert(Alert.AlertType.INFORMATION, "Succès", "Question modifiée avec succès!");
        } else {
            questionsList.add(contenu);
            showAlert(Alert.AlertType.INFORMATION, "Succès", "Question ajoutée avec succès!");
        }
        questionContentArea.clear();
        ajoutQuestionBox.setVisible(false);
        ajoutQuestionBox.setManaged(false);
        afficherQuestions();
        updateQuestionsCount();
    }

    @FXML
    private void annulerQuestion() {
        questionContentArea.clear();
        ajoutQuestionBox.setVisible(false);
        ajoutQuestionBox.setManaged(false);
        editingQuestionIndex = -1;
    }

    private void afficherQuestions() {
        questionsListBox.getChildren().clear();
        if (questionsList.isEmpty()) {
            noQuestionsLabel.setVisible(true);
            noQuestionsLabel.setManaged(true);
            questionsListBox.getChildren().add(noQuestionsLabel);
        } else {
            noQuestionsLabel.setVisible(false);
            noQuestionsLabel.setManaged(false);
            for (int i = 0; i < questionsList.size(); i++) {
                questionsListBox.getChildren().add(createQuestionCard(i, questionsList.get(i)));
            }
        }
    }

    private VBox createQuestionCard(int index, String contenu) {
        VBox card = new VBox(10);
        card.getStyleClass().add("question-card");
        card.setPadding(new Insets(15));

        HBox headerBox = new HBox(15);
        headerBox.setAlignment(Pos.CENTER_LEFT);

        Label numeroLabel = new Label(String.valueOf(index + 1));
        numeroLabel.getStyleClass().add("question-number");
        numeroLabel.setMinWidth(35);
        numeroLabel.setMinHeight(35);
        numeroLabel.setAlignment(Pos.CENTER);

        Label contenuLabel = new Label(contenu);
        contenuLabel.getStyleClass().add("question-text");
        contenuLabel.setWrapText(true);
        HBox.setHgrow(contenuLabel, Priority.ALWAYS);

        HBox actionsBox = new HBox(10);
        actionsBox.setAlignment(Pos.CENTER_RIGHT);

        Button editBtn = new Button("✏️ Modifier");
        editBtn.getStyleClass().add("question-edit-btn");
        editBtn.setOnAction(e -> modifierQuestion(index));

        Button deleteBtn = new Button("🗑️ Supprimer");
        deleteBtn.getStyleClass().add("question-delete-btn");
        deleteBtn.setOnAction(e -> supprimerQuestion(index));

        actionsBox.getChildren().addAll(editBtn, deleteBtn);
        headerBox.getChildren().addAll(numeroLabel, contenuLabel, actionsBox);
        card.getChildren().add(headerBox);
        return card;
    }

    private void modifierQuestion(int index) {
        editingQuestionIndex = index;
        questionContentArea.setText(questionsList.get(index));
        ajoutQuestionBox.setVisible(true);
        ajoutQuestionBox.setManaged(true);
        questionContentArea.requestFocus();
    }

    private void supprimerQuestion(int index) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation");
        confirmation.setHeaderText("Supprimer la question");
        confirmation.setContentText("Êtes-vous sûr de vouloir supprimer cette question ?");
        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                questionsList.remove(index);
                afficherQuestions();
                updateQuestionsCount();
            }
        });
    }

    private void updateQuestionsCount() {
        questionsCountLabel.setText(questionsList.size() + " question(s) ajoutée(s)");
    }

    // ── Test saving ──

    @FXML
    private void enregistrerTest() {
        if (!validerChamps())
            return;

        try {
            TestPsychologique test = new TestPsychologique();
            test.setTitre(titreField.getText().trim());

            String nomTypeSelectionne = typeComboBox.getValue();
            int idType = 1;
            for (Map.Entry<Integer, String> entry : typesTestsMap.entrySet()) {
                if (entry.getValue().equals(nomTypeSelectionne)) {
                    idType = entry.getKey();
                    break;
                }
            }
            test.setIdType(idType);
            test.setDescription(descriptionArea.getText().trim());
            test.setNombreQuestions(nombreQuestionsSpinner.getValue());

            testService.ajouter(test);

            List<TestPsychologique> tests = testService.recuperer();
            int idTestAjoute = tests.get(tests.size() - 1).getIdTest();

            // Add questions with default answers (Oui=2, Non=0, Parfois=1)
            for (String contenu : questionsList) {
                Question question = new Question();
                question.setIdTest(idTestAjoute);
                question.setContenu(contenu.trim());
                questionService.ajouter(question);

                List<Question> questions = questionService.recupererParTest(idTestAjoute);
                int idQuestion = questions.get(questions.size() - 1).getIdQuestion();

                Connection cnx = DBConnection.getInstance().getConnection();
                PreparedStatement psRep = cnx.prepareStatement(
                        "INSERT INTO reponse (id_question, contenu, points) VALUES (?,?,?)");
                psRep.setInt(1, idQuestion);
                psRep.setString(2, "Oui");
                psRep.setInt(3, 2);
                psRep.executeUpdate();
                psRep.setInt(1, idQuestion);
                psRep.setString(2, "Non");
                psRep.setInt(3, 0);
                psRep.executeUpdate();
                psRep.setInt(1, idQuestion);
                psRep.setString(2, "Parfois");
                psRep.setInt(3, 1);
                psRep.executeUpdate();
            }
            insererTranchesAutomatiques(idTestAjoute, questionsList.size());

            showAlert(Alert.AlertType.INFORMATION, "Succès",
                    "Le test \"" + test.getTitre() + "\" a été enregistré avec "
                            + questionsList.size() + " question(s).");

            String titreTest = test.getTitre();
            String typeTest = typeComboBox.getValue();

            reinitialiserFormulaire();

            // Send WhatsApp notifications in background
            envoyerWhatsAppATousLesUtilisateurs(titreTest, typeTest);

        } catch (SQLException e) {
            showAlert(Alert.AlertType.ERROR, "Erreur",
                    "Erreur lors de l'enregistrement: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private boolean validerChamps() {
        if (titreField.getText().trim().isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Attention", "Veuillez saisir le titre du test.");
            return false;
        }
        if (descriptionArea.getText().trim().isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Attention", "Veuillez saisir la description du test.");
            return false;
        }
        if (questionsList.isEmpty()) {
            showAlert(Alert.AlertType.WARNING, "Attention", "Veuillez ajouter au moins une question.");
            return false;
        }
        int nombreAttendu = nombreQuestionsSpinner.getValue();
        if (questionsList.size() != nombreAttendu) {
            showAlert(Alert.AlertType.WARNING, "Attention",
                    "Le nombre de questions (" + questionsList.size()
                            + ") ne correspond pas au nombre attendu (" + nombreAttendu + ").");
            return false;
        }
        return true;
    }

    @FXML
    private void annulerTest() {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Confirmation");
        confirmation.setHeaderText("Annuler la création du test");
        confirmation.setContentText("Êtes-vous sûr ? Toutes les données seront perdues.");
        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK)
                reinitialiserFormulaire();
        });
    }

    private void reinitialiserFormulaire() {
        titreField.clear();
        typeComboBox.getSelectionModel().selectFirst();
        descriptionArea.clear();
        nombreQuestionsSpinner.getValueFactory().setValue(10);
        questionsList.clear();
        afficherQuestions();
        updateQuestionsCount();
        ajoutQuestionBox.setVisible(false);
        ajoutQuestionBox.setManaged(false);
    }

    // ── Navigation ──

    @FXML
    private void retournerListeTests() {
        ViewManager.loadView("tests/listeTests");
    }

    // ── Utilities ──

    private void showAlert(Alert.AlertType type, String title, String content) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    public void setListeTestsController(ListeTestsController controller) {
        this.listeTestsController = controller;
    }

    private void envoyerWhatsAppATousLesUtilisateurs(String titreTest, String typeTest) {
        Thread t = new Thread(() -> {
            try {
                Connection cnx = DBConnection.getInstance().getConnection();
                PreparedStatement ps = cnx.prepareStatement(
                        "SELECT first_name, email, phone_number FROM user WHERE roles LIKE '%ROLE_USER%'");
                ResultSet rs = ps.executeQuery();
                while (rs.next()) {
                    String prenom = rs.getString("first_name");
                    String email = rs.getString("email");
                    String phone = rs.getString("phone_number");

                    System.out.println("📱 Notification for " + prenom + " about new test: " + titreTest);

                    // Call SMS/WhatsApp Integration (only if phone is configured)
                    if (phone != null && !phone.isBlank()) {
                        try {
                            // Ensure it has a country code, e.g. +216
                            String formattedPhone = phone.startsWith("+") ? phone : "+216" + phone;
                            SmsService.getInstance().envoyerAlerteNouveauTestWhatsApp(formattedPhone, prenom, titreTest,
                                    typeTest);
                        } catch (Exception smsEx) {
                            System.err.println("WhatsApp Error: " + smsEx.getMessage());
                        }
                    } else {
                        System.out.println("⚠️ No phone number for " + prenom + ", skipping WhatsApp.");
                    }

                    // Call Email Integration
                    if (email != null && !email.isBlank()) {
                        try {
                            String emailContent = "<p>Un nouveau test <b>" + titreTest + "</b> (" + typeTest
                                    + ") est disponible dans votre espace patient InnerTrack.</p>";
                            new com.innertrack.service.EmailTestService().envoyerRapport(email, prenom,
                                    "Nouveau Test Disponible", emailContent);
                        } catch (Exception emailEx) {
                            System.err.println("Email Error: " + emailEx.getMessage());
                        }
                    }
                }
            } catch (Exception e) {
                System.err.println("Erreur notifications: " + e.getMessage());
            }
        });
        t.setDaemon(true);
        t.start();
    }

    private void insererTranchesAutomatiques(int idTest, int nbQuestions) {
        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            int scoreMax = nbQuestions * 2;
            int t1Max = (int) (scoreMax * 0.25);
            int t2Max = (int) (scoreMax * 0.50);
            int t3Max = (int) (scoreMax * 0.75);

            PreparedStatement ps = cnx.prepareStatement(
                    "INSERT INTO tranche_resultat (id_test, score_min, score_max, libelle, interpretation, niveau) VALUES (?, ?, ?, ?, ?, ?)");

            ps.setInt(1, idTest);
            ps.setInt(2, 0);
            ps.setInt(3, t1Max);
            ps.setString(4, "Résultat faible");
            ps.setString(5, "Peu ou pas de symptômes détectés. Votre profil est globalement équilibré.");
            ps.setString(6, "faible");
            ps.executeUpdate();

            ps.setInt(1, idTest);
            ps.setInt(2, t1Max + 1);
            ps.setInt(3, t2Max);
            ps.setString(4, "Résultat modéré");
            ps.setString(5, "Quelques éléments à surveiller. Des habitudes saines peuvent améliorer votre situation.");
            ps.setString(6, "modere");
            ps.executeUpdate();

            ps.setInt(1, idTest);
            ps.setInt(2, t2Max + 1);
            ps.setInt(3, t3Max);
            ps.setString(4, "Résultat élevé");
            ps.setString(5, "Des symptômes significatifs sont présents. Un suivi professionnel est recommandé.");
            ps.setString(6, "eleve");
            ps.executeUpdate();

            ps.setInt(1, idTest);
            ps.setInt(2, t3Max + 1);
            ps.setInt(3, scoreMax);
            ps.setString(4, "Résultat critique");
            ps.setString(5, "Niveau élevé de symptômes détecté. Consultation urgente conseillée.");
            ps.setString(6, "critique");
            ps.executeUpdate();

            System.out.println("✅ Tranches créées pour test id=" + idTest + " (scoreMax=" + scoreMax + ")");
        } catch (Exception e) {
            System.err.println("❌ Erreur création tranches: " + e.getMessage());
        }
    }
}
