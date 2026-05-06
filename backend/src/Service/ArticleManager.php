<?php

namespace App\Service;

use App\Entity\Article;

/**
 * Business-rule validation and readability analysis for Article entities.
 *
 * Place this file at:  src/Service/ArticleManager.php
 */
class ArticleManager
{
    // -----------------------------------------------------------------------
    // Validation
    // -----------------------------------------------------------------------

    /**
     * Validates an Article against all business rules.
     *
     * @throws \InvalidArgumentException with a French message on the first broken rule.
     * @return true when every rule passes.
     */
    public function validate(Article $article): bool
    {
        // --- Title ---
        $titre = $article->getTitre();

        if ($titre === null || $titre === '') {
            throw new \InvalidArgumentException('Le titre est obligatoire.');
        }

        if (mb_strlen($titre) < 5) {
            throw new \InvalidArgumentException(
                'Le titre doit comporter au moins 5 caractères.'
            );
        }

        if (mb_strlen($titre) > 255) {
            throw new \InvalidArgumentException(
                'Le titre ne peut pas dépasser 255 caractères.'
            );
        }

        // --- Content ---
        $contenu = $article->getContenu();

        if ($contenu === null || $contenu === '') {
            throw new \InvalidArgumentException('Le contenu est obligatoire.');
        }

        if (mb_strlen($contenu) < 20) {
            throw new \InvalidArgumentException(
                'Le contenu doit comporter au moins 20 caractères.'
            );
        }

        // --- Publication date ---
        $date = $article->getDatePublication();

        if ($date === null) {
            throw new \InvalidArgumentException('La date de publication est obligatoire.');
        }

        $today = new \DateTime('today');
        if ($date > $today) {
            throw new \InvalidArgumentException(
                'La date de publication ne peut pas être dans le futur.'
            );
        }

        // --- Category ---
        if ($article->getCategorie() === null) {
            throw new \InvalidArgumentException('La catégorie est obligatoire.');
        }

        return true;
    }

    // -----------------------------------------------------------------------
    // Readability
    // -----------------------------------------------------------------------

    /**
     * Estimates reading difficulty based on average word length.
     *
     * - ≤ 4 characters  → 'easy'
     * - 5–6 characters  → 'medium'
     * - > 6 characters  → 'hard'
     * - empty string    → 'unknown'
     */
    public function calculateReadability(string $content): string
    {
        $content = trim($content);

        if ($content === '') {
            return 'unknown';
        }

        // Split on whitespace; filter empty tokens produced by multiple spaces.
        $words = array_filter(preg_split('/\s+/', $content) ?: []);

        if (count($words) === 0) {
            return 'unknown';
        }

        $totalChars = array_sum(array_map('mb_strlen', $words));
        $avgLength  = $totalChars / count($words);

        if ($avgLength <= 4) {
            return 'easy';
        }

        if ($avgLength <= 6) {
            return 'medium';
        }

        return 'hard';
    }
}
