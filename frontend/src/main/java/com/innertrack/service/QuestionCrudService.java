package com.innertrack.service;

import com.innertrack.model.Question;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class QuestionCrudService implements ITestCrudService<Question> {

    private Connection cnx;

    public QuestionCrudService() {
        cnx = DBConnection.getInstance().getConnection();
    }

    @Override
    public void ajouter(Question q) throws SQLException {
        String sql = "INSERT INTO question (id_test, contenu) VALUES (?, ?)";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, q.getIdTest());
        ps.setString(2, q.getContenu());
        ps.executeUpdate();
    }

    @Override
    public void modifier(Question q) throws SQLException {
        String sql = "UPDATE question SET contenu=? WHERE id_question=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setString(1, q.getContenu());
        ps.setInt(2, q.getIdQuestion());
        ps.executeUpdate();
    }

    @Override
    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM question WHERE id_question=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    @Override
    public List<Question> recuperer() throws SQLException {
        List<Question> list = new ArrayList<>();
        String sql = "SELECT * FROM question ORDER BY id_question";
        Statement st = cnx.createStatement();
        ResultSet rs = st.executeQuery(sql);

        while (rs.next()) {
            Question q = new Question(
                    rs.getInt("id_question"),
                    rs.getInt("id_test"),
                    rs.getString("contenu"));
            list.add(q);
        }
        return list;
    }

    // Retrieve questions for a specific test
    public List<Question> recupererParTest(int idTest) throws SQLException {
        List<Question> list = new ArrayList<>();
        String sql = "SELECT * FROM question WHERE id_test=? ORDER BY id_question";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idTest);
        ResultSet rs = ps.executeQuery();

        while (rs.next()) {
            Question q = new Question(
                    rs.getInt("id_question"),
                    rs.getInt("id_test"),
                    rs.getString("contenu"));
            list.add(q);
        }
        return list;
    }

    // Retrieve a question by ID
    public Question recupererParId(int idQuestion) throws SQLException {
        String sql = "SELECT * FROM question WHERE id_question=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idQuestion);
        ResultSet rs = ps.executeQuery();

        if (rs.next()) {
            return new Question(
                    rs.getInt("id_question"),
                    rs.getInt("id_test"),
                    rs.getString("contenu"));
        }
        return null;
    }

    // Delete all questions for a test
    public void supprimerParTest(int idTest) throws SQLException {
        String sql = "DELETE FROM question WHERE id_test=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, idTest);
        ps.executeUpdate();
    }
}
