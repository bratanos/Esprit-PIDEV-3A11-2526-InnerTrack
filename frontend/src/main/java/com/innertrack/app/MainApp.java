package com.innertrack.app;

import atlantafx.base.theme.PrimerLight;
import com.innertrack.model.User;
import com.innertrack.service.RememberMeService;
import com.innertrack.service.SettingsService;
import com.innertrack.util.ViewManager;
import com.innertrack.util.ViewNavigator;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import io.github.cdimascio.dotenv.Dotenv;

public class MainApp extends Application {

    private static Dotenv dotenv;

    private static Stage primaryStage;

    public static String getEnv(String key) {
        if (dotenv == null) {
            try {
                dotenv = Dotenv.configure()
                        .ignoreIfMissing()
                        .load();
            } catch (Exception e) {
                System.err.println("Could not load .env file: " + e.getMessage());
            }
        }
        return dotenv != null ? dotenv.get(key) : null;
    }

    public static Stage getPrimaryStage() {
        return primaryStage;
    }

    @Override
    public void start(Stage stage) throws Exception {
        primaryStage = stage;

        // Set the AtlantaFX theme
        Application.setUserAgentStylesheet(
                new PrimerLight().getUserAgentStylesheet());

        // Load the main layout
        FXMLLoader loader = new FXMLLoader(
                getClass().getResource("/fxml/MainLayout.fxml"));
        loader.setResources(SettingsService.getInstance().getBundle());
        Parent root = loader.load();

        Scene scene = new Scene(root);
        primaryStage.setTitle("InnerTrack - Gestion de Santé Mentale");
        primaryStage.setScene(scene);

        scene.getStylesheets().add(
                getClass()
                        .getResource("/styles/base/typography.css")
                        .toExternalForm());

        primaryStage.show();

        // ── AUTO-LOGIN CHECK (ADDED) ────────────────────────────
        User remembered = RememberMeService.getInstance().tryAutoLogin();

        if (remembered != null) {
            // Valid saved session → go straight to dashboard
            ViewNavigator.navigateToDashboard();
        } else {
            // No saved session → show login
            ViewManager.loadView("login");
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
}