-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 05 Janvier 2018 à 15:15
-- Version du serveur :  5.7.17-log
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `air_azur`
--

-- --------------------------------------------------------

--
-- Structure de la table `aeroport`
--
drop database air_azur; 
CREATE DATABASE air_azur;

use air_azur;

CREATE TABLE `aeroport` (
  `code` int(11) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `arp_nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `aeroport`
--

INSERT INTO `aeroport` (`code`, `libelle`, `pays`, `arp_nom`) VALUES
(1, 'CDG', 'France', 'Roissy-CDG'),
(2, 'MLE', 'Maldives', 'Malé'),
(3, 'JFK', 'Etats-Unis', 'John-F-Kennedy'),
(4, 'LCY', 'Royaume-Uni', 'Londres-City');

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `gnc_id` int(11) NOT NULL,
  `code_agence` int(11) DEFAULT NULL,
  `mot_de_passe` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `agence`
--

INSERT INTO `agence` (`gnc_id`, `code_agence`, `mot_de_passe`) VALUES
(1, 810, '123456'),
(2, 815, '987654');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `cln_id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adr_rue` varchar(30) DEFAULT NULL,
  `adr_cp` int(11) DEFAULT NULL,
  `adr_ville` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `client` (`cln_id`, `nom`, `prenom`, `adr_rue`, `adr_cp`, `adr_ville`) VALUES
(1, 'Zor', 'Dino', 'Rue des Lézards', 75014, 'Paris'),
(3, 'Solete', 'Bob', 'Rue des Chats', 75019, 'Paris'),
(4, 'Piazza', 'Roberto', 'Rue des Mouettes', 76600, 'Le Havre');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `rsr_num` int(11) NOT NULL,
  `gnc_id` int(11) NOT NULL,
  `nbr_places_res` int(11) DEFAULT NULL,
  `date_reservation` date DEFAULT NULL,
  `cln_id` int(11) DEFAULT NULL,
  `vlg_num` varchar(20) DEFAULT NULL,
  `date_dep` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reservation` (`rsr_num`, `gnc_id`, `nbr_places_res`, `date_reservation`, `cln_id`, `vlg_num`, `date_dep`) VALUES
(1, 1, 2, '2018-01-06', 1, 'AF660', '2018-01-16'),
(2, 1, 1, '2018-01-06', 3, 'AF150', '2018-01-17');
-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE `vol` (
  `date_dep` date NOT NULL,
  `vlg_num` varchar(20) NOT NULL,
  `date_arr` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vol`
--

INSERT INTO `vol` (`date_dep`, `vlg_num`, `date_arr`) VALUES
('2018-01-15', 'AF410', '2018-01-16'),
('2018-01-16', 'AF660', '2018-01-16'),
('2018-01-17', 'AF150', '2018-01-17'),
('2018-01-22', 'AF410', '2018-01-23'),
('2018-01-23', 'AF660', '2018-01-23'),
('2018-01-24', 'AF150', '2018-01-24');

-- --------------------------------------------------------

--
-- Structure de la table `vol_g`
--

CREATE TABLE `vol_g` (
  `vlg_num` varchar(20) NOT NULL,
  `heure_dep` time DEFAULT NULL,
  `heure_arr` time DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `nbr_places` int(11) DEFAULT NULL,
  `jour` varchar(10) DEFAULT NULL,
  `code_arp_dep` int(11) DEFAULT NULL,
  `code_arp_arr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vol_g`
--

INSERT INTO `vol_g` (`vlg_num`, `heure_dep`, `heure_arr`, `prix`, `nbr_places`, `jour`, `code_arp_dep`, `code_arp_arr`) VALUES
('AF150', '15:30:00', '16:30:00', 39, 185, 'mercredi', 1, 4),
('AF410', '20:30:00', '09:30:00', 766, 180, 'lundi', 1, 2),
('AF660', '08:00:00', '16:00:00', 277, 180, 'mardi', 1, 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `aeroport`
--
ALTER TABLE `aeroport`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`gnc_id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cln_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`rsr_num`,`gnc_id`),
  ADD KEY `fk_rsr_gnc` (`gnc_id`),
  ADD KEY `fk_cln_id` (`cln_id`),
  ADD KEY `FK_num_dep_vol` (`vlg_num`,`date_dep`);

--
-- Index pour la table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`date_dep`,`vlg_num`),
  ADD KEY `FK_vol_volg` (`vlg_num`);

--
-- Index pour la table `vol_g`
--
ALTER TABLE `vol_g`
  ADD PRIMARY KEY (`vlg_num`),
  ADD KEY `fk_code_arp_dep` (`code_arp_dep`),
  ADD KEY `fk_code_arp_arr` (`code_arp_arr`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `aeroport`
--
ALTER TABLE `aeroport`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `agence`
--
ALTER TABLE `agence`
  MODIFY `gnc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `cln_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_num_dep_vol` FOREIGN KEY (`vlg_num`,`date_dep`) REFERENCES `vol` (`vlg_num`, `date_dep`),
  ADD CONSTRAINT `fk_cln_id` FOREIGN KEY (`cln_id`) REFERENCES `client` (`cln_id`),
  ADD CONSTRAINT `fk_rsr_gnc` FOREIGN KEY (`gnc_id`) REFERENCES `agence` (`gnc_id`);

--
-- Contraintes pour la table `vol`
--
ALTER TABLE `vol`
  ADD CONSTRAINT `FK_vol_volg` FOREIGN KEY (`vlg_num`) REFERENCES `vol_g` (`vlg_num`);

--
-- Contraintes pour la table `vol_g`
--
ALTER TABLE `vol_g`
  ADD CONSTRAINT `fk_code_arp_arr` FOREIGN KEY (`code_arp_arr`) REFERENCES `aeroport` (`code`),
  ADD CONSTRAINT `fk_code_arp_dep` FOREIGN KEY (`code_arp_dep`) REFERENCES `aeroport` (`code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
