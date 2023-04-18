-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 02:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btwev`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Staff'),
(2, 'QA'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `closesuredate`
--

CREATE TABLE `closesuredate` (
  `Begin_date` datetime NOT NULL,
  `Closesure_date` datetime NOT NULL,
  `Final_Date` datetime NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `closesuredate`
--

INSERT INTO `closesuredate` (`Begin_date`, `Closesure_date`, `Final_Date`, `Year`) VALUES
('2023-01-03 01:00:00', '2023-11-30 13:00:00', '2023-12-31 01:00:00', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `mcomments`
--

CREATE TABLE `mcomments` (
  `mc_id` int(11) NOT NULL,
  `mc_text` text NOT NULL,
  `mc_u_uni_id` varchar(100) NOT NULL,
  `mc_p_uni_id` varchar(100) NOT NULL,
  `mc_date` date NOT NULL,
  `mc_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mcomments`
--

INSERT INTO `mcomments` (`mc_id`, `mc_text`, `mc_u_uni_id`, `mc_p_uni_id`, `mc_date`, `mc_uni_no`) VALUES
(18, 'kft', '11', '120', '2023-03-17', 7679712033424429),
(19, 'trd', '11', '120', '2023-03-17', 4411310913315392),
(66, 'gt', '45bdcc6f072dc02bbabb8ca6fb81be24', '120', '2023-03-22', 5742539445543410),
(67, 'test', '45bdcc6f072dc02bbabb8ca6fb81be24', '120', '2023-03-23', 2906173560539318),
(68, 'test2', '45bdcc6f072dc02bbabb8ca6fb81be24', '120', '2023-03-23', 5092305531423337),
(69, 'sprint', '1a10c1d31c7e23abc8eda5db2b48116d', '120', '2023-04-03', 3408230037496868);

-- --------------------------------------------------------

--
-- Table structure for table `mscomments`
--

CREATE TABLE `mscomments` (
  `msc_id` int(11) NOT NULL,
  `msc_u_uni_no` varchar(100) NOT NULL,
  `msc_mc_uni_no` bigint(20) NOT NULL,
  `msc_text` text NOT NULL,
  `msc_date` date NOT NULL,
  `msc_uni_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mscomments`
--

INSERT INTO `mscomments` (`msc_id`, `msc_u_uni_no`, `msc_mc_uni_no`, `msc_text`, `msc_date`, `msc_uni_no`) VALUES
(2, '45bdcc6f072dc02bbabb8ca6fb81be24', 7679712033424429, 'Hi', '2023-03-19', 2366898542192720),
(3, '45bdcc6f072dc02bbabb8ca6fb81be24', 7679712033424429, 'hello', '2023-03-21', 8424004183299079);

-- --------------------------------------------------------

--
-- Table structure for table `poster`
--

CREATE TABLE `poster` (
  `p_id` int(11) NOT NULL,
  `p_user` varchar(100) NOT NULL,
  `p_image` text NOT NULL,
  `p_name` varchar(200) NOT NULL,
  `p_text` text NOT NULL,
  `p_uni_no` bigint(20) NOT NULL,
  `p_cat` int(11) NOT NULL,
  `p_file` text NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL,
  `Added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poster`
--

INSERT INTO `poster` (`p_id`, `p_user`, `p_image`, `p_name`, `p_text`, `p_uni_no`, `p_cat`, `p_file`, `like_count`, `dislike_count`, `Added_date`, `view`) VALUES
(12363, '8b5f68b3e2ee26486188a022fd18d7a2', 'ai.jpg', ' Artificial intelligence', 'Artificial intelligence (AI), the ability of a digital computer', 157316319, 1, '', 7, 1, '2023-04-10 10:23:15', 1),
(12364, '8b5f68b3e2ee26486188a022fd18d7a2', 'react.jpg', 'React Native', 'React Native and Expo let you build apps in React for Android, iOS, and more. They look and feel native because their UIs are truly native.', 299945749, 2, '', 5, 0, '2023-04-10 10:25:37', 1),
(12365, '8b5f68b3e2ee26486188a022fd18d7a2', 'nóql.png', 'NoSQL', 'A NoSQL (originally referring to \"non-SQL\" or \"non-relational\")', 432560442, 1, '', 0, 0, '2023-04-10 10:27:45', 0),
(12366, '8b5f68b3e2ee26486188a022fd18d7a2', 'web.jpg', 'Web 3.0', 'Whether Web 3.0 comes to pass, especially in the form currently envisioned, remains an open question. What\'s clear is that interest in Web 3.0 has never been higher. Enterprises are ready to learn enough about Web 3.0 to decide what actions to take, if any.\n\n', 199658350, 2, '', 12, 2, '2023-04-10 10:30:13', 1),
(12367, '8b5f68b3e2ee26486188a022fd18d7a2', 'postman.jpg', 'Postman API Platform', 'Postman is an API platform for building and using APIs. Postman simplifies each step of the API lifecycle and streamlines collaboration so you can create better APIs—faster. ', 1073946240, 1, '', 5, 3, '2023-04-10 10:31:26', 0),
(12368, '8b5f68b3e2ee26486188a022fd18d7a2', 'symfony.jpg', 'Symfony', 'Symfony is a set of reusable PHP components and a PHP framework to build web applications, APIs, microservices and web services', 98964320, 2, '', 2, 1, '2023-04-10 10:32:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `u_pass` varchar(50) NOT NULL,
  `roles` int(11) NOT NULL DEFAULT 0 COMMENT '0: staff\r\n2: admin\r\n1\r\n1:QA',
  `verify_token` varchar(100) NOT NULL,
  `verified_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = not verified\r\n1 = verified',
  `u_img` varchar(200) NOT NULL,
  `anonymous_status` tinyint(2) DEFAULT NULL COMMENT '0 = no\r\n1 = yes',
  `anonymous_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `email`, `u_pass`, `roles`, `verify_token`, `verified_status`, `u_img`, `anonymous_status`, `anonymous_name`) VALUES
(1000, 'Hoang', 'hoangpnhtesting@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'c20ad4d76fe97759aa27a0c99bff6710', 1, '0', 0, 'anonymous'),
(1640, 'phuong', 'trantrucphuong2414@gmail.com', '4d7d719ac0cf3d78ea8a94701913fe47', 0, '1a10c1d31c7e23abc8eda5db2b48116d', 1, '0', 0, 'anonymous'),
(11563, 'Truong', 'truongst110902@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda', 2, '11', 1, 'user9.png', 0, 'anonymous'),
(180458836, 'student1', 'phuongttgcc200245@fpt.edu.vn', '5ed8e6625404b7886b73aa3aa816e2bc', 1, '8b5f68b3e2ee26486188a022fd18d7a2', 1, '0.png', NULL, ''),
(429241429, '      anonymo', 'huyhoanglm1412@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 2, '45bdcc6f072dc02bbabb8ca6fb81be24', 1, '', 1, '     Hoang'),
(814963937, 'tt', 't@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 0, '2f3f33d8b8a96fa7e395245f952c4676', 0, '0.png', NULL, ''),
(2101367919, '', 'tthoangpnhtesting@gmail.com', '6512bd43d9caa6e02c990b0a82652dca', 0, '1bea8c32322e62c5687be4a336d0a0f1', 0, '0.png', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `closesuredate`
--
ALTER TABLE `closesuredate`
  ADD PRIMARY KEY (`Year`);

--
-- Indexes for table `mcomments`
--
ALTER TABLE `mcomments`
  ADD PRIMARY KEY (`mc_id`),
  ADD UNIQUE KEY `mc_uni_no` (`mc_uni_no`),
  ADD KEY `mc_p_uni_id` (`mc_p_uni_id`),
  ADD KEY `mc_u_uni_id` (`mc_u_uni_id`);

--
-- Indexes for table `mscomments`
--
ALTER TABLE `mscomments`
  ADD PRIMARY KEY (`msc_id`),
  ADD UNIQUE KEY `msc_uni_no` (`msc_uni_no`),
  ADD KEY `msc_mc_uni_no` (`msc_mc_uni_no`),
  ADD KEY `msc_u_uni_no` (`msc_u_uni_no`);

--
-- Indexes for table `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_uni_no` (`p_uni_no`),
  ADD KEY `cat_post` (`p_cat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_uni_no` (`verify_token`),
  ADD KEY `role_user` (`roles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mcomments`
--
ALTER TABLE `mcomments`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `mscomments`
--
ALTER TABLE `mscomments`
  MODIFY `msc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poster`
--
ALTER TABLE `poster`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12369;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `poster`
--
ALTER TABLE `poster`
  ADD CONSTRAINT `cat_post` FOREIGN KEY (`p_cat`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
