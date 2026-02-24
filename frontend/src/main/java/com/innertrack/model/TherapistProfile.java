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
    private String phone;
    private Integer sessionRate;
    private String availableDays;   // comma-separated: MON,TUE,WED
    private LocalDateTime createdAt;

    public TherapistProfile() {}

    public TherapistProfile(int userId) {
        this.userId = userId;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                           { return id; }
    public void setId(int id)                    { this.id = id; }

    public int getUserId()                       { return userId; }
    public void setUserId(int userId)            { this.userId = userId; }

    public String getSpecialization()            { return specialization; }
    public void setSpecialization(String v)      { this.specialization = v; }

    public String getLicenseNumber()             { return licenseNumber; }
    public void setLicenseNumber(String v)       { this.licenseNumber = v; }

    public String getBio()                       { return bio; }
    public void setBio(String bio)               { this.bio = bio; }

    public String getAddress()                   { return address; }
    public void setAddress(String address)       { this.address = address; }

    public Double getLatitude()                  { return latitude; }
    public void setLatitude(Double latitude)     { this.latitude = latitude; }

    public Double getLongitude()                 { return longitude; }
    public void setLongitude(Double longitude)   { this.longitude = longitude; }

    public String getPhone()                     { return phone; }
    public void setPhone(String phone)           { this.phone = phone; }

    public Integer getSessionRate()              { return sessionRate; }
    public void setSessionRate(Integer rate)     { this.sessionRate = rate; }

    public String getAvailableDays()             { return availableDays; }
    public void setAvailableDays(String days)    { this.availableDays = days; }

    public LocalDateTime getCreatedAt()          { return createdAt; }
    public void setCreatedAt(LocalDateTime v)    { this.createdAt = v; }

    public boolean hasLocation() {
        return latitude != null && longitude != null;
    }

    /** Human-readable availability string for display in client map panel */
    public String getFormattedDays() {
        if (availableDays == null || availableDays.isBlank()) return "—";
        return availableDays
                .replace("MON", "Lun").replace("TUE", "Mar").replace("WED", "Mer")
                .replace("THU", "Jeu").replace("FRI", "Ven").replace("SAT", "Sam")
                .replace("SUN", "Dim").replace(",", " · ");
    }
}