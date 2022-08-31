-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 31 août 2022 à 17:32
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `katakatani`
--

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `id` int(10) UNSIGNED NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone1` varchar(23) NOT NULL,
  `telephone2` varchar(23) DEFAULT NULL,
  `debut_at` datetime NOT NULL,
  `fin_at` datetime DEFAULT NULL,
  `katakatani_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`id`, `prenom`, `nom`, `adresse`, `telephone1`, `telephone2`, `debut_at`, `fin_at`, `katakatani_id`) VALUES
(1, 'Seydou', '(Salia)', 'Namassa dankan', '+223 69 30 17 67', NULL, '2022-08-31 00:00:00', '2022-08-31 00:00:00', 2),
(2, 'Chaka', '(Chaka)', 'Gouana', '+223 66 33 36 88', '+223 76 67 99 70', '2022-06-15 00:00:00', '2022-08-31 00:00:00', 1),
(3, 'Abdramane', 'Kodio', 'Torokorobougou', '+223 67 00 07 37', NULL, '2020-01-27 00:00:00', '2022-08-31 00:00:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comptabilite`
--

CREATE TABLE `comptabilite` (
  `id` int(10) UNSIGNED NOT NULL,
  `motif` enum('Dépense','Recette') NOT NULL,
  `montant` int(11) NOT NULL,
  `date_at` datetime NOT NULL,
  `details` mediumtext DEFAULT NULL,
  `katakatani_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comptabilite`
--

INSERT INTO `comptabilite` (`id`, `motif`, `montant`, `date_at`, `details`, `katakatani_id`) VALUES
(1, 'Dépense', 15000, '2022-08-22 00:00:00', 'Réparation des roulements du pont', 1),
(2, 'Dépense', 9000, '2022-08-02 00:00:00', 'Réparation des lames', 2),
(3, 'Dépense', 84800, '2022-08-26 00:00:00', '- Cylindre (il contient le piston et singman), \r\n- Bol, \r\n- Piston\r\n- Huile (1,5L)', 3),
(4, 'Dépense', 4500, '2022-08-21 00:00:00', '- Réparation Singma (3 000 FCFA).\r\n- Frais de réparation (1 500 FCFA.', 2),
(5, 'Recette', 10000, '2022-08-28 00:00:00', 'Il n\'a pas travaille le jeudi 25 et 26 août 2022 pour cause de réparation, c\'est pourquoi ce montant ', 3);

-- --------------------------------------------------------

--
-- Structure de la table `katakatani`
--

CREATE TABLE `katakatani` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  `acheter_at` datetime DEFAULT NULL,
  `prix_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `katakatani`
--

INSERT INTO `katakatani` (`id`, `matricule`, `acheter_at`, `prix_achat`) VALUES
(1, '1979428774482', '2017-06-08 00:00:00', 1185000),
(2, '4006704009772', '2018-01-27 00:00:00', 1185000),
(3, '9561664699432', '2018-12-03 00:00:00', 1185000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roles`) VALUES
(1, 'admin', '$2y$10$dKCaDwSddjy165q929lX0.5y7Qu.4M1WR/cGUVRN5zpWkUasRuNBu', 'administrateur'),
(2, 'admin', '$2y$10$VwlidhRURc3Qkkqz17u.c.yP4SPyE/ZaBE8KV1LXxON2LE3iHfwQe', 'administrateur'),
(3, 'admin', '$2y$10$s9p7017QEQwXd2rpYsjwjuOfNKFY7vN6ItQ6eY7D2gyerCGayH1hy', 'administrateur'),
(4, 'admin', '$2y$10$gV3hUvNk9RB/CjFyZ/RHvO7LtBMa3WcBl1sMpLJr6O50IYa.5Jstu', 'administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katakatani_id` (`katakatani_id`);

--
-- Index pour la table `comptabilite`
--
ALTER TABLE `comptabilite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katakatani_id` (`katakatani_id`);

--
-- Index pour la table `katakatani`
--
ALTER TABLE `katakatani`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comptabilite`
--
ALTER TABLE `comptabilite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `katakatani`
--
ALTER TABLE `katakatani`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD CONSTRAINT `chauffeur_ibfk_1` FOREIGN KEY (`katakatani_id`) REFERENCES `katakatani` (`id`);

--
-- Contraintes pour la table `comptabilite`
--
ALTER TABLE `comptabilite`
  ADD CONSTRAINT `comptabilite_ibfk_1` FOREIGN KEY (`katakatani_id`) REFERENCES `katakatani` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
