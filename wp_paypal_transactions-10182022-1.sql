-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2022 at 08:01 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `davelkwd_wrdp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_paypal_transactions`
--

CREATE TABLE `wp_paypal_transactions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `shop_txn_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txn_id` int(11) DEFAULT NULL,
  `item_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pending_reason` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mc_gross` decimal(8,2) DEFAULT NULL,
  `mc_fee` decimal(6,2) DEFAULT NULL,
  `mc_net` decimal(8,2) DEFAULT NULL,
  `tax` decimal(6,2) DEFAULT NULL,
  `mc_currency` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_street` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_state` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_country_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residence_country` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_subject` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payer_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `notify_version` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_sign` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referrer_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `business` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ipn_track_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_ipn` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wp_paypal_transactions`
--

INSERT INTO `wp_paypal_transactions` (`id`, `user_id`, `shop_txn_id`, `txn_id`, `item_name`, `item_number`, `timestamp`, `payment_date`, `receiver_email`, `payment_status`, `payment_type`, `payer_status`, `pending_reason`, `mc_gross`, `mc_fee`, `mc_net`, `tax`, `mc_currency`, `currency_code`, `first_name`, `last_name`, `address_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `address_country_code`, `residence_country`, `address_status`, `payer_email`, `transaction_subject`, `payer_id`, `notify_version`, `verify_sign`, `referrer_id`, `business`, `ipn_track_id`, `test_ipn`) VALUES
(163, 6518, '6518:2022-10-18@193758', 514331769, 'membership', '', '20221018-193758', '20%3A12%3A59+Jan+13%2C+2009+PS', 'gpmac_1231902686_biz%40paypal.com', 'Verified', 'instant', 'verified', NULL, '40.00', '1.46', '38.54', NULL, 'USD', 'USD', 'Don', 'Lemon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'buyer%40paypalsandbox.com', '', 'LPLWNMTBWMFAY', NULL, 'AtkOfCXbDm', NULL, NULL, NULL, ''),
(164, 7211, '7211:2022-10-18@193823', 709789338, 'membership', '', '20221018-193823', '20%3A12%3A59+Jan+13%2C+2009+PS', 'gpmac_1231902686_biz%40paypal.com', 'Verified', 'instant', 'verified', NULL, '40.00', '1.46', '38.54', NULL, 'USD', 'USD', 'Don', 'Lemon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'buyer%40paypalsandbox.com', '', 'LPLWNMTBWMFAY', NULL, 'AtkOfCXbDm', NULL, NULL, NULL, ''),
(165, 8303, '8303:20221018-194034', 168432978, '', '', '20221018-194034', '19:40:15 Oct 17, 2022 PDT', 'seller@paypalsandbox.com', 'Processed', 'echeck', 'verified', NULL, '12.34', '0.66', '11.68', NULL, 'USD', '', 'David', 'Van Abel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'buyer@paypalsandbox.com', '', 'TESTBUYERID01', NULL, 'ApgU2jisch', NULL, NULL, NULL, ''),
(166, 7483, '7483:2022-10-18@194657', 598037237, 'membership', '', '20221018-194657', '20%3A12%3A59+Jan+13%2C+2009+PS', 'gpmac_1231902686_biz%40paypal.com', 'Verified', 'instant', 'verified', NULL, '40.00', '1.46', '38.54', NULL, 'USD', 'USD', 'Don', 'Lemon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'buyer%40paypalsandbox.com', '', 'LPLWNMTBWMFAY', NULL, 'AtkOfCXbDm', NULL, NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_paypal_transactions`
--
ALTER TABLE `wp_paypal_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IPN-Txn-ID-Status-Type` (`txn_id`,`payment_status`,`payment_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_paypal_transactions`
--
ALTER TABLE `wp_paypal_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
