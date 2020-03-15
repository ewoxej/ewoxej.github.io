-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 15 2020 г., 14:48
-- Версия сервера: 10.4.8-MariaDB
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lb1itex`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `ID_Category` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`ID_Category`, `name`) VALUES
(0, 'motherboard'),
(1, 'graphic card'),
(2, 'processor'),
(3, 'keyboard'),
(4, 'mouse'),
(5, 'display');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `ID_Items` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `quality` int(11) DEFAULT NULL,
  `FID_Vendor` int(11) NOT NULL,
  `FID_Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`ID_Items`, `name`, `price`, `quantity`, `quality`, `FID_Vendor`, `FID_Category`) VALUES
(0, 'DX 356', 35.99, 5, 1, 2, 5),
(1, 'XV 567', 34.07, 2, 3, 0, 4),
(2, 'Hello', 4.5, 2, 2, 6, 1),
(3, 'World', 15.07, 10, 5, 4, 4),
(4, 'Core i5', 200, 50, 1, 5, 2),
(5, 'core i3', 150, 35, 1, 5, 2),
(6, '900 GTX', 320, 10, 1, 0, 1),
(7, 'Athlon II', 100, 23, 4, 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `vendors`
--

CREATE TABLE `vendors` (
  `ID_Vendors` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `vendors`
--

INSERT INTO `vendors` (`ID_Vendors`, `name`) VALUES
(0, 'Asus'),
(1, 'acer'),
(2, 'samsung'),
(3, 'LG'),
(4, 'dell'),
(5, 'intel'),
(6, 'AMD');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID_Items`),
  ADD KEY `FK_vendors` (`FID_Vendor`),
  ADD KEY `FK_category` (`FID_Category`);

--
-- Индексы таблицы `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`ID_Vendors`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_category` FOREIGN KEY (`FID_Category`) REFERENCES `category` (`ID_Category`),
  ADD CONSTRAINT `FK_vendors` FOREIGN KEY (`FID_Vendor`) REFERENCES `vendors` (`ID_Vendors`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
