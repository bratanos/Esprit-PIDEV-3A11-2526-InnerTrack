<?php

namespace App\Service;

class BienEtreAnalyzer
{
        public function calculerScore(
        float $avgEnergie,
        float $avgStress,
        float $avgSommeil,
        float $avgHumeur
    ): int {
        $score = (
            ($avgEnergie * 3) +
            ((10 - $avgStress) * 3) +
            ($avgSommeil * 2) +
            ($avgHumeur * 2)
        ) / 10;

        return (int) round(min(100, max(0, $score * 10)));
    }

        public function getNiveau(int $score): string
    {
        return match(true) {
            $score >= 80 => 'Excellent',
            $score >= 60 => 'Bien',
            $score >= 40 => 'Moyen',
            $score >= 20 => 'Difficile',
            default      => 'Critique',
        };
    }

        public function getCouleur(int $score): string
    {
        return match(true) {
            $score >= 80 => '#48bb78',
            $score >= 60 => '#68d391',
            $score >= 40 => '#f6ad55',
            $score >= 20 => '#fc8181',
            default      => '#e53e3e',
        };
    }

    public function getEmoji(int $score): string
    {
        return match(true) {
            $score >= 80 => '🌟',
            $score >= 60 => '😊',
            $score >= 40 => '😐',
            $score >= 20 => '😔',
            default      => '😢',
        };
    }

public function buildPrompt(
    int $score,
    float $avgEnergie,
    float $avgStress,
    float $avgSommeil,
    float $avgHumeur,
    int $nbHabitudes,
    int $nbEntrees
): string {
    return "Tu es un coach de bien-être bienveillant et professionnel.
IMPORTANT: Réponds UNIQUEMENT avec du JSON valide, aucun texte avant ou après, aucune balise markdown, aucun ```json.

Voici les données de bien-être d'un utilisateur pour la semaine :
- Score global de bien-être : {$score}/100
- Niveau d'énergie moyen : {$avgEnergie}/10
- Niveau de stress moyen : {$avgStress}/10
- Qualité du sommeil moyenne : {$avgSommeil}/10
- Humeur moyenne : {$avgHumeur}/10
- Nombre d'habitudes enregistrées : {$nbHabitudes}
- Nombre d'entrées de journal : {$nbEntrees}

Génère une analyse personnalisée en français avec :
1. Un message d'encouragement personnalisé (2 phrases)
2. Les 2 points forts de l'utilisateur
3. Les 2 axes d'amélioration prioritaires
4. 3 recommandations concrètes et actionables
5. Un conseil du jour inspirant

Réponds avec exactement cette structure JSON et rien d'autre :
{
  \"message_encouragement\": \"...\",
  \"points_forts\": [\"...\", \"...\"],
  \"axes_amelioration\": [\"...\", \"...\"],
  \"recommandations\": [\"...\", \"...\", \"...\"],
  \"conseil_du_jour\": \"...\"
}";
}
}
