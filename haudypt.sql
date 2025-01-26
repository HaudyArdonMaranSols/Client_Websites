-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 10:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haudypt`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_jenis_barang`
--

CREATE TABLE `kategori_jenis_barang` (
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_jenis_barang`
--

INSERT INTO `kategori_jenis_barang` (`kategori_id`, `nama`, `deskripsi`) VALUES
(1, 'Parfum', 'Placeholder untuk Barang A'),
(2, 'Pengharum Ruangan', 'Placeholder untuk Barang B'),
(3, 'Pewarna & Perawatan Rambut', 'Placeholder untuk Barang C'),
(4, 'Perawatan Tubuh & Skincare', 'Place Holder blabla');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `harga`, `stok`, `kategori_id`, `foto`) VALUES
(2, 'Ayam Bakar Madura', '50000.00', 54, 1, 'adolf_1737881392.jpg'),
(3, 'rerer', '232323.00', 233232, 1, '273200837_681447652877737_8722398283768233009_n_1737881736.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stok_log`
--

CREATE TABLE `stok_log` (
  `log_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `jenis` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_log`
--

INSERT INTO `stok_log` (`log_id`, `produk_id`, `jumlah`, `tanggal`, `jenis`) VALUES
(442, 121, 125, '2025-01-26 03:31:03', 'masuk'),
(641, 121, 50, '2025-01-26 03:27:57', 'keluar');

--
-- Triggers `stok_log`
--
DELIMITER $$
CREATE TRIGGER `after_insert_log_stok` AFTER INSERT ON `stok_log` FOR EACH ROW BEGIN
    IF NEW.jenis = 'masuk' THEN
        UPDATE produk 
        SET stok = stok + NEW.jumlah 
        WHERE produk_id = NEW.produk_id;
    ELSEIF NEW.jenis = 'keluar' THEN
        IF (SELECT stok FROM produk WHERE produk_id = NEW.produk_id) >= NEW.jumlah THEN
            UPDATE produk 
            SET stok = stok - NEW.jumlah 
            WHERE produk_id = NEW.produk_id;
        ELSE
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Stok tidak mencukupi untuk pengurangan.';
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`) VALUES
(31, 'doni', 'july', '$2a$12$BwnGzPulanv0K1h5hpOpm.tzU6gQ6bHuuVS7sPOUkRsVnTz4UD6rO', '2025-01-26 04:37:14'),
(112131, 'Admin', 'AyamBawang', '$2y$10$z9TYAlgAA9iwwknxIIJZHOACO0HGlgMoVNDtsUlNpX.Ci.LF/M.KO', '2025-01-25 09:16:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_jenis_barang`
--
ALTER TABLE `kategori_jenis_barang`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `produk_ibfk_1` (`kategori_id`);

--
-- Indexes for table `stok_log`
--
ALTER TABLE `stok_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_jenis_barang`
--
ALTER TABLE `kategori_jenis_barang`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stok_log`
--
ALTER TABLE `stok_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=642;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112132;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_jenis_barang` (`kategori_id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_log`
--
ALTER TABLE `stok_log`
  ADD CONSTRAINT `stok_log_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
