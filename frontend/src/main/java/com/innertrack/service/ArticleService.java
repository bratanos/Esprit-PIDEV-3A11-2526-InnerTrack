package com.innertrack.service;

import com.innertrack.dao.ArticleDao;
import com.innertrack.dao.CategorieDao;
import com.innertrack.model.Article;
import com.innertrack.model.Categorie;
import com.innertrack.util.ArticleIndexer;
import com.innertrack.util.ReadabilityCalculator;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Enhanced ArticleService with Search, Readability, and CRUD.
 */
public class ArticleService {

    private final ArticleDao articleDao = new ArticleDao();
    private final CategorieDao categorieDao = new CategorieDao();
    private ArticleIndexer indexer;

    public ArticleService() {
        try {
            this.indexer = new ArticleIndexer();
        } catch (IOException e) {
            System.err.println("Failed to initialize ArticleIndexer: " + e.getMessage());
        }
    }

    public boolean addArticle(Article a) {
        boolean success = articleDao.create(a);
        if (success && indexer != null) {
            try {
                indexer.indexArticle(a);
            } catch (IOException e) {
                System.err.println("Indexing error: " + e.getMessage());
            }
        }
        return success;
    }

    public boolean updateArticle(Article a) {
        boolean success = articleDao.update(a);
        if (success && indexer != null) {
            try {
                indexer.updateArticle(a);
            } catch (IOException e) {
                System.err.println("Indexing update error: " + e.getMessage());
            }
        }
        return success;
    }

    public boolean deleteArticle(int id) {
        boolean success = articleDao.delete(id);
        if (success && indexer != null) {
            try {
                indexer.deleteArticle(id);
            } catch (IOException e) {
                System.err.println("Indexing delete error: " + e.getMessage());
            }
        }
        return success;
    }

    public List<Article> getAllArticles() {
        return articleDao.findAll();
    }

    public List<Article> getAllArticlesWithCategory() {
        return articleDao.findAllWithCategory();
    }

    public Article getById(int id) {
        return articleDao.findById(id);
    }

    public List<Article> getByCategorie(int categorieId) {
        return articleDao.findByCategorie(categorieId);
    }

    public List<Categorie> getAllCategories() {
        return categorieDao.findAll();
    }

    public boolean existsByTitre(String titre) {
        return articleDao.existsByTitre(titre);
    }

    public boolean existsByTitreExcludingId(String titre, int id) {
        return articleDao.existsByTitreExcludingId(titre, id);
    }

    public List<Article> search(String query) {
        if (indexer == null)
            return new ArrayList<>();
        try {
            List<Integer> ids = indexer.search(query, 50);
            List<Article> results = new ArrayList<>();
            for (int id : ids) {
                Article a = articleDao.findById(id);
                if (a != null) {
                    // Enrich with category name
                    for (Categorie c : getAllCategories()) {
                        if (c.getId() == a.getCategorieId()) {
                            a.setCategorieNom(c.getNom());
                            break;
                        }
                    }
                    results.add(a);
                }
            }
            return results;
        } catch (Exception e) {
            System.err.println("Search error: " + e.getMessage());
            return new ArrayList<>();
        }
    }

    public void reindexAll() {
        if (indexer == null)
            return;
        try {
            indexer.clearIndex();
            List<Article> all = articleDao.findAll();
            for (Article a : all) {
                indexer.indexArticle(a);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    /**
     * Calculates readability level for an article.
     */
    public void updateReadability(Article a) {
        String level = ReadabilityCalculator.calculateLevel(a.getContenu());
        a.setReadability(level);
    }
}