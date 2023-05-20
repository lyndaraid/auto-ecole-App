<?php
class Database
{
    private $db_host = 'localhost';
    private $db_name = 'mydb';
    private $db_username = 'root';
    private $port = "3308";
    private $db_password = '';

    public function getConnextion()
    {
        try {
            return new PDO('mysql:host=' . $this->db_host . '; port=3308; dbname=' . $this->db_name, $this->db_username, $this->db_password);
            echo "connexion faite avec succès";
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function createFacturee($facture_emission, int $facture_montant_paye, int $facture_montant_total, string $facture_status)
    {
        $q = $this->getConnextion()->prepare("INSERT INTO facture(facture_emission,facture_montant_paye,facture_montant_total,facture_status) VALUES(:facture_emission, :facture_montant_paye,:facture_montant_total,:facture_status)");
        return $q->execute([
            'facture_emission' => $facture_emission,
            'facture_montant_paye' => $facture_montant_paye,
            'facture_montant_total' => $facture_montant_total,
            'facture_status' => $facture_status
        ]);
    }

    public function addPaiment(int $facture_montant_paye, string $modePaiement_nom, string $candidat_nom, string $candidat_prenom, $facture_emission, $facture_montant_total, string $typepermis_nom)
    {

        $q = $this->getConnextion()->prepare(" INSERT INTO paiemnt(facture_id,modePaiement_id,candidat_id,typePermis_id) VALUES((select facture_id from facture where (facture_montant_paye= :facture_montant_paye and facture_montant_total= :facture_montant_total and facture_emission= :facture_emission  ) LIMIT 1)
,(select modePaiement_id from modepaiement where modePaiement_nom= :modePaiement_nom LIMIT 1),(select candidat_id from candidat where (candidat_nom= :candidat_nom and candidat_prenom= :candidat_prenom)  LIMIT 1),(select typePermis_id from typepermis where typepermis_nom= :typepermis_nom LIMIT 1 ))");
        return $q->execute([

            'facture_montant_paye' => $facture_montant_paye,
            'modePaiement_nom' => $modePaiement_nom,
            'candidat_nom' => $candidat_nom,
            'candidat_prenom' => $candidat_prenom,
            'facture_montant_total' => $facture_montant_total,
            'facture_emission' => $facture_emission,
            'typepermis_nom' => $typepermis_nom
        ]);
    }
    public function read()
    {
        return  $this->getConnextion()->query("SELECT paiemnt_id,candidat_nom,candidat_prenom, modepaiement_nom,typepermis_nom,facture_montant_total,facture_montant_paye,facture_status from facture ,modepaiement,candidat,typepermis JOIN paiemnt where (paiemnt.facture_id= facture.facture_id and paiemnt.modePaiement_id= modepaiement.modePaiement_id and paiemnt.typePermis_id= typepermis.typePermis_id  and paiemnt.candidat_id=candidat.candidat_id)  GROUP by paiemnt.paiemnt_id ")->fetchAll(PDO::FETCH_OBJ);
    }
    public function readinfo()
    {
        return  $this->getConnextion()->query("SELECT paiemnt.paiemnt_id,candidat.candidat_nom,candidat.candidat_prenom,typepermis.typePermis_nom,facture.facture_montant_paye,
    facture.facture_montant_total,facture.facture_status,modepaiement.modePaiement_nom from candidat,paiemnt,typepermis,facture,modepaiement
     where candidat.candidat_id=paiemnt.candidat_id and typepermis.typePermis_id=paiemnt.typePermis_id and facture.facture_id=paiemnt.facture_id and modepaiement.modePaiement_id=paiemnt.modePaiement_id  GROUP BY paiemnt_id")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getConnextion()->query("SELECT count(paiemnt_id) as count from paiemnt")->fetch()[0];
    }

    public function getSinglBill(int $paiemnt_id)
    {

        $q = $this->getConnextion()->prepare(" SELECT paiemnt_id,candidat.candidat_nom,candidat.candidat_prenom,typepermis.typePermis_nom,facture.facture_montant_paye,
    facture.facture_montant_total,facture.facture_status,modepaiement.modePaiement_nom from candidat,paiemnt,typepermis,facture,modepaiement
     where candidat.candidat_id=paiemnt.candidat_id and typepermis.typePermis_id=paiemnt.typePermis_id and facture.facture_id=paiemnt.facture_id and modepaiement.modePaiement_id=paiemnt.modePaiement_id  and paiemnt_id= :paiemnt_id");
        $q->execute(['paiemnt_id' => $paiemnt_id]);
        return $q->fetch(PDO::FETCH_OBJ);
        echo 'hi bill';
    }

    public function update(int $paiemnt_id, int $facture_montant_paye, string $modePaiement_nom, string $candidat_nom, string $candidat_prenom, $facture_emission, $facture_montant_total, string $facture_status, string $typePermis_nom)
    {
        $q = $this->getConnextion()->prepare("UPDATE paiemnt set paiemnt.facture_id=(SELECT facture_id from facture where (facture.facture_montant_paye = :facture_montant_paye and 
    facture.facture_montant_total = :facture_montant_total and facture.facture_emission = :facture_emission and facture.facture_status = :facture_status)LIMIT 1) ,paiemnt.candidat_id=(SELECT candidat_id from candidat where (candidat.candidat_nom = :candidat_nom 
     and candidat.candidat_prenom = :candidat_prenom ) LIMIT 1),paiemnt.modePaiement_id=(SELECT modePaiement_id from modepaiement where modepaiement.modePaiement_nom = :modePaiement_nom  LIMIT 1),paiemnt.typePermis_id=(SELECT typePermis_id from typepermis where typepermis.typePermis_nom = :typePermis_nom 
    LIMIT 1) WHERE paiemnt_id = :paiemnt_id");
        return $q->execute([
            'facture_montant_paye' => $facture_montant_paye,
            'modePaiement_nom' => $modePaiement_nom,
            'candidat_nom' => $candidat_nom,
            'candidat_prenom' => $candidat_prenom,
            'facture_montant_total' => $facture_montant_total,
            'facture_emission' => $facture_emission,
            'typePermis_nom' => $typePermis_nom,
            'facture_status' => $facture_status,
            'paiemnt_id' => $paiemnt_id,

        ]);
    }

    public function delete(int $paiemnt_id): bool
    {
        $q = $this->getConnextion()->prepare("DELETE FROM  paiemnt where paiemnt_id = :paiemnt_id");
        return $q->execute(['paiemnt_id' => $paiemnt_id]);
    }
}
