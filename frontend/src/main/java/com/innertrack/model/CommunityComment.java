package com.innertrack.model;

import java.time.LocalDateTime;

public class CommunityComment {
    private int id;
    private int userId;
    private String title; // NEW: Topic Title
    private String content;
    private LocalDateTime createdAt;
    private boolean modified;
    private int parentId;

    // Transient fields — filled by DAO JOINs
    private String authorName;
    private String authorRole; // e.g. "ROLE_PSYCHOLOGUE", "ROLE_USER"
    private String authorProfilePic;
    private String currentReaction; // current user's reaction emoji

    public CommunityComment() {
    }

    public CommunityComment(int userId, String content) {
        this.userId = userId;
        this.content = content;
    }

    public CommunityComment(int userId, String content, int parentId) {
        this.userId = userId;
        this.content = content;
        this.parentId = parentId;
    }

    // ── Getters ──
    public int getId() {
        return id;
    }

    public int getUserId() {
        return userId;
    }

    public String getTitle() {
        return title;
    }

    public String getContent() {
        return content;
    }

    public LocalDateTime getCreatedAt() {
        return createdAt;
    }

    public boolean isModified() {
        return modified;
    }

    public int getParentId() {
        return parentId;
    }

    public String getAuthorName() {
        return authorName;
    }

    public String getAuthorRole() {
        return authorRole;
    }

    public String getAuthorProfilePic() {
        return authorProfilePic;
    }

    public String getCurrentReaction() {
        return currentReaction;
    }

    // ── Setters ──
    public void setId(int id) {
        this.id = id;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public void setCreatedAt(LocalDateTime createdAt) {
        this.createdAt = createdAt;
    }

    public void setModified(boolean modified) {
        this.modified = modified;
    }

    public void setParentId(int parentId) {
        this.parentId = parentId;
    }

    public void setAuthorName(String authorName) {
        this.authorName = authorName;
    }

    public void setAuthorRole(String authorRole) {
        this.authorRole = authorRole;
    }

    public void setAuthorProfilePic(String authorProfilePic) {
        this.authorProfilePic = authorProfilePic;
    }

    public void setCurrentReaction(String currentReaction) {
        this.currentReaction = currentReaction;
    }

    public boolean isTherapist() {
        return authorRole != null && authorRole.contains("ROLE_PSYCHOLOGUE");
    }

    @Override
    public String toString() {
        return "CommunityComment{id=" + id + ", user=" + authorName + ", content='" + content + "'}";
    }
}
