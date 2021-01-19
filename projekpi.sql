-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Jan 2021 pada 14.22
-- Versi server: 8.0.21
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekpi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angkutan`
--

CREATE TABLE `angkutan` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `angkutan` enum('Angkutan Dinas','Angkutan Pribadi','Angkutan Umum','Angkutan Sewa') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` enum('Roda Dua','Roda Empat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plat` text COLLATE utf8mb4_unicode_ci,
  `angkutan_umum` enum('Pesawat','Kereta','Kapal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sewa` enum('Roda Enam/Bus Besar','Roda Enam/Bus Sedang','Roda Empat/Bus Mini','Roda Empat','Roda Dua') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bbsppd`
--

CREATE TABLE `bbsppd` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `skpd` text COLLATE utf8mb4_unicode_ci,
  `program` text COLLATE utf8mb4_unicode_ci,
  `kegiatan` text COLLATE utf8mb4_unicode_ci,
  `rekening` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_bidang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(1, 'Perencanaan Sumber Daya Air', '2021-01-07 12:38:12', '2021-01-07 12:38:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dasar`
--

CREATE TABLE `dasar` (
  `id` bigint UNSIGNED NOT NULL,
  `dasar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dasar_surat`
--

CREATE TABLE `dasar_surat` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `dasar_surat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `eselon`
--

CREATE TABLE `eselon` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama_eselon` enum('Eselon II','Eselon III','PJFT Gol IV/c','Eselon IV','PJFT Gol IV/b','PJFT Gol IV/a','PJFT Gol III','Staf Gol IV/III','Staf Gol II/I','PTT S2/S3','PTT S1','PTT D3','PTT D1/SMK','PTT SMA','PTT SMP/SD') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `eselon`
--

INSERT INTO `eselon` (`id`, `user_id`, `nama_eselon`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2021-01-07 12:38:09', '2021-01-07 12:38:09'),
(2, 2, NULL, '2021-01-07 12:38:10', '2021-01-07 12:38:10'),
(3, 3, NULL, '2021-01-07 12:38:10', '2021-01-07 12:38:10'),
(4, 4, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11'),
(5, 5, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `golongan` enum('PTT SMA/SMP/SD','PTT D1/SMK','PTT D3','PTT S1','PTT S2/S3','Juru Muda (I/a)','Juru Muda Tingkat I (I/b)','Juru (I/c)','Juru Tingkat I (I/d)','Pengatur Muda (II/a)','Pengatur Muda Tingkat I (II/b)','Pengatur (II/c)','Pengatur Tingkat I (II/d)','Penata Muda (III/a)','Penata Muda Tingkat I (III/b)','Penata (III/c)','Penata Tingkat I (III/d)','Pembina (IV/a)','Pembina Tingkat I (IV/b)','Pembina Utama Muda (IV/c)','Pembina Utama Madya (IV/d)','Pembina Utama (IV/e)') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id`, `user_id`, `golongan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2021-01-07 12:38:09', '2021-01-07 12:38:09'),
(2, 2, NULL, '2021-01-07 12:38:09', '2021-01-07 12:38:09'),
(3, 3, NULL, '2021-01-07 12:38:10', '2021-01-07 12:38:10'),
(4, 4, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11'),
(5, 5, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `user_id`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2021-01-07 12:38:08', '2021-01-07 12:38:08'),
(2, 2, NULL, '2021-01-07 12:38:09', '2021-01-07 12:38:09'),
(3, 3, NULL, '2021-01-07 12:38:10', '2021-01-07 12:38:10'),
(4, 4, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11'),
(5, 5, NULL, '2021-01-07 12:38:11', '2021-01-07 12:38:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabid`
--

CREATE TABLE `kabid` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `nama_kabid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint UNSIGNED NOT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keterangan`
--

CREATE TABLE `keterangan` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `petunjuk` text COLLATE utf8mb4_unicode_ci,
  `masalah` text COLLATE utf8mb4_unicode_ci,
  `saran` text COLLATE utf8mb4_unicode_ci,
  `lain_lain` text COLLATE utf8mb4_unicode_ci,
  `tglcetak` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(28, '2020_07_04_134418_create_users_table', 1),
(29, '2020_07_07_040836_create_jabatan_table', 1),
(30, '2020_07_07_142217_create_golongan_table', 1),
(31, '2020_07_08_151425_create_nosurat_table', 1),
(32, '2020_07_09_210357_create_dasar_table', 1),
(33, '2020_07_10_082311_create_sppd_table', 1),
(34, '2020_07_11_153111_create_sppd_users_table', 1),
(35, '2020_07_11_160421_create_tempat_table', 1),
(36, '2020_07_11_225317_create_dasar_surat_table', 1),
(37, '2020_07_13_074653_create_kabid_table', 1),
(38, '2020_07_16_102548_create_bidang_table', 1),
(39, '2020_07_17_034654_create_eselon_table', 1),
(40, '2020_07_20_060803_create_angkutan_table', 1),
(41, '2020_07_22_035321_create_keterangan_table', 1),
(42, '2020_07_23_031958_create_skpd_table', 1),
(43, '2020_07_23_165835_create_program_table', 1),
(44, '2020_07_23_173013_create_kegiatan_table', 1),
(45, '2020_07_23_180044_create_rekening_table', 1),
(46, '2020_07_23_211139_create_bbsppd_table', 1),
(47, '2020_08_19_044036_create_rincian_table', 1),
(48, '2020_09_02_074104_create_laporans_table', 1),
(49, '2020_09_03_132045_create_uang_harians_table', 1),
(50, '2020_09_11_084622_create_rincian_l2s_table', 1),
(51, '2020_09_22_111846_create_tgl_surats_table', 1),
(52, '2020_09_22_133450_create_tgl_surat_kwitansis_table', 1),
(53, '2020_10_30_063634_create_tanggalkwitansi_table', 1),
(54, '2020_10_31_090448_create_tanggalrincian_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `no_surat`
--

CREATE TABLE `no_surat` (
  `id` int UNSIGNED NOT NULL,
  `no_surat` int UNSIGNED NOT NULL DEFAULT '1',
  `tahun_surat` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `no_surat`
--

INSERT INTO `no_surat` (`id`, `no_surat`, `tahun_surat`, `created_at`, `updated_at`) VALUES
(1, 1, 2020, '2021-01-07 12:38:12', '2021-01-07 12:38:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id` bigint UNSIGNED NOT NULL,
  `program` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id` bigint UNSIGNED NOT NULL,
  `rekening` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian`
--

CREATE TABLE `rincian` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `kegunaan_biaya` text COLLATE utf8mb4_unicode_ci,
  `jumlah_per_hari` bigint DEFAULT NULL,
  `tanggal_penggunaan` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian_l2s`
--

CREATE TABLE `rincian_l2s` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `berangkat_dari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiba_di` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `tanggal_tiba` date NOT NULL,
  `kepala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `skpd`
--

CREATE TABLE `skpd` (
  `id` bigint UNSIGNED NOT NULL,
  `skpd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppd`
--

CREATE TABLE `sppd` (
  `id` int UNSIGNED NOT NULL,
  `no_surat` int UNSIGNED NOT NULL,
  `tahun_surat` year NOT NULL,
  `tgl_surat` date NOT NULL DEFAULT '2021-01-07',
  `tgl_pergi` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `acara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sppd_users`
--

CREATE TABLE `sppd_users` (
  `sppd_id` int UNSIGNED NOT NULL,
  `users_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggalkwitansi`
--

CREATE TABLE `tanggalkwitansi` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `tglyangmenerima` text COLLATE utf8mb4_unicode_ci,
  `tglbendahara` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggalrincian`
--

CREATE TABLE `tanggalrincian` (
  `id` int UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `tgltelahmenerima` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat`
--

CREATE TABLE `tempat` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `tempat_berangkat` enum('Surabaya','Gresik','Sidoarjo','Mojokerto','Jombang','Bojonegoro','Lamongan','Tuban','Madiun','Ngawi','Magetan','Ponorogo','Pacitan','Kediri','Nganjuk','Tulungagung','Blitar','Trenggalek','Malang','Pasuruan','Probolinggo','Lumajang','Bondowoso','Situbondo','Jember','Banyuwangi','Bangkalan','Sampang','Pamekasan','Sumenep','Batu','Aceh','Sumatera Utara','Riau','Kep. Riau','Jambi','Sumatera Barat','Sumatera Selatan','Lampung','Bengkulu','Bangka Belitung','Banten','Jawa Barat','D.K.I Jakarta','Jawa Tengah','D.I Jogjakarta','Jawa Timur','Bali','Nusa Tenggara Barat','Nusa Tenggara Timur','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Barat','Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_tujuan` enum('Surabaya','Gresik','Sidoarjo','Mojokerto','Jombang','Bojonegoro','Lamongan','Tuban','Madiun','Ngawi','Magetan','Ponorogo','Pacitan','Kediri','Nganjuk','Tulungagung','Blitar','Trenggalek','Malang','Pasuruan','Probolinggo','Lumajang','Bondowoso','Situbondo','Jember','Banyuwangi','Bangkalan','Sampang','Pamekasan','Sumenep','Batu','Aceh','Sumatera Utara','Riau','Kep. Riau','Jambi','Sumatera Barat','Sumatera Selatan','Lampung','Bengkulu','Bangka Belitung','Banten','Jawa Barat','D.K.I Jakarta','Jawa Tengah','D.I Jogjakarta','Jawa Timur','Bali','Nusa Tenggara Barat','Nusa Tenggara Timur','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Barat','Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgl_surats`
--

CREATE TABLE `tgl_surats` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `tanggal_surat_rincian` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgl_surat_kwitansis`
--

CREATE TABLE `tgl_surat_kwitansis` (
  `id` bigint UNSIGNED NOT NULL,
  `sppd_id` int UNSIGNED NOT NULL,
  `tanggal_surat_kwitansi` date DEFAULT NULL,
  `tempat_surat_kwitansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_harians`
--

CREATE TABLE `uang_harians` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_harian` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `uang_harians`
--

INSERT INTO `uang_harians` (`id`, `nama`, `role`, `uang_harian`, `created_at`, `updated_at`) VALUES
(1, 'Nama Admin', 'Admin', 100000, '2021-01-07 12:38:12', '2021-01-07 12:38:12'),
(2, 'Nama Kepala Bidang', 'Kepala Bidang', 500000, '2021-01-07 12:38:12', '2021-01-07 12:38:12'),
(3, 'Nama Staff', 'Staff', 400000, '2021-01-07 12:38:13', '2021-01-07 12:38:13'),
(4, 'Nama Kepala Seksi', 'Kepala Seksi', 300000, '2021-01-07 12:38:13', '2021-01-07 12:38:13'),
(5, 'Nama Sekretaris Bidang', 'Sekretaris Bidang', 350000, '2021-01-07 12:38:13', '2021-01-07 12:38:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `role` enum('Admin','Kepala Bidang','Kepala Seksi','Staff','Sekretaris Bidang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `cek` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `nama`, `password`, `alamat`, `tanggal_lahir`, `role`, `cek`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1000000000', 'Nama Admin', '$2y$10$KSzlD3ouj3kL.g60C4s.k.71xpLsK1rZ6061yLeYSOgT6E45DpjHe', NULL, NULL, 'Admin', 0, NULL, '2021-01-07 12:38:06', '2021-01-07 12:38:06'),
(2, '2000000000', 'Nama Kepala Bidang', '$2y$10$q33CSzpb14HG9uW1IgVv3Ol1CfWaGpVa8fdKyyRxH14oYDPGXUz0a', NULL, NULL, 'Kepala Bidang', 1, NULL, '2021-01-07 12:38:07', '2021-01-07 12:38:07'),
(3, '3000000000', 'Nama Kepala Seksi', '$2y$10$5xXK5XtFs/ahFgDVb5sk6.dsJhR1PK8BHtPPyoo5e86xSND9pDdrG', NULL, NULL, 'Kepala Seksi', 1, NULL, '2021-01-07 12:38:07', '2021-01-07 12:38:07'),
(4, '4000000000', 'Nama Staff', '$2y$10$otZ3QFI/3CQnZoq07wHW9OTvUFGfx.9pOKHRKOUjv/GG52QoUcbxS', NULL, NULL, 'Staff', 1, NULL, '2021-01-07 12:38:07', '2021-01-07 12:38:07'),
(5, '5000000000', 'Nama Sekretaris Bidang', '$2y$10$RN/VYffXgSqPstjI3dAZdeWstFjTMymO.5oPSMp81C55r52DLnz1C', NULL, NULL, 'Sekretaris Bidang', 1, NULL, '2021-01-07 12:38:07', '2021-01-07 12:38:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angkutan`
--
ALTER TABLE `angkutan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `angkutan_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `bbsppd`
--
ALTER TABLE `bbsppd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bbsppd_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dasar`
--
ALTER TABLE `dasar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dasar_surat`
--
ALTER TABLE `dasar_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dasar_surat_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `eselon`
--
ALTER TABLE `eselon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eselon_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `golongan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `kabid`
--
ALTER TABLE `kabid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kabid_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keterangan_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `no_surat`
--
ALTER TABLE `no_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rincian`
--
ALTER TABLE `rincian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rincian_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `rincian_l2s`
--
ALTER TABLE `rincian_l2s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rincian_l2s_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `skpd`
--
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sppd_users`
--
ALTER TABLE `sppd_users`
  ADD PRIMARY KEY (`sppd_id`,`users_id`),
  ADD KEY `sppd_users_users_id_foreign` (`users_id`);

--
-- Indeks untuk tabel `tanggalkwitansi`
--
ALTER TABLE `tanggalkwitansi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanggalkwitansi_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `tanggalrincian`
--
ALTER TABLE `tanggalrincian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanggalrincian_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tempat_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `tgl_surats`
--
ALTER TABLE `tgl_surats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tgl_surats_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `tgl_surat_kwitansis`
--
ALTER TABLE `tgl_surat_kwitansis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tgl_surat_kwitansis_sppd_id_foreign` (`sppd_id`);

--
-- Indeks untuk tabel `uang_harians`
--
ALTER TABLE `uang_harians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angkutan`
--
ALTER TABLE `angkutan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bbsppd`
--
ALTER TABLE `bbsppd`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dasar`
--
ALTER TABLE `dasar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `dasar_surat`
--
ALTER TABLE `dasar_surat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `eselon`
--
ALTER TABLE `eselon`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kabid`
--
ALTER TABLE `kabid`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `no_surat`
--
ALTER TABLE `no_surat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rincian`
--
ALTER TABLE `rincian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rincian_l2s`
--
ALTER TABLE `rincian_l2s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `skpd`
--
ALTER TABLE `skpd`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sppd`
--
ALTER TABLE `sppd`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tanggalkwitansi`
--
ALTER TABLE `tanggalkwitansi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tanggalrincian`
--
ALTER TABLE `tanggalrincian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tgl_surats`
--
ALTER TABLE `tgl_surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tgl_surat_kwitansis`
--
ALTER TABLE `tgl_surat_kwitansis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uang_harians`
--
ALTER TABLE `uang_harians`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angkutan`
--
ALTER TABLE `angkutan`
  ADD CONSTRAINT `angkutan_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bbsppd`
--
ALTER TABLE `bbsppd`
  ADD CONSTRAINT `bbsppd_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dasar_surat`
--
ALTER TABLE `dasar_surat`
  ADD CONSTRAINT `dasar_surat_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`);

--
-- Ketidakleluasaan untuk tabel `eselon`
--
ALTER TABLE `eselon`
  ADD CONSTRAINT `eselon_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD CONSTRAINT `golongan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kabid`
--
ALTER TABLE `kabid`
  ADD CONSTRAINT `kabid_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keterangan`
--
ALTER TABLE `keterangan`
  ADD CONSTRAINT `keterangan_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rincian`
--
ALTER TABLE `rincian`
  ADD CONSTRAINT `rincian_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rincian_l2s`
--
ALTER TABLE `rincian_l2s`
  ADD CONSTRAINT `rincian_l2s_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sppd_users`
--
ALTER TABLE `sppd_users`
  ADD CONSTRAINT `sppd_users_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sppd_users_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggalkwitansi`
--
ALTER TABLE `tanggalkwitansi`
  ADD CONSTRAINT `tanggalkwitansi_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggalrincian`
--
ALTER TABLE `tanggalrincian`
  ADD CONSTRAINT `tanggalrincian_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tempat`
--
ALTER TABLE `tempat`
  ADD CONSTRAINT `tempat_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tgl_surats`
--
ALTER TABLE `tgl_surats`
  ADD CONSTRAINT `tgl_surats_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tgl_surat_kwitansis`
--
ALTER TABLE `tgl_surat_kwitansis`
  ADD CONSTRAINT `tgl_surat_kwitansis_sppd_id_foreign` FOREIGN KEY (`sppd_id`) REFERENCES `sppd` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
