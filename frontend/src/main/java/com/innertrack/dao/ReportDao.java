package com.innertrack.dao;

import com.innertrack.model.Report;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class ReportDao {

    private final Connection connection;

    public ReportDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    /** File a new report. Returns true on success. */
    public boolean fileReport(Report report) {
        String sql = "INSERT INTO report (reporter_id, reported_id, reason, details, status) " +
                "VALUES (?, ?, ?, ?, 'PENDING')";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, report.getReporterId());
            stmt.setInt(2, report.getReportedId());
            stmt.setString(3, report.getReason());
            stmt.setString(4, report.getDetails());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ReportDao.fileReport: " + e.getMessage());
        }
        return false;
    }

    /** All pending reports — for the admin panel. */
    public List<Report> getPendingReports() {
        return getByStatus("PENDING");
    }

    /** All reports regardless of status — for the admin panel. */
    public List<Report> getAllReports() {
        String sql = "SELECT r.*, " +
                "CONCAT(u1.first_name,' ',u1.last_name) AS reporter_name, " +
                "CONCAT(u2.first_name,' ',u2.last_name) AS reported_name " +
                "FROM report r " +
                "JOIN user u1 ON u1.id = r.reporter_id " +
                "JOIN user u2 ON u2.id = r.reported_id " +
                "ORDER BY r.created_at DESC";
        return query(sql);
    }

    private List<Report> getByStatus(String status) {
        String sql = "SELECT r.*, " +
                "CONCAT(u1.first_name,' ',u1.last_name) AS reporter_name, " +
                "CONCAT(u2.first_name,' ',u2.last_name) AS reported_name " +
                "FROM report r " +
                "JOIN user u1 ON u1.id = r.reporter_id " +
                "JOIN user u2 ON u2.id = r.reported_id " +
                "WHERE r.status = ? " +
                "ORDER BY r.created_at DESC";
        return query(sql, status);
    }

    /** Admin marks a report as reviewed. */
    public boolean reviewReport(int reportId, int adminId, String decision) {
        String sql = "UPDATE report SET status=?, reviewed_by=?, reviewed_at=NOW() WHERE id=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, decision); // "REVIEWED" or "DISMISSED"
            stmt.setInt(2, adminId);
            stmt.setInt(3, reportId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ReportDao.reviewReport: " + e.getMessage());
        }
        return false;
    }

    public int countPending() {
        try (PreparedStatement stmt = connection.prepareStatement(
                "SELECT COUNT(*) FROM report WHERE status='PENDING'");
                ResultSet rs = stmt.executeQuery()) {
            if (rs.next())
                return rs.getInt(1);
        } catch (SQLException e) {
            System.err.println("ReportDao.countPending: " + e.getMessage());
        }
        return 0;
    }

    // ── Helpers ───────────────────────────────────────────────

    private List<Report> query(String sql, Object... params) {
        List<Report> list = new ArrayList<>();
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            for (int i = 0; i < params.length; i++)
                stmt.setObject(i + 1, params[i]);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next())
                    list.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("ReportDao.query: " + e.getMessage());
        }
        return list;
    }

    private Report map(ResultSet rs) throws SQLException {
        Report r = new Report();
        r.setId(rs.getInt("id"));
        r.setReporterId(rs.getInt("reporter_id"));
        r.setReportedId(rs.getInt("reported_id"));
        r.setReason(rs.getString("reason"));
        r.setDetails(rs.getString("details"));
        r.setStatus(rs.getString("status"));
        r.setReporterName(rs.getString("reporter_name"));
        r.setReportedName(rs.getString("reported_name"));
        Timestamp ca = rs.getTimestamp("created_at");
        if (ca != null)
            r.setCreatedAt(ca.toLocalDateTime());
        Timestamp ra = rs.getTimestamp("reviewed_at");
        if (ra != null)
            r.setReviewedAt(ra.toLocalDateTime());
        int rb = rs.getInt("reviewed_by");
        if (!rs.wasNull())
            r.setReviewedBy(rb);
        return r;
    }
}