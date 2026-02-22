package com.innertrack.model;

import java.time.LocalDate;
import java.time.LocalDateTime;

/**
 * Extended profile data for a client (ROLE_USER).
 * Basic identity (first_name, last_name, profile_picture) lives on User — not here.
 * This table only holds data that is specific to a client and not needed for auth.
 */
public class ClientProfile {
    private int id;
    private int userId;
    private LocalDate dateOfBirth;
    private String bio;
    private LocalDateTime createdAt;

    public ClientProfile() {}

    public ClientProfile(int userId) {
        this.userId = userId;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                        { return id; }
    public void setId(int id)                 { this.id = id; }

    public int getUserId()                    { return userId; }
    public void setUserId(int userId)         { this.userId = userId; }

    public LocalDate getDateOfBirth()         { return dateOfBirth; }
    public void setDateOfBirth(LocalDate v)   { this.dateOfBirth = v; }

    public String getBio()                    { return bio; }
    public void setBio(String bio)            { this.bio = bio; }

    public LocalDateTime getCreatedAt()       { return createdAt; }
    public void setCreatedAt(LocalDateTime v) { this.createdAt = v; }
}