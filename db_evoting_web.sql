-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 05:53 AM
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
-- Database: `db_evoting_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(47, 'administrator1', 'admin@admin.com', '$2y$10$H.fx5kDNEchDeO7KOhix2ObHC94feQj5Cw5TvD0.tuooo/6GKBHJW', '2023-06-04 02:06:00', '2023-06-04 02:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id_candidate` int(255) NOT NULL,
  `fk_id_student` int(255) NOT NULL,
  `fk_id_data` int(255) NOT NULL,
  `vision` text NOT NULL,
  `mission` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id_candidate`, `fk_id_student`, `fk_id_data`, `vision`, `mission`, `picture`, `created_at`, `updated_at`) VALUES
(19, 16, 27, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec dictum diam. Suspendisse tempor lectus id bibendum commodo. Integer congue, turpis a euismod viverra, neque quam consectetur orci, id euismod leo tellus vel tortor. Nullam id dignissim quam, in ornare eros. Mauris sodales eu odio sit amet sodales. Nulla erat enim, dictum eget est sit amet, efficitur congue ante. Vivamus eget ante eget magna venenatis dictum. Sed vel mauris eget nulla rutrum dapibus vitae vel libero. Aliquam iaculis ornare elementum. Donec at iaculis ante, id semper turpis. Proin dapibus varius suscipit. Praesent nec lacus ac augue sollicitudin euismod. Praesent gravida finibus nibh, sodales sollicitudin velit porttitor eu. Sed auctor gravida mauris in maximus. Duis non elit eget ligula ultrices rhoncus accumsan vitae dui. Nulla semper vehicula ante, vel condimentum velit elementum nec.', 'Ut nec dignissim diam. Etiam vel tortor ut augue eleifend rutrum quis in erat. Sed faucibus dictum lectus et pharetra. Ut eget massa finibus, imperdiet sem vitae, dapibus mauris. Donec tristique lorem nec enim aliquam, vitae viverra turpis lobortis. Maecenas malesuada odio a dignissim ornare. Praesent imperdiet arcu vel mi feugiat maximus. Suspendisse et tortor vitae purus bibendum rhoncus at sed felis. Vivamus nisl ante, luctus in aliquam id, volutpat eget purus. Suspendisse faucibus libero ut leo eleifend bibendum.\r\n\r\nNulla vitae feugiat ante. Praesent sollicitudin sapien in pretium ultrices. Aenean ligula mauris, pellentesque non accumsan id, venenatis nec odio. Vivamus elementum efficitur posuere. Proin imperdiet ligula vitae leo lacinia ultricies. Nunc vel massa ligula. Sed id ornare tellus, at accumsan augue. Vivamus ut mi gravida, pretium tellus ut, luctus metus.', '6489df8ae06e6.jpg', '2023-06-14 10:40:58', '2023-06-14 10:40:58'),
(20, 15, 25, 'Ut nec dignissim diam. Etiam vel tortor ut augue eleifend rutrum quis in erat. Sed faucibus dictum lectus et pharetra. Ut eget massa finibus, imperdiet sem vitae, dapibus mauris. Donec tristique lorem nec enim aliquam, vitae viverra turpis lobortis. Maecenas malesuada odio a dignissim ornare. Praesent imperdiet arcu vel mi feugiat maximus. Suspendisse et tortor vitae purus bibendum rhoncus at sed felis. Vivamus nisl ante, luctus in aliquam id, volutpat eget purus. Suspendisse faucibus libero ut leo eleifend bibendum.', 'Nulla vitae feugiat ante. Praesent sollicitudin sapien in pretium ultrices. Aenean ligula mauris, pellentesque non accumsan id, venenatis nec odio. Vivamus elementum efficitur posuere. Proin imperdiet ligula vitae leo lacinia ultricies. Nunc vel massa ligula. Sed id ornare tellus, at accumsan augue. Vivamus ut mi gravida, pretium tellus ut, luctus metus.\r\n\r\nPraesent quis est velit. Aenean ut augue elit. Ut eu vulputate neque. Etiam bibendum pellentesque enim at lacinia. Quisque vitae ornare sem, eu tristique odio. Maecenas eget augue ullamcorper, elementum est ac, consequat lacus. Morbi molestie efficitur nunc, porta facilisis felis ornare vitae. Ut iaculis eget justo at euismod. Suspendisse et odio et mauris volutpat condimentum dictum eu libero. Sed scelerisque tempor tristique. Praesent vitae risus ut ipsum dictum semper in ac libero. Morbi lectus lacus, scelerisque in semper eget, molestie eu lorem. Morbi euismod maximus dui, et elementum ex feugiat nec. Curabitur convallis odio elit, scelerisque efficitur tellus euismod vel. Duis eget finibus purus.\r\n\r\nQuisque sit amet lacus placerat, semper libero ac, sagittis nunc. Nunc vel dui tincidunt, luctus est non, tincidunt leo. Nam convallis risus eget orci dapibus tincidunt. Cras urna orci, vehicula vel mauris eu, aliquet malesuada velit. Pellentesque finibus ornare eros, aliquet tristique orci fringilla a. Curabitur vitae sapien nisi. Ut vestibulum tellus id ex vulputate malesuada sed id libero. Curabitur bibendum libero vitae facilisis congue.', '6489dfb64dcdd.jpg', '2023-06-14 10:41:42', '2023-06-14 10:41:42'),
(21, 14, 32, 'Ut nec dignissim diam. Etiam vel tortor ut augue eleifend rutrum quis in erat. Sed faucibus dictum lectus et pharetra. Ut eget massa finibus, imperdiet sem vitae, dapibus mauris. Donec tristique lorem nec enim aliquam, vitae viverra turpis lobortis. Maecenas malesuada odio a dignissim ornare. Praesent imperdiet arcu vel mi feugiat maximus. Suspendisse et tortor vitae purus bibendum rhoncus at sed felis. Vivamus nisl ante, luctus in aliquam id, volutpat eget purus. Suspendisse faucibus libero ut leo eleifend bibendum.', 'Praesent quis est velit. Aenean ut augue elit. Ut eu vulputate neque. Etiam bibendum pellentesque enim at lacinia. Quisque vitae ornare sem, eu tristique odio. Maecenas eget augue ullamcorper, elementum est ac, consequat lacus. Morbi molestie efficitur nunc, porta facilisis felis ornare vitae. Ut iaculis eget justo at euismod. Suspendisse et odio et mauris volutpat condimentum dictum eu libero. Sed scelerisque tempor tristique. Praesent vitae risus ut ipsum dictum semper in ac libero. Morbi lectus lacus, scelerisque in semper eget, molestie eu lorem. Morbi euismod maximus dui, et elementum ex feugiat nec. Curabitur convallis odio elit, scelerisque efficitur tellus euismod vel. Duis eget finibus purus.\r\n\r\nQuisque sit amet lacus placerat, semper libero ac, sagittis nunc. Nunc vel dui tincidunt, luctus est non, tincidunt leo. Nam convallis risus eget orci dapibus tincidunt. Cras urna orci, vehicula vel mauris eu, aliquet malesuada velit. Pellentesque finibus ornare eros, aliquet tristique orci fringilla a. Curabitur vitae sapien nisi. Ut vestibulum tellus id ex vulputate malesuada sed id libero. Curabitur bibendum libero vitae facilisis congue.', '6489dfed10785.jpg', '2023-06-14 10:42:37', '2023-06-14 10:42:37'),
(22, 18, 26, '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec dictum diam. Suspendisse tempor lectus id bibendum commodo. Integer congue, turpis a euismod viverra, neque quam consectetur orci, id euismod leo tellus vel tortor. Nullam id dignissim quam, in ornare eros. Mauris sodales eu odio sit amet sodales. Nulla erat enim, dictum eget est sit amet, efficitur congue ante. Vivamus eget ante eget magna venenatis dictum. Sed vel mauris eget nulla rutrum dapibus vitae vel libero. Aliquam iaculis ornare elementum. Donec at iaculis ante, id semper turpis. Proin dapibus varius suscipit. Praesent nec lacus ac augue sollicitudin euismod. Praesent gravida finibus nibh, sodales sollicitudin velit porttitor eu. Sed auctor gravida mauris in maximus. Duis non elit eget ligula ultrices rhoncus accumsan vitae dui. Nulla semper vehicula ante, vel condimentum velit elementum nec.', 'Nulla vitae feugiat ante. Praesent sollicitudin sapien in pretium ultrices. Aenean ligula mauris, pellentesque non accumsan id, venenatis nec odio. Vivamus elementum efficitur posuere. Proin imperdiet ligula vitae leo lacinia ultricies. Nunc vel massa ligula. Sed id ornare tellus, at accumsan augue. Vivamus ut mi gravida, pretium tellus ut, luctus metus.\r\n\r\nPraesent quis est velit. Aenean ut augue elit. Ut eu vulputate neque. Etiam bibendum pellentesque enim at lacinia. Quisque vitae ornare sem, eu tristique odio. Maecenas eget augue ullamcorper, elementum est ac, consequat lacus. Morbi molestie efficitur nunc, porta facilisis felis ornare vitae. Ut iaculis eget justo at euismod. Suspendisse et odio et mauris volutpat condimentum dictum eu libero. Sed scelerisque tempor tristique. Praesent vitae risus ut ipsum dictum semper in ac libero. Morbi lectus lacus, scelerisque in semper eget, molestie eu lorem. Morbi euismod maximus dui, et elementum ex feugiat nec. Curabitur convallis odio elit, scelerisque efficitur tellus euismod vel. Duis eget finibus purus.', '6489e00e16fa1.jpg', '2023-06-14 10:43:10', '2023-06-14 10:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(255) NOT NULL,
  `class_name` enum('X IPA 1','X IPA 2','X IPA 3','X IPS 1','X IPS 2','X IPS 3','XI IPA 1','XI IPA 2','XI IPA 3','XI IPS 1','XI IPS 2','XI IPS 3','XII IPA 1','XII IPA 2','XII IPA 3','XII IPS 1','XII IPS 2','XII IPS 3') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `class_name`, `created_at`, `updated_at`) VALUES
(1, 'X IPA 1', '2023-06-04 09:19:50', '2023-06-04 09:19:50'),
(2, 'X IPA 2', '2023-06-04 09:20:24', '2023-06-04 09:20:24'),
(3, 'X IPA 3', '2023-06-04 09:20:24', '2023-06-04 09:20:24'),
(4, 'X IPS 1', '2023-06-04 09:21:14', '2023-06-04 09:21:14'),
(5, 'X IPS 2', '2023-06-04 09:21:14', '2023-06-04 09:21:14'),
(6, 'X IPS 3', '2023-06-04 09:23:06', '2023-06-04 09:26:29'),
(7, 'XI IPA 1', '2023-06-04 09:23:06', '2023-06-04 09:27:04'),
(8, 'XI IPA 2', '2023-06-04 09:23:06', '2023-06-04 09:28:04'),
(9, 'XI IPA 3', '2023-06-04 09:23:06', '2023-06-04 09:28:27'),
(10, 'XI IPS 1', '2023-06-04 09:23:06', '2023-06-04 09:29:05'),
(11, 'XI IPS 2', '2023-06-04 09:23:06', '2023-06-04 09:29:22'),
(12, 'XI IPS 3', '2023-06-04 09:23:06', '2023-06-04 09:29:34'),
(13, 'XII IPA 1', '2023-06-04 09:23:06', '2023-06-04 09:29:53'),
(14, 'XII IPA 2', '2023-06-04 09:23:06', '2023-06-04 09:30:06'),
(15, 'XII IPA 3', '2023-06-04 09:23:06', '2023-06-04 09:30:23'),
(16, 'XII IPS 1', '2023-06-04 09:23:06', '2023-06-04 09:30:35'),
(17, 'XII IPS 2', '2023-06-04 09:23:06', '2023-06-04 09:30:44'),
(18, 'XII IPS 3', '2023-06-04 09:30:56', '2023-06-04 09:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(255) NOT NULL,
  `module` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `useraccess` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `module`, `action`, `useraccess`, `created_at`, `updated_at`) VALUES
(1, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 02:49:38', '2023-06-03 02:49:38'),
(2, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 03:14:58', '2023-06-03 03:14:58'),
(3, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 03:53:12', '2023-06-03 03:53:12'),
(4, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 22:08:28', '2023-06-03 22:08:28'),
(5, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 23:15:51', '2023-06-03 23:15:51'),
(6, 'Register', 'Account Register', 'admin@admin.com', '2023-06-03 23:21:38', '2023-06-03 23:21:38'),
(7, 'Register', 'Account Register', 'admin@admin.com', '2023-06-04 02:01:43', '2023-06-04 02:01:43'),
(8, 'Register', 'Account Register', 'admin@admin.com', '2023-06-04 02:06:00', '2023-06-04 02:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(255) NOT NULL,
  `fk_id_data` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('siswa','kandidat','','') NOT NULL DEFAULT 'siswa',
  `last_login` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `fk_id_data`, `password`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(14, 32, '$2y$10$9DD0M6UZEf/B9OWAeKqRoOeyQMK5Jna6ce5zgVt1JDP7G2od8Y81S', 'kandidat', '2023-06-10 15:59:08', '2023-06-10 08:59:08', '2023-06-10 08:59:08'),
(15, 25, '$2y$10$l/zF7Tg5QwIzcYiMhAfUruzwqE7pAerwoxHCOPkeGdDzBRlrUCCO.', 'kandidat', '2023-06-10 15:59:25', '2023-06-10 08:59:25', '2023-06-10 08:59:25'),
(16, 27, '$2y$10$IrCoUGsGY6m5TZ1fBOJ78.CCPoOL8qBXsFFEIImpdY0Mxcp6mX/3m', 'kandidat', '2023-06-10 15:59:43', '2023-06-10 08:59:43', '2023-06-10 08:59:43'),
(18, 26, '$2y$10$ERawiJLD6FflpPx1mMCyK.WjfWWENVQIOkxBFng9pKyfpSY1/67O2', 'kandidat', '2023-06-10 16:00:24', '2023-06-10 09:00:24', '2023-06-10 09:00:24'),
(21, 37, '$2y$10$ViFFnCDVKg8zv0J/Q/CjreYjkofl4fN5GX2EJww9zmvl6F85lSsTu', 'siswa', '2023-06-11 18:51:03', '2023-06-11 11:51:03', '2023-06-11 11:51:03'),
(22, 30, '$2y$10$DzSkkTmvH5iZFh/3YiputeuwFMt9PoWX2YpdC9TZkQAS3Xms5iyTa', 'siswa', '2023-06-15 17:10:33', '2023-06-15 10:10:33', '2023-06-15 10:10:33'),
(23, 38, '$2y$10$uGVEWKYePLP3SmzB3wpEZuDECKn.wRBnnwJ5j28TjEqnqdkA.DwSO', 'siswa', '2023-06-15 17:12:11', '2023-06-15 10:12:11', '2023-06-15 10:12:11'),
(24, 39, '$2y$10$XeGzA2vcQ2KGCalSgRmFB.9UBb5hXY.ymle9xuOz8gYGW939nXhgW', 'siswa', '2023-06-16 05:47:32', '2023-06-15 22:47:32', '2023-06-15 22:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id_data` int(255) NOT NULL,
  `nis` varchar(14) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fk_id_class` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id_data`, `nis`, `name`, `email`, `fk_id_class`, `created_at`, `updated_at`) VALUES
(25, '21416255201178', 'Muhamad Agus Faisal', 'anime@anime.com', 13, '2023-06-05 09:22:31', '2023-06-05 09:22:31'),
(26, '21416255201179', 'Rai Tilosava de Araujo', 'anime@anime.com', 15, '2023-06-05 09:22:50', '2023-06-05 09:22:50'),
(27, '21416255201180', 'M. Naufal Faqih', 'anime@anime.com', 15, '2023-06-05 09:23:09', '2023-06-05 09:23:09'),
(30, '21416255201185', 'Ragil Assidiq', 'anime@anime.com', 15, '2023-06-06 04:41:35', '2023-06-06 04:41:35'),
(32, '21416255201186', 'Arman Hardiansyah', 'anime@anime.com', 16, '2023-06-06 10:47:12', '2023-06-06 10:47:12'),
(37, '21416255201120', 'Aditya Ramadhan Sulistyo', 'anime@anime.com', 7, '2023-06-11 11:49:26', '2023-06-11 11:49:26'),
(38, '21416255201203', 'Haikal Fasiha Fayyadh', 'anime@anime.com', 6, '2023-06-15 10:11:52', '2023-06-15 10:11:52'),
(39, '21416255201123', 'Gibran Arifni', 'gibran@gmail.com', 3, '2023-06-15 22:46:57', '2023-06-15 22:46:57');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(255) NOT NULL,
  `fk_id_student` int(255) NOT NULL,
  `fk_id_candidate` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `fk_id_student`, `fk_id_candidate`, `created_at`, `updated_at`) VALUES
(6, 21, 19, '2023-06-15 09:47:06', '2023-06-15 09:47:06'),
(7, 22, 20, '2023-06-15 10:10:46', '2023-06-15 10:10:46'),
(8, 23, 20, '2023-06-15 10:16:01', '2023-06-15 10:16:01'),
(9, 15, 20, '2023-06-15 22:13:25', '2023-06-15 22:13:25'),
(10, 24, 22, '2023-06-15 22:49:02', '2023-06-15 22:49:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id_candidate`),
  ADD KEY `id_student` (`fk_id_student`),
  ADD KEY `fk_id_data` (`fk_id_data`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_data` (`fk_id_data`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `id_class` (`fk_id_class`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`),
  ADD KEY `id_student` (`fk_id_student`),
  ADD KEY `id_candidate` (`fk_id_candidate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id_candidate` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id_data` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`fk_id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `candidate_ibfk_2` FOREIGN KEY (`fk_id_data`) REFERENCES `student_data` (`id_data`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`fk_id_data`) REFERENCES `student_data` (`id_data`);

--
-- Constraints for table `student_data`
--
ALTER TABLE `student_data`
  ADD CONSTRAINT `student_data_ibfk_1` FOREIGN KEY (`fk_id_class`) REFERENCES `class` (`id_class`);

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`fk_id_student`) REFERENCES `student` (`id_student`),
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`fk_id_candidate`) REFERENCES `candidate` (`id_candidate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
