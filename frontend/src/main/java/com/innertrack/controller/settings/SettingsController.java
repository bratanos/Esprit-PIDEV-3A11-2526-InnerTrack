package com.innertrack.controller.settings;

import com.innertrack.util.ViewManager;
import com.innertrack.session.SessionManager;
import javafx.fxml.FXML;
import javafx.scene.control.TabPane;

public class SettingsController {

    @FXML
    private TabPane settingsTabPane;

    @FXML
    public void initialize() {
        // Stop monitoring if the user switches away from the Audio tab
        settingsTabPane.getSelectionModel().selectedItemProperty().addListener((obs, oldTab, newTab) -> {
            if (newTab != null && !newTab.getText().contains("Audio")) {
                com.innertrack.service.AudioDeviceService.getInstance().stopMonitoring();
            }
        });
    }

    @FXML
    private void handleBack() {
        // Stop any active mic monitoring when leaving settings
        com.innertrack.service.AudioDeviceService.getInstance().stopMonitoring();

        String role = SessionManager.getInstance().getCurrentUser().getRoles().get(0);
        if (role.contains("ADMIN")) {
            ViewManager.loadView("admin/dashboard");
        } else if (role.contains("PSYCHOLOGUE")) {
            ViewManager.loadView("psychologue/dashboard");
        } else {
            ViewManager.loadView("user/dashboard");
        }
    }
}
