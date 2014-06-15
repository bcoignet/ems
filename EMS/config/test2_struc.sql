-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 06 Juin 2014 à 17:17
-- Version du serveur: 5.5.8
-- Version de PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `test2`
--

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `ville` varchar(32) NOT NULL DEFAULT '-1',
  `organisation` varchar(50) NOT NULL DEFAULT '-1',
  `date_debut` date NOT NULL,
  `heure_debut` char(5) NOT NULL DEFAULT '08:00',
  `date_fin` date NOT NULL,
  `heure_fin` char(5) NOT NULL DEFAULT '17:00',
  `moto_demande` int(3) NOT NULL DEFAULT '-1',
  `type_course` varchar(50) NOT NULL DEFAULT '-1',
  `defraiement` varchar(50) NOT NULL DEFAULT '-1',
  `distance` varchar(50) NOT NULL DEFAULT '-1',
  `nb_coureurs` varchar(50) NOT NULL DEFAULT '-1',
  `statut` varchar(50) NOT NULL DEFAULT '-1',
  `visibilite` varchar(50) NOT NULL DEFAULT 'tous',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Déclencheurs `courses`
--
DROP TRIGGER IF EXISTS `courses_update`;
DELIMITER //
CREATE TRIGGER `courses_update` BEFORE UPDATE ON `courses`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites_courses`
--

CREATE TABLE IF NOT EXISTS `disponibilites_courses` (
  `id_membre` int(10) unsigned NOT NULL,
  `id_course` int(10) unsigned NOT NULL,
  `reponse` varchar(50) NOT NULL,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`,`id_course`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `disponibilites_courses`
--
DROP TRIGGER IF EXISTS `disponibilites_courses_update`;
DELIMITER //
CREATE TRIGGER `disponibilites_courses_update` BEFORE UPDATE ON `disponibilites_courses`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites_sorties`
--

CREATE TABLE IF NOT EXISTS `disponibilites_sorties` (
  `id_membre` int(10) unsigned NOT NULL,
  `id_sortie` int(10) unsigned NOT NULL,
  `reponse` varchar(50) NOT NULL,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`,`id_sortie`),
  KEY `id_sortie` (`id_sortie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déclencheurs `disponibilites_sorties`
--
DROP TRIGGER IF EXISTS `disponibilites_sorties_update`;
DELIMITER //
CREATE TRIGGER `disponibilites_sorties_update` BEFORE UPDATE ON `disponibilites_sorties`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `documenter_courses`
--

CREATE TABLE IF NOT EXISTS `documenter_courses` (
  `id_document` int(10) unsigned NOT NULL,
  `id_course` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_document`,`id_course`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `documenter_sorties`
--

CREATE TABLE IF NOT EXISTS `documenter_sorties` (
  `id_document` int(10) unsigned NOT NULL,
  `id_sortie` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_document`,`id_sortie`),
  KEY `id_sortie` (`id_sortie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '-1',
  `chemin` varchar(50) NOT NULL,
  `proprietaire` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Déclencheurs `documents`
--
DROP TRIGGER IF EXISTS `documents_update`;
DELIMITER //
CREATE TRIGGER `documents_update` BEFORE UPDATE ON `documents`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `nom_moto` varchar(50) NOT NULL,
  `marque_moto` varchar(50) NOT NULL,
  `type_moto` varchar(50) NOT NULL,
  `role_asso` varchar(128) NOT NULL,
  `date_naissance` date NOT NULL,
  `photo` varchar(128) NOT NULL,
  `sexe` char(1) NOT NULL,
  `type_membre` varchar(50) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Déclencheurs `membres`
--
DROP TRIGGER IF EXISTS `membres_update`;
DELIMITER //
CREATE TRIGGER `membres_update` BEFORE UPDATE ON `membres`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `participations_courses`
--

CREATE TABLE IF NOT EXISTS `participations_courses` (
  `id_membre` int(10) unsigned NOT NULL,
  `id_course` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`,`id_course`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participations_sortie`
--

CREATE TABLE IF NOT EXISTS `participations_sortie` (
  `id_membre` int(10) unsigned NOT NULL,
  `id_sortie` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`,`id_sortie`),
  KEY `id_sortie` (`id_sortie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

CREATE TABLE IF NOT EXISTS `sorties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` varchar(50) NOT NULL DEFAULT '-1',
  `visibilite` varchar(50) NOT NULL DEFAULT 'tous',
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Déclencheurs `sorties`
--
DROP TRIGGER IF EXISTS `sorties_update`;
DELIMITER //
CREATE TRIGGER `sorties_update` BEFORE UPDATE ON `sorties`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(32) NOT NULL,
  `mot_de_passe` char(40) NOT NULL,
  `adresse_email` varchar(128) NOT NULL,
  `hash_validation` char(32) NOT NULL,
  `date_inscription` date NOT NULL,
  `avatar` varchar(128) NOT NULL DEFAULT '',
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mobile` char(10) NOT NULL,
  `fixe` char(10) NOT NULL,
  `code_postal` varchar(8) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `rue` varchar(128) NOT NULL,
  `batiment` varchar(100) NOT NULL,
  `complement` varchar(128) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `membre_rattache` int(10) unsigned NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `grade` int(3) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_utilisateur` (`nom_utilisateur`,`adresse_email`),
  KEY `mot_de_passe` (`mot_de_passe`),
  KEY `membre_rattache` (`membre_rattache`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Déclencheurs `utilisateurs`
--
DROP TRIGGER IF EXISTS `utilisateurs_update`;
DELIMITER //
CREATE TRIGGER `utilisateurs_update` BEFORE UPDATE ON `utilisateurs`
 FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END
//
DELIMITER ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `disponibilites_courses`
--
ALTER TABLE `disponibilites_courses`
  ADD CONSTRAINT `disponibilites_courses_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `disponibilites_courses_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`);

--
-- Contraintes pour la table `disponibilites_sorties`
--
ALTER TABLE `disponibilites_sorties`
  ADD CONSTRAINT `disponibilites_sorties_ibfk_1` FOREIGN KEY (`id_sortie`) REFERENCES `sorties` (`id`),
  ADD CONSTRAINT `disponibilites_sorties_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `documenter_courses`
--
ALTER TABLE `documenter_courses`
  ADD CONSTRAINT `documenter_courses_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `documents` (`id`),
  ADD CONSTRAINT `documenter_courses_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`);

--
-- Contraintes pour la table `documenter_sorties`
--
ALTER TABLE `documenter_sorties`
  ADD CONSTRAINT `documenter_sorties_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `documents` (`id`),
  ADD CONSTRAINT `documenter_sorties_ibfk_2` FOREIGN KEY (`id_sortie`) REFERENCES `sorties` (`id`);

--
-- Contraintes pour la table `participations_courses`
--
ALTER TABLE `participations_courses`
  ADD CONSTRAINT `participations_courses_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `participations_courses_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id`);

--
-- Contraintes pour la table `participations_sortie`
--
ALTER TABLE `participations_sortie`
  ADD CONSTRAINT `participations_sortie_ibfk_1` FOREIGN KEY (`id_sortie`) REFERENCES `sorties` (`id`),
  ADD CONSTRAINT `participations_sortie_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`membre_rattache`) REFERENCES `membres` (`id`);
