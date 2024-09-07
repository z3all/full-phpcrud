-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 04:25 PM
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
-- Database: `php-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `username`, `email`, `password`, `level`) VALUES
(6, 'ZEALL', 'sandi', 'sandi@email.com', '$2y$10$geC6D3W/053WVMqYcxWF4.joe5Y5ksAmVOaV9QAI/8kDemIteme.y', '1'),
(7, 'Operator Barang', 'opmbarang', 'opbarang123@gmail.com', '$2y$10$1XxDaJs7lIfxiwTnSR/69.CfeKcR/oFMwqROgbUMv1SA3WZ/urnXO', '2'),
(8, 'Operator Siswa', 'opmsiswa', 'opsiswa123@gmail.com', '$2y$10$Uoya7hLfxCWlwSKoJyL8GeWbeokIpGSUNRJghdCg9r8Wlor156frC', '3');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jumlah`, `harga`, `barcode`, `tanggal`) VALUES
(11, 'Laptop', '15', '10000000', '9739', '2024-09-04 22:32:01'),
(12, 'PC ', '5', '20000000', '655041', '2024-09-04 22:37:11'),
(13, 'Headset', '20', '50000', '133577', '2024-09-05 06:01:45'),
(14, 'iphone 15 pro max', '5', '25000000', '251350', '2024-09-05 06:03:09'),
(15, 'Kursi Gaming Titan', '50', '7000000', '408792', '2024-09-05 07:01:19'),
(17, 'Laptop TUF Gaming', '5', '15000000', '456265', '2024-09-06 23:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `jabatan`, `email`, `telepon`, `alamat`) VALUES
(1, 'Drs.Yog', 'Direktur ', 'yog52@gmail.com', '08262573211', 'Krian,Sidoarjoe'),
(2, 'Fendi', 'Wakil Direktur', 'fend32@gmail.com', '0872528291', 'Krian,Sidoarjo'),
(3, 'Syifa', 'Sekretaris', 'syif@gmail.com', '03739367983', 'Tempel,Sidorejo');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama`, `prodi`, `jk`, `telepon`, `alamat`, `email`, `foto`) VALUES
(11, 'Fendi', 'Teknik Komputer', 'Laki-Laki', '081293129', '<p><i>Samben,Junwangi, <strong>16829</strong></i></p>', 'fendi@gmail.com', '66d9133d13bc7.jpeg'),
(14, 'Abell', 'Teknik Listrik', 'Perempuan', '084273426172', '<p><i>Krian,SedenganMijen <strong>199990</strong></i></p>', 'bel00@gmail.com', '66d912d58195d.jpg'),
(16, 'gilang', 'Teknik Mesin', 'Laki-Laki', '0815171816513', '<p><i>Kenep,Junwangi, <strong>172729</strong></i></p>', 'gilang@gmail.com', '66d912fe6fc59.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
