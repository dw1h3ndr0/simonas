-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table simonas.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table simonas.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.migrations: ~15 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_05_06_160032_create_simonas_provinsi_table', 1),
	(5, '2020_05_06_160319_create_simonas_kabupaten_table', 1),
	(6, '2020_05_06_160520_create_simonas_kecamatan_table', 1),
	(7, '2020_05_06_160615_create_simonas_desa_table', 1),
	(8, '2021_04_29_145222_create_simonas_listing_table', 1),
	(9, '2021_04_29_145250_create_simonas_sampel_table', 1),
	(10, '2021_04_29_150759_create_simonas_dokumen_table', 1),
	(11, '2021_05_06_153138_create_simonas_kegiatan_table', 1),
	(12, '2021_05_22_161245_create_simonas_dsbs_table', 1),
	(13, '2021_05_22_162851_create_simonas_user_kegiatan_table', 1),
	(14, '2021_05_23_065846_create_simonas_user_dsbs_table', 1),
	(15, '2021_06_14_211547_create_simonas_supervisor_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table simonas.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_desa
CREATE TABLE IF NOT EXISTS `simonas_desa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provinsi_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_desa: ~206 rows (approximately)
/*!40000 ALTER TABLE `simonas_desa` DISABLE KEYS */;
INSERT INTO `simonas_desa` (`id`, `provinsi_id`, `kabupaten_id`, `kecamatan_id`, `kode`, `desa`, `created_at`, `updated_at`) VALUES
	(1, '75', '02', '010', '006', 'Lamu', '2021-05-26 10:09:29', '2021-05-26 10:09:30'),
	(2, '75', '02', '010', '007', 'Tontayuo', '2021-05-26 10:09:55', '2021-05-26 10:09:55'),
	(3, '75', '02', '010', '008', 'Biluhu Timur', '2021-05-26 10:10:20', '2021-05-26 10:10:21'),
	(4, '75', '02', '010', '009', 'Kayubulan', '2021-05-26 10:10:46', '2021-05-26 10:10:47'),
	(5, '75', '02', '010', '010', 'Lopo', '2021-05-26 10:11:08', '2021-05-26 10:11:09'),
	(6, '75', '02', '010', '011', 'Bongo', '2021-05-26 10:11:24', '2021-05-26 10:11:25'),
	(7, '75', '02', '010', '013', 'Olimoo\'O', '2021-05-26 10:11:57', '2021-05-26 10:11:57'),
	(8, '75', '02', '010', '014', 'Langgula', '2021-05-26 10:12:20', '2021-05-26 10:12:20'),
	(9, '75', '02', '010', '015', 'Buhudaa', '2021-05-26 10:12:39', '2021-05-26 10:12:42'),
	(10, '75', '02', '011', '001', 'Huwongo', '2021-05-26 10:13:28', '2021-05-26 10:13:28'),
	(11, '75', '02', '011', '002', 'Biluhu Barat', '2021-05-26 10:14:16', '2021-05-26 10:14:17'),
	(12, '75', '02', '011', '003', 'Lobuto', '2021-05-26 10:14:35', '2021-05-26 10:14:36'),
	(13, '75', '02', '011', '004', 'Luluo', '2021-05-26 10:14:59', '2021-05-26 10:14:59'),
	(14, '75', '02', '011', '005', 'Biluhu Tengah', '2021-05-26 10:15:26', '2021-05-26 10:15:27'),
	(15, '75', '02', '011', '006', 'Lobuto Timur', '2021-05-26 10:15:46', '2021-05-26 10:15:46'),
	(16, '75', '02', '011', '007', 'Olimeyala', '2021-05-26 10:16:23', '2021-05-26 10:16:23'),
	(17, '75', '02', '011', '008', 'Botubolu\'O', '2021-05-26 10:16:54', '2021-05-26 10:16:54'),
	(18, '75', '02', '020', '019', 'Payungan', '2021-05-26 10:17:44', '2021-05-26 10:17:45'),
	(19, '75', '02', '020', '020', 'Huntu', '2021-05-26 10:18:16', '2021-05-26 10:18:17'),
	(20, '75', '02', '020', '021', 'Bua', '2021-05-26 10:18:33', '2021-05-26 10:18:33'),
	(21, '75', '02', '020', '022', 'Iluta', '2021-05-26 10:18:52', '2021-05-26 10:18:53'),
	(22, '75', '02', '020', '025', 'Barakati', '2021-05-26 10:19:50', '2021-05-26 10:19:51'),
	(23, '75', '02', '020', '026', 'Dunggala', '2021-05-26 10:20:17', '2021-05-26 10:20:18'),
	(24, '75', '02', '020', '027', 'Ilohungayo', '2021-05-26 10:20:41', '2021-05-26 10:20:42'),
	(25, '75', '02', '020', '028', 'Pilobuhuta', '2021-05-26 10:21:06', '2021-05-26 10:21:06'),
	(26, '75', '02', '021', '001', 'Molanihu', '2021-05-26 10:21:59', '2021-05-26 10:21:59'),
	(27, '75', '02', '021', '002', 'Batulayar', '2021-05-26 10:22:34', '2021-05-26 10:22:34'),
	(28, '75', '02', '021', '003', 'Molas', '2021-05-26 10:22:56', '2021-05-26 10:22:56'),
	(29, '75', '02', '021', '004', 'Tohupo', '2021-05-26 10:23:22', '2021-05-26 10:23:22'),
	(30, '75', '02', '021', '005', 'Molopatodu', '2021-05-26 10:23:46', '2021-05-26 10:23:46'),
	(31, '75', '02', '021', '006', 'Upomela', '2021-05-26 10:24:20', '2021-05-26 10:24:20'),
	(32, '75', '02', '021', '007', 'Dulamayo', '2021-05-26 10:24:43', '2021-05-26 10:24:44'),
	(33, '75', '02', '021', '014', 'Otopade', '2021-05-26 10:25:14', '2021-05-26 10:25:15'),
	(34, '75', '02', '021', '015', 'Batu Loreng', '2021-05-26 10:25:44', '2021-05-26 10:25:44'),
	(35, '75', '02', '021', '016', 'Bongohulawa', '2021-05-26 10:27:23', '2021-05-26 10:27:23'),
	(36, '75', '02', '021', '017', 'Huntulohulawa', '2021-05-26 10:28:01', '2021-05-26 10:28:01'),
	(37, '75', '02', '021', '020', 'Liyodu', '2021-05-26 10:28:20', '2021-05-26 10:28:20'),
	(38, '75', '02', '021', '021', 'Kayumerah', '2021-05-26 10:28:43', '2021-05-26 10:28:44'),
	(39, '75', '02', '021', '022', 'Owalanga', '2021-05-26 10:29:04', '2021-05-26 10:29:05'),
	(40, '75', '02', '021', '025', 'Liyoto', '2021-05-26 10:29:27', '2021-05-26 10:29:28'),
	(41, '75', '02', '022', '001', 'Tabongo Barat', '2021-05-26 10:30:09', '2021-05-26 10:30:09'),
	(42, '75', '02', '022', '002', 'Limehe Barat', '2021-05-26 10:30:29', '2021-05-26 10:30:29'),
	(43, '75', '02', '022', '003', 'Ilomangga', '2021-05-26 10:30:51', '2021-05-26 10:30:51'),
	(44, '75', '02', '022', '004', 'Tabongo Timur', '2021-05-26 10:31:30', '2021-05-26 10:31:30'),
	(45, '75', '02', '022', '005', 'Limehe Timur', '2021-05-26 10:32:04', '2021-05-26 10:32:05'),
	(46, '75', '02', '022', '006', 'Motinelo', '2021-05-26 10:32:38', '2021-05-26 10:32:39'),
	(47, '75', '02', '022', '007', 'Moahudu', '2021-05-26 10:32:56', '2021-05-26 10:32:56'),
	(48, '75', '02', '022', '008', 'Teratai', '2021-05-26 10:33:11', '2021-05-26 10:33:15'),
	(49, '75', '02', '022', '009', 'Limehu', '2021-05-26 10:33:46', '2021-05-26 10:33:46'),
	(50, '75', '02', '023', '001', 'Momala', '2021-05-26 10:34:36', '2021-05-26 10:34:37'),
	(51, '75', '02', '023', '002', 'Ambara', '2021-05-26 10:34:56', '2021-05-26 10:34:56'),
	(52, '75', '02', '023', '003', 'Ayuhula', '2021-05-26 10:35:17', '2021-05-26 10:35:17'),
	(53, '75', '02', '023', '004', 'Botubulowe', '2021-05-26 10:35:42', '2021-05-26 10:35:43'),
	(54, '75', '02', '023', '005', 'Dungaliyo', '2021-05-26 10:36:12', '2021-05-26 10:36:13'),
	(55, '75', '02', '023', '006', 'Pilolalenga', '2021-05-26 10:36:40', '2021-05-26 10:36:40'),
	(56, '75', '02', '023', '007', 'Kaliyoso', '2021-05-26 10:37:02', '2021-05-26 10:37:02'),
	(57, '75', '02', '023', '008', 'Pangadaa', '2021-05-26 10:37:27', '2021-05-26 10:37:28'),
	(58, '75', '02', '023', '009', 'Bongomeme', '2021-05-26 10:37:47', '2021-05-26 10:37:47'),
	(59, '75', '02', '023', '010', 'Duwanga', '2021-05-26 10:38:05', '2021-05-26 10:38:05'),
	(60, '75', '02', '030', '004', 'Ilomata', '2021-05-26 10:39:52', '2021-05-26 10:39:53'),
	(61, '75', '02', '030', '005', 'Molowahu', '2021-05-26 10:40:12', '2021-05-26 10:40:13'),
	(62, '75', '02', '030', '006', 'Dunggala', '2021-05-26 10:40:32', '2021-05-26 10:40:32'),
	(63, '75', '02', '030', '007', 'Reksonegoro', '2021-05-26 10:40:57', '2021-05-26 10:40:58'),
	(64, '75', '02', '030', '008', 'Tolotio', '2021-05-26 10:41:21', '2021-05-26 10:41:22'),
	(65, '75', '02', '030', '009', 'Isimu Selatan', '2021-05-26 10:42:05', '2021-05-26 10:42:07'),
	(66, '75', '02', '030', '010', 'Datahu', '2021-05-26 10:42:32', '2021-05-26 10:42:33'),
	(67, '75', '02', '030', '016', 'Iloponu', '2021-05-26 10:43:03', '2021-05-26 10:43:04'),
	(68, '75', '02', '030', '017', 'Buhu', '2021-05-26 10:43:27', '2021-05-26 10:43:27'),
	(69, '75', '02', '030', '018', 'Isimu Utara', '2021-05-26 10:43:45', '2021-05-26 10:43:46'),
	(70, '75', '02', '030', '019', 'Labanu', '2021-05-26 10:44:13', '2021-05-26 10:44:13'),
	(71, '75', '02', '030', '021', 'Motilango', '2021-05-26 10:44:39', '2021-05-26 10:44:40'),
	(72, '75', '02', '030', '022', 'Balahu', '2021-05-26 10:44:59', '2021-05-26 10:45:00'),
	(73, '75', '02', '030', '023', 'Botumoputi', '2021-05-26 10:45:19', '2021-05-26 10:45:20'),
	(74, '75', '02', '030', '024', 'Isimu Raya', '2021-05-26 10:45:39', '2021-05-26 10:45:40'),
	(75, '75', '02', '030', '025', 'Olobua', '2021-05-26 10:46:13', '2021-05-26 10:46:13'),
	(76, '75', '02', '031', '001', 'Mulyonegoro', '2021-05-26 10:47:35', '2021-05-26 10:47:35'),
	(77, '75', '02', '031', '002', 'Bakti', '2021-05-26 10:47:54', '2021-05-26 10:47:55'),
	(78, '75', '02', '031', '003', 'Pulubala', '2021-05-26 10:48:14', '2021-05-26 10:48:15'),
	(79, '75', '02', '031', '004', 'Tridarma', '2021-05-26 10:48:34', '2021-05-26 10:48:35'),
	(80, '75', '02', '031', '005', 'Pongongaila', '2021-05-26 10:49:08', '2021-05-26 10:49:09'),
	(81, '75', '02', '031', '006', 'Puncak', '2021-05-26 10:49:25', '2021-05-26 10:49:26'),
	(82, '75', '02', '031', '007', 'Molamahu', '2021-05-26 10:49:43', '2021-05-26 10:49:44'),
	(83, '75', '02', '031', '008', 'Molalahu', '2021-05-26 10:50:03', '2021-05-26 10:50:05'),
	(84, '75', '02', '031', '009', 'Toydito', '2021-05-26 10:54:17', '2021-05-26 10:54:17'),
	(85, '75', '02', '031', '010', 'Ayumolingo', '2021-05-26 10:54:38', '2021-05-26 10:54:38'),
	(86, '75', '02', '031', '011', 'Bukit Aren', '2021-05-26 10:54:58', '2021-05-26 10:54:59'),
	(87, '75', '02', '031', '012', 'UPT Bukin Aren', '2021-05-26 10:55:23', '2021-05-26 10:55:23'),
	(88, '75', '02', '040', '007', 'Parungi', '2021-05-26 11:06:19', '2021-05-26 11:06:19'),
	(89, '75', '02', '040', '008', 'Sido Mulyo', '2021-05-26 11:06:53', '2021-05-26 11:06:53'),
	(90, '75', '02', '040', '009', 'Sidodadi', '2021-05-26 11:07:24', '2021-05-26 11:07:24'),
	(91, '75', '02', '040', '016', 'Diloniyohu', '2021-05-26 11:08:05', '2021-05-26 11:08:05'),
	(92, '75', '02', '040', '017', 'Motoduto', '2021-05-26 11:08:36', '2021-05-26 11:08:37'),
	(93, '75', '02', '040', '018', 'Potanga', '2021-05-26 11:09:06', '2021-05-26 11:09:06'),
	(94, '75', '02', '040', '020', 'Bandung Rejo', '2021-05-26 11:09:35', '2021-05-26 11:09:36'),
	(95, '75', '02', '040', '021', 'Iloheluma', '2021-05-26 11:09:52', '2021-05-26 11:09:53'),
	(96, '75', '02', '040', '022', 'Monggolito', '2021-05-26 11:10:11', '2021-05-26 11:10:12'),
	(97, '75', '02', '040', '023', 'Dulohupa', '2021-05-26 11:10:46', '2021-05-26 11:10:47'),
	(98, '75', '02', '040', '024', 'Sidomulyo Selatan', '2021-05-26 11:11:27', '2021-05-26 11:11:47'),
	(99, '75', '02', '040', '025', 'Bongongoayu', '2021-05-26 11:12:33', '2021-05-26 11:12:34'),
	(100, '75', '02', '040', '026', 'Tolite', '2021-05-26 11:12:57', '2021-05-26 11:12:58'),
	(101, '75', '02', '041', '001', 'Talumopatu', '2021-05-26 11:14:24', '2021-05-26 11:14:25'),
	(102, '75', '02', '041', '002', 'Sido Mukti', '2021-05-26 11:14:44', '2021-05-26 11:14:45'),
	(103, '75', '02', '041', '003', 'Karya Mukti', '2021-05-26 11:15:04', '2021-05-26 11:15:04'),
	(104, '75', '02', '041', '004', 'Satria', '2021-05-26 11:15:25', '2021-05-26 11:15:25'),
	(105, '75', '02', '041', '005', 'Paris', '2021-05-26 11:15:45', '2021-05-26 11:15:46'),
	(106, '75', '02', '041', '006', 'Helumo', '2021-05-26 11:16:04', '2021-05-26 11:16:04'),
	(107, '75', '02', '041', '007', 'Pilomonu', '2021-05-26 11:16:21', '2021-05-26 11:16:21'),
	(108, '75', '02', '041', '008', 'Huyula', '2021-05-26 11:16:37', '2021-05-26 11:16:38'),
	(109, '75', '02', '041', '009', 'Payu', '2021-05-26 11:17:16', '2021-05-26 11:17:17'),
	(110, '75', '02', '041', '010', 'Suka Maju', '2021-05-26 11:17:34', '2021-05-26 11:17:35'),
	(111, '75', '02', '042', '001', 'Gandasari', '2021-05-26 11:18:42', '2021-05-26 11:18:42'),
	(112, '75', '02', '042', '002', 'Sukamakmur', '2021-05-26 11:19:07', '2021-05-26 11:19:08'),
	(113, '75', '02', '042', '003', 'Molohu', '2021-05-26 11:19:29', '2021-05-26 11:19:29'),
	(114, '75', '02', '042', '004', 'Lakeya', '2021-05-26 11:19:50', '2021-05-26 11:19:52'),
	(115, '75', '02', '042', '007', 'Polohungo', '2021-05-26 11:20:15', '2021-05-26 11:20:15'),
	(116, '75', '02', '042', '008', 'Bina Jaya', '2021-05-26 11:21:31', '2021-05-26 11:21:38'),
	(117, '75', '02', '042', '009', 'Tamaila', '2021-05-26 11:22:02', '2021-05-26 11:22:03'),
	(118, '75', '02', '042', '010', 'Sidoarjo', '2021-05-26 11:24:30', '2021-05-26 11:24:31'),
	(119, '75', '02', '042', '013', 'Sukamakmur Utara', '2021-05-26 11:25:04', '2021-05-26 11:25:04'),
	(120, '75', '02', '042', '014', 'Margomulya', '2021-05-26 11:25:28', '2021-05-26 11:25:28'),
	(121, '75', '02', '042', '015', 'Makmur Abadi', '2021-05-26 11:26:55', '2021-05-26 11:26:56'),
	(122, '75', '02', '042', '016', 'Gandaria', '2021-05-26 11:27:14', '2021-05-26 11:27:15'),
	(123, '75', '02', '042', '017', 'Ombulo Tango', '2021-05-26 11:27:41', '2021-05-26 11:27:41'),
	(124, '75', '02', '042', '018', 'Tamaila Utara', '2021-05-26 11:28:07', '2021-05-26 11:28:08'),
	(125, '75', '02', '042', '019', 'Himalaya', '2021-05-26 11:28:33', '2021-05-26 11:28:34'),
	(126, '75', '02', '043', '001', 'Bululi', '2021-05-26 11:32:34', '2021-05-26 11:32:34'),
	(127, '75', '02', '043', '002', 'Mohiyolo', '2021-05-26 11:32:51', '2021-05-26 11:32:51'),
	(128, '75', '02', '043', '003', 'Karya Indah', '2021-05-26 11:33:08', '2021-05-26 11:33:08'),
	(129, '75', '02', '043', '004', 'Pangahu', '2021-05-26 11:33:26', '2021-05-26 11:33:11'),
	(130, '75', '02', '043', '005', 'Tiohu', '2021-05-26 11:33:52', '2021-05-26 11:33:54'),
	(131, '75', '02', '043', '006', 'Prima', '2021-05-26 11:34:11', '2021-05-26 11:34:11'),
	(132, '75', '02', '043', '007', 'Karya Baru', '2021-05-26 11:34:41', '2021-05-26 11:34:54'),
	(133, '75', '02', '043', '008', 'Bontula', '2021-05-26 11:35:19', '2021-05-26 11:35:20'),
	(134, '75', '02', '043', '009', 'Bihe', '2021-05-26 11:35:35', '2021-05-26 11:35:35'),
	(135, '75', '02', '043', '010', 'Olimohulo', '2021-05-26 11:36:03', '2021-05-26 11:36:04'),
	(136, '75', '02', '044', '001', 'Bilato', '2021-05-26 11:38:18', '2021-05-26 11:38:19'),
	(137, '75', '02', '044', '002', 'Ilomata', '2021-05-26 11:38:50', '2021-05-26 11:38:50'),
	(138, '75', '02', '044', '003', 'Pelehu', '2021-05-26 11:39:14', '2021-05-26 11:39:15'),
	(139, '75', '02', '044', '004', 'Taulaa', '2021-05-26 11:40:04', '2021-05-26 11:40:10'),
	(140, '75', '02', '044', '005', 'Juriya', '2021-05-26 11:40:31', '2021-05-26 11:40:31'),
	(141, '75', '02', '044', '006', 'Bumela', '2021-05-26 11:40:58', '2021-05-26 11:40:58'),
	(142, '75', '02', '044', '007', 'Totopo', '2021-05-26 11:41:22', '2021-05-26 11:41:33'),
	(143, '75', '02', '044', '008', 'Suka Damail', '2021-05-26 11:41:52', '2021-05-26 11:41:53'),
	(144, '75', '02', '044', '009', 'Lamahu', '2021-05-26 11:42:10', '2021-05-26 11:42:10'),
	(145, '75', '02', '044', '010', 'Musyawarah', '2021-05-26 11:42:33', '2021-05-26 11:42:35'),
	(146, '75', '02', '070', '005', 'Tenilo', '2021-05-26 11:45:09', '2021-05-26 11:45:09'),
	(147, '75', '02', '070', '006', 'Bolihuangga', '2021-05-26 11:45:29', '2021-05-26 11:45:29'),
	(148, '75', '02', '070', '007', 'Hunggaluwa', '2021-05-26 11:45:47', '2021-05-26 11:45:48'),
	(149, '75', '02', '070', '008', 'Kayubulan', '2021-05-26 11:46:05', '2021-05-26 11:46:05'),
	(150, '75', '02', '070', '009', 'Hepuhulawa', '2021-05-26 11:46:26', '2021-05-26 11:46:29'),
	(151, '75', '02', '070', '010', 'Dutulanaa', '2021-05-26 11:46:51', '2021-05-26 11:46:53'),
	(152, '75', '02', '070', '011', 'Hutuo', '2021-05-26 11:47:15', '2021-05-26 11:47:17'),
	(153, '75', '02', '070', '012', 'Bulota', '2021-05-26 11:47:40', '2021-05-26 11:47:41'),
	(154, '75', '02', '070', '013', 'Malahu', '2021-05-26 11:47:58', '2021-05-26 11:47:59'),
	(155, '75', '02', '070', '014', 'Biyonga', '2021-05-26 11:48:25', '2021-05-26 11:48:25'),
	(156, '75', '02', '070', '015', 'Bongohulawa', '2021-05-26 11:48:47', '2021-05-26 11:48:48'),
	(157, '75', '02', '070', '016', 'Kayumerah', '2021-05-26 11:49:08', '2021-05-26 11:49:09'),
	(158, '75', '02', '070', '017', 'Polohungo', '2021-05-26 11:49:33', '2021-05-26 11:49:34'),
	(159, '75', '02', '070', '018', 'Tilihuwa', '2021-05-26 11:50:01', '2021-05-26 11:50:05'),
	(160, '75', '02', '071', '001', 'Padengo', '2021-05-26 11:51:19', '2021-05-26 11:51:20'),
	(161, '75', '02', '071', '002', 'Hutabohu', '2021-05-26 11:51:46', '2021-05-26 11:51:47'),
	(162, '75', '02', '071', '003', 'Yoosonegoro', '2021-05-26 11:52:24', '2021-05-26 11:52:25'),
	(163, '75', '02', '071', '004', 'Tunggulo', '2021-05-26 11:52:53', '2021-05-26 11:52:54'),
	(164, '75', '02', '071', '005', 'Pone', '2021-05-26 11:53:15', '2021-05-26 11:53:16'),
	(165, '75', '02', '071', '006', 'Huidu', '2021-05-26 11:53:44', '2021-05-26 11:53:45'),
	(166, '75', '02', '071', '007', 'Ombulo', '2021-05-26 11:54:16', '2021-05-26 11:54:17'),
	(167, '75', '02', '071', '008', 'Daenaa', '2021-05-26 11:54:35', '2021-05-26 11:54:36'),
	(168, '75', '02', '071', '009', 'Huidu Utara', '2021-05-26 11:55:03', '2021-05-26 11:55:04'),
	(169, '75', '02', '071', '010', 'Haya-Haya', '2021-05-26 11:55:31', '2021-05-26 11:55:33'),
	(170, '75', '02', '080', '011', 'Bulila', '2021-05-26 11:57:45', '2021-05-26 11:57:46'),
	(171, '75', '02', '080', '014', 'Mongolato', '2021-05-26 11:58:19', '2021-05-26 11:58:19'),
	(172, '75', '02', '080', '015', 'Luhu', '2021-05-26 11:58:47', '2021-05-26 11:58:48'),
	(173, '75', '02', '080', '016', 'Hulawa', '2021-05-26 11:59:10', '2021-05-26 11:59:11'),
	(174, '75', '02', '080', '017', 'Pilohayanga', '2021-05-26 11:59:32', '2021-05-26 11:59:33'),
	(175, '75', '02', '080', '027', 'Dulamayo Selatan', '2021-05-26 11:59:56', '2021-05-26 11:59:57'),
	(176, '75', '02', '080', '028', 'Dulamayo Barat', '2021-05-26 12:00:17', '2021-05-26 12:00:17'),
	(177, '75', '02', '080', '029', 'Pilohayanga Barat', '2021-05-26 12:00:47', '2021-05-26 12:00:50'),
	(178, '75', '02', '080', '030', 'Doluhupa', '2021-05-26 12:01:13', '2021-05-26 12:01:13'),
	(179, '75', '02', '081', '001', 'Lupoyo', '2021-05-26 12:01:56', '2021-05-26 12:01:57'),
	(180, '75', '02', '081', '002', 'Pantungo', '2021-05-26 12:02:15', '2021-05-26 12:02:15'),
	(181, '75', '02', '081', '003', 'Dumati', '2021-05-26 12:02:34', '2021-05-26 12:02:36'),
	(182, '75', '02', '081', '004', 'Tuladenggi', '2021-05-26 12:02:52', '2021-05-26 12:02:53'),
	(183, '75', '02', '081', '005', 'Ulapato.A', '2021-05-26 12:03:33', '2021-05-26 12:03:34'),
	(184, '75', '02', '081', '006', 'Pentadio Timur', '2021-05-26 12:04:05', '2021-05-26 12:04:07'),
	(185, '75', '02', '081', '007', 'Pentadio Barat', '2021-05-26 12:04:29', '2021-05-26 12:04:29'),
	(186, '75', '02', '081', '008', 'Talumelito', '2021-05-26 12:04:47', '2021-05-26 12:04:49'),
	(187, '75', '02', '081', '009', 'Ulapato.B', '2021-05-26 12:05:09', '2021-05-26 12:05:10'),
	(188, '75', '02', '081', '010', 'Dulamayo Utara', '2021-05-26 12:05:36', '2021-05-26 12:05:36'),
	(189, '75', '02', '081', '011', 'Modellidu', '2021-05-26 12:06:18', '2021-05-26 12:06:19'),
	(190, '75', '02', '081', '012', 'Tinelo', '2021-05-26 12:06:45', '2021-05-26 12:06:45'),
	(191, '75', '02', '081', '013', 'Timuato', '2021-05-26 12:07:02', '2021-05-26 12:07:03'),
	(192, '75', '02', '081', '014', 'Tapaluluo', '2021-05-26 12:07:34', '2021-05-26 12:07:34'),
	(193, '75', '02', '081', '015', 'Tonala', '2021-05-26 12:07:56', '2021-05-26 12:07:56'),
	(194, '75', '02', '082', '001', 'Tualango', '2021-05-26 12:09:35', '2021-05-26 12:09:36'),
	(195, '75', '02', '082', '002', 'Dulomo', '2021-05-26 12:09:58', '2021-05-26 12:09:59'),
	(196, '75', '02', '082', '003', 'Tilote', '2021-05-26 12:10:17', '2021-05-26 12:10:17'),
	(197, '75', '02', '082', '004', 'Tabumela', '2021-05-26 12:10:51', '2021-05-26 12:10:52'),
	(198, '75', '02', '082', '005', 'Ilotidea', '2021-05-26 12:11:15', '2021-05-26 12:11:17'),
	(199, '75', '02', '082', '006', 'Lauwonu', '2021-05-26 12:11:41', '2021-05-26 12:11:42'),
	(200, '75', '02', '082', '007', 'Tenggela', '2021-05-26 12:12:07', '2021-05-26 12:12:07'),
	(201, '75', '02', '082', '008', 'TInelo', '2021-05-26 12:12:17', '2021-05-26 12:12:15'),
	(202, '75', '02', '083', '001', 'Hutadaa', '2021-05-26 12:14:09', '2021-05-26 12:14:10'),
	(203, '75', '02', '083', '002', 'Buhu', '2021-05-26 12:14:32', '2021-05-26 12:14:33'),
	(204, '75', '02', '083', '003', 'Luwoo', '2021-05-26 12:14:57', '2021-05-26 12:14:58'),
	(205, '75', '02', '083', '004', 'Bunggalo', '2021-05-26 12:15:20', '2021-05-26 12:15:21'),
	(206, '75', '02', '083', '005', 'Bulota', '2021-05-26 12:15:37', '2021-05-26 12:15:37');
/*!40000 ALTER TABLE `simonas_desa` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_dokumen
CREATE TABLE IF NOT EXISTS `simonas_dokumen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_dsbs_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcl_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pml_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p1` int(11) DEFAULT NULL,
  `p2` int(11) DEFAULT NULL,
  `p3` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_dokumen: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_dokumen` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_dokumen` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_dsbs
CREATE TABLE IF NOT EXISTS `simonas_dsbs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_dsbs: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_dsbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_dsbs` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_kabupaten
CREATE TABLE IF NOT EXISTS `simonas_kabupaten` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provinsi_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_kabupaten: ~6 rows (approximately)
/*!40000 ALTER TABLE `simonas_kabupaten` DISABLE KEYS */;
INSERT INTO `simonas_kabupaten` (`id`, `provinsi_id`, `kode`, `kabupaten`, `created_at`, `updated_at`) VALUES
	(1, '75', '01', 'Boalemo', '2021-05-26 09:56:13', '2021-05-26 09:56:14'),
	(2, '75', '02', 'Gorontalo', '2021-05-26 09:56:37', '2021-05-26 09:56:38'),
	(3, '75', '03', 'Pohuwato', '2021-05-26 09:57:01', '2021-05-26 09:57:03'),
	(4, '75', '04', 'Bone Bolango', '2021-05-26 09:57:20', '2021-05-26 09:57:21'),
	(5, '75', '05', 'Gorontalo Utara', '2021-05-26 09:57:39', '2021-05-26 09:57:40'),
	(6, '75', '71', 'Gorontalo', '2021-05-26 09:58:15', '2021-05-26 09:58:16');
/*!40000 ALTER TABLE `simonas_kabupaten` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_kecamatan
CREATE TABLE IF NOT EXISTS `simonas_kecamatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provinsi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_kecamatan: ~19 rows (approximately)
/*!40000 ALTER TABLE `simonas_kecamatan` DISABLE KEYS */;
INSERT INTO `simonas_kecamatan` (`id`, `provinsi_id`, `kabupaten_id`, `kode`, `kecamatan`, `created_at`, `updated_at`) VALUES
	(1, '75', '02', '010', 'Batudaa Pantai', '2021-05-26 10:00:24', '2021-05-26 10:00:25'),
	(2, '75', '02', '011', 'Biluhu', '2021-05-26 10:00:53', '2021-05-26 10:00:54'),
	(3, '75', '02', '020', 'Batudaa', '2021-05-26 10:01:26', '2021-05-26 10:01:26'),
	(4, '75', '02', '021', 'Bongomeme', '2021-05-26 10:01:51', '2021-05-26 10:01:51'),
	(5, '75', '02', '022', 'Tabongo', '2021-05-26 10:02:15', '2021-05-26 10:02:16'),
	(6, '75', '02', '023', 'Dungaliyo', '2021-05-26 10:02:43', '2021-05-26 10:02:43'),
	(7, '75', '02', '030', 'Tibawa', '2021-05-26 10:03:12', '2021-05-26 10:03:13'),
	(8, '75', '02', '031', 'Pulubala', '2021-05-26 10:03:33', '2021-05-26 10:03:33'),
	(9, '75', '02', '040', 'Boliyohuto', '2021-05-26 10:03:55', '2021-05-26 10:03:55'),
	(10, '75', '02', '041', 'Mootilango', '2021-05-26 10:04:20', '2021-05-26 10:04:20'),
	(11, '75', '02', '042', 'Tolangohula', '2021-05-26 10:04:43', '2021-05-26 10:04:43'),
	(12, '75', '02', '043', 'Asparaga', '2021-05-26 10:05:18', '2021-05-26 10:05:19'),
	(13, '75', '02', '044', 'Bilato', '2021-05-26 10:05:40', '2021-05-26 10:05:40'),
	(14, '75', '02', '070', 'Limboto', '2021-05-26 10:06:00', '2021-05-26 10:06:01'),
	(15, '75', '02', '071', 'Limboto Barat', '2021-05-26 10:06:22', '2021-05-26 10:06:22'),
	(16, '75', '02', '080', 'Telaga', '2021-05-26 10:06:38', '2021-05-26 10:06:39'),
	(17, '75', '02', '081', 'Telaga Biru', '2021-05-26 10:06:58', '2021-05-26 10:06:58'),
	(18, '75', '02', '082', 'Tilango', '2021-05-26 10:07:14', '2021-05-26 10:07:15'),
	(19, '75', '02', '083', 'Telaga Jaya', '2021-05-26 10:07:33', '2021-05-26 10:07:33');
/*!40000 ALTER TABLE `simonas_kecamatan` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_kegiatan
CREATE TABLE IF NOT EXISTS `simonas_kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_keg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_kegiatan: ~1 rows (approximately)
/*!40000 ALTER TABLE `simonas_kegiatan` DISABLE KEYS */;
INSERT INTO `simonas_kegiatan` (`id`, `tahun`, `nama_keg`, `periode`, `mulai`, `selesai`, `created_at`, `updated_at`) VALUES
	(1, '2021', 'Susenas', 'Semester II', '2021-08-01', '2021-08-20', '2021-05-24 23:04:32', '2021-05-24 23:04:33');
/*!40000 ALTER TABLE `simonas_kegiatan` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_listing
CREATE TABLE IF NOT EXISTS `simonas_listing` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_dsbs_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcl_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pml_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p1` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_listing: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_listing` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_listing` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_provinsi
CREATE TABLE IF NOT EXISTS `simonas_provinsi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_provinsi: ~1 rows (approximately)
/*!40000 ALTER TABLE `simonas_provinsi` DISABLE KEYS */;
INSERT INTO `simonas_provinsi` (`id`, `kode`, `provinsi`, `created_at`, `updated_at`) VALUES
	(1, '75', 'Gorontalo', '2021-05-26 09:54:51', '2021-05-26 09:54:52');
/*!40000 ALTER TABLE `simonas_provinsi` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_sampel
CREATE TABLE IF NOT EXISTS `simonas_sampel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_dsbs_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pml_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcl_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p1` int(11) DEFAULT NULL,
  `p2` int(11) DEFAULT NULL,
  `p3` int(11) DEFAULT NULL,
  `p4` int(11) DEFAULT NULL,
  `p5` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_sampel: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_sampel` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_sampel` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_supervisor
CREATE TABLE IF NOT EXISTS `simonas_supervisor` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_supervisor: ~1 rows (approximately)
/*!40000 ALTER TABLE `simonas_supervisor` DISABLE KEYS */;
INSERT INTO `simonas_supervisor` (`id`, `user_id`, `kegiatan_id`, `nama`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
	(1, 1, '1', 'Dwi Hendro Siswo Purnomo', '082292532649', 'dwi.hendro@bps.go.id', '2021-05-24 23:06:01', '2021-05-24 23:06:02');
/*!40000 ALTER TABLE `simonas_supervisor` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_user_dsbs
CREATE TABLE IF NOT EXISTS `simonas_user_dsbs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dsbs_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_user_dsbs: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_user_dsbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_user_dsbs` ENABLE KEYS */;

-- Dumping structure for table simonas.simonas_user_kegiatan
CREATE TABLE IF NOT EXISTS `simonas_user_kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kegiatan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.simonas_user_kegiatan: ~0 rows (approximately)
/*!40000 ALTER TABLE `simonas_user_kegiatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `simonas_user_kegiatan` ENABLE KEYS */;

-- Dumping structure for table simonas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table simonas.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role`, `nama`, `jabatan`, `no_hp`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Dwi Hendro Siswo Purnomo', 'organik', '082292532649', 'dwi.hendro@bps.go.id', NULL, '$2y$10$FImCK1D8vu16sshFEbFJ3eFYm5WL14BthrXKoPbNAGBLWmid2scZi', NULL, '2021-05-23 07:18:10', '2021-06-14 01:27:44'),
	(2, 'admin', 'Riane Ramdhani Isa', 'organik', '08114321585', 'riane@bps.go.id', NULL, '$2y$10$T7bBDpc3MM8cwT0ThQ3mk.zfRXUjHM6i8Ld2nZK4bLfqseE1LM/tG', 'EdDQshbhJCQdByXNxFKQ5cTugMUm1XZzFb6NFwpXNZi8UbsdlKVZJ7hmHxVL', '2021-05-23 08:04:02', '2021-05-23 08:04:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
