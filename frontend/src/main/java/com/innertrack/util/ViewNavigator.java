package com.innertrack.util;

import com.innertrack.model.User;
import com.innertrack.session.SessionManager;

public class ViewNavigator {
    public static void navigateToDashboard() {
        User user = SessionManager.getInstance().getCurrentUser();
        if (user == null) {
            ViewManager.loadView("login");
            return;
        }

        // Check roles list — never use instanceof since AuthService sets plain User objects
        if (hasRole(user, "ROLE_ADMIN")) {
            ViewManager.loadView("admin/dashboard");
        } else if (hasRole(user, "ROLE_PSYCHOLOGUE")) {
            ViewManager.loadView("psychologue/dashboard");
        } else {
            ViewManager.loadView("user/dashboard");
        }
    }

    public static boolean hasRole(User user, String role) {
        return user != null
                && user.getRoles() != null
                && user.getRoles().contains(role);
    }

    public static boolean isAdmin()      { return hasRole(SessionManager.getInstance().getCurrentUser(), "ROLE_ADMIN"); }
    public static boolean isTherapist()  { return hasRole(SessionManager.getInstance().getCurrentUser(), "ROLE_PSYCHOLOGUE"); }
    public static boolean isClient()     { return hasRole(SessionManager.getInstance().getCurrentUser(), "ROLE_USER"); }
}