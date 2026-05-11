package com.innertrack.controller.article;

import com.innertrack.app.MainApp;
import com.innertrack.model.*;
import com.innertrack.service.ArticleService;
import com.innertrack.service.SimilarityService;
import com.innertrack.service.LearningPathService;
import com.innertrack.service.api.GoogleBooksService;
import com.innertrack.service.api.FreesoundService;
import com.innertrack.service.api.SentimentService;
import com.innertrack.service.api.SoundPlayer;
import com.innertrack.session.SessionManager;
import com.innertrack.model.*;
import com.innertrack.util.ValidationUtils;
import com.innertrack.util.ViewManager;
import com.innertrack.util.ViewNavigator;
import com.innertrack.dao.UserDao;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.*;

import java.time.LocalDate;
import java.util.List;
import java.util.Set;
import com.innertrack.util.KeywordExtractor;

public class ArticleController {

    // Table and its columns
    @FXML private TableView<Article> tableArticles;
    @FXML private TableColumn<Article, String> colTitre, colAuteur, colCategorie;
    @FXML private TableColumn<Article, LocalDate> colDate;

    // Sidebar form fields
    @FXML private TextField tfSearch, tfTitre, tfAuteur;
    @FXML private TextArea taContenu, taPreview;
    @FXML private DatePicker dpDatePublication;
    @FXML private ComboBox<Categorie> cbCategorie;

    // Detail panel labels
    @FXML private Label lblDetailTitle, lblDetailMeta, lblReadability;

    // emptyState shown when no article is selected; detailScrollPane shows the article
    @FXML private VBox emptyState, detailView;
    @FXML private ScrollPane detailScrollPane;

    // API-powered panels
    @FXML private ListView<Book> booksListView;
    @FXML private ListView<Sound> soundsListView;
    @FXML private Button playSoundButton, stopSoundButton, btnAdd, btnUpdate, btnDelete, btnNew;

    // Tag-style boxes at the bottom of the detail panel
    @FXML private FlowPane articlePathsBox, keywordSuggestionsBox;
    @FXML private VBox similarArticlesBox;

    // Sentiment analysis result label
    @FXML private Label lblSentiment;

    private final ArticleService articleService;
    private final SimilarityService similarityService;
    private final LearningPathService learningPathService;
    private final GoogleBooksService googleBooksService;
    private final FreesoundService freesoundService;
    private final SoundPlayer soundPlayer;
    private final UserDao userDao;

    private SentimentService sentimentService = new SentimentService();
    // Keep a reference so we can cancel an in-flight sentiment request when the user picks a new article
    private Task<?> currentSentimentTask;

    // Set by another controller when navigating here with a pre-filter or pre-selection
    private Categorie filterCategorie;
    private Article initialSelection;

    public ArticleController() {
        String gBooksKey = MainApp.getEnv("GOOGLE_BOOKS_API_KEY");
        String freesoundKey = MainApp.getEnv("FREESOUND_API_KEY");

        this.articleService = new ArticleService();
        this.similarityService = new SimilarityService();
        this.learningPathService = new LearningPathService();
        this.googleBooksService = new GoogleBooksService(gBooksKey);
        this.freesoundService = new FreesoundService(freesoundKey);
        this.soundPlayer = new SoundPlayer();
        this.userDao = new UserDao();
    }

    // Full unfiltered article list; the search bar works against this
    private ObservableList<Article> masterList = FXCollections.observableArrayList();

    @FXML
    public void initialize() {
        setupTable();
        loadData();
        setupSelectionListener();
        setupSearch();
        setupSoundControls();
        checkPermissions();
        setupAPIDisplay();

        // Update the preview and keyword suggestions live as the user types content
        taContenu.textProperty().addListener((obs, old, newVal) -> {
            taPreview.setText(newVal);
            updateKeywordSuggestions(newVal);
        });

        // Check if another view pushed a category filter or a specific article into the session
        SessionManager sm = SessionManager.getInstance();
        Categorie cat = sm.getCurrentCategory();
        Article art = sm.getCurrentArticle();

        if (cat != null) {
            tfSearch.setText(cat.getNom());
            showFilterBanner(cat);
            sm.setCurrentCategory(null); // consume it
        }
        if (art != null) {
            // Data loads on a background thread, so we defer the selection until the table is ready
            Platform.runLater(() -> selectArticleById(art.getId()));
            sm.setCurrentArticle(null); // consume it
        }

        // Same deferred-selection logic for the field set before FXML init (e.g. from setInitialSelection)
        if (filterCategorie != null) {
            tfSearch.setText(filterCategorie.getNom());
            showFilterBanner(filterCategorie);
        }
        if (initialSelection != null) {
            Platform.runLater(() -> selectArticleById(initialSelection.getId()));
        }

        clearForm();
    }

    // Add a dismissible info banner above the search field when a category filter is active
    private void showFilterBanner(Categorie categorie) {
        Label info = new Label("🔍 Filtré par : " + categorie.getNom());
        info.setStyle("-fx-font-size: 12px; -fx-text-fill: #0078d4; -fx-font-weight: bold;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        Button clearBtn = new Button("× Effacer le filtre");
        clearBtn.setStyle(
                "-fx-background-color: transparent;" +
                        "-fx-text-fill: #0078d4;" +
                        "-fx-cursor: hand;" +
                        "-fx-font-size: 11px;" +
                        "-fx-underline: true;");

        HBox banner = new HBox(8, info, spacer, clearBtn);
        banner.setAlignment(Pos.CENTER_LEFT);
        banner.setPadding(new Insets(6, 12, 6, 12));
        banner.setStyle("-fx-background-color: #dce9f9; -fx-background-radius: 6px;");

        clearBtn.setOnAction(e -> {
            tfSearch.clear();
            filterCategorie = null;
            if (banner.getParent() instanceof VBox sidebar)
                sidebar.getChildren().remove(banner);
        });

        // Insert at the top of the sidebar so it's the first thing visible
        if (tfSearch.getParent() instanceof VBox sidebar)
            sidebar.getChildren().add(0, banner);
    }

    // Scroll to and select the row whose article ID matches, if it's in masterList
    private void selectArticleById(int id) {
        for (Article a : masterList) {
            if (a.getId() == id) {
                tableArticles.getSelectionModel().select(a);
                tableArticles.scrollTo(a);
                return;
            }
        }
    }

    // Hide write-only buttons and lock fields for read-only users
    private void checkPermissions() {
        User user = SessionManager.getInstance().getCurrentUser();
        boolean canWrite = ViewNavigator.hasRole(user, "ROLE_ADMIN")
                || ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        btnNew.setVisible(canWrite);    btnNew.setManaged(canWrite);
        btnAdd.setVisible(canWrite);    btnAdd.setManaged(canWrite);
        btnUpdate.setVisible(canWrite); btnUpdate.setManaged(canWrite);
        btnDelete.setVisible(canWrite); btnDelete.setManaged(canWrite);

        tfTitre.setEditable(canWrite);
        taContenu.setEditable(canWrite);
        cbCategorie.setDisable(!canWrite);
        dpDatePublication.setDisable(!canWrite);
    }

    public void setFilterCategorie(Categorie categorie)  { this.filterCategorie = categorie; }
    public void setInitialSelection(Article article)     { this.initialSelection = article; }

    // Bind columns to Article properties; the author column does a DAO lookup to show the full name
    private void setupTable() {
        colTitre.setCellValueFactory(new PropertyValueFactory<>("titre"));
        colCategorie.setCellValueFactory(new PropertyFactoryWithName());
        colDate.setCellValueFactory(new PropertyValueFactory<>("datePublication"));

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
                        setText(u != null ? u.getFirstName() + " " + u.getLastName() : "ID: " + a.getAuteurUserId());
                    } catch (Exception e) {
                        setText("ID: " + a.getAuteurUserId());
                    }
                }
            }
        });
    }

    // Run sentiment analysis in the background so the UI stays responsive.
    // Any previous in-flight request is cancelled first to avoid stale results.
    private void loadSentiment(String text) {
        if (currentSentimentTask != null && currentSentimentTask.isRunning())
            currentSentimentTask.cancel(true);

        // Trim to 1000 chars to stay within API limits
        String trimmed = text.length() > 1000 ? text.substring(0, 1000) : text;

        Task<SentimentService.SentimentResult> task = new Task<>() {
            @Override
            protected SentimentService.SentimentResult call() throws Exception {
                return sentimentService.analyseSentiment(trimmed);
            }
        };

        task.setOnSucceeded(e -> {
            if (task.isCancelled()) return;
            SentimentService.SentimentResult result = task.getValue();
            lblSentiment.setText(result.getDisplayText());
            // Apply a CSS class so the label colour reflects the sentiment
            lblSentiment.getStyleClass().removeAll("sentiment-pos", "sentiment-neg", "sentiment-neutral");
            switch (result.getLabel()) {
                case "pos" -> lblSentiment.getStyleClass().add("sentiment-pos");
                case "neg" -> lblSentiment.getStyleClass().add("sentiment-neg");
                default    -> lblSentiment.getStyleClass().add("sentiment-neutral");
            }
        });

        task.setOnFailed(e -> {
            if (!task.isCancelled()) {
                lblSentiment.setText("(non disponible)");
                task.getException().printStackTrace();
            }
        });

        currentSentimentTask = task;
        new Thread(task).start();
    }

    // Simple PropertyValueFactory override to bind the category name column
    private static class PropertyFactoryWithName extends PropertyValueFactory<Article, String> {
        public PropertyFactoryWithName() { super("categorieNom"); }
    }

    // Configure the Book and Sound list cells and wire up play / stop buttons
    private void setupAPIDisplay() {
        booksListView.setCellFactory(lv -> new ListCell<Book>() {
            @Override
            protected void updateItem(Book book, boolean empty) {
                super.updateItem(book, empty);
                if (empty || book == null) { setText(null); setGraphic(null); return; }

                HBox container = new HBox(12);
                container.setAlignment(Pos.CENTER_LEFT);
                container.setPadding(new Insets(8, 12, 8, 12));

                Label iconLabel = new Label("📚");
                iconLabel.setStyle("-fx-font-size: 20px; -fx-text-fill: #4c51bf;");

                VBox infoBox = new VBox(4);
                Label titleLabel = new Label(book.getTitle());
                Tooltip.install(titleLabel, new Tooltip(book.getTitle()));
                titleLabel.setWrapText(true);

                Label authorLabel = new Label(book.getFormattedAuthors());
                authorLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #718096;");
                authorLabel.setWrapText(true);

                infoBox.getChildren().addAll(titleLabel, authorLabel);
                container.getChildren().addAll(iconLabel, infoBox);
                setGraphic(container);
            }
        });

        soundsListView.setCellFactory(lv -> new ListCell<Sound>() {
            @Override
            protected void updateItem(Sound sound, boolean empty) {
                super.updateItem(sound, empty);
                if (empty || sound == null) { setText(null); setGraphic(null); return; }

                HBox container = new HBox(12);
                container.setAlignment(Pos.CENTER_LEFT);
                container.setPadding(new Insets(8, 12, 8, 12));

                // Pick an emoji icon based on the sound name to make the list more readable
                String icon = "🎵";
                String name = sound.getName().toLowerCase();
                if      (name.contains("rain"))      icon = "🌧️";
                else if (name.contains("nature"))    icon = "🌿";
                else if (name.contains("meditation"))icon = "🧘";
                else if (name.contains("bell"))      icon = "🔔";

                Label iconLabel = new Label(icon);
                iconLabel.setStyle("-fx-font-size: 20px; -fx-text-fill: #5a67d8;");

                VBox infoBox = new VBox(4);
                Label nameLabel = new Label(sound.getName());
                Tooltip.install(nameLabel, new Tooltip(sound.getName()));
                nameLabel.setWrapText(true);

                HBox metaBox = new HBox(8);
                Label durationLabel = new Label(sound.getFormattedDuration());
                durationLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #718096;");
                Label userLabel = new Label("par " + sound.getUsername());
                userLabel.setStyle("-fx-font-size: 11px; -fx-text-fill: #a0aec0;");

                metaBox.getChildren().addAll(durationLabel, userLabel);
                infoBox.getChildren().addAll(nameLabel, metaBox);
                container.getChildren().addAll(iconLabel, infoBox);
                setGraphic(container);
            }
        });

        playSoundButton.setOnAction(e -> {
            Sound selected = soundsListView.getSelectionModel().getSelectedItem();
            if (selected != null && selected.hasPreview())
                soundPlayer.playPreview(selected.getPreviewUrl());
        });
        stopSoundButton.setOnAction(e -> soundPlayer.stop());
    }

    // Pull articles + categories from the service and refresh both the table and the combo box
    private void loadData() {
        masterList.setAll(articleService.getAllArticlesWithCategory());
        tableArticles.setItems(masterList);
        cbCategorie.setItems(FXCollections.observableArrayList(articleService.getAllCategories()));

        // Show the category name instead of the default toString() in the combo box
        cbCategorie.setCellFactory(param -> new ListCell<>() {
            @Override
            protected void updateItem(Categorie item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : item.getNom());
            }
        });
        cbCategorie.setButtonCell(new ListCell<>() {
            @Override
            protected void updateItem(Categorie item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : item.getNom());
            }
        });
    }

    // When the user picks a row, show its detail; clear the panel when nothing is selected
    private void setupSelectionListener() {
        tableArticles.getSelectionModel().selectedItemProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal != null) showDetail(newVal);
            else               hideDetail();
        });
    }

    // Search runs on a background thread to avoid blocking the UI for large datasets
    private void setupSearch() {
        tfSearch.textProperty().addListener((obs, oldVal, newVal) -> {
            if (newVal == null || newVal.trim().isEmpty()) {
                tableArticles.setItems(masterList);
            } else {
                Task<List<Article>> searchTask = new Task<>() {
                    @Override
                    protected List<Article> call() {
                        return articleService.search(newVal);
                    }
                };
                searchTask.setOnSucceeded(e ->
                        tableArticles.setItems(FXCollections.observableArrayList(searchTask.getValue())));
                new Thread(searchTask).start();
            }
        });
    }

    // Wire the play/stop buttons (also done in setupAPIDisplay; kept here for the initial setup pass)
    private void setupSoundControls() {
        playSoundButton.setOnAction(e -> {
            Sound s = soundsListView.getSelectionModel().getSelectedItem();
            if (s != null) soundPlayer.playPreview(s.getPreviewUrl());
        });
        stopSoundButton.setOnAction(e -> soundPlayer.stop());
    }

    // Populate every section of the detail panel for the given article
    private void showDetail(Article article) {
        emptyState.setVisible(false);
        detailScrollPane.setVisible(true);

        lblDetailTitle.setText(article.getTitre());

        // Resolve the author name; the table stores only the user ID
        String authorName = "Inconnu";
        try {
            User u = userDao.read(article.getAuteurUserId());
            if (u != null) authorName = u.getFirstName() + " " + u.getLastName();
        } catch (Exception ignored) {}

        lblDetailMeta.setText(
                authorName + " · " +
                        (article.getCategorieNom() != null ? article.getCategorieNom() : "N/A") +
                        " · " + article.getDatePublication());

        lblReadability.setText(article.getReadability() != null ? article.getReadability() : "Non calculé");

        tfTitre.setText(article.getTitre());
        tfAuteur.setText(authorName);
        tfAuteur.setEditable(false); // author is set automatically, not by the form
        dpDatePublication.setValue(article.getDatePublication());
        taContenu.setText(article.getContenu());

        // Pre-select the matching category in the combo box
        if (article.getCategorieId() != null) {
            cbCategorie.getItems().stream()
                    .filter(c -> c.getId() == article.getCategorieId())
                    .findFirst()
                    .ifPresent(cbCategorie.getSelectionModel()::select);
        }

        // Kick off the background tasks for the supplementary panels
        refreshBooks();
        refreshSounds();
        loadSimilarArticles(article);
        loadArticlePaths(article);
        loadSentiment(article.getContenu());

        // Existing article: disable Add, enable Update/Delete
        btnAdd.setDisable(true);
        btnUpdate.setDisable(false);
        btnDelete.setDisable(false);
    }

    private void hideDetail() {
        emptyState.setVisible(true);
        detailScrollPane.setVisible(false);
    }

    @FXML private void handleRefresh() { loadData(); }

    // Clear the form and switch to "new article" mode (no selection, Add enabled)
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
        if (!validate()) return;

        Article a = new Article();
        updateModelFromForm(a);

        User current = SessionManager.getInstance().getCurrentUser();
        if (current == null) { ValidationUtils.showError("Session expirée."); return; }
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
        if (selected == null || !validate()) return;

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

    // Navigation helpers
    @FXML private void goToCategories()    { ViewManager.loadView("article/CategorieView"); }
    @FXML private void goToLearningPaths() { ViewManager.loadView("article/LearningPathView"); }
    @FXML private void goToDashboard()     { ViewNavigator.navigateToDashboard(); }

    // Fetch related books from Google Books API using the article title as the query
    @FXML
    private void refreshBooks() {
        String query = tfTitre.getText();
        if (query.isEmpty()) return;
        Task<List<Book>> task = new Task<>() {
            @Override
            protected List<Book> call() throws Exception {
                return googleBooksService.searchBooksByArticle(query, 5);
            }
        };
        task.setOnSucceeded(e -> booksListView.setItems(FXCollections.observableArrayList(task.getValue())));
        new Thread(task).start();
    }

    // Fetch ambient sounds from Freesound using keywords extracted from the article content
    @FXML
    private void refreshSounds() {
        String content = taContenu.getText();
        if (content.isEmpty()) return;
        Task<List<Sound>> task = new Task<>() {
            @Override
            protected List<Sound> call() throws Exception {
                return freesoundService.searchByKeywords(List.of(content.split("\\W+")), 5);
            }
        };
        task.setOnSucceeded(e -> soundsListView.setItems(FXCollections.observableArrayList(task.getValue())));
        new Thread(task).start();
    }

    // Run TF-IDF similarity in the background and show the top-3 results as clickable hyperlinks
    private void loadSimilarArticles(Article a) {
        similarArticlesBox.getChildren().clear();
        Task<List<Article>> task = new Task<>() {
            @Override
            protected List<Article> call() { return similarityService.findSimilarArticles(a, 3); }
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

    // Show which learning paths contain this article as clickable tag-style buttons
    private void loadArticlePaths(Article a) {
        articlePathsBox.getChildren().clear();
        Task<List<LearningPath>> task = new Task<>() {
            @Override
            protected List<LearningPath> call() { return learningPathService.getPathsForArticle(a.getId()); }
        };
        task.setOnSucceeded(e -> {
            for (LearningPath lp : task.getValue()) {
                Button btn = new Button(lp.getTitre());
                btn.getStyleClass().add("tag-button");
                btn.setOnAction(ev -> {
                    SessionManager.getInstance().setCurrentLearningPath(lp);
                    SessionManager.getInstance().setCurrentArticle(a);
                    ViewManager.loadView("article/LearningPathView");
                });
                articlePathsBox.getChildren().add(btn);
            }
        });
        new Thread(task).start();
    }

    // Extract keywords from the content and display them as non-interactive tags
    private void updateKeywordSuggestions(String text) {
        keywordSuggestionsBox.getChildren().clear();
        Set<String> keywords = KeywordExtractor.extractKeywords(text);
        for (String kw : keywords) {
            Label label = new Label(kw);
            label.getStyleClass().add("tag-button");
            keywordSuggestionsBox.getChildren().add(label);
        }
    }

    // Copy the current form values into the given Article object before saving
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