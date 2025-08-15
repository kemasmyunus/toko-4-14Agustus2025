-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2025 at 04:35 AM
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
(18, 'BRG009', 'SKU009', 'Casing HP', 'Softcase', 'Ugreen', 'Aksesoris', 50000, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `imei_sn` varchar(20) NOT NULL,
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

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_penjualan`, `id_barang`, `imei_sn`, `jumlah`, `harga_jual`, `potongan1`, `potongan2`, `potongan3`, `total_setelah_potongan`) VALUES
(1, 1, 1, '', 1, 2500000, 0, 0, 0, 2500000),
(2, 1, 13, '', 1, 2200000, 0, 0, 0, 2200000),
(3, 2, 1, '', 4, 2500000, 0, 0, 0, 10000000),
(4, 2, 11, '', 1, 3200000, 0, 0, 0, 3200000),
(5, 2, 12, '', 1, 13000000, 0, 0, 0, 13000000),
(6, 2, 13, '', 1, 2200000, 0, 0, 0, 2200000),
(7, 3, 18, '', 2, 50000, 0, 0, 0, 100000);

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
(3, 'kira', '123');

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
(3, '2025-08-15', 3, 2, 'ewallet', 100000, 0, 100000, 99508);

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
(2, 18, '123', 123, '2025-08-14', '2025-08-16', 'aktif'),
(3, 18, '123', 123, '2025-08-14', '2025-08-27', 'aktif');

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
(1, 1, 13, '123', 123, '2025-08-01', '2025-08-14', 'aktif', 'nonaktif', '2025-08-15 02:05:11');

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
(3, 18, 1, 98);

-- --------------------------------------------------------

--
-- Table structure for table `stok_sn`
--

CREATE TABLE `stok_sn` (
  `id_stok_sn` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `imei_sn` varchar(20) NOT NULL,
  `status` enum('tersedia','terjual') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_sn`
--

INSERT INTO `stok_sn` (`id_stok_sn`, `id_barang`, `id_gudang`, `imei_sn`, `status`) VALUES
(2, 11, 1, '0001', 'tersedia');

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `potongan_barang`
--
ALTER TABLE `potongan_barang`
  MODIFY `id_potongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `potongan_barang_riwayat`
--
ALTER TABLE `potongan_barang_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekonsiliasi`
--
ALTER TABLE `rekonsiliasi`
  MODIFY `id_rekonsiliasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_sn`
--
ALTER TABLE `stok_sn`
  MODIFY `id_stok_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
