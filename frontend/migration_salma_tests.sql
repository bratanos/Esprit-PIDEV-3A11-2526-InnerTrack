-- ═══════════════════════════════════════════════════
-- MIGRATION SQL POUR LE MODULE TESTS PSYCHOLOGIQUES - SALMA
-- ═══════════════════════════════════════════════════

-- 1. Table `type_test`
CREATE TABLE IF NOT EXISTS `type_test` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert some default types
INSERT IGNORE INTO `type_test` (`id_type`, `libelle`) VALUES
(1, 'Anxiété'),
(2, 'Dépression'),
(3, 'Stress'),
(4, 'Personnalité');

-- 2. Table `test_psychologique`
CREATE TABLE IF NOT EXISTS `test_psychologique` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `id_type` int(11) NOT NULL,
  `description` text,
  `nombre_questions` int(11) DEFAULT '0',
  PRIMARY KEY (`id_test`),
  KEY `IDX_TEST_TYPE` (`id_type`),
  CONSTRAINT `FK_TEST_TYPE` FOREIGN KEY (`id_type`) REFERENCES `type_test` (`id_type`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Table `question`
CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `IDX_QUESTION_TEST` (`id_test`),
  CONSTRAINT `FK_QUESTION_TEST` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Table `reponse` (Options de réponse pour une question)
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_reponse`),
  KEY `IDX_REPONSE_QUESTION` (`id_question`),
  CONSTRAINT `FK_REPONSE_QUESTION` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Table `reponse_utilisateur` (Les réponses choisies par l'utilisateur)
CREATE TABLE IF NOT EXISTS `reponse_utilisateur` (
  `id_reponse_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_reponse` int(11) NOT NULL,
  `date_reponse` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reponse_utilisateur`),
  KEY `IDX_RU_USER` (`id_utilisateur`),
  KEY `IDX_RU_QUESTION` (`id_question`),
  KEY `IDX_RU_REPONSE` (`id_reponse`),
  CONSTRAINT `FK_RU_USER` FOREIGN KEY (`id_utilisateur`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_RU_QUESTION` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`) ON DELETE CASCADE,
  CONSTRAINT `FK_RU_REPONSE` FOREIGN KEY (`id_reponse`) REFERENCES `reponse` (`id_reponse`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Table `tranche_resultat` (Pour l'interprétation des scores)
CREATE TABLE IF NOT EXISTS `tranche_resultat` (
  `id_tranche` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `score_min` int(11) NOT NULL,
  `score_max` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `interpretation` text,
  `niveau` varchar(50) DEFAULT 'Normal',
  PRIMARY KEY (`id_tranche`),
  KEY `IDX_TRANCHE_TEST` (`id_test`),
  CONSTRAINT `FK_TRANCHE_TEST` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 7. Table `resultat` (Le résultat final d'un test calculé pour un user)
CREATE TABLE IF NOT EXISTS `resultat` (
  `id_resultat` int(11) NOT NULL AUTO_INCREMENT,
  `id_test` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `score_total` int(11) NOT NULL,
  `score_max_possible` int(11) NOT NULL,
  `pourcentage` double NOT NULL,
  `resultat` varchar(255) NOT NULL,
  `interpretation` text,
  `date_passage` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_resultat`),
  UNIQUE KEY `UNIQ_RESULT_TEST_USER` (`id_test`, `id_utilisateur`),
  KEY `IDX_RESULTAT_USER` (`id_utilisateur`),
  CONSTRAINT `FK_RESULTAT_TEST` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`) ON DELETE CASCADE,
  CONSTRAINT `FK_RESULTAT_USER` FOREIGN KEY (`id_utilisateur`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 8. Table `historique_resultat` (Toutes les fois où un user a passé un test)
CREATE TABLE IF NOT EXISTS `historique_resultat` (
  `id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `pourcentage` double NOT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `date_passage` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historique`),
  KEY `IDX_HIST_USER` (`id_utilisateur`),
  KEY `IDX_HIST_TEST` (`id_test`),
  CONSTRAINT `FK_HIST_USER` FOREIGN KEY (`id_utilisateur`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_HIST_TEST` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 9. Table `ai_recommandation`
CREATE TABLE IF NOT EXISTS `ai_recommandation` (
  `id_recommandation` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `cluster_profil` varchar(255) NOT NULL,
  `confiance` double NOT NULL,
  `habitudes_suggerees` json DEFAULT NULL,
  `plan_action` json DEFAULT NULL,
  `alertes_critiques` json DEFAULT NULL,
  `date_generation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_recommandation`),
  KEY `IDX_AI_REC_USER` (`id_utilisateur`),
  KEY `IDX_AI_REC_TEST` (`id_test`),
  CONSTRAINT `FK_AI_REC_USER` FOREIGN KEY (`id_utilisateur`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_AI_REC_TEST` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Done! These 9 tables cover the entire psychology testing module.
