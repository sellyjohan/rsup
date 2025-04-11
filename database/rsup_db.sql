-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 03:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsup_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` enum('pdf','image') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `file_path`, `file_type`, `created_at`, `updated_at`) VALUES
(1, 'a', 'aafff', 'uploads/CV_ATS_Selly_Johansyah_Isamuddin_2.pdf', 'pdf', '2025-04-11 08:39:13', '2025-04-11 09:54:38'),
(3, 'vvv', 'cccc', 'uploads/daya_tampung.PNG', 'image', '2025-04-11 13:06:48', '2025-04-11 13:06:48'),
(4, 'fff', 'ghhsg', 'uploads/tatacara_1.PNG', 'image', '2025-04-11 13:27:41', '2025-04-11 13:27:41'),
(5, 'ccc', 'ddd', 'uploads/persyaratan1.PNG', 'image', '2025-04-11 13:27:58', '2025-04-11 13:27:58'),
(6, 'ddd', 'fgafa', 'uploads/materi_ujian.PNG', 'image', '2025-04-11 13:28:20', '2025-04-11 13:28:20'),
(7, 'hjsj', 'hsfs', 'uploads/jadwal.PNG', 'image', '2025-04-11 13:28:47', '2025-04-11 13:28:47'),
(8, 'testp', 'test postm', 'uploads/daya_tampung1.PNG', 'image', '2025-04-11 15:34:55', '2025-04-11 15:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `created_at`) VALUES
(1, NULL, 'Melihat daftar user', '2025-04-10 07:33:07'),
(2, NULL, 'Melihat daftar user', '2025-04-10 07:34:48'),
(3, NULL, 'Melihat daftar user', '2025-04-10 07:35:13'),
(4, NULL, 'Melihat daftar user', '2025-04-10 07:35:26'),
(5, NULL, 'Melihat daftar user', '2025-04-10 07:37:51'),
(6, NULL, 'Melihat daftar user', '2025-04-10 07:38:31'),
(7, NULL, 'Melihat daftar user', '2025-04-10 07:38:39'),
(8, NULL, 'Melihat daftar user', '2025-04-10 07:41:24'),
(9, NULL, 'Menambahkan user baru dengan ID 4', '2025-04-10 09:20:00'),
(10, NULL, 'Menghapus user ID 4', '2025-04-10 09:24:46'),
(11, NULL, 'Menambahkan user baru dengan ID 5', '2025-04-10 09:27:20'),
(12, NULL, 'Menghapus user ID 5', '2025-04-10 09:27:25'),
(13, NULL, 'Menambahkan user baru dengan ID 6', '2025-04-10 09:28:04'),
(14, NULL, 'Mengupdate user ID 2', '2025-04-10 12:43:27'),
(15, NULL, 'Mengupdate user ID 6', '2025-04-10 14:52:05'),
(16, NULL, 'Mengupdate user ID 6', '2025-04-10 23:33:34'),
(17, NULL, 'Mengupdate user ID 3', '2025-04-11 07:18:31'),
(18, NULL, 'Menghapus user ID 15', '2025-04-11 07:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`) VALUES
(1, 'admin', '2025-04-10 03:45:20'),
(2, 'editor', '2025-04-10 03:45:20'),
(3, 'user', '2025-04-10 03:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role_id`, `created_at`, `email`) VALUES
(1, 'admin', '$2y$10$Ox8ntX0aE7iNON1yJqVYDevk0BdoGG7UnuzWjKrhS3qLkvU55sgOa', 'Admin Aja', 1, '2025-04-10 04:52:35', ''),
(2, 'editor', '$2y$10$R9T7BGEILkZSXf9mUFDoVupFEp46orEsqe3KJ7IFucswsqCX8Nliy', 'Editor Satu', 2, '2025-04-10 04:52:35', 'efg@gmail.com'),
(3, 'user', '$2y$10$Yx9iErcHNOlIkN.GG9V6G.ZJah7p6Clt55Ntv6g3M5KkSj0q2dKnG', 'User Biasazz', 3, '2025-04-10 04:52:35', 'zz@gmail.com'),
(6, 'a', '$2y$10$vey6LgLK2r6QUVNTvPAwCu0Wxr8.xm4SCu3brTHjmpvgIqpCKUB9.', 'aastaga b', 3, '2025-04-10 14:28:04', 'a@g.com'),
(7, 'dummyuser1', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 1', 1, '2025-04-10 17:45:30', 'dummy1@example.com'),
(8, 'dummyuser2', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 2', 2, '2025-04-10 17:45:30', 'dummy2@example.com'),
(9, 'dummyuser3', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 3', 3, '2025-04-10 17:45:30', 'dummy3@example.com'),
(10, 'dummyuser4', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 4', 2, '2025-04-10 17:45:30', 'dummy4@example.com'),
(11, 'dummyuser5', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 5', 3, '2025-04-10 17:45:30', 'dummy5@example.com'),
(12, 'dummyuser6', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 6', 1, '2025-04-10 17:45:30', 'dummy6@example.com'),
(13, 'dummyuser7', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 7', 2, '2025-04-10 17:45:30', 'dummy7@example.com'),
(14, 'dummyuser8', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 8', 3, '2025-04-10 17:45:30', 'dummy8@example.com'),
(16, 'dummyuser10', '$2y$10$ZsTISs71LViDi2zq6ZKn3uRxEWid1OkiYu.G/Jv4HbN9dK8r5v1u6', 'Dummy User 10', 2, '2025-04-10 17:45:30', 'dummy10@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `revoked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `refresh_token`, `expires_at`, `created_at`, `revoked`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTIyODksImV4cCI6MTc0NDMxNTg4OSwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.BO_uysM_VNKjrrvS3IKPrcZgYum6hJ0xTFiH6pQmgXg', '2025-04-10 22:11:29', '2025-04-10 19:11:29', 0),
(2, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTI4MDAsImV4cCI6MTc0NDMxNjQwMCwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.LWrqTFScETXmg2mVjl51bFttJoSJHxIMUmbVH6N8rn0', '2025-04-10 22:20:00', '2025-04-10 19:20:00', 0),
(3, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTI5OTcsImV4cCI6MTc0NDMxNjU5Nywic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.gevmivUF_WCNGkHT7Ku4IH53PX1695TCotBUjH7tsUI', '2025-04-10 22:23:17', '2025-04-10 19:23:17', 0),
(4, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTMzMzIsImV4cCI6MTc0NDMxNjkzMiwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.7jUJaT62QcKRS1Ye7XPfuBfqL6nlh6gUNsW9CUpP0DU', '2025-04-10 22:28:52', '2025-04-10 19:28:52', 0),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTM0OTEsImV4cCI6MTc0NDMxNzA5MSwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.LVCXTRHvKmUHsRFofNCN1jhdx73j5UD2qMOY4gnkOIg', '2025-04-10 22:31:31', '2025-04-10 19:31:31', 0),
(6, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTM2NzMsImV4cCI6MTc0NDMxNzI3Mywic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.RKCfjU7Nd8zBK7TNtpbYDSVBzoDMyld1_3Tcw6iSyvI', '2025-04-10 22:34:33', '2025-04-10 19:34:33', 0),
(7, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzMTQ3OTgsImV4cCI6MTc0NDMxODM5OCwic3ViIjoiMiIsInVzZXJuYW1lIjoiZWRpdG9yIn0.qaRYm8y4sRC1VdJIFSfkJRisMhOs4MqI8H3CEuPzQ7c', '2025-04-10 22:53:18', '2025-04-10 19:53:18', 0),
(8, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNDU5ODUsImV4cCI6MTc0NDM0OTU4NSwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.06Rz5JCpLeUMKgy0a7T4wPqeKaYGy3y3lwYLHL6UveY', '2025-04-11 07:33:05', '2025-04-11 04:33:05', 0),
(9, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNDY5NzIsImV4cCI6MTc0NDM1MDU3Miwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.3eYwqZgTHoA4XMSvC0PdTB6vsHBFMt_0yO4AxhIXIfY', '2025-04-11 07:49:32', '2025-04-11 04:49:32', 0),
(10, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNTExNjIsImV4cCI6MTc0NDM1NDc2Miwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.bgQLCjcp8gQelaycgG1Hp36C155A1br31qkmIU-9Qpg', '2025-04-11 08:59:22', '2025-04-11 05:59:22', 0),
(11, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNTQ4MTUsImV4cCI6MTc0NDM1ODQxNSwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.H3USBpTYT2GwUS880tZ4FT5rSLKMQhY_VlwIt62UsWg', '2025-04-11 10:00:15', '2025-04-11 07:00:15', 0),
(12, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNTcwMTIsImV4cCI6MTc0NDM2MDYxMiwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.qtrKvvybEggqAJCvNU6oNZkDm7H9Qcn-djs9Kyv-AIg', '2025-04-11 10:36:52', '2025-04-11 07:36:52', 0),
(13, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNjE3MTQsImV4cCI6MTc0NDM2NTMxNCwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.XjggfxUaNgKANcDurA-BN72tqAXZ6xd-28kkwXGinIs', '2025-04-11 11:55:14', '2025-04-11 08:55:14', 0),
(14, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNjg5NDEsImV4cCI6MTc0NDM3MjU0MSwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.GY5tuRXzY3FZfAciFSwvozWq2RC4w6zQg4fnR501-Ic', '2025-04-11 13:55:41', '2025-04-11 10:55:41', 0),
(15, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzExNzcsImV4cCI6MTc0NDM3NDc3Nywic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.p1VchjDHVNWcGCveSKmyc444jrW6gA6ZnXFrIO-pyUs', '2025-04-11 14:32:57', '2025-04-11 11:32:57', 0),
(16, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzI5MDAsImV4cCI6MTc0NDM3NjUwMCwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.C-0GRyXGfoDWMTXS2qWarIDLivnrdTvBSFU__M8usWs', '2025-04-11 15:01:40', '2025-04-11 12:01:40', 0),
(17, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzQ3ODYsImV4cCI6MTc0NDM3ODM4Niwic3ViIjoiMyIsInVzZXJuYW1lIjoidXNlciJ9.MtXp0B2BZb5Hi7sVNfpCshNBSxek1kfpDcR-28qpFXA', '2025-04-11 15:33:06', '2025-04-11 12:33:06', 0),
(18, 2, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzU5OTMsImV4cCI6MTc0NDM3OTU5Mywic3ViIjoiMiIsInVzZXJuYW1lIjoiZWRpdG9yIn0.ByiXyDAhegkqHmq9wTqAnVMr4LDbn5M6ESUYicPwjyA', '2025-04-11 15:53:13', '2025-04-11 12:53:13', 0),
(19, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzYzNzgsImV4cCI6MTc0NDM3OTk3OCwic3ViIjoiMyIsInVzZXJuYW1lIjoidXNlciJ9.PE9zjj2EgPaOtWDIPFVsGZSRBrU5pwAtGN7Hm-WqlXg', '2025-04-11 15:59:38', '2025-04-11 12:59:38', 0),
(20, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzY2NDYsImV4cCI6MTc0NDM4MDI0Niwic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4ifQ.69jIAbpaoWr1jn7YZnRqzTroH7s4O1Yn_X8_ybYEzeA', '2025-04-11 16:04:06', '2025-04-11 13:04:06', 0),
(21, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzc0NjcsImV4cCI6MTc0NDM4MTA2Nywic3ViIjoiMSIsInVzZXJuYW1lIjoiYWRtaW4iLCJyb2xlIjoiYWRtaW4ifQ.2ZMOTXC-lvohJtbNTTEoV77hHPNEjeNkLEKri8_JqY4', '2025-04-11 16:17:47', '2025-04-11 13:17:47', 0),
(22, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDQzNzc2NDQsImV4cCI6MTc0NDM4MTI0NCwic3ViIjoiMyIsInVzZXJuYW1lIjoidXNlciIsInJvbGUiOiJ1c2VyIn0.2IRpZmM4yc3olftBgjlyykQmiVA5T-Q-a1hCadtasws', '2025-04-11 16:20:44', '2025-04-11 13:20:44', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `refresh_token` (`refresh_token`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`);

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
