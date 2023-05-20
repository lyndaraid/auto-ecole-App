<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="accueil_style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Accueil</title>
</head>

<body>
    <div class="header-image">
        <img class="logo" src="logo.jpg" alt="">
        <p class="Titre_logo">Auto-école Annarakdim Nassim</p>
        <p class="Titre_logo_2">Auto-école Bejaia(06)</p>
    </div>
    </div>

    <!-- Navbar  -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark bg-gradient pt-3 pb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav text-center">
                    <li>
                        <a class="nav-link " aria-current="page" href="page_accueil.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="nos vehicules/page_nosvehicules.html">Nos
                            véhicules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Decouvrez auto ecole/page_autoecole.html">A propos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Nos forfaits</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Forfait auto</a></li>
                            <li><a class="dropdown-item" href="#">forfait moto</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/login page/login.php">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nous contacter</a>
                    </li>
                </ul>
            </div>
    </nav>

    <!-- Main Content -->
    <div class="main">
        <div class="container1">
            <img class="img_acceuil" src="image-accueil.png" alt="image en-tete">
            <button class="btncontact"><a href="#">Contactez nous</a> </button>
            <button class="btnforfaits"><a href="#">Nos forfaits</a> </button>
            <button class="btnautoecole"><a href="Decouvrez auto ecole/page_autoecole.html">
                    <p>Découvrez <br> l'auto école</p>
                </a> </button>
        </div>
    </div>
    <div class="container2 container">
        <div class="row">
            <h1 class="titre_forfaits">Nos forfaits</h1>
            <div class="col-sm-5 col-md-6 ">
                <img class="icon_car" src="icon_car.png" alt="">
                <figcaption class="forfait_auto">Forfait auto</figcaption>
                <div class="details_forfaits_auto">
                    <p style="max-width: 70%;margin: auto; text-align: justify;text-justify: inter-word;">
                        Le forfait permis B reste idéal pour vous si vous souhaitez accéder à une formation complète en
                        vue de
                        l’obtention du permis de conduire de catégorie B.
                        Nous disposons d’outils fiables, à commencer par un véhicule neuf pour mieux s’exercer à la
                        conduite
                        (Clio IV), jusqu’aux différentes méthodes d’apprentissage utilisées pour assimiler les cours.
                        Nous procédons à la fin de la formation à un examen blanc qui met chaque élève dans la situation
                        réelle, mais aussi dans les conditions de l’examen de conduite</p>
                </div>
            </div>
            <div class="col-sm-5 col-md-6">
                <img class="icon_moto" src="icon_moto.png" alt="">
                <figcaption class="forfait_moto">Forfait moto</figcaption>
                <div class="details_forfaits_auto">
                    <p style="max-width: 70%;margin: auto; text-align: justify;text-justify: inter-word;">
                        Ceux qui aspirent à conduire très prochainement un deux roues seront servis chez auto-école MC !
                        Jérôme, notre enseignant qui se
                        passionne de moto vous guidera dans votre apprentissage.
                        Vous monterez des véhicules neufs, soit uneYamaha MT-07 ainsi
                        qu’une moto bridée et rabaissée. Nous avons à notre disposition une
                        piste privée spécialement dédiée aux motos. Nous mettons un point d’honneur
                        à garantir la sécurité de nos élèves lors de leur formation moto dans notre
                        moto-école.</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-gradient">
        <div class="row">
            <div class="col-sm-5 col-md-4">
                <h3 class="location">Location</h3>
                <p class="adresse">
                    64,Rue des Aurés-Béjaia
                </p>
            </div>
            <div class="col-sm-5 col-md-4">
                <h3 class="contact">Nos contacts</h3>
                <p class="contact_info">
                    <img src="icon-phone.png" alt="" style="padding: 5px;">0111111111
                </p>
                <p class="contact_info">
                    <img src="mail-icon.gif" alt="" style="padding: 5px;">autoecoleAKN@gmail.com
                </p>
            </div>
            <div class="col-sm-5 col-md-4">
                <h3 class="horaires">Nos Horaires</h3>
                <p class="horaires_info" style="font-weight: bold;">
                    OUVERTURE DU BUREAU ET SÉANCE DE CODE
                </p>

                <p class="horaires_info2">
                    Du Lundi au Vendredi : de 15h à 19h
                </p>
                <p class="horaires_info2">Samedi : 10h à 14h</p>
                <p class="horaires_info" style="font-weight: bold;">
                    LES COURS DE CONDUITE :
                </p>
                <p class="horaires_info2">
                    8h à 20h : tous les jours
                </p>
                <p class="horaires_info2">Samedi : 8h à 17h</p>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>



</html>