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
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `use_id` int(11) NOT NULL,
  `use_active` int(11) DEFAULT '0',
  `use_login` varchar(100) DEFAULT NULL,
  `use_password` varchar(50) DEFAULT NULL,
  `use_first_name` varchar(50) DEFAULT NULL,
  `use_last_name` varchar(50) DEFAULT NULL,
  `use_birthdays` varchar(10) DEFAULT NULL,
  `use_gender` int(11) DEFAULT '0',
  `use_city` int(11) DEFAULT '1',
  `use_phone` varchar(20) DEFAULT NULL,
  `use_fax` varchar(20) DEFAULT NULL,
  `use_email` varchar(100) DEFAULT NULL,
  `use_address` varchar(255) DEFAULT NULL,
  `use_date` int(11) DEFAULT '0',
  `use_group` int(11) DEFAULT '0',
  `use_security` varchar(255) DEFAULT NULL,
  `use_name` varchar(255) DEFAULT NULL,
  `use_admin` int(11) DEFAULT '0',
  `use_type` int(11) DEFAULT '0',
  `use_avatar` varchar(100) DEFAULT NULL,
  `use_avatar_facebook` text,
  `use_bank_account` varchar(255) DEFAULT NULL,
  `use_account_baokim` varchar(255) DEFAULT NULL,
  `use_token` text,
  `use_address_received` text,
  `use_baokim_confirm` tinyint(1) DEFAULT '0',
  `use_sources` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`),
  ADD UNIQUE KEY `use_email` (`use_email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
