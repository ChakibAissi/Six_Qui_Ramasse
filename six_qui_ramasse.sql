-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 17 Avril 2017 à 10:51
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
  `NUM_CARTE` int(11) NOT NULL,
  `NB_BELIERS` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`NUM_CARTE`, `NB_BELIERS`) VALUES
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
-- Structure de la table `est_invite_a`
--

CREATE TABLE `est_invite_a` (
  `login` char(15) NOT NULL,
  `id_partie` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `est_invite_a`
--

INSERT INTO `est_invite_a` (`login`, `id_partie`) VALUES
('maxime', 1),
('paul', 3),
('clementV', 5),
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
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joue`
--

INSERT INTO `joue` (`id_partie`, `login`, `score`) VALUES
(1, 'yassine', 0),
(2, 'chakib', 0),
(2, 'lucasO', 0),
(2, 'root', 0),
(10, 'chakib', 0),
(10, 'root', 0),
(15, 'root', 0),
(16, 'chakib', 0),
(16, 'root', 0),
(17, 'root', 0),
(18, 'root', 0),
(19, 'lucasO', 0),
(19, 'root', 0),
(20, 'root', 0),
(21, 'root', 0),
(22, 'root', 0),
(23, 'root', 0),
(24, 'ayoub', 0),
(24, 'root', 0),
(25, 'chakib', 0),
(25, 'root', 0),
(26, 'root', 0),
(27, 'root', 0),
(28, 'root', 0),
(29, 'root', 0),
(30, 'root', 0),
(31, 'root', 0),
(31, 'yassine', 0),
(32, 'root', 0),
(33, 'root', 0),
(34, 'root', 0),
(35, 'root', 0),
(36, 'root', 0),
(37, 'root', 0),
(38, 'root', 0),
(40, 'root', 0),
(41, 'root', 0),
(42, 'clementD', 0),
(43, 'clementV', 0),
(43, 'root', 0),
(44, 'chakib', 0),
(44, 'root', 0),
(49, 'root', 0),
(64, 'root', 0),
(65, 'root', 0),
(80, 'root', 0),
(81, 'root', 0),
(82, 'root', 0);

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
  `ID_MAIN` int(11) NOT NULL,
  `LOGIN` char(15) NOT NULL,
  `ID_PARTIE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, 'axel', 2, NULL, NULL, NULL, NULL),
(10, 'root', 10, 1, 0, 1, '2017-04-14'),
(15, 'root', 2, 0, 0, 1, '2017-04-13'),
(16, 'root', 2, 1, 0, 1, '2017-04-13'),
(17, 'root', 2, 0, 0, 1, '2017-04-13'),
(18, 'root', 2, 0, 0, 1, '2017-04-13'),
(19, 'root', 2, 0, 0, 1, '2017-04-13'),
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
-- Structure de la table `rangee`
--

CREATE TABLE `rangee` (
  `NUM_RANGEE` int(11) NOT NULL,
  `ID_PARTIE` bigint(20) NOT NULL,
  `NB_BELIERS_RANGEE` smallint(6) DEFAULT NULL,
  `valeur_derniere_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `se_compose_de`
--

CREATE TABLE `se_compose_de` (
  `ID_MAIN` int(11) NOT NULL,
  `NUM_CARTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`NUM_CARTE`);

--
-- Index pour la table `est_invite_a`
--
ALTER TABLE `est_invite_a`
  ADD PRIMARY KEY (`login`,`id_partie`),
  ADD KEY `FK_EST_INVITE_A2` (`id_partie`);

--
-- Index pour la table `joue`
--
ALTER TABLE `joue`
  ADD PRIMARY KEY (`id_partie`,`login`),
  ADD KEY `FK_JOUE2` (`login`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`ID_MAIN`),
  ADD KEY `FK_POSSEDE` (`LOGIN`),
  ADD KEY `FK_EST_DANS` (`ID_PARTIE`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`id_partie`),
  ADD KEY `FK_CREE` (`id_createur`);

--
-- Index pour la table `rangee`
--
ALTER TABLE `rangee`
  ADD PRIMARY KEY (`NUM_RANGEE`),
  ADD KEY `FK_EST_DANS` (`ID_PARTIE`);

--
-- Index pour la table `se_compose_de`
--
ALTER TABLE `se_compose_de`
  ADD PRIMARY KEY (`ID_MAIN`,`NUM_CARTE`),
  ADD UNIQUE KEY `SE_COMPOSE_DE_PK` (`ID_MAIN`,`NUM_CARTE`),
  ADD KEY `FK_SE_COMPOSE_DE2` (`NUM_CARTE`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `id_partie` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `est_invite_a`
--
ALTER TABLE `est_invite_a`
  ADD CONSTRAINT `FK_EST_INVITE_A` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EST_INVITE_A2` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `joue`
--
ALTER TABLE `joue`
  ADD CONSTRAINT `FK_JOUE` FOREIGN KEY (`id_partie`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_JOUE2` FOREIGN KEY (`login`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `FK_EST_DANS` FOREIGN KEY (`ID_PARTIE`) REFERENCES `partie` (`id_partie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_POSSEDE` FOREIGN KEY (`LOGIN`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `FK_CREE` FOREIGN KEY (`id_createur`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `se_compose_de`
--
ALTER TABLE `se_compose_de`
  ADD CONSTRAINT `FK_SE_COMPOSE_DE` FOREIGN KEY (`ID_MAIN`) REFERENCES `main` (`ID_MAIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SE_COMPOSE_DE2` FOREIGN KEY (`NUM_CARTE`) REFERENCES `carte` (`NUM_CARTE`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
