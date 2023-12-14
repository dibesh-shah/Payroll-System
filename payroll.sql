-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 04:22 PM
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
(38, 7, '2023-11-08', '2:03 PM', '2:03 PM', '2023-12-09 02:33:01', '2023-12-09 02:33:03'),
(39, 7, '2023-11-10', '10:00 PM', '5:00 PM', NULL, NULL),
(40, 7, '2023-11-11', '10:00 PM', '5:00 PM', NULL, NULL),
(41, 7, '2023-11-12', '10:00 PM', '5:00 PM', NULL, NULL),
(42, 7, '2023-11-13', '10:00 PM', '5:00 PM', NULL, NULL),
(43, 7, '2023-11-14', '10:00 PM', '5:00 PM', NULL, NULL),
(44, 7, '2023-11-15', '10:00 PM', '5:00 PM', NULL, NULL),
(45, 7, '2023-11-16', '10:00 PM', '5:00 PM', NULL, NULL),
(46, 7, '2023-11-17', '10:00 PM', '5:00 PM', NULL, NULL),
(47, 7, '2023-11-18', '10:00 PM', '5:00 PM', NULL, NULL),
(48, 7, '2023-11-19', '10:00 PM', '5:00 PM', NULL, NULL),
(49, 7, '2023-11-20', '10:00 PM', '5:00 PM', NULL, NULL),
(50, 7, '2023-11-21', '10:00 PM', '5:00 PM', NULL, NULL),
(51, 7, '2023-11-22', '10:00 PM', '5:00 PM', NULL, NULL),
(52, 7, '2023-11-23', '10:00 PM', '5:00 PM', NULL, NULL),
(53, 7, '2023-11-24', '10:00 PM', '5:00 PM', NULL, NULL),
(54, 7, '2023-11-25', '10:00 PM', '5:00 PM', NULL, NULL),
(55, 7, '2023-11-26', '10:00 PM', '5:00 PM', NULL, NULL),
(56, 7, '2023-11-27', '10:00 PM', '5:00 PM', NULL, NULL),
(64, 1, '2023-12-14', '5:53 PM', '5:53 PM', '2023-12-14 06:23:13', '2023-12-14 06:23:20');

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
  `designation` varchar(255) DEFAULT NULL,
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

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `date_of_birth`, `permanent_address`, `mailing_address`, `bank_account_number`, `bank_name`, `gender`, `designation`, `tax_payer_id`, `tax_filing_status`, `document`, `department_id`, `status`, `password`, `created_at`, `updated_at`, `date_of_joining`, `hiring_date`, `salary`, `role`) VALUES
(1, 'Bimal', 'Paudel', 'hello@gmail.com', '9854545454', '2001-01-02', 'Balaju', 'baneshwor', '16723525878767', 'NIC Asia', 'male', 'Software Engineer', '314256', 'married', 'documents/Khc9Wf8tPmOpLkQj1AH5wYlk6lS1sU0hsJw56tJS.pdf', 1, 'approved', '$2y$10$L0PHWFffHfo6PJcojsK2qe/i.u.hhLNM5W/ChNinx5F35Twyedsj6', '2023-08-14 03:36:10', '2023-12-14 06:00:49', '2023-08-18', '2023-08-14', 70000.00, 'employee'),
(2, 'dibesh', 'shah', 'admin@gmail.com', '9843563423', '2023-08-03', 'Balaju', 'baneshwor', '16723525252525', 'NIC Asia', 'male', NULL, 'jsnmcsn12', 'single', 'documents/eKfhUhsw1sDRGtzy6Ndy56wE7iEQqXf4uO9aeEql.pdf', 1, 'approved', '$2y$10$Ri9KS2YfgvNsOxqzyjg7oumPz0UxyBurW721i6EsNdJwmdChIy/Li', '2023-08-15 02:59:56', '2023-08-15 03:06:15', '2023-08-18', '2023-08-14', 60000.00, 'admin'),
(5, 'Bimala', 'shyam', 'minusking2002@gmail.com', '9843563423', '2023-08-02', 'Balaju1', 'baneshwor', '16723525252524', 'NIC Asian', 'female', NULL, 'jsnmcsn123', 'married', 'documents/rHkK0sNPzXSXIXAkOzOWGYdP9h9zSZUiArISI87w.pdf', 3, 'approved', '$2y$10$RJaQQea3ooUqDBNKg.pMxegJ4dA0rq3JZzRa0JyU5YrfIe8uZjeNG', '2023-08-26 04:38:39', '2023-08-28 03:18:28', '2023-08-18', '2023-08-14', 50000.00, 'employee'),
(6, 'Sujan', 'Bista', 'sujan@gmail.com', '9898989898', '2023-12-06', 'lumbini', 'kathmandu', '280546745565655', 'Kumari Bank', 'female', NULL, '6598952', 'single', 'documents/hnZO9Bvenys6lO14j3xXZVVsCsG1oJJ2FrJGhd8A.pdf', 2, 'approved', NULL, '2023-12-08 23:01:19', '2023-12-08 23:02:44', '2023-12-09', NULL, 100000.00, 'employee'),
(7, 'Joeh', 'Harry', 'harryprince69@gmail.com', '9898989898', '1997-06-10', 'lumbini', 'kathmandu', '280546745565655', 'Kumari Bank', 'male', 'hr', '6598952', 'single', 'documents/d0QOG2oxJGro13quCUfIEs2FASsDPJ4bJWA7NrzG.pdf', 1, 'approved', '$2y$10$AI.NAw/pzuiCc2RXF5pEr.6K3L7Jf292m6OXCj0dXRyhRZTPLCpiq', '2023-12-09 02:24:20', '2023-12-13 10:04:14', '2023-12-14', '2023-12-12', 100000.00, 'employee'),
(8, 'dfjdk', 'jldfj', 'dfjl@dkfj.ch', '9898989988', '2023-12-05', 'djlfkdf', 'dlfkjfl', '656556', 'dkfjfd', 'male', NULL, '5454545', 'single', 'documents/XFnXR6G56xsCn47pg6DdZZ4Qn7dWnOVOv803Dvko.pdf', NULL, 'pending', NULL, '2023-12-13 02:53:41', '2023-12-13 02:53:41', '2023-12-13', '2023-12-13', NULL, 'employee'),
(9, 'Sujan', 'Bista', 'dbex7502@gmail.com', '9898989898', '2023-11-30', 'lumbini', 'kathmandu', '280546745565655', 'Kumari Bank', 'male', 'hdfkfdj', '6598952', 'married', 'documents/uWQzssnDqDkQXamCkTmjpbyukBUi0N6UxgpQ4EIu.pdf', 1, 'approved', '$2y$10$R/ef4AJVDy6m3ebqqFYuxeiX7vGZv3nY0fMd3O8tkHfA8AINKldbK', '2023-12-13 08:13:33', '2023-12-13 21:46:57', '2023-12-14', '2023-12-14', 100000.00, 'employee'),
(10, 'Sujan', 'Giri', 'deepakgiri23@gmail.com', '9878457868', '2023-12-08', 'lumbini', 'kathmandu', '46656454114', 'Kumari Bank', 'male', NULL, '6598952', 'single', 'documents/OKCOMOMigSi5q1jN8U65oHywRfXZMt8nVesfoq5S.pdf', 1, 'approved', '$2y$10$BBcsaTFkTavw7RN9fMCmJeg4mKSnWsPZ8qGVZN.DIMqRfNg/.XdMW', '2023-12-13 08:15:49', '2023-12-13 10:01:12', '2023-12-13', '2023-12-12', 70000.00, 'employee'),
(11, 'Sujan', 'Bista', 'company@example.comm', '9878457868', '2023-12-06', 'lumbini', 'kathmandu', '280546745565655', 'Kumari Bank', 'male', NULL, '6598952', 'single', 'documents/OZmn1WKWgFP0gOeHaZ3AKzE1UQ6yBWKDlLSl4F88.pdf', NULL, 'rejected', NULL, '2023-12-13 08:26:25', '2023-12-13 09:05:30', '2023-12-13', '2023-12-13', NULL, 'employee');

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
(1, 1, 1200.00, 'amount', '2023-08-14 21:10:07', '2023-08-14 21:10:07'),
(1, 2, 1500.00, 'amount', '2023-08-14 21:10:07', '2023-08-14 21:10:07'),
(6, 1, 3000.00, 'amount', '2023-12-08 23:02:45', '2023-12-08 23:02:45'),
(6, 2, 10.00, 'percentage', '2023-12-08 23:02:45', '2023-12-08 23:02:45');

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
(1, 1, 2000.00, 'amount', '2023-08-14 21:10:07', '2023-08-14 21:10:07'),
(1, 2, 10.00, 'percentage', '2023-08-14 21:10:07', '2023-08-14 21:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leave_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`id`, `employee_id`, `leave_id`, `created_at`, `updated_at`) VALUES
(1, 9, 2, '2023-12-13 21:43:04', '2023-12-13 21:43:04'),
(2, 9, 5, '2023-12-13 21:43:04', '2023-12-13 21:43:04');

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
(1, '0000-00-00', 'Public Holiday', '2023-09-27 02:19:05', '2023-09-27 02:19:05'),
(2, '0000-00-00', 'Other', '2023-09-27 02:19:28', '2023-09-27 02:19:28'),
(3, '0000-00-00', 'Public Holiday', '2023-09-27 03:17:20', '2023-09-27 03:17:20'),
(4, '2023-9-24,2023-9-25', 'Public Holiday', '2023-09-29 09:06:07', '2023-09-29 09:06:07'),
(5, '2023-10-15,2023-10-20', 'Weekend', '2023-10-02 00:08:05', '2023-10-02 00:08:05'),
(6, '2023-10-15,2023-10-20,2023-10-17,2023-10-4', 'Other', '2023-10-02 00:08:37', '2023-10-02 00:08:37'),
(7, '2023-11-29', 'Public Holiday', '2023-12-10 10:00:17', '2023-12-10 10:00:17'),
(8, '2023-11-30', 'Other', '2023-12-10 10:08:57', '2023-12-10 10:08:57'),
(9, '2023-11-25', 'Public Holiday', '2023-12-10 10:09:51', '2023-12-10 10:09:51'),
(11, '2023-11-18,2023-11-17', 'Public Holiday', '2023-12-10 10:11:21', '2023-12-10 10:11:21'),
(12, '2023-12-31', 'Public Holiday', '2023-12-14 08:02:09', '2023-12-14 08:02:09'),
(13, '2023-12-24', 'Public Holiday', '2023-12-14 08:05:19', '2023-12-14 08:05:19'),
(14, '2023-12-17', 'Public Holiday', '2023-12-14 08:06:18', '2023-12-14 08:06:18'),
(15, '2023-12-10', 'Public Holiday', '2023-12-14 08:08:17', '2023-12-14 08:08:17'),
(16, '2023-12-25', 'Weekend', '2023-12-14 08:09:53', '2023-12-14 08:09:53'),
(17, '2023-12-25', 'Weekend', '2023-12-14 08:10:11', '2023-12-14 08:10:11'),
(18, '2023-12-26', 'Other', '2023-12-14 08:11:00', '2023-12-14 08:11:00'),
(19, '2023-12-25,2023-12-27', 'Weekend', '2023-12-14 08:11:13', '2023-12-14 08:11:13'),
(20, '2023-12-3', 'Weekend', '2023-12-14 08:22:04', '2023-12-14 08:22:04'),
(21, '2023-12-28', 'Weekend', '2023-12-14 08:23:23', '2023-12-14 08:23:23');

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
(78, '2', '1', 'September 30, 12:47 PM', 'ikay then', '1', '2023-09-30 07:02:51', '2023-09-30 07:02:51'),
(79, '1', '2', 'September 30, 12:55 PM', 'i dont like the way you are talking okay please mind your language there is something worng with you;l:L;\'', '1', '2023-09-30 07:10:49', '2023-09-30 07:10:49'),
(80, '2', '1', 'September 30, 12:56 PM', 'oh okay dear', '1', '2023-09-30 07:11:07', '2023-09-30 07:11:07'),
(81, '2', '1', 'October 1, 1:09 PM', 'hello bimal how are you doing', '1', '2023-10-01 07:24:35', '2023-10-01 07:24:35'),
(82, '1', '2', 'October 1, 1:09 PM', 'doing great', '1', '2023-10-01 07:24:45', '2023-10-01 07:24:45'),
(83, '2', '7', 'December 12, 8:53 PM', 'hello harry', '7', '2023-12-12 15:08:57', '2023-12-12 15:08:57'),
(84, '7', '2', 'December 12, 8:55 PM', 'hi admin', '7', '2023-12-12 15:10:07', '2023-12-12 15:10:07'),
(85, '2', '7', 'December 12, 8:55 PM', 'nice', '7', '2023-12-12 15:10:15', '2023-12-12 15:10:15'),
(86, '2', '11', 'December 14, 9:23 AM', 'hello', '11', '2023-12-14 03:38:16', '2023-12-14 03:38:16'),
(87, '2', '1', 'December 14, 6:18 PM', 'hello', '1', '2023-12-14 12:33:17', '2023-12-14 12:33:17'),
(88, '1', '2', 'December 14, 6:18 PM', 'hello', '1', '2023-12-14 12:33:26', '2023-12-14 12:33:26');

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
(1, 1, '2', '2023-09-14', '2023-09-18', 'rejected', 'hello', 'hello', '2023-09-30 09:06:05', '2023-10-02 00:07:03'),
(2, 1, '1', '2023-09-07', '2023-09-07', 'approved', 'fgdfg', 'take a leave', '2023-09-30 10:22:59', '2023-09-30 11:20:22'),
(3, 1, '1', '2023-09-07', '2023-09-13', 'approved', 'hjhj', NULL, '2023-09-30 10:29:51', '2023-10-01 05:20:11'),
(4, 1, '4', '2023-09-09', '2023-09-16', 'approved', 'i want to take a leave', 'okay i am granting you a leave', '2023-09-30 11:24:43', '2023-09-30 11:25:40'),
(5, 1, '5', '2023-10-20', '2023-10-27', 'approved', 'hkjjkjhkj', 'kdljfj', '2023-09-30 23:36:55', '2023-09-30 23:37:28'),
(6, 1, '3', '2023-10-12', '2023-10-13', 'approved', 'khjkjhjk', 'ok', '2023-09-30 23:45:59', '2023-10-01 01:17:52'),
(7, 1, '1', '2023-10-01', '2023-10-01', 'approved', NULL, NULL, '2023-10-02 00:05:29', '2023-10-02 00:07:15'),
(8, 1, '2', '2023-12-14', '2023-12-14', 'approved', 'i want leave today', 'ikay', '2023-12-14 06:34:24', '2023-12-14 07:27:53'),
(9, 1, '2', '2023-12-14', '2023-12-14', 'rejected', 'jkdfjkdjf', NULL, '2023-12-14 06:36:05', '2023-12-14 07:31:39'),
(10, 9, '5', '2023-12-15', '2023-12-18', 'rejected', 'hjj', 'i am approving it', '2023-12-14 06:53:46', '2023-12-14 09:03:12'),
(11, 9, '5', '2023-12-15', '2023-12-15', 'pending', NULL, NULL, '2023-12-14 07:42:48', '2023-12-14 07:42:48'),
(12, 9, '2', '2023-12-15', '2023-12-15', 'rejected', 'dlkjlkfjkl', NULL, '2023-12-14 09:30:14', '2023-12-14 09:30:38');

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
(2, 5, 50000.00, NULL, '2023-08-26 04:39:22', '2023-08-28 00:34:39'),
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
  `income` varchar(255) DEFAULT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `year`, `status`, `income`, `tax_rate`, `created_at`, `updated_at`) VALUES
(100, '2080/81', 'couple', '600000', 1, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(101, '2080/81', 'couple', '200000', 10, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(102, '2080/81', 'couple', '300000', 20, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(103, '2080/81', 'couple', '900000', 30, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(104, '2080/81', 'couple', '3000000', 36, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(105, '2080/81', 'couple', '5000000', 39, '2023-12-14 07:50:21', '2023-12-14 07:50:21'),
(112, '2080/81', 'single', '500000', 1, '2023-12-14 07:51:03', '2023-12-14 07:51:03'),
(113, '2080/81', 'single', '200000', 10, '2023-12-14 07:51:03', '2023-12-14 07:51:03'),
(114, '2080/81', 'single', '300000', 20, '2023-12-14 07:51:03', '2023-12-14 07:51:03'),
(115, '2080/81', 'single', '1000000', 30, '2023-12-14 07:51:03', '2023-12-14 07:51:03'),
(116, '2080/81', 'single', '3000000', 36, '2023-12-14 07:51:03', '2023-12-14 07:51:03'),
(117, '2080/81', 'single', '5000000', 39, '2023-12-14 07:51:03', '2023-12-14 07:51:03');

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
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `leave_id` (`leave_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `employee_leave_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `employee_leave_ibfk_2` FOREIGN KEY (`leave_id`) REFERENCES `leaves` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
