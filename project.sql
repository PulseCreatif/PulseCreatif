-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 mai 2024 à 21:32
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `project`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `ID_Categorie` int(50) NOT NULL,
  `Nom_Categorie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description_Categorie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID_Categorie`, `Nom_Categorie`, `Description_Categorie`) VALUES
(1, 'aaaaaaa', 'aaaaaaaaaa'),
(3, 'zaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa'),
(5, 'nanan', 'zzzzzzzzzzzzzzzzzzz'),
(6, 'bbbbbbbbbbbbb', 'bbbbbbbbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `authorC` varchar(50) DEFAULT NULL,
  `contentC` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_post`, `authorC`, `contentC`) VALUES
(1, 15, 'x', 'x'),
(2, 15, 'test', 'test'),
(3, 15, 'reset', 'res');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `action_type` enum('ajout','modification','suppression') DEFAULT NULL,
  `table_concernee` varchar(255) DEFAULT NULL,
  `id_ligne_modifiee` int(11) DEFAULT NULL,
  `date_action` timestamp NOT NULL DEFAULT current_timestamp(),
  `utilisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `action_type`, `table_concernee`, `id_ligne_modifiee`, `date_action`, `utilisateur_id`) VALUES
(1, 'ajout', 'reclamation', 23, '2024-05-05 01:23:33', 123),
(2, 'suppression', 'reclamation', 23, '2024-05-05 01:25:25', 123),
(3, 'modification', 'reclamation', 17, '2024-05-05 01:26:29', 123),
(4, 'ajout', 'categorie', 3, '2024-05-05 01:29:55', 123),
(5, 'modification', 'categorie', 1, '2024-05-05 01:30:52', 123),
(6, 'suppression', 'categorie', 2, '2024-05-05 01:30:59', 123),
(7, 'modification', 'reclamation', 16, '2024-05-05 01:38:16', 123),
(8, 'modification', 'categorie', 1, '2024-05-05 01:39:16', 123),
(9, 'ajout', 'categorie', 4, '2024-05-05 01:52:23', 123),
(10, 'modification', 'reclamation', 17, '2024-05-05 02:25:54', 123),
(11, 'ajout', 'reclamation', 24, '2024-05-05 22:14:05', 123),
(12, 'modification', 'reclamation', 18, '2024-05-06 01:09:10', 123),
(13, 'suppression', 'reclamation', 19, '2024-05-06 01:09:41', 123),
(14, 'ajout', 'reclamation', 25, '2024-05-06 01:10:26', 123),
(15, 'modification', 'categorie', 1, '2024-05-06 01:10:37', 123),
(16, 'suppression', 'categorie', 4, '2024-05-06 01:10:44', 123),
(17, 'ajout', 'categorie', 5, '2024-05-06 01:11:24', 123),
(18, 'modification', 'categorie', 5, '2024-05-06 01:11:30', 123),
(19, 'ajout', 'categorie', 6, '2024-05-08 18:05:30', 123);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `contentP` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `date_created` date NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `title`, `contentP`, `author`, `date_created`, `img`) VALUES
(15, 'x', 'x', 'x', '2024-04-27', '../../Uploads/270600840_1270646430114468_1634897655021456101_n.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `idR` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Etat` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ID_Categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`idR`, `Name`, `Type`, `Etat`, `Description`, `Subject`, `Email`, `ID_Categorie`) VALUES
(16, '', 'aaaaaaaaaaaa', 'xx', 'xaaaaaaaaaaa', '', 'aR3gAibeDRY7@aboskandar.xyz', NULL),
(17, 'Jhon Cen', 'aaaa²', 'bbbbbbbbb', 'okaaaaaaaaaaaay', 'testx', 'xxxxxxxxxxx@gmail.com', NULL),
(18, 'ddd', 'aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', 'daddadad', 'ddd', 'dddx@gmail.com', NULL),
(21, '', 'qaaaaaaaa', 'aaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', '', 'aaa@esprit.tn', NULL),
(24, '', 'aaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaa', '', 'aaaaa@esprit.tn', NULL),
(25, '', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', 'ameni@esprit.tn', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID_Categorie`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `fk` (`id_post`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idR`),
  ADD KEY `ID_Categorie` (`ID_Categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID_Categorie` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorie` (`ID_Categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
