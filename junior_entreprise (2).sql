-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2013 at 09:01 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `junior_entreprise`
--

-- --------------------------------------------------------

--
-- Table structure for table `accompte`
--

CREATE TABLE IF NOT EXISTS `accompte` (
  `noAccompte` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  PRIMARY KEY (`noAccompte`),
  KEY `noEtudiant` (`noEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `noEnts` int(11) NOT NULL AUTO_INCREMENT,
  `nomEnts` varchar(20) NOT NULL,
  `adresseEnts` varchar(40) NOT NULL,
  `telEnts` int(11) NOT NULL,
  PRIMARY KEY (`noEnts`),
  UNIQUE KEY `noEnts` (`noEnts`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='table entreprise (1 -> 1..* convention)' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`noEnts`, `nomEnts`, `adresseEnts`, `telEnts`) VALUES
(1, 'ents1', 'adrents1', 411),
(2, 'ents2', 'adrents2', 422);

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `noEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `noResp` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noEquipe`),
  KEY `noResp` (`noResp`),
  KEY `noResp_2` (`noResp`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`noEquipe`, `noResp`, `noEtude`) VALUES
(1, 4, 3),
(2, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `etude`
--

CREATE TABLE IF NOT EXISTS `etude` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `etude`
--

INSERT INTO `etude` (`noEtude`, `noEnts`, `dateDebut`, `duree`, `dateFin`, `prixJournee`, `convention`) VALUES
(3, 1, '2013-04-01', 10, '2013-04-10', 10, 'pouet the world'),
(4, 2, '2013-04-10', 12, '2013-04-03', 10, 'haha');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `noEtudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nomEtudiant` varchar(11) NOT NULL,
  `adresseEtudiant` varchar(11) NOT NULL,
  `noSecu` int(11) NOT NULL,
  PRIMARY KEY (`noEtudiant`),
  UNIQUE KEY `noEtudiant` (`noEtudiant`),
  KEY `noEtudiant_2` (`noEtudiant`),
  KEY `noEtudiant_3` (`noEtudiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`noEtudiant`, `nomEtudiant`, `adresseEtudiant`, `noSecu`) VALUES
(4, 'etu1', 'adretu1', 111),
(5, 'etu2', 'adreetu2', 122);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `noFacture` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noFacture`),
  KEY `noFacture` (`noFacture`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `frais`
--

CREATE TABLE IF NOT EXISTS `frais` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `frais`
--

INSERT INTO `frais` (`noFrais`, `date`, `montDep`, `montSejour`, `montAutre`, `noEtudiant`, `noEtude`) VALUES
(1, '0000-00-00', 0, 0, 0, 4, 3),
(2, '0000-00-00', 0, 0, 0, 4, 3),
(3, '0000-00-00', 10, 0, 0, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `indemnites`
--

CREATE TABLE IF NOT EXISTS `indemnites` (
  `noIndemnite` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `nbJourEtude` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `noEtudiant` int(11) NOT NULL,
  `noEtude` int(11) NOT NULL,
  PRIMARY KEY (`noIndemnite`),
  KEY `noEtudiant` (`noEtudiant`),
  KEY `noEtude` (`noEtude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `indemnites`
--

INSERT INTO `indemnites` (`noIndemnite`, `date`, `nbJourEtude`, `montant`, `noEtudiant`, `noEtude`) VALUES
(1, '2013-04-02', 10, 45, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
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
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`noEquipe`, `noEtudiant`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `remboursement`
--

CREATE TABLE IF NOT EXISTS `remboursement` (
  `noRemboursement` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `montant` int(11) NOT NULL,
  `noFrais` int(11) NOT NULL,
  PRIMARY KEY (`noRemboursement`),
  KEY `noEtudiant` (`noFrais`),
  KEY `noFrais` (`noFrais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accompte`
--
ALTER TABLE `accompte`
  ADD CONSTRAINT `accompte_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`);

--
-- Constraints for table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_2` FOREIGN KEY (`noResp`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `equipe_ibfk_3` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Constraints for table `etude`
--
ALTER TABLE `etude`
  ADD CONSTRAINT `etude_ibfk_1` FOREIGN KEY (`noEnts`) REFERENCES `entreprise` (`noEnts`);

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Constraints for table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `frais_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `frais_ibfk_2` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Constraints for table `indemnites`
--
ALTER TABLE `indemnites`
  ADD CONSTRAINT `indemnites_ibfk_1` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`),
  ADD CONSTRAINT `indemnites_ibfk_2` FOREIGN KEY (`noEtude`) REFERENCES `etude` (`noEtude`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`noEquipe`) REFERENCES `equipe` (`noEquipe`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`noEtudiant`) REFERENCES `etudiant` (`noEtudiant`);

--
-- Constraints for table `remboursement`
--
ALTER TABLE `remboursement`
  ADD CONSTRAINT `remboursement_ibfk_2` FOREIGN KEY (`noFrais`) REFERENCES `frais` (`noFrais`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
