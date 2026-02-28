package com.innertrack.service;

import com.innertrack.model.TestPsychologique;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class TestPsychologiqueCrudService implements ITestCrudService<TestPsychologique> {

    private Connection cnx;

    public TestPsychologiqueCrudService() {
        cnx = DBConnection.getInstance().getConnection();
    }

    // CREATE
    @Override
    public void ajouter(TestPsychologique t) throws SQLException {
        String sql = "INSERT INTO test_psychologique (titre, id_type, description, nombre_questions) VALUES (?, ?, ?, ?)";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setString(1, t.getTitre());
        ps.setInt(2, t.getIdType());
        ps.setString(3, t.getDescription());
        ps.setInt(4, t.getNombreQuestions());
        ps.executeUpdate();
    }

    // UPDATE
    @Override
    public void modifier(TestPsychologique t) throws SQLException {
        String sql = "UPDATE test_psychologique SET titre=?, id_type=?, description=?, nombre_questions=? WHERE id_test=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setString(1, t.getTitre());
        ps.setInt(2, t.getIdType());
        ps.setString(3, t.getDescription());
        ps.setInt(4, t.getNombreQuestions());
        ps.setInt(5, t.getIdTest());
        ps.executeUpdate();
    }

    // DELETE
    @Override
    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM test_psychologique WHERE id_test=?";
        PreparedStatement ps = cnx.prepareStatement(sql);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    // READ ALL
    @Override
    public List<TestPsychologique> recuperer() throws SQLException {
        List<TestPsychologique> list = new ArrayList<>();
        String sql = "SELECT * FROM test_psychologique";
        Statement st = cnx.createStatement();
        ResultSet rs = st.executeQuery(sql);

        while (rs.next()) {
            TestPsychologique t = new TestPsychologique(
                    rs.getInt("id_test"),
                    rs.getString("titre"),
                    rs.getInt("id_type"),
                    rs.getString("description"),
                    rs.getInt("nombre_questions"));
            list.add(t);
        }
        return list;
    }
}
