-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 sep. 2025 à 19:41
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
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `editor` varchar(100) NOT NULL,
  `id_song` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id`, `title`, `author`, `available`, `editor`, `id_song`) VALUES
(1, 'Drifting', 'Night Tapes', 1, 'Night Records', 1),
(2, 'Black Holes and Revelations', 'Muse', 1, 'Warner Bros.', 2),
(3, 'Ravedeath', 'Ravedeath', 0, 'Death Records', 3),
(4, 'American Idiot', 'Green Day', 1, 'Reprise Records', 4),
(5, 'Metallica (The Black Album)', 'Metallica', 1, 'Elektra Records', 5),
(6, 'Hurry Up, We’re Dreaming', 'M83', 0, 'Naïve Records', 6),
(7, 'A Rush of Blood to the Head', 'Coldplay', 1, 'Parlophone', 7),
(8, 'Nevermind', 'Nirvana', 1, 'DGC Records', 8),
(9, 'Elephant', 'The White Stripes', 0, 'V2 Records', 9),
(10, 'Toxicity', 'System of a Down', 1, 'American Recordings', 10);

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `pagenumber` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `available`, `pagenumber`) VALUES
(1, 'Les Ombres de l\'Aube', 'Jean Dupont', 1, 324),
(2, 'Voyage au-delà des Étoiles', 'Marie Lefèvre', 0, 512),
(3, 'Le Secret du Lac Noir', 'Paul Martin', 1, 278),
(4, 'Chroniques d\'une Cité Perdue', 'Claire Dubois', 1, 401),
(5, 'L\'Énigme du Temps', 'Antoine Morel', 0, 365),
(6, 'Murmures dans la Forêt', 'Sophie Lambert', 1, 289),
(7, 'Le Dernier Royaume', 'Luc Bernard', 1, 450),
(8, 'Au Fil du Destin', 'Camille Rousseau', 0, 372);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Fiction'),
(2, 'Science Fiction'),
(3, 'Biographie'),
(4, 'Histoire'),
(5, 'Enfants'),
(6, 'Jeunesse'),
(7, 'Policier'),
(8, 'Thriller'),
(9, 'Fantastique'),
(10, 'Romance'),
(11, 'Aventure');

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
  `genre_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `title`, `author`, `available`, `duration`, `genre_id`) VALUES
(1, 'Prisoners', 'Denis Villeneuve', 1, 153, 7),
(2, 'Inception', 'Christopher Nolan', 1, 148, 2),
(3, 'The Shawshank Redemption', 'Frank Darabont', 1, 142, 1),
(4, 'The Godfather', 'Francis Ford Coppola', 1, 175, 1),
(5, 'The Dark Knight', 'Christopher Nolan', 1, 152, 8),
(6, 'Interstellar', 'Christopher Nolan', 1, 169, 2),
(7, 'Forrest Gump', 'Robert Zemeckis', 1, 142, 1),
(8, 'The Pianist', 'Roman Polanski', 1, 150, 3),
(9, 'Harry Potter and the Sorcerer\'s Stone', 'Chris Columbus', 1, 152, 6),
(10, 'The Lion King', 'Roger Allers & Rob Minkoff', 1, 88, 5),
(11, 'Gone Girl', 'David Fincher', 1, 149, 8),
(12, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 1, 178, 9),
(13, 'Titanic', 'James Cameron', 1, 195, 10),
(14, 'Indiana Jones: Raiders of the Lost Ark', 'Steven Spielberg', 1, 115, 11),
(15, 'Se7en', 'David Fincher', 1, 127, 8);

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

CREATE TABLE `song` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `song`
--

INSERT INTO `song` (`id`, `title`, `author`, `available`) VALUES
(1, 'Drifting', 'Night tapes', 1),
(2, 'Starlight', 'Muse', 1),
(3, 'Cult Member', 'Ravedeath', 0),
(4, 'Boulevard of Broken Dreams', 'Green Day', 1),
(5, 'Nothing Else Matters', 'Metallica', 1),
(6, 'Midnight City', 'M83', 0),
(7, 'Clocks', 'Coldplay', 1),
(8, 'Smells Like Teen Spirit', 'Nirvana', 1),
(9, 'Seven Nation Army', 'The White Stripes', 0),
(10, 'Chop Suey!', 'System of a Down', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_song` (`id_song`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_album_song` FOREIGN KEY (`id_song`) REFERENCES `song` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_movie_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
