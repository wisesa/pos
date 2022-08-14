-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 07:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(2, 'Advance'),
(4, 'Desktop'),
(3, 'Lifestyle'),
(1, 'Repo');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` varchar(12) NOT NULL,
  `id_supplier` varchar(12) NOT NULL,
  `created_on` datetime NOT NULL,
  `batal` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_supplier`, `created_on`, `batal`) VALUES
('2GC6FB70BB4J', '18', '2022-08-14 10:02:53', 0),
('3Y5QOYJLAH7P', '20', '2022-08-14 13:55:27', 0),
('7095T9F8MUDC', '22', '2022-08-14 17:10:49', 0),
('98BG54YQB8DZ', '20', '2022-08-14 17:09:45', 0),
('9Z1902B440XG', '20', '2022-08-14 17:09:33', 0),
('AD87S08B0ZWE', '18', '2022-08-14 17:11:07', 0),
('B378T5218A8M', '20', '2022-08-14 13:55:20', 0),
('B8QZX59EVG26', '21', '2022-08-14 10:30:23', 0),
('BDF9HH9LPJ8M', '22', '2022-08-14 13:55:31', 0),
('CUVRAQXCACBC', '22', '2022-08-14 17:10:53', 0),
('D5X16FLP0YE9', '18', '2022-08-14 17:09:37', 0),
('K2PHUDF11NAD', '21', '2022-08-14 17:11:12', 0),
('QE8VHJ8E9KAU', '21', '2022-08-14 17:09:41', 0),
('U137C9VML485', '22', '2022-08-14 17:09:51', 0),
('VI802GBF20D1', '22', '2022-08-14 10:15:17', 1),
('X731KABAR86E', '22', '2022-08-14 17:10:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelian` varchar(12) NOT NULL,
  `id_produk` varchar(12) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian`, `id_produk`, `harga`, `jumlah`) VALUES
('2GC6FB70BB4J', '1J8DRUUEW34P', 2000000, 1),
('3Y5QOYJLAH7P', '2RAE7A5ZEAO7', 10000, 1),
('7095T9F8MUDC', '1ZJ6DIL7997M', 3000000, 1),
('98BG54YQB8DZ', '2RAE7A5ZEAO7', 10000, 1),
('9Z1902B440XG', 'FN0DKO9EFCUA', 1000000, 1),
('AD87S08B0ZWE', '1J8DRUUEW34P', 2000000, 1),
('B378T5218A8M', '1J8DRUUEW34P', 2000000, 1),
('B8QZX59EVG26', '2RAE7A5ZEAO7', 10000, 1),
('BDF9HH9LPJ8M', '1J8DRUUEW34P', 2000000, 1),
('CUVRAQXCACBC', 'FN0DKO9EFCUA', 1000000, 1),
('D5X16FLP0YE9', '1J8DRUUEW34P', 2000000, 1),
('K2PHUDF11NAD', '1ZJ6DIL7997M', 3000000, 1),
('QE8VHJ8E9KAU', '1ZJ6DIL7997M', 3000000, 1),
('U137C9VML485', 'FN0DKO9EFCUA', 1000000, 1),
('VI802GBF20D1', 'FN0DKO9EFCUA', 1000000, 1),
('X731KABAR86E', 'FN0DKO9EFCUA', 1000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` varchar(12) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_pelanggan`, `created_on`) VALUES
('3B0DV3A3LYGC', 16, '2022-08-14 12:21:09'),
('51GHF9YC9D23', 16, '2022-08-14 12:21:05'),
('62DE5BFEUBTC', 16, '2022-08-14 12:21:01'),
('A4E2XFW1FOI1', 2, '2022-08-14 11:39:52'),
('BV8C396ERG0Z', 16, '2022-08-14 12:20:57'),
('CYCB0RV5LDZO', 2, '2022-08-14 12:20:05'),
('F1C0QCU5339N', 2, '2022-08-14 11:32:28'),
('MD56DGBZDT34', 2, '2022-08-14 12:20:36'),
('RB0YCE3HKCJH', 2, '2022-08-14 12:20:42'),
('Z22P7H1KNWYA', 2, '2022-08-14 11:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualan` varchar(12) NOT NULL,
  `id_produk` varchar(12) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualan`, `id_produk`, `harga`, `jumlah`) VALUES
('F1C0QCU5339N', '1ZJ6DIL7997M', 3500000, 1),
('A4E2XFW1FOI1', 'FN0DKO9EFCUA', 1500000, 1),
('Z22P7H1KNWYA', '1J8DRUUEW34P', 2500000, 1),
('CYCB0RV5LDZO', '1ZJ6DIL7997M', 3500000, 1),
('MD56DGBZDT34', '1J8DRUUEW34P', 2500000, 1),
('RB0YCE3HKCJH', '1J8DRUUEW34P', 2500000, 1),
('BV8C396ERG0Z', '1J8DRUUEW34P', 2500000, 1),
('62DE5BFEUBTC', 'FN0DKO9EFCUA', 1500000, 1),
('51GHF9YC9D23', 'FN0DKO9EFCUA', 1500000, 1),
('3B0DV3A3LYGC', '2RAE7A5ZEAO7', 150000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` varchar(12) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `gambar` varchar(300) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga_beli`, `harga_jual`, `deskripsi`, `id_kategori`, `gambar`, `aktif`) VALUES
('1J8DRUUEW34P', 'Paket Desktop', 2000000, 2500000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra eros ac enim posuere, a sagittis ante finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam ante augue, tristique eget libero vel, sagittis sollicitudin risus. Aenean finibus lectus lectus, in lobortis libero semper et.</p>', 4, 'paket-desktop.png', 1),
('1ZJ6DIL7997M', 'Paket Lifestyle', 3000000, 3500000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra eros ac enim posuere, a sagittis ante finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam ante augue, tristique eget libero vel, sagittis sollicitudin risus. Aenean finibus lectus lectus, in lobortis libero semper et.</p>', 4, 'paket-lifestyle.png', 1),
('2RAE7A5ZEAO7', 'Standard Repo', 10000, 150000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra eros ac enim posuere, a sagittis ante finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam ante augue, tristique eget libero vel, sagittis sollicitudin risus. Aenean finibus lectus lectus, in lobortis libero semper et.</p>', 1, 'standard_repo.png', 1),
('FN0DKO9EFCUA', 'Paket Advance', 1000000, 1500000, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam viverra eros ac enim posuere, a sagittis ante finibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam ante augue, tristique eget libero vel, sagittis sollicitudin risus. Aenean finibus lectus lectus, in lobortis libero semper et.</p>', 2, 'paket-advance.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `aktif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `kontak`, `type`, `aktif`) VALUES
(1, 'Administrator', 'admin@majoo.com', '202cb962ac59075b964b07152d234b70', '+6282133329323', 'administrator', 1),
(2, 'Bradika Almandin Wisesa', 'brad@majoo.com', '202cb962ac59075b964b07152d234b70', '+6281288342342', 'pelanggan', 1),
(16, 'Mikhaela', 'mikha@majoo.com', '202cb962ac59075b964b07152d234b70', '+628231332332', 'pelanggan', 1),
(18, 'PT. Bina Sarana Sukses', 'bss@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '+6281288342342', 'supplier', 1),
(19, 'Amir Otreya', 'amir@majoo.com', '202cb962ac59075b964b07152d234b70', '+628332421232', 'petugas', 1),
(20, 'PT. Makmur Sejahtera', 'makmur@majoo.com', 'd41d8cd98f00b204e9800998ecf8427e', '+62833412323124', 'supplier', 1),
(21, 'PT. Jaya Abadi', 'jaya@majoo.com', 'd41d8cd98f00b204e9800998ecf8427e', '+6233424222342', 'supplier', 1),
(22, 'PT. Adhya Tirta', 'adhya@majoo.com', '', '+62833412343', 'supplier', 1),
(23, 'Putri', 'putri@majoo.com', '202cb962ac59075b964b07152d234b70', '+6281244324242', 'petugas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
