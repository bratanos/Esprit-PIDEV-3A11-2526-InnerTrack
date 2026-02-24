package com.innertrack.model;

import java.time.LocalDateTime;

public class ContactRequest {
    private int id;
    private int clientId;
    private int therapistId;
    private String message;
    private String status; // PENDING | ACCEPTED | DECLINED
    private LocalDateTime createdAt;
    private LocalDateTime respondedAt;

    // Transient
    private String clientName;

    public ContactRequest() {}

    public ContactRequest(int clientId, int therapistId, String message) {
        this.clientId = clientId;
        this.therapistId = therapistId;
        this.message = message;
        this.status = "PENDING";
    }

    public int getId()                           { return id; }
    public void setId(int id)                    { this.id = id; }
    public int getClientId()                     { return clientId; }
    public void setClientId(int v)               { this.clientId = v; }
    public int getTherapistId()                  { return therapistId; }
    public void setTherapistId(int v)            { this.therapistId = v; }
    public String getMessage()                   { return message; }
    public void setMessage(String v)             { this.message = v; }
    public String getStatus()                    { return status; }
    public void setStatus(String status)         { this.status = status; }
    public LocalDateTime getCreatedAt()          { return createdAt; }
    public void setCreatedAt(LocalDateTime v)    { this.createdAt = v; }
    public LocalDateTime getRespondedAt()        { return respondedAt; }
    public void setRespondedAt(LocalDateTime v)  { this.respondedAt = v; }
    public String getClientName()                { return clientName; }
    public void setClientName(String v)          { this.clientName = v; }
}