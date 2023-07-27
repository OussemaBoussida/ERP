-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 juil. 2023 à 11:34
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `erp`
--

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(8) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `datee` date NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tel` int(8) NOT NULL,
  `document_cin` varchar(500) NOT NULL,
  `titre_poste` varchar(50) NOT NULL,
  `salaire` int(10) NOT NULL,
  `type_contrat` varchar(50) NOT NULL,
  `rib` varchar(100) NOT NULL,
  `imagee` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `cin`, `nom`, `prenom`, `datee`, `adresse`, `email`, `tel`, `document_cin`, `titre_poste`, `salaire`, `type_contrat`, `rib`, `imagee`) VALUES
(4, '14515001', 'Abidi ', 'Mohamed Aziz', '2001-07-19', '25 Sidi Salah , Soukra', 'Abidi.Aziz@esprit.tn', 54001421, 'cv.pdf', 'Ingénieur ', 2500, 'rdi', 'rr787b11d55', '1186452.jpg'),
(5, '14214451', 'Ouerthi', ' Amal', '2000-07-15', '21 rue de reservoir', 'amalouerthi88@gmail.com', 89554124, 'cv.pdf', 'Developer', 1500, 'cdi', 'aa748dd44d6', '1276648.png'),
(6, '14511241', 'Turki', 'Alaa', '2023-07-17', '31 Soukra Laouina', 'alaa.turki@esprit.tn', 78447563, 'cv.pdf', 'Developer', 1000, 'rdi', '1451221458j55ii', 'demon-slayer-kimetsu-no-yaiba-anime-4k-t9.jpg'),
(8, '12021451', 'Joo', 'Anas', '1997-09-08', 'Menzel temim', 'anas.joo@esprit.tn', 54008652, '1186452.jpg', 'designer', 1000, 'cdi', 'aa748dd44d6edd', '1186452.jpg'),
(10, '13031862', 'Boussida', 'Mohamed Oussema', '2002-07-02', '21 Chotrana 3 , La Soukra', 'mohamedoussema.boussida@esprit.tn', 54007403, 'cv.pdf', 'designer', 500, 'cdi', '1451pp87nn4d7', '1675446160607.jpg'),
(11, '13031855', 'Mahdi', 'Salim', '2002-08-05', '55 Sfax', 'SalimMahdi@esprit.tn', 54008403, 'cv.pdf', 'Marketing Manager', 8000, 'rdi', 'aa748dd44d6', 'demon-slayer-minimal-4k-zh.jpg'),
(12, '11012147', 'Ben Mohamed', 'Kilani', '2023-07-17', '55 Rue el horiya', 'Kilani77@gmail.com', 87445121, 'cv.pdf', 'Developer', 700, 'cdi', 'aa748dd44d6edd', 'technology-code-coding-computer.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cin` (`cin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
