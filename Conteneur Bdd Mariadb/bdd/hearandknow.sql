-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 172.18.0.2:3306
-- Généré le : jeu. 14 mars 2024 à 14:36
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

--
-- Déchargement des données de la table `alertes`
--

INSERT INTO `alertes` (`id_alerte`, `utilisateur_id`, `date`, `statut`, `vu`) VALUES
(1, 1, '2024-02-14 08:00:00', 'En cours', 1),
(2, 1, '2024-02-01 09:15:00', 'Résolu', 1),
(3, 1, '2024-02-05 10:30:00', 'Fausse alerte', 1),
(4, 1, '2024-02-15 11:45:00', 'En cours', 1),
(5, 1, '2024-02-17 13:00:00', 'En cours', 1),
(6, 1, '2024-03-12 01:31:31', 'En cours', 1),
(7, 1, '2024-03-12 01:35:53', 'En cours', 1),
(8, 1, '2024-03-12 01:42:13', 'En cours', 1),
(9, 1, '2024-03-12 01:42:19', 'En cours', 1),
(10, 1, '2024-03-12 01:42:21', 'En cours', 1),
(11, 1, '2024-03-12 01:42:21', 'En cours', 1),
(12, 1, '2024-03-12 01:42:21', 'En cours', 1),
(13, 1, '2024-03-12 01:42:22', 'En cours', 1),
(14, 1, '2024-03-12 01:42:23', 'En cours', 1),
(15, 1, '2024-03-12 01:42:24', 'En cours', 1),
(16, 1, '2024-03-12 01:42:24', 'En cours', 1),
(17, 1, '2024-03-12 01:42:24', 'En cours', 1),
(18, 1, '2024-03-12 01:42:24', 'En cours', 1),
(19, 1, '2024-03-12 01:42:29', 'En cours', 1),
(20, 1, '2024-03-12 01:42:29', 'En cours', 1),
(21, 1, '2024-03-12 01:42:30', 'En cours', 1),
(22, 1, '2024-03-12 01:42:30', 'En cours', 1),
(23, 1, '2024-03-12 01:42:30', 'En cours', 1),
(24, 1, '2024-03-12 01:42:30', 'En cours', 1),
(25, 1, '2024-03-12 01:42:33', 'En cours', 1),
(26, 1, '2024-03-12 01:42:33', 'En cours', 1),
(27, 1, '2024-03-12 01:42:33', 'En cours', 1),
(28, 1, '2024-03-12 01:42:33', 'En cours', 1),
(29, 1, '2024-03-12 01:42:34', 'En cours', 1),
(30, 1, '2024-03-12 01:42:38', 'En cours', 1),
(31, 1, '2024-03-12 01:42:38', 'En cours', 1),
(32, 1, '2024-03-12 01:42:38', 'En cours', 1),
(33, 1, '2024-03-12 01:42:38', 'En cours', 1),
(34, 1, '2024-03-12 01:42:38', 'En cours', 1),
(35, 1, '2024-03-12 01:42:39', 'En cours', 1),
(36, 1, '2024-03-12 01:42:39', 'En cours', 1),
(37, 1, '2024-03-12 01:42:39', 'En cours', 1),
(38, 1, '2024-03-12 01:42:39', 'En cours', 1),
(39, 1, '2024-03-12 01:42:39', 'En cours', 1),
(40, 1, '2024-03-12 01:42:39', 'En cours', 1),
(41, 1, '2024-03-12 01:42:40', 'En cours', 1),
(42, 1, '2024-03-12 01:42:40', 'En cours', 1),
(43, 1, '2024-03-12 01:42:40', 'En cours', 1),
(44, 1, '2024-03-12 01:42:40', 'En cours', 1),
(45, 1, '2024-03-12 01:42:40', 'En cours', 1),
(46, 1, '2024-03-12 01:42:41', 'En cours', 1),
(47, 1, '2024-03-12 01:42:41', 'En cours', 1),
(48, 1, '2024-03-12 01:42:41', 'En cours', 1),
(49, 1, '2024-03-12 01:42:41', 'En cours', 1),
(50, 1, '2024-03-12 01:42:42', 'En cours', 1),
(51, 1, '2024-03-12 01:42:42', 'En cours', 1),
(52, 1, '2024-03-12 01:42:42', 'En cours', 1),
(53, 1, '2024-03-12 01:42:42', 'En cours', 1),
(54, 1, '2024-03-12 01:42:42', 'En cours', 1),
(55, 1, '2024-03-12 01:42:42', 'En cours', 1),
(56, 1, '2024-03-12 01:42:43', 'En cours', 1),
(57, 1, '2024-03-12 01:42:43', 'En cours', 1),
(58, 1, '2024-03-12 01:42:43', 'En cours', 1),
(59, 1, '2024-03-12 01:42:43', 'En cours', 1),
(60, 1, '2024-03-12 01:42:43', 'En cours', 1),
(61, 1, '2024-03-12 01:42:43', 'En cours', 1),
(62, 1, '2024-03-12 01:42:44', 'En cours', 1),
(63, 1, '2024-03-12 01:42:44', 'En cours', 1),
(64, 1, '2024-03-12 01:42:44', 'En cours', 1),
(65, 1, '2024-03-12 01:42:44', 'En cours', 1),
(66, 1, '2024-03-12 01:42:44', 'En cours', 1),
(67, 1, '2024-03-12 01:42:45', 'En cours', 1),
(68, 1, '2024-03-12 01:42:45', 'En cours', 1),
(69, 1, '2024-03-12 01:42:45', 'En cours', 1),
(70, 1, '2024-03-12 01:42:45', 'En cours', 1),
(71, 1, '2024-03-12 01:42:45', 'En cours', 1),
(72, 1, '2024-03-12 01:42:46', 'En cours', 1),
(73, 1, '2024-03-12 01:42:52', 'En cours', 1),
(74, 1, '2024-03-12 01:42:57', 'En cours', 1),
(75, 1, '2024-03-12 01:42:58', 'En cours', 1),
(76, 1, '2024-03-12 01:43:04', 'En cours', 1),
(77, 1, '2024-03-12 01:43:05', 'En cours', 1),
(78, 1, '2024-03-12 01:43:22', 'En cours', 1),
(79, 1, '2024-03-12 01:43:29', 'En cours', 1),
(80, 1, '2024-03-12 01:43:30', 'En cours', 1),
(81, 1, '2024-03-12 01:43:31', 'En cours', 1),
(82, 1, '2024-03-12 01:44:57', 'En cours', 1),
(83, 1, '2024-03-12 00:49:49', 'En cours', 1),
(84, 1, '2024-03-12 00:49:56', 'En cours', 1),
(85, 1, '2024-03-12 00:50:00', 'En cours', 1),
(86, 1, '2024-03-12 00:50:13', 'En cours', 1),
(87, 1, '2024-03-12 00:50:18', 'En cours', 1),
(88, 1, '2024-03-14 12:42:44', 'En cours', 1),
(89, 1, '2024-03-14 12:44:27', 'En cours', 0);

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
(3, 1, 'Moreau', 'Claire', '0645678901', '@clairemoreau');

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
(12, 'Suthan', 'Subina', 'subina.suthan@gmail.com', 'subina', '1906');

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
  MODIFY `id_alerte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `contacts_urgence`
--
ALTER TABLE `contacts_urgence`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
