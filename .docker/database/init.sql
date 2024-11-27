-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 27-11-2024 a las 19:24:36
-- Versión del servidor: 10.11.9-MariaDB-ubu2204
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `red_social_pablogarciajc`
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chats`
--

INSERT INTO `chats` (`id`, `emisor_id`, `receptor_id`, `message`, `created_at`, `updated_at`, `leido`) VALUES
(909, 111, 115, 'Hola Emilia, ¡es un placer verte por aquí! Me encanta tu publicación sobre meditar para encontrar claridad. Coincido totalmente, especialmente en momentos de caos. Yo también trato de incorporar momentos de silencio en mi día para mantener la mente enfocada. ¿Tienes algún consejo para quienes recién empezamos a meditar?', '2024-11-21 21:01:08', '2024-11-21 21:02:37', 1),
(910, 111, 113, '¡Hola Marco! Vi tu publicación sobre libros, qué interesante. Estoy de acuerdo contigo, la lectura es un gran escape y una fuente de inspiración. ¿Te interesa algún género en particular? A mí me encanta leer sobre psicología y liderazgo', '2024-11-21 21:01:28', '2024-11-21 21:03:02', 1),
(911, 111, 112, '¡Hola Sofía! Me encantó tu publicación sobre cómo un picnic puede renovar ideas. ¡Qué buen enfoque! Yo también creo que un cambio de entorno puede abrir la mente. ¿Tienes algún lugar favorito para esos momentos de desconexión?', '2024-11-21 21:01:43', '2024-11-21 21:02:08', 1),
(912, 112, 111, '¡Hola Liam! Sí, a menudo voy a un pequeño parque cerca de mi casa. Es tranquilo y tiene mucha vegetación. Me ayuda a relajarme y pensar con claridad. ¿Tienes algún espacio que uses para desconectar del trabajo?', '2024-11-21 21:02:11', '2024-11-21 21:03:32', 1),
(913, 115, 111, '¡Hola Liam! Qué bueno que te guste. Mi consejo es empezar con solo unos minutos al día. Lo importante es ser constante y no presionarte demasiado. Con el tiempo, verás los beneficios. ¿Y tú, alguna técnica que uses para calmar la mente?', '2024-11-21 21:02:44', '2024-11-21 21:04:26', 1),
(914, 113, 111, '¡Hola Liam! Claro, la psicología es fascinante. Yo también disfruto de esos temas. Ahora estoy leyendo un libro sobre neurociencia aplicada a la toma de decisiones. ¿Algún libro en particular que me recomiendes sobre liderazgo?', '2024-11-21 21:03:11', '2024-11-21 21:04:01', 1),
(915, 111, 112, '¡Hola Sofía! Me encantó tu publicación sobre los picnics. Es increíble cómo un cambio de ambiente puede realmente activar la creatividad. ¿Te ha sorprendido alguna vez una idea mientras estabas al aire libre? A veces, las mejores soluciones vienen cuando menos lo esperas.', '2024-11-21 21:03:45', '2024-11-21 21:10:35', 1),
(916, 111, 113, '¡Hola Marco! Totalmente de acuerdo contigo, la lectura siempre es una excelente fuente de inspiración. Yo también soy un gran fan de los libros sobre psicología y liderazgo. Si te interesa, te puedo recomendar un libro que me ayudó mucho en ese ámbito, \'Los 7 hábitos de la gente altamente efectiva\' de Stephen Covey. ¿Lo has leído?', '2024-11-21 21:04:10', '2024-11-21 21:12:35', 1),
(917, 111, 115, '¡Hola Emilia! Me encanta cómo hablas sobre meditar para encontrar claridad. Yo también he notado cómo momentos de silencio pueden realmente ayudar a alinear mis pensamientos. ¿Sueles meditar en la mañana o en la noche? Yo he probado ambas y me gusta cómo en la mañana establece el tono del día.', '2024-11-21 21:05:42', '2024-11-21 21:13:30', 1),
(918, 112, 115, '¡Hola Emilia! Me encantó tu publicación sobre meditar. Yo también he encontrado que dedicar unos minutos al día para desconectar realmente ayuda a mantener el enfoque. ¿Tienes algún tipo de meditación guiada que uses? A veces me cuesta concentrarme solo en la respiración.', '2024-11-21 21:11:21', '2024-11-21 21:13:34', 1),
(919, 112, 113, '¡Hola Marco! Estoy totalmente de acuerdo contigo, la lectura siempre tiene una manera de abrir la mente. También soy fan de los libros sobre desarrollo personal y liderazgo. Uno de mis favoritos es \'Despierta tu héroe interior\' de Victor Hugo Manzanilla. ¿Lo conoces?', '2024-11-21 21:11:33', '2024-11-21 21:12:41', 1),
(920, 113, 112, '¡Hola Sofía! No conocía ese libro, pero suena interesante. Me encanta leer sobre cómo podemos desarrollar nuestro máximo potencial. Siempre estoy en busca de nuevas recomendaciones. Si te interesa, te puedo recomendar \'El poder de los hábitos\' de Charles Duhigg, ¡es uno de mis favoritos! ¿Tú qué tipo de libros prefieres, además de los de desarrollo personal?', '2024-11-21 21:13:07', '2024-11-21 21:15:33', 1),
(921, 115, 112, '¡Hola Sofía! Gracias por tu comentario. A veces la meditación guiada también me ayuda, especialmente cuando quiero profundizar más en la práctica. Utilizo algunas apps como Headspace o Calm. Pero, en general, me gusta meditar en silencio para centrarme mejor. ¡Deberíamos hacer una sesión juntas algún día!', '2024-11-21 21:13:55', '2024-11-21 21:15:23', 1),
(922, 113, 115, '¡Hola Emilia! Estaba pensando en lo que dijiste sobre meditar en la mañana para comenzar el día con claridad. ¡Qué buena idea! A veces me cuesta encontrar el tiempo para meditar, pero creo que voy a probar hacerlo por la mañana. ¿Tienes algún consejo para mantener la mente enfocada mientras meditas?', '2024-11-21 21:17:32', '2024-11-21 21:17:52', 1),
(923, 115, 113, '¡Hola Marco! Me alegra que te guste la idea. Para mantener la mente enfocada, trato de no presionarme demasiado por \'no pensar en nada\'. Simplemente dejo que los pensamientos vengan y vayan sin aferrarme a ellos. Al principio puede ser difícil, pero con la práctica se vuelve más fácil. ¡Dale una oportunidad por la mañana, te sorprenderá cómo cambia el día! 😜', '2024-11-21 21:18:11', '2024-11-21 21:19:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `publication_id`, `contenido`, `created_at`, `updated_at`) VALUES
(1076, 115, 1128, 'Nada como un buen libro para desconectar y a la vez nutrir la mente. ¿Recomendarías algo relacionado con liderazgo?', '2024-11-21 20:40:35', '2024-11-21 20:44:50'),
(1078, 112, 1128, 'Qué buen hábito, Marco. Leer en un entorno tranquilo siempre dispara mi creatividad. ¿Prefieres ficción o no ficción?', '2024-11-21 20:45:22', '2024-11-21 20:45:22'),
(1079, 111, 1128, '😎 Gracias a todos por sus comentarios. Estoy leyendo \'La vida secreta de los árboles\' de Peter Wohlleben, un libro fascinante que conecta con mi amor por la naturaleza. También me encanta explorar temas de liderazgo y sostenibilidad, así que \'El líder que no tenía cargo\' es una gran recomendación que podría interesarles.', '2024-11-21 20:46:09', '2024-11-21 20:46:24'),
(1080, 111, 1127, '¡Qué buena idea, Sofía! Creo que cambiar de entorno puede ser la clave para desbloquear la creatividad. ¿Tienes un lugar favorito para hacer picnics?', '2024-11-21 20:49:08', '2024-11-21 20:49:08'),
(1081, 113, 1127, 'Totalmente de acuerdo, Sofía. Estar en contacto con la naturaleza siempre ayuda a aclarar la mente. ¿Qué sueles llevar para esos momentos al aire libre?', '2024-11-21 20:49:32', '2024-11-21 20:49:32'),
(1082, 115, 1127, 'Me encanta este enfoque, Sofía. La combinación de aire fresco y un espacio tranquilo suena perfecta para nuevas ideas. ¿Lo haces a menudo?', '2024-11-21 20:49:55', '2024-11-21 20:49:55'),
(1083, 112, 1127, '¡Gracias a todos! Estoy convencida de que la naturaleza nos inspira de maneras únicas. Liam, suelo ir a un parque cerca de casa, lleno de cerezos. Marco, siempre llevo un cuaderno y bocadillos caseros; es mi ritual creativo. Emilia, trato de hacerlo al menos una vez al mes. ¡Deberíamos intentar una sesión creativa grupal al aire libre algún día!', '2024-11-21 20:50:18', '2024-11-21 20:50:18'),
(1084, 113, 1126, '¡Qué gran punto, Liam! La música tiene ese poder de enfocarnos y ayudarnos a pensar de manera más clara. ¿Tienes alguna canción o género específico que te inspire cuando tomas decisiones importantes?', '2024-11-21 20:51:59', '2024-11-21 20:51:59'),
(1085, 115, 1126, 'Totalmente de acuerdo, Liam. La música tiene una forma única de crear el ambiente adecuado para la creatividad. ¿Prefieres algo tranquilo o más energético para esos momentos clave?', '2024-11-21 20:52:34', '2024-11-21 20:52:34'),
(1086, 112, 1126, '¡Me encanta! La música realmente puede hacer que nuestras ideas fluyan mejor. ¿Tienes alguna playlist favorita para la toma de decisiones estratégicas?', '2024-11-21 20:52:58', '2024-11-21 20:52:58'),
(1087, 111, 1126, 'Gracias a todos por sus comentarios. Personalmente, me inclino por música instrumental cuando necesito concentración, algo como piano o electrónica suave. Marco, me encanta el jazz para los momentos de reflexión profunda. Emilia, varío entre géneros dependiendo de la tarea, aunque generalmente prefiero algo tranquilo para tomar decisiones clave. Sofía, tengo varias listas de reproducción, pero si les interesa, puedo compartir una de mis favoritas para inspirar creatividad.', '2024-11-21 20:53:25', '2024-11-21 20:53:25'),
(1088, 111, 1125, 'Totalmente de acuerdo, Emilia. Meditar puede ser el ancla que necesitamos en momentos de alta presión. ¿Tienes alguna técnica o rutina específica que sigas?', '2024-11-21 20:54:41', '2024-11-21 20:54:41'),
(1089, 113, 1125, '¡Qué interesante, Emilia! La meditación siempre ha sido un desafío para mí, pero sé que es fundamental para la claridad mental. ¿Cuánto tiempo sueles dedicarle a tu práctica diaria?', '2024-11-21 20:54:59', '2024-11-21 20:54:59'),
(1090, 112, 1125, '¡Qué bien dicho, Emilia! Encontrar espacio para la calma en medio del caos es esencial. ¿Usas alguna aplicación o prefieres meditar de forma libre?', '2024-11-21 20:55:20', '2024-11-21 20:55:20'),
(1091, 115, 1125, 'Gracias a todos por sus comentarios. Liam, suelo meditar en silencio por la mañana, solo unos 10-15 minutos para empezar el día con claridad. Marco, no hace falta mucho tiempo, lo importante es hacerlo con constancia. Sofía, prefiero meditar libremente, sin ninguna aplicación, solo centrándome en la respiración. ¡Me encantaría saber cómo cada uno de ustedes maneja el estrés y se enfoca en lo importante!', '2024-11-21 20:55:42', '2024-11-21 20:55:42');

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
(186, 115, 111, 'confirmado', '2024-10-02 04:50:37', '2024-11-11 20:04:18'),
(187, 112, 111, 'desconocido', '2024-10-07 03:31:10', '2024-10-14 20:53:30'),
(188, 111, 112, 'confirmado', '2024-10-22 03:08:05', '2024-10-22 03:08:20'),
(189, 115, 112, 'confirmado', '2024-10-24 17:25:29', '2024-10-24 17:26:28'),
(190, 115, 113, 'confirmado', '2024-10-24 17:25:37', '2024-10-24 17:26:49'),
(191, 115, 114, 'confirmado', '2024-10-24 17:25:42', '2024-10-24 17:27:05'),
(192, 111, 113, 'confirmado', '2024-11-21 20:28:38', '2024-11-21 20:28:59'),
(193, 113, 112, 'confirmado', '2024-11-21 20:29:25', '2024-11-21 20:30:01');

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
(413, 115, 1126, 'like', '2024-11-21 21:20:13', '2024-11-21 21:20:13'),
(414, 115, 1125, 'dislike', '2024-11-21 21:20:17', '2024-11-21 21:20:17'),
(415, 111, 1128, 'like', '2024-11-21 21:20:28', '2024-11-21 21:20:28'),
(416, 111, 1127, 'like', '2024-11-21 21:20:31', '2024-11-21 21:20:31'),
(417, 111, 1126, 'dislike', '2024-11-21 21:20:35', '2024-11-21 21:20:35'),
(418, 111, 1125, 'like', '2024-11-21 21:20:38', '2024-11-21 21:20:38'),
(419, 112, 1128, 'dislike', '2024-11-21 21:20:50', '2024-11-21 21:20:50'),
(420, 112, 1127, 'like', '2024-11-21 21:20:56', '2024-11-21 21:20:56'),
(421, 112, 1126, 'dislike', '2024-11-21 21:21:00', '2024-11-21 21:21:00'),
(422, 112, 1125, 'like', '2024-11-21 21:21:03', '2024-11-21 21:21:03'),
(423, 115, 1128, 'like', '2024-11-21 21:21:15', '2024-11-21 21:21:15'),
(424, 115, 1127, 'dislike', '2024-11-21 21:21:22', '2024-11-21 21:21:22'),
(425, 113, 1128, 'like', '2024-11-21 21:21:56', '2024-11-21 21:21:56'),
(426, 113, 1127, 'dislike', '2024-11-21 21:21:59', '2024-11-21 21:21:59'),
(427, 113, 1126, 'like', '2024-11-21 21:22:02', '2024-11-21 21:22:02'),
(428, 113, 1125, 'dislike', '2024-11-21 21:22:06', '2024-11-21 21:22:06');

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
('d730bff0-1bdc-44d9-b9e4-08cddd7c312f', 'App\\Notifications\\AgregarAmigoNotification', 'App\\Models\\User', 113, '{\"user_id\":112,\"alias\":\"Sof\\u00eda\",\"fotoPerfil\":\"17322194842.png\",\"estado\":\"confirmado\",\"messaje\":\"Acepto solicitud de amistad\"}', '2024-11-21 20:38:56', '2024-11-21 20:30:01', '2024-11-21 20:38:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1125, 115, NULL, 'Encontrando claridad en medio del caos: Meditar, un hábito clave para liderar con propósito.', '2024-11-21 20:08:25', '2024-11-21 20:09:55'),
(1126, 111, NULL, 'La música como inspiración: el ritmo perfecto para tomar decisiones estratégicas.', '2024-11-21 20:11:43', '2024-11-21 20:11:43'),
(1127, 112, NULL, 'Creatividad al aire libre: cómo un picnic puede renovar tus ideas.', '2024-11-21 20:13:42', '2024-11-21 20:13:42'),
(1128, 113, NULL, 'Entre páginas y paisajes: encontrando inspiración en la lectura.', '2024-11-21 20:15:06', '2024-11-21 20:15:06');

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
(1054, 1125, '1732219795_imagen_3.jpg', '2024-11-21 20:09:55', '2024-11-21 20:09:55'),
(1055, 1125, '1732219795_imagen_1.jpg', '2024-11-21 20:09:55', '2024-11-21 20:09:55'),
(1056, 1125, '1732219795_imagen_0.jpg', '2024-11-21 20:09:55', '2024-11-21 20:09:55'),
(1057, 1125, '1732219795_imagen_2.jpg', '2024-11-21 20:09:55', '2024-11-21 20:09:55'),
(1058, 1126, '1732219903_imagen_0.jpg', '2024-11-21 20:11:44', '2024-11-21 20:11:44'),
(1059, 1126, '1732219904_imagen_1.jpg', '2024-11-21 20:11:44', '2024-11-21 20:11:44'),
(1060, 1126, '1732219904_imagen_2.jpg', '2024-11-21 20:11:44', '2024-11-21 20:11:44'),
(1061, 1126, '1732219904_imagen_3.jpg', '2024-11-21 20:11:44', '2024-11-21 20:11:44'),
(1062, 1127, '1732220022_imagen_0.jpg', '2024-11-21 20:13:42', '2024-11-21 20:13:42'),
(1063, 1127, '1732220022_imagen_1.jpg', '2024-11-21 20:13:42', '2024-11-21 20:13:42'),
(1064, 1127, '1732220022_imagen_2.jpg', '2024-11-21 20:13:42', '2024-11-21 20:13:42'),
(1065, 1128, '1732220106_imagen_0.jpg', '2024-11-21 20:15:06', '2024-11-21 20:15:06'),
(1066, 1128, '1732220106_imagen_1.jpg', '2024-11-21 20:15:06', '2024-11-21 20:15:06'),
(1067, 1128, '1732220106_imagen_2.jpg', '2024-11-21 20:15:06', '2024-11-21 20:15:06'),
(1068, 1128, '1732220106_imagen_3.jpg', '2024-11-21 20:15:06', '2024-11-21 20:15:06');

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
(111, 'Liam', 'Liam', 'Keller', 'España', 'Berliner Strasse 89, Múnich, Alemania', 'Horizon Biotech', 'Director de Operaciones Internacionales', '+49 171 654 3210', 'liam@user.com', '17322193751.png', '$2y$10$yV4bfuX1TFzE7v6OAtC9i.mVhy0dsZxIIbyOo3vj7aDTjy1BHaQAG', 'Con una experiencia de más de 15 años en logística y operaciones, mi enfoque principal es optimizar procesos globales. En mi tiempo libre, disfruto correr maratones y leer sobre historia contemporánea.', 1, NULL, '2024-09-01 18:43:08', '2024-11-27 19:13:28'),
(112, 'Sofía', 'Sofía', 'Nakamura', 'Japón', '3-2-1 Shinjuku, Tokio, Japón', 'Akira Designs', 'Diseñadora Jefe de Producto', '+81 90 1234 5678', 'sofia@user.com', '17322194842.png', '$2y$10$X/fCuCvm8QNR9fSCtWuXLuPtrHntbge.6X5p9bG43CAyh2UFYZmZO', 'Diseñadora con enfoque en la sostenibilidad, creo productos funcionales y amigables con el medio ambiente. Soy amante de la música clásica y el arte contemporáneo.', 0, NULL, '2024-09-01 18:45:00', '2024-11-26 21:28:07'),
(113, 'Marco', 'Marco', 'Santis', 'Via Roma 18, Milán, Italia', 'Via Roma 18, Milán, Italia', 'Verde Vita Consultores', 'Consultor Ambiental Senior', '+39 345 678 9012', 'marco@user.com', '17322195963.png', '$2y$10$bTlrYZCshMpdY9Uxn4XQkemMv2nYN8UTBp3j8HCKhX629.d/j83tu', 'Mi misión es asesorar a empresas para que reduzcan su huella de carbono y adopten estrategias ecológicas. Amante de la naturaleza, suelo dedicar mi tiempo libre a la fotografía de paisajes.', 0, NULL, '2024-09-01 18:46:29', '2024-11-27 14:35:24'),
(115, 'Emilia', 'Emilia', 'Fuentes', 'Colombia', 'Carrera 45 #12-34, Bogotá, Colombia', 'NovaGenix Solutions', 'Gerente de Innovación', '+57 312 456 7890', 'emilia@user.com', '17322192474.png', '$2y$10$DNDuHiKvxpq/JyBkx4Nq/OWx0SSlkYSMep3ATgzv54wXDkVnPc4Yu', 'Apasionada por la tecnología y las soluciones disruptivas, lidero equipos para crear productos innovadores que transforman vidas. Fuera del trabajo, disfruto explorar nuevos destinos y aprender sobre diferentes culturas.', 0, NULL, '2024-09-18 00:59:26', '2024-11-21 21:21:28');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=924;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1092;

--
-- AUTO_INCREMENT de la tabla `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=429;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1129;

--
-- AUTO_INCREMENT de la tabla `publication_images`
--
ALTER TABLE `publication_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1069;

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
