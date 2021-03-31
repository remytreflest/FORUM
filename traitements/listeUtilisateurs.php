<?php
require_once "traitement.php";

if(!empty($_POST["idRole"]) && !empty($_POST["validate"])){

    $erreurs = [];
    $userRemoved = false;

    if(!empty($_POST["idCategorie"])){

        $userCate = userCategorie($_POST["idCategorie"]);

        if($_POST["idUser"] !== $userCate["idUser"] && $userCate["idUser"] !== NULL){

            supModerateur($_POST["idCategorie"]);

            $userRemoved = $userCate["identifiant"] . " " . $userCate["idUser"] . " " . $_POST["idCategorie"];
        }

        try {
            ajoutModerateur($_POST["idUser"], $_POST["idCategorie"]);
        } catch (Exception $e) {
            modifModerateur($_POST["idCategorie"], $_POST["idUser"]);
        }
        
    } else {

        try {
            supModerateurBU($_POST["idUser"]);
        } catch (Exception $e) {
            //Nothing
        } 

    }

    modifUserBM($_POST["idRole"], $_POST["idUser"]);


    if(empty($_GET["filtre"]) && empty($_GET["pages"])){
        $url3 = "../admin/listeUtilisateurs.php";
    } else if(empty($_GET["filtre"]) && !empty($_GET["pages"])){
        $url3 = "../admin/listeUtilisateurs.php?pages=" . $_GET["pages"];
    } else if(!empty($_GET["filtre"]) && empty($_GET["pages"])) {
        $url3 = "../admin/listeUtilisateurs.php?filtre=" . $_GET["filtre"];
    } else if (!empty($_GET["filtre"]) && !empty($_GET["pages"])){
        $url3 = "../admin/listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&pages=" . $_GET["pages"];
    }

    if($userRemoved !== false){
        if(empty($_GET["filtre"]) && empty($_GET["pages"])){
            $url3 = $url3 . "?userRemoved=" . $userRemoved;
        } else {
            $url3 = $url3 . "&userRemoved=" . $userRemoved;
        }
        
    }

    if(count($erreurs) > 0){
        ?>
        <div class="alert alert-danger text-center">
        <?php
        foreach($erreurs as $erreur){
            echo $erreur . "<br>";
        }
        ?>
        </div>
        <?php
    } else {

        ?>
        <script>
            window.location.href="<?=$url3;?>";
        </script>
        <?php

    }



} else if(isset($_POST["validate"])) {
    header("location:../admin/listeUtilisateurs?error");
}

// Pour la suppression d'un utilisateurs
if(!empty($_POST["supprimer"])){

    supUserBA($_POST["supprimer"]);

    if(empty($_GET["filtre"]) && empty($_GET["pages"])){
        $url4 = "..:admin/listeUtilisateurs.php";
    } else if(empty($_GET["filtre"]) && !empty($_GET["pages"])){
        $url4 = "..:admin/listeUtilisateurs.php?pages=" . $_GET["pages"];
    } else if(!empty($_GET["filtre"]) && empty($_GET["pages"])) {
        $url4 = "..:admin/listeUtilisateurs.php?filtre=" . $_GET["filtre"];
    } else if (!empty($_GET["filtre"]) && !empty($_GET["pages"])){
        $url4 = "..:admin/listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&pages=" . $_GET["pages"];
    }

    ?>
    <script>
        window.location.href="<?=$url4;?>";
    </script>
    <?php

}