package com.innertrack.util;

import com.innertrack.service.SettingsService;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.layout.Pane;
import java.io.IOException;
import java.io.InputStream;
import java.io.PushbackInputStream;
import java.net.URL;

public class ViewManager {

    private static Pane contentContainer;
    private static String currentActiveView;

    public static void setContainer(Pane container) {
        contentContainer = container;
    }

    public static <T> T loadView(String fxmlName) {
        currentActiveView = fxmlName;
        if (contentContainer == null) {
            System.err.println("Error: Content container not set in ViewManager.");
            return null;
        }
        return loadView(fxmlName, contentContainer);
    }

    public static void reloadCurrentView() {
        if (currentActiveView != null && contentContainer != null) {
            loadView(currentActiveView, contentContainer);
        }
    }

    public static <T> T loadView(String fxmlName, Pane container) {
        try {
            container.getChildren().clear();

            String path = null;
            URL location = null;

            // List of common fxml subdirectories to search in if not found directly
            String[] subdirs = { "", "auth/", "user/", "admin/", "psychologue/", "settings/" };

            for (String subdir : subdirs) {
                String testPath = "/fxml/" + subdir + fxmlName + ".fxml";
                location = ViewManager.class.getResource(testPath);
                if (location != null) {
                    path = testPath;
                    break;
                }
            }

            if (location == null && fxmlName.contains("/")) {
                path = "/fxml/" + fxmlName + ".fxml";
                location = ViewManager.class.getResource(path);
            }

            if (location == null) {
                System.err.println("Error: FXML resource not found for fxmlName: " + fxmlName);
                return null;
            }

            FXMLLoader loader = new FXMLLoader(location);

            // Set resource bundle for i18n
            loader.setResources(SettingsService.getInstance().getBundle());

            // Load through BOM-stripping stream so UTF-8 BOM files never crash
            Node view = loader.load(stripBom(location.openStream()));

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

    /**
     * Strips the UTF-8 BOM (EF BB BF) from the beginning of a stream if present.
     * This avoids XMLStreamException "Contenu non autorisé dans le prologue"
     * which occurs when FXML files are saved with BOM encoding.
     */
    private static InputStream stripBom(InputStream in) throws IOException {
        PushbackInputStream pb = new PushbackInputStream(in, 3);
        byte[] bom = new byte[3];
        int read = pb.read(bom, 0, 3);
        if (read == 3 && bom[0] == (byte) 0xEF && bom[1] == (byte) 0xBB && bom[2] == (byte) 0xBF) {
            // BOM detected — discard it, stream now starts at the real content
            return pb;
        } else {
            // No BOM — push the bytes back so nothing is lost
            if (read > 0)
                pb.unread(bom, 0, read);
            return pb;
        }
    }
}