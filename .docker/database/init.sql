-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-10-2024 a las 08:46:44
-- Versión del servidor: 10.11.9-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u498565300_rsbdpjgc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `emisor_id` int(10) UNSIGNED NOT NULL,
  `receptor_id` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `publication_id`, `imagen`, `contenido`, `created_at`, `updated_at`) VALUES
(586, 111, 651, NULL, 'hola es un comentario basico', '2024-10-06 19:20:25', '2024-10-06 19:20:25'),
(587, 111, 651, '1728242446-diploma-gestion-tiempo.webp', NULL, '2024-10-06 19:20:46', '2024-10-06 19:20:46'),
(588, 111, 651, NULL, 'comentario nuevo', '2024-10-06 19:21:02', '2024-10-06 19:21:02'),
(589, 115, 651, NULL, 'bien', '2024-10-06 19:21:13', '2024-10-06 19:21:13'),
(590, 115, 651, NULL, '🤔', '2024-10-06 19:21:23', '2024-10-06 19:21:23'),
(591, 111, 651, NULL, '🐍', '2024-10-06 19:21:35', '2024-10-06 19:21:35'),
(592, 115, 651, NULL, '🐍', '2024-10-06 19:21:58', '2024-10-06 19:21:58'),
(593, 111, 652, NULL, 'ffgd', '2024-10-06 19:24:24', '2024-10-06 19:24:24'),
(594, 115, 652, NULL, 'dlklf', '2024-10-06 19:24:32', '2024-10-06 19:24:32'),
(595, 111, 652, '1728242685-diploma-marca-personal-emprendedores.webp', NULL, '2024-10-06 19:24:45', '2024-10-06 19:24:45'),
(596, 111, 653, NULL, 'sdsd', '2024-10-07 04:04:13', '2024-10-07 04:04:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `seguido` int(11) NOT NULL,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `seguido`, `estado`, `created_at`, `updated_at`) VALUES
(186, 115, 111, 'confirmado', '2024-10-02 04:50:37', '2024-10-02 04:50:45'),
(187, 112, 111, 'confirmado', '2024-10-07 03:31:10', '2024-10-07 03:31:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `type` enum('like','dislike') DEFAULT 'like',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `publication_id`, `type`, `created_at`, `updated_at`) VALUES
(267, 115, 652, 'like', '2024-10-07 03:28:51', '2024-10-07 03:28:51'),
(271, 111, 652, 'like', '2024-10-07 03:33:20', '2024-10-07 03:33:20'),
(272, 112, 652, 'like', '2024-10-07 03:33:33', '2024-10-07 03:33:33'),
(273, 111, 651, 'dislike', '2024-10-07 03:33:42', '2024-10-07 03:33:42'),
(274, 112, 651, 'dislike', '2024-10-07 03:33:50', '2024-10-07 03:33:50'),
(277, 115, 653, 'dislike', '2024-10-07 04:04:04', '2024-10-07 04:04:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
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

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0c56eb76-a6d3-44e4-8305-810afcce1931', 'App\\Notifications\\AgregarAmigoNotification', 'App\\Models\\User', 112, '{\"user_id\":111,\"alias\":\"user2\",\"fotoPerfil\":\"1725218453img-user.png\",\"estado\":\"confirmado\",\"messaje\":\"Acepto solicitud de amistad\"}', NULL, '2024-10-07 03:31:17', '2024-10-07 03:31:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user1@user.com', '$2y$10$cyimxdfgEwmLdqq2d8xnEu4/pkPQKbcz3uCkmkQ24rx9hrcjodf8u', '2024-09-18 00:48:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `user_id`, `imagen`, `contenido`, `created_at`, `updated_at`) VALUES
(651, 115, NULL, '😭 Es una Prueba de Publicacion', '2024-10-06 19:19:15', '2024-10-06 19:19:15'),
(652, 115, NULL, 'Es una prueba de publicacion de user 2', '2024-10-06 19:24:00', '2024-10-06 19:24:00'),
(653, 111, NULL, 'prueba 1', '2024-10-07 04:03:53', '2024-10-07 04:03:53'),
(654, 115, NULL, 'Prueba de Puyblicaciones', '2024-10-08 01:55:02', '2024-10-08 01:55:02'),
(655, 115, NULL, 'ddsds', '2024-10-08 01:55:29', '2024-10-08 01:55:29'),
(656, 115, NULL, 'Prueba de 3d🐼', '2024-10-08 02:02:10', '2024-10-08 02:02:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication_images`
--

CREATE TABLE `publication_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publication_images`
--

INSERT INTO `publication_images` (`id`, `publication_id`, `image_path`, `created_at`, `updated_at`) VALUES
(252, 651, '1728242355_imagen_0.jpg', '2024-10-06 19:19:15', '2024-10-06 19:19:15'),
(253, 651, '1728242355_imagen_1.jpg', '2024-10-06 19:19:15', '2024-10-06 19:19:15'),
(254, 651, '1728242355_imagen_2.jpg', '2024-10-06 19:19:15', '2024-10-06 19:19:15'),
(255, 651, '1728242355_imagen_3.jpg', '2024-10-06 19:19:15', '2024-10-06 19:19:15'),
(256, 652, '1728242640_imagen_0.jpg', '2024-10-06 19:24:00', '2024-10-06 19:24:00'),
(257, 652, '1728242640_imagen_1.jpg', '2024-10-06 19:24:00', '2024-10-06 19:24:00'),
(258, 653, '1728273833_imagen_0.jpg', '2024-10-07 04:03:53', '2024-10-07 04:03:53'),
(259, 653, '1728273833_imagen_1.jpg', '2024-10-07 04:03:53', '2024-10-07 04:03:53'),
(260, 654, '1728352502_imagen_0.jpg', '2024-10-08 01:55:02', '2024-10-08 01:55:02'),
(261, 654, '1728352502_imagen_1.jpg', '2024-10-08 01:55:02', '2024-10-08 01:55:02'),
(262, 655, '1728352529_imagen_0.jpg', '2024-10-08 01:55:29', '2024-10-08 01:55:29'),
(263, 655, '1728352529_imagen_1.jpg', '2024-10-08 01:55:29', '2024-10-08 01:55:29'),
(264, 656, '1728352930_imagen_0.jpg', '2024-10-08 02:02:10', '2024-10-08 02:02:10'),
(265, 656, '1728352930_imagen_1.jpg', '2024-10-08 02:02:10', '2024-10-08 02:02:10'),
(266, 656, '1728352930_imagen_2.jpg', '2024-10-08 02:02:10', '2024-10-08 02:02:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoPerfil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sobreMi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conectado` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `alias`, `nombre`, `apellido`, `pais`, `direccion`, `empresa`, `cargo`, `movil`, `email`, `fotoPerfil`, `password`, `sobreMi`, `conectado`, `remember_token`, `created_at`, `updated_at`) VALUES
(111, 'user2', 'user2', 'apellido2', 'España', 'Malaga', 'empresa2', 'developer2', '555 555 555', 'user2@user.com', '1725218453img-user.png', '$2y$10$yV4bfuX1TFzE7v6OAtC9i.mVhy0dsZxIIbyOo3vj7aDTjy1BHaQAG', 'Lorem ipsum dolor sit amet consectetur adipiscing elit cum nunc vehicula, lobortis sociis consequat diam dis porttitor tincidunt natoque nascetur, facilisis molestie vulputate ad venenatis quam nulla nullam tristique. Vel blandit neque feugiat fames aptent non, et ornare nisl porttitor laoreet, dui libero a natoque ac. Feugiat taciti molestie imperdiet mi aliquam fermentum nibh, natoque aliquet est interdum ridiculus dis velit ac, fames purus porttitor auctor in vitae.', 1, NULL, '2024-09-01 18:43:08', '2024-10-06 15:29:58'),
(112, 'user3', 'user3', 'apellido3', 'España', 'Malaga', 'empresa3', 'cargo3', '555 555 555', 'user3@user.com', '1725218700img-user.png', '$2y$10$X/fCuCvm8QNR9fSCtWuXLuPtrHntbge.6X5p9bG43CAyh2UFYZmZO', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, vestibulum porta augue habitant volutpat auctor odio, vel nisi nostra scelerisque vitae nibh. Quis et dictumst mi sed mus malesuada, aliquam torquent odio imperdiet risus convallis, posuere nunc sem eleifend nisi. Taciti tortor potenti dictum nullam accumsan venenatis, porta aliquet nulla suscipit ligula senectus fermentum, justo odio sociosqu scelerisque nisi.', 1, NULL, '2024-09-01 18:45:00', '2024-10-07 03:30:55'),
(113, 'user4', 'user4', 'apellido4', 'España', 'Malaga', 'empresa4', 'developer4', '555 555 555', 'user4@user.com', '1725218726img-user.png', '$2y$10$bTlrYZCshMpdY9Uxn4XQkemMv2nYN8UTBp3j8HCKhX629.d/j83tu', 'Lorem ipsum dolor sit amet consectetur adipiscing elit laoreet, ullamcorper mus ad non primis ante porttitor tincidunt, aenean augue volutpat nisl nostra netus curabitur. Feugiat bibendum vivamus aenean accumsan venenatis potenti dignissim justo metus, ac sodales sem pharetra maecenas nisi ultricies. Bibendum semper tempus scelerisque ultrices praesent magna fermentum himenaeos torquent, parturient netus vestibulum aliquet non consequat nisl nibh interdum, justo facilisis taciti sodales dapibus fringilla hendrerit vulputate.', 1, NULL, '2024-09-01 18:46:29', '2024-09-15 14:17:12'),
(114, 'user5', 'user5', 'apellido5', 'España', 'Malaga', 'empresa5', 'developer5', '555 555 555', 'user5@user.com', '1725218746img-user.png', '$2y$10$8sr8gAfipkjEJj9/XI6Y3unne2.HBWOlF3jwWoNswP85APxPIR9Si', 'Lorem ipsum dolor sit amet consectetur adipiscing elit mi enim nullam parturient dui ad, varius scelerisque integer aptent justo id montes per habitasse ultrices iaculis. Nulla morbi gravida pretium augue duis netus velit orci varius nullam fusce pellentesque praesent vel, venenatis phasellus lectus dignissim platea vitae faucibus aliquam sodales libero diam condimentum. Convallis suspendisse aptent varius felis nisl potenti semper leo, mi magnis ornare aliquet urna ante condimentum, dis eleifend integer erat sollicitudin facilisi cubilia.', 0, NULL, '2024-09-01 18:47:42', '2024-09-08 14:04:19'),
(115, 'user1', 'user1', NULL, NULL, NULL, NULL, NULL, NULL, 'user1@user.com', '1727870366img-user.png', '$2y$10$DNDuHiKvxpq/JyBkx4Nq/OWx0SSlkYSMep3ATgzv54wXDkVnPc4Yu', NULL, 1, NULL, '2024-09-18 00:59:26', '2024-10-06 14:48:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor_id` (`emisor_id`),
  ADD KEY `receptor_id` (`receptor_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_publication` (`publication_id`);

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
-- Indices de la tabla `publication_images`
--
ALTER TABLE `publication_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_id` (`publication_id`);

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
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=597;

--
-- AUTO_INCREMENT de la tabla `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=657;

--
-- AUTO_INCREMENT de la tabla `publication_images`
--
ALTER TABLE `publication_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`emisor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`receptor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_publication` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE;

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

--
-- Filtros para la tabla `publication_images`
--
ALTER TABLE `publication_images`
  ADD CONSTRAINT `publication_images_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
