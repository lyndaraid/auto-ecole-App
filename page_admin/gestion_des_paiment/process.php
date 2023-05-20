<?php
require_once  'model.php';
$db = new Database();
if (isset($_POST['action']) && $_POST['action']=== 'createFacturee') {
    extract($_POST);
    $db-> createFacturee( $facture_emission, (int)$facture_montant_paye, (int)$facture_montant_total, (string)$facture_status);
    echo'perfect';
}
if (isset($_POST['action']) && $_POST['action']=== 'addPaiment') {
    extract($_POST);
    $db-> addPaiment((int)$facture_montant_paye, (string)$modePaiement_nom, $candidat_nom,$candidat_prenom,$facture_emission,$facture_montant_total, $typePermis_nom);
    echo'perfect';
}
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
                          <th scope="col">Prenom</th>
                          <th scope="col">Mode paiment</th>
                          <th scope="col">Permis</th>
                          <th scope="col">Montant total</th>
                          <th scope="col">Montant payé</th>
                          <th scope="col">Etat</th>
                          <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
      ';
      foreach($bills as $bill){
        $output.= "
          <tr>
                    <th scope=\"row\">$bill->paiemnt_id</th>
                    <td>$bill->candidat_nom</td>
                    <td>$bill->candidat_prenom</td>
                    <td>$bill->modepaiement_nom</td>
                    <td>$bill->typepermis_nom</td>
                    <td>$bill->facture_montant_paye</td>
                    <td>$bill->facture_montant_total</td>
                    <td>$bill->facture_status</td>
                    <td>
                    <a href=\"#\" class=\"text-info me-2 infoBtn\" title=\"Voir détails\" data-id=\"$bill->paiemnt_id\"><i class=\"fas fa-info-circle\"></i></a>
                    <a href=\"#\" class=\"text-primary me-2 editBtn\" title=\"Modifier\" data-id=\"$bill->paiemnt_id\"><i class=\"fas fa-edit\" data-bs-toggle='modal' data-bs-target='#updateModal'></i></a>
                    <a href=\"#\" class=\"text-danger me-2 deleteBtn\" title=\"supprimer\" data-id=\"$bill->paiemnt_id\"><i class=\"fas fa-trash-alt\"></i></a>
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
if (isset($_POST['workingId'])){
  $workingId = (int)$_POST['workingId'];
  echo json_encode($db->getSinglBill($workingId));
}

if (isset($_POST['action']) && $_POST['action'] === 'update') {
  extract($_POST);
  $db-> update((int)$paiemnt_id, $facture_montant_paye, $modePaiement_nom, $candidat_nom, $candidat_prenom,$facture_emission,$facture_montant_total,(string)$facture_status, $typePermis_nom);
  echo'perfect';
}

if (isset($_POST['informationId'])){
  $informationId = (int)$_POST['informationId'];
  echo json_encode($db->getSinglBill($informationId));
}

  if (isset($_POST['deletionId'])){
    $deletionId = (int)$_POST['deletionId'];
    echo $db->delete($deletionId);
  } 
  //Exportation
if(isset($_GET['action']) && $_GET['action'] === 'export') {
  $excelFileName = "paiements". date('YmdHis'). '.xls';
  header("Content-Type: application/csv");
  header("Content-Disposition: attachment; filename=$excelFileName");

  $columnName = ['id', 'Nom', 'Prenom', 'Mode paiement','Montant total' , 'type du permis','Montant paye' , 'Etat'];

  $data = implode("\t", array_values($columnName)) . "\n";
  if($db->countBills() > 0) {
      $bills = $db->readinfo();
      foreach ($bills as $bill) {
          $excelData = [$bill->paiemnt_id, $bill->candidat_nom, $bill->candidat_prenom, $bill->modePaiement_nom,
          $bill->typePermis_nom, $bill->facture_montant_total, $bill->facture_montant_paye, $bill->facture_status];
          $data .= implode("\t", $excelData). "\n";
      }
  } else {
      $data = "Aucune paiment trouvé..." . "\n";
  }

  echo $data;
  die();
}

?>