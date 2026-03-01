package com.innertrack.service;

import com.innertrack.model.TypeEvent;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class TypeEventService {

    private final Connection connection;

    public TypeEventService() {
        connection = DBConnection.getInstance().getConnection();
    }

    public void ajouter(TypeEvent t) throws SQLException {
        String sql = "INSERT INTO type_event(libelle) VALUES (?)";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setString(1, t.getLibelle().trim());
            ps.executeUpdate();
        }
    }

    public void modifier(TypeEvent t) throws SQLException {
        String sql = "UPDATE type_event SET libelle=? WHERE id_type_event=?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setString(1, t.getLibelle().trim());
            ps.setInt(2, t.getIdTypeEvent());
            ps.executeUpdate();
        }
    }

    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM type_event WHERE id_type_event=?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    public List<TypeEvent> recuperer() throws SQLException {
        String sql = "SELECT id_type_event, libelle FROM type_event ORDER BY libelle";
        List<TypeEvent> list = new ArrayList<>();
        try (Statement st = connection.createStatement();
             ResultSet rs = st.executeQuery(sql)) {

            while (rs.next()) {
                list.add(new TypeEvent(
                        rs.getInt("id_type_event"),
                        rs.getString("libelle")
                ));
            }
        }
        return list;
    }

    public TypeEvent findById(int id) throws SQLException {
        String sql = "SELECT id_type_event, libelle FROM type_event WHERE id_type_event=?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return new TypeEvent(rs.getInt("id_type_event"), rs.getString("libelle"));
                }
            }
        }
        return null;
    }
}