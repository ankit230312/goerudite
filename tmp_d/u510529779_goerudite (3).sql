-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2026 at 06:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u510529779_goerudite`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalogues`
--

CREATE TABLE `catalogues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_title` varchar(255) NOT NULL,
  `publisher_brand_name` varchar(255) DEFAULT NULL,
  `academic_session` varchar(50) NOT NULL,
  `applicable_board` varchar(100) NOT NULL,
  `medium` varchar(100) NOT NULL,
  `print_length` int(11) DEFAULT NULL,
  `published_on` date DEFAULT NULL,
  `isbn_13` varchar(255) DEFAULT NULL,
  `isbn_10` varchar(255) DEFAULT NULL,
  `reading_age` varchar(255) DEFAULT NULL,
  `dimensions` varchar(255) DEFAULT NULL,
  `volume_part_numbers` varchar(255) DEFAULT NULL,
  `mrp` decimal(10,2) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `cover_file` varchar(255) DEFAULT NULL,
  `sample_file` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catalogues`
--

INSERT INTO `catalogues` (`id`, `user_id`, `catalogue_title`, `publisher_brand_name`, `academic_session`, `applicable_board`, `medium`, `print_length`, `published_on`, `isbn_13`, `isbn_10`, `reading_age`, `dimensions`, `volume_part_numbers`, `mrp`, `category`, `cover_file`, `sample_file`, `description`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 3, 'In fugiat minus ull test', 'Genevieve Cortez', 'Duis mollit sint nat', 'CBSE', 'English', 89, '2020-04-04', 'Iusto dicta commodo', 'Aut autem earum eaqu', 'Suscipit temporibus', 'Eligendi in mollitia', '331', 31.00, 'Non-Fiction', 'catalogues/TFnUosg7aDpPOnPp4ARNINSpuNAr6IHGiionV5LI.jpg', 'catalogues/rdDbGyS6go9IVkmRR46n9ieP00rU7N3Jq1nk8ojq.jpg', 'Quam est esse quis m', 1, '2026-02-16 11:34:32', '2026-02-16 13:16:33'),
(2, 3, 'Culpa in dolor cupi', 'Damian Burns', 'Molestiae odio quae', 'State Board', 'English', 37, '2017-10-18', 'Error aut rerum face', 'Molestias esse ex es', 'Itaque natus odit au', 'Maxime quis ipsa re', '196', 99.00, 'Reference', NULL, NULL, 'Laboris dolorem ea v', 1, '2026-02-16 11:38:45', '2026-02-16 11:38:45');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_13_174319_create_classes_table', 2),
(5, '2026_01_24_074226_create_rfqs_table', 3),
(6, '2026_01_28_183018_create_purchase_records_table', 4),
(7, '2026_02_19_000001_add_targeting_fields_to_rfqs_table', 5),
(8, '2026_02_21_000002_create_rfq_receipts_table', 6);

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
-- Table structure for table `purchase_records`
--

CREATE TABLE `purchase_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `record_name` varchar(255) NOT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `gst_details` varchar(255) DEFAULT NULL,
  `delivery_status` enum('delivered','pending','cancelled') NOT NULL,
  `payment_status` enum('paid','pending','partial') NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `invoice_file` varchar(255) DEFAULT NULL,
  `return_file` varchar(255) DEFAULT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_records`
--

INSERT INTO `purchase_records` (`id`, `user_id`, `record_name`, `invoice_no`, `purchase_date`, `item_name`, `gst_details`, `delivery_status`, `payment_status`, `supplier`, `quantity`, `amount`, `invoice_file`, `return_file`, `document_name`, `created_at`, `updated_at`) VALUES
(2, 1, 'test record up', 'Quo et et commodo ad up', '2019-10-20', 'Xandra Bass up', 'Fugiat a itaque quis up', 'cancelled', 'paid', 'Tempora molestiae no up', 201, 5001.00, 'purchase_records/e54SaJ8OKjBII5MRrLgefRAONmV0VBHNvwFEvJ2T.pdf', 'purchase_records/4yaKLVlR8qMRFyTUtJRNQuym9f6BoEBSHARxTmIy.png', 'purchase_records/qiK888eRHGOGvYNcC1ZlfvUBH4jpQRcRLoSke9yz.pdf', '2026-01-28 13:15:57', '2026-01-28 13:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `rfqs`
--

CREATE TABLE `rfqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `target_roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`target_roles`)),
  `target_state` varchar(255) DEFAULT NULL,
  `target_city` varchar(255) DEFAULT NULL,
  `academic_session` varchar(255) NOT NULL,
  `books` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`books`)),
  `delivery_from` date NOT NULL,
  `delivery_to` date NOT NULL,
  `urgency` varchar(255) NOT NULL,
  `evaluation_criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`evaluation_criteria`)),
  `rfq_closing_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','closed') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rfqs`
--

INSERT INTO `rfqs` (`id`, `user_id`, `school_name`, `city`, `target_roles`, `target_state`, `target_city`, `academic_session`, `books`, `delivery_from`, `delivery_to`, `urgency`, `evaluation_criteria`, `rfq_closing_date`, `notes`, `confirmed`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Leroy Adams', 'Sit nobis libero ten', NULL, NULL, NULL, '2024-25', '\"[{\\\"class_name\\\":\\\"Erica Walsh\\\",\\\"subject\\\":\\\"Expedita modi eu eni\\\",\\\"book_title\\\":\\\"Repellendus Non cup\\\",\\\"publisher\\\":\\\"Oxford\\\",\\\"edition\\\":\\\"Sunt optio sit vo\\\",\\\"quantity\\\":\\\"290\\\"}]\"', '2004-09-25', '1981-04-15', 'Time-sensitive', '\"[\\\"price\\\",\\\"delivery\\\",\\\"relationship\\\"]\"', '1987-08-02', 'Alias deleniti inven', 1, 'closed', '2026-01-27 12:02:13', '2026-01-27 12:32:30'),
(2, 1, 'Leroy Adams', 'Irure minim cumque i', '[\"distributor\"]', NULL, NULL, '2025-26', '\"[{\\\"class_name\\\":\\\"Thane Drake\\\",\\\"subject\\\":\\\"Reprehenderit enim d\\\",\\\"book_title\\\":\\\"Temporibus et volupt\\\",\\\"publisher\\\":\\\"Oxford\\\",\\\"edition\\\":\\\"Quis et ex voluptas \\\",\\\"quantity\\\":\\\"873\\\"}]\"', '1970-03-20', '1984-11-12', 'Time-sensitive', '\"[\\\"relationship\\\"]\"', '1989-11-12', 'Sed eiusmod facilis', 1, 'active', '2026-01-27 12:07:35', '2026-02-19 13:37:16'),
(3, 2, 'Yardley Gaines', 'tewst', NULL, NULL, NULL, '2024-25', '\"[{\\\"class_name\\\":\\\"Erica Walsh\\\",\\\"subject\\\":\\\"Expedita modi eu eni\\\",\\\"book_title\\\":\\\"Repellendus Non cup\\\",\\\"publisher\\\":\\\"NCERT\\\",\\\"edition\\\":\\\"Sunt optio sit vo\\\",\\\"quantity\\\":\\\"10\\\"}]\"', '2026-02-19', '2026-02-27', 'Normal', '\"[\\\"publisher\\\"]\"', '2026-02-20', 'rgdfg', 1, 'closed', '2026-02-19 12:49:50', '2026-02-19 12:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `rfq_receipts`
--

CREATE TABLE `rfq_receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `received_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rfq_receipts`
--

INSERT INTO `rfq_receipts` (`id`, `rfq_id`, `user_id`, `received_at`, `created_at`, `updated_at`) VALUES
(2, 2, 2, '2026-02-26 12:55:08', '2026-02-26 12:55:08', '2026-02-26 12:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `school_classes`
--

CREATE TABLE `school_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `academic_session` varchar(255) NOT NULL,
  `board` varchar(255) NOT NULL,
  `medium` varchar(255) NOT NULL,
  `sections` int(11) NOT NULL,
  `total_students` int(11) NOT NULL,
  `boys` int(11) DEFAULT NULL,
  `girls` int(11) DEFAULT NULL,
  `expected_admissions` int(11) DEFAULT NULL,
  `subjects` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `syllabus` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_classes`
--

INSERT INTO `school_classes` (`id`, `class_name`, `academic_session`, `board`, `medium`, `sections`, `total_students`, `boys`, `girls`, `expected_admissions`, `subjects`, `publisher`, `syllabus`, `created_at`, `updated_at`) VALUES
(2, 'Rose Mcguire', '2025-26', 'Other', 'Regional', 49, 93, 11, 73, 34, 'Ipsum quis voluptate', 'Voluptatem qui alia', 'Possimus dolores in', '2026-01-14 12:11:21', '2026-01-14 12:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KRyIrhkNIaGus4mQpEbmMtIRzwk4tVQQwPrP1nCD', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR0Jsa0hlRU8yVDRudEhOZGIzVlB2eFNBRVBIYXZMa3oxS1I1UWZPdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaXN0cmlidXRvci9tYW5hZ2UtcmVjb3JkcyI7czo1OiJyb3V0ZSI7czoyNjoiZGlzdHJpYnV0b3IubWFuYWdlX3JlY29yZHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1772130751);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `business_category` varchar(100) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `school_type` varchar(200) DEFAULT NULL,
  `publisher_type` varchar(100) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `pan` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `total_students` varchar(80) DEFAULT NULL,
  `website_link` varchar(200) DEFAULT NULL,
  `established` varchar(100) DEFAULT NULL,
  `board` varchar(100) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `business_category`, `business_name`, `school_type`, `publisher_type`, `contact_person`, `mobile`, `address`, `gst`, `pan`, `city`, `state`, `pincode`, `document`, `remember_token`, `total_students`, `website_link`, `established`, `board`, `about`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, 'qerebu@mailinator.com', NULL, '$2y$12$jgk9bJINpCShDb.1qRcTEeSc74s7dC9b1y.zk/v4ZSAVocismJf1C', NULL, 'Leroy Adams', 'rte', NULL, NULL, 'Minus sed voluptatib', 'Rerum modi quidem ab', 'Pariatur Praesentiu', 'Nemo magnam dolorum', 'Vadodara', 'Gujarat', 'Excepteur et nobis c', NULL, NULL, '60', 'web link', 'est', 'tewst', 'about 123', 'profiles/lXx84T0wWJoHf7MHCgBV3wogMZnVqgrNjCtx4bHr.png', '2026-01-04 10:54:32', '2026-02-21 09:13:07'),
(2, 'distributor', NULL, 'cemehef@mailinator.com', NULL, '$2y$12$jk0//WvpsHL4clbGwrJeIOjux728OO.G61V8oA3fdK0FZ8RmwxKvK', NULL, 'Yardley Gaines', NULL, NULL, 'Placeat ea aut debi', 'In consequatur Labo', 'Temporibus et illo c', 'Dolores neque sunt', 'Eu ipsa esse quisqu', 'Dolore enim optio a', 'Karnataka', 'Et distinctio Maior', 'documents/n19v1tqazQvmDirwLaNOJkr8T7fSWz1TxkvLIYI1.png', NULL, NULL, NULL, NULL, NULL, 'testing 123', NULL, '2026-01-04 10:55:08', '2026-02-19 12:43:26'),
(3, 'distributor', NULL, 'sipimyvy@mailinator.com', NULL, '$2y$12$xV1WDBQGpvURYx/.j5b/Eu15w/zt54vt6FqbBZ0Rwoj2QHSktWT4e', NULL, 'Dylan Mcintyre', NULL, NULL, 'Id ipsum amet sit e', 'Voluptate qui culpa', 'Aliquip nisi ad vero', 'In quasi accusamus m', 'Nostrum voluptatem a', 'Rohini', 'Delhi', 'Est ea hic quia quod', 'documents/QyK9aw2FAbr8T5qkjhrEauYuK4V83Pe1l2ISbnxm.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-15 12:59:00', '2026-02-21 09:16:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogues_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
-- Indexes for table `purchase_records`
--
ALTER TABLE `purchase_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `rfqs`
--
ALTER TABLE `rfqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rfqs_user_id_foreign` (`user_id`);

--
-- Indexes for table `rfq_receipts`
--
ALTER TABLE `rfq_receipts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfq_receipts_rfq_id_user_id_unique` (`rfq_id`,`user_id`),
  ADD KEY `rfq_receipts_user_id_foreign` (`user_id`);

--
-- Indexes for table `school_classes`
--
ALTER TABLE `school_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `catalogues`
--
ALTER TABLE `catalogues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_records`
--
ALTER TABLE `purchase_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rfqs`
--
ALTER TABLE `rfqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rfq_receipts`
--
ALTER TABLE `rfq_receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_classes`
--
ALTER TABLE `school_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD CONSTRAINT `catalogues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_records`
--
ALTER TABLE `purchase_records`
  ADD CONSTRAINT `purchase_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rfqs`
--
ALTER TABLE `rfqs`
  ADD CONSTRAINT `rfqs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rfq_receipts`
--
ALTER TABLE `rfq_receipts`
  ADD CONSTRAINT `rfq_receipts_rfq_id_foreign` FOREIGN KEY (`rfq_id`) REFERENCES `rfqs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rfq_receipts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
