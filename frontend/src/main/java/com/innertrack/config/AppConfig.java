package com.innertrack.config;

import java.util.Properties;

public class AppConfig {

    private static final Properties properties = new Properties();

    static {
        try {
            // Load from external config directory
            java.io.File cf = new java.io.File("frontend/config/application.properties");
            if (!cf.exists()) {
                cf = new java.io.File("config/application.properties");
            }
            if (cf.exists()) {
                java.io.FileInputStream fis = new java.io.FileInputStream(cf);
                properties.load(fis);
            } else {
                System.err.println("Cannot find application.properties in config/ or frontend/config/");
            }
        } catch (java.io.IOException e) {
            throw new RuntimeException(
                    "Cannot load application.properties.",
                    e);
        }
    }

    public static String get(String key) {
        return properties.getProperty(key);
    }
}