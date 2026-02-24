package com.innertrack.dao;

import com.innertrack.model.TherapistProfile;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class TherapistProfileDao {
    private final Connection connection;

    public TherapistProfileDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(TherapistProfile p) {
        String sql = "INSERT INTO therapist_profile (user_id, specialization, license_number, bio, address, latitude, longitude, phone, session_rate, available_days) VALUES (?,?,?,?,?,?,?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, p.getUserId());
            stmt.setString(2, p.getSpecialization());
            stmt.setString(3, p.getLicenseNumber());
            stmt.setString(4, p.getBio());
            stmt.setString(5, p.getAddress());
            setNullableDouble(stmt, 6, p.getLatitude());
            setNullableDouble(stmt, 7, p.getLongitude());
            stmt.setString(8, p.getPhone());
            setNullableInt(stmt, 9, p.getSessionRate());
            stmt.setString(10, p.getAvailableDays());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) p.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.create: " + e.getMessage());
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
            System.err.println("TherapistProfileDao.findByUserId: " + e.getMessage());
        }
        return null;
    }

    /** All therapists with a set location — used by client map view */
    public List<TherapistProfile> findAllWithLocation() {
        List<TherapistProfile> list = new ArrayList<>();
        String sql = "SELECT * FROM therapist_profile WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            while (rs.next()) list.add(map(rs));
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.findAllWithLocation: " + e.getMessage());
        }
        return list;
    }

    public boolean update(TherapistProfile p) {
        String sql = "UPDATE therapist_profile SET specialization=?, license_number=?, bio=?, address=?, latitude=?, longitude=?, phone=?, session_rate=?, available_days=? WHERE user_id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, p.getSpecialization());
            stmt.setString(2, p.getLicenseNumber());
            stmt.setString(3, p.getBio());
            stmt.setString(4, p.getAddress());
            setNullableDouble(stmt, 5, p.getLatitude());
            setNullableDouble(stmt, 6, p.getLongitude());
            stmt.setString(7, p.getPhone());
            setNullableInt(stmt, 8, p.getSessionRate());
            stmt.setString(9, p.getAvailableDays());
            stmt.setInt(10, p.getUserId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("TherapistProfileDao.update: " + e.getMessage());
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
        p.setAddress(rs.getString("address"));
        double lat = rs.getDouble("latitude");
        if (!rs.wasNull()) p.setLatitude(lat);
        double lng = rs.getDouble("longitude");
        if (!rs.wasNull()) p.setLongitude(lng);
        p.setPhone(rs.getString("phone"));
        int rate = rs.getInt("session_rate");
        if (!rs.wasNull()) p.setSessionRate(rate);
        p.setAvailableDays(rs.getString("available_days"));
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null) p.setCreatedAt(ts.toLocalDateTime());
        return p;
    }

    private void setNullableDouble(PreparedStatement s, int i, Double v) throws SQLException {
        if (v != null) s.setDouble(i, v); else s.setNull(i, Types.DOUBLE);
    }

    private void setNullableInt(PreparedStatement s, int i, Integer v) throws SQLException {
        if (v != null) s.setInt(i, v); else s.setNull(i, Types.INTEGER);
    }
}