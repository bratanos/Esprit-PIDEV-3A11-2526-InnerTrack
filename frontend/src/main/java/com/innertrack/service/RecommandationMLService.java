package com.innertrack.service;

import com.innertrack.model.AIRecommandation;
import com.innertrack.model.Resultat;
import com.innertrack.util.DBConnection;

import java.sql.*;
import java.util.*;

/**
 * ML-based recommendation service. Uses a softmax classifier trained on
 * synthetic data to classify users into Fragile / Stable / Résilient profiles,
 * then generates test-specific recommendations.
 */
public class RecommandationMLService {

    private static final int NB_FEATURES = 7;
    private static final int NB_CLASSES = 3;
    private static final double LEARNING_RATE = 0.1;
    private static final int NB_ITERATIONS = 1000;
    private static final String[] LABELS = { "Fragile", "Stable", "Résilient" };

    private double[][] poids;
    private double[] biais;

    // Tests where high score = GOOD result (invert for the model)
    private static final Set<String> TESTS_POSITIFS = new HashSet<>(Arrays.asList(
            "résilience", "resilience", "estime", "confiance",
            "intelligence émotionnelle", "intelligence emotionnelle",
            "cognitif", "cognitive", "fonctionnement cognitif",
            "mbti", "personnalité", "personnalite",
            "soft skills", "emotionnel"));

    private boolean estPositif(String titreLow) {
        return TESTS_POSITIFS.stream().anyMatch(titreLow::contains);
    }

    private static final Set<String> TESTS_SYMPTOMES = new HashSet<>(Arrays.asList(
            "dépression", "depression", "anxiét", "anxiet",
            "bpd", "borderline", "adhd", "déficit",
            "tspt", "ptsd", "traumat", "schizo", "stress"));

    private boolean estSymptome(String titreLow) {
        return TESTS_SYMPTOMES.stream().anyMatch(titreLow::contains);
    }

    // ── Training ──
    public RecommandationMLService() {
        poids = new double[NB_CLASSES][NB_FEATURES];
        biais = new double[NB_CLASSES];
        entrainer();
    }

    private void entrainer() {
        double[][] X = {
                { 0.10, 0.80, 0.20, 0.90, 0.15, 0.85, 0.10 }, { 0.15, 0.75, 0.25, 0.85, 0.20, 0.80, 0.15 },
                { 0.20, 0.70, 0.30, 0.80, 0.10, 0.90, 0.20 }, { 0.12, 0.85, 0.15, 0.95, 0.05, 0.88, 0.08 },
                { 0.18, 0.72, 0.22, 0.78, 0.25, 0.82, 0.12 }, { 0.08, 0.90, 0.10, 0.92, 0.12, 0.91, 0.07 },
                { 0.22, 0.68, 0.28, 0.75, 0.18, 0.77, 0.18 },
                { 0.50, 0.40, 0.55, 0.45, 0.50, 0.45, 0.55 }, { 0.55, 0.35, 0.60, 0.40, 0.55, 0.40, 0.60 },
                { 0.45, 0.45, 0.50, 0.50, 0.45, 0.50, 0.50 }, { 0.52, 0.38, 0.57, 0.42, 0.52, 0.43, 0.57 },
                { 0.48, 0.42, 0.53, 0.47, 0.48, 0.47, 0.53 }, { 0.60, 0.30, 0.65, 0.35, 0.60, 0.35, 0.65 },
                { 0.42, 0.48, 0.47, 0.52, 0.42, 0.52, 0.48 },
                { 0.85, 0.10, 0.90, 0.12, 0.88, 0.10, 0.92 }, { 0.90, 0.08, 0.92, 0.10, 0.90, 0.08, 0.95 },
                { 0.80, 0.15, 0.85, 0.15, 0.82, 0.12, 0.88 }, { 0.88, 0.09, 0.91, 0.11, 0.89, 0.09, 0.93 },
                { 0.82, 0.12, 0.88, 0.13, 0.84, 0.11, 0.90 }, { 0.92, 0.06, 0.94, 0.08, 0.92, 0.07, 0.96 },
                { 0.78, 0.18, 0.82, 0.17, 0.80, 0.14, 0.86 }
        };
        int[] Y = { 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2 };

        Random rand = new Random(42);
        for (int c = 0; c < NB_CLASSES; c++) {
            biais[c] = 0.0;
            for (int f = 0; f < NB_FEATURES; f++)
                poids[c][f] = (rand.nextDouble() - 0.5) * 0.01;
        }
        for (int iter = 0; iter < NB_ITERATIONS; iter++) {
            for (int n = 0; n < X.length; n++) {
                double[] p = softmax(X[n]);
                for (int c = 0; c < NB_CLASSES; c++) {
                    double g = p[c] - (c == Y[n] ? 1.0 : 0.0);
                    biais[c] -= LEARNING_RATE * g;
                    for (int f = 0; f < NB_FEATURES; f++)
                        poids[c][f] -= LEARNING_RATE * g * X[n][f];
                }
            }
        }
        System.out.println("✅ Modèle ML entraîné — " + NB_ITERATIONS + " itérations");
    }

    // ── Entry point ──
    public AIRecommandation genererRecommandations(Resultat resultat,
            int idUtilisateur) throws SQLException {
        String[] infos = recupererInfosTest(resultat.getIdTest());
        String titre = infos[0];
        String titreLow = titre.toLowerCase();
        boolean positif = estPositif(titreLow);

        double[] features = extraireFeatures(resultat, idUtilisateur);

        if (positif) {
            features[0] = 1.0 - features[0];
        } else if (estSymptome(titreLow)) {
            features[0] = 1.0 - features[0];
        }

        double[] probas = softmax(features);
        int cluster = argmax(probas);
        int conf = (int) (probas[cluster] * 100);

        AIRecommandation rec = new AIRecommandation();
        rec.setCluster(LABELS[cluster]);
        rec.setProbabilites(probas);
        rec.setScoreConfiance(conf);
        rec.setFeatures(features);
        rec.setAnalyseGlobale(analyse(cluster, resultat, probas, titre, positif));
        rec.setHabitudes(habitudes(cluster, features, titreLow));
        rec.setPlanSemaine(planSemaine(cluster, positif));
        rec.setAlertes(alertes(cluster, features, positif));

        return rec;
    }

    // ── DB ──
    private String[] recupererInfosTest(int idTest) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        PreparedStatement ps = cnx.prepareStatement(
                "SELECT tp.titre, tt.libelle FROM test_psychologique tp " +
                        "JOIN type_test tt ON tp.id_type = tt.id_type WHERE tp.id_test = ?");
        ps.setInt(1, idTest);
        ResultSet rs = ps.executeQuery();
        if (rs.next())
            return new String[] { rs.getString("titre"), rs.getString("libelle") };
        return new String[] { "Test inconnu", "" };
    }

    // ── Features ──
    private double[] extraireFeatures(Resultat r, int idU) throws SQLException {
        Connection cnx = DBConnection.getInstance().getConnection();
        double[] f = new double[NB_FEATURES];
        f[0] = r.getScoreMaxPossible() > 0
                ? (double) r.getScoreTotal() / r.getScoreMaxPossible()
                : 0.5;

        PreparedStatement ps = cnx.prepareStatement(
                "SELECT rep.points FROM reponse_utilisateur ru " +
                        "JOIN reponse rep ON ru.id_reponse = rep.id_reponse " +
                        "JOIN question q ON ru.id_question = q.id_question " +
                        "WHERE ru.id_utilisateur = ? AND q.id_test = ? ORDER BY q.id_question");
        ps.setInt(1, idU);
        ps.setInt(2, r.getIdTest());
        ResultSet rs = ps.executeQuery();

        List<Integer> pts = new ArrayList<>();
        while (rs.next())
            pts.add(rs.getInt("points"));

        if (pts.isEmpty()) {
            Arrays.fill(f, 0.5);
            f[0] = r.getScoreMaxPossible() > 0
                    ? (double) r.getScoreTotal() / r.getScoreMaxPossible()
                    : 0.5;
            return f;
        }

        double max = pts.stream().mapToInt(i -> i).max().orElse(1);
        double min = pts.stream().mapToInt(i -> i).min().orElse(0);
        double moy = pts.stream().mapToInt(i -> i).average().orElse(0);
        double var = pts.stream().mapToDouble(p -> Math.pow(p - moy, 2)).average().orElse(0);
        double maxVar = Math.pow(max - min, 2) / 4.0;

        f[1] = maxVar > 0 ? Math.min(1.0, var / maxVar) : 0;
        f[2] = 1.0 - f[1];

        int sf = (int) (pts.size() * 0.7);
        double mf = 0;
        int cf = 0;
        for (int i = sf; i < pts.size(); i++) {
            mf += pts.get(i);
            cf++;
        }
        f[3] = cf > 0 && max > 0 ? 1.0 - (mf / cf / max) : 0.5;

        int ss = (int) (pts.size() * 0.3);
        double ms = 0;
        for (int i = 0; i < Math.min(ss, pts.size()); i++)
            ms += pts.get(i);
        f[4] = ss > 0 && max > 0 ? ms / (ss * max) : 0.5;

        int d = (int) (pts.size() * 0.3), fn = (int) (pts.size() * 0.7);
        double mst = 0;
        int cst = 0;
        for (int i = d; i < fn && i < pts.size(); i++) {
            mst += pts.get(i);
            cst++;
        }
        f[5] = cst > 0 && max > 0 ? 1.0 - (mst / cst / max) : 0.5;

        double et = Math.sqrt(var);
        f[6] = (max - min) > 0 ? 1.0 - Math.min(1.0, et / (max - min)) : 1.0;
        return f;
    }

    // ── Softmax ──
    private double[] softmax(double[] x) {
        double[] lg = new double[NB_CLASSES];
        double mx = Double.NEGATIVE_INFINITY;
        for (int c = 0; c < NB_CLASSES; c++) {
            lg[c] = biais[c];
            for (int f = 0; f < NB_FEATURES; f++)
                lg[c] += poids[c][f] * x[f];
            if (lg[c] > mx)
                mx = lg[c];
        }
        double[] p = new double[NB_CLASSES];
        double s = 0;
        for (int c = 0; c < NB_CLASSES; c++) {
            p[c] = Math.exp(lg[c] - mx);
            s += p[c];
        }
        for (int c = 0; c < NB_CLASSES; c++)
            p[c] /= s;
        return p;
    }

    private int argmax(double[] a) {
        int m = 0;
        for (int i = 1; i < a.length; i++)
            if (a[i] > a[m])
                m = i;
        return m;
    }

    // ── Analysis ──
    private String analyse(int cl, Resultat r, double[] p, String titre, boolean positif) {
        String pct = String.format("%.0f%%", r.getPourcentage());
        String conf = String.format("%.0f%%", p[cl] * 100);
        if (positif) {
            return switch (cl) {
                case 2 -> "Excellent résultat au test « " + titre + " » (score " + pct + "). " +
                        "Le modèle ML détecte une grande cohérence dans vos réponses, signe de compétences solides. " +
                        "Maintenez ces acquis et continuez à progresser (confiance : " + conf + ").";
                case 1 -> "Bon résultat au test « " + titre + " » (score " + pct + "). " +
                        "Vous avez de bonnes bases avec des axes d'amélioration identifiés. " +
                        "Les habitudes recommandées vous aideront à progresser (confiance : " + conf + ").";
                default -> "Résultat en développement au test « " + titre + " » (score " + pct + "). " +
                        "Ce domaine nécessite du travail — tout à fait améliorable avec les bonnes pratiques (confiance : "
                        + conf + ").";
            };
        }
        return switch (cl) {
            case 0 ->
                "Votre profil au test « " + titre + " » (score " + pct + ") révèle des symptômes significatifs. " +
                        "Le modèle détecte une forte intensité dans vos réponses. " +
                        "Un suivi professionnel est recommandé (confiance : " + conf + ").";
            case 1 -> "Votre profil au test « " + titre + " » (score " + pct + ") est modéré. " +
                    "Quelques signaux à surveiller — la situation est gérable avec les bonnes habitudes (confiance : "
                    + conf + ").";
            default -> "Bonne nouvelle : votre profil au test « " + titre + " » (score " + pct
                    + ") montre peu de symptômes. " +
                    "Votre bien-être dans ce domaine est satisfaisant (confiance : " + conf + ").";
        };
    }

    // ── Dynamic habits by test type ──
    private List<AIRecommandation.Habitude> habitudes(int cl, double[] f, String tl) {
        if (tl.contains("anxiét") || tl.contains("anxiet"))
            return hAnxiete(cl, f);
        if (tl.contains("bpd") || tl.contains("borderline"))
            return hBPD(cl, f);
        if (tl.contains("adhd") || tl.contains("déficit") || tl.contains("attention"))
            return hADHD(cl, f);
        if (tl.contains("tspt") || tl.contains("ptsd") || tl.contains("traumat"))
            return hPTSD(cl, f);
        if (tl.contains("schizo"))
            return hSchizo(cl, f);
        if (tl.contains("résilience") || tl.contains("resilience"))
            return hResilience(cl, f);
        if (tl.contains("estime") || tl.contains("confiance"))
            return hEstime(cl, f);
        if (tl.contains("intelligence") || tl.contains("emotionnel"))
            return hIE(cl, f);
        if (tl.contains("cognitif") || tl.contains("cognitive"))
            return hCognitif(cl, f);
        if (tl.contains("mbti") || tl.contains("personnali"))
            return hMBTI(cl, f);
        return hGenerique(cl, f);
    }

    private List<AIRecommandation.Habitude> hAnxiete(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🌬️", "Cohérence cardiaque", "3 séances/jour 5 min : inspirez 5s, expirez 5s.", "3x / jour",
                    "Stress", "CRITIQUE"));
            h.add(H("🏥", "Consultation TCC", "La TCC est efficace à 85% pour l'anxiété en 12 séances.", "Urgent",
                    "Suivi médical", "CRITIQUE"));
            h.add(H("🚫", "Zéro caféine", "Supprimez la caféine : amplifie les crises d'anxiété.", "Quotidien",
                    "Nutrition", "Élevé"));
            h.add(H("🌙", "Sommeil strict", "Coucher fixe ±15 min, 18°C, aucun écran après 20h.", "Quotidien",
                    "Sommeil", "CRITIQUE"));
            if (f[4] < 0.3)
                h.add(H("👥", "Anti-isolement", "1 contact humain/jour.", "Quotidien", "Lien social", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("🧘", "Méditation guidée", "10 min/matin. Réduit l'anxiété de 30% en 8 semaines.", "Quotidien",
                    "Bien-être", "Élevé"));
            h.add(H("📵", "Détox numérique", "Pas de réseaux sociaux avant 9h et après 21h.", "Quotidien",
                    "Hygiène mentale", "Élevé"));
            h.add(H("🏃", "Cardio 3x/semaine", "30 min course, natation ou vélo.", "3x / semaine", "Sport", "Élevé"));
            h.add(H("📓", "Journal d'inquiétudes", "Chaque soir : écrivez vos préoccupations.", "Quotidien (soir)",
                    "Santé mentale", "Moyen"));
        } else {
            h.add(H("✅", "Maintien de vos pratiques", "Vos habitudes anti-stress fonctionnent. Continuez !",
                    "Quotidien", "Prévention", "Maintien"));
            h.add(H("🌿", "Pleine conscience", "5-10 min mindfulness matin.", "Quotidien", "Bien-être", "Maintien"));
            h.add(H("🤝", "Soutien aux proches", "Aidez des personnes anxieuses autour de vous.", "Hebdomadaire",
                    "Impact social", "Fort"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hBPD(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🏥", "Thérapie DBT urgente", "DBT = thérapie de référence pour le BPD.", "Urgent", "Suivi médical",
                    "CRITIQUE"));
            h.add(H("📞", "Numéro 3114", "En cas d'impulsions : 3114 disponible 24h/24.", "Si besoin", "Sécurité",
                    "CRITIQUE"));
            h.add(H("⏸️", "Technique STOP", "Stopper — Temps — Observer — Prendre du recul.", "À chaque crise",
                    "Régulation", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("📚", "Compétences DBT", "4 modules DBT à apprendre.", "Hebdomadaire", "Thérapie", "Élevé"));
            h.add(H("📓", "Journal DBT", "Déclencheur → émotion → envie → action choisie.", "Quotidien",
                    "Auto-observation", "Élevé"));
        } else {
            h.add(H("✅", "Équilibre préservé", "Peu de traits BPD. Maintien recommandé.", "Quotidien", "Prévention",
                    "Maintien"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hADHD(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🏥", "Bilan psychiatrique ADHD", "Tests neuropsychologiques nécessaires.", "Urgent",
                    "Suivi médical", "CRITIQUE"));
            h.add(H("⏱️", "Pomodoro strict", "25 min travail + 5 min pause.", "Chaque session", "Productivité",
                    "CRITIQUE"));
            h.add(H("🏃", "Cardio matinal", "30 min sport intense libère dopamine.", "Quotidien (matin)", "Sport",
                    "CRITIQUE"));
            h.add(H("📅", "Externalisation totale", "Agenda, rappels, listes. Ne comptez pas sur la mémoire.",
                    "Quotidien", "Organisation", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("⏱️", "Pomodoro adapté", "25 min + 5 min. Respectez les pauses.", "Jours de travail",
                    "Productivité", "Élevé"));
            h.add(H("🎧", "Musique de concentration", "Bruit blanc ou lo-fi pendant le travail.", "Pendant le travail",
                    "Focus", "Moyen"));
        } else {
            h.add(H("✅", "Bonnes adaptations", "Vos stratégies ADHD fonctionnent.", "Quotidien", "Productivité",
                    "Maintien"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hPTSD(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🏥", "EMDR ou exposition", "EMDR et exposition prolongée ont 80% d'efficacité.", "Urgent",
                    "Suivi médical", "CRITIQUE"));
            h.add(H("🌬️", "Grounding 5-4-3-2-1", "5 choses vues, 4 sons, 3 textures, 2 odeurs, 1 goût.",
                    "À chaque flashback", "Régulation", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("🧘", "Yoga trauma-informé", "Reconnecte avec le corps de manière sécurisante.", "3x / semaine",
                    "Corps", "Élevé"));
        } else {
            h.add(H("✅", "Bonne récupération", "Peu de symptômes TSPT.", "Quotidien", "Prévention", "Maintien"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hSchizo(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🚨", "Urgences psychiatriques", "Consultez immédiatement.", "Urgent", "Suivi médical",
                    "CRITIQUE"));
            h.add(H("🚫", "Zéro substances", "Cannabis : risque de décompensation.", "Quotidien", "Santé", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("🏥", "Parlez à votre médecin", "Signalez ces symptômes.", "Prochain RDV", "Suivi médical",
                    "Élevé"));
        } else {
            h.add(H("✅", "Aucun signe significatif", "Maintenez sommeil et liens sociaux.", "Quotidien", "Prévention",
                    "Maintien"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hResilience(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 2) {
            h.add(H("🎯", "OKR trimestriels", "1 objectif + 3 résultats mesurables/trimestre.", "Hebdomadaire",
                    "Performance", "Maintien"));
            h.add(H("🤝", "Devenir mentor", "Guidez un proche en difficulté.", "2x / semaine", "Impact social",
                    "Fort"));
        } else if (cl == 1) {
            h.add(H("🌱", "Growth Mindset", "Chaque échec = une information.", "Quotidien", "Mindset", "Élevé"));
            h.add(H("💪", "Défis progressifs", "Petites difficultés volontaires.", "3x / semaine", "Défi", "Élevé"));
        } else {
            h.add(H("🔍", "Vos preuves de force", "Listez 3 difficultés passées surmontées.", "Cette semaine",
                    "Mindset", "Élevé"));
            h.add(H("🤝", "Réseau de soutien", "Identifiez 3 personnes ressources.", "Maintenant", "Lien social",
                    "CRITIQUE"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hEstime(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 2) {
            h.add(H("🌟", "Défis qui font grandir", "Défis au-dessus de votre niveau.", "Trimestriel", "Épanouissement",
                    "Maintien"));
        } else if (cl == 1) {
            h.add(H("🏆", "Journal des victoires", "Notez 1 chose accomplie/jour.", "Quotidien (soir)", "Confiance",
                    "Élevé"));
            h.add(H("📵", "Moins de comparaison", "Instagram/TikTok → 20 min/jour max.", "Quotidien", "Hygiène mentale",
                    "Élevé"));
        } else {
            h.add(H("❤️", "Auto-compassion", "Parlez-vous comme à un ami.", "Quotidien", "Bien-être", "CRITIQUE"));
            h.add(H("🎯", "Micro-succès quotidiens", "1 objectif ultra-simple/jour.", "Quotidien", "Confiance",
                    "CRITIQUE"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hIE(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 2) {
            h.add(H("🎓", "CNV avancée", "Communication Non Violente de Marshall Rosenberg.", "Formation",
                    "Compétences", "Fort"));
        } else if (cl == 1) {
            h.add(H("📓", "Journal émotionnel", "Soir : quelle émotion ? Pourquoi ?", "Quotidien (soir)",
                    "Auto-observation", "Élevé"));
            h.add(H("⏸️", "Règle des 90 secondes", "Attendez 90s avant d'agir.", "À chaque réaction", "Régulation",
                    "Élevé"));
        } else {
            h.add(H("🔍", "Nommer ses émotions", "3 émotions principales/jour.", "Quotidien", "Conscience", "Élevé"));
            h.add(H("📚", "Livre de base", "«L'Intelligence Émotionnelle» de Goleman.", "1 mois", "Formation",
                    "Élevé"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hCognitif(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 2) {
            h.add(H("🧠", "Projets complexes", "Programmation, langue, instrument : 1h/jour.", "Quotidien 1h",
                    "Cognition", "Maintien"));
        } else if (cl == 1) {
            h.add(H("🗂️", "GTD", "Capturez toutes vos tâches dans un système externe.", "Quotidien", "Organisation",
                    "Élevé"));
            h.add(H("🧩", "Entraînement cognitif", "Sudoku, échecs : 15 min/jour.", "Quotidien", "Cerveau", "Moyen"));
        } else {
            h.add(H("🏥", "Bilan neuropsychologique", "Identifiez les zones fragiles.", "Consultez", "Suivi médical",
                    "CRITIQUE"));
            h.add(H("😴", "Sommeil en urgence", "8h/nuit obligatoire.", "Quotidien", "Sommeil", "CRITIQUE"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hMBTI(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 2) {
            h.add(H("🌟", "Exploitez votre profil", "Orientez vos choix selon vos forces naturelles.", "Quotidien",
                    "Connaissance de soi", "Maintien"));
        } else if (cl == 1) {
            h.add(H("🔍", "Approfondissez votre profil", "Observez vos dimensions naturelles.", "Hebdomadaire",
                    "Conscience de soi", "Élevé"));
        } else {
            h.add(H("🧘", "Flexibilité cognitive", "Sortez de votre zone MBTI.", "Hebdomadaire", "Adaptabilité",
                    "Élevé"));
        }
        return h;
    }

    private List<AIRecommandation.Habitude> hGenerique(int cl, double[] f) {
        var h = new ArrayList<AIRecommandation.Habitude>();
        if (cl == 0) {
            h.add(H("🧘", "Méditation quotidienne", "10 min/matin.", "Quotidien", "Bien-être", "Élevé"));
            h.add(H("🏃", "Activité physique", "30 min de marche 5x/semaine.", "5x / semaine", "Sport", "Élevé"));
            h.add(H("🏥", "Consultation", "Parlez à un professionnel.", "Consultez", "Suivi médical", "CRITIQUE"));
        } else if (cl == 1) {
            h.add(H("📓", "Journaling", "15 min/soir : pensées, émotions.", "Quotidien", "Réflexion", "Moyen"));
            h.add(H("🏃", "Sport régulier", "30 min 4x/semaine.", "4x / semaine", "Sport", "Élevé"));
        } else {
            h.add(H("🎯", "Objectifs ambitieux", "Des défis à votre hauteur.", "Trimestriel", "Performance",
                    "Maintien"));
            h.add(H("🤝", "Transmission", "Partagez vos stratégies.", "Hebdomadaire", "Impact social", "Fort"));
        }
        return h;
    }

    private AIRecommandation.Habitude H(String e, String t, String d, String fr, String c, String i) {
        AIRecommandation.Habitude h = new AIRecommandation.Habitude();
        h.emoji = e;
        h.titre = t;
        h.description = d;
        h.frequence = fr;
        h.categorie = c;
        h.impact = i;
        return h;
    }

    // ── Weekly plan ──
    private String planSemaine(int cl, boolean positif) {
        if (cl == 2 && positif)
            return """
                    📅 PLAN DE PERFORMANCE
                    Lun : Défi cognitif ou compétence avancée (1h)
                    Mar : Mentorat ou partage de connaissance
                    Mer : Sport intense + suivi indicateurs personnels
                    Jeu : Projet ambitieux + réflexion stratégique
                    Ven : Bilan semaine + ajustement objectifs
                    Sam : Apprentissage libre + activité créative
                    Dim : Planification OKR semaine suivante
                    🚀 Maintenez vos forces et partagez-les !
                    """;
        if (cl == 2)
            return """
                    📅 PLAN DE MAINTIEN (Peu de symptômes)
                    Lun : Activité bien-être (sport, nature, méditation)
                    Mar : Connexion sociale de qualité
                    Mer : Activité créative ou apprentissage
                    Jeu : Routines de prévention (sommeil, nutrition)
                    Ven : Bilan émotionnel de la semaine
                    Sam : Temps pour soi, activité plaisir
                    Dim : Préparation sereine de la semaine
                    ✅ Continuez ce qui fonctionne pour vous !
                    """;
        if (cl == 1)
            return """
                    📅 PLAN D'AMÉLIORATION
                    Lun : Habitude principale n°1 (15 min)
                    Mar : Sport 30 min + habitude n°2
                    Mer : Connexion sociale + journal du soir
                    Jeu : Habitude n°1 + lecture/podcast
                    Ven : Sport + bilan semaine
                    Sam : Activité plaisir + habitude n°2
                    Dim : Repos actif + planification semaine
                    💡 Attachez chaque habitude à une existante (habit stacking).
                    """;
        return """
                📅 PLAN DE DÉMARRAGE (Priorité bien-être)
                Lun : 1 seule habitude, 5 minutes — pas plus
                Mar : Répétez + ajoutez 1 min
                Mer : Contact avec un proche de confiance
                Jeu : Répétez votre habitude de base
                Ven : Bilan : comment vous sentez-vous ?
                Sam : Activité plaisir simple, sans pression
                Dim : Préparation + si besoin, RDV médical
                ⚠️ Commencez micro. 2 min suffisent pour créer une habitude.
                """;
    }

    // ── Alerts ──
    private List<String> alertes(int cl, double[] f, boolean positif) {
        var a = new ArrayList<String>();
        if (cl == 0) {
            if (positif) {
                a.add("📈 Score faible — des progrès sont possibles avec pratique régulière.");
            } else {
                a.add("⚠️ Niveau de symptômes élevé — suivi professionnel recommandé.");
                if (f[4] < 0.25)
                    a.add("🚨 Isolement social détecté — contactez un proche.");
                if (f[1] > 0.75)
                    a.add("⚠️ Grande variabilité — évaluation professionnelle conseillée.");
            }
        } else if (cl == 1) {
            a.add("📌 Progression possible — des habitudes ciblées feront la différence.");
            if (f[6] < 0.4)
                a.add("🔄 Manque de régularité — la constance est clé.");
        } else {
            if (positif)
                a.add("🌟 Excellent profil — partagez vos stratégies.");
            else
                a.add("✅ Peu de symptômes — maintenez vos bonnes pratiques.");
        }
        return a;
    }

    public static String[] getNomsFeatures() {
        return new String[] { "Score normalisé", "Variance réponses", "Cohérence",
                "Indice fatigue", "Score social", "Score stress", "Régularité" };
    }
}
