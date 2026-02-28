module com.innertrack {
    requires transitive javafx.graphics;
    requires javafx.controls;
    requires javafx.fxml;
    requires javafx.web;
    requires javafx.swing;
    requires java.net.http;
    requires java.sql;
    requires java.desktop;
    requires com.google.gson;
    requires atlantafx.base;
    requires jakarta.mail;
    requires twilio;

    requires com.sothawo.mapjfx;
    requires io.redlink.geocoding.osm;
    requires io.redlink.geocoding.api;
    requires org.slf4j;

    // Security & JWT
    requires jbcrypt;
    requires jjwt.api;
    requires io.github.cdimascio.dotenv.java;

    // UI Libraries
    requires com.jfoenix;
    requires MaterialFX;
    requires org.kordamp.ikonli.core;
    requires org.kordamp.ikonli.javafx;
    requires org.kordamp.ikonli.fontawesome5;
    requires jdk.jsobject;
    requires itextpdf;

    opens com.innertrack.model to com.google.gson, javafx.base;
    opens com.innertrack.dao to java.sql;
    opens com.innertrack.service to java.base;
    opens com.innertrack.security to jjwt.api;
    opens com.innertrack.controller.admin to javafx.fxml;
    opens com.innertrack.controller.therapist to javafx.fxml;
    opens com.innertrack.controller.user to javafx.fxml;
    opens com.innertrack.controller.profile to javafx.fxml;
    opens com.innertrack.controller.settings to javafx.fxml;
    opens com.innertrack.controller.chat to javafx.fxml;
    opens com.innertrack.controller.community to javafx.fxml;
    opens com.innertrack.controller to javafx.fxml;
    opens com.innertrack.controller.journal to javafx.fxml;
    opens com.innertrack.util to javafx.fxml;

    // Auth resources
    // Removed opens fxml.auth as it is not a valid package

    exports com.innertrack.app;
    exports com.innertrack.model;
    exports com.innertrack.service;
    exports com.innertrack.security;
    exports com.innertrack.session;
    exports com.innertrack.controller.chat; // ← NEW
    exports com.innertrack.controller.admin;
    exports com.innertrack.controller.therapist;
    exports com.innertrack.controller.user;
    exports com.innertrack.controller.profile;
    exports com.innertrack.util;

    opens com.innertrack.app to javafx.fxml;

    exports com.innertrack.controller.auth;

    opens com.innertrack.controller.auth to javafx.fxml;
}