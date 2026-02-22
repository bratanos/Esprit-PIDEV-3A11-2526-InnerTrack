package com.innertrack.dao;

import com.innertrack.model.TherapistProfile;
import com.innertrack.util.DBConnection;

import java.sql.*;

public class TherapistProfileDao {
    private final Connection connection;

    public TherapistProfileDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(TherapistProfile profile) {
        String sql = "INSERT INTO therapist_profile (user_id, specialization, license_number, bio) VALUES (?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, profile.getUserId());
            stmt.setString(2, profile.getSpecialization());
            stmt.setString(3, profile.getLicenseNumber());
            stmt.setString(4, profile.getBio());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) profile.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.create error: " + e.getMessage());
        }
        return false;
    }

    public TherapistProfile findByUserId(int userId) {
        String sql = "SELECT * FROM therapist_profile WHERE user_id = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.findByUserId error: " + e.getMessage());
        }
        return null;
    }

    public boolean update(TherapistProfile profile) {
        String sql = "UPDATE therapist_profile SET specialization=?, license_number=?, bio=? WHERE user_id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, profile.getSpecialization());
            stmt.setString(2, profile.getLicenseNumber());
            stmt.setString(3, profile.getBio());
            stmt.setInt(4, profile.getUserId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int userId) {
        String sql = "DELETE FROM therapist_profile WHERE user_id = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.delete error: " + e.getMessage());
        }
        return false;
    }

    private TherapistProfile map(ResultSet rs) throws SQLException {
        TherapistProfile p = new TherapistProfile();
        p.setId(rs.getInt("id"));
        p.setUserId(rs.getInt("user_id"));
        p.setSpecialization(rs.getString("specialization"));
        p.setLicenseNumber(rs.getString("license_number"));
        p.setBio(rs.getString("bio"));
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null) p.setCreatedAt(ts.toLocalDateTime());
        return p;
    }
}