-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2019 at 09:52 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14-1+0~20190113100742.14+stretch~1.gbpd83c69

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multimedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `datas`
--

CREATE TABLE `datas` (
  `id_datas` int(11) NOT NULL,
  `chemin_relatif` varchar(200) NOT NULL,
  `name_origin` varchar(200) NOT NULL,
  `mime_type` varchar(20) NOT NULL,
  `description` longtext NOT NULL,
  `auteur_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datas`
--

INSERT INTO `datas` (`id_datas`, `chemin_relatif`, `name_origin`, `mime_type`, `description`, `auteur_id`, `date`) VALUES
(21, './multimedia/images/8129153136394ef57681e65f2d68b92bee8d63cfef31c9861e80d46935ae37c4.jpg', 'slider4.jpg', 'jpg', 'Lac', 35, '2019-02-17 20:24:16'),
(22, './multimedia/images/81dbb604cdc46b35718af6b804aecdf8ff456ffe4028b45498850a625ba4ef58.jpg', 'p11.jpg', 'jpg', 'paysage', 35, '2019-02-17 20:25:39'),
(23, './multimedia/images/3fb5327438913d008d31898b377aff34bdca1e48224f53ecd517d34055753491.jpg', 'p10.jpg', 'jpg', 'paysage', 35, '2019-02-17 20:25:58'),
(24, './multimedia/images/1c8c91ae11223e43213959024d40a336012625b1c7a1bd4ec50972850afbfd0b.jpg', 'p1.jpg', 'jpg', 'paysage', 35, '2019-02-17 20:26:11'),
(25, './multimedia/videos/0f55a4a183468951636a4118ef2626ac2231cef22b322c2e1450bfc700cfdd7c.mp4', 'Palms - 19610.mp4', 'mp4', 'Palmiers', 35, '2019-02-17 20:41:12'),
(26, './multimedia/images/6ea9f29261f2dcdcc8bdd81ed434ea40e37737bc36cda696cca7e289db958f09.jpg', 'apples-634572_1920.jpg', 'jpg', 'Pommes', 35, '2019-02-17 20:41:52'),
(27, './multimedia/images/1b43eed91c41657f9cee6ce0d3452b42b7a2a5f9133bee414bc08fd77ff70fd0.jpg', 'boat-3410807_1920.jpg', 'jpg', 'Mer', 35, '2019-02-17 20:42:15'),
(28, './multimedia/images/5a809875676c03a45698284b53b5a954e9dbf994d5c6f9d89e16b8daa330d84d.jpg', 'elephants-1900332_1920.jpg', 'jpg', 'elephants', 35, '2019-02-17 20:43:05'),
(29, './multimedia/videos/e17bd2a9ce050940fc13f607d8dafba409c9a651a06cc497945bb25cab3252ff.mp4', 'Inn - 21069.mp4', 'mp4', 'Inn mer', 35, '2019-02-17 20:43:45'),
(31, './multimedia/images/01cee11e4e61130febda5bf888c928e40eb46feeaad8d0000d02d3c7c38b4d36.jpg', 'africa-17335_1280.jpg', 'jpg', 'Lion', 35, '2019-02-17 20:44:30');

-- --------------------------------------------------------

--
-- Table structure for table `login_tentative`
--

CREATE TABLE `login_tentative` (
  `id_tentative` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `id_users_tentative` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_tentative`
--

INSERT INTO `login_tentative` (`id_tentative`, `time`, `id_users_tentative`) VALUES
(1, 1550163617, 34);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `passwd`) VALUES
(34, 'TestToto', '$2y$10$F0v4hbdQ33CRCz28rh7Shu8w5zeY6KqaYNyfaO8EG91S3qbWAyuv2'),
(35, 'Stag12345', '$2y$10$ShmNuqXswaP2pVaQzi6yoO0k7tvmM0o0ZUWxsg9Pmf7kNieCZ66Mu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`id_datas`),
  ADD KEY `id_datas` (`id_datas`),
  ADD KEY `auteur_id` (`auteur_id`);

--
-- Indexes for table `login_tentative`
--
ALTER TABLE `login_tentative`
  ADD PRIMARY KEY (`id_tentative`),
  ADD KEY `id_users_tentative` (`id_users_tentative`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datas`
--
ALTER TABLE `datas`
  MODIFY `id_datas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `login_tentative`
--
ALTER TABLE `login_tentative`
  MODIFY `id_tentative` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
