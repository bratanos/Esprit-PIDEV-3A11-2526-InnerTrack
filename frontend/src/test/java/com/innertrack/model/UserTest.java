package com.innertrack.model;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.time.LocalDateTime;
import java.util.Arrays;
import java.util.List;

import static org.junit.jupiter.api.Assertions.*;

class UserTest {

    private User user;

    @BeforeEach
    void setUp() {
        user = new User();
    }

    @Test
    void testGetFullNameWithBothNames() {
        user.setFirstName("John");
        user.setLastName("Doe");
        assertEquals("John Doe", user.getFullName());
    }

    @Test
    void testGetFullNameWithNullFirstName() {
        user.setFirstName(null);
        user.setLastName("Doe");
        assertEquals("Doe", user.getFullName());
    }

    @Test
    void testGetFullNameWithNullLastName() {
        user.setFirstName("John");
        user.setLastName(null);
        assertEquals("John", user.getFullName());
    }

    @Test
    void testGetFullNameWithBothNullReturnsEmptyString() {
        user.setFirstName(null);
        user.setLastName(null);
        assertEquals("", user.getFullName());
    }

    @Test
    void testGetFullNameWithEmptyStringsReturnsEmptyString() {
        user.setFirstName("");
        user.setLastName("");
        assertEquals("", user.getFullName());
    }

    @Test
    void testGetFullNameTrimsTrailingSpaces() {
        user.setFirstName("John");
        user.setLastName(null);
        assertFalse(user.getFullName().endsWith(" "));
    }

    @Test
    void testIsVerifiedDefaultsFalse() {
        assertFalse(user.isVerified());
    }

    @Test
    void testSetVerifiedToTrue() {
        user.setVerified(true);
        assertTrue(user.isVerified());
    }

    @Test
    void testSetAndGetId() {
        user.setId(42);
        assertEquals(42, user.getId());
    }

    @Test
    void testSetAndGetEmail() {
        user.setEmail("john@example.com");
        assertEquals("john@example.com", user.getEmail());
    }

    @Test
    void testSetAndGetPassword() {
        user.setPassword("hashed_password");
        assertEquals("hashed_password", user.getPassword());
    }

    @Test
    void testSetAndGetStatus() {
        user.setStatus("ACTIVE");
        assertEquals("ACTIVE", user.getStatus());
    }

    @Test
    void testSetAndGetPhoneNumber() {
        user.setPhoneNumber("+216 12 345 678");
        assertEquals("+216 12 345 678", user.getPhoneNumber());
    }

    @Test
    void testSetAndGetProfilePicture() {
        user.setProfilePicture("/uploads/profiles/photo.jpg");
        assertEquals("/uploads/profiles/photo.jpg", user.getProfilePicture());
    }

    @Test
    void testRolesDefaultToEmptyList() {
        assertNotNull(user.getRoles());
        assertTrue(user.getRoles().isEmpty());
    }

    @Test
    void testSetAndGetRoles() {
        List<String> roles = Arrays.asList("ROLE_ADMIN", "ROLE_USER");
        user.setRoles(roles);
        assertEquals(2, user.getRoles().size());
        assertTrue(user.getRoles().contains("ROLE_ADMIN"));
        assertTrue(user.getRoles().contains("ROLE_USER"));
    }

    @Test
    void testSetAndGetCreatedAt() {
        LocalDateTime now = LocalDateTime.now();
        user.setCreatedAt(now);
        assertEquals(now, user.getCreatedAt());
    }

    @Test
    void testSetAndGetLastLogin() {
        LocalDateTime loginTime = LocalDateTime.of(2026, 4, 30, 10, 0);
        user.setLastLogin(loginTime);
        assertEquals(loginTime, user.getLastLogin());
    }

    @Test
    void testCreatedAtDefaultsToNull() {
        assertNull(user.getCreatedAt());
    }

    @Test
    void testLastLoginDefaultsToNull() {
        assertNull(user.getLastLogin());
    }
}
