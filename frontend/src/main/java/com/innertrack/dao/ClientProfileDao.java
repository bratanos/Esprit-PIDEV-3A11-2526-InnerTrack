package com.innertrack.dao;

import com.innertrack.model.ClientProfile;
import com.innertrack.util.DBConnection;

import java.sql.*;

public class ClientProfileDao {
    private final Connection connection;

    public ClientProfileDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(ClientProfile profile) {
        String sql = "INSERT INTO client_profile (user_id, date_of_birth, bio) VALUES (?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, profile.getUserId());
            stmt.setObject(2, profile.getDateOfBirth() != null
                    ? Date.valueOf(profile.getDateOfBirth()) : null);
            stmt.setString(3, profile.getBio());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) profile.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("ClientProfileDao.create error: " + e.getMessage());
        }
        return false;
    }

    public ClientProfile findByUserId(int userId) {
        String sql = "SELECT * FROM client_profile WHERE user_id = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("ClientProfileDao.findByUserId error: " + e.getMessage());
        }
        return null;
    }

    public boolean update(ClientProfile profile) {
        String sql = "UPDATE client_profile SET date_of_birth=?, bio=? WHERE user_id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setObject(1, profile.getDateOfBirth() != null
                    ? Date.valueOf(profile.getDateOfBirth()) : null);
            stmt.setString(2, profile.getBio());
            stmt.setInt(3, profile.getUserId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ClientProfileDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int userId) {
        String sql = "DELETE FROM client_profile WHERE user_id = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ClientProfileDao.delete error: " + e.getMessage());
        }
        return false;
    }

    private ClientProfile map(ResultSet rs) throws SQLException {
        ClientProfile p = new ClientProfile();
        p.setId(rs.getInt("id"));
        p.setUserId(rs.getInt("user_id"));
        Date dob = rs.getDate("date_of_birth");
        if (dob != null) p.setDateOfBirth(dob.toLocalDate());
        p.setBio(rs.getString("bio"));
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null) p.setCreatedAt(ts.toLocalDateTime());
        return p;
    }
}