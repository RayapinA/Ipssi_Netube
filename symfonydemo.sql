-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le :  Dim 27 jan. 2019 à 16:27
-- Version du serveur :  8.0.13
-- Version de PHP :  7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfonydemo`
--
CREATE DATABASE IF NOT EXISTS `symfonydemo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `symfonydemo`;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `description`, `name`) VALUES
(1, 'Le rire est contagieux', 'Humour'),
(2, 'Il s agit de la category Action', 'Action');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `birthday`, `email`, `roles`, `password`) VALUES
(1, 'FirstName', 'Lastname', '2014-01-01 00:00:00', 'email@email.com', 'ROLE_USER', '$2y$13$ZM02UhDEOAQ2mivq1q.hMuEtPN0MKdnvBFJoaMhFfXsTFfo..Wl2C'),
(2, 'FirstName', 'Lastname', '2014-01-01 00:00:00', 'email@email.coma', 'ROLE_USER', '$2y$13$nZH/jGfXUT44ihItwa4La.YJp5Pw2jVOWKNfAYzuQgFqa6dlvgGHS'),
(3, 'Antoine', 'Antoine', '2014-01-01 00:00:00', 'antoine@gmail.com', 'ROLE_USER', '$2y$13$WM7jcAS.Iq5zU9DeV57Kd.iyb1pmH.05bWC6NPuZfOX567GbukmKy'),
(4, 'FirstName_Admin', 'LastName_Admin', NULL, 'admin@admin.com', 'ROLE_USER,ROLE_ADMIN', '$2y$13$0qch8UBWbGB2xFBc3uI/De3/RDYW7R9tLR...WrAiYHOLativEdXW'),
(5, 'Bloggeur', 'Fou', '2014-01-01 00:00:00', 'Bloggeur@fou.net', 'ROLE_USER', '$2y$13$CB2VbJw.YPoAEoWxWmORFu3cC4wCsXUSFesFeCTqOQX0jXw2HCrxi'),
(6, 'aaa', 'aaa', '2014-01-01 00:00:00', 'email@email.co', 'ROLE_USER', '$2y$13$q8CJ22CIUq0vejm2a/go2uQPHdRLXWHwN..U.7Uwfj0uQoKMIXKS2');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `nb_views` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `id_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `title`, `url`, `description`, `created_at`, `nb_views`, `published`, `category_id`, `user_id`, `id_youtube`) VALUES
(1, 'Unpublished', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la premiere video', '2019-01-11 14:10:08', 1, 0, 1, 3, NULL),
(2, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:17:04', 1, 1, 2, 3, NULL),
(3, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:17:41', 1, 1, 1, 4, NULL),
(4, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:23:48', 1, 1, 1, 4, NULL),
(5, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:24:34', 1, 1, 1, 3, NULL),
(6, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:31:49', NULL, 1, 2, 2, NULL),
(7, 'La deuxième vidéo', 'https://www.youtube.com/embed/7B0hhelht9Q', 'Il s\'agit de la deuxieme video', '2019-01-11 14:32:08', NULL, 1, 1, 3, NULL),
(8, 'Test', 'https://www.yout.com/embed/7B0hhelht9Q', 'Niska', '2019-01-22 23:35:37', NULL, 1, 2, 2, NULL),
(21, 'ffzfz', 'https://www.youtube.com/embed/JctVyGslOtw', 'fffff', '2019-01-27 13:02:43', NULL, 1, 1, 3, NULL),
(22, 'y traaaez', 'https://www.youtube.com/embed/JctVyGslOtw', 'flashaddmesasag', '2019-01-27 13:15:19', NULL, 1, 1, 3, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CC7DA2C12469DE2` (`category_id`),
  ADD KEY `IDX_7CC7DA2CA76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_7CC7DA2CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
