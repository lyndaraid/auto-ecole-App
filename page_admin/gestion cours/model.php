<?php
class Database{
    private $db_host = 'localhost';
    private $db_name = 'mydb';
    private $db_username = 'root';
    private $port = "3308";
    private $db_password = '';
        
public function getConnextion(){
 try {
    return new PDO('mysql:host='.$this->db_host.'; port=3308; dbname='.$this->db_name,$this->db_username,$this->db_password);
    echo"connexion faite avec succès";
    
} catch (PDOException $e) {
    die('Erreur: '.$e->getMessage());
 }
}


public function create(string $cours_typeCours,string $cours_date,string $cours_heure_debut,string $cours_heure_fin,string $moniteur_nom,string $moniteur_prenom,string $typePermis_nom,int $planning_id){
   
    $q = $this->getConnextion()->prepare(" INSERT INTO cours(cours_typeCours,cours_date,cours_heure_debut,cours_heure_fin,moniteur_id,typePermis_id,planning_id) VALUES(:cours_typeCours,:cours_date,:cours_heure_debut,:cours_heure_fin,
(SELECT moniteur_id FROM moniteur WHERE (moniteur_nom= :moniteur_nom and moniteur_prenom= :moniteur_prenom)LIMIT 1),(select typePermis_id from typepermis where typePermis_nom= :typePermis_nom LIMIT 1 ),(select planning_id from planning where planning_id= :planning_id LIMIT 1 ))");
return $q->execute([
    'cours_typeCours' => $cours_typeCours,
    'cours_date' => $cours_date,
    'cours_heure_debut' => $cours_heure_debut,
    'cours_heure_fin' => $cours_heure_fin,
    'moniteur_nom' => $moniteur_nom,
    'moniteur_prenom' => $moniteur_prenom,
    'typePermis_nom' => $typePermis_nom,
    'planning_id' => $planning_id
    
]);   

}

public function read(){
    return  $this->getConnextion()->query("SELECT cours.cours_id,cours.cours_typeCours,cours.cours_date,cours.cours_heure_debut,cours.cours_heure_fin,moniteur.moniteur_nom,moniteur.moniteur_prenom,typepermis.typePermis_nom,planning.planning_id
     from  moniteur,typepermis,planning JOIN cours where (cours.moniteur_id= moniteur.moniteur_id and cours.typePermis_id= typepermis.typePermis_id and cours.planning_id= planning.planning_id )GROUP by cours.cours_id")->fetchAll(PDO::FETCH_OBJ);
     
  }
  public function readinfo(){
    return  $this->getConnextion()->query("SELECT cours.cours_id,cours.cours_typeCours,cours.cours_date,cours.cours_heure_debut,cours.cours_heure_fin,moniteur.moniteur_nom,moniteur.moniteur_prenom,typepermis.typePermis_nom,planning.planning_id from moniteur,typepermis,planning,cours
      where (cours.moniteur_id= moniteur.moniteur_id and cours.typePermis_id= typepermis.typePermis_id and cours.planning_id= planning.planning_id )GROUP by cours.cours_id")->fetchAll(PDO::FETCH_OBJ);
     
  }
public function countBills():int{
    return(int)$this->getConnextion()->query("SELECT count(cours_id) as count from cours")->fetch()[0];
 }

 public function getSinglBill(int $cours_id){
    
    $q =$this->getConnextion()->prepare("SELECT cours.cours_id,cours.cours_typeCours,cours.cours_date,cours.cours_heure_debut,cours.cours_heure_fin,moniteur.moniteur_nom,moniteur.moniteur_prenom,typepermis.typePermis_nom,planning.planning_id from moniteur,typepermis,planning,cours
    where cours.moniteur_id= moniteur.moniteur_id and cours.typePermis_id= typepermis.typePermis_id and cours.planning_id= planning.planning_id  and cours_id= :cours_id");
    $q->execute(['cours_id'   => $cours_id]);
    return $q->fetch(PDO::FETCH_OBJ);
}
 public function update(int $cours_id,string $cours_typeCours,string $cours_date,string $cours_heure_debut,string $cours_heure_fin,string $moniteur_nom,string $moniteur_prenom,string $typePermis_nom,int $planning_id)
{
    $q = $this->getConnextion()->prepare("UPDATE cours set cours_typeCours= :cours_typesCours ,cour_date= :cours_date,cours_heure_debut= :cours_heure_debut,
    cours_heure_fin= :cours_heure_fin,cours.moniteur_id=(SELECT moniteur_id from moniteur where (moniteur_nom= :moniteur_nom and moniteur_prenom= :moniteur_prenom) LIMIT 1),
    cours.typePermis_id=(SELECT typePermis_id from typepermis where typepermis.typePermis_nom = :typePermis_nom LIMIT 1),
    planning_id=(select planning_id from planning where planning_id= :planning_id LIMIT 1 ) WHERE cours_id = :cours_id");
    return $q->execute([
        'cours_typeCours' => $cours_typeCours,
        'cours_date' => $cours_date,
        'cours_heure_debut' => $cours_heure_debut,
        'cours_heure_fin' => $cours_heure_fin,
        'moniteur_nom' => $moniteur_nom,
        'moniteur_prenom' => $moniteur_prenom,
        'typePermis_nom' => $typePermis_nom,
        'planning_id' => $planning_id,
        'cours_id' => $cours_id
    ]);
}

 public function delete(int $cours_id): bool{
    $q= $this->getConnextion()->prepare("DELETE FROM  cours where cours_id = :cours_id");
    return $q ->execute(['cours_id' => $cours_id]);
   }

}


?>