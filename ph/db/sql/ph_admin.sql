-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 20 2015 г., 11:48
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `shopdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
`id` int(6) NOT NULL,
  `parent_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `priority` int(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `parent_id`, `name`, `url`, `description`, `priority`) VALUES
(2, 0, 'Монтажные изделия', 'montazhnye-izdeliya', 'Некое описание каталога', 10),
(3, 2, 'Изолента', 'izolenta', '', 0),
(4, 0, 'Кабель / провод', 'kabel-provod', '', 5),
(5, 2, 'Сальники', 'salniki', '', 0),
(6, 0, 'Всякая всячина', 'ttt', '', 3),
(7, 6, 'Железяки', 'qqqq', '', 0),
(8, 7, 'Гайки', 'q', '', 0),
(9, 7, 'Шурупы', 'b', '', 0),
(20, 7, 'Шайбы', 'shaybi', '', 1),
(21, 0, 'Модульное оборудование', 'modulnoe-oborudovanie', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ph_exchange_rates`
--

CREATE TABLE IF NOT EXISTS `ph_exchange_rates` (
  `currency` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ph_exchange_rates`
--

INSERT INTO `ph_exchange_rates` (`currency`, `name`, `value`) VALUES
(1, 'BYR', 1),
(2, 'USD', 18344),
(3, 'RUB', 257.67);

-- --------------------------------------------------------

--
-- Структура таблицы `ph_user`
--

CREATE TABLE IF NOT EXISTS `ph_user` (
`id` int(6) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(4) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ph_user`
--

INSERT INTO `ph_user` (`id`, `login`, `password`, `name`, `role`) VALUES
(1, 'admin', '57a0dcf0dcbd9050f8bc9919f11f111e', 'admin', 2);

--
-- Структура таблицы `special_offer`
--

CREATE TABLE IF NOT EXISTS `special_offer` (
  `catalog_id` int(6) NOT NULL,
  `product_id` int(6) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catalog`
--
ALTER TABLE `catalog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ph_exchange_rates`
--
ALTER TABLE `ph_exchange_rates`
 ADD PRIMARY KEY (`currency`);

--
-- Indexes for table `ph_user`
--
ALTER TABLE `ph_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_offer`
--
ALTER TABLE `special_offer`
 ADD PRIMARY KEY (`catalog_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ph_user`
--
ALTER TABLE `ph_user`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
