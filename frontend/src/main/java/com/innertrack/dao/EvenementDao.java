package com.innertrack.dao;

import com.innertrack.model.Evenement;
import com.innertrack.util.ApiClient;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class EvenementDao {
    
    private static final DateTimeFormatter DATE_FORMATTER = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm");
    
    public List<Evenement> findAll(int page, int limit, String statut) {
        try {
            String url = "/evenements?page=" + page + "&limit=" + limit;
            if (statut != null && !statut.isEmpty()) {
                url += "&statut=" + statut;
            }
            
            Map<String, Object> response = ApiClient.get(url);
            List<Map<String, Object>> data = (List<Map<String, Object>>) response.get("data");
            
            List<Evenement> evenements = new ArrayList<>();
            for (Map<String, Object> item : data) {
                evenements.add(mapToEvenement(item));
            }
            
            return evenements;
        } catch (Exception e) {
            System.err.println("Error fetching evenements: " + e.getMessage());
            return new ArrayList<>();
        }
    }
    
    public Evenement findById(int id) {
        try {
            Map<String, Object> response = ApiClient.get("/evenements/" + id);
            return mapToEvenement(response);
        } catch (Exception e) {
            System.err.println("Error fetching evenement: " + e.getMessage());
            return null;
        }
    }
    
    public boolean create(Evenement evenement) {
        try {
            Map<String, Object> data = Map.of(
                "titre", evenement.getTitre(),
                "description", evenement.getDescription(),
                "dateDebut", evenement.getDateDebut().format(DATE_FORMATTER),
                "dateFin", evenement.getDateFin().format(DATE_FORMATTER),
                "lieu", evenement.getLieu(),
                "statut", evenement.getStatut(),
                "nombreMaxParticipants", evenement.getNombreMaxParticipants(),
                "imageUrl", evenement.getImageUrl() != null ? evenement.getImageUrl() : ""
            );
            
            Map<String, Object> response = ApiClient.post("/evenements", data);
            return response.containsKey("success");
        } catch (Exception e) {
            System.err.println("Error creating evenement: " + e.getMessage());
            return false;
        }
    }
    
    public boolean update(Evenement evenement) {
        try {
            Map<String, Object> data = Map.of(
                "titre", evenement.getTitre(),
                "description", evenement.getDescription(),
                "dateDebut", evenement.getDateDebut().format(DATE_FORMATTER),
                "dateFin", evenement.getDateFin().format(DATE_FORMATTER),
                "lieu", evenement.getLieu(),
                "statut", evenement.getStatut(),
                "nombreMaxParticipants", evenement.getNombreMaxParticipants(),
                "imageUrl", evenement.getImageUrl() != null ? evenement.getImageUrl() : ""
            );
            
            Map<String, Object> response = ApiClient.put("/evenements/" + evenement.getId(), data);
            return response.containsKey("success");
        } catch (Exception e) {
            System.err.println("Error updating evenement: " + e.getMessage());
            return false;
        }
    }
    
    public boolean delete(int id) {
        try {
            Map<String, Object> response = ApiClient.delete("/evenements/" + id);
            return response.containsKey("success");
        } catch (Exception e) {
            System.err.println("Error deleting evenement: " + e.getMessage());
            return false;
        }
    }
    
    public List<Evenement> findUpcoming() {
        try {
            List<Map<String, Object>> data = (List<Map<String, Object>>) ApiClient.get("/evenements/upcoming");
            List<Evenement> evenements = new ArrayList<>();
            for (Map<String, Object> item : data) {
                evenements.add(mapToEvenement(item));
            }
            return evenements;
        } catch (Exception e) {
            System.err.println("Error fetching upcoming evenements: " + e.getMessage());
            return new ArrayList<>();
        }
    }
    
    public int getTotalCount(String statut) {
        try {
            String url = "/evenements?page=1&limit=1";
            if (statut != null && !statut.isEmpty()) {
                url += "&statut=" + statut;
            }
            
            Map<String, Object> response = ApiClient.get(url);
            return (Integer) response.get("total");
        } catch (Exception e) {
            System.err.println("Error getting total count: " + e.getMessage());
            return 0;
        }
    }
    
    private Evenement mapToEvenement(Map<String, Object> data) {
        Evenement evenement = new Evenement();
        evenement.setId((Integer) data.get("id"));
        evenement.setTitre((String) data.get("titre"));
        evenement.setDescription((String) data.get("description"));
        
        String dateDebutStr = (String) data.get("dateDebut");
        if (dateDebutStr != null) {
            evenement.setDateDebut(LocalDateTime.parse(dateDebutStr, DATE_FORMATTER));
        }
        
        String dateFinStr = (String) data.get("dateFin");
        if (dateFinStr != null) {
            evenement.setDateFin(LocalDateTime.parse(dateFinStr, DATE_FORMATTER));
        }
        
        evenement.setLieu((String) data.get("lieu"));
        evenement.setStatut((String) data.get("statut"));
        evenement.setNombreParticipants((Integer) data.get("nombreParticipants"));
        evenement.setNombreMaxParticipants((Integer) data.get("nombreMaxParticipants"));
        evenement.setImageUrl((String) data.get("imageUrl"));
        
        String createdAtStr = (String) data.get("createdAt");
        if (createdAtStr != null) {
            evenement.setCreatedAt(LocalDateTime.parse(createdAtStr, DATE_FORMATTER));
        }
        
        String updatedAtStr = (String) data.get("updatedAt");
        if (updatedAtStr != null) {
            evenement.setUpdatedAt(LocalDateTime.parse(updatedAtStr, DATE_FORMATTER));
        }
        
        evenement.setCreatedBy((Integer) data.get("createdBy"));
        
        return evenement;
    }
}
