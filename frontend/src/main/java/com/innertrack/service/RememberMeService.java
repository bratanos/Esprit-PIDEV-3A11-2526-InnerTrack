package com.innertrack.service;

import com.innertrack.dao.UserDao;
import com.innertrack.model.User;
import com.innertrack.session.SessionManager;
import com.innertrack.security.JwtUtil;

import java.io.*;
import java.nio.file.*;
import java.util.Properties;

/**
 * Persists a "remember me" token to disk so the user stays logged in
 * across app restarts without re-entering credentials.
 *
 * Token file location: {user.home}/.innertrack/remember.properties
 * Contains: email + a JWT token (same one issued at login).
 */
public class RememberMeService {

    private static final RememberMeService INSTANCE = new RememberMeService();
    private static final Path TOKEN_FILE = Paths.get(
            System.getProperty("user.home"), ".innertrack", "remember.properties");

    private RememberMeService() {}

    public static RememberMeService getInstance() { return INSTANCE; }

    // ── Save ──────────────────────────────────────────────────

    /** Call this after successful login when "remember me" is checked. */
    public void save(String email, String jwtToken) {
        try {
            Files.createDirectories(TOKEN_FILE.getParent());
            Properties props = new Properties();
            props.setProperty("email", email);
            props.setProperty("token", jwtToken);
            try (OutputStream out = Files.newOutputStream(TOKEN_FILE)) {
                props.store(out, "InnerTrack remember-me token");
            }
        } catch (IOException e) {
            System.err.println("RememberMeService.save failed: " + e.getMessage());
        }
    }

    /** Call this on logout or when user unchecks "remember me". */
    public void clear() {
        try {
            Files.deleteIfExists(TOKEN_FILE);
        } catch (IOException e) {
            System.err.println("RememberMeService.clear failed: " + e.getMessage());
        }
    }

    public boolean hasToken() {
        return Files.exists(TOKEN_FILE);
    }

    // ── Auto-login ────────────────────────────────────────────

    /**
     * Tries to restore the session from disk.
     * Returns the User if successful, null otherwise.
     * Call this in MainApp.start() before showing any view.
     */
    public User tryAutoLogin() {
        if (!hasToken()) return null;

        try (InputStream in = Files.newInputStream(TOKEN_FILE)) {
            Properties props = new Properties();
            props.load(in);

            String email = props.getProperty("email");
            String token = props.getProperty("token");

            if (email == null || token == null) { clear(); return null; }

            // Validate the JWT hasn't expired
            if (!JwtUtil.isValid(token)) {
                clear();
                return null;
            }

            // Load fresh user from DB
            UserDao userDao = new UserDao();
            User user = userDao.findByEmail(email);
            if (user == null || !"ACTIVE".equals(user.getStatus())) {
                clear();
                return null;
            }

            // Restore session
            SessionManager.getInstance().setCurrentUser(user);
            SessionManager.getInstance().setJwtToken(token);
            SettingsService.getInstance().loadSettings(user.getId());
            userDao.updateLastLogin(user.getId());

            return user;

        } catch (IOException e) {
            System.err.println("RememberMeService.tryAutoLogin failed: " + e.getMessage());
            clear();
            return null;
        }
    }
}