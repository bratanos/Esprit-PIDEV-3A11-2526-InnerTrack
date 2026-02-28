package com.innertrack.util;

import com.innertrack.model.Article;
import java.util.*;
import java.util.stream.Collectors;

public class KeywordExtractor {

    private static final Set<String> STOP_WORDS = new HashSet<>(Arrays.asList(
            "le", "la", "les", "un", "une", "des", "du", "de", "d", "l", "et", "à", "a",
            "est", "sont", "dans", "pour", "sur", "par", "avec", "ce", "cet", "cette",
            "ces", "mon", "ton", "son", "ma", "ta", "sa", "mes", "tes", "ses", "notre",
            "votre", "leur", "nos", "vos", "leurs", "en", "au", "aux", "ou", "où", "si",
            "que", "qui", "dont", "qu", "quel", "quelle", "quels", "quelles", "plus",
            "moins", "très", "trop", "peu", "assez", "beaucoup", "pendant", "depuis",
            "chez", "vers", "jusque", "jusqu", "entre", "parmi", "sans", "sous", "sur",
            "dans", "hors", "selon", "comme", "car", "donc", "ni", "or", "mais", "alors",
            "puis", "aussi", "bien", "mal", "mieux", "pire", "non", "oui", "voici",
            "voilà", "c", "ça", "cela", "celui", "celle", "ceux", "celles", "il", "ils",
            "elle", "elles", "on", "nous", "vous", "je", "tu", "me", "te", "se", "lui",
            "eux", "moi", "toi", "soi", "y", "en", "là", "ici", "maintenant", "aujourd'hui",
            "demain", "hier", "toujours", "jamais", "souvent", "parfois", "quelquefois",
            "encore", "déjà", "presque", "environ", "autant", "autre", "autres", "même",
            "tous", "toutes", "tout", "toute", "chaque", "certains", "certaines",
            "plusieurs", "quelques", "aucun", "aucune", "nul", "nulle", "personne",
            "rien", "quelqu'un", "quelque", "chose", "faire", "fait", "être", "avoir",
            "aller", "venir", "voir", "savoir", "pouvoir", "vouloir", "devoir", "falloir",
            "dire", "parler", "penser", "croire", "trouver", "donner", "prendre",
            "comprendre", "mettre", "tenir", "sentir", "laisser", "rester", "passer",
            "arriver", "partir", "entrer", "sortir", "monter", "descendre", "tomber",
            "suivre", "vivre", "mourir", "naître", "devenir", "revenir", "tenir",
            "appeler", "répondre", "demander", "aimer", "adorer", "détester", "préférer",
            "pouvez", "voulez", "devez", "faites", "êtes", "avez", "sommes", "font",
            "sont", "ont", "peuvent", "veulent", "doivent", "disent", "font", "voient",
            "savent", "vont", "viennent", "ramenez", "concentrez", "inspirant"));

    public static List<String> extractKeywords(Article article, int topN) {
        return extractKeywords(article.getContenu(), topN);
    }

    public static List<String> extractKeywords(String content, int topN) {
        if (content == null || content.trim().isEmpty())
            return Collections.emptyList();

        String[] words = content.toLowerCase().split("\\W+");
        Map<String, Integer> freq = new HashMap<>();

        for (String word : words) {
            if (word.length() < 4)
                continue;
            if (STOP_WORDS.contains(word))
                continue;
            if (word.matches(".*\\d.*"))
                continue;

            freq.put(word, freq.getOrDefault(word, 0) + 1);
        }

        return freq.entrySet().stream()
                .sorted(Map.Entry.<String, Integer>comparingByValue().reversed())
                .limit(topN)
                .map(Map.Entry::getKey)
                .collect(Collectors.toList());
    }

    public static Set<String> extractKeywords(String content) {
        return new HashSet<>(extractKeywords(content, 10));
    }
}
