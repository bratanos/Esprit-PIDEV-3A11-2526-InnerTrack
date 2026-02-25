package com.innertrack.service;

import com.innertrack.dao.UserSettingsDao;
import com.innertrack.model.UserSettings;
import com.innertrack.app.MainApp;
import javafx.application.Platform;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import java.util.Locale;
import java.util.ResourceBundle;

import com.innertrack.util.ViewManager;

public class SettingsService {
    private static SettingsService instance;
    private final UserSettingsDao settingsDao = new UserSettingsDao();
    private UserSettings currentSettings;
    private ResourceBundle bundle;

    private SettingsService() {
        // Default to French — the app's primary language
        bundle = ResourceBundle.getBundle("messages", Locale.FRENCH);
    }

    public static synchronized SettingsService getInstance() {
        if (instance == null) {
            instance = new SettingsService();
        }
        return instance;
    }

    public ResourceBundle getBundle() {
        return bundle;
    }

    public void loadSettings(int userId) {
        currentSettings = settingsDao.findByUserId(userId);
        if (currentSettings == null) {
            // Default: light theme, normal font, French language
            currentSettings = new UserSettings(userId, "LIGHT", "NORMAL", "FR");
            settingsDao.create(currentSettings);
        }
        applyAll();
    }

    public UserSettings getCurrentSettings() {
        if (currentSettings == null) {
            // Fallback so the settings page never NPEs before login
            currentSettings = new UserSettings(0, "LIGHT", "NORMAL", "FR");
        }
        return currentSettings;
    }

    public void updateTheme(String theme) {
        currentSettings.setTheme(theme);
        settingsDao.update(currentSettings);
        applyTheme();
    }

    public void updateFontSize(String fontSize) {
        currentSettings.setFontSize(fontSize);
        settingsDao.update(currentSettings);
        applyFontSize();
    }

    public void updateLanguage(String language) {
        currentSettings.setLanguage(language);
        settingsDao.update(currentSettings);
        applyLanguage();
    }

    public void applyAll() {
        applyTheme();
        applyFontSize();
        applyLanguage();
    }

    // Called by ViewManager after every view load so each new node
    // gets the currently active theme instead of the FXML-hardcoded one.
    public void applyThemeToNode(Parent node) {
        if (node == null || currentSettings == null)
            return;
        String lightCss = getResourcePath("/styles/themes/theme-light.css");
        String darkCss = getResourcePath("/styles/themes/theme-dark.css");
        if (lightCss == null || darkCss == null)
            return;

        node.getStylesheets().remove(lightCss);
        node.getStylesheets().remove(darkCss);
        node.getStylesheets().add("DARK".equals(currentSettings.getTheme()) ? darkCss : lightCss);

        // Sync the CSS class on the node root as well
        node.getStyleClass().removeAll("light-theme", "dark-theme");
        node.getStyleClass().add("DARK".equals(currentSettings.getTheme()) ? "dark-theme" : "light-theme");
    }

    private void applyTheme() {
        Platform.runLater(() -> {
            Stage stage = MainApp.getPrimaryStage();
            if (stage == null || stage.getScene() == null)
                return;
            Scene scene = stage.getScene();

            String lightCss = getResourcePath("/styles/themes/theme-light.css");
            String darkCss = getResourcePath("/styles/themes/theme-dark.css");
            if (lightCss == null || darkCss == null)
                return;

            // Swap theme on scene stylesheet list
            scene.getStylesheets().remove(lightCss);
            scene.getStylesheets().remove(darkCss);
            scene.getStylesheets().add("DARK".equals(currentSettings.getTheme()) ? darkCss : lightCss);

            // Mark the root node so descendant rules like .dark-theme .label work
            Parent root = scene.getRoot();
            root.getStyleClass().removeAll("light-theme", "dark-theme");
            root.getStyleClass().add("DARK".equals(currentSettings.getTheme()) ? "dark-theme" : "light-theme");

            // Stamp all currently loaded child nodes too
            applyThemeClassToChildren(root);

            root.applyCss();
            root.layout();
        });
    }

    // Recursively stamps .dark-theme / .light-theme on every Parent in the tree
    // so rules like ".dark-theme .dashboard-card" always have a matching ancestor.
    private void applyThemeClassToChildren(Parent parent) {
        String themeClass = "DARK".equals(currentSettings.getTheme()) ? "dark-theme" : "light-theme";
        parent.getStyleClass().removeAll("light-theme", "dark-theme");
        parent.getStyleClass().add(themeClass);
        for (javafx.scene.Node child : parent.getChildrenUnmodifiable()) {
            if (child instanceof Parent) {
                applyThemeClassToChildren((Parent) child);
            }
        }
    }

    private void applyFontSize() {
        Platform.runLater(() -> {
            Stage stage = MainApp.getPrimaryStage();
            if (stage == null || stage.getScene() == null)
                return;
            Parent root = stage.getScene().getRoot();

            root.getStyleClass().removeAll("font-small", "font-normal", "font-large");
            String fontClass = "font-" + currentSettings.getFontSize().toLowerCase();
            root.getStyleClass().add(fontClass);

            root.applyCss();
            root.layout();
        });
    }

    private void applyLanguage() {
        Locale locale = "FR".equals(currentSettings.getLanguage()) ? Locale.FRENCH : Locale.ENGLISH;
        Locale.setDefault(locale);
        bundle = ResourceBundle.getBundle("messages", locale);

        Platform.runLater(() -> {
            ViewManager.reloadCurrentView();
        });
    }

    public String getString(String key) {
        try {
            return bundle.getString(key);
        } catch (Exception e) {
            return key; // Graceful fallback: show the key if missing
        }
    }

    private String getResourcePath(String path) {
        try {
            return getClass().getResource(path).toExternalForm();
        } catch (Exception e) {
            System.err.println("SettingsService: could not find resource: " + path);
            return null;
        }
    }

}