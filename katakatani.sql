-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 07 oct. 2022 à 11:42
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
(3, 'Abdramane', 'Kodio', 'Torokorobougou', '+223 67 00 07 37', NULL, '2020-01-27 00:00:00', '2022-10-02 00:00:00', 3),
(4, 'Daouda', 'Diarra', 'Sabalibougou', '60664566', NULL, '2022-10-04 00:00:00', '2022-10-04 00:00:00', 3);

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
(5, 'Recette', 10000, '2022-08-28 00:00:00', 'Il n\'a pas travaille le jeudi 25 et 26 août 2022 pour cause de réparation, c\'est pourquoi ce montant ', 3),
(6, 'Dépense', 1500, '2022-08-26 00:00:00', 'Réparation de Pneu', 2),
(7, 'Recette', 15000, '2022-08-28 00:00:00', NULL, 1),
(8, 'Recette', 15000, '2022-08-28 00:00:00', NULL, 2),
(9, 'Recette', 2500, '2022-09-01 00:00:00', 'Via Orange Money, ça reste 12500 FCFA', 1),
(10, 'Recette', 2500, '2022-09-03 00:00:00', NULL, 1),
(11, 'Recette', 2500, '2022-09-04 00:00:00', 'Il a donné 2 500 FCFA à Kodio, et il avait envoyé 2 fois 2 500 FCFA (5 000 FCFA) via Orange Money, il lui reste à payer maintenant 7 500 FCFA', 1),
(12, 'Recette', 15000, '2022-09-04 00:00:00', NULL, 3),
(13, 'Recette', 15000, '2022-09-04 00:00:00', NULL, 2),
(14, 'Dépense', 2000, '2022-09-02 00:00:00', 'Soudure de Tissu (Barre stabilisatrice)', 3),
(15, 'Dépense', 2500, '2022-09-02 00:00:00', 'Frais de réparation de Sékouba', 3),
(16, 'Dépense', 1500, '2022-09-05 00:00:00', 'Soudure pour les besoins de freins.', 3),
(17, 'Dépense', 2500, '2022-09-05 00:00:00', 'Frein réglage', 3),
(18, 'Dépense', 2000, '2022-09-05 00:00:00', 'Frais de réparation de Sékouba', 3),
(19, 'Recette', 10000, '2022-09-05 00:00:00', 'Il a payé l\'arriéré 7500 FCFA de la semaine passée et le 2500 FCFA d\'aujourd\'hui.', 1),
(20, 'Recette', 5000, '2022-09-07 00:00:00', 'Recette de mardi et mercredi', 1),
(21, 'Dépense', 2500, '2022-09-10 00:00:00', 'Achat de nouveau chambre à air (2250) et frais de réparation 250', 1),
(22, 'Dépense', 5000, '2022-09-10 00:00:00', 'Réparation des freins arrières', 1),
(23, 'Recette', 7500, '2022-09-11 00:00:00', 'Pour jeudi, vendredi et samedi', 1),
(24, 'Recette', 7500, '2022-09-11 00:00:00', 'Il lui reste 7 500 FCFA à payer', 2),
(25, 'Recette', 12500, '2022-09-11 00:00:00', 'Il n\'a pas travaillé un jour', 3),
(26, 'Recette', 5000, '2022-09-13 00:00:00', 'Pour lundi et mardi', 1),
(27, 'Recette', 2500, '2022-09-14 00:00:00', 'Pour mercredi', 1),
(28, 'Dépense', 6500, '2022-09-15 00:00:00', 'Réparation du mao vers le pneu.', 1),
(29, 'Recette', 15000, '2022-09-18 00:00:00', 'Il lui reste les 7 500 de la semaine passé.', 2),
(30, 'Recette', 5000, '2022-09-16 00:00:00', 'Pour le jeudi et vendredi', 1),
(31, 'Recette', 2500, '2022-09-18 00:00:00', 'Pour le samedi', 1),
(32, 'Recette', 15000, '2022-09-19 00:00:00', NULL, 3),
(33, 'Dépense', 5000, '2022-09-19 00:00:00', 'La police lui a arrêté pour sens interdit vers la grande mosquée à bagadadji. On  les a donné 10 000 FCFA, moi j\'ai donné 5 000 et Abdramane même 5 000', 3),
(34, 'Dépense', 7500, '2022-09-19 00:00:00', 'Réparation du bas du bol', 3),
(35, 'Dépense', 4500, '2022-09-20 00:00:00', '3500 FCFA pour le classeur qui contient les disques et 1000 FCFA pour la réparation', 1),
(36, 'Recette', 2500, '2022-09-21 00:00:00', 'Il lui reste 8 000 FCFA', 1),
(37, 'Recette', 2500, '2022-09-23 00:00:00', 'Il lui reste 5 500 FCFA', 1),
(38, 'Recette', 15000, '2022-09-24 00:00:00', 'Il lui reste 7 500 FCFA', 2),
(39, 'Recette', 3000, '2022-09-26 00:00:00', 'Il lui reste 2 500 FCFA', 1),
(40, 'Recette', 10000, '2022-09-25 00:00:00', NULL, 3),
(41, 'Recette', 5000, '2022-09-27 00:00:00', 'Le 2 500 FCFA qui lui restait et la recette du lundi 26/09/2022', 1),
(42, 'Recette', 2500, '2022-09-29 00:00:00', 'Il lui reste 10 000 FCFA', 1),
(43, 'Recette', 2500, '2022-10-01 00:00:00', 'Il lui reste 7 500 FCFA', 1),
(44, 'Recette', 5000, '2022-10-03 00:00:00', 'Il lui reste 2 500 FCFA', 1),
(45, 'Dépense', 5000, '2022-10-03 00:00:00', 'Réparation du deuxième frein arrière', 1),
(46, 'Recette', 15000, '2022-10-02 00:00:00', NULL, 3),
(47, 'Recette', 22500, '2022-10-02 00:00:00', 'La recette de la semaine et le 7 500 FCFA restant.', 2),
(48, 'Dépense', 6500, '2022-09-30 00:00:00', 'Réparation de Frein', 3),
(49, 'Recette', 5000, '2022-10-05 00:00:00', 'Pour le 2500 FCFA restant et la recette du lundi', 1),
(50, 'Recette', 2500, '2022-10-04 00:00:00', 'Pour ce mardi', 3),
(51, 'Recette', 2500, '2022-10-05 00:00:00', 'Pour ce mercredi', 3),
(52, 'Recette', 5000, '2022-10-06 00:00:00', 'Pour le mardi et mercredi', 1);

-- --------------------------------------------------------

--
-- Structure de la table `katakatani`
--

CREATE TABLE `katakatani` (
  `id` int(10) UNSIGNED NOT NULL,
  `matricule` varchar(255) DEFAULT NULL,
  `acheter_at` datetime DEFAULT NULL,
  `prix_achat` int(11) NOT NULL,
  `numero` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `katakatani`
--

INSERT INTO `katakatani` (`id`, `matricule`, `acheter_at`, `prix_achat`, `numero`) VALUES
(1, '1979428774482', '2017-06-08 00:00:00', 1185000, 1),
(2, '4006704009772', '2018-01-27 00:00:00', 1185000, 2),
(3, '9561664699432', '2018-12-03 00:00:00', 1185000, 3);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comptabilite`
--
ALTER TABLE `comptabilite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `katakatani`
--
ALTER TABLE `katakatani`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
