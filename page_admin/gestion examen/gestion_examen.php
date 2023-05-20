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
    <link rel="stylesheet" href="gestion_examen_style.css">
    <title>Gestion des examens</title>
</head>

<body>
    <?php
  include "../nav_bar/nav.php";
  ?>

    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-sm mb-5 mx-auto">
                <h1 class="fs-4 text-center lead text-primary">Gestion des examens</h1>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-0">Liste des examens</h5>
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

                <h3 class="text-success text-center">Chargement des examens...</h3>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nouveau examen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formOrder">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="exemen_date" name="exemen_date"
                                        required>
                                    <label for="exemen_date">Date de l'examen</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="exemen_lieu" name="exemen_lieu"
                                        required>
                                    <label for="exemen_lieu">Lieu de l'examen</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="exemen_type" name="exemen_type"
                                        required>
                                    <label for="exemen_type">Type de l'examen</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="exemen_resultat" name="exemen_resultat"
                                        required>
                                    <label for="exemen_resultat">Resultat de l'examen</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="candidat_nom" name="candidat_nom"
                                        required>
                                    <label for="candidat_nom">Nom du candidat</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="candidat_prenom" name="candidat_prenom"
                                        required>
                                    <label for="candidat_prenom">Prenom du candidat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="typePermis_nom" name="typePermis_nom"
                                        required>
                                    <label for="typePermis_nom">Type du permis</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="planning_id" name="planning_id"
                                        required>
                                    <label for="planning_id">Numero du planning</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="moniteur_nom" name="moniteur_nom"
                                        required>
                                    <label for="moniteur_nom">Nom du moniteur</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="moniteur_prenom" name="moniteur_prenom"
                                        required>
                                    <label for="moniteur_prenom">Prenom du moniteur</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" name="create" id="create">Ajouter <i
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
                    <h5 class="modal-title" id="updateModalLabel">Modifier un </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formUpdateOrder">
                        <input type="hidden" name="exemen_id" id="bill_id">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="exemen_dateUpdate" name="exemen_date"
                                        required>
                                    <label for="exemen_dateUpdate">Date de l'examen</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="exemen_lieuUpdate" name="exemen_lieu"
                                        required>
                                    <label for="exemen_lieuUpdate">Lieu de l'examen</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="exemen_typeUpdate" name="exemen_type"
                                        required>
                                    <label for="exemen_typeUpdate">Type de l'examen</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="exemen_resultatUpdate"
                                        name="exemen_resultat" required>
                                    <label for="exemen_resultatUpdate">Resultat de l'examen</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="candidat_nomUpdate" name="candidat_nom"
                                        required>
                                    <label for="candidat_nomUpdate">Nom du candidat</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="candidat_prenomUpdate"
                                        name="candidat_prenom" required>
                                    <label for="candidat_prenomUpdate">Prenom du candidat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="typePermis_nomUpdate"
                                        name="typePermis_nom" required>
                                    <label for="typePermis_nomUpdate">Type du permis</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="planning_idUpdate" name="planning_id"
                                        required>
                                    <label for="planning_idUpdate">Numero du planning</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="texte" class="form-control" id="moniteur_nomUpdate" name="moniteur_nom"
                                        required>
                                    <label for="moniteur_nomUpdate">Nom du moniteur</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="moniteur_prenomUpdate"
                                        name="moniteur_prenom" required>
                                    <label for="moniteur_prenomUpdate">Prenom du moniteur</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" name="update" id="update">Mettre à jour <i
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
    <script src="gestion_examen_script.js"></script>
</body>

</html>