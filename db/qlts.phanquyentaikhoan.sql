-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 08, 2023 at 08:47 AM
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
-- Database: `qlts`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('macDinh', 16, 1691400376),
('user_16_', 16, 1691400376),
('user_4_', 4, 1691396411);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/baotri/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/default/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/default/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/ke-hoach-bao-tri/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/lich-bao-tri/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/lich-bao-tri/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/baotri/loai-bao-tri/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/bo-phan/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/default/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/default/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/doi-tac/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhan-vien/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/bophan/nhom-doi-tac/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/default/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/default/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/create-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/delete-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/update-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/hinh-anh/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/history/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/import/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/import/import', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/import/upload', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/create-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/delete-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/update-outer', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/dungchung/tai-lieu/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/gridview/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/gridview/export/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/gridview/export/download', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/gridview/grid-edited-row/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/gridview/grid-edited-row/back', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/kholuutru/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/default/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/default/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/depdrop/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/depdrop/get-nhan-vien', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/kholuutru/kho/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/site/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/about', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/captcha', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/contact', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/error', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/login', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/logout', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/taisan/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/default/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/default/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/list-thiet-bi', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/he-thong/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/loai-thiet-bi/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/qr/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/qr/in-loai', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/qr/in-qrs', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/qr-scan', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/thiet-bi/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/bulkdelete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/create', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/delete', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/update', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/taisan/vi-tri/view', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/auth-item-group/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/bulk-activate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/bulk-deactivate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/bulk-delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/grid-page-size', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth-item-group/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/captcha', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/auth/confirm-email', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/login', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/logout', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/password-recovery', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/auth/registration', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/bulk-activate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/bulk-deactivate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/bulk-delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/grid-page-size', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/refresh-routes', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/set-child-permissions', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/set-child-routes', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/permission/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/bulk-activate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/bulk-deactivate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/bulk-delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/grid-page-size', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/set-child-permissions', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/set-child-roles', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/role/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-permission/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user-visit-log/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/bulk-activate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/bulk-deactivate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/bulk-delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/grid-page-size', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user-visit-log/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/user/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/captcha', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/change-own-password', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/confirm-email', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/login', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/logout', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/password-recovery', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/auth/registration', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/default/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/default/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/giao-dien/*', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/user/giao-dien/index', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/user/user-ajax/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/bulkdelete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/change-password', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/user/user-ajax/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/set', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/set-roles', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/activity', 3, NULL, NULL, NULL, 1691110097, 1691110097, NULL),
('/user/user/bulk-activate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/bulk-deactivate', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/bulk-delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/change-password', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/grid-page-size', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/grid-sort', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/toggle-attribute', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1689001074, 1689001074, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('macdinh', 1, 'Mặc định cho tài khoản', NULL, NULL, 1691400067, 1691400067, NULL),
('nQuanLyBoPhan', 1, 'Quản lý Phòng ban - Bộ phận', NULL, NULL, 1691483880, 1691483880, NULL),
('nQuanLyDanhMuc', 1, 'Quản lý danh mục', NULL, NULL, 1691483908, 1691483908, NULL),
('nQuanLyDoiTac', 1, 'Quản lý đối tác', NULL, NULL, 1691483922, 1691483922, NULL),
('nQuanLyHeThongThietBi', 1, 'Quản lý hệ thống thiết bị', NULL, NULL, 1691483941, 1691483941, NULL),
('nQuanLyKho', 1, 'Quản lý kho lưu trữ', NULL, NULL, 1691483957, 1691483957, NULL),
('nQuanLyLoaiThietBi', 1, 'Quản lý loại thiết bị', NULL, NULL, 1691483978, 1691483978, NULL),
('nQuanLyNhanVien', 1, 'Quản lý nhân viên', NULL, NULL, 1691483998, 1691483998, NULL),
('nQuanLyTaiSan', 1, 'Quản lý tài sản', NULL, NULL, 1691484016, 1691484016, NULL),
('nQuanLyViTri', 1, 'Quản lý vị trí', NULL, NULL, 1691484042, 1691484042, NULL),
('nQuanTriTaiKhoan', 1, 'Quản trị tài khoản người dùng', NULL, NULL, 1691483835, 1691483835, NULL),
('nXemTatCa', 1, 'Quyền xem', NULL, NULL, 1691484173, 1691484173, NULL),
('qDanhMucNhomDoiTac', 2, 'Quản lý danh mục nhóm đối tác', NULL, NULL, 1691481882, 1691481882, 'quanLyDanhMuc'),
('qDanhSachBoPhan', 2, 'Xem danh sách bộ phận', NULL, NULL, 1691420418, 1691420430, 'quanLyBoPhan'),
('qDanhSachDoiTac', 2, 'Xem danh sách đối tác', NULL, NULL, 1691480297, 1691480297, 'quanLyDoiTac'),
('qDanhSachHeThongThietBi', 2, 'Xem danh sách hệ thống thiết bị', NULL, NULL, 1691482349, 1691482349, 'quanLyHeThongThietBi'),
('qDanhSachKho', 2, 'Xem danh sách Kho lưu trữ', NULL, NULL, 1691482033, 1691482033, 'quanLyKhoLuuTru'),
('qDanhSachLoaiThietBi', 2, 'Xem danh sách loại thiết bị', NULL, NULL, 1691482755, 1691482755, 'quanLyLoaiThietBi'),
('qDanhSachNhanVien', 2, 'Xem danh sách nhân viên', NULL, NULL, 1691481320, 1691481320, 'quanLyNhanVien'),
('qDanhSachTaiKhoan', 2, 'Xem danh sách tài khoản', NULL, NULL, 1691399023, 1691399298, 'accountsManage'),
('qDanhSachTaiSan', 2, 'Xem danh sách tài sản - thiết bị', NULL, NULL, 1691375126, 1691399310, 'quanLyTaiSan'),
('qDanhSachViTri', 2, 'Xem danh sách vị trí', NULL, NULL, 1691400832, 1691400832, 'quanLyViTri'),
('qGiaoDienThietBi', 2, 'Tùy chỉnh giao diện cho thiết bị cá nhân', NULL, NULL, 1691399872, 1691399872, 'userCommonPermissions'),
('qInQrTaiSan', 2, 'In QR tài sản - thiết bị', NULL, NULL, 1691375622, 1691399273, 'quanLyTaiSan'),
('qPhanQuyenTaiKhoan', 2, 'Phân quyền cho tài khoản', NULL, NULL, 1691399576, 1691399576, 'accountsManage'),
('qScanQrTaiSan', 2, 'Scan QR xem tài sản - thiết bị', NULL, NULL, 1691375522, 1691399264, 'quanLyTaiSan'),
('qSuaBoPhan', 2, 'Sửa thông tin bộ phận', NULL, NULL, 1691420634, 1691420634, 'quanLyBoPhan'),
('qSuaDoiTac', 2, 'Sửa thông tin đối tác', NULL, NULL, 1691480405, 1691480405, 'quanLyDoiTac'),
('qSuaHeThongThietBi', 2, 'Sửa thông tin hệ thống thiết bị', NULL, NULL, 1691482549, 1691482549, 'quanLyHeThongThietBi'),
('qSuaKho', 2, 'Sửa thông tin kho lưu trữ', NULL, NULL, 1691482132, 1691482132, 'quanLyKhoLuuTru'),
('qSuaLoaiThietBi', 2, 'Sửa loại thiết bị', NULL, NULL, 1691482839, 1691482839, 'quanLyLoaiThietBi'),
('qSuaNhanVien', 2, 'Sửa thông tin nhân viên', NULL, NULL, 1691481669, 1691481669, 'quanLyNhanVien'),
('qSuaTaiKhoan', 2, 'Sửa tài khoản', NULL, NULL, 1689124200, 1691399360, 'accountsManage'),
('qSuaTaiSan', 2, 'Sửa thông tin tài sản - thiết bị', NULL, NULL, 1691375293, 1691399239, 'quanLyTaiSan'),
('qSuaViTri', 2, 'Sửa vị trí', NULL, NULL, 1691401058, 1691401058, 'quanLyViTri'),
('qThayDoiMatKhauCaNhan', 2, 'Thay đổi mật khẩu cá nhân', NULL, NULL, 1691109892, 1691399740, 'userCommonPermissions'),
('qThemBoPhan', 2, 'Thêm bộ phận', NULL, NULL, 1691420545, 1691420608, 'quanLyBoPhan'),
('qThemDoiTac', 2, 'Thêm mới đối tác', NULL, NULL, 1691480380, 1691480380, 'quanLyDoiTac'),
('qThemHeThongThietBi', 2, 'Thêm hệ thống thiết bị', NULL, NULL, 1691482620, 1691482620, 'quanLyHeThongThietBi'),
('qThemKho', 2, 'Thêm thông tin kho lưu trữ', NULL, NULL, 1691482097, 1691482097, 'quanLyKhoLuuTru'),
('qThemLoaiThietBi', 2, 'Thêm loại thiết bị', NULL, NULL, 1691482811, 1691482811, 'quanLyLoaiThietBi'),
('qThemNhanVien', 2, 'Thêm nhân viên', NULL, NULL, 1691481648, 1691481648, 'quanLyNhanVien'),
('qThemTaiKhoan', 2, 'Thêm tài khoản', NULL, NULL, 1689123863, 1691399351, 'accountsManage'),
('qThemTaiSan', 2, 'Thêm mới tài sản', NULL, NULL, 1691375384, 1691399247, 'quanLyTaiSan'),
('qThemViTri', 2, 'Thêm vị trí', NULL, NULL, 1691110325, 1691400562, 'quanLyViTri'),
('qXemBoPhan', 2, 'Xem thông tin bộ phận', NULL, NULL, 1691420483, 1691420483, 'quanLyBoPhan'),
('qXemDashboard', 2, 'Truy cập Dashboard', NULL, NULL, 1691399814, 1691399814, 'userCommonPermissions'),
('qXemDoiTac', 2, 'Xem thông tin đối tác', NULL, NULL, 1691480321, 1691480321, 'quanLyDoiTac'),
('qXemHeThongThietBi', 2, 'Xem thông tin hệ thống thiết bị', NULL, NULL, 1691482522, 1691482522, 'quanLyHeThongThietBi'),
('qXemHoatDongCaNhan', 2, 'Xem thông tin lịch sử hoạt động của cá nhân', NULL, NULL, 1691109981, 1691399711, 'userCommonPermissions'),
('qXemKho', 2, 'Xem thông tin kho lưu trữ', NULL, NULL, 1691482067, 1691482067, 'quanLyKhoLuuTru'),
('qXemLoaiThietBi', 2, 'Xem thông tin loại thiết bị', NULL, NULL, 1691482782, 1691482782, 'quanLyLoaiThietBi'),
('qXemNhanVien', 2, 'Xem thông tin nhân viên', NULL, NULL, 1691481358, 1691481358, 'quanLyNhanVien'),
('qXemTaiKhoan', 2, 'Xem tài khoản', NULL, NULL, 1689124249, 1691399377, 'accountsManage'),
('qXemTaiSan', 2, 'Xem Thông tin chi tiết tài sản - thiết bị', NULL, NULL, 1691375224, 1691399225, 'quanLyTaiSan'),
('qXemViTri', 2, 'Xem thông tin vị trí', NULL, NULL, 1691400883, 1691400883, 'quanLyViTri'),
('qXoaBoPhan', 2, 'Xóa bộ phận', NULL, NULL, 1691420667, 1691420667, 'quanLyBoPhan'),
('qXoaDoiTac', 2, 'Xóa đối tác', NULL, NULL, 1691480428, 1691480428, 'quanLyDoiTac'),
('qXoaHeThongThietBi', 2, 'Xóa hệ thống thiết bị', NULL, NULL, 1691482576, 1691482576, 'quanLyHeThongThietBi'),
('qXoaKho', 2, 'Xóa kho lưu trữ', NULL, NULL, 1691482161, 1691482161, 'quanLyKhoLuuTru'),
('qXoaLoaiThietBi', 2, 'Xóa loại thiết bị', NULL, NULL, 1691482867, 1691482867, 'quanLyLoaiThietBi'),
('qXoaNhanVien', 2, 'Xóa nhân viên', NULL, NULL, 1691481693, 1691481693, 'quanLyNhanVien'),
('qXoaTaiKhoan', 2, 'Xóa tài khoản', NULL, NULL, 1689124228, 1691399369, 'accountsManage'),
('qXoaTaiSan', 2, 'Xóa tài sản - thiết bị', NULL, NULL, 1691375438, 1691399255, 'quanLyTaiSan'),
('qXoaViTri', 2, 'Xóa vị trí', NULL, NULL, 1691401098, 1691401098, 'quanLyViTri'),
('user_16_', 1, 'Quyền tùy chỉnh cho user tyan4', NULL, NULL, 1691400376, 1691400376, NULL),
('user_1_', 1, 'Quyền tùy chỉnh cho user superadmin', NULL, NULL, 1691396390, 1691396390, NULL),
('user_4_', 1, 'Quyền tùy chỉnh cho user user003', NULL, NULL, 1691396411, 1691396411, NULL),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1689001075, 1689001075, 'userManagement');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('qXoaBoPhan', '/bophan/bo-phan/bulkdelete'),
('qThemBoPhan', '/bophan/bo-phan/create'),
('qXoaBoPhan', '/bophan/bo-phan/delete'),
('qDanhSachBoPhan', '/bophan/bo-phan/index'),
('qSuaBoPhan', '/bophan/bo-phan/update'),
('qXemBoPhan', '/bophan/bo-phan/view'),
('qXoaDoiTac', '/bophan/doi-tac/bulkdelete'),
('qThemDoiTac', '/bophan/doi-tac/create'),
('qXoaDoiTac', '/bophan/doi-tac/delete'),
('qDanhSachDoiTac', '/bophan/doi-tac/index'),
('qSuaDoiTac', '/bophan/doi-tac/update'),
('qXemDoiTac', '/bophan/doi-tac/view'),
('qXoaNhanVien', '/bophan/nhan-vien/bulkdelete'),
('qThemNhanVien', '/bophan/nhan-vien/create'),
('qXoaNhanVien', '/bophan/nhan-vien/delete'),
('qDanhSachNhanVien', '/bophan/nhan-vien/index'),
('qSuaNhanVien', '/bophan/nhan-vien/update'),
('qXemNhanVien', '/bophan/nhan-vien/view'),
('qDanhMucNhomDoiTac', '/bophan/nhom-doi-tac/*'),
('qDanhSachKho', '/kholuutru/depdrop/get-nhan-vien'),
('qSuaKho', '/kholuutru/depdrop/get-nhan-vien'),
('qThemKho', '/kholuutru/depdrop/get-nhan-vien'),
('qXemKho', '/kholuutru/depdrop/get-nhan-vien'),
('qXoaKho', '/kholuutru/kho/bulkdelete'),
('qThemKho', '/kholuutru/kho/create'),
('qXoaKho', '/kholuutru/kho/delete'),
('qDanhSachKho', '/kholuutru/kho/index'),
('qSuaKho', '/kholuutru/kho/update'),
('qXemKho', '/kholuutru/kho/view'),
('qXoaHeThongThietBi', '/taisan/he-thong/bulkdelete'),
('qThemHeThongThietBi', '/taisan/he-thong/create'),
('qXoaHeThongThietBi', '/taisan/he-thong/delete'),
('qDanhSachHeThongThietBi', '/taisan/he-thong/index'),
('qSuaHeThongThietBi', '/taisan/he-thong/update'),
('qXemHeThongThietBi', '/taisan/he-thong/view'),
('qXoaLoaiThietBi', '/taisan/loai-thiet-bi/bulkdelete'),
('qThemLoaiThietBi', '/taisan/loai-thiet-bi/create'),
('qXoaLoaiThietBi', '/taisan/loai-thiet-bi/delete'),
('qDanhSachLoaiThietBi', '/taisan/loai-thiet-bi/index'),
('qSuaLoaiThietBi', '/taisan/loai-thiet-bi/update'),
('qXemLoaiThietBi', '/taisan/loai-thiet-bi/view'),
('qInQrTaiSan', '/taisan/qr/in-loai'),
('qInQrTaiSan', '/taisan/qr/in-qrs'),
('qXoaTaiSan', '/taisan/thiet-bi/bulkdelete'),
('qThemTaiSan', '/taisan/thiet-bi/create'),
('qXoaTaiSan', '/taisan/thiet-bi/delete'),
('qDanhSachTaiSan', '/taisan/thiet-bi/index'),
('qScanQrTaiSan', '/taisan/thiet-bi/qr-scan'),
('qSuaTaiSan', '/taisan/thiet-bi/update'),
('qXemTaiSan', '/taisan/thiet-bi/view'),
('qXoaViTri', '/taisan/vi-tri/bulkdelete'),
('qThemViTri', '/taisan/vi-tri/create'),
('qXoaViTri', '/taisan/vi-tri/delete'),
('qDanhSachViTri', '/taisan/vi-tri/index'),
('qSuaViTri', '/taisan/vi-tri/update'),
('qXemViTri', '/taisan/vi-tri/view'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('deleteUsers', '/user-management/user/bulk-delete'),
('changeUserPassword', '/user-management/user/change-password'),
('createUsers', '/user-management/user/create'),
('deleteUsers', '/user-management/user/delete'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('editUsers', '/user-management/user/update'),
('viewUsers', '/user-management/user/view'),
('qThayDoiMatKhauCaNhan', '/user/auth/change-own-password'),
('qXemDashboard', '/user/default/index'),
('qGiaoDienThietBi', '/user/giao-dien/index'),
('qXoaTaiKhoan', '/user/user-ajax/bulkdelete'),
('qThemTaiKhoan', '/user/user-ajax/create'),
('qXoaTaiKhoan', '/user/user-ajax/delete'),
('qDanhSachTaiKhoan', '/user/user-ajax/index'),
('qXemTaiKhoan', '/user/user-ajax/index'),
('qSuaTaiKhoan', '/user/user-ajax/update'),
('qXemTaiKhoan', '/user/user-ajax/view'),
('qPhanQuyenTaiKhoan', '/user/user-permission/set'),
('qPhanQuyenTaiKhoan', '/user/user-permission/set-roles'),
('qXemHoatDongCaNhan', '/user/user/activity'),
('nQuanLyDanhMuc', 'qDanhMucNhomDoiTac'),
('nQuanLyBoPhan', 'qDanhSachBoPhan'),
('nXemTatCa', 'qDanhSachBoPhan'),
('nQuanLyDoiTac', 'qDanhSachDoiTac'),
('nXemTatCa', 'qDanhSachDoiTac'),
('nQuanLyHeThongThietBi', 'qDanhSachHeThongThietBi'),
('nXemTatCa', 'qDanhSachHeThongThietBi'),
('nQuanLyKho', 'qDanhSachKho'),
('nXemTatCa', 'qDanhSachKho'),
('nQuanLyLoaiThietBi', 'qDanhSachLoaiThietBi'),
('nXemTatCa', 'qDanhSachLoaiThietBi'),
('nQuanLyNhanVien', 'qDanhSachNhanVien'),
('nXemTatCa', 'qDanhSachNhanVien'),
('nQuanTriTaiKhoan', 'qDanhSachTaiKhoan'),
('nXemTatCa', 'qDanhSachTaiKhoan'),
('user_16_', 'qDanhSachTaiKhoan'),
('nQuanLyTaiSan', 'qDanhSachTaiSan'),
('nXemTatCa', 'qDanhSachTaiSan'),
('nQuanLyViTri', 'qDanhSachViTri'),
('nXemTatCa', 'qDanhSachViTri'),
('macdinh', 'qGiaoDienThietBi'),
('nQuanLyTaiSan', 'qInQrTaiSan'),
('user_16_', 'qInQrTaiSan'),
('nQuanTriTaiKhoan', 'qPhanQuyenTaiKhoan'),
('user_16_', 'qPhanQuyenTaiKhoan'),
('nQuanLyTaiSan', 'qScanQrTaiSan'),
('nXemTatCa', 'qScanQrTaiSan'),
('user_16_', 'qScanQrTaiSan'),
('nQuanLyBoPhan', 'qSuaBoPhan'),
('nQuanLyDoiTac', 'qSuaDoiTac'),
('nQuanLyHeThongThietBi', 'qSuaHeThongThietBi'),
('nQuanLyKho', 'qSuaKho'),
('nQuanLyLoaiThietBi', 'qSuaLoaiThietBi'),
('nQuanLyNhanVien', 'qSuaNhanVien'),
('nQuanTriTaiKhoan', 'qSuaTaiKhoan'),
('user_16_', 'qSuaTaiKhoan'),
('nQuanLyTaiSan', 'qSuaTaiSan'),
('user_16_', 'qSuaTaiSan'),
('nQuanLyViTri', 'qSuaViTri'),
('macdinh', 'qThayDoiMatKhauCaNhan'),
('nQuanLyBoPhan', 'qThemBoPhan'),
('nQuanLyDoiTac', 'qThemDoiTac'),
('nQuanLyHeThongThietBi', 'qThemHeThongThietBi'),
('nQuanLyKho', 'qThemKho'),
('nQuanLyLoaiThietBi', 'qThemLoaiThietBi'),
('nQuanLyNhanVien', 'qThemNhanVien'),
('nQuanTriTaiKhoan', 'qThemTaiKhoan'),
('user_16_', 'qThemTaiKhoan'),
('nQuanLyTaiSan', 'qThemTaiSan'),
('nQuanLyViTri', 'qThemViTri'),
('nQuanLyBoPhan', 'qXemBoPhan'),
('nXemTatCa', 'qXemBoPhan'),
('macdinh', 'qXemDashboard'),
('nQuanLyDoiTac', 'qXemDoiTac'),
('nXemTatCa', 'qXemDoiTac'),
('nQuanLyHeThongThietBi', 'qXemHeThongThietBi'),
('nXemTatCa', 'qXemHeThongThietBi'),
('macdinh', 'qXemHoatDongCaNhan'),
('nQuanLyKho', 'qXemKho'),
('nXemTatCa', 'qXemKho'),
('nQuanLyLoaiThietBi', 'qXemLoaiThietBi'),
('nXemTatCa', 'qXemLoaiThietBi'),
('nQuanLyNhanVien', 'qXemNhanVien'),
('nXemTatCa', 'qXemNhanVien'),
('nQuanTriTaiKhoan', 'qXemTaiKhoan'),
('nXemTatCa', 'qXemTaiKhoan'),
('qSuaTaiKhoan', 'qXemTaiKhoan'),
('qThemTaiKhoan', 'qXemTaiKhoan'),
('qXoaTaiKhoan', 'qXemTaiKhoan'),
('nQuanLyTaiSan', 'qXemTaiSan'),
('nXemTatCa', 'qXemTaiSan'),
('qInQrTaiSan', 'qXemTaiSan'),
('qScanQrTaiSan', 'qXemTaiSan'),
('nQuanLyViTri', 'qXemViTri'),
('nXemTatCa', 'qXemViTri'),
('nQuanLyBoPhan', 'qXoaBoPhan'),
('nQuanLyDoiTac', 'qXoaDoiTac'),
('nQuanLyHeThongThietBi', 'qXoaHeThongThietBi'),
('nQuanLyKho', 'qXoaKho'),
('nQuanLyLoaiThietBi', 'qXoaLoaiThietBi'),
('nQuanLyNhanVien', 'qXoaNhanVien'),
('nQuanTriTaiKhoan', 'qXoaTaiKhoan'),
('nQuanLyTaiSan', 'qXoaTaiSan'),
('nQuanLyViTri', 'qXoaViTri'),
('editUserEmail', 'viewUserEmail'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('changeUserPassword', 'viewUsers'),
('createUsers', 'viewUsers'),
('deleteUsers', 'viewUsers'),
('editUsers', 'viewUsers');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_group`
--

DROP TABLE IF EXISTS `auth_item_group`;
CREATE TABLE IF NOT EXISTS `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('accountsManage', 'Quản trị tài khoản người dùng', NULL, NULL),
('quanLyBoPhan', 'Quản lý Phòng ban - Bộ phận', NULL, NULL),
('quanLyDanhMuc', 'Quản lý danh mục', NULL, NULL),
('quanLyDoiTac', 'Quản lý đối tác', NULL, NULL),
('quanLyHeThongThietBi', 'Quản lý hệ thống thiết bị', NULL, NULL),
('quanLyKhoLuuTru', 'Quản lý kho lưu trữ', NULL, NULL),
('quanLyLoaiThietBi', 'Quản lý loại thiết bị', NULL, NULL),
('quanLyNhanVien', 'Quản lý nhân viên', NULL, NULL),
('quanLyTaiSan', 'Quản lý tài sản', NULL, NULL),
('quanLyViTri', 'Quản lý vị trí', NULL, NULL),
('userCommonPermissions', 'Quyền cho tài khoản', 1689001075, 1689001075),
('userManagement', 'User management', 1689001075, 1689001075);

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `superadmin` smallint(6) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `email_confirmed` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
(1, 'superadmin', 'Eh3yGaY9ys2CN7vmFwgJmN1aRu6aaUed', '$2y$13$PSqrfHBcnSig7v3YlWjRG.V5cNWTcCXAvTzS0YNyxudFgkfb91T0W', NULL, 1, 1, 1689001074, 1691109648, NULL, '', '', 0),
(2, 'u001', '0BGuWUbLL_Bf7HL969XStKm4DxEvRWBq', '$2y$13$c2TRCwOzJvGHD4DUeucfSuMMkJzIG0JIVybnE/chlgp.fSsu1zg96', NULL, 1, 0, 1689045928, 1691054879, '::1', '192.168.1.1', 'nguyenvana@gmail.com', 0),
(4, 'user003', 'c0ZYRq8LTpMVn3DZ96-j0__eHQs-rULR', '$2y$13$5oWUaqTVpr3vJTpx0USVMeWrJe6iGjnY7nWfIJrWGtnNw9Nqsn4da', NULL, 1, 0, 1689900390, 1689904172, '::1', '', 'a@gmail.copm', 0),
(6, 'nvc', 'fF9GmW625pEILPsVBLZYKn5MLILlXoix', '$2y$13$JGMS4C4aaL56j9mgbaEfmOFuj9UdAT3W2DrXmxwCo6Oj0s6G.eCym', NULL, 1, 0, 1689904220, 1691375956, '::1', '', '', 0),
(7, 'nvd', 'ebuerhq8ul2W59y3_f3mNTaB2hGII3QM', '$2y$13$HJfu8TuXeMDZZSq5GI8QhOnTfEa4LFUYorIS2QonKuNl1DUhWaD1q', NULL, 1, 0, 1691113587, 1691113587, '::1', '', '', 0),
(16, 'tyan4', 'fdLL6xxToj1wSKDLNVAUqaMyU-I9hHvN', '$2y$13$rPQnpSbV67F8gqaX47jCcut3JxqobYKmVImX2HRIDqNVjMmf0OtQS', NULL, 1, 0, 1691400376, 1691400376, '::1', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_visit_log`
--

DROP TABLE IF EXISTS `user_visit_log`;
CREATE TABLE IF NOT EXISTS `user_visit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_visit_log`
--

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(1, '64ac1d37ca7e3', '127.0.0.1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689001271, 'Chrome', 'Windows'),
(2, '64acb3bed5ec5', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689039806, 'Chrome', 'Windows'),
(3, '64acb70d6a873', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689040653, 'Chrome', 'Windows'),
(4, '64acb737330e5', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689040695, 'Chrome', 'Windows'),
(5, '64acb7fcc2409', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689040892, 'Chrome', 'Windows'),
(6, '64acc05a22083', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689043034, 'Chrome', 'Windows'),
(7, '64acc2c941e0d', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689043657, 'Chrome', 'Windows'),
(8, '64acc2d28c346', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689043666, 'Chrome', 'Windows'),
(9, '64acc33e167a7', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689043774, 'Chrome', 'Windows'),
(10, '64acc486d2377', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689044102, 'Chrome', 'Windows'),
(11, '64acc508bccd5', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689044232, 'Chrome', 'Windows'),
(12, '64acc7abc6b9a', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689044907, 'Chrome', 'Windows'),
(13, '64acc81c9c590', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689045020, 'Chrome', 'Windows'),
(14, '64acfaedbf81a', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689058029, 'Chrome', 'Windows'),
(15, '64ad1150dd4b2', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689063760, 'Chrome', 'Windows'),
(16, '64adf89b3beee', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689122971, 'Chrome', 'Windows'),
(17, '64ae020475511', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689125380, 'Chrome', 'Windows'),
(18, '64af6c8ea9c89', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689218190, 'Chrome', 'Windows'),
(19, '64b4a3b7820cf', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689559991, 'Chrome', 'Windows'),
(20, '64b5e052360a0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689641042, 'Chrome', 'Windows'),
(21, '64b636f76975e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689663223, 'Chrome', 'Windows'),
(22, '64b63aafc1b02', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689664175, 'Chrome', 'Windows'),
(23, '64b885dc0428b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689814492, 'Chrome', 'Windows'),
(24, '64b8e9535ecd9', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689839955, 'Chrome', 'Windows'),
(25, '64b9d53d212f0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689900349, 'Chrome', 'Windows'),
(26, '64b9dba7de6fb', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', NULL, 1689901991, 'Chrome', 'Windows'),
(27, '64b9de5bcea89', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', NULL, 1689902683, 'Chrome', 'Windows'),
(28, '64bb4c7662ea6', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689996406, 'Chrome', 'Windows'),
(29, '64be1ea575fd9', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690181285, 'Chrome', 'Windows'),
(30, '64bf34abd0975', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690252459, 'Chrome', 'Windows'),
(31, '64bf41e58e7c4', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690255845, 'Chrome', 'Windows'),
(32, '64bf8ea9678e0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690275497, 'Chrome', 'Windows'),
(33, '64bf9ab95a8fb', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690278585, 'Chrome', 'Windows'),
(34, '64c06dfd7e0ec', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690332669, 'Chrome', 'Windows'),
(35, '64c1be391be67', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690418745, 'Chrome', 'Windows'),
(36, '64c21d8b3f7d8', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690443147, 'Chrome', 'Windows'),
(37, '64c23d7a05552', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1690451322, 'Chrome', 'Windows'),
(38, '64c3262e4f893', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690510894, 'Chrome', 'Windows'),
(39, '64c370d624b2e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690530006, 'Chrome', 'Windows'),
(40, '64c474e113efd', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690596577, 'Chrome', 'Windows'),
(41, '64c7059d5721c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690764701, 'Chrome', 'Windows'),
(42, '64c85241bfc7f', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690849857, 'Chrome', 'Windows'),
(43, '64c9a0ec86c54', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1690935532, 'Chrome', 'Windows'),
(44, '64caf5e13a179', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691022817, 'Chrome', 'Windows'),
(45, '64cb56ed5789c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691047661, 'Chrome', 'Windows'),
(46, '64cb57fa7db2b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691047930, 'Chrome', 'Windows'),
(47, '64cb733645510', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691054902, 'Chrome', 'Windows'),
(48, '64cc47e9353b2', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691109353, 'Chrome', 'Windows'),
(49, '64cc48e552ee3', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 6, 1691109605, 'Chrome', 'Windows'),
(50, '64cc490102635', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691109633, 'Chrome', 'Windows'),
(51, '64cc4b05ecb90', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 6, 1691110149, 'Chrome', 'Windows'),
(52, '64ccaac9edc42', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691134665, 'Chrome', 'Windows'),
(53, '64cda83434a78', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691199540, 'Chrome', 'Windows'),
(54, '64d041b1b9263', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691369905, 'Chrome', 'Windows'),
(55, '64d0595fa5457', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 6, 1691375967, 'Chrome', 'Windows'),
(56, '64d1040d65d53', '127.0.0.1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691419661, 'Chrome', 'Windows'),
(57, '64d1f03bbf342', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 1, 1691480123, 'Chrome', 'Windows');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
