-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2019 at 03:19 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `awk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500'),
(2, 'eva', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE IF NOT EXISTS `harga` (
  `harga_per_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`harga_per_jam`) VALUES
(90000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
`pelanggan_id` int(8) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(8) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_hp` varchar(20) NOT NULL,
  `pelanggan_alamat` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `username`, `password`, `pelanggan_nama`, `pelanggan_hp`, `pelanggan_alamat`) VALUES
(1, 'revo', '12345678', 'revo', '12345', 'jl.megatruh'),
(3, 'alina', '1111', 'alin', '12345', 'jl.megatruh');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`transaksi_id` int(11) NOT NULL,
  `transaksi_jam_pemesanan` datetime NOT NULL,
  `transaksi_tgl` date NOT NULL,
  `transaksi_pelanggan` varchar(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `transaksi_harga` int(11) NOT NULL,
  `transaksi_durasi` int(11) NOT NULL,
  `transaksi_jam_selesai` time NOT NULL,
  `transaksi_status` int(11) NOT NULL,
  `transaksi_lap` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_jam_pemesanan`, `transaksi_tgl`, `transaksi_pelanggan`, `jam_mulai`, `transaksi_harga`, `transaksi_durasi`, `transaksi_jam_selesai`, `transaksi_status`, `transaksi_lap`) VALUES
(36, '2019-07-27 23:44:10', '2019-07-13', 'revo', '00:00:00', 180000, 2, '02:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
 ADD PRIMARY KEY (`pelanggan_id`), ADD UNIQUE KEY `pelanggan_nama` (`pelanggan_nama`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`transaksi_id`), ADD UNIQUE KEY `jam_mulai` (`jam_mulai`), ADD UNIQUE KEY `transaksi_jam_selesai` (`transaksi_jam_selesai`), ADD KEY `transaksi_status` (`transaksi_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
MODIFY `pelanggan_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
