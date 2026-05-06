<?php

namespace App\Service\Testpsy;

class TestPsyManager
{
    // ── Règle 1 : Titre ──────────────────────────────
    public function validerTitre(string $titre): bool
    {
        if (empty($titre)) {
            throw new \InvalidArgumentException('Le titre est obligatoire.');
        }
        if (mb_strlen($titre) < 3) {
            throw new \InvalidArgumentException('Le titre doit contenir au moins 3 caractères.');
        }
        if (mb_strlen($titre) > 255) {
            throw new \InvalidArgumentException('Le titre ne peut pas dépasser 255 caractères.');
        }
        return true;
    }

    // ── Règle 2 : Score ──────────────────────────────
    public function validerScore(int $score, int $scoreMax): bool
    {
        if ($score < 0) {
            throw new \InvalidArgumentException('Le score ne peut pas être négatif.');
        }
        if ($score > $scoreMax) {
            throw new \InvalidArgumentException('Le score ne peut pas dépasser le score maximum.');
        }
        return true;
    }

    // ── Règle 3 : Pourcentage ────────────────────────
    public function calculerPourcentage(int $score, int $scoreMax): float
    {
        if ($scoreMax <= 0) {
            throw new \InvalidArgumentException('Le score maximum doit être supérieur à zéro.');
        }
        return round(($score / $scoreMax) * 100, 2);
    }

    // ── Règle 4 : Nombre de questions ────────────────
    public function validerNombreQuestions(int $nb): bool
    {
        if ($nb <= 0) {
            throw new \InvalidArgumentException('Un test doit avoir au moins une question.');
        }
        return true;
    }

    // ── Règle 5 : MBTI ───────────────────────────────
    //public function calculerMBTI(array $reponses): string
    /** @param int[] $reponses */
    public function calculerMBTI(array $reponses): string
    {
        if (count($reponses) < 20) {
            throw new \InvalidArgumentException('Le test MBTI nécessite 20 réponses.');
        }

        $axisE = 0; $axisS = 0; $axisT = 0; $axisJ = 0;
        foreach ($reponses as $idx => $v) {
            if ($idx < 5)       $axisE += $v;
            elseif ($idx < 10)  $axisS += $v;
            elseif ($idx < 15)  $axisT += $v;
            else                $axisJ += $v;
        }

        $type  = ($axisE >= 13) ? 'E' : 'I';
        $type .= ($axisS >= 13) ? 'S' : 'N';
        $type .= ($axisT >= 13) ? 'T' : 'F';
        $type .= ($axisJ >= 13) ? 'J' : 'P';

        return $type;
    }

    // ── Règle 6 : Bien-être global ───────────────────
    //public function calculerBienEtre(array $resultats): int
    /** @param array<string, float> $resultats */
public function calculerBienEtre(array $resultats): int
    {
        if (empty($resultats)) return 0;

        $testsPositifs = ['estime', 'resilience', 'résilience', 'emotionn', 'émotionn'];
        $total = 0;
        $count = 0;

        foreach ($resultats as $titre => $pct) {
            $titreLow = strtolower($titre);
            if (str_contains($titreLow, 'mbti')) continue;

            $isPositive = false;
            foreach ($testsPositifs as $mot) {
                if (str_contains($titreLow, $mot)) {
                    $isPositive = true;
                    break;
                }
            }

            $score = $isPositive ? $pct : max(0, 100 - $pct);
            $total += $score;
            $count++;
        }

        return $count > 0 ? (int) round($total / $count) : 0;
    }

    // ── Règle 7 : estPositif ─────────────────────────
    public function estPositif(string $titreLow): bool
    {
        $testsPositifs = [
            "résilience", "resilience", "estime", "confiance",
            "intelligence émotionnelle", "intelligence emotionnelle",
            "cognitif", "cognitive", "mbti", "personnalité",
            "personnalite", "soft skills", "emotionnel"
        ];
        foreach ($testsPositifs as $m) {
            if (str_contains($titreLow, $m)) return true;
        }
        return false;
    }

    // ── Règle 8 : estSymptome ────────────────────────
    public function estSymptome(string $titreLow): bool
    {
        $testsSymptomes = [
            "dépression", "depression", "anxiét", "anxiet",
            "bpd", "borderline", "adhd", "déficit",
            "tspt", "ptsd", "traumat", "schizo", "stress"
        ];
        foreach ($testsSymptomes as $m) {
            if (str_contains($titreLow, $m)) return true;
        }
        return false;
    }

    // ── Règle 9 : Arbre de décision ──────────────────
    //public function arbreDecision(array $f): int
    /** @param float[] $f */
public function arbreDecision(array $f): int
    {
        $scoreGlobal  = ($f[0] + $f[2] + $f[4] + $f[6]) / 4;
        $stressGlobal = ($f[1] + (1 - $f[3]) + (1 - $f[5])) / 3;

        if ($scoreGlobal >= 0.65 && $stressGlobal < 0.40)  return 2;
        if ($scoreGlobal <= 0.35 || $stressGlobal >= 0.65) return 0;
        if ($f[6] >= 0.7 && $f[2] >= 0.6) return 2;
        if ($f[1] >= 0.7 && $f[0] < 0.5)  return 0;
        return 1;
    }

    // ── Règle 10 : Correction polarité ───────────────
    //public function corrigerPolarite(array $features, string $titreLow): array
    /**
 * @param float[] $features
 * @return float[]
 */
public function corrigerPolarite(array $features, string $titreLow): array
    {
        if ($this->estPositif($titreLow) || $this->estSymptome($titreLow)) {
            $features[0] = 1.0 - $features[0];
        }
        return $features;
    }

    // ── Règle 11 : argmax ────────────────────────────
    //public function argmax(array $a): int
    /** @param float[] $a */
public function argmax(array $a): int
    {
        $m = 0;
        for ($i = 1; $i < count($a); $i++) {
            if ($a[$i] > $a[$m]) $m = $i;
        }
        return $m;
    }
}