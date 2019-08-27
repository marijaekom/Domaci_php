-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 10:26 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veb_aplikacija`
--
CREATE DATABASE IF NOT EXISTS `veb_aplikacija` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `veb_aplikacija`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ime_prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `email`, `password`, `ime_prezime`, `telefon`, `slika`) VALUES
(18, 'homer@gmail.com', '1dafc8fddbd1b5f7fef5cb9c2f75a8265f095828301d7de285f94a1474d316dc3a466d1577dc4462e61e96143d8f2d392c572ae456d0608057457be90ea0691e', 'Homer Simpson', '064123456', 'slike/1566847073homer.jpg'),
(19, 'marge@gmail.com', 'c8f412e5dc1f3445235a30381529bb3ce20c52d851b55fec177162bb8a881ea641c4eed73e5b29209454f6662a6db13038a6d390da45a2bb9864939f12404e79', 'Marge Simpson', '011123456', 'slike/1566847113marge.jpg'),
(20, 'lisa@gmail.com', 'f13b7762550dd9df698fbd960475185551ef43c605cdbac9a3af401ddef35b52507fd95ddf09c5edfb7782ef8c3420ea274774d31f1aff6ff92c0c1731964252', 'Lisa Simpson', '034258789', 'slike/1566847589lisa.jpg'),
(21, 'bart@gmail.com', '2e73ef3a8994418d04fcbbcafea0d5c1890b2fb693cf7c98eacf926fb7046500b428260acbc3c01f368cdb4c85bf6790b1ec75b635dc5663279bc1d86433f01f', 'Bart Simpson', '063258444', 'slike/1566847725bart.png'),
(28, 'marija@gmail.com', '16a9c7835af2af52bb37079321bf2b748ae88030fd6cc0d31ae4132013ff95593089cb3956c560a464c4c4c8559f1e269d5a398767aa6c52fb49857ae2ffbde5', 'Marija Jovanovic', '0641154298', ''),
(29, 'krang@gmail.com', '1accee1c07c0e97f6df6de4e6df1d24e0120874ade645b5e74878e85bf30a417297dcbdb868019c5b26403353ae104d4a465f8d11d839516c7c1f7c52a86b3ff', 'Krang', '065487996', 'slike/1566926239krang.png'),
(41, 'splinter@gmail.com', '86f82560a611a83625f54452f4e8c281bd595dfa73b113475b1a68bbfa82f9daf92f8bc0a1266327055763111ada61612c2e3494cef808bd2d5e08078d02ff0e', 'Hamato Yoshi', '063124569', 'slike/1566930124splinter.jpg'),
(43, 'jovan@gmail.com', 'af6a99e288c9612fc6d0b1de2fd826235eecb3a71c1111f1d2f0134e13749aacd1b9028fb7cf14708bcc4167ea457995ede90ed4eccec95120ef72eac0b6a82f', 'Jovan Jovanovic', '011235669', '');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `id` int(10) UNSIGNED NOT NULL,
  `naslov` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sadrzaj` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `korisnik_id` int(10) UNSIGNED NOT NULL,
  `prioritet` int(11) NOT NULL,
  `primalac` int(10) UNSIGNED NOT NULL,
  `procitano` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`id`, `naslov`, `sadrzaj`, `vreme`, `korisnik_id`, `prioritet`, `primalac`, `procitano`) VALUES
(329, 'Poruka', 'Poruka za Homera', '2019-08-26 20:51:06', 28, 1, 18, 1),
(330, 'Poruka', 'Poruka za Mardz', '2019-08-26 20:52:09', 28, 0, 19, 0),
(331, 'For Lisa', 'A message for Lisa :)', '2019-08-26 21:42:45', 28, 0, 20, 0),
(332, 'Zdravo', 'Zdravo Marija!', '2019-08-26 21:43:23', 20, 1, 28, 0),
(333, 'Life lesson', 'Kids, just because I don’t care doesn’t mean I’m not listening.', '2019-08-26 21:46:28', 18, 0, 21, 0),
(334, 'Liar', 'Marge it takes two to lie. One to lie and one to listen.', '2019-08-26 21:48:51', 18, 1, 19, 0),
(335, 'Job', 'Lisa, if you don’t like your job you don’t strike. You just go in every day and do it really half-assed.', '2019-08-26 21:49:40', 18, 0, 20, 0),
(336, 'Love', 'Bart, with $10,000, we’d be millionaires! We could buy all kinds of useful things like… love!', '2019-08-26 21:51:02', 18, 1, 21, 1),
(337, 'Marriage', 'Marriage is like a coffin and each kid is another nail.', '2019-08-26 21:52:48', 18, 0, 19, 1),
(338, 'Where is Bart?', 'I wonder where Bart is, his dinner’s getting all cold, and eaten.', '2019-08-26 21:53:34', 18, 1, 19, 0),
(339, 'Flintstones', 'If The Flintstones has taught us anything, it’s that pelicans can be used to mix cement.', '2019-08-26 21:55:16', 18, 1, 20, 1),
(340, 'Go out', 'What’s the point of going out? We’re just going to wind up back here anyway.', '2019-08-26 21:56:26', 18, 0, 19, 0),
(341, 'Columbus', 'I\'m proud of you, Mom. You\'re like Christopher Columbus. You discovered something millions of people knew about before you.', '2019-08-26 21:58:57', 20, 0, 19, 0),
(342, 'Dreams', 'Does it make you feel superior to tear down people\'s dreams?', '2019-08-26 22:00:04', 20, 1, 21, 0),
(343, 'Shot', 'Dad, women won\'t like being shot in the face.', '2019-08-26 22:00:47', 20, 1, 18, 0),
(344, 'Money', 'You got the brains and talent to go as far as you want and when you do I\'ll be right there to borrow money.', '2019-08-26 22:02:30', 21, 0, 20, 0),
(345, 'Hello', 'Hello Marija', '2019-08-26 22:02:46', 21, 0, 28, 0),
(346, 'I Didn\'t Do It', 'I Didn\'t Do It. Nobody Saw Me Do It. You Can\'t Prove Anything.', '2019-08-26 22:10:33', 21, 1, 18, 0),
(347, 'Fourth Grade', 'As God Is My Witness, I Can Pass the Fourth Grade.', '2019-08-26 22:12:34', 21, 0, 19, 0),
(348, 'Benefit of the doubt', 'Lisa, you’re learning many lessons tonight. And one of them is to always give your mother the benefit of the doubt.', '2019-08-26 22:15:44', 19, 0, 20, 0),
(349, 'Stalking', 'Homer don’t start stalking people again! It’s so… illegal.', '2019-08-26 22:17:30', 19, 1, 18, 0),
(350, 'Attic', 'You went into the attic? I’m very disappointed and terrified.', '2019-08-26 22:18:56', 19, 1, 21, 0),
(351, 'Naslov komentara', 'Zdravo Marija', '2019-08-27 17:18:26', 29, 0, 28, 0),
(352, 'Hello Krang', 'Hello Krang. This is an important message.', '2019-08-27 18:22:43', 41, 1, 29, 0),
(353, 'Hello', 'Zdravo Marija.', '2019-08-27 19:10:52', 43, 0, 28, 0),
(354, 'Hello Homer', 'Hello Homer!', '2019-08-27 20:09:57', 43, 0, 18, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_id` (`korisnik_id`),
  ADD KEY `primalac` (`primalac`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `poruke`
--
ALTER TABLE `poruke`
  ADD CONSTRAINT `poruke_ibfk_1` FOREIGN KEY (`primalac`) REFERENCES `korisnici` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
