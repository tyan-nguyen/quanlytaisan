-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2023 at 07:42 AM
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
('Admin', 1, 1689123036),
('Admin', 3, 1689046410),
('role_delete', 2, 1689238800),
('role_delete', 3, 1689125159);

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
('/debug/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/db-explain', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/download-mail', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/index', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/toolbar', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/default/view', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/user/*', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/user/reset-identity', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
('/debug/user/set-identity', 3, NULL, NULL, NULL, 1689001075, 1689001075, NULL),
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
('/site/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/about', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/captcha', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/contact', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/error', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/login', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/site/logout', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
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
('/user/user-ajax/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/bulkdelete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/create', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/delete', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/index', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/update', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-ajax/view', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/set', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user-permission/set-roles', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
('/user/user/*', 3, NULL, NULL, NULL, 1689123866, 1689123866, NULL),
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
('Admin', 1, 'Admin', NULL, NULL, 1689001075, 1689001075, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1689001075, 1689001075, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1689001074, 1689001074, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1689001075, 1689001075, 'userManagement'),
('quyenQuanTriTaiKhoan', 2, 'Toàn quyền quản trị tài khoản', NULL, NULL, 1689124583, 1689124583, 'accountsManage'),
('quyenSuaTaiKhoan', 2, 'Sửa tài khoản', NULL, NULL, 1689124200, 1689124200, 'accountsManage'),
('quyenThemTaiKhoan', 2, 'Thêm tài khoản', NULL, NULL, 1689123863, 1689123863, 'accountsManage'),
('quyenXemTaiKhoan', 2, 'Xem tài khoản', NULL, NULL, 1689124249, 1689124249, 'accountsManage'),
('quyenXoaTaiKhoan', 2, 'Xóa tài khoản', NULL, NULL, 1689124228, 1689124228, 'accountsManage'),
('role_delete', 1, 'Quyền xóa', NULL, NULL, 1689123301, 1689125688, NULL),
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
('changeOwnPassword', '/user-management/auth/change-own-password'),
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
('quyenXoaTaiKhoan', '/user/user-ajax/bulkdelete'),
('quyenThemTaiKhoan', '/user/user-ajax/create'),
('quyenXoaTaiKhoan', '/user/user-ajax/delete'),
('quyenXemTaiKhoan', '/user/user-ajax/index'),
('quyenSuaTaiKhoan', '/user/user-ajax/update'),
('quyenXemTaiKhoan', '/user/user-ajax/view'),
('Admin', 'assignRolesToUsers'),
('Admin', 'changeOwnPassword'),
('Admin', 'changeUserPassword'),
('Admin', 'createUsers'),
('Admin', 'deleteUsers'),
('Admin', 'editUsers'),
('role_delete', 'quyenQuanTriTaiKhoan'),
('quyenQuanTriTaiKhoan', 'quyenSuaTaiKhoan'),
('quyenQuanTriTaiKhoan', 'quyenThemTaiKhoan'),
('quyenQuanTriTaiKhoan', 'quyenXemTaiKhoan'),
('quyenSuaTaiKhoan', 'quyenXemTaiKhoan'),
('quyenThemTaiKhoan', 'quyenXemTaiKhoan'),
('quyenXoaTaiKhoan', 'quyenXemTaiKhoan'),
('quyenQuanTriTaiKhoan', 'quyenXoaTaiKhoan'),
('editUserEmail', 'viewUserEmail'),
('assignRolesToUsers', 'viewUserRoles'),
('Admin', 'viewUsers'),
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
('userCommonPermissions', 'User common permission', 1689001075, 1689001075),
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
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1689001070),
('m140608_173539_create_user_table', 1689001073),
('m140611_133903_init_rbac', 1689001073),
('m140808_073114_create_auth_item_group_table', 1689001074),
('m140809_072112_insert_superadmin_to_user', 1689001074),
('m140809_073114_insert_common_permisison_to_auth_item', 1689001074),
('m141023_141535_create_user_visit_log', 1689001074),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1689001074),
('m141121_194858_split_browser_and_os_column', 1689001075),
('m141201_220516_add_email_and_email_confirmed_to_user', 1689001075),
('m141207_001649_create_basic_user_permissions', 1689001075);

-- --------------------------------------------------------

--
-- Table structure for table `ts_bo_phan`
--

DROP TABLE IF EXISTS `ts_bo_phan`;
CREATE TABLE IF NOT EXISTS `ts_bo_phan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_bo_phan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_bo_phan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `truc_thuoc` int(11) DEFAULT NULL,
  `la_dv_quan_ly` tinyint(1) DEFAULT NULL,
  `la_dv_su_dung` tinyint(1) DEFAULT NULL,
  `la_dv_bao_tri` tinyint(1) DEFAULT NULL,
  `la_dv_van_tai` tinyint(1) DEFAULT NULL,
  `la_dv_mua_hang` tinyint(1) DEFAULT NULL,
  `la_dv_quan_ly_kho` tinyint(1) DEFAULT NULL,
  `la_trung_tam_chi_phi` tinyint(1) DEFAULT NULL,
  `id_kho_vat_tu` int(11) DEFAULT NULL,
  `id_kho_phe_lieu` int(11) DEFAULT NULL,
  `id_kho_thanh_pham` int(11) DEFAULT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_bo_phan`
--

INSERT INTO `ts_bo_phan` (`id`, `ma_bo_phan`, `ten_bo_phan`, `truc_thuoc`, `la_dv_quan_ly`, `la_dv_su_dung`, `la_dv_bao_tri`, `la_dv_van_tai`, `la_dv_mua_hang`, `la_dv_quan_ly_kho`, `la_trung_tam_chi_phi`, `id_kho_vat_tu`, `id_kho_phe_lieu`, `id_kho_thanh_pham`, `thoi_gian_tao`, `nguoi_tao`) VALUES
(1, 'BP001', 'Bộ phận A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ts_doi_tac`
--

DROP TABLE IF EXISTS `ts_doi_tac`;
CREATE TABLE IF NOT EXISTS `ts_doi_tac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_doi_tac` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_doi_tac` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_nhom_doi_tac` int(11) NOT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tai_khoan_ngan_hang` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_so_thue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `la_nha_cung_cap` tinyint(1) DEFAULT NULL,
  `la_khach_hang` tinyint(1) DEFAULT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_nhom_doi_tac` (`id_nhom_doi_tac`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_he_thong`
--

DROP TABLE IF EXISTS `ts_he_thong`;
CREATE TABLE IF NOT EXISTS `ts_he_thong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_he_thong` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_he_thong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `truc_thuoc` int(11) DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_hinh_anh`
--

DROP TABLE IF EXISTS `ts_hinh_anh`;
CREATE TABLE IF NOT EXISTS `ts_hinh_anh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_tham_chieu` int(11) NOT NULL,
  `ten_hien_thi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duong_dan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file_luu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_extension` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_size` float DEFAULT NULL,
  `img_wh` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_history`
--

DROP TABLE IF EXISTS `ts_history`;
CREATE TABLE IF NOT EXISTS `ts_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_tham_chieu` int(11) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_history`
--

INSERT INTO `ts_history` (`id`, `loai`, `id_tham_chieu`, `noi_dung`, `thoi_gian_tao`, `nguoi_tao`) VALUES
(10, 'nhanvien', 3, '<p>Thay đổi Email \"nguyenvanc7@gmail.com\" thành \"nguyenvanc@gmail.com\"</p>', '2023-07-20 09:44:42', 1),
(11, 'nhanvien', 4, 'Thực hiện thêm mới dữ liệu thành công.', '2023-07-20 09:53:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ts_ke_hoach_bao_tri`
--

DROP TABLE IF EXISTS `ts_ke_hoach_bao_tri`;
CREATE TABLE IF NOT EXISTS `ts_ke_hoach_bao_tri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_he_thong` int(11) DEFAULT NULL,
  `id_thiet_bi` int(11) NOT NULL,
  `id_chi_tiet` int(11) DEFAULT NULL,
  `ten_cong_viec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_loai_bao_tri` int(11) NOT NULL,
  `ngay_bao_tri_cuoi` date DEFAULT NULL,
  `bao_truoc` smallint(6) NOT NULL,
  `can_cu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_ky` tinyint(4) DEFAULT NULL,
  `ky_bao_tri` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_don_vi_bao_tri` int(11) NOT NULL,
  `id_nguoi_chiu_trach_nhiem` int(11) NOT NULL,
  `muc_do_uu_tien` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `truc_thuoc` int(11) DEFAULT NULL,
  `thoi_gian_thuc_hien` float DEFAULT NULL,
  `don_vi_thoi_gian` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dung_may` tinyint(1) DEFAULT NULL,
  `thue_ngoai` tinyint(1) DEFAULT NULL,
  `da_het_hieu_luc` tinyint(1) DEFAULT NULL,
  `ngay_het_hieu_luc` date DEFAULT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_thiet_bi` (`id_thiet_bi`),
  KEY `id_loai_bao_tri` (`id_loai_bao_tri`),
  KEY `id_don_vi_bao_tri` (`id_don_vi_bao_tri`),
  KEY `id_nguoi_chiu_trach_nhiem` (`id_nguoi_chiu_trach_nhiem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_kho_luu_tru`
--

DROP TABLE IF EXISTS `ts_kho_luu_tru`;
CREATE TABLE IF NOT EXISTS `ts_kho_luu_tru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_kho` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_kho` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loai_kho` int(11) NOT NULL,
  `id_nguoi_quan_ly` int(11) NOT NULL,
  `id_bo_phan_quan_ly` int(11) NOT NULL,
  `gia_tri_toi_da` int(11) DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_nguoi_quan_ly` (`id_nguoi_quan_ly`),
  KEY `id_bo_phan_quan_ly` (`id_bo_phan_quan_ly`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_loai_bao_tri`
--

DROP TABLE IF EXISTS `ts_loai_bao_tri`;
CREATE TABLE IF NOT EXISTS `ts_loai_bao_tri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_loai_thiet_bi`
--

DROP TABLE IF EXISTS `ts_loai_thiet_bi`;
CREATE TABLE IF NOT EXISTS `ts_loai_thiet_bi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_loai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_loai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_tinh` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `truc_thuoc` int(11) DEFAULT NULL,
  `loai_thiet_bi` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_nhan_vien`
--

DROP TABLE IF EXISTS `ts_nhan_vien`;
CREATE TABLE IF NOT EXISTS `ts_nhan_vien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bo_phan` int(11) NOT NULL,
  `ma_nhan_vien` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_nhan_vien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioi_tinh` tinyint(1) DEFAULT NULL,
  `ten_truy_cap` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_vao_lam` date DEFAULT NULL,
  `da_thoi_viec` tinyint(1) DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_bo_phan` (`id_bo_phan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ts_nhan_vien`
--

INSERT INTO `ts_nhan_vien` (`id`, `id_bo_phan`, `ma_nhan_vien`, `ten_nhan_vien`, `ngay_sinh`, `gioi_tinh`, `ten_truy_cap`, `ngay_vao_lam`, `da_thoi_viec`, `dien_thoai`, `email`, `dia_chi`, `thoi_gian_tao`, `nguoi_tao`) VALUES
(1, 1, 'NV001', 'Nguyễn Văn A', '01/01/1989', 0, 'nvtan', NULL, 0, '0374711908', 'nguyenvantyan@gmail.com', 'ấp Dừa Đỏ 2, xã Nhị Long Phú, huyện Càng Long, tỉnh Trà Vinh.', '2023-07-17 09:41:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ts_nhan_vien_kho`
--

DROP TABLE IF EXISTS `ts_nhan_vien_kho`;
CREATE TABLE IF NOT EXISTS `ts_nhan_vien_kho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kho` int(11) NOT NULL,
  `id_nhan_vien` int(11) NOT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `la_quan_ly_kho` tinyint(1) DEFAULT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kho` (`id_kho`),
  KEY `id_nhan_vien` (`id_nhan_vien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_nhom_doi_tac`
--

DROP TABLE IF EXISTS `ts_nhom_doi_tac`;
CREATE TABLE IF NOT EXISTS `ts_nhom_doi_tac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_nhom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_nhom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_tai_lieu`
--

DROP TABLE IF EXISTS `ts_tai_lieu`;
CREATE TABLE IF NOT EXISTS `ts_tai_lieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_tham_chieu` int(11) NOT NULL,
  `ten_tai_lieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duong_dan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file_luu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_extension` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime NOT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_thiet_bi`
--

DROP TABLE IF EXISTS `ts_thiet_bi`;
CREATE TABLE IF NOT EXISTS `ts_thiet_bi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_thiet_bi` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_vi_tri` int(11) DEFAULT NULL,
  `id_he_thong` int(11) DEFAULT NULL,
  `id_loai_thiet_bi` int(11) NOT NULL,
  `id_bo_phan_quan_ly` int(11) NOT NULL,
  `ten_thiet_bi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_thiet_bi_cha` int(11) DEFAULT NULL,
  `id_layout` int(11) DEFAULT NULL,
  `nam_san_xuat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xuat_xu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_hang_bao_hanh` int(11) DEFAULT NULL,
  `id_nhien_lieu` int(11) DEFAULT NULL,
  `dac_tinh_ky_thuat` text COLLATE utf8_unicode_ci,
  `id_lop_hu_hong` int(11) DEFAULT NULL,
  `id_trung_tam_chi_phi` int(11) DEFAULT NULL,
  `id_don_vi_bao_tri` int(11) DEFAULT NULL,
  `id_nguoi_quan_ly` int(11) NOT NULL,
  `ngay_mua` date DEFAULT NULL,
  `han_bao_hanh` date DEFAULT NULL,
  `ngay_dua_vao_su_dung` date DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_ngung_hoat_dong` date DEFAULT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_loai_thiet_bi` (`id_loai_thiet_bi`),
  KEY `id_bo_phan_quan_ly` (`id_bo_phan_quan_ly`),
  KEY `id_nguoi_quan_ly` (`id_nguoi_quan_ly`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_vi_tri`
--

DROP TABLE IF EXISTS `ts_vi_tri`;
CREATE TABLE IF NOT EXISTS `ts_vi_tri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_vi_tri` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ten_vi_tri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `truc_thuoc` int(11) DEFAULT NULL,
  `da_ngung_hoat_dong` tinyint(1) DEFAULT NULL,
  `ngay_ngung_hoat_dong` date DEFAULT NULL,
  `id_layout` int(11) DEFAULT NULL,
  `toa_do_x` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toa_do_y` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoi_gian_tao` datetime DEFAULT NULL,
  `nguoi_tao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_layout` (`id_layout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `confirmation_token`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `bind_to_ip`, `email`, `email_confirmed`) VALUES
(1, 'superadmin', 'Eh3yGaY9ys2CN7vmFwgJmN1aRu6aaUed', '$2y$13$tTb2OHDmbOK.OACF3j2uSuV09TRaUtQh2JZzOTJxR40exkK9V0DHi', NULL, 1, 1, 1689001074, 1689576183, NULL, '', '', 0),
(2, 'u001', '0BGuWUbLL_Bf7HL969XStKm4DxEvRWBq', '$2y$13$n1.zETMUwsguV2oXkaWPAezpVdR5hvEL3/Cpzh.oj.0krHton4ZnO', NULL, 1, 0, 1689045928, 1689060641, '::1', '', 'nguyenvana@gmail.com', 0),
(3, 'u002', 'jacIaoxolS-QjgGzJXNPap5Qwd1Facio', '$2y$13$MFrgliK9h.slFPE/wkv2SecfBXfzyva8IIDTX9I7f2sXKSO401xsK', NULL, 1, 0, 1689045979, 1689564809, '::1', '127.0.0.1', '', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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
(23, '64b885dc0428b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, 1689814492, 'Chrome', 'Windows');

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
-- Constraints for table `ts_doi_tac`
--
ALTER TABLE `ts_doi_tac`
  ADD CONSTRAINT `ts_doi_tac_ibfk_1` FOREIGN KEY (`id_nhom_doi_tac`) REFERENCES `ts_nhom_doi_tac` (`id`);

--
-- Constraints for table `ts_ke_hoach_bao_tri`
--
ALTER TABLE `ts_ke_hoach_bao_tri`
  ADD CONSTRAINT `ts_ke_hoach_bao_tri_ibfk_1` FOREIGN KEY (`id_thiet_bi`) REFERENCES `ts_thiet_bi` (`id`),
  ADD CONSTRAINT `ts_ke_hoach_bao_tri_ibfk_2` FOREIGN KEY (`id_loai_bao_tri`) REFERENCES `ts_loai_bao_tri` (`id`),
  ADD CONSTRAINT `ts_ke_hoach_bao_tri_ibfk_3` FOREIGN KEY (`id_don_vi_bao_tri`) REFERENCES `ts_bo_phan` (`id`),
  ADD CONSTRAINT `ts_ke_hoach_bao_tri_ibfk_4` FOREIGN KEY (`id_nguoi_chiu_trach_nhiem`) REFERENCES `ts_nhan_vien` (`id`);

--
-- Constraints for table `ts_nhan_vien`
--
ALTER TABLE `ts_nhan_vien`
  ADD CONSTRAINT `ts_nhan_vien_ibfk_1` FOREIGN KEY (`id_bo_phan`) REFERENCES `ts_bo_phan` (`id`);

--
-- Constraints for table `ts_nhan_vien_kho`
--
ALTER TABLE `ts_nhan_vien_kho`
  ADD CONSTRAINT `ts_nhan_vien_kho_ibfk_1` FOREIGN KEY (`id_kho`) REFERENCES `ts_kho_luu_tru` (`id`),
  ADD CONSTRAINT `ts_nhan_vien_kho_ibfk_2` FOREIGN KEY (`id_nhan_vien`) REFERENCES `ts_nhan_vien` (`id`);

--
-- Constraints for table `ts_thiet_bi`
--
ALTER TABLE `ts_thiet_bi`
  ADD CONSTRAINT `ts_thiet_bi_ibfk_1` FOREIGN KEY (`id_loai_thiet_bi`) REFERENCES `ts_loai_thiet_bi` (`id`),
  ADD CONSTRAINT `ts_thiet_bi_ibfk_2` FOREIGN KEY (`id_bo_phan_quan_ly`) REFERENCES `ts_bo_phan` (`id`),
  ADD CONSTRAINT `ts_thiet_bi_ibfk_3` FOREIGN KEY (`id_nguoi_quan_ly`) REFERENCES `ts_nhan_vien` (`id`);

--
-- Constraints for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
