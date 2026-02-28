package com.innertrack.controller;

import javafx.animation.*;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.*;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.shape.Rectangle;
import javafx.util.Duration;
import com.innertrack.model.AIRecommandation;
import com.innertrack.model.Resultat;
import com.innertrack.service.RecommandationMLService;
import com.innertrack.service.EmailTestService;
import com.innertrack.util.DBConnection;

import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ResourceBundle;

/**
 * Controller for displaying ML-based recommendations.
 * Loaded via fx:include from the result view.
 */
public class Recommandationmlcontroller implements Initializable {

    @FXML
    private VBox mlRecommandationRoot;

    private Resultat resultat;
    private int idUtilisateur;
    private final RecommandationMLService mlService = new RecommandationMLService();

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // Initialized via setResultat() from parent controller
    }

    public void setResultat(Resultat resultat, int idUtilisateur) {
        this.resultat = resultat;
        this.idUtilisateur = idUtilisateur;
        afficherChargement();
        lancerAnalyseML();
    }

    private void afficherChargement() {
        mlRecommandationRoot.getChildren().clear();
        VBox loadingBox = new VBox(15);
        loadingBox.setAlignment(Pos.CENTER);
        loadingBox.setPadding(new Insets(40));

        Label icon = new Label("🧠");
        icon.setStyle("-fx-font-size: 48px;");
        Label msg = new Label("Analyse en cours...");
        msg.setStyle("-fx-font-size: 16px; -fx-text-fill: #555; -fx-font-weight: bold;");
        Label sub = new Label("Régression logistique Softmax sur 7 dimensions comportementales");
        sub.setStyle("-fx-font-size: 12px; -fx-text-fill: #999;");

        ProgressBar bar = new ProgressBar();
        bar.setPrefWidth(300);
        bar.setStyle("-fx-accent: #4a90d9;");

        Timeline tl = new Timeline(
                new KeyFrame(Duration.ZERO, new KeyValue(bar.progressProperty(), 0)),
                new KeyFrame(Duration.seconds(2), new KeyValue(bar.progressProperty(), 0.95)));
        tl.play();

        loadingBox.getChildren().addAll(icon, msg, sub, bar);
        mlRecommandationRoot.getChildren().add(loadingBox);
    }

    private void lancerAnalyseML() {
        Thread thread = new Thread(() -> {
            try {
                AIRecommandation rec = mlService.genererRecommandations(resultat, idUtilisateur);
                Platform.runLater(() -> afficherRecommandations(rec));
            } catch (Exception e) {
                Platform.runLater(() -> afficherErreur(e.getMessage()));
            }
        });
        thread.setDaemon(true);
        thread.start();
    }

    private void afficherRecommandations(AIRecommandation rec) {
        mlRecommandationRoot.getChildren().clear();
        mlRecommandationRoot.setSpacing(20);
        mlRecommandationRoot.setPadding(new Insets(20));

        mlRecommandationRoot.getChildren().add(creerEntetCluster(rec));
        mlRecommandationRoot.getChildren().add(creerGrapheProbabilites(rec));
        mlRecommandationRoot.getChildren().add(creerRadarFeatures(rec));
        mlRecommandationRoot.getChildren().add(creerAnalyse(rec));

        if (rec.getAlertes() != null && !rec.getAlertes().isEmpty())
            mlRecommandationRoot.getChildren().add(creerAlertes(rec));

        mlRecommandationRoot.getChildren().add(creerSectionHabitudes(rec));
        mlRecommandationRoot.getChildren().add(creerPlanSemaine(rec));
        mlRecommandationRoot.getChildren().add(creerBoutonEmail(rec));
        animerEntree(mlRecommandationRoot);
    }

    // ── Visual components ──

    private VBox creerEntetCluster(AIRecommandation rec) {
        VBox box = new VBox(12);
        box.getStyleClass().add("header-banner");
        box.setStyle("-fx-background-color: " + rec.getCouleurCluster() + ";"); // Use the actual color for the banner

        HBox badgeRow = new HBox(12);
        badgeRow.setAlignment(Pos.CENTER_LEFT);
        Label emoji = new Label(rec.getEmojiCluster());
        emoji.setStyle("-fx-font-size: 36px;");

        VBox textBox = new VBox(4);
        Label clusterLabel = new Label("Profil détecté : " + rec.getCluster());
        clusterLabel.setStyle("-fx-font-size: 22px; -fx-font-weight: bold; -fx-text-fill: white;");
        Label confLabel = new Label("Confiance du modèle ML : " + rec.getScoreConfiance() + "%");
        confLabel.setStyle("-fx-font-size: 13px; -fx-text-fill: rgba(255,255,255,0.8);");
        textBox.getChildren().addAll(clusterLabel, confLabel);
        badgeRow.getChildren().addAll(emoji, textBox);

        HBox confBar = creerBarreProgression("Confiance", rec.getScoreConfiance() / 100.0, "#ffffff");
        Label tagML = new Label("⚙️  Softmax Regression · 7 features · 1000 itérations");
        tagML.setStyle("-fx-font-size: 11px; -fx-text-fill: rgba(255,255,255,0.6); -fx-font-style: italic;");

        box.getChildren().addAll(badgeRow, confBar, tagML);
        return box;
    }

    private VBox creerGrapheProbabilites(AIRecommandation rec) {
        VBox box = creerSectionBox("📊 Distribution des probabilités (Softmax)");
        String[] labels = { "🔴 Fragile", "🟡 Stable", "🟢 Résilient" };
        String[] colors = { "#e74c3c", "#f39c12", "#27ae60" };
        double[] probas = rec.getProbabilites();

        VBox bars = new VBox(10);
        for (int i = 0; i < 3; i++) {
            bars.getChildren().add(creerBarreProgression(
                    String.format("%s  %.1f%%", labels[i], probas[i] * 100), probas[i], colors[i]));
        }
        box.getChildren().add(bars);
        return box;
    }

    private VBox creerRadarFeatures(AIRecommandation rec) {
        VBox box = creerSectionBox("🔬 Features extraites de vos réponses");
        String[] noms = RecommandationMLService.getNomsFeatures();
        double[] feats = rec.getFeatures();
        String[] colors = { "#4a90d9", "#e74c3c", "#27ae60", "#f39c12", "#9b59b6", "#1abc9c", "#e67e22" };

        GridPane grid = new GridPane();
        grid.setHgap(20);
        grid.setVgap(8);

        for (int i = 0; i < noms.length; i++) {
            Label nom = new Label(noms[i]);
            nom.setStyle("-fx-font-size: 12px; -fx-text-fill: #555; -fx-min-width: 150px;");

            StackPane miniBar = new StackPane();
            miniBar.setMaxWidth(200);
            miniBar.setMinWidth(200);
            miniBar.setPrefHeight(14);
            miniBar.setStyle("-fx-background-color: #eee; -fx-background-radius: 7;");

            Rectangle fill = new Rectangle(200 * feats[i], 14);
            fill.setArcWidth(7);
            fill.setArcHeight(7);
            fill.setFill(Color.web(colors[i]));
            StackPane.setAlignment(fill, Pos.CENTER_LEFT);
            miniBar.getChildren().add(fill);

            fill.setWidth(0);
            Timeline tl = new Timeline(
                    new KeyFrame(Duration.ZERO, new KeyValue(fill.widthProperty(), 0)),
                    new KeyFrame(Duration.millis(800), new KeyValue(fill.widthProperty(), 200 * feats[i])));
            tl.setDelay(Duration.millis(i * 80));
            tl.play();

            Label val = new Label(String.format("%.2f", feats[i]));
            val.setStyle("-fx-font-size: 12px; -fx-text-fill: #333; -fx-font-weight: bold;");

            grid.add(nom, 0, i);
            grid.add(miniBar, 1, i);
            grid.add(val, 2, i);
        }
        box.getChildren().add(grid);
        return box;
    }

    private VBox creerAnalyse(AIRecommandation rec) {
        VBox box = creerSectionBox("🧠 Analyse psychologique personnalisée");
        Label texte = new Label(rec.getAnalyseGlobale());
        texte.setWrapText(true);
        texte.setStyle("-fx-font-size: 13.5px; -fx-text-fill: #333; -fx-line-spacing: 4;");
        box.getChildren().add(texte);
        return box;
    }

    private VBox creerAlertes(AIRecommandation rec) {
        VBox box = creerSectionBox("⚠️ Points d'attention");
        for (String alerte : rec.getAlertes()) {
            Label lbl = new Label(alerte);
            lbl.setWrapText(true);
            lbl.setStyle("""
                        -fx-background-color: #fff8e1; -fx-border-color: #f39c12;
                        -fx-border-radius: 8; -fx-background-radius: 8;
                        -fx-padding: 10 14; -fx-font-size: 13px; -fx-text-fill: #7d6000;
                    """);
            box.getChildren().add(lbl);
        }
        return box;
    }

    private VBox creerSectionHabitudes(AIRecommandation rec) {
        VBox box = creerSectionBox("💡 Habitudes recommandées");
        if (rec.getHabitudes() == null)
            return box;
        for (int i = 0; i < rec.getHabitudes().size(); i++) {
            AIRecommandation.Habitude h = rec.getHabitudes().get(i);
            VBox carte = creerCarteHabitude(h);
            carte.getStyleClass().add("rec-card");
            carte.setOpacity(0);
            FadeTransition ft = new FadeTransition(Duration.millis(400), carte);
            ft.setToValue(1);
            ft.setDelay(Duration.millis(i * 120));
            ft.play();
            box.getChildren().add(carte);
        }
        return box;
    }

    private VBox creerCarteHabitude(AIRecommandation.Habitude h) {
        String borderColor = switch (h.impact) {
            case "CRITIQUE" -> "#e74c3c";
            case "Élevé" -> "#f39c12";
            case "Fort" -> "#4a90d9";
            default -> "#27ae60";
        };

        VBox carte = new VBox(8);
        carte.setStyle(String.format("""
                    -fx-background-color: white; -fx-border-color: %s;
                    -fx-border-width: 0 0 0 5; -fx-border-radius: 8;
                    -fx-background-radius: 8; -fx-padding: 15;
                    -fx-effect: dropshadow(gaussian, rgba(0,0,0,0.08), 8, 0, 0, 2);
                """, borderColor));

        HBox header = new HBox(10);
        header.setAlignment(Pos.CENTER_LEFT);
        Label emojiLbl = new Label(h.emoji);
        emojiLbl.setStyle("-fx-font-size: 24px;");

        VBox titreBox = new VBox(3);
        Label titreLbl = new Label(h.titre);
        titreLbl.setStyle("-fx-font-size: 14px; -fx-font-weight: bold; -fx-text-fill: #1a1a2e;");

        HBox badges = new HBox(8);
        badges.getChildren().addAll(
                creerBadge("🏷 " + h.categorie, "#4a90d9"),
                creerBadge("⏰ " + h.frequence, "#666"),
                creerBadge("📈 " + h.impact, borderColor));
        titreBox.getChildren().addAll(titreLbl, badges);
        header.getChildren().addAll(emojiLbl, titreBox);

        Label desc = new Label(h.description);
        desc.setWrapText(true);
        desc.setStyle("-fx-font-size: 12.5px; -fx-text-fill: #555; -fx-line-spacing: 3;");

        carte.getChildren().addAll(header, desc);
        return carte;
    }

    private VBox creerPlanSemaine(AIRecommandation rec) {
        VBox box = creerSectionBox("📅 Plan d'action — 7 jours");
        Label plan = new Label(rec.getPlanSemaine());
        plan.setWrapText(true);
        plan.setStyle("""
                    -fx-font-family: 'Courier New', monospace; -fx-font-size: 12.5px;
                    -fx-text-fill: #333; -fx-background-color: #f8f9fa;
                    -fx-padding: 15; -fx-background-radius: 8; -fx-line-spacing: 5;
                """);
        box.getChildren().add(plan);
        return box;
    }

    // ── Utilities ──

    private VBox creerSectionBox(String titre) {
        VBox box = new VBox(12);
        box.getStyleClass().add("rec-card");
        Label titreLabel = new Label(titre);
        titreLabel.getStyleClass().add("rec-section-title");
        Separator sep = new Separator();
        sep.setStyle("-fx-opacity: 0.3;");
        box.getChildren().addAll(titreLabel, sep);
        return box;
    }

    private HBox creerBarreProgression(String libelle, double valeur, String couleur) {
        HBox row = new HBox(10);
        row.setAlignment(Pos.CENTER_LEFT);
        Label lbl = new Label(libelle);
        lbl.setStyle("-fx-font-size: 12px; -fx-text-fill: #444; -fx-min-width: 180px;");

        StackPane barContainer = new StackPane();
        barContainer.setStyle("-fx-background-color: #eee; -fx-background-radius: 6;");
        barContainer.setPrefHeight(16);
        HBox.setHgrow(barContainer, Priority.ALWAYS);

        Rectangle fill = new Rectangle(0, 16);
        fill.setArcWidth(6);
        fill.setArcHeight(6);
        fill.setFill(Color.web(couleur));
        StackPane.setAlignment(fill, Pos.CENTER_LEFT);
        barContainer.getChildren().add(fill);

        barContainer.widthProperty().addListener((obs, old, w) -> {
            double target = w.doubleValue() * valeur;
            Timeline tl = new Timeline(
                    new KeyFrame(Duration.ZERO, new KeyValue(fill.widthProperty(), 0)),
                    new KeyFrame(Duration.millis(600), new KeyValue(fill.widthProperty(), target)));
            tl.play();
        });

        row.getChildren().addAll(lbl, barContainer);
        return row;
    }

    private Label creerBadge(String texte, String couleur) {
        String baseColor = couleur;
        if (baseColor.startsWith("#") && baseColor.length() == 4) {
            // Convert #RGB to #RRGGBB
            baseColor = "#" + baseColor.charAt(1) + baseColor.charAt(1) +
                    baseColor.charAt(2) + baseColor.charAt(2) +
                    baseColor.charAt(3) + baseColor.charAt(3);
        }

        Label badge = new Label(texte);
        badge.setStyle(String.format("""
                    -fx-background-color: %s22; -fx-border-color: %s;
                    -fx-border-radius: 10; -fx-background-radius: 10;
                    -fx-padding: 2 8; -fx-font-size: 10px; -fx-text-fill: %s;
                """, baseColor, baseColor, baseColor));
        return badge;
    }

    private void animerEntree(VBox root) {
        FadeTransition ft = new FadeTransition(Duration.millis(500), root);
        ft.setFromValue(0);
        ft.setToValue(1);
        TranslateTransition tt = new TranslateTransition(Duration.millis(400), root);
        tt.setFromY(20);
        tt.setToY(0);
        new ParallelTransition(ft, tt).play();
    }

    private void afficherErreur(String msg) {
        mlRecommandationRoot.getChildren().clear();
        Label err = new Label("❌ Erreur ML : " + msg);
        err.setStyle("-fx-text-fill: red; -fx-font-size: 13px;");
        mlRecommandationRoot.getChildren().add(err);
    }

    private VBox creerBoutonEmail(AIRecommandation rec) {
        VBox box = new VBox(10);
        box.setAlignment(Pos.CENTER);
        box.setPadding(new Insets(10, 20, 20, 20));

        Button btnEmail = new Button("📧  Envoyer ce rapport par email");
        btnEmail.getStyleClass().add("action-button");

        Label statusLbl = new Label("");
        statusLbl.setStyle("-fx-font-size: 12px; -fx-text-fill: #555;");
        btnEmail.setOnAction(e -> envoyerEmailAsync(rec, btnEmail, statusLbl));
        box.getChildren().addAll(btnEmail, statusLbl);
        return box;
    }

    private void envoyerEmailAsync(AIRecommandation rec, Button btn, Label statusLbl) {
        btn.setDisable(true);
        btn.setText("⏳  Envoi en cours...");
        Thread t = new Thread(() -> {
            try {
                String[] infos = recupererInfosUtilisateur(idUtilisateur);
                String email = infos[0];
                if (email == null || email.isBlank()) {
                    Platform.runLater(() -> {
                        statusLbl.setStyle("-fx-text-fill: #e74c3c;");
                        statusLbl.setText("❌ Aucun email enregistré.");
                        btn.setDisable(false);
                        btn.setText("📧  Envoyer ce rapport par email");
                    });
                    return;
                }

                String titreTest = recupererTitreTest(resultat.getIdTest());
                String contenu = "Profil: " + rec.getCluster()
                        + " — Score: " + resultat.getScoreTotal() + "/" + resultat.getScoreMaxPossible()
                        + " (" + String.format("%.1f%%", resultat.getPourcentage()) + ")"
                        + "<br><br>" + rec.getAnalyseGlobale();
                new EmailTestService().envoyerRapport(email, infos[1], titreTest, contenu);

                Platform.runLater(() -> {
                    statusLbl.setStyle("-fx-text-fill: #27ae60;");
                    statusLbl.setText("✅ Rapport envoyé à " + email);
                    btn.setText("✅  Email envoyé !");
                    btn.setStyle(
                            "-fx-background-color: #27ae60; -fx-text-fill: white; -fx-font-size: 14px; -fx-font-weight: bold; -fx-padding: 12 28; -fx-background-radius: 10;");
                });
            } catch (Exception ex) {
                Platform.runLater(() -> {
                    statusLbl.setStyle("-fx-text-fill: #e74c3c;");
                    statusLbl.setText("❌ " + ex.getMessage());
                    btn.setDisable(false);
                    btn.setText("📧  Réessayer");
                });
            }
        });
        t.setDaemon(true);
        t.start();
    }

    private String[] recupererInfosUtilisateur(int idU) throws Exception {
        Connection cnx = DBConnection.getInstance().getConnection();
        PreparedStatement ps = cnx.prepareStatement("SELECT email, first_name FROM user WHERE id = ?");
        ps.setInt(1, idU);
        ResultSet rs = ps.executeQuery();
        if (rs.next())
            return new String[] { rs.getString("email"), rs.getString("first_name") };
        return new String[] { "", "user" };
    }

    private String recupererTitreTest(int idTest) throws Exception {
        Connection cnx = DBConnection.getInstance().getConnection();
        PreparedStatement ps = cnx.prepareStatement("SELECT titre FROM test_psychologique WHERE id_test = ?");
        ps.setInt(1, idTest);
        ResultSet rs = ps.executeQuery();
        return rs.next() ? rs.getString("titre") : "Test";
    }
}
