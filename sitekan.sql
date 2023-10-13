-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 09:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitekan`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(7, 'admin-web', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `alamat`, `email`, `image_path`, `password`, `is_active`) VALUES
(1, 'Ainul Rokhman', '', 'admin@admin.com', NULL, '$2y$10$dm57Fom1SZqH6tdVHC/uMudCaoUwgTN67jwhm54PWgBVWO.gvS8e2', 1),
(10, 'Admin Web', '', 'admin@web.com', NULL, '$2y$10$pyTB982nMbqvvix1I6Mi.OTAJcS979V9Y5t9WzOWugzoiRg/401ZS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`role_id`, `menu_id`) VALUES
(1, 4),
(1, 6),
(1, 8),
(1, 12),
(1, 13),
(1, 14),
(9, 14),
(7, 8),
(7, 12),
(7, 13),
(7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int NOT NULL,
  `menu` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `index` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`, `url`, `index`) VALUES
(4, 'Menu', 'fas fa-fw fa-folder-open', 'menu', 2),
(6, 'Jabatan', 'fas fa-user-tag', 'role', 1),
(8, 'User', 'fas fa-users', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_user` int NOT NULL,
  `id_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_user`, `id_role`) VALUES
(12, 8),
(10, 7),
(11, 9),
(13, 9),
(1, 1),
(21, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int NOT NULL,
  `menu_id` int NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `is_active`) VALUES
(10, 4, 'Manajemen Menu', 'index', 1),
(11, 4, 'Manajemen Submenu', 'submenu', 1),
(18, 8, 'Manajemen User', 'index', 1),
(23, 6, 'Manajemen Jabatan', 'index', 1),
(33, 12, 'Manajemen Informasi', 'index', 1),
(34, 13, 'Pertanyaan', 'builying', 1),
(35, 13, 'Fairness', 'fairness', 0),
(36, 13, 'Atur Hasil', 'setting', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_submenu`
-- (See below for the actual view)
--
CREATE TABLE `v_submenu` (
`id` int
,`menu_id` int
,`title` varchar(128)
,`url_menu` varchar(100)
,`url_sub_menu` varchar(128)
,`is_active` int
,`menu` varchar(128)
,`icon` varchar(128)
,`roles` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user_role`
-- (See below for the actual view)
--
CREATE TABLE `v_user_role` (
`id` int
,`full_name` varchar(100)
,`email` varchar(100)
,`alamat` text
,`image_path` varchar(255)
,`password` varchar(255)
,`is_active` int
,`role_id` int
,`role_name` varchar(20)
,`role_description` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_submenu`
--
DROP TABLE IF EXISTS `v_submenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_submenu`  AS SELECT `user_sub_menu`.`id` AS `id`, `user_menu`.`id` AS `menu_id`, `user_sub_menu`.`title` AS `title`, `user_menu`.`url` AS `url_menu`, `user_sub_menu`.`url` AS `url_sub_menu`, `user_sub_menu`.`is_active` AS `is_active`, `user_menu`.`menu` AS `menu`, `user_menu`.`icon` AS `icon`, group_concat(`role`.`name` separator ',') AS `roles` FROM (((`user_menu` left join `user_sub_menu` on((`user_sub_menu`.`menu_id` = `user_menu`.`id`))) left join `user_access_menu` on((`user_access_menu`.`menu_id` = `user_menu`.`id`))) left join `role` on((`role`.`id` = `user_access_menu`.`role_id`))) GROUP BY `user_sub_menu`.`id` ORDER BY `user_menu`.`index` ASC, `user_sub_menu`.`id` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `v_user_role`
--
DROP TABLE IF EXISTS `v_user_role`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user_role`  AS SELECT `user`.`id` AS `id`, `user`.`full_name` AS `full_name`, `user`.`email` AS `email`, `user`.`alamat` AS `alamat`, `user`.`image_path` AS `image_path`, `user`.`password` AS `password`, `user`.`is_active` AS `is_active`, `role`.`id` AS `role_id`, `role`.`name` AS `role_name`, `role`.`description` AS `role_description` FROM ((`user` left join `user_role` on((`user_role`.`id_user` = `user`.`id`))) left join `role` on((`role`.`id` = `user_role`.`id_role`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
