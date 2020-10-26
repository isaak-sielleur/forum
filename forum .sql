-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 oct. 2020 à 13:50
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `id_conversation` int(11) NOT NULL AUTO_INCREMENT,
  `id_topics` varchar(255) NOT NULL,
  `id_createur` varchar(255) NOT NULL,
  `nom_conversation` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_conversation`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id_conversation`, `id_topics`, `id_createur`, `nom_conversation`, `date`) VALUES
(1, '3', '2', 'docteur who super', '2020-10-15 00:00:00'),
(2, '3', '2', 'deuxieme conv', '2020-10-15 00:00:00'),
(3, '3', '2', 'troisieme conv', '2020-10-15 00:00:00'),
(4, '4', '2', 'quatrieme conv', '2020-10-15 00:00:00'),
(5, '3', '2', 'test', '2020-10-19 15:05:16'),
(6, '4', '5', '5eme conv', '2020-10-19 16:58:38'),
(11, '4', '5', '7eme conv', '2020-10-20 12:14:48'),
(8, '4', '5', '6eme conv', '2020-10-19 17:01:05'),
(9, '4', '5', '7eme conv', '2020-10-19 17:35:22'),
(10, '4', '5', '5eme conv', '2020-10-19 17:49:50');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversations` varchar(255) NOT NULL,
  `id_createur` varchar(255) NOT NULL,
  `nom_message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_conversations`, `id_createur`, `nom_message`, `date`) VALUES
(37, '10', '5', 'bsoir ', '2020-10-22 17:35:39'),
(35, '11', '5', 'hey ', '2020-10-22 14:37:47'),
(36, '11', '5', 'hey ', '2020-10-22 14:38:25'),
(33, '6', '5', 'ouais', '2020-10-22 11:32:18'),
(34, '11', '5', 'hey ', '2020-10-22 14:37:32'),
(32, '6', '5', 'hey', '2020-10-22 11:32:04'),
(31, '4', '5', 'hello', '2020-10-22 11:29:14'),
(30, '9', '5', 'bonjour ', '2020-10-21 19:38:48'),
(29, '9', '5', 'bonjour ', '2020-10-21 19:38:09'),
(38, '4', '5', 'hey ca va \r\n', '2020-10-22 17:50:28');

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `acces` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id_topic`, `id_createur`, `name`, `date`, `acces`, `sujet`) VALUES
(3, '4', 'Saisons 1', '2020-10-01', 'tous', 'Il sajit d\'un essai'),
(4, '2', 'Saison 2', '2020-10-14', 'inscrits', 'oui c\'est bien oui ');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(2555) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status_compte` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `photo_profil`, `password`, `email`, `status_compte`) VALUES
(2, 'rouge', 'medias/image-profil/modo.png', 'ac2abdfc7238ffef58a06ab759e381e4d44867cdf8676781004ef6a398e5a6cf', 'bb@gmail.com', '3'),
(3, 'lune', 'medias/image-profil/admin.png', '$2y$10$4tvTfBXX9TbtbBxBzx2Mv.29OMa5iIv.4GUeOMsdMeuJSeoHsHX8W', 'cc', '1'),
(4, 'dd', 'medias/image-profil/admin.png', 'e852abbda64685746306b81af5b26f727c256f9eeb542709b463c7a04215e5c0', 'dd@gmail.com', '1'),
(5, 'Mike', '', 'be649229b1c598774bb940d72c2d4801fc2a537c4cb7a24ee2ac0a444ee1f1c5', 'ssss@hotmail.fr', '2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
