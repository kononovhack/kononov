-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 07 2021 г., 19:00
-- Версия сервера: 5.7.35-cll-lve
-- Версия PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rf6733_eweb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `live`
--

CREATE TABLE `live` (
  `live_id` int(10) UNSIGNED NOT NULL,
  `live_nickname` varchar(50) NOT NULL DEFAULT '',
  `live_name` varchar(50) NOT NULL,
  `live_price` varchar(50) NOT NULL,
  `live_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_actions` (
  `id` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `actor_uuid` varchar(36) NOT NULL,
  `actor_name` varchar(100) NOT NULL,
  `type` char(1) NOT NULL,
  `acted_uuid` varchar(36) NOT NULL,
  `acted_name` varchar(36) NOT NULL,
  `action` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_groups` (
  `name` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_group_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `permission` varchar(200) NOT NULL,
  `value` tinyint(1) NOT NULL,
  `server` varchar(36) NOT NULL,
  `world` varchar(64) NOT NULL,
  `expiry` bigint(20) NOT NULL,
  `contexts` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_messenger` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_players` (
  `uuid` varchar(36) NOT NULL,
  `username` varchar(16) NOT NULL,
  `primary_group` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_tracks` (
  `name` varchar(36) NOT NULL,
  `groups` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `luckperms_user_permissions` (
  `id` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `permission` varchar(200) NOT NULL,
  `value` tinyint(1) NOT NULL,
  `server` varchar(36) NOT NULL,
  `world` varchar(64) NOT NULL,
  `expiry` bigint(20) NOT NULL,
  `contexts` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sale` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `item` varchar(255) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `luckperms_actions`
--
ALTER TABLE `luckperms_actions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `luckperms_groups`
--
ALTER TABLE `luckperms_groups`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `luckperms_group_permissions`
--
ALTER TABLE `luckperms_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luckperms_group_permissions_name` (`name`);

--
-- Индексы таблицы `luckperms_messenger`
--
ALTER TABLE `luckperms_messenger`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `luckperms_players`
--
ALTER TABLE `luckperms_players`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `luckperms_players_username` (`username`);

--
-- Индексы таблицы `luckperms_tracks`
--
ALTER TABLE `luckperms_tracks`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `luckperms_user_permissions`
--
ALTER TABLE `luckperms_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `luckperms_user_permissions_uuid` (`uuid`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `luckperms_actions`
--
ALTER TABLE `luckperms_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `luckperms_group_permissions`
--
ALTER TABLE `luckperms_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT для таблицы `luckperms_messenger`
--
ALTER TABLE `luckperms_messenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `luckperms_user_permissions`
--
ALTER TABLE `luckperms_user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
