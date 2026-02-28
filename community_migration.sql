-- ═══════════════════════════════════════════════════════════════
-- Community Forum Migration Script for InnerTrack
-- Run this in phpMyAdmin against your `testdb` database
-- ═══════════════════════════════════════════════════════════════

-- ═══ Community Comments ═══
CREATE TABLE IF NOT EXISTS `community_comment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `content` VARCHAR(500) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `modified` TINYINT(1) NOT NULL DEFAULT 0,
  `parent_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cc_parent` (`parent_id`),
  KEY `idx_cc_user` (`user_id`),
  CONSTRAINT `fk_cc_parent` FOREIGN KEY (`parent_id`) REFERENCES `community_comment` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cc_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Trigger: auto-set modified flag when content changes
DELIMITER $$
CREATE TRIGGER `trg_cc_set_modified` BEFORE UPDATE ON `community_comment`
FOR EACH ROW
  IF NOT (NEW.content <=> OLD.content) THEN
    SET NEW.modified = 1;
  END IF$$
DELIMITER ;

-- ═══ Community Reactions ═══
CREATE TABLE IF NOT EXISTS `community_reaction` (
  `user_id` INT(11) NOT NULL,
  `comment_id` INT(11) NOT NULL,
  `reaction` VARCHAR(8) DEFAULT NULL,
  PRIMARY KEY (`user_id`, `comment_id`),
  KEY `idx_cr_comment` (`comment_id`),
  CONSTRAINT `fk_cr_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cr_comment` FOREIGN KEY (`comment_id`) REFERENCES `community_comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ═══ Chat Lock (punishment system) ═══
CREATE TABLE IF NOT EXISTS `chat_lock` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `reason` VARCHAR(255) NOT NULL,
  `locked_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `locked_until` DATETIME DEFAULT NULL,
  `locked_by` INT(11) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_cl_user` (`user_id`, `is_active`),
  CONSTRAINT `fk_cl_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cl_admin` FOREIGN KEY (`locked_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ═══ Add context column to existing report table ═══
ALTER TABLE `report` ADD COLUMN IF NOT EXISTS `context` VARCHAR(20) DEFAULT 'MESSAGING' AFTER `details`;
