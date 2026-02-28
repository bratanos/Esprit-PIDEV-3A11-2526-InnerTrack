package com.innertrack.model;

public class TrancheResultat {

    private int idTranche;
    private int idTest;
    private int scoreMin;
    private int scoreMax;
    private String libelle;
    private String interpretation;
    private String niveau; // "faible", "modere", "eleve", "critique"

    public TrancheResultat() {
    }

    public int getIdTranche() {
        return idTranche;
    }

    public void setIdTranche(int idTranche) {
        this.idTranche = idTranche;
    }

    public int getIdTest() {
        return idTest;
    }

    public void setIdTest(int idTest) {
        this.idTest = idTest;
    }

    public int getScoreMin() {
        return scoreMin;
    }

    public void setScoreMin(int scoreMin) {
        this.scoreMin = scoreMin;
    }

    public int getScoreMax() {
        return scoreMax;
    }

    public void setScoreMax(int scoreMax) {
        this.scoreMax = scoreMax;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public String getInterpretation() {
        return interpretation;
    }

    public void setInterpretation(String interpretation) {
        this.interpretation = interpretation;
    }

    public String getNiveau() {
        return niveau;
    }

    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }
}
