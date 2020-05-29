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
-- Cấu trúc bảng cho bảng `configuration`
--

CREATE TABLE `configuration` (
  `con_id` int(11) NOT NULL,
  `con_page_size` varchar(10) DEFAULT NULL,
  `con_left_size` varchar(10) DEFAULT NULL,
  `con_right_size` varchar(10) DEFAULT NULL,
  `con_admin_email` varchar(255) DEFAULT NULL,
  `con_site_title` varchar(255) DEFAULT NULL,
  `con_meta_description` text,
  `con_meta_keywords` text,
  `con_currency` varchar(20) DEFAULT NULL,
  `con_mod_rewrite` tinyint(1) DEFAULT '0',
  `con_lang_id` int(11) DEFAULT '1',
  `con_extenstion` varchar(20) DEFAULT 'html',
  `lang_id` int(11) DEFAULT '1',
  `con_contact` int(11) DEFAULT '0',
  `con_hotline` varchar(255) DEFAULT NULL,
  `con_hotline_banhang` varchar(255) DEFAULT NULL,
  `con_hotline_hotro_kythuat` varchar(255) DEFAULT NULL,
  `con_background_img` varchar(255) DEFAULT NULL,
  `con_background_color` varchar(50) DEFAULT NULL,
  `con_address` text,
  `con_image_path` varchar(255) DEFAULT NULL,
  `con_picture_path` varchar(255) DEFAULT NULL,
  `con_background_homepage` varchar(255) DEFAULT NULL,
  `con_theme_path` varchar(255) DEFAULT NULL,
  `con_info_payment` text,
  `con_fee_transport` text,
  `con_buy_shop` text,
  `con_contact_sale` text,
  `con_info_company` text,
  `con_logo_top` varchar(255) DEFAULT NULL,
  `con_logo_bottom` varchar(255) DEFAULT NULL,
  `con_page_fb` text,
  `con_link_fb` varchar(255) DEFAULT NULL,
  `con_link_twiter` varchar(255) DEFAULT NULL,
  `con_link_insta` varchar(255) DEFAULT NULL,
  `con_map` text,
  `con_footer` text,
  `con_video` text,
  `con_count_customer` int(11) DEFAULT NULL,
  `con_count_project` int(11) DEFAULT NULL,
  `con_count_ns` int(11) DEFAULT NULL,
  `con_img_contact` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Đang đổ dữ liệu cho bảng `configuration`
--

INSERT INTO `configuration` (`con_id`, `con_page_size`, `con_left_size`, `con_right_size`, `con_admin_email`, `con_site_title`, `con_meta_description`, `con_meta_keywords`, `con_currency`, `con_mod_rewrite`, `con_lang_id`, `con_extenstion`, `lang_id`, `con_contact`, `con_hotline`, `con_hotline_banhang`, `con_hotline_hotro_kythuat`, `con_background_img`, `con_background_color`, `con_address`, `con_image_path`, `con_picture_path`, `con_background_homepage`, `con_theme_path`, `con_info_payment`, `con_fee_transport`, `con_buy_shop`, `con_contact_sale`, `con_info_company`, `con_logo_top`, `con_logo_bottom`, `con_page_fb`, `con_link_fb`, `con_link_twiter`, `con_link_insta`, `con_map`, `con_footer`, `con_video`, `con_count_customer`, `con_count_project`, `con_count_ns`, `con_img_contact`) VALUES
(1, '1133', '215', '230', 'aeluxury', 'aeluxury', 'Chúng tôi làm việc để trở thành studio thiết kế và kiến ​​trúc quốc tế tốt nhất. Tập hợp các chuyên gia giỏi nhất trong nhóm của chúng tôi, chúng tôi thể hiện ước mơ của bạn theo phong cách độc đáo của chúng tôi. Mỗi ngày chúng tôi phát triển trong văn hóa kinh doanh của mình, tạo ra một môi trường thoải mái cho cuộc sống và công việc của bạn.\r\n\r\nChúng tôi được truyền cảm hứng và cải tiến tại các triển lãm chuyên nghiệp quốc tế và các sự kiện chuyên ngành. Cá nhân chúng tôi liên lạc với đại diện của các thương hiệu thời trang đồ nội thất độc quyền và thường sử dụng đồ nội thất được làm theo bản phác thảo riêng lẻ trong các dự án của chúng tôi.', 'aeluxury', 'VND', 1, 1, 'html', 1, 0, '0965.808.868', '04 632 77 555', '04 632 95 012', '', '#f6ebcf', 'Số 352, đường Giải Phóng, Phường Phương Liệt, Quận Thanh Xuân, TP Hà Nội', '', '', 'ktm1540045257.png', '', '<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Vietcombank:</strong>&nbsp;Trần xu&acirc;n diện : 0721000523747 Chi nh&aacute;nh Kỳ đồng<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Sacombank:</strong>&nbsp;Trần xu&acirc;n diện : 060099383677 CN Trung t&acirc;m<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Đ&ocirc;ng &Aacute;:</strong>&nbsp;Nguyễn thị tuyết trinh 0103674795 Chi nh&aacute;nh quy nhơn<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Agribank:&nbsp;</strong>Nguyễn thị tuyết trinh 1604205302028 CN Ph&uacute; nhuận<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Nam &Aacute;:</strong>&nbsp;Trần xu&acirc;n diện 701019611100001 CN B&igrave;nh Phước</p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\"><a href=\"http://dathangsi.vn/bangia\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\">DOWNLOAD BẢNG GI&Aacute; SỈ</a></strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\"><a href=\"http://dathangsi.vn/bangia/printer.php\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\">IN BẢNG GI&Aacute; SỈ</a></strong></p>\r\n', '<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Th&agrave;nh phố Hồ Ch&iacute; Minh​</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Nội th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">25K&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	-&nbsp;Ngoại th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">30K</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Huyện ngoại th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">35K</strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Tỉnh th&agrave;nh kh&aacute;c&nbsp;</strong>-&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">TL dưới 1Kg&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Miền Nam -&nbsp;T&acirc;y Nguy&ecirc;n ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">55K</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Miền Trung - Miền Bắc&nbsp;ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">60K</strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">H&agrave;ng cồng kềnh hoặc số lượng nhiều</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	Gủi ch&agrave;nh xe chi ph&iacute; từ&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">50K&nbsp;</strong>đến&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">100K</strong></p>\r\n<div>\r\n	&nbsp;</div>\r\n', '<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 102, 0); line-height: 22px; box-sizing: border-box;\">ĐỊA CHỈ:&nbsp;</strong><strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">37 Đường C27, Phường 12, Q.T&acirc;n B&igrave;nh, Tp.HCM&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	( Ho&agrave;ng Hoa Th&aacute;m &raquo; Nguyễn Minh Ho&agrave;n &raquo; Hẻm 58 &raquo; Đường C27 )</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<a href=\"https://www.google.com/maps/place/%C4%90%C6%B0%E1%BB%9Dng+C27,+Ph%C6%B0%E1%BB%9Dng+12,+T%C3%A2n+B%C3%ACnh,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7986851,106.6466218,17z/data=!4m5!3m4!1s0x317529496640fa6d:0x640e38f05c0947ee!8m2!3d10.7979895!4d106.6491324\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\" target=\"_blank\"><strong style=\"margin: 0px; padding: 0px; font-size: 15px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">&nbsp;Bản đồ chỉ dẫn đường đi</strong></a></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">GIỜ L&Agrave;M VIỆC: T2- T7 : TỪ 8h ĐẾN 18H !!!</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box; text-transform: uppercase;\">NGHĨ TRƯA TỪ 12H ĐẾN 13H30</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 102); line-height: 22px; box-sizing: border-box;\">QU&Iacute; KH&Aacute;CH VUI L&Ograve;NG TỚI TRONG GIỜ L&Agrave;M VIỆC</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 102); line-height: 22px; box-sizing: border-box;\">XIN CH&Acirc;N TH&Agrave;NH CẢM ƠN!!!</strong></p>\r\n', '<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch HCM</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0902 985 499</strong>&nbsp;<i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Th&uacute;y)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch Tỉnh</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0932 621 233</strong>&nbsp;<i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Hương)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Mua sỉ sll, nhận order</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0934 030 287&nbsp;</strong><i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Trinh)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">H&agrave;ng bảo h&agrave;nh kh&aacute;ch tỉnh</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0974 947 857&nbsp;</strong><i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Mr Trường)</i></p>\r\n', '<div class=\"phone-row\">\r\n	<a href=\"tel:+78126710054\">0965.808.868</a>&nbsp;|&nbsp;0865553336&nbsp;&ndash; Đặt h&agrave;ng dự &aacute;n</div>\r\n<div class=\"mail-row\">\r\n	&nbsp;</div>\r\n<div class=\"phone-row\">\r\n	aeluxury.vn@gmail.com &ndash; Li&ecirc;n hệ hỗ trợ</div>\r\n<p>\r\n	&nbsp;</p>\r\n<div class=\"adress-caption\">\r\n	Giờ mở cửa:<br />\r\n	Thứ 2 - Thứ 7 từ 8:30 đến 17:30<br />\r\n	<br />\r\n	&nbsp;</div>\r\n', 'evf1555557307.png', 'zuf1555557483.png', '', 'https://facebook.com', 'https://www.pinterest.com/aetuannguyen/', 'https://www.instagram.com/', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.141057928433!2d105.83396556538132!3d21.06702764184573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abbf0724b861%3A0x9194141770fd081b!2zQ8O0bmcgVHkgVE5ISCBRdeG7kWMgdOG6vyBUcsOgIEdpYW5n!5e0!3m2!1svi!2s!4v1539923453510\" width=\"100%\" height=\"350\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '<p style=\"text-align: center;\">\r\n	<span style=\"font-size:18px;\"><span style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(255, 255, 255);  background-color: rgb(14, 14, 14);\"><a href=\"tel:+79312705454\" style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: inherit; -webkit-font-smoothing: antialiased; background-color: transparent; color: rgb(203, 163, 124); text-decoration-line: none; outline: 0px; border: 0px; transition: all 0.2s ease-out 0s; display: inline-block; min-width: 184px;\">0965.808.868 - 086.555.3336</a>&nbsp; |&nbsp; aeluxury.vn@gmail.com&nbsp;</span><span style=\"color: rgb(255, 255, 255); font-family: Muller, Verdana, sans-serif; background-color: rgb(14, 14, 14);\">&nbsp;|&nbsp; Li&ecirc;n hệ hỗ trợ&nbsp;</span></span><br style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(255, 255, 255); font-size: 22px; background-color: rgb(14, 14, 14);\" />\r\n	&nbsp;</p>\r\n<p style=\"margin: 0px; padding: 0px; box-sizing: border-box; font-family: Muller, Verdana, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(255, 255, 255); background-color: rgb(14, 14, 14); text-align: center;\">\r\n	<span style=\"font-size: 18px;\">Địa chỉ: Số 352, Đường Giải Ph&oacute;ng, Phường Thanh Liệt, Quận Thanh Xu&acirc;n, TP H&agrave; Nội</span></p>\r\n', '<iframe width=\"100%\" height=\"300\" src=\"https://www.youtube.com/embed/f-n5csg25vg\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 5000, 8000, 60, 'nqa1555495240.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`con_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `configuration`
--
ALTER TABLE `configuration`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
