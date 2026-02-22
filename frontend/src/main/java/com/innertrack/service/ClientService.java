package com.innertrack.service;

import com.innertrack.dao.ClientProfileDao;
import com.innertrack.dao.HabitDao;
import com.innertrack.dao.JournalDao;
import com.innertrack.model.ClientProfile;
import com.innertrack.model.HabitEntry;
import com.innertrack.model.JournalEntry;
import com.innertrack.model.User;

import java.time.LocalDate;
import java.util.List;

/**
 * All business logic that belongs to a client (ROLE_USER).
 * Role enforcement lives here — controllers must never bypass this layer.
 * Basic identity (name, picture) is managed through UserDao directly,
 * as it lives on the user table. This service handles extended profile
 * data and all client-exclusive features.
 */
public class ClientService {

    private final ClientProfileDao profileDao = new ClientProfileDao();
    private final JournalDao       journalDao = new JournalDao();
    private final HabitDao         habitDao   = new HabitDao();

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

    // ── Journal ───────────────────────────────────────────────

    public boolean addJournalEntry(User user, JournalEntry entry) {
        assertClient(user);
        validateHumeur(entry.getHumeur());
        entry.setUserId(user.getId());
        if (entry.getDateSaisie() == null) entry.setDateSaisie(LocalDate.now());
        return journalDao.create(entry);
    }

    public List<JournalEntry> getJournalEntries(User user) {
        assertClient(user);
        return journalDao.findByUserId(user.getId());
    }

    public boolean updateJournalEntry(User user, JournalEntry entry) {
        assertClient(user);
        assertOwnsJournal(user, entry.getId());
        validateHumeur(entry.getHumeur());
        return journalDao.update(entry);
    }

    public boolean deleteJournalEntry(User user, int journalId) {
        assertClient(user);
        assertOwnsJournal(user, journalId);
        return journalDao.delete(journalId);
    }

    // ── Habits ────────────────────────────────────────────────

    public boolean addHabitEntry(User user, HabitEntry entry) {
        assertClient(user);
        validateHabitMetrics(entry);
        entry.setUserId(user.getId());
        if (entry.getDateCreation() == null) entry.setDateCreation(LocalDate.now());
        return habitDao.create(entry);
    }

    public List<HabitEntry> getHabits(User user) {
        assertClient(user);
        return habitDao.findByUserId(user.getId());
    }

    public List<HabitEntry> getHabitsForDate(User user, LocalDate date) {
        assertClient(user);
        return habitDao.findByUserAndDate(user.getId(), date);
    }

    public boolean updateHabitEntry(User user, HabitEntry entry) {
        assertClient(user);
        validateHabitMetrics(entry);
        return habitDao.update(entry);
    }

    public boolean deleteHabitEntry(User user, int habitId) {
        assertClient(user);
        return habitDao.delete(habitId);
    }

    // ── Private Guards ────────────────────────────────────────

    private void assertClient(User user) {
        if (user == null || !user.getRoles().contains("ROLE_USER")) {
            throw new SecurityException("Action reserved for clients (ROLE_USER).");
        }
    }

    private void assertOwnsJournal(User user, int journalId) {
        JournalEntry entry = journalDao.findById(journalId);
        if (entry == null || entry.getUserId() != user.getId()) {
            throw new SecurityException("You do not own this journal entry.");
        }
    }

    private void validateHumeur(int humeur) {
        if (humeur < 1 || humeur > 10)
            throw new IllegalArgumentException("Mood (humeur) must be between 1 and 10.");
    }

    private void validateHabitMetrics(HabitEntry entry) {
        if (entry.getNiveauEnergie() < 1 || entry.getNiveauEnergie() > 15)
            throw new IllegalArgumentException("Energy level must be between 1 and 15.");
        if (entry.getNiveauStress() < 1 || entry.getNiveauStress() > 10)
            throw new IllegalArgumentException("Stress level must be between 1 and 10.");
        if (entry.getQualiteSommeil() < 1 || entry.getQualiteSommeil() > 10)
            throw new IllegalArgumentException("Sleep quality must be between 1 and 10.");
    }
}