<?php

require_once  'model.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action']=== 'create') {
    extract($_POST);
    $db-> create($vehicule_marque,$vehicule_modele,$vehicule_annee,$vehicule_permis);
    echo'perfect';
}

//recuperer les types permis

//creation des types permis

if (isset($_POST['action']) && $_POST['action'] === 'fetch') {
    $output='';
    $db->countBills();
    if($db->countBills() >0){
      $bills = $db->read();
      $output .= '
      <table class="table text-center table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marque</th>
                            <th scope="col">Modele</th>
                            <th scope="col">Année</th>
                            <th scope="col">Permis associé</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
      ';
      foreach($bills as $bill){
        $output.= "
          <tr>
                    <th scope=\"row\">$bill->vehicule_id</th>
                    <td>$bill->vehicule_marque</td>
                    <td>$bill->vehicule_modele</td>
                    <td>$bill->vehicule_annee</td>
                    <td>$bill->vehicule_permis</td>
                    <td>
                        <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\" data-id=\"$bill->vehicule_id\"><i class=\"fas fa-info-circle\"></i></a>
                        <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Modifier\" data-id=\"$bill->vehicule_id\"><i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>
                        <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"supprimer\" data-id=\"$bill->vehicule_id\"><i class=\"fas fa-trash-alt\"></i></a>
                    </td>
                </tr>
            ";
        
      }
         $output .= "</tbody></table>";
         echo $output;
    }else{
        echo"<h3> Aucune facture pour le moment</h3>";
    }
}

//info pour detail de type permis

if (isset($_POST['workingId'])){
  $workingId = (int)$_POST['workingId'];
  echo json_encode($db->getSinglBill($workingId));
}
//update des types permis

if (isset($_POST['action']) && $_POST['action'] === 'update') {
  extract($_POST);
  $db->update($vehicule_id, $vehicule_marque, $vehicule_modele, $vehicule_annee, $vehicule_permis);
  
  echo'perfect';
}
//afficher informations type_pemris
if (isset($_POST['informationId'])){
  $informationId = (int)$_POST['informationId'];
  echo json_encode($db->getSinglBill($informationId));
} 

//suppression de type permis 
if (isset($_POST['deletionId'])){
  $deletionId = (int)$_POST['deletionId'];
  echo $db->delete($deletionId);
} 

//Exportation
if(isset($_GET['action']) && $_GET['action'] === 'export') {
  $excelFileName = "Vehicules". date('YmdHis'). '.xls';
  header("Content-Type: application/csv");
  header("Content-Disposition: attachment; filename=$excelFileName");

  $columnName = ['vehicule_id', 'Marque', 'Modele', 'Annee','Pemris associe'];

  $data = implode("\t", array_values($columnName)) . "\n";
  if($db->countBills() > 0) {
      $bills = $db->read();
      foreach ($bills as $bill) {
          $excelData = [$bill->vehicule_id, $bill->vehicule_marque, $bill->vehicule_modele, $bill->vehicule_annee,$bill->vehicule_permis];
          $data .= implode("\t", $excelData). "\n";
      }
  } else {
      $data = "Aucun vehicule trouvé..." . "\n";
  }

  echo $data;
  die();
}



?>