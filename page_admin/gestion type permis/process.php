<?php
require_once  'model.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action']=== 'create') {
    extract($_POST);
    $db-> create($typePermis_nom,$typePermis_description,(int)$typePermis_prixBase);
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
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
      ';
      foreach($bills as $bill){
        $output.= "
          <tr>
                    <th scope=\"row\">$bill->typePermis_id</th>
                    <td>$bill->typePermis_nom</td>
                    <td>$bill->typePermis_description</td>
                    <td>$bill->typePermis_prixBase</td>
                    <td>
                        <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\" data-id=\"$bill->typePermis_id\"><i class=\"fas fa-info-circle\"></i></a>
                        <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Modifier\" data-id=\"$bill->typePermis_id\"><i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>
                        <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"supprimer\" data-id=\"$bill->typePermis_id\"><i class=\"fas fa-trash-alt\"></i></a>
                    </td>
                </tr>
            ";
        
      }
         $output .= "</tbody></table>";
         echo $output;
    }else{
        echo"<h3> Aucune Permis  pour le moment</h3>";
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
  $db-> update( $typePermis_id,$typePermis_nom,$typePermis_description,(int)$typePermis_prixBase);
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
  $excelFileName = "Factures". date('YmdHis'). '.xls';
  header("Content-Type: application/csv");
  header("Content-Disposition: attachment; filename=$excelFileName");

  $columnName = ['id', 'Nom', 'Description', 'Prix de base'];

  $data = implode("\t", array_values($columnName)) . "\n";
  if($db->countBills() > 0) {
      $bills = $db->read();
      foreach ($bills as $bill) {
          $excelData = [$bill->typePermis_id, $bill->typePermis_nom, $bill->typePermis_description, $bill->typePermis_prixBase];
          $data .= implode("\t", $excelData). "\n";
      }
  } else {
      $data = "Aucunes Permis trouvées..." . "\n";
  }

  echo $data;
  die();
}
