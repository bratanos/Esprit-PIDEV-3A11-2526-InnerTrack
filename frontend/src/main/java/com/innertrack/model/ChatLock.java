package com.innertrack.model;

import java.time.LocalDateTime;

public class ChatLock {
    private int id;
    private int userId;
    private String reason;
    private LocalDateTime lockedAt;
    private LocalDateTime lockedUntil; // null = permanent
    private int lockedBy;
    private boolean active;

    // Transient
    private String userName;

    public ChatLock() {
    }

    public ChatLock(int userId, String reason, LocalDateTime lockedUntil, int lockedBy) {
        this.userId = userId;
        this.reason = reason;
        this.lockedUntil = lockedUntil;
        this.lockedBy = lockedBy;
        this.active = true;
    }

    public boolean isExpired() {
        return lockedUntil != null && lockedUntil.isBefore(LocalDateTime.now());
    }

    public boolean isPermanent() {
        return lockedUntil == null;
    }

    // ── Getters ──
    public int getId() {
        return id;
    }

    public int getUserId() {
        return userId;
    }

    public String getReason() {
        return reason;
    }

    public LocalDateTime getLockedAt() {
        return lockedAt;
    }

    public LocalDateTime getLockedUntil() {
        return lockedUntil;
    }

    public int getLockedBy() {
        return lockedBy;
    }

    public boolean isActive() {
        return active;
    }

    public String getUserName() {
        return userName;
    }

    // ── Setters ──
    public void setId(int id) {
        this.id = id;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public void setReason(String reason) {
        this.reason = reason;
    }

    public void setLockedAt(LocalDateTime lockedAt) {
        this.lockedAt = lockedAt;
    }

    public void setLockedUntil(LocalDateTime lockedUntil) {
        this.lockedUntil = lockedUntil;
    }

    public void setLockedBy(int lockedBy) {
        this.lockedBy = lockedBy;
    }

    public void setActive(boolean active) {
        this.active = active;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }
}
