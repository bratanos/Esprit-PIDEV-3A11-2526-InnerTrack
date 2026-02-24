package com.innertrack.controller.auth;

import com.innertrack.session.SessionManager;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Hyperlink;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;

import java.time.Year;

public class MainLayoutController {

    private static MainLayoutController instance;

    @FXML
    private HBox navbar;

    @FXML
    private javafx.scene.layout.StackPane contentContainer;

    @FXML
    private Hyperlink loginLink;

    @FXML
    private Hyperlink registerLink;

    @FXML
    private Button profileBtn;

    @FXML
    private Label footerLabel;

    public static MainLayoutController getInstance() {
        return instance;
    }

    @FXML
    private VBox footer;

    public void setNavbarVisible(boolean visible) {
        navbar.setVisible(visible);
        navbar.setManaged(visible);
    }

    public void setFooterVisible(boolean visible) {
        footer.setVisible(visible);
        footer.setManaged(visible);
    }

    @FXML
    public void initialize() {
        instance = this;
        ViewManager.setContainer(contentContainer);
        footerLabel.setText("© " + Year.now().getValue() + " InnerTrack — All rights reserved");
        updateUiForSession();
    }

    public void updateUiForSession() {
        boolean loggedIn = SessionManager.getInstance().getCurrentUser() != null;
        loginLink.setVisible(!loggedIn);
        registerLink.setVisible(!loggedIn);
        profileBtn.setVisible(loggedIn);
    }

    @FXML
    private void goToHome() {
        var currentUser = SessionManager.getInstance().getCurrentUser();
        if (currentUser == null) {
            ViewManager.loadView("main");
            return;
        }

        var roles = currentUser.getRoles();
        String dashboardView;
        if (roles != null && roles.contains("ROLE_ADMIN")) {
            dashboardView = "admin/dashboard";
        } else if (roles != null && roles.contains("ROLE_PSYCHOLOGUE")) {
            dashboardView = "psychologue/dashboard";
        } else {
            dashboardView = "user/dashboard";
        }

        ViewManager.loadView(dashboardView);
    }

    @FXML
    private void goToLogin() {
        ViewManager.loadView("login");
    }

    @FXML
    private void goToRegister() {
        ViewManager.loadView("register");
    }
}
