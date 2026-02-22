package com.innertrack.util;

import com.innertrack.service.SettingsService;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.layout.Pane;
import java.io.IOException;

public class ViewManager {

    private static Pane contentContainer;

    public static void setContainer(Pane container) {
        contentContainer = container;
    }

    public static <T> T loadView(String fxmlName) {
        if (contentContainer == null) {
            System.err.println("Error: Content container not set in ViewManager.");
            return null;
        }
        return loadView(fxmlName, contentContainer);
    }

    public static <T> T loadView(String fxmlName, Pane container) {
        try {
            container.getChildren().clear();

            String path = null;
            FXMLLoader loader = null;

            // Prioritize auth/ folder for specific auth views
            if (!fxmlName.contains("/")) {
                java.util.List<String> authViews = java.util.Arrays.asList(
                        "login", "register", "verify_otp", "forgot_password", "reset_password");
                if (authViews.contains(fxmlName)) {
                    path = "/fxml/auth/" + fxmlName + ".fxml";
                    loader = new FXMLLoader(ViewManager.class.getResource(path));
                }
            }

            // Fallback to direct path
            if (loader == null || loader.getLocation() == null) {
                path = "/fxml/" + fxmlName + ".fxml";
                loader = new FXMLLoader(ViewManager.class.getResource(path));
            }

            if (loader.getLocation() == null) {
                System.err.println("Error: FXML resource not found for path: " + path);
                return null;
            }

            // Set resource bundle for i18n
            loader.setResources(SettingsService.getInstance().getBundle());

            Node view = loader.load();

            // Apply the currently active theme to the newly loaded node so
            // it overrides the hardcoded theme-light.css each FXML declares.
            if (view instanceof Parent) {
                SettingsService.getInstance().applyThemeToNode((Parent) view);
            }

            container.getChildren().add(view);
            return loader.getController();

        } catch (IOException e) {
            System.err.println("Error loading view: " + fxmlName + ". " + e.getMessage());
            e.printStackTrace();
            return null;
        }
    }
}