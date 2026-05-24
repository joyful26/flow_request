-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 23 mai 2026 à 09:29
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `geco_requete`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'APISIDI ABAKALAOU', 'JOSUE', 'apissidi@gmail.com', '$2y$10$oIKaG4h4/GdQbLiRTJI5V.cN5Foudyhc7j1p5MtmXSUBkyPv1cXlS'),
(2, 'DASSI PRINCE', 'EMANUEL', 'dassi@gmail.com', '$2y$10$jlGwejR8Lszn0kVh5hEJle4x7tKmT6807KACkSbL.fb1f3ygGrKJe');

-- --------------------------------------------------------

--
-- Structure de la table `associer`
--

CREATE TABLE `associer` (
  `id_requete` int(11) NOT NULL,
  `id_piece` int(11) NOT NULL,
  `id_association` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `associer`
--

INSERT INTO `associer` (`id_requete`, `id_piece`, `id_association`) VALUES
(11, 53, 11),
(12, 53, 12),
(16, 55, 16);

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

CREATE TABLE `cycle` (
  `id_cycle` int(11) NOT NULL,
  `libelle_cycle` varchar(50) NOT NULL,
  `niv_max` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`id_cycle`, `libelle_cycle`, `niv_max`, `id_admin`) VALUES
(1, 'LICENCE', 3, 1),
(2, 'MASTER RECHERCHE', 2, 1),
(3, 'MASTER PRO', 2, 1),
(4, 'DUT', 2, 1),
(5, 'BTS', 2, 1),
(6, 'LICENCE PRO', 3, 1),
(7, 'DOCTORAT', 5, 1),
(8, 'INGENIEUR', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_departement` int(11) NOT NULL,
  `libelle_departement` varchar(50) NOT NULL,
  `id_etablissement` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `abreviation_departement` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_departement`, `libelle_departement`, `id_etablissement`, `id_admin`, `abreviation_departement`) VALUES
(1, 'GENIE ALIMENTAIRE ET CONTROLE DE QUALITE', 12, 1, 'GACQ'),
(2, 'GENIE INFORMATIQUE', 12, 1, 'GIN'),
(3, 'GENIE ENERGETIQUE', 12, 1, 'GEN'),
(4, 'GENIE MECANIQUE', 12, 1, 'GIM'),
(5, 'GENIE CIVIL ET CONSTRUCTION DURABLE', 12, 1, 'GCD'),
(6, 'MAINTENANCE DES EQUIPEMENTS BIOMEDICAUX', 12, 1, 'MEB'),
(7, 'GENIE CHIMIQUE', 9, 1, 'GEC'),
(8, 'GENIE MINERALE', 9, 1, 'GEM'),
(9, 'SCIENCES DE GESTION', 8, 1, 'SG'),
(10, 'ECONOMIE', 8, 1, 'ECO'),
(11, 'GEOGRAPHIE', 2, 1, 'GEO'),
(12, 'HISTOIRE', 2, 1, 'HST'),
(13, 'SOCIOLOGIE ET ANTROPOLOGIE', 2, 1, 'SA'),
(14, 'LANGUES, LITTERATURES ET BILINGUISME', 2, 1, 'LLB'),
(15, 'MATHEMATIQUE INFORMATIQUE', 1, 1, 'DMI'),
(16, 'PHYSIQUE', 1, 1, 'PHY'),
(17, 'CHIMIE', 1, 1, 'CHI'),
(18, 'SCIENCE BIOLOGIQUE', 1, 1, 'BIO'),
(19, 'SCIENCE BIOMEDICALE, INFIRMIERE ET RADIOLOGIE', 1, 1, 'BIOMEDICAL'),
(20, 'SCIENCE DE LA TERRE', 1, 1, 'ST'),
(21, 'GENIE DES PROCEDE ET DE L\'ENVIRONNEMENT', 11, 1, 'GPE'),
(22, 'INDUSTRIE AGRO-ALIMENTAIRE', 11, 1, 'IAA'),
(23, 'MAINTENANCE ET INSTRUMENTATION', 11, 1, 'MI'),
(24, 'DROIT PRIVE', 5, 1, 'DP'),
(25, 'DROIT PUBLIC', 5, 1, 'DPR'),
(26, 'SCIENCE POLITIQUE', 5, 1, 'SCIENCEPO');

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

CREATE TABLE `etablissement` (
  `id_etablissement` int(11) NOT NULL,
  `libelle_etablissement` varchar(150) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `short_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id_etablissement`, `libelle_etablissement`, `id_admin`, `short_name`) VALUES
(1, 'FACULTE DES SCIENCES', 1, 'FS'),
(2, 'FACULTE DES LETTRES ET SCIENCES HUMAINES', 1, 'FALSH'),
(5, 'FACULTE DES SCIENCES JURIDIQUE ET POLITIQUE', 1, 'FSJP'),
(7, 'FACULTE DES SCIENCES DE L\'EDUCATION', 1, 'FSE'),
(8, 'FACULTE DES SCIENCES ECONOMIQUE ET DE GESTION', 1, 'FSEG'),
(9, 'ECOLE DE GENIE CHIMIQUE ET INDUSTRIE MINERALE', 1, 'EGCIM'),
(10, 'ECOLE DE GEOLOGIE ET DEGENIE MINERAL', 1, 'EGEM'),
(11, 'ECOLE NATIONAL SUPERIEURE DES SCIENCES AGRO-INDUSTRIELLE', 1, 'ENSAI'),
(12, 'INSTITUT UNIVERSITAIRE DE TECHNOLOGIE', 1, 'IUT'),
(13, 'ECOLE DES SCIENCE MEDICAL VETERINAIRE', 1, 'ESMV');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `contact` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `id_cycle` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `matricule`, `email`, `nom`, `prenom`, `contact`, `niveau`, `mdp`, `id_cycle`, `id_filiere`) VALUES
(5, '23a654fs', 'apissidi@gmail.com', 'apissidi', 'apissidi', 692877603, 3, '$2y$10$dYBbiULJ5iHFei34SVqzkOYgoXW4weFBpvQqKm4.q4wLkQo9tuOIW', 1, 39),
(6, '23a655fs', 'josue@gmail.com', 'josue', 'josue', 692877603, 3, '$2y$10$vxD5Vx59yMJcg./JOTI/vuFVuidVuDT/bCVRJcOkK//9rJQ0Sx/IC', 1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `libelle_filiere` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `abreviation_filiere` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `libelle_filiere`, `id_admin`, `id_departement`, `abreviation_filiere`) VALUES
(1, 'GENIE BIOLOGIQUE', 1, 1, 'GBIO'),
(2, 'ANALYSES BIOLOGIQUES ET BIOCHIMIQUES', 1, 1, 'ABB'),
(3, 'GENIE DE L\'ENVIRONNEMENT', 1, 1, 'GENV'),
(4, 'RESEAUX ET TELECOMUNICATION', 1, 2, 'RT'),
(5, 'GENIE LOGICIEL', 1, 2, 'GLO'),
(6, 'TELECOMUNICATION', 1, 2, 'TELECOM'),
(7, 'ADMINISTRATION RESEAU', 1, 2, 'ADR'),
(8, 'GENIE THERMIQUE ET ENERGETIQUE', 1, 3, 'GTE'),
(9, 'ENERGIES RENOUVELABLE', 1, 3, 'ENR'),
(10, 'GENIE ELECTRIQUE', 1, 4, 'GEL'),
(11, 'GENIE MECANIQUE', 1, 4, 'GM'),
(12, 'MAINTENANCE INDUSTRIELLE ET PRODUCTIQUE', 1, 4, 'MIP'),
(13, 'BATIMENT ET TRAVAUX PUBLICS', 1, 5, 'BTP'),
(14, 'GEOTECHNIQUE', 1, 5, 'GEOTECH'),
(15, 'GENIE DES PROCEDE', 1, 7, 'GEP'),
(16, 'GENIE DES MINES', 1, 8, 'GM'),
(17, 'COMPTABILITE ET FINANCE', 1, 9, 'CF'),
(18, 'MARKETING', 1, 9, 'MKT'),
(19, 'GESTION DES RESSOURCES HUMAINES', 1, 9, 'GRH'),
(20, 'MANAGEMENT ET ORGANISATIONS', 1, 9, 'MO'),
(21, 'BANQUE ET ASSURANCE', 1, 9, 'BA'),
(22, 'ECONOMIE INTERNATIONALE', 1, 10, 'ECOINT'),
(23, 'ECONOMIE MONETAIRE ET BANCAIRE', 1, 10, 'ECOMB'),
(24, 'ECONOMIE DE L\'ENVIRONNEMENT', 1, 10, 'ECOENV'),
(25, 'ECONOMIE MATHEMATIQUE', 1, 10, 'ECOMATH'),
(26, 'GEOGRAPHIE PHYSIQUE', 1, 11, 'GP'),
(27, 'GEOGRAPHIE HUMAINE', 1, 11, 'GH'),
(28, 'AMENAGEMENT DU TERRITOIRE ET URBANISME', 1, 11, 'ATU'),
(29, 'CARTOGRAPHIET SIG', 1, 11, 'CSIG'),
(30, 'HISTOIRE POLITIQUE', 1, 12, 'HSTPO'),
(31, 'HISTOIRE ECONOMIQUE ET SOCIALE', 1, 12, 'HSTECOSO'),
(32, 'ARCHEOLOGIE ET PATRIMOINE CULTUREL', 1, 12, 'APC'),
(33, 'SOCIOLOGIE DU DEVELOPPEMENT', 1, 13, 'SD'),
(34, 'ANTROPOLOGIE CULTURELLE', 1, 13, 'AC'),
(35, 'ETUDE BILINGUE', 1, 14, 'EB'),
(36, 'LITTERATURE NEGRO-AFRICAINE', 1, 14, 'LNA'),
(37, 'LANGUES MODERNES', 1, 14, 'LM'),
(38, 'MATHEMATIQUE FONDAMENTALE', 1, 15, 'MATH'),
(39, 'INFORMATIQUE FONDAMENTALE', 1, 15, 'INF'),
(40, 'INTELLIGENCE ARTIFICIELLE', 1, 15, 'IA'),
(41, 'PHYSIQUE DES MATERIAUX', 1, 16, 'PHYM'),
(42, 'ENERGIE ET ELECTRONIQUE', 1, 16, 'EE'),
(43, 'CHIMIE ORGANIQUE', 1, 17, 'CHO'),
(44, 'CHIMIE INORGANIQUE', 1, 17, 'CHIO'),
(45, 'CHIMIE PHYSIQUE', 1, 17, 'CHP'),
(46, 'BIOCHIMIE', 1, 18, 'BIOCHIMIE'),
(47, 'MICROBIOLOGIE', 1, 18, 'MBIO'),
(48, 'BIOLOGIE ANIMALE', 1, 18, 'BA'),
(49, 'BIOLOGIE VEGETALE', 1, 18, 'BV'),
(50, 'GEOLOGIE FONDAMENTALE', 1, 20, 'GEO'),
(51, 'HYDROLOGIE', 1, 20, 'HYDRO'),
(52, 'RESSOURCES MINIÈRES', 1, 20, 'RM'),
(53, 'INGENIEUR EN GENIE DES PROCEDE', 1, 21, 'IGP'),
(54, 'ENVIRONNEMENT INDUSTRIEL', 1, 21, 'EO');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `matricule` varchar(50) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `contenu`, `id_admin`, `matricule`, `date_message`) VALUES
(30, 'premier message', 1, '23a655fs', '2026-05-22 17:19:55'),
(31, 'dexieme message', 1, '23a655fs', '2026-05-22 18:08:21'),
(34, 'message3', 1, '23a655fs', '2026-05-23 07:15:35'),
(35, 'message 4', 1, '23a655fs', '2026-05-23 07:16:52'),
(36, 'message5', 1, '23a655fs', '2026-05-23 07:17:01');

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `id_objet` int(11) NOT NULL,
  `libelle_objet` varchar(50) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`id_objet`, `libelle_objet`, `id_admin`) VALUES
(1, 'DEMANDE DE PUBLICATION DE NOTES', 1),
(2, 'DEMANDE DE PERMISSION D\'ABSCENCE', 1);

-- --------------------------------------------------------

--
-- Structure de la table `piece_jointe`
--

CREATE TABLE `piece_jointe` (
  `id_piece` int(11) NOT NULL,
  `libelle_piece` varchar(50) NOT NULL,
  `annee` varchar(50) NOT NULL,
  `semestre` varchar(50) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `chemin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `piece_jointe`
--

INSERT INTO `piece_jointe` (`id_piece`, `libelle_piece`, `annee`, `semestre`, `matricule`, `chemin`) VALUES
(53, 'releve', '2024-2025', 'Semestre 2', '23a654fs', 'upload/23a654fs--apissidi--apissidi/'),
(55, 'releve ', '2026-2027', 'Semestre 1 & 2', '23a655fs', 'upload/23a655fs--josue--josue/');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `id_admin_r` int(11) NOT NULL,
  `matricule_r` varchar(50) NOT NULL,
  `contenu_r` text NOT NULL,
  `date_reponse` datetime NOT NULL DEFAULT current_timestamp(),
  `id_message_r` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `id_admin_r`, `matricule_r`, `contenu_r`, `date_reponse`, `id_message_r`) VALUES
(9, 1, '23a655fs', 'reponse1', '2026-05-22 18:00:37', 30),
(10, 1, '23a655fs', 'reponse2', '2026-05-22 18:01:17', 30);

-- --------------------------------------------------------

--
-- Structure de la table `requete`
--

CREATE TABLE `requete` (
  `id_requete` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_etudiant` int(11) DEFAULT NULL,
  `matricule` varchar(50) NOT NULL,
  `id_objet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `requete`
--

INSERT INTO `requete` (`id_requete`, `id_admin`, `id_etudiant`, `matricule`, `id_objet`) VALUES
(11, 2, NULL, '23a654fs', 1),
(12, 1, NULL, '23a654fs', 1),
(13, 1, NULL, '23a655fs', 1),
(14, 1, NULL, '23a655fs', 1),
(15, 1, NULL, '23a655fs', 1),
(16, 1, NULL, '23a655fs', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `matricule` (`email`);

--
-- Index pour la table `associer`
--
ALTER TABLE `associer`
  ADD UNIQUE KEY `id_association` (`id_association`),
  ADD KEY `id_piece` (`id_piece`);

--
-- Index pour la table `cycle`
--
ALTER TABLE `cycle`
  ADD PRIMARY KEY (`id_cycle`),
  ADD UNIQUE KEY `libelle_cylce` (`libelle_cycle`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`),
  ADD KEY `id_etablissement` (`id_etablissement`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD PRIMARY KEY (`id_etablissement`),
  ADD UNIQUE KEY `libelle_etablissement` (`libelle_etablissement`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`,`matricule`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_cycle` (`id_cycle`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`id_objet`),
  ADD UNIQUE KEY `libelle_objet` (`libelle_objet`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Index pour la table `piece_jointe`
--
ALTER TABLE `piece_jointe`
  ADD PRIMARY KEY (`id_piece`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_reponse`);

--
-- Index pour la table `requete`
--
ALTER TABLE `requete`
  ADD PRIMARY KEY (`id_requete`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_objet` (`id_objet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `associer`
--
ALTER TABLE `associer`
  MODIFY `id_association` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `cycle`
--
ALTER TABLE `cycle`
  MODIFY `id_cycle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `etablissement`
--
ALTER TABLE `etablissement`
  MODIFY `id_etablissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `objet`
--
ALTER TABLE `objet`
  MODIFY `id_objet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `piece_jointe`
--
ALTER TABLE `piece_jointe`
  MODIFY `id_piece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `requete`
--
ALTER TABLE `requete`
  MODIFY `id_requete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `associer`
--
ALTER TABLE `associer`
  ADD CONSTRAINT `associer_ibfk_1` FOREIGN KEY (`id_requete`) REFERENCES `requete` (`id_requete`) ON DELETE CASCADE,
  ADD CONSTRAINT `associer_ibfk_2` FOREIGN KEY (`id_piece`) REFERENCES `piece_jointe` (`id_piece`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cycle`
--
ALTER TABLE `cycle`
  ADD CONSTRAINT `cycle_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`);

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_etablissement`) REFERENCES `etablissement` (`id_etablissement`) ON DELETE CASCADE,
  ADD CONSTRAINT `departement_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`);

--
-- Contraintes pour la table `etablissement`
--
ALTER TABLE `etablissement`
  ADD CONSTRAINT `etablissement_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_cycle`) REFERENCES `cycle` (`id_cycle`) ON DELETE CASCADE,
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE;

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`),
  ADD CONSTRAINT `filiere_ibfk_2` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objet`
--
ALTER TABLE `objet`
  ADD CONSTRAINT `objet_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`);

--
-- Contraintes pour la table `piece_jointe`
--
ALTER TABLE `piece_jointe`
  ADD CONSTRAINT `piece_jointe_ibfk_1` FOREIGN KEY (`id_dosssier`) REFERENCES `dossier` (`id_dosssier`) ON DELETE CASCADE,
  ADD CONSTRAINT `piece_jointe_ibfk_2` FOREIGN KEY (`id_etudiant`,`matricule`) REFERENCES `etudiant` (`id_etudiant`, `matricule`) ON DELETE CASCADE;

--
-- Contraintes pour la table `requete`
--
ALTER TABLE `requete`
  ADD CONSTRAINT `requete_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`),
  ADD CONSTRAINT `requete_ibfk_2` FOREIGN KEY (`id_etudiant`,`matricule`) REFERENCES `etudiant` (`id_etudiant`, `matricule`) ON DELETE CASCADE,
  ADD CONSTRAINT `requete_ibfk_3` FOREIGN KEY (`id_objet`) REFERENCES `objet` (`id_objet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
