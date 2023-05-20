<?php
session_start();
include '../../../../includ/connexionObject.php';
$dbobj = new Database();
// var_dump($dbobj);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List candidats</title>
  <!-- fontasesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <!-- boostrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Link css -->
  <link rel="stylesheet" href="listcandidat.css">

</head>

<body>
  <!-- nav bar ici -->
  <?php
  include "../../../nav_bar/nav.php";
  ?>
  <section class="overlay">

    <div class="container">
      <!-- bar de rechercher -->
      <div class="row mb-3">
        <div class="col-10">
          <div class="input-group mb-3">
            <span class="input-group-text bg-dark text-light" id="basic-addon1"> <i class="fas fa-search"></i></span>
            <input type="text" class="form-control" placeholder="chercher un candidat ..." aria-describedby="basic-addon1">

          </div>
        </div>

        <div class="col-2">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usermodal">
            <i class="fas fa-user-plus"></i> Ajouter
          </button>
        </div>

      </div>

      <div class="row mb-3">
        <!-- modal -->
        <?php
        include 'formajoutecadida.php';
        ?>

        <!-- list candidat -->
        <?php
        include 'tablescandidat.php';
        ?>
        <!-- profil -->
        <?php
        include 'profileview.php';
        ?>
      </div>

      <!-- pagination -->
      <div class="row mb-3 mt-3">
        <nav aria-label="Page navigation example " id='pagination'>
          <ul class="pagination justify-content-center">
            <li class="page-item  disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active "><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>

    </div>

  </section>


  <!--  Link JS -->
  <script src="listcandidat.js"></script>
  <!-- jquery cdn -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <!-- boostrap js link  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
  </script>
  <!-- file js -->
  <script src="js/scripts.js"></script>

</body>

</html>