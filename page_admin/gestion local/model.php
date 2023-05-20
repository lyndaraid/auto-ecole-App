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

public function create(string $local_nom,string $local_adresse,int $local_capacite,string $local_type){
    $q = $this->getConnextion()->prepare("INSERT INTO local( local_nom, local_adresse, local_capacite,local_type) 
    VALUES(:local_nom, :local_adresse,:local_capacite,:local_type)");
    return $q->execute([
        'local_nom' => $local_nom,
        'local_adresse' => $local_adresse,
        'local_capacite' => $local_capacite,
        'local_type' => $local_type
    ]);
}
public function read(){
  return  $this->getConnextion()->query("SELECT * from local order by local_id")->fetchAll(PDO::FETCH_OBJ);
}


public function countBills():int{
   return(int)$this->getConnextion()->query("SELECT count(local_id) as count from local")->fetch()[0];
}

public function getSinglBill(int $local_id){
    
    $q =$this->getConnextion()->prepare("SELECT * FROM local WHERE local_id  = :local_id");
    $q->execute(['local_id'   => $local_id]);
    return $q->fetch(PDO::FETCH_OBJ);
}
  
public function update(int $local_id,string $local_nom,string $local_adresse,int $local_capacite,string $local_type)
{
    $q = $this->getConnextion()->prepare("UPDATE local SET local_nom = :local_nom, local_adresse = :local_adresse, local_capacite = :local_capacite,local_type = :local_type WHERE local_id = :local_id");
    return $q->execute([
        'local_nom' => $local_nom,
        'local_adresse' => $local_adresse,
        'local_capacite' => $local_capacite,
        'local_type' => $local_type,
        'local_id' => $local_id
    ]);
}
public function delete(int $local_id): bool{
 $q= $this->getConnextion()->prepare("DELETE FROM local where local_id = :local_id");
 return $q ->execute(['local_id' => $local_id]);
}

}
