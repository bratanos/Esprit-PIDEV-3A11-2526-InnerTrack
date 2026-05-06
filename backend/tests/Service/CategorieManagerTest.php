<?php

namespace App\Tests\Service;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Service\CategorieManager;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for CategorieManager business rules.
 *
 * Run with:  php bin/phpunit tests/Service/CategorieManagerTest.php
 */
class CategorieManagerTest extends TestCase
{
    private CategorieManager $manager;

    protected function setUp(): void
    {
        $this->manager = new CategorieManager();
    }

    // -----------------------------------------------------------------------
    // Helper
    // -----------------------------------------------------------------------
    private function makeValidCategorie(): Categorie
    {
        $cat = new Categorie();
        $cat->setNom('Mental Health');
        $cat->setDescription('Articles related to mental health and wellness.');

        return $cat;
    }

    // -----------------------------------------------------------------------
    // Happy path
    // -----------------------------------------------------------------------

    public function testValidCategoriePassesValidation(): void
    {
        $this->assertTrue($this->manager->validate($this->makeValidCategorie()));
    }

    // -----------------------------------------------------------------------
    // Name – required
    // -----------------------------------------------------------------------

    public function testEmptyNameThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom est obligatoire');

        $cat = $this->makeValidCategorie();
        $cat->setNom('');
        $this->manager->validate($cat);
    }

    public function testWhitespaceOnlyNameThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom est obligatoire');

        $cat = $this->makeValidCategorie();
        $cat->setNom('   ');
        $this->manager->validate($cat);
    }

    // -----------------------------------------------------------------------
    // Name – length
    // -----------------------------------------------------------------------

    public function testNameTooShortThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('2 caractères');

        $cat = $this->makeValidCategorie();
        $cat->setNom('A'); // 1 char
        $this->manager->validate($cat);
    }

    public function testNameAtMinimumLengthPasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setNom('Qi'); // 2 chars – exactly the minimum
        $this->assertTrue($this->manager->validate($cat));
    }

    public function testNameTooLongThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('100 caractères');

        $cat = $this->makeValidCategorie();
        $cat->setNom(str_repeat('A', 101)); // 101 chars
        $this->manager->validate($cat);
    }

    public function testNameAtMaximumLengthPasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setNom(str_repeat('A', 100)); // exactly 100
        $this->assertTrue($this->manager->validate($cat));
    }

    // -----------------------------------------------------------------------
    // Name – allowed characters
    // -----------------------------------------------------------------------

    public function testNameWithSpecialCharsThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('apostrophes et tirets');

        $cat = $this->makeValidCategorie();
        $cat->setNom('Anxiety@Disorders!'); // @ and ! not allowed
        $this->manager->validate($cat);
    }

    public function testNameWithAccentedLettersPasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setNom('Dépression et Épuisement'); // accented – valid
        $this->assertTrue($this->manager->validate($cat));
    }

    public function testNameWithHyphenAndApostrophePasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setNom("L'auto-estime"); // apostrophe + hyphen – both allowed
        $this->assertTrue($this->manager->validate($cat));
    }

    // -----------------------------------------------------------------------
    // Description – optional but capped at 1 000 chars
    // -----------------------------------------------------------------------

    public function testNullDescriptionPasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setDescription(null);
        $this->assertTrue($this->manager->validate($cat));
    }

    public function testDescriptionTooLongThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('1 000 caractères');

        $cat = $this->makeValidCategorie();
        $cat->setDescription(str_repeat('x', 1001));
        $this->manager->validate($cat);
    }

    public function testDescriptionAtMaximumLengthPasses(): void
    {
        $cat = $this->makeValidCategorie();
        $cat->setDescription(str_repeat('x', 1000)); // exactly 1 000
        $this->assertTrue($this->manager->validate($cat));
    }

    // -----------------------------------------------------------------------
    // Deletion guard
    // -----------------------------------------------------------------------

    public function testCanDeleteEmptyCategorieReturnsTrue(): void
    {
        $cat = $this->makeValidCategorie(); // no articles
        $this->assertTrue($this->manager->canDelete($cat));
    }

    public function testCannotDeleteCategorieWithArticles(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('contient des articles');

        $cat     = $this->makeValidCategorie();
        $article = new Article();
        $article->setTitre('Dummy Article Title');
        $article->setContenu(str_repeat('content ', 5));
        $cat->addArticle($article);

        $this->manager->canDelete($cat);
    }
}
