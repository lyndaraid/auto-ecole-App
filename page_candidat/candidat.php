<?php
session_start();
if (isset($_SESSION['Utilisateur_id'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontasesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>page candidat</title>
</head>
<h1> Hello,<?php echo  $_SESSION['Utilisateur_email']; ?> </h1>

<button class="btn btn-btn-primary">
    <i class="fas fa-key"></i>
    <a href="../includ/logout.php">logout</a>

</button>

<body>

</body>

</html>
<?php }
?>