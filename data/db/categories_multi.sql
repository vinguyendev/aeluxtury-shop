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
-- Cấu trúc bảng cho bảng `categories_multi`
--

CREATE TABLE `categories_multi` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_name_rewrite` varchar(266) DEFAULT NULL,
  `cat_order` int(5) DEFAULT NULL,
  `cat_picture` varchar(255) DEFAULT NULL,
  `cat_banner` varchar(255) DEFAULT NULL,
  `cat_banner_link` text,
  `cat_background` varchar(255) DEFAULT NULL,
  `cat_title` text,
  `cat_description` text,
  `cat_meta_keyword` text,
  `cat_meta_title` text,
  `cat_meta_description` text,
  `cat_active` int(1) DEFAULT '1',
  `lang_id` int(1) DEFAULT '1',
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_has_child` int(11) NOT NULL DEFAULT '1',
  `cat_all_child` varchar(255) DEFAULT NULL,
  `cat_type` varchar(100) DEFAULT NULL,
  `cat_hot` tinyint(4) DEFAULT '0',
  `admin_id` int(11) DEFAULT '0',
  `cat_show_mob` tinyint(1) DEFAULT '0',
  `cat_show` int(1) DEFAULT '0',
  `cat_create_time` int(11) DEFAULT '0',
  `cat_update_at` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categories_multi`
--

INSERT INTO `categories_multi` (`cat_id`, `cat_name`, `cat_name_rewrite`, `cat_order`, `cat_picture`, `cat_banner`, `cat_banner_link`, `cat_background`, `cat_title`, `cat_description`, `cat_meta_keyword`, `cat_meta_title`, `cat_meta_description`, `cat_active`, `lang_id`, `cat_parent_id`, `cat_has_child`, `cat_all_child`, `cat_type`, `cat_hot`, `admin_id`, `cat_show_mob`, `cat_show`, `cat_create_time`, `cat_update_at`) VALUES
(1, 'Giới thiệu', 'gioi-thieu', 1, NULL, NULL, NULL, NULL, NULL, '', 'Giới thiệu', 'Giới thiệu', 'Giới thiệu', 1, 1, 0, 0, '1', 'static', 0, 1, 0, 0, 1540038767, 1540038767),
(12, 'Dự án', 'du-an', 1, NULL, NULL, NULL, NULL, NULL, '', 'Dự án', 'Dự án', 'Chúng tôi thiết kế nội thất độc quyền của căn hộ, nhà ở nông thôn và nhà tranh ở St. Petersburg và vùng Leningrad.', 1, 1, 0, 1, '12,15,16,17,18', 'product', 0, 1, 0, 0, 1553842606, 1555402468),
(4, 'Tin tức', 'tin-tuc', 1, NULL, NULL, NULL, NULL, NULL, '', 'Tin tức', 'Tin tức', 'Tin tức', 1, 1, 0, 1, '4,19,20,21', 'news', 0, 1, 0, 0, 1540038821, 1555388996),
(5, 'Liên hệ', 'lien-he', 1, NULL, NULL, NULL, NULL, NULL, '', 'Liên hệ', 'Liên hệ', 'Liên hệ', 1, 1, 0, 0, '5', 'static', 0, 1, 0, 0, 1540038896, 1540038896),
(15, 'Nội thất biệt thự', 'noi-that-biet-thu', 1, 'myp1555401247.jpg', NULL, NULL, NULL, NULL, '<ul>\r\n	<li>\r\n		Biệt thự Khu đô thị mới</li>\r\n	<li>\r\n		Biệt thự Biển</li>\r\n	<li>\r\n		Biệt thự nhà vườn</li>\r\n	<li>\r\n		Nhà phố</li>\r\n	<li>\r\n		Biệt thự cao cấp</li>\r\n</ul>', 'Nội thất biệt thự', 'Nội thất biệt thự', 'Nhà thiết kế nội thất Biệt Thự chuyên nghiệp', 1, 1, 12, 0, '15', 'product', 1, 1, 0, 0, 1555401247, 1556874468),
(16, 'Nội thất chung cư', 'noi-that-chung-cu', 2, 'lkp1556874731.jpg', NULL, NULL, NULL, NULL, '<ul>\r\n	<li>\r\n		Nội thất Penthouse</li>\r\n	<li>\r\n		Nội thất chung cư cao cấp</li>\r\n	<li>\r\n		Nội thất Duplex</li>\r\n	<li>\r\n		Nội thất căn hộ Vinhomes</li>\r\n	<li>\r\n		Nội thất căn hộ Luxury</li>\r\n</ul>', 'Nội thất chung cư', 'Nội thất chung cư', 'Nhà thiết kế nội thất Penthouse Pro', 1, 1, 12, 0, '16', 'product', 1, 1, 0, 0, 1555401403, 1556874731),
(17, 'Thiết kế kiên trúc', 'thiet-ke-kien-truc', 3, 'lut1555401478.jpg', NULL, NULL, NULL, NULL, '<ul>\r\n	<li>\r\n		Khách sạn &amp; Nhà hàng</li>\r\n	<li>\r\n		Biệt thự &amp; Nhà chia lô</li>\r\n	<li>\r\n		Apartment &amp; Building</li>\r\n</ul>', 'Thiết kế kiên trúc', 'Thiết kế kiên trúc', 'Tiêu chí của chúng tôi là Tư vấn giải pháp tổng thể, đồng bộ & kinh tế - Đem lại cho khách hàng những giá trị về Thẩm mỹ & Kinh tế nhất', 1, 1, 12, 0, '17', 'product', 1, 1, 0, 0, 1555401478, 1556875948),
(18, 'Nội thất nhà hàng & khách sạn', 'noi-that-nha-hang-khach-san', 4, 'yot1555401520.jpg', NULL, NULL, NULL, NULL, '', 'Nội thất nhà hàng & khách sạn', 'Nội thất nhà hàng & khách sạn', 'chuyên gia thiết kế Nội thất nhà hàng & khách sạn', 1, 1, 12, 0, '18', 'product', 1, 1, 0, 0, 1555401520, 1556876369),
(19, 'Sự kiện', 'su-kien', 1, NULL, NULL, NULL, NULL, NULL, '', 'Sự kiện', 'Sự kiện', 'Sự kiện', 1, 1, 4, 0, '19', 'news', 0, 1, 0, 0, 1555576216, 1555576216),
(20, 'Không gian sống', 'khong-gian-song', 2, NULL, NULL, NULL, NULL, NULL, '', 'Không gian sống', 'Không gian sống', 'Không gian sống', 1, 1, 4, 0, '20', 'news', 0, 1, 0, 0, 1555576225, 1555576225),
(21, 'Tuyển dụng', 'tuyen-dung', 3, NULL, NULL, NULL, NULL, NULL, '', 'Tuyển dụng', 'Tuyển dụng', 'Tuyển dụng', 1, 1, 4, 0, '21', 'news', 0, 1, 0, 0, 1555576239, 1555576239),
(22, 'Video', 'video', 1, NULL, NULL, NULL, NULL, NULL, '', 'Video', 'Video', 'Video', 1, 1, 0, 0, '22', 'news', 0, 1, 0, 0, 1555576345, 1555576345);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories_multi`
--
ALTER TABLE `categories_multi`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_parent_id` (`cat_parent_id`),
  ADD KEY `cat_order` (`cat_order`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories_multi`
--
ALTER TABLE `categories_multi`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
