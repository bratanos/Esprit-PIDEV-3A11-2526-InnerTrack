package com.innertrack.model;

import java.time.LocalDateTime;

public class Message {
    private int id;
    private int conversationId;
    private int senderId;
    private String content;
    private boolean isRead;
    private LocalDateTime sentAt;

    // Transient
    private String senderName;

    public Message() {}

    public Message(int conversationId, int senderId, String content) {
        this.conversationId = conversationId;
        this.senderId = senderId;
        this.content = content;
    }

    public int getId()                         { return id; }
    public void setId(int id)                  { this.id = id; }
    public int getConversationId()             { return conversationId; }
    public void setConversationId(int v)       { this.conversationId = v; }
    public int getSenderId()                   { return senderId; }
    public void setSenderId(int v)             { this.senderId = v; }
    public String getContent()                 { return content; }
    public void setContent(String v)           { this.content = v; }
    public boolean isRead()                    { return isRead; }
    public void setRead(boolean read)          { isRead = read; }
    public LocalDateTime getSentAt()           { return sentAt; }
    public void setSentAt(LocalDateTime v)     { this.sentAt = v; }
    public String getSenderName()              { return senderName; }
    public void setSenderName(String v)        { this.senderName = v; }
}