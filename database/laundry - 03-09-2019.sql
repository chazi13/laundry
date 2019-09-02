-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2019 at 06:42 PM
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
('OP002', ' Operator 1', 'L', 'operator.1@mail.com', '081231012321', '6ebbdc9b5f63b4fa8ce2221a2dc00986', 'Pegawai'),
('OP003', 'Operator 2', 'L', 'operator.2@mail.com', '081241282920', '830cee9a8ce338f53d8459e9c589d9e8', 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE IF NOT EXISTS `coa` (
  `no_coa` int(11) NOT NULL,
  `nama_coa` varchar(50) NOT NULL,
  `gol` char(1) NOT NULL,
  `klasifikasi` int(1) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`no_coa`, `nama_coa`, `gol`, `klasifikasi`, `saldo`) VALUES
(11101, 'Kas', 'D', 1, 4400000),
(11103, 'Tabungan Bank BCA', 'D', 1, 4000),
(11104, 'Tabungan Bank', 'D', 1, 155500),
(11105, 'Tabungan Bank BNI', 'D', 1, 4000),
(11222, 'Inventaris', 'D', 1, 100500),
(21101, 'Hutang', 'C', 2, 120000),
(24440, 'Modal', 'C', 3, 3000000),
(41101, 'Pendapatan Usaha', 'C', 4, 13000000),
(51101, 'Beban Usaha', 'D', 5, 110000),
(51102, 'Beban Hidup', 'D', 5, 10700000),
(51103, 'Beban Listrik', 'D', 5, 589000),
(51104, 'Beban Telepon', 'D', 5, 0),
(51105, 'Beban Bangunan', 'D', 5, 57000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga` float NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_transaksi` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `nama_produk`, `qty`, `harga`, `id_produk`, `kode_transaksi`) VALUES
(1, 'Kiloan', 1, 10000, 1, 'TRS-00001'),
(2, 'Dry Clean', 1, 20000, 2, 'TRS-00002'),
(3, 'Kiloan', 2, 10000, 1, 'TRS-00003'),
(4, 'Kiloan', 1, 10000, 1, 'TRS-00004'),
(5, 'Dry Clean', 2, 20000, 2, 'TRS-00005'),
(6, 'Dry Clean', 1, 20000, 2, 'TRS-00006'),
(7, 'Kiloan', 2, 10000, 1, 'TRS-00007'),
(8, 'Kiloan', 2, 10000, 1, 'TRS-00008'),
(9, 'Dry Clean', 1, 20000, 2, 'TRS-00008'),
(10, 'Kiloan', 2, 10000, 1, 'TRS-00009'),
(11, 'Setrika Kiloan', 2, 5000, 3, 'TRS-00010'),
(12, 'Kiloan', 2, 10000, 1, 'TRS-00010'),
(13, 'Dry Clean', 2, 20000, 2, 'TRS-00011'),
(14, 'Setrika Kiloan', 1, 5000, 3, 'TRS-00011'),
(15, 'Kiloan', 2, 10000, 1, 'TRS-00012'),
(16, 'Kiloan', 2, 10000, 1, 'TRS-00013'),
(17, 'Dry Clean', 1, 20000, 2, 'TRS-00014'),
(20, 'Kiloan', 2, 10000, 1, 'TRS-00015'),
(21, 'Kiloan', 1, 10000, 1, 'TRS-00016'),
(22, 'Dry Clean', 1, 20000, 2, 'TRS-00016'),
(23, 'Kiloan', 3, 10000, 1, 'TRS-00017'),
(24, 'Dry Clean', 2, 20000, 2, 'TRS-00018');

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
(1, 10, '2019-08-24 17:31:29');

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
('MB001', 2),
('MB002', 3),
('MB003', 3),
('MB004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `info_toko`
--

CREATE TABLE IF NOT EXISTS `info_toko` (
  `nama_toko` varchar(50) NOT NULL,
  `tentang` text NOT NULL,
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

INSERT INTO `info_toko` (`nama_toko`, `tentang`, `alamat`, `email`, `telp`, `fax`, `rek`, `facebook`, `twitter`, `instagram`) VALUES
('Mukhlida Laundry', '<div class="row">\r\n<div class="col-sm-12 col-md-6"><img src="http://localhost/project/laundry/assets/vendor/source/Screenshot%20(1).png" alt="" width="100%" /></div>\r\n<div class="col-sm-12 col-md-6">\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, quasi quia a, nesciunt iure asperiores odit obcaecati repellendus impedit non autem laudantium itaque quis consequatur fuga reiciendis, optio dolores quidem!</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, quis totam? Sint, ullam dolore officia, distinctio possimus quidem tenetur tempora alias fugiat dicta doloribus fugit est aliquam maiores totam vel!</p>\r\n</div>\r\n</div>', 'Jl. Suci, Gg. Makmur, No. 19, Kel. Susukan, Kec. Ciracas, Jakarta Timur, 13750', 'info@mukhlidalaundry.com', '08512141292', '021904184102', '', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `kode_jurnal` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `saldo` float NOT NULL,
  `coa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`kode_jurnal`, `tanggal`, `saldo`, `coa_id`) VALUES
('JNL-00001', '2019-08-25', 4400000, 11101);

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE IF NOT EXISTS `klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `nama_klasifikasi` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`) VALUES
(1, 'Aktiva'),
(2, 'Pasiva'),
(3, 'Modal'),
(4, 'Pendapatan'),
(5, 'Beban');

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE IF NOT EXISTS `log_transaksi` (
  `id_log` int(11) NOT NULL,
  `pegawai` varchar(50) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kode_transaksi` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_transaksi`
--

INSERT INTO `log_transaksi` (`id_log`, `pegawai`, `status`, `timestamp`, `kode_transaksi`) VALUES
(1, ' Operator 1', 0, '2019-01-01 13:32:45', 'TRS-00001'),
(2, ' Operator 1', 0, '2019-01-02 01:19:52', 'TRS-00002'),
(3, ' Operator 1', 1, '2019-01-02 01:23:15', 'TRS-00001'),
(4, ' Operator 1', 1, '2019-01-02 01:23:24', 'TRS-00002'),
(5, ' Operator 1', 2, '2019-01-02 03:23:39', 'TRS-00001'),
(6, ' Operator 1', 2, '2019-01-02 03:23:40', 'TRS-00002'),
(7, ' Operator 1', 3, '2019-01-02 04:00:23', 'TRS-00002'),
(8, ' Operator 1', 4, '2019-01-02 05:38:31', 'TRS-00001'),
(9, ' Operator 1', 4, '2019-01-02 05:38:33', 'TRS-00002'),
(10, ' Operator 1', 0, '2019-02-01 02:41:04', 'TRS-00003'),
(11, ' Operator 1', 0, '2019-02-01 02:42:55', 'TRS-00004'),
(12, ' Operator 1', 1, '2019-02-01 04:43:27', 'TRS-00003'),
(13, ' Operator 1', 1, '2019-02-01 04:43:30', 'TRS-00004'),
(14, ' Operator 1', 2, '2019-02-01 07:43:39', 'TRS-00003'),
(15, ' Operator 1', 2, '2019-02-01 07:43:42', 'TRS-00004'),
(16, ' Operator 1', 4, '2019-02-01 07:43:43', 'TRS-00004'),
(17, ' Operator 1', 4, '2019-02-01 07:43:45', 'TRS-00003'),
(18, 'Operator 2', 0, '2019-03-15 07:45:44', 'TRS-00005'),
(19, 'Operator 2', 0, '2019-03-15 07:46:15', 'TRS-00006'),
(20, 'Operator 2', 0, '2019-03-15 07:47:28', 'TRS-00007'),
(21, 'Operator 2', 1, '2019-03-16 01:48:00', 'TRS-00005'),
(22, 'Operator 2', 1, '2019-03-16 01:48:02', 'TRS-00006'),
(23, 'Operator 2', 1, '2019-03-16 01:48:04', 'TRS-00007'),
(24, 'Operator 2', 2, '2019-03-16 03:48:18', 'TRS-00005'),
(25, 'Operator 2', 2, '2019-03-16 03:48:20', 'TRS-00006'),
(26, 'Operator 2', 2, '2019-03-16 03:48:21', 'TRS-00007'),
(27, 'Operator 2', 3, '2019-03-16 03:48:26', 'TRS-00005'),
(28, 'Operator 2', 3, '2019-03-16 03:48:28', 'TRS-00006'),
(29, 'Operator 2', 4, '2019-03-16 05:48:38', 'TRS-00005'),
(30, 'Operator 2', 4, '2019-03-16 05:48:39', 'TRS-00006'),
(31, 'Operator 2', 4, '2019-03-16 05:48:41', 'TRS-00007'),
(32, 'Operator 2', 0, '2019-04-16 05:49:58', 'TRS-00008'),
(33, 'Operator 2', 1, '2019-04-16 08:50:21', 'TRS-00008'),
(34, 'Operator 2', 2, '2019-04-16 11:50:32', 'TRS-00008'),
(35, 'Operator 2', 4, '2019-04-16 11:50:34', 'TRS-00008'),
(36, 'Operator 2', 0, '2019-05-10 01:51:16', 'TRS-00009'),
(37, 'Operator 2', 0, '2019-05-10 01:51:53', 'TRS-00010'),
(38, 'Operator 2', 1, '2019-05-10 02:00:12', 'TRS-00009'),
(39, 'Operator 2', 1, '2019-05-10 02:00:15', 'TRS-00010'),
(40, 'Operator 2', 2, '2019-05-10 05:00:21', 'TRS-00009'),
(41, 'Operator 2', 2, '2019-05-10 05:00:23', 'TRS-00010'),
(42, 'Operator 2', 4, '2019-05-10 06:00:30', 'TRS-00009'),
(43, 'Operator 2', 4, '2019-05-10 06:00:31', 'TRS-00010'),
(44, ' Operator 1', 0, '2019-07-21 14:41:28', 'TRS-00011'),
(45, ' Operator 1', 0, '2019-07-21 14:42:34', 'TRS-00012'),
(46, ' Operator 1', 0, '2019-07-21 14:43:02', 'TRS-00013'),
(47, ' Operator 1', 1, '2019-07-21 01:43:46', 'TRS-00011'),
(48, ' Operator 1', 1, '2019-07-21 01:43:48', 'TRS-00012'),
(49, ' Operator 1', 1, '2019-07-21 01:43:49', 'TRS-00013'),
(50, ' Operator 1', 2, '2019-07-21 05:43:56', 'TRS-00011'),
(51, ' Operator 1', 2, '2019-07-21 05:43:58', 'TRS-00012'),
(52, ' Operator 1', 2, '2019-07-21 05:43:59', 'TRS-00013'),
(53, ' Operator 1', 3, '2019-07-21 07:44:07', 'TRS-00011'),
(54, ' Operator 1', 3, '2019-07-21 07:44:09', 'TRS-00012'),
(55, ' Operator 1', 4, '2019-07-21 07:44:10', 'TRS-00013'),
(56, ' Operator 1', 4, '2019-07-21 07:44:12', 'TRS-00012'),
(57, ' Operator 1', 4, '2019-07-21 07:44:13', 'TRS-00011'),
(58, ' Operator 1', 0, '2019-06-12 07:44:52', 'TRS-00014'),
(59, ' Operator 1', 1, '2019-06-12 07:45:05', 'TRS-00014'),
(60, ' Operator 1', 2, '2019-06-12 09:45:10', 'TRS-00014'),
(61, ' Operator 1', 4, '2019-06-12 10:45:16', 'TRS-00014'),
(63, ' Operator 1', 0, '2019-08-08 05:09:34', 'TRS-00015'),
(64, 'Administrator', 0, '2019-08-24 17:46:10', 'TRS-00016'),
(65, 'Administrator', 0, '2019-08-24 17:48:56', 'TRS-00017'),
(66, 'Administrator', 0, '2019-08-24 17:49:38', 'TRS-00018');

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
('MB001', 'Sumarti Nur Khalisa', 'Jl. Khayalan, No. 13, Kota Baru', 'P', '081583203940', 'ffd74476908bd23442afb580e8ad3d29', '2019-07-11 04:02:06'),
('MB002', 'Jason Mannes', 'Jl. Kenangan, No. 13, Kel. Masalalu, Kec. Indah', 'L', '0813157690', '473b527e51ae3e946255d486eafc9a58', '2019-07-21 13:18:21'),
('MB003', 'Sutirah Halima', 'Jl. Indah, No. 19, Kel. Masitu, Kec. Kalaitu', 'P', '0857809712', 'e005b6fdfc69761f9b83c540cf45820f', '2019-07-21 13:20:00'),
('MB004', 'Ahmad Khairul', 'Jl. Sukaria, No. 15, Kel. Sukasuka, Kec. Sukakamu', 'L', '08574292443', '0ac4b0bb1912052c283e1c22173cc410', '2019-07-21 14:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `harga` float NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `icon`, `harga`, `satuan`) VALUES
(1, 'Kiloan', 'assets/img/produk/1562904601-kiloan.png', 10000, 'Kg'),
(2, 'Dry Clean', 'assets/img/produk/dry-clean.png', 20000, 'Potong'),
(3, 'Setrika Kiloan', 'assets/img/produk/1562980859setrika-kiloan.png', 5000, 'Kg');

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
  `total` float NOT NULL,
  `tunai` float NOT NULL,
  `status` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0 - menunggu, 1 - dikerjakan, 2 - selesai dikerjakan, 3 - dikirim, 4 - selesai',
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_member` varchar(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tgl_transaksi`, `pemesan`, `telp`, `alamat`, `logistik`, `diskon`, `total`, `tunai`, `status`, `update_at`, `id_member`) VALUES
('TRS-00001', '2019-01-01 13:29:10', 'Sumarti Nur Khalisa', '081583203940', 'Jl. Khayalan, No. 13, Kota Baru', 'Ambil Sendiri', 0, 10000, 10000, '4', '2019-01-02 05:38:31', 'MB001'),
('TRS-00002', '2019-01-02 01:19:52', 'Jason Mannes', '0813157690', 'Jl. Kenangan, No. 13, Kel. Masalalu, Kec. Indah', 'Diantar', 0, 29000, 30000, '4', '2019-01-02 05:38:33', 'MB002'),
('TRS-00003', '2019-02-01 02:41:04', 'Nurhasanah', '081574237634', 'Jl. Pertiwi, No. 15, Susukan, Ciracas', 'Ambil Sendiri', 0, 20000, 20000, '4', '2019-02-01 07:43:45', '0'),
('TRS-00004', '2019-02-01 02:42:55', 'Sutirah Halima', '0857809712', 'Jl. Indah, No. 19, Kel. Masitu, Kec. Kalaitu', 'Ambil Sendiri', 0, 10000, 10000, '4', '2019-02-01 07:43:43', 'MB003'),
('TRS-00005', '2019-03-15 07:45:43', 'Cholil Ahmad', '0813907823', 'Jl. Rambutan, No. 24, Kel. Rambutan, Kec. Ciracas', 'Diantar', 0, 49000, 50000, '4', '2019-03-16 05:48:38', '0'),
('TRS-00006', '2019-03-15 07:46:15', 'Jason Mannes', '0813157690', 'Jl. Kenangan, No. 13, Kel. Masalalu, Kec. Indah', 'Diantar', 0, 29000, 30000, '4', '2019-03-16 05:48:39', 'MB002'),
('TRS-00007', '2019-03-15 07:47:27', 'Siti Nur Khalisa', '08159230234', 'Jl. Cipayung, No. 19, Kel. Sukasuka, Kec. Sukakamu', 'Ambil Sendiri', 0, 20000, 20000, '4', '2019-03-16 05:48:41', '0'),
('TRS-00008', '2019-04-16 05:49:58', 'Rizal Syakir', '8131093273', 'Jl. Pertiwi, No. 20, Kel, Susukan, Kec. Ciracas', 'Ambil Sendiri', 0, 40000, 40000, '4', '2019-04-16 11:50:34', '0'),
('TRS-00009', '2019-05-10 01:51:16', 'Sumarti Nur Khalisa', '081583203940', 'Jl. Khayalan, No. 13, Kota Baru', 'Ambil Sendiri', 0, 20000, 20000, '4', '2019-05-10 06:00:30', 'MB001'),
('TRS-00010', '2019-05-10 01:51:53', 'Sutirah Halima', '0857809712', 'Jl. Indah, No. 19, Kel. Masitu, Kec. Kalaitu', 'Ambil Sendiri', 0, 30000, 30000, '4', '2019-05-10 06:00:31', 'MB003'),
('TRS-00011', '2019-07-21 14:41:28', 'Ahmad Khairul', '08574292443', 'Jl. Sukaria, No. 15, Kel. Sukasuka, Kec. Sukakamu', 'Diantar', 0, 54000, 55000, '4', '2019-07-21 07:44:13', 'MB004'),
('TRS-00012', '2019-07-21 14:42:34', 'Nur Khalisa Amara', '08139051292', 'Jl. Kembali, No. 29, Kel. Awal, Kec. Akhir', 'Diantar', 0, 29000, 30000, '4', '2019-07-21 07:44:12', '0'),
('TRS-00013', '2019-07-21 14:43:02', 'Sutirah Halima', '0857809712', 'Jl. Indah, No. 19, Kel. Masitu, Kec. Kalaitu', 'Ambil Sendiri', 0, 20000, 20000, '4', '2019-07-21 07:44:10', 'MB003'),
('TRS-00014', '2019-06-12 07:44:52', 'Jason Mannes', '0813157690', 'Jl. Kenangan, No. 13, Kel. Masalalu, Kec. Indah', 'Ambil Sendiri', 0, 20000, 20000, '4', '2019-06-12 10:45:16', 'MB002'),
('TRS-00015', '2019-08-08 05:09:33', 'Alfred', '08235090930', 'Jl. Rindau, Riau', 'Diantar', 0, 29000, 30000, '0', '2019-08-08 05:09:33', '0'),
('TRS-00016', '2019-08-24 17:46:10', 'Ahmad Khairul', '08574292443', 'Jl. Sukaria, No. 15, Kel. Sukasuka, Kec. Sukakamu', 'Diantar', 10, 39000, 50000, '0', '2019-08-24 17:46:10', 'MB004'),
('TRS-00017', '2019-08-24 17:48:56', 'Sutirah Halima', '0857809712', 'Jl. Indah, No. 19, Kel. Masitu, Kec. Kalaitu', 'Ambil Sendiri', 10, 3000, 50000, '0', '2019-08-24 17:48:56', 'MB003'),
('TRS-00018', '2019-08-24 17:49:38', 'Jason Mannes', '0813157690', 'Jl. Kenangan, No. 13, Kel. Masalalu, Kec. Indah', 'Diantar', 10, 44100, 50000, '0', '2019-08-24 17:49:38', 'MB002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`no_coa`);

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
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`kode_jurnal`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id_log`);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
