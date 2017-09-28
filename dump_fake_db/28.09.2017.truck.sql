-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 28 Wrz 2017, 17:50
-- Wersja serwera: 5.7.19-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `truck`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accident_case`
--

CREATE TABLE `accident_case` (
  `id` int(11) NOT NULL,
  `damage_description` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `driver_contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `info_sms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `progress_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `report_late` int(11) NOT NULL,
  `report_rs_time` int(11) NOT NULL,
  `report_nrs_time` int(11) NOT NULL,
  `report_repair_total` int(11) NOT NULL,
  `report_arrival_time` int(11) NOT NULL,
  `report_case_total` int(11) NOT NULL,
  `report_repair_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `accident_case`
--

INSERT INTO `accident_case` (`id`, `damage_description`, `location`, `driver_contact`, `comment`, `info_sms`, `info_mail`, `status`, `progress_color`, `report_late`, `report_rs_time`, `report_nrs_time`, `report_repair_total`, `report_arrival_time`, `report_case_total`, `report_repair_status`, `vehicle_id`, `time_start`) VALUES
(1, 'opis uszkodzenia edit', 'lokacja w miescie edit', 'kontakt do kierowcy 444 555 555', 'zwykly komentarza', 'edit', 'edit', 'inactive', '#E6E6E6', 11, 0, 666, 0, 0, 0, 'completed', 1, NULL),
(2, 'opis2 uszkodzenia2', 'lokacja w miesci22e', 'kontakt do kie22rowcy 444 555 555', 'zwykly22 komentarza', NULL, NULL, 'inactive', '#E6E6E6', 123, 0, 0, 0, 0, 0, 'completed', 1, NULL),
(3, 'sdfsfd', 'sdfs', 'sdf', 'empty comment', 'sdfs', 'dsf', 'inactive', '#E6E6E6', 0, 1111, 0, 0, 0, 0, 'completed', 1, NULL),
(4, 'damage description', 'warsaw', 'jan99999999', 'start case', 'empty', 'empty', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'completed', 3, NULL),
(6, 'po prostu awarisa', '333w mieście', 'jan jankowski 123 456 789', 'zgloszenie awarii', 'brak', 'brak', 'inactive', '#E6E6E6', 0, 0, 0, 33, 33, 33, 'completed', 11, NULL),
(7, 'sagds', 'sd', 'sdg', 'sdg', 'sdg', 'sdg', 'inactive', '#E6E6E6', 0, 0, 11, 0, 0, 0, 'completed', 2, NULL),
(15, 'wer', 'wer', 'wer', 'werwerwrewrr', 'wer', 'wer', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'completed', 13, NULL),
(16, 'new date test', 'new date test', 'new date test', 'new date test', 'new date test', 'new date test', 'inactive', '#E6E6E6', 0, 0, 14335, 14335, 0, 57625, 'completed', 6, NULL),
(17, 'sedg', 'dsfg', 'dfg', 'dfg', 'dfg', 'dgf', 'inactive', '#E6E6E6', 0, 4834, 0, 4834, 0, 57645, 'completed', 1, NULL),
(18, 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'inactive', '#E6E6E6', 0, 14365, 0, 14365, 0, 54611, 'completed', 1, NULL),
(19, 'sfds', 'sdfsfd', 'sdfsdf', 'asdasd', '2222', 'asfdasdf', 'inactive', '#E6E6E6', 8512, 6012, 0, 6012, 12887, 18902, 'completed', 14, NULL),
(20, 'dsgt', 'ert', 'ert', 'ert', 'ert', 'ert', 'inactive', '#E6E6E6', 90, 4321, 0, 4321, 116, 17263, 'incompleted', 1, NULL),
(21, 'sdfg', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', 'active', '#FF9C42', 12561, 4769, 0, 4769, 0, 17378, 'completed', 1, NULL),
(22, 'new', 'n', 'n edit', 'n case edit detal', 'n', 'n', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'completed', 13, NULL),
(23, 'r', 'r', 'r', 'r', 'r', 'r', 'active', '#93EEAA', 0, 840, 0, 840, 0, 16024, 'completed', 1, NULL),
(27, 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', 'active', '#FF9C42', 0, 0, 0, 0, 0, 0, 'completed', 13, NULL),
(28, 'ff', 'f', 'f', 'f', 'f', 'f', 'inactive', '#E6E6E6', 5, 4, 0, 4, 18, 4432, 'incompleted', 1, NULL),
(29, 'new', 'locat', 'ker 44', 'comment', 'brak', 'brak', 'active', '#E6E6E6', 15, 3, 2, 5, 27, 34, 'completed', 12, NULL),
(30, 'time start', 'time start', 'time start', 'time start', NULL, NULL, 'active', '#E6E6E6', 11, 10, 0, 10, 45, 1709, 'completed', 1, '2017-09-19 13:23:33'),
(31, 'r', 'r', 'r', 'r', 'r', 'r', 'active', '#93EEAA', 0, 0, 0, 0, 0, 0, 'initialization', 1, '2017-09-21 12:08:01'),
(32, 'e', 'e', 'e', 'e', 'ert', 'empty', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 1, 'canceled', 1, '2017-09-21 12:08:32'),
(33, 'd', 'd', 'dd', 'd', 'dfg', 'dgf', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'canceled', 1, '2017-09-21 12:08:56'),
(34, 'rrr', 'rrrrr', 'rrrr', NULL, NULL, 'dfgdfgdfg@pp.pl', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 10180, 'canceled', 2, '2017-09-21 13:21:24'),
(35, 'sdfsdf', 'sdfdsf', 'sdfsdf', 'sdf', NULL, 'sdf', 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 15, 'canceled', 2, '2017-09-27 15:37:57'),
(36, 'eee', 'eeu', 'e33', 'e', NULL, NULL, 'inactive', '#E6E6E6', 0, 0, 444, 0, 0, 1241, 'completed', 13, '2017-09-27 18:57:19'),
(37, 'ewr', 'wer', 'wer', NULL, NULL, NULL, 'active', '#FF7575', 0, 0, 0, 0, 0, 0, 'initialization', 1, '2017-09-27 19:08:52'),
(38, 'dgfdf', 'gdfg', 'dfgdfg', NULL, NULL, NULL, 'active', '#FF7575', 0, 0, 0, 0, 0, 0, 'initialization', 2, '2017-09-28 14:56:07'),
(39, 'wer', 'wer', 'wer', NULL, NULL, NULL, 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 2, 'completed', 2, '2017-09-28 14:56:51'),
(40, 'esgt', 'ert', 'ert', NULL, NULL, NULL, 'inactive', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'incompleted', 3, '2017-09-28 14:58:12'),
(41, 'dsdf', 'sdf', 'sdf', 'sdf', NULL, NULL, 'inactive', '#E6E6E6', 0, 0, 0, 0, 33, 0, 'completed', 2, '2017-09-28 16:32:42'),
(42, 'dfsdf', 'sdf', 'sdf', 'sdf', NULL, NULL, 'inactive', '#E6E6E6', 0, 0, 0, 0, 33, 0, 'completed', 6, '2017-09-28 16:38:04'),
(43, 'dsgf', 'dfg', 'dfg', 'dfg', NULL, NULL, 'active', '#E6E6E6', 0, 0, 0, 0, 0, 12, 'completed', 12, '2017-09-28 16:40:55'),
(44, 'dsgf', 'sdg', 'fff', 'ff', NULL, NULL, 'inactive', '#E6E6E6', 22, 0, 0, 0, 0, 0, 'canceled', 12, '2017-09-28 16:46:43'),
(45, 'USTERKA CHŁODNICY - LEJE SIĘ PŁYN.', 'ZWYKŁE MIASTO, UL. ZWYKŁA 1', 'KIEROWCA JAN 123123', 'OD GODZ. 18:00 POD NUMEREM KIEROWCY DOSTĘPNY BĘDZIE DYSPOZYTOR FIRMY', NULL, NULL, 'active', '#FF9C42', 0, 0, 0, 0, 0, 0, 'initialization', 15, '2017-09-28 17:22:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dealer`
--

CREATE TABLE `dealer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_24h` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_service_car` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_phone_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_phone_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_mail_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_mail_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_comments` text COLLATE utf8_unicode_ci,
  `is_active` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `dealer`
--

INSERT INTO `dealer` (`id`, `name`, `street`, `zip_code`, `city`, `main_phone`, `main_fax`, `main_mail`, `phone_24h`, `phone_service_car`, `alt_phone_1`, `alt_phone_2`, `alt_mail_1`, `alt_mail_2`, `other_comments`, `is_active`) VALUES
(1, 'serwis 1 edit 33', 'ulica', '33-334', 'miasto', '22 3334422', '22 3334422', 'mail@serwis1.elo', '600100600', 'empty', '600100900', 'phone edit', 'empty', 'empty', 'brak numeru telefonu do wozu serwisowego', 'active'),
(3, 'serwis 2', 'ulica', '33-324', 'miasto2', '22 3334422', '22 3334422', 'mail@serwis2.elo', '600100600', NULL, '600100900', NULL, NULL, NULL, 'brak numeru telefonu do wozu serwisowego', 'active'),
(4, 'old1', 'old street 11/332', '11-112', 'old city', NULL, NULL, 'old@mail.elo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactive'),
(5, 'old2', 'old street 11/32', '19-112', 'old city', NULL, NULL, 'old2@mail.elo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'suspended'),
(6, 'AllData', 'super street 1', '11-111', 'super city', '23 1112211', '23 1112211', 'super@mail.elo', '111222333', '333222111', '22 33', '33 22', 'ma1@ma.elo', 'ma2@m.elo', 'wszystkie dane, dealer aktywny od 1.2.2017', 'active'),
(7, 'new form', 'new street', 'zip code', 'city', '909090909', '90909099', '90909@9090.00', '90909009', 'EMPTY', 'empty', 'empty', 'empty', 'empty', 'new dealer, start 24.07.2017', 'active'),
(8, 'new form 2', 'new street', 'zip code', 'city', '909090909', '90909099', '90909@9090.001', '90909009', 'EMPTY', 'empty', 'empty', 'empty', 'empty', 'new dealer, start 24.07.2017', 'active'),
(9, 'acive form', 'example', 'example', 'example', 'example', 'example', 'example@example.example', 'example', 'example', 'example', 'example', 'example', 'example', 'exampleexampleexampleexample', 'active');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'ccwrcadmin', 'ccwrcadmin', 'ccwrcadmin@gmail.elo', 'ccwrcadmin@gmail.elo', 1, NULL, '$2y$13$mdUZimf2vJ/q5o1SqQSRh.m6ldO29NGHlCcCuIsFjU1bdWNAT9w8u', '2017-09-28 16:27:43', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'ccwrcoperator', 'ccwrcoperator', 'ccwrcoperator@gmail.elo', 'ccwrcoperator@gmail.elo', 1, NULL, '$2y$13$NPahNgRTTcYYeafyiKg0x.RS35r6nAu79N4pzKUj8ajLc5fH2EB4W', '2017-09-28 14:55:45', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_OPERATOR\";}'),
(3, 'ccwrcuser', 'ccwrcuser', 'ccwrcuser@gmail.elo', 'ccwrcuser@gmail.elo', 1, NULL, '$2y$13$85Y1dC2YeX05aYoxrLAgOOmjsHKCaObP1t7c08ympJGrufzmX6lGe', '2017-07-26 14:46:43', NULL, NULL, 'a:0:{}'),
(4, 'ccwrcdealer', 'ccwrcdealer', 'ccwrcdealer@ccwrcdealer.elo', 'ccwrcdealer@ccwrcdealer.elo', 1, NULL, '$2y$13$garsgYLil1hIyV7yu7dXGuHYGB2TELZgcca/wiUN4WdGN824meA2K', '2017-09-19 13:32:32', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_DEALER\";}'),
(5, 'ccwrcsuperadmin', 'ccwrcsuperadmin', 'ccwrcsuperadmin@gmail.elo', 'ccwrcsuperadmin@gmail.elo', 1, NULL, '$2y$13$eFT7Nt2mA3zltKru5pmfJO5RtLGB7SrCgfUIBUcAy.TQFJsjKcNgO', '2017-09-28 12:54:11', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_save` datetime NOT NULL,
  `time_set` datetime DEFAULT NULL,
  `document` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_through` longtext COLLATE utf8_unicode_ci,
  `comments` longtext COLLATE utf8_unicode_ci,
  `out_comment` longtext COLLATE utf8_unicode_ci,
  `contact_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_mails` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accident_case_id` int(11) DEFAULT NULL,
  `operator` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_dealer_id` int(11) DEFAULT NULL,
  `repair_dealer_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `currency` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `monitoring`
--

INSERT INTO `monitoring` (`id`, `code`, `time_save`, `time_set`, `document`, `contact_through`, `comments`, `out_comment`, `contact_mail`, `optional_mails`, `accident_case_id`, `operator`, `home_dealer_id`, `repair_dealer_id`, `amount`, `currency`) VALUES
(4, 'START', '2017-08-01 00:00:00', NULL, NULL, 'edit kierowca 565656566', 'edit zgloszenie awarii edit', NULL, NULL, NULL, 1, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(12, 'START', '2017-08-07 14:54:51', NULL, NULL, 'wer ed', 'wer ed', NULL, NULL, NULL, 15, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(13, 'START', '2017-08-07 14:57:23', NULL, NULL, 'edit new date test', 'edit new date test', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(14, 'START', '2017-08-07 14:58:42', NULL, NULL, 'dfg', 'dfg', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(27, 'START', '2017-08-09 16:57:52', NULL, NULL, 'ed', 'ed', NULL, NULL, NULL, 18, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(32, 'Incoming', '2017-08-13 17:16:27', NULL, NULL, 'inc', 'inc', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(33, 'Incoming', '2017-08-14 11:27:14', NULL, NULL, 'incoming edit', 'incoming edit', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(34, 'Incoming', '2017-08-14 12:18:34', NULL, NULL, 'fd ed', 'dfhg', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(35, 'RO', '2017-08-15 12:10:59', NULL, NULL, 'sadf edit', 'sdf', 'sdf', NULL, NULL, 15, 'ccwrcadmin', 3, 7, NULL, NULL),
(36, 'RO', '2017-08-15 12:47:48', NULL, NULL, 'case 18 edit', 'edit case 18', 'case 18', NULL, NULL, 18, 'ccwrcadmin', 1, 9, NULL, NULL),
(37, 'ETA', '2017-08-17 10:32:59', '2018-08-17 10:00:00', NULL, 'new eta edit', 'new eta edit', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(38, 'RO', '2017-08-17 10:49:27', NULL, NULL, 'asdg', 'sdgf', 'sfdg', NULL, NULL, 16, 'ccwrcadmin', 1, 6, NULL, NULL),
(39, 'PG', '2017-08-17 11:33:55', NULL, NULL, 'df', 'dfg', 'dfg', NULL, NULL, 18, 'ccwrcadmin', 1, NULL, NULL, NULL),
(40, 'PG', '2017-08-17 11:39:40', NULL, NULL, 'wq3te', 'rtetr', 'ert', NULL, NULL, 1, 'ccwrcadmin', 1, NULL, NULL, NULL),
(41, 'CPG', '2017-08-17 11:40:03', NULL, NULL, 'sdfg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', 1, NULL, NULL, NULL),
(42, 'RO', '2017-08-17 11:40:23', NULL, NULL, 'dfg', 'dfg', 'dfg', NULL, NULL, 1, 'ccwrcadmin', 1, 8, NULL, NULL),
(43, 'ETA', '2017-08-17 11:41:33', '2017-08-17 22:24:00', NULL, 'sdg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(44, 'ETA', '2017-08-17 12:28:35', '2012-08-17 12:28:00', NULL, 'dsh edyta', 'ddfh', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(45, 'STRR', '2017-08-21 12:30:41', '2017-08-21 12:19:00', NULL, 'edit start', 'start edit', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(46, 'STRR', '2017-08-21 14:48:16', '2017-08-21 14:48:00', NULL, 'start', 'start 2', NULL, NULL, NULL, 7, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(47, 'Out', '2017-08-22 15:40:16', NULL, NULL, 'out', 'out', NULL, NULL, NULL, 7, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(48, 'Out', '2017-08-23 11:59:18', NULL, NULL, 'out edit', 'edit out', NULL, NULL, NULL, 3, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(49, 'END', '2017-08-23 17:39:25', '2017-08-23 17:39:00', NULL, 'end', 'end', NULL, NULL, NULL, 7, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(50, 'END', '2017-08-24 17:44:55', '2017-08-24 17:44:00', NULL, 'end', 'end', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(51, 'END', '2017-08-27 11:50:06', '2017-08-27 11:49:00', NULL, 'end op', 'end op', NULL, NULL, NULL, 3, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(52, 'END', '2017-08-27 13:17:14', '2017-08-27 13:17:00', NULL, 'degf edit', 'dsfg edit', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(53, 'END', '2017-08-27 15:30:04', '2017-08-27 15:29:00', NULL, 'dsgf edit', 'dfg edit', NULL, NULL, NULL, 2, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(54, 'PG', '2017-08-28 13:15:10', NULL, NULL, 'cd', 'dgf', 'dfg', NULL, NULL, 6, 'ccwrcadmin', 6, NULL, NULL, NULL),
(55, 'PG', '2017-08-28 13:21:24', NULL, NULL, 'fbc', 'cvb', 'cv', NULL, NULL, 17, 'ccwrcadmin', 1, NULL, NULL, NULL),
(56, 'CPG', '2017-08-28 13:33:42', NULL, NULL, 'dsfff', 'dsfff', NULL, NULL, NULL, 16, 'ccwrcadmin', 1, NULL, NULL, NULL),
(57, 'RO', '2017-08-28 14:38:01', NULL, NULL, 'dfg edyta', 'dfg edyta', 'dfg', NULL, NULL, 16, 'ccwrcadmin', 1, 5, NULL, NULL),
(58, 'ETA', '2017-08-29 11:08:20', '2017-08-29 11:08:00', NULL, 'new eta edot', 'edyut', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(59, 'STRR', '2017-08-29 11:32:03', '2017-08-29 11:31:00', NULL, 'start edit', 'start edit', NULL, NULL, NULL, 15, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(60, 'Incoming', '2017-08-29 12:14:52', NULL, NULL, 'inc edit', 'inc edit', NULL, NULL, NULL, 15, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(61, 'Out', '2017-08-29 14:27:41', NULL, NULL, 'o e', 'e o', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(62, 'END', '2017-08-30 17:43:56', '2017-08-30 17:43:00', NULL, 'dgf  ed', 'dfg  ed', NULL, NULL, NULL, 2, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(63, 'PG', '2017-08-31 14:39:13', NULL, NULL, 'df', 'dff', 'df', NULL, NULL, 2, 'ccwrcadmin', 1, NULL, NULL, NULL),
(64, 'WPG', '2017-08-31 14:41:18', NULL, NULL, 'sdf edit', 'sdf edit', 'sdf', NULL, NULL, 2, 'ccwrcadmin', 1, NULL, NULL, NULL),
(65, 'PG', '2017-09-01 13:15:45', NULL, NULL, 'f', 'f', 'f', NULL, NULL, 3, 'ccwrcadmin', 1, NULL, NULL, NULL),
(66, 'WPG', '2017-09-01 13:16:05', NULL, NULL, 'fe', 'fe', 'f', NULL, NULL, 3, 'ccwrcadmin', 1, NULL, NULL, NULL),
(67, 'CPG', '2017-09-01 14:46:03', NULL, NULL, 'saf', 'sdf', NULL, NULL, NULL, 17, 'ccwrcadmin', 1, NULL, NULL, NULL),
(68, 'WCPG', '2017-09-01 14:46:15', NULL, NULL, 'd', 'd', NULL, NULL, NULL, 17, 'ccwrcadmin', 1, NULL, NULL, NULL),
(69, 'WCPG', '2017-09-03 11:31:26', NULL, NULL, 'df edit', 'edit dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', 1, NULL, NULL, NULL),
(70, 'RO', '2017-09-03 11:59:52', NULL, NULL, 'gg', 'gg', 'gg', NULL, NULL, 4, 'ccwrcadmin', 1, 6, NULL, NULL),
(71, 'RO', '2017-09-03 13:15:46', NULL, NULL, 'dxv', 'xcv', 'xcv', NULL, NULL, 3, 'ccwrcadmin', 1, 1, NULL, NULL),
(72, 'WRO', '2017-09-03 13:15:57', NULL, NULL, 'xcv', 'cxvxc', 'vxcvx', NULL, NULL, 3, 'ccwrcadmin', 1, 1, NULL, NULL),
(73, 'RO', '2017-09-04 08:43:54', NULL, NULL, 'r', 'r', 'r', NULL, NULL, 6, 'ccwrcadmin', 6, 7, NULL, NULL),
(74, 'WRO', '2017-09-04 08:44:09', NULL, NULL, 'r edit', 'edit r', 'r', NULL, NULL, 6, 'ccwrcadmin', 6, 7, NULL, NULL),
(75, 'START', '2017-09-04 12:15:08', NULL, NULL, 'sdfsdf', 'asdasd', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(76, 'PG', '2017-09-04 12:15:43', NULL, NULL, 'sadf', 'asd', 'wwww', NULL, NULL, 19, 'ccwrcadmin', 6, NULL, NULL, NULL),
(77, 'CPG', '2017-09-04 12:16:05', NULL, NULL, 'ddd', 'dddd', NULL, NULL, NULL, 19, 'ccwrcadmin', 6, NULL, NULL, NULL),
(78, 'RO', '2017-09-04 12:17:07', NULL, NULL, 'sdf', 'sdf', 'sdf', NULL, NULL, 19, 'ccwrcadmin', 6, 7, NULL, NULL),
(79, 'END', '2017-09-04 12:17:34', '2017-09-04 12:17:00', NULL, 'safdsf', 'sdfsdf', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(80, 'WPG', '2017-09-04 12:18:35', NULL, NULL, 'asfd', 'asd', 'asd', NULL, NULL, 19, 'ccwrcadmin', 6, NULL, NULL, NULL),
(81, 'CPG', '2017-09-04 16:53:50', NULL, NULL, 'cpg ed test', 'ed test cpg', NULL, NULL, NULL, 19, 'ccwrcadmin', 6, NULL, NULL, NULL),
(82, 'END', '2017-09-04 17:59:23', '2017-09-04 17:59:00', NULL, 'rr ed', 'ed rr', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(83, 'ETA', '2017-09-04 18:06:46', '2017-09-04 18:06:00', NULL, 'e ed', 'ed e', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(84, 'Incoming', '2017-09-04 18:24:42', NULL, NULL, 'wer ed', 'ed wer', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(85, 'Out', '2017-09-05 11:17:22', NULL, NULL, 'e ed', 'ed e', NULL, NULL, NULL, 3, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(86, 'PG', '2017-09-05 11:25:59', NULL, NULL, 'sf ed', 'ed sdf', 'sdf', NULL, NULL, 3, 'ccwrcadmin', 1, NULL, NULL, NULL),
(87, 'RO', '2017-09-05 11:38:50', NULL, NULL, 'ed dfg', 'df ed', 'df', NULL, NULL, 3, 'ccwrcadmin', 1, 7, NULL, NULL),
(88, 'STRR', '2017-09-05 12:43:01', '2017-09-05 12:42:00', NULL, 'st ed', 'st ed', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(89, 'START', '2017-09-05 15:47:49', NULL, NULL, 'ert', 'ert', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(90, 'START', '2017-09-05 15:51:35', NULL, NULL, 'dfg', 'dfg', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(91, 'ETA', '2017-09-05 16:41:33', '2017-09-05 16:39:00', NULL, 'dsgftr', 'sdf', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(92, 'END', '2017-09-05 17:32:57', '2017-09-05 17:32:00', NULL, 'wer', 'wer', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(93, 'START', '2017-09-06 11:53:36', NULL, NULL, 'n ed', 'n ed', NULL, NULL, NULL, 22, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(94, 'END', '2017-09-06 12:21:50', '2017-09-06 12:21:00', NULL, 'xf', 'rtf', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(95, 'START', '2017-09-06 12:36:07', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(96, 'CPG', '2017-09-06 14:23:24', NULL, NULL, 'dxfg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', 1, NULL, NULL, NULL),
(97, 'CPG', '2017-09-06 14:24:49', NULL, NULL, 'werfts', 'sdf', NULL, NULL, NULL, 1, 'ccwrcadmin', 1, NULL, NULL, NULL),
(98, 'END', '2017-09-06 14:31:02', '2017-09-06 14:30:00', NULL, 'dfh', 'dgf', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(99, 'ETA', '2017-09-06 14:36:15', '2017-09-06 14:36:00', NULL, 'sdeg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(100, 'PG', '2017-09-07 12:27:10', NULL, NULL, 'dd', 'dd', 'dd', NULL, NULL, 7, 'ccwrcadmin', 1, NULL, NULL, NULL),
(101, 'RO', '2017-09-07 12:50:37', NULL, NULL, 'dd', 'dd', 'dd', NULL, NULL, 15, 'ccwrcadmin', 3, 1, NULL, NULL),
(102, 'STRR', '2017-09-07 13:01:57', '2017-09-07 13:01:00', NULL, 'dd', 'dd', NULL, NULL, NULL, 4, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(103, 'ETA', '2017-09-07 13:02:14', '2017-09-07 13:02:00', NULL, 'ff', 'ff', NULL, NULL, NULL, 7, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(104, 'END', '2017-09-07 13:02:35', '2017-09-07 13:02:00', NULL, 'rr', 'rr', NULL, NULL, NULL, 15, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(105, 'CPG', '2017-09-07 13:11:24', NULL, NULL, 'fcgh', 'fg', NULL, NULL, NULL, 18, 'ccwrcadmin', 1, NULL, NULL, NULL),
(106, 'ETA', '2017-09-07 13:13:08', '2017-09-07 13:13:00', NULL, 'rr', 'rr', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(107, 'STRR', '2017-09-07 13:19:06', '2017-09-07 13:19:00', NULL, 'dfg', 'dfg', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(108, 'CPG', '2017-09-07 13:22:18', NULL, NULL, 'wer', 'wer', NULL, NULL, NULL, 7, 'ccwrcadmin', 1, NULL, NULL, NULL),
(109, 'RO', '2017-09-07 13:22:26', NULL, NULL, 'er', 'er', 'er', NULL, NULL, 7, 'ccwrcadmin', 1, 1, NULL, NULL),
(110, 'WCPG', '2017-09-07 13:22:39', NULL, NULL, 'fg', 'fg', NULL, NULL, NULL, 7, 'ccwrcadmin', 1, NULL, NULL, NULL),
(111, 'WPG', '2017-09-07 13:32:22', NULL, NULL, 'dfg', 'dfg', 'dfg', NULL, NULL, 3, 'ccwrcadmin', 1, NULL, NULL, NULL),
(112, 'PG', '2017-09-07 13:35:27', NULL, NULL, 'sdf', 'sdf', 'sdf', NULL, NULL, 4, 'ccwrcadmin', 1, NULL, NULL, NULL),
(113, 'ETA', '2017-09-07 13:35:36', '2017-09-07 13:35:00', NULL, 'd', 'd', NULL, NULL, NULL, 4, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(114, 'WPG', '2017-09-07 13:35:46', NULL, NULL, 'd', 'd', 'd', NULL, NULL, 4, 'ccwrcadmin', 1, NULL, NULL, NULL),
(115, 'WRO', '2017-09-07 13:40:35', NULL, NULL, 'wer', 'wer', 'wer', NULL, NULL, 16, 'ccwrcadmin', 1, 5, NULL, NULL),
(116, 'END', '2017-09-07 14:59:34', '2017-09-07 14:59:00', NULL, 'deg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(117, 'END', '2017-09-07 15:01:10', '2017-09-07 15:01:00', NULL, 'cv', 'cx', NULL, NULL, NULL, 2, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(118, 'END', '2017-09-07 15:05:49', '2017-09-07 15:05:00', NULL, 'rr', 'r', NULL, NULL, NULL, 3, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(119, 'END', '2017-09-07 15:24:18', '2017-09-07 15:24:00', NULL, 'r', 'd', NULL, NULL, NULL, 4, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(120, 'END', '2017-09-07 15:26:30', '2017-09-07 15:26:00', NULL, 'dsg', 'dfg', NULL, NULL, NULL, 7, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(121, 'STRR', '2017-09-07 15:37:45', '2017-09-07 15:37:00', NULL, 'r', 'r', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(122, 'STRR', '2017-09-07 16:27:09', '2017-09-07 16:27:00', NULL, 'hh', 'hh', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(123, 'END', '2017-09-07 17:52:59', '2017-09-07 17:52:00', NULL, 'gg', 'gg', NULL, NULL, NULL, 22, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(124, 'END', '2017-09-08 14:50:58', '2017-09-08 14:50:00', NULL, 'cc', 'cc', NULL, NULL, NULL, 6, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(125, 'START', '2017-09-10 12:31:23', NULL, NULL, 'dd', 'dd', NULL, NULL, NULL, 24, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(126, 'START', '2017-09-10 12:46:33', NULL, NULL, '33', '33', NULL, NULL, NULL, 25, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(128, 'START', '2017-09-10 13:30:12', NULL, NULL, 'dfg', 'dfg', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(129, 'END', '2017-09-10 15:55:18', '2017-09-10 15:55:00', NULL, 'dgt', 'dfg', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(130, 'CPG', '2017-09-11 13:17:13', NULL, NULL, 'dfg', 'dfgxx', NULL, NULL, NULL, 20, 'ccwrcadmin', 1, NULL, NULL, NULL),
(131, 'END', '2017-09-11 13:48:45', '2017-09-11 13:48:00', NULL, 'dfgcc', 'dfgcc', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(132, 'ETA', '2017-09-11 13:59:21', '2017-09-11 13:59:00', NULL, 'tt22', 'tt22', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(133, 'Incoming', '2017-09-11 14:46:43', NULL, NULL, 'ee', 'ee', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(134, 'Incoming', '2017-09-11 16:00:25', NULL, NULL, 'ert', 'df', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(135, 'ETA', '2017-09-11 16:06:48', '2017-09-11 16:16:00', NULL, '44', '44', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(136, 'ETA', '2017-09-11 16:15:05', '2017-09-11 16:04:00', NULL, 'tt', 'tt', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(137, 'ETA', '2017-09-11 16:56:22', '2017-11-11 16:56:00', NULL, 'r', 'r', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(138, 'Incoming', '2017-09-12 15:14:00', NULL, NULL, 'g x f', 'f', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(139, 'Out', '2017-09-12 15:36:45', NULL, NULL, 'fr', 'fr', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(140, 'PG', '2017-09-12 16:17:46', NULL, NULL, 'rre', 'rre', 'rrr', NULL, NULL, 17, 'ccwrcadmin', 1, NULL, NULL, NULL),
(141, 'RO', '2017-09-13 10:34:14', NULL, NULL, 'er', 'er', 'e', NULL, NULL, 18, 'ccwrcadmin', 1, 1, NULL, NULL),
(142, 'STRR', '2017-09-13 11:06:01', '2017-09-13 11:05:00', NULL, '44e', '44e', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(143, 'ETA', '2017-09-13 12:28:45', '2017-09-13 12:38:00', NULL, 'rrr', 'r', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(144, 'ETA', '2017-09-13 12:44:45', '2018-09-13 12:44:00', NULL, '4', '4', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(145, 'ETA', '2017-09-13 12:47:05', '2017-09-20 12:46:00', NULL, 'gf', 'f', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(146, 'ETA', '2017-09-13 12:47:52', '2017-09-02 12:47:00', NULL, 'd', 'd', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(147, 'ETA', '2017-09-13 15:16:00', '2017-09-13 15:15:00', NULL, 'last', 'last', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(148, 'STRR', '2017-09-14 12:43:46', '2017-09-14 12:43:00', NULL, 'd', 'd', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(149, 'END', '2017-09-14 12:58:39', '2017-09-14 12:58:00', NULL, 'dd', 'dd', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(150, 'RO', '2017-09-14 13:33:46', NULL, NULL, 'dd', 'dd', 'dd', NULL, NULL, 20, 'ccwrcadmin', 1, 1, NULL, NULL),
(151, 'ETA', '2017-09-14 13:34:04', '2017-09-14 14:00:00', NULL, 'dd', 'dd', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(152, 'STRR', '2017-09-14 13:34:37', '2017-09-14 15:30:00', NULL, 'dd', 'dd', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(153, 'STRR', '2017-09-14 16:01:10', '2017-09-14 10:00:00', NULL, 'rr', 'rr', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(154, 'END', '2017-09-14 16:01:27', '2017-09-14 14:00:00', NULL, 'r', 'r', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(155, 'STRR', '2017-09-14 16:06:20', '2017-09-14 07:10:00', NULL, '3', '3', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(156, 'END', '2017-09-14 16:06:40', '2017-09-14 09:30:00', NULL, '3', '3', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(157, 'START', '2017-09-17 12:38:56', NULL, NULL, 'f', 'f', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(158, 'END', '2017-09-17 12:39:08', '2017-09-17 12:39:00', NULL, 'f', 'f', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(159, 'CPG', '2017-09-17 12:39:38', NULL, NULL, 'e', 'e', NULL, NULL, NULL, 28, 'ccwrcadmin', 1, NULL, NULL, NULL),
(160, 'ETA', '2017-09-17 12:39:44', '2017-09-17 12:39:00', NULL, 'e', 'e', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(161, 'END', '2017-09-17 12:39:51', '2017-09-17 12:39:00', NULL, 'end op', 'e', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(162, 'END', '2017-09-17 12:41:04', '2017-09-17 12:40:00', NULL, 'f', 'f', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(163, 'END', '2017-09-17 13:10:16', '2017-09-17 13:10:00', NULL, 'degd', 'd', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(164, 'END', '2017-09-17 13:11:03', '2017-09-17 13:10:00', NULL, 'degd', 'd', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(165, 'END', '2017-09-17 13:13:43', '2017-09-17 13:13:00', NULL, 'r', 'r', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(166, 'END', '2017-09-17 13:16:43', '2017-09-17 13:13:00', NULL, 'r', 'r', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(167, 'END', '2017-09-17 13:18:04', '2017-09-17 13:13:00', NULL, 'r', 'r', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(168, 'END', '2017-09-17 13:23:56', '2017-09-17 13:13:00', NULL, 'r', 'r', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(169, 'END', '2017-09-17 13:25:33', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(170, 'END', '2017-09-17 13:26:11', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(171, 'END', '2017-09-17 13:29:10', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(172, 'END', '2017-09-17 13:32:26', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(173, 'END', '2017-09-17 13:33:00', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(174, 'END', '2017-09-17 13:34:22', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(175, 'END', '2017-09-17 13:41:57', '2017-09-17 13:25:00', NULL, '3', '3', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(176, 'END', '2017-09-17 15:02:43', '2017-09-17 15:02:00', NULL, 'e', 'e', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(177, 'END', '2017-09-17 15:04:50', '2017-09-17 15:02:00', NULL, 'e', 'e', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(178, 'END', '2017-09-17 15:09:17', '2017-09-17 15:02:00', NULL, 'e', 'e', NULL, NULL, NULL, 18, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(179, 'END', '2017-09-17 15:17:25', '2017-09-17 15:17:00', NULL, 'e', 'e', NULL, NULL, NULL, 19, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(180, 'END', '2017-09-17 15:22:44', '2017-09-17 15:22:00', NULL, 'degf', 'g', NULL, NULL, NULL, 16, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(181, 'END', '2017-09-17 15:31:28', '2017-09-17 15:31:00', NULL, 'rr', 'rr', NULL, NULL, NULL, 20, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(182, 'END', '2017-09-17 15:34:46', '2017-09-17 15:34:00', NULL, 'end', 'e', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(183, 'ETA', '2017-09-17 15:40:06', '2017-09-17 15:40:00', NULL, 'ee', 'e', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(184, 'STRR', '2017-09-17 15:40:20', '2017-09-17 01:40:00', NULL, '3', '3', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(185, 'END', '2017-09-17 15:40:26', '2017-09-17 15:40:00', NULL, '3', '3', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(186, 'ETA', '2017-09-17 15:44:09', '2017-09-17 15:44:00', NULL, 'r', 'r', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(187, 'END', '2017-09-17 15:44:22', '2017-09-17 15:44:00', NULL, 'r', 'r', NULL, NULL, NULL, 17, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(188, 'CPG', '2017-09-17 15:49:57', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 21, 'ccwrcadmin', 1, NULL, NULL, NULL),
(189, 'STRR', '2017-09-17 15:50:11', '2017-09-17 15:50:00', NULL, 'dd', 'd', NULL, NULL, NULL, 23, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(190, 'END', '2017-09-17 16:55:15', '2017-09-17 16:55:00', NULL, 'end', 'e', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(191, 'START', '2017-09-17 16:57:20', NULL, NULL, 'ker 44 ed', 'comment ed', NULL, NULL, NULL, 29, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(192, 'PG', '2017-09-17 16:57:31', NULL, NULL, 'ee', 'eee', 'ee', NULL, NULL, 29, 'ccwrcadmin', 1, NULL, NULL, NULL),
(193, 'CPG', '2017-09-17 16:57:41', NULL, NULL, 'ee', 'ee', NULL, NULL, NULL, 29, 'ccwrcadmin', 1, NULL, NULL, NULL),
(194, 'RO', '2017-09-17 16:57:51', NULL, NULL, 'ee', 'ee', 'ee', NULL, NULL, 29, 'ccwrcadmin', 1, 8, NULL, NULL),
(195, 'ETA', '2017-09-17 16:58:13', '2017-09-17 17:10:00', NULL, 'ee', 'ee', NULL, NULL, NULL, 29, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(196, 'END', '2017-09-17 16:58:31', '2017-09-17 16:58:00', NULL, 'degd', 'd', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(197, 'END', '2017-09-17 17:29:52', '2017-09-17 17:29:00', NULL, 'r', 'r', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(198, 'STRR', '2017-09-17 17:31:30', '2017-09-17 17:25:00', NULL, 'e', 'e', NULL, NULL, NULL, 29, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(199, 'END', '2017-09-17 17:31:53', '2017-09-17 17:30:00', NULL, 'e f', 'e f', NULL, NULL, NULL, 29, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(200, 'CPG', '2017-09-17 17:50:11', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 21, 'ccwrcadmin', 1, NULL, NULL, NULL),
(201, 'WCPG', '2017-09-17 17:50:35', NULL, NULL, 'w ed', 'w ed', NULL, NULL, NULL, 21, 'ccwrcadmin', 1, NULL, NULL, NULL),
(202, 'PG', '2017-09-18 11:52:54', NULL, NULL, 'e', 'e', 'e', NULL, NULL, 21, 'ccwrcadmin', 1, NULL, NULL, NULL),
(203, 'WPG', '2017-09-18 11:53:14', NULL, NULL, '2e', '2e', '2', NULL, NULL, 21, 'ccwrcadmin', 1, NULL, NULL, NULL),
(204, 'RO', '2017-09-18 12:12:25', NULL, NULL, 'e', 'e', 'e', NULL, NULL, 21, 'ccwrcadmin', 1, 1, NULL, NULL),
(205, 'WRO', '2017-09-18 12:13:07', NULL, NULL, 'wwr', 'wr', 'w', NULL, NULL, 21, 'ccwrcadmin', 1, 1, NULL, NULL),
(206, 'ETA', '2017-09-18 16:53:48', '2017-09-18 16:53:00', NULL, 'ff', 'f', NULL, NULL, NULL, 21, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(207, 'START', '2017-09-19 13:23:34', NULL, NULL, 'time start', 'time start', NULL, NULL, NULL, 30, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(208, 'CPG', '2017-09-20 14:03:29', NULL, NULL, 'r', 'rr', NULL, NULL, NULL, 28, 'ccwrcadmin', 1, NULL, NULL, NULL),
(209, 'RO', '2017-09-20 14:08:32', NULL, NULL, 'r', 'r', 'r', NULL, NULL, 28, 'ccwrcadmin', 1, 1, NULL, NULL),
(210, 'ETA', '2017-09-20 14:22:58', '2017-09-20 14:22:00', NULL, 'f', 'f', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(211, 'STRR', '2017-09-20 14:27:11', '2017-09-20 14:27:00', NULL, 'r', 'r', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(212, 'END', '2017-09-20 14:31:29', '2017-09-20 14:31:00', NULL, 'd', 'd', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(213, 'Out', '2017-09-20 14:35:29', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(214, 'Out', '2017-09-20 14:39:07', NULL, NULL, 'dfg', 'dfg', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(215, 'Incoming', '2017-09-20 14:41:56', NULL, NULL, 'd', 'd', NULL, NULL, NULL, 28, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(216, 'PG', '2017-09-20 16:38:45', NULL, NULL, 'anonim 3333ed', 'prosba o potwierdzenie ed', NULL, NULL, NULL, 30, 'ccwrcadmin', 1, NULL, NULL, NULL),
(217, 'CPG', '2017-09-20 16:39:13', NULL, NULL, 'anonim 777777', 'udzielil potwierdzenia', NULL, NULL, NULL, 30, 'ccwrcadmin', 1, NULL, NULL, NULL),
(218, 'RO', '2017-09-20 16:54:43', NULL, NULL, 'anonim 333333', 'koment', 'koment for dealer', NULL, NULL, 30, 'ccwrcadmin', 1, 5, NULL, NULL),
(219, 'ETA', '2017-09-20 16:55:17', '2017-09-20 17:30:00', NULL, 'anonim z serwisu', 'dojedzie na 17:30', NULL, NULL, NULL, 30, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(220, 'STRR', '2017-09-20 17:47:37', '2017-09-20 17:40:00', NULL, 'anonim', '10 min late, naprawa w toku', NULL, NULL, NULL, 30, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(221, 'END', '2017-09-20 17:52:44', '2017-09-20 17:50:00', NULL, 'anonim 7777', 'naprawa zakonczona o 17:50, przyczyna byl bezpiecznik', NULL, NULL, NULL, 30, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(222, 'START', '2017-09-21 12:08:01', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 31, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(223, 'START', '2017-09-21 12:08:32', NULL, NULL, 'e', 'e', NULL, NULL, NULL, 32, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(224, 'START', '2017-09-21 12:08:57', NULL, NULL, 'dd', 'd', NULL, NULL, NULL, 33, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(225, 'END', '2017-09-21 12:09:25', '2017-09-21 12:09:00', NULL, 'rr', 'r', NULL, NULL, NULL, 33, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(226, 'END', '2017-09-21 12:09:43', '2017-09-21 12:09:00', NULL, 'rr', 'r', NULL, NULL, NULL, 32, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(227, 'START', '2017-09-21 13:21:24', NULL, NULL, 'r', 'r', NULL, NULL, NULL, 34, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(228, 'Out', '2017-09-24 13:21:05', NULL, NULL, 'test super admin rr', 'test super admin coment rr', NULL, NULL, NULL, 29, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(229, 'PG', '2017-09-24 15:42:57', NULL, NULL, 'dsfg', 'd', 'd', NULL, NULL, 31, 'ccwrcadmin', 1, NULL, NULL, NULL),
(230, 'WPG', '2017-09-24 15:43:05', NULL, NULL, 'dfg ed', 'd ed', 'd', NULL, NULL, 31, 'ccwrcadmin', 1, NULL, NULL, NULL),
(231, 'CPG', '2017-09-24 15:47:27', NULL, NULL, 'edf', 'f', NULL, NULL, NULL, 31, 'ccwrcadmin', 1, NULL, NULL, NULL),
(232, 'WCPG', '2017-09-24 15:48:02', NULL, NULL, 's ed', 's wde', NULL, NULL, NULL, 31, 'ccwrcadmin', 1, NULL, NULL, NULL),
(233, 'RO', '2017-09-24 16:17:14', NULL, NULL, 'ee d', 'e d', 'e', NULL, NULL, 31, 'ccwrcadmin', 1, 1, NULL, NULL),
(234, 'WRO', '2017-09-24 16:21:58', NULL, NULL, 'e r', 'e r', 'e', NULL, NULL, 31, 'ccwrcadmin', 1, 1, NULL, NULL),
(235, 'ETA', '2017-09-24 16:47:06', '2017-09-24 16:47:00', NULL, 'rr t', 'rr t', NULL, NULL, NULL, 31, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(236, 'STRR', '2017-09-24 16:49:29', '2017-09-24 16:49:00', NULL, 'rr d', 'r d', NULL, NULL, NULL, 31, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(237, 'Incoming', '2017-09-26 19:41:23', NULL, NULL, 'sdf tt', 'sdf tt', NULL, NULL, NULL, 30, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(238, 'Incoming', '2017-09-26 19:46:58', NULL, NULL, 'ert ff', 'e ff', NULL, NULL, NULL, 27, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(239, 'START', '2017-09-27 15:37:57', NULL, NULL, 'sdfsdf', 'sdf', NULL, NULL, NULL, 35, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(240, 'END', '2017-09-27 15:53:45', '2017-09-27 15:53:00', NULL, 'f', 'f', NULL, NULL, NULL, 35, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(241, 'START', '2017-09-27 18:57:19', NULL, NULL, 'e', 'e', NULL, NULL, NULL, 36, 'ccwrcsuperadmin', NULL, NULL, NULL, NULL),
(242, 'START', '2017-09-27 19:08:52', NULL, NULL, 'wer', NULL, NULL, NULL, NULL, 37, 'ccwrcsuperadmin', NULL, NULL, NULL, NULL),
(243, 'START', '2017-09-28 14:56:08', NULL, NULL, 'dfgdfg', NULL, NULL, NULL, NULL, 38, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(244, 'START', '2017-09-28 14:56:51', NULL, NULL, 'wer', NULL, NULL, NULL, NULL, 39, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(245, 'START', '2017-09-28 14:58:12', NULL, NULL, 'ert', NULL, NULL, NULL, NULL, 40, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(246, 'END', '2017-09-28 14:58:40', '2017-09-28 14:58:00', NULL, '5', '5', NULL, NULL, NULL, 40, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(247, 'END', '2017-09-28 14:59:01', '2017-09-28 14:58:00', NULL, '5', '5', NULL, NULL, NULL, 39, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(248, 'END', '2017-09-28 15:01:35', '2017-09-28 15:01:00', NULL, 'f', 'f', NULL, NULL, NULL, 34, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(249, 'END', '2017-09-28 15:38:50', '2017-09-28 15:38:00', NULL, 'dg', 'dfg', NULL, NULL, NULL, 36, 'ccwrcoperator', NULL, NULL, NULL, NULL),
(250, 'START', '2017-09-28 16:32:43', NULL, NULL, 'sdf', 'sdf', NULL, NULL, NULL, 41, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(251, 'END', '2017-09-28 16:32:51', '2017-09-28 16:32:00', NULL, 'sdf', 'dsf', NULL, NULL, NULL, 41, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(252, 'START', '2017-09-28 16:38:05', NULL, NULL, 'sdf', 'sdf', NULL, NULL, NULL, 42, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(253, 'RO', '2017-09-28 16:38:14', NULL, NULL, 'ewr', 'wer', 'wer', NULL, NULL, 42, 'ccwrcadmin', 1, 1, NULL, NULL),
(254, 'STRR', '2017-09-28 16:38:31', '2017-09-28 16:38:00', NULL, 'qwe', 'qwe', NULL, NULL, NULL, 42, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(255, 'END', '2017-09-28 16:38:51', '2017-09-28 16:38:00', NULL, 'defr', 'sdf', NULL, NULL, NULL, 42, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(256, 'START', '2017-09-28 16:40:56', NULL, NULL, 'dfg', 'dfg', NULL, NULL, NULL, 43, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(257, 'START', '2017-09-28 16:46:43', NULL, NULL, 'fff', 'ff', NULL, NULL, NULL, 44, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(258, 'END', '2017-09-28 16:46:56', '2017-09-28 16:46:00', NULL, 'dsg', 'dfg', NULL, NULL, NULL, 44, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(259, 'END', '2017-09-28 16:53:19', '2017-09-28 16:53:00', NULL, 'r', 'r', NULL, NULL, NULL, 43, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(260, 'START', '2017-09-28 17:22:31', NULL, NULL, 'KIEROWCA JAN 123123', 'OD GODZ. 18:00 POD NUMEREM KIEROWCY DOSTĘPNY BĘDZIE DYSPOZYTOR FIRMY', NULL, NULL, NULL, 45, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(261, 'PG', '2017-09-28 17:23:33', NULL, NULL, 'SERWIS 123123123', 'PRZESYŁAM PROŚBĘ O POTWIERDZENIE PŁATNOŚCI DLA KLIENTA', NULL, NULL, NULL, 45, 'ccwrcadmin', 6, NULL, NULL, NULL),
(262, 'CPG', '2017-09-28 17:24:42', NULL, NULL, 'JAN SERWISOWY 123123123', 'KLIENT JEST WYPŁACALNY, ZAGWARANTOWAŁ 3000PLN NA START', NULL, NULL, NULL, 45, 'ccwrcadmin', 6, NULL, NULL, NULL),
(263, 'RO', '2017-09-28 17:25:34', NULL, NULL, 'KUBA SERWISOWY 123123123', 'PRZEKAZAŁEM ZLECENIE NAPRAWY', NULL, NULL, NULL, 45, 'ccwrcadmin', 6, 5, NULL, NULL),
(264, 'ETA', '2017-09-28 17:27:14', '2017-09-28 18:20:00', NULL, 'KUBA SERWISOWY 123123', 'MAJA POTRZEBNE CZĘŚCI, BĘDĄ NA MIEJSCU OKOŁO GODZ. 18:20.', NULL, NULL, NULL, 45, 'ccwrcadmin', NULL, NULL, NULL, NULL),
(265, 'Out', '2017-09-28 17:27:54', NULL, NULL, 'KIEROWCA JAN 123123', 'POINFORMOWAŁEM O CZASIE DOJAZDU WOZU SERWISOWEGO.', NULL, NULL, NULL, 45, 'ccwrcadmin', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `vin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mileage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guarantee_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `vehicle`
--

INSERT INTO `vehicle` (`id`, `vin`, `street`, `city`, `phone`, `fax`, `mail`, `mileage`, `purchase_date`, `company_name`, `tax_id_number`, `contact_person`, `zip_code`, `registration_number`, `guarantee_type`, `name_type`, `dealer_id`) VALUES
(1, 'gyt55EDIT2', 'car street', 'car city', '22 phone', 'EDIT', 'EDIT', '11', '2015-07-04', 'company 1 EDIT2', '454545454545', 'jan kovalsky', '11-222', 'ws11www', 'FULL', 'Merc Daf11', 1),
(2, 'gyqt55', 'car street', 'car city', '22 phone', '324243234', '2342443434', '11', '2015-07-04', 'company 1', '454545454545', 'jan kovalsky22', '11-222', 'ws11www', 'NO WARRANTY', 'Merc Daf11', 1),
(3, 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', '22222', '2013-06-24', 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', 'FULL', 'truck 33', 1),
(4, 'wahfewfewew', 'sadfsaefsf 4/6', 'juyqgfwd', '2134121213', '123123123', '44E@uu.pl', '900', '2016-02-03', 'lkhdsokuqwdokuq', '243234234234', 'janek 8787887', '11-233', 'wi900000', 'FULL, end date: 2020-11-11', 'truck 11 460KM', 6),
(5, 'zwyklyVIN', 'ulica 1/1', 'miasto', 'tel. 3333', 'fax awaryjnby 3338888', 'brak', '100', '2015-04-06', 'zwykla firma', 'zwykly tax id', 'jenk 3339990000', '11-kod', 'po00000', 'ENGINE ONLY to 3 000 000 km', 'truck 747', 6),
(6, 'sdfd', 'dfg', 'dfg', 'dfg', 'dfg', 'fdg', 'dfg', '2012-01-01', 'dfg', 'dfg', 'dfg', 'dgf', 'dfg', 'dfg', 'dfg', 1),
(8, 'sfsfw434', 'qwe', 'qe', 'we', 'qwe', 'qwe', 'qwe', '2012-01-01', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 6),
(10, 'wer444', 'e', 'e', 'e', 'e', 'e', 'e', '2012-01-01', 'wer', 'we', 'e', 'e', 'e', 'e', 'e', 6),
(11, 'nowyVINNN', 'ulica', 'miasto', '9090909909', '9090900909', 'brak', '898', '2014-01-01', 'nowa firma', 'tax id', 'osoba kontaktowa 123 123 123', 'kod-999', 'uuuuu99', 'pełna do 2018.01.09', 'truck 555', 6),
(12, 'newvinform', '123', 'qwsdf', 'sdf', 'sdf', 'sdf', '4444', '2014-02-01', 'qwe', 'qwe', 'qwe 333333', 'sdf', 'sdf5555', 'empty', 'weerwrwer', 1),
(13, 'newvin12300', 'szcsd 2', 'wdeaxasx', '23423424', '121231', 'uyftdhtrd@uuu7.pl', '12333', '2017-01-01', 'sadfsEDIT', '234243', 'jukiu  4444444', '11-233', 'www1223e', 'empty', 'type 1 name 2', 3),
(14, '3243424', 'qweq', 'qwe', 'qwe', 'wer', 'qwe', 'qwe', '2012-01-01', 'qwe', 'qweqe', 'qweqwe', 'qwe', 'qwe', 'full', 'merc 11', 6),
(15, '1234567VV', 'ZWYKŁA ULICA', 'ZWYKŁE MIASTO', '22 123123', '22 123123', 'ZWYKLY@MAIL.PL', '12334', '2012-01-01', 'ZWYKŁA FIRMA', 'NIP123', 'JAN KOWALSKI 123123123', '11-233', 'WW123', 'BRAK', 'ZWYKŁA CIĘŻARÓWKA', 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `accident_case`
--
ALTER TABLE `accident_case`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_56A83C38545317D1` (`vehicle_id`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_17A339025E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_17A33902B1959E2A` (`main_mail`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA4F975DE7C7236B` (`accident_case_id`),
  ADD KEY `IDX_BA4F975D5A4A17E5` (`home_dealer_id`),
  ADD KEY `IDX_BA4F975D65F38CB8` (`repair_dealer_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1B80E486B1085141` (`vin`),
  ADD KEY `IDX_1B80E486249E6EA1` (`dealer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `accident_case`
--
ALTER TABLE `accident_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT dla tabeli `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;
--
-- AUTO_INCREMENT dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `accident_case`
--
ALTER TABLE `accident_case`
  ADD CONSTRAINT `FK_56A83C38545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Ograniczenia dla tabeli `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `FK_BA4F975D5A4A17E5` FOREIGN KEY (`home_dealer_id`) REFERENCES `dealer` (`id`),
  ADD CONSTRAINT `FK_BA4F975D65F38CB8` FOREIGN KEY (`repair_dealer_id`) REFERENCES `dealer` (`id`),
  ADD CONSTRAINT `FK_BA4F975DE7C7236B` FOREIGN KEY (`accident_case_id`) REFERENCES `accident_case` (`id`);

--
-- Ograniczenia dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `FK_1B80E486249E6EA1` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
