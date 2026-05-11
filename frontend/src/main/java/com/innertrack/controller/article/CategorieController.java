package com.innertrack.controller.article;

import com.innertrack.dao.UserDao;
import com.innertrack.model.Article;
import com.innertrack.model.Categorie;
import com.innertrack.dao.CategorieDao;
import com.innertrack.dao.ArticleDao;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.util.ValidationUtils;
import com.innertrack.util.ViewManager;
import com.innertrack.util.ViewNavigator;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Cursor;
import javafx.scene.control.*;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;

import java.sql.SQLException;
import java.util.List;
import java.util.function.BiConsumer;

public class CategorieController {

    @FXML private TextField searchField, nomField;
    @FXML private TextArea descField;
    @FXML private VBox categoriesContainer;
    // emptyState shown when nothing is selected; detailView shows the selected category info
    @FXML private VBox emptyState, detailView, articlesListBox;
    @FXML private ScrollPane detailScrollPane;
    @FXML private Label lblDetailTitle, lblDetailDescription, lblArticleCount;
    @FXML private Button btnUpdate, btnDelete, btnNew;

    private final CategorieDao categorieDao = new CategorieDao();
    private final ArticleDao articleDao = new ArticleDao();

    // masterList holds every category so the search filter can reset to it
    private ObservableList<Categorie> masterList = FXCollections.observableArrayList();
    private Categorie selectedCategorie;

    @FXML
    public void initialize() {
        loadData();
        setupSearch();
        hideDetail();
        checkPermissions();
    }

    // Only admins and psychologists can create / edit / delete categories
    private void checkPermissions() {
        User user = SessionManager.getInstance().getCurrentUser();
        boolean canWrite = ViewNavigator.hasRole(user, "ROLE_ADMIN")
                || ViewNavigator.hasRole(user, "ROLE_PSYCHOLOGUE");

        btnNew.setVisible(canWrite);
        btnNew.setManaged(canWrite);
        btnUpdate.setVisible(canWrite);
        btnUpdate.setManaged(canWrite);
        btnDelete.setVisible(canWrite);
        btnDelete.setManaged(canWrite);

        nomField.setEditable(canWrite);
        descField.setEditable(canWrite);
    }

    // Load all categories from the DB and re-render the card grid
    @FXML
    private void loadData() {
        masterList.setAll(categorieDao.findAll());
        renderCategories(masterList);
    }

    // Rebuild the card grid from the given list (used for both full load and search filter)
    private void renderCategories(List<Categorie> categories) {
        categoriesContainer.getChildren().clear();
        for (Categorie c : categories) {
            categoriesContainer.getChildren().add(createCategoryCard(c));
        }
    }

    // Build a single row for the article list inside the detail panel
    private HBox buildArticleRow(Article article) {
        HBox row = new HBox(10);
        row.setAlignment(Pos.CENTER_LEFT);
        row.setPadding(new Insets(8, 12, 8, 12));
        row.setStyle("-fx-background-color: #f3f2f1; -fx-background-radius: 6px; -fx-cursor: hand;");

        Label icon = new Label("📰");
        icon.setStyle("-fx-font-size: 15px;");

        Label titre = new Label(article.getTitre());
        titre.setStyle("-fx-font-size: 13px; -fx-font-weight: bold; -fx-text-fill: #323130;");
        titre.setMaxWidth(180);
        titre.setTextOverrun(OverrunStyle.ELLIPSIS);

        // Use the pre-fetched author name; fall back to "Inconnu" if missing
        String authorName = (article.getAuteurName() != null && !article.getAuteurName().trim().isEmpty())
                ? article.getAuteurName()
                : "Inconnu";
        String dateStr = article.getDatePublication() != null
                ? article.getDatePublication().toString()
                : "—";
        Label meta = new Label(authorName + " · " + dateStr);
        meta.setStyle("-fx-font-size: 11px; -fx-text-fill: #8a8886;");

        Label arrow = new Label("→");
        arrow.setStyle("-fx-text-fill: #0078d4; -fx-font-weight: bold;");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        row.getChildren().addAll(icon, titre, spacer, meta, arrow);

        // Subtle blue highlight on hover to signal the row is clickable
        row.setOnMouseEntered(e -> row.setStyle("-fx-background-color: #dce9f9; -fx-background-radius: 6px;"));
        row.setOnMouseExited(e -> row.setStyle("-fx-background-color: #f3f2f1; -fx-background-radius: 6px;"));

        // Clicking a row opens that article in ArticleView
        row.setOnMouseClicked(e -> {
            SessionManager.getInstance().setCurrentArticle(article);
            SessionManager.getInstance().setCurrentCategory(null);
            ViewManager.loadView("article/ArticleView");
        });

        return row;
    }

    // Build a card widget for a single category in the grid
    private VBox createCategoryCard(Categorie c) {
        VBox card = new VBox(8);
        card.getStyleClass().add("card");
        card.setPadding(new Insets(16));
        card.setCursor(Cursor.HAND);

        Label title = new Label(c.getNom());
        title.getStyleClass().add("card-title");

        // Truncate long descriptions so the card stays a uniform height
        String desc = c.getDescription();
        if (desc != null && desc.length() > 60) desc = desc.substring(0, 60) + "...";
        Label description = new Label(desc != null ? desc : "Aucune description");
        description.getStyleClass().add("card-subtitle");
        description.setWrapText(true);

        int articleCount = articleDao.countByCategorie(c.getId());
        Label badge = new Label(articleCount + " article" + (articleCount > 1 ? "s" : ""));
        badge.getStyleClass().add("card-badge");

        // The "see articles" button navigates directly to ArticleView filtered by this category
        Button btnView = new Button("Voir les articles →");
        btnView.setStyle(
                "-fx-background-color: transparent; -fx-text-fill: #0078d4; -fx-cursor: hand; " +
                        "-fx-font-size: 11px; -fx-underline: true; -fx-padding: 0;");
        btnView.setOnAction(e -> {
            e.consume(); // prevent the card's own click handler from firing
            SessionManager.getInstance().setCurrentCategory(c);
            SessionManager.getInstance().setCurrentArticle(null);
            ViewManager.loadView("article/ArticleView");
        });

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);
        HBox footer = new HBox(8, badge, spacer, btnView);
        footer.setAlignment(Pos.CENTER_LEFT);

        card.getChildren().addAll(title, description, footer);

        // Clicking the card body (not the button) shows the detail panel
        card.setOnMouseClicked(e -> showDetail(c));
        return card;
    }

    // Live search: filter the card grid as the user types
    private void setupSearch() {
        searchField.textProperty().addListener((obs, old, newVal) -> {
            if (newVal == null || newVal.isEmpty()) {
                renderCategories(masterList);
            } else {
                List<Categorie> filtered = masterList.stream()
                        .filter(c -> c.getNom().toLowerCase().contains(newVal.toLowerCase()))
                        .toList();
                renderCategories(filtered);
            }
        });
    }

    // Populate the detail panel on the right with the selected category's info and its articles
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

    // Fill the article list box with individual rows
    private void renderArticlesList(List<Article> articles) {
        articlesListBox.getChildren().clear();
        for (Article a : articles) {
            articlesListBox.getChildren().add(buildArticleRow(a));
        }
    }

    // Show the empty-state placeholder and hide the detail panel
    private void hideDetail() {
        emptyState.setVisible(true);
        detailScrollPane.setVisible(false);
    }

    // Reset the form for creating a new category (deselects the current one)
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

    // Save: insert a new category or update the selected one depending on state
    @FXML
    private void handleUpdate() {
        if (!ValidationUtils.isNotEmpty(nomField, "Le nom"))
            return;

        if (selectedCategorie == null) {
            Categorie c = new Categorie();
            c.setNom(nomField.getText());
            c.setDescription(descField.getText());
            if (categorieDao.create(c)) {
                ValidationUtils.showInfo("Catégorie créée.");
                loadData();
                showDetail(c);
            }
        } else {
            selectedCategorie.setNom(nomField.getText());
            selectedCategorie.setDescription(descField.getText());
            if (categorieDao.update(selectedCategorie)) {
                ValidationUtils.showInfo("Catégorie mise à jour.");
                loadData();
                showDetail(selectedCategorie);
            }
        }
    }

    // Ask for confirmation then delete the selected category
    @FXML
    private void handleDelete() {
        if (selectedCategorie != null && ValidationUtils.confirmDelete(selectedCategorie.getNom())) {
            if (categorieDao.delete(selectedCategorie.getId())) {
                loadData();
                hideDetail();
            }
        }
    }

    // Navigation helpers — wired to the top nav bar in the FXML
    @FXML private void goToArticles()      { ViewManager.loadView("article/ArticleView"); }
    @FXML private void goToLearningPaths() { ViewManager.loadView("article/LearningPathView"); }
    @FXML private void goToDashboard()     { ViewNavigator.navigateToDashboard(); }
    @FXML private void clearSelection()    { hideDetail(); }
}