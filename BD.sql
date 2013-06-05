-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 05 Juin 2013 à 23:21
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `junior_entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompte`
--

CREATE TABLE `accompte` (
  `noAccompte` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  PRIMARY KEY (`noAccompte`),
  KEY `noEtudiant` (`noEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cra`
--

CREATE TABLE `cra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noEtudiant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `duree` int(11) NOT NULL,
  `dateFin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `noEtudiant` (`noEtudiant`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `cra`
--

INSERT INTO `cra` (`id`, `noEtudiant`, `noEtude`, `dateDebut`, `duree`, `dateFin`) VALUES
(1, 7, 7, '0000-00-00', 7, '0000-00-00'),
(2, 5, 4, '0000-00-00', 7, '0000-00-00'),
(4, 9, 7, '2013-05-13', 5, '2013-05-17'),
(5, 4, 3, '2013-05-01', 4, '2013-05-07'),
(6, 5, 7, '2013-05-09', 5, '2013-05-16'),
(7, 10, 8, '2013-06-03', 5, '2013-06-07'),
(8, 4, 7, '2013-05-06', 20, '2013-05-31'),
(9, 4, 4, '2013-04-15', 15, '2013-05-03');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `noEnts` int(255) NOT NULL AUTO_INCREMENT,
  `nomEnts` varchar(20) NOT NULL,
  `adresseEnts` varchar(40) NOT NULL,
  `telEnts` varchar(15) NOT NULL,
  PRIMARY KEY (`noEnts`),
  UNIQUE KEY `noEnts` (`noEnts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='table entreprise (1 -> 1..* convention)' AUTO_INCREMENT=10 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`noEnts`, `nomEnts`, `adresseEnts`, `telEnts`) VALUES
(1, 'ents1', 'adrents1', '411'),
(2, 'ents2', 'adrents2', '422'),
(3, 'Entreprise success', '8 rue de la carriere', '1'),
(4, 'soullard&moula', '18 rue de la bourbe', '+33682456790'),
(8, 'google', '15 rue de la technologie', '+33745238765'),
(9, 'samsung', '3 rue des innovations', '0645234165');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE `equipe` (
  `noEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `noResp` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noEquipe`),
  KEY `noResp` (`noResp`),
  KEY `noResp_2` (`noResp`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`noEquipe`, `noResp`, `noEtude`) VALUES
(1, 4, 4),
(2, 4, 3),
(3, 4, 8),
(4, 10, 7),
(6, 10, 9),
(8, 6, 11);

-- --------------------------------------------------------

--
-- Structure de la table `etude`
--

CREATE TABLE `etude` (
  `noEtude` int(11) NOT NULL AUTO_INCREMENT,
  `noEnts` int(11) NOT NULL,
  `dateDebut` varchar(80) NOT NULL,
  `duree` int(11) NOT NULL,
  `dateFin` date NOT NULL,
  `prixJournee` int(11) NOT NULL,
  `convention` varchar(40) NOT NULL,
  `statut` tinyint(4) NOT NULL,
  PRIMARY KEY (`noEtude`),
  UNIQUE KEY `noEtude` (`noEtude`),
  KEY `noEnts` (`noEnts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `etude`
--

INSERT INTO `etude` (`noEtude`, `noEnts`, `dateDebut`, `duree`, `dateFin`, `prixJournee`, `convention`, `statut`) VALUES
(3, 1, '2013-04-01', 10, '2013-04-10', 180, 'Logiciel gestion salaires', 1),
(4, 2, '2013-04-10', 12, '2013-04-03', 150, 'Consulting systeme gestion base de donne', 1),
(7, 1, '0000-00-00', 10, '0000-00-00', 200, 'pilotage arrosage automatique', 0),
(8, 3, '0000-00-00', 25, '0000-00-00', 220, 'dev plugin outlook', 0),
(9, 4, '0000-00-00', 18, '0000-00-00', 0, 'systÃ¨me automatique ', 1),
(11, 8, '2013-06-10', 5, '2013-06-14', 0, 'dÃ©velppement appli android', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `noEtudiant` int(255) NOT NULL AUTO_INCREMENT,
  `nomEtudiant` varchar(11) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `adresseEtudiant` varchar(150) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `noSecu` int(11) NOT NULL,
  PRIMARY KEY (`noEtudiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`noEtudiant`, `nomEtudiant`, `adresseEtudiant`, `noSecu`) VALUES
(4, 'Charles', '3 rue grandchemin', 1111111),
(5, 'rene', '29 place de la fontaine', 672829),
(6, 'francois', '3 rue du chien fidèle', 333),
(7, 'paul', '4 rue du plat', 444),
(8, 'luc', '3 impasse de la bourbe', 67983),
(9, 'Claude', '5 rue de la colline', 555),
(10, 'guillaume', '3 rue de la baraudière', 1820572),
(12, 'remi', '1 rue montagne qui gagne', 5436710),
(13, 'Alphonse', '', 4321),
(14, 'pauline', '4 rue de la mer', 78005672),
(15, 'emilie', '5 rue des angevins', 0);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `noFacture` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noFacture`),
  KEY `noFacture` (`noFacture`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`noFacture`, `date`, `montant`, `noEtude`) VALUES
(1, '0000-00-00', 3086, 3),
(2, '0000-00-00', 2571, 4),
(3, '0000-00-00', 12, 9);

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE `frais` (
  `noFrais` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montDep` int(11) NOT NULL,
  `montSejour` int(11) NOT NULL,
  `montAutre` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noFrais`),
  KEY `noEtudiant` (`noEtudiant`),
  KEY `noEtude` (`noEtude`),
  KEY `noFrais` (`noFrais`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`noFrais`, `date`, `montDep`, `montSejour`, `montAutre`, `noEtudiant`, `noEtude`) VALUES
(3, '0000-00-00', 10, 0, 0, 5, 3),
(6, '0000-00-00', 50, 230, 55, 7, 4),
(7, '0000-00-00', 34, 87, 23, 6, 3),
(8, '2013-05-23', 50, 50, 50, 9, 3),
(9, '2013-05-25', 22, 22, 22, 5, 7),
(10, '2013-06-05', 10, 0, 0, 15, 9),
(11, '0000-00-00', 153, 153, 153, 15, 3);

-- --------------------------------------------------------

--
-- Structure de la table `indemnites`
--

CREATE TABLE `indemnites` (
  `noIndemnite` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nbJourEtude` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noIndemnite`),
  KEY `noEtudiant` (`noEtudiant`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `indemnites`
--

INSERT INTO `indemnites` (`noIndemnite`, `date`, `nbJourEtude`, `montant`, `noEtudiant`, `noEtude`) VALUES
(1, '2013-04-02', 10, 45, 4, 3),
(2, '2013-05-23', 2, 100, 6, 4),
(6, '2013-05-27', 7, 77, 4, 7),
(7, '2013-05-24', 4, 44, 4, 4),
(8, '2013-05-17', 17, 117, 4, 7),
(9, '2013-05-03', 30, 300, 4, 3),
(10, '2013-05-14', 1, 29, 5, 4),
(12, '2013-05-11', 2, 60, 5, 7);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `numero` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `icq` int(10) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `commentaires` varchar(200) NOT NULL,
  `question` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `domaine` varchar(200) NOT NULL,
  `navigateur` varchar(200) NOT NULL,
  `dateYMDheure` datetime NOT NULL,
  PRIMARY KEY (`numero`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `noEquipe` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  KEY `noEquipe` (`noEquipe`),
  KEY `noEtudiant` (`noEtudiant`),
  KEY `noEquipe_2` (`noEquipe`),
  KEY `noEtudiant_2` (`noEtudiant`),
  KEY `noEquipe_3` (`noEquipe`),
  KEY `noEtudiant_3` (`noEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`noEquipe`, `noEtudiant`) VALUES
(1, 5),
(4, 5),
(4, 6),
(4, 7),
(4, 9),
(1, 4),
(1, 8),
(3, 4),
(3, 6),
(3, 10),
(6, 9),
(6, 6),
(6, 6),
(8, 10),
(8, 15),
(4, 4),
(8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `remboursement`
--

CREATE TABLE `remboursement` (
  `noRemboursement` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` int(11) NOT NULL,
  `noFrais` int(11) NOT NULL,
  PRIMARY KEY (`noRemboursement`),
  KEY `noEtudiant` (`noFrais`),
  KEY `noFrais` (`noFrais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `accompte`
--
ALTER TABLE `accompte`
  ADD CONSTRAINT `accompte_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`);

--
-- Contraintes pour la table `cra`
--
ALTER TABLE `cra`
  ADD CONSTRAINT `cra_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `cra_ibfk_2` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`noResp`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `equipe_ibfk_3` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Contraintes pour la table `etude`
--
ALTER TABLE `etude`
  ADD CONSTRAINT `etude_ibfk_1` FOREIGN KEY (`noEnts`) REFERENCES `entreprise` (`noEnts`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `frais_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `frais_ibfk_2` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Contraintes pour la table `indemnites`
--
ALTER TABLE `indemnites`
  ADD CONSTRAINT `indemnites_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `indemnites_ibfk_2` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Contraintes pour la table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`noEquipe`) REFERENCES `equipe` (`noEquipe`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`);

--
-- Contraintes pour la table `remboursement`
--
ALTER TABLE `remboursement`
  ADD CONSTRAINT `remboursement_ibfk_2` FOREIGN KEY (`noFrais`) REFERENCES `frais` (`noFrais`);

