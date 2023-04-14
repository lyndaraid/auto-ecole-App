-- MySQL Workbench Synchronization
-- Generated: 2023-04-07 17:54
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: MON PC

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `mydb`.`candidat` (
  `candidat_id` INT(11) NOT NULL AUTO_INCREMENT,
  `candidat_nom` VARCHAR(45) BINARY NOT NULL,
  `candidat_prenom` VARCHAR(45) NOT NULL,
  `candidat_dateNaiss` DATE NOT NULL,
  `candidat_telephone` VARCHAR(45) NOT NULL,
  `candidat_email` VARCHAR(45) NOT NULL,
  `candidat_dateInscription` DATE NULL DEFAULT NULL,
  `candidat_ville` VARCHAR(45) NOT NULL,
  `candidat_photo` VARCHAR(45) NOT NULL,
  `candidat_mote_pass` VARCHAR(45) NOT NULL,
  `Utilisateur_id` VARCHAR(45) NULL DEFAULT NULL,
  `modePaiement_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`candidat_id`),
  INDEX `fk_candidat_Utilisateur1_idx` (`Utilisateur_id` ASC) INVISIBLE,
  INDEX `fk_candidat_modePaiement1_idx` (`modePaiement_id` ASC) INVISIBLE,
  CONSTRAINT `fk_candidat_Utilisateur1`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`Utilisateur_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_candidat_modePaiement1`
    FOREIGN KEY (`modePaiement_id`)
    REFERENCES `mydb`.`modePaiement` (`modePaiement_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`exemen` (
  `exemen_id` INT(11) NOT NULL AUTO_INCREMENT,
  `exemen_date` DATE NOT NULL,
  `exemen_lieu` VARCHAR(100) NOT NULL,
  `exemen_type` VARCHAR(45) NOT NULL,
  `exemen_resultat` VARCHAR(45) NOT NULL,
  `candidat_id` INT(11) NOT NULL,
  `typePermis_id` INT(11) NOT NULL,
  `moniteur_id` INT(11) NOT NULL,
  `planning_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`exemen_id`, `candidat_id`, `typePermis_id`, `moniteur_id`, `planning_id`),
  INDEX `fk_exemen_candidat_idx` (`candidat_id` ASC) VISIBLE,
  INDEX `fk_exemen_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
  INDEX `fk_exemen_moniteur1_idx` (`moniteur_id` ASC) VISIBLE,
  INDEX `fk_exemen_planning1_idx` (`planning_id` ASC) VISIBLE,
  CONSTRAINT `fk_exemen_candidat`
    FOREIGN KEY (`candidat_id`)
    REFERENCES `mydb`.`candidat` (`candidat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_exemen_typePermis1`
    FOREIGN KEY (`typePermis_id`)
    REFERENCES `mydb`.`typePermis` (`typePermis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_exemen_moniteur1`
    FOREIGN KEY (`moniteur_id`)
    REFERENCES `mydb`.`moniteur` (`moniteur_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_exemen_planning1`
    FOREIGN KEY (`planning_id`)
    REFERENCES `mydb`.`planning` (`planning_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`local` (
  `local_id` INT(11) NOT NULL AUTO_INCREMENT,
  `local_nom` VARCHAR(45) NOT NULL,
  `local_adresse` VARCHAR(45) NOT NULL,
  `local_capacite` INT(11) NOT NULL,
  `local_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`local_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`vehicule` (
  `vehicule_id` INT(11) NOT NULL AUTO_INCREMENT,
  `vehicule_marque` VARCHAR(45) NOT NULL,
  `vehicule_modele` VARCHAR(45) NOT NULL,
  `vehicule_annee` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`vehicule_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`typePermis` (
  `typePermis_id` INT(11) NOT NULL AUTO_INCREMENT,
  `typePermis_nom` VARCHAR(45) NOT NULL,
  `typePermis_description` VARCHAR(45) NOT NULL,
  `typePermis_prixBase` FLOAT(11) NOT NULL,
  `typePermis_typePermis_id` INT(11) NOT NULL,
  PRIMARY KEY (`typePermis_id`, `typePermis_typePermis_id`),
  INDEX `fk_typePermis_typePermis1_idx` (`typePermis_typePermis_id` ASC) VISIBLE,
  CONSTRAINT `fk_typePermis_typePermis1`
    FOREIGN KEY (`typePermis_typePermis_id`)
    REFERENCES `mydb`.`typePermis` (`typePermis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`moniteur` (
  `moniteur_id` INT(11) NOT NULL,
  `moniteur_nom` VARCHAR(45) NOT NULL,
  `moniteur_prenom` VARCHAR(45) NOT NULL,
  `moniteur_telephone` VARCHAR(16) NOT NULL,
  `moniteur_adresse` VARCHAR(45) NULL DEFAULT NULL,
  `moniteur_codePostal` VARCHAR(10) NOT NULL,
  `moniteur_ville` VARCHAR(45) NOT NULL,
  `moniteur_email` VARCHAR(100) NOT NULL,
  `Utilisateur_id` INT(11) NULL DEFAULT NULL,
  `moniteur_mot_pass` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`moniteur_id`),
  INDEX `fk_moniteur_Utilisateur1_idx` (`Utilisateur_id` ASC) VISIBLE,
  CONSTRAINT `fk_moniteur_Utilisateur1`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`Utilisateur_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`cours` (
  `cours_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cours_typeCours` VARCHAR(45) NOT NULL,
  `cours_date` DATE NOT NULL,
  `cours_heure_debut` TIMESTAMP NOT NULL,
  `cours_heure_fin` TIME NOT NULL,
  `moniteur_id` INT(11) NOT NULL,
  `typePermis_id` INT(11) NOT NULL,
  `planning_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`cours_id`, `moniteur_id`, `typePermis_id`, `planning_id`),
  INDEX `fk_cours_moniteur1_idx` (`moniteur_id` ASC) VISIBLE,
  INDEX `fk_cours_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
  INDEX `fk_cours_planning1_idx` (`planning_id` ASC) VISIBLE,
  CONSTRAINT `fk_cours_moniteur1`
    FOREIGN KEY (`moniteur_id`)
    REFERENCES `mydb`.`moniteur` (`moniteur_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cours_typePermis1`
    FOREIGN KEY (`typePermis_id`)
    REFERENCES `mydb`.`typePermis` (`typePermis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cours_planning1`
    FOREIGN KEY (`planning_id`)
    REFERENCES `mydb`.`planning` (`planning_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`planning` (
  `planning_id` INT(10) UNSIGNED NOT NULL,
  `planning_date` DATE NOT NULL,
  `planning_heure_debut` TIME NOT NULL,
  `planning_heure_fin` TIME NOT NULL,
  `vehicule_vehicule_id` INT(11) NOT NULL,
  `local_local_id` INT(11) NOT NULL,
  PRIMARY KEY (`planning_id`, `vehicule_vehicule_id`, `local_local_id`),
  INDEX `fk_planning_vehicule1_idx` (`vehicule_vehicule_id` ASC) VISIBLE,
  INDEX `fk_planning_local1_idx` (`local_local_id` ASC) VISIBLE,
  CONSTRAINT `fk_planning_vehicule1`
    FOREIGN KEY (`vehicule_vehicule_id`)
    REFERENCES `mydb`.`vehicule` (`vehicule_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_planning_local1`
    FOREIGN KEY (`local_local_id`)
    REFERENCES `mydb`.`local` (`local_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`permis` (
  `permis_id` INT(11) NOT NULL AUTO_INCREMENT,
  `permis_date_Obt` DATE NOT NULL,
  `typePermis_id` INT(11) NOT NULL,
  `candidat_id` INT(11) NOT NULL,
  PRIMARY KEY (`permis_id`, `typePermis_id`, `candidat_id`),
  INDEX `fk_permis_typePermis1_idx` (`typePermis_id` ASC, `candidat_id` ASC) VISIBLE,
  CONSTRAINT `fk_permis_typePermis1`
    FOREIGN KEY (`typePermis_id`)
    REFERENCES `mydb`.`typePermis` (`typePermis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`facture` (
  `facture_id` INT(11) NOT NULL AUTO_INCREMENT,
  `facture_emission` DATE NULL DEFAULT NULL,
  `facture_montant_paye` FLOAT(11) NULL DEFAULT NULL,
  `facture_montant_total` FLOAT(11) NULL DEFAULT NULL,
  `facture_satus` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`facture_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`paiemnt` (
  `paiemnt_id` INT(11) NOT NULL,
  `facture_id` INT(11) NOT NULL,
  `modePaiement_id` INT(11) NOT NULL,
  `candidat_id` INT(11) NOT NULL,
  `typePermis_id` INT(11) NOT NULL,
  PRIMARY KEY (`paiemnt_id`, `facture_id`, `modePaiement_id`, `candidat_id`, `typePermis_id`),
  INDEX `fk_paiemnt_facture1_idx` (`facture_id` ASC) VISIBLE,
  INDEX `fk_paiemnt_modePaiement1_idx` (`modePaiement_id` ASC) VISIBLE,
  INDEX `fk_paiemnt_candidat1_idx` (`candidat_id` ASC) VISIBLE,
  INDEX `fk_paiemnt_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
  CONSTRAINT `fk_paiemnt_facture1`
    FOREIGN KEY (`facture_id`)
    REFERENCES `mydb`.`facture` (`facture_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paiemnt_modePaiement1`
    FOREIGN KEY (`modePaiement_id`)
    REFERENCES `mydb`.`modePaiement` (`modePaiement_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paiemnt_candidat1`
    FOREIGN KEY (`candidat_id`)
    REFERENCES `mydb`.`candidat` (`candidat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paiemnt_typePermis1`
    FOREIGN KEY (`typePermis_id`)
    REFERENCES `mydb`.`typePermis` (`typePermis_typePermis_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`modePaiement` (
  `modePaiement_id` INT(11) NOT NULL AUTO_INCREMENT,
  `modePaiement_nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`modePaiement_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Utilisateur` (
  `Utilisateur_id` INT(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_email` VARCHAR(45) NOT NULL,
  `Utilisateur_MotPass` VARCHAR(45) NOT NULL,
  `Utilisateur_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Utilisateur_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`secretaire` (
  `secretaire_id` INT(11) NOT NULL,
  `secretaire_nom` VARCHAR(45) NOT NULL,
  `secretaire_prenom` VARCHAR(45) NOT NULL,
  `secretaire_email` VARCHAR(45) NOT NULL,
  `secretaire_adresse` VARCHAR(45) NOT NULL,
  `secretaire_telephone` VARCHAR(45) NOT NULL,
  `secretaire_mot_pass` VARCHAR(45) NOT NULL,
  `Utilisateur_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`secretaire_id`),
  INDEX `fk_secretaire_Utilisateur1_idx` (`Utilisateur_id` ASC) VISIBLE,
  CONSTRAINT `fk_secretaire_Utilisateur1`
    FOREIGN KEY (`Utilisateur_id`)
    REFERENCES `mydb`.`Utilisateur` (`Utilisateur_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`candidat_has_cours` (
  `candidat_id` INT(11) NOT NULL,
  `cours_id` INT(11) NOT NULL,
  PRIMARY KEY (`candidat_id`, `cours_id`),
  INDEX `fk_candidat_has_cours_cours1_idx` (`cours_id` ASC) VISIBLE,
  INDEX `fk_candidat_has_cours_candidat1_idx` (`candidat_id` ASC) VISIBLE,
  CONSTRAINT `fk_candidat_has_cours_candidat1`
    FOREIGN KEY (`candidat_id`)
    REFERENCES `mydb`.`candidat` (`candidat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_candidat_has_cours_cours1`
    FOREIGN KEY (`cours_id`)
    REFERENCES `mydb`.`cours` (`cours_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE SCHEMA IF NOT EXISTS `auto_ecoleDB` DEFAULT CHARACTER SET utf8 ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
