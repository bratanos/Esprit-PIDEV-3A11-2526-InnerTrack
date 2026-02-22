package com.innertrack.dao;

import com.innertrack.model.JournalEntry;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class JournalDao {
    private final Connection connection;

    public JournalDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(JournalEntry entry) {
        String sql = "INSERT INTO journal_emotionnel (humeur, note_textuelle, date_saisie, id) VALUES (?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, entry.getHumeur());
            stmt.setString(2, entry.getNoteTextuelle());
            stmt.setDate(3, Date.valueOf(entry.getDateSaisie()));
            stmt.setInt(4, entry.getUserId());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) entry.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("JournalDao.create error: " + e.getMessage());
        }
        return false;
    }

    public JournalEntry findById(int id) {
        String sql = "SELECT * FROM journal_emotionnel WHERE id_journal = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("JournalDao.findById error: " + e.getMessage());
        }
        return null;
    }

    public List<JournalEntry> findByUserId(int userId) {
        List<JournalEntry> entries = new ArrayList<>();
        String sql = "SELECT * FROM journal_emotionnel WHERE id = ? ORDER BY date_saisie DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) entries.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("JournalDao.findByUserId error: " + e.getMessage());
        }
        return entries;
    }

    public boolean update(JournalEntry entry) {
        String sql = "UPDATE journal_emotionnel SET humeur=?, note_textuelle=?, date_saisie=? WHERE id_journal=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, entry.getHumeur());
            stmt.setString(2, entry.getNoteTextuelle());
            stmt.setDate(3, Date.valueOf(entry.getDateSaisie()));
            stmt.setInt(4, entry.getId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("JournalDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM journal_emotionnel WHERE id_journal = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("JournalDao.delete error: " + e.getMessage());
        }
        return false;
    }

    private JournalEntry map(ResultSet rs) throws SQLException {
        JournalEntry e = new JournalEntry();
        e.setId(rs.getInt("id_journal"));
        e.setUserId(rs.getInt("id"));
        e.setHumeur(rs.getInt("humeur"));
        e.setNoteTextuelle(rs.getString("note_textuelle"));
        e.setDateSaisie(rs.getDate("date_saisie").toLocalDate());
        return e;
    }
}