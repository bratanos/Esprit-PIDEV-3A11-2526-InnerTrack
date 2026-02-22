package com.innertrack.app;

import atlantafx.base.theme.PrimerLight;
import com.innertrack.util.ViewManager;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;


public class MainApp extends Application {
    private static Stage primaryStage;

    public static Stage getPrimaryStage() {
        return primaryStage;
    }

    @Override
    public void start(Stage stage) throws Exception {
        primaryStage = stage;
        // Set the AtlantaFX theme
        Application.setUserAgentStylesheet(new PrimerLight().getUserAgentStylesheet());



        // Load the main layout
        FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/MainLayout.fxml"));
        Parent root = loader.load();

        Scene scene = new Scene(root);
        primaryStage.setTitle("InnerTrack - Gestion de Santé Mentale");
        primaryStage.setScene(scene);
        primaryStage.show();
        scene.getStylesheets().add(
                getClass().getResource("/styles/base/typography.css").toExternalForm()
        );

        // Load the initial view (login or main)
        ViewManager.loadView("login");
    }

    public static void main(String[] args) {
        launch(args);
    }
}
