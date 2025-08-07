-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2025 at 12:26 AM
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
-- Database: `hypercare`
--

-- --------------------------------------------------------

--
-- Table structure for table `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `id_pengetahuan` bigint(20) UNSIGNED NOT NULL,
  `id_penyakit` bigint(20) UNSIGNED DEFAULT NULL,
  `id_gejala` bigint(20) UNSIGNED DEFAULT NULL,
  `cf_pakar` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_penyakit`, `id_gejala`, `cf_pakar`) VALUES
(13, 1, 3, 0.90),
(14, 1, 4, 0.70),
(15, 2, 3, 0.80),
(16, 2, 5, 0.60),
(17, 3, 6, 0.85),
(18, 3, 7, 0.70),
(19, 4, 5, 0.90),
(20, 4, 8, 0.80),
(21, 6, 3, 0.75),
(22, 6, 9, 0.65);

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `id_detail_konsultasi` bigint(10) NOT NULL,
  `id_konsultasi` bigint(10) UNSIGNED DEFAULT NULL,
  `id_gejala` bigint(10) UNSIGNED DEFAULT NULL,
  `cf_pasien` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` bigint(20) UNSIGNED NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(3, 'G001', 'Tekanan darah tinggi (≥140/90 mmHg)'),
(4, 'G002', 'Pembengkakan pada tangan, kaki, dan wajah'),
(5, 'G003', 'Sakit kepala hebat'),
(6, 'G004', 'Pandangan kabur atau sensitif terhadap cahaya'),
(7, 'G005', 'Nyeri di perut bagian atas (biasanya di bawah tulang rusuk)'),
(8, 'G006', 'Mual atau muntah yang tidak biasa'),
(9, 'G007', 'Penurunan frekuensi buang air kecil'),
(10, 'G008', 'Kenaikan berat badan secara mendadak'),
(11, 'G009', 'Kesulitan bernapas'),
(12, 'G010', 'Adanya protein dalam urin (proteinuria)'),
(13, 'G011', 'Muntah');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` bigint(20) UNSIGNED NOT NULL,
  `id_pasien` bigint(10) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hasil_diagnosa` varchar(100) DEFAULT NULL,
  `tingkat_keyakinan` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` bigint(20) UNSIGNED NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `usia` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` bigint(20) UNSIGNED NOT NULL,
  `kode_penyakit` varchar(10) NOT NULL,
  `nama_penyakit` varchar(255) NOT NULL,
  `penjelasan` text NOT NULL,
  `penanganan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`, `penjelasan`, `penanganan`) VALUES
(1, 'HPL001', 'Hipertensi Gestasional', 'Hipertensi yang terjadi selama kehamilan tanpa adanya protein dalam urin atau tanda-tanda kerusakan organ lain.', 'Pemantauan tekanan darah secara rutin, istirahat cukup, diet rendah garam, dan pengawasan ketat dari tenaga medis.'),
(2, 'HPL002', 'Preeklampsia Ringan', 'Tekanan darah tinggi disertai dengan proteinuria (protein dalam urin) dan pembengkakan ringan pada ibu hamil.', 'Observasi ketat, diet seimbang, istirahat, dan jika diperlukan, rawat inap.'),
(3, 'HPL003', 'Preeklampsia Berat', 'Kondisi serius dengan tekanan darah tinggi, proteinuria, dan tanda kerusakan organ (seperti gangguan penglihatan, nyeri kepala, atau nyeri di perut bagian atas).', 'Rawat inap, pemberian magnesium sulfat untuk mencegah kejang, dan kemungkinan persalinan dini.'),
(4, 'HPL004', 'Eklampsia', 'Komplikasi preeklampsia yang ditandai dengan kejang-kejang pada ibu hamil.', 'Tindakan gawat darurat: pemberian magnesium sulfat, kontrol tekanan darah, dan persalinan sesegera mungkin.'),
(5, 'HPL005', 'Hipertensi Kronik dalam Kehamilan', 'Hipertensi yang sudah ada sebelum kehamilan atau muncul sebelum usia kehamilan 20 minggu.', 'Pemberian obat antihipertensi yang aman untuk kehamilan, pemantauan fungsi ginjal dan janin.'),
(6, 'HPL006', 'Hipertensi Kronik dengan Preeklampsia Superimposed', 'Ibu dengan hipertensi kronik yang kemudian mengalami gejala preeklampsia.', 'Pemantauan intensif, pengobatan untuk tekanan darah dan pencegahan komplikasi, serta perencanaan persalinan.'),
(7, 'HPL007', 'HELLP Syndrome', 'Kondisi yang merupakan variasi dari preeklampsia berat, meliputi hemolisis, peningkatan enzim hati, dan trombosit rendah.', 'Rawat inap segera, stabilisasi kondisi ibu, dan biasanya persalinan darurat.'),
(8, 'HPL008', 'Hipertensi Sekunder dalam Kehamilan', 'Hipertensi akibat penyakit lain seperti penyakit ginjal atau gangguan endokrin yang muncul saat kehamilan.', 'Terapkan pengobatan sesuai penyebab utama, serta pemantauan kehamilan secara berkala.'),
(9, 'HPL009', 'Hipertensi Berat Akut dalam Kehamilan', 'Tekanan darah ≥160/110 mmHg yang memerlukan penanganan segera.', 'Pemberian obat penurun tekanan darah dengan cepat, observasi terus-menerus, dan evaluasi kondisi janin.'),
(10, 'HPL010', 'Hipertensi Induksi Obat atau Suplemen', 'Hipertensi yang muncul akibat konsumsi obat atau suplemen tertentu selama kehamilan.', 'Hentikan pemicu, evaluasi tekanan darah, dan pengawasan medis ketat.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 'admin123@gmail.com', 'admin', '2025-08-06 05:45:54', '$2y$10$nHhy5rQDAo8KXHH5I4SEC.fDj.9A4gCLJtyrb4YhaMNeMExbKcHxO', NULL, '2025-08-05 22:45:54', '2025-08-05 22:45:54'),
(3, 'Ahmad', 'petugas123@gmail.com', 'petugas', '2025-08-07 22:09:32', '$2y$10$kUVG.RstG8JAufydGzlKWuxlZ44TWlsdTfxAp/rglqpe810HFgGVy', NULL, '2025-08-07 15:09:32', '2025-08-07 15:09:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`id_pengetahuan`),
  ADD KEY `basis_pengetahuan_kd_penyakit_foreign` (`id_penyakit`),
  ADD KEY `basis_pengetahuan_kd_gejala_foreign` (`id_gejala`);

--
-- Indexes for table `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD PRIMARY KEY (`id_detail_konsultasi`),
  ADD KEY `id_konsultasi` (`id_konsultasi`,`id_gejala`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

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
-- AUTO_INCREMENT for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `id_pengetahuan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  MODIFY `id_detail_konsultasi` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD CONSTRAINT `basis_pengetahuan_kd_gejala_foreign` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`),
  ADD CONSTRAINT `basis_pengetahuan_kd_penyakit_foreign` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `detail_konsultasi`
--
ALTER TABLE `detail_konsultasi`
  ADD CONSTRAINT `detail_konsultasi_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_konsultasi_ibfk_2` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE SET NULL;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
