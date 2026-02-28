package com.innertrack.util;

public class ReadabilityCalculator {

    public static String calculateLevel(String text) {
        if (text == null || text.trim().isEmpty())
            return "Inconnu";
        int words = countWords(text);
        int sentences = countSentences(text);
        int syllables = countSyllables(text);

        if (words == 0 || sentences == 0)
            return "Inconnu";

        double score = 0.39 * ((double) words / sentences) + 11.8 * ((double) syllables / words) - 15.59;

        if (score < 6)
            return "Facile";
        if (score < 10)
            return "Moyen";
        return "Avancé";
    }

    private static int countWords(String text) {
        if (text == null)
            return 0;
        String[] words = text.trim().split("\\s+");
        return words.length;
    }

    private static int countSentences(String text) {
        if (text == null)
            return 0;
        String[] sentences = text.split("[.!?]+\\s*");
        return sentences.length;
    }

    private static int countSyllables(String text) {
        if (text == null)
            return 0;
        String lower = text.toLowerCase();
        int count = 0;
        boolean prevIsVowel = false;
        for (char c : lower.toCharArray()) {
            boolean isVowel = "aeiouy".indexOf(c) >= 0;
            if (isVowel && !prevIsVowel) {
                count++;
            }
            prevIsVowel = isVowel;
        }
        return count;
    }
}
