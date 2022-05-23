-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 22, 2022 lúc 02:14 AM
-- Phiên bản máy phục vụ: 10.5.12-MariaDB
-- Phiên bản PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `id18932519_pro5a_vinhld`
--
CREATE DATABASE IF NOT EXISTS `db_user` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db_user`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `idStudent` int(11) DEFAULT NULL,
  `idAssignment` int(11) DEFAULT NULL,
  `studentName` varchar(100) DEFAULT NULL,
  `fileName` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `assignment`
--

INSERT INTO `assignment` (`id`, `title`, `idStudent`, `idAssignment`, `studentName`, `fileName`, `date`) VALUES
(1, 'Giai Bai1', 3, 1, 'student1', 'flag.txt', '2022-05-12 22:03:20'),
(2, 'Giai Bai2', 3, 2, 'student1', 'flag.txt', '2022-05-12 22:04:31'),
(3, 'Student2 giai bai1', 4, 1, 'student2', 'bai1student1.txt', '2022-05-12 22:47:20'),
(4, 'Giai Bai 3', 4, 3, 'student2', 'St2Bai3.txt', '2022-05-12 23:12:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `idTeacher` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`id`, `idTeacher`, `title`, `content`, `file`, `date`) VALUES
(1, 1, 'bai1', 'pro', 'flag.txt', '2022-05-12 17:56:05'),
(2, 1, 'Bai2', 'asd', 'HTTP Request Smuggling.docx', '2022-05-12 17:56:05'),
(3, 1, 'Bai3', 'prog3', 'bai1student1.txt', '2022-05-12 23:07:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `idTeacher` int(11) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `hint` varchar(1000) DEFAULT NULL,
  `fileName` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `game`
--

INSERT INTO `game` (`id`, `idTeacher`, `title`, `hint`, `fileName`, `date`) VALUES
(4, 1, 'Game1', 'Game', 'flag.txt', '2022-05-13 23:55:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sendId` int(11) DEFAULT NULL,
  `recvId` int(11) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `sendId`, `recvId`, `content`, `author`) VALUES
(11, 1, 4, 'Hello', NULL),
(24, 2, 1, 'Xin Chao toi la teacher2', 'teacher2'),
(25, 1, 1, 'Xin chao toi la teacher1', 'teacher1'),
(27, 3, 1, 'Xin Chao toi la student1', 'student1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `role`, `avatar`) VALUES
(1, 'teacher1', '123456a@A', 'Le Van A', 'a@teacher1.com', '0123456789', 1, '1652238384-anh.png'),
(2, 'teacher2', '123456a@A', 'Le Van B', 'a@a.com', '123456789', 1, '1652236823-anh.png'),
(3, 'student1', '123456a@A', 'Le Van C', 'a@a.com', '123456789', 0, NULL),
(4, 'student2', '123456a@A', 'Le Van D', 'a@student2.com', '123456789', 0, ''),
(7, 'test', 'test', 'test', 'test@gmail.com', '0123456789', 0, '1652242363-6dcd56efef64d4f51e5c5185324af29e.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
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
-- AUTO_INCREMENT cho bảng `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
