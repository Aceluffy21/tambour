-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 09 avr. 2020 à 17:34
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `tambour`
--

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `touche` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `instrument`
--

INSERT INTO `instrument` (`id`, `nom`, `icon`, `touche`, `audio`) VALUES
(1, 'Cymbale', 'crash', 'c', 'crash.mp3'),
(2, 'Caisse claire', 'snare', 's', 'snare.mp3'),
(3, 'Tambour 1', 'tom1', 't', 'tom-1.mp3'),
(4, 'Tambour 2', 'tom2', 'y', 'tom-2.mp3'),
(5, 'Tambour 3', 'tom3', 'u', 'tom-3.mp3'),
(6, 'Tambour 4', 'tom4', 'i', 'tom-4.mp3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `instrument`
--
ALTER TABLE `instrument`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `instrument`
--
ALTER TABLE `instrument`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
