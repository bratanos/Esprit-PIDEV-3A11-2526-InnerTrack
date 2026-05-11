module com.innertrack {
    requires transitive javafx.graphics;
    requires transitive javafx.controls;
    requires javafx.fxml;
    requires javafx.web;
    requires javafx.swing;
    requires java.net.http;
    requires java.sql;
    requires transitive java.desktop;
    requires vosk;
    requires com.google.gson;
    requires atlantafx.base;
    requires jakarta.mail;
    requires twilio;
    requires javafx.media;
    requires org.apache.lucene.core;
    requires org.apache.lucene.queryparser;

    requires com.google.zxing;
    requires com.google.zxing.javase;
    requires com.sothawo.mapjfx;
    requires io.redlink.geocoding.osm;
    requires io.redlink.geocoding.api;
    requires org.slf4j;

    // Security & JWT
    requires jbcrypt;
    requires jjwt.api;
    requires io.github.cdimascio.dotenv.java;
    requires com.fasterxml.jackson.databind;

    // UI Libraries
    requires com.jfoenix;
    requires MaterialFX;
    requires org.kordamp.ikonli.core;
    requires org.kordamp.ikonli.javafx;
    requires org.kordamp.ikonli.fontawesome5;
    requires jdk.jsobject;
    requires itextpdf;
    //requires com.innertrack;

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
    opens com.innertrack.controller.article to javafx.fxml;
    opens com.innertrack.controller.chatbot to javafx.fxml;
    opens com.innertrack.controller.event to javafx.fxml;
    opens com.innertrack.util to javafx.fxml;

    exports com.innertrack.app;
    exports com.innertrack.model;
    exports com.innertrack.service;
    exports com.innertrack.security;
    exports com.innertrack.session;
    exports com.innertrack.controller.chat;
    exports com.innertrack.controller.admin;
    exports com.innertrack.controller.therapist;
    exports com.innertrack.controller.user;
    exports com.innertrack.controller.profile;
    exports com.innertrack.controller.article;
    exports com.innertrack.util;
    exports com.innertrack.controller.auth;
    exports com.innertrack.controller.settings;

    opens com.innertrack.app to javafx.fxml;
    opens com.innertrack.controller.auth to javafx.fxml;
}