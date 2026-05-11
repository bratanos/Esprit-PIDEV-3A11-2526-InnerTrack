package com.innertrack.session;

import com.innertrack.model.Article;
import com.innertrack.model.Categorie;
import com.innertrack.model.LearningPath;
import com.innertrack.model.User;
import com.innertrack.service.RememberMeService;

public class SessionManager {
    private static SessionManager instance;
    private User currentUser;
    private String jwtToken;

    private SessionManager() {
    }

    public static SessionManager getInstance() {
        if (instance == null) {
            instance = new SessionManager();
        }
        return instance;
    }

    public User getCurrentUser() {
        return currentUser;
    }

    public void setCurrentUser(User currentUser) {
        this.currentUser = currentUser;
    }

    public String getJwtToken() {
        return jwtToken;
    }

    public void setJwtToken(String jwtToken) {
        this.jwtToken = jwtToken;
    }

    private Categorie currentCategory;
    private Article currentArticle;

    public Categorie getCurrentCategory() { return currentCategory; }
    public void setCurrentCategory(Categorie cat) { this.currentCategory = cat; }

    public Article getCurrentArticle() { return currentArticle; }
    public void setCurrentArticle(Article art) { this.currentArticle = art; }
    public void logout() {
        cleanSession();
    }

    public void cleanSession() {
        currentUser = null;
        jwtToken = null;

        RememberMeService.getInstance().clear();
    }

    private LearningPath currentLearningPath;

    public LearningPath getCurrentLearningPath() { return currentLearningPath; }
    public void setCurrentLearningPath(LearningPath lp) { this.currentLearningPath = lp; }
}
