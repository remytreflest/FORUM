<?php
require_once "../traitements/traitement.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Forum</title>
</head>
<body>

<!-- Début de la barre de navigation -->

<nav class="navbar navbar-light navbar-expand-md bg-light">
  <a class="navbar-brand" href="index.php">
    Forum
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <div class="navbar-nav col-12">
        <a class="nav-item nav-link" href="ajoutSujet.php">Ajouter un sujet</a>
        <?php
        if(isset($_SESSION["idUser"]) && !empty($_SESSION["idUser"]) &&
        isset($_SESSION["identifiant"]) && !empty($_SESSION["identifiant"]) && 
        isset($_SESSION["Role"]) && !empty($_SESSION["Role"])){
          if(!empty($_SESSION["Role"]) && $_SESSION["Role"] == 2){
            ?>
            <a class="nav-item nav-link" href="../admin/indexAdmin.php">SB-Admin</a>
            <?php
          }
          ?>
          <a class="nav-item nav-link ml-auto" href="../user/profil.php">
            <i class="fas fa-cog"></i>
          </a>
          <a class="nav-item nav-link btn btn-outline-danger d-flex align-items-end" role="button" href="../traitements/deconnexion.php">Déconnexion</a>
          <?php
        }else{
          ?>
          <div class="btn-group d-flex align-items-end ml-auto" role="group" aria-label="Basic example">
            <a class="nav-item nav-link btn btn-outline-info " role="button" href="inscription.php">Inscription</a>
            <a class="nav-item nav-link btn btn-outline-success" role="button" href="connexion.php">Connexion</a>
          </div>
          <?php
        }
        ?>
  </div>
</nav>

<!-- Fin de la barre de navigation -->

<div class="container my-5">