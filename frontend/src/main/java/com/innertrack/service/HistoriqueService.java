package com.innertrack.service;

import com.innertrack.model.HistoriqueResultat;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class HistoriqueService {

    public void sauvegarder(HistoriqueResultat h) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        String sql = "INSERT INTO historique_resultat (id_user, id_test, score, pourcentage, niveau) VALUES (?, ?, ?, ?, ?)";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, h.getIdUser());
        ps.setInt(2, h.getIdTest());
        ps.setInt(3, h.getScore());
        ps.setDouble(4, h.getPourcentage());
        ps.setString(5, h.getNiveau());
        ps.executeUpdate();
    }

    public List<HistoriqueResultat> recupererPourUtilisateur(int idUser) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        List<HistoriqueResultat> list = new ArrayList<>();
        String sql = "SELECT * FROM historique_resultat WHERE id_user = ? ORDER BY date_passage DESC";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUser);
        ResultSet rs = ps.executeQuery();
        while (rs.next()) {
            HistoriqueResultat h = new HistoriqueResultat();
            h.setIdHistorique(rs.getInt("id_historique"));
            h.setIdUser(rs.getInt("id_user"));
            h.setIdTest(rs.getInt("id_test"));
            h.setScore(rs.getInt("score"));
            h.setPourcentage(rs.getDouble("pourcentage"));
            h.setNiveau(rs.getString("niveau"));
            h.setDatePassage(rs.getTimestamp("date_passage"));
            list.add(h);
        }
        return list;
    }

    public List<HistoriqueResultat> recupererPourTest(int idUser, int idTest) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        List<HistoriqueResultat> list = new ArrayList<>();
        String sql = "SELECT * FROM historique_resultat WHERE id_user = ? AND id_test = ? ORDER BY date_passage ASC";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUser);
        ps.setInt(2, idTest);
        ResultSet rs = ps.executeQuery();
        while (rs.next()) {
            HistoriqueResultat h = new HistoriqueResultat();
            h.setIdHistorique(rs.getInt("id_historique"));
            h.setIdUser(rs.getInt("id_user"));
            h.setIdTest(rs.getInt("id_test"));
            h.setScore(rs.getInt("score"));
            h.setPourcentage(rs.getDouble("pourcentage"));
            h.setNiveau(rs.getString("niveau"));
            h.setDatePassage(rs.getTimestamp("date_passage"));
            list.add(h);
        }
        return list;
    }

    public int compterRepetitions(int idUser, int idTest) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        String sql = "SELECT COUNT(*) AS nb FROM historique_resultat WHERE id_user = ? AND id_test = ?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idUser);
        ps.setInt(2, idTest);
        ResultSet rs = ps.executeQuery();
        return rs.next() ? rs.getInt("nb") : 0;
    }

    public double calculerTendance(int idUser, int idTest) throws SQLException {
        List<HistoriqueResultat> historique = recupererPourTest(idUser, idTest);
        if (historique.size() < 2)
            return 0;

        int n = historique.size();
        double sumX = 0, sumY = 0, sumXY = 0, sumX2 = 0;
        for (int i = 0; i < n; i++) {
            sumX += i;
            sumY += historique.get(i).getPourcentage();
            sumXY += i * historique.get(i).getPourcentage();
            sumX2 += i * i;
        }
        double denom = n * sumX2 - sumX * sumX;
        return denom == 0 ? 0 : (n * sumXY - sumX * sumY) / denom;
    }
}
