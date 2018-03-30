-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 30 2018 г., 00:18
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id2589914_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Answer`
--

CREATE TABLE `Answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `id_question` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Answer`
--

INSERT INTO `Answer` (`id`, `name`, `correct`, `id_question`) VALUES
(1, 'Otvet', 1, 1),
(2, 'sdgsdg', 1, 2),
(3, 'sdgsdg', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_16_105336_create_Answer_table', 1),
(4, '2017_06_16_105336_create_Question_table', 1),
(5, '2017_06_16_105336_create_Subject_table', 1),
(6, '2017_06_16_105336_create_Topic_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Question`
--

CREATE TABLE `Question` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_topic` int(10) UNSIGNED NOT NULL,
  `mark` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Question`
--

INSERT INTO `Question` (`id`, `question`, `id_topic`, `mark`) VALUES
(1, 'Vopros', 9, 15),
(2, 'sdfsdfdfsdd', 8, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Subject`
--

CREATE TABLE `Subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Subject`
--

INSERT INTO `Subject` (`id`, `name`) VALUES
(5, 'Аналіз вимог до програмного забезпечення'),
(2, 'Бази даних'),
(1, 'Програмування інтернет'),
(4, 'Теорія обчислювальних систем і структур'),
(3, 'Якість програмного забезпечення');

-- --------------------------------------------------------

--
-- Структура таблицы `Topic`
--

CREATE TABLE `Topic` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_subject` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Topic`
--

INSERT INTO `Topic` (`id`, `created_at`, `updated_at`, `name`, `id_subject`, `id_user`) VALUES
(8, '2017-06-29 03:46:06', '2017-08-23 08:20:44', 'asdgasdg', 5, 1),
(9, '2017-08-16 14:51:53', '2017-10-13 09:48:48', 'Testov', 5, 1),
(10, '2017-08-16 14:53:52', '2017-08-16 14:53:52', 'оалвлыокг', 5, 1),
(11, '2017-08-16 17:01:23', '2017-08-16 17:02:01', '789', 4, 2),
(12, '2017-10-13 08:59:15', '2017-10-13 08:59:15', 'jgfhjgk', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `middle_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Александр', 'Новиков', 'Владиславович', 'nester096@gmail.com', '$2y$10$Wgr3z22m34hFredKVw9hbu/.CIjJP/6kvY3h2vKofmP9idgkafj9.', 'ONbwvWt05f1GYifj389kXiVDET05JHVq44t2nuexsSNZiFxWYo3kUQ8zS41a', '2017-06-27 13:27:59', '2017-06-27 13:27:59'),
(2, 'Владислав', 'Новиков', 'Александрович', 'novikov@ua.fm', '$2y$10$y1WiDmmATNk8.hREoGTn8.YaHSzPi4C4iGG2iKxGvYli01phgd22u', 'VKj2n3I6peJcOxa40tL9b6VHxT85vye1ucMRhbJQY3wHA42ng9kbbub7Jf81', '2017-08-16 17:00:59', '2017-08-16 17:00:59');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Subject`
--
ALTER TABLE `Subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_name_unique` (`name`);

--
-- Индексы таблицы `Topic`
--
ALTER TABLE `Topic`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Answer`
--
ALTER TABLE `Answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Question`
--
ALTER TABLE `Question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Subject`
--
ALTER TABLE `Subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Topic`
--
ALTER TABLE `Topic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
