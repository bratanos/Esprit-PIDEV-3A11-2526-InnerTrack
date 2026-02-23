package com.innertrack.model;

import java.time.LocalDateTime;

public class TherapistProfile {
    private int id;
    private int userId;
    private String specialization;
    private String licenseNumber;
    private String bio;
    private String address;
    private Double latitude;
    private Double longitude;
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

    public String getAddress()                { return address; }
    public void setAddress(String address)    { this.address = address; }

    public Double getLatitude()               { return latitude; }
    public void setLatitude(Double latitude)  { this.latitude = latitude; }

    public Double getLongitude()              { return longitude; }
    public void setLongitude(Double v)        { this.longitude = v; }

    public LocalDateTime getCreatedAt()       { return createdAt; }
    public void setCreatedAt(LocalDateTime v) { this.createdAt = v; }

    public boolean hasLocation() {
        return latitude != null && longitude != null;
    }
}