-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 26 2015 г., 14:09
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `electrika`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `parent_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `priority` int(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `parent_id`, `name`, `url`, `description`, `priority`) VALUES
(1, 0, 'Кабель и провод', 'kabel-i-provod', 'Мы продаём самые свежие кабеля в Минске', 0),
(2, 0, 'Розетки и выключатели', 'rozetki-i-vykljuchateli', 'Мы продаём самые свежие кабеля в Минске', 0),
(3, 0, 'Корпуса металлические, боксы', 'korpusa-metallicheskie-i-boksy', 'Мы продаём самые свежие кабеля в Минске', 0),
(4, 0, 'Коробки распределительные', 'korobki-raspredelitelnye-raspajachnye', 'Мы продаём самые свежие кабеля в Минске', 0),
(5, 0, 'Модульное оборудование', 'modulnoe-oborudovanie', 'Мы продаём самые свежие кабеля в Минске', 0),
(6, 0, 'Светотехника', 'svetotehnika', 'Мы продаём самые свежие кабеля в Минске', 0),
(7, 0, 'Силовые разёмы', 'silovye-razjomy', 'Мы продаём самые свежие кабеля в Минске', 0),
(8, 0, 'Счётчики', 'schjotchiki', 'Мы продаём самые свежие кабеля в Минске', 0),
(9, 0, 'Стабилизаторы напряжения', 'stabilizatory-naprjazhenija', 'Мы продаём самые свежие кабеля в Минске', 0),
(10, 0, 'Системы для прокладки кабеля', 'sistemy-dlja-prokladki-kabelja', 'Мы продаём самые свежие кабеля в Минске', 0),
(11, 0, 'Аксесуары для монтажа', 'aksesuary-dlja-montazha', 'Мы продаём самые свежие кабеля в Минске', 0),
(12, 0, 'Труба ПНД', 'truba-pnd', 'Мы продаём самые свежие кабеля в Минске', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ph_exchange_rates`
--

CREATE TABLE IF NOT EXISTS `ph_exchange_rates` (
  `currency` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ph_exchange_rates`
--

INSERT INTO `ph_exchange_rates` (`currency`, `name`, `value`) VALUES
(1, 'BYR', 1),
(2, 'USD', 18345),
(3, 'RUB', 257.67);

-- --------------------------------------------------------

--
-- Структура таблицы `ph_user`
--

CREATE TABLE IF NOT EXISTS `ph_user` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ph_user`
--

INSERT INTO `ph_user` (`id`, `login`, `password`, `name`, `role`) VALUES
(1, 'admin', '57a0dcf0dcbd9050f8bc9919f11f111e', 'admin', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
