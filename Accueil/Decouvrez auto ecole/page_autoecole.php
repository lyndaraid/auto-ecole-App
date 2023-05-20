<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="autoecole_style.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<title>navbar</title>
</head>
<body>
    <div class="header-image">
       <img  class="logo" src="../logo.jpg" alt="">
          <p class="Titre_logo">Auto-école Annarakdim Nassim</p>
          <p class="Titre_logo_2">Auto-école Bejaia(06)</p>
  </div>
</div>

<!-- Navbar  -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark bg-gradient pt-3 pb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">           </a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
    <ul class="navbar-nav text-center">
      <li>
        <a class="nav-link " aria-current="page" href="../page_accueil.html">Accueil</a>
    </li>
      <li class="nav-item">
         <a class="nav-link " aria-current="page" href="#">Nos véhicules</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">A propos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nos forfaits
            </a>
             <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Forfait auto</a></li>
                <li><a class="dropdown-item" href="#">forfait moto</a></li>
             </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Se connecter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Nous contacter</a>
     </li>
    </ul>
  </div>
</nav>
<div class="col-sm-12 col-md-12 container describe_1">
    <p> Située à Bejaia, l’auto-école Annarakdim Nassim vous fournira une formation sérieuse
         si vous voulez obtenir votre permis de conduire pour auto ou pour moto.
        Vous serez à même de maîtriser aussi bien le code de la route que la conduite.</p>
</div>
<div class="row describe_2" >
    <div class="col-sm-12 col-md-6">
        <img class="facade-auto-ecole" src="facade-auto-ecole.jpg" alt="">
    </div>
    <div class="col-sm-12 col-md-6 describe_2_info">
        <p>Composée de 5 enseignants, notre équipe se base sur REMC (Référentiel 
            pour une Education à une Mobilité Citoyenne) durant les formations.</p>
        <p class="describe_2_titre">Présentation de l’équipe :</p>
        <ul class="list_staff">
            <li >Nizar, gérant et enseignant de la conduite A et B</li>
            <li>Djamel, coordinateur pédagogique (enseignant B)</li>
            <li>Vincent, enseignant A et B</li>
            <li>Smaïl, enseignant B</li>
            <li>Camille, enseignante B</li>
            <li>Lucie, enseignante B </li>
            <li>Allison, secrétaire</li>
        </ul>
    </div>
</div>

<div class="row describe_3" >
    <div class="col-sm-12 col-md-6" >
        <button class="btn_forfait_A">Je découvre le forfait permis A</button>
    </div>
    <div class="col-sm-12 col-md-6">
        <button class="btn_forfait_B">Je découvre le forfait permis B</button>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
crossorigin="anonymous"></script>
</html>
