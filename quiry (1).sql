-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 10:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiry`
--

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `id` int(11) NOT NULL,
  `breakfastname` varchar(40) NOT NULL,
  `breakfastprice` varchar(10) NOT NULL,
  `breakfastdesc` varchar(60) NOT NULL,
  `breakfastimg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breakfast`
--

INSERT INTO `breakfast` (`id`, `breakfastname`, `breakfastprice`, `breakfastdesc`, `breakfastimg`) VALUES
(1, 'Magnam Tiste', '$5.95', ' Lorem, deren, trataro, filede, nerada', 'menu-item-4.png');

-- --------------------------------------------------------

--
-- Table structure for table `chefmaster`
--

CREATE TABLE `chefmaster` (
  `id` int(11) NOT NULL,
  `cname` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `descr` text NOT NULL,
  `img` varchar(300) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1 COMMENT '1-present,0-resign'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chefmaster`
--

INSERT INTO `chefmaster` (`id`, `cname`, `title`, `descr`, `img`, `isactive`) VALUES
(53, '  dipesh kumar', 'Sous Chef', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi ipsum nostrum nihil porro ullam consectetur praesentium id ex sit soluta!                            ', 'chefs-3.jpg ', 1),
(54, '    umer naaz', 'Sous Chef', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi ipsum nostrum nihil porro ullam consectetur praesentium id ex sit soluta!                            ', 'chefs-1.jpg ', 1),
(55, '      kavya ', 'Senior Chef', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi ipsum nostrum nihil porro ullam consectetur praesentium id ex sit soluta!                            ', 'chefs-2.jpg ', 1),
(57, '  dipesh kumar', 'Executive Chef', 'gfgs                            ', 'default.jfif ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

CREATE TABLE `dinner` (
  `id` int(11) NOT NULL,
  `dinnername` varchar(40) NOT NULL,
  `dinnerprice` varchar(10) NOT NULL,
  `dinnerdesc` varchar(60) NOT NULL,
  `dinnerimg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinner`
--

INSERT INTO `dinner` (`id`, `dinnername`, `dinnerprice`, `dinnerdesc`, `dinnerimg`) VALUES
(1, 'dfsdafasd', '       sda', '       asdfsafsda', 'menu-item-4.png'),
(2, 'dfsdafasd', '   sdafsda', '   asdfsafsda', 'menu-item-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `home_about`
--

CREATE TABLE `home_about` (
  `id` int(11) NOT NULL,
  `aboutus` text NOT NULL,
  `aboutus_point` varchar(50) NOT NULL,
  `whywe` text NOT NULL,
  `block1` varchar(150) NOT NULL,
  `block2` varchar(150) NOT NULL,
  `block3` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_about`
--

INSERT INTO `home_about` (`id`, `aboutus`, `aboutus_point`, `whywe`, `block1`, `block2`, `block3`) VALUES
(45, 'umer naazLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.hi\r\n\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure dolor in reprehenderit in voluptate velit.\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.\r\nUllamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident', '', 'umernaazLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.', 'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt', 'Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere umer');

-- --------------------------------------------------------

--
-- Table structure for table `home_events`
--

CREATE TABLE `home_events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(30) NOT NULL,
  `event_price` text NOT NULL,
  `event_desc` varchar(100) NOT NULL,
  `event_image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_events`
--

INSERT INTO `home_events` (`id`, `event_name`, `event_price`, `event_desc`, `event_image`) VALUES
(19, 'custom event', '200$', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius minima veritatis architecto dolor aute', 'events-1.jpg'),
(20, 'custom event', '200$', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius minima veritatis architecto dolor aute', 'events-2.jpg'),
(21, 'custom event', '200$', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius minima veritatis architecto dolor aute', 'events-3.jpg'),
(22, 'custom event', '200$', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius minima veritatis architecto dolor aute', 'events-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home_menus`
--

CREATE TABLE `home_menus` (
  `id` int(11) NOT NULL,
  `foodname` varchar(40) NOT NULL,
  `foodprice` varchar(10) NOT NULL,
  `fooddesc` varchar(60) NOT NULL,
  `foodimg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_menus`
--

INSERT INTO `home_menus` (`id`, `foodname`, `foodprice`, `fooddesc`, `foodimg`) VALUES
(6, 'Magnam Tiste', ' $5.95', 'Lorem, deren, trataro, filede, nerada', 'menu-item-1.png'),
(8, 'Laboriosam Direva', '$9.95', 'Lorem, deren, trataro, filede, nerada', 'menu-item-2.png'),
(9, 'Est Eligendi', '$8.95', ' Lorem, deren, trataro, filede, nerada', 'menu-item-4.png'),
(10, 'Eos Luibusdam', ' $12.95', ' Lorem, deren, trataro, filede, nerada', 'menu-item-3.png'),
(13, 'Eos Luibusdam', ' $12.95', ' Lorem, deren, trataro, filede, nerada', 'menu-item-5.png'),
(14, 'Eos Luibusdam', '  $9.95', '  Lorem, deren, trataro, filede, nerada', 'menu-item-6.png'),
(15, 'Magnam ', ' 5.95', ' Lorem, deren, trataro, filede, nerada	', 'menu-item-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `id` int(11) NOT NULL,
  `lunchname` varchar(40) NOT NULL,
  `lunchprice` varchar(10) NOT NULL,
  `lunchdesc` varchar(60) NOT NULL,
  `lunchimg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`id`, `lunchname`, `lunchprice`, `lunchdesc`, `lunchimg`) VALUES
(1, 'DSDAFASF', '21', 'DGSAGSA', 'menu-item-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'admin@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chefmaster`
--
ALTER TABLE `chefmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_about`
--
ALTER TABLE `home_about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_events`
--
ALTER TABLE `home_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_menus`
--
ALTER TABLE `home_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chefmaster`
--
ALTER TABLE `chefmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `dinner`
--
ALTER TABLE `dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_about`
--
ALTER TABLE `home_about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `home_events`
--
ALTER TABLE `home_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `home_menus`
--
ALTER TABLE `home_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
