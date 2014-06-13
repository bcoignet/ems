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

--
-- Contenu de la table `courses`
--

INSERT INTO `courses` (`id`, `nom`, `ville`, `organisation`, `date_debut`, `heure_debut`, `date_fin`, `heure_fin`, `moto_demande`, `type_course`, `defraiement`, `distance`, `nb_coureurs`, `statut`, `visibilite`, `date_creation`, `date_maj`) VALUES
(1, 'Triathlon Salagou', '-1', '-1', '2014-06-07', '08:00', '2014-06-07', '17:00', 4, 'Triathlon', '-1', '-1', '850', '-1', 'tous', '2014-06-06 11:05:01', '0000-00-00 00:00:00');

--
-- Contenu de la table `disponibilites_courses`
--

INSERT INTO `disponibilites_courses` (`id_membre`, `id_course`, `reponse`, `date_maj`, `date_creation`) VALUES
(1, 1, 'non', '2014-06-06 11:08:38', '2014-06-06 11:07:56'),
(2, 1, 'non', '0000-00-00 00:00:00', '2014-06-06 11:08:24');

--
-- Contenu de la table `disponibilites_sorties`
--


--
-- Contenu de la table `documenter_courses`
--


--
-- Contenu de la table `documenter_sorties`
--


--
-- Contenu de la table `documents`
--


--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `nom_moto`, `marque_moto`, `type_moto`, `role_asso`, `date_naissance`, `photo`, `sexe`, `type_membre`, `date_creation`, `date_maj`) VALUES
(1, 'Coignet', 'Benjamin', '500 cbf 2004', 'Honda', 'Roadster', 'Webmaster', '1986-10-24', '', 'm', 'Motard', '2014-06-06 00:00:00', '2014-06-06 10:45:26'),
(2, 'Jédrowiak', 'Jérôme', '1150 rt', 'BMW', 'Routière', 'Responsable communication', '1970-01-01', '', 'm', 'Motard', '2014-06-06 00:00:00', '2014-06-06 17:12:30'),
(3, 'Philippot', 'Xavier', '', '', '', 'Secrétaire', '1970-01-01', '', 'm', 'Motard', '2014-06-06 00:00:00', '2014-06-06 00:00:00'),
(4, 'Blaise', 'Philippe', 'k1600 GTL', 'BMW', 'Routière', 'Président', '1970-01-01', '', 'm', 'Motard', '2014-06-06 00:00:00', '2014-06-06 00:00:00'),
(5, 'Blaise', 'Laurence', '', '', '', 'Trésorière', '1970-01-01', '', 'f', 'Piéton', '2014-06-06 00:00:00', '2014-06-06 00:00:00');

--
-- Contenu de la table `participations_courses`
--

INSERT INTO `participations_courses` (`id_membre`, `id_course`, `date_creation`) VALUES
(1, 1, '2014-06-06 11:09:28');

--
-- Contenu de la table `participations_sortie`
--


--
-- Contenu de la table `sorties`
--


--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom_utilisateur`, `mot_de_passe`, `adresse_email`, `hash_validation`, `date_inscription`, `avatar`, `nom`, `prenom`, `mobile`, `fixe`, `code_postal`, `ville`, `rue`, `batiment`, `complement`, `statut`, `membre_rattache`, `date_creation`, `date_maj`, `grade`) VALUES
(1, 'bcoignet', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'benjamin.coignet@gmail.com', '78cv34', '2014-06-06', '', 'Coignet', 'Benjamin', '0603451796', '', '34980', 'St clément de Rivière', '122 rue des chardonnerets', '', '', '', 1, '2014-06-06 00:00:00', '2014-06-06 16:09:09', 1),
(3, 'jerome.j', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', '12cv96', '2014-06-06', '', 'Jedrowiak', 'Jérôme', '', '', '', 'Mauguio', '', '', '', '', 2, '2014-06-06 11:03:12', '2014-06-06 16:09:18', 10);
