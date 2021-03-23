-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 09:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_book`
--

CREATE TABLE `tb_book` (
  `book_id` int(11) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_start` date NOT NULL,
  `book_end` date NOT NULL,
  `book_status` int(11) NOT NULL,
  `book_snap` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_book`
--

INSERT INTO `tb_book` (`book_id`, `car_id`, `user_id`, `book_start`, `book_end`, `book_status`, `book_snap`) VALUES
(8, '6ded6f68057d73f8376160aa42f56b54', 1, '2021-03-23', '2021-03-24', 2, '76cd48ab-f055-4c57-b79d-60bce7367dad');

-- --------------------------------------------------------

--
-- Table structure for table `tb_car`
--

CREATE TABLE `tb_car` (
  `car_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `car_door` int(11) NOT NULL,
  `car_seat` int(11) NOT NULL,
  `car_transmision` tinyint(1) NOT NULL,
  `car_age` int(11) NOT NULL,
  `car_location` varchar(255) NOT NULL,
  `car_area` varchar(255) NOT NULL,
  `car_lat` varchar(255) NOT NULL,
  `car_long` varchar(255) NOT NULL,
  `car_price` int(11) NOT NULL,
  `car_avaliable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_car`
--

INSERT INTO `tb_car` (`car_id`, `user_id`, `car_name`, `car_door`, `car_seat`, `car_transmision`, `car_age`, `car_location`, `car_area`, `car_lat`, `car_long`, `car_price`, `car_avaliable`) VALUES
('6ded6f68057d73f8376160aa42f56b54', 2, 'Honda CR-V', 4, 4, 1, 17, 'Jalan Taman Bungkul', 'Darmo, Kota Surabaya, Jawa Timur, Indonesia', '-7.29087', '112.74', 800000, 1),
('788ad44de81e03d748b71cfd926820a8', 2, 'Daihatsu Ayla', 4, 6, 0, 18, 'Universitas Negeri Surabaya (UNESA) Ketintang', 'Jalan Ketintang, Ketintang, Kota Surabaya, Jawa Timur, Indonesia', '-7.31333', '112.727', 500000, 1),
('96297a2f7e4ebd3fe1a1baaf79afb3e7', 2, 'Lancer Evolution III', 4, 4, 1, 17, 'Jalan Ketintang Madya', 'Jalan Ketintang Madya, Ketintang, Kota Surabaya, Jawa Timur, Indonesia', '-7.31563', '112.723', 1500000, 1),
('dcdbfe34819bd5da8ba1885ee0858a82', 2, 'Pajero Sport', 4, 6, 0, 18, 'Jambangan', 'Jambangan, Surabaya City, East Java, Indonesia', '-7.32108', '112.718', 1500000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_photo`
--

CREATE TABLE `tb_photo` (
  `photo_id` int(11) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `car_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_photo`
--

INSERT INTO `tb_photo` (`photo_id`, `car_id`, `car_photo`) VALUES
(22, '96297a2f7e4ebd3fe1a1baaf79afb3e7', 'user_car_0.jpg'),
(23, '96297a2f7e4ebd3fe1a1baaf79afb3e7', 'user_car_1.jpg'),
(24, '788ad44de81e03d748b71cfd926820a8', 'user_car_0.jpg'),
(25, '788ad44de81e03d748b71cfd926820a8', 'user_car_1.jpg'),
(26, '6ded6f68057d73f8376160aa42f56b54', 'user_car_0.jpg'),
(27, '6ded6f68057d73f8376160aa42f56b54', 'user_car_1.jpeg'),
(28, '6ded6f68057d73f8376160aa42f56b54', 'user_car_2.jpg'),
(29, 'dcdbfe34819bd5da8ba1885ee0858a82', 'user_car_0.jpg'),
(30, 'dcdbfe34819bd5da8ba1885ee0858a82', 'user_car_1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_address`, `user_phone`, `user_photo`, `user_type`) VALUES
(1, 'Qolbu Dzikru', 'anjeaye1231@gmail.com', 'myrental123', 'Jl. Ketintang No. 1 A', '085730209109', 'user_photo.jpg', 0),
(2, 'Frank Lampard', 'frank@gmail.com', 'frank123', 'Jl. Ketintang No. 1 A', '085655709577', 'user_photo.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_book`
--
ALTER TABLE `tb_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `tb_car`
--
ALTER TABLE `tb_car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `tb_photo`
--
ALTER TABLE `tb_photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_book`
--
ALTER TABLE `tb_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_photo`
--
ALTER TABLE `tb_photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
