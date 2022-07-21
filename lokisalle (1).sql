-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2022 at 03:26 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lokisalle`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(1, 7, 1, 'uytèiuytity_iy_i', 5, '2022-07-13 00:00:00'),
(2, 7, 1, 'fdgdhfh', 2, '2022-07-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(1, 7, 11, '2022-07-13 00:00:00'),
(2, 7, 12, '2022-07-13 00:00:00'),
(3, 7, 12, '2022-07-13 00:00:00'),
(4, 7, 12, '2022-07-13 00:00:00'),
(5, 7, 12, '2022-07-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(4, 'yas', '$2y$10$r9a2u8jdjUy8qdWawtgAuu/V5CL08g1RbIkwdJgX3RYaAJmAfZ5By', 'M', 'Yassine', 'y_moudjaoui@yahoo.fr', 'm', 1, '2022-07-04 00:00:00'),
(5, 'joker', '$2y$10$Gk612y1V7Qp7L.n2slJFfu6HlMRu5cfpm6dTcXtJ8q6WYsNRs6NgO', 'Cottet', 'Julien', 'juju70@gmail.com', 'm', 0, '2022-07-06 00:00:00'),
(6, 'camelus', '$2y$10$yY6r/PWw1WrgrvGxkpLE.edCs3EMyP5IxD.D5odL6PyqC2utRD8VK', 'Miller', 'Guillaume', 'guillaume-miller@gmail.com', 'm', 0, '2022-07-09 00:00:00'),
(7, 'gringofumi', '$2y$10$rJ3nwm.aGOjKQ2P8xgsXv.nE7YbvnChJzN5srg7NUd4WXOxlOaNRC', 'desaulle', 'césaire', 'cezdesaulle@gmail.com', 'm', 0, '2022-07-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(6, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'reservation'),
(8, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'reservation'),
(9, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'reservation'),
(10, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'reservation'),
(11, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'reservation'),
(12, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'reservation'),
(13, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'reservation'),
(14, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'reservation'),
(15, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre'),
(16, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'libre'),
(17, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'reservation'),
(18, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre'),
(19, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'libre'),
(20, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'libre'),
(21, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre'),
(22, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'libre'),
(23, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'libre'),
(24, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre'),
(25, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'libre'),
(26, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'libre'),
(27, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre'),
(28, 1, '2016-11-22 00:00:00', '2016-11-27 00:00:00', 1200, 'libre'),
(29, 1, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 900, 'libre'),
(30, 7, '2016-11-29 00:00:00', '2016-12-03 00:00:00', 880, 'libre');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('réunion','bureau','formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Cézanne', 'Cette salle sera parfaite pour vos réunions d\'entreprise', 'upload/06072022123312Salle_Cézanne.png', 'france', 'paris', '30 rue mademoiselle', 75015, 30, 'réunion'),
(7, 'Mozart', 'Cette salle vous permettra de recevoir vos collaborateurs en petit comité', 'upload/06072022123312Salle_Cézanne.png', 'france', 'paris', '17 rue de turbigo', 75002, 5, 'réunion'),
(8, 'Picasso', 'Cette salle vous permettra de travailler au calme', 'upload/06072022123312Salle_Cézanne.png', 'france', 'lyon', '28 quai claude bernard lyon', 69007, 2, 'bureau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
