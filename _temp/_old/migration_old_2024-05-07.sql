-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2024 at 05:10 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlts`
--

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1715086910),
('m140608_173539_create_user_table', 1715087511),
('m140611_133903_init_rbac', 1715087511),
('m140808_073114_create_auth_item_group_table', 1715087511),
('m140809_072112_insert_superadmin_to_user', 1715087512),
('m140809_073114_insert_common_permisison_to_auth_item', 1715087513),
('m141023_141535_create_user_visit_log', 1715087513),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1715087513),
('m141121_194858_split_browser_and_os_column', 1715087513),
('m141201_220516_add_email_and_email_confirmed_to_user', 1715087514),
('m141207_001649_create_basic_user_permissions', 1715087515),
('m240425_125048_create_table_ts_bo_phan', 1715086916),
('m240425_125150_create_table_ts_nhom_doi_tac', 1715087124),
('m240425_125859_create_table_ts_doi_tac', 1715087124),
('m240425_130703_create_table_ts_he_thong', 1715087124),
('m240425_131223_create_table_ts_hinh_anh', 1715087124),
('m240426_071111_create_table_ts_history', 1715087124),
('m240426_071910_create_table_ts_loai_bao_tri', 1715087124),
('m240426_072759_create_table_ts_loai_thiet_bi', 1715087125),
('m240426_073138_create_table_ts_lop_hu_hong', 1715087125),
('m240426_073957_create_table_ts_tai_lieu', 1715087125),
('m240426_074321_create_table_ts_nhan_vien', 1715087125),
('m240426_075023_create_table_ts_thiet_bi', 1715087125),
('m240426_081552_create_table_ts_vi_tri', 1715087125),
('m240507_125221_create_table_ts_kho_luu_tru', 1715087125),
('m240507_125934_create_table_ts_ke_hoach_bao_tri', 1715090877),
('m240507_131512_create_table_ts_nhan_vien_kho', 1715090877);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
