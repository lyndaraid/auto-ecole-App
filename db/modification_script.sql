use mydb ;

DELIMITER  $$
CREATE DEFINER = CURRENT_USER TRIGGER `mydb`.`candidat_AFTER_INSERT` AFTER INSERT ON `candidat` FOR EACH ROW
begin
  -- Insère la ligne dans la table "utilisateur"
  INSERT INTO utilisateur (utilisateur_email, utilisateur_motpass, utilisateur_type)
  VALUES (NEW.candidat_email, NEW.candidat_mote_pass, 'candidat');

  end $$
DELIMITER ;
CREATE DEFINER = CURRENT_USER TRIGGER `mydb`.`utilisateur_candidat_AFTER_INSERT` AFTER INSERT ON `utilisateur` FOR EACH ROW
begin
  
  -- Met à jour la clé étrangère utilisateur_id dans candidat 
  UPDATE candidat as c 
  SET c.utilisateur_id = LAST_INSERT_ID()
 WHERE `candidat_email` = NEW.`utilisateur_email` AND `candidat_mote_pass` = NEW.`utilisateur_motpass` AND NEW.`utilisateur_type`='candidat' 
  end $$
DELIMITER ;


INSERT INTO candidat (candidat_nom, candidat_prenom, candidat_dateNaiss, candidat_telephone, candidat_email, candidat_dateInscription, candidat_ville, candidat_photo, candidat_mote_pass)
VALUES ('lynda', 'Jean', '1990-01-01', '0123456789', 'jean.dupont@example.com', '2023-04-07', 'Paris', 'photo.jpg', 'password123');
 
  

