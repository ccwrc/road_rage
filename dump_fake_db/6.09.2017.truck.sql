-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 06 Wrz 2017, 16:12
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
  `vehicle_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `accident_case`
--

INSERT INTO `accident_case` (`id`, `damage_description`, `location`, `driver_contact`, `comment`, `info_sms`, `info_mail`, `status`, `progress_color`, `report_late`, `report_rs_time`, `report_nrs_time`, `report_repair_total`, `report_arrival_time`, `report_case_total`, `report_repair_status`, `vehicle_id`) VALUES
(1, 'opis uszkodzenia edit', 'lokacja w miescie edit', 'kontakt do kierowcy 444 555 555', 'zwykly komentarza', 'edit', 'edit', 'active', '#FF9C42', 11, 0, 666, 0, 0, 0, 'completed', 1),
(2, 'opis2 uszkodzenia2', 'lokacja w miesci22e', 'kontakt do kie22rowcy 444 555 555', 'zwykly22 komentarza', NULL, NULL, 'active', 'start', 123, 0, 0, 0, 0, 0, 'dfg', 1),
(3, 'sdfsfd', 'sdfs', 'sdf', 'empty comment', 'sdfs', 'dsf', 'active', 'start', 0, 1111, 0, 0, 0, 0, '0', 1),
(4, 'damage description', 'warsaw', 'jan99999999', 'start case', 'empty', 'empty', 'active', 'start', 0, 0, 0, 0, 0, 0, '0', 3),
(6, 'po prostu awarisa', '333w mieście', 'jan jankowski 123 456 789', 'zgloszenie awarii', 'brak', 'brak', 'active', 'start', 0, 0, 0, 33, 33, 33, 'notification', 11),
(7, 'sagds', 'sd', 'sdg', 'sdg', 'sdg', 'sdg', 'active', 'start', 0, 0, 11, 0, 0, 0, 'notification', 2),
(15, 'wer', 'wer', 'wer', 'werwerwrewrr', 'wer', 'wer', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 13),
(16, 'new date test', 'new date test', 'new date test', 'new date test', 'new date test', 'new date test', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 6),
(17, 'sedg', 'dsfg', 'dfg', 'dfg', 'dfg', 'dgf', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 1),
(18, 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'new chrome case', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 1),
(19, 'sfds', 'sdfsfd', 'sdfsdf', 'asdasd', '2222', 'asfdasdf', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 14),
(20, 'dsgt', 'ert', 'ert', 'ert', 'ert', 'ert', 'active', 'start', 0, 0, 0, 0, 0, 0, 'notification', 1),
(21, 'sdfg', 'dfg', 'dfg', 'dfg', 'dfg', 'dfg', 'active', '#E6E6E6', 0, 0, 0, 0, 0, 0, 'notification', 1),
(22, 'new', 'n', 'n edit', 'n case edit detal', 'n', 'n', 'active', '#FF7575', 0, 0, 0, 0, 0, 0, 'initialization', 13),
(23, 'r', 'r', 'r', 'r', 'r', 'r', 'active', '#FF7575', 0, 0, 0, 0, 0, 0, 'initialization', 1);

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
(1, 'ccwrcadmin', 'ccwrcadmin', 'ccwrcadmin@gmail.elo', 'ccwrcadmin@gmail.elo', 1, NULL, '$2y$13$mdUZimf2vJ/q5o1SqQSRh.m6ldO29NGHlCcCuIsFjU1bdWNAT9w8u', '2017-09-06 14:23:09', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'ccwrcoperator', 'ccwrcoperator', 'ccwrcoperator@gmail.elo', 'ccwrcoperator@gmail.elo', 1, NULL, '$2y$13$NPahNgRTTcYYeafyiKg0x.RS35r6nAu79N4pzKUj8ajLc5fH2EB4W', '2017-09-04 12:20:37', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_OPERATOR\";}'),
(3, 'ccwrcuser', 'ccwrcuser', 'ccwrcuser@gmail.elo', 'ccwrcuser@gmail.elo', 1, NULL, '$2y$13$85Y1dC2YeX05aYoxrLAgOOmjsHKCaObP1t7c08ympJGrufzmX6lGe', '2017-07-26 14:46:43', NULL, NULL, 'a:0:{}'),
(4, 'ccwrcdealer', 'ccwrcdealer', 'ccwrcdealer@ccwrcdealer.elo', 'ccwrcdealer@ccwrcdealer.elo', 1, NULL, '$2y$13$garsgYLil1hIyV7yu7dXGuHYGB2TELZgcca/wiUN4WdGN824meA2K', '2017-07-26 14:51:12', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_DEALER\";}'),
(5, 'ccwrcsuperadmin', 'ccwrcsuperadmin', 'ccwrcsuperadmin@gmail.elo', 'ccwrcsuperadmin@gmail.elo', 1, NULL, '$2y$13$eFT7Nt2mA3zltKru5pmfJO5RtLGB7SrCgfUIBUcAy.TQFJsjKcNgO', '2017-07-26 14:54:32', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}');

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
(27, 'START', '2017-08-09 16:57:52', NULL, NULL, 'new chrome case', 'new chrome case', NULL, NULL, NULL, 18, 'ccwrcoperator', NULL, NULL, NULL, NULL),
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
(99, 'ETA', '2017-09-06 14:36:15', '2017-09-06 14:36:00', NULL, 'sdeg', 'dfg', NULL, NULL, NULL, 1, 'ccwrcadmin', NULL, NULL, NULL, NULL);

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
(2, 'gyqt55', 'car street', 'car city', '22 phone', NULL, NULL, '11', '2015-07-04', 'company 1', '454545454545', 'jan kovalsky22', '11-222', 'ws11www', 'NO WARRANTY', 'Merc Daf11', 1),
(3, 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', '22222', '2013-06-24', 'new form test', 'new form test', 'new form test', 'new form test', 'new form test', 'FULL', 'truck 33', 1),
(4, 'wahfewfewew', 'sadfsaefsf 4/6', 'juyqgfwd', '2134121213', '123123123', '44E@uu.pl', '900', '2016-02-03', 'lkhdsokuqwdokuq', '243234234234', 'janek 8787887', '11-233', 'wi900000', 'FULL, end date: 2020-11-11', 'truck 11 460KM', 6),
(5, 'zwyklyVIN', 'ulica 1/1', 'miasto', 'tel. 3333', 'fax awaryjnby 3338888', 'brak', '100', '2015-04-06', 'zwykla firma', 'zwykly tax id', 'jenk 3339990000', '11-kod', 'po00000', 'ENGINE ONLY to 3 000 000 km', 'truck 747', 6),
(6, 'sdfd', 'dfg', 'dfg', 'dfg', 'dfg', 'fdg', 'dfg', '2012-01-01', 'dfg', 'dfg', 'dfg', 'dgf', 'dfg', 'dfg', 'dfg', 1),
(8, 'sfsfw434', 'qwe', 'qe', 'we', 'qwe', 'qwe', 'qwe', '2012-01-01', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 'qwe', 6),
(10, 'wer444', 'e', 'e', 'e', 'e', 'e', 'e', '2012-01-01', 'wer', 'we', 'e', 'e', 'e', 'e', 'e', 6),
(11, 'nowyVINNN', 'ulica', 'miasto', '9090909909', '9090900909', 'brak', '898', '2014-01-01', 'nowa firma', 'tax id', 'osoba kontaktowa 123 123 123', 'kod-999', 'uuuuu99', 'pełna do 2018.01.09', 'truck 555', 6),
(12, 'newvinform', '123', 'qwsdf', 'sdf', 'sdf', 'sdf', '4444', '2014-02-01', 'qwe', 'qwe', 'qwe 333333', 'sdf', 'sdf5555', 'empty', 'weerwrwer', 1),
(13, 'newvin12300', 'szcsd 2', 'wdeaxasx', '23423424', '121231', 'uyftdhtrd@uuu7.pl', '12333', '2017-01-01', 'sadfsEDIT', '234243', 'jukiu  4444444', '11-233', 'www1223e', 'empty', 'type 1 name 2', 3),
(14, '3243424', 'qweq', 'qwe', 'qwe', 'wer', 'qwe', 'qwe', '2012-01-01', 'qwe', 'qweqe', 'qweqwe', 'qwe', 'qwe', 'full', 'merc 11', 6);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
