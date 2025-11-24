-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Nov 2025 pada 04.02
-- Versi server: 8.0.30
-- Versi PHP: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_mading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikels`
--

CREATE TABLE `artikels` (
  `id_artikel` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('draft','pending','published','rejected') NOT NULL DEFAULT 'draft',
  `alasan_penolakan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `artikels`
--

INSERT INTO `artikels` (`id_artikel`, `judul`, `isi`, `tanggal`, `id_user`, `id_kategori`, `foto`, `status`, `alasan_penolakan`, `created_at`, `updated_at`) VALUES
(4, 'PEMILIHAN KETOS', 'bjfbefheifief', '2025-11-11', 3, 3, 'artikel_foto/7ytFRvHtLi0oc6kTCWCg5PG4iDbB00j5feG43DlH.jpg', 'published', NULL, '2025-11-10 19:46:12', '2025-11-10 19:46:34'),
(5, 'sajutaa', 'santun jujur taat', '2025-11-11', 3, 1, 'artikel_foto/RzngiioU8ObASSN7AblxA8R1HBZMaueF6X5hEbXA.jpg', 'published', NULL, '2025-11-11 00:38:19', '2025-11-11 00:38:55'),
(6, 'HARI PAHLAWAN', 'PAHLAWAN', '2025-11-11', 3, 5, 'artikel_foto/t8HDGIvWP6re3boQ1dsevy3DARjrel6JkwemXWGd.jpg', 'published', NULL, '2025-11-11 02:31:28', '2025-11-11 02:32:07'),
(10, 'PORAK', 'SERU BANGETTTTT', '2025-11-14', 9, 3, NULL, 'published', NULL, '2025-11-13 23:46:09', '2025-11-13 23:48:50'),
(12, 'bbbb', 'bbbbbb', '2025-11-18', 9, 3, NULL, 'pending', NULL, '2025-11-17 19:07:04', '2025-11-20 20:09:18'),
(13, 'HARI BATIK nasional', 'selamat hari batik', '2025-11-18', 11, 5, 'posts/KIBUojG61ue14uSP6ex9L9choQbBWZM1whpY2EZ4.jpg', 'published', NULL, '2025-11-17 20:11:31', '2025-11-17 20:12:34'),
(14, 'yesssss', 'juaraaaa', '2025-11-19', 11, 2, NULL, 'published', NULL, '2025-11-18 18:24:27', '2025-11-19 10:00:32'),
(15, 'artikel', 'yes', '2025-11-19', 11, 2, 'posts/k0CW9yOMtX8UOC1Yosc6YEYEBFkTKaazaGX7ZWFl.jpg', 'rejected', 'kurang menarik', '2025-11-18 19:12:27', '2025-11-18 19:13:55'),
(16, 'Hari batik', 'selamat hari batik nasional', '2025-11-19', 12, 5, 'posts/Rcd49Wvue3DvaTRySzMymSHGb9dZBtirqB22ABHc.jpg', 'published', NULL, '2025-11-19 09:59:27', '2025-11-19 10:00:53'),
(17, 'JUARA FUTSAL', 'juara 2 futsal series di al masoem', '2025-11-20', 14, 2, 'posts/3CHQSCFpGaTDrfGhKJodEdiU5IsKDDFNoFyW2gvq.jpg', 'published', NULL, '2025-11-19 18:10:30', '2025-11-19 18:21:04'),
(18, 'porak', 'hari porak', '2025-11-20', 11, 3, 'posts/O2N658UWUWBzQyNfiZKsHmVL9VZu63YiUclukhCw.jpg', 'published', NULL, '2025-11-20 00:49:46', '2025-11-20 00:50:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Berita Sekolah', '2025-11-10 18:12:13', '2025-11-10 18:12:13'),
(2, 'Prestasi', '2025-11-10 18:12:13', '2025-11-10 18:12:13'),
(3, 'Kegiatan', '2025-11-10 18:12:13', '2025-11-10 18:12:13'),
(4, 'Pengumuman', '2025-11-10 18:12:13', '2025-11-10 18:12:13'),
(5, 'Hari Nasional', '2025-11-10 18:22:24', '2025-11-10 18:22:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentars`
--

CREATE TABLE `komentars` (
  `id_komentar` bigint UNSIGNED NOT NULL,
  `id_artikel` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `isi_komentar` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `komentars`
--

INSERT INTO `komentars` (`id_komentar`, `id_artikel`, `id_user`, `isi_komentar`, `created_at`, `updated_at`) VALUES
(3, 4, 2, 'mantap', '2025-11-10 19:46:56', '2025-11-10 19:46:56'),
(4, 4, 1, 'keren', '2025-11-10 20:50:08', '2025-11-10 20:50:08'),
(5, 5, 2, 'yap yap', '2025-11-11 00:39:18', '2025-11-11 00:39:18'),
(6, 6, 2, 'mantap', '2025-11-11 02:32:50', '2025-11-11 02:32:50'),
(8, 17, 11, 'mantap', '2025-11-20 00:55:30', '2025-11-20 00:55:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id_like` bigint UNSIGNED NOT NULL,
  `id_artikel` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`id_like`, `id_artikel`, `id_user`, `created_at`, `updated_at`) VALUES
(3, 4, 2, '2025-11-10 19:46:50', '2025-11-10 19:46:50'),
(4, 5, 2, '2025-11-11 00:39:09', '2025-11-11 00:39:09'),
(5, 6, 2, '2025-11-11 02:32:44', '2025-11-11 02:32:44'),
(6, 10, 2, '2025-11-13 23:51:26', '2025-11-13 23:51:26'),
(7, 17, 1, '2025-11-19 19:22:15', '2025-11-19 19:22:15'),
(9, 17, 11, '2025-11-20 00:55:23', '2025-11-20 00:55:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log`, `id_user`, `aksi`, `waktu`, `created_at`, `updated_at`) VALUES
(16, 2, 'Login', '2025-11-10 18:31:15', '2025-11-10 18:31:15', '2025-11-10 18:31:15'),
(17, 2, 'Logout', '2025-11-10 18:35:46', '2025-11-10 18:35:46', '2025-11-10 18:35:46'),
(21, 2, 'Login', '2025-11-10 18:36:59', '2025-11-10 18:36:59', '2025-11-10 18:36:59'),
(22, 2, 'Logout', '2025-11-10 18:40:07', '2025-11-10 18:40:07', '2025-11-10 18:40:07'),
(23, 2, 'Login', '2025-11-10 18:40:20', '2025-11-10 18:40:20', '2025-11-10 18:40:20'),
(24, 2, 'ACC Artikel: Artikel Test Siswa', '2025-11-10 18:43:44', '2025-11-10 18:43:44', '2025-11-10 18:43:44'),
(25, 2, 'Komentar Artikel: Artikel Test Siswa', '2025-11-10 18:44:08', '2025-11-10 18:44:08', '2025-11-10 18:44:08'),
(26, 2, 'Like Artikel: Artikel Test Siswa', '2025-11-10 18:44:18', '2025-11-10 18:44:18', '2025-11-10 18:44:18'),
(27, 2, 'Logout', '2025-11-10 18:44:37', '2025-11-10 18:44:37', '2025-11-10 18:44:37'),
(32, 2, 'Login', '2025-11-10 18:45:21', '2025-11-10 18:45:21', '2025-11-10 18:45:21'),
(33, 2, 'ACC Artikel: PEMILIHAN KETOS', '2025-11-10 18:45:27', '2025-11-10 18:45:27', '2025-11-10 18:45:27'),
(34, 2, 'ACC Artikel: HARI BATIK', '2025-11-10 18:45:32', '2025-11-10 18:45:32', '2025-11-10 18:45:32'),
(35, 2, 'ACC Artikel: HARI BATIK', '2025-11-10 18:45:44', '2025-11-10 18:45:44', '2025-11-10 18:45:44'),
(36, 2, 'ACC Artikel: HARI BATIK', '2025-11-10 18:45:54', '2025-11-10 18:45:54', '2025-11-10 18:45:54'),
(37, 2, 'Komentar Artikel: HARI BATIK', '2025-11-10 18:48:56', '2025-11-10 18:48:56', '2025-11-10 18:48:56'),
(38, 2, 'Like Artikel: HARI BATIK', '2025-11-10 18:49:00', '2025-11-10 18:49:00', '2025-11-10 18:49:00'),
(39, 2, 'Logout', '2025-11-10 18:52:26', '2025-11-10 18:52:26', '2025-11-10 18:52:26'),
(40, 2, 'Login', '2025-11-10 18:52:45', '2025-11-10 18:52:45', '2025-11-10 18:52:45'),
(41, 2, 'Logout', '2025-11-10 18:55:02', '2025-11-10 18:55:02', '2025-11-10 18:55:02'),
(42, 1, 'Login', '2025-11-10 18:57:09', '2025-11-10 18:57:09', '2025-11-10 18:57:09'),
(43, 1, 'Logout', '2025-11-10 19:05:31', '2025-11-10 19:05:31', '2025-11-10 19:05:31'),
(44, 2, 'Login', '2025-11-10 19:08:47', '2025-11-10 19:08:47', '2025-11-10 19:08:47'),
(45, 2, 'Logout', '2025-11-10 19:40:25', '2025-11-10 19:40:25', '2025-11-10 19:40:25'),
(46, 3, 'Login', '2025-11-10 19:40:51', '2025-11-10 19:40:51', '2025-11-10 19:40:51'),
(47, 3, 'Update Artikel: Artikel Siswa', '2025-11-10 19:43:38', '2025-11-10 19:43:38', '2025-11-10 19:43:38'),
(48, 3, 'Logout', '2025-11-10 19:45:35', '2025-11-10 19:45:35', '2025-11-10 19:45:35'),
(49, 3, 'Login', '2025-11-10 19:45:47', '2025-11-10 19:45:47', '2025-11-10 19:45:47'),
(50, 3, 'Membuat Artikel: PEMILIHAN KETOS', '2025-11-10 19:46:12', '2025-11-10 19:46:12', '2025-11-10 19:46:12'),
(51, 3, 'Submit Artikel untuk Verifikasi: PEMILIHAN KETOS', '2025-11-10 19:46:15', '2025-11-10 19:46:15', '2025-11-10 19:46:15'),
(52, 3, 'Logout', '2025-11-10 19:46:19', '2025-11-10 19:46:19', '2025-11-10 19:46:19'),
(53, 2, 'Login', '2025-11-10 19:46:27', '2025-11-10 19:46:27', '2025-11-10 19:46:27'),
(54, 2, 'ACC Artikel: PEMILIHAN KETOS', '2025-11-10 19:46:34', '2025-11-10 19:46:34', '2025-11-10 19:46:34'),
(55, 2, 'Like Artikel: PEMILIHAN KETOS', '2025-11-10 19:46:50', '2025-11-10 19:46:50', '2025-11-10 19:46:50'),
(56, 2, 'Komentar Artikel: PEMILIHAN KETOS', '2025-11-10 19:46:57', '2025-11-10 19:46:57', '2025-11-10 19:46:57'),
(57, 2, 'Logout', '2025-11-10 19:47:16', '2025-11-10 19:47:16', '2025-11-10 19:47:16'),
(58, 1, 'Login', '2025-11-10 19:47:25', '2025-11-10 19:47:25', '2025-11-10 19:47:25'),
(59, 1, 'Komentar Artikel: PEMILIHAN KETOS', '2025-11-10 20:50:08', '2025-11-10 20:50:08', '2025-11-10 20:50:08'),
(60, 1, 'Logout', '2025-11-10 20:51:39', '2025-11-10 20:51:39', '2025-11-10 20:51:39'),
(61, 2, 'Login', '2025-11-10 20:51:49', '2025-11-10 20:51:49', '2025-11-10 20:51:49'),
(62, 2, 'Logout', '2025-11-10 20:57:09', '2025-11-10 20:57:09', '2025-11-10 20:57:09'),
(63, 3, 'Login', '2025-11-10 20:57:19', '2025-11-10 20:57:19', '2025-11-10 20:57:19'),
(64, 3, 'Logout', '2025-11-10 20:58:55', '2025-11-10 20:58:55', '2025-11-10 20:58:55'),
(65, 3, 'Login', '2025-11-10 21:18:27', '2025-11-10 21:18:27', '2025-11-10 21:18:27'),
(66, 1, 'Login', '2025-11-10 23:42:39', '2025-11-10 23:42:39', '2025-11-10 23:42:39'),
(67, 1, 'Logout', '2025-11-11 00:37:14', '2025-11-11 00:37:14', '2025-11-11 00:37:14'),
(68, 3, 'Login', '2025-11-11 00:37:32', '2025-11-11 00:37:32', '2025-11-11 00:37:32'),
(69, 3, 'Membuat Artikel: sajutaa', '2025-11-11 00:38:19', '2025-11-11 00:38:19', '2025-11-11 00:38:19'),
(70, 3, 'Submit Artikel untuk Verifikasi: sajutaa', '2025-11-11 00:38:22', '2025-11-11 00:38:22', '2025-11-11 00:38:22'),
(71, 3, 'Logout', '2025-11-11 00:38:28', '2025-11-11 00:38:28', '2025-11-11 00:38:28'),
(72, 2, 'Login', '2025-11-11 00:38:40', '2025-11-11 00:38:40', '2025-11-11 00:38:40'),
(73, 2, 'ACC Artikel: sajutaa', '2025-11-11 00:38:55', '2025-11-11 00:38:55', '2025-11-11 00:38:55'),
(74, 2, 'Like Artikel: sajutaa', '2025-11-11 00:39:09', '2025-11-11 00:39:09', '2025-11-11 00:39:09'),
(75, 2, 'Komentar Artikel: sajutaa', '2025-11-11 00:39:18', '2025-11-11 00:39:18', '2025-11-11 00:39:18'),
(76, 2, 'Logout', '2025-11-11 00:39:36', '2025-11-11 00:39:36', '2025-11-11 00:39:36'),
(77, 1, 'Login', '2025-11-11 00:39:44', '2025-11-11 00:39:44', '2025-11-11 00:39:44'),
(78, 1, 'Logout', '2025-11-11 02:30:03', '2025-11-11 02:30:03', '2025-11-11 02:30:03'),
(79, 3, 'Login', '2025-11-11 02:30:32', '2025-11-11 02:30:32', '2025-11-11 02:30:32'),
(80, 3, 'Membuat Artikel: HARI PAHLAWAN', '2025-11-11 02:31:28', '2025-11-11 02:31:28', '2025-11-11 02:31:28'),
(81, 3, 'Submit Artikel untuk Verifikasi: HARI PAHLAWAN', '2025-11-11 02:31:36', '2025-11-11 02:31:36', '2025-11-11 02:31:36'),
(82, 3, 'Logout', '2025-11-11 02:31:43', '2025-11-11 02:31:43', '2025-11-11 02:31:43'),
(83, 2, 'Login', '2025-11-11 02:31:54', '2025-11-11 02:31:54', '2025-11-11 02:31:54'),
(84, 2, 'ACC Artikel: HARI PAHLAWAN', '2025-11-11 02:32:07', '2025-11-11 02:32:07', '2025-11-11 02:32:07'),
(85, 2, 'Like Artikel: HARI PAHLAWAN', '2025-11-11 02:32:44', '2025-11-11 02:32:44', '2025-11-11 02:32:44'),
(86, 2, 'Komentar Artikel: HARI PAHLAWAN', '2025-11-11 02:32:50', '2025-11-11 02:32:50', '2025-11-11 02:32:50'),
(87, 2, 'Logout', '2025-11-11 02:33:00', '2025-11-11 02:33:00', '2025-11-11 02:33:00'),
(88, 1, 'Login', '2025-11-11 02:33:13', '2025-11-11 02:33:13', '2025-11-11 02:33:13'),
(89, 3, 'Login', '2025-11-11 18:13:07', '2025-11-11 18:13:07', '2025-11-11 18:13:07'),
(90, 3, 'Membuat Artikel: BAKNUS', '2025-11-11 18:13:35', '2025-11-11 18:13:35', '2025-11-11 18:13:35'),
(91, 3, 'Submit Artikel untuk Verifikasi: BAKNUS', '2025-11-11 18:13:41', '2025-11-11 18:13:41', '2025-11-11 18:13:41'),
(92, 3, 'Logout', '2025-11-11 18:13:46', '2025-11-11 18:13:46', '2025-11-11 18:13:46'),
(93, 2, 'Login', '2025-11-11 18:13:59', '2025-11-11 18:13:59', '2025-11-11 18:13:59'),
(94, 2, 'ACC Artikel: BAKNUS', '2025-11-11 18:14:06', '2025-11-11 18:14:06', '2025-11-11 18:14:06'),
(95, 2, 'Logout', '2025-11-11 18:14:34', '2025-11-11 18:14:34', '2025-11-11 18:14:34'),
(96, 9, 'Register', '2025-11-11 18:24:55', '2025-11-11 18:24:55', '2025-11-11 18:24:55'),
(97, 9, 'Membuat Artikel: BAKNUS', '2025-11-11 18:25:24', '2025-11-11 18:25:24', '2025-11-11 18:25:24'),
(98, 9, 'Submit Artikel untuk Verifikasi: BAKNUS', '2025-11-11 18:25:36', '2025-11-11 18:25:36', '2025-11-11 18:25:36'),
(99, 9, 'Logout', '2025-11-11 18:25:39', '2025-11-11 18:25:39', '2025-11-11 18:25:39'),
(100, 2, 'Login', '2025-11-11 18:25:52', '2025-11-11 18:25:52', '2025-11-11 18:25:52'),
(101, 2, 'ACC Artikel: BAKNUS', '2025-11-11 18:26:00', '2025-11-11 18:26:00', '2025-11-11 18:26:00'),
(102, 2, 'Logout', '2025-11-11 18:28:41', '2025-11-11 18:28:41', '2025-11-11 18:28:41'),
(103, 1, 'Login', '2025-11-11 18:28:52', '2025-11-11 18:28:52', '2025-11-11 18:28:52'),
(104, 1, 'Logout', '2025-11-11 18:36:46', '2025-11-11 18:36:46', '2025-11-11 18:36:46'),
(105, 9, 'Login', '2025-11-11 20:57:24', '2025-11-11 20:57:24', '2025-11-11 20:57:24'),
(106, 9, 'Update Artikel: BAKNUS', '2025-11-11 20:59:14', '2025-11-11 20:59:14', '2025-11-11 20:59:14'),
(107, 9, 'Logout', '2025-11-11 20:59:20', '2025-11-11 20:59:20', '2025-11-11 20:59:20'),
(108, 3, 'Login', '2025-11-13 17:33:15', '2025-11-13 17:33:15', '2025-11-13 17:33:15'),
(109, 3, 'Membuat Artikel: makanan bergizi gratis', '2025-11-13 17:34:48', '2025-11-13 17:34:48', '2025-11-13 17:34:48'),
(110, 3, 'Submit Artikel untuk Verifikasi: makanan bergizi gratis', '2025-11-13 17:34:55', '2025-11-13 17:34:55', '2025-11-13 17:34:55'),
(111, 3, 'Logout', '2025-11-13 17:34:59', '2025-11-13 17:34:59', '2025-11-13 17:34:59'),
(112, 1, 'Login', '2025-11-13 17:35:11', '2025-11-13 17:35:11', '2025-11-13 17:35:11'),
(113, 1, 'Publish Artikel: makanan bergizi gratis', '2025-11-13 17:35:32', '2025-11-13 17:35:32', '2025-11-13 17:35:32'),
(114, 1, 'Komentar Artikel: makanan bergizi gratis', '2025-11-13 17:36:12', '2025-11-13 17:36:12', '2025-11-13 17:36:12'),
(115, 1, 'Logout', '2025-11-13 17:36:50', '2025-11-13 17:36:50', '2025-11-13 17:36:50'),
(116, 2, 'Login', '2025-11-13 17:37:03', '2025-11-13 17:37:03', '2025-11-13 17:37:03'),
(117, 2, 'Logout', '2025-11-13 17:38:48', '2025-11-13 17:38:48', '2025-11-13 17:38:48'),
(118, 1, 'Login', '2025-11-13 17:39:05', '2025-11-13 17:39:05', '2025-11-13 17:39:05'),
(119, 1, 'Logout', '2025-11-13 17:53:09', '2025-11-13 17:53:09', '2025-11-13 17:53:09'),
(120, 2, 'Login', '2025-11-13 17:53:35', '2025-11-13 17:53:35', '2025-11-13 17:53:35'),
(121, 2, 'Logout', '2025-11-13 17:53:55', '2025-11-13 17:53:55', '2025-11-13 17:53:55'),
(122, 9, 'Login', '2025-11-13 23:45:21', '2025-11-13 23:45:21', '2025-11-13 23:45:21'),
(123, 9, 'Membuat Artikel: PORAK', '2025-11-13 23:46:09', '2025-11-13 23:46:09', '2025-11-13 23:46:09'),
(124, 9, 'Submit Artikel untuk Verifikasi: PORAK', '2025-11-13 23:46:14', '2025-11-13 23:46:14', '2025-11-13 23:46:14'),
(125, 9, 'Logout', '2025-11-13 23:48:04', '2025-11-13 23:48:04', '2025-11-13 23:48:04'),
(126, 2, 'Login', '2025-11-13 23:48:31', '2025-11-13 23:48:31', '2025-11-13 23:48:31'),
(127, 2, 'ACC Artikel: PORAK', '2025-11-13 23:48:50', '2025-11-13 23:48:50', '2025-11-13 23:48:50'),
(128, 2, 'Logout', '2025-11-13 23:48:55', '2025-11-13 23:48:55', '2025-11-13 23:48:55'),
(129, 9, 'Login', '2025-11-13 23:49:04', '2025-11-13 23:49:04', '2025-11-13 23:49:04'),
(130, 9, 'Logout', '2025-11-13 23:51:00', '2025-11-13 23:51:00', '2025-11-13 23:51:00'),
(131, 2, 'Login', '2025-11-13 23:51:11', '2025-11-13 23:51:11', '2025-11-13 23:51:11'),
(132, 2, 'Like Artikel: PORAK', '2025-11-13 23:51:26', '2025-11-13 23:51:26', '2025-11-13 23:51:26'),
(133, 1, 'Login', '2025-11-16 17:42:18', '2025-11-16 17:42:18', '2025-11-16 17:42:18'),
(134, 1, 'Logout', '2025-11-16 17:42:40', '2025-11-16 17:42:40', '2025-11-16 17:42:40'),
(135, 9, 'Login', '2025-11-16 18:25:55', '2025-11-16 18:25:55', '2025-11-16 18:25:55'),
(136, 9, 'Logout', '2025-11-16 18:28:59', '2025-11-16 18:28:59', '2025-11-16 18:28:59'),
(137, 3, 'Login', '2025-11-16 18:32:00', '2025-11-16 18:32:00', '2025-11-16 18:32:00'),
(138, 3, 'Hapus Artikel: Artikel Siswa', '2025-11-16 18:32:07', '2025-11-16 18:32:07', '2025-11-16 18:32:07'),
(139, 3, 'Hapus Artikel: BAKNUS', '2025-11-16 18:32:20', '2025-11-16 18:32:20', '2025-11-16 18:32:20'),
(140, 3, 'Hapus Artikel: makanan bergizi gratis', '2025-11-16 18:32:25', '2025-11-16 18:32:25', '2025-11-16 18:32:25'),
(141, 3, 'Logout', '2025-11-16 18:35:29', '2025-11-16 18:35:29', '2025-11-16 18:35:29'),
(142, 1, 'Login', '2025-11-16 18:35:39', '2025-11-16 18:35:39', '2025-11-16 18:35:39'),
(143, 1, 'Logout', '2025-11-16 18:45:17', '2025-11-16 18:45:17', '2025-11-16 18:45:17'),
(144, 1, 'Login', '2025-11-16 21:48:52', '2025-11-16 21:48:52', '2025-11-16 21:48:52'),
(145, 1, 'Logout', '2025-11-16 21:49:36', '2025-11-16 21:49:36', '2025-11-16 21:49:36'),
(146, 9, 'Login', '2025-11-16 23:47:15', '2025-11-16 23:47:15', '2025-11-16 23:47:15'),
(147, 9, 'Hapus Artikel: BAKNUS', '2025-11-16 23:47:34', '2025-11-16 23:47:34', '2025-11-16 23:47:34'),
(148, 9, 'Logout', '2025-11-16 23:47:57', '2025-11-16 23:47:57', '2025-11-16 23:47:57'),
(149, 2, 'Login', '2025-11-17 00:03:42', '2025-11-17 00:03:42', '2025-11-17 00:03:42'),
(150, 2, 'Logout', '2025-11-17 00:04:14', '2025-11-17 00:04:14', '2025-11-17 00:04:14'),
(151, 1, 'Login', '2025-11-17 00:13:35', '2025-11-17 00:13:35', '2025-11-17 00:13:35'),
(152, 1, 'Logout', '2025-11-17 00:14:28', '2025-11-17 00:14:28', '2025-11-17 00:14:28'),
(153, 9, 'Login', '2025-11-17 18:52:17', '2025-11-17 18:52:17', '2025-11-17 18:52:17'),
(154, 9, 'Membuat Artikel: Hari kartini', '2025-11-17 18:53:03', '2025-11-17 18:53:03', '2025-11-17 18:53:03'),
(155, 9, 'Submit Artikel untuk Verifikasi: Hari kartini', '2025-11-17 18:53:14', '2025-11-17 18:53:14', '2025-11-17 18:53:14'),
(156, 9, 'Logout', '2025-11-17 18:53:34', '2025-11-17 18:53:34', '2025-11-17 18:53:34'),
(157, 2, 'Login', '2025-11-17 18:53:57', '2025-11-17 18:53:57', '2025-11-17 18:53:57'),
(158, 2, 'Logout', '2025-11-17 18:58:16', '2025-11-17 18:58:16', '2025-11-17 18:58:16'),
(159, 2, 'Login', '2025-11-17 18:58:29', '2025-11-17 18:58:29', '2025-11-17 18:58:29'),
(160, 2, 'Reject Artikel: Hari kartini', '2025-11-17 19:02:17', '2025-11-17 19:02:17', '2025-11-17 19:02:17'),
(161, 2, 'Logout', '2025-11-17 19:03:46', '2025-11-17 19:03:46', '2025-11-17 19:03:46'),
(162, 9, 'Login', '2025-11-17 19:03:59', '2025-11-17 19:03:59', '2025-11-17 19:03:59'),
(163, 9, 'Hapus Artikel: Hari kartini', '2025-11-17 19:04:15', '2025-11-17 19:04:15', '2025-11-17 19:04:15'),
(164, 9, 'Membuat Artikel: bbbb', '2025-11-17 19:07:04', '2025-11-17 19:07:04', '2025-11-17 19:07:04'),
(165, 9, 'Submit Artikel untuk Verifikasi: bbbb', '2025-11-17 19:07:11', '2025-11-17 19:07:11', '2025-11-17 19:07:11'),
(166, 9, 'Logout', '2025-11-17 19:07:14', '2025-11-17 19:07:14', '2025-11-17 19:07:14'),
(167, 2, 'Login', '2025-11-17 19:07:56', '2025-11-17 19:07:56', '2025-11-17 19:07:56'),
(168, 2, 'Logout', '2025-11-17 19:08:12', '2025-11-17 19:08:12', '2025-11-17 19:08:12'),
(169, 1, 'Login', '2025-11-17 19:08:29', '2025-11-17 19:08:29', '2025-11-17 19:08:29'),
(170, 1, 'Reject Artikel: bbbb', '2025-11-17 19:08:55', '2025-11-17 19:08:55', '2025-11-17 19:08:55'),
(171, 1, 'Logout', '2025-11-17 19:31:45', '2025-11-17 19:31:45', '2025-11-17 19:31:45'),
(172, 11, 'Register', '2025-11-17 20:10:38', '2025-11-17 20:10:38', '2025-11-17 20:10:38'),
(173, 11, 'Membuat Artikel: HARI BATIK nasional', '2025-11-17 20:11:31', '2025-11-17 20:11:31', '2025-11-17 20:11:31'),
(174, 11, 'Submit Artikel untuk Verifikasi: HARI BATIK nasional', '2025-11-17 20:11:38', '2025-11-17 20:11:38', '2025-11-17 20:11:38'),
(175, 11, 'Logout', '2025-11-17 20:11:50', '2025-11-17 20:11:50', '2025-11-17 20:11:50'),
(176, 2, 'Login', '2025-11-17 20:12:02', '2025-11-17 20:12:02', '2025-11-17 20:12:02'),
(177, 2, 'ACC Artikel: HARI BATIK nasional', '2025-11-17 20:12:34', '2025-11-17 20:12:34', '2025-11-17 20:12:34'),
(178, 2, 'Logout', '2025-11-17 20:12:54', '2025-11-17 20:12:54', '2025-11-17 20:12:54'),
(179, 1, 'Login', '2025-11-17 23:41:29', '2025-11-17 23:41:29', '2025-11-17 23:41:29'),
(180, 1, 'Logout', '2025-11-17 23:52:48', '2025-11-17 23:52:48', '2025-11-17 23:52:48'),
(181, 1, 'Login', '2025-11-18 17:53:16', '2025-11-18 17:53:16', '2025-11-18 17:53:16'),
(182, 1, 'Logout', '2025-11-18 18:23:52', '2025-11-18 18:23:52', '2025-11-18 18:23:52'),
(183, 11, 'Login', '2025-11-18 18:24:02', '2025-11-18 18:24:02', '2025-11-18 18:24:02'),
(184, 11, 'Membuat Artikel: yesssss', '2025-11-18 18:24:27', '2025-11-18 18:24:27', '2025-11-18 18:24:27'),
(185, 11, 'Logout', '2025-11-18 18:24:30', '2025-11-18 18:24:30', '2025-11-18 18:24:30'),
(186, 2, 'Login', '2025-11-18 18:24:39', '2025-11-18 18:24:39', '2025-11-18 18:24:39'),
(187, 2, 'Logout', '2025-11-18 18:24:44', '2025-11-18 18:24:44', '2025-11-18 18:24:44'),
(188, 11, 'Login', '2025-11-18 18:24:53', '2025-11-18 18:24:53', '2025-11-18 18:24:53'),
(189, 11, 'Submit Artikel untuk Verifikasi: yesssss', '2025-11-18 18:24:59', '2025-11-18 18:24:59', '2025-11-18 18:24:59'),
(190, 11, 'Logout', '2025-11-18 18:25:02', '2025-11-18 18:25:02', '2025-11-18 18:25:02'),
(191, 2, 'Login', '2025-11-18 18:25:10', '2025-11-18 18:25:10', '2025-11-18 18:25:10'),
(192, 2, 'Reject Artikel: yesssss - Alasan: kurang bagus', '2025-11-18 18:25:30', '2025-11-18 18:25:30', '2025-11-18 18:25:30'),
(193, 2, 'Logout', '2025-11-18 18:25:34', '2025-11-18 18:25:34', '2025-11-18 18:25:34'),
(194, 11, 'Login', '2025-11-18 18:25:44', '2025-11-18 18:25:44', '2025-11-18 18:25:44'),
(195, 11, 'Resubmit Artikel setelah Perbaikan: yesssss', '2025-11-18 18:35:56', '2025-11-18 18:35:56', '2025-11-18 18:35:56'),
(196, 11, 'Logout', '2025-11-18 19:10:26', '2025-11-18 19:10:26', '2025-11-18 19:10:26'),
(197, 1, 'Login', '2025-11-18 19:10:46', '2025-11-18 19:10:46', '2025-11-18 19:10:46'),
(198, 1, 'Logout', '2025-11-18 19:11:52', '2025-11-18 19:11:52', '2025-11-18 19:11:52'),
(199, 11, 'Login', '2025-11-18 19:12:00', '2025-11-18 19:12:00', '2025-11-18 19:12:00'),
(200, 11, 'Membuat Artikel: artikel', '2025-11-18 19:12:27', '2025-11-18 19:12:27', '2025-11-18 19:12:27'),
(201, 11, 'Submit Artikel untuk Verifikasi: artikel', '2025-11-18 19:12:34', '2025-11-18 19:12:34', '2025-11-18 19:12:34'),
(202, 11, 'Logout', '2025-11-18 19:12:38', '2025-11-18 19:12:38', '2025-11-18 19:12:38'),
(203, 2, 'Login', '2025-11-18 19:13:22', '2025-11-18 19:13:22', '2025-11-18 19:13:22'),
(204, 2, 'Reject Artikel: artikel - Alasan: kurang menarik', '2025-11-18 19:13:55', '2025-11-18 19:13:55', '2025-11-18 19:13:55'),
(205, 2, 'Logout', '2025-11-18 19:14:01', '2025-11-18 19:14:01', '2025-11-18 19:14:01'),
(206, 11, 'Login', '2025-11-18 19:14:11', '2025-11-18 19:14:11', '2025-11-18 19:14:11'),
(207, 11, 'Logout', '2025-11-18 19:40:41', '2025-11-18 19:40:41', '2025-11-18 19:40:41'),
(208, 1, 'Login', '2025-11-18 19:41:01', '2025-11-18 19:41:01', '2025-11-18 19:41:01'),
(209, 1, 'Login', '2025-11-18 22:57:47', '2025-11-18 22:57:47', '2025-11-18 22:57:47'),
(210, 1, 'Logout', '2025-11-18 22:57:55', '2025-11-18 22:57:55', '2025-11-18 22:57:55'),
(211, 12, 'Register', '2025-11-19 09:58:39', '2025-11-19 09:58:39', '2025-11-19 09:58:39'),
(212, 12, 'Membuat Artikel: Hari batik', '2025-11-19 09:59:27', '2025-11-19 09:59:27', '2025-11-19 09:59:27'),
(213, 12, 'Submit Artikel untuk Verifikasi: Hari batik', '2025-11-19 09:59:48', '2025-11-19 09:59:48', '2025-11-19 09:59:48'),
(214, 12, 'Logout', '2025-11-19 10:00:00', '2025-11-19 10:00:00', '2025-11-19 10:00:00'),
(215, 2, 'Login', '2025-11-19 10:00:08', '2025-11-19 10:00:08', '2025-11-19 10:00:08'),
(216, 2, 'ACC Artikel: yesssss', '2025-11-19 10:00:32', '2025-11-19 10:00:32', '2025-11-19 10:00:32'),
(217, 2, 'ACC Artikel: Hari batik', '2025-11-19 10:00:53', '2025-11-19 10:00:53', '2025-11-19 10:00:53'),
(218, 2, 'Logout', '2025-11-19 10:01:29', '2025-11-19 10:01:29', '2025-11-19 10:01:29'),
(219, 12, 'Login', '2025-11-19 10:01:40', '2025-11-19 10:01:40', '2025-11-19 10:01:40'),
(220, 12, 'Logout', '2025-11-19 10:01:57', '2025-11-19 10:01:57', '2025-11-19 10:01:57'),
(221, 1, 'Login', '2025-11-19 10:02:07', '2025-11-19 10:02:07', '2025-11-19 10:02:07'),
(222, 13, 'Register', '2025-11-19 18:06:56', '2025-11-19 18:06:56', '2025-11-19 18:06:56'),
(223, 14, 'Register', '2025-11-19 18:08:57', '2025-11-19 18:08:57', '2025-11-19 18:08:57'),
(224, 14, 'Membuat Artikel: JUARA FUTSAL', '2025-11-19 18:10:30', '2025-11-19 18:10:30', '2025-11-19 18:10:30'),
(225, 14, 'Submit Artikel untuk Verifikasi: JUARA FUTSAL', '2025-11-19 18:10:46', '2025-11-19 18:10:46', '2025-11-19 18:10:46'),
(226, 14, 'Logout', '2025-11-19 18:11:05', '2025-11-19 18:11:05', '2025-11-19 18:11:05'),
(227, 2, 'Login', '2025-11-19 18:11:15', '2025-11-19 18:11:15', '2025-11-19 18:11:15'),
(228, 2, 'Reject Artikel: JUARA FUTSAL - Alasan: kurang kece', '2025-11-19 18:12:26', '2025-11-19 18:12:26', '2025-11-19 18:12:26'),
(229, 2, 'Logout', '2025-11-19 18:12:35', '2025-11-19 18:12:35', '2025-11-19 18:12:35'),
(230, 14, 'Login', '2025-11-19 18:12:46', '2025-11-19 18:12:46', '2025-11-19 18:12:46'),
(231, 14, 'Update Artikel: JUARA FUTSAL', '2025-11-19 18:17:17', '2025-11-19 18:17:17', '2025-11-19 18:17:17'),
(232, 14, 'Submit Artikel untuk Verifikasi: JUARA FUTSAL', '2025-11-19 18:17:20', '2025-11-19 18:17:20', '2025-11-19 18:17:20'),
(233, 14, 'Logout', '2025-11-19 18:20:19', '2025-11-19 18:20:19', '2025-11-19 18:20:19'),
(234, 14, 'Login', '2025-11-19 18:20:27', '2025-11-19 18:20:27', '2025-11-19 18:20:27'),
(235, 14, 'Logout', '2025-11-19 18:20:35', '2025-11-19 18:20:35', '2025-11-19 18:20:35'),
(236, 2, 'Login', '2025-11-19 18:20:48', '2025-11-19 18:20:48', '2025-11-19 18:20:48'),
(237, 2, 'ACC Artikel: JUARA FUTSAL', '2025-11-19 18:21:04', '2025-11-19 18:21:04', '2025-11-19 18:21:04'),
(238, 2, 'Logout', '2025-11-19 18:21:25', '2025-11-19 18:21:25', '2025-11-19 18:21:25'),
(239, 1, 'Login', '2025-11-19 18:21:34', '2025-11-19 18:21:34', '2025-11-19 18:21:34'),
(240, 1, 'Like Artikel: JUARA FUTSAL', '2025-11-19 19:22:15', '2025-11-19 19:22:15', '2025-11-19 19:22:15'),
(241, 1, 'Logout', '2025-11-19 19:22:22', '2025-11-19 19:22:22', '2025-11-19 19:22:22'),
(242, 14, 'Login', '2025-11-19 23:07:48', '2025-11-19 23:07:48', '2025-11-19 23:07:48'),
(243, 14, 'Logout', '2025-11-19 23:08:03', '2025-11-19 23:08:03', '2025-11-19 23:08:03'),
(244, 2, 'Login', '2025-11-19 23:08:12', '2025-11-19 23:08:12', '2025-11-19 23:08:12'),
(245, 2, 'Logout', '2025-11-19 23:08:18', '2025-11-19 23:08:18', '2025-11-19 23:08:18'),
(246, 11, 'Login', '2025-11-20 00:49:00', '2025-11-20 00:49:00', '2025-11-20 00:49:00'),
(247, 11, 'Membuat Artikel: porak', '2025-11-20 00:49:46', '2025-11-20 00:49:46', '2025-11-20 00:49:46'),
(248, 11, 'Submit Artikel untuk Verifikasi: porak', '2025-11-20 00:50:00', '2025-11-20 00:50:00', '2025-11-20 00:50:00'),
(249, 11, 'Logout', '2025-11-20 00:50:09', '2025-11-20 00:50:09', '2025-11-20 00:50:09'),
(250, 2, 'Login', '2025-11-20 00:50:18', '2025-11-20 00:50:18', '2025-11-20 00:50:18'),
(251, 2, 'ACC Artikel: porak', '2025-11-20 00:50:50', '2025-11-20 00:50:50', '2025-11-20 00:50:50'),
(252, 2, 'Logout', '2025-11-20 00:51:00', '2025-11-20 00:51:00', '2025-11-20 00:51:00'),
(253, 11, 'Login', '2025-11-20 00:51:10', '2025-11-20 00:51:10', '2025-11-20 00:51:10'),
(254, 11, 'Logout', '2025-11-20 00:51:25', '2025-11-20 00:51:25', '2025-11-20 00:51:25'),
(255, 11, 'Login', '2025-11-20 00:51:37', '2025-11-20 00:51:37', '2025-11-20 00:51:37'),
(256, 11, 'Logout', '2025-11-20 00:51:51', '2025-11-20 00:51:51', '2025-11-20 00:51:51'),
(257, 1, 'Login', '2025-11-20 00:52:01', '2025-11-20 00:52:01', '2025-11-20 00:52:01'),
(258, 1, 'Logout', '2025-11-20 00:53:50', '2025-11-20 00:53:50', '2025-11-20 00:53:50'),
(259, 11, 'Login', '2025-11-20 00:54:00', '2025-11-20 00:54:00', '2025-11-20 00:54:00'),
(260, 11, 'Logout', '2025-11-20 00:54:07', '2025-11-20 00:54:07', '2025-11-20 00:54:07'),
(261, 11, 'Login', '2025-11-20 00:54:59', '2025-11-20 00:54:59', '2025-11-20 00:54:59'),
(262, 11, 'Like Artikel: JUARA FUTSAL', '2025-11-20 00:55:21', '2025-11-20 00:55:21', '2025-11-20 00:55:21'),
(263, 11, 'Unlike Artikel: JUARA FUTSAL', '2025-11-20 00:55:22', '2025-11-20 00:55:22', '2025-11-20 00:55:22'),
(264, 11, 'Like Artikel: JUARA FUTSAL', '2025-11-20 00:55:23', '2025-11-20 00:55:23', '2025-11-20 00:55:23'),
(265, 11, 'Komentar Artikel: JUARA FUTSAL', '2025-11-20 00:55:30', '2025-11-20 00:55:30', '2025-11-20 00:55:30'),
(266, 9, 'Login', '2025-11-20 20:08:19', '2025-11-20 20:08:19', '2025-11-20 20:08:19'),
(267, 9, 'Submit Artikel untuk Verifikasi: bbbb', '2025-11-20 20:09:18', '2025-11-20 20:09:18', '2025-11-20 20:09:18'),
(268, 9, 'Logout', '2025-11-20 20:09:28', '2025-11-20 20:09:28', '2025-11-20 20:09:28'),
(269, 2, 'Login', '2025-11-20 20:09:47', '2025-11-20 20:09:47', '2025-11-20 20:09:47'),
(270, 2, 'Logout', '2025-11-20 20:10:41', '2025-11-20 20:10:41', '2025-11-20 20:10:41'),
(271, 1, 'Login', '2025-11-20 20:10:51', '2025-11-20 20:10:51', '2025-11-20 20:10:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_10_062300_create_kategori_table', 1),
(5, '2025_11_10_062301_create_artikels_table', 1),
(6, '2025_11_10_062301_create_likes_table', 1),
(7, '2025_11_10_062301_create_log_aktivitas_table', 1),
(8, '2025_11_10_070740_komentar', 1),
(9, '2025_11_11_000003_create_sessions_table', 2),
(10, '2025_11_14_063907_create_notifikasis_table', 3),
(11, '2025_11_19_011020_add_alasan_penolakan_to_artikels_table', 4),
(12, '2025_11_19_173339_create_guest_likes_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id_notifikasi` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_artikel` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `tipe` enum('approved','rejected') NOT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `notifikasis`
--

INSERT INTO `notifikasis` (`id_notifikasi`, `id_user`, `id_artikel`, `judul`, `pesan`, `tipe`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 9, 10, 'Artikel Disetujui', 'Artikel \"PORAK\" telah disetujui dan dipublikasikan.', 'approved', 1, '2025-11-13 23:48:50', '2025-11-13 23:49:13'),
(3, 9, 12, 'Artikel Ditolak', 'Artikel \"bbbb\" ditolak. Silakan periksa dan perbaiki artikel Anda.', 'rejected', 0, '2025-11-17 19:08:55', '2025-11-17 19:08:55'),
(4, 11, 13, 'Artikel Disetujui', 'Artikel \"HARI BATIK nasional\" telah disetujui dan dipublikasikan.', 'approved', 1, '2025-11-17 20:12:34', '2025-11-18 18:25:56'),
(5, 11, 14, 'Artikel Ditolak', 'Artikel \"yesssss\" ditolak. Alasan: kurang bagus', 'rejected', 1, '2025-11-18 18:25:30', '2025-11-18 18:25:55'),
(6, 11, 15, 'Artikel Ditolak', 'Artikel \"artikel\" ditolak. Alasan: kurang menarik', 'rejected', 0, '2025-11-18 19:13:55', '2025-11-18 19:13:55'),
(7, 11, 14, 'Artikel Disetujui', 'Artikel \"yesssss\" telah disetujui dan dipublikasikan.', 'approved', 0, '2025-11-19 10:00:32', '2025-11-19 10:00:32'),
(8, 12, 16, 'Artikel Disetujui', 'Artikel \"Hari batik\" telah disetujui dan dipublikasikan.', 'approved', 1, '2025-11-19 10:00:53', '2025-11-19 10:01:49'),
(9, 14, 17, 'Artikel Ditolak', 'Artikel \"JUARA FUTSAL\" ditolak. Alasan: kurang kece', 'rejected', 0, '2025-11-19 18:12:26', '2025-11-19 18:12:26'),
(10, 14, 17, 'Artikel Disetujui', 'Artikel \"JUARA FUTSAL\" telah disetujui dan dipublikasikan.', 'approved', 0, '2025-11-19 18:21:04', '2025-11-19 18:21:04'),
(11, 11, 18, 'Artikel Disetujui', 'Artikel \"porak\" telah disetujui dan dipublikasikan.', 'approved', 0, '2025-11-20 00:50:50', '2025-11-20 00:50:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9VKQyinWcJBpmXdLxsxkRVJrnzpiVvEmkw0UWNrC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUY4a2J5TWZsNVQ0QnlueWNkQnZtWHF0R2pMZXF5T0RTUDhCTjVIMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1763694727),
('wB7n5F5S3Qw7hbUX2PyBEkGUMsk8F31c4M7E10HZ', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN0I1enhiV1hmVUNOMmZjTjhoSXllZWxlSnJCV0NrTnJ0YzlMNEZoYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN3YS9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTt9', 1763625337);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `kelas`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pa ijal', 'admin', '$2y$12$5vxjNWvViN7EZJy8FqzcMeC93PmiZFhE6vK40lnXAPf05yUgwxAGG', 'admin', NULL, NULL, '2025-11-10 18:06:07', '2025-11-16 18:44:32'),
(2, 'Bu ajeng', 'guru', '$2y$12$eN8j4EabaNTqN22JG5Jxme4h8v98Q.rpaSFqTjHSba40rFPra55Wa', 'guru', NULL, NULL, '2025-11-10 18:06:07', '2025-11-16 18:44:15'),
(3, 'Azka', 'azka', '$2y$12$e2jtjKC1IlZL.vuE5rOdW.0pFPn71F8EQl0/3bthwiV5YtScM9Z72', 'siswa', NULL, NULL, '2025-11-10 18:06:07', '2025-11-16 18:44:55'),
(9, 'budi', 'budi', '$2y$12$mg2O3thD3f2h3ASXhAEJDOjiC89Z87f7f.KLTSiIrfTbGYEz2hxU2', 'siswa', 'XII RPL 1', NULL, '2025-11-11 18:24:55', '2025-11-11 18:24:55'),
(11, 'billy bagus', 'billy', '$2y$12$.t8dYN99PvhKKr6.BTNiCeOHyQ7yDJ4PgoEKAIHeBdFyl4EmNumZC', 'siswa', 'XII RPL 1', NULL, '2025-11-17 20:10:38', '2025-11-17 20:10:38'),
(12, 'udep', 'depdep', '$2y$12$huNQNZ.ClIX1GlA656BLLeuHJM6BZEHaBQ/VNxky6A1lEwPA.bu/y', 'siswa', 'XII DKV', NULL, '2025-11-19 09:58:39', '2025-11-19 09:58:39'),
(13, 'aldy taufik', 'aldy', '$2y$12$e8syFEZRWcFeY9k2Ed/7lO6066LYqiWUoKPQCxFO8vctgi0zVXoou', 'siswa', 'XII ANIMASI', NULL, '2025-11-19 18:06:56', '2025-11-19 18:06:56'),
(14, 'alya najla', 'alya', '$2y$12$8A5HxPnRTxfccd13MRuHxuF1RbceiW48sAqeRklR.eNeniqsz6aT2', 'siswa', 'XII ANIMASI', NULL, '2025-11-19 18:08:57', '2025-11-19 18:08:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `artikels_id_user_foreign` (`id_user`),
  ADD KEY `artikels_id_kategori_foreign` (`id_kategori`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `komentars_id_artikel_foreign` (`id_artikel`),
  ADD KEY `komentars_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD UNIQUE KEY `likes_id_artikel_id_user_unique` (`id_artikel`,`id_user`),
  ADD KEY `likes_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `log_aktivitas_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `notifikasis_id_user_foreign` (`id_user`),
  ADD KEY `notifikasis_id_artikel_foreign` (`id_artikel`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id_artikel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id_komentar` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id_notifikasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikels`
--
ALTER TABLE `artikels`
  ADD CONSTRAINT `artikels_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `artikels_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD CONSTRAINT `komentars_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `artikels` (`id_artikel`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentars_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `artikels` (`id_artikel`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `artikels` (`id_artikel`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
