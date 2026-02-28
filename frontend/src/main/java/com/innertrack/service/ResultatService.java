package com.innertrack.service;

import com.innertrack.model.Resultat;
import com.innertrack.model.TrancheResultat;
import com.innertrack.util.DBConnection;
import java.sql.*;

public class ResultatService {

    /**
     * Calculate and save a user's result for a test.
     */
    public Resultat calculerEtEnregistrer(int idUtilisateur, int idTest) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();

        // 1. Calculate obtained score
        int scoreObtenu = calculerScore(cnx, idUtilisateur, idTest);

        // 2. Calculate max possible score
        int scoreMax = calculerScoreMax(cnx, idTest);

        // 3. Find matching interpretation
        TrancheResultat tranche = trouverTranche(cnx, idTest, scoreObtenu);

        // 4. Save the result
        Resultat resultat = new Resultat();
        resultat.setIdTest(idTest);
        resultat.setIdUtilisateur(idUtilisateur);
        resultat.setScoreTotal(scoreObtenu);
        resultat.setScoreMaxPossible(scoreMax);
        resultat.setPourcentage(scoreMax > 0 ? (scoreObtenu * 100.0 / scoreMax) : 0);
        resultat.setResultat(tranche != null ? tranche.getLibelle() : "Non défini");
        resultat.setInterpretation(tranche != null ? tranche.getInterpretation() : "");

        enregistrerResultat(cnx, resultat);
        return resultat;
    }

    private int calculerScore(Connection cnx, int idUtilisateur, int idTest) throws SQLException {
        String sql = """
                    SELECT COALESCE(SUM(r.points), 0) AS score
                    FROM reponse_utilisateur ru
                    JOIN reponse r ON ru.id_reponse = r.id_reponse
                    JOIN question q ON ru.id_question = q.id_question
                    WHERE ru.id_utilisateur = ? AND q.id_test = ?
                """;
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUtilisateur);
        ps.setInt(2, idTest);
        ResultSet rs = ps.executeQuery();
        return rs.next() ? rs.getInt("score") : 0;
    }

    private int calculerScoreMax(Connection cnx, int idTest) throws SQLException {
        String sql = """
                    SELECT COALESCE(SUM(max_pts), 0) AS score_max
                    FROM (
                        SELECT q.id_question, MAX(r.points) AS max_pts
                        FROM question q
                        JOIN reponse r ON r.id_question = q.id_question
                        WHERE q.id_test = ?
                        GROUP BY q.id_question
                    ) sub
                """;
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idTest);
        ResultSet rs = ps.executeQuery();
        return rs.next() ? rs.getInt("score_max") : 0;
    }

    private TrancheResultat trouverTranche(Connection cnx, int idTest, int score) throws SQLException {
        String sql = """
                    SELECT * FROM tranche_resultat
                    WHERE id_test = ? AND ? BETWEEN score_min AND score_max
                    LIMIT 1
                """;
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idTest);
        ps.setInt(2, score);
        ResultSet rs = ps.executeQuery();
        if (rs.next()) {
            TrancheResultat t = new TrancheResultat();
            t.setLibelle(rs.getString("libelle"));
            t.setInterpretation(rs.getString("interpretation"));
            t.setNiveau(rs.getString("niveau"));
            return t;
        }
        return null;
    }

    private void enregistrerResultat(Connection cnx, Resultat r) throws SQLException {
        String sql = """
                    INSERT INTO resultat
                    (id_test, id_utilisateur, score_total, score_max_possible, pourcentage, resultat, interpretation)
                    VALUES (?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                    score_total = VALUES(score_total),
                    resultat = VALUES(resultat),
                    interpretation = VALUES(interpretation)
                """;
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, r.getIdTest());
        ps.setInt(2, r.getIdUtilisateur());
        ps.setInt(3, r.getScoreTotal());
        ps.setInt(4, r.getScoreMaxPossible());
        ps.setDouble(5, r.getPourcentage());
        ps.setString(6, r.getResultat());
        ps.setString(7, r.getInterpretation());
        ps.executeUpdate();
    }

    public void supprimerReponsesUtilisateurPourTest(int idTest, int idUtilisateur) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        String sql = "DELETE FROM reponse_utilisateur WHERE id_utilisateur = ? AND id_question IN (SELECT id_question FROM question WHERE id_test = ?)";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUtilisateur);
        ps.setInt(2, idTest);
        ps.executeUpdate();
    }

    public Resultat recupererParUtilisateurEtTest(int idUtilisateur, int idTest) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        String sql = "SELECT * FROM resultat WHERE id_utilisateur = ? AND id_test = ?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUtilisateur);
        ps.setInt(2, idTest);
        ResultSet rs = ps.executeQuery();
        if (rs.next()) {
            Resultat r = new Resultat();
            r.setIdResultat(rs.getInt("id_resultat"));
            r.setIdTest(rs.getInt("id_test"));
            r.setIdUtilisateur(rs.getInt("id_utilisateur"));
            r.setScoreTotal(rs.getInt("score_total"));
            r.setScoreMaxPossible(rs.getInt("score_max_possible"));
            r.setPourcentage(rs.getDouble("pourcentage"));
            r.setResultat(rs.getString("resultat"));
            r.setInterpretation(rs.getString("interpretation"));
            r.setDatePassage(rs.getTimestamp("date_passage"));
            return r;
        }
        return null;
    }
}
