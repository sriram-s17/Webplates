-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 09:41 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webplates`
--

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `previewimg` varchar(200) DEFAULT 'assets/images/default-temp-img.png',
  `zipfile` varchar(200) DEFAULT NULL,
  `filelocation` varchar(200) DEFAULT NULL,
  `homepage` varchar(200) DEFAULT NULL,
  `upd_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `user_id`, `name`, `previewimg`, `zipfile`, `filelocation`, `homepage`, `upd_time`) VALUES
(1, 1, 'Marvel', 'templates/preview/marvel//Marvel-preview.png', 'templates/zipfiles/marvel.zip', 'templates/preview/marvel/', 'templates/preview/marvel/marvel/index.html', '2021-10-16 09:50:04'),
(2, 1, 'Felicity', 'templates/preview/felicity//Felicity-preview.png', 'templates/zipfiles/felicity.zip', 'templates/preview/felicity/', 'templates/preview/felicity/felicity/index.html', '2021-10-15 19:22:36'),
(3, 1, 'One Health', 'templates/preview/One Health//One Health-preview.png', 'templates/zipfiles/One Health.zip', 'templates/preview/One Health/', 'templates/preview/One Health/one-health/html/index.html', '2021-10-15 17:41:33'),
(4, 1, 'ADsiter', 'templates/preview/ADsiter//ADsiter-preview.png', 'templates/zipfiles/ADsiter.zip', 'templates/preview/ADsiter/', 'templates/preview/ADsiter/adsiter/index.html', '2021-10-15 18:03:12'),
(5, 1, 'Blessed', 'templates/preview/Blessed//Blessed-preview.png', 'templates/zipfiles/Blessed.zip', 'templates/preview/Blessed/', 'templates/preview/Blessed/blessed/index.html', '2021-10-15 18:04:24'),
(6, 1, 'Data Web', 'templates/preview/Data Web//Data Web-preview.png', 'templates/zipfiles/Data Web.zip', 'templates/preview/Data Web/', 'templates/preview/Data Web/data-web/index.html', '2021-10-15 18:06:21'),
(7, 1, 'Meticulous', 'templates/preview/Meticulous//Meticulous-preview.png', 'templates/zipfiles/Meticulous.zip', 'templates/preview/Meticulous/', 'templates/preview/Meticulous/meticulous/index.html', '2021-10-15 18:07:10'),
(8, 1, 'ULOAX', 'templates/preview/ULOAX//ULOAX-preview.png', 'templates/zipfiles/ULOAX.zip', 'templates/preview/ULOAX/', 'templates/preview/ULOAX/uloax/index.html', '2021-10-15 18:11:27'),
(9, 1, 'YOOGA', 'templates/preview/YOOGA//YOOGA-preview.jpg', 'templates/zipfiles/YOOGA.zip', 'templates/preview/YOOGA/', 'templates/preview/YOOGA/free-yoga-website-template/index.html', '2021-10-16 10:07:10'),
(10, 1, 'pintereso', 'templates/preview/Pintereso//pintereso-preview.png', 'templates/zipfiles/Pintereso.zip', 'templates/preview/Pintereso/', 'templates/preview/Pintereso/template-pintereso-bootstrap-html-master/docs/index.html', '2021-10-16 10:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `photo` varchar(100) DEFAULT 'assets/images/user.jpg',
  `gender` enum('Male','Female','Transgender') DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `verified` enum('yes','no') DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `photo`, `gender`, `dob`, `pwd`, `verified`) VALUES
(1, 'abc@gmail.com', 'abc', 'assets/images/users/userprofile-1.jpg', 'Male', '01-01-2001', 'e0002f872fab20668458e08586d0ad40', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
