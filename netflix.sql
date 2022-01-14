-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 jan. 2022 à 15:24
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `netflix`
--
CREATE DATABASE IF NOT EXISTS `netflix` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `netflix`;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` mediumtext NOT NULL,
  `questionUser` longtext NOT NULL,
  `id_user` int(11) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `titre`, `questionUser`, `id_user`, `createDate`) VALUES
(7, 'srgqsrgsrtg', 'dfgsdfgsdfg', 8, '2021-11-18 12:06:20'),
(8, 'Probleme de connexion', 'gf&quot;gahah&quot;(', 8, '2021-11-18 12:16:21'),
(9, 'afeafaefaefa', 'affaeafeaefaefaefeafeaf', 8, '2021-11-18 13:46:59'),
(10, 'Probleme de connexion', 'J\'en ai marre Ã§a marche quand Ã§a veut xD', 8, '2021-11-18 14:13:44'),
(11, 'Pas d\'insulte ici', 'Ben si hahahaha!', 8, '2021-11-18 14:40:04'),
(12, 'J\'ai dit', 'je ferai', 8, '2021-11-18 14:44:57'),
(15, 'OUPS', 'Mince alors', 6, '2021-11-18 15:38:28'),
(16, 'C\'est Genial', 'Comment je fais pour garder l\'id de la question afin de pouvoir rÃ©pondre\r\n ', 6, '2021-11-18 16:25:16'),
(17, 'ProblÃ¨me de Stream', 'Je n\'arrive plus Ã  voir mes series prefere', 6, '2021-11-19 08:49:56'),
(18, 'C\'est cool bientot fini', 'Est ce que Ã§a marche', 6, '2022-01-12 18:21:44'),
(19, 'Derniere ligne droite', 'Attention ', 6, '2022-01-13 15:58:43');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reponseUser` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `createDateAnswer` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`) USING BTREE,
  KEY `id_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `reponseUser`, `user_id`, `article_id`, `createDateAnswer`) VALUES
(1, 'Youpla boom', 9, 17, '2021-11-19 12:27:19'),
(5, 'Merciiiiiiiiiiiiiiiiiii pour la saloution', 9, 17, '2021-11-19 12:34:30'),
(11, 'Bonjour j\'ai peut Ãªtre ta rÃ©ponse', 6, 17, '2021-11-19 14:22:37'),
(12, 'zrzegzeggzezzeggze', 6, 12, '2021-11-19 14:23:28'),
(13, 'Je suis un debrouillard\r\n', 6, 10, '2021-11-19 14:24:42'),
(14, 'opizgjzirjpizgjz\r\n', 6, 7, '2021-11-19 14:31:10'),
(15, 'C\'est cool', 6, 17, '2022-01-13 11:48:10'),
(16, 'Normalement OUi enfin je pense', 6, 18, '2022-01-13 12:02:12'),
(17, 'LÃ  fin est lÃ  je pense', 6, 18, '2022-01-13 15:51:17'),
(18, 'si je rÃ©pond cela s\'affiche direct', 6, 18, '2022-01-13 15:57:24'),
(19, 'Peut Ãªtre la solution', 6, 19, '2022-01-13 16:02:10'),
(20, 'Oui bientÃ´t', 6, 18, '2022-01-13 16:02:34'),
(21, 'OUi je crois que oui', 6, 19, '2022-01-13 16:47:51');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `secret` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blocked` int(11) NOT NULL DEFAULT '0',
  `isAdmin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pseudo`, `password`, `secret`, `creation_date`, `blocked`, `isAdmin`) VALUES
(2, 'test@test.fr', 'TEST', '0cecd389a35d1e33659f57dd6c667c07cf8d774b9e715ed9892ac4a7d95bfea7', '87e526044512b4e98ab4f7bd025ed0d6cf039cbe1637051585', '2021-11-16 09:33:05', 0, 0),
(6, 'azerty@test.fr', 'Azerty', 'c938977792f56771a3fd8b8598b63a1e5440feb532e4e1b1f6bfff720253cc53', '8b3dd0249ffebea0e31bd7e8467fc232e386a3561637148549', '2021-11-17 12:29:09', 0, 1),
(8, 'jklm@test.fr', 'JK', '6f40b9b41de1300b20947b9414a75ce14354b821756f81cd799c94b7c964efb1', 'af3f283b141322beed238def4b56f8f0420dc8011637224305', '2021-11-18 09:31:45', 0, 0),
(9, 'berangere@test.fr', 'BÃ©bÃ©', 'c938977792f56771a3fd8b8598b63a1e5440feb532e4e1b1f6bfff720253cc53', 'c348171373221713ca5ce67dbc00aace32a7a4451637320143', '2021-11-19 12:09:03', 0, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`article_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
