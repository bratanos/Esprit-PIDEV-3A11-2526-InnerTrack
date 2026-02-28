package com.innertrack.service;

import java.sql.SQLException;
import java.util.List;

/**
 * CRUD interface using French method names, matching Salma's test module
 * services.
 * Kept separate from the existing ICrudService<T> to avoid conflicts.
 */
public interface ITestCrudService<T> {
    void ajouter(T entity) throws SQLException;

    void modifier(T entity) throws SQLException;

    void supprimer(int id) throws SQLException;

    List<T> recuperer() throws SQLException;
}
