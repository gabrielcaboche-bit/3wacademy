-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 08 Février 2026 à 22:29
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `task_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_urgent` tinyint(1) NOT NULL,
  `is_important` tinyint(1) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`id`, `title`, `is_urgent`, `is_important`, `is_done`, `user_id`, `created_at`) VALUES
(74, 'Préparer la réunion client', 1, 1, 0, 30, '2026-02-08 23:28:55'),
(75, 'Envoyer le rapport mensuel', 1, 0, 0, 30, '2026-02-08 23:28:55'),
(76, 'Répondre aux emails', 0, 1, 0, 30, '2026-02-08 23:28:55'),
(77, 'Mettre à jour le portfolio', 0, 0, 0, 30, '2026-02-08 23:28:55'),
(78, 'Finaliser le projet web', 1, 1, 1, 30, '2026-02-08 23:28:55'),
(79, 'Appeler le fournisseur', 0, 1, 1, 30, '2026-02-08 23:28:55'),
(80, 'Organiser les fichiers', 0, 0, 1, 30, '2026-02-08 23:28:55'),
(81, 'Créer le design du logo', 1, 1, 0, 31, '2026-02-08 23:28:55'),
(82, 'Rédiger le contenu du site', 1, 0, 0, 31, '2026-02-08 23:28:55'),
(83, 'Tester la responsive design', 0, 1, 0, 31, '2026-02-08 23:28:55'),
(84, 'Optimiser les images', 0, 0, 0, 31, '2026-02-08 23:28:55'),
(85, 'Configurer le SEO', 0, 1, 0, 31, '2026-02-08 23:28:55'),
(86, 'Analyser la concurrence', 1, 1, 1, 31, '2026-02-08 23:28:55'),
(87, 'Définir la palette de couleurs', 0, 1, 1, 31, '2026-02-08 23:28:55'),
(88, 'Choisir les polices', 0, 0, 1, 31, '2026-02-08 23:28:55'),
(89, 'Créer le wireframe', 1, 0, 1, 31, '2026-02-08 23:28:55'),
(90, 'Développer l\'API REST', 1, 1, 0, 32, '2026-02-08 23:28:55'),
(91, 'Écrire les tests unitaires', 1, 0, 0, 32, '2026-02-08 23:28:55'),
(92, 'Documenter le code', 0, 1, 0, 32, '2026-02-08 23:28:55'),
(93, 'Revoir le code legacy', 0, 0, 0, 32, '2026-02-08 23:28:55'),
(94, 'Configurer l\'environnement de dev', 1, 1, 1, 32, '2026-02-08 23:28:55'),
(95, 'Installer les dépendances', 0, 1, 1, 32, '2026-02-08 23:28:55'),
(96, 'Créer la structure du projet', 1, 0, 1, 32, '2026-02-08 23:28:55'),
(97, 'Planifier la campagne marketing', 1, 1, 0, 33, '2026-02-08 23:28:55'),
(98, 'Créer les visuels réseaux sociaux', 1, 0, 0, 33, '2026-02-08 23:28:55'),
(99, 'Rédiger les articles de blog', 0, 1, 0, 33, '2026-02-08 23:28:55'),
(100, 'Analyser les statistiques', 0, 0, 0, 33, '2026-02-08 23:28:55'),
(101, 'Préparer la newsletter', 0, 1, 0, 33, '2026-02-08 23:28:55'),
(102, 'Lancer la campagne précédente', 1, 1, 1, 33, '2026-02-08 23:28:55'),
(103, 'Créer le calendrier éditorial', 0, 1, 1, 33, '2026-02-08 23:28:55'),
(104, 'Mettre à jour les profils sociaux', 0, 0, 1, 33, '2026-02-08 23:28:55'),
(105, 'Analyser les résultats Q1', 1, 0, 1, 33, '2026-02-08 23:28:55'),
(106, 'Former les nouveaux employés', 1, 1, 0, 34, '2026-02-08 23:28:55'),
(107, 'Préparer les évaluations', 1, 0, 0, 34, '2026-02-08 23:28:55'),
(108, 'Organiser le team building', 0, 1, 0, 34, '2026-02-08 23:28:55'),
(109, 'Mettre à jour les procédures', 0, 0, 0, 34, '2026-02-08 23:28:55'),
(110, 'Recruter un développeur', 1, 1, 1, 34, '2026-02-08 23:28:55'),
(111, 'Créer les offres d\'emploi', 0, 1, 1, 34, '2026-02-08 23:28:55'),
(112, 'Conduire les entretiens', 1, 0, 1, 34, '2026-02-08 23:28:55'),
(113, 'Intégrer les nouveaux arrivants', 0, 0, 1, 34, '2026-02-08 23:28:55');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(30, 'Jean Dupont', 'jean.dupont@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-08 23:28:55'),
(31, 'Marie Martin', 'marie.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-08 23:28:55'),
(32, 'Pierre Bernard', 'pierre.bernard@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-08 23:28:55'),
(33, 'Sophie Leroy', 'sophie.leroy@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-08 23:28:55'),
(34, 'Lucas Moreau', 'lucas.moreau@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-02-08 23:28:55');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
