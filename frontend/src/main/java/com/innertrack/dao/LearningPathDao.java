package com.innertrack.dao;

import com.innertrack.model.Article;
import com.innertrack.model.LearningPath;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class LearningPathDao {
    private final Connection connection;

    public LearningPathDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(LearningPath path) {
        String sql = "INSERT INTO learning_path (titre, description, date_creation, created_by_id) VALUES (?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setString(1, path.getTitre());
            stmt.setString(2, path.getDescription());
            stmt.setDate(3, Date.valueOf(path.getDateCreation()));
            stmt.setInt(4, path.getCreatedById());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next())
                        path.setId(keys.getInt(1));
                }
                return true;
            }
        } catch (SQLException e) {
            System.err.println("LearningPathDao.create error: " + e.getMessage());
        }
        return false;
    }

    public LearningPath findById(int id) {
        String sql = "SELECT * FROM learning_path WHERE id_path = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next())
                    return map(rs);
            }
        } catch (SQLException e) {
            System.err.println("LearningPathDao.findById error: " + e.getMessage());
        }
        return null;
    }

    public List<LearningPath> findAll() {
        List<LearningPath> list = new ArrayList<>();
        String sql = "SELECT * FROM learning_path ORDER BY date_creation DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
                ResultSet rs = stmt.executeQuery()) {
            while (rs.next())
                list.add(map(rs));
        } catch (SQLException e) {
            System.err.println("LearningPathDao.findAll error: " + e.getMessage());
        }
        return list;
    }

    public boolean update(LearningPath path) {
        String sql = "UPDATE learning_path SET titre=?, description=? WHERE id_path=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, path.getTitre());
            stmt.setString(2, path.getDescription());
            stmt.setInt(3, path.getId());
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("LearningPathDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM learning_path WHERE id_path = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("LearningPathDao.delete error: " + e.getMessage());
        }
        return false;
    }

    // ── Articles in Path ──────────────────────────────────────

    public boolean addArticleToPath(int pathId, int articleId, int order) {
        String sql = "INSERT INTO path_article (id_path, id_article, ordre) VALUES (?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, pathId);
            stmt.setInt(2, articleId);
            stmt.setInt(3, order);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("LearningPathDao.addArticleToPath error: " + e.getMessage());
        }
        return false;
    }

    public boolean removeArticleFromPath(int pathId, int articleId) {
        String sql = "DELETE FROM path_article WHERE id_path=? AND id_article=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, pathId);
            stmt.setInt(2, articleId);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("LearningPathDao.removeArticleFromPath error: " + e.getMessage());
        }
        return false;
    }

    public List<Article> findArticlesInPath(int pathId) {
        List<Article> articles = new ArrayList<>();
        String sql = "SELECT a.* FROM article a " +
                "JOIN path_article pa ON a.id_Article = pa.id_article " +
                "WHERE pa.id_path = ? ORDER BY pa.ordre";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, pathId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Article a = new Article();
                    a.setId(rs.getInt("id_Article"));
                    a.setTitre(rs.getString("titre"));
                    a.setContenu(rs.getString("contenu"));
                    a.setAuteurUserId(rs.getInt("auteur_user_id"));
                    a.setDatePublication(rs.getDate("datePublication").toLocalDate());
                    int catId = rs.getInt("id_categorie");
                    if (!rs.wasNull())
                        a.setCategorieId(catId);
                    a.setReadability(rs.getString("readability"));
                    articles.add(a);
                }
            }
        } catch (SQLException e) {
            System.err.println("LearningPathDao.findArticlesInPath error: " + e.getMessage());
        }
        return articles;
    }

    public List<LearningPath> findPathsByArticle(int articleId) {
        List<LearningPath> paths = new ArrayList<>();
        String sql = "SELECT p.* FROM learning_path p " +
                "JOIN path_article pa ON p.id_path = pa.id_path " +
                "WHERE pa.id_article = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, articleId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next())
                    paths.add(map(rs));
            }
        } catch (SQLException e) {
            System.err.println("LearningPathDao.findPathsByArticle error: " + e.getMessage());
        }
        return paths;
    }

    public boolean clearArticlesFromPath(int pathId) {
        String sql = "DELETE FROM path_article WHERE id_path = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, pathId);
            return stmt.executeUpdate() >= 0;
        } catch (SQLException e) {
            System.err.println("LearningPathDao.clearArticlesFromPath error: " + e.getMessage());
        }
        return false;
    }

    private LearningPath map(ResultSet rs) throws SQLException {
        LearningPath p = new LearningPath();
        p.setId(rs.getInt("id_path"));
        p.setTitre(rs.getString("titre"));
        p.setDescription(rs.getString("description"));
        p.setDateCreation(rs.getDate("date_creation").toLocalDate());
        p.setCreatedById(rs.getInt("created_by_id"));
        return p;
    }
}
