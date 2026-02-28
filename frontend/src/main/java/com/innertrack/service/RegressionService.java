package com.innertrack.service;

public class RegressionService {

    private final double B0 = 5;
    private final double B1 = 0.6;
    private final double B2 = 8;
    private final double B3 = 12;

    public double calculerScoreRisque(double pourcentage,
            int repetitions,
            double tendance) {

        return B0
                + (B1 * pourcentage)
                + (B2 * repetitions)
                + (B3 * tendance);
    }

    public String classifier(double score) {

        if (score >= 120)
            return "critique";

        if (score >= 80)
            return "eleve";

        if (score >= 50)
            return "modere";

        return "faible";
    }
}
