package com.innertrack.model;

import java.sql.Timestamp;

public class Resultat {

    private int idResultat;
    private int idTest;
    private int idUtilisateur;
    private int scoreTotal;
    private int scoreMaxPossible;
    private double pourcentage;
    private String resultat;
    private String interpretation;
    private Timestamp datePassage;

    public Resultat() {
    }

    public Resultat(int idTest, int idUtilisateur, int scoreTotal,
            int scoreMaxPossible, double pourcentage,
            String resultat, String interpretation) {
        this.idTest = idTest;
        this.idUtilisateur = idUtilisateur;
        this.scoreTotal = scoreTotal;
        this.scoreMaxPossible = scoreMaxPossible;
        this.pourcentage = pourcentage;
        this.resultat = resultat;
        this.interpretation = interpretation;
    }

    public int getIdResultat() {
        return idResultat;
    }

    public void setIdResultat(int idResultat) {
        this.idResultat = idResultat;
    }

    public int getIdTest() {
        return idTest;
    }

    public void setIdTest(int idTest) {
        this.idTest = idTest;
    }

    public int getIdUtilisateur() {
        return idUtilisateur;
    }

    public void setIdUtilisateur(int idUtilisateur) {
        this.idUtilisateur = idUtilisateur;
    }

    public int getScoreTotal() {
        return scoreTotal;
    }

    public void setScoreTotal(int scoreTotal) {
        this.scoreTotal = scoreTotal;
    }

    public int getScoreMaxPossible() {
        return scoreMaxPossible;
    }

    public void setScoreMaxPossible(int scoreMaxPossible) {
        this.scoreMaxPossible = scoreMaxPossible;
    }

    public double getPourcentage() {
        return pourcentage;
    }

    public void setPourcentage(double pourcentage) {
        this.pourcentage = pourcentage;
    }

    public String getResultat() {
        return resultat;
    }

    public void setResultat(String resultat) {
        this.resultat = resultat;
    }

    public String getInterpretation() {
        return interpretation;
    }

    public void setInterpretation(String interpretation) {
        this.interpretation = interpretation;
    }

    public Timestamp getDatePassage() {
        return datePassage;
    }

    public void setDatePassage(Timestamp datePassage) {
        this.datePassage = datePassage;
    }

    @Override
    public String toString() {
        return "Resultat{" +
                "idResultat=" + idResultat +
                ", idTest=" + idTest +
                ", idUtilisateur=" + idUtilisateur +
                ", scoreTotal=" + scoreTotal +
                ", scoreMaxPossible=" + scoreMaxPossible +
                ", pourcentage=" + pourcentage +
                ", resultat='" + resultat + '\'' +
                '}';
    }
}
