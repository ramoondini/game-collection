-- Adminer 5.4.2 MySQL 8.0.45 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-alek.alek@alek.alek|192.168.8.15',	'i:1;',	1780181229),
('laravel-cache-alek.alek@alek.alek|192.168.8.15:timer',	'i:1780181229;',	1780181229);

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `game_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_game_id_foreign` (`game_id`),
  CONSTRAINT `comments_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `user_id`, `game_id`, `content`, `created_at`, `updated_at`) VALUES
(2,	2,	3,	'Laba spēle!',	'2026-05-30 19:13:53',	'2026-05-30 19:13:53'),
(3,	3,	5,	'Man ļoti patīk! <3',	'2026-05-30 19:27:41',	'2026-05-30 19:27:41');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `game_user`;
CREATE TABLE `game_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `genre_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `year` year DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'velos_spelet',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `games_genre_id_foreign` (`genre_id`),
  KEY `games_user_id_foreign` (`user_id`),
  CONSTRAINT `games_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `games_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `games` (`id`, `user_id`, `genre_id`, `title`, `description`, `year`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2,	2,	1,	'S.T.A.L.K.E.R. 2 Heart of Chernobyl',	'mutanti, šauj',	'2025',	'games/mdCRWtl7lJTYYM4ASV5qJKySutxTB5u89bLTq2L4.webp',	'velos_spelet',	'2026-05-30 18:53:22',	'2026-05-30 18:59:45'),
(3,	2,	2,	'The Witcher 3',	'veci laiki',	'2015',	'games/psU1fahvAG1fGjMsqzeAYAiuu7FRiYeR9Enz5tAc.webp',	'iesakta',	'2026-05-30 19:08:09',	'2026-05-30 19:21:08'),
(4,	2,	1,	'Cyberpunk 2077',	'nākotne, trakums',	'2020',	'games/WNOxJlVDysxs3BVlfsf9pB5I7kD06crKfn5rtXt0.webp',	'pabeigta',	'2026-05-30 19:22:49',	'2026-05-30 19:29:46'),
(5,	2,	3,	'Genshin Impact',	'daudz misijas',	'2020',	'games/OvRwegCaxt217WG9cTRynRyqQXKdSYXYqapqVtu9.webp',	'atcelta',	'2026-05-30 19:24:03',	'2026-05-30 19:24:03'),
(6,	3,	3,	'Stardew valley',	'lauku seta darba daudz',	'2016',	'games/YAOiFaQB7ucXeBqCgVwD36wdYGV8feLqUv6iFPeU.webp',	'iesakta',	'2026-05-30 19:25:47',	'2026-05-30 19:25:47');

DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'Action',	'2026-05-30 21:05:53',	'2026-05-30 21:05:53'),
(2,	'RPG',	'2026-05-30 21:05:53',	'2026-05-30 21:05:53'),
(3,	'Adventure',	'2026-05-30 21:05:53',	'2026-05-30 21:05:53'),
(4,	'Strategy',	'2026-05-30 21:05:53',	'2026-05-30 21:05:53'),
(5,	'Sport',	'2026-05-30 21:05:53',	'2026-05-30 21:05:53');

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'0001_01_01_000000_create_users_table',	1),
(2,	'0001_01_01_000001_create_cache_table',	1),
(3,	'0001_01_01_000002_create_jobs_table',	1),
(4,	'2026_05_30_203001_create_genres_table',	1),
(5,	'2026_05_30_203002_create_games_table',	1),
(6,	'2026_05_30_203003_create_comments_table',	1),
(7,	'2026_05_30_203004_create_ratings_table',	1),
(8,	'2026_05_30_203505_create_game_user_table',	1),
(9,	'2026_05_30_211140_add_image_to_games_table',	2),
(10,	'2026_05_30_212825_add_role_to_users_table',	3),
(11,	'2026_05_30_213018_add_user_id_to_games_table',	4),
(12,	'2026_05_30_221551_add_status_to_games_table',	5);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `game_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_game_id_foreign` (`game_id`),
  CONSTRAINT `ratings_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ratings` (`id`, `user_id`, `game_id`, `rating`, `created_at`, `updated_at`) VALUES
(2,	2,	4,	4,	'2026-05-30 19:26:21',	'2026-05-30 19:26:21'),
(3,	2,	2,	4,	'2026-05-30 19:26:35',	'2026-05-30 19:26:35'),
(4,	2,	3,	2,	'2026-05-30 19:26:43',	'2026-05-30 19:26:43'),
(5,	2,	5,	1,	'2026-05-30 19:26:51',	'2026-05-30 19:26:51'),
(6,	3,	4,	3,	'2026-05-30 19:27:07',	'2026-05-30 19:27:07'),
(7,	3,	5,	5,	'2026-05-30 19:27:16',	'2026-05-30 19:27:16'),
(8,	4,	6,	5,	'2026-05-30 19:30:56',	'2026-05-30 19:30:56');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('B4pwtdRPpIYZDmonrDf9QEqBV3tAUV5cNgPtUpu8',	NULL,	'192.168.8.14',	'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1',	'eyJfdG9rZW4iOiJXZENSYmRQWkkyZnJRTGFHUk1EbVJ2c2t3d3Q4cWNBaFpGN0Fia1FJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzE5Mi4xNjguOC4xMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',	1780181110),
('HNP7TWvMI4B10gdyoVWTJnkthREtlWhDJxcEwurd',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',	'eyJfdG9rZW4iOiJTSGh0a01aZlFkcFR1UXo5QU13SkV3b3BybzNUMVRMaWRabGRLdlpFIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2ZvcmdvdC1wYXNzd29yZCIsInJvdXRlIjoicGFzc3dvcmQucmVxdWVzdCJ9fQ==',	1780180269),
('q6iXVh5WQRZlTpf3JU0b0sWn2xblhHp376KSbv2s',	3,	'192.168.8.15',	'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1',	'eyJfdG9rZW4iOiJMa1ZPMlhVbVVtaVpmenY2czYyY0ZNeHpJVE5jWG1qSzF3M0NBS1E3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzE5Mi4xNjguOC4xMTo4MDAwXC9nYW1lcyIsInJvdXRlIjoiZ2FtZXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=',	1780181263),
('rANRzWIW0RajssBWAgxUzGg3jGmgZqI5qL1LP9vJ',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',	'eyJfdG9rZW4iOiJLdk90OE9IdWpmWFlNbVEzV0U5eklEUWhtOXVZM3F2c1N0anJKeEt4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuZ2FtZS1jb2xsZWN0aW9uIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',	1780180291),
('UCKIK75DnKCFinYAYrEdC8KHqEfrpTvp9OqVpgll',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',	'eyJfdG9rZW4iOiJXc1pCbjZFdGM3eklzZGlEMHZLR3d2d0VSc3M3MHNtdVY5YzMwM29EIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3d3dy5nYW1lLWNvbGxlY3Rpb24uZ2FtZSIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',	1780180831),
('Us22LS4l3rOxXLJObexr2mMYRsxwAEZGG5ePT9ey',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36',	'eyJfdG9rZW4iOiJ4azRMdGJncDh1eXB4RGZIQ3VQNXFYQ0EyYjNtcDVCVDBvOWc0UnFjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9nYW1lLWNvbGxlY3Rpb24iLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',	1780180347),
('WXnFFeLiky0k6WEA94M8Z2T8uWgCnqWszu4qlQ6O',	NULL,	'172.20.10.1',	'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1',	'eyJfdG9rZW4iOiJvWWc5OGRkc3JURzIwWEtLYkM4ZjhGb2g3aloxTkt5Nzl2aGtjcEF2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzE3Mi4yMC4xMC4yOjgwMDBcL2NvbGxlY3Rpb25zXC8zIiwicm91dGUiOiJjb2xsZWN0aW9ucy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',	1780180983);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Test User',	'test@example.com',	NULL,	'$2y$12$JQ9f5RDEm7xpvjrOpNs6YO9ROVhFy9XTOHu7Kx/kc6OT8GJdt7W6G',	'user',	NULL,	'2026-05-30 21:05:58',	'2026-05-30 21:05:58'),
(2,	'Reims',	'reimonds@gmail.com',	NULL,	'$2y$12$a6PLYIUfP7rqwU5H8EG2QeigsOsHFz2Qza/a4iO8TVhPJgfpKRIdu',	'user',	NULL,	'2026-05-30 18:28:05',	'2026-05-30 18:28:05'),
(3,	'alek',	'alek@alek.alek',	NULL,	'$2y$12$x9O6qD4cXAJ.qTfh0bxiWu5S2sTOoqSEYR81AUq3sGNiiJTLxyZ36',	'user',	NULL,	'2026-05-30 18:46:47',	'2026-05-30 18:46:47'),
(4,	'admin',	'admin@example.com',	NULL,	'$2y$12$b8tUQXu.wib/AWOcCzTDL.bDNid3kpvJQO6nUfVROIpPTfPjXWdXC',	'admin',	NULL,	'2026-05-30 18:47:33',	'2026-05-30 18:47:33');

-- 2026-06-15 15:47:00 UTC
