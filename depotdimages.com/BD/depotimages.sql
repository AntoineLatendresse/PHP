-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 26 Novembre 2015 à 19:13
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `depotimages`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PASSWORD`(IN `PUSERNAME` VARCHAR(25))
    NO SQL
BEGIN
	SELECT Pass_word FROM utilisateurs WHERE Username = PUSERNAME;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_USER`(IN `PUSERNAME` VARCHAR(25))
    NO SQL
BEGIN
  SELECT Username, Pass_word, FirstName, LastName FROM utilisateurs WHERE Username = PUSERNAME;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PROFIL`(IN `PNOUTILISATEUR` INT(11), IN `PUSERNAME` VARCHAR(25), IN `PNEWPASSWORD` VARCHAR(25), IN `PFIRSTNAME` VARCHAR(25), IN `PLASTNAME` VARCHAR(25))
    NO SQL
BEGIN
    UPDATE utilisateurs
    SET Username = PUSERNAME,
    	Pass_word = PNEWPASSWORD,
        FirstName = PFIRSTNAME,
        LastName = PLASTNAME
    WHERE NoUtilisateur = PNOUTILISATEUR;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `NoUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(25) NOT NULL,
  `Pass_word` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  PRIMARY KEY (`NoUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`NoUtilisateur`, `Username`, `Pass_word`, `FirstName`, `LastName`) VALUES
(1, 'Admin', 'Admin', 'Antoine', 'Latendresse');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
