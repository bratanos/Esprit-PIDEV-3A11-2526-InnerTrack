package com.innertrack.service;

import com.innertrack.model.EntreeJournal;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class JournalService implements ICrudService<EntreeJournal> {
    private Connection connection;

    public JournalService() {
        connection = DBConnection.getInstance().getConnection();
    }

    @Override
    public void create(EntreeJournal entree) throws SQLException {
        String sql = "INSERT INTO journal_emotionnel (humeur, note_textuelle, date_saisie, id) VALUES (?, ?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, entree.getHumeur());
            ps.setString(2, entree.getNoteTextuelle());
            ps.setDate(3, Date.valueOf(entree.getDateSaisie()));
            ps.setInt(4, entree.getIdUser());
            ps.executeUpdate();
        }
    }

    @Override
    public EntreeJournal read(int id) throws SQLException {
        String sql = "SELECT * FROM journal_emotionnel WHERE id_journal = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return mapRow(rs);
                }
            }
        }
        return null;
    }

    @Override
    public void update(EntreeJournal entree) throws SQLException {
        String sql = "UPDATE journal_emotionnel SET humeur = ?, note_textuelle = ?, date_saisie = ? WHERE id_journal = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, entree.getHumeur());
            ps.setString(2, entree.getNoteTextuelle());
            ps.setDate(3, Date.valueOf(entree.getDateSaisie()));
            ps.setInt(4, entree.getIdJournal());
            ps.executeUpdate();
        }
    }

    @Override
    public void delete(int id) throws SQLException {
        String sql = "DELETE FROM journal_emotionnel WHERE id_journal = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    @Override
    public List<EntreeJournal> findAll() throws SQLException {
        String sql = "SELECT * FROM journal_emotionnel";
        List<EntreeJournal> entrees = new ArrayList<>();
        try (Statement st = connection.createStatement();
                ResultSet rs = st.executeQuery(sql)) {
            while (rs.next()) {
                entrees.add(mapRow(rs));
            }
        }
        return entrees;
    }

    /** Returns only journal entries belonging to the specified user */
    public List<EntreeJournal> findByUserId(int userId) throws SQLException {
        String sql = "SELECT * FROM journal_emotionnel WHERE id = ? ORDER BY date_saisie DESC";
        List<EntreeJournal> entrees = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, userId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    entrees.add(mapRow(rs));
                }
            }
        }
        return entrees;
    }

    /** Search journal entries by keyword, scoped to a user */
    public List<EntreeJournal> search(String keyword, int userId) throws SQLException {
        String sql = "SELECT * FROM journal_emotionnel WHERE id = ? AND (note_textuelle LIKE ? OR CAST(humeur AS CHAR) LIKE ?) ORDER BY date_saisie DESC";
        List<EntreeJournal> entrees = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            String pattern = "%" + keyword + "%";
            ps.setInt(1, userId);
            ps.setString(2, pattern);
            ps.setString(3, pattern);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                entrees.add(mapRow(rs));
            }
        }
        return entrees;
    }

    /** Unscoped search (kept for backward compat) */
    public List<EntreeJournal> search(String keyword) throws SQLException {
        String sql = "SELECT * FROM journal_emotionnel WHERE note_textuelle LIKE ? OR CAST(humeur AS CHAR) LIKE ?";
        List<EntreeJournal> entrees = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            String pattern = "%" + keyword + "%";
            ps.setString(1, pattern);
            ps.setString(2, pattern);
            ResultSet rs = ps.executeQuery();
            while (rs.next()) {
                entrees.add(mapRow(rs));
            }
        }
        return entrees;
    }

    private EntreeJournal mapRow(ResultSet rs) throws SQLException {
        return new EntreeJournal(
                rs.getInt("id_journal"),
                rs.getInt("humeur"),
                rs.getString("note_textuelle"),
                rs.getDate("date_saisie").toLocalDate(),
                rs.getInt("id"));
    }
}
