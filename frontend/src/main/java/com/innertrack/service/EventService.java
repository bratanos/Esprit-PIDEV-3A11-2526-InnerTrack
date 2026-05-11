package com.innertrack.service;

import com.innertrack.model.Event;
import com.innertrack.model.TypeEvent;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class EventService {

    private final Connection connection;

    public EventService() {
        connection = DBConnection.getInstance().getConnection();
    }

    public void ajouter(Event event) throws SQLException {

        String sql = """
            INSERT INTO event (titre, description, date_event, id_type_event, date_creation, capacite, statut)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        """;

        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setString(1, event.getTitre());
            ps.setString(2, event.getDescription());
            ps.setDate(3, Date.valueOf(event.getDateEvent()));
            ps.setInt(4, event.getTypeEvent().getIdTypeEvent()); // ✅ FK
            ps.setDate(5, Date.valueOf(event.getDateCreation()));
            ps.setInt(6, event.getCapacite());
            ps.setBoolean(7, event.isStatut());
            ps.executeUpdate();
        }
    }

    public void modifier(Event event) throws SQLException {

        String sql = """
            UPDATE event
            SET titre=?, description=?, date_event=?, id_type_event=?, capacite=?, statut=?
            WHERE id_event=?
        """;

        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setString(1, event.getTitre());
            ps.setString(2, event.getDescription());
            ps.setDate(3, Date.valueOf(event.getDateEvent()));
            ps.setInt(4, event.getTypeEvent().getIdTypeEvent()); // ✅ FK
            ps.setInt(5, event.getCapacite());
            ps.setBoolean(6, event.isStatut());
            ps.setInt(7, event.getIdEvent());
            ps.executeUpdate();
        }
    }

    public void supprimer(int id) throws SQLException {
        String sql = "DELETE FROM event WHERE id_event=?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, id);
            ps.executeUpdate();
        }
    }

    // ✅ JOIN pour récupérer libelle
    public List<Event> recuperer() throws SQLException {

        String sql = """
            SELECT e.*
            FROM event e
            ORDER BY e.date_event DESC
        """;

        List<Event> events = new ArrayList<>();

        try (Statement st = connection.createStatement();
             ResultSet rs = st.executeQuery(sql)) {

            while (rs.next()) {
                Event e = new Event();
                e.setIdEvent(rs.getInt("id_event"));
                e.setTitre(rs.getString("titre"));
                e.setDescription(rs.getString("description"));
                e.setDateEvent(rs.getDate("date_event").toLocalDate());
                e.setDateCreation(rs.getDate("date_creation").toLocalDate());
                e.setCapacite(rs.getInt("capacite"));
                e.setStatut(rs.getBoolean("statut"));

                int idTypeEvent = rs.getInt("id_type_event");
                String libelle = switch (idTypeEvent) {
                    case 1 -> "Conférence";
                    case 2 -> "Atelier";
                    case 3 -> "Forum";
                    case 4 -> "Webinaire";
                    default -> "Inconnu";
                };

                TypeEvent te = new TypeEvent(idTypeEvent, libelle);
                e.setTypeEvent(te);

                events.add(e);
            }
        }

        return events;
    }
}