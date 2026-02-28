package com.innertrack.service;

import com.innertrack.dao.ClientProfileDao;
import com.innertrack.model.ClientProfile;

import com.innertrack.model.User;

/**
 * All business logic that belongs to a client (ROLE_USER).
 * Role enforcement lives here — controllers must never bypass this layer.
 * Basic identity (name, picture) is managed through UserDao directly,
 * as it lives on the user table. This service handles extended profile
 * data and all client-exclusive features.
 */
public class ClientService {

    private final ClientProfileDao profileDao = new ClientProfileDao();

    // ── Extended Profile ──────────────────────────────────────

    /**
     * Returns the client's extended profile (bio, date of birth).
     * Creates a blank one if it doesn't exist — safe to call at any time.
     */
    public ClientProfile getOrCreateProfile(User user) {
        assertClient(user);
        ClientProfile profile = profileDao.findByUserId(user.getId());
        if (profile == null) {
            profile = new ClientProfile(user.getId());
            profileDao.create(profile);
        }
        return profile;
    }

    public boolean updateProfile(User user, ClientProfile profile) {
        assertClient(user);
        if (profile.getUserId() != user.getId()) {
            throw new SecurityException("Profile does not belong to the current user.");
        }
        return profileDao.update(profile);
    }

    // ── Private Guards ────────────────────────────────────────

    private void assertClient(User user) {
        if (user == null || !user.getRoles().contains("ROLE_USER")) {
            throw new SecurityException("Action reserved for clients (ROLE_USER).");
        }
    }
}