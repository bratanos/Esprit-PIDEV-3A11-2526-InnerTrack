package com.innertrack.model;

import java.time.LocalDateTime;

public class Report {
    private int id;
    private int reporterId;
    private int reportedId;
    private String reason; // SPAM | HARASSMENT | INAPPROPRIATE | OTHER
    private String details;
    private String status; // PENDING | REVIEWED | DISMISSED
    private String context; // MESSAGING | COMMUNITY
    private LocalDateTime createdAt;
    private LocalDateTime reviewedAt;
    private Integer reviewedBy;

    // Transient — filled by DAO via JOIN
    private String reporterName;
    private String reportedName;

    public Report() {
    }

    public Report(int reporterId, int reportedId, String reason, String details) {
        this.reporterId = reporterId;
        this.reportedId = reportedId;
        this.reason = reason;
        this.details = details;
        this.status = "PENDING";
        this.context = "MESSAGING"; // Default, overridden if specified
    }

    public Report(int reporterId, int reportedId, String reason, String details, String context) {
        this.reporterId = reporterId;
        this.reportedId = reportedId;
        this.reason = reason;
        this.details = details;
        this.status = "PENDING";
        this.context = context;
    }

    // ── Getters / Setters ─────────────────────────────────────

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getReporterId() {
        return reporterId;
    }

    public void setReporterId(int v) {
        this.reporterId = v;
    }

    public int getReportedId() {
        return reportedId;
    }

    public void setReportedId(int v) {
        this.reportedId = v;
    }

    public String getReason() {
        return reason;
    }

    public void setReason(String v) {
        this.reason = v;
    }

    public String getDetails() {
        return details;
    }

    public void setDetails(String v) {
        this.details = v;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String v) {
        this.status = v;
    }

    public String getContext() {
        return context;
    }

    public void setContext(String context) {
        this.context = context;
    }

    public LocalDateTime getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(LocalDateTime v) {
        this.createdAt = v;
    }

    public LocalDateTime getReviewedAt() {
        return reviewedAt;
    }

    public void setReviewedAt(LocalDateTime v) {
        this.reviewedAt = v;
    }

    public Integer getReviewedBy() {
        return reviewedBy;
    }

    public void setReviewedBy(Integer v) {
        this.reviewedBy = v;
    }

    public String getReporterName() {
        return reporterName;
    }

    public void setReporterName(String v) {
        this.reporterName = v;
    }

    public String getReportedName() {
        return reportedName;
    }

    public void setReportedName(String v) {
        this.reportedName = v;
    }

    public String getReasonLabel() {
        return switch (reason == null ? "" : reason) {
            case "SPAM" -> "Spam";
            case "HARASSMENT" -> "Harcèlement";
            case "INAPPROPRIATE" -> "Contenu inapproprié";
            default -> "Autre";
        };
    }
}