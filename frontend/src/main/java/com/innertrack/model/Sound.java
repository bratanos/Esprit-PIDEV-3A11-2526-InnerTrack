package com.innertrack.model;

public class Sound {
    private int id;
    private String name;
    private String username;
    private String previewUrl; // URL du prévisualisation audio (MP3)
    private double duration;

    // Getters et setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPreviewUrl() {
        return previewUrl;
    }

    public void setPreviewUrl(String previewUrl) {
        this.previewUrl = previewUrl;
    }

    public double getDuration() {
        return duration;
    }

    public void setDuration(double duration) {
        this.duration = duration;
    }

    public String getFormattedDuration() {
        int minutes = (int) duration / 60;
        int seconds = (int) duration % 60;
        return String.format("%d:%02d", minutes, seconds);
    }

    public boolean hasPreview() {
        return previewUrl != null && !previewUrl.isEmpty();
    }
}
