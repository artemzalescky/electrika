-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 26 2015 г., 16:16
-- Версия сервера: 5.6.20
-- Версия PHP: 5.5.15

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
`id` int(6) NOT NULL,
  `parent_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `priority` int(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

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
(12, 0, 'Труба ПНД', 'truba-pnd', 'Мы продаём самые свежие кабеля в Минске', 0),
(13, 1, 'АВВГ', 'avvg', '', 0),
(14, 1, 'ВВГ', 'vvg', '', 0),
(15, 1, 'ПВС', 'pvs', '', 0),
(16, 1, 'ШВВП', 'shvvp', '', 0),
(17, 1, 'АВБШВ', 'avbshv', '', 0),
(18, 1, 'РКГМ', 'rkgm', '', 0),
(19, 1, 'СИП', 'sip', '', 0),
(20, 1, 'КГ', 'kg', '', 0),
(21, 1, 'АПБпп', 'apbpp', '', 0),
(22, 1, 'КСПВ', 'kspv', '', 0),
(23, 1, 'RG, PK', 'rg-i-pk', '', 0),
(24, 1, 'ВВГ нг', 'vvg-ng', '', 0),
(25, 1, 'ВВГ НГ-LS', 'vvg-ng-ls', '', 0),
(26, 1, 'ПВ', 'pv', '', 0),
(27, 1, 'ПуГВ', 'pugv', '', 0),
(28, 1, 'ПБВВГ', 'pbvvg', '', 0),
(29, 1, 'UTP', 'utp', '', 0),
(30, 2, 'Vico carmen', 'vico-carmen', '', 0),
(31, 2, 'Vico karre', 'vico-karre', '', 0),
(32, 2, 'Lezard mira', 'lezard-mira', '', 0),
(33, 2, 'Legtand Etika', 'legtand-etika', '', 0),
(34, 2, 'Legrand Valena', 'legrand-valena', '', 0),
(35, 2, 'Legrand Quteo', 'legrand-quteo', '', 0),
(36, 3, 'ЩРн', 'shhrn', '', 0),
(37, 3, 'ЩРв', 'shhrv', '', 0),
(38, 3, 'ЩУРн', 'shhurn', '', 0),
(39, 3, 'ЩУРв', 'shhurv', '', 0),
(40, 3, 'Боксы пластиковые внутренние', 'boksy-plastikovye-vnutrennie', '', 0),
(41, 3, 'Боксы пластиковые наружние', 'boksy-plastikovye-naruzhnie', '', 0),
(42, 3, 'КМПн', 'kmpn', '', 0),
(43, 5, 'Автоматический выключатель EATON', 'avtomaticheskij-vykljuchatel-eaton', '', 0),
(44, 5, 'Дифф. авт. выкл.', 'diff-avt-vykl', '', 0),
(45, 5, 'УЗО', 'uzo', '', 0),
(46, 5, 'ВА 47-29 1Р С', 'va-47-29-1r-s', '', 0),
(47, 5, 'ВА 47-29 2Р С', 'va-47-29-2r-s', '', 0),
(48, 5, 'ВА 47-29 3Р С', 'va-47-29-3r-s', '', 0),
(49, 5, 'ВА 47-100 3Р', 'va-47-100-3r', '', 0),
(50, 5, ' АВДТ-63', 'avdt-63', '', 0),
(51, 5, 'АВДТ 32 1Р', 'avdt-32-1r', '', 0),
(52, 5, ' УЗО ВД-100 2P', 'uzo-vd-100-2p', '', 0),
(53, 5, 'УЗО 4Р', 'uzo-4p', '', 0),
(54, 6, 'Прожектора светодиодные', 'prozhektora-svetodiodnye', '', 0),
(55, 6, 'Лампа накаливания', 'lampa-nakalivanija', '', 0),
(56, 6, 'Теплоизлучатель ', 'teploizluchatel', '', 0),
(57, 6, 'ЛПП', 'llp', '', 0),
(58, 6, 'ДДС', 'dds', '', 0),
(59, 6, 'ЛВО', 'lvo', '', 0),
(60, 6, 'ЛПО', 'lpo', '', 0),
(61, 6, 'ЛБ', 'lb', '', 0),
(62, 6, 'CAB2B', 'cab2b', '', 0),
(63, 6, 'Лампа рефлекторная', 'lampa-reflektornaja', '', 0),
(64, 10, 'Кабель канал', 'kabel-kanal', '', 0),
(65, 10, 'Металлорукав', 'metallorukav', '', 0),
(66, 10, 'Крепёж-клипса', 'krepjozh-klipsa', '', 0),
(67, 10, 'Труба гофрированная', 'truba-gofrirovannaja', '', 0),
(68, 10, '"Промрукав" 2-й замок сосна', 'promrukav-2-j-zamok-sosna', '', 0);

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
(2, 'USD', 18345),
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catalog`
--
ALTER TABLE `catalog`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `ph_user`
--
ALTER TABLE `ph_user`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
