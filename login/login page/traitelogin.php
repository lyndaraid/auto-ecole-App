<?php
session_start();
include '../../includ/connexion1.php';
if (isset($_POST['Valid_connexion'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {


        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        if (empty($email)) {
            header("Location: login.php?error_message= email is required");
            exit();
        } elseif (empty($password)) {
            header("Location: login.php?error_message= passworfis required");
            exit();
        } else {

            // Exécuter une requête SELECT avec PDO
            $sql = "SELECT * FROM utilisateur WHERE Utilisateur_email='$email' AND  Utilisateur_MotPass='$password'";
            $result = $db->query($sql);

            // Vérifier si la requête a retourné des résultats
            if ($result->rowCount() > 0) {
                // Obtenir tous les résultats sous forme d'un tableau associatif
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                    if ($row['Utilisateur_email'] === $email  && $row['Utilisateur_MotPass'] === $password) {

                        $_SESSION['Utilisateur_id'] = $row['Utilisateur_id'];
                        $_SESSION['Utilisateur_type'] = $row['Utisateur_type'];
                        $_SESSION['Utilisateur_MotPass'] = $row['Utilisateur_MotPass'];
                        $_SESSION['Utilisateur_email'] = $row['Utilisateur_email'];

                        // Rediriger l'utilisateur en fonction du type d'utilisateur
                        switch ($row['Utilisateur_type']) {
                            case 'secretaire':
                                header('Location: secretaire.php');
                                exit();
                            case 'admin':
                                header('Location:  ../../page_admin/gestion des vehicules/gestion_vehicules_permisA.php');
                                exit();
                            case 'moniteur':
                                header('Location:  ../../page_moniteur/moniteur.php');
                                exit();
                            case 'candidat':
                                header('Location: ../../page_candidat/candidat.php');
                                exit();
                            default:
                                echo 'Type d\'utilisateur inconnu';
                                break;
                        }
                    }
                }
            } else {
                header("Location: login.php?error_message=Email ou mot de passe incorrect");
                exit();
            }
        }
    } else {
        header("Location: login.php?error_message=Email ou mot de passe incorrect");
        exit();
    }
}
