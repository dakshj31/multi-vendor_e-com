-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2025 at 05:34 PM
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
-- Database: `multi_vendor_e_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `role`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Daksh Joshi', 'admin', '8178745897', 'daksh@gmail.com', '$2y$12$fUujQXjECMVvMLFkATUJzOCskow1OYQPXhPUgoHByrIIRQWJsZp62', NULL, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 'Tony', 'subadmin', '817878952', 'tony@gmail.com', '$2y$12$fUujQXjECMVvMLFkATUJzOCskow1OYQPXhPUgoHByrIIRQWJsZp62', NULL, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, 'Steve', 'subadmin', '8178965723', 'steve@gmail.com', '$2y$12$fUujQXjECMVvMLFkATUJzOCskow1OYQPXhPUgoHByrIIRQWJsZp62', NULL, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `admins_roles`
--

CREATE TABLE `admins_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subadmin_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `view_access` tinyint(4) NOT NULL,
  `edit_access` tinyint(4) NOT NULL,
  `full_access` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `link`, `title`, `alt`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'carousel-1.jpg', 'Slider', '', 'Products on Sale', 'Products on Sale', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 'carousel-2.jpg', 'Slider', '', 'Flat 50% Off', 'Flat 50% Off', 2, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, 'carousel-3.jpg', 'Slider', '', 'Summer Sale', 'Summer Sale', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `menu_status` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `logo`, `discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `menu_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arrow', '', '', 0, '', 'arrow', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 'Gap', '', '', 0, '', 'gap', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, 'Lee', '', '', 0, '', 'lee', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(4, 'Monte Carlo', '', '', 0, '', 'monte-carlo', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(5, 'Peter England', '', '', 0, '', 'peter-england', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `size_chart` varchar(255) DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `menu_status` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `image`, `size_chart`, `discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `menu_status`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Clothing', '', '', 0, '', 'clothing', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, NULL, 'Electronics', '', '', 0, '', 'electronics', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, NULL, 'Appliances', '', '', 0, '', 'appliances', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(4, 1, 'Men', '', '', 0, '', 'men', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(5, 1, 'Women', '', '', 0, '', 'women', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(6, 1, 'Kids', '', '', 0, '', 'kids', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(7, 4, 'Men T-Shirts', '', '', 0, '', 'men-t-shirt', '', '', '', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `category_filter`
--

CREATE TABLE `category_filter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Black', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 'Blue', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, 'Brown', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(4, 'Green', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(5, 'Grey', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(6, 'Multi', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(7, 'Olive', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(8, 'Orange', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(9, 'Pink', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(10, 'Purple', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(11, 'Red', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(12, 'White', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(13, 'Yellow', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `column_preferences`
--

CREATE TABLE `column_preferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `column_order` text DEFAULT NULL,
  `hidden_columns` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_name` varchar(255) NOT NULL,
  `filter_column` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filters`
--

INSERT INTO `filters` (`id`, `filter_name`, `filter_column`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fabric', 'fabric', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 'Sleeve', 'sleeve', 2, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `filter_values`
--

CREATE TABLE `filter_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filter_values`
--

INSERT INTO `filter_values` (`id`, `filter_id`, `value`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cotton', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 1, 'Polyester', 2, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(3, 2, 'Full Sleeve', 1, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(4, 2, 'Half Sleeve', 2, 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14');

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
(4, '2025_08_01_164910_create_admin_table', 1),
(5, '2025_08_11_172633_create_admins_roles_table', 1),
(6, '2025_08_12_161823_create_categories_table', 1),
(7, '2025_08_19_130256_create_products_table', 1),
(8, '2025_08_24_170642_create_colors_table', 1),
(9, '2025_08_27_125601_create_product_images_table', 1),
(10, '2025_08_28_122352_create_products_attributes_table', 1),
(11, '2025_09_05_170930_create_column_preferences_table', 1),
(12, '2025_09_08_185234_create_brands_table', 1),
(13, '2025_09_20_170417_create_banners_table', 1),
(14, '2025_10_09_162241_create_filters_table', 1),
(15, '2025_10_09_163824_create_filter_values_table', 1),
(16, '2025_10_09_164319_create_product_filter_values_table', 1),
(17, '2025_10_12_171003_create_category_filter_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_role` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `family_color` varchar(255) NOT NULL,
  `group_code` varchar(255) DEFAULT NULL,
  `product_price` double NOT NULL,
  `product_discount` double NOT NULL,
  `product_discount_amount` double NOT NULL,
  `discount_applied_on` varchar(255) NOT NULL,
  `product_gst` double NOT NULL DEFAULT 0,
  `final_price` double NOT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `product_weight` double NOT NULL DEFAULT 0,
  `product_video` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `wash_care` text DEFAULT NULL,
  `search_keywords` text DEFAULT NULL,
  `fabric` varchar(255) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `sleeve` varchar(255) DEFAULT NULL,
  `fit` varchar(255) DEFAULT NULL,
  `occasion` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_featured` enum('No','Yes') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `admin_id`, `admin_role`, `product_name`, `product_code`, `product_color`, `family_color`, `group_code`, `product_price`, `product_discount`, `product_discount_amount`, `discount_applied_on`, `product_gst`, `final_price`, `main_image`, `product_weight`, `product_video`, `description`, `wash_care`, `search_keywords`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `stock`, `sort`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 1, 'admin', 'Blue T-shirt', 'BTS001', 'Dark Blue', 'Blue', 'b001', 1000, 10, 100, 'product', 12, 900, '', 500, '', 'Test Product', '', '', '', '', '', '', '', 10, 1, '', '', '', 'No', 1, '2025-10-12 12:11:14', '2025-10-12 12:11:14'),
(2, 7, 1, 1, 'admin', 'Red T-shirt', 'RTS001', 'Red', 'Red', 'r001', 2000, 10, 200, 'product', 12, 1800, NULL, 500, '', 'Test Product', '', '', '', '', '', '', '', 0, 2, '', '', '', 'Yes', 1, '2025-10-12 12:11:14', '2025-10-16 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `sku`, `price`, `stock`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Small', 'BTS001-S', 1500.00, 10, 1, 1, NULL, NULL),
(2, 1, 'Medium', 'BTS001-M', 1600.00, 20, 2, 1, NULL, NULL),
(3, 1, 'Large', 'BTS001-L', 1700.00, 10, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_filter_values`
--

CREATE TABLE `product_filter_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `filter_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('hmztCIBWtbjbibA3BvMqueBN2BkVuVf6N961s41J', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia1RGeWF6Rnh3eWNCamloUmFhQ0hvOTBWdFd1ejk3bFdRQ1dmQXJEZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9maWx0ZXJzLzIvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6InBhZ2UiO3M6OToiZGFzaGJvYXJkIjt9', 1760724510);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-10-12 12:11:13', '$2y$12$.u2TcWP8nKNlcMjSnGVlLO8plnODHCUrQnq4R4vG7j8NsHzH7iJMy', 'b3egodTglW', '2025-10-12 12:11:13', '2025-10-12 12:11:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admins_roles`
--
ALTER TABLE `admins_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_url_unique` (`url`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_url_unique` (`url`);

--
-- Indexes for table `category_filter`
--
ALTER TABLE `category_filter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_filter_category_id_foreign` (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `column_preferences`
--
ALTER TABLE `column_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter_values`
--
ALTER TABLE `filter_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filter_values_filter_id_foreign` (`filter_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_attributes_sku_unique` (`sku`),
  ADD KEY `products_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_filter_values`
--
ALTER TABLE `product_filter_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_filter_values_product_id_foreign` (`product_id`),
  ADD KEY `product_filter_values_filter_value_id_foreign` (`filter_value_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins_roles`
--
ALTER TABLE `admins_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_filter`
--
ALTER TABLE `category_filter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `column_preferences`
--
ALTER TABLE `column_preferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filter_values`
--
ALTER TABLE `filter_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_filter_values`
--
ALTER TABLE `product_filter_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_filter`
--
ALTER TABLE `category_filter`
  ADD CONSTRAINT `category_filter_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `filter_values`
--
ALTER TABLE `filter_values`
  ADD CONSTRAINT `filter_values_filter_id_foreign` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD CONSTRAINT `products_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_filter_values`
--
ALTER TABLE `product_filter_values`
  ADD CONSTRAINT `product_filter_values_filter_value_id_foreign` FOREIGN KEY (`filter_value_id`) REFERENCES `filter_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_filter_values_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
