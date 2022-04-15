-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Апр 13 2022 г., 23:31
-- Версия сервера: 8.0.28-0ubuntu0.20.04.3
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `attestationproject`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `date`) VALUES
(1, 'Машина', '2022-04-13 19:54:57');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `patronymic` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_role` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `lastname`, `patronymic`, `id_role`) VALUES
(34, 'sfdghgfdhgh', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'fajyr@mailinator.com', 'ваыпавппавы', 'авпрвпар', 'паврправ', 1),
(35, 'gfhgfdhgdhfghfdc', '465b37dc825ac5346608099a6afa8092', 'fdgfdgfdgs@mailinator.com', 'вапавпрвпрар', 'паввпрправ', 'авырпра', 1),
(36, 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 1),
(37, '123456', '465b37dc825ac5346608099a6afa8092', 'sdfgsdgf@gmail.com', 'аврппаврпавр', 'праврпавар', 'паврправправ', 2),
(38, 'gfdhgfdhghdf', '465b37dc825ac5346608099a6afa8092', 'dimassdfsds9689@gmail.com', 'паврвпарправ', 'апрврпвправ', 'прврпавпрв', 1),
(39, 'fdgdsgfdsgsd', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'nava1enyj@mailinator.com', 'вапыавпыав', 'ываппыавыпва', 'ываппывапыв', 1),
(40, 'sdfggsdfgsd', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'nava1enyj@gmail.com', 'ывпаыпвав', 'ывпапаывпвы', 'авпыпыпва', 1),
(41, 'admin', 'e020590f0e18cd6053d7ae0e0a507609', 'admin11@gmill.com', 'Админ', 'Админ', 'Админ', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ix_category_name` (`name`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ix_users_login` (`login`),
  ADD UNIQUE KEY `ix_users_email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
