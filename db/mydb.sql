-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : sam. 20 mai 2023 à 20:28
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mydb`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouter_candidat_utilisateur` (IN `p_candidat_nom` VARCHAR(255), IN `p_candidat_prenom` VARCHAR(255), IN `p_candidat_dateNaiss` DATE, IN `p_candidat_telephone` VARCHAR(20), IN `p_candidat_email` VARCHAR(255), IN `p_candidat_dateInscription` DATE, IN `p_candidat_ville` VARCHAR(255), IN `p_candidat_photo` VARCHAR(255), IN `p_candidat_mote_pass` VARCHAR(255))   BEGIN
  DECLARE utilisateur_id INT;

  -- Insère la ligne dans la table "utilisateur"
  INSERT INTO utilisateur (
    utilisateur_email,
    utilisateur_motpass,
    utilisateur_type
  ) VALUES (
    p_candidat_email,
    p_candidat_mote_pass,
    'candidat'
  );

  -- Récupère l'ID de l'utilisateur inséré
  SET utilisateur_id = LAST_INSERT_ID();

  -- Insère la ligne dans la table "candidat"
  INSERT INTO candidat (
    candidat_nom,
    candidat_prenom,
    candidat_dateNaiss,
    candidat_telephone,
    candidat_email,
    candidat_dateInscription,
    candidat_ville,
    candidat_photo,
    utilisateur_id,
    candidat_mote_pass
  ) VALUES (
    p_candidat_nom,
    p_candidat_prenom,
    p_candidat_dateNaiss,
    p_candidat_telephone,
    p_candidat_email,
    p_candidat_dateInscription,
    p_candidat_ville,
    p_candidat_photo,
    utilisateur_id,
    p_candidat_mote_pass
  );
  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `candidat_id` int(11) NOT NULL,
  `candidat_nom` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `candidat_prenom` varchar(45) NOT NULL,
  `candidat_dateNaiss` date NOT NULL,
  `candidat_telephone` varchar(45) NOT NULL,
  `candidat_email` varchar(45) NOT NULL,
  `candidat_dateInscription` date DEFAULT NULL,
  `candidat_ville` varchar(45) NOT NULL,
  `candidat_photo` varchar(45) NOT NULL,
  `candidat_mote_pass` varchar(45) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `modePaiement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`candidat_id`, `candidat_nom`, `candidat_prenom`, `candidat_dateNaiss`, `candidat_telephone`, `candidat_email`, `candidat_dateInscription`, `candidat_ville`, `candidat_photo`, `candidat_mote_pass`, `utilisateur_id`, `modePaiement_id`) VALUES
(7, 'raid', 'lynda', '0000-00-00', '06606665450', 'lindaraid.01@gmail.com', '0000-00-00', 'beni maouche', '', '1234', 6, NULL),
(9, 'raid', 'fatima', '1996-07-28', '0660502501', 'raidfatima@gmail.com', '2023-05-15', 'beni maouche', '', '1234', 9, NULL),
(10, 'tazibet', 'manel', '2001-08-24', '0660535231', 'tazibetmanel.09@gmail.com', '2023-05-15', 'sidi  ahmed', '', 'manel', 10, NULL),
(11, 'tazibet', 'manel', '2001-08-24', '0660535231', 'tazibetmanel.09@gmail.com', '2023-05-15', 'sidi  ahmed', '', 'manel', 11, NULL),
(12, 'raid', 'yahia', '1998-11-02', '0666523257', 'raidyahia9@gmail.com', '2023-05-15', 'Beni maouche', '_MG_4415.JPG', '$2y$10$/yOtcS/FLu3m.GcCGd1fIOzilVsawQUGAfSf7d', 12, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `candidat_has_cours`
--

CREATE TABLE `candidat_has_cours` (
  `candidat_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `cours_id` int(11) NOT NULL,
  `cours_typeCours` varchar(45) NOT NULL,
  `cours_date` date NOT NULL,
  `cours_heure_debut` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cours_heure_fin` time NOT NULL,
  `moniteur_id` int(11) NOT NULL,
  `typePermis_id` int(11) NOT NULL,
  `planning_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`cours_id`, `cours_typeCours`, `cours_date`, `cours_heure_debut`, `cours_heure_fin`, `moniteur_id`, `typePermis_id`, `planning_id`) VALUES
(1, 'code', '2023-05-02', '2023-05-17 13:18:10', '19:18:10', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `exemen`
--

CREATE TABLE `exemen` (
  `exemen_id` int(11) NOT NULL,
  `exemen_date` date NOT NULL,
  `exemen_lieu` varchar(100) NOT NULL,
  `exemen_type` varchar(45) NOT NULL,
  `exemen_resultat` varchar(45) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `typePermis_id` int(11) NOT NULL,
  `moniteur_id` int(11) NOT NULL,
  `planning_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `exemen`
--

INSERT INTO `exemen` (`exemen_id`, `exemen_date`, `exemen_lieu`, `exemen_type`, `exemen_resultat`, `candidat_id`, `typePermis_id`, `moniteur_id`, `planning_id`) VALUES
(1, '2023-05-08', 'auto ecole', 'surcilation', '10', 10, 1, 1, 1),
(2, '2023-05-10', 'auto ecole', 'surcilation', '10', 10, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `facture_id` int(11) NOT NULL,
  `facture_emission` date DEFAULT NULL,
  `facture_montant_paye` float DEFAULT NULL,
  `facture_montant_total` float DEFAULT NULL,
  `facture_status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`facture_id`, `facture_emission`, `facture_montant_paye`, `facture_montant_total`, `facture_status`) VALUES
(1, '2023-05-22', 120, 23000, 'Payée'),
(2, '2023-05-22', 120, 23000, 'Payée'),
(3, '2023-05-22', 120, 23000, 'Payée'),
(4, '2023-05-23', 400, 23000, 'Payée'),
(5, '2023-05-16', 1500, 23000, 'Payée'),
(6, '2023-05-03', 1500, 23000, 'Payée'),
(7, '2023-05-03', 1200, 23000, 'Non payée'),
(8, '2023-05-02', 2000, 4000, 'Payée');

-- --------------------------------------------------------

--
-- Structure de la table `local`
--

CREATE TABLE `local` (
  `local_id` int(11) NOT NULL,
  `local_nom` varchar(45) NOT NULL,
  `local_adresse` varchar(45) NOT NULL,
  `local_capacite` int(11) NOT NULL,
  `local_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `local`
--

INSERT INTO `local` (`local_id`, `local_nom`, `local_adresse`, `local_capacite`, `local_type`) VALUES
(1, 'Auto Ecole Bejaia', '123 Rue des Auto-Écoles', 50, 'Auto-École'),
(2, 'Stade Targa Ouzmour ', 'Stade Targa Ouzmour bejaia', 12, 'Auto-École'),
(3, 'auto ecole Karim', 'Naciria bejaia', 5, 'auto ecole');

-- --------------------------------------------------------

--
-- Structure de la table `modepaiement`
--

CREATE TABLE `modepaiement` (
  `modePaiement_id` int(11) NOT NULL,
  `modePaiement_nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moniteur`
--

CREATE TABLE `moniteur` (
  `moniteur_id` int(11) NOT NULL,
  `moniteur_nom` varchar(45) NOT NULL,
  `moniteur_prenom` varchar(45) NOT NULL,
  `moniteur_telephone` varchar(16) NOT NULL,
  `moniteur_adresse` varchar(45) DEFAULT NULL,
  `moniteur_codePostal` varchar(10) NOT NULL,
  `moniteur_ville` varchar(45) NOT NULL,
  `moniteur_email` varchar(100) NOT NULL,
  `moniteur_mot_pass` varchar(45) DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `moniteur`
--

INSERT INTO `moniteur` (`moniteur_id`, `moniteur_nom`, `moniteur_prenom`, `moniteur_telephone`, `moniteur_adresse`, `moniteur_codePostal`, `moniteur_ville`, `moniteur_email`, `moniteur_mot_pass`, `utilisateur_id`) VALUES
(1, 'khaled', 'Bedjou', '0712345003', 'stade ', '06000', 'bejaia', 'moniteur@gmail.com', 'm', 13);

-- --------------------------------------------------------

--
-- Structure de la table `paiemnt`
--

CREATE TABLE `paiemnt` (
  `paiemnt_id` int(11) NOT NULL,
  `facture_id` int(100) NOT NULL,
  `modePaiement_id` int(11) DEFAULT NULL,
  `candidat_id` int(11) NOT NULL,
  `typePermis_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `paiemnt`
--

INSERT INTO `paiemnt` (`paiemnt_id`, `facture_id`, `modePaiement_id`, `candidat_id`, `typePermis_id`) VALUES
(1, 1, NULL, 7, 1),
(2, 4, NULL, 7, 1),
(3, 5, NULL, 10, 1),
(4, 7, NULL, 7, 1),
(5, 8, NULL, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `permis`
--

CREATE TABLE `permis` (
  `permis_id` int(11) NOT NULL,
  `permis_date_Obt` date NOT NULL,
  `typePermis_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `planning_id` int(10) UNSIGNED NOT NULL,
  `planning_date` date NOT NULL,
  `planning_heure_debut` time NOT NULL,
  `planning_heure_fin` time NOT NULL,
  `vehicule_vehicule_id` int(11) NOT NULL,
  `local_local_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`planning_id`, `planning_date`, `planning_heure_debut`, `planning_heure_fin`, `vehicule_vehicule_id`, `local_local_id`) VALUES
(1, '2023-05-07', '11:50:30', '17:50:30', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

CREATE TABLE `secretaire` (
  `secretaire_id` int(11) NOT NULL,
  `secretaire_nom` varchar(45) NOT NULL,
  `secretaire_prenom` varchar(45) NOT NULL,
  `secretaire_email` varchar(45) NOT NULL,
  `secretaire_adresse` varchar(45) NOT NULL,
  `secretaire_telephone` varchar(45) NOT NULL,
  `secretaire_mot_pass` varchar(45) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `secretaire`
--

INSERT INTO `secretaire` (`secretaire_id`, `secretaire_nom`, `secretaire_prenom`, `secretaire_email`, `secretaire_adresse`, `secretaire_telephone`, `secretaire_mot_pass`, `utilisateur_id`) VALUES
(2, 'Abas', 'rania', 'secretaire@gmail.com', 'bouira', '0666664523', 's', 15);

-- --------------------------------------------------------

--
-- Structure de la table `typepermis`
--

CREATE TABLE `typepermis` (
  `typePermis_id` int(11) NOT NULL,
  `typePermis_nom` varchar(45) NOT NULL,
  `typePermis_description` varchar(45) NOT NULL,
  `typePermis_prixBase` float NOT NULL,
  `typePermis_typePermis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `typepermis`
--

INSERT INTO `typepermis` (`typePermis_id`, `typePermis_nom`, `typePermis_description`, `typePermis_prixBase`, `typePermis_typePermis_id`) VALUES
(1, 'permis A1', 'kjbgu', 120, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Utilisateur_id` int(11) NOT NULL,
  `Utilisateur_email` varchar(45) NOT NULL,
  `Utilisateur_MotPass` varchar(45) NOT NULL,
  `Utilisateur_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Utilisateur_id`, `Utilisateur_email`, `Utilisateur_MotPass`, `Utilisateur_type`) VALUES
(1, 'jean.dupont@example.com', 'password123', 'candidat'),
(6, 'lindaraid.01@gmail.com', '1234', 'candidat'),
(8, 'admin@gamil.com', 'admin', 'admin'),
(9, 'raidfatima@gmail.com', '1234', 'candidat'),
(10, 'tazibetmanel.09@gmail.com', 'manel', 'candidat'),
(11, 'tazibetmanel.09@gmail.com', 'manel', 'candidat'),
(12, 'raidyahia9@gmail.com', '$2y$10$/yOtcS/FLu3m.GcCGd1fIOzilVsawQUGAfSf7d', 'candidat'),
(13, 'moniteur@gmail.com', 'm', 'moniteur'),
(14, 'secretaire@gmail.com', 's', 'secretraire'),
(15, 'secretaire@gmail.com', 's', 'secretaire');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `vehicule_id` int(11) NOT NULL,
  `vehicule_marque` varchar(45) NOT NULL,
  `vehicule_modele` varchar(45) NOT NULL,
  `vehicule_annee` varchar(45) NOT NULL,
  `vehicule_permis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`vehicule_id`, `vehicule_marque`, `vehicule_modele`, `vehicule_annee`, `vehicule_permis`) VALUES
(1, 'toyota', 'toyota.5', '2016', 'permisA'),
(2, 'dfghbjn,', 'sdfcgvhbn,;:', '4523', 'putf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`candidat_id`),
  ADD KEY `fk_candidat_utilisateur` (`utilisateur_id`),
  ADD KEY `fk_candidat_modePaiement1` (`modePaiement_id`);

--
-- Index pour la table `candidat_has_cours`
--
ALTER TABLE `candidat_has_cours`
  ADD PRIMARY KEY (`candidat_id`,`cours_id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`cours_id`),
  ADD KEY `fk_typePremis_id_cours1` (`typePermis_id`),
  ADD KEY `fk_moniteur_id_cours` (`moniteur_id`),
  ADD KEY `fk_planning_id_cours` (`planning_id`);

--
-- Index pour la table `exemen`
--
ALTER TABLE `exemen`
  ADD PRIMARY KEY (`exemen_id`),
  ADD KEY `fk_typePermis_id` (`typePermis_id`),
  ADD KEY `fk_candidat_id_exemen` (`candidat_id`),
  ADD KEY `fk_moniteur_id_exemen` (`moniteur_id`),
  ADD KEY `fk_planning_id_exemen` (`planning_id`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`facture_id`);

--
-- Index pour la table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`local_id`);

--
-- Index pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  ADD PRIMARY KEY (`modePaiement_id`);

--
-- Index pour la table `moniteur`
--
ALTER TABLE `moniteur`
  ADD PRIMARY KEY (`moniteur_id`),
  ADD KEY `fk_moniteur_id_utilisatuer` (`utilisateur_id`);

--
-- Index pour la table `paiemnt`
--
ALTER TABLE `paiemnt`
  ADD PRIMARY KEY (`paiemnt_id`),
  ADD KEY `fk_facture_id` (`facture_id`),
  ADD KEY `fk_modepaiement_id` (`modePaiement_id`),
  ADD KEY `fk_candidat_id` (`candidat_id`),
  ADD KEY `fk_typePremis_id` (`typePermis_id`);

--
-- Index pour la table `permis`
--
ALTER TABLE `permis`
  ADD PRIMARY KEY (`permis_id`),
  ADD KEY `fk_permis_id_candidat` (`candidat_id`),
  ADD KEY `fk_TypePermis_id_Permis` (`typePermis_id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`planning_id`),
  ADD KEY `fk_local_id_planning` (`local_local_id`),
  ADD KEY `fk_vihecule_id_planning` (`vehicule_vehicule_id`);

--
-- Index pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD PRIMARY KEY (`secretaire_id`),
  ADD KEY `fk_utilisateur_id_secretaire` (`utilisateur_id`);

--
-- Index pour la table `typepermis`
--
ALTER TABLE `typepermis`
  ADD PRIMARY KEY (`typePermis_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Utilisateur_id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`vehicule_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `candidat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `cours_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `exemen`
--
ALTER TABLE `exemen`
  MODIFY `exemen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `local`
--
ALTER TABLE `local`
  MODIFY `local_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  MODIFY `modePaiement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `moniteur`
--
ALTER TABLE `moniteur`
  MODIFY `moniteur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paiemnt`
--
ALTER TABLE `paiemnt`
  MODIFY `paiemnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `permis`
--
ALTER TABLE `permis`
  MODIFY `permis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `planning_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `secretaire`
--
ALTER TABLE `secretaire`
  MODIFY `secretaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typepermis`
--
ALTER TABLE `typepermis`
  MODIFY `typePermis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `Utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `vehicule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `fk_candidat_modePaiement1` FOREIGN KEY (`modePaiement_id`) REFERENCES `modepaiement` (`modePaiement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_candidat_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`Utilisateur_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_moniteur_id_cours` FOREIGN KEY (`moniteur_id`) REFERENCES `moniteur` (`moniteur_id`),
  ADD CONSTRAINT `fk_planning_id_cours` FOREIGN KEY (`planning_id`) REFERENCES `planning` (`planning_id`),
  ADD CONSTRAINT `fk_typePremis_id_cours` FOREIGN KEY (`typePermis_id`) REFERENCES `typepermis` (`typePermis_id`),
  ADD CONSTRAINT `fk_typePremis_id_cours1` FOREIGN KEY (`typePermis_id`) REFERENCES `typepermis` (`typePermis_id`);

--
-- Contraintes pour la table `exemen`
--
ALTER TABLE `exemen`
  ADD CONSTRAINT `fk_candidat_id_exemen` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`candidat_id`),
  ADD CONSTRAINT `fk_moniteur_id_exemen` FOREIGN KEY (`moniteur_id`) REFERENCES `moniteur` (`moniteur_id`),
  ADD CONSTRAINT `fk_planning_id_exemen` FOREIGN KEY (`planning_id`) REFERENCES `planning` (`planning_id`),
  ADD CONSTRAINT `fk_typePermis_id` FOREIGN KEY (`typePermis_id`) REFERENCES `typepermis` (`typePermis_id`);

--
-- Contraintes pour la table `moniteur`
--
ALTER TABLE `moniteur`
  ADD CONSTRAINT `fk_moniteur_Utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`Utilisateur_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_moniteur_id_utilisatuer` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`Utilisateur_id`);

--
-- Contraintes pour la table `paiemnt`
--
ALTER TABLE `paiemnt`
  ADD CONSTRAINT `fk_candidat_id` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`candidat_id`),
  ADD CONSTRAINT `fk_facture_id` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`facture_id`),
  ADD CONSTRAINT `fk_modepaiement_id` FOREIGN KEY (`modePaiement_id`) REFERENCES `modepaiement` (`modePaiement_id`),
  ADD CONSTRAINT `fk_typePremis_id` FOREIGN KEY (`typePermis_id`) REFERENCES `typepermis` (`typePermis_id`);

--
-- Contraintes pour la table `permis`
--
ALTER TABLE `permis`
  ADD CONSTRAINT `fk_TypePermis_id_Permis` FOREIGN KEY (`typePermis_id`) REFERENCES `typepermis` (`typePermis_id`),
  ADD CONSTRAINT `fk_permis_id_candidat` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`candidat_id`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `fk_local_id_planning` FOREIGN KEY (`local_local_id`) REFERENCES `local` (`local_id`),
  ADD CONSTRAINT `fk_vihecule_id_planning` FOREIGN KEY (`vehicule_vehicule_id`) REFERENCES `vehicule` (`vehicule_id`);

--
-- Contraintes pour la table `secretaire`
--
ALTER TABLE `secretaire`
  ADD CONSTRAINT `fk_secretaire_Utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`Utilisateur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilisateur_id_secretaire` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`Utilisateur_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
