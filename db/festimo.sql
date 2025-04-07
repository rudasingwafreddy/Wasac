-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2025 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `festimo`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `id` int(11) DEFAULT NULL,
  `e_worker` int(11) DEFAULT NULL,
  `meter_used` varchar(200) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `e_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `e_id` int(11) NOT NULL,
  `e_title` varchar(30) DEFAULT NULL,
  `e_category` int(11) DEFAULT NULL,
  `e_worker` int(11) DEFAULT NULL,
  `e_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`e_id`, `e_title`, `e_category`, `e_worker`, `e_date`) VALUES
(10, '10', 10, 10, '10');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(51, 'agricalture'),
(49, 'Household'),
(52, 'institition'),
(50, 'Utility');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `e_id` int(11) NOT NULL,
  `e_title` varchar(250) NOT NULL,
  `e_category` varchar(250) NOT NULL,
  `e_worker` varchar(250) NOT NULL,
  `e_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`e_id`, `e_title`, `e_category`, `e_worker`, `e_date`) VALUES
(37, 'SUPPORT FOR MARIE JOSE TUYISENGE', 'Support', 'Shadraack KWIZERA', '2021-12-02'),
(38, 'SUPPORT FOR BPR MURUNDA', 'Support', 'Emmanuel NSENGIYUMVA', '2021-12-02'),
(39, 'SUPPORT FOR CROIX ROUGE KACYIRU', 'Support', 'Emmanuel HABIMANA', '2021-12-02'),
(40, 'SENDING WBS', 'Others', 'Alfred SINDAYIHEBA', '2021-12-02'),
(41, 'RECOVERY FOR ABIMANA', 'Recovery', 'Alfred SINDAYIHEBA', '2021-12-02'),
(42, 'NEW CONNECTION FOR NSENGIYUMVA EMMANUEL', 'New Connection', 'Olivier NTEZIRYAYO', '2021-12-02'),
(43, 'SUPPORT FOR NZAMURAMBAHO VEDASTE', 'Support', 'Emmanuel HABIMANA', '2021-12-02'),
(44, 'RECOVERY FOR KAYIRANGA J DAMASCENE', 'Recovery', 'MBALA MAKENGO', '2021-12-02'),
(45, 'NEW CONNECTION FOR NKUNDIMANA JMV ', 'New Connection', 'Ignace BARAHIRA', '2021-12-02'),
(46, 'NEW CONNECTION FOR NGABOYERA VALENS', 'New Connection', 'Gylain BAHATI', '2021-12-02'),
(47, 'SUPPORT FOR RWAMAGANA LEADERS SCHOOL', 'Support', 'Jules HABINEZA', '2021-12-02'),
(48, 'SUPPORT FOR UNHCR NYABIHEKE', 'Support', 'Jules HABINEZA', '2021-12-02'),
(49, 'SURVEY FOR MINIFRA/GATO SAMUEL', 'New Connection', 'Jules HABINEZA', '2021-12-02'),
(50, 'NEW CONNECTION FOR RUHUMURIZA DANIEL', 'New Connection', 'Jules HABINEZA', '2021-12-02'),
(51, 'SUPPORT FOR KIM HOTEL', 'Support', 'Robert NTAMBARA', '2021-12-02'),
(52, 'NEW CONNECTION FOR SALAFINA FLAVIA', 'New Connection', 'Ignace BARAHIRA', '2021-12-02'),
(53, 'SUPPORT FOR IRAKOZE THIERRY', 'Support', 'Emmanuel NSENGIYUMVA', '2021-12-05'),
(60, 'SUPPORT FOR JOSEPH', 'Support', 'Robert NTAMBARA', '2021-12-05'),
(61, 'GAHANGA MIGRATION', 'Migration', 'Robert NTAMBARA', '2021-12-05'),
(62, 'SUPPORT FOR KANYAMANZA BAPTISTE', 'Support', 'Alfred SINDAYIHEBA', '2021-12-05'),
(63, 'SUPPORT FOR CHARLOTTE MUTONI', 'Support', 'Alfred SINDAYIHEBA', '2021-12-05'),
(64, 'SUPPORT FOR PREMIER BETTING NASHO', 'Support', 'Jules HABINEZA', '2021-12-05'),
(65, 'SUPPORT FOR MUSAZA HC', 'Support', 'Jules HABINEZA', '2021-12-05'),
(66, 'SUPPORT FOR  VANESSA KAGANZA', 'Support', 'Emmanuel HABIMANA', '2021-12-05'),
(67, 'GAHANGA MIGRATION', 'Migration', 'Olivier NTEZIRYAYO', '2021-12-05'),
(68, 'OTHERS', 'Others', 'Richard MBANZA', '2021-12-05'),
(70, 'Support for Mzee', 'Support', 'Robert NTAMBARA', '2021-12-09'),
(71, 'Support for Mzee', 'Support', 'Robert NTAMBARA', '2021-12-09'),
(72, 'ugomba kwishura mubyiciro nkuko wabidusabye', 'Utility', 'fred rudasingwa', '2025-02-16'),
(73, 'kwishyura amazi', 'institition', 'WB-2025-10642 MTR-582737', '2025-03-02'),
(74, 'UKWEZI KWA 2', 'agricalture', 'WB-2025-14279 MTR-784729', '2025-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `id` int(22) NOT NULL,
  `e_worker` varchar(70) NOT NULL,
  `meter_used` varchar(30) DEFAULT NULL,
  `amaount` varchar(40) NOT NULL,
  `e_date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`id`, `e_worker`, `meter_used`, `amaount`, `e_date`) VALUES
(15, 'Alfred  SINDAYIHEBA', NULL, '3500', '2021-12-02'),
(16, 'Olivier  NTEZIRYAYO', NULL, '3000', '2021-12-02'),
(17, 'Robert  NTAMBARA', NULL, '3000', '2021-12-02'),
(18, 'Gylain  BAHATI', NULL, '2000', '2021-12-02'),
(19, 'Anne Bella  NIYONIZEYE', NULL, '1000', '2021-12-02'),
(20, 'Didon  RWIRAHIRA', NULL, '1000', '2021-12-02'),
(21, 'Shadraack  KWIZERA', NULL, '1000', '2021-12-02'),
(22, 'Emmanuel  HABIMANA', NULL, '1000', '2021-12-02'),
(23, 'Elidad  MUHAWENIMANA', NULL, '1000', '2021-12-02'),
(24, 'MBALA  MAKENGO', NULL, '2000', '2021-12-02'),
(25, 'Fiston  SIBOMANA', NULL, '1000', '2021-12-02'),
(26, 'Ignace  BARAHIRA', NULL, '1000', '2021-12-02'),
(27, 'Alfred  SINDAYIHEBA', NULL, '3500', '2021-12-05'),
(28, 'Richard  MBANZA', NULL, '5000', '2021-12-05'),
(29, 'Emmanuel  HABIMANA', NULL, '1000', '2021-12-05'),
(30, 'Olivier  NTEZIRYAYO', NULL, '3000', '2021-12-05'),
(31, 'Gylain  BAHATI', NULL, '2000', '2021-12-07'),
(32, 'Alfred  SINDAYIHEBA', NULL, '3000', '2021-12-09'),
(33, 'Alfred  SINDAYIHEBA', '8', '80 RWF', ''),
(34, 'Olivier  NTEZIRYAYO', '128', '1280 RWF', '2025-02-08'),
(35, 'fred  rudasingwa', '345', '3450 RWF', '2025-02-16'),
(36, 'ishimwe martin  luther', '4567', '45670 RWF', '2025-02-19'),
(37, 'fredy  fredy', '23457', '234570 RWF', '2025-03-02'),
(38, 'peter  peter', '2000', '20000 RWF', '2025-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `email`, `address`, `message`) VALUES
(1, 'ishmartinluther@gmail.com', 'Gisagara', 'asddf'),
(2, 'fred@gmail.com', 'Rurindo', 'sddsff'),
(3, 'banks8582@gmail.com', 'Musanze', 'asdssdsd'),
(4, 'admin@gmail.com', 'Gisagara', 'saasas'),
(5, 'banks8582@gmail.com', 'Gatsibo', 'sdsdddd'),
(6, 'fred@gmail.com', 'Musanze', 'ds'),
(7, 'ishmartinluther@gmail.com', 'Muhanga', 'twabuze amazi ukwezi kose'),
(8, 'fred@gmail.com', 'Gakenke', 'sdgdfhfhh'),
(9, 'ishimwe@gmail.com', 'Rurindo', 'twabuze amazi');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `m_id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `customer_account` varchar(30) NOT NULL,
  `meter_number` varchar(30) NOT NULL,
  `meter_reading` varchar(30) NOT NULL,
  `new_money` int(11) NOT NULL,
  `divided_amount` varchar(30) NOT NULL,
  `payment_period` varchar(30) NOT NULL,
  `prepaid` varchar(30) NOT NULL,
  `m_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`m_id`, `category`, `customer_account`, `meter_number`, `meter_reading`, `new_money`, `divided_amount`, `payment_period`, `prepaid`, `m_date`) VALUES
(28, 'Household', 'WB-2025-43316', 'MTR-667250', '78', 780, '195.00', 'Quarterly', 'Quarterly', '2025-02-10'),
(29, 'Household', 'WB-2025-43316', 'MTR-667250', '78', 780, '195.00', 'Quarterly', 'Quarterly', '2025-02-10'),
(30, 'Agriculture', 'WB-2025-57811', 'MTR-717021', '4567', 45670, '45670.00', 'Monthly', 'Monthly', '2025-01-15'),
(31, 'Utility', 'WB-2025-21715', 'MTR-694478', '234567', 2345670, '586417.50', 'Quarterly', 'Quarterly', '2025-02-16'),
(32, 'Institution', 'WB-2025-10642', 'MTR-582737', '234567', 2345670, '586417.50', 'Quarterly', 'Quarterly', '2025-01-29'),
(33, 'Agriculture', 'WB-2025-14279', 'MTR-784729', '10000', 100000, '25000.00', 'Quarterly', 'Quarterly', '2025-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_account` varchar(30) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remaining_to_pay` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_account`, `phone_number`, `amount`, `payment_date`, `remaining_to_pay`) VALUES
(1, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(2, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(3, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(4, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(5, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(6, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(7, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 08:30:49', NULL),
(8, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-26 22:00:00', NULL),
(9, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 07:32:34', NULL),
(10, 'WB-2025-57811', '0780927460', '45670.00', '2025-02-27 07:33:11', NULL),
(38, 'WB-2025-10642', '0786693280', '300', '2025-03-03 08:31:43', 586117.50),
(43, 'WB-2025-10642', '0786693280', '2000', '2025-03-03 10:35:51', 584417.50),
(47, 'WB-2025-14279', '0780927461', '6000', '2025-03-03 20:08:28', 19000.00);

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `customer_account` varchar(30) DEFAULT NULL,
  `e_date` varchar(30) DEFAULT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penalties`
--

INSERT INTO `penalties` (`customer_account`, `e_date`, `amount`, `status`) VALUES
('10', '10', '100', 'payed');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `id` int(11) NOT NULL,
  `customer_account` varchar(50) NOT NULL,
  `meter_number` varchar(50) NOT NULL,
  `penalty_amount` decimal(10,2) NOT NULL DEFAULT 5000.00,
  `description` varchar(255) NOT NULL DEFAULT 'Penalty',
  `phone_number` varchar(30) NOT NULL,
  `penalty_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`id`, `customer_account`, `meter_number`, `penalty_amount`, `description`, `phone_number`, `penalty_date`, `created_at`, `status`) VALUES
(1, 'WB-2025-57811', 'MTR-717021', 5000.00, 'Penalty', '', '2025-02-28', '2025-02-28 19:59:11', NULL),
(2, 'WB-2025-57811', 'MTR-717021', 5000.00, 'Penalty', '', '2025-02-28', '2025-02-28 20:01:30', NULL),
(3, 'WB-2025-10642', 'MTR-582737', 5000.00, 'Penalty', '', '2025-03-02', '2025-03-02 20:21:33', NULL),
(4, 'WB-2025-10642', '', 1175535.00, 'Penalty', '0786693280', '2025-03-03', '2025-03-03 11:19:35', ''),
(5, 'WB-2025-14279', 'MTR-784729', 5000.00, 'Penalty', '', '2025-03-03', '2025-03-03 20:11:58', NULL),
(6, 'WB-2025-14279', '', 24000.00, 'Penalty', '0780927461', '2025-03-03', '2025-03-03 20:15:45', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `prepaid`
--

CREATE TABLE `prepaid` (
  `e_title` varchar(30) DEFAULT NULL,
  `e_detail1` varchar(30) DEFAULT NULL,
  `e_detail2` varchar(30) DEFAULT NULL,
  `e_amount1` varchar(30) DEFAULT NULL,
  `e_amount2` varchar(30) DEFAULT NULL,
  `e_detail3` varchar(30) DEFAULT NULL,
  `e_detail4` varchar(30) DEFAULT NULL,
  `e_amount3` varchar(30) DEFAULT NULL,
  `e_amount4` varchar(30) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `customer` varchar(20) DEFAULT NULL,
  `e_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prepaid`
--

INSERT INTO `prepaid` (`e_title`, `e_detail1`, `e_detail2`, `e_amount1`, `e_amount2`, `e_detail3`, `e_detail4`, `e_amount3`, `e_amount4`, `category`, `customer`, `e_date`) VALUES
('xfsdfdd', 'sdddsds', 'dssddsds', 'ddsdsdsd', 'sdsdsdsd', 'dssdsdsd', 'sddssdds', 'dsdsd', 'ddsss', 'sdsdsd', 'sdsdsd', '2025-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `sub-details`
--

CREATE TABLE `sub-details` (
  `id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `e_detail` varchar(250) NOT NULL,
  `e_amount` int(11) NOT NULL,
  `e_detail2` varchar(250) NOT NULL,
  `e_detail3` varchar(250) NOT NULL,
  `e_detail4` varchar(250) NOT NULL,
  `e_detail5` varchar(250) NOT NULL,
  `e_amount2` int(11) NOT NULL,
  `e_amount3` int(11) NOT NULL,
  `e_amount4` int(11) NOT NULL,
  `e_amount5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub-details`
--

INSERT INTO `sub-details` (`id`, `e_id`, `e_detail`, `e_amount`, `e_detail2`, `e_detail3`, `e_detail4`, `e_detail5`, `e_amount2`, `e_amount3`, `e_amount4`, `e_amount5`) VALUES
(37, 37, 'TP BUSANZA - GISOZI', 2000, 'TP GISOZI - KIMIRONKO', '', '', '', 1500, 0, 0, 0),
(38, 38, 'TP RUBENGERA - CONGO NILE', 3000, 'TP CONGO NILE - BPR MURUNDA', 'TP BPR MURUNDA - MURUNDA TOWER', 'TP MURUNDA TOWER -  BPR MURUNDA', 'TP BPR MURUNDA - RUBENGERA', 2000, 1500, 1500, 4000),
(39, 39, 'TP NYAMIRAMBO - KACYIRU', 1500, 'TP KACYIRU - KIMIRONKO', 'WELDING [ DUE TO PIPE FALL DOWN ]', '', '', 1000, 5000, 0, 0),
(40, 40, 'TP KIMIRNKO - SWITCH + RETURN', 1000, '', '', '', '', 0, 0, 0, 0),
(41, 41, 'TP KIMIRONKO - MUSHIMIRE + RETURN', 1000, '', '', '', '', 0, 0, 0, 0),
(42, 42, 'TP KIMIRONKO - KICUKIRO + RETURN', 2000, 'WELDING', '', '', '', 4000, 0, 0, 0),
(43, 43, 'TP KIMIRONKO - KACYIRU +RETURN', 2000, '', '', '', '', 0, 0, 0, 0),
(44, 44, 'TP KIMIRONKO - MUYANGE + RETURN', 3000, '', '', '', '', 0, 0, 0, 0),
(45, 45, 'TP KIMIRONKO - MASAKA', 3000, 'WELDING', '', '', '', 5000, 0, 0, 0),
(46, 46, 'TP KIMIRONKO - NYABUGOGO + RETURN', 2000, 'NYABUGOGO - GIHARA', 'WELDING', 'CHARGES WHILE SENDING VIA MOMO', '', 3000, 5000, 300, 0),
(47, 47, 'TP KAYONZA - RWAMAGANA', 500, 'TP RWAMAGANA - CUSTOMER', 'TP CUSTOMER - NTSINDA TOWER + RETURN', '', '', 500, 2000, 0, 0),
(48, 48, 'TP RWAMAGANA - KABARORE', 2000, 'TP KABARORE - NYABIHEKE + RETURN', 'TP NYABIHEKE - NGARAMA 1 TOWER + RETURN', '', '', 6000, 4000, 0, 0),
(49, 49, 'TP KABARORE - NYAGATARE', 1000, 'TP NYAGATARE - KINIHURA + RETURN', '', '', '', 2000, 0, 0, 0),
(50, 50, 'TP NYAGATARE - RYABEGA + RETURN', 1000, 'TP NYAGATARE - KAYONZA', 'CHARGES WHILE SENDING MOMO', '', '', 2000, 1000, 0, 0),
(51, 51, 'TP KIMIRONKO - KIMIHURURA', 1000, 'TP KIMIHURURA - PAPIRISI SITE + RETURN', 'TP KIMIHURURA - KIMIRONKO', 'CHARGES WHILE SENDING MOMO', '', 2000, 1000, 350, 0),
(52, 52, 'TP KIMIRONKO - BIBARE + RETURN', 1000, '', '', '', '', 0, 0, 0, 0),
(53, 53, 'TP RUBENGERA - GAKERI + RETURN', 10500, 'TP GAKERI - CUSTOMER ', 'TP CUSTOMER - KIGEYO TOWER', 'TP KIGEEYO TOER - GAKERI', 'TRANSCTION', 3000, 1500, 2000, 650),
(55, 60, 'TP KIMIORNKO - KANOMBE', 1000, 'WELDING (FOR CHANGING PIPE LOC)', '', '', '', 5000, 0, 0, 0),
(56, 61, 'TP KANOMBE - GAHANGA', 3000, 'TP TO  4 CUSTOMERS', ' LUNCH FOR YESTERDAY', 'TRANCTION', '', 2000, 3000, 750, 0),
(57, 62, 'TP KIMIRONKO - KABUGA', 1500, 'WELDING (CHANGING PIPE LOCATION)', '', '', '', 5000, 0, 0, 0),
(58, 63, 'TP KABUGA - RUBIRIZI', 1500, 'TP RUBIRIZI - KIMIRONKO', '', '', '', 1000, 0, 0, 0),
(59, 64, 'TP KAYONZA - KABARONDO', 500, 'TP KABARONDO - NASHO TOWER + RETURN', '', '', '', 8000, 0, 0, 0),
(60, 65, 'TP KABARONDO - NYAKARAMBI', 1500, 'TP NYAKARAMBI - MUSAZA TOWER', 'TP NYAKARAMBI - KAYONZA', 'TP MUSAZA TOWER - CUSTOMER', 'TRANSCTION', 5000, 2000, 1000, 650),
(61, 66, 'TP NYAMIRAMBO - KIMIRONKO', 1500, 'TP KIMIRONKO - KINYAGA + RETURN', '', '', '', 4000, 0, 0, 0),
(62, 67, 'RENT OF 3 RADERS FRO RECOVERING', 3000, 'TP GAHANGA - KICUKIRO', '', '', '', 1500, 0, 0, 0),
(63, 68, 'CYIZA', 500, '', '', '', '', 0, 0, 0, 0),
(65, 71, 'Tp kimironko - kibagabaga', 1000, 'welding', '', '', '', 5000, 0, 0, 0),
(66, 72, 'nubishaka utangire wishyure muriki cyumweru', 1234, '', '', '', '', 0, 0, 0, 0),
(67, 73, 'UGOMBAKWISHURA murikicyumweru', 234570, '', '', '', '', 0, 0, 0, 0),
(68, 74, 'ugomba kwishyura', 20000, '', '', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(110) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `user_role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_role`) VALUES
(5, 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
(34, 'fred', 'fred@gmail.com', '570a90bfbf8c7eab5dc5d4e26832d5b1', 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `role` varchar(23) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(250) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `meter_number` varchar(30) DEFAULT NULL,
  `customer_account` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `e_id`, `first_name`, `last_name`, `role`, `gender`, `address`, `telephone`, `meter_number`, `customer_account`, `password`) VALUES
(25, 0, 'Alfred', 'SINDAYIHEBA', 'Store', 'Male', 'Kimironko', '0788938330', NULL, NULL, ''),
(26, 0, 'Olivier', 'NTEZIRYAYO', 'Technician', 'Male', 'Kicukiro', '0786733081', NULL, NULL, ''),
(30, 0, 'Robert', 'NTAMBARA', 'Technician', 'Male', 'Remera', '0786466158', NULL, NULL, ''),
(31, 0, 'Gylain', 'BAHATI', 'Technician', 'Male', 'Kacyiru', '0787515354', NULL, NULL, ''),
(32, 0, 'Jules', 'HABINEZA', 'Technician', 'Male', 'Muhima', '0781059701', NULL, NULL, ''),
(33, 0, 'Emmanuel', 'HABIMANA', 'Technician', 'Male', 'Nyamirambo', '0783473165', NULL, NULL, ''),
(36, 0, 'Ignace', 'BARAHIRA', 'Technician', 'Male', 'Nyamirambo', '0790838900', NULL, NULL, ''),
(37, 0, 'Didon', 'RWIRAHIRA', 'Front Desk', 'Male', 'Kimironko', '0790419911', NULL, NULL, ''),
(38, 0, 'Christian', 'RUKUNDO', 'Driver', 'Male', 'Kicukiro', '0780643938', NULL, NULL, ''),
(39, 0, 'Anne Bella', 'NIYONIZEYE', 'Accountant', 'Male', 'N/A', '0782105782', NULL, NULL, ''),
(40, 0, 'Jean De Dieu', 'IRADUKUNDA', 'Technician', 'Male', 'Batsinda', '0788459629', NULL, NULL, ''),
(41, 0, 'Elidad', 'MUHAWENIMANA', 'Accountant', 'Male', 'Zindiro', '0788874800', NULL, NULL, ''),
(42, 0, 'Richard', 'MBANZA', 'Technician', 'Male', 'Remera', '0787654212', NULL, NULL, ''),
(43, 0, 'MBALA', 'MAKENGO', 'Technician', 'Male', 'N/A', 'N/A', NULL, NULL, ''),
(45, 0, 'Fiston', 'SIBOMANA', 'Store Keeper', 'Male', 'N/A', '078..........', NULL, NULL, ''),
(46, 0, '0780090009', 'Javan', 'ddf', 'Male', 'RWANDA', '0780090010', 'MTR-436536', NULL, ''),
(48, 0, 'ISHIMWE Martin', 'Javan', 'Technician', 'Male', 'RWANDA', '0780090009', 'MTR-208486', 'WB-2025-18293', 'wasac'),
(51, 0, '0780090009', 'Javan', 'Household', 'Male', 'RWANDA', '0780090000', 'MTR-981221', 'WB-2025-99400', 'wasac'),
(53, 0, 'ISHIMWE Martin', 'Luther', 'Household', 'Male', 'RWANDA', '0781090009', 'MTR-717021', 'WB-2025-57811', 'martin'),
(54, 0, 'fred', 'rudasingwa', 'Utility', 'Male', 'RWANDA', '0784390009', 'MTR-694478', 'WB-2025-23715', 'wasac'),
(55, 0, 'ishimwe martin', 'luther', 'Household', 'Male', 'RWANDA', '0786693287', 'MTR-136008', 'WB-2025-12359', 'wasac'),
(58, 0, 'fredy', 'fredy', 'institution', 'Male', 'MUHANGA', '0786693280', 'MTR-582737', 'WB-2025-10642', 'fredy'),
(59, 0, 'peter', 'peter', 'agricalture', 'Male', 'RWANDA', '0780090020', 'MTR-784729', 'WB-2025-14279', 'wasac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub-details`
--
ALTER TABLE `sub-details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `e_id` (`e_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub-details`
--
ALTER TABLE `sub-details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub-details`
--
ALTER TABLE `sub-details`
  ADD CONSTRAINT `sub-details_ibfk_1` FOREIGN KEY (`e_id`) REFERENCES `expense` (`e_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
