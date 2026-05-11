package com.innertrack.util;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DBConnection {

    private static DBConnection instance;
    private Connection connection;

    private DBConnection() {
        connect();
    }

    private void connect() {
        try {
            // Load from .env, fallback to default local configuration
            String envUrl = com.innertrack.app.MainApp.getEnv("DB_URL");
            String envUser = com.innertrack.app.MainApp.getEnv("DB_USER");
            String envPassword = com.innertrack.app.MainApp.getEnv("DB_PASSWORD");

            String dbUrl = (envUrl != null && !envUrl.isBlank()) ? envUrl : "jdbc:mysql://localhost:3306/testDB";
            String dbUser = (envUser != null && !envUser.isBlank()) ? envUser : "root";
            String dbPassword = envPassword != null ? envPassword : "";

            connection = DriverManager.getConnection(dbUrl, dbUser, dbPassword);
            System.out.println("Connected to database at " + dbUrl);
        } catch (SQLException e) {
            System.err.println("❌ DB Connection failed: " + e.getMessage());
        }
    }

    public static DBConnection getInstance() {
        if (instance == null) {
            instance = new DBConnection();
        }
        return instance;
    }

    public Connection getConnection() {
        try {
            if (connection == null || connection.isClosed()) {
                connect();
            }
        } catch (SQLException e) {
            connect();
        }
        return connection;
    }
}
