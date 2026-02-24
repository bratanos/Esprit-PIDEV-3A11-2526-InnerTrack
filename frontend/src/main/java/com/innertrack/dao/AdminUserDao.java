package com.innertrack.dao;

import com.innertrack.model.User;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

/**
 * Admin-specific queries — never expose this to non-admin controllers.
 */
public class AdminUserDao {

    private final Connection connection;

    public AdminUserDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    // ── ANALYTICS ────────────────────────────────────────────

    public int countAll() {
        return countWhere("1=1");
    }

    public int countByRole(String role) {
        // roles column stores JSON: ["ROLE_USER"] etc.
        return countWhere("roles LIKE '%" + role + "%'");
    }

    public int countByStatus(String status) {
        return countWhere("status = '" + status + "'");
    }

    public int countNewThisMonth() {
        return countWhere("MONTH(created_at) = MONTH(NOW()) AND YEAR(created_at) = YEAR(NOW())");
    }

    private int countWhere(String condition) {
        String sql = "SELECT COUNT(*) FROM user WHERE " + condition;
        try (PreparedStatement stmt = connection.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) {
            System.err.println("AdminUserDao.countWhere: " + e.getMessage());
        }
        return 0;
    }

    /** Registrations per month for the last 6 months — for the bar chart */
    public Map<String, Integer> registrationsPerMonth() {
        Map<String, Integer> result = new LinkedHashMap<>();
        String sql = "SELECT DATE_FORMAT(created_at, '%b %Y') AS month, COUNT(*) AS cnt " +
                "FROM user " +
                "WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH) " +
                "GROUP BY YEAR(created_at), MONTH(created_at) " +
                "ORDER BY YEAR(created_at), MONTH(created_at)";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            while (rs.next()) {
                result.put(rs.getString("month"), rs.getInt("cnt"));
            }
        } catch (SQLException e) {
            System.err.println("AdminUserDao.registrationsPerMonth: " + e.getMessage());
        }
        return result;
    }

    // ── USER MANAGEMENT ───────────────────────────────────────

    /**
     * Search and filter users with pagination.
     *
     * @param search     name/email search term (null = no filter)
     * @param roleFilter e.g. "ROLE_USER", "ROLE_PSYCHOLOGUE", "ROLE_ADMIN" (null = all)
     * @param statusFilter e.g. "ACTIVE", "PENDING", "BLOCKED" (null = all)
     * @param page       0-indexed
     * @param pageSize   rows per page
     */
    public List<User> searchUsers(String search, String roleFilter,
                                  String statusFilter, int page, int pageSize) {
        List<User> list = new ArrayList<>();
        StringBuilder sql = new StringBuilder(
                "SELECT * FROM user WHERE 1=1");

        List<Object> params = new ArrayList<>();

        if (search != null && !search.isBlank()) {
            sql.append(" AND (LOWER(email) LIKE ? OR LOWER(first_name) LIKE ? OR LOWER(last_name) LIKE ?)");
            String like = "%" + search.toLowerCase() + "%";
            params.add(like); params.add(like); params.add(like);
        }
        if (roleFilter != null && !roleFilter.isBlank()) {
            sql.append(" AND roles LIKE ?");
            params.add("%" + roleFilter + "%");
        }
        if (statusFilter != null && !statusFilter.isBlank()) {
            sql.append(" AND status = ?");
            params.add(statusFilter);
        }

        sql.append(" ORDER BY created_at DESC LIMIT ? OFFSET ?");
        params.add(pageSize);
        params.add(page * pageSize);

        try (PreparedStatement stmt = connection.prepareStatement(sql.toString())) {
            for (int i = 0; i < params.size(); i++) {
                stmt.setObject(i + 1, params.get(i));
            }
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) list.add(mapUser(rs));
            }
        } catch (SQLException e) {
            System.err.println("AdminUserDao.searchUsers: " + e.getMessage());
        }
        return list;
    }

    public int countSearch(String search, String roleFilter, String statusFilter) {
        StringBuilder sql = new StringBuilder("SELECT COUNT(*) FROM user WHERE 1=1");
        List<Object> params = new ArrayList<>();

        if (search != null && !search.isBlank()) {
            sql.append(" AND (LOWER(email) LIKE ? OR LOWER(first_name) LIKE ? OR LOWER(last_name) LIKE ?)");
            String like = "%" + search.toLowerCase() + "%";
            params.add(like); params.add(like); params.add(like);
        }
        if (roleFilter != null && !roleFilter.isBlank()) {
            sql.append(" AND roles LIKE ?");
            params.add("%" + roleFilter + "%");
        }
        if (statusFilter != null && !statusFilter.isBlank()) {
            sql.append(" AND status = ?");
            params.add(statusFilter);
        }

        try (PreparedStatement stmt = connection.prepareStatement(sql.toString())) {
            for (int i = 0; i < params.size(); i++) stmt.setObject(i + 1, params.get(i));
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("AdminUserDao.countSearch: " + e.getMessage());
        }
        return 0;
    }

    public boolean setUserStatus(int userId, String status) {
        String sql = "UPDATE user SET status=? WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, status);
            stmt.setInt(2, userId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("AdminUserDao.setUserStatus: " + e.getMessage());
        }
        return false;
    }

    public boolean deleteUser(int userId) {
        String sql = "DELETE FROM user WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("AdminUserDao.deleteUser: " + e.getMessage());
        }
        return false;
    }

    // ── Mapper ────────────────────────────────────────────────

    private User mapUser(ResultSet rs) throws SQLException {
        User u = new User();
        u.setId(rs.getInt("id"));
        u.setEmail(rs.getString("email"));
        u.setFirstName(rs.getString("first_name"));
        u.setLastName(rs.getString("last_name"));
        u.setStatus(rs.getString("status"));
        u.setVerified(rs.getBoolean("is_verified"));
        u.setProfilePicture(rs.getString("profile_picture"));
        // Parse roles JSON: ["ROLE_USER"] → ["ROLE_USER"]
        String rolesJson = rs.getString("roles");
        if (rolesJson != null) {
            // Simple parse without Gson since it's always a flat string array
            List<String> roles = new ArrayList<>();
            rolesJson = rolesJson.replace("[", "").replace("]", "").replace("\"", "").trim();
            for (String r : rolesJson.split(",")) {
                if (!r.isBlank()) roles.add(r.trim());
            }
            u.setRoles(roles);
        }
        Timestamp ca = rs.getTimestamp("created_at");
        if (ca != null) u.setCreatedAt(ca.toLocalDateTime());
        Timestamp ll = rs.getTimestamp("last_login");
        if (ll != null) u.setLastLogin(ll.toLocalDateTime());
        return u;
    }
}