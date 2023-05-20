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

public function create(string $typePermis_nom,string $typePermis_description,string $typePermis_prixBase){
    $q = $this->getConnextion()->prepare("INSERT INTO typepermis( typePermis_nom, typePermis_description, typePermis_prixBase) VALUES (:typePermis_nom, :typePermis_description,:typePermis_prixBase)");
    return $q->execute([
        'typePermis_nom' => $typePermis_nom,
        'typePermis_description' => $typePermis_description,
        'typePermis_prixBase' => $typePermis_prixBase
    ]);
}
public function read(){
  return  $this->getConnextion()->query("SELECT * from typepermis order by typePermis_id")->fetchAll(PDO::FETCH_OBJ);
}


public function countBills():int{
   return(int)$this->getConnextion()->query("SELECT count(typePermis_id) as count from typepermis")->fetch()[0];
}

public function getSinglBill(int $typePermis_id){
    
    $q =$this->getConnextion()->prepare("SELECT * FROM typepermis WHERE typePermis_id  = :typePermis_id");
    $q->execute(['typePermis_id'   => $typePermis_id]);
    return $q->fetch(PDO::FETCH_OBJ);
}
  
public function update(int $typePermis_id, string $typePermis_nom, string $typePermis_description, int $typePermis_prixBase)
{
    $q = $this->getConnextion()->prepare("UPDATE typepermis SET typePermis_nom = :typePermis_nom, typePermis_description = :typePermis_description, typePermis_PrixBase = :typePermis_prixBase WHERE typePermis_id = :typePermis_id");
    return $q->execute([
        'typePermis_nom' => $typePermis_nom,
        'typePermis_description' => $typePermis_description,
        'typePermis_prixBase' => $typePermis_prixBase,
        'typePermis_id'     => $typePermis_id
    ]);
}
public function delete(int $typePermis_id): bool{
 $q= $this->getConnextion()->prepare("DELETE FROM typepermis where typePermis_id = :typePermis_id");
 return $q ->execute(['typePermis_id' => $typePermis_id]);
}

}

?>