package com.innertrack.model;

import java.time.LocalDate;
import java.util.List;

public class Article {
    private int id;
    private String titre;
    private String contenu;
    private int auteurUserId;
    private String auteurName;
    private LocalDate datePublication;
    private Integer categorieId; // Using Integer to allow null
    private String categorieNom;
    private String readability;
    private List<Tag> tags;

    public Article() {
    }

    public Article(String titre, String contenu, int auteurUserId, LocalDate datePublication, Integer categorieId) {
        this.titre = titre;
        this.contenu = contenu;
        this.auteurUserId = auteurUserId;
        this.datePublication = datePublication;
        this.categorieId = categorieId;
    }

    public Article(int id, String titre, String contenu, int auteurUserId, LocalDate datePublication,
            Integer categorieId) {
        this.id = id;
        this.titre = titre;
        this.contenu = contenu;
        this.auteurUserId = auteurUserId;
        this.datePublication = datePublication;
        this.categorieId = categorieId;
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

    public String getContenu() {
        return contenu;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }

    public int getAuteurUserId() {
        return auteurUserId;
    }

    public void setAuteurUserId(int auteurUserId) {
        this.auteurUserId = auteurUserId;
    }

    public String getAuteurName() {
        return auteurName;
    }

    public void setAuteurName(String auteurName) {
        this.auteurName = auteurName;
    }

    public LocalDate getDatePublication() {
        return datePublication;
    }

    public void setDatePublication(LocalDate datePublication) {
        this.datePublication = datePublication;
    }

    public Integer getCategorieId() {
        return categorieId;
    }

    public void setCategorieId(Integer categorieId) {
        this.categorieId = categorieId;
    }

    public String getCategorieNom() {
        return categorieNom;
    }

    public void setCategorieNom(String categorieNom) {
        this.categorieNom = categorieNom;
    }

    public String getReadability() {
        return readability;
    }

    public void setReadability(String readability) {
        this.readability = readability;
    }

    public List<Tag> getTags() {
        return tags;
    }

    public void setTags(List<Tag> tags) {
        this.tags = tags;
    }

    @Override
    public String toString() {
        return "Article{" +
                "id=" + id +
                ", titre='" + titre + '\'' +
                ", auteurUserId=" + auteurUserId +
                ", auteurName='" + auteurName + '\'' +
                ", datePublication=" + datePublication +
                ", categorieId=" + categorieId +
                '}';
    }
}