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
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `odd_order_id` int(11) NOT NULL,
  `odd_product_id` int(11) NOT NULL,
  `odd_quantity` int(11) NOT NULL DEFAULT '0',
  `odd_status` tinyint(2) NOT NULL DEFAULT '0',
  `odd_prices` double(11,0) DEFAULT '0',
  `odd_color` int(11) DEFAULT '0',
  `odd_size` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`odd_order_id`, `odd_product_id`, `odd_quantity`, `odd_status`, `odd_prices`, `odd_color`, `odd_size`) VALUES
(2, 3, 3, 0, 350000, 0, 0),
(3, 3, 1, 0, 350000, 0, 0),
(5, 3, 1, 0, 350000, 0, 0),
(6, 3, 1, 0, 350000, 0, 0),
(8, 2, 1, 0, 400000, 0, 0),
(9, 3, 1, 0, 350000, 0, 0),
(10, 3, 1, 0, 350000, 0, 0),
(11, 2, 1, 0, 400000, 0, 0),
(11, 3, 1, 0, 350000, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`odd_order_id`,`odd_product_id`),
  ADD KEY `odd_order_id` (`odd_order_id`),
  ADD KEY `odd_product_id` (`odd_product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
