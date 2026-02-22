package com.innertrack.model;

import java.time.LocalDateTime;

/**
 * Extended profile data for a therapist (ROLE_PSYCHOLOGUE).
 * Basic identity (first_name, last_name, profile_picture) lives on User — not here.
 * This table only holds data that is specific to a therapist.
 */
public class TherapistProfile {
    private int id;
    private int userId;
    private String specialization;
    private String licenseNumber;
    private String bio;
    private LocalDateTime createdAt;

    public TherapistProfile() {}

    public TherapistProfile(int userId) {
        this.userId = userId;
    }

    public TherapistProfile(int userId, String specialization, String licenseNumber) {
        this.userId         = userId;
        this.specialization = specialization;
        this.licenseNumber  = licenseNumber;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                        { return id; }
    public void setId(int id)                 { this.id = id; }

    public int getUserId()                    { return userId; }
    public void setUserId(int userId)         { this.userId = userId; }

    public String getSpecialization()         { return specialization; }
    public void setSpecialization(String v)   { this.specialization = v; }

    public String getLicenseNumber()          { return licenseNumber; }
    public void setLicenseNumber(String v)    { this.licenseNumber = v; }

    public String getBio()                    { return bio; }
    public void setBio(String bio)            { this.bio = bio; }

    public LocalDateTime getCreatedAt()       { return createdAt; }
    public void setCreatedAt(LocalDateTime v) { this.createdAt = v; }
}