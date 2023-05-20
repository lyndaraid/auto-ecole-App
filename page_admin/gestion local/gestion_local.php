<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="gestion_local_style.css">
    <title>Gestion des locaux</title>
</head>

<body>
    <header>
        <?php
        include "../nav_bar/nav.php";
        ?>

        <section class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm mb-5 mx-auto">
                    <h1 class="fs-4 text-center lead text-primary">Gestion des locaux</h1>
                </div>
            </div>
            <div class="dropdown-divider border-warning"></div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-8">Liste des locaux disponibles</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-folder-plus"></i> Nouveau</button>
                        <a href="process.php?action=export" class="btn btn-success btn-sm" id="export"><i class="fas fa-table"></i> Exporter</a>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider border-warning"></div>
            <div class="row">
                <div class="table-responsive" id="orderTable">
                    <h3 class="text-success text-center">Chargement des locaux...</h3>
                </div>
            </div>
        </section>


        <!-- CreateModal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Nouveau local</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="formOrder">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="local_nom" name="local_nom" required>
                                <label for="local_nom">Nom du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="local_adresse" rows="3" name="local_adresse" required></textarea>
                                <label for="local_adresse">Adresse du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="local_capacite" name="local_capacite" required>
                                <label for="local_capacite">Capacitée du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="local_type" name="local_type" required>
                                <label for="local_type">Type du local</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary" id="create" name="create">Ajouter <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- UpdateModal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Nouveau type permis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="formUpdateOrder">
                            <input type="hidden" name="local_id" id="bill_id">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="local_nomUpdate" name="local_nom" required>
                                <label for="local_nomUpdate">Nom du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="local_adresseUpdate" rows="3" name="local_adresse" required></textarea>
                                <label for="local_adresseUpdate">Adresse du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="local_capaciteUpdate" name="local_capacite" required>
                                <label for="local_capciteUpdate">Type du local</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="local_typeUpdate" name="local_type" required>
                                <label for="local_typeUpdate">Type du local</label>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-primary" id="update" name="update">Mettre à jour <i class="fas fa-sync"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="gestionlocal_script.js"></script>
</body>

</html>