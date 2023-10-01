-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 03:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'travel allowance', 'travel allowance', '2023-08-14 07:26:55', '2023-08-14 07:26:55'),
(2, 'Health Allowance', 'Health Allowance', '2023-08-14 07:27:10', '2023-08-14 07:27:10'),
(3, 'HRA', 'House Rent Allowance', '2023-09-26 06:18:02', '2023-09-26 06:18:02'),
(4, 'DA', 'Dearness Allowance', '2023-09-26 06:18:20', '2023-09-26 06:18:20'),
(5, 'Conveyance Allowance', 'Conveyance Allowance', '2023-09-26 06:18:41', '2023-09-26 06:18:41'),
(6, 'Medical Allowances', 'Medical Allowances', '2023-09-26 06:19:27', '2023-09-26 06:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `clock_in` varchar(256) NOT NULL,
  `clock_out` varchar(256) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `date`, `clock_in`, `clock_out`, `created_at`, `updated_at`) VALUES
(17, 2, '2023-08-20', '3:21 PM', '3:35 PM', '2023-08-25 03:51:38', '2023-08-25 04:05:44'),
(18, 2, '2023-08-21', '12:04 PM', '06:54 PM', NULL, NULL),
(22, 2, '2023-08-22', '10:12 AM', '05:32 PM', NULL, NULL),
(23, 2, '2023-08-23', '10:12 AM', '05:32 PM', NULL, NULL),
(25, 2, '2023-08-24', '10:12 AM', '05:32 PM', NULL, NULL),
(27, 1, '2023-08-24', '10:12 AM', '05:32 PM', NULL, NULL),
(28, 2, '2023-08-25', '3:54 PM', '3:54 PM', '2023-08-25 04:24:39', '2023-08-25 04:24:42'),
(29, 1, '2023-08-26', '8:28 AM', '8:28 AM', '2023-08-25 20:58:54', '2023-08-25 20:58:56'),
(30, 5, '2023-08-28', '12:08 PM', '12:08 PM', '2023-08-28 00:38:17', '2023-08-28 00:38:18'),
(31, 5, '2023-08-29', '10:45 AM', NULL, NULL, NULL),
(32, 5, '2023-08-29', '10:40 AM', NULL, NULL, NULL),
(33, 1, '2023-09-29', '10:36 AM', NULL, '2023-09-28 23:06:18', '2023-09-28 23:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Loan', 'loan', '2023-08-14 07:27:30', '2023-08-14 07:27:30'),
(2, 'PF', 'provident fund', '2023-08-14 07:27:41', '2023-08-14 07:27:41'),
(3, 'Pension Deduction', 'Pension Deduction', '2023-09-26 06:20:28', '2023-09-26 06:20:28'),
(4, 'ESI', 'Employee State Insurance (ESI) Deduction', '2023-09-26 06:21:33', '2023-09-26 06:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2023-08-14 03:35:23', '2023-08-14 03:35:23'),
(2, 'IT', 'it', '2023-08-28 00:12:56', '2023-08-28 00:12:56'),
(3, 'Accountancy', 'account', '2023-08-28 00:13:08', '2023-08-28 00:13:08'),
(4, 'HR', 'Human Resourcing', '2023-09-26 06:08:52', '2023-09-26 06:08:52'),
(5, 'Finance and Accounting', 'Finance and Accounting', '2023-09-26 06:09:18', '2023-09-26 06:09:18'),
(6, 'Marketing', 'Marketing', '2023-09-26 06:09:46', '2023-09-26 06:09:46'),
(7, 'Sales', 'Sales', '2023-09-26 06:10:07', '2023-09-26 06:10:07'),
(8, 'QA', 'Quality Assurance', '2023-09-26 06:10:41', '2023-09-26 06:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `mailing_address` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `tax_payer_id` varchar(255) NOT NULL,
  `tax_filing_status` enum('single','married') NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `hiring_date` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `role` enum('employee','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `date_of_birth`, `permanent_address`, `mailing_address`, `bank_account_number`, `bank_name`, `gender`, `tax_payer_id`, `tax_filing_status`, `document`, `department_id`, `status`, `password`, `created_at`, `updated_at`, `date_of_joining`, `hiring_date`, `salary`, `role`) VALUES
(1, 'Bimal', 'Paudel', 'hello@gmail.com', '9843563423', '2023-08-16', 'Balaju', 'baneshwor', '16723525252525', 'NIC Asia', 'male', 'jsnmcsn12', 'single', 'documents/Khc9Wf8tPmOpLkQj1AH5wYlk6lS1sU0hsJw56tJS.pdf', 1, 'approved', '$2y$10$L0PHWFffHfo6PJcojsK2qe/i.u.hhLNM5W/ChNinx5F35Twyedsj6', '2023-08-14 03:36:10', '2023-08-15 02:55:07', '2023-08-18', '2023-08-14', 70000.00, 'employee'),
(2, 'dibesh', 'shah', 'admin@gmail.com', '9843563423', '2023-08-03', 'Balaju', 'baneshwor', '16723525252525', 'NIC Asia', 'male', 'jsnmcsn12', 'single', 'documents/eKfhUhsw1sDRGtzy6Ndy56wE7iEQqXf4uO9aeEql.pdf', 1, 'approved', '$2y$10$Ri9KS2YfgvNsOxqzyjg7oumPz0UxyBurW721i6EsNdJwmdChIy/Li', '2023-08-15 02:59:56', '2023-08-15 03:06:15', '2023-08-18', '2023-08-14', 60000.00, 'admin'),
(5, 'Bimala', 'shyam', 'minusking2002@gmail.com', '9843563423', '2023-08-02', 'Balaju1', 'baneshwor', '16723525252524', 'NIC Asian', 'female', 'jsnmcsn123', 'married', 'documents/rHkK0sNPzXSXIXAkOzOWGYdP9h9zSZUiArISI87w.pdf', 3, 'approved', '$2y$10$RJaQQea3ooUqDBNKg.pMxegJ4dA0rq3JZzRa0JyU5YrfIe8uZjeNG', '2023-08-26 04:38:39', '2023-08-28 03:18:28', '2023-08-18', '2023-08-14', 50000.00, 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `employee_allowance`
--

CREATE TABLE `employee_allowance` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `allowance_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `type` enum('amount','percentage') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_allowance`
--

INSERT INTO `employee_allowance` (`employee_id`, `allowance_id`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 1200.00, 'amount', '2023-08-15 02:55:07', '2023-08-15 02:55:07'),
(1, 2, 1500.00, 'amount', '2023-08-15 02:55:07', '2023-08-15 02:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `employee_deduction`
--

CREATE TABLE `employee_deduction` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `deduction_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `type` enum('amount','percentage') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_deduction`
--

INSERT INTO `employee_deduction` (`employee_id`, `deduction_id`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2000.00, 'amount', '2023-08-15 02:55:07', '2023-08-15 02:55:07'),
(1, 2, 0.00, 'percentage', '2023-08-15 02:55:07', '2023-08-15 02:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holiday_date` varchar(255) NOT NULL,
  `holiday_type` enum('Weekend','Public Holiday','Other') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `holiday_date`, `holiday_type`, `created_at`, `updated_at`) VALUES
(4, '2023-9-24,2023-9-25', 'Public Holiday', '2023-09-29 09:06:07', '2023-09-29 09:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `inboxes`
--

CREATE TABLE `inboxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `senderId` varchar(255) NOT NULL,
  `receiverId` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `conversationId` varchar(256) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inboxes`
--

INSERT INTO `inboxes` (`id`, `senderId`, `receiverId`, `dateTime`, `message`, `conversationId`, `created_at`, `updated_at`) VALUES
(1, '1', 'Admin', 'abcabc', 'esgr', '', '2023-09-29 00:36:17', '2023-09-29 00:36:17'),
(2, '1', '2', 'abcabc', 'bimal paudel', '', '2023-09-29 00:52:45', '2023-09-29 00:52:45'),
(3, '1', '2', 'September 29, 12:48 PM', 'adasd', '', '2023-09-29 07:03:05', '2023-09-29 07:03:05'),
(4, '1', '2', 'September 29, 12:56 PM', 'gehb', '', '2023-09-29 07:11:20', '2023-09-29 07:11:20'),
(5, '1', '2', 'September 29, 12:58 PM', 'sbcsjwbf', '', '2023-09-29 07:13:36', '2023-09-29 07:13:36'),
(6, '1', '2', 'September 29, 12:59 PM', 'afghn', '', '2023-09-29 07:14:53', '2023-09-29 07:14:53'),
(7, '1', '2', 'September 29, 1:02 PM', 'helo hello', '', '2023-09-29 07:17:25', '2023-09-29 07:17:25'),
(8, '1', '2', 'September 29, 1:05 PM', 'hkdkfkfddfk', '', '2023-09-29 07:20:08', '2023-09-29 07:20:08'),
(9, '1', '2', 'September 29, 1:05 PM', 'fjdjd', '', '2023-09-29 07:20:48', '2023-09-29 07:20:48'),
(10, '1', '2', 'September 29, 1:08 PM', 'jkdfkdkfj', '', '2023-09-29 07:23:27', '2023-09-29 07:23:27'),
(11, '1', '2', 'September 29, 1:09 PM', 'fhjdhjdjfhj', '', '2023-09-29 07:24:36', '2023-09-29 07:24:36'),
(12, '1', '2', 'September 29, 1:15 PM', 'kjdkfkdfk', '', '2023-09-29 07:30:58', '2023-09-29 07:30:58'),
(13, '1', '2', 'September 29, 1:17 PM', 'jkdjkfkj', '', '2023-09-29 07:32:09', '2023-09-29 07:32:09'),
(14, '1', '2', 'September 29, 1:21 PM', 'kjkdkfkdf', '', '2023-09-29 07:36:18', '2023-09-29 07:36:18'),
(15, '1', '2', 'September 29, 1:21 PM', 'jdkkddkdjk', '', '2023-09-29 07:36:30', '2023-09-29 07:36:30'),
(16, '1', '2', 'September 29, 1:23 PM', 'kfjkdjkfdj', '', '2023-09-29 07:38:38', '2023-09-29 07:38:38'),
(17, '1', '2', 'September 29, 1:25 PM', 'jshdjsdj', '', '2023-09-29 07:40:36', '2023-09-29 07:40:36'),
(18, '1', '2', 'September 29, 1:28 PM', 'jdhsjhdj', '', '2023-09-29 07:43:47', '2023-09-29 07:43:47'),
(19, '1', '2', 'September 29, 1:28 PM', 'hdhdjsjdsdj', '', '2023-09-29 07:43:55', '2023-09-29 07:43:55'),
(20, '1', '2', 'September 29, 1:29 PM', 'jdhjhdfhj', '', '2023-09-29 07:44:42', '2023-09-29 07:44:42'),
(21, '2', '1', 'September 29, 2:30 PM', 'kdjkfjkf', '', '2023-09-29 08:45:22', '2023-09-29 08:45:22'),
(22, '2', '1', 'September 29, 2:34 PM', 'hkdkdh', '', '2023-09-29 08:49:55', '2023-09-29 08:49:55'),
(23, '1', '2', 'September 29, 9:21 PM', 'hello admin', '', '2023-09-29 15:36:56', '2023-09-29 15:36:56'),
(24, '2', '5', 'September 29, 9:22 PM', 'hello user', '', '2023-09-29 15:37:21', '2023-09-29 15:37:21'),
(25, '2', '5', 'September 29, 9:24 PM', 'hey bimala', '', '2023-09-29 15:39:03', '2023-09-29 15:39:03'),
(26, '1', '2', 'September 29, 9:30 PM', 'hey admin what up', '1', '2023-09-29 15:45:51', '2023-09-29 15:45:51'),
(27, '1', '2', 'September 29, 9:34 PM', 'kfhjdk', '1', '2023-09-29 15:49:05', '2023-09-29 15:49:05'),
(28, '2', '5', 'September 29, 9:37 PM', 'fdfjfdj', '5', '2023-09-29 15:52:19', '2023-09-29 15:52:19'),
(29, '2', '5', 'September 29, 9:39 PM', 'dfhkdjf', '5', '2023-09-29 15:54:04', '2023-09-29 15:54:04'),
(30, '1', '2', 'September 29, 9:41 PM', 'fhjdfhjd', '1', '2023-09-29 15:56:48', '2023-09-29 15:56:48'),
(31, '2', '1', 'September 29, 9:43 PM', 'its from admin', '1', '2023-09-29 15:58:21', '2023-09-29 15:58:21'),
(32, '1', '2', 'September 29, 9:43 PM', 'hhhhhh', '1', '2023-09-29 15:58:32', '2023-09-29 15:58:32'),
(33, '2', '1', 'September 29, 9:44 PM', 'hhhhh', '1', '2023-09-29 15:59:13', '2023-09-29 15:59:13'),
(34, '1', '2', 'September 29, 10:15 PM', 'okay admin', '1', '2023-09-29 16:30:25', '2023-09-29 16:30:25'),
(35, '5', '2', 'September 29, 10:26 PM', 'hhey bimala', '5', '2023-09-29 16:41:57', '2023-09-29 16:41:57'),
(36, '1', '2', 'September 29, 11:00 PM', 'hui hui hui', '1', '2023-09-29 17:15:48', '2023-09-29 17:15:48'),
(37, '1', '2', 'September 30, 10:46 AM', 'this is new okay admin', '1', '2023-09-30 05:01:28', '2023-09-30 05:01:28'),
(38, '2', '5', 'September 30, 10:46 AM', 'okay gotcha', '5', '2023-09-30 05:01:56', '2023-09-30 05:01:56'),
(39, '2', '5', 'September 30, 10:55 AM', 'this is 38', '5', '2023-09-30 05:10:46', '2023-09-30 05:10:46'),
(40, '2', '5', 'September 30, 10:56 AM', 'this is 40', '5', '2023-09-30 05:11:23', '2023-09-30 05:11:23'),
(41, '2', '1', 'September 30, 10:59 AM', 'hello bimal busy', '1', '2023-09-30 05:14:09', '2023-09-30 05:14:09'),
(42, '1', '2', 'September 30, 10:59 AM', 'oh you there', '1', '2023-09-30 05:14:32', '2023-09-30 05:14:32'),
(43, '2', '5', 'September 30, 10:59 AM', 'you are bimala right', '5', '2023-09-30 05:14:54', '2023-09-30 05:14:54'),
(44, '2', '1', 'September 30, 11:17 AM', 'odhfkd', '1', '2023-09-30 05:32:51', '2023-09-30 05:32:51'),
(45, '2', '1', 'September 30, 11:18 AM', 'dfkhkjdfhk', '1', '2023-09-30 05:33:49', '2023-09-30 05:33:49'),
(46, '2', '1', 'September 30, 11:27 AM', 'hui hui', '1', '2023-09-30 05:42:35', '2023-09-30 05:42:35'),
(47, '1', '2', 'September 30, 11:27 AM', 'ikdkf', '1', '2023-09-30 05:42:53', '2023-09-30 05:42:53'),
(48, '2', '1', 'September 30, 11:33 AM', 'hello', '1', '2023-09-30 05:48:27', '2023-09-30 05:48:27'),
(49, '1', '2', 'September 30, 11:33 AM', 'hwo you', '1', '2023-09-30 05:48:44', '2023-09-30 05:48:44'),
(50, '2', '1', 'September 30, 11:33 AM', 'fine', '1', '2023-09-30 05:48:54', '2023-09-30 05:48:54'),
(51, '1', '2', 'September 30, 11:34 AM', 'ok', '1', '2023-09-30 05:49:03', '2023-09-30 05:49:03'),
(52, '1', '2', 'September 30, 12:07 PM', 'hello', '1', '2023-09-30 06:22:21', '2023-09-30 06:22:21'),
(53, '2', '1', 'September 30, 12:07 PM', 'hello', '1', '2023-09-30 06:22:28', '2023-09-30 06:22:28'),
(54, '1', '2', 'September 30, 12:17 PM', 'hello', '1', '2023-09-30 06:32:49', '2023-09-30 06:32:49'),
(55, '2', '1', 'September 30, 12:18 PM', 'hi', '1', '2023-09-30 06:33:00', '2023-09-30 06:33:00'),
(56, '1', '2', 'September 30, 12:18 PM', 'ok', '1', '2023-09-30 06:33:11', '2023-09-30 06:33:11'),
(57, '2', '1', 'September 30, 12:18 PM', 'nice', '1', '2023-09-30 06:33:19', '2023-09-30 06:33:19'),
(58, '1', '2', 'September 30, 12:32 PM', 'hello admin', '1', '2023-09-30 06:47:52', '2023-09-30 06:47:52'),
(59, '2', '1', 'September 30, 12:33 PM', 'hi', '1', '2023-09-30 06:48:28', '2023-09-30 06:48:28'),
(60, '1', '2', 'September 30, 12:34 PM', 'hho you', '1', '2023-09-30 06:49:01', '2023-09-30 06:49:01'),
(61, '2', '1', 'September 30, 12:35 PM', 'hello', '1', '2023-09-30 06:50:53', '2023-09-30 06:50:53'),
(62, '1', '2', 'September 30, 12:36 PM', 'how you', '1', '2023-09-30 06:51:04', '2023-09-30 06:51:04'),
(63, '1', '2', 'September 30, 12:38 PM', 'get', '1', '2023-09-30 06:53:52', '2023-09-30 06:53:52'),
(64, '1', '2', 'September 30, 12:40 PM', 'hello', '1', '2023-09-30 06:55:10', '2023-09-30 06:55:10'),
(65, '2', '1', 'September 30, 12:40 PM', 'hi how you', '1', '2023-09-30 06:55:20', '2023-09-30 06:55:20'),
(66, '1', '2', 'September 30, 12:41 PM', 'fine', '1', '2023-09-30 06:56:38', '2023-09-30 06:56:38'),
(67, '2', '1', 'September 30, 12:41 PM', 'and you', '1', '2023-09-30 06:56:45', '2023-09-30 06:56:45'),
(68, '1', '2', 'September 30, 12:41 PM', 'fine also', '1', '2023-09-30 06:56:53', '2023-09-30 06:56:53'),
(69, '2', '1', 'September 30, 12:42 PM', 'what are you doing', '1', '2023-09-30 06:57:04', '2023-09-30 06:57:04'),
(70, '1', '2', 'September 30, 12:42 PM', 'nothing much', '1', '2023-09-30 06:57:16', '2023-09-30 06:57:16'),
(71, '2', '1', 'September 30, 12:42 PM', 'see you then', '1', '2023-09-30 06:57:40', '2023-09-30 06:57:40'),
(72, '1', '2', 'September 30, 12:44 PM', 'kfkd', '1', '2023-09-30 06:59:13', '2023-09-30 06:59:13'),
(73, '1', '2', 'September 30, 12:45 PM', 'hey', '1', '2023-09-30 07:00:12', '2023-09-30 07:00:12'),
(74, '2', '1', 'September 30, 12:45 PM', 'what up', '1', '2023-09-30 07:00:21', '2023-09-30 07:00:21'),
(75, '1', '2', 'September 30, 12:47 PM', 'hey admin', '1', '2023-09-30 07:02:23', '2023-09-30 07:02:23'),
(76, '2', '1', 'September 30, 12:47 PM', 'yes tell me', '1', '2023-09-30 07:02:34', '2023-09-30 07:02:34'),
(77, '1', '2', 'September 30, 12:47 PM', 'nothing sir ji', '1', '2023-09-30 07:02:43', '2023-09-30 07:02:43'),
(78, '2', '1', 'September 30, 12:47 PM', 'ikay then', '1', '2023-09-30 07:02:51', '2023-09-30 07:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `days` int(11) NOT NULL,
  `type` enum('paid','unpaid') NOT NULL DEFAULT 'paid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `name`, `days`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Bereavement Leave', 5, 'paid', '2023-09-26 06:15:00', '2023-09-26 06:15:00'),
(2, 'Sick Leave', 5, 'paid', '2023-09-26 06:15:22', '2023-09-26 06:15:22'),
(3, 'Family and Medical Leave (FMLA)', 3, 'unpaid', '2023-09-26 06:15:58', '2023-09-26 06:15:58'),
(4, 'Educational Leave', 5, 'unpaid', '2023-09-26 06:16:30', '2023-09-26 06:16:30'),
(5, 'Personal Leave', 2, 'unpaid', '2023-09-26 06:17:02', '2023-09-26 06:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `message` text DEFAULT NULL,
  `admin_response` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`, `message`, `admin_response`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sick Leave', '2023-09-14', '2023-09-18', 'approved', 'hello', 'hello', '2023-09-30 09:06:05', '2023-09-30 04:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_29_045740_create_holidays_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `net_pay` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `basic_salary`, `net_pay`, `created_at`, `updated_at`) VALUES
(2, 5, 50000.00, NULL, '2023-08-26 04:39:22', '2023-08-28 00:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `salary_structures`
--

CREATE TABLE `salary_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) NOT NULL,
  `status` enum('single','couple') NOT NULL,
  `income` varchar(255) NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `year`, `status`, `income`, `tax_rate`, `created_at`, `updated_at`) VALUES
(4, '2080/81', 'single', '500000', 1, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(5, '2080/81', 'single', '200000', 10, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(6, '2080/81', 'single', '300000', 20, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(7, '2080/81', 'single', '1000000', 30, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(8, '2080/81', 'single', '3000000', 36, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(9, '2080/81', 'single', '5000000', 39, '2023-09-28 10:11:22', '2023-09-28 10:11:22'),
(10, '2080/81', 'couple', '600000', 1, '2023-09-28 10:15:19', '2023-09-28 10:15:19'),
(11, '2080/81', 'couple', '200000', 10, '2023-09-28 10:15:19', '2023-09-28 10:15:19'),
(12, '2080/81', 'couple', '300000', 20, '2023-09-28 10:15:19', '2023-09-28 10:15:19'),
(13, '2080/81', 'couple', '900000', 30, '2023-09-28 10:15:19', '2023-09-28 10:15:19'),
(14, '2080/81', 'couple', '3000000', 36, '2023-09-28 10:15:19', '2023-09-28 10:15:19'),
(15, '2080/81', 'couple', '5000000', 39, '2023-09-28 10:15:19', '2023-09-28 10:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  ADD KEY `employee_allowance_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_allowance_allowance_id_foreign` (`allowance_id`);

--
-- Indexes for table `employee_deduction`
--
ALTER TABLE `employee_deduction`
  ADD KEY `employee_deduction_employee_id_foreign` (`employee_id`),
  ADD KEY `employee_deduction_deduction_id_foreign` (`deduction_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inboxes`
--
ALTER TABLE `inboxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
