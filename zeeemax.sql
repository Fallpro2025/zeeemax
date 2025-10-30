-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 oct. 2025 à 23:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zeeemax`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `email`, `password`, `telephone`, `actif`, `created_at`, `updated_at`) VALUES
(1, 'Codou Mbaye', 'admin@zeeemax.com', '$2y$12$e3vX0sztzqz2O6l3z9lLzO9R.b49urphqVsY1lSy.EkyJtxgJfrpO', '+33 7 66 01 29 25', 1, '2025-10-29 13:10:54', '2025-10-30 16:00:54');

-- --------------------------------------------------------

--
-- Structure de la table `apropos`
--

CREATE TABLE `apropos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `apropos`
--

INSERT INTO `apropos` (`id`, `titre`, `description`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'ZEEEMAX: Révélez votre identité, faîtes rayonner votre projet.', 'ZEEEMAX est né d’une envie profonde : aider les entrepreneur(e)s à révéler leur identité, construire une image de marque forte et faire rayonner leur projet avec impact.\r\n\r\nForte d\'une expérience de terrain et diplômée en stratégie marketing & communication, j\'accompagne les marques à clarifier leur positionnement et gagner en visibilité.', 'images/apropos/1761739973_690204c5b81e8.jpg', '2025-10-29 12:12:53', '2025-10-29 21:13:28');

-- --------------------------------------------------------

--
-- Structure de la table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `extrait` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `contenu` text NOT NULL,
  `image_couverture` varchar(255) DEFAULT NULL,
  `publie` tinyint(1) NOT NULL DEFAULT 0,
  `publie_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `titre`, `slug`, `extrait`, `categorie`, `contenu`, `image_couverture`, `publie`, `publie_le`, `created_at`, `updated_at`) VALUES
(1, 'Lancer sa marque: 5 étapes clés', 'lancer-sa-marque-5-etapes-cles-kh3jIm', 'De l’identité au go-to-market, notre méthode condensée.', NULL, 'Découvrez les 5 étapes essentielles pour lancer votre marque:\n1) Clarifier votre positionnement\n2) Construire votre identité visuelle\n3) Valider votre offre\n4) Déployer vos canaux\n5) Optimiser en continu.', 'https://picsum.photos/seed/RrJnsKnq/800/450', 1, '2025-10-25 13:20:31', '2025-10-30 13:20:31', '2025-10-30 13:20:31'),
(2, 'Booster sa visibilité sur Instagram', 'booster-sa-visibilite-sur-instagram-Mgic8N', 'Formats, fréquence, et contenu qui convertit.', NULL, 'Nous détaillons les formats performants, la fréquence recommandée et des idées de contenus qui engagent durablement.', 'https://picsum.photos/seed/vMWoL9Bg/800/450', 1, '2025-10-22 13:20:31', '2025-10-30 13:20:31', '2025-10-30 13:20:31'),
(3, 'Site web: les erreurs à éviter', 'site-web-les-erreurs-a-eviter-A5msTd', 'Clarté, vitesse, et conversion: le trio gagnant.', NULL, 'Votre site doit être clair, rapide et orienté conversion. Voici un check-list simple pour améliorer votre impact.', 'https://picsum.photos/seed/tnxeBGDr/800/450', 1, '2025-10-27 13:20:31', '2025-10-30 13:20:31', '2025-10-30 13:20:31');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-site_settings_first', 'O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:1;s:8:\"nom_site\";s:7:\"zeeemax\";s:8:\"logo_url\";s:40:\"images/site/1761814674_69032892b79c8.png\";s:16:\"description_site\";s:17:\"BRAND EMPOWERMENT\";s:5:\"email\";s:19:\"contact@zeeemax.com\";s:9:\"telephone\";s:17:\"+33 7 66 01 29 25\";s:7:\"adresse\";s:6:\"France\";s:5:\"ville\";s:5:\"Paris\";s:11:\"code_postal\";s:5:\"75001\";s:4:\"pays\";s:6:\"France\";s:8:\"facebook\";N;s:7:\"twitter\";N;s:9:\"instagram\";N;s:8:\"linkedin\";N;s:7:\"youtube\";N;s:6:\"tiktok\";N;s:10:\"created_at\";s:19:\"2025-10-29 12:46:15\";s:10:\"updated_at\";s:19:\"2025-10-30 08:57:54\";}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:1;s:8:\"nom_site\";s:7:\"zeeemax\";s:8:\"logo_url\";s:40:\"images/site/1761814674_69032892b79c8.png\";s:16:\"description_site\";s:17:\"BRAND EMPOWERMENT\";s:5:\"email\";s:19:\"contact@zeeemax.com\";s:9:\"telephone\";s:17:\"+33 7 66 01 29 25\";s:7:\"adresse\";s:6:\"France\";s:5:\"ville\";s:5:\"Paris\";s:11:\"code_postal\";s:5:\"75001\";s:4:\"pays\";s:6:\"France\";s:8:\"facebook\";N;s:7:\"twitter\";N;s:9:\"instagram\";N;s:8:\"linkedin\";N;s:7:\"youtube\";N;s:6:\"tiktok\";N;s:10:\"created_at\";s:19:\"2025-10-29 12:46:15\";s:10:\"updated_at\";s:19:\"2025-10-30 08:57:54\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:15:{i:0;s:8:\"nom_site\";i:1;s:8:\"logo_url\";i:2;s:16:\"description_site\";i:3;s:5:\"email\";i:4;s:9:\"telephone\";i:5;s:7:\"adresse\";i:6;s:5:\"ville\";i:7;s:11:\"code_postal\";i:8;s:4:\"pays\";i:9;s:8:\"facebook\";i:10;s:7:\"twitter\";i:11;s:9:\"instagram\";i:12;s:8:\"linkedin\";i:13;s:7:\"youtube\";i:14;s:6:\"tiktok\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}', 1761864357);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'nouveau',
  `lu_le` timestamp NULL DEFAULT NULL,
  `notes_admin` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `prenom`, `nom`, `email`, `sujet`, `message`, `statut`, `lu_le`, `notes_admin`, `created_at`, `updated_at`) VALUES
(1, 'Alexandre', 'Martin', 'a.martin@startup-innovation.fr', 'Demande de devis pour refonte identité visuelle', 'Bonjour, je souhaiterais obtenir un devis pour la refonte complète de l\'identité visuelle de ma startup dans le domaine de l\'innovation technologique. Nous cherchons un positionnement moderne et dynamique.', 'lu', '2025-10-29 11:36:49', NULL, '2025-10-26 20:52:30', '2025-10-29 11:36:49'),
(2, 'Julie', 'Rousseau', 'julie.rousseau@fashion-co.com', 'Collaboration stratégie marketing digital', 'Nous aimerions discuter d\'une collaboration pour développer notre présence sur les réseaux sociaux et optimiser nos campagnes publicitaires. Notre budget annuel est de 50k€.', 'lu', '2025-10-29 22:56:08', NULL, '2025-10-26 19:07:30', '2025-10-29 22:56:08'),
(3, 'Nicolas', 'Bernard', 'n.bernard@consultingpro.fr', 'Formation équipe interne', 'Serait-il possible d\'organiser une formation pour notre équipe marketing sur les dernières tendances du branding ? Nous sommes 8 personnes.', 'lu', '2025-10-26 20:07:30', NULL, '2025-10-25 21:07:30', '2025-10-26 21:07:30');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `homepage_settings`
--

CREATE TABLE `homepage_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `background_type` varchar(255) DEFAULT NULL,
  `background_image_url` varchar(255) DEFAULT NULL,
  `background_video_url` varchar(255) DEFAULT NULL,
  `bouton_texte` varchar(255) DEFAULT NULL,
  `bouton_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `homepage_settings`
--

INSERT INTO `homepage_settings` (`id`, `titre`, `description`, `background_type`, `background_image_url`, `background_video_url`, `bouton_texte`, `bouton_url`, `created_at`, `updated_at`) VALUES
(1, 'Révélez votre identité de marque', 'Accompagner les entrepreneurs à construire une image forte et impactante.', 'video', NULL, 'images/homepage/1761860213_6903da7568ce6.mp4', 'Découvrir mes services', 'http://127.0.0.1:8000/#contact', '2025-10-29 15:17:16', '2025-10-30 21:36:53');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_25_122753_create_services_table', 1),
(5, '2025_10_25_122811_create_portfolio_items_table', 1),
(6, '2025_10_25_122822_create_testimonials_table', 1),
(7, '2025_10_25_122835_create_contact_messages_table', 1),
(8, '2025_10_27_221357_create_team_table', 2),
(9, '2025_10_27_221402_create_partners_table', 2),
(10, '2025_10_29_114409_create_apropos_table', 3),
(11, '2025_10_29_121553_create_site_settings_table', 4),
(12, '2025_10_29_130435_create_admins_table', 5),
(13, '2025_10_29_144350_create_homepage_settings_table', 6),
(14, '2025_10_30_000000_create_valeurs_table', 7),
(15, '2025_10_30_120000_create_blog_posts_table', 8),
(16, '2025_10_30_121000_add_categorie_to_blog_posts_table', 9),
(17, '2025_10_30_122000_create_subscribers_table', 10),
(18, '2025_10_30_212259_create_visits_table', 11);

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partners`
--

INSERT INTO `partners` (`id`, `nom`, `description`, `logo_url`, `site_web`, `ordre`, `actif`, `created_at`, `updated_at`) VALUES
(1, 'CodAfrik', 'Codafrik, c’est plus qu’une entreprise de conception web. C’est la fusion entre créativité africaine et innovation technologique. Nous transformons les idées en expériences numériques élégantes et efficaces. Sites vitrines, plateformes e-commerce, applications web modernes… nous donnons vie aux projets qui veulent casser les codes, briller en ligne et marquer leur époque.', 'images/partners/1761737170_6901f9d20a630.png', 'https://codafrik.com/', 1, 1, '2025-10-29 11:26:10', '2025-10-29 11:26:10'),
(4, 'Cdalicious', 'Bien plus que des produits, c’est aussi de la qualité, de l’hygiène, de l’originalité et de la passion ! Nous vous proposons une large gamme de produits de la mer, de céréales, de fruits exotiques et de confiseries fabriqués au Sénégal pour une expérience culinaire sénégalaise et africaine optimale.', 'images/partners/1761755649_690242017add9.PNG', 'https://cdalicious.com/', 1, 1, '2025-10-29 16:34:09', '2025-10-29 16:34:26');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `technologies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technologies`)),
  `lien_demo` varchar(255) DEFAULT NULL,
  `lien_github` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `titre`, `slug`, `categorie`, `description`, `image_url`, `technologies`, `lien_demo`, `lien_github`, `featured`, `actif`, `ordre`, `created_at`, `updated_at`) VALUES
(1, 'Rebranding EcoTech Solutions', 'rebranding-ecotech-solutions', 'Identité Visuelle', 'Refonte complète de l\'identité visuelle d\'une startup tech écoresponsable. Nouveau logo, charte graphique et supports de communication.', 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop', '[\"Adobe Illustrator\",\"Photoshop\",\"Figma\"]', 'https://behance.net/projet-ecotech', NULL, 1, 1, 1, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(2, 'Campagne BioNatura', 'campagne-bionatura', 'Marketing Digital', 'Stratégie digitale complète pour le lancement d\'une gamme de cosmétiques bio. +150% de visibilité en 3 mois.', 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop', '[\"Instagram\",\"Facebook Ads\",\"Google Analytics\"]', NULL, NULL, 1, 1, 2, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(3, 'Site Web Restaurant Le Moderne', 'site-web-restaurant-le-moderne', 'Web Design', 'Création d\'un site web moderne et responsive pour un restaurant gastronomique avec système de réservation intégré.', 'https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?w=800&h=600&fit=crop', '[\"WordPress\",\"CSS3\",\"JavaScript\"]', 'https://restaurant-lemoderne.fr', NULL, 0, 1, 3, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(5, 'Yonoutouki', 'yonoutouki', 'web', 'Yonoutouki.com est un site d’information dédié aux actualités du voyage et de la mobilité internationale.\r\nIl aide les étudiants et les jeunes actifs à découvrir des opportunités à l’étranger, comprendre les démarches (visa, études, stages), et suivre les tendances du tourisme mondial.', 'images/portfolio/1761661969_6900d4115f408.PNG', '[\"wordpress\"]', 'https://yonoutouki.com/', NULL, 0, 1, 0, '2025-10-28 14:32:49', '2025-10-28 14:32:49');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icone_svg` text NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `titre`, `slug`, `description`, `icone_svg`, `actif`, `ordre`, `created_at`, `updated_at`) VALUES
(2, 'Identité Visuelle', 'identite-visuelle', 'Création de logos, chartes graphiques, supports de communication et déclinaisons digitales pour une cohérence parfaite.', '<svg class=\"w-6 h-6\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2\"></path></svg>', 1, 2, '2025-10-26 21:07:30', '2025-10-28 12:32:08'),
(3, 'Marketing Digital', 'marketing-digital', 'Stratégies digitales complètes : réseaux sociaux, SEO, publicités ciblées et création de contenus engageants.', '<svg class=\"w-8 h-8\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M13 10V3L4 14h7v7l9-11h-7z\"></path></svg>', 1, 3, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(5, 'Branding sur-mesure', 'branding-sur-mesure', 'Révélez votre identité unique avec un branding aligné à vos valeurs. Logo, charte graphique, identité visuelle complète qui vous ressemble.', '<svg class=\"w-6 h-6\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01\"></path></svg>', 1, 0, '2025-10-28 12:18:44', '2025-10-28 12:18:44');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xBZBxvYC46HJQPs0XijyJHzmaPy3nDOMmsNyN9yN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMThSTGZMSGF6Z245YkNaOURyWVBPTUVMdWNIdmJCSldOVzRHVGpJSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6MTt9', 1761864206);

-- --------------------------------------------------------

--
-- Structure de la table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_site` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `description_site` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(255) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `site_settings`
--

INSERT INTO `site_settings` (`id`, `nom_site`, `logo_url`, `description_site`, `email`, `telephone`, `adresse`, `ville`, `code_postal`, `pays`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `tiktok`, `created_at`, `updated_at`) VALUES
(1, 'zeeemax', 'images/site/1761814674_69032892b79c8.png', 'BRAND EMPOWERMENT', 'contact@zeeemax.com', '+33 7 66 01 29 25', 'France', 'Paris', '75001', 'France', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-29 12:46:15', '2025-10-30 08:57:54');

-- --------------------------------------------------------

--
-- Structure de la table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `reseau_social` text DEFAULT NULL,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `nom`, `poste`, `bio`, `photo_url`, `reseau_social`, `ordre`, `actif`, `created_at`, `updated_at`) VALUES
(1, 'Codou Mbaye', 'Photographe', NULL, 'images/team/1761670673_6900f611eb948.jpg', NULL, 0, 1, '2025-10-28 16:57:53', '2025-10-28 16:57:53');

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `metrique` varchar(255) DEFAULT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `note` int(11) NOT NULL DEFAULT 5,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `ordre` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `testimonials`
--

INSERT INTO `testimonials` (`id`, `nom_client`, `profession`, `contenu`, `metrique`, `avatar_url`, `note`, `featured`, `actif`, `ordre`, `created_at`, `updated_at`) VALUES
(1, 'Marie Dubois', 'Directrice Marketing, EcoTech Solutions', 'L\'équipe ZEEEMAX a complètement transformé notre image de marque. Leur approche stratégique et leur créativité ont permis de repositionner notre entreprise avec succès.', '+45% de notoriété', 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face', 5, 1, 1, 1, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(2, 'Thomas Laurent', 'Fondateur, BioNatura', 'Grâce à ZEEEMAX, nous avons dépassé nos objectifs de vente dès le premier trimestre. Leur expertise en marketing digital est remarquable.', '+150% de ventes', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face', 5, 1, 1, 2, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(3, 'Sophie Chen', 'Propriétaire, Restaurant Le Moderne', 'Notre nouveau site web et notre stratégie de communication ont révolutionné notre présence en ligne. Les réservations ont augmenté de 80%.', '+80% de réservations', 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face', 5, 0, 1, 3, '2025-10-26 21:07:30', '2025-10-26 21:07:30'),
(4, 'Alioune Fall', 'Developpeur web', 'Une créativité qui claque, un professionnalisme qui rassure et une communication fluide du début à la fin. Zeeemax a conçu mon logo avec une précision impressionnante, tout en intégrant ma vision et ma personnalité. Résultat : un logo moderne, mémorable et totalement aligné avec mon identité de marque.', NULL, 'images/avatars/1761666022_6900e3e64aeb8.jpeg', 5, 0, 1, 0, '2025-10-28 15:40:22', '2025-10-28 16:35:01');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-10-30 13:20:28', '$2y$12$qFewhwiWkCJsHjEOHgDdlOA7lgJA6VEO056of/sRDrsfD8UsicpTu', 'BBN0yyTWaX', '2025-10-30 13:20:30', '2025-10-30 13:20:30');

-- --------------------------------------------------------

--
-- Structure de la table `valeurs`
--

CREATE TABLE `valeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `couleur` varchar(255) NOT NULL DEFAULT 'purple',
  `ordre` int(11) NOT NULL DEFAULT 0,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `valeurs`
--

INSERT INTO `valeurs` (`id`, `titre`, `description`, `icon`, `couleur`, `ordre`, `actif`, `created_at`, `updated_at`) VALUES
(5, 'Croissance', 'Nous accompagnons nos clients dans leur croissance en proposant des solutions évolutives et performantes.', 'rocket', 'purple', 5, 1, '2025-10-29 22:32:15', '2025-10-29 22:32:15'),
(6, 'Précision', 'Notre approche méthodique et précise garantit des résultats optimaux pour chaque projet.', 'target', 'blue', 6, 1, '2025-10-29 22:32:15', '2025-10-29 22:32:15'),
(9, 'Innovation', 'Nous repoussons constamment les limites pour créer des solutions novatrices qui répondent aux besoins de demain.', 'lightning', 'purple', 1, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30'),
(10, 'Excellence', 'Nous visons l\'excellence dans chaque projet, en garantissant la plus haute qualité dans tout ce que nous entreprenons.', 'shield', 'blue', 2, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30'),
(11, 'Passion', 'Notre passion pour ce que nous faisons se reflète dans notre engagement et notre dévouement envers chaque client.', 'heart', 'purple', 3, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30'),
(12, 'Qualité', 'La qualité est au cœur de notre démarche. Chaque détail compte pour offrir une expérience exceptionnelle.', 'star', 'blue', 4, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30'),
(15, 'Équipe', 'Nous valorisons le travail d\'équipe et la collaboration pour créer des synergies et atteindre l\'excellence collective.', 'users', 'purple', 7, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30'),
(16, 'Confiance', 'La confiance est la base de toutes nos relations. Nous construisons des partenariats durables basés sur la transparence.', 'handshake', 'blue', 8, 1, '2025-10-30 13:20:30', '2025-10-30 13:20:30');

-- --------------------------------------------------------

--
-- Structure de la table `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `method` varchar(10) NOT NULL DEFAULT 'GET',
  `referer` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `status_code` int(11) NOT NULL DEFAULT 200,
  `response_time` int(11) DEFAULT NULL,
  `visited_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `visits`
--

INSERT INTO `visits` (`id`, `ip_address`, `user_agent`, `url`, `route_name`, `method`, `referer`, `device_type`, `browser`, `platform`, `country`, `city`, `status_code`, `response_time`, `visited_at`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 129, '2025-10-30 21:28:55', '2025-10-30 21:28:55', '2025-10-30 21:28:55'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 173, '2025-10-30 21:37:04', '2025-10-30 21:37:04', '2025-10-30 21:37:04'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 500, 5582, '2025-10-30 22:04:52', '2025-10-30 22:04:52', '2025-10-30 22:04:52'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 500, 7866, '2025-10-30 22:07:15', '2025-10-30 22:07:15', '2025-10-30 22:07:15'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 500, 42516, '2025-10-30 22:11:12', '2025-10-30 22:11:12', '2025-10-30 22:11:12'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 500, 2684, '2025-10-30 22:15:01', '2025-10-30 22:15:01', '2025-10-30 22:15:01'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 1098, '2025-10-30 22:20:30', '2025-10-30 22:20:30', '2025-10-30 22:20:30'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 2447, '2025-10-30 22:34:48', '2025-10-30 22:34:48', '2025-10-30 22:34:48'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/a-propos', 'apropos.index', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 2255, '2025-10-30 22:40:20', '2025-10-30 22:40:20', '2025-10-30 22:40:20'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/a-propos', 'apropos.index', 'GET', 'http://127.0.0.1:8000/', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 3554, '2025-10-30 22:42:49', '2025-10-30 22:42:49', '2025-10-30 22:42:49'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'home', 'GET', 'http://127.0.0.1:8000/a-propos', 'desktop', 'Chrome', 'Windows', NULL, NULL, 200, 2949, '2025-10-30 22:43:26', '2025-10-30 22:43:26', '2025-10-30 22:43:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Index pour la table `apropos`
--
ALTER TABLE `apropos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `homepage_settings`
--
ALTER TABLE `homepage_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_items_slug_unique` (`slug`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `valeurs`
--
ALTER TABLE `valeurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visits_visited_at_route_name_index` (`visited_at`,`route_name`),
  ADD KEY `visits_visited_at_url_index` (`visited_at`,`url`),
  ADD KEY `visits_url_index` (`url`),
  ADD KEY `visits_route_name_index` (`route_name`),
  ADD KEY `visits_visited_at_index` (`visited_at`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `apropos`
--
ALTER TABLE `apropos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `homepage_settings`
--
ALTER TABLE `homepage_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `valeurs`
--
ALTER TABLE `valeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
