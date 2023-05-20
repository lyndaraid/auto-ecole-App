<?php
require_once  'model.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action']=== 'create') {
    extract($_POST);
    $db-> create($exemen_date,$exemen_lieu,$exemen_type,$exemen_resultat,
    $candidat_nom,$candidat_prenom,$typePermis_nom,$moniteur_nom,$moniteur_prenom,$planning_id);
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
                           <th scope="col">Date</th>
                           <th scope="col">lieu</th>
                           <th scope="col">Type</th>
                           <th scope="col">Résultat</th>
                           <th scope="col">Nom candidat</th>
                           <th scope="col">Prénom candidat</th>
                           <th scope="col">Type permis</th>
                           <th scope="col">Nom moniteur</th>
                           <th scope="col">Prénom moniteur</th>
                           <th scope="col">Numero planing</th>
                           <th scope="col">Action</th>
                          </tr>
                       </thead>
                     <tbody>
      ';
      foreach($bills as $bill){
        $output.= "
          <tr>
                    <th scope=\"row\">$bill->exemen_id</th>
                    <td>$bill->exemen_date</td>
                    <td>$bill->exemen_lieu</td>
                    <td>$bill->exemen_type</td>
                    <td>$bill->exemen_resultat</td>
                    <td>$bill->candidat_nom</td>
                    <td>$bill->candidat_prenom</td>
                    <td>$bill->typePermis_nom</td>
                    <td>$bill->moniteur_nom</td>
                    <td>$bill->moniteur_prenom</td>
                    <td>$bill->planning_id</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\" data-id=\"$bill->exemen_id\"><i class=\"fas fa-info-circle\"></i></a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Modifier\" data-id=\"$bill->exemen_id\"><i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"supprimer\" data-id=\"$bill->exemen_id\"><i class=\"fas fa-trash-alt\"></i></a>
                    </td>
                </tr>
            ";
        
      }
         $output .= "</tbody></table>";
         echo $output;
    }else{
        echo"<h3> Aucun examen trouvé pour le moment</h3>";
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
    $db-> update( $exemen_id,$exemen_date, $exemen_lieu, $exemen_type, $exemen_resultat,
     $candidat_nom, $candidat_prenom, $typePermis_nom, $moniteur_nom, $moniteur_prenom, $planning_id);
    echo'perfect';
  }
  
  if(isset($_GET['action']) && $_GET['action'] === 'export') {
    $excelFileName = "examens". date('YmdHis'). '.xls';
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=$excelFileName");
  
    $columnName = ['id', 'Date', 'Type', 'Resultat',  'Nom candidat','Prenom candidat' , 'Type permis' ,'Nom moniteur','Prenom moniteur' ,'Numero planing'];
  
    $data = implode("\t", array_values($columnName)) . "\n";
    if($db->countBills() > 0) {
        $bills = $db->readinfo();
        foreach ($bills as $bill) {
            $excelData = [$bill->exemen_id, $bill->exemen_date, $bill->exemen_type, $bill->exemen_resultat,
            $bill->candidat_nom, $bill->candidat_prenom, $bill->typePermis_nom , $bill->moniteur_nom, $bill->moniteur_prenom,$bill->planning_id];
            $data .= implode("\t", $excelData). "\n";
        }
    } else {
        $data = "Aucun examen trouvé..." . "\n";
    }
  
    echo $data;
    die();
  }
  if (isset($_POST['informationId'])){
    $informationId = (int)$_POST['informationId'];
    echo json_encode($db->getSinglBill($informationId));
  }
?>