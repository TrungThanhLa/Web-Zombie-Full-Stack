-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 18, 2023 lúc 01:24 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `zombiecrud`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id_cat`, `name`, `status`, `created_at`) VALUES
(47, 'Áo', 1, '2023-01-30 15:13:55'),
(48, 'Quần', 1, '2023-01-30 15:27:27'),
(50, 'Quần Âu', 0, '2023-01-30 15:31:16'),
(51, 'Áo phông unisex', 0, '2023-01-30 16:35:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `main_img` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `homepage`
--

INSERT INTO `homepage` (`id`, `main_img`, `title`, `created_at`) VALUES
(31, 'Badass Son 800x800.jpg-1676422528.jpg', 'HOT SWEATER CỰC CHẤT 2023', '2023-02-15 00:55:28'),
(32, 'AVT 2TL.png-1676422604.png', 'HOT SWEATER 2023', '2023-02-15 00:56:44'),
(33, 'DPG.png-1676422734.png', 'HOT SWEATER 2023', '2023-02-15 00:58:54'),
(34, 'AVT 2TL.png-1676423890.png', 'SWEATER 2023', '2023-02-15 01:18:10'),
(35, '', 'SWEATER 2023', '2023-02-15 01:23:42'),
(36, '', 'SWEATER 2023', '2023-02-15 01:33:34'),
(37, '', 'SWEATER 2023', '2023-02-15 01:37:51'),
(38, 'AVT 2TL.png-1676425091.png', 'SWEATER 2023', '2023-02-15 01:38:11'),
(39, 'AVT 2TL.png-1676425189.png', 'SWEATER 2023', '2023-02-15 01:39:49'),
(40, 'AVT 2TL.png-1676425502.png', 'SWEATER 2023', '2023-02-15 01:45:02'),
(41, 'Badass Son 800x800.jpg-1676425565.jpg', 'SWEATER 2023', '2023-02-15 01:46:05'),
(42, 'AVT 2TL.png-1676425714.png', 'SWEATER 2023', '2023-02-15 01:48:34'),
(43, 'Badass Son 800x800.jpg-1676425772.jpg', 'SWEATER 2023', '2023-02-15 01:49:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imgs_products`
--

CREATE TABLE `imgs_products` (
  `id` int(11) NOT NULL,
  `id_products` int(11) NOT NULL,
  `imgs_des` text NOT NULL,
  `path` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `imgs_products`
--

INSERT INTO `imgs_products` (`id`, `id_products`, `imgs_des`, `path`, `created_at`) VALUES
(8, 8, 'Badass Son 800x800.jpg-1675092928.jpg', '', '2023-01-30 15:35:28'),
(9, 8, 'DPG.png-1675092928.jpg', '', '2023-01-30 15:35:28'),
(10, 8, 'FC THKT.jpg-1675092928.jpg', '', '2023-01-30 15:35:28'),
(11, 9, 'Badass Son 800x800.jpg-1675093547.jpg', '', '2023-01-30 15:45:47'),
(12, 9, 'FC THKT.jpg-1675093547.jpg', '', '2023-01-30 15:45:47'),
(13, 9, 'Flexin Game Project 800x800.jpg-1675093547.jpg', '', '2023-01-30 15:45:47'),
(14, 10, 'AVT 2TL.png-1675094616.jpg', '', '2023-01-30 16:03:36'),
(15, 10, 'DPG.png-1675094616.jpg', '', '2023-01-30 16:03:36'),
(16, 10, 'FC THKT.jpg-1675094616.jpg', '', '2023-01-30 16:03:36'),
(17, 11, 'AVT 2TL.png-1675095656.png', '', '2023-01-30 16:20:56'),
(18, 11, 'DPG.png-1675095656.png', '', '2023-01-30 16:20:56'),
(19, 12, 'FC THKT.jpg-1675096022.jpg', '', '2023-01-30 16:27:02'),
(20, 12, 'Flexin Game Project 800x800.jpg-1675096022.jpg', '', '2023-01-30 16:27:02'),
(22, 14, 'Badass Son 800x800.jpg-1675759491.png', '', '2023-02-07 08:44:51'),
(23, 14, 'DPG.png-1675759491.png', '', '2023-02-07 08:44:51'),
(24, 15, 'FC THKT.jpg-1675759598.png', '', '2023-02-07 08:46:38'),
(25, 15, 'Flamer Poster Instagram Story.png-1675759598.png', '', '2023-02-07 08:46:38'),
(28, 17, 'AVT 2TL.png-1675783423.png', '', '2023-02-07 15:23:43'),
(29, 17, 'Badass Son 800x800.jpg-1675783423.png', '', '2023-02-07 15:23:43'),
(30, 17, 'DPG.png-1675783423.png', '', '2023-02-07 15:23:43'),
(31, 16, 'DPG.png-1675846821.png', '', '2023-02-08 09:00:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `img_sale_poster`
--

CREATE TABLE `img_sale_poster` (
  `id` int(11) NOT NULL,
  `sale_poster` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `img_sale_poster`
--

INSERT INTO `img_sale_poster` (`id`, `sale_poster`, `created_at`) VALUES
(121, 'AVT 2TL.png.1676425714.png', '2023-02-15 01:48:34'),
(122, 'Badass Son 800x800.jpg.1676425714.png', '2023-02-15 01:48:34'),
(123, 'DPG.png.1676425714.png', '2023-02-15 01:48:34'),
(124, '2TL Text Glitch Light Leak 1.jpg.1676425772.jpg', '2023-02-15 01:49:32'),
(125, '89961761_1104714736572165_5917085347442851840_o.jpg.1676425772.jpg', '2023-02-15 01:49:32'),
(126, 'AVT 2TL.png.1676425772.jpg', '2023-02-15 01:49:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `img_sale_products`
--

CREATE TABLE `img_sale_products` (
  `id` int(11) NOT NULL,
  `sale_products` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `img_sale_products`
--

INSERT INTO `img_sale_products` (`id`, `sale_products`, `created_at`) VALUES
(27, 'Flexin Game Project 800x800.jpg.1676425772.jpg', '2023-02-15 01:49:32'),
(28, 'Màn Đêm Project 800x800.png.1676425772.jpg', '2023-02-15 01:49:32'),
(29, 'PTS Test 1 - Vegeta Hakaishin.png.1676425772.jpg', '2023-02-15 01:49:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `metatitle` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `metades` varchar(300) NOT NULL,
  `posts` text NOT NULL,
  `thumbnail` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `metatitle`, `description`, `metades`, `posts`, `thumbnail`, `created_at`) VALUES
(3, 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', '<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n\r\n<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n\r\n<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n', 'AVT 2TL.png1674931998.png', '2023-01-28 18:53:18'),
(4, 'Full Set Zombie Limited Edition cực chất năm 2023', 'Full Set Zombie Limited Edition cực chất năm 2023', 'Full Set Zombie Limited Edition cực chất năm 2023', 'Full Set Zombie Limited Edition cực chất năm 2023', '<pre>\r\nFull Set Zombie Limited Edition cực chất năm 2023</pre>\r\n', 'DPG.png1675252092.png', '2023-02-01 11:48:12'),
(5, 'Full Set Zombie Limited Edition cực chất năm 2023 1', 'Full Set Zombie Limited Edition cực chất năm 2023 1', 'Full Set Zombie Limited Edition cực chất năm 2023 1 ', 'Full Set Zombie Limited Edition cực chất năm 2023 2', '<pre>\r\nFull Set Zombie Limited Edition cực chất năm 2023 2</pre>\r\n', 'Badass Son 800x800.jpg1675252113.jpg', '2023-02-01 11:48:33'),
(6, 'Full Set Zombie Limited Edition cực chất năm 2023 3', 'Full Set Zombie Limited Edition cực chất năm 2023 3', 'Full Set Zombie Limited Edition cực chất năm 2023 3', 'Full Set Zombie Limited Edition cực chất năm 2023 3', '<p>Full Set Zombie Limited Edition cực chất năm 2023 3</p>\r\n', 'FC THKT.jpg1675252126.jpg', '2023-02-01 11:48:46'),
(7, 'Full Set Zombie Limited Edition cực chất năm 2023 4', 'Full Set Zombie Limited Edition cực chất năm 2023 4', 'Full Set Zombie Limited Edition cực chất năm 2023 4', 'Full Set Zombie Limited Edition cực chất năm 2023 4', '<p>Full Set Zombie Limited Edition cực chất năm 2023 4</p>\r\n', 'BXHQE1875.JPG1675252141.jpg', '2023-02-01 11:49:01'),
(8, 'Full Set Zombie Limited Edition cực chất năm 2023 5', 'Full Set Zombie Limited Edition cực chất năm 2023 5', 'Full Set Zombie Limited Edition cực chất năm 2023 5', 'Full Set Zombie Limited Edition cực chất năm 2023 5', '<p>Full Set Zombie Limited Edition cực chất năm 2023 5</p>\r\n', 'Flexin Game Project 800x800.jpg1675252154.jpg', '2023-02-01 11:49:14'),
(9, 'Full Set Zombie Limited Edition cực chất năm 2023 6', 'Full Set Zombie Limited Edition cực chất năm 2023 6', 'Full Set Zombie Limited Edition cực chất năm 2023 6', 'Full Set Zombie Limited Edition cực chất năm 2023 6', '<p>Full Set Zombie Limited Edition cực chất năm 2023 6</p>\r\n', 'Flamer Poster.png1675252169.png', '2023-02-01 11:49:29'),
(10, 'Full Set Zombie Limited Edition cực chất năm 2023 7', 'Full Set Zombie Limited Edition cực chất năm 2023 7', 'Full Set Zombie Limited Edition cực chất năm 2023 7', 'Full Set Zombie Limited Edition cực chất năm 2023 7', '<p>Full Set Zombie Limited Edition cực chất năm 2023 7</p>\r\n', 'Glitch Avatar.jpg1675252193.jpg', '2023-02-01 11:49:53'),
(11, 'Full Set Zombie Limited Edition cực chất năm 2023 8', 'Full Set Zombie Limited Edition cực chất năm 2023 8', 'Full Set Zombie Limited Edition cực chất năm 2023 8', 'Full Set Zombie Limited Edition cực chất năm 2023 8', '<p>Full Set Zombie Limited Edition cực chất năm 2023 8</p>\r\n', 'Màn Đêm Project 800x800.png1675252210.png', '2023-02-01 11:50:10'),
(12, 'Full Set Zombie Limited Edition cực chất năm 2023 9', 'Full Set Zombie Limited Edition cực chất năm 2023 9', 'Full Set Zombie Limited Edition cực chất năm 2023 9', 'Full Set Zombie Limited Edition cực chất năm 2023 9', '<p>Full Set Zombie Limited Edition cực chất năm 2023 9</p>\r\n', 'Luôn kề bên 800x800.jpg1675252229.jpg', '2023-02-01 11:50:29'),
(13, 'Full Set Zombie Limited Edition cực chất năm 2023 10', 'Full Set Zombie Limited Edition cực chất năm 2023 10', 'Full Set Zombie Limited Edition cực chất năm 2023 10', 'Full Set Zombie Limited Edition cực chất năm 2023 10', '<p>Full Set Zombie Limited Edition cực chất năm 2023 10</p>\r\n', 'Youg Logo.png1675252241.png', '2023-02-01 11:50:41'),
(14, 'Full Set Zombie Limited Edition cực chất năm 2023 11', 'Full Set Zombie Limited Edition cực chất năm 2023 11', 'Full Set Zombie Limited Edition cực chất năm 2023 11', 'Full Set Zombie Limited Edition cực chất năm 2023 11', '<p>Full Set Zombie Limited Edition cực chất năm 2023 11</p>\r\n', 'FC THKT.jpg1675585049.jpg', '2023-02-05 08:17:29'),
(15, 'Full Set ZOMBIE OFFICIAL LIMITED cực phẩm 2023', 'Full Set ZOMBIE OFFICIAL LIMITED cực phẩm 2023', 'Full Set ZOMBIE OFFICIAL LIMITED cực phẩm 2023', 'Full Set ZOMBIE OFFICIAL LIMITED cực phẩm 2023', '<h2><span style=\"color:#e74c3c\">1. Nước hoa nam&nbsp;gi&aacute; 500k c&oacute; chất lượng kh&ocirc;ng</span></h2>\r\n\r\n<p>Đa số ai cũng c&oacute; suy nghĩ đ&atilde; l&agrave; nước hoa ch&iacute;nh h&atilde;ng&nbsp;th&igrave; chất lượng&nbsp;cũng như hương thơm m&agrave; n&oacute; mang&nbsp;lại phải xịn x&ograve;, cuốn h&uacute;t dữ&nbsp;lắm.</p>\r\n\r\n<p>Đồng nghĩa chai nước hoa h&agrave;ng hiệu đ&oacute; gi&aacute; cũng rất đắt v&agrave;&nbsp;nhiều bạn vẫn chưa thể mua được.</p>\r\n\r\n<p><strong>V&igrave; sao nước hoa h&agrave;ng hiệu lại đắt đến vậy?</strong></p>\r\n\r\n<p>Trước ti&ecirc;n ch&uacute;ng đến từ c&aacute;c Brand thương hiệu lớn như Gucci, Dior, Chanel, Giorgio Amani, . . . n&ecirc;n sản phẩm c&oacute; chất lượng hương thơm tốt, thương hiệu lớn n&ecirc;n mức sẽ cũng sẽ kh&oacute; &quot;với tới&quot;.</p>\r\n\r\n<p>Tiếp theo l&agrave; vấn đề nhập khẩu, thuế hay b&aacute;n qua tay nhiều nh&agrave; ph&acirc;n phối, đại l&yacute; rồi bạn mua. Dĩ nhi&ecirc;n gi&aacute; sẽ bị đẩy l&ecirc;n rất cao.</p>\r\n\r\n<p>Ch&iacute;nh v&igrave; thế v&ocirc; h&igrave;nh chung ai cũng c&oacute; suy nghĩ rằng nước hoa ch&iacute;nh h&atilde;ng l&agrave; phải đắt tiền, xịn x&ograve; lắm.</p>\r\n\r\n<p>Vậy&nbsp;<strong>nước hoa d&agrave;nh cho nam gi&aacute; 500k, rẻ vậy c&oacute; tốt kh&ocirc;ng?</strong></p>\r\n\r\n<p>C&acirc;u trả lời l&agrave;&nbsp;<strong>TỐT</strong>, nhưng . . . bạn phải biết nơi n&agrave;o uy t&iacute;n để mua nữa nh&eacute;.</p>\r\n\r\n<p><img alt=\"nước hoa 500k có tốt không\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-nam-500k-co-tot-khong.jpg?v=1674402703020\" style=\"height:434px; width:797px\" /></p>\r\n\r\n<p>Mu&ocirc;n mua nước hoa gi&aacute; rẻ 500k c&oacute; chất lượng tốt th&igrave; bạn n&ecirc;n đến c&aacute;c shop, cửa h&agrave;ng uy t&iacute;n</p>\r\n\r\n<p>Kh&ocirc;ng phải cứ bỏ ra một số tiền lớn th&igrave; mới c&oacute; m&ugrave;i thơm xịn. Chỉ cần&nbsp;500k bạn đ&atilde; dư sức sở hữu cho m&igrave;nh một chai dầu thơm nam ch&iacute;nh h&atilde;ng rồi.</p>\r\n\r\n<p>Xem ngay: TOP 5 chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-mui-ngot\">nước hoa nam ngọt</a>&nbsp;ng&agrave;o quyến rũ được giới trẻ th&iacute;ch nhất năm 2022</p>\r\n\r\n<h2>2. Top 5 chai nước hoa dưới 500k cho nam kh&ocirc;ng n&ecirc;n bỏ lỡ</h2>\r\n\r\n<p>Những d&ograve;ng sản phẩm Halushop&nbsp;giới thiệu dưới đ&acirc;y đều thuộc một h&atilde;ng kh&aacute; nổi tiếng v&agrave; đ&igrave;nh đ&aacute;m. Gi&aacute;&nbsp;th&agrave;nh hợp l&yacute;&nbsp;dễ tiếp cận, đ&oacute; l&agrave; Charme Perfume - Nước hoa Ph&aacute;p d&agrave;nh cho người Việt.</p>\r\n\r\n<p>N&oacute;i ngắn gọn v&agrave; đễ hiểu th&igrave; thương hiệu n&agrave;y cho ra mắt những m&ugrave;i hương m&ocirc; phỏng theo c&aacute;c d&ograve;ng nước hoa nổi tiếng của c&aacute;c thương hiệu lớn.</p>\r\n\r\n<p>Ưu điểm lớn nhất l&agrave; m&ugrave;i hương thơm l&acirc;u, gi&aacute; th&agrave;nh rẻ hơn gấp nhiều lần, m&ocirc; phỏng giống đến 90% so với phi&ecirc;n bản gốc.</p>\r\n\r\n<p>B&acirc;y giờ th&igrave; điểm danh TOP nhưng chai nước hoa nam gi&aacute; rẻ dưới 500k ngay th&ocirc;i.</p>\r\n\r\n<h3>2.1 Charme Iris</h3>\r\n\r\n<p>Charme Iris kho&aacute;c l&ecirc;n m&igrave;nh một hương thơm cao qu&yacute;, độc đ&aacute;o đến quyến rũ. Sản phẩm hội tụ cho m&igrave;nh đầy đủ những hương thơm ngọt ng&agrave;o, l&atilde;ng mạn m&agrave; c&aacute;c d&ograve;ng nước hoa Ph&aacute;p đều c&oacute;.</p>\r\n\r\n<p>Phần thiết kế tuy đơn giản nhưng kh&ocirc;ng k&eacute;m phần sang trọng, to&aacute;t ra được&nbsp;độ lịch l&atilde;m, sang chảnh đậm chất qu&yacute; tộc v&agrave; nhiều tiền, nhưng&nbsp;gi&aacute; thực tế của dầu thơm Iris&nbsp;c&ograve;n chưa đến 500k.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"454\" longdesc=\"https://halushop.vn/N%C6%B0%E1%BB%9Bc%20hoa%20Charme%20Iris%2050ml%20ch%C3%ADnh%20h%C3%A3ng%20d%C3%A0nh%20cho%20nam,%20gi%C3%A1%20t%E1%BB%91t%20nh%E1%BA%A5t\" name=\"Nước hoa Charme Iris 50ml chính hãng dành cho nam, giá tốt nhất\" scrolling=\"no\" src=\"https://www.youtube.com/embed/dRxutUWdspY\" title=\"Nước hoa Charme Iris 50ml chính hãng dành cho nam, giá tốt nhất\" width=\"835\"></iframe></p>\r\n\r\n<p>Lớp hương đầu v&agrave; giữa h&ograve;a quyện v&agrave;o nhau tạo n&ecirc;n một m&ugrave;i hương đầy sức sống, m&agrave;u sắc v&agrave; hứng khởi.</p>\r\n\r\n<p>C&ograve;n tầng hương cuối th&igrave;&nbsp;được khai th&aacute;c theo nhiều chiều hướng cảm x&uacute;c kh&aacute;c nhau. Với b&aacute;ch hương ở vị tr&iacute; chủ đạo, sản phẩm sẽ trở n&ecirc;n ấm &aacute;p v&agrave; dễ chịu hơn bao giờ hết.</p>\r\n\r\n<p>Nếu c&aacute;c bạn kh&ocirc;ng biết th&igrave; hương thơm của Iris Charme c&ograve;n được lấy cảm hứng từ m&ugrave;i hương của Bleu de Chanel - một trong những chai nước hoa thuộc ph&acirc;n kh&uacute;c cao cấp của thương hiệu Chanel xa xỉ.</p>\r\n\r\n<p>Sở hữu ngay hương thơm nam t&iacute;nh của&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-iris\">Charme Iris ch&iacute;nh h&atilde;ng</a>&nbsp;với những ưu đ&atilde;i cực hời chỉ c&oacute; tại Halushop. Nhanh tay kẻo hết nh&eacute; c&aacute;c ch&agrave;ng trai!</p>\r\n\r\n<h3>2.2 Charme Enternity</h3>\r\n\r\n<p>Mang trong m&igrave;nh sự tươi trẻ vốn c&oacute; của một ch&agrave;ng trai đang độ&nbsp;tuổi hấp dẫn, l&ocirc;i cuốn. Charme Enternity sở hữu cho m&igrave;nh một m&ugrave;i hương sảng kho&aacute;i, tươi m&aacute;t, m&atilde;nh liệt v&agrave; phong c&aacute;ch&nbsp;hiện đại.</p>\r\n\r\n<p>Nếu như c&aacute;c bạn để &yacute;&nbsp;th&igrave; Enternity c&oacute; hương thơm được m&ocirc; phỏng ho&agrave;n hảo từ chai&nbsp;<strong>nước hoa Sauvage</strong>&nbsp;của h&agrave;ng Dior sang xịn.</p>\r\n\r\n<p><img alt=\"nước hoa charme enternity có mùi hương giống nước hoa dior sauvage\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-charme-enternity-co-mui-huong-giong-nuoc-hoa-dior-sauvage.jpg?v=1663772005707\" style=\"height:660px; width:835px\" /></p>\r\n\r\n<p>Charme Enternity m&ocirc; phỏng giống m&ugrave;i nước hoa&nbsp;Dior Sauvage nhưng gi&aacute; rẻ hơn rất nhiều</p>\r\n\r\n<p>Thế nhưng mức gi&aacute; của chai dầu thơm nam n&agrave;y lại v&ocirc; c&ugrave;ng ph&ugrave; hợp với mọi đối tượng d&ugrave; bạn l&agrave;&nbsp;học sinh, sinh vi&ecirc;n, d&acirc;n văn ph&ograve;ng đều dư sức mua được.</p>\r\n\r\n<p>Tầng hương mở&nbsp;đầu bạn&nbsp;dễ d&agrave;ng cảm nhận được&nbsp;hương thơm kh&aacute; độc đ&aacute;o của cam Bergamot v&agrave; hạt ti&ecirc;u, cảm gi&aacute;c tươi m&aacute;t, sảng kho&aacute;i v&ocirc; c&ugrave;ng&nbsp;dễ chịu.</p>\r\n\r\n<p>Kế đến, thoang thoảng m&ugrave;i hoa&nbsp;oải hương cũng đủ l&agrave;m bạn ch&igrave;m đắm rồi, tạo cho bạn v&agrave; người đối diện c&oacute; bầu kh&ocirc;ng gian nhẹ nh&agrave;ng rất cuốn h&uacute;t.</p>\r\n\r\n<p>Ở tầng hương cuối c&ugrave;ng sẽ l&agrave; sự h&ograve;a hợp ho&agrave;n hảo, khiến cho mọi gi&aacute;c quan được đ&aacute;nh thức v&agrave; tăng sự hấp dẫn bởi&nbsp;hương hoa labdanum, b&aacute;ch dương v&agrave; ambroxan.</p>\r\n\r\n<p>Sở hữu ngay m&ugrave;i hương sảng kho&aacute;i, hấp dẫn, m&atilde;nh liệt của &ldquo;vũ kh&iacute; tỏa hương&rdquo;&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-enternity\">Charme Enternity</a>&nbsp;với mức ưu đ&atilde;i v&ocirc; c&ugrave;ng hấp dẫn đến từ Halushop. Do số lượng c&oacute; hạn, n&ecirc;n h&atilde;y nhanh tay kẻo hết nh&eacute; c&aacute;c ch&agrave;ng trai!</p>\r\n\r\n<p>Xem ngay: TOP 8 chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-4-mua-cho-nam\">nước hoa nam 4 m&ugrave;a</a>&nbsp;được giới trẻ ưa chuộng v&agrave; săn đ&oacute;n nhiều nhất năm nay</p>\r\n\r\n<h3>2.3 Charme 212 Sexy</h3>\r\n\r\n<p>Khi vừa nghe đến t&ecirc;n gọi đa số ai cũng nghĩ&nbsp;rằng đ&acirc;y chỉ đơn thuần l&agrave; một d&ograve;ng nước hoa d&agrave;nh ri&ecirc;ng cho c&aacute;c chị em phụ nữ.</p>\r\n\r\n<p>Thế nhưng thật ra&nbsp;Charme 212 Sexy lại l&agrave; d&ograve;ng nước hoa Unisex c&oacute; thể d&ugrave;ng cho cả nam lẫn nữ.</p>\r\n\r\n<p>Nam giới sử dụng th&igrave; sẽ tăng th&ecirc;m phần l&ocirc;i cuốn, c&ograve;n nữ giới sử dụng sẽ tăng th&ecirc;m sự c&aacute; t&iacute;nh, ph&aacute; c&aacute;ch hơn.</p>\r\n\r\n<p>Mạnh mẽ, c&aacute; t&iacute;nh, ph&aacute; c&aacute;ch đều hội tụ đủ ở chai dầu thơm unisex n&agrave;y v&agrave; dĩ nhi&ecirc;n 212 sexy lu&ocirc;n l&agrave; m&ugrave;i thơm đắt gi&aacute; được nhiều bạn săn t&igrave;m nhất trong năm qua.</p>\r\n\r\n<p>Tầng hương đầu ti&ecirc;n của chai nước hoa n&agrave;y l&agrave; sự m&aacute;t mẻ, tươi m&aacute;t, sảng kho&aacute;i của bạc h&agrave;, t&aacute;o xanh thi&ecirc;n nhi&ecirc;n v&agrave; quả chanh v&agrave;ng, gi&uacute;p cho việc khơi gợi được sự mạnh mẽ, x&uacute;c cảm, đam m&ecirc; trong bạn.</p>\r\n\r\n<p>Hương thơm ngọt ng&agrave;o của sản phẩm vẫn c&ograve;n được lưu giữ trọn vẹn cho đến tận tầng thứ hai, khi m&agrave; l&uacute;c n&agrave;y l&agrave; sự kết hợp, h&ograve;a quyện th&ecirc;m của đậu tonka, hoa phong lan v&agrave; Ambroxan.</p>\r\n\r\n<p>Đến với tầng hương cuối, để tăng phần thương nhớ, kh&oacute; qu&ecirc;n th&igrave; 212 Charme c&oacute; th&ecirc;m hương thơm đặc trưng của vani, cỏ hương b&agrave;i thơm nhẹ, r&ecirc;u sồi v&agrave; gỗ tuyết t&ugrave;ng ấm &aacute;p.</p>\r\n\r\n<p><iframe align=\"middle\" frameborder=\"0\" height=\"454\" longdesc=\"https://halushop.vn/N%C6%B0%E1%BB%9Bc%20hoa%20Charme%20212%20Sexy%2050ml%20ch%C3%ADnh%20h%C3%A3ng,%20gi%C3%A1%20t%E1%BB%91t%20nh%E1%BA%A5t\" name=\"Nước hoa Charme 212 Sexy 50ml chính hãng, giá tốt nhất\" scrolling=\"no\" src=\"https://www.youtube.com/embed/33E6iQThGHY\" title=\"Nước hoa Charme 212 Sexy 50ml chính hãng, giá tốt nhất\" width=\"835\"></iframe></p>\r\n\r\n<p>Bạn c&oacute; thể thoải m&aacute;i sử dụng m&ugrave;i hương n&agrave;y&nbsp;h&agrave;ng ng&agrave;y để tăng th&ecirc;m phần l&ocirc;i cuốn hơn. Thế nhưng, để c&oacute; thể ph&aacute;t huy được tối đa sức mạnh v&agrave; c&ocirc;ng dụng th&igrave; tốt nhất bạn vẫn n&ecirc;n d&ugrave;ng sản phẩm v&agrave;o những ng&agrave;y se se lạnh như m&ugrave;a đ&ocirc;ng hoặc&nbsp;m&ugrave;a xu&acirc;n.</p>\r\n\r\n<p>H&atilde;y nhanh tay đặt mua nước hoa&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-212-sexy\">Charme 212 Sexy</a>&nbsp;h&agrave;ng ch&iacute;nh h&atilde;ng ngay với mức gi&aacute; v&ocirc; c&ugrave;ng ưu đ&atilde;i, giao h&agrave;ng nhanh ch&oacute;ng tại Halushop nha!</p>\r\n\r\n<h3>2.4 Charme King</h3>\r\n\r\n<p>Đ&uacute;ng như c&aacute;i t&ecirc;n được nh&agrave; sản xuất đ&atilde; đặt,&nbsp;<strong>Charme King</strong>&nbsp;xứng đ&aacute;ng l&agrave; một &ocirc;ng vua nước hoa ở ph&acirc;n kh&uacute;c gi&aacute; dưới 500k.</p>\r\n\r\n<p>Mặc d&ugrave; gi&aacute; th&agrave;nh kh&aacute; thấp nhưng nước hoa King&nbsp;vẫn ngạo nghễ đứng đầu TOP&nbsp;những chai dầu thơm cao cấp được y&ecirc;u th&iacute;ch nhất của Charme.</p>\r\n\r\n<p>Sự cuốn h&uacute;t, quyền uy v&agrave; quyền lực của chai nước hoa nam gi&aacute; rẻ&nbsp;n&agrave;y được mi&ecirc;u tả như một vị vua.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, King sở hữu hương thơm nồng n&agrave;n, gi&uacute;p gia tăng phần nam t&iacute;nh, cũng như bản lĩnh chinh phục của một người đ&agrave;n &ocirc;ng thực thụ.</p>\r\n\r\n<p>Ch&iacute;nh bởi v&igrave; sự đ&agrave;n &ocirc;ng, quyền lực v&agrave; hiện đại pha ch&uacute;t c&aacute; t&iacute;nh m&agrave; sản phẩm n&agrave;y mang lại, vậy n&ecirc;n King Charme rất ph&ugrave; hợp với độ tuổi từ 24 trở l&ecirc;n.</p>\r\n\r\n<p>Độ lưu hương của sản phẩm cũng l&agrave; một điều đ&aacute;ng n&oacute;i, khi m&agrave; bạn c&oacute; thể giữ m&ugrave;i thơm trong v&ograve;ng 7 - 8 giờ tr&ecirc;n cơ thể v&agrave; hơn 1 ng&agrave;y đối với quần &aacute;o.</p>\r\n\r\n<p>Ngo&agrave;i ra, chai nước hoa n&agrave;y c&ograve;n sở hữu m&ugrave;i hương giống đến 90% so với chai dầu thơm nổi tiếng&nbsp;<strong>Paco Rabanne 1 Million Lucky</strong>.</p>\r\n\r\n<p><img alt=\"nước hoa charme king có mùi hương giống nước hoa paco rabanne 1 million lucky\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-charme-king-co-mui-huong-giong-nuoc-hoa-paco-rabanne-1-million-lucky.jpg?v=1667124659703\" style=\"height:660px; width:835px\" /></p>\r\n\r\n<p>Charme King m&ocirc; phỏng giống m&ugrave;i nước hoa&nbsp;paco rabanne 1 million lucky được rất nhiều bạn trẻ ưa chuộng</p>\r\n\r\n<p>Tuy nhi&ecirc;n, gi&aacute; th&agrave;nh của chai nước hoa nam m&ugrave;i ngọt n&agrave;y thấp hơn rất nhiều so với&nbsp;<strong>1 Million Lucky</strong>&nbsp;th&ocirc;i đ&oacute; c&aacute;c bạn!&nbsp;</p>\r\n\r\n<p>Nhanh tay đặt ngay nước hoa&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-king\">Charme King</a>&nbsp;sang chảnh, lịch l&atilde;m với gi&aacute; ưu đ&atilde;i tại Halushop th&ocirc;i n&agrave;o! Đặt nhanh kẻo hết nha!</p>\r\n\r\n<p>Xem ngay: Kh&aacute;m ph&aacute; 6+ chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-duoi-2-trieu\">nước hoa nam ch&iacute;nh h&atilde;ng gi&aacute; dưới 2 triệu</a>&nbsp;thơm cực l&acirc;u</p>\r\n\r\n<h3>2.5 Charme Ruby Sport</h3>\r\n\r\n<p>L&agrave; một hương thơm tuyệt vời d&agrave;nh cho ph&aacute;i mạnh, Charme Ruby Sport mang trong m&igrave;nh sự nhiệt huyết, năng động, c&aacute; t&iacute;nh của một ch&agrave;ng thanh ni&ecirc;n m&ecirc; thể thao.</p>\r\n\r\n<p>Chai nước hoa n&agrave;y được&nbsp;l&agrave;m ra để gia tăng th&ecirc;m&nbsp;sự l&ocirc;i cuốn, quyến rũ, mạnh mẽ v&agrave; độc đ&aacute;o cho ph&aacute;i mạnh,&nbsp;đồng thời gi&uacute;p người đối diện kh&ocirc;ng bị kh&oacute; chịu bởi m&ugrave;i cơ thể của bạn.</p>\r\n\r\n<p>Với m&ugrave;i hương m&agrave; Ruby Sport&nbsp;mang lại&nbsp;th&igrave; chắc chắn đ&acirc;y sẽ l&agrave; một sự lựa chọn đ&aacute;ng lưu &yacute; nhất d&agrave;nh cho những anh ch&agrave;ng đam m&ecirc; thể thao v&agrave; hoạt động ngo&agrave;i trời.</p>\r\n\r\n<p>Ưu điểm lớn nhất vẫn l&agrave; m&ugrave;i thơm m&agrave; n&oacute; mang lại,&nbsp;Ruby Sport khiến cho c&aacute;c chị em&nbsp;phải &ldquo;xi&ecirc;u l&ograve;ng&rdquo; trước sự tươi m&aacute;t, khỏe khoắn, nam t&iacute;nh tỏa ra từ bạn.</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, hương thơm của Ruby Charme được m&ocirc; phỏng một c&aacute;ch trọn vẹn từ chai nước hoa nổi tiếng đến từ Chanel, đ&oacute; l&agrave;&nbsp;<strong>Chanel Allure Homme Sport</strong>&nbsp;xịn s&ograve;.</p>\r\n\r\n<p><img alt=\"nước hoa charme ruby sport có mùi hương giống nước hoa chanel allure homme sport\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-charme-ruby-sport-co-mui-huong-giong-nuoc-hoa-chanel-allure-homme-sport.jpg?v=1668864823283\" style=\"height:660px; width:835px\" /></p>\r\n\r\n<p>Charme Ruby Sport c&oacute; m&ugrave;i hương giống nước hoa&nbsp;Chanel Allure Homme Sport</p>\r\n\r\n<p>Mua ngay&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-ruby-sport\">nước hoa Charme Ruby Sport</a>&nbsp;với mức gi&aacute; hấp dẫn chỉ c&oacute; tại Halushop. Đừng chần chờ m&agrave; h&atilde;y đặt h&agrave;ng ngay đi n&agrave;o c&aacute;c ch&agrave;ng trai.</p>\r\n\r\n<p>V&agrave; ngay tr&ecirc;n đ&acirc;y ch&iacute;nh l&agrave; top 5 chai nước hoa dưới 500k d&agrave;nh cho nam m&agrave; c&aacute;c bạn n&ecirc;n trải nghiệm qua một lần trong đời, sự tuyệt vời m&agrave; m&ugrave;i nước hoa n&agrave;y&nbsp;mang lại chỉ c&oacute; thể gọi l&agrave; tuyệt vời.</p>\r\n\r\n<p>Mong rằng sau khi đọc b&agrave;i viết tr&ecirc;n, bạn sẽ c&oacute; th&ecirc;m được ch&uacute;t kiến thức về những d&ograve;ng nước hoa nổi tiếng đến từ thương hiệu Charme.</p>\r\n\r\n<p>Nếu bạn c&oacute; thắc mắc hoặc c&oacute; nhu cầu đặt h&agrave;ng tại Halushop th&igrave; h&atilde;y li&ecirc;n hệ ngay số điện thoại&nbsp;<strong>09 8801 8802</strong>&nbsp;để c&oacute; thể được hỗ trợ kịp thời nh&eacute;! Cảm ơn c&aacute;c bạn đ&atilde; đọc b&agrave;i viết!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p dir=\"ltr\">Xem ngay: Bật m&iacute; 6 d&ograve;ng&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-luu-huong-lau-nhat\">nước hoa nam lưu hương l&acirc;u nhất</a>&nbsp;thời đại</p>\r\n', 'PTS Test 1 - Vegeta Hakaishin.png1675590270.png', '2023-02-05 09:44:30'),
(16, 'Full set đồ Youg Tee cực chất 2023', 'Full set đồ Youg Tee cực chất 2023', 'Một trong những loại dầu thơm được nhiều người tìm kiếm thời gian gần đây có thể kể đến là nước hoa dành cho dân văn phòng hoặc người làm trong môi trường công sở. Họ thường chọn lựa dựa trên một số tiêu chí như: hương thơm nhẹ, không quá nồng và đặc biệt là giá thành phù hợp, phải chăng.', 'Một trong những loại dầu thơm được nhiều người tìm kiếm thời gian gần đây có thể kể đến là nước hoa dành cho dân văn phòng hoặc người làm trong môi trường công sở. Họ thường chọn lựa dựa trên một số tiêu chí như: hương thơm nhẹ, không quá nồng và đặc biệt là giá thành phù hợp, phải chăng.', '<h2>Tại sao lại cần chọn nước hoa khi l&agrave;m&nbsp;văn ph&ograve;ng</h2>\r\n\r\n<p>D&acirc;n văn ph&ograve;ng hay những người trong m&ocirc;i trường c&ocirc;ng sở sẽ c&oacute; một đặc th&ugrave; đ&oacute; l&agrave; l&agrave;m việc v&agrave; đi lại trong một c&ocirc;ng ty,&nbsp;một nơi c&oacute; kh&ocirc;ng gian kh&aacute; kh&eacute;p k&iacute;n.</p>\r\n\r\n<p>C&oacute; lẻ bạn cũng biết rằng, mỗi người c&oacute; một một hương cơ thể ri&ecirc;ng v&agrave; kh&ocirc;ng hẳn ai cũng thơm.</p>\r\n\r\n<p>Ch&iacute;nh v&igrave; thế để bảo đảm m&ugrave;i cơ thể kh&ocirc;ng l&agrave;m ảnh hưởng đến những người xung quanh, c&oacute; lẻ bạn n&ecirc;n c&oacute; cho m&igrave;nh một lọ nước hoa ph&ugrave; hợp khi l&agrave;m việc.</p>\r\n\r\n<p>Nước hoa d&agrave;nh cho c&aacute;c bạn nam văn ph&ograve;ng c&oacute; thể được chọn lựa dựa v&agrave;o một số ti&ecirc;u ch&iacute; sau:</p>\r\n\r\n<p>M&ugrave;i hương kh&ocirc;ng qu&aacute; nồng hoặc k&eacute;n người sử dụng, ưu ti&ecirc;n hương hoa - cỏ.</p>\r\n\r\n<p>N&ecirc;n chọn nước hoa c&oacute; hương thơm tỏa mang xu hướng thanh lịch, tinh tế một ch&uacute;t th&igrave; c&agrave;ng tốt, bởi v&igrave; bạn d&ugrave;ng nước hoa để đi l&agrave;m chứ kh&ocirc;ng phải đi chơi đ&uacute;ng kh&ocirc;ng n&agrave;o.</p>\r\n\r\n<p>Cuối d&ugrave;ng, độ lưu m&ugrave;i l&acirc;u v&agrave; tỏa hương c&oacute; xa kh&ocirc;ng lu&ocirc;n được nhiều bạn quan t&acirc;m. Với t&iacute;nh chất l&agrave;m việc li&ecirc;n tục, tiếp x&uacute;c nhiều người, dĩ nhi&ecirc;n ai cũng muốn nước hoa m&igrave;nh sử dụng phải thơm thật l&acirc;u v&agrave; ai cũng cảm thấy th&iacute;ch.</p>\r\n\r\n<p>Xem ngay: Bật m&iacute; những&nbsp;<a href=\"https://halushop.vn/vi-tri-xit-nuoc-hoa-nam\">vị tr&iacute; xịt nước hoa nam</a>&nbsp;thơm l&acirc;u cả ng&agrave;y, chuẩn kh&ocirc;ng cần chỉnh</p>\r\n\r\n<h2>Top 5 chai nước hoa nam văn ph&ograve;ng thơm nhất m&agrave; bạn n&ecirc;n thử qua</h2>\r\n\r\n<p>Đ&acirc;y l&agrave; TOP những chai nước hoa văn ph&ograve;ng d&agrave;nh cho nam được Halushop ch&uacute;ng m&igrave;nh chọn lựa ra, thời gian tới sẽ c&ograve;n cập nhật th&ecirc;m nhiều mẫu mới, c&ugrave;ng đ&oacute;n xem nữa c&aacute;c bạn nha.</p>\r\n\r\n<h3>Charme Enternity</h3>\r\n\r\n<p>Mang trong m&igrave;nh sự mới lạ&nbsp;v&agrave; tươi trẻ vốn c&oacute; của một ch&agrave;ng trai đang độ&nbsp;tuổi sung m&atilde;n đầy&nbsp;l&ocirc;i cuốn,&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-enternity\">nước hoa Enternity</a>&nbsp;biến bạn trở n&ecirc;n trẻ trung, tự tin hơn rất nhiều khi tiếp x&uacute;c ai đ&oacute;.</p>\r\n\r\n<p>Nếu như c&aacute;c bạn để &yacute;, th&igrave; Enternity c&oacute; hương thơm rất giống&nbsp;chai&nbsp;<strong>nước hoa Sauvage Dior</strong>&nbsp;kh&aacute; nổi tiếng, nhưng&nbsp;gi&aacute; của chai dầu thơm Enternity th&igrave; thấp hơn rất nhiều so với Sauvage, ph&ugrave; hợp cho nhiều đối tượng kể cả học sinh, sinh vi&ecirc;n hay&nbsp;d&acirc;n văn&nbsp;ph&ograve;ng.</p>\r\n\r\n<p><img alt=\"nước hoa charme enternity có mùi hương giống nước hoa Dior Sauvage\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-charme-enternity-co-mui-huong-giong-nuoc-hoa-dior-sauvage.jpg?v=1663772005707\" /></p>\r\n\r\n<p>Charme Enternity c&oacute; hương thơm rất giống nước hoa Sauvage của h&atilde;ng Dior nổi tiếng</p>\r\n\r\n<p>Mở đầu hương thơm, bạn sẽ dễ d&agrave;ng cảm nhận được m&ugrave;i hương&nbsp;độc đ&aacute;o của hạt ti&ecirc;u v&agrave; cam Bergamot, cho bạn cảm nhận khởi đầu lu&ocirc;n tươi mới, sảng kho&aacute;i v&agrave; v&ocirc; c&ugrave;ng dễ chịu.</p>\r\n\r\n<p>Kế tiếp l&agrave; một hương thơm tuy kh&ocirc;ng mạnh mẽ nhưng cũng đủ để khiến say đắm l&ograve;ng người. B&ecirc;n cạnh đ&oacute;, hoa oải hương sẽ tạo cho bạn v&agrave; đối phương một kh&ocirc;ng gian chất đầy sự &ecirc;m &aacute;i, nhẹ nh&agrave;ng, l&atilde;ng mạn,&nbsp;dễ bị cuốn h&uacute;t hơn.</p>\r\n\r\n<p>Ở tầng hương cuối c&ugrave;ng sẽ l&agrave; sự h&ograve;a hợp, đan xen ho&agrave;n hảo, điều n&agrave;y gi&uacute;p cho mọi gi&aacute;c quan được tỉnh thức v&agrave; gia tăng sự hấp dẫn với hương hoa labdanum, b&aacute;ch dương v&agrave; ambroxan.</p>\r\n\r\n<p>Sở hữu ngay m&ugrave;i hương sảng kho&aacute;i, hấp dẫn, m&atilde;nh liệt của &ldquo;vũ kh&iacute; tỏa hương&rdquo;&nbsp;<strong>Charme Enternity</strong>&nbsp;với mức ưu đ&atilde;i v&ocirc; c&ugrave;ng hấp dẫn đến từ Halushop. Do số lượng c&oacute; hạn, n&ecirc;n h&atilde;y nhanh tay kẻo hết nh&eacute; c&aacute;c ch&agrave;ng trai!</p>\r\n\r\n<h3>Nước hoa Charme Peace No.1</h3>\r\n\r\n<p>Từ khi mới ra bản mẫu thử, Peace đ&atilde; được rất nhiều anh ch&agrave;ng y&ecirc;u th&iacute;ch v&agrave; ưa chuộng, v&igrave; sản phẩm sẽ gi&uacute;p cho người d&ugrave;ng kho&aacute;c l&ecirc;n m&igrave;nh một m&ugrave;i hương mang t&iacute;nh tự do, hiện đại v&agrave; đầy sự ph&oacute;ng kho&aacute;ng.&nbsp;</p>\r\n\r\n<p>Một khi đ&atilde; n&oacute;i đến Peace No.1 th&igrave; ch&uacute;ng ta cũng kh&ocirc;ng thể kh&ocirc;ng nhắc đến sự tinh xảo v&agrave; sang chảnh trong kh&acirc;u thiết kế. Sở hữu t&ocirc;ng m&agrave;u xanh biển mạnh mẽ kết hợp với m&agrave;u trắng đầy b&iacute; ẩn, tổng thể sản phẩm to&aacute;t l&ecirc;n sự trưởng th&agrave;nh, lịch l&atilde;m của một người đ&agrave;n &ocirc;ng trưởng th&agrave;nh.</p>\r\n\r\n<p><a href=\"https://halushop.vn/nuoc-hoa-charme-peace\">No.1 Peace</a>&nbsp;d&agrave;nh cho&nbsp;nam được sản xuất c&oacute; sự c&ocirc; đặc hơn với phi&ecirc;n bản đầu ti&ecirc;n&nbsp;v&agrave; điều n&agrave;y khiến cho hương thơm trở n&ecirc;n th&ecirc;m phần l&ocirc;i cuốn v&agrave; quyến rũ.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"500\" longdesc=\"https://halushop.vn/N%C6%B0%E1%BB%9Bc%20hoa%20Charme%20Peace%20No.1%20ch%C3%ADnh%20h%C3%A3ng%20d%C3%A0nh%20cho%20nam%20gi%C3%A1%20t%E1%BB%91t%20nh%E1%BA%A5t\" name=\"Nước hoa Charme Peace No.1 chính hãng dành cho nam giá tốt nhất\" scrolling=\"no\" src=\"https://www.youtube.com/embed/sGzsq8kPUzI\" title=\"Nước hoa Charme Peace No.1 chính hãng dành cho nam giá tốt nhất\" width=\"1080\"></iframe></p>\r\n\r\n<p>Lớp hương đầu ti&ecirc;n b&ugrave;ng nổ với cam Bergamot, dứa, b&aacute;ch x&ugrave;, gi&uacute;p khơi dậy sự tự tin, mạnh mẽ của tuổi trẻ.</p>\r\n\r\n<p>Tiếp đến đ&oacute; l&agrave; sự tươi m&aacute;t đa dạng mang tới sự thoải m&aacute;i, sảng kho&aacute;i của hoa l&yacute; chua.</p>\r\n\r\n<p>V&agrave; cuối c&ugrave;ng, điểm đặc biệt nhất của tầng hương cuối đ&oacute; l&agrave; hương gỗ tuyết t&ugrave;ng, hương cỏ hương b&agrave;i xa hoa như tiếp th&ecirc;m năng lượng, sức sống cho người d&ugrave;ng.</p>\r\n\r\n<p>Bạn c&ograve;n chờ đợi g&igrave; m&agrave; kh&ocirc;ng mua chai nước hoa Charme Peace No.1 100ml ch&iacute;nh h&atilde;ng chỉ c&oacute; tại Halushop. Sản phẩm sẽ chỉ c&oacute; ưu đ&atilde;i d&agrave;nh cho 15 kh&aacute;ch h&agrave;ng đầu ti&ecirc;n trong th&aacute;ng. Đặt nhanh kẻo hết c&aacute;c bạn nh&eacute;!</p>\r\n\r\n<p>Xem ngay: Kh&aacute;m ph&aacute; 6+ chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-duoi-2-trieu\">nước hoa nam ch&iacute;nh h&atilde;ng gi&aacute; dưới 2 triệu</a>&nbsp;thơm cực l&acirc;u</p>\r\n\r\n<h3>Nước hoa Charme Good Men xanh</h3>\r\n\r\n<p>Trong thời điểm vừa ra mắt, chai nước hoa n&agrave;y đ&atilde; thu h&uacute;t được đ&ocirc;ng đảo sự y&ecirc;u th&iacute;ch từ những t&iacute;n đồ v&agrave; những người y&ecirc;u nước hoa nam bởi c&aacute;i hương thơm đầy mới lạ, tự do, cũng như đầy t&iacute;nh kh&aacute;m ph&aacute; của sản phẩm.</p>\r\n\r\n<p>Với một hương thơm tươi m&aacute;t, sảng kho&aacute;i n&agrave;y th&igrave; chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-good-men-xanh\">Good Men m&agrave;u xanh</a>&nbsp;sẽ rất ph&ugrave; hợp cho những anh ch&agrave;ng y&ecirc;u th&iacute;ch sự tự do v&agrave; đam m&ecirc; kh&aacute;m ph&aacute; những điều mới mẻ.</p>\r\n\r\n<p>Thiết kế của&nbsp;n&oacute; cũng được h&atilde;ng l&agrave;m giống hệt với phi&ecirc;n bản v&agrave;ng c&ugrave;ng t&ecirc;n, thế nhưng thay v&igrave; m&agrave;u v&agrave;ng sang chảnh l&agrave;m chủ đạo th&igrave; c&ocirc;ng ty&nbsp;lại quyết định sử dụng m&agrave;u xanh tươi m&aacute;t hơn.</p>\r\n\r\n<p>Ch&iacute;nh điều n&agrave;y đ&atilde;&nbsp;gi&uacute;p t&ocirc;n l&ecirc;n vẻ đẹp lịch l&atilde;m, trưởng th&agrave;nh, sang trọng của một người đ&agrave;n &ocirc;ng tinh tế.</p>\r\n\r\n<p>M&ugrave;i hương ch&iacute;nh l&agrave; yếu tố khiến cho mọi c&ocirc; g&aacute;i xung quanh bị l&ocirc;i cuốn khi bạn xịt chai nước hoa nam t&iacute;nh n&agrave;y.</p>\r\n\r\n<p>C&aacute;c tầng hương đều kh&ocirc;ng qu&aacute;&nbsp;bị gắt hay ngọt qu&aacute; mức, m&agrave; ch&uacute;ng cứ từ từ, đều đều v&agrave; rất nhẹ nh&agrave;ng, tinh tế, điều m&agrave; khiến cho ta c&oacute; một cảm gi&aacute;c nhớ nhung đến kh&oacute; tả.</p>\r\n\r\n<p>Khi bạn vừa xịt những lớp hương đầu l&ecirc;n cơ thể, th&igrave; sẽ c&oacute; một sự chuyển giao nhẹ giữa hai tầng hương đầu v&agrave; giữa, tạo cho ta cảm gi&aacute;c cay nhẹ của hạt ti&ecirc;u, v&agrave; rồi dần dần ch&uacute;ng sẽ được chuyển sang hương hoa oải hương v&agrave; m&ugrave;i cỏ thư th&aacute;i, dễ chịu.</p>\r\n\r\n<p>Khi về cuối ng&agrave;y, hỗn hợp hương thơm của Ambroxan, b&aacute;ch hương v&agrave; Labdarum sẽ c&agrave;ng l&agrave;m bạn trở n&ecirc;n kh&oacute; phai hơn trong mắt của người con g&aacute;i đối diện.</p>\r\n\r\n<p>Bạn c&ograve;n chờ đợi g&igrave; m&agrave; kh&ocirc;ng rinh ngay chai nước hoa Charme Good Men xanh ch&iacute;nh h&atilde;ng n&agrave;y với gi&aacute; cực hời chỉ c&oacute; duy nhất tại Halushop. Số lượng ưu đ&atilde;i c&oacute; hạn n&ecirc;n c&aacute;c bạn h&atilde;y đặt nhanh kẻo hết nha!</p>\r\n\r\n<h3>Nước hoa Charme Boss</h3>\r\n\r\n<p>Chỉ cần nghe qua c&aacute;i t&ecirc;n th&ocirc;i l&agrave; ch&uacute;ng ta đ&atilde; c&oacute; thể biết được đ&acirc;y l&agrave; một sản phẩm c&oacute; m&ugrave;i hương đẳng cấp d&agrave;nh ri&ecirc;ng cho ph&aacute;i mạnh.</p>\r\n\r\n<p>B&ecirc;n cạnh c&aacute;i vẻ đẹp m&ecirc; người với thiết kế sang trọng của t&ocirc;ng m&agrave;u xanh nam t&iacute;nh l&agrave;m chủ đạo ra th&igrave; m&ugrave;i hương của&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-charme-boss\">Charme Boss</a>&nbsp;cũng sẽ khiến bạn trở n&ecirc;n lịch l&atilde;m, hiện đại v&agrave; men lỳ hơn rất nhiều.</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"500\" longdesc=\"https://halushop.vn/%C4%90%E1%BA%ADp%20h%E1%BB%99p%20n%C6%B0%E1%BB%9Bc%20hoa%20Charme%20Boss%20100ml%20ch%C3%ADnh%20h%C3%A3ng,%20gi%C3%A1%20t%E1%BB%91t%20nh%E1%BA%A5t\" name=\"Đập hộp nước hoa Charme Boss 100ml chính hãng, giá tốt nhất\" scrolling=\"no\" src=\"https://www.youtube.com/embed/TZrwoO2Dn_k\" title=\"Đập hộp nước hoa Charme Boss 100ml chính hãng, giá tốt nhất\" width=\"1080\"></iframe></p>\r\n\r\n<p>Bạn c&oacute; thể dễ d&agrave;ng cảm nhận được những nốt&nbsp;hương nh&egrave; nhẹ&nbsp;khiến cho đối phương phải c&oacute; thiện cảm, ấn tượng ngay trong lần đầu gặp mặt.</p>\r\n\r\n<p>Hương&nbsp;cam Bergamot c&oacute; vai tr&ograve; rất quan trọng ở tầng hương đầu ti&ecirc;n, tiếp đến l&agrave;&nbsp;quả qu&yacute;t hồng v&agrave; một ch&uacute;t tho&aacute;ng qua của hương lục tạo cảm gi&aacute;c dễ chịu, thư th&aacute;i hơn.</p>\r\n\r\n<p>Với sự kết hợp ho&agrave;n hảo của hương thơm hoa quả tự nhi&ecirc;n trong tầng hương thứ hai, chắc chắn sẽ l&agrave; mấu chốt để cho sản phẩm đem lại cho bạn sự tươi m&aacute;t,&nbsp;sảng kho&aacute;i, sẵn s&agrave;ng cho một&nbsp;cho ng&agrave;y&nbsp;l&agrave;m việc hiệu quả.</p>\r\n\r\n<p>Cuối c&ugrave;ng ch&iacute;nh l&agrave; c&aacute;i hương thoang thoảng của gỗ đ&agrave;n hương, hổ ph&aacute;ch, vani v&agrave; xạ hương, khiến cho bầu kh&ocirc;ng gian trở n&ecirc;n th&ecirc;m ấm &aacute;p, v&agrave; điều n&agrave;y sẽ gi&uacute;p bạn trở n&ecirc;n gần gũi hơn trước mắt đối phương.</p>\r\n\r\n<p>H&atilde;y nhanh tay sở hữu Charme Boss - m&ugrave;i thơm m&agrave; mọi ch&agrave;ng trai đều muốn c&oacute;, nhằm chinh phục được đối phương của bạn. Ngay b&acirc;y giờ tại Halushop, Boss đang c&oacute; mức gi&aacute; kh&ocirc;ng thể thấp v&agrave; hấp dẫn hơn. Vậy n&ecirc;n bạn h&atilde;y đặt h&agrave;ng ngay kẻo trễ nha!</p>\r\n\r\n<p>Xem ngay: Điểm danh 6 chai&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-duoi-500k\">nước hoa nam ch&iacute;nh h&atilde;ng gi&aacute; dưới 500k</a>&nbsp;thơm cực l&acirc;u</p>\r\n\r\n<h3>Nước hoa Charme Cool Water</h3>\r\n\r\n<p>Mới mẻ, nam t&iacute;nh v&agrave; lịch l&atilde;m ch&iacute;nh l&agrave; những t&iacute;nh từ m&agrave; đa số những kh&aacute;ch h&agrave;ng đ&atilde; sử dụng qua sản phẩm n&agrave;y m&ocirc; tả về Cool Water.</p>\r\n\r\n<p><a href=\"https://halushop.vn/nuoc-hoa-charme-cool-water\">Charme Cool Water</a>&nbsp;sở hữu cho m&igrave;nh những nốt hương của sự tươi m&aacute;t v&agrave; sảng kho&aacute;i của đại dương bao la, h&ograve;a quyện, đan xen v&agrave;o đ&oacute; ch&iacute;nh l&agrave; kh&ocirc;ng kh&iacute; biển cả m&ecirc;nh m&ocirc;ng, bao la bất tận.</p>\r\n\r\n<p><img alt=\"nước hoa cool water 100ml chính hãng dành cho nam giới\" src=\"https://bizweb.dktcdn.net/100/419/170/files/nuoc-hoa-cool-water-100ml-chinh-hang-danh-cho-nam-gioi.jpg?v=1639045009157\" /></p>\r\n\r\n<p>Kh&aacute;ch h&agrave;ng feedback nước hoa charme Cool Water khi đặt h&agrave;ng tại Halushop</p>\r\n\r\n<p>Tổng thể sản phẩm như một l&agrave;n gi&oacute; mới, g&oacute;p phần nhấn mạnh sự nam t&iacute;nh v&agrave; tinh tế, trưởng th&agrave;nh của một người đ&agrave;n &ocirc;ng.</p>\r\n\r\n<p>Đ&acirc;y chắc chắn sẽ l&agrave; một &ldquo;thỏi nam ch&acirc;m khổng lồ&rdquo; gi&uacute;p thu h&uacute;t sự ch&uacute; &yacute; của c&aacute;c c&ocirc; g&aacute;i khi bạn sử dụng dầu thơm Cool Water nơi c&ocirc;ng sở.</p>\r\n\r\n<p>Nốt hương đầu l&agrave; hương thơm thanh khiết, trong l&agrave;nh đến dễ chịu của tinh dầu l&aacute; chanh.</p>\r\n\r\n<p>Kế đến l&agrave; sự giao thoa, h&ograve;a quyện của hoa oải hương, hoa b&ocirc;ng vải v&agrave; rong biển, tổ hợp n&agrave;y sẽ mang tới cho bạn sự tươi m&aacute;t, đầy sức sống.</p>\r\n\r\n<p>Cuối c&ugrave;ng l&agrave; sự phong độ, mạnh mẽ của người đ&agrave;n &ocirc;ng với hổ ph&aacute;ch, hoắc hương v&agrave; hương gỗ kết hợp với gỗ tuyết t&ugrave;ng.</p>\r\n\r\n<p>Mua ngay nước hoa Charme Cool Water ch&iacute;nh h&atilde;ng bản mới với mức gi&aacute; hấp dẫn chỉ c&oacute; tại Halushop. Đừng chần chờ m&agrave; h&atilde;y đặt h&agrave;ng ngay đi n&agrave;o c&aacute;c ch&agrave;ng trai.</p>\r\n\r\n<p>Vừa rồi Halushop giới thiệu&nbsp;đến c&aacute;c bạn top 5 chai nước hoa nam văn ph&ograve;ng thơm nhất, được nhiều người ưa chuộng m&agrave; bạn n&ecirc;n thử qua một lần.</p>\r\n\r\n<p>Sự y&ecirc;u th&iacute;ch, chất lượng&nbsp;cũng như gi&aacute; th&agrave;nh hợp l&yacute; l&agrave; những điều&nbsp;m&agrave; Halushop lu&ocirc;n muốn d&agrave;nh cho kh&aacute;ch h&agrave;ng của m&igrave;nh.</p>\r\n\r\n<p>Vậy n&ecirc;n c&ograve;n chần chờ g&igrave; m&agrave; kh&ocirc;ng đặt h&agrave;ng ngay những chai nước hoa tr&ecirc;n tại shop ch&uacute;ng m&igrave;nh nha.</p>\r\n\r\n<p>Nếu bạn c&oacute; thắc mắc hoặc c&oacute; nhu cầu đặt h&agrave;ng tại Halushop th&igrave; h&atilde;y li&ecirc;n hệ ngay số điện thoại&nbsp;<strong>09 8801 8802</strong>&nbsp;để c&oacute; thể được hỗ trợ kịp thời nh&eacute;.&nbsp;Cảm ơn c&aacute;c bạn đ&atilde; đọc b&agrave;i viết!</p>\r\n\r\n<p dir=\"ltr\">Xem ngay: Bật m&iacute; 6 d&ograve;ng&nbsp;<a href=\"https://halushop.vn/nuoc-hoa-nam-luu-huong-lau-nhat\">nước hoa nam lưu hương l&acirc;u nhất</a>&nbsp;thời đại</p>\r\n', '2TL Text Glitch Light Leak 1.jpg1675926001.jpg', '2023-02-09 07:00:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `id_cat`, `price`, `sale_price`, `description`, `img`, `status`, `created_at`) VALUES
(8, 'Áo phông Zombie họa tiết Youg Tee cực chất', 48, 10000000, 0, '<p>&aacute;dasdasasdads</p>\r\n', 'AVT 2TL.png-1675092928.jpg', 1, '2023-01-30 15:35:28'),
(9, 'Quần Âu ZOMBIE Limited Edition', 47, 100000, 0, '<p>Quần &Acirc;u ZOMBIE Limited Edition</p>\r\n', 'DPG.png-1675093547.jpg', 1, '2023-01-30 15:45:47'),
(10, 'Quần Âu ZOMBIE Limited Edition 2023', 47, 100000, 0, '<p>Quần &Acirc;u ZOMBIE Limited Edition 2023</p>\r\n', 'DPG.png-1675094616.jpg', 1, '2023-01-30 16:03:36'),
(11, 'Tank Top Nam cực chất 2023', 48, 100000000, 10000, '<p>Tank Top</p>\r\n', 'Flexin Game Project 800x800.jpg-1675095656.png', 1, '2023-01-30 16:20:56'),
(12, 'Quần Jogger Pants', 48, 10000000, 0, '<p>Jogger</p>\r\n', 'Badass Son 800x800.jpg-1675096022.jpg', 1, '2023-01-30 16:27:02'),
(14, '	Áo phông Zombie họa tiết Youg Tee cực chất 1', 48, 1000000, 0, '<p>&nbsp;&nbsp; &nbsp;&Aacute;o ph&ocirc;ng Zombie họa tiết Youg Tee cực chất 1</p>\r\n', 'FC THKT.jpg-1675759491.png', 1, '2023-02-07 08:44:51'),
(15, 'Áo phông Zombie họa tiết Youg Tee cực chất 2', 47, 1000000, 100000, '<p>&nbsp;&nbsp; &nbsp;&Aacute;o ph&ocirc;ng Zombie họa tiết Youg Tee cực chất 2</p>\r\n', 'Luôn kề bên 800x800.jpg-1675759598.png', 1, '2023-02-07 08:46:38'),
(16, '	Áo phông Zombie họa tiết Youg Tee cực chất 3', 48, 1000000, 0, '<p>&nbsp;&nbsp; &nbsp;&Aacute;o ph&ocirc;ng Zombie họa tiết Youg Tee cực chất 2</p>\r\n', 'PTS Test 1 - Vegeta Hakaishin.png-1675759633.png', 1, '2023-02-07 08:47:13'),
(17, 'Áo phông Zombie họa tiết Youg Tee cực chất', 48, 100000, 10000, '<p>&Aacute;o ph&ocirc;ng Zombie họa tiết Youg Tee cực chất</p>\r\n', 'AVT 2TL.png-1675783423.png', 1, '2023-02-07 15:23:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` text NOT NULL,
  `gender` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_admin`
--

INSERT INTO `user_admin` (`id`, `name`, `full_name`, `username`, `password`, `email`, `avatar`, `gender`, `created_at`) VALUES
(26, 'Trung Thành', 'Lã Nguyễn Trung Thành', 'lathanh23', '$2y$10$XWLaQYE/KBWSwaju4D3qLeWC1c52SDspBCGS4ahhdK6L3hj8/5FbO', 'trungthanhla1110@gmail.com', '', 'Male', '2023-02-18 00:03:14'),
(27, 'Vân Anh', 'Lã Thị Vân Anh', 'lathanh11', '$2y$10$LIV.813tdcG8DSpKYAh6IOaWMm3ZGTsRXoAMN578pcuhn69Oyx.Km', 'fvteam69@gmail.com', '', 'Female', '2023-02-18 00:03:35');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Chỉ mục cho bảng `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `imgs_products`
--
ALTER TABLE `imgs_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `img_sale_poster`
--
ALTER TABLE `img_sale_poster`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `img_sale_products`
--
ALTER TABLE `img_sale_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cate_product` (`id_cat`);

--
-- Chỉ mục cho bảng `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `imgs_products`
--
ALTER TABLE `imgs_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `img_sale_poster`
--
ALTER TABLE `img_sale_poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT cho bảng `img_sale_products`
--
ALTER TABLE `img_sale_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_cate_product` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
