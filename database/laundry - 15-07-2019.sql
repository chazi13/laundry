-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2019 at 06:23 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `jenis_kelamin`, `email`, `telp`, `password`, `level`) VALUES
('OP001', 'Administrator', 'L', 'admin@mukhlida.com', '0813241809', '451765da9503df97b15fbbb93824d044', 'Admin'),
('OP002', ' Operator 1', 'L', 'operator.1@mail.com', '0812310123', '095dddc811c74da40ce3670d57d461e7', 'Pegawai'),
('OP003', 'Operator 2', 'L', 'operator.2@mail.com', '081241282', '56cc622df4febe09747aa70795a3c4c7', 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `nama_produk`, `qty`, `harga`, `id_produk`, `kode_transaksi`) VALUES
(1, 'Dry Clean', 2, '20000.00', 2, 'TRX-POK694'),
(2, 'Kiloan', 2, '10000.00', 1, 'TRX-NMD212');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE IF NOT EXISTS `diskon` (
  `pemesanan` int(3) NOT NULL,
  `potongan` int(3) NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`pemesanan`, `potongan`, `updated_at`) VALUES
(15, 10, '2019-07-12 07:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `diskon_counter`
--

CREATE TABLE IF NOT EXISTS `diskon_counter` (
  `id_member` varchar(5) NOT NULL,
  `counter` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon_counter`
--

INSERT INTO `diskon_counter` (`id_member`, `counter`) VALUES
('MB001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `info_toko`
--

CREATE TABLE IF NOT EXISTS `info_toko` (
  `nama_toko` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `rek` varchar(20) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_toko`
--

INSERT INTO `info_toko` (`nama_toko`, `alamat`, `email`, `telp`, `fax`, `rek`, `facebook`, `twitter`, `instagram`) VALUES
('Mukhlida Laundry', 'Jl. Asal Muasal, No. 13, Hilir', 'info@mukhli.com', '08512141292', '021904184102', '', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `jenis_kelamin`, `telp`, `password`, `created_at`) VALUES
('MB001', 'Sumarti Nur Khalisa', 'Jl. Khayalan, No. 13, Kota Baru', 'P', '0815832039', 'd3becf804a80fa4831800c2d2b444c8f', '2019-07-11 04:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `icon`, `harga`, `satuan`) VALUES
(1, 'Kiloan', 'assets/img/produk/1562904601-kiloan.png', '10000.00', 'Kg'),
(2, 'Dry Clean', 'assets/img/produk/dry-clean.png', '20000.00', 'Potong'),
(3, 'Setrika Kiloan', 'assets/img/produk/1562980859setrika-kiloan.png', '5000.00', 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `kode_transaksi` varchar(10) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pemesan` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `logistik` enum('Diantar','Ambil Sendiri') NOT NULL DEFAULT 'Ambil Sendiri',
  `diskon` int(2) NOT NULL DEFAULT '0',
  `total` decimal(10,2) NOT NULL,
  `tunai` decimal(10,2) NOT NULL,
  `status` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0 - menunggu, 1 - dikerjakan, 2 - selesai dikerjakan, 3 - dikirim, 4 - selesai',
  `id_member` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tgl_transaksi`, `pemesan`, `telp`, `alamat`, `logistik`, `diskon`, `total`, `tunai`, `status`, `id_member`) VALUES
('TRX-NMD212', '2019-07-13 10:27:52', 'Sumarti Nur Khalisa', '0815832039', 'Jl. Khayalan, No. 13, Kota Baru', 'Ambil Sendiri', 0, '20000.00', '20000.00', '4', 'MB001'),
('TRX-POK694', '2019-07-13 09:52:34', 'Cholil Al-Ghazali', '081592181211', 'Jl. Keemasan, No. 10, Kel. Perak, Kec. Perunggu', 'Diantar', 0, '49000.00', '50000.00', '3', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `diskon_counter`
--
ALTER TABLE `diskon_counter`
  ADD UNIQUE KEY `id_member` (`id_member`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
