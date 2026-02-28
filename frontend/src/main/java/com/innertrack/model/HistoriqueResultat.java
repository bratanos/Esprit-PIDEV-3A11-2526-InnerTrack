package com.innertrack.model;

import java.sql.Timestamp;

public class HistoriqueResultat {

    private int idHistorique;
    private int idUser;
    private int idTest;
    private int score;
    private double pourcentage;
    private String niveau;
    private Timestamp datePassage;

    public int getIdHistorique() {
        return idHistorique;
    }

    public void setIdHistorique(int idHistorique) {
        this.idHistorique = idHistorique;
    }

    public int getIdUser() {
        return idUser;
    }

    public void setIdUser(int idUser) {
        this.idUser = idUser;
    }

    public int getIdTest() {
        return idTest;
    }

    public void setIdTest(int idTest) {
        this.idTest = idTest;
    }

    public int getScore() {
        return score;
    }

    public void setScore(int score) {
        this.score = score;
    }

    public double getPourcentage() {
        return pourcentage;
    }

    public void setPourcentage(double pourcentage) {
        this.pourcentage = pourcentage;
    }

    public String getNiveau() {
        return niveau;
    }

    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }

    public Timestamp getDatePassage() {
        return datePassage;
    }

    public void setDatePassage(Timestamp datePassage) {
        this.datePassage = datePassage;
    }
}
