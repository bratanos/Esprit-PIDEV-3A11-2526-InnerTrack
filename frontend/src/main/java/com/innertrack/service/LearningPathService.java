package com.innertrack.service;

import com.innertrack.dao.LearningPathDao;
import com.innertrack.model.Article;
import com.innertrack.model.LearningPath;
import com.innertrack.model.User;

import java.time.LocalDate;
import java.util.List;

public class LearningPathService {
    private final LearningPathDao learningPathDao = new LearningPathDao();

    public List<LearningPath> getAllPaths() {
        return learningPathDao.findAll();
    }

    public LearningPath getById(int id) {
        LearningPath path = learningPathDao.findById(id);
        if (path != null) {
            path.setArticles(learningPathDao.findArticlesInPath(id));
        }
        return path;
    }

    public boolean createPath(LearningPath path) {
        if (path.getDateCreation() == null)
            path.setDateCreation(LocalDate.now());
        return learningPathDao.create(path);
    }

    public boolean createPath(User user, LearningPath path) {
        path.setCreatedById(user.getId());
        return createPath(path);
    }

    public List<LearningPath> getPathsForArticle(int articleId) {
        return learningPathDao.findPathsByArticle(articleId);
    }

    public List<Article> getArticlesInPath(int pathId) {
        return learningPathDao.findArticlesInPath(pathId);
    }

    public boolean updatePathArticles(int pathId, List<Article> articles) {
        learningPathDao.clearArticlesFromPath(pathId);
        for (int i = 0; i < articles.size(); i++) {
            learningPathDao.addArticleToPath(pathId, articles.get(i).getId(), i + 1);
        }
        return true;
    }

    public boolean updatePath(LearningPath path) {
        return learningPathDao.update(path);
    }

    public boolean deletePath(int id) {
        return learningPathDao.delete(id);
    }

    public boolean addArticleToPath(int pathId, int articleId, int order) {
        return learningPathDao.addArticleToPath(pathId, articleId, order);
    }

    public boolean removeArticleFromPath(int pathId, int articleId) {
        return learningPathDao.removeArticleFromPath(pathId, articleId);
    }
}
