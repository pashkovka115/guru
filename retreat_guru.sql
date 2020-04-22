-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 12 2020 г., 19:13
-- Версия сервера: 5.7.29-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `retreat_guru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carencies`
--

CREATE TABLE `carencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_left` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val` int(10) UNSIGNED DEFAULT NULL,
  `base` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category_posts`
--

CREATE TABLE `category_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_posts`
--

INSERT INTO `category_posts` (`id`, `title`) VALUES
(1, 'Без категории'),
(2, 'Кат_odio'),
(3, 'Кат_voluptas'),
(4, 'Кат_numquam'),
(5, 'Кат_dignissimos'),
(6, 'Кат_a'),
(7, 'Кат_qui'),
(8, 'Кат_perspiciatis'),
(9, 'Кат_dolorum'),
(10, 'Кат_vel'),
(11, 'Кат_minus');

-- --------------------------------------------------------

--
-- Структура таблицы `category_tours`
--

CREATE TABLE `category_tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_tours`
--

INSERT INTO `category_tours` (`id`, `title`, `description`, `img`) VALUES
(1, 'Без категории', 'Reiciendis fuga sed vel odit. Sed quidem aut qui est nostrum officiis. Nihil odit error non cumque alias eius praesentium. Occaecati sit et et blanditiis expedita.', 'https://lorempixel.com/gray/720/444/cats/Faker/?39104'),
(2, 'Растительная медицина', 'Ab incidunt aliquid modi commodi. Ut magni veritatis non magni. Voluptate nostrum ex repellat.', 'https://lorempixel.com/gray/720/444/cats/Faker/?83884'),
(3, 'Йога', 'Vitae ea omnis id. Hic nemo aut eum. Beatae nemo neque qui facilis.', 'https://lorempixel.com/gray/720/444/cats/Faker/?36790'),
(4, 'Медитация и духовность', 'Qui harum esse impedit consequuntur provident sit sunt. Consequatur natus nam rerum illo ipsam. Non animi in nobis sequi incidunt. Reprehenderit omnis deserunt quam eos tempora esse.', 'https://lorempixel.com/gray/720/444/cats/Faker/?36839'),
(5, 'Здоровье и здоровое питание', 'Quisquam facere minima ut ex aut. Quo blanditiis corporis sint molestiae. Explicabo doloremque quo veniam deserunt. Sapiente alias ut maiores maxime.', 'https://lorempixel.com/gray/720/444/cats/Faker/?15398'),
(6, 'Искусство и творчество', 'Iure eligendi fugiat libero necessitatibus consectetur. Voluptatem sit nesciunt corporis quaerat quas numquam voluptatum quasi. Tempora tempore commodi itaque aspernatur at aut consectetur et.', 'https://lorempixel.com/gray/720/444/cats/Faker/?88349'),
(7, 'Активный отдых', 'Fuga fugiat occaecati delectus at soluta. Voluptas sed illo maxime officiis consectetur neque et consequatur. Fugit molestias consequatur fugiat aut quam at maiores.', 'https://lorempixel.com/gray/720/444/cats/Faker/?63589');

-- --------------------------------------------------------

--
-- Структура таблицы `category_tour_tour`
--

CREATE TABLE `category_tour_tour` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_tour_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_tour_tour`
--

INSERT INTO `category_tour_tour` (`id`, `category_tour_id`, `tour_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_key` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` smallint(6) NOT NULL DEFAULT '0' COMMENT 'процент скидки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci,
  `queue` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci,
  `exception` longtext COLLATE utf8mb4_unicode_ci,
  `failed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(212, '2014_10_12_100000_create_password_resets_table', 1),
(213, '2020_03_17_000000_create_users_table', 1),
(214, '2020_03_17_000003_create_carencies_table', 1),
(215, '2020_03_17_000004_create_tours_table', 1),
(216, '2020_03_17_000005_create_failed_jobs_table', 1),
(217, '2020_03_17_000006_category_posts', 1),
(218, '2020_03_17_000007_create_config_table', 1),
(219, '2020_03_17_000008_create_pages_table', 1),
(220, '2020_03_17_000009_category_tours', 1),
(221, '2020_03_17_000010_create_optional_fields_table', 1),
(222, '2020_03_17_000011_create_tour_user_table', 1),
(223, '2020_03_17_000012_create_gallary_user_table', 1),
(224, '2020_03_17_000013_create_posts_table', 1),
(225, '2020_03_17_000014_category_tours_tours', 1),
(226, '2020_03_17_000015_create_gallary_tour_table', 1),
(227, '2020_03_17_111504_create_permission_tables', 1),
(228, '2020_03_19_081340_user_subscribe_tour', 1),
(229, '2020_04_01_123619_create_discounts_table', 1),
(230, '2020_04_01_125942_create_profiles_table', 1),
(231, '2020_04_01_132535_create_users_comments_table', 1),
(232, '2020_04_01_155624_create_voteds_table', 1),
(233, '2020_04_09_161015_create_organizer_leader_table', 1),
(234, '2020_04_10_155124_create_tour_variant_table', 1),
(235, '2020_04_11_094225_create_tour_leader_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `optional_fields`
--

CREATE TABLE `optional_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `field_key` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `organizer_leader`
--

CREATE TABLE `organizer_leader` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leader_id` bigint(20) UNSIGNED NOT NULL,
  `organizer_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `organizer_leader`
--

INSERT INTO `organizer_leader` (`id`, `leader_id`, `organizer_id`) VALUES
(1, 10, 1),
(2, 11, 1),
(3, 12, 1),
(4, 13, 1),
(5, 14, 1),
(6, 15, 1),
(7, 16, 1),
(8, 17, 1),
(9, 18, 1),
(10, 19, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'ut ea rem sapiente qui', 'Quisquam omnis et eum nostrum. Sit est aut molestias neque. Iste illum eum dicta ea. Perferendis facere ea enim mollitia. Laboriosam harum aperiam et. Possimus esse maiores delectus et nihil at. Illo et aliquid sunt animi consequatur. Aut at labore dolorem aut nobis consectetur. In deleniti est sint porro ex dolorum distinctio. Cum fugiat ipsum aut at omnis consequatur.', NULL, NULL),
(2, 'inventore non non magnam explicabo', 'Aut excepturi praesentium dolor quaerat quo aliquam. Rerum quod non assumenda nulla maxime debitis omnis. Incidunt ut libero autem sit. Mollitia consectetur nemo inventore facilis consequatur expedita sint. Aut nesciunt quae quas non dolores mollitia aperiam. Vel omnis qui magni qui quos. Nihil nostrum omnis tempore repellendus. Aut iusto saepe provident iusto perferendis. Expedita omnis aut totam impedit exercitationem.', NULL, NULL),
(3, 'est quo est tempore nemo', 'Voluptatem quisquam perspiciatis consequatur hic doloribus odit ducimus. Facere in ut non illum tempore minima quia. Eum possimus sequi neque et id omnis repellendus. Facere est ut minus beatae omnis veniam molestiae ullam. Necessitatibus est perspiciatis dolores itaque ullam nesciunt est dolorem. Error explicabo dolor consequatur iusto minima. Enim odit nesciunt omnis illum enim aspernatur.', NULL, NULL),
(4, 'voluptas quas autem ducimus et', 'Aut aut enim aut. Quaerat sed sed omnis. Esse optio placeat sed quidem commodi ab sequi. Officiis at dolores consequatur asperiores neque atque. Officiis deserunt sed molestiae sit. In sit aliquam ut nulla quidem veniam sint minima. Enim omnis ad repellat nam suscipit eum eveniet. Quos reiciendis quae maxime voluptate. Aut et ut quod nostrum. Velit qui veritatis sit rerum voluptates. Veritatis rem corrupti est est dolorum quisquam eos asperiores. Dignissimos nihil rerum perferendis expedita iusto ea facere vel. Voluptates facilis id velit autem beatae qui.', NULL, NULL),
(5, 'accusantium eos asperiores soluta est', 'Distinctio sint et ab labore dolores. Eius quis qui qui soluta omnis. Dolorem sapiente aut et provident vel ducimus delectus earum. Quo laudantium autem id tempore. Quod ipsa labore provident enim magnam. Et quasi maiores qui minima ut nobis. Vel a officiis qui. Quae recusandae velit voluptatem optio similique provident labore. Ipsam temporibus nostrum aut pariatur blanditiis labore. Quia et sint velit. Aut dicta alias in eos cupiditate repudiandae provident.', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard_view', 'Просматривать главную панель', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(2, 'user_view', 'Просматривать пользователей', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(3, 'user_edit', 'Редактировать пользователя', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(4, 'user_add', 'Добавлять пользователя', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(5, 'user_delete', 'Удалять пользователя', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(6, 'permission_view', 'Просматривать разрешения', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(7, 'permission_edit', 'Редактировать разрешение', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(8, 'role_view', 'Просматривать роли', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(9, 'role_edit', 'Редактировать роль', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(10, 'role_add', 'Добавлять роль', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(11, 'role_delete', 'Удалять роль', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(12, 'user-role_view', 'Просматривать роли пользователей', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(13, 'user-role_edit', 'Синхронизировать пользователей и роли', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(14, 'category-tour_view', 'Просматривать категории туров', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(15, 'category-tour_edit', 'Редактировать категории туров', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(16, 'category-tour_add', 'Добавлять категорию тура', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(17, 'category-tour_delete', 'Удалять категорию тура', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(18, 'tour_view', 'Просматривать туры', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(19, 'tour_edit', 'Редактировать туры', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(20, 'tour_add', 'Добавлять тур', 'web', '2020-04-12 05:47:45', '2020-04-12 05:47:45'),
(21, 'tour_delete', 'Удалять тур', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(22, 'file-mager_*', 'Использовать файловый менеджер', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(23, 'page_view', 'Просматривать страницы', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(24, 'page_edit', 'Редактировать страницы', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(25, 'page_add', 'Добавлять страницы', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(26, 'page_delete', 'Удалять страницы', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(27, 'category-post_view', 'Просматривать категории записей', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(28, 'category-post_edit', 'Редактировать категории записей', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(29, 'category-post_add', 'Добавлять категории записей', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(30, 'category-post_delete', 'Удалять категории записей', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(31, 'post_view', 'Просматривать записи', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(32, 'post_edit', 'Редактировать записи', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(33, 'post_add', 'Добавлять записи', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(34, 'post_delete', 'Удалять записи', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `excerpt`, `content`, `user_id`, `category_post_id`, `created_at`, `updated_at`) VALUES
(1, 'minus unde reprehenderit', 'Tenetur aut quisquam vel magnam eos quasi voluptatem necessitatibus. Voluptas aut molestiae voluptates non inventore ut eos. Illum consectetur assumenda laboriosam aut minus impedit. Odit sed quia placeat aut unde.', 'Exercitationem id recusandae necessitatibus aliquam suscipit. Ut sed mollitia fugit perferendis et non hic. Eius facilis fugit qui est rerum aut. Nobis sunt voluptate voluptatibus perferendis omnis eos ipsum quis. Repellat odio aut non voluptatem. Minima a molestiae culpa reprehenderit eveniet. Animi eligendi et non aut sit. Culpa qui ratione hic. Exercitationem sit excepturi laboriosam nostrum minima. Sapiente culpa consectetur est temporibus nihil eos. Maxime magni et ipsum eos porro sunt sint. Possimus laborum maxime doloribus laudantium enim nobis eum consequatur.', 21, 1, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(2, 'eos enim quaerat', 'Voluptatum consequatur explicabo illum et laudantium. Quidem aperiam sit numquam repellendus nulla deleniti nihil. Officia id dolorem eius inventore vero. Cupiditate neque saepe velit voluptatem.', 'Vitae in distinctio voluptas magni excepturi non sapiente. Itaque et porro nobis commodi. Sit necessitatibus numquam esse error ut sunt maxime. Magni molestiae dolor quia enim culpa et rerum ipsa. Placeat laudantium dolorum corrupti et. Corporis amet occaecati eos aperiam et. Exercitationem ex possimus et eos expedita quidem et.', 4, 9, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(3, 'neque sed eum', 'Eum dolorum quis rerum neque velit voluptatibus ut. Eum quia quidem corrupti labore odio suscipit. Perspiciatis doloremque inventore omnis quaerat repudiandae sed.', 'Alias aut repellat neque voluptatem recusandae perspiciatis. Voluptatum veniam voluptas adipisci ut. Occaecati impedit velit ex ipsum quos id dicta. Earum velit dolores omnis expedita. Omnis ea et similique distinctio facilis veniam. Aut quis tenetur dolores. Praesentium et recusandae aut. Voluptatum omnis est ipsa.', 9, 1, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(4, 'ipsa aut at', 'Necessitatibus id fuga perferendis sit quod. Maxime nulla corrupti voluptatem provident quia temporibus nisi dolor. Cumque iste quae dolorem rerum molestias sit.', 'Modi et accusantium voluptate deserunt architecto veniam. Recusandae ut quasi eveniet nulla quam aut. Iure quia atque sit optio est delectus deleniti. Necessitatibus ipsam recusandae atque eius a delectus est. Architecto dolores recusandae explicabo tempore sed explicabo doloremque. Rem incidunt rerum doloribus velit qui. Ipsam nihil et porro asperiores omnis doloribus. Corporis optio omnis ipsam non qui. Et voluptatum quidem sed accusamus. Odit non ut repellendus. Dolore sit enim modi inventore. Repudiandae rerum quisquam dolores. Nobis veniam vero eveniet soluta facilis. Quo in accusantium aliquid qui ea aut.', 4, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(5, 'ut possimus assumenda', 'Provident a tempore aut dolores ea iure. Praesentium aut minus mollitia ipsum. Aperiam enim ut qui velit qui quia. Blanditiis consequatur illum veniam ad.', 'Id reprehenderit est et itaque ab sed. Ducimus molestiae blanditiis voluptate nostrum inventore quae facere. Itaque architecto sunt molestiae praesentium exercitationem consectetur. Esse vel dignissimos dolorem accusantium necessitatibus ea. Beatae dolorum explicabo nihil facilis. Consequuntur esse enim itaque. Eveniet sit temporibus natus quasi. Dolorum repellat non et sit nulla ducimus aut dolores. Inventore et repellendus maxime molestiae. Ipsam autem voluptate non aperiam sed voluptatem. Itaque quaerat natus ut earum facere ducimus quod. Incidunt voluptate ut consequatur et qui hic voluptatem. Nesciunt ipsa esse iusto incidunt quia asperiores qui. Eligendi et explicabo est.', 22, 8, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(6, 'molestias ea aliquam', 'Culpa error eaque voluptatem distinctio voluptate repudiandae beatae. Repudiandae et id minus corrupti explicabo eligendi. Distinctio explicabo provident sit placeat id.', 'Rerum delectus iste consequatur nam. Enim nobis eos quos fugiat. Ut cupiditate error assumenda repellendus repudiandae cupiditate et ut. Ipsa quam aut a culpa ipsa dolor voluptas. Autem ea molestiae nam hic rerum molestiae consectetur voluptas. Minus repudiandae sunt soluta in incidunt. Soluta voluptates fuga reiciendis id aut voluptatem. Odit aliquam impedit velit sit labore magni rerum. Autem incidunt nulla tenetur. Doloremque architecto modi necessitatibus amet.', 15, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(7, 'enim voluptates at', 'Numquam ipsa provident eius vel. Eos temporibus fugit rerum. Odio culpa rerum aut architecto aperiam rem. Culpa et voluptates reprehenderit veniam vel. Est ipsa est dolorem iusto voluptates cumque.', 'Quam facere adipisci accusamus doloribus voluptatem voluptates. Velit quis et quis dignissimos aliquid. Et atque sit perspiciatis fugit voluptatum qui et aut. Non neque itaque iure ipsa cupiditate. Voluptas voluptates omnis est sapiente quos. Eum repudiandae autem voluptas animi consequatur dolores molestiae reiciendis. Temporibus laborum iusto pariatur et. Atque quo qui quis nobis.', 14, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(8, 'molestias nihil cum', 'Rem voluptatem quod itaque reprehenderit dolorem non. Fuga quis sunt quia cumque sequi quis assumenda dolor. Voluptatem voluptatibus qui et et architecto hic. Et adipisci enim rerum impedit minima corporis deleniti.', 'Quos quia perferendis illo voluptatem non culpa ut. Est in tempora aut qui alias id officia. Harum officiis consequuntur id tempore. Saepe praesentium necessitatibus veritatis itaque repellat sapiente quia. Voluptates esse non voluptatem iste veritatis aut voluptatem. Maiores architecto sunt sit porro iusto. Possimus est necessitatibus pariatur harum laboriosam nisi commodi. Fugiat omnis odio unde dolore. Earum necessitatibus non earum vel. Excepturi eaque ipsum blanditiis deleniti fuga ullam optio. Ea libero quisquam quis eveniet corporis asperiores in. Qui tenetur aut nostrum et id.', 14, 9, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(9, 'sed ipsam optio', 'Explicabo qui sint ducimus excepturi omnis non cupiditate quia. Ut et ad sunt vel sit. Blanditiis pariatur molestiae voluptas non qui omnis nam.', 'Similique voluptates in recusandae dolorum consequatur. Quisquam consectetur quia et modi neque. Quod et tempore eos consequatur aspernatur est. Sed nisi iusto nemo quia iste mollitia rerum. Et asperiores rem ut aut repellendus dolorem. Eligendi non non repellat officia aut. Provident commodi fuga est assumenda. Quo assumenda molestiae amet beatae quidem excepturi. Minima autem et voluptas id itaque iusto est. Occaecati quia quo asperiores ipsa in omnis omnis. Voluptate ullam eveniet quas dolor laboriosam. Et numquam est omnis eos et temporibus. Error inventore harum perferendis culpa reprehenderit. Error dolores qui vero occaecati.', 5, 9, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(10, 'quas quaerat dicta', 'Officiis nulla possimus qui id labore est. Et nisi natus dolorem. Mollitia quas animi enim expedita soluta fugiat. Quisquam sint totam ut sed est.', 'Non maxime id maxime ut omnis. Error et doloremque sequi. Maiores dolores soluta vero unde sunt ut et. Modi quasi aut reprehenderit aliquam qui recusandae. Magni earum consequuntur explicabo nihil voluptas facilis. At rerum dignissimos beatae neque. Dolores ut sunt natus quod consequatur. Ut nesciunt porro nam. Enim aut ut qui placeat nihil.', 7, 8, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(11, 'eos doloremque ut', 'Dolores autem et adipisci aliquam. Aut porro sint aliquid culpa dolorem. Autem sint corporis doloremque et voluptatem voluptatem iusto debitis.', 'Officiis voluptatem est modi voluptas autem neque dolor. Omnis facilis dicta ullam blanditiis voluptate magnam autem iure. Aut adipisci nemo voluptas numquam. Quo sit dolorem possimus repellendus. Dolore dolorem possimus consequuntur nihil nihil. Laborum accusantium quasi amet nihil a quod delectus. Iusto explicabo consequatur dolores. Omnis facilis vel sit vitae sapiente quia. Et culpa accusamus assumenda est. Itaque dolorem iure dolores sit eveniet. Dolores vero dolorem sunt repellendus qui exercitationem ea. Perferendis aut tempore quaerat quia consequatur ipsam atque. Perferendis aut in et qui eveniet.', 15, 4, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(12, 'dignissimos in culpa', 'Quia qui vel est dicta ut. Facere quos quibusdam neque rerum consequatur. Voluptas repellat delectus quis sit molestias quis qui illo.', 'Explicabo rerum eum optio neque. Hic vel fuga aut culpa. Minima nihil aliquid qui qui ut voluptatem omnis. Amet sunt nostrum earum asperiores et in dicta. Est facilis quia ipsa quos. Et vel pariatur aut suscipit. Repellendus exercitationem est totam qui. Ut velit quo hic fugit omnis. Tempore et dolorem ex reprehenderit delectus quia quia. Eum explicabo et at odio at.', 12, 3, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(13, 'omnis provident doloremque', 'Nulla consequatur sint enim et neque commodi. Officia ducimus ipsa nostrum molestias voluptas maiores sunt ea. Libero enim ut sunt ullam.', 'Qui nulla minus amet. Labore officiis eius voluptas ut aut voluptatum et. Fuga sit sit qui incidunt ducimus est voluptatem. Minus rerum fuga asperiores et. Laudantium porro inventore et ratione enim ex doloribus. Eius veniam maxime velit harum et aperiam. Corrupti deleniti fugiat repellat asperiores adipisci.', 29, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(14, 'qui ut ut', 'Ab nisi aut qui voluptatem non ad et quo. Autem ipsam eos nesciunt exercitationem. Cupiditate enim corrupti id qui. Cumque facilis iusto maiores reprehenderit ad consectetur.', 'Sed modi nihil qui facere. Consequuntur asperiores rerum iste dolor fuga. Odit praesentium veritatis totam maiores quos. Aspernatur esse harum quia veritatis quis cum modi. Explicabo quasi non sit doloremque. Dolor expedita totam libero. Magni in ut maiores dolores. Illum amet perspiciatis minima nihil minus ut voluptate. Dolore tenetur doloribus dolorem sint nulla doloremque. Eligendi aut minima tempora enim aperiam ex laboriosam. Odio mollitia id totam sit et quo. Temporibus illum ipsam aliquid qui temporibus aut cupiditate. Voluptas repellendus velit pariatur perferendis ratione quas dignissimos.', 5, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(15, 'fugiat est pariatur', 'Ut eum qui error ipsa nisi quam. Dolorem itaque expedita asperiores nobis occaecati vitae earum.', 'Exercitationem totam quos veniam totam ex iure impedit doloribus. Quibusdam distinctio optio aut quasi. Dolor quo in ad culpa dolores fugiat. Deleniti odio aut a. Incidunt sequi optio eos consectetur pariatur molestiae a. Repellendus eius impedit molestias aut eos. Veniam consequatur cupiditate ad a quia. Maiores delectus totam consequatur esse vitae velit assumenda. Et nesciunt explicabo deleniti dolorem incidunt.', 6, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(16, 'ducimus ut est', 'Optio pariatur qui dolores quisquam. Cumque voluptas cum quae non laboriosam accusantium omnis. Quibusdam inventore aspernatur pariatur aliquam et est. Quia totam aut consequatur inventore omnis reiciendis. Dolores in consequatur aut et quis perspiciatis corrupti.', 'Suscipit perspiciatis magni molestiae. Voluptatibus ea sit eum voluptatem consequatur necessitatibus ullam ratione. Possimus dolor perferendis expedita officiis enim nihil. Ex quod reprehenderit dolor et fugit. Et ad reprehenderit molestiae libero ea atque. Natus aut molestiae numquam et dolorem. Provident illo voluptates molestias recusandae.', 20, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(17, 'qui iste quisquam', 'Facere ea minima ut consequatur. Consequuntur atque sunt unde et. Et dolore adipisci soluta ad et. Et natus minima sed et totam voluptatibus id et.', 'Est dolores fuga placeat. Totam quaerat atque deleniti aut sunt ducimus fugit. Accusantium consequuntur vel et non magni. Tempore at labore quia minus. Enim dignissimos ducimus ut adipisci reprehenderit. Eos itaque sapiente est quidem voluptates asperiores. Et eos placeat deleniti. Voluptatem vel consequatur temporibus voluptatem ab repellendus. Consequatur sint debitis rem. Placeat assumenda velit ea omnis incidunt.', 3, 3, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(18, 'natus magni nobis', 'Asperiores expedita consequuntur et autem autem molestiae odio suscipit. Est amet dolor quae error. Ipsa officia praesentium qui ea hic. Nihil quis et esse quo blanditiis nobis. Incidunt corrupti omnis nulla est ut.', 'Voluptate quaerat qui aut eveniet quod quos dolor eligendi. Et alias aliquam ab eum delectus. Dignissimos nihil exercitationem ratione. Necessitatibus architecto sed sint qui aspernatur facere. Excepturi voluptatem id incidunt nisi natus. Vitae dolores quam neque. Maxime numquam est necessitatibus et cumque nobis. Eius doloribus aut suscipit voluptatem doloremque reiciendis.', 23, 7, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(19, 'consequatur perspiciatis voluptate', 'Occaecati non sed quod consequatur sed eum quia. Quis impedit aliquid distinctio deleniti commodi quisquam. Molestiae laudantium cupiditate quis illum voluptatibus voluptatum. Veritatis et laudantium exercitationem repellat voluptatem.', 'Possimus temporibus nobis sed quo omnis. Aperiam saepe occaecati consequatur. Cumque voluptas unde id. Enim ut hic dolorem incidunt eaque eius. Labore sit et quia hic. In hic velit aut laudantium. Id quia nostrum maiores. Minus et non laudantium adipisci praesentium accusantium quasi. Facilis est natus ducimus voluptatum ut modi repellat officiis. Ex excepturi totam quas et et maxime culpa. Esse et omnis culpa ipsum iure et aut. Qui non laudantium magnam dolores id temporibus minima sapiente.', 16, 4, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(20, 'libero sit quam', 'Doloremque quis autem illum odio non. Ea dignissimos non esse dignissimos quia tenetur. Alias ea vel excepturi quaerat cumque autem vel.', 'Dicta eveniet quia ut repellat placeat suscipit eius velit. Corporis id autem sunt dolor quasi. Est voluptatem voluptatibus et qui facere sunt eveniet quidem. Veritatis velit ea repellat et quos eaque tempore. Voluptatum odio modi perferendis odit expedita aut ipsam. Voluptates ea aperiam doloribus mollitia earum quisquam nemo. Impedit quos quia iste est tempore et repellendus. Non iusto at sed quidem ad saepe molestias.', 25, 7, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(21, 'hic nam enim', 'Qui quia autem quia alias numquam. Vitae id vel et omnis. Quae dolore aut aut. Debitis nostrum placeat a sed eum maiores consequatur.', 'Quisquam quod ab consequatur ipsum. Ut magnam quasi earum odit voluptatem ab eveniet. Officiis qui et quis libero perferendis officiis aspernatur. Magni voluptatibus consequuntur nesciunt perspiciatis. Officia veritatis suscipit debitis aut sequi aut. Voluptate consequatur labore blanditiis sed. Non nisi aut expedita illum voluptatibus. Aut quia error voluptatum ut et fugiat. Et molestiae omnis quia eos qui. Amet ut odit at aut cum ducimus. Quasi laudantium vel ipsam ea. Voluptatem vel qui at nemo necessitatibus sint odio cupiditate. Tempora minima et impedit neque iusto. Quo maiores hic est iure ut eos aut.', 20, 1, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(22, 'aut suscipit totam', 'Praesentium sequi dolore quisquam temporibus eveniet qui aut. Aut perferendis aut enim quos ducimus dignissimos. Aut iste minus ex dolorem natus et.', 'Voluptates aliquid quidem ut cumque sint vitae sequi. Architecto impedit voluptas sint aut et porro qui. Et vero eos reprehenderit aut. Odio corporis ut explicabo aperiam consequatur corporis. Ut quam distinctio ut consequatur autem. Voluptates rerum deleniti commodi sed. Sit error cumque hic blanditiis minima iste deserunt quos. Rerum repellat id voluptatem. Voluptatibus aut repellendus ducimus aliquam. Ipsa autem quia perspiciatis. Tempore officiis dolores quis hic perferendis nobis. Corporis et in esse assumenda. Facere perferendis qui quo vitae.', 20, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(23, 'accusantium eum ea', 'Molestiae incidunt odio fugiat provident minus provident corporis. Laudantium similique laborum labore praesentium. Nulla sed illo deserunt iste ullam rem facilis. Saepe nisi non minima quia.', 'Magni nemo maiores sed sit atque in quia quod. Aut fugit iste doloremque sit aut. Dolores et sequi quasi nobis eius vero. Voluptates natus explicabo ea impedit molestiae laudantium. Quo natus aut perspiciatis voluptatibus quia. Dolores molestiae tempore praesentium nesciunt qui distinctio. Voluptatem quo cupiditate qui doloribus voluptas et id. Autem quia nihil sint asperiores. At sed consequatur tempora assumenda omnis enim est. Consequatur qui sint nobis veritatis. Quo non aperiam omnis. Voluptas aperiam qui laborum sed fugit beatae. Iusto autem recusandae voluptatibus sit dolorem repellendus. Voluptatum suscipit quos ut odit incidunt neque explicabo.', 10, 4, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(24, 'est animi eum', 'Voluptas nobis nemo quia sed. Omnis ducimus aspernatur placeat. Officiis animi aut aut officiis. Qui consequatur quod cupiditate itaque.', 'Non cum ab ut repellendus et sint. Sed sapiente accusantium dolor dolorem ipsum. Et aut expedita quas in a alias quisquam. Qui laboriosam velit sed aut necessitatibus. Quasi deleniti non dolore deserunt enim eum. Blanditiis quis praesentium eveniet. Animi cum qui sit distinctio dignissimos. Temporibus dolorum accusamus et sequi recusandae temporibus. Vero maiores cum eos omnis corrupti. Aperiam sit eum molestiae adipisci officia sit et ut. Dolorem dolores aspernatur dolore in aspernatur quasi exercitationem qui. Reiciendis voluptatem rerum esse facilis. Fugiat ut error rerum est architecto assumenda iste. Eius placeat libero tempore sunt id et.', 5, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(25, 'earum ut expedita', 'Aut aut dolorum rem adipisci sit. Aut quaerat possimus aperiam temporibus aperiam. Autem quos voluptatem soluta nobis. Dolorum delectus illo commodi sint.', 'Corrupti incidunt explicabo voluptatibus quas officia voluptatem veritatis. Officia doloremque et explicabo esse ea. Recusandae veritatis id magnam hic animi pariatur. Qui corporis rerum expedita nobis voluptas. Est officiis aut officiis doloribus eos voluptas. Iste nostrum distinctio id facere amet voluptatem tenetur sint. Voluptatum voluptas non voluptas ab eos laudantium. Id eaque dolor doloribus. Maxime et vel sed quia officiis consectetur. Recusandae illum praesentium ut cum molestiae doloribus animi.', 27, 4, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(26, 'minus unde laboriosam', 'Animi omnis sit quasi at expedita exercitationem commodi. Quia libero inventore dolorem quibusdam sapiente hic. Voluptatibus qui dolor aut delectus quo. Saepe quia et iure assumenda pariatur quae.', 'Mollitia eum aut porro consequuntur. Assumenda facere nisi adipisci qui veniam aut placeat. Unde dignissimos autem similique dolores. Et in ea est et repellat qui et. Illo cupiditate sapiente repudiandae earum accusamus aut accusamus. Voluptate molestias reprehenderit id natus quasi sed. Omnis tempore sed dolores enim ipsa et. Minus est non amet aut ipsam odio quisquam dolorum. Explicabo fugit eos labore officiis. Adipisci est impedit et dolor iste deleniti iusto veritatis. Est ea dolore quaerat magni in optio molestiae. Consectetur voluptas maxime et exercitationem necessitatibus modi.', 7, 11, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(27, 'aspernatur dolorem autem', 'Qui omnis et reiciendis nostrum quo ut. Commodi est natus ab tempore.', 'Quidem quis dolor voluptatibus voluptatem quia aut. Recusandae quidem blanditiis nesciunt aut unde est. Perferendis consequatur maxime vel ut et iste. Rerum animi repudiandae quod eligendi accusantium suscipit quam. Officia sapiente est facere iusto sunt. Et molestiae enim optio distinctio vitae voluptatem consectetur possimus. Nemo voluptas quod inventore molestias dolorum ut. Ex nulla dolorem sequi aut sed. Quo hic eaque et sint et error vitae ipsa. Vel eveniet sint sint molestiae consequatur quam delectus. Eaque sed eos facere est consequatur velit. Ex ea aut accusamus. Totam a dolores assumenda qui magnam.', 13, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(28, 'aut deserunt aliquam', 'Qui rerum quo dolorem dignissimos quam. Cum sit corporis tempore aliquam.', 'Commodi recusandae delectus aut harum maxime. Velit quaerat hic ullam repudiandae qui possimus fugiat. Aut reiciendis ut eum assumenda et autem earum. Maiores dolores tempora distinctio optio vel quia. Perferendis error error ipsum eveniet quia. Consequatur asperiores ut possimus aperiam. Eum ut eum reiciendis sit.', 13, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(29, 'occaecati id ratione', 'Omnis odit vero voluptatem sed et quis quisquam. Animi provident corporis impedit fugit sapiente sequi odit dolorem. Ullam pariatur dolores rem rerum dolore soluta rerum. Quo iusto et voluptas corporis totam voluptas.', 'Illum odit accusantium veritatis repudiandae maxime aut. Accusantium numquam vel similique facilis molestiae est tempore cum. Vel qui est voluptatem provident neque voluptatem consequatur voluptas. Qui fugit explicabo corporis ullam architecto. Accusantium nostrum saepe cum rerum et nisi. Soluta autem ut labore nam veritatis. Animi sint aspernatur fugit natus sit laboriosam aspernatur qui. Doloribus accusamus aliquam atque ad inventore dolore facilis. Enim quo eos maiores enim sed eveniet ut. Provident deserunt itaque odio expedita impedit. Maxime et vero consequuntur. Optio quae maxime numquam voluptatibus nam voluptates maiores.', 24, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(30, 'voluptatibus reiciendis et', 'Nostrum illo eum debitis fugit quia omnis dolorem. Et illo saepe minus debitis sit veniam rerum. Eaque illo accusamus et iste odio adipisci voluptatum.', 'Molestias excepturi ut impedit. Quis voluptas numquam voluptates consequuntur. Ipsa laborum nobis deserunt eveniet recusandae veniam. Corporis sit quae animi autem pariatur qui cupiditate. Suscipit voluptatem ea similique dolorem deserunt. Qui aspernatur dolorem reprehenderit explicabo omnis. Atque rerum enim esse. Rerum debitis adipisci vitae. Dicta ut at quia quae. Illum distinctio quo nisi voluptatem eius sapiente. Facere veniam ratione harum voluptatum nihil aut sint. Dolores consectetur consequatur rerum omnis ad odit ullam a. Soluta rerum officia cumque sed ea nesciunt ut.', 6, 10, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(31, 'consequuntur veritatis omnis', 'Corrupti voluptas quia ipsum iusto. Enim est vero iusto est aut amet repellat. Dolorem blanditiis autem eius officia quae ut asperiores.', 'Repellendus voluptatum hic voluptas aspernatur vero. Omnis molestiae molestiae quisquam ut dolor eos consequatur. Omnis et neque expedita eveniet in excepturi qui. Rem corporis consectetur quas quo voluptatem ipsa. Nostrum pariatur expedita facere fugit illo. Vel dolorem sunt aspernatur. Nemo eius quia dolor aspernatur nihil commodi quo. Rerum sunt dolores sunt est qui nesciunt. Et in dolores possimus quaerat quod qui est voluptatem. Earum vero aut ea porro architecto. Eum excepturi voluptatem sed quis.', 3, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(32, 'exercitationem sint iste', 'Molestiae sit eligendi sit recusandae aliquid vitae. Nesciunt nihil quia ex ex nostrum explicabo.', 'Quasi qui modi distinctio consectetur. Dolorem pariatur iste accusantium sequi nam et mollitia rerum. Unde non pariatur quis rerum. Asperiores eos laudantium aut aut. Ducimus eligendi alias ab autem. Quia laudantium ut ab voluptatibus. Eligendi deserunt nesciunt earum ea nihil. Autem quas in fugiat quia alias quis. Aut quibusdam incidunt dolore. Ad fuga eius cumque commodi.', 22, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(33, 'quisquam sed nihil', 'Omnis saepe quaerat est quia similique perferendis perspiciatis rerum. Explicabo sequi neque qui debitis rerum sed voluptatibus ratione. Aspernatur aut reiciendis cum praesentium sint. Quo sit amet pariatur sapiente suscipit sunt. Aut rem consequatur officiis et.', 'Aut ipsam eligendi autem iusto minus eveniet esse. Fugit consequatur sit accusamus itaque. Voluptas maxime nesciunt aut magni quam expedita doloremque qui. Consequuntur mollitia et qui. Cum ea voluptas dolorem repellat quos. Quibusdam officiis nesciunt quasi vel id. Deleniti magnam id eius excepturi laudantium. Ab qui maiores debitis. Vel iste voluptas quos totam. Modi nobis distinctio aspernatur dicta.', 8, 4, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(34, 'et omnis voluptas', 'Voluptas ullam adipisci et consequuntur illum a exercitationem aut. Non deleniti aliquid aut id rem reprehenderit hic. Ut occaecati et iusto aut consequuntur dolor deleniti aut. Dolores quia quasi molestias.', 'Sunt excepturi at temporibus. Culpa voluptas amet labore quisquam. Optio illo similique eligendi. Quia libero et ullam aut cum molestiae. Qui non ea et ea vitae sed molestiae facere. Sequi quis in et. Tempora expedita quo non a quo corporis laborum.', 6, 7, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(35, 'nostrum aut velit', 'Eveniet sunt perspiciatis nulla voluptatem. Quis id animi sequi est voluptas blanditiis alias. Iure ipsa ut asperiores placeat ipsum suscipit voluptates dolorum. Blanditiis natus velit magni reiciendis repudiandae id qui.', 'Nesciunt dolor omnis iste quisquam. Atque quam id enim repellat velit numquam. Est dolor facilis cumque est consequatur delectus est. Iste quis deleniti nulla ut et sed. Porro minus ipsa sit sed. Quod et aut sit eligendi. Nihil adipisci sequi reiciendis quidem.', 30, 1, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(36, 'neque aut repellat', 'Repudiandae nihil non id et rerum distinctio. Ullam dolorum est fugiat officiis earum. Incidunt ducimus accusamus veritatis accusamus temporibus vitae odit est.', 'Explicabo eius iure rerum omnis. Maxime voluptatibus nisi reprehenderit distinctio. Eligendi hic maiores sint totam molestias blanditiis et. Dolorem doloremque qui distinctio esse tempore. Delectus aut ducimus blanditiis voluptas mollitia adipisci cupiditate. Non illum animi repellendus aspernatur. Ut nam eveniet autem et. Voluptates aliquam unde non odio deserunt commodi enim. Dolorum error a mollitia at quidem quia. Quidem inventore dolorem iure veritatis adipisci iusto. In quo ullam praesentium itaque maiores est veniam. Sapiente placeat aliquam nostrum non nihil quia magnam. Ipsam sed quod ducimus aut natus vel. Vitae fuga aut quos architecto nostrum qui quibusdam.', 25, 3, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(37, 'id saepe ipsa', 'Saepe nesciunt libero repudiandae placeat et. Consequatur odio nihil magni eos repellat officiis odit ullam. Nobis cupiditate deserunt et voluptatibus est.', 'Ad molestias maxime laborum sint iste provident. Sit tempore mollitia explicabo ipsa. Earum quis quasi qui quia. Quis error est ex quis est in quo. Pariatur voluptate a ipsam eaque mollitia rerum ratione explicabo. Numquam veniam quidem tenetur perferendis. Sit tempore eligendi ea consectetur neque saepe. Totam cum facilis aliquid et aspernatur ipsam. Assumenda iusto nemo porro labore. Ut itaque ut rem sint. Ab est ipsum magni molestiae dolor architecto.', 17, 5, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(38, 'placeat rem qui', 'Rerum minus in debitis minus. Quas soluta exercitationem quisquam saepe modi. Accusantium et recusandae sit quis molestias quis. Eius tempore non et rerum non voluptas rerum. Voluptas facere veritatis dolores est veniam.', 'Vitae perferendis culpa minus excepturi. Expedita reiciendis libero ea. Et facere similique aut qui natus possimus. Iste et nisi qui. At sed et ab. Modi amet error temporibus quis aut quos incidunt rerum. Non in dolor natus et. Voluptatem rerum debitis voluptas quis optio. Ullam eum aperiam dicta magni inventore beatae. Dolore ut eos a vel et et. Et laudantium minima et veniam.', 29, 7, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(39, 'sit rerum consequuntur', 'Et fuga nostrum iure. Sapiente voluptas esse at cum nulla ea. Totam et quidem amet non eum. Officia voluptatem neque inventore nostrum.', 'Earum consequatur ut rerum. Itaque quaerat repellat qui distinctio quos sunt eveniet. Placeat eum distinctio sint aut. Eos id deleniti repellendus quia. Unde nobis facere ut non odio rerum et. Et doloribus quas reiciendis. Ab reprehenderit omnis eius est et fuga aut repellat.', 13, 3, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(40, 'ducimus in ad', 'Occaecati mollitia ad quo fugit. Ab omnis enim dolorem aut. Praesentium cumque voluptate dolore sequi molestias vitae.', 'Enim est eum neque incidunt. Maiores dolorem laboriosam doloribus. Quaerat odit sed doloremque. Sequi commodi quia assumenda perspiciatis veritatis in dignissimos. Magnam et repellendus rerum porro. Vero eveniet inventore totam accusamus tempora ratione aspernatur. Rerum repellat enim et ut facere nam. Perspiciatis distinctio sit sit sequi similique quia enim.', 14, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(41, 'quidem ut sunt', 'Et autem consequuntur fugiat ullam ut ducimus quia sit. Ullam autem doloremque quia aut. Distinctio nihil veritatis fuga qui dolores modi iste. Nobis rerum quia aspernatur ea ut ut.', 'Cum eum at recusandae beatae quibusdam velit. Nam amet praesentium dignissimos qui illo nobis. Dolore quo odit atque animi delectus nobis rerum. Et eum ut eaque fugiat esse quod sit. Fugiat fugiat dignissimos soluta vitae sequi ex. Accusantium quia occaecati dolore explicabo blanditiis. Maxime omnis ducimus qui reiciendis quae ea dolore. Omnis atque officia placeat voluptates quibusdam provident officia.', 29, 1, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(42, 'qui quo corrupti', 'Autem nostrum cum in rerum molestias qui. Nesciunt repellat maxime excepturi odit sint. In veritatis veniam molestias beatae. Mollitia ducimus animi eligendi omnis et.', 'Quas totam vero recusandae vel incidunt. Omnis aut vel voluptatem vitae officiis. Aut voluptas ipsam accusantium similique et est. Impedit incidunt sint impedit sit saepe enim accusamus. Facilis fugiat exercitationem est rerum eveniet. Aliquid et non non et. Voluptas deleniti distinctio voluptatem et. Quia a rerum architecto voluptatum. Nihil mollitia sed dignissimos dignissimos non eaque atque. Id aut rerum recusandae et aut ut deleniti. Commodi sed reiciendis et ut non adipisci. Nemo occaecati sunt error ut qui. Omnis voluptatum unde minus. Consequuntur ab labore ullam expedita ut dolorem.', 21, 6, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(43, 'nisi quae debitis', 'Sit sed ut et. Officiis nulla dolores velit consequatur aut nam dolores. Nihil qui excepturi neque id sunt dolor. Voluptatem ut consequatur laborum quis aut ad.', 'Dolorem maxime enim tenetur porro beatae dolorum. Nemo inventore voluptatem eum ipsam consequatur. Suscipit ut corrupti tempora aut. Vel ut ipsam sit ut temporibus veniam. Facere voluptatem amet voluptatem perspiciatis voluptates nobis earum quia. Aut eius et dolor ea. Saepe nihil corporis nihil quia ut voluptas. Quo reiciendis aperiam nihil pariatur.', 5, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(44, 'accusantium perferendis dolores', 'Ipsum cupiditate eos voluptatem molestias enim sunt maiores. Fugiat reprehenderit non hic maiores occaecati. Et molestiae ut reiciendis nulla labore tempora ut. Sit minima praesentium numquam mollitia. Totam ipsam optio qui.', 'Amet maiores consequatur ea qui adipisci. Nisi voluptatibus numquam est aut voluptatum qui atque. Id sunt perspiciatis velit ipsum qui quod. Praesentium ab in et quos qui. Quo aut delectus non modi ut voluptas. Et doloribus quod quia dolor. Reprehenderit iusto similique nobis et qui et sit. Voluptas et est est et sit excepturi. Vel consequuntur laudantium dolor rerum dolor itaque eaque repellat. Enim et repellat non tenetur perferendis autem deserunt. Temporibus a dolor voluptas eos sed eum. Dicta iste quisquam voluptatum accusantium.', 27, 5, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(45, 'vero dolores sunt', 'Aut ipsum voluptatem ea nisi. Aut fuga eius in ut sint et excepturi. Est ut quasi doloremque id odio laborum aut. Voluptatibus voluptatum aut incidunt recusandae doloribus libero recusandae. Incidunt id deserunt porro et.', 'Ipsa sed ea non. Minus architecto consequuntur magnam et magni. Quibusdam similique et dolores voluptates aut. Sint ut aspernatur molestias nihil aspernatur non velit iure. Occaecati esse eveniet aut voluptate ad tempore. Sapiente quo possimus quasi autem minus repellat molestias. Molestiae et aliquid possimus perspiciatis. Molestias enim velit explicabo molestiae assumenda ducimus excepturi non. Sunt ipsa est autem aliquid officiis repellendus quibusdam. Velit recusandae quia rerum laudantium amet.', 18, 5, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(46, 'vel sed quod', 'Quia non tenetur corrupti consectetur quidem in. Eos ipsam quis quaerat voluptatem laudantium quos. Quas ut qui adipisci. Tenetur autem facere quisquam natus. Voluptatem aliquam est ipsum perspiciatis in autem blanditiis.', 'Eius ut debitis recusandae sit nulla sunt. Nulla excepturi perferendis voluptas aut ipsam neque repellat aut. Unde soluta veritatis nihil autem. Velit omnis aperiam praesentium a quis pariatur deleniti. Voluptatem enim corporis ipsa unde exercitationem itaque facilis dolore. Ut quia temporibus voluptas iusto. Non odit consequuntur id et quasi itaque suscipit. Asperiores et quasi modi facere quia consequatur ut. Qui esse et incidunt. Sunt ipsum modi eius ut odio consequuntur sit earum. Et nostrum in totam expedita aspernatur voluptas alias inventore. Officiis accusamus et voluptatem iste adipisci facilis.', 9, 2, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(47, 'quae quam at', 'Occaecati voluptate voluptatem sit incidunt sit veniam error. Nam consectetur sequi est aut.', 'Quasi ab eos nihil nisi aut. Animi velit illum ut autem. Voluptas quia error perferendis hic. Et ad aut eum tenetur amet. Quis voluptatem minima facilis qui similique laudantium. Aut dicta tempore sed id accusamus. Voluptatem pariatur voluptate assumenda at omnis. Porro a aut aut repudiandae quibusdam. Iusto qui vel est laudantium.', 3, 5, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(48, 'a quae at', 'Deleniti nobis eos non est eaque. Dolorem eos animi qui non et. Ipsam odio modi assumenda recusandae.', 'Provident repellendus corporis perferendis debitis repellat quis. Qui nisi dolores velit rerum enim ut sed accusantium. Delectus fuga reiciendis tempora cupiditate aspernatur. Eos numquam odio dolores est. Exercitationem rerum sunt a consequuntur. Ea est autem cumque omnis quo libero. Omnis esse ut et aut excepturi et.', 20, 9, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(49, 'facilis et voluptatibus', 'Iste rerum non illum totam a aut. Distinctio ullam fuga velit fuga nihil voluptatem architecto. Sit non consequuntur blanditiis et voluptatibus et. Nesciunt et ducimus quasi vel. Asperiores blanditiis dolore consequatur dolorem eius nihil.', 'Voluptatum et cumque quia quis tempora sapiente qui in. Facere quia laboriosam delectus ad molestias quibusdam aut. Earum necessitatibus qui quas nihil iure consequatur. Inventore eum doloremque aliquam quidem sunt. Repellendus atque veritatis alias veniam nemo et quis molestias. Architecto excepturi officiis aut ratione quis aperiam. Et aut ducimus alias aut qui amet sed. Nulla doloremque aut veniam aut ea eum. Eligendi voluptates autem qui ex recusandae quod inventore. Itaque dicta porro quidem maiores sed repellendus error quod.', 28, 3, '2020-04-12 05:47:48', '2020-04-12 05:47:48'),
(50, 'cumque sunt provident', 'Aspernatur quam ratione id iusto autem accusantium nihil sed. Unde laboriosam animi cum aperiam. Rerum qui eos qui laudantium.', 'Consequatur vitae velit fugit eius reprehenderit amet animi. Tempore enim minima minima. Nihil maxime dicta esse alias. Consequatur culpa nemo itaque. Corrupti similique quod modi distinctio. Ipsam illum in est dolorem id. Porro qui illo distinctio mollitia sit voluptatibus sunt. Quos necessitatibus ut impedit. Quam autem quae similique reiciendis ipsa illum. Eum maiores in hic minus et sit. Dolor voluptas dignissimos rerum atque. Aliquam unde id esse corporis et repellendus.', 16, 5, '2020-04-12 05:47:48', '2020-04-12 05:47:48');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type_user` enum('user','organizer','leader') COLLATE utf8mb4_unicode_ci NOT NULL,
  `raiting` double(8,2) NOT NULL,
  `auth` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `type_user`, `raiting`, `auth`, `exception`, `description`, `country`, `city`) VALUES
(1, 1, 'organizer', 3.30, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Dolores sed itaque qui consectetur itaque sapiente labore voluptatem. Eius totam sed sapiente non voluptatem voluptatem saepe omnis. Id et molestias dolor. Necessitatibus mollitia alias cumque harum quibusdam ab labore. Sit ex praesentium minus et animi. Alias ratione totam beatae doloribus saepe voluptate. Et aut doloremque excepturi autem laborum et.', 'Босния и Герцеговина', 'Дмитров'),
(2, 2, 'organizer', 1.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Nemo aut earum velit voluptatem cum vel. Officiis qui nemo labore qui. Dignissimos assumenda delectus placeat velit voluptas. Placeat in nemo voluptatem est accusamus. Dolorem sit sunt et delectus. Ea voluptas quod doloribus consectetur animi voluptatum vitae. Explicabo cum esse tenetur ab repudiandae consequatur ducimus. Rerum ut in qui expedita nostrum.', 'Испания', 'Павловский Посад'),
(3, 3, 'leader', 0.50, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Voluptas temporibus ut et qui sed et. Consequatur quaerat aspernatur eum eos. Tempora assumenda commodi eius ad minus qui. Labore assumenda sunt unde rerum omnis maiores est. Quo et explicabo nesciunt minus fugiat illo quidem quisquam. Occaecati qui vel voluptatum minus. Quidem hic enim et earum.', 'Эстония', 'Дорохово'),
(4, 4, 'leader', 5.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Qui ratione reprehenderit tempore. Totam autem sapiente commodi maiores nisi aspernatur. Et accusantium eveniet nobis consequatur labore et. Rerum consequuntur earum reiciendis accusantium qui accusamus. Delectus quos et quaerat. Quidem et quis facere iure libero doloribus. Tempore ad ut cumque ipsum facere facilis. Asperiores pariatur illum omnis natus recusandae deserunt dignissimos qui.', 'Виргинские Острова Соединённых Штатов', 'Ногинск'),
(5, 5, 'leader', 1.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Pariatur non placeat laborum atque quia quis aut. Eum voluptatum et hic quam. Fuga aspernatur possimus et sint. Unde dignissimos ut id eos sequi officiis. Qui nostrum optio corrupti vitae veritatis tempora. Fugit velit quam quia enim odio quasi. Molestiae enim et in. Et illo cumque adipisci distinctio aut. Molestiae ipsum occaecati consequatur minus vel. Non aliquam nihil consectetur cum explicabo dolorem cupiditate. A quod non aut. Porro vitae possimus praesentium dignissimos. Non mollitia commodi odit modi vitae aliquid et. Enim sapiente vero dolores necessitatibus error.', 'Объединенные Арабские Эмираты', 'Орехово-Зуево'),
(6, 6, 'leader', 4.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Iste exercitationem eos autem eligendi voluptatem. Similique eveniet quasi commodi non corporis. Quae qui sit quia fugiat vitae enim sit. Nesciunt eos necessitatibus nesciunt impedit voluptas. Commodi omnis id maiores. Numquam nostrum eos cumque accusantium labore beatae quas. Sequi voluptas quasi officia. Officiis qui quia voluptatem ut. Corrupti quisquam dolores modi repudiandae.', 'Виргинские Острова Соединённых Штатов', 'Видное'),
(7, 7, 'leader', 0.50, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Voluptatem dolores hic praesentium omnis. Aliquid laborum impedit facere soluta et odio explicabo. Dolor quia sed fugiat aperiam. Sed veniam quia quisquam magnam id et et. Eligendi aut eum vel magnam ab deserunt. Placeat voluptatem nam sint asperiores enim ullam nihil. Assumenda dolorum aut aut officiis. Quis debitis magnam tenetur assumenda placeat amet at.', 'Южный Судан', 'Павловский Посад'),
(8, 8, 'leader', 2.30, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Debitis cum numquam ea. Reiciendis sed incidunt est qui ipsam ratione. Odit rerum ut et et nihil similique voluptatum. Nulla nulla quos ea vitae blanditiis et et. Et et repellat et delectus ut. Autem sit neque alias qui atque id possimus. Tenetur voluptas dolores quo laudantium quaerat quia aliquid soluta. Reprehenderit perspiciatis sed similique est blanditiis ducimus qui nihil. Quas rerum consequatur dolorem et qui. Ipsum consequuntur similique aut architecto. Voluptas quae qui asperiores officiis et velit laudantium. Dolores omnis et ut aut et ipsa quidem et.', 'Бонэйр, Синт-Эстатиус и Саба', 'Клин'),
(9, 9, 'user', 2.10, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Reiciendis asperiores occaecati id ut debitis voluptatem. Neque soluta ea dolorum repellendus vero. Rerum aliquid quae nihil consequatur sit non laudantium. Libero est doloremque ullam quia ut omnis sed. Fugiat et necessitatibus et et. Sit placeat optio molestias atque quod odio temporibus. Sint aspernatur tempora quasi cupiditate est. Culpa ut hic dolorem molestiae doloribus ratione non beatae. Nostrum at eum molestiae ex libero. Qui voluptatibus rerum quod molestias. Et non accusantium sunt eligendi non a tenetur ut. Minus deserunt repellendus nisi dolores sunt. Ullam eveniet quae deleniti animi sit hic. Commodi dolorem est cupiditate voluptatibus non.', 'Бруней', 'Шаховская'),
(10, 10, 'user', 1.60, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Illum fugit molestias sint maiores quo perferendis. Voluptatem eligendi nesciunt consectetur atque. Id qui et magni enim. Esse qui vel unde voluptatibus inventore consequatur. Qui maxime perferendis vitae at aliquid aliquam est. Dicta quia quis omnis et nam dolorum. Alias itaque atque ea similique quam. Dignissimos ut error similique doloremque autem delectus. Alias tempora architecto eius minus et iste. Aliquam temporibus consequatur asperiores.', 'Антарктида', 'Одинцово'),
(11, 11, 'user', 4.80, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Qui ea molestiae et et facilis non. Dolorem fuga praesentium sed esse. Et quam aspernatur voluptatem voluptas. Sint et omnis sunt consequatur quia exercitationem. Et non molestiae dolorem. Dolores voluptas maxime ut dolor qui vel voluptatem sint. Voluptates quaerat qui quos est aut repellendus saepe.', 'Эстония', 'Видное'),
(12, 12, 'user', 5.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Neque voluptatibus blanditiis assumenda est omnis molestiae. Et quidem iusto sunt dicta voluptatem hic odit. Fugit corporis architecto ipsam omnis. Aut ratione voluptate fuga. Voluptatem qui iste tempore sunt. Nisi facilis quia omnis fugit. Autem culpa natus deserunt voluptatem. Eveniet qui consequatur a eius et iure voluptatibus quasi. Repellat ut ullam consequuntur voluptatem et veniam. Asperiores autem nemo perspiciatis ut et incidunt quae. Qui animi laboriosam consectetur voluptatem. Et dolores laudantium corporis quibusdam inventore. Fuga voluptatibus qui minus provident neque et.', 'Словакия', 'Можайск'),
(13, 13, 'user', 4.90, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Qui quo dolorem consequatur et adipisci est. Ratione perspiciatis a unde. Et id sed labore et. Optio harum velit tempore laboriosam. Et molestias velit exercitationem aliquid non qui atque. Non vel saepe iste ipsa incidunt excepturi dolor. Aut neque minima quo inventore. Eos rem sint animi inventore est tempora. Possimus expedita voluptates eum corrupti accusantium sit. Dolorum minus aperiam consequatur eos est temporibus ad. Quia sed harum harum. Minus cumque excepturi fugit repellat voluptatem vitae. Quas ex consectetur sit provident reprehenderit corrupti. Occaecati eveniet porro est omnis consectetur magnam incidunt.', 'Камерун', 'Зарайск'),
(14, 14, 'user', 5.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Saepe similique id nam eum laborum. Vero sint voluptatem cumque est. Corrupti consequatur praesentium commodi itaque non quod. Id inventore dolores facere sed non. Voluptatem reprehenderit dicta quo possimus. Deserunt optio consequatur omnis ipsum saepe porro aut officia. Doloremque eos expedita ducimus quam aut rerum. Eaque pariatur voluptatum distinctio corporis nostrum reprehenderit placeat. Suscipit sed consequatur necessitatibus quia ut sit.', 'Монголия', 'Лотошино'),
(15, 15, 'user', 0.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Fuga quia quo porro occaecati enim aspernatur. Esse omnis in neque ut eligendi error dolorem consequatur. Minima similique asperiores est tempore ex et ut. Nam quod at ut aliquid omnis distinctio odio. Est velit reprehenderit maxime ipsa vero qui eum. Iste porro neque sit excepturi et dolor. Quam adipisci voluptas dignissimos sit et quas maxime.', 'Остров Норфолк', 'Орехово-Зуево'),
(16, 16, 'user', 0.60, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Assumenda consectetur aspernatur est molestiae accusantium sit. Est accusamus odio aut sit minima qui. Perferendis porro voluptates magnam repudiandae qui ipsam. Blanditiis recusandae maiores repellat illum facere. Itaque sunt et dolorum ut adipisci. Cum in consectetur expedita et pariatur et aut. Dicta sapiente corporis illo eum et officiis. Omnis blanditiis quas deserunt necessitatibus. Voluptatem consequatur modi ea repellat. Quam nihil nihil sit nesciunt. Error ipsa assumenda maxime blanditiis dolorum qui vel. Perferendis aspernatur recusandae aut dolores.', 'Малайзия', 'Щёлково'),
(17, 17, 'user', 5.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Et magnam omnis aut voluptatem. Iusto provident earum ut. Minima voluptatem aut nobis et. A omnis quod dignissimos eos. Omnis laudantium aut eos qui et consectetur sed. Reprehenderit quaerat sit quae quo officiis laboriosam. Ut et sit quas qui occaecati possimus. Voluptas aliquam ut quo quod rem repudiandae corporis. Quo sapiente sit hic tempora eos repellendus ab. Molestiae aut perspiciatis ratione sunt nisi eius. Soluta labore illo qui. Cupiditate expedita odio aut voluptatibus at sit.', 'Тувалу', 'Пушкино'),
(18, 18, 'user', 2.20, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Inventore sint aliquid molestiae et. Consequatur minima asperiores veniam possimus nostrum culpa iste. Consequuntur voluptatem dolorum voluptates exercitationem. Doloremque libero rerum a ipsum ut nihil. In facere quod officia deserunt. Aut explicabo necessitatibus quos et. Ea ut ab sit illum. Magni blanditiis libero aut ut. Autem perspiciatis ut voluptas quasi facilis.', 'Катар', 'Раменское'),
(19, 19, 'user', 1.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Omnis et voluptatem natus omnis magnam. Accusamus alias qui rem esse rerum nisi non. In qui et possimus hic. Omnis et consequuntur tenetur nihil in recusandae omnis. Dolor et ratione et. Dolore sed nostrum eaque culpa. Quo quod alias autem neque ratione aspernatur velit. Autem cumque corrupti ut quae harum. Ut optio voluptatem et quidem neque aut magni officia. Magnam accusamus dicta repudiandae nesciunt porro. Minus est earum sed aperiam minus ut. Et expedita sed aut accusantium aut ut quaerat. Praesentium quibusdam id rem et ullam.', 'Свазиленд', 'Раменское'),
(20, 20, 'user', 1.30, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Expedita consequatur adipisci mollitia ipsam consequatur in. Sit molestiae quam voluptatem quasi nisi. Qui deleniti odio eius quo nihil incidunt. Fugiat dolor exercitationem neque laborum qui. Animi maiores tempore autem. Debitis accusantium beatae et molestiae amet qui ut. Placeat quo odit nam voluptate quasi. Laboriosam illo fugiat et corporis perferendis aut. Quod nihil nobis quisquam libero sapiente placeat et. Iste velit quam corporis sit rerum. Enim dignissimos qui temporibus commodi. Corporis et autem architecto fuga vel.', 'Япония', 'Клин'),
(21, 21, 'user', 0.80, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Sint distinctio maxime eum voluptates. Repellat odio sed excepturi esse id incidunt. Sapiente quia dicta inventore consectetur quia quod nostrum. Nesciunt cum non consequatur corrupti voluptate ut. Est et autem dolores molestiae. Voluptatum adipisci aut repellat eum. Praesentium laboriosam nisi beatae et vero libero inventore. Recusandae ducimus et ipsum voluptas veniam perspiciatis voluptate. Magni assumenda blanditiis omnis molestiae error assumenda illum. Aut saepe rerum odit. Natus sunt officia omnis eos amet aut et. Eos dolorum eos commodi sunt.', 'Французские Южные Территории', 'Егорьевск'),
(22, 22, 'user', 3.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Enim et assumenda enim ea autem. Et error ut vel mollitia sed quia nihil. Voluptates recusandae et quam officia architecto. Qui quia vel et. Quo voluptatem non et aspernatur distinctio et dicta officiis. Inventore in officiis ea sit quae. Omnis est commodi atque necessitatibus ut velit earum. Consequatur suscipit enim laborum ex occaecati modi. Cupiditate non enim minima fuga corrupti cupiditate et inventore. Maiores consequatur rem voluptatum dolore deleniti veritatis. Aperiam distinctio veniam alias ut quae voluptas ratione.', 'Ангола', 'Истра'),
(23, 23, 'user', 5.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Commodi similique non non consectetur quam. Quo enim expedita qui iste culpa at. Facere cum mollitia et dicta totam quibusdam. Earum consequatur veritatis aut perferendis quaerat ut. Error voluptas modi architecto. Ullam sint excepturi at eius placeat. Perferendis enim facere iure qui et dolorem. Sit dolores deleniti nemo error. Est aut exercitationem voluptas dolorum. Necessitatibus neque qui est molestiae. Repellendus maiores non architecto voluptates molestiae.', 'Греция', 'Дорохово'),
(24, 24, 'user', 3.50, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Aut maiores porro doloribus nihil sed aut atque. Fuga quo aut illo placeat. Ex velit qui accusantium sed modi repudiandae placeat. Maxime fugit laudantium recusandae occaecati ea reprehenderit. Odit voluptatibus ipsam aut ex. Autem quia corporis dolor qui. Vel laudantium vitae doloremque ratione quas ipsa in accusantium. Minus pariatur excepturi voluptatem omnis. Consequuntur qui sed magnam molestias illum consectetur quibusdam. Deleniti sint autem qui aliquid. Eligendi aliquid qui voluptatem. Tempore voluptas cum illo doloremque itaque aut. Exercitationem id ut laborum vel aspernatur voluptas fugit. Impedit tempora et sit porro ab tempore ut deleniti.', 'Греция', 'Подольск'),
(25, 25, 'user', 4.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Delectus expedita laudantium aut. Architecto in voluptatem omnis. Et corporis omnis earum distinctio soluta ipsum quam. Dolores quidem ut et eos consectetur est minima. Odio aliquid nemo sint libero temporibus ad voluptatem. Odio libero molestiae et voluptas totam tempore. Quo officiis fugit dolor praesentium sed laudantium vitae. Quo voluptatem iusto qui non et molestiae delectus sequi. Enim aperiam aut eligendi ad eveniet veniam laudantium. Ducimus blanditiis facilis dignissimos repellat. Quis ut quam fugit aut fugiat. Odit deserunt illum porro eligendi qui autem.', 'Португалия', 'Талдом'),
(26, 26, 'user', 4.20, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Dignissimos dolorum libero quis ut et odio accusamus quia. Praesentium voluptas exercitationem sed culpa. Necessitatibus ad vel necessitatibus facere. Quos repudiandae quas dicta in. Enim aut repudiandae ab deleniti nam ab doloribus. Voluptatum tenetur distinctio quam ducimus quibusdam. Sed eos consequuntur necessitatibus magnam ut perferendis eius. Dicta delectus dolor accusamus quaerat ullam quisquam neque impedit. Ea quidem inventore culpa hic. At veniam quidem fugiat vitae id pariatur. Ipsum ipsum est enim. Consequatur non nihil ipsam non voluptas. Enim autem ut sequi. Eum odio officia doloribus aut in quaerat.', 'Бурунди', 'Балашиха'),
(27, 27, 'user', 1.00, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Est non non atque qui. Illum nihil est et veritatis voluptatem. Accusantium excepturi possimus et et inventore blanditiis aperiam. Sunt asperiores animi deserunt soluta dicta. Ut ut vitae eveniet et omnis corporis nostrum quo. Corrupti dolorum quia distinctio facere quos nostrum. Quis rerum quia minus aut ullam. Quas ipsa molestiae quidem sint eaque dolorem voluptas.', 'Фарерские острова', 'Кашира'),
(28, 28, 'user', 5.00, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Porro eaque quas distinctio aut recusandae aut. Alias totam qui dignissimos harum velit non sit rerum. Fugiat non error qui dolor labore ipsam. Aut ab sequi quis autem officiis iure nemo. Eligendi neque et fuga veniam autem. Dolore dolores incidunt deserunt ad cupiditate. Ut sed aliquid eveniet sapiente ullam placeat exercitationem.', 'Люксембург', 'Талдом'),
(29, 29, 'user', 3.40, '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Doloribus quam consequatur et ea omnis. Fugit qui libero veniam ipsam. Magnam laudantium officia iste odio sunt. Vero omnis commodi provident sit. Fuga veniam provident excepturi voluptates atque. Enim et enim incidunt debitis. Tempore iste minus et consequatur dolorem iusto et. Est et voluptatem et ut id quos. Dolor laborum molestias quo voluptas nemo sunt et.', 'Оман', 'Волоколамск'),
(30, 30, 'user', 1.70, '0', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum fugit incidunt quasi deserunt, libero placeat.', 'Minus odio sapiente impedit non. Voluptas temporibus ut itaque fugit quo aliquid occaecati magnam. Sit est id corrupti voluptatibus praesentium. Minus ut vitae qui exercitationem in voluptatem deleniti illo. Iste doloremque ratione dolore exercitationem quo ut officia corrupti. Qui est doloribus nemo aperiam ut laboriosam. Et delectus fugit hic animi fuga totam nostrum. Sunt ut sit laudantium libero minima. Soluta officiis facilis rerum possimus ducimus sunt omnis doloremque.', 'Гвинея-Бисау', 'Истра');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Можно всё', 'web', '2020-04-12 05:47:46', '2020-04-12 05:47:46'),
(2, 'moderator', 'Просматривает главную', 'web', '2020-04-12 05:47:47', '2020-04-12 05:47:47');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT 'опубликовано',
  `good` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'одобрен администратором',
  `price` int(10) UNSIGNED DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `included_event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Что включено в мероприятие',
  `group_people` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Размер группы',
  `food_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'питание',
  `accommodation_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Проживание и удобства',
  `wifi_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Wi-Fi,Интернет,Телефон',
  `transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `some_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date_start` timestamp NULL DEFAULT NULL COMMENT 'начало мероприятия',
  `date_end` timestamp NULL DEFAULT NULL COMMENT 'окончание мероприятия',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'главное фото',
  `gallery` text COLLATE utf8mb4_unicode_ci COMMENT 'произвольная галерея',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'координаты',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tours`
--

INSERT INTO `tours` (`id`, `active`, `good`, `price`, `rating`, `title`, `h1`, `included_event`, `group_people`, `food_desc`, `accommodation_desc`, `wifi_desc`, `transfer`, `some_text`, `description`, `date_start`, `date_end`, `img`, `gallery`, `location`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '1', 468937, '2.0', 'nesciunt molestiae in', 'magni assumenda voluptatem est fuga', 'pariatur illum illum aut ut', 'sed sapiente ut', 'a omnis reiciendis', 'eos consequatur provident', 'eum ut suscipit id non', 'eius impedit architecto', 'labore est harum', 'Rerum et reiciendis voluptatem suscipit. Non corporis alias molestiae et voluptas dolores. Occaecati optio illo nesciunt accusamus. Aliquid iure quaerat laudantium nisi.', '2020-04-09 05:47:47', '2020-04-16 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?23525', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"54.866353\",\"h\":\"82.781511\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(2, '0', '0', 179388, '5.0', 'aliquam modi esse', 'deleniti itaque saepe voluptatem aspernatur', 'laboriosam maiores sequi harum praesentium', '', '', '', 'rerum nam quo excepturi magnam', '', '', 'Id expedita exercitationem repellendus consequatur et sed. Dolor facilis harum aliquid.', '2020-04-07 05:47:47', '2020-04-14 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?94062', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-19.49974\",\"h\":\"-91.250748\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(3, '1', '1', 384822, '5.0', 'consequuntur et quia', 'ut quibusdam magnam distinctio doloremque', 'labore nesciunt ea maxime sed', '', '', '', 'in et eaque sed placeat', '', '', 'Sed qui eaque excepturi distinctio sunt quasi. Dolorem illum unde explicabo id corporis animi nobis molestiae.', '2020-04-04 05:47:47', '2020-04-20 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?41019', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-81.390706\",\"h\":\"-178.578828\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(4, '0', '0', 50053, '1.0', 'doloremque tempora velit', 'odio quam voluptas optio modi', 'vel sit qui autem a', '', '', '', 'impedit reiciendis aut sed aspernatur', 'vero mollitia officia', '', 'Fugit officiis autem rerum. Iste in soluta voluptatibus fugiat inventore quis adipisci. Et beatae neque quod velit ab sed deserunt.', '2020-04-08 05:47:47', '2020-05-02 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?46868', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-65.223505\",\"h\":\"144.177917\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(5, '1', '1', 55489, '0.0', 'in ipsum non', 'amet est et aut rerum', 'reprehenderit aut laudantium voluptas earum', 'nesciunt molestiae sit', '', '', 'deleniti aut libero animi repellat', '', '', 'Eaque voluptas doloremque perspiciatis error quia. Cumque molestiae quam omnis qui labore fuga illo. Velit doloremque dicta cumque quae iure. Suscipit hic tempora culpa commodi consequatur et temporibus. Mollitia laborum aliquam sint praesentium aliquid et recusandae et.', '2020-04-07 05:47:47', '2020-05-02 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?87806', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"41.057542\",\"h\":\"17.511467\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(6, '0', '0', 106325, '5.0', 'ut perferendis cupiditate', 'dolor iste aliquid vitae eum', 'cumque quia tempore modi tenetur', '', 'quia perspiciatis culpa', '', 'vel magnam occaecati nihil eaque', '', '', 'Quas velit commodi possimus possimus eos ut quas repudiandae. Qui consequatur vel autem et rerum. Et ipsa praesentium eum minus.', '2020-04-08 05:47:47', '2020-04-29 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?79283', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"25.474887\",\"h\":\"147.396011\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(7, '1', '1', 108465, '5.0', 'cupiditate ex optio', 'quam doloremque maxime voluptas a', 'dignissimos dolores nisi odit error', '', '', '', 'voluptatum occaecati accusantium aut eaque', 'laborum quia illo', '', 'Totam ut ducimus culpa non. Accusamus recusandae quo et quasi dignissimos. Molestiae impedit eveniet omnis autem sint quo. Culpa laboriosam sed rerum aliquid dolores quia minima.', '2020-04-04 05:47:47', '2020-04-25 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?99319', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-5.293171\",\"h\":\"-42.95699\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(8, '0', '0', 299446, '0.0', 'qui consequatur quam', 'fugit ea assumenda illo veniam', 'debitis excepturi unde similique mollitia', '', '', 'eaque velit harum', 'porro eum est reprehenderit cumque', '', '', 'Eum mollitia consequatur vero et. Dolorem et iste reiciendis assumenda. Magni amet libero sed soluta suscipit dolorem. Molestias architecto commodi numquam nobis aliquam.', '2020-04-09 05:47:47', '2020-04-30 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?27053', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-69.423089\",\"h\":\"-179.972111\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(9, '1', '1', 453933, '3.0', 'repellat velit unde', 'aliquid odit eum sed voluptatem', 'similique fuga consequatur corporis deleniti', 'id aspernatur cum', '', '', 'est eveniet esse dolore omnis', '', '', 'Vero qui voluptatem officia non. Deserunt quas repudiandae enim molestiae velit qui vero. Aut tempore possimus voluptatem accusamus. Porro consectetur nisi officia consequatur ut non ipsa dicta.', '2020-04-09 05:47:47', '2020-04-17 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?48327', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-55.983449\",\"h\":\"-97.324139\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(10, '0', '0', 458473, '1.0', 'excepturi officiis expedita', 'necessitatibus amet aut ullam excepturi', 'cupiditate consequatur rerum iure tempore', '', '', '', 'explicabo similique eaque velit placeat', 'est quia architecto', 'in sint cum', 'Distinctio aperiam quidem et soluta velit aut vitae. Tenetur accusamus consequatur voluptatum et tempora est consequatur ex. Nihil distinctio suscipit nesciunt qui doloremque dolores consequatur. Earum vel vero excepturi deleniti suscipit omnis.', '2020-04-05 05:47:47', '2020-04-15 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?39365', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-51.709865\",\"h\":\"139.227135\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(11, '1', '1', 121580, '5.0', 'et occaecati excepturi', 'dolorem fugiat id sed deleniti', 'sed labore nesciunt eos recusandae', '', 'ad qui maxime', '', 'non accusamus sit quia quas', '', '', 'Praesentium possimus architecto illum sequi aperiam minima dolorum. Sed sequi illum sunt excepturi occaecati labore.', '2020-04-11 05:47:47', '2020-04-30 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?16101', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-31.225662\",\"h\":\"-70.151217\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(12, '0', '0', 387603, '5.0', 'vel a aperiam', 'qui dolorem qui mollitia aut', 'voluptate et quibusdam est ut', '', '', '', 'non et voluptatem cumque ab', '', '', 'Corporis facere dolor repudiandae provident. Aut enim vel tenetur dolorem esse quia et. Unde inventore eveniet maxime eligendi doloremque consequatur nostrum. Quia quisquam recusandae culpa doloremque voluptates eaque. Eligendi consequatur delectus velit nihil et.', '2020-04-10 05:47:47', '2020-04-20 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?73702', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"86.720528\",\"h\":\"134.021607\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(13, '1', '1', 422290, '0.0', 'velit reprehenderit labore', 'laborum quo aut consequatur est', 'ut sequi eius voluptatem quibusdam', 'ab inventore quam', '', '', 'qui a beatae perferendis voluptatem', 'sed aut autem', '', 'Adipisci alias officia sint aut magnam alias. Eaque pariatur adipisci beatae. Ullam error maxime aspernatur veniam voluptatum in. Vel similique perspiciatis molestiae earum.', '2020-04-06 05:47:47', '2020-04-29 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?25931', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"62.54946\",\"h\":\"76.825514\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(14, '0', '0', 233202, '1.0', 'eos sunt libero', 'harum nemo ipsum dolor aperiam', 'consequuntur accusantium qui qui voluptas', '', '', '', 'quae et corrupti asperiores tempora', '', '', 'Consectetur rem ad sint perspiciatis labore. In impedit recusandae sint debitis ut qui. Ipsum non qui quod. Eligendi deserunt atque iure veniam facere et debitis.', '2020-04-04 05:47:47', '2020-04-18 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?41865', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"67.002108\",\"h\":\"-32.364088\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(15, '1', '1', 436621, '3.0', 'quibusdam perferendis odit', 'error quis laudantium rerum id', 'est at deserunt excepturi rerum', '', '', 'et et perferendis', 'in consequuntur error sit consequuntur', '', '', 'Voluptatem tempora voluptas earum suscipit corrupti. Tempora doloribus in rerum sed ut exercitationem quo iure.', '2020-04-09 05:47:47', '2020-04-19 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?18548', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-59.158459\",\"h\":\"-67.211271\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(16, '0', '0', 269897, '5.0', 'aspernatur tempora ut', 'ab dolorum accusantium consequatur sunt', 'est et fugit esse dicta', '', 'soluta libero eum', '', 'asperiores aut laudantium minus culpa', 'qui soluta voluptate', '', 'Et earum quis maxime eos officiis. Voluptatibus nisi qui et modi nemo provident dolorem. Qui nisi dolore ut voluptas. Eius quidem et rerum reiciendis voluptates magni.', '2020-04-03 05:47:47', '2020-04-28 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?34944', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"80.293293\",\"h\":\"141.495792\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(17, '1', '1', 98638, '4.0', 'itaque qui nostrum', 'consequatur non consequuntur dolores sequi', 'est ex soluta aperiam id', 'illum odit sit', '', '', 'laborum omnis ut ut et', '', '', 'Aliquam alias perspiciatis id quia voluptas in. Harum esse soluta eos quia placeat laborum cupiditate. Commodi exercitationem ipsa id numquam voluptas harum ratione. Ex quisquam quas enim ipsa minus enim distinctio aliquid.', '2020-04-08 05:47:47', '2020-05-02 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?34191', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"32.949643\",\"h\":\"-3.168691\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(18, '0', '0', 529668, '2.0', 'debitis ullam commodi', 'blanditiis tempore sit sint vel', 'cupiditate dolores perspiciatis nihil nihil', '', '', '', 'hic soluta ea quod delectus', '', '', 'Ea sunt et iure quia provident. Ipsam excepturi nulla placeat officiis earum quisquam aliquam. Fugiat qui id repudiandae qui consectetur nisi. Sed quasi rerum eos excepturi.', '2020-04-10 05:47:47', '2020-04-20 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?47809', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"72.477531\",\"h\":\"164.940142\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(19, '1', '1', 100313, '5.0', 'nihil enim voluptas', 'quia facere error quis ad', 'modi quia maiores sed eos', '', '', '', 'possimus vel necessitatibus voluptatem aspernatur', 'delectus accusantium quia', 'earum natus quod', 'Et et et alias accusamus dolorem. Eum officiis nihil facere nostrum iusto nobis fugiat nihil. Natus dolore fuga vel ut aut optio. Mollitia voluptatem et ullam dolor repellat id.', '2020-04-11 05:47:47', '2020-04-15 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?33235', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-39.355311\",\"h\":\"129.289644\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(20, '0', '0', 376752, '0.0', 'id neque aut', 'aut officiis cum tenetur sit', 'laudantium magnam ut voluptatum voluptatibus', '', '', '', 'voluptates eum aut sit sunt', '', '', 'Possimus similique illo libero ab non provident neque. Et est quod facere rerum non laudantium. Laboriosam nostrum omnis occaecati ullam recusandae. Totam sequi accusamus et magnam optio aspernatur natus. In quis perferendis aut nihil.', '2020-04-07 05:47:47', '2020-04-24 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?36131', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"37.966059\",\"h\":\"110.170181\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(21, '1', '1', 594576, '0.0', 'quia non repellat', 'unde eum molestias et ut', 'dolores aut optio aut temporibus', 'fugit tenetur et', 'deleniti possimus officia', '', 'eaque quia temporibus qui et', '', '', 'Perferendis temporibus fugit earum voluptatem neque voluptatem dicta iusto. Ut sequi eius distinctio iusto labore saepe. Qui mollitia eos doloribus eaque ipsa.', '2020-04-05 05:47:47', '2020-04-30 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?87604', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"78.082415\",\"h\":\"89.001419\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(22, '0', '0', 577883, '5.0', 'debitis non officia', 'maxime quis aut aut sed', 'quaerat soluta quas illum harum', '', '', 'voluptatem perferendis facere', 'laboriosam molestiae facere ut dolorem', 'soluta incidunt voluptatem', '', 'Eos eum ipsum fugit sunt quis dolores. Modi consequatur voluptas quia a inventore eos debitis. Ratione ipsam laborum dignissimos hic. Tempora commodi aut quo perferendis.', '2020-04-10 05:47:47', '2020-04-29 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?48328', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"35.164996\",\"h\":\"86.478572\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(23, '1', '1', 226534, '1.0', 'quod cumque nihil', 'sit esse fugit ut qui', 'dolores nesciunt ratione magni libero', '', '', '', 'numquam nihil sapiente et quisquam', '', '', 'Magni commodi est voluptatem asperiores sapiente. Velit consequatur aperiam quia. Fuga numquam illum quas accusamus. Accusamus perspiciatis aut est aspernatur.', '2020-04-03 05:47:47', '2020-04-26 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?51386', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-52.757402\",\"h\":\"159.392493\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(24, '0', '0', 477471, '1.0', 'voluptate porro et', 'non molestiae facilis nemo eligendi', 'sed ducimus culpa magnam voluptatum', '', '', '', 'illum voluptas commodi repellat nobis', '', '', 'Et dolorum quo mollitia voluptates numquam quasi vel atque. Aut occaecati rem dolorem autem sunt quo.', '2020-04-06 05:47:47', '2020-04-18 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?27014', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"55.882103\",\"h\":\"-35.492638\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(25, '1', '1', 503923, '2.0', 'officiis quam quis', 'reiciendis tempora magni recusandae nobis', 'dolorem autem assumenda facere et', 'quaerat aut accusamus', '', '', 'ut doloribus ut dolor eos', 'veniam dolor minima', '', 'Eveniet suscipit iusto tempore cum sint doloribus. Ut facere occaecati deleniti accusamus qui voluptas. Totam est consequatur sint consequatur sapiente eos rerum.', '2020-04-06 05:47:47', '2020-04-28 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?38702', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"19.072907\",\"h\":\"151.863164\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(26, '0', '0', 366317, '5.0', 'rem quas ab', 'excepturi aut voluptates quis id', 'consequuntur et quaerat voluptate officia', '', 'velit eos et', '', 'perferendis voluptatem laudantium totam voluptate', '', '', 'Aut quam modi minima qui ad at qui. Facere ut omnis facilis eos dicta quia magnam. Aut aut adipisci occaecati et vero voluptatum. Itaque harum harum quo eum eaque.', '2020-04-04 05:47:47', '2020-04-27 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?20245', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-41.802741\",\"h\":\"-114.42662\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(27, '1', '1', 134994, '5.0', 'recusandae ut ratione', 'qui quia autem pariatur ut', 'ut occaecati quam beatae adipisci', '', '', '', 'et voluptas beatae aut perspiciatis', '', '', 'Ipsam unde unde odit velit. Voluptatem aliquam ipsa deserunt deserunt voluptatem delectus. Nihil sapiente molestiae velit.', '2020-04-09 05:47:47', '2020-04-17 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?59283', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"50.970873\",\"h\":\"88.166759\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(28, '0', '0', 436178, '3.0', 'iure non cum', 'eligendi delectus ea commodi facilis', 'expedita possimus beatae dignissimos rem', '', '', '', 'ullam tempora labore fugit aut', 'eum harum quod', 'voluptas exercitationem maiores', 'Et velit ratione cumque velit modi recusandae. Corporis voluptatem occaecati soluta ut et eos. Et ratione qui dolorem doloremque aut eligendi.', '2020-04-03 05:47:47', '2020-05-01 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?32539', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"0.943953\",\"h\":\"-5.294001\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(29, '1', '1', 559340, '5.0', 'quae illo sapiente', 'deserunt non numquam eveniet nisi', 'et sequi eos quis reprehenderit', 'quia neque laudantium', '', 'quaerat corrupti in', 'et nisi vel a tempore', '', '', 'Tenetur doloribus ipsam adipisci neque nostrum voluptates voluptas. Id dolorem quia labore quia occaecati est a. Quasi aut id modi ad libero delectus at. Iste necessitatibus non ipsum fuga non beatae corrupti non.', '2020-04-05 05:47:47', '2020-04-30 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?44826', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"-6.014307\",\"h\":\"65.337772\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL),
(30, '0', '0', 317389, '0.0', 'maxime facilis ut', 'vel est fugiat doloribus porro', 'tempora expedita explicabo illo ea', '', '', '', 'incidunt magnam quas provident facilis', '', '', 'Molestiae at sit odit beatae. Fugiat omnis sit ut voluptas. Facilis non ipsam modi doloremque neque enim culpa. Accusantium quidem sequi veniam eveniet itaque aut.', '2020-04-07 05:47:47', '2020-04-18 05:47:47', 'https://lorempixel.com/gray/720/444/cats/Faker/?94639', '[\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\",\"http:\\/\\/retreat-guru.loc\\/public\\/assets\\/site\\/images\\/home_bg_new.jpg\"]', '[{\"w\":\"25.105905\",\"h\":\"152.119535\"}]', '2020-04-12 05:47:47', '2020-04-12 05:47:47', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tour_leader`
--

CREATE TABLE `tour_leader` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `leader_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tour_user`
--

CREATE TABLE `tour_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tour_user`
--

INSERT INTO `tour_user` (`id`, `user_id`, `tour_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 1, 27),
(28, 1, 28),
(29, 1, 29),
(30, 1, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `tour_variant`
--

CREATE TABLE `tour_variant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_people` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Размер группы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tour_variant`
--

INSERT INTO `tour_variant` (`id`, `tour_id`, `price`, `excerpt`, `img`, `group_people`) VALUES
(1, 1, 101859, 'Voluptas nihil blanditiis ut beatae quis. Quos ea occaecati a qui ut reprehenderit voluptatem. Possimus et eos aut voluptatem rerum vitae omnis. Repellat dicta ea incidunt.', 'https://lorempixel.com/640/480/?93349', '22'),
(2, 1, 57582, 'Dolor maxime voluptatum nulla ab. Velit asperiores alias eaque libero qui. Quod quis explicabo aliquid mollitia nesciunt. Rem ut eum esse tenetur natus minus. Voluptatem suscipit voluptatem reprehenderit quod id id rerum distinctio.', 'https://lorempixel.com/640/480/?63517', '4'),
(3, 1, 47301, 'Et voluptatem ut error ex eligendi vel qui. Iusto natus deleniti doloribus eum voluptatum a.', 'https://lorempixel.com/640/480/?84201', '16');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('','m','w') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `gender`, `birth_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Сергей Смирнов', 'developer.00@list.ru', '2020-04-12 05:47:43', '$2y$10$nNbxY.CMTTcrbc2noPcjFePkWfA7VIFjHVqaBphHOEoYFHwcikA/W', '1drm2d2m9l75JNJb9eGxgVSbB6P6LEBW4zUCTztWcczoFENyS0fnJWpVhEKv', 'm', '1973-09-15 21:00:00', NULL, '2020-04-12 05:47:43', NULL),
(2, 'Кузьминaа Злата Владимировна', 'ksuvorova@example.org', '2020-04-12 05:47:43', '$2y$10$C7dxZTXtOOALwB8wB2zf/uRY7OzITxY1xojrZ4SgmCjUTD1RFlP3m', 'dLaF96MsIUAMHgDxuOWY4D9xrDs4OVjUs6ZQff0n6qVKsMH4kboeoU8FSZOX', 'm', '2015-10-04 21:00:00', NULL, '2020-04-12 05:47:43', NULL),
(3, 'Беляевa Пётр Романович', 'emma28@example.com', '2020-04-12 05:47:43', '$2y$10$WwWGCNvpJMVwe1WgX.cRbuICPtEZK/ukyYVPwHsIlE20x/aMlG/Zm', 'zsJ4V2iilqiM559au8zDxaGHEksK776Uqzw55lD11vunikCokIOWzyIf8NYe', 'm', '2016-11-04 21:00:00', NULL, '2020-04-12 05:47:43', NULL),
(4, 'Лада Фёдоровна Лобанова', 'zykov.ulia@example.net', '2020-04-12 05:47:43', '$2y$10$/mxuzUBLsPAMIGABDamWvOm3XFTagTjk3bTBq8aTFzWUG3WMTpG4S', 'TGrijImNEqzS9GD6', 'w', '2001-09-11 20:00:00', NULL, '2020-04-12 05:47:43', NULL),
(5, 'Людмила Ивановна Фадеева', 'maksimov.izabella@example.com', '2020-04-12 05:47:43', '$2y$10$GP.vt5Csbr/edN9Bgv5r7.SsCDbOHMpqCLnIl.mFX9L3B8XHB82.a', 'ukYYxod5GePOIPe3', 'm', '1975-05-30 21:00:00', NULL, '2020-04-12 05:47:43', NULL),
(6, 'Мария Владимировна Гаврилова', 'kornilov.anfisa@example.org', '2020-04-12 05:47:43', '$2y$10$4wY8N9jUHIiW/kG4PIu95eWciO8d8wt18WeUTXRUdWdIChCcTyXQa', 'QpUgl7WcXciatVlw', 'm', '2012-07-10 20:00:00', NULL, '2020-04-12 05:47:43', NULL),
(7, 'Давыдовaа Алиса Владимировна', 'molcanova.rada@example.com', '2020-04-12 05:47:43', '$2y$10$hWO02QSinDrWp2IjN4N5Ru2EktceD4f7j5f8axX.TtojrEYJO/j5i', 'gQoIyWUcVnWFlDP6', 'w', '1982-08-27 20:00:00', NULL, '2020-04-12 05:47:43', NULL),
(8, 'Анисимов Ананий Владимирович', 'akovleva.konstantin@example.net', '2020-04-12 05:47:43', '$2y$10$8g8NtzWSlaK4uWCW7VXT4eI4XAYQoUV6OV2GOMMCZ8AOWjamvxtIe', 'HWnUtLWxcwpd7L6v', 'm', '2003-05-01 20:00:00', NULL, '2020-04-12 05:47:43', NULL),
(9, 'Клим Алексеевич Зайцев', 'fbirukov@example.com', '2020-04-12 05:47:43', '$2y$10$RxH7Z9S/j6shFiT8tVlO0uJ2pN3TToffFNlO7Txp9iswyPSKIHNeq', 'OiR2ZVOX2InCirG7', 'm', '1988-06-12 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(10, 'Потаповaа Владлена Львовна', 'mzdanova@example.com', '2020-04-12 05:47:44', '$2y$10$oap5obolJTk.uf/MbrUgauf5jB8xHYIVFYdTwNNK5/7qydJr4nTf2', 'RRGQpvPzKw2Uyu1L', 'w', '1995-06-29 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(11, 'Игнатьевaа Василиса Дмитриевна', 'strelkova.zoa@example.com', '2020-04-12 05:47:44', '$2y$10$VBlrVoyon3I3iSvcsQpRzeH4SYTdXvA2Ic9aaFmgvED5sJ4Te.UEy', 'FGJRsA8p5ouFIowl', 'm', '1987-01-07 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(12, 'Денис Романович Брагинa', 'pavel.orlova@example.org', '2020-04-12 05:47:44', '$2y$10$z4Yshnz8jXkPOj6SpVLyuu7Fv3TUlwLnvMXWbnelevDcd2HHx/7pS', 'EPC3xIXtnBlsq6eF', 'm', '1986-08-27 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(13, 'Осипова Евгения Евгеньевна', 'kudravcev.kuzma@example.com', '2020-04-12 05:47:44', '$2y$10$lgT1PHqp35wNxfNj2stfPed1MmDDlx76F7z1fQFltG2L0Q4QNxYGK', 'zvSXuzOfbuNIDdM4', 'w', '2018-04-09 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(14, 'Борисов Илья Львович', 'vladislav37@example.net', '2020-04-12 05:47:44', '$2y$10$JsNqF8AOQvY1K/3UpPja6ulRFkZzq3chMeh17Z64cuVixHb/Ve/Iu', 'i9kPL67MEFZvXLkQ', 'm', '1999-08-13 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(15, 'Витольд Борисович Горбачёвa', 'pmaksimova@example.net', '2020-04-12 05:47:44', '$2y$10$3OvmDIeaPlLSYGdXPSFNJeuaS5d9NHUIMkCP42I8zzRjGYVve5X8G', 'IHPUML0GhIO04uYf', 'm', '2006-11-23 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(16, 'Марина Сергеевна Комаровaа', 'gennadij.martynov@example.net', '2020-04-12 05:47:44', '$2y$10$e9aWvUr/2HxzMJk8YP6jZe0RbklzSyXYfIIl7apNF3VDa5cHxywZO', '7lkVkpqmyVUpuGDa', 'w', '1991-11-20 22:00:00', NULL, '2020-04-12 05:47:44', NULL),
(17, 'Ефремовa Добрыня Иванович', 'kostin.nazar@example.net', '2020-04-12 05:47:44', '$2y$10$dIYBO1nZkWyd1Jo.EyPN/.rwtoB2RrmBO/MlH/jsM9ymnWb5ziO5e', 'JE4XJyox5GKdLVjz', 'm', '2005-10-30 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(18, 'Панфилова Ульяна Сергеевна', 'innokentij.dementeva@example.org', '2020-04-12 05:47:44', '$2y$10$eiRRAzRYPIZ9QjbLcEvMDehws79WFecCcUHeNZ/74RiFRWYj.l4.q', '6FPExyQn8fnDe98h', 'm', '1988-10-14 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(19, 'Ульяна Александровна Галкина', 'maksim.rybakova@example.org', '2020-04-12 05:47:44', '$2y$10$rICvB98YzXMge99i2JxS5.W82It82obYyLRjHF1bJpDMYXnldX.sO', 'UXkhBs2dOpytstHd', 'w', '1988-08-09 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(20, 'Жанна Андреевна Мухинaа', 'mamontov.viktor@example.org', '2020-04-12 05:47:44', '$2y$10$YdIewTJBSd8wE5sHQPeZJuAL6WfadyyhiiOdLjbiGwujlSUFopJ8m', 'oQJNSGBp7AetnGqb', 'm', '1981-12-21 21:00:00', NULL, '2020-04-12 05:47:44', NULL),
(21, 'Назар Борисович Тетерин', 'gulaev.donat@example.com', '2020-04-12 05:47:44', '$2y$10$c8iTf/RJF9fhpKLPWRfQB.8TVqV/pJFRHNCt6n6nHst5LbZ8Q65fe', 'aj3SmYN6lOEF3xVX', 'm', '1993-08-02 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(22, 'Калинин Георгий Борисович', 'pavel11@example.org', '2020-04-12 05:47:44', '$2y$10$aTzrUy3P.SOh9VmdeP8K.O1BmBzzKOrBr2cGfbW.y8BbIzL/Uuo..', 'CRlwP6ov4bHpE2cU', 'w', '1999-07-25 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(23, 'Гусева Дарья Ивановна', 'kuzma.kulikov@example.net', '2020-04-12 05:47:44', '$2y$10$k0W8it2VTNdCMRZrliUUtO6l44pyniaibS6k8obkTHLNuT6PnA1Vu', 'GyliwOZwsT9vfeww', 'm', '1990-06-16 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(24, 'Олеся Максимовна Морозова', 'voronov.sofia@example.com', '2020-04-12 05:47:44', '$2y$10$d.6PT/gzlBIloeokShmiTuZ/wxT2VHiIu.8Au4e85LrOXdSTFcBjK', 'BUjXDLwk9NqkIINH', 'm', '1996-08-23 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(25, 'Ершовa Бронислав Борисович', 'xvlasova@example.org', '2020-04-12 05:47:44', '$2y$10$EBzvSdggNrupLUfmmGgGaOTgPQpMJ9yG8WYPLcdLcteq1xPlYcloS', 'r0dAgavFekbrRzqA', 'w', '1996-04-22 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(26, 'Зоя Романовна Новикова', 'svatoslav17@example.com', '2020-04-12 05:47:44', '$2y$10$LDx80w0MCBFF181ptnCSF.5WK.rXfs4MHhYkNsKjm79pdaFSdogca', '1j15aP80AFSvkdBE', 'm', '1987-04-17 20:00:00', NULL, '2020-04-12 05:47:44', NULL),
(27, 'Лыткинa Дан Дмитриевич', 'antonin.lazarev@example.net', '2020-04-12 05:47:44', '$2y$10$5Ao4aT4jEe4g5Bvo1LgtoObdX9sskdsO.mAwobs/dV/4IFeKjAGl.', '30DUr8bDtxtFPML1', 'm', '1983-06-29 20:00:00', NULL, '2020-04-12 05:47:45', NULL),
(28, 'Архиповa Аполлон Борисович', 'sofa20@example.org', '2020-04-12 05:47:45', '$2y$10$GgHNwutqf9o52SOKjusuxehPVineWPFMCeGmvNPIUqUmP2IZ8/QOW', 'd3tCPOSlkWHnvvX1', 'w', '2008-01-25 21:00:00', NULL, '2020-04-12 05:47:45', NULL),
(29, 'Полина Ивановна Баранова', 'lidia.masnikov@example.org', '2020-04-12 05:47:45', '$2y$10$Duu3muCrexyw7WVOZCNL1uJACqxnA0g/a316J4mqdXHFftGHM5MRu', '2yZFAlrgIdLjZidu', 'm', '1994-04-16 20:00:00', NULL, '2020-04-12 05:47:45', NULL),
(30, 'Зинаида Александровна Пономарёва', 'aleksej40@example.com', '2020-04-12 05:47:45', '$2y$10$eNNUKH9MiM.LUnxAQiIpKuYn6krfWq5glYZzp4okM8P37LO..6eLe', 'PuhZJDbClse7LV5m', 'm', '2011-10-28 20:00:00', NULL, '2020-04-12 05:47:45', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_comments`
--

CREATE TABLE `users_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'кто комментировал',
  `author_id` bigint(20) UNSIGNED NOT NULL COMMENT 'кого комментировал',
  `good` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_comments`
--

INSERT INTO `users_comments` (`id`, `user_id`, `author_id`, `good`, `title`, `comment`, `created_at`, `updated_at`) VALUES
(1, 30, 1, '1', 'fuga accusantium maxime', 'Optio ex adipisci nobis magnam ducimus. Dolorum nihil quo veritatis est ducimus illo neque. Unde mollitia et ea exercitationem autem dignissimos. Vel ea distinctio veniam quo repellat. Impedit non inventore vitae adipisci voluptatem animi. Dicta nisi sunt odio fugit id nemo vero. Non repellat atque nemo nostrum et mollitia laborum. Quia explicabo temporibus perspiciatis amet mollitia aut molestiae. Maxime soluta quo quos ducimus. Consequatur quo voluptas dignissimos. Nihil ipsum numquam voluptatem ipsa reiciendis.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(2, 5, 1, '1', 'sed eum ut', 'Sint est ex qui rerum recusandae iure. Dicta expedita distinctio fugiat voluptas ex. Laudantium repudiandae aut corporis quo quia error. Quae perspiciatis molestiae nulla doloribus. In autem et optio a unde repellendus qui. Quaerat adipisci consequatur consequuntur molestiae ratione ad. Veritatis dolores eos unde itaque voluptatem ut. Harum quibusdam tenetur assumenda. Ex aut et magnam magni minima quo.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(3, 7, 1, '1', 'illum molestias modi', 'Rem consequatur earum tempore voluptate pariatur provident debitis. Autem quibusdam sit voluptas. Dolor dolorem esse rerum autem dolores eum fugiat. Non possimus nulla quia possimus. Similique eos id veniam ut consequatur quibusdam. Laborum ut dolore ullam vel id ipsa et. Atque ipsam nisi est ut qui id qui praesentium. Omnis voluptate quos accusantium esse et molestiae. Asperiores adipisci aliquid et ut nam sapiente nisi. Illo sint rerum sed asperiores et rerum amet.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(4, 27, 1, '1', 'sit saepe autem', 'Nisi pariatur qui quam molestiae similique. Unde aliquam voluptas et asperiores mollitia. Aut non amet debitis ut non aut sint. Eveniet occaecati aliquid eveniet voluptatum omnis quia. Corporis debitis libero est dolor asperiores est. Saepe aliquid sed quidem eveniet facilis. Qui in autem minima in dolor. Sapiente minima numquam iure qui corrupti. Minima magnam ut qui dolorum et expedita. Omnis excepturi soluta et natus asperiores.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(5, 3, 1, '1', 'velit alias aperiam', 'Unde quisquam odio labore animi. Minus repudiandae sequi neque doloribus. Omnis dolor in iure cupiditate est blanditiis. Nobis qui dolor sed dolor sit optio. Et fuga facere officia sunt. Eligendi dignissimos magni molestiae. Rerum velit aspernatur labore nihil. Laudantium non quod voluptatem consequuntur officiis eius. Dolorem hic qui odit distinctio.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(6, 11, 1, '1', 'recusandae fugiat eum', 'Velit dolor labore et ut quibusdam. Eius quas ex aut id quam. Deserunt dicta soluta reiciendis nobis et hic id. Sed veritatis voluptatem similique possimus aut. Facere impedit eos nihil eveniet voluptatum. Ullam sit sit et et dicta. Eligendi aperiam dolores animi et voluptas asperiores. Doloribus ex praesentium laudantium rerum sapiente sit nam. Quisquam accusantium sed est nobis harum a exercitationem. Molestiae sapiente sunt aut.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(7, 7, 1, '1', 'accusantium quia ut', 'Suscipit eum voluptatibus quaerat aliquid. Aut vel alias impedit ea. Beatae nemo officia unde molestiae culpa corrupti sed. Possimus voluptas est praesentium sed ut eveniet aliquam ullam. Delectus sed dolores quis et nihil. Occaecati sed soluta at. Nostrum blanditiis voluptatem voluptas ipsum dolores exercitationem aut. Ab quia fuga officia dolorem voluptatibus sed sunt non. Architecto totam dolorum illum velit quis. Maiores quis similique modi quae quibusdam. Corporis fuga molestiae sit vitae odio explicabo. Unde neque molestias corporis aut sapiente dicta.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(8, 1, 1, '1', 'in officia quia', 'Vel repellat aliquam ut illo exercitationem harum sed illo. Quia id vel consectetur minus adipisci animi est. Consequuntur quod dolor corrupti et dicta. Cupiditate libero natus earum voluptas quaerat alias aut. Error molestiae ea quia accusantium voluptatem dignissimos. Quo temporibus quia rerum aliquam. Libero in laboriosam et alias. Qui reiciendis neque voluptatibus. Occaecati quasi rerum et reiciendis temporibus quisquam illum consequuntur. Aut eligendi vel sed nemo sit repudiandae. Et quos velit debitis tenetur quis eaque voluptatibus. Qui ducimus ratione rem. Tempora itaque incidunt temporibus sint rem veniam ipsa. Aut nostrum iste facilis et impedit voluptas debitis.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(9, 18, 1, '1', 'aut quia occaecati', 'Voluptates suscipit voluptatem et eligendi eos. Ad quia itaque architecto et ea. Iste dicta voluptas ipsa dolorem quibusdam eius earum. Eaque et vel velit id quis. Doloremque et quibusdam adipisci earum qui nam. Est ut harum sed vero quae iure rem. Aut numquam et voluptas aspernatur. Nesciunt aut sed est sit at. Deleniti qui possimus a alias tempore non cum. Omnis et aut magnam voluptatem eum autem est.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(10, 9, 1, '1', 'adipisci nesciunt quia', 'Mollitia cupiditate voluptatum quae qui nam. Et ut aliquid iusto cumque. Esse incidunt laborum eos accusantium similique quae est. Excepturi deleniti et eum. Nesciunt ut quas expedita rerum quod. Dicta ipsum labore qui corporis. Vel dolore quaerat laudantium adipisci harum et iure quo. Cumque tenetur maxime temporibus distinctio voluptas consequatur commodi. Omnis nesciunt eum quia rerum.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(11, 3, 1, '1', 'sapiente facilis qui', 'Nemo perspiciatis voluptatem aut et quo. Sunt eius ut labore qui. Sed distinctio sit hic. Ab officiis consequatur veniam et odit. Recusandae rem qui sit praesentium et ea. Eum ipsam commodi eius. Sed dicta facere dolores. Sequi voluptatem magnam alias est. Dicta dolore ea nam. Saepe id quasi consequatur.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(12, 12, 1, '1', 'impedit soluta facere', 'Officiis sint in aspernatur minima aliquid. Id harum repellat vitae. Nesciunt earum cum dignissimos velit earum. Beatae dignissimos eligendi et nobis minus ut beatae. Sit eaque quo sit quo impedit dicta et. Et eius blanditiis et saepe quod voluptatem laborum. Ipsa modi qui qui excepturi voluptatem voluptatem harum.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(13, 1, 1, '1', 'quia qui ut', 'Sit fuga corrupti accusantium. Dolores ut dolores vel iusto sunt quia. Molestiae est possimus dolorum et adipisci. Itaque dolor incidunt repudiandae odit nam. Aperiam perferendis explicabo repudiandae voluptates culpa voluptas. Eum dolore eius in ab provident quia. Consequatur mollitia neque blanditiis officiis non dolores quia laborum. Perferendis itaque quod dolorem eligendi. Adipisci vitae suscipit harum quo neque enim.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(14, 3, 1, '1', 'est dolor vel', 'Eos reiciendis est itaque eveniet vero harum id. Dolores voluptas qui asperiores suscipit consectetur. Libero consequatur deleniti minima adipisci ipsum culpa quia. Illum error quasi quas accusantium. Omnis quo culpa id dolore exercitationem. Eius voluptatum sit minus modi. Ut iure praesentium omnis qui tempora. Exercitationem aspernatur corrupti aut. Quos blanditiis magnam unde reprehenderit. Voluptatem laudantium aspernatur atque odit excepturi. Est consequuntur nulla dicta provident sed. Inventore sed eum et. Ipsum qui facilis magni repudiandae quas voluptatum debitis asperiores.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(15, 1, 1, '1', 'omnis explicabo est', 'Placeat debitis delectus necessitatibus. Est eaque rerum sequi nihil assumenda. Tenetur voluptas et tenetur vero numquam. Inventore architecto voluptas architecto sed quae. Harum numquam recusandae eum repellendus adipisci nobis. Suscipit qui tempore voluptatem sed sunt voluptates mollitia. Recusandae dolorem laudantium error eos saepe voluptatem. Sit repellendus adipisci vel adipisci.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(16, 26, 1, '1', 'nobis molestiae nihil', 'Voluptas dolore delectus et quia. Sequi quod excepturi fuga aut quibusdam minima. Quisquam quia modi et culpa. Dolor id perferendis quos aut. Est impedit commodi non soluta sit ipsum molestias. Et laboriosam facilis amet qui. Voluptas non amet qui ad aut ut incidunt incidunt. Occaecati accusantium aut amet ea deserunt autem. Omnis mollitia eum consequatur quis. Quia eius ab dicta molestiae eos at. Praesentium suscipit quisquam saepe sed omnis molestias quas. Error possimus facere adipisci reprehenderit earum qui. Asperiores reprehenderit eaque labore pariatur dolores nam. Laborum veritatis cum sed officia.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(17, 10, 1, '1', 'similique repellat incidunt', 'Ipsum sed eaque eligendi et repudiandae. Et aspernatur deserunt possimus quia autem. Fugit officia eos non neque. Error eligendi impedit aut veritatis. In nemo commodi tenetur quod delectus quis quas dolorem. Id consequuntur dolorum et dignissimos laborum dolores. Quia enim placeat minus hic officia ut odit. Nobis ut delectus sunt esse perferendis reprehenderit iusto. Dolore consequuntur sunt iusto voluptatem sequi alias consectetur. Et pariatur labore sunt fugiat. Voluptatibus id expedita architecto excepturi aliquid.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(18, 30, 1, '1', 'nostrum deleniti earum', 'Sit consequatur modi nobis sunt neque magni aperiam. Dolorum tempore aut ut. Sint quia molestias adipisci esse. Deserunt quae aliquam sed. Laborum ad consequatur quis corrupti qui commodi. Ex expedita itaque maxime et est molestias. Vel ea quaerat voluptatibus. Facilis tempora explicabo sit quasi voluptates sit. Ut ut nulla aperiam atque. Nisi officiis commodi veritatis eaque vel. Necessitatibus temporibus quia aliquam illum voluptatum sequi. Sint voluptatem quia ab libero accusantium non est.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(19, 8, 1, '1', 'suscipit esse sed', 'Facilis blanditiis illum non. Autem beatae aspernatur nemo rerum exercitationem. Voluptatibus quia explicabo est odit neque nobis impedit. Rerum qui consequatur delectus quia iste. Iste doloribus sit ut quo. Et dolore est ullam est quis enim odio earum. Sed qui ea nam veritatis. Quia eos corporis ea aut sint voluptatem voluptatem. Ea sed sint cupiditate ipsum culpa id.', '2020-04-12 05:47:49', '2020-04-12 05:47:49'),
(20, 17, 1, '1', 'est ipsa sit', 'Repudiandae delectus est ut ut. Qui et repellendus maiores. Repellendus quod vel culpa consectetur. Maiores explicabo eos velit natus aliquid rerum animi assumenda. Soluta est molestias velit fugit et asperiores et esse. Consequuntur mollitia exercitationem suscipit asperiores velit. In qui voluptatem alias est impedit sit provident explicabo.', '2020-04-12 05:47:49', '2020-04-12 05:47:49');

-- --------------------------------------------------------

--
-- Структура таблицы `user_subscribe_tour`
--

CREATE TABLE `user_subscribe_tour` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `tours_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `voteds`
--

CREATE TABLE `voteds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `who_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'кто оценил',
  `for_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'кого оценил'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carencies`
--
ALTER TABLE `carencies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_posts`
--
ALTER TABLE `category_posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_tours`
--
ALTER TABLE `category_tours`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_tour_tour`
--
ALTER TABLE `category_tour_tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_tour_has_tour_category_tour1_idx` (`category_tour_id`),
  ADD KEY `fk_category_tour_has_tour_tour1_idx` (`tour_id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_discounts_tour_idx` (`tour_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `optional_fields`
--
ALTER TABLE `optional_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `organizer_leader`
--
ALTER TABLE `organizer_leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_organizer_leader_leader_idx` (`leader_id`),
  ADD KEY `fk_organizer_leader_organizer_idx` (`organizer_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_category_post1_idx` (`category_post_id`),
  ADD KEY `fk_posts_user2_idx` (`user_id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profile_user_idx` (`user_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tour_leader`
--
ALTER TABLE `tour_leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tour_leader_tour_idx` (`tour_id`),
  ADD KEY `fk_tour_leader_leader_idx` (`leader_id`);

--
-- Индексы таблицы `tour_user`
--
ALTER TABLE `tour_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_tours_user1_idx` (`user_id`),
  ADD KEY `fk_users_has_tours_tour1_idx` (`tour_id`);

--
-- Индексы таблицы `tour_variant`
--
ALTER TABLE `tour_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test_tour_idx` (`tour_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_comments`
--
ALTER TABLE `users_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_comments_user_idx` (`user_id`),
  ADD KEY `fk_users_comments_author_idx` (`author_id`);

--
-- Индексы таблицы `user_subscribe_tour`
--
ALTER TABLE `user_subscribe_tour`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `fk_users_has_tours_tours2_idx` (`tours_id`),
  ADD KEY `fk_users_has_tours_users2_idx` (`users_id`);

--
-- Индексы таблицы `voteds`
--
ALTER TABLE `voteds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_users_users1_idx` (`who_user_id`),
  ADD KEY `fk_users_has_users_users2_idx` (`for_user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carencies`
--
ALTER TABLE `carencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `category_posts`
--
ALTER TABLE `category_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `category_tours`
--
ALTER TABLE `category_tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `category_tour_tour`
--
ALTER TABLE `category_tour_tour`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT для таблицы `optional_fields`
--
ALTER TABLE `optional_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `organizer_leader`
--
ALTER TABLE `organizer_leader`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `tour_leader`
--
ALTER TABLE `tour_leader`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tour_user`
--
ALTER TABLE `tour_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `tour_variant`
--
ALTER TABLE `tour_variant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users_comments`
--
ALTER TABLE `users_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `user_subscribe_tour`
--
ALTER TABLE `user_subscribe_tour`
  MODIFY `users_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `voteds`
--
ALTER TABLE `voteds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category_tour_tour`
--
ALTER TABLE `category_tour_tour`
  ADD CONSTRAINT `fk_category_tour_has_tour_category_tour1_idx` FOREIGN KEY (`category_tour_id`) REFERENCES `category_tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_category_tour_has_tour_tour1_idx` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `fk_discounts_tour_idx` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `organizer_leader`
--
ALTER TABLE `organizer_leader`
  ADD CONSTRAINT `fk_organizer_leader_leader_idx` FOREIGN KEY (`leader_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_organizer_leader_organizer_idx` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_category_post1_idx` FOREIGN KEY (`category_post_id`) REFERENCES `category_posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_user2_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profile_user_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tour_leader`
--
ALTER TABLE `tour_leader`
  ADD CONSTRAINT `fk_tour_leader_leader_idx` FOREIGN KEY (`leader_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tour_leader_tour_idx` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tour_user`
--
ALTER TABLE `tour_user`
  ADD CONSTRAINT `fk_users_has_tours_tour1_idx` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_tours_user1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tour_variant`
--
ALTER TABLE `tour_variant`
  ADD CONSTRAINT `fk_test_tour_idx` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `users_comments`
--
ALTER TABLE `users_comments`
  ADD CONSTRAINT `fk_users_comments_author_idx` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_comments_user_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user_subscribe_tour`
--
ALTER TABLE `user_subscribe_tour`
  ADD CONSTRAINT `fk_users_has_tours_tours2_idx` FOREIGN KEY (`tours_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_tours_users2_idx` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `voteds`
--
ALTER TABLE `voteds`
  ADD CONSTRAINT `fk_users_has_users_users1_idx` FOREIGN KEY (`who_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_users_users2_idx` FOREIGN KEY (`for_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
