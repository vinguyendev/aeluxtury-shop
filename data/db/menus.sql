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
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `mnu_id` int(11) NOT NULL,
  `mnu_name` varchar(255) DEFAULT NULL,
  `mnu_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `mnu_link` text,
  `mnu_target` varchar(10) DEFAULT '_self',
  `mnu_type` tinyint(3) DEFAULT '1',
  `mnu_position` int(11) NOT NULL DEFAULT '0',
  `mnu_order` double DEFAULT '0',
  `mnu_parent_id` int(11) DEFAULT '0',
  `mnu_has_child` int(1) DEFAULT '0',
  `mnu_defined` varchar(255) DEFAULT NULL,
  `mnu_active` tinyint(1) DEFAULT '1',
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `mnu_all_child` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`mnu_id`, `mnu_name`, `mnu_picture`, `mnu_link`, `mnu_target`, `mnu_type`, `mnu_position`, `mnu_order`, `mnu_parent_id`, `mnu_has_child`, `mnu_defined`, `mnu_active`, `lang_id`, `admin_id`, `mnu_all_child`) VALUES
(26, 'Thiết kế kiến trúc', NULL, '/category/tin-tuc/thiet-ke-kien-truc-id17', '_self', 1, 1, 0, 23, 0, NULL, 1, 1, 0, NULL),
(25, 'Nội thất chung cư', NULL, '/category/tin-tuc/noi-that-chung-cu-id16', '_self', 1, 1, 2, 23, 0, NULL, 1, 1, 0, NULL),
(24, 'Nội thất biệt thự', NULL, '/category/tin-tuc/noi-that-biet-thu-id15', '_self', 1, 1, 1, 23, 0, NULL, 1, 1, 0, NULL),
(22, 'Tin tức', NULL, '/tin-tuc/tin-tuc.html', '_self', 1, 1, 4, 0, 1, NULL, 1, 1, 0, NULL),
(23, 'Dự án', NULL, '/category/du-an-id12', '_self', 1, 1, 3, 0, 1, NULL, 1, 1, 0, NULL),
(27, 'Nội thất nhà hàng & khách sạn', NULL, '/category/tin-tuc/noi-that-nha-hang-khach-san-id18', '_self', 1, 1, 4, 23, 0, NULL, 1, 1, 0, NULL),
(28, 'Sự kiện', NULL, '/tin-tuc/su-kien.html', '_self', 1, 1, 1, 22, 0, NULL, 1, 1, 0, NULL),
(29, 'Không gian sống', NULL, '/tin-tuc/khong-gian-song.html', '_self', 1, 1, 2, 22, 0, NULL, 1, 1, 0, NULL),
(30, 'Tuyển dụng', NULL, '/tin-tuc/tuyen-dung.html', '_self', 1, 1, 3, 22, 0, NULL, 1, 1, 0, NULL),
(31, 'Video', NULL, '/tin-tuc/video.html', '_self', 1, 1, 5, 0, 0, NULL, 1, 1, 0, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`mnu_id`),
  ADD KEY `mnu_order` (`mnu_order`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `mnu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
