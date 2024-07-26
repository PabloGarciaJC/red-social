-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-02-2023 a las 01:30:01
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pablogarciajc_red_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--
-- Creación: 12-12-2022 a las 02:23:08
-- Última actualización: 11-02-2023 a las 00:27:09
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followers`
--
-- Creación: 10-02-2023 a las 20:00:12
-- Última actualización: 11-02-2023 a las 00:27:38
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `seguido` int(11) NOT NULL,
  `aprobada` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--
-- Creación: 12-12-2022 a las 02:26:30
-- Última actualización: 09-02-2023 a las 17:31:50
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--
-- Creación: 12-12-2022 a las 02:18:58
-- Última actualización: 10-02-2023 a las 20:00:12
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_09_15_094722_create_images_table', 1),
(5, '2022_12_07_234756_create_publications_table', 2),
(6, '2022_09_15_235141_create_comments_table', 3),
(7, '2022_09_15_234423_create_likes_table', 4),
(8, '2022_11_14_044728_create_notifications_table', 5),
(9, '2022_11_04_085215_create_followers_table', 6),
(10, '2023_02_10_195320_eliminar_columna_followers', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--
-- Creación: 12-12-2022 a las 02:27:06
-- Última actualización: 11-02-2023 a las 00:27:17
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--
-- Creación: 12-12-2022 a las 02:18:58
-- Última actualización: 11-02-2023 a las 00:27:54
-- Última revisión: 12-12-2022 a las 02:18:58
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--
-- Creación: 12-12-2022 a las 02:18:58
-- Última actualización: 12-12-2022 a las 02:18:58
-- Última revisión: 12-12-2022 a las 02:18:58
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--
-- Creación: 12-12-2022 a las 02:20:51
-- Última actualización: 11-02-2023 a las 00:28:04
--

CREATE TABLE `publications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--
-- Creación: 08-12-2022 a las 00:53:20
-- Última actualización: 10-02-2023 a las 21:02:49
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoPerfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobreMi` text COLLATE utf8mb4_unicode_ci,
  `conectado` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `alias`, `nombre`, `apellido`, `pais`, `direccion`, `empresa`, `cargo`, `movil`, `email`, `fotoPerfil`, `password`, `sobreMi`, `conectado`, `remember_token`, `created_at`, `updated_at`) VALUES
(60, 'Pablo', 'Pablo', 'Garcia', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', '(+58) 12345612', 'pablo@administrador.com', '16760398851.jpg', '$2y$10$I4bmnIwgVO0Cq2U6upMite1fSmQslFBCHQtC7Mi196N5SndkEYxWG', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th0', 0, 'qMjuHmX9tyG93guQ3eHcuoDKCM61VuuNqybu17HvoSAMuz7R6kyB0rYkI90g', '2023-02-08 03:01:32', '2023-02-10 13:39:45'),
(103, 'Lucia', 'Lucía', 'Martínez', 'Lorem Ipsum0', 'Lorem Ipsum0', 'Lorem Ipsum0', 'Lorem Ipsum0', '(+58) 123456120', 'administrador0@administrador.com', 'profile0.png', '$2y$10$118mTNWDjIm5vkZBQCuqK.5xetpn5DAM75dozHhMkZNINj4lrFa8S', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th0', 1, 'Yl85hIGoxtBMiJ5h0twloKEE5JrbYLjvC4Xis07Zpiy2NeVXbAf0G69AASpY', NULL, '2023-02-10 20:02:30'),
(104, 'Martina', 'Martina', 'Rodríguez', 'Lorem Ipsum1', 'Lorem Ipsum1', 'Lorem Ipsum1', 'Lorem Ipsum1', '(+58) 123456121', 'administrador1@administrador.com', 'profile1.png', '$2y$10$AotNFjy2MojrIUyAS5Pg0u2CtroZH44GU5Z2az0ZKGImc7kGwfYvW', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th1', 1, 'XkHNelApLziY7URqQXNRk4EPyjnE5q2KFhbjJfVm1NyJXP75k511WYLCuuXl', NULL, '2023-02-10 19:55:29'),
(105, 'Paula', 'Paula', 'Pérez', 'Lorem Ipsum2', 'Lorem Ipsum2', 'Lorem Ipsum2', 'Lorem Ipsum2', '(+58) 123456122', 'administrador2@administrador.com', 'profile2.png', '$2y$10$wqOgHyAzG/WhY9/bERM7QuLSNf31ESqdhM2a4JKgJjjuiWIn7nTou', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th2', 0, 'hrUwDBN6n2JS4eCLOLBDajrGFSuI2gJfq8u2dYAPngTLPyQljbrye4X0096o', NULL, '2023-02-10 19:33:11'),
(106, 'Lucas', 'Lucas', 'González', 'Lorem Ipsum3', 'Lorem Ipsum3', 'Lorem Ipsum3', 'Lorem Ipsum3', '(+58) 123456123', 'administrador3@administrador.com', 'profile3.png', '$2y$10$/KaFdQujj.J5D9f19mQUNevO4HZhtJZJQKfmCPMIQrFnhNKAXwnAe', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th3', 1, 'WszPXKYP2TFz9DTyN8E4kFLfxCxZUZ6phPlGpGRst1rL7vb0VnsSZpyQmVnM', NULL, '2023-02-10 20:02:25'),
(107, 'Marcos ', 'Sánchez', 'Muñoz', 'Lorem Ipsum4', 'Lorem Ipsum4', 'Lorem Ipsum4', 'Lorem Ipsum4', '(+58) 123456124', 'administrador4@administrador.com', 'profile4.png', '$2y$10$Fp7gb4JZNilbqWGQGU5G7Ol9Xxi/YActhMG6kXwH4NpU6bY9/kUbu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th4', 1, 'y5NBL9R8PlqTxiqQHHZsty6dqc1zq8uldGoaxxTcxMMsITfLwZKYkoUEweSS', NULL, '2023-02-10 08:33:17'),
(108, 'Javier ', 'Hernández', 'Moreno', 'Lorem Ipsum5', 'Lorem Ipsum5', 'Lorem Ipsum5', 'Lorem Ipsum5', '(+58) 123456125', 'administrador5@administrador.com', 'profile5.png', '$2y$10$8Mzmg3tg6IsvBKJhanModuj5xHibQNZSJROWcrQRpsWWW0aGeZpB6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th5', 0, 'jFHCJlLKCHxyKKCJ9rKDVVVpZbOLfSvnv3XL3KhC8VpugINGHsoOnLYyuZoS', NULL, '2023-02-10 20:00:02'),
(109, 'Alvaro', 'Guerrero', 'Jimenez', 'Lorem Ipsum6', 'Lorem Ipsum6', 'Lorem Ipsum6', 'Desarrollador deSoftware', '(+58) 123456126', 'administrador6@administrador.com', 'profile6.png', '$2y$10$Xaj2ZdNBJaRyNGbEDRFJi.8Fz0B5YCQf3ssKXxFvUqLFrDGNHzhgu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since th Lorem Ipsum has been the industry s standard dummy text ever since th6', 1, 'hiQvbPueTGcd1CUIiiLeEx6jcucNI9Rc87X38lW7Iy2iAB403xWHsiX3VLWV', NULL, '2023-02-10 08:33:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_publication_id_foreign` (`publication_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_publication_id_foreign` (`publication_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publications_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`),
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
