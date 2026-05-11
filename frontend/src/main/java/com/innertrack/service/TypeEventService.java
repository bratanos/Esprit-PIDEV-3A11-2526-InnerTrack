package com.innertrack.service;

import com.innertrack.model.TypeEvent;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class TypeEventService {

    private final Connection connection;

    public TypeEventService() {
        connection = DBConnection.getInstance().getConnection();
    }

    public void ajouter(TypeEvent t) throws SQLException {
        throw new UnsupportedOperationException("TypeEvent is a fixed Enum in the backend. Cannot add new types.");
    }

    public void modifier(TypeEvent t) throws SQLException {
        throw new UnsupportedOperationException("TypeEvent is a fixed Enum in the backend. Cannot modify types.");
    }

    public void supprimer(int id) throws SQLException {
        throw new UnsupportedOperationException("TypeEvent is a fixed Enum in the backend. Cannot delete types.");
    }

    public List<TypeEvent> recuperer() throws SQLException {
        List<TypeEvent> list = new ArrayList<>();
        list.add(new TypeEvent(1, "Conférence"));
        list.add(new TypeEvent(2, "Atelier"));
        list.add(new TypeEvent(3, "Forum"));
        list.add(new TypeEvent(4, "Webinaire"));
        return list;
    }

    public TypeEvent findById(int id) throws SQLException {
        return switch (id) {
            case 1 -> new TypeEvent(1, "Conférence");
            case 2 -> new TypeEvent(2, "Atelier");
            case 3 -> new TypeEvent(3, "Forum");
            case 4 -> new TypeEvent(4, "Webinaire");
            default -> null;
        };
    }
}