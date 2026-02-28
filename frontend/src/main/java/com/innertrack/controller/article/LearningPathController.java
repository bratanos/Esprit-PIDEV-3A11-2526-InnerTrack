package com.innertrack.controller.article;

import com.innertrack.model.Article;
import com.innertrack.model.LearningPath;
import com.innertrack.service.ArticleService;
import com.innertrack.service.LearningPathService;
import com.innertrack.util.ValidationUtils;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;

public class LearningPathController {

    @FXML
    private ListView<LearningPath> pathListView;
    @FXML
    private ListView<Article> availableArticlesListView;
    @FXML
    private ListView<Article> pathArticlesListView;

    @FXML
    private TextField titreField, createdByField;
    @FXML
    private TextArea descriptionArea;

    @FXML
    private Button btnAddToPath, btnRemoveFromPath, btnMoveUp, btnMoveDown, btnSavePath, btnDeletePath, btnNew;

    @FXML
    private javafx.scene.layout.HBox mainContent;
    @FXML
    private javafx.scene.layout.VBox emptyStateBox;

    private final LearningPathService service = new LearningPathService();
    private final ArticleService articleService = new ArticleService();

    private LearningPath selectedPath;

    @FXML
    public void initialize() {
        loadPaths();
        loadAvailableArticles();
        setupListListeners();
        setupButtons();
        checkPermissions();
    }

    private void checkPermissions() {
        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        boolean hasWriteAccess = com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_ADMIN")
                || com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        btnNew.setVisible(hasWriteAccess);
        btnNew.setManaged(hasWriteAccess);
        btnSavePath.setVisible(hasWriteAccess);
        btnSavePath.setManaged(hasWriteAccess);
        btnDeletePath.setVisible(hasWriteAccess);
        btnDeletePath.setManaged(hasWriteAccess);
        btnAddToPath.setVisible(hasWriteAccess);
        btnAddToPath.setManaged(hasWriteAccess);
        btnRemoveFromPath.setVisible(hasWriteAccess);
        btnRemoveFromPath.setManaged(hasWriteAccess);
        btnMoveUp.setVisible(hasWriteAccess);
        btnMoveUp.setManaged(hasWriteAccess);
        btnMoveDown.setVisible(hasWriteAccess);
        btnMoveDown.setManaged(hasWriteAccess);

        titreField.setEditable(hasWriteAccess);
        descriptionArea.setEditable(hasWriteAccess);
        createdByField.setEditable(hasWriteAccess);
    }

    @FXML
    private void loadPaths() {
        java.util.List<LearningPath> paths = service.getAllPaths();
        pathListView.setItems(FXCollections.observableArrayList(paths));

        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        boolean isNormalUser = !com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_ADMIN")
                && !com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        if (paths.isEmpty() && isNormalUser) {
            mainContent.setVisible(false);
            emptyStateBox.setVisible(true);
        } else {
            mainContent.setVisible(true);
            emptyStateBox.setVisible(false);
        }
    }

    private void loadAvailableArticles() {
        availableArticlesListView.setItems(FXCollections.observableArrayList(articleService.getAllArticles()));
    }

    private void setupListListeners() {
        pathListView.getSelectionModel().selectedItemProperty().addListener((obs, old, newVal) -> {
            if (newVal != null)
                showPathDetail(newVal);
        });
    }

    private void showPathDetail(LearningPath path) {
        selectedPath = path;
        titreField.setText(path.getTitre());
        descriptionArea.setText(path.getDescription());
        createdByField.setText(String.valueOf(path.getCreatedById()));

        pathArticlesListView.setItems(FXCollections.observableArrayList(service.getArticlesInPath(path.getId())));
    }

    private void setupButtons() {
        btnAddToPath.setOnAction(e -> {
            Article a = availableArticlesListView.getSelectionModel().getSelectedItem();
            if (a != null && selectedPath != null) {
                if (pathArticlesListView.getItems().stream().noneMatch(existing -> existing.getId() == a.getId())) {
                    pathArticlesListView.getItems().add(a);
                }
            }
        });

        btnRemoveFromPath.setOnAction(e -> {
            Article a = pathArticlesListView.getSelectionModel().getSelectedItem();
            if (a != null)
                pathArticlesListView.getItems().remove(a);
        });

        btnMoveUp.setOnAction(e -> {
            int idx = pathArticlesListView.getSelectionModel().getSelectedIndex();
            if (idx > 0) {
                Article a = pathArticlesListView.getItems().remove(idx);
                pathArticlesListView.getItems().add(idx - 1, a);
                pathArticlesListView.getSelectionModel().select(idx - 1);
            }
        });

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

    private void handleSave() {
        if (titreField.getText().isEmpty())
            return;

        if (selectedPath == null) {
            LearningPath lp = new LearningPath();
            lp.setTitre(titreField.getText());
            lp.setDescription(descriptionArea.getText());
            // User ID handling ...
            if (service.createPath(lp)) {
                service.updatePathArticles(lp.getId(), pathArticlesListView.getItems());
                loadPaths();
            }
        } else {
            selectedPath.setTitre(titreField.getText());
            selectedPath.setDescription(descriptionArea.getText());
            if (service.updatePath(selectedPath)) {
                service.updatePathArticles(selectedPath.getId(), pathArticlesListView.getItems());
                loadPaths();
            }
        }
    }

    private void handleDelete() {
        if (selectedPath != null && ValidationUtils.confirmDelete(selectedPath.getTitre())) {
            if (service.deletePath(selectedPath.getId())) {
                loadPaths();
                clearForm();
            }
        }
    }

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

    @FXML
    private void goToArticles() {
        com.innertrack.util.ViewManager.loadView("article/ArticleView");
    }

    @FXML
    private void goToCategories() {
        com.innertrack.util.ViewManager.loadView("article/CategorieView");
    }

    @FXML
    private void goToDashboard() {
        com.innertrack.util.ViewNavigator.navigateToDashboard();
    }
}
