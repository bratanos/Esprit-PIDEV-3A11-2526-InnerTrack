package com.innertrack.model;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

public class Article {
    private int id;
    private String titre;
    private String contenu;
    private int auteurUserId;        // FK → user.id (must be a therapist)
    private LocalDate datePublication;
    private Integer categorieId;     // nullable
    private String readability;
    private List<Tag> tags = new ArrayList<>();

    public Article() {}

    public Article(String titre, String contenu, int auteurUserId, LocalDate datePublication) {
        this.titre          = titre;
        this.contenu        = contenu;
        this.auteurUserId   = auteurUserId;
        this.datePublication = datePublication;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                           { return id; }
    public void setId(int id)                    { this.id = id; }

    public String getTitre()                     { return titre; }
    public void setTitre(String titre)           { this.titre = titre; }

    public String getContenu()                   { return contenu; }
    public void setContenu(String contenu)       { this.contenu = contenu; }

    public int getAuteurUserId()                 { return auteurUserId; }
    public void setAuteurUserId(int v)           { this.auteurUserId = v; }

    public LocalDate getDatePublication()        { return datePublication; }
    public void setDatePublication(LocalDate v)  { this.datePublication = v; }

    public Integer getCategorieId()              { return categorieId; }
    public void setCategorieId(Integer v)        { this.categorieId = v; }

    public String getReadability()               { return readability; }
    public void setReadability(String v)         { this.readability = v; }

    public List<Tag> getTags()                   { return tags; }
    public void setTags(List<Tag> tags)          { this.tags = tags; }
}