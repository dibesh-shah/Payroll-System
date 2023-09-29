-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 11:00 AM
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
(1, 'Bimal', 'Paudel', 'company@example.com', '9843563423', '2023-08-16', 'Balaju', 'baneshwor', '16723525252525', 'NIC Asia', 'male', 'jsnmcsn12', 'single', 'documents/Khc9Wf8tPmOpLkQj1AH5wYlk6lS1sU0hsJw56tJS.pdf', 1, 'approved', '$2y$10$Ri9KS2YfgvNsOxqzyjg7oumPz0UxyBurW721i6EsNdJwmdChIy/Li', '2023-08-14 03:36:10', '2023-08-15 02:55:07', '2023-08-18', '2023-08-14', 70000.00, 'employee'),
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
(1, 2, 15.00, 'amount', '2023-08-15 02:55:07', '2023-08-15 02:55:07');

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
(1, '2023-9-3,2023-9-4', 'Public Holiday', '2023-09-27 02:19:05', '2023-09-27 02:19:05'),
(2, '2023-9-17,2023-9-19', 'Other', '2023-09-27 02:19:28', '2023-09-27 02:19:28'),
(3, '2023-9-21,2023-9-14', 'Public Holiday', '2023-09-27 03:17:20', '2023-09-27 03:17:20');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inboxes`
--

INSERT INTO `inboxes` (`id`, `senderId`, `receiverId`, `dateTime`, `message`, `created_at`, `updated_at`) VALUES
(1, '1', 'Admin', 'abcabc', 'esgr', '2023-09-29 00:36:17', '2023-09-29 00:36:17'),
(2, '1', '2', 'abcabc', 'bimal paudel', '2023-09-29 00:52:45', '2023-09-29 00:52:45'),
(3, '1', '2', 'September 29, 12:48 PM', 'adasd', '2023-09-29 07:03:05', '2023-09-29 07:03:05'),
(4, '1', '2', 'September 29, 12:56 PM', 'gehb', '2023-09-29 07:11:20', '2023-09-29 07:11:20'),
(5, '1', '2', 'September 29, 12:58 PM', 'sbcsjwbf', '2023-09-29 07:13:36', '2023-09-29 07:13:36'),
(6, '1', '2', 'September 29, 12:59 PM', 'afghn', '2023-09-29 07:14:53', '2023-09-29 07:14:53'),
(7, '1', '2', 'September 29, 1:02 PM', 'helo hello', '2023-09-29 07:17:25', '2023-09-29 07:17:25'),
(8, '1', '2', 'September 29, 1:05 PM', 'hkdkfkfddfk', '2023-09-29 07:20:08', '2023-09-29 07:20:08'),
(9, '1', '2', 'September 29, 1:05 PM', 'fjdjd', '2023-09-29 07:20:48', '2023-09-29 07:20:48'),
(10, '1', '2', 'September 29, 1:08 PM', 'jkdfkdkfj', '2023-09-29 07:23:27', '2023-09-29 07:23:27'),
(11, '1', '2', 'September 29, 1:09 PM', 'fhjdhjdjfhj', '2023-09-29 07:24:36', '2023-09-29 07:24:36'),
(12, '1', '2', 'September 29, 1:15 PM', 'kjdkfkdfk', '2023-09-29 07:30:58', '2023-09-29 07:30:58'),
(13, '1', '2', 'September 29, 1:17 PM', 'jkdjkfkj', '2023-09-29 07:32:09', '2023-09-29 07:32:09'),
(14, '1', '2', 'September 29, 1:21 PM', 'kjkdkfkdf', '2023-09-29 07:36:18', '2023-09-29 07:36:18'),
(15, '1', '2', 'September 29, 1:21 PM', 'jdkkddkdjk', '2023-09-29 07:36:30', '2023-09-29 07:36:30'),
(16, '1', '2', 'September 29, 1:23 PM', 'kfjkdjkfdj', '2023-09-29 07:38:38', '2023-09-29 07:38:38'),
(17, '1', '2', 'September 29, 1:25 PM', 'jshdjsdj', '2023-09-29 07:40:36', '2023-09-29 07:40:36'),
(18, '1', '2', 'September 29, 1:28 PM', 'jdhsjhdj', '2023-09-29 07:43:47', '2023-09-29 07:43:47'),
(19, '1', '2', 'September 29, 1:28 PM', 'hdhdjsjdsdj', '2023-09-29 07:43:55', '2023-09-29 07:43:55'),
(20, '1', '2', 'September 29, 1:29 PM', 'jdhjhdfhj', '2023-09-29 07:44:42', '2023-09-29 07:44:42'),
(21, '2', '1', 'September 29, 2:30 PM', 'kdjkfjkf', '2023-09-29 08:45:22', '2023-09-29 08:45:22'),
(22, '2', '1', 'September 29, 2:34 PM', 'hkdkdh', '2023-09-29 08:49:55', '2023-09-29 08:49:55');

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
(5, '2023_07_29_045740_create_holidays_table', 1),
(6, '2023_08_10_024438_create_employees_table', 1),
(7, '2023_08_10_024500_create_departments_table', 1),
(8, '2023_08_10_024511_create_leaves_table', 1),
(9, '2023_08_10_024524_create_allowances_table', 1),
(10, '2023_08_10_024537_create_deductions_table', 1),
(11, '2023_08_14_083022_add_date_of_joining_to_employees_table', 1),
(12, '2023_08_14_083121_create_salary_structures_table', 1),
(13, '2023_08_14_090517_create_employee_allowance_table', 1),
(14, '2023_08_14_090840_create_employee_deduction_table', 1),
(15, '2023_08_15_090957_create_salaries_table', 2),
(16, '2023_08_23_152052_create_attendances_table', 3),
(17, '2023_08_26_072739_create_salaries_table', 4),
(18, '2023_09_28_145843_create_taxes_table', 5),
(19, '2023_09_29_051720_create_inboxes_table', 6);

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
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `salary_structures`
--
ALTER TABLE `salary_structures`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_structures`
--
ALTER TABLE `salary_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_allowance`
--
ALTER TABLE `employee_allowance`
  ADD CONSTRAINT `employee_allowance_allowance_id_foreign` FOREIGN KEY (`allowance_id`) REFERENCES `allowances` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_allowance_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_deduction`
--
ALTER TABLE `employee_deduction`
  ADD CONSTRAINT `employee_deduction_deduction_id_foreign` FOREIGN KEY (`deduction_id`) REFERENCES `deductions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_deduction_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
