package com.innertrack.controller.article;

import com.innertrack.model.*;
import com.innertrack.service.ArticleService;
import com.innertrack.service.SimilarityService;
import com.innertrack.service.LearningPathService;
import com.innertrack.service.api.GoogleBooksService;
import com.innertrack.service.api.FreesoundService;
import com.innertrack.service.api.SoundPlayer;
import com.innertrack.session.SessionManager;
import com.innertrack.model.User;
import com.innertrack.util.ValidationUtils;
import com.innertrack.util.ViewManager;
import com.innertrack.util.ViewNavigator;
import com.innertrack.dao.UserDao;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.VBox;

import java.time.LocalDate;
import java.util.List;
import java.util.Set;
import com.innertrack.util.KeywordExtractor;

public class ArticleController {

    @FXML
    private TableView<Article> tableArticles;
    @FXML
    private TableColumn<Article, String> colTitre, colAuteur, colCategorie;
    @FXML
    private TableColumn<Article, LocalDate> colDate;

    @FXML
    private TextField tfSearch, tfTitre, tfAuteur;
    @FXML
    private TextArea taContenu, taPreview;
    @FXML
    private DatePicker dpDatePublication;
    @FXML
    private ComboBox<Categorie> cbCategorie;
    @FXML
    private Label lblDetailTitle, lblDetailMeta, lblReadability;

    @FXML
    private VBox emptyState, detailView;
    @FXML
    private ScrollPane detailScrollPane;
    @FXML
    private ListView<Book> booksListView;
    @FXML
    private ListView<Sound> soundsListView;
    @FXML
    private Button playSoundButton, stopSoundButton, btnAdd, btnUpdate, btnDelete, btnNew;
    @FXML
    private FlowPane articlePathsBox, keywordSuggestionsBox;
    @FXML
    private VBox similarArticlesBox;

    private final ArticleService articleService;
    private final SimilarityService similarityService;
    private final LearningPathService learningPathService;
    private final GoogleBooksService googleBooksService;
    private final FreesoundService freesoundService;
    private final SoundPlayer soundPlayer;
    private final UserDao userDao;

    public ArticleController() {
        io.github.cdimascio.dotenv.Dotenv dotenv = io.github.cdimascio.dotenv.Dotenv.load();
        String gBooksKey = dotenv.get("GOOGLE_BOOKS_API_KEY");
        String freesoundKey = dotenv.get("FREESOUND_API_KEY");

        this.articleService = new ArticleService();
        this.similarityService = new SimilarityService();
        this.learningPathService = new LearningPathService();
        this.googleBooksService = new GoogleBooksService(gBooksKey);
        this.freesoundService = new FreesoundService(freesoundKey);
        this.soundPlayer = new SoundPlayer();
        this.userDao = new UserDao();
    }

    private ObservableList<Article> masterList = FXCollections.observableArrayList();

    @FXML
    public void initialize() {
        setupTable();
        loadData();
        setupSelectionListener();
        setupSearch();
        setupSoundControls();
        checkPermissions();

        taContenu.textProperty().addListener((obs, old, newVal) -> {
            taPreview.setText(newVal);
            updateKeywordSuggestions(newVal);
        });

        clearForm();
    }

    private void checkPermissions() {
        User user = SessionManager.getInstance().getCurrentUser();
        boolean hasWriteAccess = ViewNavigator.hasRole(user, "ROLE_ADMIN")
                || ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        btnNew.setVisible(hasWriteAccess);
        btnNew.setManaged(hasWriteAccess);
        btnAdd.setVisible(hasWriteAccess);
        btnAdd.setManaged(hasWriteAccess);
        btnUpdate.setVisible(hasWriteAccess);
        btnUpdate.setManaged(hasWriteAccess);
        btnDelete.setVisible(hasWriteAccess);
        btnDelete.setManaged(hasWriteAccess);

        tfTitre.setEditable(hasWriteAccess);
        taContenu.setEditable(hasWriteAccess);
        cbCategorie.setDisable(!hasWriteAccess);
        dpDatePublication.setDisable(!hasWriteAccess);
    }

    private void setupTable() {
        colTitre.setCellValueFactory(new PropertyValueFactory<>("titre"));
        colCategorie.setCellValueFactory(new PropertyFactoryWithName()); // See below
        colDate.setCellValueFactory(new PropertyValueFactory<>("datePublication"));

        // Custom cell for author name
        colAuteur.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || getTableRow() == null || getTableRow().getItem() == null) {
                    setText(null);
                } else {
                    Article a = getTableRow().getItem();
                    try {
                        User u = userDao.read(a.getAuteurUserId());
                        if (u != null)
                            setText(u.getFirstName() + " " + u.getLastName());
                        else
                            setText("ID: " + a.getAuteurUserId());
                    } catch (Exception e) {
                        setText("ID: " + a.getAuteurUserId());
                    }
                }
            }
        });
    }

    private static class PropertyFactoryWithName extends PropertyValueFactory<Article, String> {
        public PropertyFactoryWithName() {
            super("categorieNom");
        }
    }

    private void loadData() {
        masterList.setAll(articleService.getAllArticlesWithCategory());
        tableArticles.setItems(masterList);
        cbCategorie.setItems(FXCollections.observableArrayList(articleService.getAllCategories()));
    }

    private void setupSelectionListener() {
        tableArticles.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null)
                showDetail(newVal);
            else
                hideDetail();
        });
    }

    private void setupSearch() {
        tfSearch.textProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal == null || newVal.trim().isEmpty())
                tableArticles.setItems(masterList);
            else {
                Task<List<Article>> searchTask = new Task<>() {
                    @Override
                    protected List<Article> call() {
                        return articleService.search(newVal);
                    }
                };
                searchTask.setOnSucceeded(
                        e -> tableArticles.setItems(FXCollections.observableArrayList(searchTask.getValue())));
                new Thread(searchTask).start();
            }
        });
    }

    private void setupSoundControls() {
        playSoundButton.setOnAction(e -> {
            Sound s = soundsListView.getSelectionModel().getSelectedItem();
            if (s != null)
                soundPlayer.playPreview(s.getPreviewUrl());
        });
        stopSoundButton.setOnAction(e -> soundPlayer.stop());
    }

    private void showDetail(Article article) {
        emptyState.setVisible(false);
        detailScrollPane.setVisible(true);

        lblDetailTitle.setText(article.getTitre());
        String authorName = "Inconnu";
        try {
            User u = userDao.read(article.getAuteurUserId());
            if (u != null)
                authorName = u.getFirstName() + " " + u.getLastName();
        } catch (Exception ignored) {
        }

        lblDetailMeta
                .setText(authorName + " · " + (article.getCategorieNom() != null ? article.getCategorieNom() : "N/A") +
                        " · " + article.getDatePublication());

        lblReadability.setText(article.getReadability() != null ? article.getReadability() : "Non calculé");

        tfTitre.setText(article.getTitre());
        tfAuteur.setText(authorName);
        tfAuteur.setEditable(false);
        dpDatePublication.setValue(article.getDatePublication());
        taContenu.setText(article.getContenu());

        if (article.getCategorieId() != null) {
            cbCategorie.getItems().stream()
                    .filter(c -> c.getId() == article.getCategorieId())
                    .findFirst()
                    .ifPresent(c -> cbCategorie.getSelectionModel().select(c));
        }

        refreshBooks();
        refreshSounds();
        loadSimilarArticles(article);
        loadArticlePaths(article);

        btnAdd.setDisable(true);
        btnUpdate.setDisable(false);
        btnDelete.setDisable(false);
    }

    private void hideDetail() {
        emptyState.setVisible(true);
        detailScrollPane.setVisible(false);
    }

    @FXML
    private void handleRefresh() {
        loadData();
    }

    @FXML
    private void handleNewArticle() {
        tableArticles.getSelectionModel().clearSelection();
        clearForm();
        emptyState.setVisible(false);
        detailScrollPane.setVisible(true);
        btnAdd.setDisable(false);
        btnUpdate.setDisable(true);
        btnDelete.setDisable(true);
    }

    @FXML
    private void handleAdd() {
        if (!validate())
            return;
        Article a = new Article();
        updateModelFromForm(a);
        User current = SessionManager.getInstance().getCurrentUser();
        if (current == null) {
            ValidationUtils.showError("Session expirée.");
            return;
        }
        a.setAuteurUserId(current.getId());

        if (articleService.existsByTitre(a.getTitre())) {
            ValidationUtils.showError("Titre déjà utilisé.");
            return;
        }

        articleService.updateReadability(a);
        if (articleService.addArticle(a)) {
            ValidationUtils.showInfo("Article ajouté.");
            loadData();
            clearForm();
        }
    }

    @FXML
    private void handleUpdate() {
        Article selected = tableArticles.getSelectionModel().getSelectedItem();
        if (selected == null || !validate())
            return;

        updateModelFromForm(selected);
        if (articleService.existsByTitreExcludingId(selected.getTitre(), selected.getId())) {
            ValidationUtils.showError("Titre déjà utilisé.");
            return;
        }

        articleService.updateReadability(selected);
        if (articleService.updateArticle(selected)) {
            ValidationUtils.showInfo("Article mis à jour.");
            loadData();
        }
    }

    @FXML
    private void handleDelete() {
        Article selected = tableArticles.getSelectionModel().getSelectedItem();
        if (selected != null && ValidationUtils.confirmDelete(selected.getTitre())) {
            if (articleService.deleteArticle(selected.getId())) {
                loadData();
                hideDetail();
            }
        }
    }

    @FXML
    private void goToCategories() {
        ViewManager.loadView("article/CategorieView");
    }

    @FXML
    private void goToLearningPaths() {
        ViewManager.loadView("article/LearningPathView");
    }

    @FXML
    private void goToDashboard() {
        ViewNavigator.navigateToDashboard();
    }

    @FXML
    private void refreshBooks() {
        String query = tfTitre.getText();
        if (query.isEmpty())
            return;
        Task<List<Book>> task = new Task<>() {
            @Override
            protected List<Book> call() throws Exception {
                return googleBooksService.searchBooksByArticle(query, 5);
            }
        };
        task.setOnSucceeded(e -> booksListView.setItems(FXCollections.observableArrayList(task.getValue())));
        new Thread(task).start();
    }

    @FXML
    private void refreshSounds() {
        String content = taContenu.getText();
        if (content.isEmpty())
            return;
        Task<List<Sound>> task = new Task<>() {
            @Override
            protected List<Sound> call() throws Exception {
                return freesoundService.searchByKeywords(List.of(content.split("\\W+")), 5);
            }
        };
        task.setOnSucceeded(e -> soundsListView.setItems(FXCollections.observableArrayList(task.getValue())));
        new Thread(task).start();
    }

    private void loadSimilarArticles(Article a) {
        similarArticlesBox.getChildren().clear();
        Task<List<Article>> task = new Task<>() {
            @Override
            protected List<Article> call() {
                return similarityService.findSimilarArticles(a, 3);
            }
        };
        task.setOnSucceeded(e -> {
            for (Article sim : task.getValue()) {
                Hyperlink link = new Hyperlink(sim.getTitre());
                link.setOnAction(ev -> tableArticles.getSelectionModel().select(sim));
                similarArticlesBox.getChildren().add(link);
            }
        });
        new Thread(task).start();
    }

    private void loadArticlePaths(Article a) {
        articlePathsBox.getChildren().clear();
        Task<List<LearningPath>> task = new Task<>() {
            @Override
            protected List<LearningPath> call() {
                return learningPathService.getPathsForArticle(a.getId());
            }
        };
        task.setOnSucceeded(e -> {
            for (LearningPath lp : task.getValue()) {
                Label badge = new Label(lp.getTitre());
                badge.getStyleClass().add("card-badge");
                articlePathsBox.getChildren().add(badge);
            }
        });
        new Thread(task).start();
    }

    private void updateKeywordSuggestions(String text) {
        keywordSuggestionsBox.getChildren().clear();
        Set<String> keywords = KeywordExtractor.extractKeywords(text);
        for (String kw : keywords) {
            Label label = new Label(kw);
            label.getStyleClass().add("tag-button");
            keywordSuggestionsBox.getChildren().add(label);
        }
    }

    private void updateModelFromForm(Article a) {
        a.setTitre(tfTitre.getText());
        a.setContenu(taContenu.getText());
        a.setDatePublication(dpDatePublication.getValue());
        if (cbCategorie.getValue() != null) {
            a.setCategorieId(cbCategorie.getValue().getId());
            a.setCategorieNom(cbCategorie.getValue().getNom());
        }
    }

    private boolean validate() {
        return ValidationUtils.isNotEmpty(tfTitre, "Le titre")
                && ValidationUtils.isNotEmpty(taContenu, "Le contenu")
                && cbCategorie.getValue() != null;
    }

    @FXML
    private void clearForm() {
        tfTitre.clear();
        tfAuteur.clear();
        dpDatePublication.setValue(LocalDate.now());
        taContenu.clear();
        taPreview.clear();
        cbCategorie.getSelectionModel().clearSelection();
    }
}
