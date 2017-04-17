-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Avril 2017 à 21:18
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `six_qui_ramasse`
--

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE `carte` (
  `numero_carte` int(11) NOT NULL,
  `nombre_beliers` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`numero_carte`, `nombre_beliers`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 3),
(11, 5),
(12, 1),
(13, 1),
(14, 1),
(15, 2),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 3),
(21, 1),
(22, 5),
(23, 1),
(24, 1),
(25, 2),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 3),
(31, 1),
(32, 1),
(33, 5),
(34, 1),
(35, 2),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 3),
(41, 1),
(42, 1),
(43, 1),
(44, 5),
(45, 2),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 3),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 7),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 3),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 2),
(66, 5),
(67, 1),
(68, 1),
(69, 1),
(70, 3),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 2),
(76, 1),
(77, 5),
(78, 1),
(79, 1),
(80, 3),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 2),
(86, 1),
(87, 1),
(88, 5),
(89, 3),
(90, 3),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 2),
(96, 1),
(97, 1),
(98, 1),
(99, 5),
(100, 3),
(101, 1),
(102, 1),
(103, 1),
(104, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composition_main`
--

CREATE TABLE `composition_main` (
  `id_main` bigint(20) NOT NULL,
  `numero_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `composition_main`
--

INSERT INTO `composition_main` (`id_main`, `numero_carte`) VALUES
(7, 3),
(6, 4),
(7, 6),
(6, 18),
(7, 19),
(6, 27),
(7, 29),
(7, 31),
(6, 36),
(6, 44),
(7, 47),
(6, 51),
(7, 53),
(7, 56),
(6, 64),
(7, 67),
(6, 69),
(7, 81),
(6, 98),
(6, 99);

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `login` char(15) NOT NULL,
  `id_partie` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `invitation`
--

INSERT INTO `invitation` (`login`, `id_partie`) VALUES
('maxime', 1),
('paul', 3),
('ayoub', 10),
('clementD', 10),
('clementV', 10),
('jimmy', 10),
('lucasK', 10),
('lucasO', 10),
('maxime', 10),
('paul', 10),
('clementD', 15),
('romain', 16),
('lucasO', 17),
('romain', 18),
('yassine', 19),
('maxime', 20),
('ayoub', 25),
('yassine', 25),
('paul', 26),
('axel', 27),
('romain', 27),
('lucasK', 28),
('abc', 39),
('vincent', 42),
('ayoub', 44);

-- --------------------------------------------------------

--
-- Structure de la table `joue`
--

CREATE TABLE `joue` (
  `id_partie` bigint(20) NOT NULL,
  `login` char(15) NOT NULL,
  `score` int(11) NOT NULL,
  `numero_carte_jouee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joue`
--

INSERT INTO `joue` (`id_partie`, `login`, `score`, `numero_carte_jouee`) VALUES
(1, 'yassine', 0, NULL),
(2, 'chakib', 0, NULL),
(2, 'lucasO', 0, NULL),
(2, 'root', 0, NULL),
(10, 'chakib', 0, NULL),
(10, 'root', 0, NULL),
(15, 'root', 0, NULL),
(16, 'chakib', 0, NULL),
(16, 'root', 0, NULL),
(17, 'root', 0, NULL),
(18, 'root', 0, NULL),
(19, 'lucasO', 0, NULL),
(19, 'root', 0, NULL),
(20, 'root', 0, NULL),
(21, 'root', 0, NULL),
(22, 'root', 0, NULL),
(23, 'root', 0, NULL),
(24, 'ayoub', 0, NULL),
(24, 'root', 0, NULL),
(25, 'chakib', 0, NULL),
(25, 'root', 0, NULL),
(26, 'root', 0, NULL),
(27, 'root', 0, NULL),
(28, 'root', 0, NULL),
(29, 'root', 0, NULL),
(30, 'root', 0, NULL),
(31, 'root', 0, NULL),
(31, 'yassine', 0, NULL),
(32, 'root', 0, NULL),
(33, 'root', 0, NULL),
(34, 'root', 0, NULL),
(35, 'root', 0, NULL),
(36, 'root', 0, NULL),
(37, 'root', 0, NULL),
(38, 'root', 0, NULL),
(40, 'root', 0, NULL),
(41, 'root', 0, NULL),
(42, 'clementD', 0, NULL),
(43, 'clementV', 0, NULL),
(43, 'root', 0, NULL),
(44, 'chakib', 0, NULL),
(44, 'root', 0, NULL),
(49, 'root', 0, NULL),
(64, 'root', 0, NULL),
(65, 'root', 0, NULL),
(80, 'root', 0, NULL),
(81, 'root', 0, NULL),
(82, 'root', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `login` char(15) NOT NULL,
  `password` char(15) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joueur`
--

INSERT INTO `joueur` (`login`, `password`, `score`, `mail`) VALUES
('', '', 0, ''),
('a', 'b', 0, 'c'),
('aa', 'a', 0, 'a'),
('aazz', 'a', 0, ''),
('aazza', 'a', 0, ''),
('abc', 'a', 0, ''),
('abcdef', 'a', 0, ''),
('axel', 'ytreza!', 9, 'axel@minesdedouai.fr'),
('ayoub', 'ytreza!', 0, 'ayoub@minesdedouai.fr'),
('chakib', 'ytreza!', 2, 'chakib@minesdedouai.fr'),
('clementD', 'ytreza!', 10, 'clemendD@minesdedouai.fr'),
('clementV', 'ytreza!', 4, 'clementV@minesdedouai.fr'),
('jimmy', 'ytreza!', 1, 'jimmy@minesdedouai.fr'),
('lucasK', 'ytreza!', 11, 'lucasK@minesdedouai.fr'),
('lucasO', 'ytreza!', 12, 'lucasO@minesdedouai.fr'),
('maxime', 'ytreza!', 13, 'maxime@minesdedouai.fr'),
('paul', 'ytreza!', 14, 'paul@minesdedouai.fr'),
('romain', 'ytreza!', 5, 'romain@minesdedouai.fr'),
('root', 'root', 0, ''),
('vincent', 'ytreza!', 7, 'vincent@minesdedouai.fr'),
('Violator59', 'salutChakib', -999999999, ''),
('yassine', 'ytreza!', 3, 'FJurietti@minesdedouai.fr'),
('yohann', 'ytreza!', 8, 'yohann@minesdedouai.fr');

-- --------------------------------------------------------

--
-- Structure de la table `main`
--

CREATE TABLE `main` (
  `id_main` bigint(20) NOT NULL,
  `login` char(15) NOT NULL,
  `id_partie` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `main`
--

INSERT INTO `main` (`id_main`, `login`, `id_partie`) VALUES
(6, 'lucasO', 19),
(7, 'root', 19);

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `id_partie` bigint(20) NOT NULL,
  `id_createur` char(15) NOT NULL,
  `nombre_joueurs` smallint(6) DEFAULT NULL,
  `est_commencee` tinyint(1) DEFAULT NULL,
  `est_terminee` tinyint(1) DEFAULT NULL,
  `est_public` tinyint(1) DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`id_partie`, `id_createur`, `nombre_joueurs`, `est_commencee`, `est_terminee`, `est_public`, `date_creation`) VALUES
(1, 'yassine', 5, 1, 0, 1, '2017-03-13'),
(2, 'ayoub', 7, 0, 0, 1, '2017-04-16'),
(3, 'a', 2, NULL, NULL, NULL, NULL),
(10, 'root', 10, 1, 0, 1, '2017-04-14'),
(15, 'root', 2, 0, 0, 1, '2017-04-13'),
(16, 'root', 2, 1, 0, 1, '2017-04-13'),
(17, 'root', 2, 0, 0, 1, '2017-04-13'),
(18, 'root', 2, 0, 0, 1, '2017-04-13'),
(19, 'root', 2, 1, 0, 1, '2017-04-13'),
(20, 'root', 2, 0, 0, 1, '2017-04-13'),
(21, 'root', 2, 0, 0, 1, '2017-04-13'),
(22, 'root', 2, 0, 0, 1, '2017-04-13'),
(23, 'root', 2, 0, 0, 1, '2017-04-13'),
(24, 'root', 2, 1, 0, 1, '2017-04-13'),
(25, 'root', 2, 1, 0, 1, '2017-04-13'),
(26, 'root', 2, 0, 0, 1, '2017-04-13'),
(27, 'root', 2, 1, 1, 1, '2017-04-14'),
(28, 'root', 2, 0, 0, 1, '2017-04-14'),
(29, 'root', 2, 0, 0, 1, '2017-04-14'),
(30, 'root', 2, 0, 0, 0, '2017-04-14'),
(31, 'root', 2, 1, 0, 0, '2017-04-14'),
(32, 'root', 10, 0, 0, 1, '2017-04-14'),
(33, 'root', 9, 0, 0, 0, '2017-04-14'),
(34, 'root', 2, 0, 0, 1, '2017-04-14'),
(35, 'root', 2, 0, 0, 1, '2017-04-14'),
(36, 'root', 2, 0, 0, 1, '2017-04-14'),
(37, 'root', 2, 0, 0, 1, '2017-04-14'),
(38, 'root', 2, 0, 0, 1, '2017-04-14'),
(39, 'abc', 2, 0, 0, 1, '2017-04-14'),
(40, 'root', 5, 0, 0, 1, '2017-04-14'),
(41, 'root', 5, 0, 0, 1, '2017-04-14'),
(42, 'yohann', 2, 0, 0, 1, '2017-04-15'),
(43, 'yassine', 10, 0, 0, 1, '2017-04-15'),
(44, 'root', 5, 0, 0, 1, '0000-00-00'),
(49, 'root', 12, 0, 0, 1, '0000-00-00'),
(64, 'root', 12, 0, 0, 1, '0000-00-00'),
(65, 'root', 12, 0, 0, 1, '0000-00-00'),
(80, 'root', 6, 0, 0, 1, '2017-04-16'),
(81, 'root', 5, 0, 0, 1, '2017-04-16'),
(82, 'root', 5, 0, 0, 1, '2017-04-16');

-- --------------------------------------------------------

--
-- Structure de la table `plateau`
--

CREATE TABLE `plateau` (
  `id_partie` bigint(20) NOT NULL,
  `numero_rangee` int(11) NOT NULL,
  `numero_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `plateau`
--

INSERT INTO `plateau` (`id_partie`, `numero_rangee`, `numero_carte`) VALUES
(19, 0, 1),
(19, 0, 2),
(19, 0, 5),
(19, 0, 7),
(19, 0, 8),
(19, 0, 9),
(19, 0, 10),
(19, 0, 11),
(19, 0, 12),
(19, 0, 13),
(19, 0, 14),
(19, 0, 15),
(19, 0, 16),
(19, 0, 17),
(19, 0, 20),
(19, 0, 21),
(19, 0, 22),
(19, 0, 23),
(19, 0, 24),
(19, 0, 25),
(19, 0, 26),
(19, 0, 28),
(19, 0, 30),
(19, 0, 32),
(19, 0, 33),
(19, 0, 34),
(19, 0, 35),
(19, 0, 37),
(19, 0, 38),
(19, 0, 39),
(19, 0, 40),
(19, 0, 41),
(19, 0, 43),
(19, 0, 45),
(19, 0, 46),
(19, 0, 48),
(19, 0, 49),
(19, 0, 50),
(19, 0, 52),
(19, 0, 54),
(19, 0, 55),
(19, 0, 57),
(19, 0, 58),
(19, 0, 59),
(19, 0, 60),
(19, 0, 61),
(19, 0, 62),
(19, 0, 63),
(19, 0, 65),
(19, 0, 66),
(19, 0, 68),
(19, 0, 70),
(19, 0, 72),
(19, 0, 73),
(19, 0, 74),
(19, 0, 75),
(19, 0, 76),
(19, 0, 77),
(19, 0, 78),
(19, 0, 79),
(19, 0, 80),
(19, 0, 82),
(19, 0, 83),
(19, 0, 84),
(19, 0, 85),
(19, 0, 86),
(19, 0, 87),
(19, 0, 88),
(19, 0, 89),
(19, 0, 90),
(19, 0, 91),
(19, 0, 92),
(19, 0, 93),
(19, 0, 94),
(19, 0, 95),
(19, 0, 96),
(19, 0, 100),
(19, 0, 101),
(19, 0, 102),
(19, 0, 103),
(19, 1, 42),
(19, 2, 71),
(19, 3, 104),
(19, 4, 97),
(19, 5, 3),
(19, 5, 4),
(19, 5, 6),
(19, 5, 18),
(19, 5, 19),
(19, 5, 27),
(19, 5, 29),
(19, 5, 31),
(19, 5, 36),
(19, 5, 44),
(19, 5, 47),
(19, 5, 51),
(19, 5, 53),
(19, 5, 56),
(19, 5, 64),
(19, 5, 67),
(19, 5, 69),
(19, 5, 81),
(19, 5, 98),
(19, 5, 99);

-- --------------------------------------------------------

--
-- Structure de la table `rangee`
--

CREATE TABLE `rangee` (
  `numero_rangee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rangee`
--

INSERT INTO `rangee` (`numero_rangee`) VALUES
(0),
(1),
(2),
(3),
(4),
(5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`numero_carte`);

--
-- Index pour la table `composition_main`
--
ALTER TABLE `composition_main`
  ADD PRIMARY KEY (`id_main`,`numero_carte`),
  ADD UNIQUE KEY `SE_COMPOSE_DE_PK` (`id_main`,`numero_carte`),
  ADD KEY `FK_SE_COMPOSE_DE2` (`numero_carte`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`login`,`id_partie`),
  ADD KEY `FK_EST_INVITE_A2` (`id_partie`);

--
-- Index pour la table `joue`
--
ALTER TABLE `joue`
  ADD PRIMARY KEY (`id_partie`,`login`),
  ADD KEY `FK_JOUE2` (`login`),
  ADD KEY `numero_carte_jouee` (`numero_carte_jouee`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id_main`),
  ADD KEY `FK_POSSEDE` (`login`),
  ADD KEY `FK_EST_DANS` (`id_partie`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`id_partie`),
  ADD KEY `FK_CREE` (`id_createur`);

--
-- Index pour la table `plateau`
--
ALTER TABLE `plateau`
  ADD PRIMARY KEY (`id_partie`,`numero_carte`,`numero_rangee`),
  ADD KEY `FK_RANGEE` (`numero_rangee`),
  ADD KEY `FK_CARTE` (`numero_carte`);

--
-- Index pour la table `rangee`
--
ALTER TABLE `rangee`
  ADD PRIMARY KEY (`numero_rangee`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `main`
--
ALTER TABLE `main`
  MODIFY `id_main` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `id_partie` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `composition_main`
--
ALTER TABLE `composition_main`
  ADD CONSTRAINT `FK_SE_COMPOSE_DE` FOREIGN KEY (`id_main`) REFERENCES `main` (`id_main`),
  ADD CONSTRAINT `FK_SE_COMPOSE_DE2` FOREIGN KEY (`numero_carte`) REFERENCES `carte` (`numero_carte`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `FK_EST_INVITE_A` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EST_INVITE_A2` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `joue`
--
ALTER TABLE `joue`
  ADD CONSTRAINT `FK_JOUE` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_JOUE2` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_JOUE3` FOREIGN KEY (`numero_carte_jouee`) REFERENCES `carte` (`numero_carte`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `FK_EST_DANS` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_POSSEDE` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `FK_CREE` FOREIGN KEY (`id_createur`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `plateau`
--
ALTER TABLE `plateau`
  ADD CONSTRAINT `FK_CARTE` FOREIGN KEY (`numero_carte`) REFERENCES `carte` (`numero_carte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PARTIE` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RANGEE` FOREIGN KEY (`numero_rangee`) REFERENCES `rangee` (`numero_rangee`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
