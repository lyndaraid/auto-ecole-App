<?php
require_once  'model.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action']=== 'create') {
    extract($_POST);
    $db-> create( $cours_typeCours, $cours_date, $cours_heure_debut, $cours_heure_fin, $moniteur_nom, $moniteur_prenom, $typePermis_nom, $planning_id);
    echo'perfect';
}

if (isset($_POST['action']) && $_POST['action'] === 'fetch') {
    $output='';
    $db->countBills();
    if($db->countBills() >0){
      $bills = $db->read();
      $output .= '
      <table class="table table-striped">
                      <thead>
                          <tr>
                           <th scope="col">#</th>
                           <th scope="col">Type  cour</th>
                           <th scope="col">Date cour</th>
                           <th scope="col">Heure début</th>
                           <th scope="col">Heure fin</th>
                           <th scope="col">Nom moniteur</th>
                           <th scope="col">Prénom moniteur</th>
                           <th scope="col">Type permis</th>
                           <th scope="col">Numero planing</th>
                           <th scope="col">Action</th>
                          </tr>
                       </thead>
                     <tbody>
      ';
      foreach($bills as $bill){
        $output.= "
          <tr>
                    <th scope=\"row\">$bill->cours_id</th>
                    <td>$bill->cours_typeCours</td>
                    <td>$bill->cours_date</td>
                    <td>$bill->cours_heure_debut</td>
                    <td>$bill->cours_heure_fin</td>
                    <td>$bill->moniteur_nom</td>
                    <td>$bill->moniteur_prenom</td>
                    <td>$bill->typePermis_nom</td>
                    <td>$bill->planning_id</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\" data-id=\"$bill->cours_id\"><i class=\"fas fa-info-circle\"></i></a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Modifier\" data-id=\"$bill->cours_id\"><i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"supprimer\" data-id=\"$bill->cours_id\"><i class=\"fas fa-trash-alt\"></i></a>
                    </td>
                </tr>
            ";
        
      }
         $output .= "</tbody></table>";
         echo $output;
    }else{
        echo"<h3> Aucune Cours pour le moment</h3>";
    }
}
if (isset($_POST['deletionId'])){
    $deletionId = (int)$_POST['deletionId'];
    echo $db->delete($deletionId);
  }
  if (isset($_POST['workingId'])){
    $workingId = (int)$_POST['workingId'];
    echo json_encode($db->getSinglBill($workingId));
  }
  
  if (isset($_POST['action']) && $_POST['action'] === 'update') {
    extract($_POST);
    $db-> update($cours_id,$cours_typeCours, $cours_date, $cours_heure_debut, $cours_heure_fin, $moniteur_nom, $moniteur_prenom, $typePermis_nom, $planning_id);
    echo'perfect';
  }

  if(isset($_GET['action']) && $_GET['action'] === 'export') {
    $excelFileName = "cours". date('YmdHis'). '.xls';
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=$excelFileName");
  
    $columnName = ['id', 'Type', 'Date', 'Heure debut','Heure fin' , 'Nom moniteur','Prenom moniteur' , 'Type permis' ,'Numero planing'];
  
    $data = implode("\t", array_values($columnName)) . "\n";
    if($db->countBills() > 0) {
        $bills = $db->readinfo();
        foreach ($bills as $bill) {
            $excelData = [$bill->cours_id, $bill->cours_typeCours, $bill->cours_date, $bill->cours_heure_debut,
            $bill->cours_heure_fin, $bill->moniteur_nom, $bill->moniteur_prenom, $bill->typePermis_nom ,$bill->planning_id];
            $data .= implode("\t", $excelData). "\n";
        }
    } else {
        $data = "Aucun cours trouvé..." . "\n";
    }
  
    echo $data;
    die();
  }
  if (isset($_POST['informationId'])){
    $informationId = (int)$_POST['informationId'];
    echo json_encode($db->getSinglBill($informationId));
  }
?>