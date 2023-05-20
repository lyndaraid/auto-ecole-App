<?php
// print_r($_FILES);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// die;
$action = $_REQUEST['action'];
if (!empty($action)) {
    require_once "candidat.php";
    $obj = new candidat();
};
// adding user action 
if ($action == 'adduser' && !empty($_POST)) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $dateNaissance = $_POST['birthday'];
    $ville = $_POST['ville'];
    $photo = $_FILES['photo'];

    // Accessing the uploaded file data
    $photoName = $photo['name'];
    $photoType = $photo['type'];
    $photoSize = $photo['size'];
    $photoTmpPath = $photo['tmp_name'];
    $photoError = $photo['error'];

    $candidatId = (!empty($_POST['userId'])) ? $_POST['userId'] : "";
    $image = "";
    if (!empty($photo['name'])) {
        $imageName = $obj->uploadPhoto($photo);
        $candidatData = [
            'nom' =>  $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'password' => $password,
            'dateNaissance' => $dateNaissance,
            'ville' => $ville,
            'photo' => $photo
        ];
    } else {
        $candidatData = [
            'nom' =>  $nom,
            'prenom' => $prenom,
            'email' => $email,
            'telephone' => $telephone,
            'password' => $password,
            'dateNaissance' => $dateNaissance,
            'ville' => $ville
        ];
        $candidatId = $obj->add($candidatData);

        if (!empty($candidatId)) {
            $candidat = $obj->getSingleRow('candidat_id', $candidatId);
            echo json_encode($candidat);
            exit();
        }
    }
}
