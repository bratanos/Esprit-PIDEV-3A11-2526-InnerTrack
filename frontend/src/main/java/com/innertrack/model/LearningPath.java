package com.innertrack.model;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

public class LearningPath {
    private int id;
    private String titre;
    private String description;
    private LocalDate dateCreation;
    private int createdByUserId;         // FK → user.id (therapist)
    private List<Article> articles = new ArrayList<>();

    public LearningPath() {}

    public LearningPath(String titre, String description, int createdByUserId) {
        this.titre           = titre;
        this.description     = description;
        this.createdByUserId = createdByUserId;
        this.dateCreation    = LocalDate.now();
    }

    public int getId()                            { return id; }
    public void setId(int id)                     { this.id = id; }

    public String getTitre()                      { return titre; }
    public void setTitre(String titre)            { this.titre = titre; }

    public String getDescription()                { return description; }
    public void setDescription(String v)          { this.description = v; }

    public LocalDate getDateCreation()            { return dateCreation; }
    public void setDateCreation(LocalDate v)      { this.dateCreation = v; }

    public int getCreatedByUserId()               { return createdByUserId; }
    public void setCreatedByUserId(int v)         { this.createdByUserId = v; }

    public List<Article> getArticles()            { return articles; }
    public void setArticles(List<Article> list)   { this.articles = list; }
}