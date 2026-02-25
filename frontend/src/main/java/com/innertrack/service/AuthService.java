package com.innertrack.service;

import com.innertrack.dao.ClientProfileDao;
import com.innertrack.dao.EmailVerificationCodeDao;
import com.innertrack.dao.TherapistProfileDao;
import com.innertrack.dao.UserDao;
import com.innertrack.model.ClientProfile;
import com.innertrack.model.EmailVerificationCode;
import com.innertrack.model.TherapistProfile;
import com.innertrack.model.User;
import com.innertrack.security.BCryptHasher;
import com.innertrack.security.JwtUtil;
import com.innertrack.session.SessionManager;

import java.time.LocalDateTime;
import java.util.List;
import java.util.Random;

public class AuthService {
    private final UserDao userDao = new UserDao();
    private final EmailVerificationCodeDao otpDao = new EmailVerificationCodeDao();
    private final ClientProfileDao clientProfileDao = new ClientProfileDao();
    private final TherapistProfileDao therapistProfileDao = new TherapistProfileDao();

    public String register(String email, String password, String firstName, String lastName,
            List<String> requestedRoles) {
         if (requestedRoles.contains("ROLE_ADMIN")) {
         return "Registration for Admin is not allowed.";
         }
        if (userDao.findByEmail(email) != null) {
            return "User already exists.";
        }

        User user = new User();
        user.setEmail(email);
        user.setPassword(BCryptHasher.hash(password));
        user.setFirstName(firstName);
        user.setLastName(lastName);
        user.setRoles(requestedRoles);
        user.setVerified(false);
        user.setStatus("PENDING");

        try {
            if (userDao.create(user)) {
                // Reload to get the generated ID
                user = userDao.findByEmail(email);

                // Auto-create the role-specific profile row so downstream
                // services never get a null profile on first login.
                createProfileForUser(user);

                sendNewOtp(user);
                return "SUCCESS";
            }
        } catch (Exception e) {
            System.err.println("Error creating user: " + e.getMessage());
        }
        return "Registration failed.";
    }

    /**
     * Creates the appropriate profile row based on the user's role.
     * Called automatically after registration and can be called defensively
     * from services if a legacy user has no profile yet.
     */
    public void createProfileForUser(User user) {
        if (user == null)
            return;
        List<String> roles = user.getRoles();
        if (roles.contains("ROLE_PSYCHOLOGUE")) {
            if (therapistProfileDao.findByUserId(user.getId()) == null) {
                therapistProfileDao.create(new TherapistProfile(user.getId()));
            }
        } else if (roles.contains("ROLE_USER")) {
            if (clientProfileDao.findByUserId(user.getId()) == null) {
                clientProfileDao.create(new ClientProfile(user.getId()));
            }
        }
        // ROLE_ADMIN has no profile table
    }

    public void sendNewOtp(User user) {
        String code = String.format("%06d", new Random().nextInt(1000000));
        EmailVerificationCode evc = new EmailVerificationCode();
        evc.setUser(user);
        evc.setCode(code);
        evc.setExpiresAt(LocalDateTime.now().plusMinutes(10));
        evc.setLastSentAt(LocalDateTime.now());
        evc.setResendAttempts(1);
        evc.setVerifyAttempts(0);
        otpDao.create(evc);
        EmailService.getInstance().sendVerificationEmail(user.getEmail(), code);
    }

    public String verifyOtp(String email, String code) {
        User user = userDao.findByEmail(email);
        if (user == null)
            return "User not found.";
        if (user.isVerified())
            return "User already verified.";

        EmailVerificationCode evc = otpDao.findByUserId(user.getId());
        if (evc == null)
            return "No verification code found.";
        if (evc.getExpiresAt().isBefore(LocalDateTime.now()))
            return "Code expired.";
        if (evc.getVerifyAttempts() >= 5)
            return "Too many failed attempts. Request a new code.";

        if (!evc.getCode().equals(code)) {
            evc.setVerifyAttempts(evc.getVerifyAttempts() + 1);
            otpDao.update(evc);
            return "Invalid code.";
        }

        userDao.updateStatus(user.getId(), "ACTIVE", true);
        evc.setUsedAt(LocalDateTime.now());
        otpDao.update(evc);
        return "SUCCESS";
    }

    public String resendOtp(String email) {
        User user = userDao.findByEmail(email);
        if (user == null)
            return "User not found.";
        if (user.isVerified())
            return "User already verified.";

        EmailVerificationCode evc = otpDao.findByUserId(user.getId());
        if (evc == null) {
            sendNewOtp(user);
            return "SUCCESS";
        }
        if (evc.getLastSentAt().isAfter(LocalDateTime.now().minusSeconds(60))) {
            return "Wait before requesting another code.";
        }
        if (evc.getResendAttempts() >= 3
                && evc.getLastSentAt().isAfter(LocalDateTime.now().minusMinutes(5))) {
            return "Too many requests. Try later.";
        }

        String code = String.format("%06d", new Random().nextInt(1000000));
        evc.setCode(code);
        evc.setExpiresAt(LocalDateTime.now().plusMinutes(10));
        evc.setLastSentAt(LocalDateTime.now());
        evc.setResendAttempts(evc.getResendAttempts() + 1);
        evc.setVerifyAttempts(0);
        otpDao.update(evc);
        EmailService.getInstance().sendVerificationEmail(user.getEmail(), code);
        return "SUCCESS";
    }

    public String login(String email, String password) {
        User user = userDao.findByEmail(email);
        if (user == null)
            return "Invalid credentials.";
        if (!BCryptHasher.check(password, user.getPassword()))
            return "Invalid credentials.";

        if (!user.isVerified() || !"ACTIVE".equals(user.getStatus())) {
            if ("BLOCKED".equals(user.getStatus())) {
                return "Your account has been blocked. Please contact an admin.";
            }
            return "Account not verified. Please verify your email.";
        }

        // Ensure profile exists for legacy users who registered before profiles were
        // introduced
        createProfileForUser(user);

        String token = JwtUtil.generateToken(user.getEmail(), user.getRoles());
        SessionManager.getInstance().setCurrentUser(user);
        SessionManager.getInstance().setJwtToken(token);
        userDao.updateLastLogin(user.getId());
        SettingsService.getInstance().loadSettings(user.getId());

        return "SUCCESS";
    }

    public String requestPasswordReset(String email) {
        User user = userDao.findByEmail(email);
        if (user == null)
            return "Email non trouvé.";

        String code = String.format("%06d", new java.util.Random().nextInt(999999));
        com.innertrack.dao.PasswordResetDao resetDao = new com.innertrack.dao.PasswordResetDao();
        if (resetDao.create(user.getId(), code)) {
            EmailService.getInstance().sendPasswordResetEmail(email, code);
            return "SUCCESS";
        }
        return "Erreur lors de la génération du code.";
    }

    public String resetPassword(String email, String code, String newPassword) {
        com.innertrack.dao.PasswordResetDao resetDao = new com.innertrack.dao.PasswordResetDao();
        int userId = resetDao.findUserIdByValidCode(email, code);
        if (userId == -1)
            return "Code invalide ou expiré.";

        String hashed = org.mindrot.jbcrypt.BCrypt.hashpw(newPassword, org.mindrot.jbcrypt.BCrypt.gensalt());
        if (userDao.updatePassword(userId, hashed)) {
            resetDao.markAsUsed(userId, code);
            return "SUCCESS";
        }
        return "Erreur lors de la mise à jour du mot de passe.";
    }
}