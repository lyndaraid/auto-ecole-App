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
    <link rel="stylesheet" href="gestionvehicules_permisA_style.css">
    <title>Gestion des vehicules</title>
</head>

<body>

    <?php
  include "../nav_bar/nav.php";
  ?>
    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-sm mb-5 mx-auto">
                <h1 class="fs-4 text-center lead text-primary">Gestion des vehicules</h1>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-8">Liste des vehicules disponibles</h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal"><i
                            class="fas fa-folder-plus"></i> Nouveau</button>
                    <a href="process.php?action=export" class="btn btn-success btn-sm" id="export"><i
                            class="fas fa-table"></i> Exporter</a>
                </div>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="table-responsive" id="orderTable">
                <h3 class="text-success text-center">Chargement des vehicule...</h3>
            </div>
        </div>
    </section>




    <!-- CreateModal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nouveau vehicule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formOrder">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_marque" name="vehicule_marque"
                                required>
                            <label for="vehicule_marque">Marque deu vehicule</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="vehicule_modele" rows="3" name="vehicule_modele"
                                required></textarea>
                            <label for="vehicule_modele">Modele du vehicule</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_annee" name="vehicule_annee" required>
                            <label for="vehicule_annee">Prix de base du permis</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_permis" name="vehicule_permis"
                                required>
                            <label for="vehicule_permis">Permis associé au vehicule</label>
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

    <!-- UpdateModal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Modifier un véhicule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formUpdateOrder">
                        <input type="hidden" name="vehicule_id" id="bill_id">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_marqueUpdate" name="vehicule_marque"
                                required>
                            <label for="vehicule_marqueUpdate">Marque deu vehicule</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_modeleUpdate" name="vehicule_modele"
                                required></textarea>
                            <label for="vehicule_modeleUpdate">Modele du vehicule</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_anneeUpdate" name="vehicule_annee"
                                required>
                            <label for="vehicule_anneeUpdate">Prix de base du permis</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="vehicule_permisUpdate" name="vehicule_permis"
                                required>
                            <label for="vehicule_permisUpdate">Permis associé au vehicule</label>
                        </div>

                </div>
                </form>

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
    <script src="gestionvehicules_permisA_script.js"></script>
</body>

</html>