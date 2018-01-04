-- DROP TABLE IF EXISTS `origins`;
-- CREATE TABLE `origins` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- DROP TABLE IF EXISTS `products`;
-- CREATE TABLE `products` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- DROP TABLE IF EXISTS `profiles`;
-- CREATE TABLE `profiles` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
--   `type_id` int(11) NOT NULL,
--   `subtype_id` int(11) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- DROP TABLE IF EXISTS `types`;
-- CREATE TABLE `types` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- DROP TABLE IF EXISTS `users`;
-- CREATE TABLE `users` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
--   `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
--   `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
--   `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- DROP TABLE IF EXISTS `subtypes`;
-- CREATE TABLE `subtypes` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- DROP TABLE IF EXISTS `product_visit`;
-- CREATE TABLE `product_visit` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `product_id` int(11) NOT NULL,
--   `visit_id` int(11) NOT NULL,
--   `qtd` smallint(6) NOT NULL,
--   `amount` decimal(7,2) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- DROP TABLE IF EXISTS `visits`;
-- CREATE TABLE `visits` (
--   `id` int(10) UNSIGNED NOT NULL,
--   `unit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
--   `dt` date NOT NULL,
--   `tm` time NOT NULL,
--   `profile_id` int(11) NOT NULL,
--   `origin_id` int(11) NOT NULL,
--   `avg` decimal(5,2) NOT NULL,
--   `max` decimal(5,2) NOT NULL,
--   `min` decimal(5,2) NOT NULL,
--   `prec` decimal(5,2) NOT NULL,
--   `comment` text COLLATE utf8_unicode_ci,
--   `user_id` int(11) NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `origins` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Australia', '2017-10-07 09:30:00', NULL),
(2, 'Brazil', '2017-10-07 09:30:00', NULL),
(3, 'China', '2017-10-07 09:30:00', NULL),
(4, 'England', '2017-10-07 09:30:00', NULL),
(5, 'Canada', '2017-10-07 09:30:00', NULL),
(6, 'Puerto Rico', '2017-10-07 09:30:00', NULL),
(7, 'India', '2017-10-07 09:30:00', NULL),
(8, 'Japan', '2017-10-07 09:30:00', NULL),
(9, 'United States', '2017-10-07 09:30:00', NULL),
(10, ' Please choose', '2017-10-07 09:30:00', NULL);


INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bolle', '2017-10-07 09:30:00', NULL),
(2, 'Bulgari', '2017-10-07 09:30:00', NULL),
(3, 'Carrera', '2017-10-07 09:30:00', NULL),
(4, 'Case', '2017-10-07 09:30:00', NULL),
(5, 'Cleaning Kit', '2017-10-07 09:30:00', NULL),
(6, 'Coach', '2017-10-07 09:30:00', NULL),
(7, 'Costa', '2017-10-07 09:30:00', NULL),
(8, 'Croake', '2017-10-07 09:30:00', NULL),
(9, 'Dior', '2017-10-07 09:30:00', NULL),
(10, 'Emporio Armani', '2017-10-07 09:30:00', NULL),
(11, 'Gucci', '2017-10-07 09:30:00', NULL),
(12, 'Guess', '2017-10-07 09:30:00', NULL),
(13, 'Jimmy Choo', '2017-10-07 09:30:00', NULL),
(14, 'Maui Jim', '2017-10-07 09:30:00', NULL),
(15, 'Michael Kors', '2017-10-07 09:30:00', NULL),
(16, 'New York Shades', '2017-10-07 09:30:00', NULL),
(17, 'Oakley', '2017-10-07 09:30:00', NULL),
(18, 'Polaroid', '2017-10-07 09:30:00', NULL),
(19, 'Prada', '2017-10-07 09:30:00', NULL),
(20, 'Ralph Lauren', '2017-10-07 09:30:00', NULL),
(21, 'Ray Ban', '2017-10-07 09:30:00', NULL),
(22, 'Reading Glasses', '2017-10-07 09:30:00', NULL),
(23, 'Revo', '2017-10-07 09:30:00', NULL),
(24, 'Serengetti', '2017-10-07 09:30:00', NULL),
(25, 'Suncloud', '2017-10-07 09:30:00', NULL),
(26, 'Tifanny', '2017-10-07 09:30:00', NULL),
(27, 'Tommy Bahamas', '2017-10-07 09:30:00', NULL),
(28, 'Tori Burch', '2017-10-07 09:30:00', NULL),
(29, 'Versace', '2017-10-07 09:30:00', NULL),
(30, 'Vogue', '2017-10-07 09:30:00', NULL),
(31, ' Please choose', '2017-10-07 09:30:00', NULL);


INSERT INTO `profiles` (`id`, `name`, `type_id`, `subtype_id`, `created_at`, `updated_at`) VALUES
(1, 'Couple Middle Age', 1, 1, '2017-10-05 16:30:00', NULL),
(2, 'Couple Young', 1, 4, '2017-10-05 16:31:00', NULL),
(3, 'Couple Senior', 1, 3, '2017-10-05 16:32:00', NULL),
(4, 'Family', 2, 2, '2017-10-05 16:33:00', NULL),
(5, 'Gentleman Middle Age', 4, 1, '2017-10-05 16:34:00', NULL),
(6, 'Gentleman Young', 4, 4, '2017-10-05 16:35:00', NULL),
(7, 'Gentleman Senior', 4, 3, '2017-10-05 16:36:00', NULL),
(8, 'Lady Middle Age', 3, 1, '2017-10-05 16:37:00', NULL),
(9, 'Lady Senior', 3, 3, '2017-10-05 16:38:00', NULL),
(10, 'Lady Young', 3, 4, '2017-10-05 16:39:00', NULL),
(11, ' Please choose', 5, 5, '2017-10-05 16:39:00', NULL);


INSERT INTO `subtypes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Middle Age', '2017-10-07 09:30:00', NULL),
(2, 'All', '2017-10-07 09:30:00', NULL),
(3, 'Senior', '2017-10-07 09:30:00', NULL),
(4, 'Young', '2017-10-07 09:30:00', NULL),
(5, 'N/A', '2017-10-07 09:30:00', NULL);

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Couple', '2017-10-07 09:30:00', NULL),
(2, 'Family', '2017-10-07 09:30:00', NULL),
(3, 'Ladies', '2017-10-07 09:30:00', NULL),
(4, 'Gentlemen', '2017-10-07 09:30:00', NULL),
(5, 'N/A', '2017-10-07 09:30:00', NULL);

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
 (1, 'John', 'user1@example.org', '$2y$10\$yjueIt9OpQqWgIu6BAkgLu0eOTjewQJK8Aza3p26qT160jxvAP4lC', 'iJZDmNmvR2bAmqVvcWSacJJzvJwZsgLLs8t1NXm6FLSOK7QS3cUByrJiqd0D', '2017-11-02 16:20:20', '2017-11-02 16:20:20'),
        (2, 'Peter', 'user1@example.org', '$2y$10$.ZnA3NvK9CN8P64wjSAMPuiZAY7ePjh95x82cEDrI7GOwmqK8AyGm', NULL, '2017-11-02 16:20:52', '2017-11-02 16:20:52');"