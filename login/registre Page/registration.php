<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> inscription</title>
    <!-- fontasesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Link css -->
    <link rel="stylesheet" href="registration.css">
    <!--  Link JS -->
    <script src="registration.js"></script>
</head>

<body>
    <div class="container ">
        <form class="needs-validation " action="traiteRegistration.php" method="POST">
            <div class="card">
                <div class="row">

                    <h1 class="title">Inscription</h1>

                    <div class="row">

                        <?php if (isset($_GET['error_message'])) { ?>
                        <div id="error-message" class="alert alert-danger m-auto m-lg-3" role="alert">
                            <?php echo $_GET['error_message'] ?>
                        </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success m-auto m-lg-3" role="alert">
                            <?php echo $_GET['success'] ?>
                        </div>
                        <?php } ?>

                        <div class="form_group was-validated col-md  mb-2  mt-2  mx-3 ">
                            <label for="nom"> NOM</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-user-circle"></i>
                                </span>
                                <input type="text" name="nom" id="nom" placeholder="Entre votre nom"
                                    class="form-control" required>


                            </div>
                        </div>

                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="prenom"> Prénom</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="prenom" id="prenom" placeholder="Entre votre Prenom"
                                    class="form-control" required>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="form_group was-validated col-md mb-3  mt-3  mx-3">
                            <label for="email"> Email</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" placeholder="Entre votre email"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="telephone"> Telephone</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" name="telephone" id="telephone" placeholder="Entre votre telephone"
                                    class="form-control" required>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="form_group was-validated col-md mb-3  mt-3  mx-3">
                            <label for="password">Mot de passe</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" name="password" id="password"
                                    placeholder="Entre votre mot de passe" class="form-control" required>
                                <span class="input-group-text" onclick="motPASS_Affichage()">
                                    <i class="fas fa-eye" id="hide1"></i>
                                    <i class="fas fa-eye-slash" id="hide2"></i>
                                </span>

                            </div>
                        </div>

                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="password-confirm">confirmer mot de passe</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </span>
                                <input type="password" id="password-confirm" name="re_password"
                                    placeholder="confirmer votre mot de passe" class="form-control" required>
                                <span class="input-group-text" onclick="motPASS_confirme()">
                                    <i class="fas fa-eye" id="hide3"></i>
                                    <i class="fas fa-eye-slash" id="hide4"></i>
                                </span>
                            </div>


                            <div class="" id="message-confirm" role="alert">

                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="">Date naissance</label>
                            <input type="date" name="birthday" class="form-control">
                        </div>

                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="">ville</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="ville" placeholder="Entre votre ville" class="form-control"
                                    required>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form_group was-validated col-md mb-3 mt-3  mx-3">
                            <label for="">Votre photo</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-image"></i>
                                </span>
                                <input type="file" class="form-control" name="photo" id="inputGroupFile02" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2 " type="submit" id="submit-button"
                            onclick="checkpassword()" name="Valid_registre">
                            <i class="fas fa-sign-in"></i>Connecter
                        </button>
                        <button class="btn btn-primary me-md-2" type="text">
                            <i class="fas fa-share"></i> Revenir
                        </button>

                    </div>

                    <div class="form-link">
                        <span>J'ai un compte? <a href="../login page/login.php">Se conneter </a></span>
                    </div>

                </div>

            </div>
        </form>
    </div>

</body>

</html>