-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 01, 2023 lúc 11:02 AM
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
(50, 'Quần Âu', 1, '2023-01-30 15:31:16'),
(51, 'Áo phông unisex', 1, '2023-01-30 16:35:16');

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
(20, 12, 'Flexin Game Project 800x800.jpg-1675096022.jpg', '', '2023-01-30 16:27:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `metatitle` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `metades` varchar(200) NOT NULL,
  `posts` text NOT NULL,
  `thumbnail` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `metatitle`, `description`, `metades`, `posts`, `thumbnail`, `created_at`) VALUES
(3, 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', 'Youg Tee feat Wrxdie cực cháy', '<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n\r\n<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n\r\n<p>Youg Tee feat Wrxdie cực ch&aacute;y</p>\r\n', 'AVT 2TL.png1674931998.png', '2023-01-28 18:53:18');

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
(8, 'Áo phông Zombie họa tiết Youg Tee cực chất', 47, 10000000, 0, '<p>&aacute;dasdasasdads</p>\r\n', 'AVT 2TL.png-1675092928.jpg', 1, '2023-01-30 15:35:28'),
(9, 'Quần Âu ZOMBIE Limited Edition', 48, 100000, 0, '<p>Quần &Acirc;u ZOMBIE Limited Edition</p>\r\n', 'DPG.png-1675093547.jpg', 0, '2023-01-30 15:45:47'),
(10, 'Quần Âu ZOMBIE Limited Edition 2023', 50, 100000, 0, '<p>Quần &Acirc;u ZOMBIE Limited Edition 2023</p>\r\n', 'DPG.png-1675094616.jpg', 0, '2023-01-30 16:03:36'),
(11, 'Tank Top Nam cực chất 2023', 47, 100000000, 10000, '<p>Tank Top</p>\r\n', 'Flexin Game Project 800x800.jpg-1675095656.png', 1, '2023-01-30 16:20:56'),
(12, 'Quần Jogger Pants', 48, 10000000, 0, '<p>Jogger</p>\r\n', 'Badass Son 800x800.jpg-1675096022.jpg', 1, '2023-01-30 16:27:02');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Chỉ mục cho bảng `imgs_products`
--
ALTER TABLE `imgs_products`
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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `imgs_products`
--
ALTER TABLE `imgs_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
