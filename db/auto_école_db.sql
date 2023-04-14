-- MySQL Workbench Synchronization
-- Generated: 2023-04-07 13:34
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: MON PC

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `mydb`.`candidat` 
DROP FOREIGN KEY `fk_candidat_modePaiement1`;

ALTER TABLE `mydb`.`exemen` 
DROP FOREIGN KEY `fk_exemen_candidat`,
DROP FOREIGN KEY `fk_exemen_moniteur1`,
DROP FOREIGN KEY `fk_exemen_planning1`;

ALTER TABLE `mydb`.`moniteur` 
DROP FOREIGN KEY `fk_moniteur_Utilisateur1`;

ALTER TABLE `mydb`.`cours` 
DROP FOREIGN KEY `fk_cours_moniteur1`,
DROP FOREIGN KEY `fk_cours_planning1`;

ALTER TABLE `mydb`.`permis` 
DROP FOREIGN KEY `fk_permis_typePermis1`;

ALTER TABLE `mydb`.`paiemnt` 
DROP FOREIGN KEY `fk_paiemnt_facture1`,
DROP FOREIGN KEY `fk_paiemnt_modePaiement1`,
DROP FOREIGN KEY `fk_paiemnt_typePermis1`;

ALTER TABLE `mydb`.`candidat` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `modePaiement_id`,
DROP COLUMN `Utilisateur_id`,
ADD COLUMN `Utilisateur_id` VARCHAR(45) NOT NULL AFTER `candidat_mote_pass`,
ADD COLUMN `modePaiement_id` INT(11) NULL DEFAULT NULL AFTER `Utilisateur_id`,
ADD INDEX `fk_candidat_Utilisateur1_idx` (`Utilisateur_id` ASC) VISIBLE,
ADD INDEX `fk_candidat_modePaiement1_idx` (`modePaiement_id` ASC) VISIBLE,
DROP INDEX `fk_candidat_modePaiement1_idx` ,
DROP INDEX `fk_candidat_Utilisateur1_idx` ;
;

ALTER TABLE `mydb`.`exemen` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `planning_id`,
DROP COLUMN `moniteur_id`,
DROP COLUMN `typePermis_id`,
DROP COLUMN `candidat_id`,
ADD COLUMN `candidat_id` INT(11) NOT NULL AFTER `exemen_resultat`,
ADD COLUMN `typePermis_id` INT(11) NOT NULL AFTER `candidat_id`,
ADD COLUMN `moniteur_id` INT(11) NOT NULL AFTER `typePermis_id`,
ADD COLUMN `planning_id` INT(10) UNSIGNED NOT NULL AFTER `moniteur_id`,
ADD INDEX `fk_exemen_candidat_idx` (`candidat_id` ASC) VISIBLE,
ADD INDEX `fk_exemen_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
ADD INDEX `fk_exemen_moniteur1_idx` (`moniteur_id` ASC) VISIBLE,
ADD INDEX `fk_exemen_planning1_idx` (`planning_id` ASC) VISIBLE,
DROP INDEX `fk_exemen_planning1_idx` ,
DROP INDEX `fk_exemen_moniteur1_idx` ,
DROP INDEX `fk_exemen_typePermis1_idx` ,
DROP INDEX `fk_exemen_candidat_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`local` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `mydb`.`vehicule` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `mydb`.`typePermis` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD INDEX `fk_typePermis_typePermis1_idx` (`typePermis_typePermis_id` ASC) VISIBLE,
DROP INDEX `fk_typePermis_typePermis1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`moniteur` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `Utilisateur_id`,
ADD COLUMN `Utilisateur_id` INT(11) NOT NULL AFTER `moniteur_email`,
ADD INDEX `fk_moniteur_Utilisateur1_idx` (`Utilisateur_id` ASC) VISIBLE,
DROP INDEX `fk_moniteur_Utilisateur1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`moniteur` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`cours` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `planning_id`,
DROP COLUMN `typePermis_id`,
DROP COLUMN `moniteur_id`,
ADD COLUMN `moniteur_id` INT(11) NOT NULL AFTER `cours_heure_fin`,
ADD COLUMN `typePermis_id` INT(11) NOT NULL AFTER `moniteur_id`,
ADD COLUMN `planning_id` INT(10) UNSIGNED NOT NULL AFTER `typePermis_id`,
ADD INDEX `fk_cours_moniteur1_idx` (`moniteur_id` ASC) VISIBLE,
ADD INDEX `fk_cours_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
ADD INDEX `fk_cours_planning1_idx` (`planning_id` ASC) VISIBLE,
DROP INDEX `fk_cours_planning1_idx` ,
DROP INDEX `fk_cours_typePermis1_idx` ,
DROP INDEX `fk_cours_moniteur1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`moniteur` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`cours` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`planning` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
ADD INDEX `fk_planning_vehicule1_idx` (`vehicule_vehicule_id` ASC) VISIBLE,
ADD INDEX `fk_planning_local1_idx` (`local_local_id` ASC) VISIBLE,
DROP INDEX `fk_planning_local1_idx` ,
DROP INDEX `fk_planning_vehicule1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`moniteur` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`cours` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`permis` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `candidat_id`,
DROP COLUMN `typePermis_id`,
ADD COLUMN `typePermis_id` INT(11) NOT NULL AFTER `permis_date_Obt`,
ADD COLUMN `candidat_id` INT(11) NOT NULL AFTER `typePermis_id`,
ADD INDEX `fk_permis_typePermis1_idx` (`typePermis_id` ASC, `candidat_id` ASC) VISIBLE,
DROP INDEX `fk_permis_typePermis1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`moniteur` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`cours` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`permis` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`facture` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

ALTER TABLE `mydb`.`paiemnt` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ,
DROP COLUMN `typePermis_id`,
DROP COLUMN `candidat_id`,
DROP COLUMN `modePaiement_id`,
DROP COLUMN `facture_id`,
ADD COLUMN `facture_id` INT(11) NOT NULL AFTER `paiemnt_id`,
ADD COLUMN `modePaiement_id` INT(11) NOT NULL AFTER `facture_id`,
ADD COLUMN `candidat_id` INT(11) NOT NULL AFTER `modePaiement_id`,
ADD COLUMN `typePermis_id` INT(11) NOT NULL AFTER `candidat_id`,
ADD INDEX `fk_paiemnt_facture1_idx` (`facture_id` ASC) VISIBLE,
ADD INDEX `fk_paiemnt_modePaiement1_idx` (`modePaiement_id` ASC) VISIBLE,
ADD INDEX `fk_paiemnt_candidat1_idx` (`candidat_id` ASC) VISIBLE,
ADD INDEX `fk_paiemnt_typePermis1_idx` (`typePermis_id` ASC) VISIBLE,
DROP INDEX `fk_paiemnt_typePermis1_idx` ,
DROP INDEX `fk_paiemnt_candidat1_idx` ,
DROP INDEX `fk_paiemnt_modePaiement1_idx` ,
DROP INDEX `fk_paiemnt_facture1_idx` ;
ALTER TABLE `mydb`.`exemen` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`moniteur` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`cours` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`permis` ALTER INDEX `PRIMARY` VISIBLE;
ALTER TABLE `mydb`.`paiemnt` ALTER INDEX `PRIMARY` VISIBLE;

ALTER TABLE `mydb`.`modePaiement` 
CHARACTER SET = utf8 , COLLATE = utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `mydb`.`secretaire` (
  `secretaire_id` INT(11) NOT NULL,
  `secretaire_nom` VARCHAR(45) NOT NULL,
  `secretaire_prenom` VARCHAR(45) NOT NULL,
  `secretaire_email` VARCHAR(45) NOT NULL,
  `secretaire_adresse` VARCHAR(45) NOT NULL,
  `secretaire_telephone` VARCHAR(45) NOT NULL,
  `secretaire_mot_pass` VARCHAR(45) NOT NULL,
  `Utilisateur_id` INT(11) NOT NULL,
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

ALTER TABLE `mydb`.`candidat` 
DROP FOREIGN KEY `fk_candidat_Utilisateur1`;

ALTER TABLE `mydb`.`candidat` ADD CONSTRAINT `fk_candidat_Utilisateur1`
  FOREIGN KEY (`Utilisateur_id`)
  REFERENCES `mydb`.`Utilisateur` (`Utilisateur_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_candidat_modePaiement1`
  FOREIGN KEY (`modePaiement_id`)
  REFERENCES `mydb`.`modePaiement` (`modePaiement_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `mydb`.`exemen` 
DROP FOREIGN KEY `fk_exemen_typePermis1`;

ALTER TABLE `mydb`.`exemen` ADD CONSTRAINT `fk_exemen_candidat`
  FOREIGN KEY (`candidat_id`)
  REFERENCES `mydb`.`candidat` (`candidat_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_exemen_typePermis1`
  FOREIGN KEY (`typePermis_id`)
  REFERENCES `mydb`.`typePermis` (`typePermis_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_exemen_moniteur1`
  FOREIGN KEY (`moniteur_id`)
  REFERENCES `mydb`.`moniteur` (`moniteur_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_exemen_planning1`
  FOREIGN KEY (`planning_id`)
  REFERENCES `mydb`.`planning` (`planning_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `mydb`.`moniteur` 
ADD CONSTRAINT `fk_moniteur_Utilisateur1`
  FOREIGN KEY (`Utilisateur_id`)
  REFERENCES `mydb`.`Utilisateur` (`Utilisateur_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `mydb`.`cours` 
DROP FOREIGN KEY `fk_cours_typePermis1`;

ALTER TABLE `mydb`.`cours` ADD CONSTRAINT `fk_cours_moniteur1`
  FOREIGN KEY (`moniteur_id`)
  REFERENCES `mydb`.`moniteur` (`moniteur_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_cours_typePermis1`
  FOREIGN KEY (`typePermis_id`)
  REFERENCES `mydb`.`typePermis` (`typePermis_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_cours_planning1`
  FOREIGN KEY (`planning_id`)
  REFERENCES `mydb`.`planning` (`planning_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `mydb`.`permis` 
ADD CONSTRAINT `fk_permis_typePermis1`
  FOREIGN KEY (`typePermis_id`)
  REFERENCES `mydb`.`typePermis` (`typePermis_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `mydb`.`paiemnt` 
DROP FOREIGN KEY `fk_paiemnt_candidat1`;

ALTER TABLE `mydb`.`paiemnt` ADD CONSTRAINT `fk_paiemnt_facture1`
  FOREIGN KEY (`facture_id`)
  REFERENCES `mydb`.`facture` (`facture_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_paiemnt_modePaiement1`
  FOREIGN KEY (`modePaiement_id`)
  REFERENCES `mydb`.`modePaiement` (`modePaiement_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_paiemnt_candidat1`
  FOREIGN KEY (`candidat_id`)
  REFERENCES `mydb`.`candidat` (`candidat_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `fk_paiemnt_typePermis1`
  FOREIGN KEY (`typePermis_id`)
  REFERENCES `mydb`.`typePermis` (`typePermis_typePermis_id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
