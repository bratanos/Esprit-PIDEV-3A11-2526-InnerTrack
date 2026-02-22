package com.innertrack.model;

import java.time.LocalDate;

public class JournalEntry {
    private int id;         // id_journal
    private int userId;     // FK → user.id
    private int humeur;     // mood score 1-10
    private String noteTextuelle;
    private LocalDate dateSaisie;

    public JournalEntry() {}

    public JournalEntry(int userId, int humeur, String noteTextuelle, LocalDate dateSaisie) {
        this.userId       = userId;
        this.humeur       = humeur;
        this.noteTextuelle = noteTextuelle;
        this.dateSaisie   = dateSaisie;
    }

    // ── Getters & Setters ─────────────────────────────────────

    public int getId()                      { return id; }
    public void setId(int id)               { this.id = id; }

    public int getUserId()                  { return userId; }
    public void setUserId(int userId)       { this.userId = userId; }

    public int getHumeur()                  { return humeur; }
    public void setHumeur(int humeur)       { this.humeur = humeur; }

    public String getNoteTextuelle()        { return noteTextuelle; }
    public void setNoteTextuelle(String v)  { this.noteTextuelle = v; }

    public LocalDate getDateSaisie()        { return dateSaisie; }
    public void setDateSaisie(LocalDate v)  { this.dateSaisie = v; }

    /** Convenience: human-readable mood label */
    public String getHumeurLabel() {
        if (humeur >= 9) return "Excellent";
        if (humeur >= 7) return "Bien";
        if (humeur >= 5) return "Neutre";
        if (humeur >= 3) return "Fatigué";
        return "Difficile";
    }
}