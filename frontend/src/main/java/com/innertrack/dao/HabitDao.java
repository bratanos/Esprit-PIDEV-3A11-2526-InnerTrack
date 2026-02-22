package com.innertrack.dao;

import com.innertrack.model.HabitEntry;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class HabitDao {
    private final Connection connection;

    public HabitDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(HabitEntry entry) {
        String sql = "INSERT INTO habittracker (nom_habitude, emotion_dominantes, note_textuelle, niveau_energie, niveau_stress, qualite_sommeil, date_creation, id, id_journal) VALUES (?,?,?,?,?,?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setString(1, entry.getNomHabitude());
            stmt.setString(2, entry.getEmotionDominantes());
            stmt.setString(3, entry.getNoteTextuelle());
            stmt.setInt(4, entry.getNiveauEnergie());
            stmt.setInt(5, entry.getNiveauStress());
            stmt.setInt(6, entry.getQualiteSommeil());
            stmt.setDate(7, Date.valueOf(entry.getDateCreation()));
            stmt.setInt(8, entry.getUserId());
            if (entry.getJournalId() != null) stmt.setInt(9, entry.getJournalId());
            else stmt.setNull(9, Types.INTEGER);
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) entry.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("HabitDao.create error: " + e.getMessage());
        }
        return false;
    }

    public List<HabitEntry> findByUserId(int userId) {
        List<HabitEntry> list = new ArrayList<>();
        String sql = "SELECT * FROM habittracker WHERE id = ? ORDER BY date_creation DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("HabitDao.findByUserId error: " + e.getMessage());
        }
        return list;
    }

    public List<HabitEntry> findByUserAndDate(int userId, java.time.LocalDate date) {
        List<HabitEntry> list = new ArrayList<>();
        String sql = "SELECT * FROM habittracker WHERE id = ? AND date_creation = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            stmt.setDate(2, Date.valueOf(date));
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("HabitDao.findByUserAndDate error: " + e.getMessage());
        }
        return list;
    }

    public boolean update(HabitEntry entry) {
        String sql = "UPDATE habittracker SET nom_habitude=?, emotion_dominantes=?, note_textuelle=?, niveau_energie=?, niveau_stress=?, qualite_sommeil=? WHERE Id_Habit=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, entry.getNomHabitude());
            stmt.setString(2, entry.getEmotionDominantes());
            stmt.setString(3, entry.getNoteTextuelle());
            stmt.setInt(4, entry.getNiveauEnergie());
            stmt.setInt(5, entry.getNiveauStress());
            stmt.setInt(6, entry.getQualiteSommeil());
            stmt.setInt(7, entry.getId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("HabitDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM habittracker WHERE Id_Habit = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("HabitDao.delete error: " + e.getMessage());
        }
        return false;
    }

    private HabitEntry map(ResultSet rs) throws SQLException {
        HabitEntry h = new HabitEntry();
        h.setId(rs.getInt("Id_Habit"));
        h.setUserId(rs.getInt("id"));
        h.setNomHabitude(rs.getString("nom_habitude"));
        h.setEmotionDominantes(rs.getString("emotion_dominantes"));
        h.setNoteTextuelle(rs.getString("note_textuelle"));
        h.setNiveauEnergie(rs.getInt("niveau_energie"));
        h.setNiveauStress(rs.getInt("niveau_stress"));
        h.setQualiteSommeil(rs.getInt("qualite_sommeil"));
        h.setDateCreation(rs.getDate("date_creation").toLocalDate());
        int jid = rs.getInt("id_journal");
        if (!rs.wasNull()) h.setJournalId(jid);
        return h;
    }
}