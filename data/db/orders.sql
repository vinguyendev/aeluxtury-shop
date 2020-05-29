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
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ord_name` varchar(255) DEFAULT NULL,
  `ord_email` varchar(255) DEFAULT NULL,
  `ord_address` varchar(255) DEFAULT NULL,
  `ord_phone` varchar(255) DEFAULT NULL,
  `ord_address_other_info` text,
  `ord_status` int(1) DEFAULT '0',
  `ord_code` varchar(255) DEFAULT NULL,
  `ord_date` int(11) DEFAULT '0',
  `ord_payment` int(11) DEFAULT '0',
  `ord_method_pay` varchar(50) NOT NULL,
  `admin_id` int(11) DEFAULT '0',
  `lang_id` int(11) DEFAULT '1',
  `ord_city` int(11) DEFAULT '0',
  `ord_district` int(11) DEFAULT '0',
  `ord_user_id` int(11) DEFAULT '0',
  `ord_note` varchar(255) DEFAULT NULL,
  `ord_time_ship` tinyint(1) DEFAULT NULL,
  `ord_note_customer` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_name`, `ord_email`, `ord_address`, `ord_phone`, `ord_address_other_info`, `ord_status`, `ord_code`, `ord_date`, `ord_payment`, `ord_method_pay`, `admin_id`, `lang_id`, `ord_city`, `ord_district`, `ord_user_id`, `ord_note`, `ord_time_ship`, `ord_note_customer`) VALUES
(2, 'trần quang minh', 'minh@gmail.com', 'phòng P123TSP - 102 Thái Thịnh', '123 123123', NULL, 2, NULL, 1540882831, 1050000, '0', 1, 1, 0, 0, 0, '123', NULL, '123123123'),
(3, 'trần quang minh', 'minh@gmail.com', '12312', '123123123', NULL, 0, NULL, 1540883459, 350000, '0', 0, 1, 0, 0, 0, NULL, NULL, ''),
(4, 'trần quang minh', 'minh@gmail.com', '12312', '123123123', NULL, 0, NULL, 1540883465, 0, '0', 0, 1, 0, 0, 0, NULL, NULL, ''),
(5, 'trần quang minh', 'minh@gmail.com', '123123', '123123', NULL, 0, NULL, 1540883578, 350000, '0', 0, 1, 0, 0, 0, NULL, NULL, '123123'),
(6, 'trần quang minh', 'minh@gmail.com', '123123', '123123', NULL, 0, NULL, 1540883631, 350000, '0', 0, 1, 0, 0, 0, NULL, NULL, ''),
(7, 'trần quang minh', 'minh@gmail.com', '123123', '123123', NULL, 0, NULL, 1540883676, 0, '0', 0, 1, 0, 0, 0, NULL, NULL, ''),
(8, 'trần quang minh', 'minh@gmail.com', '123123', '123123', NULL, 0, NULL, 1540883779, 400000, '0', 0, 1, 0, 0, 0, NULL, NULL, '12312312'),
(9, 'Trần Quang', '', 'Thai Thịnh 102', '363814855', NULL, 0, NULL, 1546592308, 350000, 'COD', 0, 1, 5, 16, 0, NULL, NULL, ''),
(10, 'Trần Quang', '', 'Thai Thịnh 102', '363814855', NULL, 0, NULL, 1547535173, 350000, 'COD', 0, 1, 167, 170, 0, NULL, NULL, ''),
(11, 'Trần Quang', '', 'Thai Thịnh 102', '363814855', NULL, 0, NULL, 1547535246, 750000, 'COD', 0, 1, 177, 179, 0, NULL, NULL, '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
