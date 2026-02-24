package com.innertrack.dao;

import com.innertrack.model.*;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Single DAO for all messaging-related tables.
 * Covers: conversation, message, contact_request, notification.
 */
public class MessagingDao {

    private final Connection connection;

    public MessagingDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    // ── CONTACT REQUESTS ─────────────────────────────────────

    /**
     * Client sends a contact request to a therapist.
     * Also creates a notification for the therapist.
     */
    public boolean sendContactRequest(int clientId, int therapistId, String message) {
        // Check if one already exists
        if (contactRequestExists(clientId, therapistId)) return false;

        String sql = "INSERT INTO contact_request (client_id, therapist_id, message) VALUES (?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, clientId);
            stmt.setInt(2, therapistId);
            stmt.setString(3, message);
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                int requestId = -1;
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) requestId = keys.getInt(1);
                }
                // Create notification for therapist
                createNotification(new Notification(
                        therapistId,
                        "CONTACT_REQUEST",
                        "Nouvelle demande de contact",
                        "Un patient souhaite vous contacter.",
                        requestId
                ));
                return true;
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.sendContactRequest: " + e.getMessage());
        }
        return false;
    }

    public boolean contactRequestExists(int clientId, int therapistId) {
        String sql = "SELECT id FROM contact_request WHERE client_id=? AND therapist_id=? AND status='PENDING'";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, clientId);
            stmt.setInt(2, therapistId);
            try (ResultSet rs = stmt.executeQuery()) {
                return rs.next();
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.contactRequestExists: " + e.getMessage());
        }
        return false;
    }

    /** Get all pending contact requests for a therapist (for notification panel) */
    public List<ContactRequest> getPendingRequests(int therapistId) {
        List<ContactRequest> list = new ArrayList<>();
        String sql = "SELECT cr.*, CONCAT(u.first_name, ' ', u.last_name) AS client_name " +
                "FROM contact_request cr " +
                "JOIN user u ON cr.client_id = u.id " +
                "WHERE cr.therapist_id = ? AND cr.status = 'PENDING' " +
                "ORDER BY cr.created_at DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, therapistId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    ContactRequest cr = mapContactRequest(rs);
                    cr.setClientName(rs.getString("client_name"));
                    list.add(cr);
                }
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.getPendingRequests: " + e.getMessage());
        }
        return list;
    }

    /**
     * Therapist accepts a contact request → creates a conversation.
     */
    public Conversation acceptRequest(int requestId) {
        // Get the request
        ContactRequest req = getContactRequest(requestId);
        if (req == null) return null;

        // Update request status
        updateRequestStatus(requestId, "ACCEPTED");

        // Create conversation
        Conversation conv = createConversation(req.getClientId(), req.getTherapistId());

        if (conv != null) {
            // Notify the client
            createNotification(new Notification(
                    req.getClientId(),
                    "CONTACT_REQUEST",
                    "Demande acceptée",
                    "Votre thérapeute a accepté votre demande. Vous pouvez maintenant échanger.",
                    conv.getId()
            ));
        }
        return conv;
    }

    public void declineRequest(int requestId) {
        ContactRequest req = getContactRequest(requestId);
        if (req != null) {
            updateRequestStatus(requestId, "DECLINED");
            createNotification(new Notification(
                    req.getClientId(),
                    "CONTACT_REQUEST",
                    "Demande refusée",
                    "Le thérapeute n'est pas disponible pour le moment.",
                    requestId
            ));
        }
    }

    private void updateRequestStatus(int requestId, String status) {
        String sql = "UPDATE contact_request SET status=?, responded_at=NOW() WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, status);
            stmt.setInt(2, requestId);
            stmt.executeUpdate();
        } catch (SQLException e) {
            System.err.println("MessagingDao.updateRequestStatus: " + e.getMessage());
        }
    }

    private ContactRequest getContactRequest(int id) {
        String sql = "SELECT * FROM contact_request WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return mapContactRequest(rs);
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.getContactRequest: " + e.getMessage());
        }
        return null;
    }

    // ── CONVERSATIONS ────────────────────────────────────────

    public Conversation createConversation(int clientId, int therapistId) {
        String sql = "INSERT INTO conversation (client_id, therapist_id, status) VALUES (?,?,'ACTIVE')";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setInt(1, clientId);
            stmt.setInt(2, therapistId);
            stmt.executeUpdate();
            try (ResultSet keys = stmt.getGeneratedKeys()) {
                if (keys.next()) {
                    Conversation c = new Conversation(clientId, therapistId);
                    c.setId(keys.getInt(1));
                    c.setStatus("ACTIVE");
                    return c;
                }
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.createConversation: " + e.getMessage());
        }
        return null;
    }

    /** Get all conversations for a user (client or therapist) */
    public List<Conversation> getConversationsForUser(int userId) {
        List<Conversation> list = new ArrayList<>();
        String sql = "SELECT c.*, " +
                "CONCAT(cl.first_name, ' ', cl.last_name) AS client_name, " +
                "CONCAT(th.first_name, ' ', th.last_name) AS therapist_name " +
                "FROM conversation c " +
                "JOIN user cl ON c.client_id = cl.id " +
                "JOIN user th ON c.therapist_id = th.id " +
                "WHERE (c.client_id = ? OR c.therapist_id = ?) AND c.status = 'ACTIVE' " +
                "ORDER BY c.created_at DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            stmt.setInt(2, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Conversation conv = new Conversation();
                    conv.setId(rs.getInt("id"));
                    conv.setClientId(rs.getInt("client_id"));
                    conv.setTherapistId(rs.getInt("therapist_id"));
                    conv.setStatus(rs.getString("status"));
                    conv.setClientName(rs.getString("client_name"));
                    conv.setTherapistName(rs.getString("therapist_name"));
                    Timestamp ts = rs.getTimestamp("created_at");
                    if (ts != null) conv.setCreatedAt(ts.toLocalDateTime());
                    list.add(conv);
                }
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.getConversationsForUser: " + e.getMessage());
        }
        return list;
    }

    // ── MESSAGES ─────────────────────────────────────────────

    public boolean sendMessage(int conversationId, int senderId, String content) {
        String sql = "INSERT INTO message (conversation_id, sender_id, content) VALUES (?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, conversationId);
            stmt.setInt(2, senderId);
            stmt.setString(3, content);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("MessagingDao.sendMessage: " + e.getMessage());
        }
        return false;
    }

    public List<Message> getMessages(int conversationId) {
        List<Message> list = new ArrayList<>();
        String sql = "SELECT m.*, CONCAT(u.first_name, ' ', u.last_name) AS sender_name " +
                "FROM message m JOIN user u ON m.sender_id = u.id " +
                "WHERE m.conversation_id = ? ORDER BY m.sent_at ASC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, conversationId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Message msg = new Message();
                    msg.setId(rs.getInt("id"));
                    msg.setConversationId(rs.getInt("conversation_id"));
                    msg.setSenderId(rs.getInt("sender_id"));
                    msg.setContent(rs.getString("content"));
                    msg.setRead(rs.getBoolean("is_read"));
                    msg.setSenderName(rs.getString("sender_name"));
                    Timestamp ts = rs.getTimestamp("sent_at");
                    if (ts != null) msg.setSentAt(ts.toLocalDateTime());
                    list.add(msg);
                }
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.getMessages: " + e.getMessage());
        }
        return list;
    }

    public void markMessagesRead(int conversationId, int userId) {
        String sql = "UPDATE message SET is_read=1 WHERE conversation_id=? AND sender_id != ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, conversationId);
            stmt.setInt(2, userId);
            stmt.executeUpdate();
        } catch (SQLException e) {
            System.err.println("MessagingDao.markMessagesRead: " + e.getMessage());
        }
    }

    // ── NOTIFICATIONS ────────────────────────────────────────

    public boolean createNotification(Notification n) {
        String sql = "INSERT INTO notification (user_id, type, title, body, reference_id) VALUES (?,?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, n.getUserId());
            stmt.setString(2, n.getType());
            stmt.setString(3, n.getTitle());
            stmt.setString(4, n.getBody());
            if (n.getReferenceId() != null) stmt.setInt(5, n.getReferenceId());
            else stmt.setNull(5, Types.INTEGER);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("MessagingDao.createNotification: " + e.getMessage());
        }
        return false;
    }

    public List<Notification> getUnreadNotifications(int userId) {
        List<Notification> list = new ArrayList<>();
        String sql = "SELECT * FROM notification WHERE user_id=? AND is_read=0 ORDER BY created_at DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) list.add(mapNotification(rs));
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.getUnreadNotifications: " + e.getMessage());
        }
        return list;
    }

    public int countUnread(int userId) {
        String sql = "SELECT COUNT(*) FROM notification WHERE user_id=? AND is_read=0";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, userId);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return rs.getInt(1);
            }
        } catch (SQLException e) {
            System.err.println("MessagingDao.countUnread: " + e.getMessage());
        }
        return 0;
    }

    public void markNotificationRead(int notificationId) {
        String sql = "UPDATE notification SET is_read=1 WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, notificationId);
            stmt.executeUpdate();
        } catch (SQLException e) {
            System.err.println("MessagingDao.markNotificationRead: " + e.getMessage());
        }
    }

    // ── Mappers ───────────────────────────────────────────────

    private ContactRequest mapContactRequest(ResultSet rs) throws SQLException {
        ContactRequest cr = new ContactRequest();
        cr.setId(rs.getInt("id"));
        cr.setClientId(rs.getInt("client_id"));
        cr.setTherapistId(rs.getInt("therapist_id"));
        cr.setMessage(rs.getString("message"));
        cr.setStatus(rs.getString("status"));
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null) cr.setCreatedAt(ts.toLocalDateTime());
        Timestamp resp = rs.getTimestamp("responded_at");
        if (resp != null) cr.setRespondedAt(resp.toLocalDateTime());
        return cr;
    }

    private Notification mapNotification(ResultSet rs) throws SQLException {
        Notification n = new Notification();
        n.setId(rs.getInt("id"));
        n.setUserId(rs.getInt("user_id"));
        n.setType(rs.getString("type"));
        n.setTitle(rs.getString("title"));
        n.setBody(rs.getString("body"));
        n.setRead(rs.getBoolean("is_read"));
        int refId = rs.getInt("reference_id");
        if (!rs.wasNull()) n.setReferenceId(refId);
        Timestamp ts = rs.getTimestamp("created_at");
        if (ts != null) n.setCreatedAt(ts.toLocalDateTime());
        return n;
    }
}