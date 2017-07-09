-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2017 at 12:31 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `truck`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_case`
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
  `progress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Dumping data for table `accident_case`
--

INSERT INTO `accident_case` (`id`, `damage_description`, `location`, `driver_contact`, `comment`, `info_sms`, `info_mail`, `status`, `progress`, `report_late`, `report_rs_time`, `report_nrs_time`, `report_repair_total`, `report_arrival_time`, `report_case_total`, `report_repair_status`, `vehicle_id`) VALUES
(1, 'opis uszkodzenia', 'lokacja w miescie', 'kontakt do kierowcy 444 555 555', 'zwykly komentarza', NULL, NULL, 'active', 'start', 0, 0, 0, 0, 0, 0, NULL, 1),
(2, 'opis2 uszkodzenia2', 'lokacja w miesci22e', 'kontakt do kie22rowcy 444 555 555', 'zwykly22 komentarza', NULL, NULL, 'active', 'start', 0, 0, 0, 0, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
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
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`id`, `name`, `street`, `zip_code`, `city`, `main_phone`, `main_fax`, `main_mail`, `phone_24h`, `phone_service_car`, `alt_phone_1`, `alt_phone_2`, `alt_mail_1`, `alt_mail_2`, `other_comments`, `is_active`) VALUES
(1, 'serwis 1', 'ulica', '33-334', 'miasto', '22 3334422', '22 3334422', 'mail@serwis1.elo', '600100600', NULL, '600100900', NULL, NULL, NULL, 'brak numeru telefonu do wozu serwisowego', 'active'),
(3, 'serwis 2', 'ulica', '33-324', 'miasto2', '22 3334422', '22 3334422', 'mail@serwis2.elo', '600100600', NULL, '600100900', NULL, NULL, NULL, 'brak numeru telefonu do wozu serwisowego', 'active'),
(4, 'old1', 'old street 11/332', '11-112', 'old city', NULL, NULL, 'old@mail.elo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactive'),
(5, 'old2', 'old street 11/32', '19-112', 'old city', NULL, NULL, 'old2@mail.elo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'suspended'),
(6, 'AllData', 'super street 1', '11-111', 'super city', '23 1112211', '23 1112211', 'super@mail.elo', '111222333', '333222111', '22 33', '33 22', 'ma1@ma.elo', 'ma2@m.elo', 'wszystkie dane, dealer aktywny od 1.2.2017', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
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
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'ccwrcadmin', 'ccwrcadmin', 'ccwrcadmin@gmail.elo', 'ccwrcadmin@gmail.elo', 1, NULL, '$2y$13$mdUZimf2vJ/q5o1SqQSRh.m6ldO29NGHlCcCuIsFjU1bdWNAT9w8u', '2017-07-08 16:29:13', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'ccwrcoperator', 'ccwrcoperator', 'ccwrcoperator@gmail.elo', 'ccwrcoperator@gmail.elo', 1, NULL, '$2y$13$NPahNgRTTcYYeafyiKg0x.RS35r6nAu79N4pzKUj8ajLc5fH2EB4W', '2017-07-04 16:00:34', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_OPERATOR\";}'),
(3, 'ccwrcuser', 'ccwrcuser', 'ccwrcuser@gmail.elo', 'ccwrcuser@gmail.elo', 1, NULL, '$2y$13$85Y1dC2YeX05aYoxrLAgOOmjsHKCaObP1t7c08ympJGrufzmX6lGe', '2017-07-02 12:51:01', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code_description` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_save` datetime NOT NULL,
  `time_set` datetime DEFAULT NULL,
  `document` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_through` longtext COLLATE utf8_unicode_ci,
  `comments` longtext COLLATE utf8_unicode_ci,
  `out_comment` longtext COLLATE utf8_unicode_ci,
  `home_dealer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `repair_dealer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_mails` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accident_case_id` int(11) DEFAULT NULL,
  `operator` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id`, `code`, `code_description`, `time_save`, `time_set`, `document`, `contact_through`, `comments`, `out_comment`, `home_dealer`, `repair_dealer`, `contact_mail`, `optional_mails`, `accident_case_id`, `operator`) VALUES
(1, 'START', 'start case', '2017-07-09 01:00:00', NULL, NULL, 'kierowca 122 122 122', 'zgloszenie awarii', NULL, '', NULL, NULL, NULL, 1, 'ccwrcuser'),
(2, 'PG', 'payment guarantee', '2017-07-09 01:10:00', NULL, NULL, 'dealer 111 111 111', 'przeslanie prosby o potwrierdzenie platnosci', NULL, 'dealer 1', NULL, NULL, NULL, 1, 'ccwrcoperator'),
(3, 'CPG', 'confirmation payment guarantee', '2017-07-09 01:12:00', NULL, NULL, 'mail od jan kowalski dealer 1', 'zagwarantowal platnosc za klienta', NULL, '', NULL, NULL, NULL, NULL, 'ccwrcoperator');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
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
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `vin`, `street`, `city`, `phone`, `fax`, `mail`, `mileage`, `purchase_date`, `company_name`, `tax_id_number`, `contact_person`, `zip_code`, `registration_number`, `guarantee_type`, `name_type`, `dealer_id`) VALUES
(1, 'gyt55', 'car street', 'car city', '22 phone', NULL, NULL, '11', '2015-07-04', 'company 1', '454545454545', 'jan kovalsky', '11-222', 'ws11www', 'FULL', 'Merc Daf11', 1),
(2, 'gyqt55', 'car street', 'car city', '22 phone', NULL, NULL, '11', '2015-07-04', 'company 1', '454545454545', 'jan kovalsky22', '11-222', 'ws11www', 'NO WARRANTY', 'Merc Daf11', 1);

--
-- Indexes for dumped tables
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
  ADD KEY `IDX_BA4F975DE7C7236B` (`accident_case_id`);

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
-- AUTO_INCREMENT for table `accident_case`
--
ALTER TABLE `accident_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accident_case`
--
ALTER TABLE `accident_case`
  ADD CONSTRAINT `FK_56A83C38545317D1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`);

--
-- Constraints for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `FK_BA4F975DE7C7236B` FOREIGN KEY (`accident_case_id`) REFERENCES `accident_case` (`id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `FK_1B80E486249E6EA1` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
