<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="paimentnormal_style.css">
    <title>Gestion des paiements</title>
</head>

<body>

    <?php
  include "../nav_bar/nav.php";
  ?>


    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-sm mb-5 mx-auto">
                <h1 class="fs-4 text-center lead text-primary">Gestion des paiments </h1>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-8">Liste des paiments </h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal"><i
                            class="fas fa-folder-plus"></i> Nouveau</button>
                    <a href="process.php?action=export" class="btn btn-success btn-sm" id="export"><i
                            class="fas fa-table"> Exporter</i></a>
                </div>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="table-responsive" id="orderTable">

            </div>
        </div>
    </section>




    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nouveau paiment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formOrder">
                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="candidat_nom" name="candidat_nom" required>
                            <label for="candidat_nom">nom du candidat</label>

                            </a>

                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="candidat_prenom" name="candidat_prenom"
                                required>
                            <label for="candidat_prenom">Prenom du candidat</label>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="modePaiement_nom" aria-label="modePaiement_nom"
                                    name="modePaiement_nom" required>
                                    <option value="paiment normal">paiment normal</option>
                                    <option value="paiment forfait">paiment forfait</option>

                                </select>
                                <label for="modePaiement_nom">Mode de paiment</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="facture_emission" name="facture_emission"
                                required>
                            <label for="facture_emission">Prenom du candidat</label>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="typePermis_nom" name="typePermis_nom"
                                        required>
                                    <label for="typePermis_nom">Types du permis</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="facture_montant_total"
                                        name="facture_montant_total" required>
                                    <label for="facture_montant_total">Montant total </label>
                                </div>
                            </div>

                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="facture_montant_paye"
                                        name="facture_montant_paye" required>
                                    <label for="facture_montant_paye">Montant payé </label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="facture_status" aria-label="facture_status"
                                        name="facture_status" required>
                                        <option value="Payée">Payée</option>
                                        <option value="Non payée">Non payée</option>

                                    </select>
                                    <label for="facture_status">Etat</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="create" name="create">Ajouter <i
                            class="fas fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Modifier un paiement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formUpdateOrder">
                        <input type="hidden" name="paiemnt_id" id="bill_id">
                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="candidat_nomUpdate" name="candidat_nom"
                                required>
                            <label for="candidat_nomUpdate">nom du candidat</label>

                            </a>

                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="candidat_prenomUpdate" name="candidat_prenom"
                                required>
                            <label for="candidat_prenomUpdate">Prenom du candidat</label>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="modePaiement_nomUpdate"
                                    aria-label="modePaiement_nomUpdate" name="modePaiement_nom" required>
                                    <option value="paiment normal">paiment normal</option>
                                    <option value="paiment forfait">paiment forfait</option>

                                </select>
                                <label for="modePaiement_nomUpdate">Mode de paiment</label>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="facture_emissionUpdate" name="facture_emission"
                                required>
                            <label for="facture_emissionUpdate">Prenom du candidat</label>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="typePermis_nomUpdate"
                                        name="typePermis_nom" required>
                                    <label for="typePermis_nomUpdate">Types du permis</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="facture_montant_totalUpdate"
                                        name="facture_montant_total" required>
                                    <label for="facture_montant_totalUpdate">Montant total </label>
                                </div>
                            </div>

                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="facture_montant_payeUpdate"
                                        name="facture_montant_paye" required>
                                    <label for="facture_montant_payeUpdate">Montant payé </label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="facture_statusUpdate" aria-label="etat"
                                        name="facture_status" required>
                                        <option value="Payée">Payée</option>
                                        <option value="Non payée">Non payée</option>

                                    </select>
                                    <label for="facture_statusUpdate">Etat</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="update" name="update">Mettre à jour <i
                            class="fas fa-sync"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="paimentnormal_script.js"></script>
</body>

</html>