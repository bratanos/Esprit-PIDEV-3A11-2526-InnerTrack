package com.innertrack.model;

import java.time.LocalDate;

public class HabitEntry {
    private int id;               // Id_Habit
    private int userId;           // FK → user.id
    private String nomHabitude;
    private String emotionDominantes;
    private String noteTextuelle;
    private int niveauEnergie;    // 1-15
    private int niveauStress;     // 1-10
    private int qualiteSommeil;   // 1-10
    private LocalDate dateCreation;
    private Integer journalId;    // nullable FK → journal_emotionnel.id_journal

    public HabitEntry() {}

    public HabitEntry(int userId, String nomHabitude, int niveauEnergie,
                      int niveauStress, int qualiteSommeil, LocalDate dateCreation) {
        this.userId         = userId;
        this.nomHabitude    = nomHabitude;
        this.niveauEnergie  = niveauEnergie;
        this.niveauStress   = niveauStress;
        this.qualiteSommeil = qualiteSommeil;
        this.dateCreation   = dateCreation;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                           { return id; }
    public void setId(int id)                    { this.id = id; }

    public int getUserId()                       { return userId; }
    public void setUserId(int userId)            { this.userId = userId; }

    public String getNomHabitude()               { return nomHabitude; }
    public void setNomHabitude(String v)         { this.nomHabitude = v; }

    public String getEmotionDominantes()         { return emotionDominantes; }
    public void setEmotionDominantes(String v)   { this.emotionDominantes = v; }

    public String getNoteTextuelle()             { return noteTextuelle; }
    public void setNoteTextuelle(String v)       { this.noteTextuelle = v; }

    public int getNiveauEnergie()                { return niveauEnergie; }
    public void setNiveauEnergie(int v)          { this.niveauEnergie = v; }

    public int getNiveauStress()                 { return niveauStress; }
    public void setNiveauStress(int v)           { this.niveauStress = v; }

    public int getQualiteSommeil()               { return qualiteSommeil; }
    public void setQualiteSommeil(int v)         { this.qualiteSommeil = v; }

    public LocalDate getDateCreation()           { return dateCreation; }
    public void setDateCreation(LocalDate v)     { this.dateCreation = v; }

    public Integer getJournalId()                { return journalId; }
    public void setJournalId(Integer journalId)  { this.journalId = journalId; }
}