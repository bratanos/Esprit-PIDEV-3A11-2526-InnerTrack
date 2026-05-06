<?php

namespace App\Service;

use App\Entity\Categorie;

/**
 * Business-rule validation and deletion guard for Categorie entities.
 *
 * Place this file at:  src/Service/CategorieManager.php
 */
class CategorieManager
{
    // -----------------------------------------------------------------------
    // Validation
    // -----------------------------------------------------------------------

    /**
     * Validates a Categorie against all business rules.
     *
     * @throws \InvalidArgumentException with a French message on the first broken rule.
     * @return true when every rule passes.
     */
    public function validate(Categorie $categorie): bool
    {
        // --- Name: required (including whitespace-only) ---
        $nom = $categorie->getNom();

        if ($nom === null || trim($nom) === '') {
            throw new \InvalidArgumentException('Le nom est obligatoire.');
        }

        // --- Name: minimum length ---
        if (mb_strlen($nom) < 2) {
            throw new \InvalidArgumentException(
                'Le nom doit comporter au moins 2 caractères.'
            );
        }

        // --- Name: maximum length ---
        if (mb_strlen($nom) > 100) {
            throw new \InvalidArgumentException(
                'Le nom ne peut pas dépasser 100 caractères.'
            );
        }

        // --- Name: allowed characters (letters incl. accented, spaces, hyphens, apostrophes) ---
        if (!preg_match("/^[\p{L}\s'\-]+$/u", $nom)) {
            throw new \InvalidArgumentException(
                "Le nom ne peut contenir que des lettres, des espaces, des apostrophes et tirets."
            );
        }

        // --- Description: optional, but capped at 1 000 characters ---
        $description = $categorie->getDescription();

        if ($description !== null && mb_strlen($description) > 1000) {
            throw new \InvalidArgumentException(
                'La description ne peut pas dépasser 1 000 caractères.'
            );
        }

        return true;
    }

    // -----------------------------------------------------------------------
    // Deletion guard
    // -----------------------------------------------------------------------

    /**
     * Checks whether a Categorie can safely be deleted.
     *
     * @throws \LogicException if the category still has articles attached.
     * @return true when deletion is safe.
     */
    public function canDelete(Categorie $categorie): bool
    {
        if ($categorie->getArticles()->count() > 0) {
            throw new \LogicException(
                'Cette catégorie ne peut pas être supprimée car elle contient des articles.'
            );
        }

        return true;
    }
}
