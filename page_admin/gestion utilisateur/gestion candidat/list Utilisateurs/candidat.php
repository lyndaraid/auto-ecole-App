<?php
require_once "../../../../includ/connexionObject.php";
$conn= new Database();
class candidat extends Database
{
    protected $tableName = "candidat";
    //fonction to add users 
   // Fonction pour ajouter un utilisateur
public function add($data) {
    // Récupérer les valeurs des champs depuis le tableau $data
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $dateNaissance = $data['dateNaissance'];
    $telephone = $data['telephone'];
    $email = $data['email'];
    $dateInscription = date('Y-m-d'); // Date actuelle
    $ville = $data['ville'];
    $photo = $data['photo'];
    $hashedPassword = $data['hashedPassword'];

    $sql = "CALL ajouter_candidat_utilisateur(:nom, :prenom, :dateNaissance, :telephone, :email, :dateInscription, :ville, :photo, :hashedPassword);";

    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':dateNaissance', $dateNaissance);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dateInscription', $dateInscription);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':hashedPassword', $hashedPassword);

        if ($stmt->execute()) {
            echo "Utilisateur ajouté avec succès.";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de l'utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

    //fonction to get rows

    // Fonction pour obtenir plusieurs lignes
    public function getRows($start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM {$this->tableName} Order by DESC LIMIT{$start},{$limit} ;";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $resultats = [];
        }



        return $resultats;
    }

    //fonction to get singel row 
    // Fonction pour obtenir une seule ligne
    public function getSingleRow($field, $value)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE {$field} = :{$field};";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":{$field}", $value);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $resultat = [];
        }

        return $resultat;
    }

    // fonction to count number of rows 
    // Fonction pour compter le nombre de lignes
    public function countRows()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->tableName};";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    //fonction to upload photo 
    // Fonction pour télécharger une photo
    public function uploadPhoto($file)
    {
        // Vérifier si un fichier a été envoyé
        if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
            $fileTempPath = $file['temp_name'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileNameCmps = explode('.', $fileName); // Chemin de destination du fichier téléchargé
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

            $allowedExtn = ["png", "jpg", "jpeg"];

            if (in_array($fileExtension, $allowedExtn)) {
                return $fileName; // Renvoyer le nom du fichier téléchargé
                $uploadFileDir = getcwd() . '/uploads/';
                $destFilePath = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTempPath,  $destFilePath)) {
                    return $newFileName; // Renvoyer le nom du fichier téléchargé
                }
            }
        }

     
    }


    //fonction to update
    //fonction to delete 
    //fonction forsearch  
}