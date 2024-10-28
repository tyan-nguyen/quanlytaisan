-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2024 at 02:46 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlts_v2_fixed`
--

-- --------------------------------------------------------

--
-- Table structure for table `ts_thiet_bi_vat_tu`
--

DROP TABLE IF EXISTS `ts_thiet_bi_vat_tu`;
CREATE TABLE IF NOT EXISTS `ts_thiet_bi_vat_tu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_thiet_bi` int(11) NOT NULL,
  `id_vat_tu` int(11) NOT NULL,
  `qr_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `id_phieu_sua_chua` int(11) DEFAULT NULL,
  `id_tbvt_thay_the` int(11) DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tru_ton_kho` int(11) DEFAULT NULL,
  `id_kho` int(11) DEFAULT NULL COMMENT 'danh cho vt hong',
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_thiet_bi` (`id_thiet_bi`),
  KEY `id_vat_tu` (`id_vat_tu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ts_thiet_bi_vat_tu`
--
ALTER TABLE `ts_thiet_bi_vat_tu`
  ADD CONSTRAINT `ts_thiet_bi_vat_tu_ibfk_1` FOREIGN KEY (`id_thiet_bi`) REFERENCES `ts_thiet_bi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ts_thiet_bi_vat_tu_ibfk_2` FOREIGN KEY (`id_vat_tu`) REFERENCES `ts_dm_vat_tu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
