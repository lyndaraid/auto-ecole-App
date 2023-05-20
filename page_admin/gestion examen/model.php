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


public function create(string $exemen_date,string $exemen_lieu,string $exemen_type,string $exemen_resultat,
string $candidat_nom,string $candidat_prenom,string $typePermis_nom,string $moniteur_nom,string $moniteur_prenom,int $planning_id){
   
    $q = $this->getConnextion()->prepare(" INSERT INTO exemen(exemen_date,exemen_lieu,exemen_type,exemen_resultat,candidat_id,typePermis_id,moniteur_id,planning_id) 
    VALUES(:exemen_date,:exemen_lieu,:exemen_type,:exemen_resultat,(SELECT candidat_id FROM candidat WHERE (candidat_nom= :candidat_nom and candidat_prenom= :candidat_prenom)LIMIT 1),
    (select typePermis_id from typepermis where typePermis_nom= :typePermis_nom LIMIT 1 ),
    (SELECT moniteur_id FROM moniteur WHERE (moniteur_nom= :moniteur_nom and moniteur_prenom= :moniteur_prenom)LIMIT 1)
    ,(select planning_id from planning where planning_id= :planning_id LIMIT 1 ))");
return $q->execute([
    'exemen_date' => $exemen_date,
    'exemen_lieu' => $exemen_lieu,
    'exemen_type' => $exemen_type,
    'exemen_resultat' => $exemen_resultat,
    'candidat_nom' => $candidat_nom,
    'candidat_prenom' => $candidat_prenom,
    'moniteur_nom' => $moniteur_nom,
    'moniteur_prenom' => $moniteur_prenom,
    'typePermis_nom' => $typePermis_nom,
    'planning_id' => $planning_id
    
]);   

}

public function read(){
    return  $this->getConnextion()->query("SELECT exemen_id,exemen_date,exemen_lieu,exemen_type,exemen_resultat,candidat.candidat_nom,candidat.candidat_prenom,typePermis_nom,moniteur_nom,moniteur_prenom,planning.planning_id from  moniteur,candidat,typepermis,planning JOIN exemen 
    where (exemen.moniteur_id= moniteur.moniteur_id and exemen.typePermis_id= typepermis.typePermis_id and exemen.planning_id= planning.planning_id and exemen.candidat_id= candidat.candidat_id)GROUP by exemen.exemen_id")->fetchAll(PDO::FETCH_OBJ);
     
  }

  public function readinfo(){
    return  $this->getConnextion()->query("SELECT exemen_id,exemen_date,exemen_lieu,exemen_type,exemen_resultat,candidat.candidat_nom,candidat.candidat_prenom,typePermis_nom,moniteur_nom,moniteur_prenom,planning.planning_id from  moniteur,candidat,typepermis,planning JOIN exemen 
    where (exemen.moniteur_id= moniteur.moniteur_id and exemen.typePermis_id= typepermis.typePermis_id and exemen.planning_id= planning.planning_id and exemen.candidat_id= candidat.candidat_id)GROUP by exemen.exemen_id")->fetchAll(PDO::FETCH_OBJ);
     
  }

public function countBills():int{
    return(int)$this->getConnextion()->query("SELECT count(exemen_id) as count from exemen")->fetch()[0];
 }

 public function getSinglBill(int $exemen_id){
    
    $q =$this->getConnextion()->prepare("SELECT exemen_id,exemen_date,exemen_lieu,exemen_type,exemen_resultat,candidat.candidat_nom,candidat.candidat_prenom,typePermis_nom,moniteur_nom,moniteur_prenom,planning.planning_id from  moniteur,candidat,typepermis,planning JOIN exemen 
    where (exemen.moniteur_id= moniteur.moniteur_id and exemen.typePermis_id= typepermis.typePermis_id and exemen.planning_id= planning.planning_id and exemen.candidat_id= candidat.candidat_id and exemen.exemen_id= :exemen_id)");
    $q->execute(['exemen_id'   => $exemen_id]);
    return $q->fetch(PDO::FETCH_OBJ);
}
 public function update(int $exemen_id,string $exemen_date,string $exemen_lieu,string $exemen_type,string $exemen_resultat,
 string $candidat_nom,string $candidat_prenom,string $typePermis_nom,string $moniteur_nom,string $moniteur_prenom,int $planning_id)
{
    $q = $this->getConnextion()->prepare("UPDATE exemen set exemen_date= :exemen_date ,exemen_lieu= :exemen_lieu,exemen_type= :exemen_type,
    exemen_resultat= :exemen_resultat,exemen.candidat_id=(SELECT candidat_id from candidat where (candidat_nom= :candidat_nom and candidat_prenom= :candidat_prenom) LIMIT 1),
    exemen.typePermis_id=(SELECT typePermis_id from typepermis where typepermis.typePermis_nom = :typePermis_nom LIMIT 1),
    exemen.moniteur_id=(SELECT moniteur_id from moniteur where (moniteur_nom= :moniteur_nom and moniteur_prenom= :moniteur_prenom) LIMIT 1),
    exemen.planning_id=(select planning_id from planning where planning_id= :planning_id LIMIT 1 ) WHERE exemen_id = :exemen_id");
    return $q->execute([
    'exemen_date' => $exemen_date,
    'exemen_lieu' => $exemen_lieu,
    'exemen_type' => $exemen_type,
    'exemen_resultat' => $exemen_resultat,
    'candidat_nom' => $candidat_nom,
    'candidat_prenom' => $candidat_prenom,
    'moniteur_nom' => $moniteur_nom,
    'moniteur_prenom' => $moniteur_prenom,
    'typePermis_nom' => $typePermis_nom,
    'planning_id' => $planning_id,
    'exemen_id' => $exemen_id
    ]);
}

 public function delete(int $exemen_id): bool{
    $q= $this->getConnextion()->prepare("DELETE FROM  exemen where exemen_id = :exemen_id");
    return $q ->execute(['exemen_id' => $exemen_id]);
   }

}


?>