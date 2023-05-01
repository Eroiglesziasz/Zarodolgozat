-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 04:16 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiztime`
--
CREATE DATABASE IF NOT EXISTS `quiztime` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `quiztime`;

-- --------------------------------------------------------

--
-- Table structure for table `eredmeny`
--

DROP TABLE IF EXISTS `eredmeny`;
CREATE TABLE `eredmeny` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `pontszam` int(11) NOT NULL,
  `mikor` date NOT NULL DEFAULT current_timestamp(),
  `ido` time NOT NULL,
  `nehezseg_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `eredmeny`
--

TRUNCATE TABLE `eredmeny`;
--
-- Dumping data for table `eredmeny`
--

INSERT INTO `eredmeny` (`id`, `felhasznalo_id`, `tema_id`, `pontszam`, `mikor`, `ido`, `nehezseg_id`) VALUES
(13, 37, 1, 3, '2023-04-23', '00:00:04', 1),
(15, 37, 1, 4, '2023-04-23', '00:00:13', 3),
(16, 37, 2, 2, '2023-04-23', '00:00:58', 1),
(20, 40, 3, 3, '2023-04-25', '00:00:07', 2),
(23, 40, 1, 6, '2023-04-25', '00:00:10', 2),
(24, 40, 3, 5, '2023-04-25', '00:00:15', 3),
(28, 39, 3, 0, '2023-04-29', '00:00:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
CREATE TABLE `felhasznalo` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo` varchar(256) NOT NULL,
  `jelszo` varchar(256) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `felhasznalo`
--

TRUNCATE TABLE `felhasznalo`;
--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `felhasznalo`, `jelszo`, `email`, `admin`) VALUES
(37, 'admin', '$2y$10$EOepv3jbM.yTR0RLKFdTD.5PRhMn6uLzKR.537fEClQba.nlyaqMa', 'admin@admin.hu', 1),
(39, 'tanulo2', '$2y$10$HnXwYgiKBpl25UHZh31h6eAvtvE5/QvX8kSUOwNemGv/3/oKgrqBe', 'tanulo2@tanulo2.hu', 0),
(40, 'tanulo1', '$2y$10$68oDpTv5YsrIqMw2t/pAse6mdsXa61uoujuaZW4sCDrbrqr5ANtAK', 'tanulo1@tanulo1.hu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kerdesek`
--

DROP TABLE IF EXISTS `kerdesek`;
CREATE TABLE `kerdesek` (
  `id` int(10) UNSIGNED NOT NULL,
  `tema_id` int(10) UNSIGNED NOT NULL,
  `szoveg` varchar(256) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=364 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `kerdesek`
--

TRUNCATE TABLE `kerdesek`;
--
-- Dumping data for table `kerdesek`
--

INSERT INTO `kerdesek` (`id`, `tema_id`, `szoveg`) VALUES
(1, 1, 'Ki/mi az a censor?'),
(2, 1, 'Az egyház ügyeinek megtárgyalására összehívott gyûlés, amely minden hívôre kötelezô határozatokat is hozhat'),
(3, 1, 'Korlátlan egyeduralom, amikor az uralkodó hatalmát sem törvények, sem egyéb szabályok nem korlátozzák'),
(4, 1, 'Mi az a triumvirátus?'),
(5, 1, 'Egyistenhit'),
(6, 1, 'Árutermelô nagybirtok a Római Birodalomban'),
(7, 1, 'Ki/mi az a patrícius?'),
(8, 1, 'Mi az a despotizmus?'),
(9, 1, 'Ki/mi az a türannisz?'),
(10, 1, 'Körszínház, jellegzetes római középület, amely a gladiátori játékok és egyéb viadalok színtere volt'),
(11, 1, 'Kik/Mik azok a girondiak?'),
(12, 1, 'Mikor volt a karlócai béke a Szent Liga és a törökök között?'),
(13, 1, 'Mit takar a következő meghatározás? \"Iparszervezési forma és érdekvédelmi szervezet Nyugat-Európában a XI–XII'),
(14, 1, 'Mikor volt a Dózsa György vezette parasztháború?'),
(15, 1, 'Mikor volt Szigetvár ostroma?'),
(16, 2, 'Melyik a helytelen?'),
(17, 2, 'Melyik a helytelen?'),
(18, 2, 'Melyik a helytelen?'),
(19, 2, 'Melyik a helytelen?'),
(20, 2, 'Melyik a helytelen?'),
(21, 2, 'Melyik a helytelen?'),
(22, 2, 'Melyik a helytelen?'),
(23, 2, 'Melyik a helytelen?'),
(24, 2, 'Melyik a helytelen?'),
(25, 2, 'Melyik a helytelen?'),
(26, 2, 'Hogyan írjuk helyesen?'),
(27, 2, 'Hogyan írjuk helyesen?'),
(28, 2, 'Hogyan írjuk helyesen?'),
(29, 2, 'Hogyan írjuk helyesen?'),
(30, 2, 'Hogyan írjuk helyesen?'),
(31, 3, 'Hol született Arany János?'),
(32, 3, 'Hogy hívták Ady feleségét?'),
(33, 3, 'Hol tanult jogot Ady Endre?'),
(34, 3, 'Ki volt Vitay Georgina első szerelme az Abigélben?'),
(35, 3, 'Kinek az első felesége volt Laborfalvi Róza?'),
(36, 3, 'Az alábbi nevekkel kötelező olvasmányai során találkozott'),
(37, 3, 'Ki volt reménytelenül szerelmes Déryné Széppataki Rózába?'),
(38, 3, 'Kinek a nagy szerelme volt Léda?'),
(39, 3, 'Kinek az első felesége volt Laborfalvi Róza?'),
(40, 3, 'Ki írt szerelmes leveleket Vágó Mártának?'),
(41, 3, 'Kinek az ifjúkori szerelme volt Lányi Hedvig?'),
(42, 3, 'Kihez ment hozzá Szendrey Júlia?'),
(43, 3, 'Ki volt Kaffka Margit második férje?'),
(44, 3, 'Ki volt reménytelenül szerelmes Déryné Széppataki Rózába?'),
(45, 3, 'Kinek a felesége volt Török Sophie költőnő (Tanner Ilona)?');

-- --------------------------------------------------------

--
-- Table structure for table `nehezseg`
--

DROP TABLE IF EXISTS `nehezseg`;
CREATE TABLE `nehezseg` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `nehezseg`
--

TRUNCATE TABLE `nehezseg`;
--
-- Dumping data for table `nehezseg`
--

INSERT INTO `nehezseg` (`id`, `nev`) VALUES
(1, 'Könnyű'),
(2, 'Közepes'),
(3, 'Nehéz');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

DROP TABLE IF EXISTS `tema`;
CREATE TABLE `tema` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(256) NOT NULL,
  `kep_url` text DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `tema`
--

TRUNCATE TABLE `tema`;
--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`id`, `nev`, `kep_url`) VALUES
(1, 'Történelem', NULL),
(2, 'Nyelvtan', NULL),
(3, 'Irodalom', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `valasztas`
--

DROP TABLE IF EXISTS `valasztas`;
CREATE TABLE `valasztas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kerdes_id` int(10) UNSIGNED NOT NULL,
  `szoveg` varchar(256) NOT NULL,
  `jovalasz` tinyint(1) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=121 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `valasztas`
--

TRUNCATE TABLE `valasztas`;
--
-- Dumping data for table `valasztas`
--

INSERT INTO `valasztas` (`id`, `kerdes_id`, `szoveg`, `jovalasz`) VALUES
(136, 1, 'Az európai történelem egyik korszaka', 0),
(137, 1, 'A legôsibb egyiptomi írásfajta', 0),
(138, 1, 'Magas rangú tisztségviselô', 1),
(139, 2, 'Sztratégosz', 0),
(140, 2, 'Senatus', 0),
(141, 2, 'Zsinat', 1),
(142, 3, 'Feudalizmus', 0),
(143, 3, 'Hellenizmus', 0),
(144, 3, 'Despotizmus', 1),
(145, 4, 'Az egyeduralom a zsarnokság görög elnevezése', 0),
(146, 4, 'Szabadságától megfosztott, más tulajdonában levô személy', 0),
(147, 4, 'Három férfi szövetsége', 1),
(148, 5, 'Hellenizmus', 0),
(149, 5, 'Provincia', 0),
(150, 5, 'Monoteizmus', 1),
(151, 6, 'Monopolium', 0),
(152, 6, 'Limes', 0),
(153, 6, 'Latifundium', 1),
(154, 7, 'Valamely tevékenység végzésére való kizárólagos jog', 0),
(155, 7, 'A zsidóság megváltója, akinek eljövetelét a próféták megjövendölték', 0),
(156, 7, 'A római társadalom vagyonos polgárjoggal rendelkezô csoportjának tagja', 1),
(157, 8, 'Görög társadalom egyik rétege', 0),
(158, 8, 'Ősi indiai többistenhívô vallás', 0),
(159, 8, 'Korlátlan egyeduralom', 1),
(160, 9, 'A zsidóság megváltója akinek eljövetelét a próféták megjövendölték', 0),
(161, 9, 'A plebejusok érdekeit védô tisztségviselô az ókori Rómában', 0),
(162, 9, 'Az egyeduralom, a zsarnokság görög elnevezése', 1),
(163, 10, 'Colonus', 0),
(164, 10, 'Allódium', 0),
(165, 10, 'Amphiteatrum', 1),
(166, 11, 'Egy birodalomépítő, gyarmatosító politika', 0),
(167, 11, 'Az idegen területek meghódítása és birtokbavétele', 0),
(168, 11, 'A mérsékelt köztársaságpártiak politikai csoportja a francia forradalom idején.', 1),
(169, 12, '1667', 0),
(170, 12, '1684', 0),
(171, 12, '1699', 1),
(172, 13, 'Földesúri rendszer', 0),
(173, 13, 'Manufaktúra', 0),
(174, 13, 'Céh', 1),
(175, 14, '1539', 0),
(176, 14, '1554', 0),
(177, 14, '1514', 1),
(178, 15, '1552', 0),
(179, 15, '1538', 0),
(180, 15, '1566', 1),
(181, 16, 'fuvolaszóló', 0),
(182, 16, 'labdarúgó-mérkőzés', 0),
(183, 16, 'matek érettségi', 1),
(184, 17, 'tutaj', 0),
(185, 17, 'ricsaj', 0),
(186, 17, 'fekéj', 1),
(187, 18, 'Elzett', 0),
(188, 18, 'Ofotért', 0),
(189, 18, 'Otp', 1),
(190, 19, 'asztalitenniszcsapat', 0),
(191, 19, 'kézilabdacsapat', 0),
(192, 19, 'labdarúgócsapat', 1),
(193, 20, 'gólya', 0),
(194, 20, 'héja', 0),
(195, 20, 'papagály', 1),
(196, 21, 'finomfőzelék', 0),
(197, 21, 'lencsefőzelék', 0),
(198, 21, 'kelkáposztafőzelék', 1),
(199, 22, 'segéjjel', 0),
(200, 22, 'segélyjel', 0),
(201, 22, 'segéllyel', 1),
(202, 23, 'májjal', 0),
(203, 23, 'mályjal', 0),
(204, 23, 'mállyal', 1),
(205, 24, 'műlyégpálya', 0),
(206, 24, 'műjégpája', 0),
(207, 24, 'műjégpálya', 1),
(208, 25, 'kesejü', 0),
(209, 25, 'kesejű', 0),
(210, 25, 'keselyű', 1),
(211, 26, 'rio de janeirói', 0),
(212, 26, 'Rio de janeiró-i', 0),
(213, 26, 'Rio de Janeiró-i', 1),
(214, 27, 'Balkán hegységi', 0),
(215, 27, 'balkán-hegységi', 0),
(216, 27, 'Balkán-hegységi', 1),
(217, 28, 'Nagy-Britannia-i', 0),
(218, 28, 'Nagy Britannia-i', 0),
(219, 28, 'nagy-britanniai', 1),
(220, 29, 'Dráva-közi', 0),
(221, 29, 'Drávaközi', 0),
(222, 29, 'drávaközi', 1),
(223, 30, 'Közép-európai', 0),
(224, 30, 'Közép európai', 0),
(225, 30, 'közép-európai', 1),
(226, 31, 'Nagyszeben', 0),
(227, 31, 'Kiskőrös', 0),
(228, 31, 'Nagyszalonta', 1),
(229, 32, 'Sárvári Anna', 0),
(230, 32, 'Brüll Adél', 0),
(231, 32, 'Boncza Berta', 1),
(232, 33, 'Pozsony', 0),
(233, 33, 'Budapest', 0),
(234, 33, 'Debrecen', 1),
(235, 34, 'Egy titkár', 0),
(236, 34, 'Egy ügyvéd', 0),
(237, 34, 'Egy hadnagy', 1),
(238, 35, 'Ady Endre', 0),
(239, 35, 'Arany János', 0),
(240, 35, 'Jókai Mór', 1),
(241, 36, 'Homérosz', 0),
(242, 36, 'Antigoné', 0),
(243, 36, 'Szophoklész', 1),
(244, 37, 'Csokonai Vitéz Mihály', 0),
(245, 37, 'Madách Imre', 0),
(246, 37, 'Katona József', 1),
(247, 38, 'Babits Mihály', 0),
(248, 38, 'Mikszáth Kálmán', 0),
(249, 38, 'Ady Endre', 1),
(250, 39, 'Krúdy Gyula', 0),
(251, 39, 'Arany János', 0),
(252, 39, 'Jókai Mór', 1),
(253, 40, 'Karinthy Frigyes', 0),
(254, 40, 'Juhász Gyula', 0),
(255, 40, 'József Attila', 1),
(256, 41, 'Madách Imre', 0),
(257, 41, 'Karinthy Frigyes', 0),
(258, 41, 'Kosztolányi Dezső', 1),
(259, 42, 'Csokonai Vitéz Mihály', 0),
(260, 42, 'Arany János', 0),
(261, 42, 'Petőfi Sándor', 1),
(262, 43, 'Márai Sándor', 0),
(263, 43, 'Balázs Béla', 0),
(264, 43, 'Bauer Ervin', 1),
(265, 44, 'Kölcsey Ferenc', 0),
(266, 44, 'Madách Imre', 0),
(267, 44, 'Katona József', 1),
(268, 45, 'Juhász Gyula', 0),
(269, 45, 'Füst Milán', 0),
(270, 45, 'Babits Mihály', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eredmeny`
--
ALTER TABLE `eredmeny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eredmeny_ibfk_1` (`felhasznalo_id`),
  ADD KEY `eredmeny_ibfk_2` (`tema_id`),
  ADD KEY `nehezseg_id` (`nehezseg_id`);

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kerdesek_ibfk_1` (`tema_id`);

--
-- Indexes for table `nehezseg`
--
ALTER TABLE `nehezseg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valasztas`
--
ALTER TABLE `valasztas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valasztas_ibfk_1` (`kerdes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eredmeny`
--
ALTER TABLE `eredmeny`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kerdesek`
--
ALTER TABLE `kerdesek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `nehezseg`
--
ALTER TABLE `nehezseg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `valasztas`
--
ALTER TABLE `valasztas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=811;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eredmeny`
--
ALTER TABLE `eredmeny`
  ADD CONSTRAINT `eredmeny_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`),
  ADD CONSTRAINT `eredmeny_ibfk_2` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`),
  ADD CONSTRAINT `eredmeny_ibfk_3` FOREIGN KEY (`nehezseg_id`) REFERENCES `nehezseg` (`id`);

--
-- Constraints for table `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD CONSTRAINT `kerdesek_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`);

--
-- Constraints for table `valasztas`
--
ALTER TABLE `valasztas`
  ADD CONSTRAINT `valasztas_ibfk_1` FOREIGN KEY (`kerdes_id`) REFERENCES `kerdesek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
