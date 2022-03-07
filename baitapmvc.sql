-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2022 lúc 10:59 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `baitapmvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `departmentcode` varchar(20) NOT NULL,
  `departmentname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`id`, `departmentcode`, `departmentname`) VALUES
(10, 'CNTT', 'Công nghệ thông tin'),
(16, 'KT', 'Kế toán 123'),
(18, 'KD', 'Kinh doanh'),
(25, 'NS', 'Nhân sự');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employeecode` varchar(20) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1: member, 2:admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `employeecode`, `fullname`, `password`, `departmentid`, `role`) VALUES
(21, 'CBA', 'CBA', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(22, '123', '123', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(23, '321', '321', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(24, '111', '111', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(25, '222', '222', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(26, 'AFA', 'FSFS', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(27, 'GSGD', 'SGS', '25d55ad283aa400af464c76d713c07ad', 10, 1),
(30, 'ABC', 'ABC', '25d55ad283aa400af464c76d713c07ad', 18, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
