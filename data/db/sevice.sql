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
-- Cấu trúc bảng cho bảng `sevice`
--

CREATE TABLE `sevice` (
  `sev_id` int(11) NOT NULL,
  `sev_title` varchar(255) DEFAULT NULL,
  `sev_content` text,
  `sev_active` tinyint(1) DEFAULT '0',
  `sev_create_time` int(11) DEFAULT '0',
  `sev_update_time` int(11) DEFAULT '0',
  `admin_id` int(11) DEFAULT '0',
  `sev_parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sevice`
--

INSERT INTO `sevice` (`sev_id`, `sev_title`, `sev_content`, `sev_active`, `sev_create_time`, `sev_update_time`, `admin_id`, `sev_parent_id`) VALUES
(1, 'Thiết kế nhận diện thương hiệu', '<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	Một logo được thiết kế để tạo ra sự nhận biết ngay tức thời, tạo ra sự tin tưởng, chấp nhận, l&ograve;ng trung th&agrave;nh v&agrave; h&agrave;m chứa c&aacute;c th&ocirc;ng điệp của thương hiệu.Logo được sử dụng để ph&acirc;n biệt Nếu như c&oacute; một h&igrave;nh ảnh n&agrave;o đ&oacute; l&agrave;m kh&aacute;ch h&agrave;ng dễ d&agrave;ng li&ecirc;n tưởng tới c&ocirc;ng ty bạn nhiều nhất th&igrave; đ&oacute; ch&iacute;nh l&agrave; logo.Nếu như bạn coi c&ocirc;ng việc kinh doanh của m&igrave;nh l&agrave; nghi&ecirc;m t&uacute;c v&agrave; chuy&ecirc;n nghiệp, bạn h&atilde;y nghĩ đến việc thiết kế logo tương xứng.giữa thương hiệu n&agrave;y với thương hiệu kh&aacute;c trong kinh doanh cũng như trong đời sống x&atilde; hội.<br style=\"box-sizing: border-box;\" />\r\n	Hiểu được vai tr&ograve; quan trọng của logo đối với h&igrave;nh ảnh tổ chức, thương hiệu,&nbsp;<span style=\"box-sizing: border-box; font-weight: 700;\">95Designer</span>&nbsp;cung cấp dịch vụ thiết kế logo, nhận diện thương hiệu gi&uacute;p bạn kết nối c&ocirc;ng việc kinh doanh của m&igrave;nh với kh&aacute;ch h&agrave;ng một c&aacute;ch đầy cảm hứng v&agrave; s&aacute;ng tạo.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	<img alt=\"\" class=\"size-large wp-image-1652 aligncenter\" height=\"1024\" sizes=\"(max-width: 936px) 100vw, 936px\" src=\"https://95designer.com/wp-content/uploads/dich-vu/23-936x1024.jpg\" srcset=\"https://95designer.com/wp-content/uploads/dich-vu/23.jpg 936w, https://95designer.com/wp-content/uploads/dich-vu/23-274x300.jpg 274w, https://95designer.com/wp-content/uploads/dich-vu/23-768x840.jpg 768w\" style=\"box-sizing: border-box; border: 0px; max-width: 100%; height: auto; display: block; margin: 0px auto 30px;\" width=\"936\" /></p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	DỊCH VỤ THIẾT KẾ LOGO CHUY&Ecirc;N NGHIỆP CỦA 95Designer MANG ĐẾN CHO BẠN<br style=\"box-sizing: border-box;\" />\r\n	&ndash; Một logo truyền tải được sứ mệnh kinh doanh của bạn: Bất kể lĩnh vực kinh doanh của bạn c&oacute; phức tạp v&agrave; kh&oacute; diễn giải đến đ&acirc;u, ch&uacute;ng t&ocirc;i sẽ gi&uacute;p bạn truyền tải được những th&ocirc;ng điệp của m&igrave;nh qua logo một c&aacute;ch đơn giản v&agrave; s&acirc;u sắc nhất.<br style=\"box-sizing: border-box;\" />\r\n	&ndash; Một logo được nhận biết tức th&igrave; bởi kh&aacute;ch h&agrave;ng mục ti&ecirc;u của bạn: bởi v&igrave; ch&uacute;ng t&ocirc;i lu&ocirc;n thiết kế logo của bạn một c&aacute;ch độc đ&aacute;o, kh&aacute;c biệt đồng thời l&agrave;m cho n&oacute; đơn giản v&agrave; dễ nhớ. Kh&aacute;ch h&agrave;ng của bạn sẽ nhận ra bạn nổi bật giữa những h&agrave;ng t&aacute; đối thủ cạnh tranh.<br style=\"box-sizing: border-box;\" />\r\n	&ndash; Một logo m&agrave; bạn lu&ocirc;n thực sự sở hữu n&oacute;: Cũng như bạn, ch&uacute;ng t&ocirc;i xem logo l&agrave; một t&agrave;i sản quan trọng. Quy tr&igrave;nh của ch&uacute;ng t&ocirc;i đảm bảo việc thiết kế logo độc đ&aacute;o v&agrave; kh&aacute;c biệt. V&agrave; tr&ecirc;n hết, bạn lu&ocirc;n c&oacute; thể đăng k&yacute; sở hữu tr&iacute; tuệ cho mẫu logo v&agrave; 95Designer sẵn s&agrave;ng gi&uacute;p bạn đăng k&yacute; bản quyền Logo của bạn &ndash; bạn ho&agrave;n to&agrave;n sở hữu n&oacute;.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	VỚI DỊCH VỤ THIẾT KẾ LOGO CỦA 95Designer&nbsp;BẠN SẼ NHẬN ĐƯỢC:<br style=\"box-sizing: border-box;\" />\r\n	+ Một logo được thiết kế ấn tượng v&agrave; ph&ugrave; hợp với lĩnh vực hoạt động.<br style=\"box-sizing: border-box;\" />\r\n	+Bộ cẩm nang hướng dẫn sử dụng logo: quy định mầu sắc, font chữ, tỷ lệ tr&ecirc;n &ocirc; lưới, c&aacute;c trường hợp sử dụng, chống sử dụng cho logo, bản thuyết minh &yacute; nghĩa logo.<br style=\"box-sizing: border-box;\" />\r\n	+ Phụ thuộc v&agrave;o g&oacute;i dịch vụ lựa chọn bạn c&ograve;n nhận được:<br style=\"box-sizing: border-box;\" />\r\n	Bộ stationery: Namecard, phong b&igrave; thư A4 &amp; A5, Giấy ti&ecirc;u đề thư, H&oacute;a đơn doanh nghiệp.<br style=\"box-sizing: border-box;\" />\r\n	Bộ nhận diện thương hiệu gồm: ấn phẩm quảng c&aacute;o (tờ rơi, poster, brochure, mẫu quảng c&aacute;o b&aacute;o &hellip;), vật phẩm x&uacute;c tiến thương mại, bao b&igrave; nh&atilde;n m&aacute;c sản phẩm &hellip;<br style=\"box-sizing: border-box;\" />\r\n	Website c&ocirc;ng ty hoặc website giới thiệu sản phẩm/dịch vụ.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	HƠN THẾ NỮA BẠN C&Ograve;N NHẬN ĐƯỢC<br style=\"box-sizing: border-box;\" />\r\n	+ Bạn sẽ nhận được bộ sản phẩm logo với tất cả c&aacute;c định dạng file cần thiết (GIF v&agrave; JPG d&ugrave;ng cho web, PSD hoặc EPS), file gốc thiết kế để c&oacute; thể dễ d&agrave;ng chỉnh sửa cũng như d&ugrave;ng cho in ấn.<br style=\"box-sizing: border-box;\" />\r\n	+ Bạn cũng nhận được logo với định dạng đen trắng (grayscale/black and white).<br style=\"box-sizing: border-box;\" />\r\n	+ Bạn c&oacute; to&agrave;n quyền sở hữu sản phẩm thiết kế.<br style=\"box-sizing: border-box;\" />\r\n	+ Logo của bạn được đưa v&agrave;o thư viện c&aacute;c thương hiệu do&nbsp;<span style=\"box-sizing: border-box; font-weight: 700;\">95Designer</span>&nbsp;thiết kế.<br style=\"box-sizing: border-box;\" />\r\n	+Logo của bạn được đối chiếu với cục bản quyền, v&agrave; Bee hỗ trợ gi&uacute;p bạn đăng k&yacute; bản quyền Logo của m&igrave;nh.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px 0px 30px; padding: 0px; color: rgb(91, 94, 94); font-family: opensans; font-size: 16px;\">\r\n	TẠI SAO BẠN N&Ecirc;N CHỌN 95Designer?<br style=\"box-sizing: border-box;\" />\r\n	1. Hơn 7000 kh&aacute;ch h&agrave;ng đ&atilde; lựa chọn ch&uacute;ng t&ocirc;i: v&agrave; đ&oacute; l&agrave; l&yacute; do thuyết phục nhất để bạn lựa chọn<br style=\"box-sizing: border-box;\" />\r\n	2. Ch&uacute;ng t&ocirc;i l&agrave; chuy&ecirc;n gia trong lĩnh vực thiết kế thương hiệu: thay v&igrave; hỏi bạn muốn logo như thế n&agrave;o, ch&uacute;ng t&ocirc;i tư vấn gi&uacute;p bạn biết logo của bạn cần phải c&oacute; những g&igrave;, bạn cần kh&aacute;c biệt đối thủ như thế n&agrave;o &hellip;<br style=\"box-sizing: border-box;\" />\r\n	3. Bạn sở hữu đội ngũ chuy&ecirc;n gia của ch&uacute;ng t&ocirc;i: Một khi dự &aacute;n bắt đầu, 4 họa sỹ thiết kế, 01 gi&aacute;m đốc s&aacute;ng tạo v&agrave; 01 chuy&ecirc;n gia tư vấn chiến lược thương hiệu sẽ c&ugrave;ng tham gia v&agrave;o qu&aacute; tr&igrave;nh s&aacute;ng tạo để đảm bảo cho mẫu thiết kế logo của bạn l&agrave; sản phẩm s&aacute;ng tạo v&agrave; ph&ugrave; hợp nhất.<br style=\"box-sizing: border-box;\" />\r\n	4. Chuy&ecirc;n nghiệp: C&aacute;c dự &aacute;n của ch&uacute;ng t&ocirc;i được triển khai theo một quy tr&igrave;nh chặt chẽ v&agrave; khoa học với sự tham gia của c&aacute;c chuy&ecirc;n gia thương hiệu v&agrave; s&aacute;ng tạo. Tất cả nh&acirc;n vi&ecirc;n v&agrave; chuy&ecirc;n gia đều được đ&agrave;o tạo b&agrave;i bản tại c&aacute;c trường danh tiếng về Design.<br style=\"box-sizing: border-box;\" />\r\n	5. Chi ph&iacute; hợp l&yacute;:&nbsp;<span style=\"box-sizing: border-box; font-weight: 700;\">95Designer</span>&nbsp;cam kết lu&ocirc;n đem lại hiệu quả lớn nhất tr&ecirc;n chi ph&iacute; đầu tư của bạn.<br style=\"box-sizing: border-box;\" />\r\n	6. Ch&uacute;ng t&ocirc;i sẵn s&agrave;ng đảm nhiệm : Việc thiết kế trọn g&oacute;i từ logo, namecard, brochure, website v&agrave; trang tr&iacute; nội thất văn ph&ograve;ng của bạn theo quy chuẩn logo tốt nhất.<br style=\"box-sizing: border-box;\" />\r\n	H&atilde;y li&ecirc;n hệ ngay với ch&uacute;ng t&ocirc;i để nhận được sự tư vấn từ những chuy&ecirc;n gia h&agrave;ng đầu.</p>\r\n', 1, 1553846561, 1553847839, 1, 0),
(2, 'Tổ chức event và truyền thông', '<p>\r\n	Tổ chức event v&agrave; truyền th&ocirc;ng</p>\r\n', 1, 1553848434, 1553848542, 1, 0),
(3, 'Thiết kế thi công nội thất', '<p>\r\n	Thiết kế thi c&ocirc;ng nội thất</p>\r\n', 1, 1553848445, 1553848512, 1, 0),
(4, 'Quay phim giới thiệu doanh nghiệp', '<p>\r\n	Quay phim giới thiệu doanh nghiệp</p>\r\n', 1, 1553848465, 1553848465, 1, 0),
(5, ' Đăng ký bản quyền thương hiệu', '<p>\r\n	Đăng k&yacute; bản quyền thương hiệu</p>\r\n', 1, 1553848481, 1553848481, 1, 0),
(6, ' Thi công in ấn', '<p>\r\n	&nbsp;Thi c&ocirc;ng in ấn</p>\r\n', 1, 1553848491, 1553848491, 1, 0),
(7, ' Thiết kế hồ sơ năng lực công ty', '<p>\r\n	Thiết kế hồ sơ năng lực c&ocirc;ng ty</p>\r\n', 1, 1554105706, 1554105706, 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `sevice`
--
ALTER TABLE `sevice`
  ADD PRIMARY KEY (`sev_id`),
  ADD KEY `sev_parent_id` (`sev_parent_id`) USING BTREE,
  ADD KEY `sev_active` (`sev_active`) USING BTREE;

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sevice`
--
ALTER TABLE `sevice`
  MODIFY `sev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
