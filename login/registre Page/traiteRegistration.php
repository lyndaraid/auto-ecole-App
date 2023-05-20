<?php
session_start();
include '../../includ/connexion1.php';
if (isset($_POST['Valid_registre'])) {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password']) && isset($_POST['birthday']) && isset($_POST['ville']) && isset($_POST['photo'])) {


        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $nom = validate($_POST['nom']);
        $prenom = validate($_POST['prenom']);
        $email = validate($_POST['email']);
        $telephone = validate($_POST['telephone']);
        $password = validate($_POST['password']);
        $re_password = validate($_POST['re_password']);
        $dateNaissance = validate($_POST['birthday']);
        $ville = validate($_POST['ville']);
        $photo = validate($_POST['photo']);

        $user_data = 'prenom  ' . $prenom . 'nom  ' . $nom;
        echo $user_data;
        if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($password) || empty($dateNaissance) || empty($ville) || empty($photo)) {
            header("Location: registration.php?error_message= Tous les champs doivent être remplis.");
            exit();
        } elseif (empty($re_password)) {
            header("Location: registration.php?error_message= confirme votre mot passe");
            exit();
            $password = validate($_POST['password']);
        } elseif ($re_password !== $password) {
            header("Location: registration.php?error_message= Le mot de passe de confirmation ne correspond pas");
            exit();
        } else {
            // Hasher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Exécuter une requête SELECT avec PDO
            $sql = "SELECT * FROM utilisateur WHERE Utilisateur_email='$email' AND  Utilisateur_MotPass='$password'";
            $result = $db->query($sql);

            // Vérifier si la requête a retourné des résultats
            if ($result->rowCount() > 0) {
                header("Location: registration.php?error_message= L'adresse e-mail est déjà utilisée. Veuillez essayer une autre adresse.");
                exit();
            } else {
                $dateInscription = date('Y-m-d'); // Date actuelle
                $sql2 = "CALL ajouter_candidat_utilisateur('$nom', '$prenom', '$dateNaissance', '$telephone', '$email', '$dateInscription', '$ville', '$photo', '$hashedPassword');";


                $result2 = $db->query($sql2);
                if ($result2) {
                    header("Location: registration.php?success= Votre compte a été créé avec succès.");
                    exit();
                } else {
                    header("Location: registration.php?error_message= Une erreur inconnue s'est produite");
                    exit();
                }
            }
        }
    } else {
        header("Location: registration.php?error_message=Email ou mot de passe incorrect");
        exit();
    }
}
