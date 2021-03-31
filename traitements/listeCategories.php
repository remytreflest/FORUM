<?php
require_once "traitement.php";
$limit = 10;
$nbCategories = nbCategorie();
$nbPages = round($nbCategories["nbCategorie"] / $limit);

if(!empty($_POST["titreCat"]) && !empty($_POST["contenu"]) && !empty($_POST["validate"])){

    modifCategorieAdmin($_POST["titreCat"], $_POST["contenu"], $_POST["validate"]);

    ?>
    <script>
        window.location.href="../admin/listeCategories.php";
    </script>
    <?php

} else if(isset($_POST["validate"])) {
    ?>
    <script>
        window.location.href="../admin/listeCategories.php?error";
    </script>
    <?php
}


if(!empty($_POST["supprimer"])){
    supCategorieAdmin($_POST["supprimer"]);
    ?>
    <script>
        window.location.href="../admin/listeCategories.php";
    </script>
    <?php
}




if(!empty($_GET["pages"])){
    $infos = infosCategorieAdmin();
} else {
    $infos = infosCategorieAdminSL($limit);
}


if($nbPages == 1  && $nbCategories > $limit || $nbPages == 0){
    $nbPages++;
}

?>