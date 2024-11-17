-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 11:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(32) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `user_name` varchar(20) DEFAULT NULL,
  `password` mediumtext DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `lang` varchar(5) DEFAULT NULL,
  `block_reason` mediumtext DEFAULT NULL,
  `reg_date` varchar(50) DEFAULT NULL,
  `last_seen` varchar(50) DEFAULT NULL,
  `last_update` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bank` varchar(1) NOT NULL DEFAULT '0',
  `icon` varchar(1) NOT NULL DEFAULT '0',
  `slider` varchar(1) NOT NULL DEFAULT '0',
  `add_money` varchar(1) NOT NULL DEFAULT '0',
  `visitor` varchar(1) NOT NULL DEFAULT '0',
  `contact` varchar(1) NOT NULL DEFAULT '0',
  `admin` varchar(1) NOT NULL DEFAULT '0',
  `deposit` varchar(1) NOT NULL DEFAULT '0',
  `news_letter` varchar(1) NOT NULL DEFAULT '0',
  `feedback` varchar(1) NOT NULL DEFAULT '0',
  `users` varchar(1) NOT NULL DEFAULT '0',
  `user_balance` varchar(1) NOT NULL DEFAULT '0',
  `licences_key` varchar(1) NOT NULL DEFAULT '0',
  `web_config` varchar(1) NOT NULL DEFAULT '0',
  `discount` varchar(1) NOT NULL DEFAULT '0',
  `transaction` varchar(1) NOT NULL DEFAULT '0',
  `update_access` varchar(1) NOT NULL DEFAULT '0',
  `language` varchar(1) NOT NULL DEFAULT '0',
  `currency` varchar(1) NOT NULL DEFAULT '0',
  `payment_method` varchar(1) NOT NULL DEFAULT '0',
  `module` varchar(1) NOT NULL DEFAULT '0',
  `sms` varchar(1) DEFAULT '0',
  `service` varchar(1) NOT NULL DEFAULT '0',
  `email_access` varchar(1) NOT NULL DEFAULT '0',
  `payment` varchar(1) NOT NULL DEFAULT '0',
  `refer` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `user_name`, `password`, `email`, `phone`, `lang`, `block_reason`, `reg_date`, `last_seen`, `last_update`, `status`, `bank`, `icon`, `slider`, `add_money`, `visitor`, `contact`, `admin`, `deposit`, `news_letter`, `feedback`, `users`, `user_balance`, `licences_key`, `web_config`, `discount`, `transaction`, `update_access`, `language`, `currency`, `payment_method`, `module`, `sms`, `service`, `email_access`, `payment`, `refer`) VALUES
('6a5ada64b9fced4f781d56a3936ec02c', 'Admin', 'admin', '$2y$10$sX79S1ECIz9LCZ2fdIww4.MFxMygL5L3e5vEBDyUsZU5MjQGpYibC', 'admin@admin.com', '08011111111', NULL, NULL, '1596034613', '1597223788', '1596034613', NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ad_banner`
--

CREATE TABLE `ad_banner` (
  `id` varchar(32) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `active` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `airtime_cash`
--

CREATE TABLE `airtime_cash` (
  `id` varchar(32) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `request_id` varchar(32) DEFAULT NULL,
  `process` int(1) DEFAULT 0,
  `message` text NOT NULL,
  `process_time` varchar(30) DEFAULT NULL,
  `voucher` varchar(50) DEFAULT NULL,
  `network` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_test_pay`
--

CREATE TABLE `api_test_pay` (
  `id` varchar(32) NOT NULL,
  `request_id` text DEFAULT NULL,
  `service_id` varchar(32) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `user` varchar(34) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `transaction_value` longtext DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `refer` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_transaction`
--

CREATE TABLE `api_transaction` (
  `id` varchar(32) NOT NULL,
  `request_id` varchar(32) DEFAULT NULL,
  `service_id` varchar(32) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `user` varchar(32) DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `ini_balance` varchar(20) DEFAULT NULL,
  `final_balance` varchar(20) DEFAULT NULL,
  `pay_amount` varchar(20) DEFAULT NULL,
  `fee` varchar(10) DEFAULT NULL,
  `transaction_value` longtext DEFAULT NULL,
  `error_level` varchar(1) DEFAULT '0',
  `gateway_response` text DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `refer` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` varchar(32) NOT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(32) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rate`
--

CREATE TABLE `commission_rate` (
  `service` varchar(32) NOT NULL DEFAULT '0',
  `registered_user` varchar(20) DEFAULT '0',
  `registered_user_percentage` varchar(20) NOT NULL DEFAULT '0',
  `unregistered_user` varchar(20) NOT NULL DEFAULT '0',
  `unregistered_user_percentage` varchar(20) NOT NULL DEFAULT '0',
  `api_user` varchar(20) NOT NULL DEFAULT '0',
  `api_user_percentage` varchar(20) DEFAULT '0',
  `referrer_user` varchar(20) DEFAULT '0',
  `referrer_user_percentage` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` varchar(32) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `symbol` varchar(50) DEFAULT NULL,
  `rate` varchar(20) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `symbol`, `rate`, `active`) VALUES
('2567t796r856980709o8yoii8769ovov', 'Naira', 'NGN', '&amp;#8358;', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` varchar(32) NOT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `owner` varchar(32) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ini_balance` varchar(20) DEFAULT NULL,
  `final_balance` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `display_value`
--

CREATE TABLE `display_value` (
  `id` varchar(32) NOT NULL,
  `service` varchar(32) DEFAULT NULL,
  `display_name` tinytext DEFAULT NULL,
  `name` tinytext DEFAULT NULL,
  `view_order` varchar(10) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` varchar(32) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` varchar(32) NOT NULL,
  `service` varchar(32) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `display_name` text DEFAULT NULL,
  `regx` tinytext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `class_name` tinytext DEFAULT NULL,
  `attribute` tinytext DEFAULT NULL,
  `max_len` varchar(4) DEFAULT NULL,
  `required` varchar(1) NOT NULL DEFAULT '0',
  `order_key` varchar(11) DEFAULT NULL,
  `reg_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gateway_form`
--

CREATE TABLE `gateway_form` (
  `id` varchar(32) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `value` mediumtext DEFAULT NULL,
  `name` tinytext DEFAULT NULL,
  `gateway` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guest_payment`
--

CREATE TABLE `guest_payment` (
  `id` varchar(32) NOT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `gateway_response` text DEFAULT NULL,
  `fee` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest_payment`
--

INSERT INTO `guest_payment` (`id`, `amount`, `transaction_id`, `reg_date`, `status`, `ref`, `gateway_response`, `fee`) VALUES
('T410314681750055', '100', '2429646481', '1576149026', 'success', NULL, 'Verification successful', '0'),
('T596283245119164', '100', '1737430098', '1576151060', 'success', NULL, 'Verification successful', '0'),
('T789855826095001', '200', '2784578565', '1576183127', 'success', NULL, 'Verification successful', '0'),
('T934988033776652', '5', '3022136519', '1576313932', 'failed', NULL, 'Invalid key', '0'),
('T484412796215163', '400.00', '2254491088', '1576317609', 'failed', NULL, 'Invalid key', '0'),
('T434059575534473', '5', '2021264697', '1576318838', 'failed', NULL, 'Invalid key', '0'),
('T264809167933103', '400.00', '2254491088', '1576318966', 'failed', NULL, 'Invalid key', '0'),
('T555540974503700', '5', '3020043297', '1576320998', 'failed', NULL, 'Invalid key', '0'),
('T386088711594626', '5', '2443153868', '1576321201', 'success', NULL, 'Verification successful', '0'),
('T850167157905759', '1900', '2604418140', '1576321563', 'success', NULL, 'Verification successful', '0'),
('T294498792843719', '5', '2515533736', '1576323554', 'success', NULL, 'Verification successful', '0'),
('T460273689493522', '5', '2242307913', '1576324142', 'success', NULL, 'Verification successful', '0'),
('T524023228778405', '5', '2069220503', '1576324858', 'success', NULL, 'Verification successful', '0'),
('T519862807534096', '5', '2746941936', '1576324966', 'success', NULL, 'Verification successful', '0'),
('T367925548709702', '5', '1945077480', '1576326722', 'success', NULL, 'Verification successful', '0'),
('T517412499111257', '5', '1777120760', '1576327432', 'success', NULL, 'Verification successful', '0'),
('T410029370031532', '5', '1990076011', '1576328219', 'success', NULL, 'Verification successful', '0'),
('T039772087836209', '19', '2614939012', '1576328563', 'success', NULL, 'Verification successful', '0'),
('T929406697825024', '5', '3456380200', '1576329246', 'success', NULL, 'Verification successful', '0'),
('T675421980808197', '10', '2052917679', '1576329473', 'success', NULL, 'Verification successful', '0'),
('T812674499720219', '5', '1951654754', '1576511003', 'success', NULL, 'Verification successful', '0'),
('T429514004775460', '5', '2580959066', '1576511225', 'success', NULL, 'Verification successful', '0'),
('T111151087030827', '5', '2580959066', '1576511328', 'success', NULL, 'Verification successful', '0'),
('T976309480638267', '5', '1859849122', '1576511383', 'success', NULL, 'Verification successful', '0'),
('T859856140774320', '5', '1913252257', '1576511467', 'success', NULL, 'Verification successful', '0'),
('T922026078427675', '5', '2999165403', '1576513033', 'success', NULL, 'Verification successful', '0'),
('T068636416931757', '5', '2808423608', '1576513616', 'success', NULL, 'Verification successful', '0'),
('T096445472292719', '5', '1740517020', '1576524673', 'success', NULL, 'Verification successful', '0'),
('T730803498671482', '100', '2632903681', '1576527283', 'success', NULL, 'Verification successful', '0'),
('T186307769049865', '5', '2936658480', '1576527526', 'success', NULL, 'Verification successful', '0'),
('T001768484247056', '100', '3069176733', '1576527861', 'success', NULL, 'Verification successful', '0'),
('T405547593355860', '100', '3068675161', '1576527989', 'success', NULL, 'Verification successful', '0'),
('T620788632401814', '1000', '2881008859', '1576535373', 'success', NULL, 'Verification successful', '0'),
('T009824684337925', '5', '2040214971', '1576589665', 'success', NULL, 'Verification successful', '0'),
('T946846754616688', '5', '2040214971', '1576589727', 'success', NULL, 'Verification successful', '0'),
('T747557940087383', '5', '2519997402', '1576589785', 'success', NULL, 'Verification successful', '0'),
('T635874933158297', '5', '2938002350', '1576665246', 'success', NULL, 'Verification successful', '0'),
('T624595375912842', '5', '2165141670', '1576665391', 'success', NULL, 'Verification successful', '0'),
('T513583859416176', '5', '3037272243', '1576672505', 'success', NULL, 'Verification successful', '0'),
('T863328379754746', '50', '2552240132', '1576672907', 'success', NULL, 'Verification successful', '0'),
('T862406860555859', '5', '3596673703', '1576683392', 'success', NULL, 'Verification successful', '0'),
('T022950916812433', '1000', '3712070537', '1576752533', 'success', NULL, 'Verification successful', '0'),
('T626316850654186', '500', '2793804698', '1576755145', 'success', NULL, 'Verification successful', '0'),
('T847895143954542', '1000.00', '2294312124', '1576773000', 'success', NULL, 'Verification successful', '0'),
('T628723133754484', '500', '3641792427', '1576774693', 'success', NULL, 'Verification successful', '0'),
('T172961966066214', '1000', '2297382102', '1576782394', 'success', NULL, 'Verification successful', '0'),
('T284502869977384', '2000', '3083846661', '1576785791', 'success', NULL, 'Verification successful', '0'),
('T502623124304789', '5', '2915068523', '1576844300', 'success', NULL, 'Verification successful', '0'),
('T043951528049533', '5', '2060873129', '1576861582', 'success', NULL, 'Verification successful', '0'),
('T429496988251966', '5', '2024033243', '1577220702', 'success', NULL, 'Verification successful', '0'),
('T762475695757612', '5', '3722207790', '1578413835', 'success', NULL, 'Verification successful', '0'),
('T358064173654053', '5', '1954471115', '1578413941', 'success', NULL, 'Verification successful', '0'),
('T480327189488651', '5', '2558426006', '1578427032', 'success', NULL, 'Verification successful', '0'),
('T717719184751651', '5', '2821873885', '1578427377', 'success', NULL, 'Verification successful', '0'),
('T710982898506524', '5', '2389277214', '1578427882', 'success', NULL, 'Verification successful', '0'),
('T571629576701422', '1000', '2886368664', '1584102007', 'success', NULL, 'Verification successful', '0'),
('T285134636354278', '1000', '2473040565', '1584103700', 'success', NULL, 'Verification successful', '0'),
('T541992762284256', '5000', '2925585820', '1584104330', 'success', NULL, 'Verification successful', '0'),
('T220976275080032', '50', '1851286220', '1584105998', 'success', NULL, 'Verification successful', '0'),
('T353821304062771', '100', '3495237684', '1584106119', 'success', NULL, 'Verification successful', '0'),
('T634734497242249', '350', '3664135402', '1584106598', 'success', NULL, 'Verification successful', '0'),
('T452784439230324', '1000', '2298025330', '1586447883', 'success', NULL, 'Verification successful', '0'),
('T798522480696424', '100000', '3113207217', '1586449491', 'success', NULL, 'Verification successful', '0'),
('T510219216896774', '1000', '1701185307', '1586467936', 'success', NULL, 'Verification successful', '0'),
('T742261434935104', '100', '3442929186', '1586515068', 'success', NULL, 'Verification successful', '0'),
('T021757201811049', '100', '2236803097', '1586515559', 'success', NULL, 'Verification successful', '0'),
('T069801818712510', '100', '3001758752', '1587893860', 'success', NULL, 'Verification successful', '0'),
('T044863210333650', '100', '3339109440', '1587894514', 'success', NULL, 'Verification successful', '0'),
('T729300015893926', '5', '3565713991', '1587894888', 'success', NULL, 'Verification successful', '0'),
('T753285749653411', '5', '2463341601', '1587895106', 'success', NULL, 'Verification successful', '0'),
('T788530481229117', '150', '2588463771', '1587895580', 'success', NULL, 'Verification successful', '0'),
('T783824285192514', '5', '3392171758', '1587896267', 'success', NULL, 'Verification successful', '0'),
('T415204447261535', '100', '3248189023', '1587993113', 'success', NULL, 'Verification successful', '0'),
('T934483921630256', '5', '2466215487', '1587993914', 'success', NULL, 'Verification successful', '0'),
('T613607191740187', '100', '2801712865', '1588009495', 'success', NULL, 'Verification successful', '0'),
('T535481592764585', '500', '2064450583', '1588015812', 'success', NULL, 'Verification successful', '0'),
('T884358407535479', '1000', '3205126556', '1588098620', 'success', NULL, 'Verification successful', '48'),
('637396011', '500', '2184377431', '1588283536', 'failed', NULL, '', '50'),
('undefined', '100', '2484627410', '1590969339', 'failed', NULL, '', '50'),
('T508861369145079', '100', '2485812770', '1591453994', 'success', NULL, 'Verification successful', '2.8'),
('T961002494923461', '40', '1906403775', '1591894838', 'success', NULL, 'Verification successful', '1.12'),
('T111903896529065', '400', '2945248172', '1591894994', 'success', NULL, 'Verification successful', '11.2'),
('T273347984770539', '400', '2240638536', '1591895216', 'success', NULL, 'Verification successful', '11.2'),
('T107325849472323', '40', '3677984415', '1591897095', 'success', NULL, 'Verification successful', '1.12'),
('T030034765849149', '110', '2627880535', '1591902697', 'success', NULL, 'Verification successful', '3.08'),
('T422623325113609', '1640.00', '1809777491', '1591903735', 'success', NULL, 'Verification successful', '45.92'),
('T253092834451942', '1850.00', '2213609522', '1591904273', 'success', NULL, 'Verification successful', '51.8'),
('T185317562232690', '100.00', '2276505013', '1591904412', 'success', NULL, 'Verification successful', '2.8'),
('T892098968910531', '150', '3648900651', '1591904541', 'success', NULL, 'Verification successful', '4.2'),
('T239010572919220', '410.00', '3684533457', '1591904794', 'success', NULL, 'Verification successful', '11.48'),
('T794558916832610', '100.00', '2915825271', '1591905020', 'success', NULL, 'Verification successful', '2.8'),
('T489893740575862', '900.00', '3734075164', '1591905147', 'success', NULL, 'Verification successful', '25.2'),
('T697277591676567', '120', '3091421295', '1591905343', 'success', NULL, 'Verification successful', '3.36'),
('T916695104982001', '100.00', '2884901181', '1591905464', 'success', NULL, 'Verification successful', '2.8'),
('T834938231671449', '40', '2863582795', '1592134894', 'success', NULL, 'Verification successful', '1.12'),
('T080216516020331', '400', '1603273902', '1592134946', 'success', NULL, 'Verification successful', '11.2'),
('T516708922611108', '200.00', '2190807508', '1592135472', 'success', NULL, 'Verification successful', '5.6'),
('T894834591994305', '50', '1878258085', '1592155658', 'success', NULL, 'Verification successful', '1.4'),
('T284722156121159', '22750.00', '2404593749', '1592158955', 'success', NULL, 'Verification successful', '637'),
('T885675947510338', '50', '2468904909', '1592814433', 'success', NULL, 'Verification successful', '1.4'),
('T342268851680515', '50', '2027228750', '1592815549', 'success', NULL, 'Verification successful', '1.4'),
('T259089049196548', '50', '2554979885', '1592912808', 'success', NULL, 'Verification successful', '1.4'),
('T342202523521923', '50', '2332473803', '1592913772', 'success', NULL, 'Verification successful', '1.4'),
('T092453341431384', '1200', '2496674990', '1592926487', 'success', NULL, 'Verification successful', '33.6'),
('T457769713222482', '50', '1913055737', '1592931929', 'success', NULL, 'Verification successful', '1.4'),
('T709508181824586', '410.00', '3253489165', '1592932492', 'success', NULL, 'Verification successful', '11.48'),
('T188236541150190', '410.00', '2104916987', '1592933200', 'success', NULL, 'Verification successful', '11.48'),
('T602815434364102', '100', '2896566696', '1592946430', 'success', NULL, 'Verification successful', '2.8'),
('T762145725053981', '100.00', '2190052100', '1592946811', 'success', NULL, 'Verification successful', '2.8'),
('T196095735347269', '2460.00', '3229491184', '1594801561', 'success', NULL, 'Verification successful', '68.88'),
('T681587800886564', '2460.00', '3106753472', '1594802019', 'success', NULL, 'Verification successful', '68.88'),
('T014519078669574', '2460.00', '1802174953', '1594802227', 'success', NULL, 'Verification successful', '68.88'),
('T352886230502099', '1050', '2187186095', '1595409872', 'success', NULL, 'Verification successful', '29.4'),
('T243716326003898', '1050', '3437604400', '1595410520', 'success', NULL, 'Verification successful', '29.4'),
('T079950563441211', '350', '1875125225', '1595412089', 'success', NULL, 'Verification successful', '9.8'),
('T436046221504400', '1050', '2117968176', '1595416657', 'success', NULL, 'Verification successful', '29.4'),
('T852814447698638', '1050', '2660364197', '1595420113', 'success', NULL, 'Verification successful', '29.4'),
('T470547044185455', '1050', '3497750843', '1595429899', 'success', NULL, 'Verification successful', '29.4'),
('T277085985839966', '1050', '2681737964', '1595432432', 'success', NULL, 'Verification successful', '29.4'),
('T657516045211002', '1050', '1813762728', '1595434141', 'success', NULL, 'Verification successful', '29.4'),
('T681216078668814', '100', '2271001508', '1595848702', 'success', NULL, 'Verification successful', '2.8'),
('T715646989270271', '1000', '2583346196', '1595848796', 'success', NULL, 'Verification successful', '28'),
('T527254837558176', '1000', '2785477508', '1595849141', 'success', NULL, 'Verification successful', '28'),
('T456910025956745', '500.00', '1922961762', '1595849611', 'success', NULL, 'Verification successful', '14'),
('T831931798134459', '2500.00', '2667770094', '1595850504', 'success', NULL, 'Verification successful', '70');

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` varchar(32) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `code` varchar(11) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `name`, `file_name`, `code`, `active`) VALUES
('35d42476dbfd109c02924bb74a5d7e11', 'English', 'en.php', 'en', '1'),
('399a1ec97b825808c721eaa3417645f7', 'French', 'fr.php', 'fr', '1'),
('399ae7b8258e08c721eweaae76541764', 'Arabic', 'ar.php', 'ar', '1');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `key_value` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `doc` tinytext DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `option_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`key_value`, `name`, `doc`, `type`, `option_value`) VALUES
('CURLOPT_CUSTOMREQUEST', 'curl_custom_request', 'https://curl.haxx.se/libcurl/c/CURLOPT_CUSTOMREQUEST.html', 'option', 'GET,POST'),
('CURLOPT_FOLLOWLOCATION', 'curl_follow_redirect', 'https://curl.haxx.se/libcurl/c/CURLOPT_FOLLOWLOCATION.html', 'option', 'true,false'),
('CURLOPT_HTTP_VERSION', 'curl_http_version', 'https://curl.haxx.se/libcurl/c/CURLOPT_HTTP_VERSION.html', 'option', 'CURL_HTTP_VERSION_NONE,CURL_HTTP_VERSION_1_0,CURL_HTTP_VERSION_1_1,CURL_HTTP_VERSION_1_1,CURL_HTTP_VERSION_2_0,CURL_HTTP_VERSION_2TLS,CURL_HTTP_VERSION_2_PRIOR_KNOWLEDGE'),
('CURLOPT_MAXREDIRS', 'curl_max_redirect', 'https://curl.haxx.se/libcurl/c/CURLOPT_MAXREDIRS.html', 'text', ''),
('CURLOPT_POST', 'curl_request_http_post', 'https://curl.haxx.se/libcurl/c/CURLOPT_POST.html', 'option', 'true,false'),
('CURLOPT_POSTREDIR', 'curl_post_redirect', 'https://curl.haxx.se/libcurl/c/CURLOPT_POSTREDIR.html', 'text', ''),
('CURLOPT_REFERER', 'curl_referrer', 'https://curl.haxx.se/libcurl/c/CURLOPT_REFERER.html', 'text', ''),
('CURLOPT_TIMEOUT', 'curl_timeout', 'https://curl.haxx.se/libcurl/c/CURLOPT_TIMEOUT.html', 'text', ''),
('CURLOPT_URL', 'curl_url', '', 'text', ''),
('CURLOPT_USERPWD', 'curl_userpwd', 'https://curl.haxx.se/libcurl/c/CURLOPT_USERPWD.html', 'text', '');

-- --------------------------------------------------------

--
-- Table structure for table `mini_config`
--

CREATE TABLE `mini_config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `array_key` varchar(50) NOT NULL,
  `display_name` tinytext DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `admin` varchar(32) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `last_update` varchar(50) DEFAULT NULL,
  `key_group` varchar(30) DEFAULT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'textarea'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mini_config`
--

INSERT INTO `mini_config` (`id`, `array_key`, `display_name`, `value`, `admin`, `description`, `last_update`, `key_group`, `type`) VALUES
(27, 'SMS_debugMode', 'debugging_mode', '0', '', 'debugging_mode', '1588075380', 'sms', 'checked'),
(13, 'SMS_phoneKey', 'phone_name', 'recipient', '', 'phone_name', '1588075380', 'sms', 'textarea'),
(14, 'SMS_messageKey', 'message_name', 'message', '', 'message_name', '1588075380', 'sms', 'textarea'),
(28, 'email_debug_mode', 'debugging_mode', '0', '', 'debugging_mode', '1597218885', 'email', 'checked'),
(26, 'SMS_gateway', 'sms_gateway', 'ac788edecf41789a2906fb7bc67d4235', '', 'sms_gateway_description', '1588075380', 'sms', 'textarea'),
(17, 'email_username', 'user_name', 'example@example.com', '', NULL, '1597218885', 'email', 'textarea'),
(18, 'email_password', 'password', 'password', '', NULL, '1597218885', 'email', 'textarea'),
(19, 'email_SetFrom', 'sent_from', 'no-reply@example.com', '', NULL, '1597218885', 'email', 'textarea'),
(20, 'email_senderName', 'sender_name', 'Lajela Technologies', '', '', '1597218885', 'email', 'textarea'),
(21, 'emailHost', 'host', 'smpt.example.com', '', NULL, '1597218885', 'email', 'textarea'),
(22, 'emailPort', 'port', '465', '', NULL, '1597218885', 'email', 'textarea'),
(23, 'emailReplyTo', 'reply_to', 'support@example.com', '', NULL, '1597218885', 'email', 'textarea'),
(24, 'emailSMTPSecure', 'smtp_secure', 'tls', '', '', '1597218885', 'email', 'textarea'),
(25, 'systemTheme', 'theme', 'default', NULL, 'system_theme_description', NULL, 'theme', 'textarea'),
(29, 'useMailFunction', 'use_email_function', '1', '', 'use_email_function', '1597218885', 'email', 'checked');

-- --------------------------------------------------------

--
-- Table structure for table `news_letter`
--

CREATE TABLE `news_letter` (
  `id` varchar(32) NOT NULL,
  `subject` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `reg_date` varchar(50) DEFAULT NULL,
  `sent_date` varchar(50) DEFAULT NULL,
  `num` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_letter_subscriber`
--

CREATE TABLE `news_letter_subscriber` (
  `id` varchar(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `reg_date` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(32) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'pending',
  `payment_code` tinytext DEFAULT NULL,
  `payment_method_id` varchar(32) DEFAULT NULL,
  `reg_date` varchar(50) DEFAULT NULL,
  `settled` varchar(1) NOT NULL DEFAULT '0',
  `gateway_response` text DEFAULT NULL,
  `ref` tinytext DEFAULT NULL,
  `ini_balance` varchar(20) DEFAULT NULL,
  `final_balance` varchar(20) DEFAULT NULL,
  `fee` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_data`
--

CREATE TABLE `payment_gateway_data` (
  `id` varchar(32) NOT NULL,
  `name` text DEFAULT NULL,
  `path_name` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `custom_1` text DEFAULT NULL,
  `custom_2` text DEFAULT NULL,
  `custom_3` text DEFAULT NULL,
  `custom_4` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `is_testable` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateway_data`
--

INSERT INTO `payment_gateway_data` (`id`, `name`, `path_name`, `currency`, `custom_1`, `custom_2`, `custom_3`, `custom_4`, `logo`, `is_testable`) VALUES
('7394408438y94948943', 'Paystack', 'paystack', NULL, 'Public Key', 'Secret Key', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` varchar(32) NOT NULL,
  `active` varchar(1) DEFAULT NULL,
  `use_wallet` varchar(1) DEFAULT NULL,
  `use_recharge` varchar(1) DEFAULT NULL,
  `gateway` varchar(32) DEFAULT NULL,
  `name` tinytext DEFAULT NULL,
  `currency` varchar(32) DEFAULT NULL,
  `wallet_fee` varchar(20) DEFAULT NULL,
  `wallet_percentage` varchar(20) DEFAULT NULL,
  `wallet_capped` varchar(20) DEFAULT NULL,
  `recharge_fee` varchar(20) NOT NULL,
  `recharge_percentage` varchar(20) DEFAULT NULL,
  `recharge_capped` varchar(20) NOT NULL,
  `custom_1` text DEFAULT NULL,
  `custom_2` text DEFAULT NULL,
  `custom_3` text DEFAULT NULL,
  `custom_4` text DEFAULT NULL,
  `last_update` varchar(50) NOT NULL,
  `test_mode` varchar(1) DEFAULT '0',
  `encrypt_key` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `active`, `use_wallet`, `use_recharge`, `gateway`, `name`, `currency`, `wallet_fee`, `wallet_percentage`, `wallet_capped`, `recharge_fee`, `recharge_percentage`, `recharge_capped`, `custom_1`, `custom_2`, `custom_3`, `custom_4`, `last_update`, `test_mode`, `encrypt_key`) VALUES
('be5ed10c3c7cd0f80408e2e386e0017f', '1', '', '', '7394408438y94948943', 'Paystack', '2567t796r856980709o8yoii8769ovov', '0', '', '', '0', '', '', 'pk_live_384e3138bd884eebbdafe4ea411babb8469d3a43', 'sk_live_1ca263ec734cbf2dc5b321b20cd6ae06d532bdab', '', '', '1596648957', '1', '2001973163');

-- --------------------------------------------------------

--
-- Table structure for table `payout_request`
--

CREATE TABLE `payout_request` (
  `id` varchar(32) NOT NULL,
  `user` varchar(32) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `fee` varchar(20) NOT NULL DEFAULT '0',
  `bank_name` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `custom_1` mediumtext DEFAULT NULL,
  `custom_2` mediumtext DEFAULT NULL,
  `wallet` varchar(1) NOT NULL DEFAULT '0',
  `reg_date` varchar(50) NOT NULL,
  `settled` varchar(1) DEFAULT '0',
  `settled_date` varchar(50) DEFAULT NULL,
  `admin` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_noti`
--

CREATE TABLE `pay_noti` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(32) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `remark` tinytext DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'no',
  `settled_date` varchar(50) DEFAULT NULL,
  `admin` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` varchar(32) NOT NULL,
  `value` tinytext DEFAULT NULL,
  `display_name` tinytext DEFAULT NULL,
  `price` float DEFAULT NULL,
  `service` varchar(32) DEFAULT NULL,
  `active` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `portal_owner`
--

CREATE TABLE `portal_owner` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `user` varchar(32) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `file_loc` varchar(100) DEFAULT NULL,
  `db_name` varchar(100) DEFAULT NULL,
  `db_pass` varchar(100) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `db_user` varchar(100) DEFAULT NULL,
  `active` varchar(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `id` varchar(32) NOT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `service_id` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `payment_method` varchar(32) DEFAULT NULL,
  `user` varchar(32) DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `ini_balance` varchar(20) DEFAULT NULL,
  `final_balance` varchar(20) DEFAULT NULL,
  `pay_amount` varchar(20) DEFAULT NULL,
  `transaction_value` longtext DEFAULT NULL,
  `payment_method_id` varchar(32) DEFAULT NULL,
  `error_level` varchar(1) DEFAULT NULL,
  `gateway_response` text DEFAULT NULL,
  `fee` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ref_click`
--

CREATE TABLE `ref_click` (
  `id` varchar(32) NOT NULL,
  `widget` varchar(40) DEFAULT NULL,
  `loc` text DEFAULT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `reg_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserved_account`
--

CREATE TABLE `reserved_account` (
  `id` varchar(32) NOT NULL,
  `owner` varchar(35) DEFAULT NULL,
  `bank_name` tinytext DEFAULT NULL,
  `account_name` tinytext DEFAULT NULL,
  `account_number` varchar(12) DEFAULT NULL,
  `bank_code` varchar(10) DEFAULT NULL,
  `ref` varchar(32) DEFAULT NULL,
  `first_name` tinytext DEFAULT NULL,
  `last_name` tinytext DEFAULT NULL,
  `middle_name` tinytext DEFAULT NULL,
  `bvn` tinytext DEFAULT NULL,
  `date_of_birth` varchar(50) DEFAULT NULL,
  `card_number` tinytext DEFAULT NULL,
  `card_path` tinytext DEFAULT NULL,
  `card_type` tinytext DEFAULT NULL,
  `verified` varchar(1) NOT NULL DEFAULT '0',
  `submitted` varchar(1) NOT NULL DEFAULT '0',
  `reject_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` varchar(32) NOT NULL,
  `display_name` text NOT NULL,
  `success_text` tinytext DEFAULT NULL,
  `name` tinytext DEFAULT NULL,
  `min` varchar(20) NOT NULL DEFAULT '0',
  `max` varchar(20) DEFAULT NULL,
  `fee` varchar(20) NOT NULL DEFAULT '0',
  `fee_capped` varchar(20) DEFAULT '0',
  `fee_percentage` varchar(1) NOT NULL DEFAULT '0',
  `sms_alert` varchar(1) NOT NULL DEFAULT '0',
  `email_alert` varchar(1) NOT NULL DEFAULT '0',
  `image` tinytext DEFAULT NULL,
  `category` varchar(32) DEFAULT NULL,
  `response_level` text DEFAULT NULL,
  `api` varchar(1) DEFAULT '0',
  `description` text DEFAULT NULL,
  `last_update` varchar(20) DEFAULT NULL,
  `create_time` varchar(20) DEFAULT NULL,
  `sms_alert_me` varchar(1) DEFAULT NULL,
  `email_alert_me` varchar(1) DEFAULT NULL,
  `html_tag` longtext DEFAULT NULL,
  `active` varchar(1) DEFAULT '0',
  `create_date` varchar(20) DEFAULT NULL,
  `email_failed` varchar(1) DEFAULT '0',
  `amount_name` varchar(100) NOT NULL DEFAULT 'amount',
  `phone_name` varchar(100) DEFAULT 'phone',
  `email_name` varchar(100) DEFAULT 'email',
  `hit` tinytext DEFAULT NULL,
  `plan_field_required` varchar(1) NOT NULL DEFAULT '1',
  `plan_fixed_price` varchar(1) DEFAULT '1',
  `plan_display_name` varchar(100) NOT NULL DEFAULT 'Plans',
  `plan_name` varchar(100) DEFAULT 'plan',
  `gateway` varchar(50) DEFAULT NULL,
  `debug_mode` varchar(1) DEFAULT NULL,
  `action_link` text DEFAULT NULL,
  `comfirm_page_js` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_gateway`
--

CREATE TABLE `service_gateway` (
  `id` varchar(32) NOT NULL,
  `display_name` tinytext DEFAULT NULL,
  `CURLOPT_URL` tinytext DEFAULT NULL,
  `CURLOPT_RETURNTRANSFER` varchar(32) DEFAULT 'true',
  `CURLOPT_POST` varchar(32) DEFAULT 'true',
  `CURLOPT_ENCODING` tinytext DEFAULT NULL,
  `CURLOPT_REFERER` tinytext DEFAULT NULL,
  `CURLOPT_FOLLOWLOCATION` varchar(32) DEFAULT 'true',
  `CURLOPT_MAXREDIRS` varchar(32) DEFAULT '-1',
  `CURLOPT_POSTREDIR` varchar(32) DEFAULT '10',
  `CURLOPT_TIMEOUT` varchar(32) DEFAULT '30',
  `CURLOPT_HTTP_VERSION` tinytext DEFAULT NULL,
  `CURLOPT_CUSTOMREQUEST` tinytext DEFAULT NULL,
  `CURLOPT_USERPWD` tinytext DEFAULT NULL,
  `response_format` varchar(32) DEFAULT 'JSON',
  `response_level` mediumtext DEFAULT NULL,
  `success_key` tinytext DEFAULT NULL,
  `success_code` tinytext DEFAULT NULL,
  `success_text` tinytext DEFAULT NULL,
  `success_code_key` tinytext DEFAULT NULL,
  `ref_key_name` tinytext DEFAULT NULL,
  `ref_key_type` tinytext DEFAULT NULL,
  `ref_key_len` tinytext DEFAULT NULL,
  `ref_key_absolute_len` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `src` tinytext DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `slide_order` varchar(2) DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  `align` varchar(20) NOT NULL DEFAULT 'center-align'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `src`, `title`, `description`, `slide_order`, `reg_date`, `active`, `align`) VALUES
(22, '2020/8/12/669697488.jpg', 'VTU Creator ', 'No.1 Mini Banking System', '1', '1597215776', '1', 'center-align'),
(25, '2020/8/12/465794203.jpg', 'VTU Creator ', 'VTU Creator is a multi-language easy-to-use PHP Script that enables you to create a full functional and automated and instant digital delivery online recharge portal without basic knowledge of programming Languages.', '2', '1597217901', '1', 'left-align');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` varchar(32) NOT NULL,
  `name` tinytext DEFAULT NULL,
  `loc` tinytext DEFAULT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `loc`, `img`) VALUES
('default', 'Default Lajela Theme', 'default', 'image.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `third_party_feature`
--

CREATE TABLE `third_party_feature` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` tinytext DEFAULT NULL,
  `var1` tinytext DEFAULT NULL,
  `var2` tinytext DEFAULT NULL,
  `var3` tinytext DEFAULT NULL,
  `var4` tinytext DEFAULT NULL,
  `var5` tinytext DEFAULT NULL,
  `var6` tinytext DEFAULT NULL,
  `var7` tinytext DEFAULT NULL,
  `var8` tinytext DEFAULT NULL,
  `var9` tinytext DEFAULT NULL,
  `var10` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `third_party_feature`
--

INSERT INTO `third_party_feature` (`id`, `name`, `var1`, `var2`, `var3`, `var4`, `var5`, `var6`, `var7`, `var8`, `var9`, `var10`) VALUES
(1, 'monnify_reserved_account', 'MK_PROD_BVP3SL940LDLFJLL', 'R993OWPEEOWEOEWWVQCTVQA6K3D8H', '789128849485', '65', '', '1', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(32) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `pix` tinytext DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `street` text DEFAULT NULL,
  `city` tinytext DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `country` tinytext DEFAULT NULL,
  `password` text DEFAULT NULL,
  `reg_date` varchar(20) DEFAULT NULL,
  `last_update` varchar(20) DEFAULT NULL,
  `last_seen` varchar(20) DEFAULT NULL,
  `token` tinytext DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `block_reason` text DEFAULT NULL,
  `credit` varchar(100) NOT NULL DEFAULT '0',
  `earn` varchar(100) DEFAULT '0',
  `refer_code` varchar(50) DEFAULT NULL,
  `refer_by` tinytext DEFAULT NULL,
  `widget` varchar(50) DEFAULT NULL,
  `api` varchar(50) DEFAULT NULL,
  `lang` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `array_key` varchar(50) NOT NULL,
  `display_name` text DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `admin` varchar(32) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `last_update` varchar(20) DEFAULT NULL,
  `key_group` varchar(20) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'textarea'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`id`, `array_key`, `display_name`, `value`, `admin`, `description`, `last_update`, `key_group`, `type`) VALUES
(2, 'licencesKey', 'web_config_name_licenceskey', 'VK_14D80DF3E6038C4FC1A9758F7847D472', '', 'web_config_licenceskey', '1593775294', 'licence', 'textarea'),
(63, 'enableAPI', 'enable_api', '1', '', 'enable_api', '1597217093', 'general', 'checked'),
(4, 'allowCookie', 'web_config_name_allowcookie', '1', '', 'web_config_allowcookie', '1597217093', 'general', 'checked'),
(64, 'affiliate', 'affiliate', '&lt;h4&gt;Looking for a way to make money online without investment?&lt;/h4&gt;\r\n\r\n&lt;p&gt;You can do that easily by joining our&amp;nbsp;platform &amp;nbsp;and get up to &lt;strong&gt;3% commission rate&lt;/strong&gt; for every recharge,&amp;nbsp;by using our Affiliates Programme to&amp;nbsp;earn money. Beside the Affiliating programme, we have provided tools and resources you need to earn a commissions.&lt;/p&gt;\r\n\r\n&lt;h5&gt;&lt;strong&gt;Affiliating Link&lt;/strong&gt;&lt;/h5&gt;\r\n\r\n&lt;p&gt;We provide you an affiliating link called referral link that you simply share with your Friends &amp;amp; Family to earn up to &lt;strong&gt;1% commission&lt;/strong&gt; of purchases they make.&lt;/p&gt;\r\n\r\n&lt;p&gt;We also provide affiliate banners that can be place on your website or android app. You can also share our affiliating links or embed our links in your Blog posts. You get a commission on whatever was paid for through your affiliate links&lt;/p&gt;\r\n\r\n&lt;h5&gt;widget&lt;/h5&gt;\r\n\r\n&lt;p&gt;We provide easy customized widget, through our widget, people can pay for services directly on our website. Embed the widget on your website and earn commissions on purchases made through the widget. You can place on your website sidebar and you can also create a page for it.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h5&gt;Agents&lt;/h5&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Did you know that you can earn by referring agents to us?&lt;/strong&gt;&lt;br /&gt;\r\nStart earning from all transactions of users who registered on our website&amp;nbsp;through you. You ear&amp;nbsp;a commission on any purchases directly on our portal, API and Andriod app by your agents. Simply share your referal link with your Friends &amp;amp; Family.&lt;br /&gt;\r\nOr setup a portal for the user, but the user must register with your referral code or link&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h5&gt;API&lt;/h5&gt;\r\n\r\n&lt;p&gt;Are you a developer? With our API you can easily integrate Bill Payment, Airtime Purchase, Data Purchase e.t.c, we will provide you with API Keys that you can use to make API calls automatically affter registrastration on our portal. You can get up to 3% commission rate.&amp;nbsp;&lt;a href=&quot;https://pikihub.net/api_doc/&quot; target=&quot;api-doc&quot;&gt;API Documentation&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;https://vtucreator.com/account/register.php&quot;&gt;JOIN&amp;nbsp;NOW&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;div class=&quot;clearfix&quot;&gt;&amp;nbsp;&lt;/div&gt;\r\n', '', 'tell_your_users_about_how_your_affiliate_programme_works', '1590967924', NULL, 'textarea'),
(5, 'chatCode', 'web_config_name_chatcode', '', '', 'web_config_chatcode', '1597217500', 'contact', 'textarea'),
(6, 'webName', 'web_config_name_webname', 'VTU Creator', '', 'web_config_webname', '1597217093', 'general', 'textarea'),
(7, 'companyName', 'web_config_name_companyname', 'Lajela Technologies', '', 'web_config_companyname', '1597217500', 'contact', 'textarea'),
(8, 'webAuthor', 'web_config_name_webauthor', 'Lajela Technologies', '', 'web_config_webauthor', '1597217500', 'contact', 'textarea'),
(9, 'homePageTitle', 'web_config_name_homepagetitle', 'VTU Creator  | No.1 Mini Banking System Software', '', 'web_config_homepagetitle', '1597217093', 'general', 'textarea'),
(10, 'webLogo', 'web_config_name_weblogo', '2020/6/9/1071038542.png', '48fc109946a102814aac4d2cb85371e6', 'web_config_weblogo', '1591727402', 'image', 'textarea'),
(11, 'favicon', 'web_config_name_favicon', '2020/8/12/171317843.jpg', '6a5ada64b9fced4f781d56a3936ec02c', 'web_config_favicon', '1597218377', 'image', 'textarea'),
(14, 'repyTo', 'web_config_name_repyto', 'support@lajela.com', '', 'web_config_repyto', '1597217500', 'contact', 'textarea'),
(40, 'walletFeePercentage', 'web_config_name_wallet_fee_percentage', '1', '', 'web_config_wallet_fee_percentage', '1596648775', 'payment', 'checked'),
(15, 'supportLogo', 'web_config_name_supportlogo', '2020/6/1/409879561.png', '48fc109946a102814aac4d2cb85371e6', 'web_config_supportlogo', '1591014571', 'image', 'textarea'),
(16, 'phoneNumber', 'web_config_name_phonenumber', '09084190126', '', 'web_config_phonenumber', '1597217500', 'contact', 'textarea'),
(17, 'address', 'web_config_name_address', 'B HSE 3001.MPAPE, UND ST. Mpape 4, ABUJA NIGERIA', '', 'web_config_address', '1597217500', 'contact', 'textarea'),
(18, 'facebook', 'web_config_name_facebook', 'https://www.facebook.com/vtucreator1', '', 'web_config_facebook', '1597217500', 'contact', 'textarea'),
(19, 'twitter', 'web_config_name_twitter', '#', '', 'web_config_twitter', '1597217500', 'contact', 'textarea'),
(20, 'googlePlus', 'web_config_name_googleplus', '#', '', 'web_config_googleplus', '1597217500', 'contact', 'textarea'),
(21, 'youTube', 'web_config_name_youtube', '#', '', 'web_config_youtube', '1597217500', 'contact', 'textarea'),
(22, 'paymentMethod', 'web_config_name_paymentmethod', 'Wallet, Bank Deposit, Online Payment using any bank cards.', '', 'web_config_paymentmethod', '1596648775', 'payment', 'textarea'),
(23, 'supportEmail', 'web_config_name_supportemail', 'support@lajela.com', '', 'web_config_supportemail', '1597217500', 'contact', 'textarea'),
(25, 'keyWord', 'web_config_name_keyword', 'AIRTIME RECHARGES, Airtel Airtime VTU, MTN Airtime VTU, GLO Airtime VTU, 9mobile Airtime VTU, DATA PLAN,Airtel Data, MTN Data, GLO Data, 9mobile Data, Smile Payment', '', 'web_config_keyword', '1597217093', 'general', 'textarea'),
(60, 'payoutSendToWalletEnabled', 'send_to_wallet_enabled', '0', '', NULL, '1586536993', 'payout', 'checked'),
(61, 'payoutChargeWallet', 'charge_when_sending_to_wallet', '0', '', NULL, '1586536993', 'payout', 'checked'),
(62, 'licencesToken', 'web_config_name_licencestoken', 'VT_E24A2FC9E84DFB9E4B9360DB09A02D5A', '', 'web_config_licencestoken', '1593775294', 'licence', 'textarea'),
(26, 'description', 'web_config_name_description', 'VTU Creator is a multi-language easy-to-use PHP Script that enables you to create a full functional and automated and instant digital delivery online recharge portal without basic knowledge of programming Languages.', '', 'web_config_description', '1597217093', 'general', 'textarea'),
(49, 'webLang', 'web_config_name_web_language', 'en', NULL, 'web_config_web_language', NULL, 'select', 'general'),
(50, 'payoutMaxAmount', 'max_amount', '200000', '', 'web_config_payout_max_amount', '1586536993', 'payout', 'textarea'),
(51, 'payoutMinAmount', 'min_amount', '100', '', 'web_config_payout_min_amount', '1586536993', 'payout', 'textarea'),
(52, 'payoutCustom1', 'custom_1_field_name', 'shit code', '', 'web_config_payout_custom1', '1586536993', 'payout', 'textarea'),
(53, 'payoutCustom2', 'custom_2_field_name', 'address', '', 'web_config_payout_custom2', '1586536993', 'payout', 'textarea'),
(54, 'payoutDateTime', 'web_config_name_payout_date_time', '&lt;h6&gt;We payout on\r\n Monday - Friday:  8am - 4pm (WAT)&lt;h6&gt;', '', 'web_config_payout_datetime', '1586536993', 'payout', 'textarea'),
(55, 'payoutMessage', 'web_config_name_payout_message', '&lt;p&gt;Welcome Message &lt;p&gt;', '', 'web_config_payout_message', '1586536993', 'payout', 'textarea'),
(56, 'payoutFee', 'fee_charge', '150', '', 'web_config_payout_fee', '1586536993', 'payout', 'textarea'),
(57, 'payoutFeeCapped', 'fee_capped_at', '0', '', 'web_config_payout_capped', '1586536993', 'payout', 'textarea'),
(58, 'payoutFeePercentage', 'fee_percentage', '1', '', 'web_config_payout_fee_percentage', '1586536993', 'payout', 'checked'),
(59, 'bankPayoutEnabled', 'bank_payout_enabled', '1', '', NULL, '1586536993', 'payout', 'checked'),
(29, 'discountEnable', 'web_config_name_discountenable', '1', '', 'web_config_discountenable', '1596350935', 'discount', 'checked'),
(30, 'webLink', 'web_config_name_weblink', 'localhost/account', '', 'web_config_weblink', '1597217093', 'general', 'textarea'),
(47, 'unregisteredUserDiscountEnable', 'web_config_name_unregistered_user_discount_enable', '0', '', 'web_config_unregistered_user_discount_enable', '1596350935', 'discount', 'checked'),
(31, 'instagram', 'web_config_name_instagram', '#', '', 'web_config_instagram', '1597217500', 'contact', 'textarea'),
(32, 'faq', 'web_config_name_faq', '&lt;div class=&quot;container fqa&quot;&gt;\r\n&lt;div class=&quot;flex-items-sm-center justify-content-center row&quot;&gt;\r\n&lt;div class=&quot;col-sm-12&quot;&gt;\r\n&lt;h2&gt;Frequent Ask Question.&lt;br /&gt;\r\n&amp;nbsp;&lt;/h2&gt;\r\n&lt;u&gt;&lt;strong&gt;What is vtucreator?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;vtucreator is an online Vtu and Bill payment portal, where airtime/data recharge, electricity bill payment, cable tv subcription amongst others are made possible at a click. You can recharge your own credit or that of your friends and family, Pay Electric Bills, send bulk sms, buy educational pin, and print recharge card etc.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;How do I recharge Vtu or pay Bill?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;It&amp;#39;s super easy! Just follow these steps and you&amp;#39;ll be ready in no-time.&lt;/p&gt;\r\n\r\n&lt;ol&gt;\r\n	&lt;li&gt;Choose the Category e.g Airtime:&lt;/li&gt;\r\n	&lt;li&gt;Select Product / Operator: let us know which product you&amp;#39;re going to buy&lt;/li&gt;\r\n	&lt;li&gt;Fill in your information: fill in your email address and/or the recipient&amp;#39;s phone number, Customer ID and any other necessary details&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Pay and receive&lt;/strong&gt;: after your payment the order confirmation will be sent immediately\r\n	&lt;ol&gt;\r\n	&lt;/ol&gt;\r\n	&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;u&gt;&lt;strong&gt;Why does my transaction not succeed?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;Of course, we don&amp;#39;t want this to happen! First check if you entered the right information (phone number, Customer ID) and whether this information is still up-to-date. So: is the number still active, check for maximum and minimum amount for the service, still not working? Then please contact our Customer Care team. They can check whether there has been a malfunction at the carrier or if the carrier does not allow the recharge. If they are not able to make the recharge, then naturally we will reverse the amount back into your account.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;Can I make several recharges at the same time?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;Unfortunately, it is not yet possible to make several recharges at the same time. We are actively working on making this possible in the near future. But you can make several recharges on different tab on your browser. Would you like to be kept informed about this? Follow us on Facebook or subscribe to our newsletter.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Placing an order.&lt;/h2&gt;\r\n&lt;u&gt;&lt;strong&gt;What can I do if I accidentally recharged the wrong number?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;Well, in this case we would not be held accountable, that is why we took pains to develop the system in such a way that, you have to verify your meter number in the case of electric bills or TV subscriptions to be sure that you are sending value to the correct number. Please always ensure that you enter the right number before you proceed for payment since we would be able to retrive service that has been paid for alrealy. In some cases, the payment would not go through at our end even your money was deducted, when you complian to us, your money would be reversed&amp;nbsp; immediatly after due verifications.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;I haven&amp;#39;t received an order confirmation, did my transaction get through?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;Provided that you&amp;#39;ve entered a correct email address, you should always receive an order confirmation after a successful payment. There is a possibility that the recharge cannot immediately be processed. This could happen, for example, if you fill in a wrong/invalid phone number, when there is a malfunction at the carrier or when the payment has not succeeded. We always keep you informed on the progress of your order on the email address you provided us with. Make sure to always check the spam folder of your email account. To prevent the order confirmation from ending up in the spam folder, please add noreply@vtucreator.com to your safe senders list.&lt;/p&gt;\r\n\r\n&lt;p&gt;If a payment fails, we&amp;#39;ll refund the amount of the order. It depends on several factors how long it takes before the money is back on your bank account. In the meantime, be sure to regularly check the status of your payment with your bank. In many cases you&amp;#39;ll have the money back within a few working days. Does it take more than a week to get the refund? Please contact us. We&amp;#39;ll make sure you get what you&amp;#39;re entitled to.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;I don&amp;#39;t see the correct Customer Name after filling in the Customer ID, what to do?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;First check whether the ID you entered is correct, check your internet connection because our system always send request to the merchant&amp;#39;s server to query customer detail.&lt;/p&gt;\r\n\r\n&lt;h2&gt;Payment&lt;/h2&gt;\r\n&lt;u&gt;&lt;strong&gt;Which payment methods are available?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;That all depends on the transaction we accept online payment and charge you from your wallet for airtime purchase and bill payment. And we accept bank deposit, online payment and cash at our branch for wallet funding.&lt;/p&gt;\r\n&lt;strong&gt;Is it possible to get an invoice from my order?&lt;/strong&gt;\r\n\r\n&lt;p&gt;We&amp;#39;ll send an order confirmation to the email address you filled in while placing your order. And our system is programmed to generate invoices for every transaction. Excluding direct bank deposit and bank transfer.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;Why do I pay a service fee?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;We want to provide you with the best service and to do so we charge a service fee. Why is that? &amp;nbsp;Making use of certain banking connections and payment methods, comes with costs for us too&lt;/li&gt;\r\n	&lt;li&gt;We make sure you can access our website 24 hours a day, 365 days a year&lt;/li&gt;\r\n	&lt;li&gt;You receive your recharge or recharge code almost instantly if not instantly in most cases&lt;/li&gt;\r\n	&lt;li&gt;vtucreator provides you with a safe payment environment&lt;/li&gt;\r\n	&lt;li&gt;There&amp;#39;s an enthusiastic Customer Care team at your service in case you have questions or need some help&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;u&gt;&lt;strong&gt;How can I be entitled to discount?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;When your register with us, you are entitled to 1% and 8% discount depending on the transaction.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;h2&gt;Your account and preferences&lt;/h2&gt;\r\n&lt;u&gt;&lt;strong&gt;Can I make an account on vtucreator Portal?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;Sure, you can! If you register using your email address and a password, you can check your order history and find out the status of your current orders. Moreover, you can save your personal information, like your email address and phone number, so your next order will go even faster.&lt;/p&gt;\r\n&lt;u&gt;&lt;strong&gt;How can I unsubscribe from the newsletter?&lt;/strong&gt;&lt;/u&gt;\r\n\r\n&lt;p&gt;If you don&amp;#39;t want to receive updates by mail any longer, unsubscription is just one click away. Open the link at the bottom of our newsletters, and we&amp;#39;ll take your email address out of the system.&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n', '', 'web_config_faq', '1592481134', 'page', 'textarea'),
(46, 'APIdiscountEnable', 'web_config_name_api_discount_enable', '0', '', 'web_config_api_discount_enable', '1596350935', 'discount', 'checked'),
(34, 'about', 'web_config_name_about', '&lt;p&gt;&lt;strong&gt;vtucreator.com &lt;/strong&gt;is a product of &lt;strong&gt;Virtual Top-in Zone&lt;/strong&gt; dully registered in providing innovative communication technologies, We offer a multipurpose portal where users signs up and subscribes for any desired services such as&amp;nbsp;&lt;strong&gt;PHED, Ikeja electric, Eko electric, buy airtime and data bundle, print recharge card, buy Educational pin,&amp;nbsp;&lt;/strong&gt;from any of the telecoms networks in Nigeria here listed.&lt;/p&gt;\r\n\r\n&lt;p&gt;This portal offers the opportunity to buy any of the services with great discounts or make earnsmeet with it with great commission rates.&lt;/p&gt;\r\n\r\n&lt;p&gt;You can pay your bills at your convenience at any point in time right from the comfort of your home or office even while on transit travelling to anywhere in World.&lt;/p&gt;\r\n\r\n&lt;p&gt;Registration is free for Guest User but cost a little for Vendors, subdomain and domain owners with more discount and referral earnings.&lt;/p&gt;\r\n\r\n&lt;p&gt;We run an automated earning system where you earn from referral&amp;#39;s registration and from services they buy.&lt;/p&gt;\r\n\r\n&lt;p&gt;You can also have own your subdomain/domain portal at subsidized rate.&lt;/p&gt;\r\n\r\n&lt;p&gt;API is also available for developers.&lt;/p&gt;\r\n', '', 'web_config_about', '1596351283', 'page', 'textarea'),
(44, 'userReferRecursive', 'web_config_name_user_recursive', '1', '', 'web_config_user_recursive', '1596351734', 'referral', 'checked'),
(45, 'userDiscountEnable', 'web_config_name_user_discount_enable', '1', '', 'web_config_user_discount_enable', '1596350935', 'discount', 'checked'),
(33, 'terms', 'web_config_name_terms', '&lt;h1&gt;&lt;strong&gt;&lt;u&gt;Terms and Conditions&lt;/u&gt;&lt;/strong&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;Please read this page carefully. These are the rules that govern this Portal. These rules help us to keep this place safe for you. By using this Portal, you agree to these terms of service (&amp;quot;TOS&amp;quot;), which may be updated by vtucreator&amp;nbsp;from time to time without notice to you. In addition, when using particular operated services, you shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;strong&gt;&lt;u&gt;Description of Services:&lt;/u&gt;&lt;/strong&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;The App is provided for your personal and commercial use, the purpose of this portal is to provide easy and fast&amp;nbsp;access to fast online recharge, you understand and agree that the Service is provided and that we assume no responsibility for the timeliness, deletion, mis-delivery of any services. You are responsible for obtaining access to the Service and that access may involve third party fees (such as Internet service provider or wireless service provider charges). You are responsible for those fees; in addition, you must provide and are responsible for all equipment&amp;nbsp; necessary to access the Service.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;strong&gt;&lt;u&gt;Legal Obligations:&lt;/u&gt;&lt;/strong&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;In consideration of your use of the Service, you represent that you are of legal age to form a binding contract and are not a person barred from receiving services under the laws of Nigeria or other applicable jurisdiction.&lt;/p&gt;\r\n\r\n&lt;ol&gt;\r\n	&lt;li&gt;Registration may be required to gain full access to operated service, you must agree to provide true, accurate, current and complete information about yourself if prompted by the Service&amp;#39;s registration form (such information being the &amp;quot;Registration Data&amp;quot;) maintain and promptly update the Registration Data to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current or incomplete, or vtucreator team have reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, vtucreator team have all the right to suspend or terminate your account and refuse any and all current or future use of the Service (or any portion thereof).\r\n	&lt;p&gt;&lt;strong&gt;&lt;strong&gt;It is your responsibility and your right to protect your privacy!&lt;/strong&gt;&lt;/strong&gt;&lt;/p&gt;\r\n	&lt;/li&gt;\r\n	&lt;li&gt;All materials are copyrighted and are provided solely for personal use and not for commercial use. &amp;quot;....Freely you have received; freely give.&amp;quot;&amp;nbsp;&lt;br /&gt;\r\n	Further, you may not resell use of, or access to, the portal to any third party.&lt;/li&gt;\r\n&lt;/ol&gt;\r\n', '', 'web_config_terms', '1591727086', 'page', 'textarea'),
(42, 'userReferEnable', 'web_config_name_userreferenable', '1', '', 'web_config_userreferenable', '1596351734', 'referral', 'checked'),
(43, 'APIReferRecursive', 'web_config_name_api_recursive', '0', '', 'web_config_name_recursive', '1596351734', 'referral', 'checked'),
(35, 'header', 'web_config_name_header', '&lt;script src=&quot;https://vtucreator.site/js/validate-user.js&quot;&gt;&lt;/script&gt;', '', 'web_config_header', '1597217093', 'general', 'textarea'),
(41, 'APIReferEnable', 'web_config_name_apireferenable', '0', '', 'web_config_apireferenable', '1596351734', 'referral', 'checked'),
(36, 'walletCharge', 'web_config_name_walletcharge', '1.5%', '', 'web_config_walletcharge', '1596648775', 'payment', 'textarea'),
(37, 'chargeCap', 'web_config_name_chargecap', '1.5', '', 'web_config_chargecap', '1596648775', 'payment', 'textarea'),
(48, 'referralEnable', 'web_config_name_referral_enable', '1', '', 'web_config_referral_enable', '1596351734', 'referral', 'checked'),
(38, 'invalidWord', 'web_config_name_invalidword', 'lajela,stay,connected,admin,ceo,administrator,founder,vtu,developer,vtucreator,owner,data,airtime,glo,mtn', '', 'web_config_invalidword', '1597217093', 'general', 'textarea'),
(39, 'currency', 'web_config_name_currency', '2567t796r856980709o8yoii8769ovov', '', 'web_config_currency', '1596648775', NULL, 'textarea'),
(65, 'activeLoader', 'activate_loader', '1', '', 'activate_loader', '1597217093', 'general', 'checked'),
(66, 'mobileSlider', 'show_slider_on_mobile', '1', '', 'show_slider_on_mobile', '1597217093', 'general', 'checked'),
(67, 'navBackgroundColor', 'navigation_background_color', '#01cafe', '', 'navigation_background_color_description', '1597217657', 'color', 'textarea'),
(68, 'navForegroundColor', 'navigation_foreground_color', '#ffffff', '', 'navigation_foreground_color_description', '1597217657', 'color', 'textarea'),
(69, 'footerBackgroundColor', 'footer_background_color', '#01cafe', '', 'footer_background_color_description', '1597217657', 'color', 'textarea'),
(70, 'footerForegroundColor', 'footer_foreground_color', '#ffffff', '', 'footer_foreground_color_description', '1597217657', 'color', 'textarea'),
(71, 'buttonBackgroundColor', 'button_background_color', '#6d0e81', '', 'button_background_color_description', '1597217657', 'color', 'textarea'),
(72, 'buttonForegroundColor', 'button_foreground_color', '#ffffff', '', 'button_foreground_color_description', '1597217657', 'color', 'textarea');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_banner`
--
ALTER TABLE `ad_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airtime_cash`
--
ALTER TABLE `airtime_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_test_pay`
--
ALTER TABLE `api_test_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_transaction`
--
ALTER TABLE `api_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_rate`
--
ALTER TABLE `commission_rate`
  ADD PRIMARY KEY (`service`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `display_value`
--
ALTER TABLE `display_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateway_form`
--
ALTER TABLE `gateway_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_payment`
--
ALTER TABLE `guest_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD UNIQUE KEY `name_2` (`key_value`),
  ADD KEY `name` (`key_value`);

--
-- Indexes for table `mini_config`
--
ALTER TABLE `mini_config`
  ADD UNIQUE KEY `array_key` (`array_key`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `news_letter`
--
ALTER TABLE `news_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letter_subscriber`
--
ALTER TABLE `news_letter_subscriber`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateway_data`
--
ALTER TABLE `payment_gateway_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_request`
--
ALTER TABLE `payout_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_noti`
--
ALTER TABLE `pay_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_owner`
--
ALTER TABLE `portal_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_click`
--
ALTER TABLE `ref_click`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserved_account`
--
ALTER TABLE `reserved_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_gateway`
--
ALTER TABLE `service_gateway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_party_feature`
--
ALTER TABLE `third_party_feature`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `refer_code` (`refer_code`,`widget`,`api`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `array_key` (`array_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mini_config`
--
ALTER TABLE `mini_config`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `third_party_feature`
--
ALTER TABLE `third_party_feature`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
