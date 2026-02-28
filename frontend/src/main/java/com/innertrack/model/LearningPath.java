package com.innertrack.model;

import java.time.LocalDate;
import java.util.List;

public class LearningPath {
    private int id;
    private String titre;
    private String description;
    private LocalDate dateCreation;
    private int createdById;
    private String createdByName;
    private List<Article> articles;

    public LearningPath() {
    }

    public LearningPath(String titre, String description, int createdById) {
        this.titre = titre;
        this.description = description;
        this.createdById = createdById;
        this.dateCreation = LocalDate.now();
    }

    public LearningPath(int id, String titre, String description, LocalDate dateCreation, int createdById) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.dateCreation = dateCreation;
        this.createdById = createdById;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public LocalDate getDateCreation() {
        return dateCreation;
    }

    public void setDateCreation(LocalDate dateCreation) {
        this.dateCreation = dateCreation;
    }

    public int getCreatedById() {
        return createdById;
    }

    public void setCreatedById(int createdById) {
        this.createdById = createdById;
    }

    public String getCreatedByName() {
        return createdByName;
    }

    public void setCreatedByName(String createdByName) {
        this.createdByName = createdByName;
    }

    public List<Article> getArticles() {
        return articles;
    }

    public void setArticles(List<Article> articles) {
        this.articles = articles;
    }
}