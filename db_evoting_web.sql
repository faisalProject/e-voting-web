-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2024 at 06:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id_admin` int NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id_candidate` int NOT NULL,
  `fk_id_student` int NOT NULL,
  `fk_id_data` int NOT NULL,
  `vision` text COLLATE utf8mb4_general_ci NOT NULL,
  `mission` text COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int NOT NULL,
  `class_name` enum('X IPA 1','X IPA 2','X IPA 3','X IPS 1','X IPS 2','X IPS 3','XI IPA 1','XI IPA 2','XI IPA 3','XI IPS 1','XI IPS 2','XI IPS 3','XII IPA 1','XII IPA 2','XII IPA 3','XII IPS 1','XII IPS 2','XII IPS 3') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `id_log` int NOT NULL,
  `module` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `useraccess` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int NOT NULL,
  `fk_id_data` int NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('siswa','kandidat','','') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'siswa',
  `last_login` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id_data` int NOT NULL,
  `nis` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fk_id_class` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int NOT NULL,
  `fk_id_student` int NOT NULL,
  `fk_id_candidate` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id_candidate` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id_data` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
