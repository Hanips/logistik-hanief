-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_logistik_hanief
CREATE DATABASE IF NOT EXISTS `db_logistik_hanief` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_logistik_hanief`;

-- Dumping structure for table db_logistik_hanief.barang_keluar
CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.barang_keluar: ~2 rows (approximately)
/*!40000 ALTER TABLE `barang_keluar` DISABLE KEYS */;
INSERT INTO `barang_keluar` (`id`, `kode_barang`, `quantity`, `destination`, `tanggal_keluar`, `created_at`, `updated_at`) VALUES
	(3, '11RR', 230, 'Kantor DPR', '2024-12-20', '2024-12-20 08:14:57', '2024-12-20 08:14:57'),
	(4, 'QW12', 1000, 'PT Chicken', '2024-12-19', '2024-12-20 08:15:41', '2024-12-20 08:15:41'),
	(5, 'ER34', 230, 'PT Chicken', '2024-12-18', '2024-12-20 08:16:52', '2024-12-20 08:16:52'),
	(6, 'QW12', 800, 'PT Indofood', '2024-12-21', '2024-12-20 13:20:02', '2024-12-20 13:20:02'),
	(7, 'WE23', 150, 'PT Avows', '2024-12-20', '2024-12-20 13:20:48', '2024-12-20 13:20:48'),
	(8, '33ED', 250, 'PT Tanjung Duren', '2024-12-19', '2024-12-20 13:21:52', '2024-12-20 13:21:52'),
	(9, '33ED', 60, 'PT Duren Sawit', '2024-12-16', '2024-12-20 13:22:58', '2024-12-20 13:22:58');
/*!40000 ALTER TABLE `barang_keluar` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.barang_masuk
CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.barang_masuk: ~28 rows (approximately)
/*!40000 ALTER TABLE `barang_masuk` DISABLE KEYS */;
INSERT INTO `barang_masuk` (`id`, `kode_barang`, `quantity`, `origin`, `tanggal_masuk`, `created_at`, `updated_at`) VALUES
	(1, '12FG', 2, 'PT Indofood', '2024-12-19', '2024-12-19 09:18:42', '2024-12-19 09:18:42'),
	(2, '11RR', 2000, 'PT Astra', '2024-12-20', '2024-12-19 22:08:38', '2024-12-19 22:08:38'),
	(3, '65TH', 3, 'PT Wahana', '2024-12-20', '2024-12-19 22:09:33', '2024-12-19 22:09:33'),
	(6, '33ED', 370, 'PT Yosan', '2024-12-19', '2024-12-20 05:26:11', '2024-12-20 05:26:11'),
	(7, 'QW12', 2300, 'PT Wahana', '2024-12-14', '2024-12-20 05:27:16', '2024-12-20 05:27:16'),
	(8, 'WE23', 230, 'PT Wahana', '2024-12-15', '2024-12-20 05:27:57', '2024-12-20 05:27:57'),
	(9, 'ER34', 890, 'PT Dufan', '2024-12-15', '2024-12-20 05:28:33', '2024-12-20 05:28:33'),
	(10, 'RT45', 120, 'PT Astra', '2024-12-16', '2024-12-20 05:29:03', '2024-12-20 05:29:03'),
	(11, 'TY56', 530, 'PT Yosan', '2024-12-17', '2024-12-20 05:29:27', '2024-12-20 05:29:27'),
	(12, 'UI22', 600, 'PT Wahana', '2024-12-14', '2024-12-20 05:31:33', '2024-12-20 05:31:33'),
	(13, '41YU', 1300, 'PT Indofood', '2024-12-21', '2024-12-20 10:19:19', '2024-12-20 10:19:19'),
	(28, '11RR', 21, 'PT Astra', '2024-12-20', '2024-12-20 13:05:17', '2024-12-20 13:05:17'),
	(29, '65TH', 3, 'PT Wahana', '2024-12-20', '2024-12-20 13:05:17', '2024-12-20 13:05:17'),
	(30, '12FG', 1, 'PT Indofood', '2024-12-19', '2024-12-20 13:05:17', '2024-12-20 13:05:17'),
	(31, '11RR', 21, 'PT Astra', '2024-12-20', '2024-12-20 13:09:26', '2024-12-20 13:09:26'),
	(32, '65TH', 3, 'PT Wahana', '2024-12-20', '2024-12-20 13:09:26', '2024-12-20 13:09:26'),
	(33, '12FG', 1, 'PT Indofood', '2024-12-19', '2024-12-20 13:09:26', '2024-12-20 13:09:26');
/*!40000 ALTER TABLE `barang_masuk` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.cache: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.cache_locks: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.job_batches: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.migrations: ~7 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_12_19_062143_create_barang_masuk_table', 1),
	(5, '2024_12_19_062216_create_barang_keluar_table', 1),
	(6, '2024_12_19_062221_create_stok_barang_table', 1),
	(7, '2024_12_19_085431_create_notification_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notification_content` text COLLATE utf8mb4_unicode_ci,
  `notification_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.notifications: ~22 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` (`id`, `notification_content`, `notification_status`, `created_at`, `updated_at`) VALUES
	(1, 'Hanips membuat data barang masuk dengan kode 11RR', 1, '2024-12-19 22:08:38', '2024-12-20 10:09:24'),
	(2, 'Hanips membuat data barang masuk dengan kode 65TH', 1, '2024-12-19 22:09:33', '2024-12-20 10:09:24'),
	(3, 'Hanips membuat data barang masuk dengan kode 65TH', 1, '2024-12-19 22:16:33', '2024-12-20 10:09:24'),
	(4, 'Hanips menghapus data barang masuk dengan kode 65TH', 1, '2024-12-19 22:16:45', '2024-12-20 10:09:24'),
	(5, 'Hanips membuat data barang masuk dengan kode 41YU', 1, '2024-12-19 22:18:46', '2024-12-20 10:09:24'),
	(6, 'Hanips membuat data barang masuk dengan kode 33ED', 1, '2024-12-20 05:26:11', '2024-12-20 10:09:24'),
	(7, 'Hanips membuat data barang masuk dengan kode QW12', 1, '2024-12-20 05:27:16', '2024-12-20 10:09:24'),
	(8, 'Hanips membuat data barang masuk dengan kode WE23', 1, '2024-12-20 05:27:57', '2024-12-20 10:09:24'),
	(9, 'Hanips membuat data barang masuk dengan kode ER34', 1, '2024-12-20 05:28:33', '2024-12-20 10:09:24'),
	(10, 'Hanips membuat data barang masuk dengan kode RT45', 1, '2024-12-20 05:29:03', '2024-12-20 10:09:24'),
	(11, 'Hanips membuat data barang masuk dengan kode TY56', 1, '2024-12-20 05:29:27', '2024-12-20 10:09:24'),
	(12, 'Hanips membuat data barang masuk dengan kode UI22', 1, '2024-12-20 05:31:33', '2024-12-20 10:09:24'),
	(13, 'Manager 1 export data barang masuk pada periode  - ', 1, '2024-12-20 07:38:09', '2024-12-20 10:09:24'),
	(14, 'Manager 1 export data barang masuk pada periode 2024-12-12 - 2024-12-14', 1, '2024-12-20 07:39:46', '2024-12-20 10:09:24'),
	(15, 'Manager 1 menghapus data barang masuk dengan kode 41YU', 1, '2024-12-20 07:54:50', '2024-12-20 10:09:24'),
	(16, 'Manager 1 membuat data barang keluar dengan kode 11RR', 1, '2024-12-20 08:13:58', '2024-12-20 10:09:24'),
	(17, 'Manager 1 menghapus data barang keluar dengan kode 11RR', 1, '2024-12-20 08:14:16', '2024-12-20 10:09:24'),
	(18, 'Manager 1 membuat data barang keluar dengan kode 11RR', 1, '2024-12-20 08:14:57', '2024-12-20 10:09:24'),
	(19, 'Manager 1 membuat data barang keluar dengan kode QW12', 1, '2024-12-20 08:15:41', '2024-12-20 10:09:24'),
	(20, 'Manager 1 membuat data barang keluar dengan kode ER34', 1, '2024-12-20 08:16:52', '2024-12-20 10:09:24'),
	(21, 'Manager 1 export data barang keluar pada periode 2024-12-19 - 2024-12-20', 1, '2024-12-20 08:18:04', '2024-12-20 10:09:24'),
	(22, 'Manager 1 export data barang masuk pada periode 2024-12-14 - 2024-12-20', 1, '2024-12-20 08:23:36', '2024-12-20 10:08:49'),
	(23, 'Manager 1 export data stok barang pada periode 2024-12-14 - 2024-12-19', 1, '2024-12-20 09:24:43', '2024-12-20 10:08:43'),
	(24, 'Manager 1 export data stok barang pada periode 2024-12-14 - 2024-12-19', 1, '2024-12-20 09:25:48', '2024-12-20 10:08:35'),
	(25, 'Manager 1 membuat data barang masuk dengan kode 41YU', 0, '2024-12-20 10:19:19', '2024-12-20 10:19:19'),
	(26, 'Manager 1 membuat data barang keluar dengan kode QW12', 0, '2024-12-20 13:20:02', '2024-12-20 13:20:02'),
	(27, 'Manager 1 membuat data barang keluar dengan kode WE23', 0, '2024-12-20 13:20:48', '2024-12-20 13:20:48'),
	(28, 'Manager 1 membuat data barang keluar dengan kode 33ED', 0, '2024-12-20 13:21:52', '2024-12-20 13:21:52'),
	(29, 'Manager 1 membuat data barang keluar dengan kode 33ED', 0, '2024-12-20 13:22:58', '2024-12-20 13:22:58');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.password_reset_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('TC6o4C1ueLbqKXt5HhV1jLwnqQzAcljoYgjWC2zg', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZzRNNmVjNTNKbThHbEduUjhsaHl2RGxuNjd0WjNtVDNsWXF1UGEzUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTczNDY2NDY5Njt9fQ==', 1734675842);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.stok_barang
CREATE TABLE IF NOT EXISTS `stok_barang` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stok_barang_kode_barang_unique` (`kode_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.stok_barang: ~9 rows (approximately)
/*!40000 ALTER TABLE `stok_barang` DISABLE KEYS */;
INSERT INTO `stok_barang` (`id`, `kode_barang`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, '12FG', 4, '2024-12-19 09:18:42', '2024-12-20 13:09:26'),
	(2, '11RR', 1812, '2024-12-19 22:08:38', '2024-12-20 13:09:26'),
	(3, '65TH', 9, '2024-12-19 22:09:33', '2024-12-20 13:09:26'),
	(4, '41YU', 1300, '2024-12-19 22:18:46', '2024-12-20 10:19:19'),
	(5, '33ED', 60, '2024-12-20 05:26:11', '2024-12-20 13:22:58'),
	(6, 'QW12', 500, '2024-12-20 05:27:16', '2024-12-20 13:20:02'),
	(7, 'WE23', 80, '2024-12-20 05:27:57', '2024-12-20 13:20:48'),
	(8, 'ER34', 660, '2024-12-20 05:28:33', '2024-12-20 08:16:52'),
	(9, 'RT45', 120, '2024-12-20 05:29:03', '2024-12-20 05:29:03'),
	(10, 'TY56', 530, '2024-12-20 05:29:27', '2024-12-20 05:29:27'),
	(11, 'UI22', 600, '2024-12-20 05:31:33', '2024-12-20 05:31:33');
/*!40000 ALTER TABLE `stok_barang` ENABLE KEYS */;

-- Dumping structure for table db_logistik_hanief.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Manager','Admin','Staff') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Staff',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_logistik_hanief.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Hanips', 'hanief@gmail.com', NULL, '$2y$12$88lck.jBQpjfZ9dtRiuku.l9WD8voueR7dlaijLEokBnS7e2AHJZy', 'Manager', NULL, '2024-12-19 09:17:46', '2024-12-19 09:17:46'),
	(2, 'Admin 1', 'admin@gmail.com', NULL, '$2y$12$i1q.sWRci.pMy0DgGhTgg.q8gh.aorAGCwRE3c3/ysFBUWmpOffoa', 'Admin', NULL, '2024-12-20 07:17:40', '2024-12-20 07:17:40'),
	(3, 'Manager 1', 'manager@gmail.com', NULL, '$2y$12$nqBSL2c57YgfjUG7J2lcq.MS9AzpHvB2jX.1A8p23IuMtagzz0Pqq', 'Manager', NULL, '2024-12-20 07:19:03', '2024-12-20 10:15:18'),
	(4, 'Staff 1', 'staff@gmail.com', NULL, '$2y$12$Xd82By6JNV2CNDfYsnzIIOpB5jYs9xN2bhXDkoWqJvU.KTkVa2/16', 'Staff', NULL, '2024-12-20 07:19:37', '2024-12-20 07:19:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
