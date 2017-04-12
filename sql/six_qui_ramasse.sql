-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 12 Avril 2017 à 18:51
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
  `NUM_RANGEE` int(11) NOT NULL,
  `NB_BELIERS` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `est_invite_a`
--

CREATE TABLE `est_invite_a` (
  `LOGIN` char(15) NOT NULL,
  `ID_PARTIE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `joue`
--

CREATE TABLE `joue` (
  `ID_PARTIE` bigint(20) NOT NULL,
  `LOGIN` char(15) NOT NULL,
  `SCORE_PARTIE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `joue`
--

INSERT INTO `joue` (`ID_PARTIE`, `LOGIN`, `SCORE_PARTIE`) VALUES
(1, 'yassine', 10);

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
  `ID_PARTIE` bigint(20) NOT NULL,
  `ID_CREATEUR` char(15) NOT NULL,
  `NB_JOUEURS` smallint(6) DEFAULT NULL,
  `EST_COMMENCEE` tinyint(1) DEFAULT NULL,
  `PUBLIC` tinyint(1) DEFAULT NULL,
  `EST_TERMINEE` tinyint(1) DEFAULT NULL,
  `DATE_CREATION` datetime DEFAULT NULL,
  `typeDeJeux` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `partie`
--

INSERT INTO `partie` (`ID_PARTIE`, `ID_CREATEUR`, `NB_JOUEURS`, `EST_COMMENCEE`, `PUBLIC`, `EST_TERMINEE`, `DATE_CREATION`, `typeDeJeux`) VALUES
(1, 'yassine', 5, 1, 1, 0, '2017-03-13 00:00:00', 't001');

-- --------------------------------------------------------

--
-- Structure de la table `rangee`
--

CREATE TABLE `rangee` (
  `NUM_RANGEE` int(11) NOT NULL,
  `ID_PARTIE` bigint(20) NOT NULL,
  `NB_BELIERS_RANGEE` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `se_compose_de`
--

CREATE TABLE `se_compose_de` (
  `ID_MAIN` int(11) NOT NULL,
  `NUM_CARTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typesdejeux`
--

CREATE TABLE `typesdejeux` (
  `libelle` varchar(5) NOT NULL,
  `couleurFond` varchar(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typesdejeux`
--

INSERT INTO `typesdejeux` (`libelle`, `couleurFond`, `image`) VALUES
('t01', 'Vert', 'image01.png'),
('t02', 'Vert', 'image02.png'),
('t03', 'Bleu', 'image03.png'),
('t04', 'Violet', 'image02.png'),
('t05', 'Bleu', 'image03.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`NUM_CARTE`),
  ADD KEY `FK_APPARTIENT` (`NUM_RANGEE`);

--
-- Index pour la table `est_invite_a`
--
ALTER TABLE `est_invite_a`
  ADD PRIMARY KEY (`LOGIN`,`ID_PARTIE`),
  ADD KEY `FK_EST_INVITE_A2` (`ID_PARTIE`);

--
-- Index pour la table `joue`
--
ALTER TABLE `joue`
  ADD PRIMARY KEY (`ID_PARTIE`,`LOGIN`),
  ADD KEY `FK_JOUE2` (`LOGIN`);

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
  ADD KEY `FK_COMPOSE` (`ID_PARTIE`),
  ADD KEY `FK_POSSEDE` (`LOGIN`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`ID_PARTIE`),
  ADD KEY `FK_CREE` (`ID_CREATEUR`),
  ADD KEY `typeDeJeux` (`typeDeJeux`),
  ADD KEY `typeDeJeux_2` (`typeDeJeux`),
  ADD KEY `typeDeJeux_3` (`typeDeJeux`);

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
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `FK_APPARTIENT` FOREIGN KEY (`NUM_RANGEE`) REFERENCES `rangee` (`NUM_RANGEE`);

--
-- Contraintes pour la table `est_invite_a`
--
ALTER TABLE `est_invite_a`
  ADD CONSTRAINT `FK_EST_INVITE_A` FOREIGN KEY (`LOGIN`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EST_INVITE_A2` FOREIGN KEY (`ID_PARTIE`) REFERENCES `partie` (`ID_PARTIE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `joue`
--
ALTER TABLE `joue`
  ADD CONSTRAINT `FK_JOUE` FOREIGN KEY (`ID_PARTIE`) REFERENCES `partie` (`ID_PARTIE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_JOUE2` FOREIGN KEY (`LOGIN`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `main`
--
ALTER TABLE `main`
  ADD CONSTRAINT `FK_COMPOSE` FOREIGN KEY (`ID_PARTIE`) REFERENCES `partie` (`ID_PARTIE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_POSSEDE` FOREIGN KEY (`LOGIN`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `FK_CREE` FOREIGN KEY (`ID_CREATEUR`) REFERENCES `joueur` (`login`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `rangee`
--
ALTER TABLE `rangee`
  ADD CONSTRAINT `FK_EST_DANS` FOREIGN KEY (`ID_PARTIE`) REFERENCES `partie` (`ID_PARTIE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `se_compose_de`
--
ALTER TABLE `se_compose_de`
  ADD CONSTRAINT `FK_SE_COMPOSE_DE` FOREIGN KEY (`ID_MAIN`) REFERENCES `main` (`ID_MAIN`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SE_COMPOSE_DE2` FOREIGN KEY (`NUM_CARTE`) REFERENCES `carte` (`NUM_CARTE`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
