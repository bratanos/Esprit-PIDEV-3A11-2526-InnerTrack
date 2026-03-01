package com.innertrack.model;

public class TypeEvent {
    private int idTypeEvent;
    private String libelle;

    public TypeEvent() {}

    public TypeEvent(int idTypeEvent, String libelle) {
        this.idTypeEvent = idTypeEvent;
        this.libelle = libelle;
    }

    public int getIdTypeEvent() { return idTypeEvent; }
    public void setIdTypeEvent(int idTypeEvent) { this.idTypeEvent = idTypeEvent; }

    public String getLibelle() { return libelle; }
    public void setLibelle(String libelle) { this.libelle = libelle; }

    @Override
    public String toString() {
        return libelle; // pour afficher dans ComboBox<TypeEvent>
    }
}