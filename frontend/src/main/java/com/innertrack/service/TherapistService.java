package com.innertrack.service;

import com.innertrack.dao.ArticleDao;
import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.model.Article;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;

import java.time.LocalDate;
import java.util.List;

/**
 * All business logic that belongs to a therapist (ROLE_PSYCHOLOGUE).
 * Role enforcement lives here — controllers must never bypass this layer.
 * Basic identity (name, picture) is managed through UserDao directly.
 * This service handles extended profile data and therapist-exclusive features.
 */
public class TherapistService {

    private final TherapistProfileDao profileDao = new TherapistProfileDao();
    private final ArticleDao          articleDao = new ArticleDao();

    // ── Extended Profile ──────────────────────────────────────

    /**
     * Returns the therapist's extended profile (specialization, license, bio).
     * Creates a blank one if it doesn't exist — safe to call at any time.
     */
    public TherapistProfile getOrCreateProfile(User user) {
        assertTherapist(user);
        TherapistProfile profile = profileDao.findByUserId(user.getId());
        if (profile == null) {
            profile = new TherapistProfile(user.getId());
            profileDao.create(profile);
        }
        return profile;
    }

    public boolean updateProfile(User user, TherapistProfile profile) {
        assertTherapist(user);
        if (profile.getUserId() != user.getId()) {
            throw new SecurityException("Profile does not belong to the current user.");
        }
        return profileDao.update(profile);
    }

    // ── Articles ──────────────────────────────────────────────

    public boolean publishArticle(User user, Article article) {
        assertTherapist(user);
        validateArticle(article);
        article.setAuteurUserId(user.getId());
        if (article.getDatePublication() == null) article.setDatePublication(LocalDate.now());
        return articleDao.create(article);
    }

    public boolean updateArticle(User user, Article article) {
        assertTherapist(user);
        assertOwnsArticle(user, article.getId());
        validateArticle(article);
        return articleDao.update(article);
    }

    public boolean deleteArticle(User user, int articleId) {
        assertTherapist(user);
        assertOwnsArticle(user, articleId);
        return articleDao.delete(articleId);
    }

    public List<Article> getAllArticles(User user) {
        assertTherapist(user);
        return articleDao.findAll();
    }

    public List<Article> getMyArticles(User user) {
        assertTherapist(user);
        return articleDao.findByAuteur(user.getId());
    }

    // ── Private Guards ────────────────────────────────────────

    private void assertTherapist(User user) {
        if (user == null || !user.getRoles().contains("ROLE_PSYCHOLOGUE")) {
            throw new SecurityException("Action reserved for therapists (ROLE_PSYCHOLOGUE).");
        }
    }

    private void assertOwnsArticle(User user, int articleId) {
        Article article = articleDao.findById(articleId);
        if (article == null || article.getAuteurUserId() != user.getId()) {
            throw new SecurityException("You do not own this article.");
        }
    }

    private void validateArticle(Article article) {
        if (article.getTitre() == null || article.getTitre().isBlank())
            throw new IllegalArgumentException("Article title cannot be empty.");
        if (article.getContenu() == null || article.getContenu().isBlank())
            throw new IllegalArgumentException("Article content cannot be empty.");
    }
}