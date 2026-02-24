package com.innertrack.model;

import java.time.LocalDateTime;

public class Notification {
    private int id;
    private int userId;
    private String type;        // CONTACT_REQUEST | MESSAGE | SYSTEM
    private String title;
    private String body;
    private boolean isRead;
    private Integer referenceId; // e.g. contact_request.id or conversation.id
    private LocalDateTime createdAt;

    public Notification() {}

    public Notification(int userId, String type, String title, String body, Integer referenceId) {
        this.userId = userId;
        this.type = type;
        this.title = title;
        this.body = body;
        this.referenceId = referenceId;
        this.isRead = false;
    }

    public int getId()                           { return id; }
    public void setId(int id)                    { this.id = id; }
    public int getUserId()                       { return userId; }
    public void setUserId(int v)                 { this.userId = v; }
    public String getType()                      { return type; }
    public void setType(String type)             { this.type = type; }
    public String getTitle()                     { return title; }
    public void setTitle(String title)           { this.title = title; }
    public String getBody()                      { return body; }
    public void setBody(String body)             { this.body = body; }
    public boolean isRead()                      { return isRead; }
    public void setRead(boolean read)            { isRead = read; }
    public Integer getReferenceId()              { return referenceId; }
    public void setReferenceId(Integer v)        { this.referenceId = v; }
    public LocalDateTime getCreatedAt()          { return createdAt; }
    public void setCreatedAt(LocalDateTime v)    { this.createdAt = v; }
}