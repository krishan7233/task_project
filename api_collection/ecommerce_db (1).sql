-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 01:08 PM
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
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'aut', 'Cupiditate illum ab culpa dolorem minus quisquam iste aut.', 1, '2025-04-26 05:24:05', '2025-04-26 05:24:05', NULL),
(2, 'quia', 'Sint magni in nihil.', 1, '2025-04-26 05:24:05', '2025-04-26 05:24:05', NULL),
(3, 'vero', 'Ducimus quo sunt facere rerum est.', 1, '2025-04-26 05:24:05', '2025-04-26 05:24:05', NULL),
(4, 'consequatur', 'Quo dolore neque velit ducimus modi ea exercitationem eligendi.', 1, '2025-04-26 05:24:05', '2025-04-26 05:24:05', NULL),
(5, 'quia', 'Accusamus molestias ipsam id molestiae.', 1, '2025-04-26 05:24:05', '2025-04-26 05:24:05', NULL),
(6, 'sallon', 'all toys here listed for you', 1, '2025-04-26 05:28:58', '2025-04-26 05:30:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 5, 1, NULL, NULL),
(3, 4, 2, NULL, NULL),
(4, 5, 2, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 4, 3, NULL, NULL),
(7, 2, 4, NULL, NULL),
(8, 4, 4, NULL, NULL),
(9, 1, 5, NULL, NULL),
(10, 3, 5, NULL, NULL),
(11, 4, 6, NULL, NULL),
(12, 5, 6, NULL, NULL),
(13, 3, 7, NULL, NULL),
(14, 4, 7, NULL, NULL),
(15, 2, 8, NULL, NULL),
(16, 4, 8, NULL, NULL),
(17, 1, 9, NULL, NULL),
(18, 4, 9, NULL, NULL),
(19, 2, 10, NULL, NULL),
(20, 5, 10, NULL, NULL),
(21, 2, 11, NULL, NULL),
(22, 3, 11, NULL, NULL),
(23, 3, 12, NULL, NULL),
(24, 5, 12, NULL, NULL),
(25, 2, 13, NULL, NULL),
(26, 3, 13, NULL, NULL),
(27, 1, 14, NULL, NULL),
(28, 2, 14, NULL, NULL),
(29, 2, 15, NULL, NULL),
(30, 3, 15, NULL, NULL),
(31, 3, 16, NULL, NULL),
(32, 5, 16, NULL, NULL),
(33, 1, 17, NULL, NULL),
(34, 2, 17, NULL, NULL),
(35, 1, 18, NULL, NULL),
(36, 2, 18, NULL, NULL),
(37, 1, 19, NULL, NULL),
(38, 2, 19, NULL, NULL),
(39, 1, 20, NULL, NULL),
(40, 2, 20, NULL, NULL),
(41, 1, 21, NULL, NULL);

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
(122, '2014_10_12_000000_create_users_table', 1),
(123, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(124, '2019_08_19_000000_create_failed_jobs_table', 1),
(125, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(126, '2025_04_24_140349_add_fields_to_users_table', 1),
(127, '2025_04_24_163228_create_categories_table', 1),
(128, '2025_04_24_170012_add_soft_deletes_to_categories_table', 1),
(129, '2025_04_24_172306_create_products_table', 1),
(130, '2025_04_24_172428_create_category_product_table', 1),
(131, '2025_04_24_172633_create_product_images_table', 1),
(132, '2025_04_24_185507_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `orderNo` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `orderNo`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'ORD-7Yldlw35', 120.36, 'completed', '2025-04-26 05:37:11', '2025-04-26 05:37:42');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'api-token', 'e4ce20870c663c85497c56a9ee9617325b0d9b143d6a763c0164d985517e77da', '[\"*\"]', '2025-04-26 05:37:42', NULL, '2025-04-26 05:27:34', '2025-04-26 05:37:42'),
(2, 'App\\Models\\User', 12, 'api-token', '84e8770d6fe8cc99ffbb0ab323830e6d553e0f19eabb68994d25939048f83700', '[\"*\"]', NULL, NULL, '2025-04-26 05:33:41', '2025-04-26 05:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price`, `status`, `stock_quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'facere', 'aliquid', 'Culpa laudantium nostrum ut est et nihil rerum iure.', 86.62, 0, 4, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(2, 'voluptate', 'inventore', 'Molestiae est mollitia sed voluptas iste exercitationem.', 162.63, 1, 4, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(3, 'et', 'soluta', 'Labore rerum ipsam aut temporibus itaque perferendis vel repellat.', 431.65, 1, 9, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(4, 'nesciunt', 'dolorem', 'Exercitationem asperiores eum laudantium magnam fugiat.', 120.36, 1, 3, NULL, '2025-04-26 05:24:05', '2025-04-26 05:37:11'),
(5, 'earum', 'non', 'Esse velit quaerat quia voluptatem nihil saepe est.', 435.71, 0, 2, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(6, 'id', 'ut', 'Consequuntur modi sed tenetur quidem amet possimus.', 208.00, 0, 6, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(7, 'qui', 'qui', 'Quaerat dolor est aut quia vel dolorum voluptas.', 332.74, 0, 9, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(8, 'asperiores', 'atque', 'Asperiores rerum earum fugit fugit sequi quo.', 125.73, 0, 7, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(9, 'quia', 'sapiente', 'Quia fugit non consequuntur aut nostrum ipsam.', 422.02, 0, 6, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(10, 'et', 'nemo', 'Cumque voluptas atque repellendus quo.', 428.78, 1, 8, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(11, 'quis', 'distinctio', 'Optio molestiae dolor error eligendi voluptate aut nemo.', 78.16, 0, 6, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(12, 'illum', 'aut', 'Et saepe ipsum excepturi.', 305.83, 1, 8, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(13, 'exercitationem', 'sint', 'Mollitia perferendis adipisci quaerat totam.', 475.12, 0, 2, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(14, 'in', 'quia', 'Doloremque reprehenderit officia tempore culpa.', 193.42, 1, 7, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(15, 'aut', 'molestiae', 'Animi veniam maxime sint quo omnis.', 81.11, 0, 6, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(16, 'deleniti', 'facilis', 'Optio dolorem aut occaecati adipisci omnis.', 463.25, 1, 7, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(17, 'odit', 'nisi', 'Nostrum hic reprehenderit aperiam laboriosam voluptatum quisquam.', 76.30, 0, 6, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(18, 'quis', 'iusto', 'Minus quia ut totam reprehenderit.', 298.67, 1, 3, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(19, 'ducimus', 'rerum', 'Iure ducimus qui accusamus quod aut possimus.', 173.61, 0, 4, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(20, 'expedita', 'et', 'Impedit velit quisquam molestias deleniti ratione quis.', 377.71, 1, 9, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(21, 'dummy Product', 'dummy-product', 'This is a great product.', 99.99, 1, 10, NULL, '2025-04-26 05:35:25', '2025-04-26 05:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 21, 'product_images/TMsSBse079f8keITwBwBgJqV3FH0BCiHtR8eJeE3.jpg', '2025-04-26 05:35:25', '2025-04-26 05:35:25'),
(2, 21, 'product_images/BGzspihjImzvd3NljZnTlKu3XgVRLu6d1GodGuWg.jpg', '2025-04-26 05:35:25', '2025-04-26 05:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=User',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `usertype`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$12$lzHayEcVLhLvgt9FFuAhMuUk7IFf4IfE.2Z74iUoFhPrQM0u623wC', 1, 1, NULL, '2025-04-26 05:24:01', '2025-04-26 05:24:01'),
(2, 'Ned Bogan', 'giovanna44@example.net', '(341) 487-6246', NULL, '$2y$12$aqkgU/Gdu3MRuDzgpeCZsObpQq7BId3whoBBvm87Npo7T00JGIU7S', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(3, 'Caleigh Bode', 'kendra.russel@example.net', '760.278.3177', NULL, '$2y$12$Ifmp6MWaR/VfpW4DziXoY.pQzZTEe9WCu9VG47f98LaRsK1taa1Xm', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(4, 'Kobe Hermiston', 'stroman.sarai@example.org', '225.880.7313', NULL, '$2y$12$otkm5pEwTjSoWEnyg9c9A.6/YA39EkC0E1mgI/vszwQLAM1Mjzy0y', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(5, 'Prof. Jack Grimes DVM', 'xsipes@example.com', '949.243.9265', NULL, '$2y$12$3wIQtiJeY3r3EcrgYYZ3WO8GX02Pc.MTXHiNxnaJMc0IeyRcL9.iG', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(6, 'Dell Graham MD', 'johnson.damon@example.org', '234-863-9750', NULL, '$2y$12$Yo8l/gaTH/P1sC/C3zcnre7Mna76FY8Io6QFDO/S0OShuWu.x79ZW', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(7, 'Mariano Quigley', 'damien53@example.org', '1-251-673-2192', NULL, '$2y$12$Z7r9EebOCEiW9uCW8Hv5VuCGAzl6E/tGRE5G5rR7U882AJt0U.8y2', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(8, 'Luigi Bode', 'white.xzavier@example.com', '(531) 743-1601', NULL, '$2y$12$GmWtz1xsr0rI/TcbLTlusOvDPxDqv5/vQ3yIKqMtgj91z.1r7sXES', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(9, 'Haylee Hessel MD', 'annette.emard@example.com', '(606) 965-2782', NULL, '$2y$12$vcMdNFGVg9nABdlxcFmf1.IWCfkLZMacdJEiHNCutbmPx91INeTRy', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(10, 'Alvah Dietrich DDS', 'wilderman.vince@example.net', '+1.681.992.3132', NULL, '$2y$12$iPugDIAuCJ/3Fza1ygqGJ.rRBXfIj./dFRElmeqnd.qSS4qmUBkga', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(11, 'Freeman Feest', 'chelsie86@example.org', '605.900.2659', NULL, '$2y$12$ExEeEpMX0oS1elJHhHQjQOIurh27P3DJdohxscpPiD2TK6cfYsozO', 2, 1, NULL, '2025-04-26 05:24:05', '2025-04-26 05:24:05'),
(12, 'John Doe1', 'user@gmail.com', '9876543210', NULL, '$2y$12$rUVQ4b6Mm6M53xh47HpwE.eHJW7g1AdZcRCSPce9ZWUJyZKyZOQTO', 2, 1, NULL, '2025-04-26 05:33:41', '2025-04-26 05:34:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`),
  ADD KEY `category_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_orderno_unique` (`orderNo`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
