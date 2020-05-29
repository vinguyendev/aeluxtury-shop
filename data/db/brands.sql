-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:44 AM
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
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `bra_id` int(11) NOT NULL,
  `bra_name` varchar(255) DEFAULT NULL,
  `bra_picture` varchar(255) DEFAULT NULL,
  `bra_order` int(2) DEFAULT '0',
  `bra_date` int(11) DEFAULT '0',
  `bra_active` tinyint(1) DEFAULT '0',
  `bra_link` varchar(255) DEFAULT NULL,
  `admin_id` int(11) DEFAULT '0',
  `lang_id` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`bra_id`, `bra_name`, `bra_picture`, `bra_order`, `bra_date`, `bra_active`, `bra_link`, `admin_id`, `lang_id`) VALUES
(1, 'framesi', 'zct1540178540.jpg', 1, 1540178683, 1, '/', 1, 1),
(2, 'Moto', 'qvb1540178851.jpg', 2, 1540178851, 1, '/', 1, 1),
(3, 'maca', 'lue1540178868.jpg', 3, 1540178868, 1, '', 1, 1),
(4, 'chih', 'fkc1540178881.jpg', 4, 1540178881, 1, '', 1, 1),
(5, 'pivot', 'cvf1540178897.jpg', 5, 1540178897, 1, '', 1, 1),
(6, 'selec', 'zvz1540178914.jpg', 6, 1540178914, 1, '', 1, 1),
(7, '24hlamdep', 'zut1540178927.jpg', 7, 1540178927, 1, '', 1, 1),
(8, 'demi', 'ukl1540178938.jpg', 10, 1540178938, 1, '', 1, 1),
(9, 'beautiful', 'obc1540178950.jpg', 11, 1540178950, 1, '', 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bra_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `bra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
