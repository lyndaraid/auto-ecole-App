<?php
class Database{
    private $db_host = 'localhost';
    private $db_name = 'mydb';
    private $db_username = 'root';
    private $port = "3308";
    private $db_password = '';
        
private function getConnextion(){
 try {
    return new PDO('mysql:host='.$this->db_host.'; port=3308; dbname='.$this->db_name,$this->db_username,$this->db_password);
    echo"connexion faite avec succès"; 
} catch (PDOException $e) {
    die('Erreur: '.$e->getMessage());
 }
}

public function create(string $vehicule_marque,string $vehicule_modele,string $vehicule_annee,string $vehicule_permis){
    $q = $this->getConnextion()->prepare("INSERT INTO vehicule( vehicule_marque,vehicule_modele,vehicule_annee,vehicule_permis) VALUES(:vehicule_marque, :vehicule_modele,:vehicule_annee,:vehicule_permis)");
    return $q->execute([
        'vehicule_marque' => $vehicule_marque,
        'vehicule_modele' => $vehicule_modele,
        'vehicule_annee' => $vehicule_annee,
        'vehicule_permis' => $vehicule_permis
    ]);
}
public function read(){
  return  $this->getConnextion()->query("SELECT * from vehicule order by vehicule_id")->fetchAll(PDO::FETCH_OBJ);
}


public function countBills():int{
   return(int)$this->getConnextion()->query("SELECT count(vehicule_id) as count from vehicule")->fetch()[0];
}

public function getSinglBill(int $vehicule_id){
    
    $q =$this->getConnextion()->prepare("SELECT * FROM vehicule WHERE vehicule_id= :vehicule_id");
    $q->execute(['vehicule_id'=> $vehicule_id]);
    return $q->fetch(PDO::FETCH_OBJ);
}
  
public function update(int $vehicule_id, string $vehicule_marque, string $vehicule_modele, string $vehicule_annee, string $vehicule_permis)
{
    $q = $this->getConnextion()->prepare("UPDATE vehicule SET vehicule_marque = :vehicule_marque, vehicule_modele = :vehicule_modele, vehicule_annee = :vehicule_annee, vehicule_permis = :vehicule_permis WHERE vehicule_id = :vehicule_id");
    return $q->execute([
        'vehicule_marque' => $vehicule_marque,
        'vehicule_modele' => $vehicule_modele,
        'vehicule_annee' => $vehicule_annee,
        'vehicule_permis' => $vehicule_permis,
        'vehicule_id'     => $vehicule_id
    ]);
}

 public function delete(int $vehicule_id): bool{
  $q= $this->getConnextion()->prepare("DELETE FROM vehicule where vehiucle_id = :vehiucle_id");
  
  return $q ->execute(['vehicule_id' => $vehicule_id]);
 }

}




?>