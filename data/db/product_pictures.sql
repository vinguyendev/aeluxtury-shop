-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:50 AM
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
-- Cấu trúc bảng cho bảng `product_pictures`
--

CREATE TABLE `product_pictures` (
  `ppic_id` int(11) NOT NULL,
  `ppic_pictures` varchar(255) DEFAULT NULL,
  `ppic_note` varchar(255) DEFAULT NULL,
  `ppic_description` varchar(1000) DEFAULT NULL,
  `ppic_product_id` int(11) DEFAULT '0',
  `ppic_order` int(11) DEFAULT '0',
  `ppic_temp_key` varchar(255) DEFAULT NULL,
  `ppic_main_pic` tinyint(1) DEFAULT '0',
  `ppic_version` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `product_pictures`
--
ALTER TABLE `product_pictures`
  ADD PRIMARY KEY (`ppic_id`),
  ADD KEY `ppic_phagia_id` (`ppic_product_id`),
  ADD KEY `ppic_order` (`ppic_order`),
  ADD KEY `ppic_version` (`ppic_version`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `product_pictures`
--
ALTER TABLE `product_pictures`
  MODIFY `ppic_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
