<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <!-- fontasesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="images/icon logo.PNG" type="image/png">
    <script src="login.js bgjbhgg"></script>

</head>

<body>
    <div class="container">
        <div class="cover">
            <div class="front">
                <img src="images/image svg login.PNG" alt="image login">
            </div>
        </div>
        <div class="form-content">
            <div class="login">
                <h1 class="title">Se connecter </h1>

                <form class="needs-validation " action="traiteLogin.php" method="post">

                    <?php if (isset($_GET['error_message'])) { ?>
                    <div id="error-message" class="alert alert-danger" role="alert">
                        <?php echo $_GET['error_message'] ?>
                    </div>
                    <?php } ?>

                    <div class="form_group was-validated ">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" class=" form-control "
                                placeholder="Enter your email" required>
                            <div class="invalid-feedback">
                                Please enter your email address
                            </div>
                        </div>



                    </div>

                    <div class="form_group was-validated">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control " required>
                            <span class="input-group-text" onclick="motPASS_Affichage()">
                                <i class="fas fa-eye" id="hide1"></i>
                                <i class="fas fa-eye-slash" id="hide2"></i>
                            </span>
                            <div class="invalid-feedback">
                                Please enter your password
                            </div>
                        </div>
                    </div>


                    <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" id="check">
                        <label class="form-check-label" for="check"> souvenir de moi</label>
                        <div class="form-link"><a href="#">mote passe oublié?</a></div>
                    </div>

                    <input class="btn btn-primary w-100" type="submit" value="Connexion" name="Valid_connexion">
                    <div class="form-link">
                        <span>J'ai pas un compte? <a href="../registre Page/registration.php">Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>