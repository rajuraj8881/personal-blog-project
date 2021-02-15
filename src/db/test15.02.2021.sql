-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 06:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `addpost`
--

CREATE TABLE `addpost` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addpost`
--

INSERT INTO `addpost` (`id`, `user_id`, `title`, `description`) VALUES
(122, 73, 'Test 101', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32. 100'),
(123, 73, 'Nulla euismod sit amet ante et sodales. Vestibulum facilisis, ex non lacinia orn', 'Duis eget pulvinar nibh. Cras facilisis ornare augue, imperdiet tempus diam maximus id. Vestibulum condimentum eget ligula eu pulvinar. Nam non placerat lectus. Aliquam porta, nulla vitae tempus scelerisque, dui nisl tempus nisi, in lacinia nisi ex et risus. Donec a libero mollis, tincidunt nisl molestie, accumsan enim. Nam eget tellus luctus, faucibus magna sed, elementum risus. In aliquet dictum ante eu sagittis. In nibh nibh, laoreet vel malesuada ultricies, bibendum at dolor.\r\n\r\nMaecenas fermentum et nunc et fermentum. Suspendisse vel efficitur sapien. Morbi nisi arcu, fringilla a odio vitae, tincidunt aliquam sem. Pellentesque efficitur feugiat augue, at facilisis nisi viverra a. Morbi libero sem, tincidunt vel molestie id, molestie nec urna. Sed pellentesque sem libero, a interdum nunc iaculis quis. Quisque eu malesuada dolor. Nulla at convallis dui, sed consequat felis. Aenean ultricies lorem a sapien mattis tempor. Suspendisse scelerisque feugiat dui, ac dapibus nunc tempus et. Nam lobortis nibh nec lacus scelerisque rhoncus.\r\n\r\nMaecenas consectetur mauris eu vulputate gravida. Cras nec maximus mi. Aenean sed posuere arcu. Mauris velit quam, tristique sed ligula imperdiet, ornare rutrum lorem. Pellentesque sodales dui id turpis hendrerit, non malesuada turpis sodales. Maecenas hendrerit, dolor vel tempor pharetra, massa arcu commodo leo, eget tincidunt augue felis feugiat ligula. Ut convallis varius hendrerit. Integer iaculis maximus magna.'),
(124, 73, 'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'),
(125, 75, 'Lorem ipsum', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. 11011\r\n'),
(126, 75, 'Test 11', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comnt`
--

CREATE TABLE `comnt` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `post_id` int(10) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comnt`
--

INSERT INTO `comnt` (`id`, `user_id`, `post_id`, `comment`) VALUES
(128, '73', 123, 'hi'),
(129, '73', 124, 'hu'),
(130, '73', 124, 'hu'),
(131, '73', 124, 'klml'),
(132, '75', 125, 'hi'),
(133, '75', 125, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `imgs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id`, `name`, `imgs`) VALUES
(15, '', 'IMG_20201028_062143.jpg'),
(16, '', 'IMG_20201028_062143.jpg'),
(17, '73', 'IMG_20201028_065619.jpg'),
(18, '73', 'IMG_20201028_091904.jpg'),
(19, '73', 'IMG_20201028_092433.jpg'),
(20, '73', 'IMG_20201028_100601.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likesdislikes`
--

CREATE TABLE `likesdislikes` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `post_id` varchar(11) NOT NULL,
  `islikes` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likesdislikes`
--

INSERT INTO `likesdislikes` (`id`, `user_id`, `post_id`, `islikes`) VALUES
(243, '73', '123', 0),
(246, '73', '125', 1),
(248, '75', '125', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `imgs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bio`, `password`, `email`, `phone`, `address`, `imgs`) VALUES
(73, 'Raju Mondal', 'Hello', 'e10adc3949ba59abbe56e057f20f883e', 'raju.mondal@winexsoft.com', '+8801670685287', 'Dhaka, 1207', 'IMG_20201028_165311.jpg'),
(75, 'Test', '', 'e10adc3949ba59abbe56e057f20f883e', 'test@winexsoft.com', '+8801786665287', 'Dhaka', 'IMG_20201028_062138.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addpost`
--
ALTER TABLE `addpost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comnt`
--
ALTER TABLE `comnt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likesdislikes`
--
ALTER TABLE `likesdislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addpost`
--
ALTER TABLE `addpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `comnt`
--
ALTER TABLE `comnt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likesdislikes`
--
ALTER TABLE `likesdislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
