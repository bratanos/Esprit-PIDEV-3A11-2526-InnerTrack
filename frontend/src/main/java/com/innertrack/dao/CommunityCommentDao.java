package com.innertrack.dao;

import com.innertrack.model.CommunityComment;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CommunityCommentDao {
    private final Connection connection = DBConnection.getInstance().getConnection();

    /**
     * Get all root (top-level) comments with author info and current user's
     * reaction.
     */
    public List<CommunityComment> getRootComments(int currentUserId) {
        String sql = """
                SELECT c.*,
                       CONCAT(u.first_name, ' ', u.last_name) AS author_name,
                       u.roles AS author_role,
                       u.profile_picture AS author_pic,
                       cr.reaction AS current_reaction
                FROM community_comment c
                JOIN user u ON c.user_id = u.id
                LEFT JOIN community_reaction cr ON cr.comment_id = c.id AND cr.user_id = ?
                WHERE c.parent_id IS NULL
                ORDER BY c.created_at DESC
                """;
        List<CommunityComment> list = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, currentUserId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next())
                    list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.getRootComments: " + e.getMessage());
        }
        return list;
    }

    /**
     * Get replies for a given parent comment.
     */
    public List<CommunityComment> getReplies(int parentId, int currentUserId) {
        String sql = """
                SELECT c.*,
                       CONCAT(u.first_name, ' ', u.last_name) AS author_name,
                       u.roles AS author_role,
                       u.profile_picture AS author_pic,
                       cr.reaction AS current_reaction
                FROM community_comment c
                JOIN user u ON c.user_id = u.id
                LEFT JOIN community_reaction cr ON cr.comment_id = c.id AND cr.user_id = ?
                WHERE c.parent_id = ?
                ORDER BY c.created_at DESC
                """;
        List<CommunityComment> list = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, currentUserId);
            ps.setInt(2, parentId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next())
                    list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.getReplies: " + e.getMessage());
        }
        return list;
    }

    /**
     * Add a root comment. Returns the generated ID, or -1 on failure.
     */
    public int addComment(CommunityComment comment) {
        String sql = "INSERT INTO community_comment (user_id, title, content) VALUES (?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, comment.getUserId());
            ps.setString(2, comment.getTitle());
            ps.setString(3, comment.getContent());
            if (ps.executeUpdate() >= 1) {
                ResultSet keys = ps.getGeneratedKeys();
                if (keys.next())
                    return keys.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.addComment: " + e.getMessage());
        }
        return -1;
    }

    /**
     * Add a reply to a parent comment. Returns the generated ID, or -1 on failure.
     */
    public int addReply(CommunityComment comment) {
        String sql = "INSERT INTO community_comment (user_id, content, parent_id) VALUES (?, ?, ?)";
        try (PreparedStatement ps = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setInt(1, comment.getUserId());
            ps.setString(2, comment.getContent());
            ps.setInt(3, comment.getParentId());
            if (ps.executeUpdate() >= 1) {
                ResultSet keys = ps.getGeneratedKeys();
                if (keys.next())
                    return keys.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.addReply: " + e.getMessage());
        }
        return -1;
    }

    /**
     * Update comment content (triggers the modified flag via DB trigger).
     */
    public boolean updateContent(int commentId, String newContent) {
        String sql = "UPDATE community_comment SET content = ? WHERE id = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setString(1, newContent);
            ps.setInt(2, commentId);
            return ps.executeUpdate() == 1;
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.updateContent: " + e.getMessage());
        }
        return false;
    }

    /**
     * Delete a comment (cascades to replies).
     */
    public boolean delete(int commentId) {
        String sql = "DELETE FROM community_comment WHERE id = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, commentId);
            return ps.executeUpdate() == 1;
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.delete: " + e.getMessage());
        }
        return false;
    }

    /**
     * Read a single comment by ID with author info.
     */
    public CommunityComment read(int id, int currentUserId) {
        String sql = """
                SELECT c.*,
                       CONCAT(u.first_name, ' ', u.last_name) AS author_name,
                       u.roles AS author_role,
                       u.profile_picture AS author_pic,
                       cr.reaction AS current_reaction
                FROM community_comment c
                JOIN user u ON c.user_id = u.id
                LEFT JOIN community_reaction cr ON cr.comment_id = c.id AND cr.user_id = ?
                WHERE c.id = ?
                """;
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, currentUserId);
            ps.setInt(2, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next())
                    return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.read: " + e.getMessage());
        }
        return null;
    }

    /**
     * Search comments by text content.
     */
    public List<CommunityComment> search(String text, int currentUserId) {
        String sql = """
                SELECT c.*,
                       CONCAT(u.first_name, ' ', u.last_name) AS author_name,
                       u.roles AS author_role,
                       u.profile_picture AS author_pic,
                       cr.reaction AS current_reaction
                FROM community_comment c
                JOIN user u ON c.user_id = u.id
                LEFT JOIN community_reaction cr ON cr.comment_id = c.id AND cr.user_id = ?
                WHERE c.parent_id IS NULL AND (c.content LIKE ? OR c.title LIKE ?)
                ORDER BY c.created_at DESC
                """;
        List<CommunityComment> list = new ArrayList<>();
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, currentUserId);
            ps.setString(2, "%" + text + "%");
            ps.setString(3, "%" + text + "%");
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next())
                    list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("CommunityCommentDao.search: " + e.getMessage());
        }
        return list;
    }

    private CommunityComment map(ResultSet rs) throws SQLException {
        CommunityComment c = new CommunityComment();
        c.setId(rs.getInt("id"));
        c.setUserId(rs.getInt("user_id"));
        c.setTitle(rs.getString("title"));
        c.setContent(rs.getString("content"));
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null)
            c.setCreatedAt(ts.toLocalDateTime());
        c.setModified(rs.getBoolean("modified"));
        c.setParentId(rs.getInt("parent_id"));
        c.setAuthorName(rs.getString("author_name"));
        c.setAuthorRole(rs.getString("author_role"));
        c.setAuthorProfilePic(rs.getString("author_pic"));
        c.setCurrentReaction(rs.getString("current_reaction"));
        return c;
    }
}
