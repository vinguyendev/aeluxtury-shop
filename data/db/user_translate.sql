-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2019 lúc 08:52 AM
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
-- Cấu trúc bảng cho bảng `user_translate`
--

CREATE TABLE `user_translate` (
  `ust_keyword` varchar(255) NOT NULL,
  `ust_text` varchar(255) DEFAULT NULL,
  `lang_id` int(11) NOT NULL DEFAULT '1',
  `ust_source` varchar(255) DEFAULT NULL,
  `ust_date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_translate`
--

INSERT INTO `user_translate` (`ust_keyword`, `ust_text`, `lang_id`, `ust_source`, `ust_date`) VALUES
('54033c7f2585c112047c3361fce9f57f', 'Đang tải dữ liệu...', 1, 'Đang tải dữ liệu...', 0),
('4a9e97b890b46c07ddde4744cef33772', 'Thế giới thiết bị số', 1, 'Thế giới thiết bị số', 0),
('a71d5922bb90fa3f8472c8569d1b5021', 'Nhập tên, mã sản phẩm...', 1, 'Nhập tên, mã sản phẩm...', 0),
('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', 1, 'Tìm kiếm', 0),
('ee7ab74040f73a1d9f6944feaa11f27f', 'Bạn chưa nhập từ khóa tìm kiếm !', 1, 'Bạn chưa nhập từ khóa tìm kiếm !', 0),
('c1c079acfea640c60e08f76c4eae4dab', 'SẢN PHẨM MỚI', 1, 'SẢN PHẨM MỚI', 0),
('af40c066e87b5d73c3df11d89b24815d', 'Tạo liên kết', 1, 'Tạo liên kết', 0),
('b7fc5835210155743cb8a7e7222c6b67', 'ĐẶT MUA, GIAO TẬN NƠI', 1, 'ĐẶT MUA, GIAO TẬN NƠI', 0),
('2cd21ecf460b47b950d07f0559c7440e', 'đặt mua và nhận hàng tại nhà', 1, 'đặt mua và nhận hàng tại nhà', 0),
('561285bd4ca19ee1577af8a93e62360d', 'MUA TRẢ GÓP', 1, 'MUA TRẢ GÓP', 0),
('0ea037279469af1d94dc3828e64bec8c', 'trả trước chỉ từ 20%', 1, 'trả trước chỉ từ 20%', 0),
('2596345ecd6281fd3d521eb74c0de0c4', 'hết hàng', 1, 'hết hàng', 0),
('fd56a7b0a5f02dc31c393cc1855156c5', 'Sản phẩm Hot & cùng danh mục', 1, 'Sản phẩm Hot & cùng danh mục', 0),
('49794235bf9fa27877aa086620712b12', 'trả trước chỉ từ 30% nhận ngay SP', 1, 'trả trước chỉ từ 30% nhận ngay SP', 0),
('287b5825b7b7f56b43241ab248ba0316', 'Bạn chưa nhập họ tên người đặt', 1, 'Bạn chưa nhập họ tên người đặt', 0),
('a471c8e1ef7ee2c9f201bea2acf768a5', 'Bạn chưa nhập số điện thoại người đặt', 1, 'Bạn chưa nhập số điện thoại người đặt', 0),
('26cff175e4ffd2602a8e62d33b725081', 'Bạn chưa nhập địa chỉ người đặt', 1, 'Bạn chưa nhập địa chỉ người đặt', 0),
('4e4dda3a523ca7e5141d3479aec298ec', 'TRANG CHỦ', 1, 'TRANG CHỦ', 0),
('bed1dd0c5c6cbf31a20fd03c93320305', 'SẢN PHẨM', 1, 'SẢN PHẨM', 0),
('6b413a7c650312f11909470c2dadf82d', 'Giỏ hàng', 1, 'Giỏ hàng', 0),
('7f59583bc91af303adacb40c3c74eff9', 'Kiểm tra đơn hàng', 1, 'Kiểm tra đơn hàng', 0),
('a98070714bce0e987bbbc486a3b4a511', 'Đăng ký tài khoản', 1, 'Đăng ký tài khoản', 0),
('0bb0951dd6fc2f6f404e3672b427cc09', 'Đăng ký', 1, 'Đăng ký', 0),
('9a1927258e7c87e602898ad82c130cdd', 'Đăng nhập', 1, 'Đăng nhập', 0),
('dfb3f308150a65be9f2b3776879b4cdc', 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên', 1, 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên', 0),
('436ce5e25441f372249d815fd8ddf4ee', 'Thích', 1, 'Thích', 0),
('2082a0167d6eb3c97eb8c238d807fa2e', 'SẢN PHẨM BÁN CHẠY', 1, 'SẢN PHẨM BÁN CHẠY', 0),
('53a9e44f780b3c9cf1e9b1a54709cb6a', 'Sản phẩm được yêu thích, mua nhiều nhất trong tuần', 1, 'Sản phẩm được yêu thích, mua nhiều nhất trong tuần', 0),
('b86e54b0e2665a8bc29785eacbc5d2cd', 'Nhập email để nhận nhiều ưu đãi từ Cristiano.vn...', 1, 'Nhập email để nhận nhiều ưu đãi từ Cristiano.vn...', 0),
('5e6dadb6ca494c70f4b1859038794b0b', 'TÀI KHOẢN', 1, 'TÀI KHOẢN', 0),
('be8df1f28c0abc85a0ed0c6860e5d832', 'Blog', 1, 'Blog', 0),
('74e20f078a01c51c08c0fb721bdfb927', 'THÔNG TIN LIÊN HỆ', 1, 'THÔNG TIN LIÊN HỆ', 0),
('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', 1, 'Phone', 0),
('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', 1, 'Email', 0),
('d841d3ecad797b3fcd2872fc46f83aec', 'Tình trạng', 1, 'Tình trạng', 0),
('c95536d3182606eaa38434badbc1b7d1', 'Hết hàng', 1, 'Hết hàng', 0),
('072c1a4bd8ab9f7f7272ba93d4e54625', 'Giá', 1, 'Giá', 0),
('0b5a4d3c62d716231f932f4fa811b1c0', 'Đặt mua', 1, 'Đặt mua', 0),
('2958eac6c54552c11983299efedf96b6', 'Yêu thích', 1, 'Yêu thích', 0),
('76311150740ef69ec9193f385005588a', 'CÙNG DANH MỤC', 1, 'CÙNG DANH MỤC', 0),
('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', 1, 'Sản phẩm', 0),
('6430156f93760c2cfccb27557e815062', 'Giá bán', 1, 'Giá bán', 0),
('61012ba96209a02808fe05005e1e94c7', 'Số lượng', 1, 'Số lượng', 0),
('b131cbcbba8ba1eea5e8769e68015228', 'Họ', 1, 'Họ', 1540037920),
('2aa8efe4359bcfa93eb00515106059f8', 'Tên', 1, 'Tên', 1540037920),
('3dbd5cb3ffd5f46073a198f9452ccc3e', 'Số Điện Thoại', 1, 'Số Điện Thoại', 1540037920),
('cda25045f59d9a09d6d8e56fa6bcf92e', 'Xác Nhận', 1, 'Xác Nhận', 1540037920),
('03f0c66427dc00033958e15dff032dbb', 'Trang chủ', 1, 'Trang chủ', 1540043537),
('b72d436e69926c1e59bfff459dd35527', 'Xem Thêm', 1, 'Xem Thêm', 1540043537),
('07bea80ac0a1853fe8690b46e3b40261', 'Quẩn bò', 1, 'Quẩn bò', 1540176130),
('f9e98f192afa710affb4d224a28790f5', 'Vui lòng nhập Tên thương hiệu!', 1, 'Vui lòng nhập Tên thương hiệu!', 1540178102),
('d41d8cd98f00b204e9800998ecf8427e', '', 1, '', 1540180880),
('53d8de583ea7608b24d2aaf0edd90f0b', 'Danh mục', 1, 'Danh mục', 1540180880),
('31136746a2958287f05a1133bdd85093', 'Thông tin chi tiết', 1, 'Thông tin chi tiết', 1540180880),
('c90c3bbca355dbc2cd2aeef9231ca6c2', 'Sản phẩm nổi bật', 1, 'Sản phẩm nổi bật', 1540180880),
('8daeba139b0373d2de8da39978f559b4', 'Áo phông', 1, 'Áo phông', 1540180933),
('3c908fb058b07b772725e95b8ceed43b', 'Blue jacket', 1, 'Blue jacket', 1540180933),
('1f91a2cc05de44fcabda28db7883969e', 'Xem chi tiết', 1, 'Xem chi tiết', 1540180933),
('fd51e1e3895899233428f6b428ee507b', 'Danh mục sản phẩm', 1, 'Danh mục sản phẩm', 1540180933),
('9276b119c32c88c7647ef4d0d943ed0a', 'Liên hệ', 1, 'Liên hệ', 1540202530),
('908647da8bb09e5d135064be92ec1352', 'Gửi tin nhắn', 1, 'Gửi tin nhắn', 1540202530),
('39faf8acbcd97440649d6d3d99a5b929', 'Họ tên', 1, 'Họ tên', 1540202530),
('1e2eb2de18141400417d4933304d749f', 'Xác nhận', 1, 'Xác nhận', 1540202530),
('f34d7fc0328d0ffd4c4dd0ad19c109ed', 'Hỗ trợ Khách Hàng', 1, 'Hỗ trợ Khách Hàng', 1540202530),
('1378286c31d0a46e2f63926c3dea9e34', 'Vui lòng nhập tiêu đề!', 1, 'Vui lòng nhập tiêu đề!', 1540522652),
('33f0741f9e26310fbe1a9511048e4996', 'Giới thiệu', 1, 'Giới thiệu', 1540524713),
('4b6aece8182473c968466490bc504de4', 'Blue T Shirt', 1, 'Blue T Shirt', 1540540875),
('80523c21206afe56205d6ad367cbc246', 'Vui lòng nhập Tên Thuộc tính!', 1, 'Vui lòng nhập Tên Thuộc tính!', 1554090388),
('3cc537728fe205fc724154506e4b54c6', 'Dự án', 1, 'Dự án', 1554090579),
('9041bd1975a4a793d6a1a6e6841045fb', 'Dịch vụ', 1, 'Dịch vụ', 1554105612),
('c002c54d32c4fe24f06e549b6cb9e7b4', 'Nội thất nhà ở', 1, 'Nội thất nhà ở', 1555405540),
('f6e1d9d9e316cdbba116ef3fd8c014e2', 'Vui lòng nhập Tên!', 1, 'Vui lòng nhập Tên!', 1555470283);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user_translate`
--
ALTER TABLE `user_translate`
  ADD PRIMARY KEY (`ust_keyword`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
