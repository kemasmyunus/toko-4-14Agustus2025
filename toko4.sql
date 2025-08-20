-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2025 at 05:46 AM
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
-- Database: `toko4`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `varian` varchar(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `harga_jual_default` decimal(10,0) NOT NULL,
  `sn` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `sku`, `nama_barang`, `varian`, `brand`, `kategori`, `harga_jual_default`, `sn`) VALUES
(1, 'BRG001', 'SKU001', 'Samsung Galaxy A14', '4/64GB', 'Samsung', 'HP', 2500000, 1),
(11, 'BRG002', 'SKU002', 'Xiaomi Redmi Note 12', '6/128GB', 'Xiaomi', 'HP', 3200000, 1),
(12, 'BRG003', 'SKU003', 'iPhone 13', '128GB', 'Apple', 'HP', 13000000, 1),
(13, 'BRG004', 'SKU004', 'Oppo A57', '4/64GB', 'Oppo', 'HP', 2200000, 1),
(14, 'BRG005', 'SKU005', 'Vivo Y21', '4/64GB', 'Vivo', 'HP', 2100000, 1),
(15, 'BRG006', 'SKU006', 'Charger Fast Charging', '25W', 'Anker', 'Aksesoris', 150000, 0),
(16, 'BRG007', 'SKU007', 'Headset Bluetooth', 'v5.0', 'Sony', 'Aksesoris', 350000, 0),
(17, 'BRG008', 'SKU008', 'Powerbank', '20000mAh', 'Xiaomi', 'Aksesoris', 250000, 0),
(18, 'BRG009', 'SKU009', 'Casing HP', 'Softcase', 'Ugreen', 'Aksesoris', 50000, 0),
(21, '333', '333', 'poco', '123', '123', '123', 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `id_gudang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail_pembelian`, `id_pembelian`, `id_barang`, `jumlah`, `harga_beli`, `harga_jual`, `id_gudang`) VALUES
(2, 1, 13, 200, 200, 300, 1),
(3, 1, 14, 32, 321, 123, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `imei_sn` varchar(20) NOT NULL,
  `imei1` varchar(50) DEFAULT NULL,
  `imei2` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `potongan1` decimal(10,0) NOT NULL,
  `potongan2` decimal(10,0) NOT NULL,
  `potongan3` decimal(10,0) NOT NULL,
  `total_setelah_potongan` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_penjualan`, `id_barang`, `imei_sn`, `imei1`, `imei2`, `jumlah`, `harga_jual`, `potongan1`, `potongan2`, `potongan3`, `total_setelah_potongan`) VALUES
(1, 1, 1, '', NULL, NULL, 1, 2500000, 0, 0, 0, 2500000),
(2, 1, 13, '', NULL, NULL, 1, 2200000, 0, 0, 0, 2200000),
(3, 2, 1, '', NULL, NULL, 4, 2500000, 0, 0, 0, 10000000),
(4, 2, 11, '', NULL, NULL, 1, 3200000, 0, 0, 0, 3200000),
(5, 2, 12, '', NULL, NULL, 1, 13000000, 0, 0, 0, 13000000),
(6, 2, 13, '', NULL, NULL, 1, 2200000, 0, 0, 0, 2200000),
(7, 3, 18, '', NULL, NULL, 2, 50000, 0, 0, 0, 100000),
(8, 4, 12, '0101', NULL, NULL, 1, 13000000, 200000, 500000, 0, 12300000),
(9, 4, 11, '0001', NULL, NULL, 1, 3200000, 0, 0, 0, 3200000),
(10, 5, 16, '', NULL, NULL, 2, 350000, 0, 0, 0, 700000),
(11, 5, 12, '1234', NULL, NULL, 1, 13000000, 200000, 500000, 0, 12300000),
(12, 5, 12, '321', NULL, NULL, 1, 13000000, 200000, 500000, 0, 12300000),
(13, 6, 1, '123123', NULL, NULL, 1, 2500000, 200000, 0, 0, 2300000),
(14, 6, 1, '321321', NULL, NULL, 1, 2500000, 200000, 0, 0, 2300000),
(15, 6, 11, '333', NULL, NULL, 1, 3200000, 5000000, 120000, 0, -1920000),
(16, 7, 18, '', NULL, NULL, 1, 50000, 123, 200000, 0, -150123),
(17, 7, 16, '', NULL, NULL, 1, 350000, 0, 0, 0, 350000),
(18, 8, 16, '', NULL, NULL, 1, 350000, 0, 0, 0, 350000),
(19, 9, 15, '', NULL, NULL, 1, 150000, 0, 0, 0, 150000),
(20, 10, 15, '', NULL, NULL, 1, 150000, 0, 0, 0, 150000),
(21, 10, 18, '', NULL, NULL, 1, 50000, 123, 200000, 200, -150323),
(22, 12, 11, '234', '545434', '', 1, 3200000, 5000000, 120000, 0, -1920000),
(23, 13, 11, '234', '545434', '', 1, 3200000, 5000000, 120000, 0, -1920000);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(20) NOT NULL,
  `lokasi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `lokasi`) VALUES
(1, 'gudang pasar lama', 'pasar lamaa'),
(2, 'gudang belitung', 'beltiung');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `peran` enum('admin','gudang','kasir','finance') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `username`, `password`, `peran`) VALUES
(1, 'kaka', 'kaka', '123', 'kasir'),
(2, 'rika', 'rika', '321', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(20) NOT NULL,
  `kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `kontak`) VALUES
(2, 'yuki', '123'),
(3, 'kira', '123'),
(5, 'kias', '123321'),
(7, '4444', '4444'),
(8, '333', '333');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `total_pembelian` decimal(10,0) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal_pembelian`, `id_supplier`, `total_pembelian`, `id_pegawai`) VALUES
(1, '2025-08-17', 1, 2000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `metode_pembayaran` enum('cash','qris','ewallet','bank') NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `sisa_bayar` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tanggal_penjualan`, `id_pelanggan`, `id_pegawai`, `metode_pembayaran`, `total`, `diskon`, `subtotal`, `sisa_bayar`) VALUES
(1, '2025-08-14', 2, 1, 'cash', 4700000, 20000, 4680000, -1000000),
(2, '2025-08-14', 2, 1, 'bank', 28400000, 20000, 28380000, 0),
(3, '2025-08-15', 3, 2, 'ewallet', 100000, 0, 100000, 99508),
(4, '2025-08-16', 2, 2, 'bank', 16200000, 700000, 15500000, 0),
(5, '2025-08-16', 2, 2, 'bank', 26700000, 1400000, 25300000, 0),
(6, '2025-08-17', 5, 1, 'cash', 8200000, 5520000, 2680000, 0),
(7, '2025-08-17', 2, 1, 'cash', 400000, 200123, 199877, 0),
(8, '2025-08-17', 2, 2, 'ewallet', 350000, 0, 350000, 0),
(9, '2025-08-17', 2, 2, 'ewallet', 150000, 0, 150000, 0),
(10, '2025-08-17', 3, 1, 'cash', 200000, 200446, -446, -892),
(11, '2025-08-20', 7, 2, 'bank', 3200000, 5120000, -1920000, -3840000),
(12, '2025-08-20', 7, 2, 'bank', 3200000, 5120000, -1920000, -3840000),
(13, '2025-08-20', 7, 2, 'bank', 3200000, 5120000, -1920000, -3840000);

-- --------------------------------------------------------

--
-- Table structure for table `potongan_barang`
--

CREATE TABLE `potongan_barang` (
  `id_potongan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_potongan` varchar(100) NOT NULL,
  `nilai_potongan` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan_barang`
--

INSERT INTO `potongan_barang` (`id_potongan`, `id_barang`, `nama_potongan`, `nilai_potongan`, `tanggal_mulai`, `tanggal_selesai`, `status`) VALUES
(1, 13, '123', 123, '2025-08-01', '2025-08-14', 'nonaktif'),
(2, 18, '123', 123, '2025-08-14', '2025-08-15', 'nonaktif'),
(3, 18, '123', 200000, '2025-08-14', '2025-08-16', 'nonaktif'),
(4, 12, 'potongan natalaaa', 200000, '2025-08-15', '2025-08-22', 'aktif'),
(5, 12, 'potongan tahun baru', 500000, '2025-08-07', '2025-08-27', 'aktif'),
(6, 11, 'Potongan Natal', 5000000, '2025-08-01', '2025-08-29', 'aktif'),
(7, 11, 'Potongan tahun baru', 120000, '2025-08-01', '2025-08-30', 'aktif'),
(8, 1, 'Potongan Flash sale', 200000, '2025-08-01', '2025-08-25', 'aktif'),
(9, 18, 'potongan tahunan', 200, '2025-08-02', '2025-08-28', 'aktif'),
(10, 18, '123', 123, '2025-08-01', '2025-08-27', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `potongan_barang_riwayat`
--

CREATE TABLE `potongan_barang_riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_potongan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_potongan` varchar(100) NOT NULL,
  `nilai_potongan` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_awal` enum('aktif','nonaktif') DEFAULT NULL,
  `status_akhir` enum('aktif','nonaktif') DEFAULT NULL,
  `tanggal_perubahan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan_barang_riwayat`
--

INSERT INTO `potongan_barang_riwayat` (`id_riwayat`, `id_potongan`, `id_barang`, `nama_potongan`, `nilai_potongan`, `tanggal_mulai`, `tanggal_selesai`, `status_awal`, `status_akhir`, `tanggal_perubahan`) VALUES
(1, 1, 13, '123', 123, '2025-08-01', '2025-08-14', 'aktif', 'nonaktif', '2025-08-15 02:05:11'),
(2, 2, 18, '123', 123, '2025-08-14', '2025-08-15', 'aktif', 'nonaktif', '2025-08-16 06:11:46'),
(3, 3, 18, '123', 200000, '2025-08-14', '2025-08-16', 'aktif', 'nonaktif', '2025-08-16 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekonsiliasi`
--

CREATE TABLE `rekonsiliasi` (
  `id_rekonsiliasi` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `metode_pembayaran` enum('cash','qris','ewallet','bank') NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status_pembayaran` enum('lunas','belum lunas') NOT NULL,
  `nominal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekonsiliasi`
--

INSERT INTO `rekonsiliasi` (`id_rekonsiliasi`, `id_penjualan`, `metode_pembayaran`, `tanggal_transaksi`, `status_pembayaran`, `nominal`) VALUES
(1, 5, 'bank', '2025-08-16', 'lunas', 25300000),
(2, 6, 'cash', '2025-08-17', 'lunas', 2680000),
(3, 7, 'cash', '2025-08-17', 'lunas', 199877),
(4, 8, 'ewallet', '2025-08-17', 'lunas', 350000),
(5, 7, 'ewallet', '2025-08-13', 'belum lunas', 123),
(6, 9, 'ewallet', '2025-08-17', 'lunas', 150000),
(7, 10, 'cash', '2025-08-17', 'belum lunas', -446),
(8, 11, 'bank', '2025-08-20', 'belum lunas', -1920000),
(9, 12, 'bank', '2025-08-20', 'belum lunas', -1920000),
(10, 13, 'bank', '2025-08-20', 'belum lunas', -1920000);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_barang`, `id_gudang`, `jumlah`) VALUES
(3, 21, 1, 96),
(4, 16, 1, 96),
(5, 15, 1, 98),
(6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stok_sn`
--

CREATE TABLE `stok_sn` (
  `id_stok_sn` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `imei_sn` varchar(20) NOT NULL,
  `imei1` varchar(50) DEFAULT NULL,
  `imei2` varchar(50) DEFAULT NULL,
  `status` enum('tersedia','terjual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_sn`
--

INSERT INTO `stok_sn` (`id_stok_sn`, `id_barang`, `id_gudang`, `imei_sn`, `imei1`, `imei2`, `status`) VALUES
(2, 11, 1, '0001', NULL, NULL, 'terjual'),
(3, 12, 1, '0101', NULL, NULL, 'terjual'),
(4, 12, 1, '1234', NULL, NULL, 'terjual'),
(5, 12, 1, '321', NULL, NULL, 'terjual'),
(6, 1, 1, '321321', NULL, NULL, 'terjual'),
(7, 1, 1, '123123', '', '32132133', 'tersedia'),
(8, 11, 1, '333', NULL, NULL, 'terjual'),
(9, 11, 2, '234', '545434', '', 'terjual');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(20) NOT NULL,
  `kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `kontak`) VALUES
(1, 'asdf', 'fda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `pembelian_ibfk_1` (`id_pegawai`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `potongan_barang`
--
ALTER TABLE `potongan_barang`
  ADD PRIMARY KEY (`id_potongan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `potongan_barang_riwayat`
--
ALTER TABLE `potongan_barang_riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  ADD PRIMARY KEY (`id_rekonsiliasi`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `stok_sn`
--
ALTER TABLE `stok_sn`
  ADD PRIMARY KEY (`id_stok_sn`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `potongan_barang`
--
ALTER TABLE `potongan_barang`
  MODIFY `id_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `potongan_barang_riwayat`
--
ALTER TABLE `potongan_barang_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  MODIFY `id_rekonsiliasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok_sn`
--
ALTER TABLE `stok_sn`
  MODIFY `id_stok_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detail_pembelian_ibfk_3` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`);

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`),
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `potongan_barang`
--
ALTER TABLE `potongan_barang`
  ADD CONSTRAINT `potongan_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  ADD CONSTRAINT `rekonsiliasi_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`);

--
-- Constraints for table `stok_sn`
--
ALTER TABLE `stok_sn`
  ADD CONSTRAINT `stok_sn_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `stok_sn_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
