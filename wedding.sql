-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.19-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table wedding.paket
DROP TABLE IF EXISTS `paket`;
CREATE TABLE IF NOT EXISTS `paket` (
  `id_paket` int(11) NOT NULL AUTO_INCREMENT,
  `plh_paket` varchar(100) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `DP` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_paket`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel wedding.paket: ~4 rows (lebih kurang)
INSERT IGNORE INTO `paket` (`id_paket`, `plh_paket`, `harga`, `DP`, `gambar`) VALUES
	(16, 'SWP for Engagement', 1800000, 450000, '1664005082_79b3dd665ad61da7fec2.jpg'),
	(17, 'SWP and MC for Engagement', 2500000, 625000, '1664005228_b34a58ec07e942780e9a.jpg'),
	(18, 'SWP on Planner', 6500000, 1625000, '1664005307_e5c804c9b003d38c5e55.jpg'),
	(19, 'SWP + MC', 7000000, 1750000, '1664005380_cf14daec0e14f12a57b2.jpg');

-- membuang struktur untuk table wedding.pesanan
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE IF NOT EXISTS `pesanan` (
  `Id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_paket` varchar(255) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `tgl_booking` date NOT NULL,
  `Telepon` varchar(20) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_pesanan`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel wedding.pesanan: ~1 rows (lebih kurang)
INSERT IGNORE INTO `pesanan` (`Id_pesanan`, `id_user`, `id_paket`, `Nama`, `tgl_booking`, `Telepon`, `Alamat`, `status`, `created_at`, `updated_at`) VALUES
	(39, 4, '16', 'prayuda', '2022-09-26', '085798125078', 'Jl.veteran No.204', 2, '2022-09-24 19:02:05', '2022-09-30 15:41:52');

-- membuang struktur untuk table wedding.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `Id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `Id_pesanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `akun_bank` varchar(255) DEFAULT NULL,
  `bukti` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel wedding.transaksi: ~1 rows (lebih kurang)
INSERT IGNORE INTO `transaksi` (`Id_transaksi`, `Id_pesanan`, `id_user`, `akun_bank`, `bukti`) VALUES
	(27, 39, 4, '8769932xxx', '1664024700_da6ed4eba0a60eed4a48.jpg');

-- membuang struktur untuk table wedding.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Level` enum('Admin','Klien','','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Membuang data untuk tabel wedding.user: ~6 rows (lebih kurang)
INSERT IGNORE INTO `user` (`id_user`, `nama_user`, `username`, `password`, `Level`, `created_at`, `updated_at`) VALUES
	(2, 'Jaka', 'jaka@mail.com', 'jaka', 'Admin', '2022-07-21 00:00:00', NULL),
	(3, 'Admin', 'admin@mail.com', '$2y$10$qF.bq9fTSCYfKgNFPPzOcuPJN05b/.xuAGb5mf4s4Tbu/4K5r2Pvq', 'Admin', '2022-07-21 00:00:00', NULL),
	(4, 'prayuda', 'prayudajaka@15mail.com', '$2y$10$qF.bq9fTSCYfKgNFPPzOcuPJN05b/.xuAGb5mf4s4Tbu/4K5r2Pvq', 'Klien', '2022-07-28 00:00:00', '2022-07-28 00:00:00'),
	(5, 'sahbandi', 'sahbandi@mail.com', '$2y$10$vSDnk8.vql9vMyDIMFUlyOlqkhIzOf9RXn6IqMMglHv5W2gjvHOmy', 'Klien', '2022-08-03 00:00:00', '2022-08-03 00:00:00'),
	(6, 'abdur', 'abdur@mail.com', '$2y$10$6osekaHFbq6vJzqARjTMauEdnytM5P0pIKWcPFKK53T19dJYr..cC', 'Klien', '2022-08-03 00:00:00', '2022-08-03 00:00:00'),
	(8, 'eminem', 'eminem@mail.com', '$2y$10$QatuAMl6mf7wO9FyHM..Ce1EJIsdEQBImb1v8sWAR4GVypsvJSPYC', 'Klien', '2022-08-08 00:00:00', '2022-08-08 00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
