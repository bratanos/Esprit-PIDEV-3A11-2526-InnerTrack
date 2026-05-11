package com.innertrack.controller.article;

import com.innertrack.dao.UserDao;
import com.innertrack.model.Article;
import com.innertrack.model.LearningPath;
import com.innertrack.model.User;
import com.innertrack.service.ArticleService;
import com.innertrack.service.LearningPathService;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ValidationUtils;
import com.innertrack.util.ViewManager;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;

public class LearningPathController implements javafx.fxml.Initializable {

    // Left panel: list of all learning paths
    @FXML private ListView<LearningPath> pathListView;
    // Middle panel: all articles available to add
    @FXML private ListView<Article> availableArticlesListView;
    // Right panel: articles currently in the selected path
    @FXML private ListView<Article> pathArticlesListView;

    @FXML private TextField titreField, createdByField;
    @FXML private TextArea descriptionArea;

    @FXML private Button btnAddToPath, btnRemoveFromPath, btnMoveUp, btnMoveDown,
            btnSavePath, btnDeletePath, btnNew;

    // mainContent is hidden when there are no paths and the user is a regular user
    @FXML private HBox mainContent;
    @FXML private VBox emptyStateBox;

    private final LearningPathService service = new LearningPathService();
    private final ArticleService articleService = new ArticleService();
    private final UserDao userDao = new UserDao();

    // The path currently selected in the left list
    private LearningPath selectedPath;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        setupCellFactories();
        loadPaths();
        loadAvailableArticles();
        setupListListeners();
        setupButtons();
        checkPermissions();

        // If another view pushed a path into the session (e.g. ArticleView),
        // select it automatically once the list finishes loading
        LearningPath pendingPath = SessionManager.getInstance().getCurrentLearningPath();
        if (pendingPath != null) {
            Platform.runLater(() -> {
                pathListView.getSelectionModel().select(pendingPath);
                pathListView.scrollTo(pendingPath);
                showPathDetail(pendingPath);
                // Clear it so it isn't reused on the next open
                SessionManager.getInstance().setCurrentLearningPath(null);
            });
        }

        // Double-click an article in the path list to open it in ArticleView
        pathArticlesListView.setOnMouseClicked(event -> {
            if (event.getClickCount() == 2) {
                Article selected = pathArticlesListView.getSelectionModel().getSelectedItem();
                if (selected != null) {
                    SessionManager.getInstance().setCurrentArticle(selected);
                    ViewManager.loadView("article/ArticleView");
                }
            }
        });
    }

    // Hide write-only buttons/fields for regular users (non-admin, non-psychologist)
    private void checkPermissions() {
        User user = SessionManager.getInstance().getCurrentUser();
        boolean canWrite = com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_ADMIN")
                || com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        btnNew.setVisible(canWrite);
        btnNew.setManaged(canWrite);
        btnSavePath.setVisible(canWrite);
        btnSavePath.setManaged(canWrite);
        btnDeletePath.setVisible(canWrite);
        btnDeletePath.setManaged(canWrite);
        btnAddToPath.setVisible(canWrite);
        btnAddToPath.setManaged(canWrite);
        btnRemoveFromPath.setVisible(canWrite);
        btnRemoveFromPath.setManaged(canWrite);
        btnMoveUp.setVisible(canWrite);
        btnMoveUp.setManaged(canWrite);
        btnMoveDown.setVisible(canWrite);
        btnMoveDown.setManaged(canWrite);

        titreField.setEditable(canWrite);
        descriptionArea.setEditable(canWrite);
        createdByField.setEditable(canWrite);
    }

    // Fetch all paths from the DB and show them in the list.
    // If the list is empty and the user has no write access, show the empty-state placeholder.
    @FXML
    private void loadPaths() {
        List<LearningPath> paths = service.getAllPaths();
        System.out.println("Paths loaded: " + paths.size());
        pathListView.setItems(FXCollections.observableArrayList(paths));

        User user = SessionManager.getInstance().getCurrentUser();
        boolean isNormalUser = !com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_ADMIN")
                && !com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        boolean showEmpty = paths.isEmpty() && isNormalUser;
        mainContent.setVisible(!showEmpty);
        mainContent.setManaged(!showEmpty);
        emptyStateBox.setVisible(showEmpty);
        emptyStateBox.setManaged(showEmpty);
    }

    // Custom cell renderers so each list shows a readable label instead of a raw toString()
    private void setupCellFactories() {
        // Learning path list: show a book icon + path title
        pathListView.setCellFactory(lv -> new ListCell<LearningPath>() {
            @Override
            protected void updateItem(LearningPath item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || item == null) {
                    setText(null);
                    setGraphic(null);
                    return;
                }
                Label icon = new Label("📘");
                icon.setStyle("-fx-font-size: 14px; -fx-padding: 0 8 0 0;");
                String titre = item.getTitre() != null ? item.getTitre() : "Sans titre";
                Label name = new Label(titre);
                name.setStyle("-fx-font-weight: 500;");
                HBox box = new HBox(icon, name);
                box.setAlignment(javafx.geometry.Pos.CENTER_LEFT);
                setGraphic(box);
            }
        });

        // Available articles list: page icon + article title
        availableArticlesListView.setCellFactory(lv -> new ListCell<Article>() {
            @Override
            protected void updateItem(Article article, boolean empty) {
                super.updateItem(article, empty);
                if (empty || article == null) { setText(null); setGraphic(null); return; }
                Label icon = new Label("📄");
                icon.setStyle("-fx-font-size: 14px; -fx-padding: 0 8 0 0;");
                Label title = new Label(article.getTitre());
                title.setStyle("-fx-font-weight: 500; -fx-text-fill: #1e293b;");
                HBox box = new HBox(icon, title);
                box.setAlignment(javafx.geometry.Pos.CENTER_LEFT);
                setGraphic(box);
            }
        });

        // Path articles list: pin icon to distinguish from the available list
        pathArticlesListView.setCellFactory(lv -> new ListCell<Article>() {
            @Override
            protected void updateItem(Article article, boolean empty) {
                super.updateItem(article, empty);
                if (empty || article == null) { setText(null); setGraphic(null); return; }
                Label icon = new Label("📌");
                icon.setStyle("-fx-font-size: 14px; -fx-padding: 0 8 0 0;");
                Label title = new Label(article.getTitre());
                title.setStyle("-fx-font-weight: 500; -fx-text-fill: #1e293b;");
                HBox box = new HBox(icon, title);
                box.setAlignment(javafx.geometry.Pos.CENTER_LEFT);
                setGraphic(box);
            }
        });
    }

    // Pull all articles from the DB to populate the left "available" panel
    private void loadAvailableArticles() {
        List<Article> articles = articleService.getAllArticles();
        System.out.println("Articles loaded: " + articles.size());
        availableArticlesListView.setItems(FXCollections.observableArrayList(articles));
    }

    // When a path is selected in the left list, populate the detail panel on the right
    private void setupListListeners() {
        pathListView.getSelectionModel().selectedItemProperty().addListener((obs, old, newVal) -> {
            if (newVal != null)
                showPathDetail(newVal);
        });
    }

    // Fill the form fields and path-article list for the given path
    private void showPathDetail(LearningPath path) {
        selectedPath = path;
        titreField.setText(path.getTitre());
        descriptionArea.setText(path.getDescription());
        System.out.println("Path ID: " + path.getId());

        // Look up the creator's full name; fall back to "Inconnu" if the user no longer exists
        try {
            User creator = userDao.read(path.getCreatedById());
            System.out.println("creator found = " + creator);
            createdByField.setText(creator != null
                    ? creator.getFirstName() + " " + creator.getLastName()
                    : "Inconnu");
        } catch (Exception e) {
            System.out.println("userDao.read() failed: " + e.getMessage());
            createdByField.setText("Inconnu");
        }

        pathArticlesListView.setItems(
                FXCollections.observableArrayList(service.getArticlesInPath(path.getId()))
        );
    }

    // Wire up the add / remove / reorder / save / delete buttons
    private void setupButtons() {

        // Add the selected available article to the path, but only once
        btnAddToPath.setOnAction(e -> {
            Article a = availableArticlesListView.getSelectionModel().getSelectedItem();
            if (a != null && selectedPath != null) {
                boolean alreadyInPath = pathArticlesListView.getItems()
                        .stream()
                        .anyMatch(existing -> existing.getId() == a.getId());
                if (!alreadyInPath) {
                    pathArticlesListView.getItems().add(a);
                }
            }
        });

        // Remove the selected article from the current path
        btnRemoveFromPath.setOnAction(e -> {
            Article a = pathArticlesListView.getSelectionModel().getSelectedItem();
            if (a != null)
                pathArticlesListView.getItems().remove(a);
        });

        // Move the selected article one position up in the ordering
        btnMoveUp.setOnAction(e -> {
            int idx = pathArticlesListView.getSelectionModel().getSelectedIndex();
            if (idx > 0) {
                Article a = pathArticlesListView.getItems().remove(idx);
                pathArticlesListView.getItems().add(idx - 1, a);
                pathArticlesListView.getSelectionModel().select(idx - 1);
            }
        });

        // Move the selected article one position down
        btnMoveDown.setOnAction(e -> {
            int idx = pathArticlesListView.getSelectionModel().getSelectedIndex();
            if (idx >= 0 && idx < pathArticlesListView.getItems().size() - 1) {
                Article a = pathArticlesListView.getItems().remove(idx);
                pathArticlesListView.getItems().add(idx + 1, a);
                pathArticlesListView.getSelectionModel().select(idx + 1);
            }
        });

        btnSavePath.setOnAction(e -> handleSave());
        btnDeletePath.setOnAction(e -> handleDelete());
    }

    // Create a new path or update the selected one, then persist the article ordering
    private void handleSave() {
        if (titreField.getText().isEmpty())
            return;

        User currentUser = SessionManager.getInstance().getCurrentUser();

        if (selectedPath == null) {
            // New path — build the object and insert it
            LearningPath lp = new LearningPath();
            lp.setTitre(titreField.getText());
            lp.setDescription(descriptionArea.getText());
            lp.setCreatedById(currentUser.getId());
            if (service.createPath(lp)) {
                service.updatePathArticles(lp.getId(), pathArticlesListView.getItems());
                loadPaths();
            }
        } else {
            // Existing path — update fields and re-save the article list
            selectedPath.setTitre(titreField.getText());
            selectedPath.setDescription(descriptionArea.getText());
            if (service.updatePath(selectedPath)) {
                service.updatePathArticles(selectedPath.getId(), pathArticlesListView.getItems());
                loadPaths();
            }
        }
    }

    // Ask for confirmation before deleting the selected path
    private void handleDelete() {
        if (selectedPath != null && ValidationUtils.confirmDelete(selectedPath.getTitre())) {
            if (service.deletePath(selectedPath.getId())) {
                loadPaths();
                clearForm();
            }
        }
    }

    // Reset the form to create a new path (deselects current path)
    @FXML
    private void newPath() {
        selectedPath = null;
        clearForm();
    }

    private void clearForm() {
        titreField.clear();
        descriptionArea.clear();
        createdByField.clear();
        pathArticlesListView.getItems().clear();
    }

    // Navigation helpers — called by the top nav bar buttons in the FXML
    @FXML private void goToArticles()    { ViewManager.loadView("article/ArticleView"); }
    @FXML private void goToCategories() { ViewManager.loadView("article/CategorieView"); }
    @FXML private void goToDashboard()  { com.innertrack.util.ViewNavigator.navigateToDashboard(); }
}