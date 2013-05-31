-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 31 Mai 2013 à 14:06
-- Version du serveur: 5.5.9
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `junior_entreprise`
--
CREATE DATABASE `junior_entreprise` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `junior_entreprise`;

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

--
-- Contenu de la table `accompte`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `cra`
--

INSERT INTO `cra` VALUES(1, 7, 7, '0000-00-00', 7, '0000-00-00');
INSERT INTO `cra` VALUES(2, 5, 4, '0000-00-00', 7, '0000-00-00');
INSERT INTO `cra` VALUES(4, 9, 7, '2013-05-13', 5, '2013-05-17');
INSERT INTO `cra` VALUES(5, 4, 3, '2013-05-01', 4, '2013-05-07');
INSERT INTO `cra` VALUES(6, 5, 7, '2013-05-09', 5, '2013-05-16');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `noEnts` int(11) NOT NULL AUTO_INCREMENT,
  `nomEnts` varchar(20) NOT NULL,
  `adresseEnts` varchar(40) NOT NULL,
  `telEnts` int(11) NOT NULL,
  PRIMARY KEY (`noEnts`),
  UNIQUE KEY `noEnts` (`noEnts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='table entreprise (1 -> 1..* convention)' AUTO_INCREMENT=4 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` VALUES(1, 'ents1', 'adrents1', 411);
INSERT INTO `entreprise` VALUES(2, 'ents2', 'adrents2', 422);
INSERT INTO `entreprise` VALUES(3, 'Entreprise success', '8 rue de la carriere', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` VALUES(1, 4, 4);
INSERT INTO `equipe` VALUES(2, 4, 3);
INSERT INTO `equipe` VALUES(3, 4, 8);
INSERT INTO `equipe` VALUES(4, 10, 7);

-- --------------------------------------------------------

--
-- Structure de la table `etude`
--

CREATE TABLE `etude` (
  `noEtude` int(11) NOT NULL AUTO_INCREMENT,
  `noEnts` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `duree` int(11) NOT NULL,
  `dateFin` date NOT NULL,
  `prixJournee` int(11) NOT NULL,
  `convention` varchar(40) NOT NULL,
  PRIMARY KEY (`noEtude`),
  UNIQUE KEY `noEtude` (`noEtude`),
  KEY `noEnts` (`noEnts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `etude`
--

INSERT INTO `etude` VALUES(3, 1, '2013-04-01', 10, '2013-04-10', 180, 'Logiciel gestion salaires');
INSERT INTO `etude` VALUES(4, 2, '2013-04-10', 12, '2013-04-03', 150, 'Consulting systeme gestion base de donne');
INSERT INTO `etude` VALUES(7, 1, '0000-00-00', 10, '0000-00-00', 200, 'pilotage arrosage automatique');
INSERT INTO `etude` VALUES(8, 3, '0000-00-00', 25, '0000-00-00', 220, 'dev plugin outlook');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `noEtudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nomEtudiant` varchar(11) NOT NULL,
  `adresseEtudiant` varchar(11) NOT NULL,
  `noSecu` int(11) NOT NULL,
  PRIMARY KEY (`noEtudiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` VALUES(4, 'marcel jean', '3 rue grand', 1111111);
INSERT INTO `etudiant` VALUES(5, 'etu2', 'adreetu2', 122);
INSERT INTO `etudiant` VALUES(6, 'etu3', '3 rue du ch', 333);
INSERT INTO `etudiant` VALUES(7, 'etu4', '4 rue du pl', 444);
INSERT INTO `etudiant` VALUES(8, 'etu4', '4 rue du pl', 444);
INSERT INTO `etudiant` VALUES(9, 'etu5', '5 rue de la', 555);
INSERT INTO `etudiant` VALUES(10, 'guillaume', '3 rue de la', 1820572);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `facture`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` VALUES(1, '0000-00-00', 0, 0, 0, 4, 3);
INSERT INTO `frais` VALUES(2, '0000-00-00', 0, 0, 0, 4, 3);
INSERT INTO `frais` VALUES(3, '0000-00-00', 10, 0, 0, 5, 3);
INSERT INTO `frais` VALUES(6, '0000-00-00', 50, 230, 55, 7, 4);
INSERT INTO `frais` VALUES(7, '0000-00-00', 34, 87, 23, 6, 3);
INSERT INTO `frais` VALUES(8, '2013-05-23', 50, 50, 50, 9, 3);
INSERT INTO `frais` VALUES(9, '2013-05-25', 22, 22, 22, 5, 7);

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

INSERT INTO `indemnites` VALUES(1, '2013-04-02', 10, 45, 4, 3);
INSERT INTO `indemnites` VALUES(2, '2013-05-23', 2, 100, 6, 4);
INSERT INTO `indemnites` VALUES(6, '2013-05-27', 7, 77, 4, 7);
INSERT INTO `indemnites` VALUES(7, '2013-05-24', 4, 44, 4, 4);
INSERT INTO `indemnites` VALUES(8, '2013-05-17', 17, 117, 4, 7);
INSERT INTO `indemnites` VALUES(9, '2013-05-03', 30, 300, 4, 3);
INSERT INTO `indemnites` VALUES(10, '2013-05-14', 1, 29, 5, 4);
INSERT INTO `indemnites` VALUES(12, '2013-05-11', 2, 60, 5, 7);

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

INSERT INTO `participant` VALUES(1, 5);
INSERT INTO `participant` VALUES(4, 5);
INSERT INTO `participant` VALUES(4, 6);
INSERT INTO `participant` VALUES(4, 7);
INSERT INTO `participant` VALUES(4, 9);
INSERT INTO `participant` VALUES(1, 4);
INSERT INTO `participant` VALUES(1, 8);
INSERT INTO `participant` VALUES(3, 4);
INSERT INTO `participant` VALUES(3, 6);
INSERT INTO `participant` VALUES(3, 10);

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
-- Contenu de la table `remboursement`
--


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

