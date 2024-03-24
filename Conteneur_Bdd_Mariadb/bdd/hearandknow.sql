-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 172.18.0.2:3306
-- Généré le : dim. 24 mars 2024 à 00:18
-- Version du serveur : 10.6.17-MariaDB-1:10.6.17+maria~ubu2004
-- Version de PHP : 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hearandknow`
--

-- --------------------------------------------------------

--
-- Structure de la table `alertes`
--

CREATE TABLE `alertes` (
  `id_alerte` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` varchar(50) NOT NULL,
  `vu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contacts_urgence`
--

CREATE TABLE `contacts_urgence` (
  `id_contact` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `nom_contact` varchar(50) NOT NULL,
  `prenom_contact` varchar(50) NOT NULL,
  `numero_contact` varchar(10) NOT NULL,
  `id_telegram` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts_urgence`
--

INSERT INTO `contacts_urgence` (`id_contact`, `utilisateur_id`, `nom_contact`, `prenom_contact`, `numero_contact`, `id_telegram`) VALUES
(2, 1, 'Leroy', 'Julien', '0698765432', '@julienleroy'),
(3, 1, 'Moreau', 'Claire', '0645678901', '@clairemoreau'),
(16, 13, 'Verron', 'LIsa', '0638402738', 'lisaverron'),
(18, 15, 'paul', 'paul', '0689365425', '@paulhut');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_bouton` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `id_bouton`) VALUES
(1, 'Brigitte', 'Macron', 'hk@gmail.com', 'hk', 'FU3T23IgiAkIQ1489xFab4A4ibQRblh7S0OsqPLexY2cXTcFgi'),
(12, 'Suthan', 'Subina', 'subina.suthan@gmail.com', 'subina', '1906'),
(13, 'Verron', 'Raphael', 'raphael.verron@gmail.com', 'raph92', '4875FJDKH0'),
(15, 'enzo', 'lusardi', 'enzolus@gmail.com', '0568953698', 'kayak1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD PRIMARY KEY (`id_alerte`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `contacts_urgence`
--
ALTER TABLE `contacts_urgence`
  ADD PRIMARY KEY (`id_contact`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alertes`
--
ALTER TABLE `alertes`
  MODIFY `id_alerte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `contacts_urgence`
--
ALTER TABLE `contacts_urgence`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alertes`
--
ALTER TABLE `alertes`
  ADD CONSTRAINT `alertes_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `contacts_urgence`
--
ALTER TABLE `contacts_urgence`
  ADD CONSTRAINT `contacts_urgence_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
