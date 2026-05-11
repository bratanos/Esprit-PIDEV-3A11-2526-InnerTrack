package com.innertrack.dao;

import com.innertrack.model.Article;
import com.innertrack.model.Tag;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class ArticleDao {
    private final Connection connection;

    public ArticleDao() {
        this.connection = DBConnection.getInstance().getConnection();
    }

    public boolean create(Article article) {
        String sql = "INSERT INTO article (titre, contenu, auteur_user_id, datePublication, id_categorie, readability) VALUES (?,?,?,?,?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            stmt.setString(1, article.getTitre());
            stmt.setString(2, article.getContenu());
            stmt.setInt(3, article.getAuteurUserId());
            stmt.setDate(4, Date.valueOf(article.getDatePublication()));
            if (article.getCategorieId() != null)
                stmt.setInt(5, article.getCategorieId());
            else
                stmt.setNull(5, Types.INTEGER);
            stmt.setString(6, article.getReadability());
            int rows = stmt.executeUpdate();
            if (rows > 0) {
                try (ResultSet keys = stmt.getGeneratedKeys()) {
                    if (keys.next())
                        article.setId(keys.getInt(1));
                }
                syncTags(article);
                return true;
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.create error: " + e.getMessage());
        }
        return false;
    }

    public Article findById(int id) {
        String sql = "SELECT * FROM article WHERE id_Article = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Article a = map(rs);
                    a.setTags(findTagsForArticle(id));
                    return a;
                }
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findById error: " + e.getMessage());
        }
        return null;
    }

    public int countByCategorie(int categorieId) {
        String sql = "SELECT COUNT(*) FROM article WHERE id_categorie = ?";
        try (PreparedStatement ps = connection.prepareStatement(sql)) {
            ps.setInt(1, categorieId);
            ResultSet rs = ps.executeQuery();
            if (rs.next()) return rs.getInt(1);
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public List<Article> findAll() {
        List<Article> list = new ArrayList<>();
        String sql = "SELECT * FROM article ORDER BY datePublication DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
                ResultSet rs = stmt.executeQuery()) {
            while (rs.next()) {
                Article a = map(rs);
                a.setTags(findTagsForArticle(a.getId()));
                list.add(a);
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findAll error: " + e.getMessage());
        }
        return list;
    }

    public List<Article> findByAuteur(int authorUserId) {
        List<Article> list = new ArrayList<>();
        String sql = "SELECT * FROM article WHERE auteur_user_id = ? ORDER BY datePublication DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, authorUserId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Article a = map(rs);
                    a.setTags(findTagsForArticle(a.getId()));
                    list.add(a);
                }
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findByAuteur error: " + e.getMessage());
        }
        return list;
    }

    public List<Article> findByCategorie(int categorieId) {
        List<Article> list = new ArrayList<>();
        String sql = "SELECT a.*, CONCAT(u.first_name, ' ', u.last_name) as auteur_nom " +
                "FROM article a " +
                "LEFT JOIN user u ON a.auteur_user_id = u.id " +
                "WHERE a.id_categorie = ? ORDER BY a.datePublication DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, categorieId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Article a = map(rs);                // maps the article columns
                    a.setAuteurName(rs.getString("auteur_nom")); // set the extra field
                    list.add(a);
                }
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findByCategorie error: " + e.getMessage());
        }
        return list;
    }

    public boolean update(Article article) {
        String sql = "UPDATE article SET titre=?, contenu=?, datePublication=?, id_categorie=?, readability=? WHERE id_Article=?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, article.getTitre());
            stmt.setString(2, article.getContenu());
            stmt.setDate(3, Date.valueOf(article.getDatePublication()));
            if (article.getCategorieId() != null)
                stmt.setInt(4, article.getCategorieId());
            else
                stmt.setNull(4, Types.INTEGER);
            stmt.setString(5, article.getReadability());
            stmt.setInt(6, article.getId());
            boolean updated = stmt.executeUpdate() > 0;
            if (updated)
                syncTags(article);
            return updated;
        } catch (SQLException e) {
            System.err.println("ArticleDao.update error: " + e.getMessage());
        }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM article WHERE id_Article = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("ArticleDao.delete error: " + e.getMessage());
        }
        return false;
    }

    public List<Article> findAllWithCategory() {
        List<Article> list = new ArrayList<>();
        String sql = "SELECT a.*, c.nom as nom_categorie FROM article a " +
                "LEFT JOIN categorie c ON a.id_categorie = c.id_categorie " +
                "ORDER BY a.datePublication DESC";
        try (PreparedStatement stmt = connection.prepareStatement(sql);
                ResultSet rs = stmt.executeQuery()) {
            while (rs.next()) {
                Article a = map(rs);
                a.setCategorieNom(rs.getString("nom_categorie"));
                a.setTags(findTagsForArticle(a.getId()));
                list.add(a);
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findAllWithCategory error: " + e.getMessage());
        }
        return list;
    }

    public boolean existsByTitre(String titre) {
        String sql = "SELECT COUNT(*) FROM article WHERE titre = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, titre);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next())
                    return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.existsByTitre error: " + e.getMessage());
        }
        return false;
    }

    public boolean existsByTitreExcludingId(String titre, int id) {
        String sql = "SELECT COUNT(*) FROM article WHERE titre = ? AND id_Article != ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setString(1, titre);
            stmt.setInt(2, id);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next())
                    return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.existsByTitreExcludingId error: " + e.getMessage());
        }
        return false;
    }

    // ── Tag helpers ───────────────────────────────────────────

    private void syncTags(Article article) throws SQLException {
        // Clear existing tags
        try (PreparedStatement del = connection.prepareStatement("DELETE FROM article_tag WHERE id_article=?")) {
            del.setInt(1, article.getId());
            del.executeUpdate();
        }
        if (article.getTags() == null || article.getTags().isEmpty())
            return;
        String ins = "INSERT INTO article_tag (id_article, id_tag) VALUES (?,?)";
        try (PreparedStatement stmt = connection.prepareStatement(ins)) {
            for (Tag tag : article.getTags()) {
                stmt.setInt(1, article.getId());
                stmt.setInt(2, tag.getId());
                stmt.addBatch();
            }
            stmt.executeBatch();
        }
    }

    private List<Tag> findTagsForArticle(int articleId) {
        List<Tag> tags = new ArrayList<>();
        String sql = "SELECT t.* FROM tag t JOIN article_tag at ON t.id_tag = at.id_tag WHERE at.id_article = ?";
        try (PreparedStatement stmt = connection.prepareStatement(sql)) {
            stmt.setInt(1, articleId);
            try (ResultSet rs = stmt.executeQuery()) {
                while (rs.next()) {
                    Tag t = new Tag();
                    t.setId(rs.getInt("id_tag"));
                    t.setNom(rs.getString("nom"));
                    tags.add(t);
                }
            }
        } catch (SQLException e) {
            System.err.println("ArticleDao.findTagsForArticle error: " + e.getMessage());
        }
        return tags;
    }

    private Article map(ResultSet rs) throws SQLException {
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
        return a;
    }
}