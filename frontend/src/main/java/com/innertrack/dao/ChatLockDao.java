package com.innertrack.dao;

import com.innertrack.model.ChatLock;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.List;

public class ChatLockDao {
    private final Connection connection = DBConnection.getInstance().getConnection();

    /**
     * Lock a user's community posting for a given duration (or permanently if until
     * is null).
     */
    public boolean lockUser(int userId, String reason, LocalDateTime until, int adminId) {
        String sql = "INSERT INTO chat_lock (user_id, reason, locked_until, locked_by) VALUES (?, ?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, userId);
            ps.setString(2, reason);
            if (until != null) {
                ps.setTimestamp(3, Timestamp.valueOf(until));
            } else {
                ps.setNull(3, Types.TIMESTAMP);
            }
            ps.setInt(4, adminId);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ChatLockDao.lockUser: " + e.getMessage());
        }
        return false;
    }

    /**
     * Manually unlock a user (admin action).
     */
    public boolean unlockUser(int lockId) {
        String sql = "UPDATE chat_lock SET is_active = 0 WHERE id = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, lockId);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ChatLockDao.unlockUser: " + e.getMessage());
        }
        return false;
    }

    /**
     * Get the active lock for a user. Auto-deactivates expired locks.
     * Returns null if user is not locked.
     */
    public ChatLock getActiveLock(int userId) {
        String sql = "SELECT * FROM chat_lock WHERE user_id = ? AND is_active = 1 ORDER BY locked_at DESC LIMIT 1";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, userId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    ChatLock lock = map(rs);
                    if (lock.isExpired()) {
                        // Auto-deactivate expired lock
                        unlockUser(lock.getId());
                        return null;
                    }
                    return lock;
                }
            }
        } catch (SQLException e) {
            System.err.println("ChatLockDao.getActiveLock: " + e.getMessage());
        }
        return null;
    }

    /**
     * Get all active locks (for admin panel).
     */
    public List<ChatLock> getAllActiveLocks() {
        String sql = """
                SELECT cl.*, CONCAT(u.first_name, ' ', u.last_name) AS user_name
                FROM chat_lock cl
                JOIN user u ON cl.user_id = u.id
                WHERE cl.is_active = 1
                ORDER BY cl.locked_at DESC
                """;
        List<ChatLock> list = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    ChatLock lock = map(rs);
                    try {
                        lock.setUserName(rs.getString("user_name"));
                    } catch (SQLException ignored) {
                    }
                    // Auto-deactivate expired
                    if (lock.isExpired()) {
                        unlockUser(lock.getId());
                    } else {
                        list.add(lock);
                    }
                }
            }
        } catch (SQLException e) {
            System.err.println("ChatLockDao.getAllActiveLocks: " + e.getMessage());
        }
        return list;
    }

    private ChatLock map(ResultSet rs) throws SQLException {
        ChatLock lock = new ChatLock();
        lock.setId(rs.getInt("id"));
        lock.setUserId(rs.getInt("user_id"));
        lock.setReason(rs.getString("reason"));
        Timestamp la = rs.getTimestamp("locked_at");
        if (la != null)
            lock.setLockedAt(la.toLocalDateTime());
        Timestamp lu = rs.getTimestamp("locked_until");
        if (lu != null)
            lock.setLockedUntil(lu.toLocalDateTime());
        lock.setLockedBy(rs.getInt("locked_by"));
        lock.setActive(rs.getBoolean("is_active"));
        return lock;
    }
}
