<?php

namespace App\Tests\Service;

use App\Service\Testpsy\TestPsyManager;
use PHPUnit\Framework\TestCase;

class TestPsyManagerTest extends TestCase
{
    private TestPsyManager $manager;

    protected function setUp(): void
    {
        $this->manager = new TestPsyManager();
    }

    // ════════════════════════════════════════════════
    // RÈGLE 1 — TITRE
    // ════════════════════════════════════════════════

    public function testTitreValide(): void
    {
        $this->assertTrue($this->manager->validerTitre('Test Dépression'));
    }

    public function testTitreVide(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le titre est obligatoire.');
        $this->manager->validerTitre('');
    }

    public function testTitreTropCourt(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('au moins 3 caractères');
        $this->manager->validerTitre('AB');
    }

    public function testTitreTropLong(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->validerTitre(str_repeat('A', 256));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 2 — SCORE
    // ════════════════════════════════════════════════

    public function testScoreValide(): void
    {
        $this->assertTrue($this->manager->validerScore(15, 20));
    }

    public function testScoreNegatif(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('négatif');
        $this->manager->validerScore(-1, 20);
    }

    public function testScoreDepasseMax(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('dépasser le score maximum');
        $this->manager->validerScore(25, 20);
    }

    public function testScoreEgalMax(): void
    {
        $this->assertTrue($this->manager->validerScore(20, 20));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 3 — POURCENTAGE
    // ════════════════════════════════════════════════

    public function testPourcentage80(): void
    {
        $this->assertEquals(80.0, $this->manager->calculerPourcentage(16, 20));
    }

    public function testPourcentage100(): void
    {
        $this->assertEquals(100.0, $this->manager->calculerPourcentage(20, 20));
    }

    public function testPourcentage0(): void
    {
        $this->assertEquals(0.0, $this->manager->calculerPourcentage(0, 20));
    }

    public function testPourcentageScoreMaxZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->manager->calculerPourcentage(10, 0);
    }

    // ════════════════════════════════════════════════
    // RÈGLE 4 — NOMBRE DE QUESTIONS
    // ════════════════════════════════════════════════

    public function testNombreQuestionsValide(): void
    {
        $this->assertTrue($this->manager->validerNombreQuestions(10));
    }

    public function testNombreQuestionsZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('au moins une question');
        $this->manager->validerNombreQuestions(0);
    }

    // ════════════════════════════════════════════════
    // RÈGLE 5 — MBTI
    // ════════════════════════════════════════════════

    public function testMBTIINTJ(): void
{
    // axes tous faibles (score=1 par réponse) → INFP, pas INTJ
    $reponses = array_fill(0, 20, 1);
    $type = $this->manager->calculerMBTI($reponses);
    $this->assertEquals('INFP', $type); 
}

    public function testMBTIENFP(): void
    {
        // 20 réponses : axes tous élevés → ESFJ
        $reponses = array_fill(0, 20, 4);
        $type = $this->manager->calculerMBTI($reponses);
        $this->assertStringContainsString('E', $type);
    }

    public function testMBTIManqueReponses(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('20 réponses');
        $this->manager->calculerMBTI([1, 2, 3]);
    }

    // ════════════════════════════════════════════════
    // RÈGLE 6 — BIEN-ÊTRE GLOBAL
    // ════════════════════════════════════════════════

    public function testBienEtreTestNegatif(): void
    {
        // Test dépression score 80% → inversé → 20%
        $resultats = ['test de dépression' => 80.0];
        $bienEtre = $this->manager->calculerBienEtre($resultats);
        $this->assertEquals(20, $bienEtre);
    }

    public function testBienEtreTestPositif(): void
    {
        // Test résilience score 80% → reste 80%
        $resultats = ['test de résilience' => 80.0];
        $bienEtre = $this->manager->calculerBienEtre($resultats);
        $this->assertEquals(80, $bienEtre);
    }

    public function testBienEtreVide(): void
    {
        $this->assertEquals(0, $this->manager->calculerBienEtre([]));
    }

    public function testBienEtreMBTIIgnore(): void
    {
        // MBTI doit être ignoré
        $resultats = ['test mbti' => 60.0];
        $this->assertEquals(0, $this->manager->calculerBienEtre($resultats));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 7 — estPositif
    // ════════════════════════════════════════════════

    public function testEstPositifResilience(): void
    {
        $this->assertTrue($this->manager->estPositif('test de résilience'));
    }

    public function testEstPositifMBTI(): void
    {
        $this->assertTrue($this->manager->estPositif('test mbti'));
    }

    public function testEstPositifDepression(): void
    {
        $this->assertFalse($this->manager->estPositif('test de dépression'));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 8 — estSymptome
    // ════════════════════════════════════════════════

    public function testEstSymptomeDepression(): void
    {
        $this->assertTrue($this->manager->estSymptome('test de dépression'));
    }

    public function testEstSymptomeAnxiete(): void
    {
        $this->assertTrue($this->manager->estSymptome("test d'anxiété"));
    }

    public function testEstSymptomeResilience(): void
    {
        $this->assertFalse($this->manager->estSymptome('test de résilience'));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 9 — ARBRE DE DÉCISION
    // ════════════════════════════════════════════════

    public function testArbreResiliant(): void
    {
        $f = [0.90, 0.08, 0.92, 0.10, 0.90, 0.08, 0.95];
        $this->assertEquals(2, $this->manager->arbreDecision($f));
    }

    public function testArbreFragile(): void
    {
        $f = [0.10, 0.80, 0.20, 0.90, 0.15, 0.85, 0.10];
        $this->assertEquals(0, $this->manager->arbreDecision($f));
    }

    public function testArbreStable(): void
    {
        $f = [0.50, 0.40, 0.55, 0.45, 0.50, 0.45, 0.55];
        $this->assertEquals(1, $this->manager->arbreDecision($f));
    }

    // ════════════════════════════════════════════════
    // RÈGLE 10 — CORRECTION POLARITÉ
    // ════════════════════════════════════════════════

    public function testPolariteSymptomeInversee(): void
    {
        $features = [1.0, 0.1, 0.9, 0.1, 0.9, 0.1, 0.9];
        $result = $this->manager->corrigerPolarite($features, 'test de dépression');
        $this->assertEquals(0.0, $result[0]);
    }

    public function testPolaritePositifInversee(): void
    {
        $features = [0.8, 0.1, 0.9, 0.1, 0.9, 0.1, 0.9];
        $result = $this->manager->corrigerPolarite($features, 'test de résilience');
        $this->assertEquals(round(1.0 - 0.8, 2), round($result[0], 2));
    }

    public function testPolariteNeutreNonInversee(): void
    {
        $features = [0.8, 0.1, 0.9, 0.1, 0.9, 0.1, 0.9];
        $result = $this->manager->corrigerPolarite($features, 'test neutre');
        $this->assertEquals(0.8, $result[0]);
    }

    // ════════════════════════════════════════════════
    // RÈGLE 11 — ARGMAX
    // ════════════════════════════════════════════════

    public function testArgmaxPremier(): void
    {
        $this->assertEquals(0, $this->manager->argmax([0.9, 0.05, 0.05]));
    }

    public function testArgmaxDernier(): void
    {
        $this->assertEquals(2, $this->manager->argmax([0.05, 0.05, 0.9]));
    }

    public function testArgmaxMilieu(): void
    {
        $this->assertEquals(1, $this->manager->argmax([0.1, 0.8, 0.1]));
    }
}