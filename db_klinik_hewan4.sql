-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 10:17 AM
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
-- Database: `db_klinik_hewan4`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `tgl_booking` date NOT NULL,
  `id_pemilik` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `kode_booking`, `tgl_booking`, `id_pemilik`, `status`) VALUES
(1, 'B-20231014001', '2023-10-14', 'P-002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_obat`
--

CREATE TABLE `detail_obat` (
  `id` int(20) NOT NULL,
  `kode_rm` varchar(255) NOT NULL,
  `id_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `qty` int(20) NOT NULL,
  `harga_obat` int(20) NOT NULL,
  `subtotal` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_obat`
--

INSERT INTO `detail_obat` (`id`, `kode_rm`, `id_obat`, `nama_obat`, `qty`, `harga_obat`, `subtotal`) VALUES
(1, 'RM-202310210004', 'O-001', 'Vaksin Hewan', 1, 200000, NULL),
(2, 'RM-202310210004', 'O-002', 'Obat rabies', 1, 150000, NULL),
(3, 'RM-202310210005', 'O-002', 'Obat rabies', 2, 150000, NULL),
(4, 'RM-202310210005', 'O-001', 'Vaksin Hewan', 2, 200000, NULL),
(5, 'RM-202310220006', 'O-001', 'Vaksin Hewan', 2, 200000, 400000),
(6, 'RM-202310220006', 'O-002', 'Obat rabies', 1, 150000, 150000),
(7, 'RM-202310220007', 'O-002', 'Obat rabies', 1, 150000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `id_dokter` varchar(50) DEFAULT NULL,
  `id_user` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `no_telp` int(15) NOT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `id_dokter`, `id_user`, `nama_lengkap`, `no_telp`, `jenis_kelamin`, `alamat`) VALUES
(1, 'D-001', 'U-002', 'andriansyah', 621122330, 'L', 'Jaktim');

-- --------------------------------------------------------

--
-- Table structure for table `dropdown`
--

CREATE TABLE `dropdown` (
  `id` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dropdown`
--

INSERT INTO `dropdown` (`id`, `deskripsi`, `jenis`) VALUES
(1, 'Anjing', 'spesies'),
(2, 'Kucing', 'spesies'),
(3, 'Domestik', 'ras'),
(4, 'Anggora', 'spesies');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `id_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(20) NOT NULL,
  `tgl_expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `id_obat`, `nama_obat`, `harga`, `stok`, `tgl_expired`) VALUES
(1, 'O-001', 'Vaksin Hewan', 200000, 5, '2025-10-01'),
(2, 'O-002', 'Obat rabies', 150000, 5, '2027-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` int(11) NOT NULL,
  `id_pemilik` varchar(50) NOT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `is_register` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `id_pemilik`, `id_user`, `nama_lengkap`, `no_telp`, `alamat`, `is_register`, `created_at`) VALUES
(1, 'P-001', 'U-001', 'renald', '620099887766', 'jatim', 1, '2023-10-11 02:59:42'),
(3, 'P-002', 'U-003', 'Dede Sumantri', '6287877472553', 'bekasi ya', 1, '2023-10-12 09:58:09'),
(4, 'P-003', 'U-004', 'mutiara', '6200998877', 'bekasi juga ya', 1, '2023-10-12 09:59:27'),
(5, 'P-004', 'U-005', 'aziaz', '623322112233', 'jl belut ', 1, '2023-10-12 10:07:54'),
(6, 'P-005', 'U-006', 'mutiaa', '6298765432', 'jl belut 3', 1, '2023-10-12 10:08:54'),
(7, 'P-006', 'U-007', 'caca', '622232322322', 'sleman', 1, '2023-10-25 07:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `id_pendaftaran` varchar(50) NOT NULL,
  `nama_peliharaan` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `id_spesies` varchar(50) NOT NULL,
  `id_ras` varchar(50) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `postur` varchar(50) NOT NULL,
  `id_pemilik` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_pendaftaran`, `nama_peliharaan`, `tgl_lahir`, `jenis_kelamin`, `id_spesies`, `id_ras`, `warna`, `postur`, `id_pemilik`, `created_at`) VALUES
(1, 'RGST202310120001', 'TAHUUU', '2021-01-01', 'j', 'Kucing 2', 'Domestik', 'Putih', 'Kurus', 'P-002', '2023-10-12 12:22:28'),
(2, 'RGST202310250002', 'keong', '2023-10-25', 'b', 'Kucing 3', 'Anggora', 'lurus', 'gemoy', 'P-005', '2023-10-25 03:20:09'),
(3, 'RGST202310250003', 'muti', '2023-10-25', 'j', 'SP-001', 'R-001', 'lurus', 'gemuk', 'P-003', '2023-10-25 03:51:14'),
(4, 'RGST202310250004', 're', '2023-10-25', 'b', 'SP-001', 'R-001', 're', 're', 'P-005', '2023-10-25 06:20:21'),
(5, 'RGST202310250005', 'coba1', '2023-10-25', 'b', 'SP-001', 'R-002', 'lurus', 'langsing', 'P-002', '2023-10-25 06:22:40'),
(7, 'RGST202310250006', 'tes', '2023-10-25', 'j', 'SP-003', 'R-003', 'rtet', 'tere', 'P-003', '2023-10-25 07:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `ras`
--

CREATE TABLE `ras` (
  `id_ras` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ras`
--

INSERT INTO `ras` (`id_ras`, `deskripsi`) VALUES
('R-001', 'Domestik'),
('R-002', 'Anggora'),
('R-003', 'main coon');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` int(11) NOT NULL,
  `id_rekam_medis` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_pemilik` varchar(50) DEFAULT NULL,
  `nama_peliharaan` varchar(50) DEFAULT NULL,
  `id_dokter` varchar(50) DEFAULT NULL,
  `temperatur_rektal` varchar(50) DEFAULT NULL,
  `frekuensi_pulsus` varchar(50) DEFAULT NULL,
  `frekuensi_nafas` varchar(50) DEFAULT NULL,
  `berat_badan` varchar(50) DEFAULT NULL,
  `kondisi_umum` varchar(50) DEFAULT NULL,
  `kulit_bulu` varchar(50) DEFAULT NULL,
  `membran_mukosa` varchar(50) DEFAULT NULL,
  `kelenjar_limfa` varchar(50) DEFAULT NULL,
  `muskuloskeletal` varchar(50) DEFAULT NULL,
  `sistem_sirkulasi` varchar(50) DEFAULT NULL,
  `sistem_respirasi` varchar(50) DEFAULT NULL,
  `sistem_digesti` varchar(50) DEFAULT NULL,
  `sistem_urogenital` varchar(50) DEFAULT NULL,
  `sistem_saraf` varchar(50) DEFAULT NULL,
  `mata_telinga` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `kode_booking` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `id_rekam_medis`, `tanggal`, `id_pemilik`, `nama_peliharaan`, `id_dokter`, `temperatur_rektal`, `frekuensi_pulsus`, `frekuensi_nafas`, `berat_badan`, `kondisi_umum`, `kulit_bulu`, `membran_mukosa`, `kelenjar_limfa`, `muskuloskeletal`, `sistem_sirkulasi`, `sistem_respirasi`, `sistem_digesti`, `sistem_urogenital`, `sistem_saraf`, `mata_telinga`, `status`, `kode_booking`) VALUES
(1, 'RM-202310130001', '2023-10-13', 'P-002', 'TAHUUU', 'D-001', '100', '0', '0', '0', '0', '0', '0', '50', '50', '50', '0', '0', '0', '0', '0', 1, ''),
(4, 'RM-202310130002', '2023-10-13', 'P-002', 'TAHUUU', 'D-001', '10', '0', '0', '5', '5', '0', '0', '1', '1', '10', '0', '0', '0', '0', '10', 1, ''),
(5, 'RM-202310140003', '2023-10-14', 'P-002', 'TAHUUU', 'D-001', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 1, 'B-20231014001'),
(6, 'RM-202310210004', '2023-10-21', 'P-002', 'TAHUUU', 'D-001', '0', '0', '0', '0', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 1, ''),
(7, 'RM-202310210005', '2023-10-21', 'P-002', 'TAHUUU', 'D-001', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100', '0', '0', '0', '0', '100', 1, ''),
(8, 'RM-202310220006', '2023-10-22', 'P-002', 'TAHUUU', 'D-001', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '100', 1, ''),
(9, 'RM-202310220007', '2023-10-22', 'P-002', 'TAHUUU', 'D-001', '0', '0', '0', '0', '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis_detail`
--

CREATE TABLE `rekam_medis_detail` (
  `id` int(11) NOT NULL,
  `id_rekam_medis` varchar(255) DEFAULT NULL,
  `nama_hewan` varchar(50) DEFAULT NULL,
  `keluhan` varchar(50) DEFAULT NULL,
  `diagnosa` varchar(50) DEFAULT NULL,
  `suhu` varchar(50) DEFAULT NULL,
  `berat_badan` varchar(50) DEFAULT NULL,
  `hasil_pemeriksaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `spesies`
--

CREATE TABLE `spesies` (
  `id_spesies` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `spesies`
--

INSERT INTO `spesies` (`id_spesies`, `deskripsi`) VALUES
('SP-001', 'Anjing'),
('SP-002', 'Kucing 2'),
('SP-003', 'Kucing 3');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_rm` varchar(255) NOT NULL,
  `id_trx` varchar(255) NOT NULL,
  `tgl_trx` date NOT NULL,
  `id_customer` varchar(50) NOT NULL,
  `id_dokter` varchar(50) NOT NULL,
  `jasa_dokter` int(20) NOT NULL,
  `total_transaksi` int(20) NOT NULL,
  `grand_total` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_rm`, `id_trx`, `tgl_trx`, `id_customer`, `id_dokter`, `jasa_dokter`, `total_transaksi`, `grand_total`, `status`) VALUES
(1, 'RM-202310130002', 'TRX-20231013001', '2023-10-13', 'P-002', 'D-001', 150000, 200000, 350000, 0),
(2, 'RM-202310140003', 'TRX-20231014002', '2023-10-14', 'P-002', 'D-001', 150000, 200000, 350000, 0),
(3, 'RM-202310210004', 'TRX-20231021001', '2023-10-21', 'P-002', 'D-001', 150000, 200000, 350000, 1),
(4, 'RM-202310210005', 'TRX-20231021002', '2023-10-21', 'P-002', 'D-001', 150000, 200000, 350000, 0),
(5, 'RM-202310220006', 'TRX-20231022003', '2023-10-22', 'P-002', 'D-001', 150000, 550000, 700000, 1),
(6, 'RM-202310220007', 'TRX-20231022004', '2023-10-22', 'P-002', 'D-001', 150000, 150000, 300000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user`, `username`, `password`, `role_name`, `img`) VALUES
(1, 'U-001', 'admin', '$2y$10$oyE7yUiDKeqL/yTvfgCnxuej6vKTHnKnOFZevqlGX/egwnVTlI20e', 'admin', NULL),
(2, 'U-002', 'andriansyah', '$2y$10$ROMMyb3q2COVRWu.Qd0aHuJqHV0x4omlyUWpmrhP84tlJ7RihhOS2', 'dokter', '1697885304_16b61d4f8f2278cf37a2.png'),
(3, 'U-003', 'demantri', '$2y$10$aUeyouwXxFxNqLYVIMgK7OnS09hd/cr5hqPEy/ADgf.EHhtLj3C2S', 'customer', NULL),
(4, 'U-004', 'mrampasyi', '$2y$10$kGXzzcciHK38a.UBp/G3CeNFfBIKDqyuS7hoB2wceStFEP9LZP.zi', 'customer', NULL),
(5, 'U-005', 'kasir', '$2y$10$Nzd6ojbQeG79mm6NKvE6/edAPQv0yP4l1MutqvZOhSfAzIUmwYk6C', 'kasir', NULL),
(6, 'U-006', 'mutia', '$2y$10$QhTgkHlyVgK2H98TLwcx8e3iTVoNefuwjikaB5HredEsEYf9x1EIC', 'customer', NULL),
(8, 'U-007', 'caca', '$2y$10$t0bNjYM0fg5cY3FIdbXBC.hjgmgL0CQKogQXrQ.07oPosAHn7BYxG', 'customer', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dropdown`
--
ALTER TABLE `dropdown`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ras`
--
ALTER TABLE `ras`
  ADD PRIMARY KEY (`id_ras`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis_detail`
--
ALTER TABLE `rekam_medis_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `spesies`
--
ALTER TABLE `spesies`
  ADD PRIMARY KEY (`id_spesies`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dropdown`
--
ALTER TABLE `dropdown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rekam_medis_detail`
--
ALTER TABLE `rekam_medis_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
