package com.innertrack.dao;

import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class CommunityReactionDao {
    private final Connection connection = DBConnection.getInstance().getConnection();

    /**
     * Set or update a reaction (UPSERT). Pass null reaction to remove.
     */
    public void setReaction(int userId, int commentId, String reaction) {
        String sql = "INSERT INTO community_reaction (user_id, comment_id, reaction) VALUES (?, ?, ?) " +
                "ON DUPLICATE KEY UPDATE reaction = VALUES(reaction)";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, userId);
            ps.setInt(2, commentId);
            ps.setString(3, reaction);
            ps.executeUpdate();
        } catch (SQLException e) {
            System.err.println("CommunityReactionDao.setReaction: " + e.getMessage());
        }
    }

    /**
     * Get all reactions for a comment as a list of emoji strings.
     */
    public List<String> getReactionsForComment(int commentId) {
        String sql = "SELECT reaction FROM community_reaction WHERE comment_id = ? AND reaction IS NOT NULL";
        List<String> reactions = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, commentId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next())
                    reactions.add(rs.getString("reaction"));
            }
        } catch (SQLException e) {
            System.err.println("CommunityReactionDao.getReactionsForComment: " + e.getMessage());
        }
        return reactions;
    }

    /**
     * Get reaction counts grouped by emoji for a comment.
     */
    public Map<String, Integer> getReactionCounts(int commentId) {
        String sql = "SELECT reaction, COUNT(*) AS cnt FROM community_reaction " +
                "WHERE comment_id = ? AND reaction IS NOT NULL GROUP BY reaction";
        Map<String, Integer> counts = new HashMap<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, commentId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next())
                    counts.put(rs.getString("reaction"), rs.getInt("cnt"));
            }
        } catch (SQLException e) {
            System.err.println("CommunityReactionDao.getReactionCounts: " + e.getMessage());
        }
        return counts;
    }
}
