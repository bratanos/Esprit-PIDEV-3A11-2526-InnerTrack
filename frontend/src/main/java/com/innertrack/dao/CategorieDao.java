package com.innertrack.dao;

import com.innertrack.model.Categorie;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class CategorieDao {
    private final Connection connection;

    public CategorieDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(Categorie categorie) {
        String sql = "INSERT INTO categorie (nom, description) VALUES (?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setString(1, categorie.getNom());
            stmt.setString(2, categorie.getDescription());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next()) categorie.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("CategorieDao.create error: " + e.getMessage());
        }
        return false;
    }

    public Categorie findById(int id) {
        String sql = "SELECT * FROM categorie WHERE id_categorie = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("CategorieDao.findById error: " + e.getMessage());
        }
        return null;
    }

    public List<Categorie> findAll() {
        List<Categorie> list = new ArrayList<>();
        String sql = "SELECT * FROM categorie ORDER BY nom";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            while (rs.next()) list.add(map(rs));
        } catch (SQLException e) {
            System.err.println("CategorieDao.findAll error: " + e.getMessage());
        }
        return list;
    }

    public boolean update(Categorie categorie) {
        String sql = "UPDATE categorie SET nom=?, description=? WHERE id_categorie=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, categorie.getNom());
            stmt.setString(2, categorie.getDescription());
            stmt.setInt(3, categorie.getId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("CategorieDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM categorie WHERE id_categorie = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("CategorieDao.delete error: " + e.getMessage());
        }
        return false;
    }

    private Categorie map(ResultSet rs) throws SQLException {
        Categorie c = new Categorie();
        c.setId(rs.getInt("id_categorie"));
        c.setNom(rs.getString("nom"));
        c.setDescription(rs.getString("description"));
        return c;
    }
}