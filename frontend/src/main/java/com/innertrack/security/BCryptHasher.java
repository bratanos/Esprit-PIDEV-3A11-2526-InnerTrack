package com.innertrack.security;

import org.mindrot.jbcrypt.BCrypt;

public class BCryptHasher {
    public static String hash(String password) {
        return BCrypt.hashpw(password, BCrypt.gensalt());
    }

    /**
     * Normalises the bcrypt prefix so that hashes produced by
     * PHP / Symfony ($2y$) or older Java libs ($2b$) are accepted
     * by jBCrypt, which only understands $2a$.
     * All three variants are functionally identical.
     */
    private static String normaliseHash(String hash) {
        if (hash != null && (hash.startsWith("$2y$") || hash.startsWith("$2b$"))) {
            return "$2a$" + hash.substring(4);
        }
        return hash;
    }

    public static boolean check(String password, String hashed) {
        try {
            return BCrypt.checkpw(password, normaliseHash(hashed));
        } catch (Exception e) {
            System.err.println("BCrypt check error: " + e.getMessage());
            return false;
        }
    }
}
