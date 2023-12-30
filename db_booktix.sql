-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 07:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_booktix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'heru27s', 'Heru Setiawan', 'heru27setia@gmail.com', 'x-saitama.jpg', '$2y$10$O8j9Qv2V6J2MFHxe0PlGfuz7HSdCKLdf9PRlWxI9LCW2Iy3r5gmzO', 1, 1, 1685262077),
(2, 'martis27', 'Martis Fighter', 'martis@gmail.com', 'x-martis.png', '$2y$10$YGrkvQaz4uaX1eS7Qvvmte2x7IJHM.2UxvQnP3zeALQkoEX9FaAly', 2, 1, 1685262108);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `card_id` varchar(128) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `name`, `email`, `card_id`, `phone`, `address`, `image`, `is_active`, `date_created`) VALUES
(18, 'alucard27', '$2y$10$Z3aZuGIRCy2Jg/M82/Uge.QOSGVJphPDSVIeuceXgFUUtnTyWQtva', 'Alucard Assasin', 'alucard@gmail.com', '', '088xxxxxxxx', '', 'x-rikudo.png', 1, 1702688783),
(28, 'zilong27', '$2y$10$CTsA6YG9TgrEhZVOFmcmJe/aNPgdMu8MrGHSRLpzai9.pR9BdUDYm', 'Zilong Fighter', 'zilong@gmail.com', '', '088xxxxxxxx', '', 'defaultCustomer.png', 1, 1702857336),
(29, 'miya27', '$2y$10$x0rF1k8ShaVY5Sl.LHHqJ.wbCI1mBTs8D0x3xEIHKbPlwBlwETxh.', 'Miya Marksman', 'miya@gmail.com', '', '088xxxxxxxx', '', 'defaultCustomer.png', 1, 1702857356);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_film`
--

CREATE TABLE `tbl_film` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_film`
--

INSERT INTO `tbl_film` (`id`, `title`, `img`, `category`, `description`) VALUES
(1, 'Captain Amerika', 'captain.jpg', 'Action', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sit molestias architecto. Assumenda praesentium nemo non commodi ipsa quos est dignissimos, error odit aut ea in, cum iure delectus, sequi repudiandae omnis nesciunt libero velit doloribus?'),
(40, 'Thor', 'thor.jpg', 'Action', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sit molestias architecto. Assumenda praesentium nemo non commodi ipsa quos est dignissimos, error odit aut ea in, cum iure delectus, sequi repudiandae omnis nesciunt libero velit doloribus?'),
(41, 'Hulk', 'hulk.jpg', 'Action', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sit molestias architecto. Assumenda praesentium nemo non commodi ipsa quos est dignissimos, error odit aut ea in, cum iure delectus, sequi repudiandae omnis nesciunt libero velit doloribus?'),
(44, 'Spiderman', 'spiderman.jpg', 'Action', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sit molestias architecto. Assumenda praesentium nemo non commodi ipsa quos est dignissimos, error odit aut ea in, cum iure delectus, sequi repudiandae omnis nesciunt libero velit doloribus?'),
(54, 'IronMan', 'ironman.jpg', 'Action', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sit molestias architecto. Assumenda praesentium nemo non commodi ipsa quos est dignissimos, error odit aut ea in, cum iure delectus, sequi repudiandae omnis nesciunt libero velit doloribus?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `message` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `date`, `price`, `message`) VALUES
(1, '20/12/2023', 25000, 'not promo today'),
(14, '21/12/2023', 35000, 'not promo today'),
(15, '22/12/2023', 45000, 'not promo today');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seat`
--

CREATE TABLE `tbl_seat` (
  `id` int(11) NOT NULL,
  `code_seat` varchar(100) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `ordered` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seat`
--

INSERT INTO `tbl_seat` (`id`, `code_seat`, `studio_id`, `ordered`) VALUES
(1, 'A1', 1, 1),
(2, 'A2', 1, 0),
(3, 'A3', 1, 0),
(5, 'A4', 1, 0),
(9, 'A5', 1, 1),
(10, 'A6', 1, 0),
(11, 'A7', 1, 0),
(12, 'A8', 1, 0),
(13, 'A9', 1, 0),
(14, 'A10', 1, 0),
(15, 'B1', 1, 0),
(16, 'B2', 1, 0),
(17, 'B3', 1, 0),
(18, 'B4', 1, 0),
(19, 'B5', 1, 0),
(20, 'B6', 1, 0),
(21, 'B7', 1, 0),
(22, 'B8', 1, 0),
(23, 'B9', 1, 0),
(24, 'B10', 1, 0),
(25, 'C1', 1, 0),
(26, 'C2', 1, 0),
(27, 'C3', 1, 0),
(28, 'C4', 1, 0),
(29, 'C5', 1, 0),
(30, 'C6', 1, 0),
(31, 'C7', 1, 0),
(32, 'C8', 1, 0),
(33, 'C9', 1, 0),
(34, 'C10', 1, 0),
(35, 'A1', 2, 0),
(36, 'A2', 2, 0),
(37, 'A3', 2, 0),
(38, 'A4', 2, 0),
(39, 'A5', 2, 0),
(40, 'A6', 2, 0),
(41, 'A7', 2, 0),
(42, 'A8', 2, 0),
(43, 'A9', 2, 0),
(44, 'A10', 2, 0),
(45, 'A1', 3, 0),
(46, 'A2', 3, 0),
(47, 'A3', 3, 0),
(48, 'A4', 3, 0),
(49, 'A5', 3, 0),
(50, 'A6', 3, 0),
(51, 'A7', 3, 0),
(52, 'A8', 3, 0),
(53, 'A9', 3, 0),
(54, 'A10', 3, 0),
(55, 'B1', 3, 0),
(56, 'B2', 3, 0),
(57, 'B3', 3, 0),
(58, 'B4', 3, 0),
(59, 'B5', 3, 0),
(60, 'B6', 3, 0),
(61, 'B7', 3, 0),
(63, 'B8', 3, 0),
(64, 'B9', 3, 0),
(65, 'B10', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studio`
--

CREATE TABLE `tbl_studio` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `information` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_studio`
--

INSERT INTO `tbl_studio` (`id`, `name`, `information`, `is_active`) VALUES
(1, 'Studio 1', 'ready', 1),
(2, 'Studio 2', 'ready', 1),
(3, 'Studio 3', 'ready', 1),
(4, 'Studio 4', 'maintenance', 0),
(6, 'Studio 5', 'maintenance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time`
--

CREATE TABLE `tbl_time` (
  `id` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_time`
--

INSERT INTO `tbl_time` (`id`, `time`, `schedule_id`) VALUES
(1, '07:30', 1),
(14, '10:30', 1),
(17, '14:00', 1),
(21, '16:30', 1),
(22, '20:00', 1),
(23, '10:30', 14),
(24, '14:00', 14),
(25, '17:00', 14),
(26, '07:30', 15),
(27, '10:30', 15);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Heru Setiawan', 'heru27setia@gmail.com', 'default.png', '$2y$10$EfDXqmGLhZFBrbuUp.VJLOj43Ylyxsv8EXnj3SrMTwAYAKQoMgHnu', 1, 1, 1685262077);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(17, 2, 3),
(29, 1, 2),
(30, 1, 3),
(38, 1, 4),
(40, 1, 5),
(42, 2, 5),
(43, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin'),
(3, 'Users'),
(5, 'Bioskop');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Owner', 'dashboard/superadmin', 'fas fa-fw fa-user-secret', 1),
(2, 2, 'Dashboard', 'dashboard/admin', 'fas fa-fw fa-tachometer-alt', 1),
(3, 1, 'Role', 'dashboard/superadmin/role', 'fas fa-fw fa-user-tie', 1),
(4, 1, 'Menu', 'dashboard/superadmin/menu', 'fab fa-elementor', 1),
(6, 3, 'List Admin', 'dashboard/user/listadmin', 'fas fa-fw fa-users', 1),
(7, 3, 'List Customers', 'dashboard/usercustomer', 'fas fa-fw fa-users', 1),
(28, 2, 'Order', 'dashboard/admin/order', 'fas fa-envelope-open-text', 1),
(29, 2, 'Confirm Payment', 'dashboard/admin/confirm', 'fas fa-donate', 1),
(30, 1, 'Payment Bank', 'dashboard/management/paymentbank', 'fas fa-file-invoice-dollar', 1),
(31, 1, 'Transaction', 'dashboard/management/transaction', 'fas fa-clipboard-list', 1),
(34, 1, 'Report', 'dashboard/management/report', 'fas fa-file-alt', 1),
(35, 2, 'Ticket', 'dashboard/admin/ticket', 'fas fa-ticket-alt', 1),
(36, 5, 'Studio', 'dashboard/bioskop/studio', 'fas fa-dungeon', 1),
(37, 5, 'Film', 'dashboard/bioskop/film', 'fas fa-film', 1),
(38, 5, 'Schedule', 'dashboard/bioskop/schedule', 'fas fa-calendar-check', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_film`
--
ALTER TABLE `tbl_film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_seat`
--
ALTER TABLE `tbl_seat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_film`
--
ALTER TABLE `tbl_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_seat`
--
ALTER TABLE `tbl_seat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
