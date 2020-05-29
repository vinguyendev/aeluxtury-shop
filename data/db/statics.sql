-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:51 AM
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
-- Cấu trúc bảng cho bảng `statics`
--

CREATE TABLE `statics` (
  `sta_id` int(11) UNSIGNED NOT NULL,
  `sta_category_id` int(11) DEFAULT '0',
  `sta_title` varchar(255) DEFAULT NULL,
  `sta_order` double DEFAULT '0',
  `sta_description` text,
  `sta_date` int(11) DEFAULT '0',
  `lang_id` tinyint(1) DEFAULT '1',
  `sta_new` tinyint(1) NOT NULL DEFAULT '0',
  `sta_active` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `statics`
--

INSERT INTO `statics` (`sta_id`, `sta_category_id`, `sta_title`, `sta_order`, `sta_description`, `sta_date`, `lang_id`, `sta_new`, `sta_active`) VALUES
(1, 1, ' Giới thiệu', 0, '<p>\r\n	&nbsp;Giới thiệu</p>\r\n', 1540524610, 1, 0, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `statics`
--
ALTER TABLE `statics`
  ADD PRIMARY KEY (`sta_id`),
  ADD KEY `sta_category_id` (`sta_category_id`),
  ADD KEY `sta_order` (`sta_order`),
  ADD KEY `sta_date` (`sta_date`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `statics`
--
ALTER TABLE `statics`
  MODIFY `sta_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
