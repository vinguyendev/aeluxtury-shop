-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:45 AM
-- Phiên bản máy phục vụ: 5.5.56-cll-lve
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `waeluxu8_luxury`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `mod_id` int(11) NOT NULL,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` varchar(100) DEFAULT NULL,
  `mod_listfile` varchar(100) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `mod_help` mediumtext,
  `lang_id` int(11) DEFAULT '1',
  `mod_checkloca` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`mod_id`, `mod_name`, `mod_path`, `mod_listname`, `mod_listfile`, `mod_order`, `mod_help`, `lang_id`, `mod_checkloca`) VALUES
(1, 'Quản trị admin', 'admin_user', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(2, 'Quản lý banner', 'banners', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(3, 'Danh mục', 'categories_multi', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(5, 'Trang tĩnh', 'statics_multi', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(6, 'Tin tức', 'news_multi', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(7, 'Cấu hình website', 'configuration', 'Cấu hình', 'configuration.php', 0, NULL, 1, 0),
(8, 'Quản lý menu', 'menus', 'Add|Listing', 'add.php|listing.php', 0, NULL, 1, 0),
(20, 'Quản lý nhân sự', 'personnel', 'Listing|Add', 'listing.php|add.php', 0, NULL, 1, 0),
(14, 'Quản lý dự án', 'product', 'Listing|Add', 'listing.php|add.php', 0, NULL, 1, 0),
(19, 'Quản lý dự án', 'products', 'Listing|Add', 'listing.php|add.php', 0, NULL, 1, 0),
(18, 'Quản lý About', 'about', 'Cấu hình About', 'configuration.php', 0, NULL, 1, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`mod_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
