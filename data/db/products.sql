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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_code` varchar(50) DEFAULT NULL,
  `pro_code_md5` varchar(255) DEFAULT NULL,
  `pro_short_name` varchar(255) DEFAULT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `pro_search` text CHARACTER SET utf8 COLLATE utf8_bin,
  `pro_meta_keywords` text,
  `pro_meta_h1` varchar(255) DEFAULT NULL,
  `pro_meta_title` text,
  `pro_meta_description` text,
  `pro_tags` text,
  `pro_link_video` text,
  `pro_picture_video` varchar(255) DEFAULT NULL,
  `pro_attribute_data` text,
  `pro_fullbox` text,
  `pro_price` double DEFAULT NULL,
  `pro_import_prices` double DEFAULT '0',
  `pro_sale_prices` double NOT NULL DEFAULT '0',
  `pro_percent` int(11) NOT NULL DEFAULT '0',
  `pro_quantity` int(11) DEFAULT '0',
  `pro_picture` varchar(255) DEFAULT NULL,
  `pro_banner` varchar(255) DEFAULT NULL,
  `pro_picture_mob` varchar(255) DEFAULT NULL,
  `pro_category_id` int(11) DEFAULT '0',
  `pro_create_time` int(11) DEFAULT NULL,
  `pro_update_time` int(11) DEFAULT NULL,
  `lang_id` tinyint(1) DEFAULT '0',
  `admin_id` int(11) DEFAULT NULL,
  `pro_total_buy` text,
  `pro_active` tinyint(1) DEFAULT '1',
  `pro_order` int(11) DEFAULT '0',
  `pro_hot` tinyint(1) DEFAULT '0',
  `pro_deal` tinyint(4) NOT NULL DEFAULT '0',
  `pro_sale` tinyint(4) NOT NULL DEFAULT '0',
  `pro_new` tinyint(4) NOT NULL DEFAULT '0',
  `pro_banchay` tinyint(4) NOT NULL DEFAULT '0',
  `pro_giatot` tinyint(4) NOT NULL DEFAULT '0',
  `pro_show_home` tinyint(4) NOT NULL DEFAULT '0',
  `pro_color_background` varchar(255) DEFAULT NULL,
  `pro_picture_background` varchar(255) DEFAULT NULL,
  `pro_has_child` int(11) DEFAULT '0',
  `pro_parent_id` int(11) DEFAULT '0',
  `pro_technical` text,
  `pro_description` text,
  `pro_overview` text,
  `pro_moreinfo` text,
  `pro_picture_json` text,
  `pro_meta_keyword` varchar(255) DEFAULT NULL,
  `pro_content` text,
  `pro_brand_id` int(11) DEFAULT '0',
  `pro_pivot_check` tinyint(1) DEFAULT '0',
  `pro_status` tinyint(2) DEFAULT '0',
  `pro_onl_off` tinyint(1) DEFAULT '0',
  `pro_mil` double DEFAULT '0',
  `pro_promotion` int(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`pro_id`, `pro_code`, `pro_code_md5`, `pro_short_name`, `pro_name`, `pro_search`, `pro_meta_keywords`, `pro_meta_h1`, `pro_meta_title`, `pro_meta_description`, `pro_tags`, `pro_link_video`, `pro_picture_video`, `pro_attribute_data`, `pro_fullbox`, `pro_price`, `pro_import_prices`, `pro_sale_prices`, `pro_percent`, `pro_quantity`, `pro_picture`, `pro_banner`, `pro_picture_mob`, `pro_category_id`, `pro_create_time`, `pro_update_time`, `lang_id`, `admin_id`, `pro_total_buy`, `pro_active`, `pro_order`, `pro_hot`, `pro_deal`, `pro_sale`, `pro_new`, `pro_banchay`, `pro_giatot`, `pro_show_home`, `pro_color_background`, `pro_picture_background`, `pro_has_child`, `pro_parent_id`, `pro_technical`, `pro_description`, `pro_overview`, `pro_moreinfo`, `pro_picture_json`, `pro_meta_keyword`, `pro_content`, `pro_brand_id`, `pro_pivot_check`, `pro_status`, `pro_onl_off`, `pro_mil`, `pro_promotion`) VALUES
(6, NULL, NULL, NULL, 'Lê Hồng Phong - Ba Đình - Hà Nội', NULL, NULL, NULL, 'Chung cư khu vực Hà Đông', 'Chung cư khu vực Hà Đông', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '1555489742_ttq1555489742.jpg', NULL, NULL, 18, 1555489750, 1556876158, 0, 1, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '<p>\r\n	Chung cư khu vực H&agrave; Đ&ocirc;ng</p>\r\n', NULL, NULL, 'W3sibmFtZSI6IjE1NTY4NzYwNDdfdHdrMTU1Njg3NjA0Ny5qcGcifSx7Im5hbWUiOiIxNTU2ODc2MDY0X2N2djE1NTY4NzYwNjQuanBnIn0seyJuYW1lIjoiMTU1Njg3NjA4Ml9taGoxNTU2ODc2MDgyLmpwZyJ9LHsibmFtZSI6IjE1NTY4NzYxNTRfenBsMTU1Njg3NjE1NC5qcGcifV0=', 'Chung cư khu vực Hà Đông', '', 0, 0, 0, 0, 750, 0),
(5, NULL, NULL, NULL, 'Biệt thự Tây Hồ - Hà Nội', NULL, NULL, NULL, 'Biệt thự ở khu vực Hồ Tây', 'Biệt thự ở khu vực Hồ Tây', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '1555403360_qcu1555403360.jpg', NULL, NULL, 15, 1555403416, 1556876287, 0, 1, NULL, 1, 0, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '<div class=\"content-snippet-width1010-img1010-col2\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; max-width: 1010px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-text\" style=\"box-sizing: border-box; font-family: Merriweather, &quot;Times New Roman&quot;, serif; -webkit-font-smoothing: antialiased; display: inline-block; margin-top: 30px; font-size: 16px; position: relative; z-index: 10; line-height: 1.5; column-count: 2; column-gap: 60px; overflow: hidden;\">\r\n		<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\"><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Ch&uacute;ng t&ocirc;i một lần nữa ở khu vực Moscow v&agrave; h&acirc;n hạnh giới thiệu với bạn dự &aacute;n mới của ch&uacute;ng t&ocirc;i về một ng&ocirc;i nh&agrave; rộng 400 m2.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Lần n&agrave;y ch&uacute;ng t&ocirc;i sẽ bắt đầu c&acirc;u chuyện của ch&uacute;ng t&ocirc;i về dự &aacute;n từ ph&ograve;ng tắm v&agrave; điều n&agrave;y kh&ocirc;ng phải l&agrave; ngẫu nhi&ecirc;n.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Chủ nh&acirc;n của ng&ocirc;i nh&agrave; muốn nh&igrave;n thấy hai ph&ograve;ng tắm, một cho nữ v&agrave; một cho nam, cho ph&eacute;p ch&uacute;ng t&ocirc;i tạo ra hai nội thất, theo c&ugrave;ng một hướng, c&oacute; sự kh&aacute;c biệt của ri&ecirc;ng họ v&agrave; một niềm say m&ecirc; nhất định.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Ph&ograve;ng vệ sinh sang trọng, được trang tr&iacute; bằng khảm Sicis s&agrave;nh điệu với những b&ocirc;ng hoa huệ trắng tuyệt đẹp, h&agrave;i h&ograve;a với những bức tường s&aacute;ng m&agrave;u v&agrave; s&agrave;n gạch Rex.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Từng chi tiết, mảnh đồ nội thất đều n&oacute;i l&ecirc;n sự tinh tế của b&agrave; chủ nh&agrave; trọ, cho d&ugrave; đ&oacute; l&agrave; một chiếc đ&egrave;n ch&ugrave;m Serip thanh lịch hay một chiếc b&agrave;n Longhi kh&aacute;c thường.</font></font></div>\r\n</div>\r\n<div class=\"content-snippet-width750-cont750\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-abs-square\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; position: absolute; width: 460px; right: 0px; top: -80px;\">\r\n		&nbsp;</div>\r\n	<div class=\"content-snippet-wrap\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; max-width: 750px; margin: 0px auto;\">\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Muller, Verdana, sans-serif; font-size: 14px;\">&nbsp;&nbsp;</span></p>\r\n<div class=\"content-snippet-width1010-img1010-col2\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; max-width: 1010px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-image\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased;\">\r\n		<a class=\"fancybox\" href=\"https://www.studia-54.ru/upload/medialibrary/413/2.jpg\" rel=\"images\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; background-color: transparent; color: rgb(203, 163, 124); text-decoration-line: none; border: 0px; transition: all 0.2s ease-out 0s; outline: none !important;\"><img alt=\"2.jpg\" src=\"https://www.studia-54.ru/upload/medialibrary/413/2.jpg\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; border: 0px; vertical-align: middle; outline: 0px; max-width: 100%; height: auto; width: 1010px; position: relative; z-index: 10;\" title=\"2.jpg\" /></a>\r\n		<div class=\"content-img-desc\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; text-align: center; padding: 5px 0px; color: rgb(147, 147, 147);\">\r\n			<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Khảm Sicis s&agrave;nh điệu với hoa huệ trắng tuyệt đẹp h&agrave;i h&ograve;a với tường v&agrave; s&agrave;n s&aacute;ng</font></div>\r\n	</div>\r\n	<div class=\"content-snippet-text\" style=\"box-sizing: border-box; font-family: Merriweather, &quot;Times New Roman&quot;, serif; -webkit-font-smoothing: antialiased; display: inline-block; margin-top: 30px; font-size: 16px; position: relative; z-index: 10; line-height: 1.5; column-count: 2; column-gap: 60px; overflow: hidden;\">\r\n		<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Nếu bạn nh&igrave;n kỹ, th&igrave; trong hầu hết mọi yếu tố trang tr&iacute; ph&ograve;ng bạn sẽ t&igrave;m thấy c&aacute;c chi tiết bằng đồng, kh&ocirc;ng chỉ hợp nhất kh&ocirc;ng gian, m&agrave; c&ograve;n nhấn mạnh vẻ đẹp của từng đồ vật ri&ecirc;ng lẻ.</font></div>\r\n</div>\r\n<div class=\"content-snippet-width750-cont750\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-abs-square\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; position: absolute; width: 460px; right: 0px; top: -80px;\">\r\n		&nbsp;</div>\r\n	<div class=\"content-snippet-wrap\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; max-width: 750px; margin: 0px auto;\">\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Muller, Verdana, sans-serif; font-size: 14px;\">&nbsp;&nbsp;</span></p>\r\n<div class=\"content-snippet-width1010-img1010-col2\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; max-width: 1010px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-image\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased;\">\r\n		<a class=\"fancybox\" href=\"https://www.studia-54.ru/upload/medialibrary/785/3.jpg\" rel=\"images\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; background-color: transparent; color: rgb(203, 163, 124); text-decoration-line: none; border: 0px; transition: all 0.2s ease-out 0s; outline: none !important;\"><img alt=\"3.jpg\" src=\"https://www.studia-54.ru/upload/medialibrary/785/3.jpg\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; border: 0px; vertical-align: middle; outline: 0px; max-width: 100%; height: auto; width: 1010px; position: relative; z-index: 10;\" title=\"3.jpg\" /></a>\r\n		<div class=\"content-img-desc\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; text-align: center; padding: 5px 0px; color: rgb(147, 147, 147);\">\r\n			<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Đ&egrave;n đồng hồ c&aacute;t Cattelan Italia</font></div>\r\n	</div>\r\n	<div class=\"content-snippet-text\" style=\"box-sizing: border-box; font-family: Merriweather, &quot;Times New Roman&quot;, serif; -webkit-font-smoothing: antialiased; display: inline-block; margin-top: 30px; font-size: 16px; position: relative; z-index: 10; line-height: 1.5; column-count: 2; column-gap: 60px; overflow: hidden;\">\r\n		<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\"><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Trong phần n&agrave;y của ph&ograve;ng tắm, ch&uacute;ng t&ocirc;i đ&atilde; lắp đặt một chiếc gương lớn tr&ecirc;n s&agrave;n, mở rộng kh&ocirc;ng gian một c&aacute;ch trực quan.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Khung bằng đồng, &aacute;nh s&aacute;ng dịu rơi tr&ecirc;n những tấm gỗ m&agrave;u &oacute;c ch&oacute; tinh tế tạo ra bầu kh&ocirc;ng kh&iacute; thoải m&aacute;i v&agrave; ấm &aacute;p.&nbsp;</font><font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Bồn rửa được kết hợp với b&agrave;n trang điểm, tr&ecirc;n đ&oacute; treo một chiếc đ&egrave;n kh&aacute;c thường c&oacute; h&igrave;nh đồng hồ c&aacute;t Cattelan Italia.</font></font></div>\r\n</div>\r\n<div class=\"content-snippet-width750-cont750\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-abs-square\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; position: absolute; width: 460px; right: 0px; top: -80px;\">\r\n		&nbsp;</div>\r\n	<div class=\"content-snippet-wrap\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; max-width: 750px; margin: 0px auto;\">\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-family: Muller, Verdana, sans-serif; font-size: 14px;\">&nbsp;&nbsp;</span></p>\r\n<div class=\"content-snippet-width1010-img1010-col2\" style=\"box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; position: relative; z-index: 100; margin: 0px auto 80px; max-width: 1010px; width: 1010px; color: rgb(0, 0, 0); font-size: 14px;\">\r\n	<div class=\"content-snippet-image\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased;\">\r\n		<a class=\"fancybox\" href=\"https://www.studia-54.ru/upload/medialibrary/562/4.jpg\" rel=\"images\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; background-color: transparent; color: rgb(203, 163, 124); text-decoration-line: none; border: 0px; transition: all 0.2s ease-out 0s; outline: none !important;\"><img alt=\"4.jpg\" src=\"https://www.studia-54.ru/upload/medialibrary/562/4.jpg\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; border: 0px; vertical-align: middle; outline: 0px; max-width: 100%; height: auto; width: 1010px; position: relative; z-index: 10;\" title=\"4.jpg\" /></a>\r\n		<div class=\"content-img-desc\" style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; text-align: center; padding: 5px 0px; color: rgb(147, 147, 147);\">\r\n			<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Mặt d&acirc;y đ&egrave;n Bocci</font></div>\r\n	</div>\r\n	<div class=\"content-snippet-text\" style=\"box-sizing: border-box; font-family: Merriweather, &quot;Times New Roman&quot;, serif; -webkit-font-smoothing: antialiased; display: inline-block; margin-top: 30px; font-size: 16px; position: relative; z-index: 10; line-height: 1.5; column-count: 2; column-gap: 60px; overflow: hidden;\">\r\n		<font style=\"box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; vertical-align: inherit;\">Nếu ch&uacute;ng ta n&oacute;i về sự dịu d&agrave;ng v&agrave; tinh tế của nội thất trong ph&ograve;ng tắm của phụ nữ, th&igrave; phần nam lại ngược lại: sự nghi&ecirc;m trọng của c&aacute;c h&igrave;nh thức, sự hiện diện của c&aacute;c yếu tố trang tr&iacute; trong m&agrave;u tối, như bức tranh của Karim Ghidinelli.</font></div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, NULL, 'W3sibmFtZSI6IjE1NTY4NzYyNDVfaWdjMTU1Njg3NjI0NS5qcGcifSx7Im5hbWUiOiIxNTU2ODc2MjY0X2dkaDE1NTY4NzYyNjQucG5nIn0seyJuYW1lIjoiMTU1Njg3NjI2N19qb3YxNTU2ODc2MjY3LnBuZyJ9LHsibmFtZSI6IjE1NTY4NzYyNzBfaWVqMTU1Njg3NjI3MC5wbmcifV0=', 'Biệt thự ở khu vực Hồ Tây', '', 0, 0, 0, 0, 800, 0),
(7, NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, '1556875370_rgk1556875370.jpg', NULL, NULL, 0, 1556875389, 1556875389, 0, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, NULL, '', NULL, NULL, 'W3sibmFtZSI6IjE1NTY4NzUzNzBfcmdrMTU1Njg3NTM3MC5qcGcifV0=', '', '', 0, 0, 0, 0, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `pro_category_id` (`pro_category_id`),
  ADD KEY `pro_date` (`pro_create_time`),
  ADD KEY `pro_active` (`pro_active`),
  ADD KEY `pro_order` (`pro_order`),
  ADD KEY `pro_hot` (`pro_hot`);
ALTER TABLE `products` ADD FULLTEXT KEY `pro_search` (`pro_search`);
ALTER TABLE `products` ADD FULLTEXT KEY `pro_short_name` (`pro_short_name`);
ALTER TABLE `products` ADD FULLTEXT KEY `pro_name` (`pro_name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
