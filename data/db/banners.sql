-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:43 AM
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
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `ban_id` int(11) NOT NULL,
  `ban_name` varchar(255) DEFAULT NULL,
  `ban_picture` varchar(255) DEFAULT NULL,
  `ban_link` text,
  `ban_description` text,
  `ban_target` varchar(255) DEFAULT '_blank',
  `ban_type` int(11) DEFAULT '0',
  `ban_position` tinyint(2) DEFAULT '0',
  `ban_date` int(11) DEFAULT '0',
  `ban_active` tinyint(4) NOT NULL DEFAULT '0',
  `ban_order` int(11) NOT NULL DEFAULT '0',
  `ban_end_time` int(11) DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`ban_id`, `ban_name`, `ban_picture`, `ban_link`, `ban_description`, `ban_target`, `ban_type`, `ban_position`, `ban_date`, `ban_active`, `ban_order`, `ban_end_time`, `admin_id`, `lang_id`) VALUES
(2, 'home', 'foz1556878208.jpg', '/', '', '_blank', 1, 1, 1553844079, 1, 1, 0, 1, 1),
(3, 'home1', 'jpm1556878203.jpg', '/', '', '_blank', 1, 1, 1553844338, 1, 2, 0, 1, 1),
(5, 'home3', 'kbb1556878198.jpg', '/', '', '_blank', 1, 1, 1555397543, 1, 3, 0, 1, 1),
(6, 'home', 'wzb1556878191.jpg', '/', '', '_blank', 1, 1, 1556876935, 1, 4, 0, 1, 1),
(7, 'home5', 'tdj1556878219.jpg', '/', '', '_blank', 1, 1, 1556878219, 1, 5, 0, 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ban_id`),
  ADD KEY `ban_order` (`ban_order`),
  ADD KEY `ban_active` (`ban_active`),
  ADD KEY `ban_position` (`ban_position`),
  ADD KEY `ban_type` (`ban_type`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
