<?php

namespace App\Tests\Service;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Service\ArticleManager;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for ArticleManager business rules.
 *
 * Run with:  php bin/phpunit tests/Service/ArticleManagerTest.php
 */
class ArticleManagerTest extends TestCase
{
    private ArticleManager $manager;
    private Categorie $categorie;

    protected function setUp(): void
    {
        $this->manager   = new ArticleManager();
        $this->categorie = new Categorie();
        $this->categorie->setNom('Psychology');
    }

    // -----------------------------------------------------------------------
    // Helper – returns a fully valid Article so individual tests only break
    // the single rule they are testing.
    // -----------------------------------------------------------------------
    private function makeValidArticle(): Article
    {
        $article = new Article();
        $article->setTitre('Understanding Anxiety Disorders');
        $article->setContenu('Anxiety is a natural human response to perceived threats and stress.');
        $article->setDatePublication(new \DateTime('yesterday'));
        $article->setCategorie($this->categorie);

        return $article;
    }

    // -----------------------------------------------------------------------
    // Happy path
    // -----------------------------------------------------------------------

    public function testValidArticlePassesValidation(): void
    {
        $this->assertTrue($this->manager->validate($this->makeValidArticle()));
    }

    // -----------------------------------------------------------------------
    // Title rules
    // -----------------------------------------------------------------------

    public function testEmptyTitleThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le titre est obligatoire');

        $article = $this->makeValidArticle();
        $article->setTitre('');
        $this->manager->validate($article);
    }

    public function testTitleTooShortThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('5 caractères');

        $article = $this->makeValidArticle();
        $article->setTitre('Anx'); // 3 chars – too short
        $this->manager->validate($article);
    }

    public function testTitleAtMinimumLengthPasses(): void
    {
        $article = $this->makeValidArticle();
        $article->setTitre('Grief'); // exactly 5 chars
        $this->assertTrue($this->manager->validate($article));
    }

    public function testTitleTooLongThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('255 caractères');

        $article = $this->makeValidArticle();
        $article->setTitre(str_repeat('A', 256)); // 256 chars – too long
        $this->manager->validate($article);
    }

    // -----------------------------------------------------------------------
    // Content rules
    // -----------------------------------------------------------------------

    public function testEmptyContentThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le contenu est obligatoire');

        $article = $this->makeValidArticle();
        $article->setContenu('');
        $this->manager->validate($article);
    }

    public function testContentTooShortThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('20 caractères');

        $article = $this->makeValidArticle();
        $article->setContenu('Too short.'); // 10 chars – below 20
        $this->manager->validate($article);
    }

    public function testContentAtMinimumLengthPasses(): void
    {
        $article = $this->makeValidArticle();
        $article->setContenu('Exactly twenty chars!'); // 21 chars – valid
        $this->assertTrue($this->manager->validate($article));
    }

    // -----------------------------------------------------------------------
    // Publication date rules
    // -----------------------------------------------------------------------

    public function testNullPublicationDateThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('La date de publication est obligatoire');

        $article = $this->makeValidArticle();
        $article->setDatePublication(null);
        $this->manager->validate($article);
    }

    public function testFutureDateThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('dans le futur');

        $article = $this->makeValidArticle();
        $article->setDatePublication(new \DateTime('+1 day'));
        $this->manager->validate($article);
    }

    public function testTodayDatePasses(): void
    {
        $article = $this->makeValidArticle();
        $article->setDatePublication(new \DateTime('today'));
        $this->assertTrue($this->manager->validate($article));
    }

    // -----------------------------------------------------------------------
    // Category rule
    // -----------------------------------------------------------------------

    public function testNullCategorieThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('La catégorie est obligatoire');

        $article = $this->makeValidArticle();
        $article->setCategorie(null);
        $this->manager->validate($article);
    }

    // -----------------------------------------------------------------------
    // Readability calculation
    // -----------------------------------------------------------------------

    public function testShortWordsYieldEasyReadability(): void
    {
        // Average word length ≤ 4 → easy
        $level = $this->manager->calculateReadability('I am ok now and at my best.');
        $this->assertSame('easy', $level);
    }

    public function testMediumWordsYieldMediumReadability(): void
    {
        // Average word length 5-6 → medium
        $level = $this->manager->calculateReadability('Stress often leads to burnout events.');
        $this->assertSame('medium', $level);
    }

    public function testLongWordsYieldHardReadability(): void
    {
        // Average word length > 6 → hard
        $level = $this->manager->calculateReadability(
            'Psychotherapeutic interventions significantly ameliorate psychological distress.'
        );
        $this->assertSame('hard', $level);
    }

    public function testEmptyContentReturnsUnknown(): void
    {
        $level = $this->manager->calculateReadability('');
        $this->assertSame('unknown', $level);
    }
}
