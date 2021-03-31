<?php
require_once "traitement.php";

// requete pour remplir le select afin de pouvoir trier par catégorie
$titresCategories = titreCategorie();

// lors de la modification d'un sujet
if(!empty($_POST["titreSujet"]) && !empty($_POST["validate"])){
    modifSujetAdmin($_POST["titreSujet"], $_POST["contenu"], $_POST["validate"]);

    if(empty($_GET["categories"]) && empty($_GET["pages"])){
        $url3 = "../admin/listeSujets.php";
    } else if(empty($_GET["categories"]) && !empty($_GET["pages"])){
        $url3 = "../admin/listeSujets.php?pages=" . $_GET["pages"];
    } else if(!empty($_GET["categories"]) && empty($_GET["pages"])) {
        $url3 = "../admin/listeSujets.php?categories=" . $_GET["categories"];
    } else if (!empty($_GET["categories"]) && !empty($_GET["pages"])){
        $url3 = "../admin/listeSujets.php?categories=" . $_GET["categories"] . "&pages=" . $_GET["pages"];
    }

    echo $url3;

    ?>
    <script>
        window.location.href="<?=$url3;?>";
    </script>
    <?php

}

// lors de la suppression d'un sujet
if(!empty($_POST["supprimer"])){
    supSujetAdmin($_POST["supprimer"]);

    if(empty($_GET["categories"]) && empty($_GET["pages"])){
        $url4 = "../admin/listeSujets.php";
    } else if(empty($_GET["categories"]) && !empty($_GET["pages"])){
        $url4 = "../admin/listeSujets.php?pages=" . $_GET["pages"];
    } else if(!empty($_GET["categories"]) && empty($_GET["pages"])) {
        $url4 = "../admin/listeSujets.php?categories=" . $_GET["categories"];
    } else if (!empty($_GET["categories"]) && !empty($_GET["pages"])){
        $url4 = "../admin/listeSujets.php?categories=" . $_GET["categories"] . "&pages=" . $_GET["pages"];
    }

    echo $url4;

    ?>
    <script>
        window.location.href="<?=$url4;?>";
    </script>
    <?php

}
