
package com.innertrack.model;

import java.time.LocalDateTime;

public class Conversation {
    private int id;
    private int clientId;
    private int therapistId;
    private String status; // PENDING | ACTIVE | CLOSED
    private LocalDateTime createdAt;

    // Transient — not in DB, populated by join
    private String clientName;
    private String therapistName;

    public Conversation() {}

    public Conversation(int clientId, int therapistId) {
        this.clientId = clientId;
        this.therapistId = therapistId;
        this.status = "PENDING";
    }

    public int getId()                            { return id; }
    public void setId(int id)                     { this.id = id; }
    public int getClientId()                      { return clientId; }
    public void setClientId(int clientId)         { this.clientId = clientId; }
    public int getTherapistId()                   { return therapistId; }
    public void setTherapistId(int v)             { this.therapistId = v; }
    public String getStatus()                     { return status; }
    public void setStatus(String status)          { this.status = status; }
    public LocalDateTime getCreatedAt()           { return createdAt; }
    public void setCreatedAt(LocalDateTime v)     { this.createdAt = v; }
    public String getClientName()                 { return clientName; }
    public void setClientName(String v)           { this.clientName = v; }
    public String getTherapistName()              { return therapistName; }
    public void setTherapistName(String v)        { this.therapistName = v; }
}