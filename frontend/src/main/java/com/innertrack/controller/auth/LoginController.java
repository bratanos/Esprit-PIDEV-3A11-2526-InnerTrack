package com.innertrack.controller.auth;

import com.innertrack.service.AuthService;
import com.innertrack.util.ViewManager;
import javafx.fxml.FXML;
import javafx.scene.control.CheckBox;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import java.util.List;

public class LoginController {

    @FXML
    private TextField emailField;

    @FXML
    private PasswordField passwordField;

    @FXML
    private Label errorLabel;

    // Remember Me checkbox
    @FXML
    private CheckBox rememberMeCheckbox;

    private final AuthService authService = new AuthService();

    @FXML
    public void initialize() {
        MainLayoutController.getInstance().setNavbarVisible(false);
    }

    @FXML
    private void handleLogin() {
        String email = emailField.getText();
        String password = passwordField.getText();

        if (email.isEmpty() || password.isEmpty()) {
            errorLabel.setText("Veuillez remplir tous les champs.");
            return;
        }

        String result = (String) authService.login(email, password);

        if ("SUCCESS".equals(result)) {
            System.out.println("Login successful for user: " + email);

            //  REMEMBER ME LOGIC (added here)
            if (rememberMeCheckbox != null && rememberMeCheckbox.isSelected()) {
                String token = com.innertrack.session.SessionManager
                        .getInstance()
                        .getJwtToken();

                com.innertrack.service.RememberMeService
                        .getInstance()
                        .save(email, token);
            } else {
                // Clear any old token if unchecked
                com.innertrack.service.RememberMeService
                        .getInstance()
                        .clear();
            }

            // Determine redirection based on role
            com.innertrack.model.User user =
                    com.innertrack.session.SessionManager
                            .getInstance()
                            .getCurrentUser();

            List<String> roles = user.getRoles();
            String dashboardView;

            if (roles.contains("ROLE_ADMIN")) {
                dashboardView = "admin/dashboard";
            } else if (roles.contains("ROLE_PSYCHOLOGUE")) {
                dashboardView = "psychologue/dashboard";
            } else {
                dashboardView = "user/dashboard";
            }

            System.out.println("Redirecting to: " + dashboardView);
            ViewManager.loadView(dashboardView);

            // Update UI for logged-in session
            MainLayoutController.getInstance().updateUiForSession();

        } else {
            System.err.println("Login failed: " + result);

            if ("Account not verified. Please verify your email.".equals(result)) {
                VerifyOtpController controller = ViewManager.loadView("verify_otp");
                if (controller != null) {
                    controller.setEmail(email);
                }
            } else {
                errorLabel.setText(result);
            }
        }
    }

    @FXML
    private void goToRegister() {
        ViewManager.loadView("register");
    }

    @FXML
    private void goToForgotPassword() {
        ViewManager.loadView("forgot_password");
    }
}