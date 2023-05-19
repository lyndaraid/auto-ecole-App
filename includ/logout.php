<?php
// Détruire la session et déconnecter l'utilisateur
session_start();
session_unset();
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header('Location: ../login/login page/login.php');
exit();
?>