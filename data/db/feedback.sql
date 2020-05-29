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
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `feb_id` int(11) NOT NULL,
  `fed_logo` varchar(255) DEFAULT NULL,
  `fed_name` varchar(255) DEFAULT NULL,
  `fed_pos` varchar(255) DEFAULT NULL,
  `fed_company` varchar(255) DEFAULT NULL,
  `fed_star` int(11) DEFAULT '0',
  `fed_content` text,
  `fed_create_time` int(11) DEFAULT '0',
  `fed_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`feb_id`, `fed_logo`, `fed_name`, `fed_pos`, `fed_company`, `fed_star`, `fed_content`, `fed_create_time`, `fed_active`) VALUES
(1, 'hgg1554094092.jpg', 'Anh Minh', 'CEO', 'Công ty MTQ', 5, ' <p>Tôi xin chân thành cảm ơn đội ngũ của Sao Kim đã <strong>rất sáng tạo</strong> và <strong>nhiệt tình hỗ trợ kịp thời, nhanh chóng, đúng hẹn</strong>. Elita đặc biệt hài lòng với nhận diện thương hiệu mới do Sao Kim thiết kế.</p>\r\n                <p>Chúng tôi sẽ tiếp tục hợp tác cùng Sao Kim trong quá trình phát triển thương hiệu sau này.</p>', 1554094004, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feb_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
