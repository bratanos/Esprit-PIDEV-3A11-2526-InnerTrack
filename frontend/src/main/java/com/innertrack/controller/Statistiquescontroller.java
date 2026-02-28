package com.innertrack.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.chart.*;
import javafx.scene.control.Label;
import javafx.stage.Stage;
import com.innertrack.util.DBConnection;
import com.innertrack.session.SessionManager;

import java.net.URL;
import java.sql.*;
import java.util.*;

/**
 * Statistics controller showing charts and KPIs for test results.
 * Can be opened as a standalone window via ouvrirFenetre().
 */
public class Statistiquescontroller implements Initializable {

    @FXML
    private BarChart<String, Number> barChart;
    @FXML
    private PieChart pieChart;
    @FXML
    private LineChart<String, Number> lineChart;
    @FXML
    private Label totalPassesLabel;
    @FXML
    private Label scoreMoyenLabel;
    @FXML
    private Label testFavoriLabel;

    private int idUtilisateur = 1;
    private boolean isTherapist = false;

    @Override
    public void initialize(URL url, ResourceBundle rb) {
        try {
            com.innertrack.model.User user = SessionManager.getInstance().getCurrentUser();
            if (user != null) {
                idUtilisateur = user.getId();
                isTherapist = user.getRoles().contains("ROLE_PSYCHOLOGUE");
            }
        } catch (Exception e) {
            System.err.println("Pas de session active, mode debug");
        }
        chargerBarChart();
        chargerPieChart();
        chargerLineChart();
        chargerKPIs();
    }

    public void setIdUtilisateur(int id) {
        this.idUtilisateur = id;
        chargerBarChart();
        chargerPieChart();
        chargerLineChart();
        chargerKPIs();
    }

    // ── Static method to open as standalone window ──

    public static void ouvrirFenetre(int idUtilisateur) {
        try {
            FXMLLoader loader = new FXMLLoader(
                    Statistiquescontroller.class.getResource("/fxml/tests/statistiques.fxml"));
            Parent root = loader.load();

            Statistiquescontroller ctrl = loader.getController();
            ctrl.setIdUtilisateur(idUtilisateur);

            Stage stage = new Stage();
            stage.setTitle("📊 Statistiques des Tests");
            stage.setScene(new Scene(root, 900, 700));
            stage.setMinWidth(800);
            stage.setMinHeight(600);
            stage.show();
        } catch (Exception e) {
            System.err.println("❌ Erreur ouverture statistiques: " + e.getMessage());
            e.printStackTrace();
        }
    }

    // ── BarChart ──

    private void chargerBarChart() {
        barChart.getData().clear();
        barChart.setTitle(isTherapist ? "Tous les tests passés par catégorie" : "Tests passés par catégorie");
        barChart.setLegendVisible(false);

        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sql;
            PreparedStatement ps;

            if (isTherapist) {
                sql = """
                          SELECT tt.libelle, COUNT(r.id_resultat) as nb
                          FROM type_test tt
                          LEFT JOIN test_psychologique tp ON tt.id_type = tp.id_type
                          LEFT JOIN resultat r ON tp.id_test = r.id_test
                          GROUP BY tt.libelle ORDER BY nb DESC
                        """;
                ps = cnx.prepareStatement(sql);
            } else {
                sql = """
                          SELECT tt.libelle, COUNT(r.id_resultat) as nb
                          FROM type_test tt
                          LEFT JOIN test_psychologique tp ON tt.id_type = tp.id_type
                          LEFT JOIN resultat r ON tp.id_test = r.id_test AND r.id_utilisateur = ?
                          GROUP BY tt.libelle ORDER BY nb DESC
                        """;
                ps = cnx.prepareStatement(sql);
                ps.setInt(1, idUtilisateur);
            }

            ResultSet rs = ps.executeQuery();

            XYChart.Series<String, Number> serie = new XYChart.Series<>();
            serie.setName("Passages");
            while (rs.next()) {
                String type = rs.getString("libelle");
                String label = type.length() > 18 ? type.substring(0, 15) + "…" : type;
                serie.getData().add(new XYChart.Data<>(label, rs.getInt("nb")));
            }
            barChart.getData().add(serie);

            serie.getData().forEach(d -> {
                if (d.getNode() != null)
                    d.getNode().setStyle("-fx-bar-fill: -it-primary;");
            });
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // ── PieChart ──

    private void chargerPieChart() {
        pieChart.getData().clear();
        pieChart.setTitle("Répartition des niveaux");

        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sql;
            PreparedStatement ps;

            if (isTherapist) {
                sql = """
                            SELECT
                                CASE
                                    WHEN LOWER(resultat) LIKE '%critique%' THEN 'Critique 🔴'
                                    WHEN LOWER(resultat) LIKE '%élevé%'   THEN 'Élevé 🟠'
                                    WHEN LOWER(resultat) LIKE '%modér%'   THEN 'Modéré 🟡'
                                    WHEN LOWER(resultat) LIKE '%faible%'  THEN 'Faible 🟢'
                                    ELSE 'Autre ⚪'
                                END AS niveau_cat,
                                COUNT(*) as nb
                            FROM resultat
                            GROUP BY niveau_cat ORDER BY nb DESC
                        """;
                ps = cnx.prepareStatement(sql);
            } else {
                sql = """
                            SELECT
                                CASE
                                    WHEN LOWER(resultat) LIKE '%critique%' THEN 'Critique 🔴'
                                    WHEN LOWER(resultat) LIKE '%élevé%'   THEN 'Élevé 🟠'
                                    WHEN LOWER(resultat) LIKE '%modér%'   THEN 'Modéré 🟡'
                                    WHEN LOWER(resultat) LIKE '%faible%'  THEN 'Faible 🟢'
                                    ELSE 'Autre ⚪'
                                END AS niveau_cat,
                                COUNT(*) as nb
                            FROM resultat WHERE id_utilisateur = ?
                            GROUP BY niveau_cat ORDER BY nb DESC
                        """;
                ps = cnx.prepareStatement(sql);
                ps.setInt(1, idUtilisateur);
            }
            ResultSet rs = ps.executeQuery();

            Map<String, String> couleurs = Map.of(
                    "Critique 🔴", "#e53e3e", "Élevé 🟠", "#ed8936",
                    "Modéré 🟡", "#ecc94b", "Faible 🟢", "#48bb78", "Autre ⚪", "#a0aec0");

            boolean hasData = false;
            while (rs.next()) {
                String niveau = rs.getString("niveau_cat");
                int nb = rs.getInt("nb");
                if (nb > 0) {
                    pieChart.getData().add(new PieChart.Data(niveau + " (" + nb + ")", nb));
                    hasData = true;
                }
            }
            if (!hasData)
                pieChart.getData().add(new PieChart.Data("Aucun résultat", 1));

            javafx.application.Platform.runLater(() -> {
                pieChart.getData().forEach(d -> {
                    String key = d.getName().split(" \\(")[0];
                    String c = couleurs.getOrDefault(key, "-it-primary");
                    if (d.getNode() != null)
                        d.getNode().setStyle("-fx-pie-color: " + c + ";");
                });
            });
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // ── LineChart ──

    private void chargerLineChart() {
        lineChart.getData().clear();
        lineChart.setTitle("Évolution des scores");
        lineChart.setCreateSymbols(true);

        try {
            Connection cnx = DBConnection.getInstance().getConnection();
            String sqlTests;
            PreparedStatement psTests;

            if (isTherapist) {
                sqlTests = """
                            SELECT tp.id_test, tp.titre, COUNT(*) as nb
                            FROM resultat r JOIN test_psychologique tp ON r.id_test = tp.id_test
                            GROUP BY tp.id_test, tp.titre ORDER BY nb DESC LIMIT 4
                        """;
                psTests = cnx.prepareStatement(sqlTests);
            } else {
                sqlTests = """
                            SELECT tp.id_test, tp.titre, COUNT(*) as nb
                            FROM resultat r JOIN test_psychologique tp ON r.id_test = tp.id_test
                            WHERE r.id_utilisateur = ?
                            GROUP BY tp.id_test, tp.titre ORDER BY nb DESC LIMIT 4
                        """;
                psTests = cnx.prepareStatement(sqlTests);
                psTests.setInt(1, idUtilisateur);
            }

            ResultSet rsTests = psTests.executeQuery();
            String[] couleurs = { "-it-primary", "#e53e3e", "#48bb78", "#ed8936" };
            int idx = 0;

            while (rsTests.next()) {
                int idTest = rsTests.getInt("id_test");
                String titre = rsTests.getString("titre");
                titre = titre.length() > 20 ? titre.substring(0, 17) + "…" : titre;

                XYChart.Series<String, Number> serie = new XYChart.Series<>();
                serie.setName(titre);

                String sqlPts;
                PreparedStatement psPts;

                if (isTherapist) {
                    sqlPts = """
                                SELECT DATE_FORMAT(date_passage, '%d/%m') as dt, AVG(pourcentage) as pourcentage
                                FROM resultat WHERE id_test = ?
                                GROUP BY DATE_FORMAT(date_passage, '%d/%m')
                                ORDER BY dt LIMIT 10
                            """;
                    psPts = cnx.prepareStatement(sqlPts);
                    psPts.setInt(1, idTest);
                } else {
                    sqlPts = """
                                SELECT DATE_FORMAT(date_passage, '%d/%m') as dt, pourcentage
                                FROM resultat WHERE id_utilisateur = ? AND id_test = ?
                                ORDER BY date_passage LIMIT 10
                            """;
                    psPts = cnx.prepareStatement(sqlPts);
                    psPts.setInt(1, idUtilisateur);
                    psPts.setInt(2, idTest);
                }

                ResultSet rsPts = psPts.executeQuery();

                while (rsPts.next()) {
                    serie.getData().add(new XYChart.Data<>(rsPts.getString("dt"), rsPts.getDouble("pourcentage")));
                }
                lineChart.getData().add(serie);

                final String c = couleurs[idx % couleurs.length];
                javafx.application.Platform.runLater(() -> {
                    if (serie.getNode() != null)
                        serie.getNode().setStyle("-fx-stroke: " + c + "; -fx-stroke-width: 2.5px;");
                });
                idx++;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // ── KPIs ──

    private void chargerKPIs() {
        try {
            Connection cnx = DBConnection.getInstance().getConnection();

            PreparedStatement ps1, ps2, ps3;

            if (isTherapist) {
                ps1 = cnx.prepareStatement("SELECT COUNT(DISTINCT id_utilisateur) FROM resultat");
                ps2 = cnx.prepareStatement("SELECT AVG(pourcentage) FROM resultat");
                ps3 = cnx.prepareStatement("""
                            SELECT tp.titre, COUNT(DISTINCT r.id_utilisateur) as nb FROM resultat r
                            JOIN test_psychologique tp ON r.id_test = tp.id_test
                            GROUP BY tp.titre ORDER BY nb DESC LIMIT 1
                        """);
            } else {
                ps1 = cnx.prepareStatement("SELECT COUNT(*) FROM resultat WHERE id_utilisateur = ?");
                ps1.setInt(1, idUtilisateur);

                ps2 = cnx.prepareStatement("SELECT AVG(pourcentage) FROM resultat WHERE id_utilisateur = ?");
                ps2.setInt(1, idUtilisateur);

                ps3 = cnx.prepareStatement("""
                            SELECT tp.titre, COUNT(*) as nb FROM resultat r
                            JOIN test_psychologique tp ON r.id_test = tp.id_test
                            WHERE r.id_utilisateur = ? GROUP BY tp.titre ORDER BY nb DESC LIMIT 1
                        """);
                ps3.setInt(1, idUtilisateur);
            }

            ResultSet rs1 = ps1.executeQuery();
            if (rs1.next())
                totalPassesLabel.setText(rs1.getInt(1) + (isTherapist ? " utilisateurs uniques" : " tests passés"));

            ResultSet rs2 = ps2.executeQuery();
            if (rs2.next())
                scoreMoyenLabel.setText(String.format("Score moyen : %.1f%%", rs2.getDouble(1)));

            ResultSet rs3 = ps3.executeQuery();
            if (rs3.next())
                testFavoriLabel.setText("Test favori : " + rs3.getString("titre"));
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @FXML
    private void fermer() {
        Stage stage = (Stage) barChart.getScene().getWindow();
        stage.close();
    }
}
