package com.innertrack.util;

import javafx.scene.control.Alert;
import javafx.scene.control.TextInputControl;
import java.time.LocalDate;

public class ValidationUtils {

    public static boolean isNotEmpty(TextInputControl field, String fieldName) {
        if (field.getText() == null || field.getText().trim().isEmpty()) {
            showError(fieldName + " ne peut pas être vide.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean isNotNull(Object object, String fieldName) {
        if (object == null) {
            showError(fieldName + " doit être choisi.");
            return false;
        }
        return true;
    }

    public static boolean hasMinLength(TextInputControl field, String fieldName, int minLength) {
        String text = field.getText().trim();
        if (text.length() < minLength) {
            showError(fieldName + " doit contenir au moins " + minLength + " caractères.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean hasMaxLength(TextInputControl field, String fieldName, int maxLength) {
        String text = field.getText().trim();
        if (text.length() > maxLength) {
            showError(fieldName + " ne peut pas dépasser " + maxLength + " caractères.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean hasLengthBetween(TextInputControl field, String fieldName, int min, int max) {
        String text = field.getText().trim();
        if (text.length() < min || text.length() > max) {
            showError(fieldName + " doit contenir entre " + min + " et " + max + " caractères.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean isValidName(TextInputControl field, String fieldName) {
        String text = field.getText().trim();
        if (!text.matches("^[a-zA-ZÀ-ÿ\\s'-]+$")) {
            showError(fieldName + " ne peut contenir que des lettres, espaces, apostrophes et tirets.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean isValidText(TextInputControl field, String fieldName) {
        String text = field.getText().trim();
        if (!text.matches("^[a-zA-Z0-9À-ÿ\\s.,!?;:'\"-]+$")) {
            showError(fieldName + " contient des caractères non autorisés.");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static boolean isDateSelected(LocalDate date, String fieldName) {
        if (date == null) {
            showError(fieldName + " doit être sélectionnée.");
            return false;
        }
        return true;
    }

    public static boolean isNotFutureDate(LocalDate date, String fieldName) {
        if (date != null && date.isAfter(LocalDate.now())) {
            showError(fieldName + " ne peut pas être dans le futur.");
            return false;
        }
        return true;
    }

    public static boolean isDateInRange(LocalDate date, String fieldName, LocalDate min, LocalDate max) {
        if (date != null) {
            if (date.isBefore(min)) {
                showError(fieldName + " ne peut pas être avant " + min + ".");
                return false;
            }
            if (date.isAfter(max)) {
                showError(fieldName + " ne peut pas être après " + max + ".");
                return false;
            }
        }
        return true;
    }

    public static boolean hasMeaningfulContent(TextInputControl field, String fieldName) {
        String text = field.getText().trim();
        String lettersOnly = text.replaceAll("[^a-zA-ZÀ-ÿ]", "");
        if (lettersOnly.length() < 3) {
            showError(fieldName + " doit contenir du texte significatif (au moins 3 lettres).");
            field.requestFocus();
            return false;
        }
        return true;
    }

    public static void showError(String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("❌ Erreur de validation");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public static void showInfo(String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("✅ Information");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public static void showWarning(String message) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle("⚠️ Attention");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    public static boolean confirmDelete(String itemName) {
        Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
        alert.setTitle("Confirmation de suppression");
        alert.setHeaderText("Supprimer " + itemName + " ?");
        alert.setContentText("Cette action est irréversible.");
        return alert.showAndWait().filter(r -> r == javafx.scene.control.ButtonType.OK).isPresent();
    }
}
