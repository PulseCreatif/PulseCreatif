-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 mai 2024 à 03:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myapp`
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
(3, 'zaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa'),
(5, 'nanan', 'zzzzzzzzzzzzzzzzzzz'),
(6, 'bbbbbbbbbbbbb', 'bbbbbbbbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Structure de la table `certificat`
--

CREATE TABLE `certificat` (
  `Id_Cert` int(50) NOT NULL,
  `Titre_Cert` varchar(255) NOT NULL,
  `Date_Cert` date NOT NULL,
  `Duree_Cert` varchar(255) NOT NULL,
  `id_etud` int(11) NOT NULL,
  `Id_Cours` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `certificat`
--

INSERT INTO `certificat` (`Id_Cert`, `Titre_Cert`, `Date_Cert`, `Duree_Cert`, `id_etud`, `Id_Cours`) VALUES
(16, 'Reseau', '2024-05-12', '1an', 5, 78984),
(18, 'ang', '2024-04-02', '1an', 5, 78983);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `authorC` int(11) DEFAULT NULL,
  `contentC` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_post`, `authorC`, `contentC`) VALUES
(5, 18, 36, 'a'),
(6, 18, 36, 'ghjkl'),
(8, 18, 36, 'dadad'),
(9, 18, 36, 'a'),
(10, 19, 36, 'qsdfghjk'),
(11, 19, 36, 'qsdfghjk');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `Id_cours` int(50) NOT NULL,
  `Nom_cours` varchar(255) NOT NULL,
  `Nbr_heures` int(250) NOT NULL,
  `Type_cours` tinyint(1) NOT NULL,
  `Nom_Ens` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`Id_cours`, `Nom_cours`, `Nbr_heures`, `Type_cours`, `Nom_Ens`) VALUES
(78983, 'english', 5, 1, 'wafa'),
(78984, 'reseaux', 10, 1, 'rym');

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
(19, 'ajout', 'categorie', 6, '2024-05-08 18:05:30', 123),
(20, 'ajout', 'reclamation', 26, '2024-05-13 17:12:22', 123),
(21, 'modification', 'reclamation', 26, '2024-05-13 17:15:38', 123),
(22, 'ajout', 'reclamation', 29, '2024-05-13 17:17:58', 123),
(23, 'ajout', 'reclamation', 30, '2024-05-13 17:28:14', 123),
(24, 'suppression', 'reclamation', 30, '2024-05-13 17:59:24', 123),
(25, 'suppression', 'reclamation', 29, '2024-05-13 17:59:26', 123),
(26, 'modification', 'reclamation', 28, '2024-05-13 17:59:34', 123),
(27, 'suppression', 'categorie', 9, '2024-05-13 18:00:40', 123),
(28, 'ajout', 'categorie', 10, '2024-05-13 18:00:47', 123),
(29, 'suppression', 'categorie', 10, '2024-05-13 18:00:49', 123),
(30, 'ajout', 'reclamation', 31, '2024-05-13 18:01:34', 123),
(31, 'suppression', 'reclamation', 31, '2024-05-13 18:03:39', 123),
(32, 'suppression', 'reclamation', 26, '2024-05-13 18:04:56', 123),
(33, 'ajout', 'reclamation', 32, '2024-05-13 20:44:01', 123),
(34, 'suppression', 'reclamation', 32, '2024-05-13 20:50:42', 123),
(35, 'ajout', 'reclamation', 33, '2024-05-13 21:02:47', NULL),
(36, 'ajout', 'reclamation', 34, '2024-05-13 21:04:37', 36),
(37, 'ajout', 'reclamation', 35, '2024-05-13 21:05:19', 36),
(38, 'ajout', 'reclamation', 36, '2024-05-13 21:05:51', 36);

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
(18, 'zadza', 'dzada', 'zdza', '2024-05-22', '../uploads/images.jpg'),
(19, 'azert', 'zerty', 'tff', '2024-05-07', '../uploads/images.jpg');

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
(25, '', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', 'ameni@esprit.tn', NULL),
(33, '', 'zdzd', 'dz', 'zd', '', 'dorraa@yahoo.com', NULL),
(34, '', 'dzdz', 'dz', 'dzdz', '', 'dorraa@yahoo.com', NULL),
(35, 'dzdz', '', '', 'zddzdz', 'fzef', 'dorraa@yahoo.com', 3),
(36, '', 'dzdz', 'dzdz', 'dzdz', '', 'dzd@zd.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `table_devoir`
--

CREATE TABLE `table_devoir` (
  `DEPOT_ID` int(11) NOT NULL,
  `COURS_ID` int(11) NOT NULL,
  `DATE_LIMITE` date NOT NULL,
  `FICHIER` varchar(20) NOT NULL,
  `COMMENTAIRE` varchar(500) NOT NULL,
  `ETAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `table_devoir`
--

INSERT INTO `table_devoir` (`DEPOT_ID`, `COURS_ID`, `DATE_LIMITE`, `FICHIER`, `COMMENTAIRE`, `ETAT`) VALUES
(6, 7, '2024-03-12', 'quiz.png', 'TEST', 2),
(7, 5, '2024-04-13', 'examen.png', 'EXAMEN', 0),
(13, 2, '2022-03-12', 'uploads/test.png', 'QUIZ', 0),
(14, 2, '2024-05-17', 'uploads/test.png', 'TEST', 1),
(15, 4, '2023-03-12', 'uploads/434787646_11', 'EVALUATION', 1),
(17, 1, '4566-03-12', 'uploads/435610933_78', 'AAAA', 1),
(18, 3, '2023-03-12', 'uploads/photo.jpg', 'qmsldjfmqdsjf', 0);

-- --------------------------------------------------------

--
-- Structure de la table `table_evaluation`
--

CREATE TABLE `table_evaluation` (
  `ID_EVALUATION` int(11) NOT NULL,
  `ID_DEPOT` int(11) NOT NULL,
  `ID_ENSEIGNANT` int(11) NOT NULL,
  `NOTE` varchar(10) NOT NULL,
  `COMMENTAIRE` varchar(500) NOT NULL,
  `REPONSE_ETUD` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `table_evaluation`
--

INSERT INTO `table_evaluation` (`ID_EVALUATION`, `ID_DEPOT`, `ID_ENSEIGNANT`, `NOTE`, `COMMENTAIRE`, `REPONSE_ETUD`) VALUES
(2, 7, 4, '20', 'bravoOOO', 'function countWords($inputString) {         $cleanedString = preg_replace(\'/[^\\w\\s]/\', \'\', $inputString);      // Suppression des espaces multiples et espaces blancs     $cleanedString = trim(preg_replace(\'/\\s+/\', \' \', $cleanedString));          $words = explode(\' \', $cleanedString);     $wordCount = count($words);      return $wordCount; }'),
(5, 6, 2, '20', 'BRAVO', '// Initialize cURL session$ch = curl_init();// Set cURL optionscurl_ setopt ($ch, CURLOPT_URL, Surl);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS, §postData);curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);>);'),
(8, 13, 12, '', '', '<?php\nfunction compteMots(Schaine) {\n// Remplace les espaces, tabulations et retours à la ligne par des espace\n$chaine = preg_replace(\'/\\s+/\', \' \', $chaine);\n// Supprime les espaces au début et à la fin de la chaîne\nSchaine = trim($chaine);\n// Compte le nombre de mots en séparant la chaîne par les espaces\nSnombre_mots = str_word_count($chaine);\nreturn §nombre_mots;\n// Exemple d\'utilisation\n$chaine = \" Ceci est un exemple\nde phrase avec plusieurs mots.\necho \"Nombre de mots : \" . compteMots($chaine);\n?>'),
(12, 14, 4, '10', 'DFGHJK', 'function sommeEntiersPairs(Smin, Smax) €\n// Initialiser la somme à 0\n$somme = 0;\n// S\'assurer que Smin est le plus petit des deux nombres\nif (Smin > $max) (\nlist(Smin, Smax) = array(Smax, Smin); // Échanger les\n// Ajuster $min pour qu\'il soit pair si nécessaire\nif ($min % 2 |= 0) €\nSmin += 1; // Passer au prochain entier pair\n// Boucle pour additionner tous les entiers pairs entre $m\nfor ($i = Smin; $i <= Smax; Si += 2) C\n$somme += $i;\nreturn Ssomme;');

-- --------------------------------------------------------

--
-- Structure de la table `table_user`
--

CREATE TABLE `table_user` (
  `USER_ID` int(11) NOT NULL,
  `USER_EMAIL` varchar(100) DEFAULT NULL,
  `USER_PHONENUM` varchar(100) DEFAULT NULL,
  `USER_ROLE` int(11) DEFAULT 1,
  `USER_NAME` varchar(100) DEFAULT NULL,
  `USER_PASSWORD` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `table_user`
--

INSERT INTO `table_user` (`USER_ID`, `USER_EMAIL`, `USER_PHONENUM`, `USER_ROLE`, `USER_NAME`, `USER_PASSWORD`) VALUES
(5, 'karkoubsouhaila16@gmail.com', '12345678', 2, 'ghada', 'c68b016e51f201a351ad1cb09290dbb6'),
(36, 'admin@admin.com', '9090', 0, 'admin', 'e3afed0047b08059d0fada10f400c1e5'),
(37, 'takwa@takwa.com', '12345678', 3, 'takwa', '87a6034711c82eee7f6b22ee43bd590c'),
(38, 'dali@dali.com', '13345678', 2, 'dali', '9bc35fac5f3cb3f44fd2a9ffb5b834b4'),
(39, 'test@test.com', '12345678', 1, 'test', 'e1b849f9631ffc1829b2e31402373e3c'),
(41, 'ghalia@ghalia.com', '12345678', 1, 'ghalia', '966ff74a7cf1384ee6fbc22403d095c3'),
(42, 'dali.chabani@gmail.com', '12345678', 1, 'mohamedali', '9bc35fac5f3cb3f44fd2a9ffb5b834b4');

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
  ADD KEY `fk` (`id_post`),
  ADD KEY `authorC` (`authorC`);

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
-- Index pour la table `table_devoir`
--
ALTER TABLE `table_devoir`
  ADD PRIMARY KEY (`DEPOT_ID`);

--
-- Index pour la table `table_evaluation`
--
ALTER TABLE `table_evaluation`
  ADD PRIMARY KEY (`ID_EVALUATION`),
  ADD KEY `ID_DEPOT` (`ID_DEPOT`);

--
-- Index pour la table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID_Categorie` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `table_devoir`
--
ALTER TABLE `table_devoir`
  MODIFY `DEPOT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `table_evaluation`
--
ALTER TABLE `table_evaluation`
  MODIFY `ID_EVALUATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`authorC`) REFERENCES `table_user` (`USER_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorie` (`ID_Categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `table_evaluation`
--
ALTER TABLE `table_evaluation`
  ADD CONSTRAINT `table_evaluation_ibfk_1` FOREIGN KEY (`ID_DEPOT`) REFERENCES `table_devoir` (`DEPOT_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
