package com.innertrack.service;

import com.innertrack.dao.ArticleDao;
import com.innertrack.dao.CategorieDao;
import com.innertrack.model.Article;
import com.innertrack.model.Categorie;

import java.util.List;

/**
 * Read-only article access for all authenticated users.
 * No role restriction on reading — both clients and therapists can browse articles.
 * Writing is handled exclusively by TherapistService.
 */
public class ArticleService {

    private final ArticleDao  articleDao  = new ArticleDao();
    private final CategorieDao categorieDao = new CategorieDao();

    public List<Article> getAllArticles() {
        return articleDao.findAll();
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
}