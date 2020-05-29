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
-- Cấu trúc bảng cho bảng `album`
--

CREATE TABLE `album` (
  `alb_id` int(11) NOT NULL,
  `alb_title` varchar(255) DEFAULT NULL,
  `alb_image` varchar(255) DEFAULT NULL,
  `alb_order` int(11) DEFAULT '0',
  `alb_active` tinyint(1) DEFAULT '0',
  `alb_create_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `album`
--

INSERT INTO `album` (`alb_id`, `alb_title`, `alb_image`, `alb_order`, `alb_active`, `alb_create_time`) VALUES
(1, 'Anh 1', 'puy1540523495.jpg', 1, 1, 1540523495),
(2, 'Anh 2', 'eed1540523505.jpg', 2, 1, 1540523505),
(3, 'Anh 3', 'rqp1540523597.jpg', 3, 1, 1540523597),
(4, 'Anh 4', 'fkg1540523603.jpg', 4, 1, 1540523603);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`alb_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `album`
--
ALTER TABLE `album`
  MODIFY `alb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
