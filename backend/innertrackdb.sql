-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 01:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id_Article` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `datePublication` date NOT NULL,
  `readability` varchar(50) DEFAULT NULL,
  `auteur_user_id` int(11) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_Article`, `titre`, `contenu`, `datePublication`, `readability`, `auteur_user_id`, `id_categorie`) VALUES
(1, 'Understanding the Root of Anxiety', 'Anxiety is a natural response, but when it becomes chronic, it can be paralyzing. The first step is to recognize the triggers without judgment. Start by simply noticing when your chest tightens or your breath shortens.', '2026-05-05', NULL, 5, 1),
(2, 'The 4-7-8 Breathing Technique', 'Breath is the remote control for your nervous system. Inhale for 4 seconds, hold for 7, and exhale for 8. This signals to your vagus nerve that you are safe, down-regulating your fight-or-flight response.', '2026-05-05', NULL, 5, 1),
(3, 'Mindfulness and Letting Go', 'We often suffer more in imagination than in reality. Mindfulness is the practice of gently bringing your attention back to the present moment, acknowledging that you do not need to control everything.', '2026-05-05', NULL, 5, 1),
(4, 'Reframing Negative Thoughts', 'Cognitive distortions like catastrophizing can ruin your day. Try to catch the thought, challenge its validity, and replace it with a more balanced, realistic perspective. You are not your thoughts.', '2026-05-05', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_tag`
--

CREATE TABLE `article_tag` (
  `id_article` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_user`
--

CREATE TABLE `blocked_user` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `therapist_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocked_user`
--

INSERT INTO `blocked_user` (`id`, `client_id`, `therapist_id`, `created_at`) VALUES
(3, 28, 23, '2026-02-27 15:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`, `description`) VALUES
(1, 'Zen Journey Modules', 'Educational articles for the Zen Journey gamified path.');

-- --------------------------------------------------------

--
-- Table structure for table `chat_lock`
--

CREATE TABLE `chat_lock` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `locked_at` datetime NOT NULL,
  `locked_until` datetime DEFAULT NULL,
  `locked_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_lock`
--

INSERT INTO `chat_lock` (`id`, `user_id`, `reason`, `locked_at`, `locked_until`, `locked_by`, `is_active`) VALUES
(1, 29, 'Report: Contenu inapproprié', '2026-02-28 17:55:08', '2026-03-01 17:55:08', 27, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_profile`
--

CREATE TABLE `client_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_profile`
--

INSERT INTO `client_profile` (`id`, `user_id`, `date_of_birth`, `bio`, `created_at`) VALUES
(1, 20, NULL, '', '2026-02-22 23:55:25'),
(2, 28, NULL, NULL, '2026-02-26 00:36:40'),
(3, 29, NULL, NULL, '2026-02-28 16:48:04'),
(4, 30, NULL, '', '2026-04-01 18:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `community_comment`
--

CREATE TABLE `community_comment` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified` tinyint(4) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_reaction`
--

CREATE TABLE `community_reaction` (
  `reaction` varchar(8) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_request`
--

CREATE TABLE `contact_request` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `therapist_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `responded_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_request`
--

INSERT INTO `contact_request` (`id`, `client_id`, `therapist_id`, `message`, `status`, `created_at`, `responded_at`) VALUES
(1, 20, 23, 'Bonjour, je souhaite prendre contact avec vous.', 'ACCEPTED', '2026-02-25 20:34:14', '2026-02-25 20:36:02'),
(2, 20, 23, 'Bonjour, je souhaite prendre contact avec vous.', 'ACCEPTED', '2026-02-25 22:08:32', '2026-02-25 22:09:11'),
(3, 28, 23, 'Bonjour, je souhaite prendre contact avec vous.', 'ACCEPTED', '2026-02-26 00:37:10', '2026-02-26 00:37:48'),
(4, 20, 24, 'Bonjour, je souhaite prendre contact avec vous.', 'ACCEPTED', '2026-02-27 15:07:56', '2026-02-27 15:08:29'),
(5, 20, 23, 'Bonjour, je souhaite prendre contact avec vous via la carte InnerTrack.', 'ACCEPTED', '2026-04-01 17:00:02', '2026-04-01 18:25:20'),
(6, 30, 23, 'Bonjour, je souhaite prendre contact avec vous via la carte InnerTrack.', 'ACCEPTED', '2026-04-01 18:43:19', '2026-04-01 18:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `therapist_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `client_id`, `therapist_id`, `status`, `created_at`) VALUES
(1, 20, 23, 'ACTIVE', '2026-02-25 20:36:03'),
(3, 28, 23, 'BLOCKED', '2026-02-26 00:37:48'),
(4, 20, 24, 'ACTIVE', '2026-02-27 15:08:29'),
(6, 30, 23, 'ACTIVE', '2026-04-01 18:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `crisis_log`
--

CREATE TABLE `crisis_log` (
  `id` int(11) NOT NULL,
  `triggered_at` datetime NOT NULL,
  `resolved_at` datetime DEFAULT NULL,
  `intensity` int(11) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `coping_mechanism_used` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crisis_log`
--

INSERT INTO `crisis_log` (`id`, `triggered_at`, `resolved_at`, `intensity`, `notes`, `coping_mechanism_used`, `user_id`) VALUES
(1, '2026-05-05 22:18:15', NULL, NULL, NULL, '4-7-8 Breathing', 20),
(2, '2026-05-05 22:35:26', NULL, NULL, NULL, '4-7-8 Breathing', 20),
(3, '2026-05-05 23:12:04', NULL, NULL, NULL, '4-7-8 Breathing', 20),
(4, '2026-05-05 23:12:11', '2026-05-05 23:12:11', NULL, 'Completed grounding session.', '4-7-8 Breathing', 20),
(5, '2026-05-05 23:32:22', NULL, NULL, NULL, '4-7-8 Breathing', 20),
(6, '2026-05-05 23:32:25', '2026-05-05 23:32:25', NULL, 'Completed grounding session.', '4-7-8 Breathing', 20);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260122110709', '2026-01-27 13:15:08', 205),
('DoctrineMigrations\\Version20260126123343', NULL, NULL),
('DoctrineMigrations\\Version20260126123544', NULL, NULL),
('DoctrineMigrations\\Version20260127123032', '2026-01-27 13:31:18', 160),
('DoctrineMigrations\\Version20260203191836', NULL, NULL),
('DoctrineMigrations\\Version20260218195818', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_verification_code`
--

CREATE TABLE `email_verification_code` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `resend_attempts` int(11) NOT NULL,
  `verify_attempts` int(11) NOT NULL,
  `last_sent_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_verification_code`
--

INSERT INTO `email_verification_code` (`id`, `code`, `expires_at`, `used_at`, `user_id`, `resend_attempts`, `verify_attempts`, `last_sent_at`) VALUES
(5, '797904', '2026-02-12 19:20:38', '2026-02-12 19:11:09', 5, 1, 0, '2026-02-12 19:10:38'),
(6, '430492', '2026-02-12 19:53:12', '2026-02-12 19:43:34', 6, 1, 0, '2026-02-12 19:43:12'),
(7, '717720', '2026-02-13 16:13:50', '2026-02-13 16:04:32', 7, 1, 0, '2026-02-13 16:03:50'),
(8, '989425', '2026-02-13 16:15:22', NULL, 8, 1, 0, '2026-02-13 16:05:22'),
(9, '904032', '2026-02-18 09:28:10', '2026-02-18 09:18:29', 16, 1, 0, '2026-02-18 09:18:10'),
(10, '127296', '2026-02-19 09:14:06', '2026-02-19 09:04:30', 17, 1, 0, '2026-02-19 09:04:06'),
(11, '844185', '2026-02-19 09:19:05', '2026-02-19 09:09:29', 18, 1, 0, '2026-02-19 09:09:05'),
(12, '007551', '2026-02-22 16:17:02', '2026-02-22 16:07:30', 19, 1, 0, '2026-02-22 16:07:02'),
(13, '178197', '2026-02-23 00:05:25', '2026-02-22 23:56:01', 20, 1, 0, '2026-02-22 23:55:25'),
(14, '173450', '2026-02-23 13:33:51', '2026-02-23 13:24:17', 21, 1, 0, '2026-02-23 13:23:51'),
(16, '401983', '2026-03-02 00:20:00', '2026-03-02 00:10:25', 23, 2, 0, '2026-03-02 00:10:00'),
(17, '526842', '2026-02-23 22:33:48', '2026-02-23 22:24:28', 24, 1, 0, '2026-02-23 22:23:48'),
(18, '623568', '2026-02-25 22:14:12', '2026-02-25 22:04:41', 27, 1, 0, '2026-02-25 22:04:12'),
(19, '869975', '2026-02-26 00:46:40', '2026-02-26 00:36:53', 28, 1, 0, '2026-02-26 00:36:40'),
(20, '828280', '2026-02-28 16:58:04', '2026-02-28 16:48:33', 29, 1, 0, '2026-02-28 16:48:04'),
(21, '051800', '2026-04-01 18:57:34', NULL, 30, 1, 0, '2026-04-01 18:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `date_event` date NOT NULL,
  `id_type_event` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `capacite` int(11) NOT NULL,
  `statut` tinyint(4) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `habittracker`
--

CREATE TABLE `habittracker` (
  `Id_Habit` int(11) NOT NULL,
  `nom_habitude` varchar(255) NOT NULL,
  `emotion_dominantes` varchar(255) NOT NULL,
  `note_textuelle` longtext DEFAULT NULL,
  `niveau_energie` int(11) NOT NULL,
  `niveau_stress` int(11) NOT NULL,
  `qualite_sommeil` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `id` int(11) NOT NULL,
  `id_journal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historique_resultat`
--

CREATE TABLE `historique_resultat` (
  `id_historique` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `pourcentage` double DEFAULT NULL,
  `niveau` varchar(100) DEFAULT NULL,
  `date_passage` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `id_inscription` int(11) NOT NULL,
  `nom_participant` varchar(255) NOT NULL,
  `email_participant` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL,
  `statut` varchar(50) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_emotionnel`
--

CREATE TABLE `journal_emotionnel` (
  `id_journal` int(11) NOT NULL,
  `humeur` int(11) NOT NULL,
  `note_textuelle` longtext DEFAULT NULL,
  `date_saisie` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_path`
--

CREATE TABLE `learning_path` (
  `id_path` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` longtext DEFAULT NULL,
  `date_creation` date NOT NULL,
  `created_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_path`
--

INSERT INTO `learning_path` (`id_path`, `titre`, `description`, `date_creation`, `created_by_id`) VALUES
(1, 'Anxiety Foundations', 'Understand the roots of anxiety and learn the first steps to ground yourself when feeling overwhelmed.', '2026-05-05', 5),
(2, 'The Art of Letting Go', 'A module focused on releasing control, accepting uncertainty, and practicing mindfulness.', '2026-05-05', 5),
(3, 'Building Emotional Resilience', 'Strengthen your core self. Learn how to bounce back from difficult days with practical cognitive tools.', '2026-05-05', 5),
(4, 'Mastering Deep Sleep', 'Establish nighttime routines and thought patterns that invite restful, restorative sleep.', '2026-05-05', 5),
(5, 'Radical Compassion', 'Turn your empathy inward. This module teaches you how to treat yourself as gently as you treat a friend.', '2026-05-05', 5);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `conversation_id`, `sender_id`, `content`, `is_read`, `sent_at`) VALUES
(1, 1, 23, 'bonjour', 1, '2026-02-25 20:36:13'),
(2, 1, 20, 'hello i\'m looking to see if you\'re available', 1, '2026-02-25 20:37:05'),
(3, 1, 20, 'YO PLEASE RESPOND I NEED HELP', 1, '2026-02-26 00:13:00'),
(4, 3, 23, 'yo', 1, '2026-02-26 00:39:20'),
(5, 1, 20, 'respond please', 1, '2026-02-26 00:48:23'),
(6, 1, 20, 'eaea', 1, '2026-02-26 00:52:50'),
(7, 3, 23, 'put that pussy on the phone please', 1, '2026-02-27 15:04:14'),
(8, 3, 28, 'OMG THIS IS SEXUAL HARRASMENT', 1, '2026-02-27 15:05:37'),
(9, 4, 20, 'hello', 0, '2026-02-28 15:17:41'),
(10, 4, 20, 'yo', 0, '2026-04-01 16:54:11'),
(11, 4, 20, 'yo', 0, '2026-04-01 16:54:11'),
(12, 4, 20, 'bonjour', 0, '2026-04-01 17:00:54'),
(13, 4, 20, 'hello', 0, '2026-04-01 18:07:00'),
(14, 4, 20, 'how can i come in contact with you?', 0, '2026-04-01 18:07:00'),
(15, 6, 23, 'bonjour', 1, '2026-04-01 18:44:53'),
(16, 6, 23, 'bonjour again', 1, '2026-04-01 18:52:15'),
(17, 6, 30, 'yay works', 1, '2026-04-01 18:52:44'),
(18, 1, 23, 'hello', 1, '2026-05-11 21:17:27'),
(19, 1, 20, 'hi?', 1, '2026-05-11 22:43:07'),
(20, 1, 23, 'i accidentally blocked you sorry for that', 1, '2026-05-11 21:43:26'),
(21, 1, 20, 'no problem', 1, '2026-05-11 22:43:38'),
(22, 1, 20, 'ive been looking forward to have sessions with you', 1, '2026-05-11 22:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'SYSTEM',
  `title` varchar(150) NOT NULL,
  `body` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `reference_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `type`, `title`, `body`, `is_read`, `reference_id`, `created_at`) VALUES
(1, 23, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'Un patient souhaite vous contacter.', 1, 1, '2026-02-25 20:34:14'),
(2, 20, 'CONTACT_REQUEST', 'Demande acceptée', 'Votre thérapeute a accepté votre demande. Vous pouvez maintenant échanger.', 1, 1, '2026-02-25 20:36:03'),
(3, 20, 'MESSAGE', 'Nouveau message', 'imen makhlouf vous a envoyé un message.', 1, 1, '2026-02-25 20:36:13'),
(4, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-02-25 20:37:05'),
(5, 23, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'Un patient souhaite vous contacter.', 1, 2, '2026-02-25 22:08:32'),
(6, 27, 'SYSTEM', 'Nouveau signalement', 'imen makhlouf a signalé ahmed maalaoui pour : Harcèlement', 1, 0, '2026-02-25 23:25:55'),
(7, 20, 'SYSTEM', 'Avertissement', 'Votre comportement a été signalé. Respectez les règles de la plateforme.', 1, 0, '2026-02-25 23:26:35'),
(8, 27, 'SYSTEM', 'Nouveau signalement', 'imen makhlouf a signalé ahmed maalaoui pour : Harcèlement', 1, 0, '2026-02-26 00:03:33'),
(9, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-02-26 00:13:00'),
(10, 20, 'SYSTEM', 'Compte suspendu', 'Votre compte a été temporairement suspendu suite à un signalement.', 1, 0, '2026-02-26 00:33:59'),
(11, 27, 'SYSTEM', 'Blocage signalé', 'imen makhlouf a bloqué l\'utilisateur ahmed maalaoui.', 1, 0, '2026-02-26 00:33:59'),
(12, 27, 'SYSTEM', 'Nouveau signalement', 'imen makhlouf a signalé ahmed maalaoui pour : Contenu inapproprié', 1, 0, '2026-02-26 00:34:08'),
(13, 20, 'SYSTEM', 'Compte bloqué', 'Votre compte a été bloqué suite à un signalement.', 1, 0, '2026-02-26 00:35:22'),
(14, 23, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'Un patient souhaite vous contacter.', 1, 3, '2026-02-26 00:37:10'),
(15, 28, 'CONTACT_REQUEST', 'Demande acceptée', 'Votre thérapeute a accepté votre demande. Vous pouvez maintenant échanger.', 0, 3, '2026-02-26 00:37:48'),
(16, 28, 'MESSAGE', 'Nouveau message', 'imen makhlouf vous a envoyé un message.', 0, 3, '2026-02-26 00:39:20'),
(17, 27, 'SYSTEM', 'Utilisateur bloqué', 'imen makhlouf a bloqué les messages de ahmed maalaoui.', 1, 0, '2026-02-26 00:48:01'),
(18, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-02-26 00:48:23'),
(19, 27, 'SYSTEM', 'Nouveau signalement', 'ahmed maalaoui a signalé imen makhlouf pour : Autre', 1, 0, '2026-02-26 00:48:34'),
(20, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-02-26 00:52:50'),
(21, 27, 'SYSTEM', 'Utilisateur bloqué', 'imen makhlouf a bloqué les messages de ahmed maalaoui.', 1, 0, '2026-02-26 00:53:15'),
(22, 28, 'MESSAGE', 'Nouveau message', 'imen makhlouf vous a envoyé un message.', 0, 3, '2026-02-27 15:04:14'),
(23, 23, 'MESSAGE', 'Nouveau message', 'emna maalaoui vous a envoyé un message.', 1, 3, '2026-02-27 15:05:37'),
(24, 27, 'SYSTEM', 'Nouveau signalement', 'emna maalaoui a signalé imen makhlouf pour : Harcèlement', 1, 0, '2026-02-27 15:05:45'),
(25, 23, 'SYSTEM', 'Avertissement', 'Votre comportement a été signalé. Respectez les règles de la plateforme.', 1, 0, '2026-02-27 15:06:33'),
(26, 27, 'SYSTEM', 'Utilisateur bloqué', 'imen makhlouf a bloqué les messages de emna maalaoui.', 1, 0, '2026-02-27 15:06:58'),
(27, 24, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'Un patient souhaite vous contacter.', 0, 4, '2026-02-27 15:07:56'),
(28, 20, 'CONTACT_REQUEST', 'Demande acceptée', 'Votre thérapeute a accepté votre demande. Vous pouvez maintenant échanger.', 1, 4, '2026-02-27 15:08:29'),
(29, 24, 'MESSAGE', 'New message', 'ahmed maalaoui sent you a message.', 0, 4, '2026-02-28 15:17:41'),
(30, 27, 'SYSTEM', 'New Community Report', 'ahmed maalaoui reported salah salah for: INAPPROPRIATE (Community Forum)', 1, 0, '2026-02-28 16:51:53'),
(31, 29, 'SYSTEM', 'Compte bloqué', 'Votre compte a été bloqué suite à un signalement.', 1, 0, '2026-02-28 17:02:23'),
(32, 27, 'SYSTEM', 'New Community Report', 'ahmed maalaoui reported salah salah for: INAPPROPRIATE (Community Forum)', 1, 0, '2026-02-28 17:06:10'),
(33, 27, 'SYSTEM', 'New Community Report', 'ahmed maalaoui reported imen makhlouf for: INAPPROPRIATE (Community Forum)', 1, 0, '2026-02-28 17:30:12'),
(34, 23, 'SYSTEM', 'Avertissement', 'Votre comportement a été signalé. Respectez les règles de la plateforme.', 1, 0, '2026-02-28 17:30:56'),
(35, 27, 'SYSTEM', 'New Community Report', 'ahmed maalaoui reported salah salah for: INAPPROPRIATE (Community Forum)', 1, 0, '2026-02-28 17:43:47'),
(36, 29, 'SYSTEM', 'Community Posting Locked', 'Your community posting has been locked until 01/03/2026 17:55. Reason: Contenu inapproprié', 1, 0, '2026-02-28 17:55:08'),
(37, 24, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 0, 4, '2026-04-01 16:54:11'),
(38, 24, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 0, 4, '2026-04-01 16:54:11'),
(39, 23, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'ahmed maalaoui souhaite vous contacter.', 1, NULL, '2026-04-01 17:00:02'),
(40, 24, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 0, 4, '2026-04-01 17:00:54'),
(41, 24, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 0, 4, '2026-04-01 18:07:00'),
(42, 24, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 0, 4, '2026-04-01 18:07:00'),
(43, 20, 'CONTACT_REQUEST', 'Demande acceptée', 'imen makhlouf a accepté votre demande de contact.', 1, NULL, '2026-04-01 18:25:20'),
(44, 23, 'CONTACT_REQUEST', 'Nouvelle demande de contact', 'mohsen maalaoui souhaite vous contacter.', 1, NULL, '2026-04-01 18:43:19'),
(45, 30, 'CONTACT_REQUEST', 'Demande acceptée', 'imen makhlouf a accepté votre demande de contact.', 0, NULL, '2026-04-01 18:44:34'),
(46, 30, 'MESSAGE', 'Nouveau message', 'imen makhlouf vous a envoyé un message.', 0, 6, '2026-04-01 18:44:53'),
(47, 30, 'MESSAGE', 'Nouveau message', 'imen makhlouf vous a envoyé un message.', 0, 6, '2026-04-01 18:52:15'),
(48, 23, 'MESSAGE', 'Nouveau message', 'mohsen maalaoui vous a envoyé un message.', 1, 6, '2026-04-01 18:52:44'),
(49, 20, 'MESSAGE', 'New message', 'imen makhlouf sent you a message.', 1, 1, '2026-05-11 21:17:27'),
(50, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-05-11 22:43:07'),
(51, 20, 'MESSAGE', 'New message', 'imen makhlouf sent you a message.', 0, 1, '2026-05-11 21:43:26'),
(52, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-05-11 22:43:38'),
(53, 23, 'MESSAGE', 'Nouveau message', 'ahmed maalaoui vous a envoyé un message.', 1, 1, '2026-05-11 22:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_codes`
--

CREATE TABLE `password_reset_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_codes`
--

INSERT INTO `password_reset_codes` (`id`, `user_id`, `code`, `expires_at`, `used_at`, `created_at`) VALUES
(1, 23, '969172', '2026-02-25 23:40:25', '2026-02-25 23:30:48', '2026-02-25 23:30:25'),
(2, 23, '077035', '2026-04-02 10:38:56', '2026-04-02 10:09:47', '2026-04-02 10:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `path_article`
--

CREATE TABLE `path_article` (
  `ordre` int(11) NOT NULL,
  `id_path` int(11) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `path_article`
--

INSERT INTO `path_article` (`ordre`, `id_path`, `id_article`) VALUES
(1, 1, 1),
(2, 1, 4),
(2, 2, 1),
(1, 2, 3),
(2, 3, 1),
(1, 3, 3),
(1, 4, 1),
(2, 4, 3),
(1, 5, 1),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `contenu` longtext NOT NULL,
  `id_test` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `reporter_id` int(11) NOT NULL,
  `reported_id` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `context` varchar(20) DEFAULT 'MESSAGING',
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `reporter_id`, `reported_id`, `reason`, `details`, `context`, `status`, `created_at`, `reviewed_at`, `reviewed_by`) VALUES
(1, 23, 20, 'HARASSMENT', 'said some bullshit ban this nigga', 'MESSAGING', 'REVIEWED', '2026-02-25 23:25:55', '2026-02-25 23:26:35', 27),
(2, 23, 20, 'HARASSMENT', '', 'MESSAGING', 'DISMISSED', '2026-02-26 00:03:33', '2026-02-26 00:04:00', 27),
(3, 23, 20, 'INAPPROPRIATE', '', 'MESSAGING', 'REVIEWED', '2026-02-26 00:34:08', '2026-02-26 00:35:22', 27),
(4, 20, 23, 'OTHER', '', 'MESSAGING', 'DISMISSED', '2026-02-26 00:48:34', '2026-02-27 15:06:26', 27),
(5, 28, 23, 'HARASSMENT', 'VERY RUDE', 'MESSAGING', 'REVIEWED', '2026-02-27 15:05:45', '2026-02-27 15:06:33', 27),
(6, 20, 29, 'INAPPROPRIATE', 'he said a bad word', 'MESSAGING', 'REVIEWED', '2026-02-28 16:51:53', '2026-02-28 17:02:23', 27),
(7, 20, 29, 'INAPPROPRIATE', '', 'MESSAGING', 'DISMISSED', '2026-02-28 17:06:10', '2026-02-28 17:31:01', 27),
(8, 20, 23, 'INAPPROPRIATE', 'Reported Comment: \"any one that needs help with anxiety can contact me\"\n\nUser Details: ', 'COMMUNITY', 'REVIEWED', '2026-02-28 17:30:12', '2026-02-28 17:30:57', 27),
(9, 20, 29, 'INAPPROPRIATE', 'Reported Comment: \"i have been dealing with depression lately and i really need help\"\n\nUser Details: ', 'COMMUNITY', 'REVIEWED', '2026-02-28 17:43:47', '2026-02-28 17:55:08', 27);

-- --------------------------------------------------------

--
-- Table structure for table `resultat`
--

CREATE TABLE `resultat` (
  `id_resultat` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `score_total` int(11) NOT NULL,
  `score_max_possible` int(11) NOT NULL,
  `pourcentage` double NOT NULL,
  `resultat` varchar(255) NOT NULL DEFAULT 'Non évalué',
  `interpretation` longtext DEFAULT NULL,
  `date_passage` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_psychologique`
--

CREATE TABLE `test_psychologique` (
  `id_test` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `id_type` int(11) NOT NULL,
  `description` longtext DEFAULT NULL,
  `nombre_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `therapist_profile`
--

CREATE TABLE `therapist_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `license_number` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `address` varchar(500) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `session_rate` int(11) DEFAULT NULL,
  `available_days` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapist_profile`
--

INSERT INTO `therapist_profile` (`id`, `user_id`, `specialization`, `license_number`, `bio`, `created_at`, `address`, `latitude`, `longitude`, `phone`, `session_rate`, `available_days`) VALUES
(1, 21, NULL, NULL, NULL, '2026-02-23 13:23:51', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 23, 'Psychologie du travail', '', 'je suis une psy trés professionelle plus de 20 ans experience', '2026-02-23 13:39:37', 'Fédération Tunisienne de Football, شارع محمد علي عقيد, El Menzah 1, حي السلام, معتمدية حي الخضراء, Tunis, 2058, Tunisia', 36.84167885020483, 10.189132690429688, '93061108', 60, 'MON,WED,FRI'),
(4, 24, NULL, '', '', '2026-02-23 22:23:48', NULL, 34.73907339121123, 10.774669647216799, '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tranche_resultat`
--

CREATE TABLE `tranche_resultat` (
  `id_tranche` int(11) NOT NULL,
  `score_min` int(11) NOT NULL,
  `score_max` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `interpretation` longtext DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `id_test` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_test`
--

CREATE TABLE `type_test` (
  `id_type` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `is_verified` tinyint(4) NOT NULL,
  `status` varchar(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `roles`, `is_verified`, `status`, `first_name`, `last_name`, `profile_picture`, `created_at`, `last_login`, `phone_number`) VALUES
(5, 'test2@gmail.com', '$2a$10$MSPfy6xXVilX9R9ILkBe0eqyp42HEtK6NwCDi/xuadEB/wu9pNFSG', '[\"ROLE_USER\"]', 1, 'ACTIVE', '', '', NULL, '2026-02-19 10:29:22', NULL, NULL),
(6, 'test3@gmail.com', '$2a$10$mO0gZyGW0TdIolUHD6PjDOe5rg2VxPDRhvPG0yZQzYu7aMNT73sYq', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', '', '', NULL, '2026-02-19 10:29:22', NULL, NULL),
(7, 'test4@gmail.com', '$2a$10$oCnzGiba7xwyl12BzrOij.p4GbeHJkWrrvNGXPgI4zG/j.ilR7Cn2', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', '', '', NULL, '2026-02-19 10:29:22', NULL, NULL),
(8, 'test5@gmail.com', '$2a$10$EjHQMsCqHC6SPxOLdxxbvO.mHpuMBLswYr03Sc4IC0l6XBEsY9ux2', '[\"ROLE_USER\"]', 0, 'PENDING', '', '', NULL, '2026-02-19 10:29:22', NULL, NULL),
(16, 'test7@gmail.com', '$2a$10$aV31PkIJGgX.uM.b9qaiAOI7wg91xTnszJxRm./yUoSnOSqKnT3KG', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', '', '', NULL, '2026-02-19 10:29:22', NULL, NULL),
(17, 'maalaoui.ahmed@gmail.com', '$2a$10$tbDvSE9FlGqhrCuubQPUy.5bWU6oC7Izq.kCAXNsWI51K7pV/3mA6', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'maalaoui', 'ahmed', 'C:\\Users\\Laptop l\\Desktop\\javafx-symfony-test\\javafx-symfony-test\\uploads\\profiles\\17_1771488428109_istockphoto-1443828576-612x612.jpg', '2026-02-19 10:29:22', NULL, NULL),
(18, 'sliment@gmail.com', '$2a$10$A6/3RnpJNdFxHJ0KwpnHDus/dQbfo/5k2OJpJCjgdAvCYltPvMqRW', '[\"ROLE_PSYCHOLOGUE\"]', 0, 'PENDING', 'slimen', 'abyeth', 'C:\\Users\\Laptop l\\Desktop\\javafx-symfony-test\\javafx-symfony-test\\uploads\\profiles\\18_1771488651018_6736559ae72edd152d769cb2490b2c8e.jpg', '2026-02-19 10:29:22', '2026-02-22 19:58:35', NULL),
(19, 'maalaoui@gmail.com', '$2a$10$Hxz4u03pICYS.MGb6weO7e.KUw2bgkzXzXjIkCHrvYrr/rg.cGZii', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'ahmed', 'maalaoui', 'C:\\Users\\Bratan\\javafx-symfony-test\\javafx-symfony-test\\uploads\\profiles\\19_1771779678361_35 BURPEES.jpg', '2026-02-22 16:07:02', '2026-02-22 19:59:43', NULL),
(20, 'ahmed1@gmail.com', '$2y$13$ZEtXk.iODQGAA.3r6qin4OKTR9lDVkmofZMVdQzQ6rWA1cjnQT0Hm', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'ahmed', 'maalaoui', 'https://i.ibb.co/vxBkLQRD/php-C007.jpg', '2026-02-22 23:55:25', '2026-05-11 22:18:26', '93061108'),
(21, 'ahmed@gmail.com', '$2a$10$6kjfvrthEjMLJxMSJcQhceQ5d7T1TFoWSi47rZkGBpFGulubjd8wG', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', 'ahmed', 'tbib', NULL, '2026-02-23 13:23:51', '2026-02-24 19:37:29', NULL),
(23, 'imen@gmail.com', '$2y$13$VCa0kCq.xasejwonJdZ5OegrU9CY7Tu20eV7g2NZLPI2q0su5eCsy', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', 'imen', 'makhlouf', 'https://i.ibb.co/5XPzrd8v/460116356-1014687027250405-605844003359334191-n-jpg.jpg', '2026-02-23 13:39:37', '2026-05-05 23:14:08', ''),
(24, 'mohamed@gmail.com', '$2a$10$Ii0eterZFDD/O/ssiop/xuV5OpJ4LBeIH230RAr/69w1iaW7kgBqa', '[\"ROLE_PSYCHOLOGUE\"]', 1, 'ACTIVE', 'mohamed', 'salah', 'C:\\Users\\Bratan\\javafx-symfony-test\\javafx-symfony-test\\uploads\\profiles\\24_1772201383878_35 BURPEES.jpg', '2026-02-23 22:23:48', '2026-02-27 15:08:15', NULL),
(27, 'admin@innertrack.com', '$2y$13$cMqrTsg2XkBctMM5.arAm.PYcnHkgGxkew.E9YBTUijuRj4vZejdG', '[\"ROLE_ADMIN\"]', 1, 'ACTIVE', 'admin', 'innertrack', NULL, '2026-02-25 22:04:12', '2026-05-06 00:49:35', NULL),
(28, 'emna@gmail.com', '$2a$10$9H4TY2DHmmj/Qm5zo0UZuuNRM8q/eQMBdBvg0ZKUfHrcfz5o2tNMW', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'emna', 'maalaoui', NULL, '2026-02-26 00:36:40', '2026-02-27 15:05:19', NULL),
(29, 'salah@gmail.com', '$2a$10$UAdo15UXMV8Ia1lnKiSxEuW5o7v8FH8/sFcKgPevm5qf57wKciJLC', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'salah', 'salah', NULL, '2026-02-28 16:48:04', '2026-02-28 17:55:26', NULL),
(30, 'mohsen@gmail.com', '$2y$13$Mp0rfGubFtPnayZm9d1FS.P0aNWJgaoWwfPdmqoWIzEuLGq9bs1Ny', '[\"ROLE_USER\"]', 1, 'ACTIVE', 'mohsen', 'maalaoui', 'https://i.ibb.co/WbQj6wh/php32BA.webp', '2026-04-01 18:42:33', '2026-04-01 18:52:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `user_id` int(11) NOT NULL,
  `theme` enum('LIGHT','DARK') DEFAULT 'LIGHT',
  `font_size` enum('SMALL','NORMAL','LARGE') DEFAULT 'NORMAL',
  `language` enum('EN','FR') DEFAULT 'FR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`user_id`, `theme`, `font_size`, `language`) VALUES
(18, 'DARK', 'NORMAL', 'EN'),
(19, 'DARK', 'NORMAL', 'EN'),
(20, 'LIGHT', 'NORMAL', 'FR'),
(21, 'LIGHT', 'NORMAL', 'FR'),
(23, 'LIGHT', 'NORMAL', 'EN'),
(24, 'LIGHT', 'NORMAL', 'FR'),
(27, 'LIGHT', 'NORMAL', 'EN'),
(28, 'LIGHT', 'NORMAL', 'FR'),
(29, 'LIGHT', 'NORMAL', 'FR'),
(30, 'LIGHT', 'NORMAL', 'FR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_Article`),
  ADD UNIQUE KEY `UNIQ_23A0E66FF7747B4` (`titre`),
  ADD KEY `IDX_23A0E66194C10F0` (`auteur_user_id`),
  ADD KEY `IDX_23A0E66C9486A13` (`id_categorie`);

--
-- Indexes for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id_article`,`id_tag`),
  ADD KEY `IDX_919694F9DCA7A716` (`id_article`),
  ADD KEY `IDX_919694F99D2D5FD9` (`id_tag`);

--
-- Indexes for table `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_718E113719EB6921` (`client_id`),
  ADD KEY `IDX_718E113743E8B094` (`therapist_id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `UNIQ_497DD6346C6E55B5` (`nom`);

--
-- Indexes for table `chat_lock`
--
ALTER TABLE `chat_lock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_2113064FA76ED395` (`user_id`);

--
-- Indexes for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `community_comment`
--
ALTER TABLE `community_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B0B13B3FA76ED395` (`user_id`),
  ADD KEY `IDX_B0B13B3F727ACA70` (`parent_id`);

--
-- Indexes for table `community_reaction`
--
ALTER TABLE `community_reaction`
  ADD PRIMARY KEY (`user_id`,`comment_id`),
  ADD KEY `IDX_5691C2D0A76ED395` (`user_id`),
  ADD KEY `IDX_5691C2D0F8697D13` (`comment_id`);

--
-- Indexes for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cr_client` (`client_id`),
  ADD KEY `fk_cr_therapist` (`therapist_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_conv` (`client_id`,`therapist_id`),
  ADD KEY `fk_conv_therapist` (`therapist_id`);

--
-- Indexes for table `crisis_log`
--
ALTER TABLE `crisis_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67B227DEA76ED395` (`user_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `email_verification_code`
--
ALTER TABLE `email_verification_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BD2ADC58A76ED395` (`user_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `habittracker`
--
ALTER TABLE `habittracker`
  ADD PRIMARY KEY (`Id_Habit`),
  ADD KEY `IDX_F8161C68BF396750` (`id`),
  ADD KEY `IDX_F8161C681F3A4E3D` (`id_journal`);

--
-- Indexes for table `historique_resultat`
--
ALTER TABLE `historique_resultat`
  ADD PRIMARY KEY (`id_historique`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `IDX_5E90F6D68B13D439` (`id_evenement`);

--
-- Indexes for table `journal_emotionnel`
--
ALTER TABLE `journal_emotionnel`
  ADD PRIMARY KEY (`id_journal`),
  ADD KEY `IDX_443F70FBF396750` (`id`);

--
-- Indexes for table `learning_path`
--
ALTER TABLE `learning_path`
  ADD PRIMARY KEY (`id_path`),
  ADD KEY `IDX_4D04C797B03A8386` (`created_by_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_msg_conv` (`conversation_id`,`sent_at`),
  ADD KEY `fk_msg_sender` (`sender_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_notif_user` (`user_id`,`is_read`);

--
-- Indexes for table `password_reset_codes`
--
ALTER TABLE `password_reset_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reset_user` (`user_id`);

--
-- Indexes for table `path_article`
--
ALTER TABLE `path_article`
  ADD PRIMARY KEY (`id_path`,`id_article`),
  ADD KEY `IDX_C58C384F8074970D` (`id_path`),
  ADD KEY `IDX_C58C384FDCA7A716` (`id_article`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `IDX_B6F7494E535F620E` (`id_test`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_report_status` (`status`),
  ADD KEY `idx_report_reporter` (`reporter_id`),
  ADD KEY `fk_report_reported` (`reported_id`);

--
-- Indexes for table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`id_resultat`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `UNIQ_389B7836C6E55B5` (`nom`);

--
-- Indexes for table `test_psychologique`
--
ALTER TABLE `test_psychologique`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `therapist_profile`
--
ALTER TABLE `therapist_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tranche_resultat`
--
ALTER TABLE `tranche_resultat`
  ADD PRIMARY KEY (`id_tranche`),
  ADD KEY `IDX_1F66DDA535F620E` (`id_test`);

--
-- Indexes for table `type_test`
--
ALTER TABLE `type_test`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blocked_user`
--
ALTER TABLE `blocked_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_lock`
--
ALTER TABLE `chat_lock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_profile`
--
ALTER TABLE `client_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `community_comment`
--
ALTER TABLE `community_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_request`
--
ALTER TABLE `contact_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `crisis_log`
--
ALTER TABLE `crisis_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `email_verification_code`
--
ALTER TABLE `email_verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `habittracker`
--
ALTER TABLE `habittracker`
  MODIFY `Id_Habit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historique_resultat`
--
ALTER TABLE `historique_resultat`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_emotionnel`
--
ALTER TABLE `journal_emotionnel`
  MODIFY `id_journal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learning_path`
--
ALTER TABLE `learning_path`
  MODIFY `id_path` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `password_reset_codes`
--
ALTER TABLE `password_reset_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `id_resultat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_psychologique`
--
ALTER TABLE `test_psychologique`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `therapist_profile`
--
ALTER TABLE `therapist_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tranche_resultat`
--
ALTER TABLE `tranche_resultat`
  MODIFY `id_tranche` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_test`
--
ALTER TABLE `type_test`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E66194C10F0` FOREIGN KEY (`auteur_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_23A0E66C9486A13` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

--
-- Constraints for table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `FK_919694F99D2D5FD9` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`),
  ADD CONSTRAINT `FK_919694F9DCA7A716` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_Article`);

--
-- Constraints for table `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD CONSTRAINT `FK_718E113719EB6921` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_718E113743E8B094` FOREIGN KEY (`therapist_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `chat_lock`
--
ALTER TABLE `chat_lock`
  ADD CONSTRAINT `FK_2113064FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `community_comment`
--
ALTER TABLE `community_comment`
  ADD CONSTRAINT `FK_B0B13B3F727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `community_comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B0B13B3FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `community_reaction`
--
ALTER TABLE `community_reaction`
  ADD CONSTRAINT `FK_5691C2D0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5691C2D0F8697D13` FOREIGN KEY (`comment_id`) REFERENCES `community_comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD CONSTRAINT `fk_cr_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cr_therapist` FOREIGN KEY (`therapist_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `fk_conv_client` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_conv_therapist` FOREIGN KEY (`therapist_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crisis_log`
--
ALTER TABLE `crisis_log`
  ADD CONSTRAINT `FK_67B227DEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `email_verification_code`
--
ALTER TABLE `email_verification_code`
  ADD CONSTRAINT `FK_BD2ADC58A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `habittracker`
--
ALTER TABLE `habittracker`
  ADD CONSTRAINT `FK_F8161C681F3A4E3D` FOREIGN KEY (`id_journal`) REFERENCES `journal_emotionnel` (`id_journal`),
  ADD CONSTRAINT `FK_F8161C68BF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D68B13D439` FOREIGN KEY (`id_evenement`) REFERENCES `event` (`id_event`);

--
-- Constraints for table `journal_emotionnel`
--
ALTER TABLE `journal_emotionnel`
  ADD CONSTRAINT `FK_443F70FBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `learning_path`
--
ALTER TABLE `learning_path`
  ADD CONSTRAINT `FK_4D04C797B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_msg_conv` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_msg_sender` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notif_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_codes`
--
ALTER TABLE `password_reset_codes`
  ADD CONSTRAINT `fk_reset_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `path_article`
--
ALTER TABLE `path_article`
  ADD CONSTRAINT `FK_C58C384F8074970D` FOREIGN KEY (`id_path`) REFERENCES `learning_path` (`id_path`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C58C384FDCA7A716` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_Article`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E535F620E` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_reported` FOREIGN KEY (`reported_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_report_reporter` FOREIGN KEY (`reporter_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `therapist_profile`
--
ALTER TABLE `therapist_profile`
  ADD CONSTRAINT `fk_therapist_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tranche_resultat`
--
ALTER TABLE `tranche_resultat`
  ADD CONSTRAINT `FK_1F66DDA535F620E` FOREIGN KEY (`id_test`) REFERENCES `test_psychologique` (`id_test`);

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `FK_SETTINGS_USER` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
