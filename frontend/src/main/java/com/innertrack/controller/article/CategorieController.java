package com.innertrack.controller.article;

import com.innertrack.model.Article;
import com.innertrack.model.Categorie;
import com.innertrack.dao.CategorieDao;
import com.innertrack.dao.ArticleDao;
import com.innertrack.util.ValidationUtils;
import com.innertrack.util.ViewManager;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;

import java.util.List;

public class CategorieController {

    @FXML
    private TextField searchField, nomField;
    @FXML
    private TextArea descField;
    @FXML
    private VBox categoriesContainer;
    @FXML
    private VBox emptyState, detailView, articlesListBox;
    @FXML
    private ScrollPane detailScrollPane;
    @FXML
    private Label lblDetailTitle, lblDetailDescription, lblArticleCount;
    @FXML
    private Button btnUpdate, btnDelete, btnNew;

    private final CategorieDao categorieDao = new CategorieDao();
    private final ArticleDao articleDao = new ArticleDao();
    private ObservableList<Categorie> masterList = FXCollections.observableArrayList();
    private Categorie selectedCategorie;

    @FXML
    public void initialize() {
        loadData();
        setupSearch();
        hideDetail();
        checkPermissions();
    }

    private void checkPermissions() {
        com.innertrack.model.User user = com.innertrack.session.SessionManager.getInstance().getCurrentUser();
        boolean hasWriteAccess = com.innertrack.util.ViewNavigator.hasRole(user, "ROLE_ADMIN");

        btnNew.setVisible(hasWriteAccess);
        btnNew.setManaged(hasWriteAccess);
        btnUpdate.setVisible(hasWriteAccess);
        btnUpdate.setManaged(hasWriteAccess);
        btnDelete.setVisible(hasWriteAccess);
        btnDelete.setManaged(hasWriteAccess);

        nomField.setEditable(hasWriteAccess);
        descField.setEditable(hasWriteAccess);
    }

    @FXML
    private void loadData() {
        masterList.setAll(categorieDao.findAll());
        renderCategories(masterList);
    }

    private void renderCategories(List<Categorie> categories) {
        categoriesContainer.getChildren().clear();
        for (Categorie c : categories) {
            HBox card = createCategoryCard(c);
            categoriesContainer.getChildren().add(card);
        }
    }

    private HBox createCategoryCard(Categorie c) {
        HBox card = new HBox(10);
        card.getStyleClass().add("card");
        Label name = new Label(c.getNom());
        name.getStyleClass().add("card-title");
        card.getChildren().add(name);

        card.setOnMouseClicked(e -> showDetail(c));
        return card;
    }

    private void setupSearch() {
        searchField.textProperty().addListener((obs, old, newVal) -> {
            if (newVal == null || newVal.isEmpty())
                renderCategories(masterList);
            else {
                List<Categorie> filtered = masterList.stream()
                        .filter(c -> c.getNom().toLowerCase().contains(newVal.toLowerCase()))
                        .toList();
                renderCategories(filtered);
            }
        });
    }

    private void showDetail(Categorie c) {
        selectedCategorie = c;
        emptyState.setVisible(false);
        detailScrollPane.setVisible(true);

        lblDetailTitle.setText(c.getNom());
        lblDetailDescription.setText(c.getDescription() != null ? c.getDescription() : "Aucune description");
        nomField.setText(c.getNom());
        descField.setText(c.getDescription());

        List<Article> articles = articleDao.findByCategorie(c.getId());
        lblArticleCount.setText(articles.size() + " articles dans cette catégorie");

        renderArticlesList(articles);
    }

    private void renderArticlesList(List<Article> articles) {
        articlesListBox.getChildren().clear();
        for (Article a : articles) {
            Button link = new Button(a.getTitre());
            link.getStyleClass().add("btn-ghost");
            link.setMaxWidth(Double.MAX_VALUE);
            link.setOnAction(e -> {
                // Navigate to ArticleView
                ViewManager.loadView("article/ArticleView");
            });
            articlesListBox.getChildren().add(link);
        }
    }

    private void hideDetail() {
        emptyState.setVisible(true);
        detailScrollPane.setVisible(false);
    }

    @FXML
    private void showAddForm() {
        selectedCategorie = null;
        emptyState.setVisible(false);
        detailScrollPane.setVisible(true);
        lblDetailTitle.setText("Nouvelle Catégorie");
        lblDetailDescription.setText("");
        nomField.clear();
        descField.clear();
        articlesListBox.getChildren().clear();
        lblArticleCount.setText("");
        btnUpdate.setText("Ajouter");
    }

    @FXML
    private void handleUpdate() {
        if (!ValidationUtils.isNotEmpty(nomField, "Le nom"))
            return;

        if (selectedCategorie == null) {
            // Create
            Categorie c = new Categorie();
            c.setNom(nomField.getText());
            c.setDescription(descField.getText());
            if (categorieDao.create(c)) {
                ValidationUtils.showInfo("Catégorie créée.");
                loadData();
                showDetail(c);
            }
        } else {
            // Update
            selectedCategorie.setNom(nomField.getText());
            selectedCategorie.setDescription(descField.getText());
            if (categorieDao.update(selectedCategorie)) {
                ValidationUtils.showInfo("Catégorie mise à jour.");
                loadData();
                showDetail(selectedCategorie);
            }
        }
    }

    @FXML
    private void handleDelete() {
        if (selectedCategorie != null && ValidationUtils.confirmDelete(selectedCategorie.getNom())) {
            if (categorieDao.delete(selectedCategorie.getId())) {
                loadData();
                hideDetail();
            }
        }
    }

    @FXML
    private void goToArticles() {
        com.innertrack.util.ViewManager.loadView("article/ArticleView");
    }

    @FXML
    private void goToLearningPaths() {
        com.innertrack.util.ViewManager.loadView("article/LearningPathView");
    }

    @FXML
    private void goToDashboard() {
        com.innertrack.util.ViewNavigator.navigateToDashboard();
    }

    @FXML
    private void clearSelection() {
        hideDetail();
    }
}
