-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 sep. 2025 à 14:01
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `editor` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id`, `title`, `author`, `available`, `editor`, `created_at`) VALUES
(1, 'Drifting', 'Night Tapes', 1, 'Night Records', '2025-09-27 15:26:37'),
(2, 'Black Holes and Revelations', 'Muse', 1, 'Warner Bros.', '2025-09-27 15:26:37'),
(3, 'Ravedeath', 'Ravedeath', 0, 'Death Records', '2025-09-27 15:26:37'),
(4, 'American Idiot', 'Green Day', 1, 'Reprise Records', '2025-09-27 15:26:37'),
(5, 'Metallica (The Black Album)', 'Metallica', 1, 'Elektra Records', '2025-09-27 15:26:37'),
(6, 'Hurry Up, We’re Dreaming', 'M83', 0, 'Naïve Records', '2025-09-27 15:26:37'),
(7, 'A Rush of Blood to the Head', 'Coldplay', 1, 'Parlophone', '2025-09-27 15:26:37'),
(8, 'Nevermind', 'Nirvana', 1, 'DGC Records', '2025-09-27 15:26:37'),
(9, 'Elephant', 'The White Stripes', 0, 'V2 Records', '2025-09-27 15:26:37'),
(10, 'Toxicity', 'System of a Down', 1, 'American Recordings', '2025-09-27 15:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `pagenumber` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `available`, `pagenumber`, `created_at`) VALUES
(1, 'Les Ombres de l\'Aube', 'Jean Dupont', 1, 324, '2025-09-27 15:26:38'),
(2, 'Voyage au-delà des Étoiles', 'Marie Lefèvre', 0, 512, '2025-09-27 15:26:37'),
(3, 'Le Secret du Lac Noir', 'Paul Martin', 1, 278, '2025-09-27 15:26:37'),
(4, 'Chroniques d\'une Cité Perdue', 'Claire Dubois', 1, 401, '2025-09-27 15:26:37'),
(5, 'L\'Énigme du Temps', 'Antoine Morel', 0, 365, '2025-09-27 15:26:37'),
(6, 'Murmures dans la Forêt', 'Sophie Lambert', 1, 289, '2025-09-25 15:26:37'),
(7, 'Le Dernier Royaume', 'Luc Bernard', 1, 450, '2025-09-27 15:26:37'),
(8, 'Au Fil du Destin', 'Camille Rousseau', 0, 372, '2025-09-27 15:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`, `created_at`) VALUES
(1, 'Fiction', '2025-09-27 15:26:37'),
(2, 'Science Fiction', '2025-09-27 15:26:37'),
(3, 'Biographie', '2025-09-27 15:26:37'),
(4, 'Histoire', '2025-09-27 15:26:37'),
(5, 'Enfants', '2025-09-27 15:26:37'),
(6, 'Jeunesse', '2025-09-27 15:26:37'),
(7, 'Policier', '2025-09-27 15:26:37'),
(8, 'Thriller', '2025-09-27 15:26:37'),
(9, 'Fantastique', '2025-09-27 15:26:37'),
(10, 'Romance', '2025-09-27 15:26:37'),
(11, 'Aventure', '2025-09-27 15:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `duration` int(11) NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `title`, `author`, `available`, `duration`, `genre_id`, `created_at`) VALUES
(1, 'Prisoners', 'Denis Villeneuve', 1, 153, 7, '2025-09-27 15:26:37'),
(2, 'Inception', 'Christopher Nolan', 1, 148, 2, '2025-09-27 15:26:37'),
(3, 'The Shawshank Redemption', 'Frank Darabont', 1, 142, 1, '2025-09-27 15:26:37'),
(4, 'The Godfather', 'Francis Ford Coppola', 1, 175, 1, '2025-09-27 15:26:37'),
(5, 'The Dark Knight', 'Christopher Nolan', 1, 152, 8, '2025-09-27 15:26:37'),
(6, 'Interstellar', 'Christopher Nolan', 1, 169, 2, '2025-09-27 15:26:37'),
(7, 'Forrest Gump', 'Robert Zemeckis', 1, 142, 1, '2025-09-27 15:26:37'),
(8, 'The Pianist', 'Roman Polanski', 1, 150, 3, '2025-09-27 15:26:37'),
(9, 'Harry Potter and the Sorcerer\'s Stone', 'Chris Columbus', 1, 152, 6, '2025-09-27 15:26:37'),
(10, 'The Lion King', 'Roger Allers & Rob Minkoff', 1, 88, 5, '2025-09-27 15:26:37'),
(11, 'Gone Girl', 'David Fincher', 1, 149, 8, '2025-09-27 15:26:37'),
(12, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 1, 178, 9, '2025-09-27 15:26:37'),
(13, 'Titanic', 'James Cameron', 1, 195, 10, '2025-09-27 15:26:37'),
(14, 'Indiana Jones: Raiders of the Lost Ark', 'Steven Spielberg', 1, 115, 11, '2025-09-27 15:26:37'),
(15, 'Se7en', 'David Fincher', 1, 127, 8, '2025-09-27 15:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

CREATE TABLE `song` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `song`
--

INSERT INTO `song` (`id`, `title`, `author`, `available`, `created_at`, `album_id`) VALUES
(21, 'Drifting', 'Night Tapes', 1, '2025-09-27 15:26:37', 1),
(22, 'Starlight', 'Muse', 1, '2025-09-27 15:26:37', 2),
(23, 'Cult Member', 'Ravedeath', 0, '2025-09-27 15:26:37', 3),
(24, 'Boulevard of Broken Dreams', 'Green Day', 1, '2025-09-27 15:26:37', 4),
(25, 'Nothing Else Matters', 'Metallica', 1, '2025-09-27 15:26:37', 5),
(26, 'Midnight City', 'M83', 0, '2025-09-27 15:26:37', 6),
(27, 'Clocks', 'Coldplay', 1, '2025-09-27 15:26:37', 7),
(28, 'Smells Like Teen Spirit', 'Nirvana', 1, '2025-09-27 15:26:37', 8),
(29, 'Seven Nation Army', 'The White Stripes', 0, '2025-09-27 15:26:37', 9),
(30, 'Chop Suey!', 'System of a Down', 1, '2025-09-27 15:26:37', 10);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Adrien', 'Leclère', 'adrien.leclere@orange.fr', '$2y$10$qOUqO9m4HoyWVFTfQMA6q.cPjXVOBeaWa6ylwM/gMUIYUrPhDLafu', '2025-09-10 13:43:29', NULL),
(3, 'Charle', 'Haller', 'charle.haller@ec2e.com', '$2y$10$GPrE3h4nbi3Vmh1r0kTIZ.TGNGEQ9tqokmnXnZojkfDR/uH3xZJHK', '2025-09-21 18:53:34', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_movie_genre` (`genre_id`);

--
-- Index pour la table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_song_album` (`album_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_movie_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `fk_song_album` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
