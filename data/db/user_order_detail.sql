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
-- Cấu trúc bảng cho bảng `user_order_detail`
--

CREATE TABLE `user_order_detail` (
  `uod_id` int(11) NOT NULL,
  `uod_order_id` int(11) NOT NULL DEFAULT '0',
  `uod_product_id` int(11) NOT NULL DEFAULT '0',
  `uod_product_size_color_id` varchar(255) DEFAULT NULL,
  `uod_quantity` int(11) NOT NULL DEFAULT '0',
  `uod_price` double NOT NULL DEFAULT '0',
  `uod_total_money` int(11) NOT NULL DEFAULT '0',
  `uod_last_update` int(11) NOT NULL DEFAULT '0',
  `uod_status` tinyint(3) DEFAULT '0',
  `uod_size` int(11) DEFAULT '0',
  `uod_color` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_order_detail`
--

INSERT INTO `user_order_detail` (`uod_id`, `uod_order_id`, `uod_product_id`, `uod_product_size_color_id`, `uod_quantity`, `uod_price`, `uod_total_money`, `uod_last_update`, `uod_status`, `uod_size`, `uod_color`) VALUES
(1, 17, 18, NULL, 1, 80000000, 80000000, 1510028082, 0, 0, 0),
(2, 17, 16, NULL, 1, 80000000, 80000000, 1510028082, 0, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user_order_detail`
--
ALTER TABLE `user_order_detail`
  ADD PRIMARY KEY (`uod_id`),
  ADD UNIQUE KEY `uod_order_id` (`uod_order_id`,`uod_product_id`,`uod_product_size_color_id`),
  ADD KEY `uod_status` (`uod_status`),
  ADD KEY `uod_product_id` (`uod_product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user_order_detail`
--
ALTER TABLE `user_order_detail`
  MODIFY `uod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
