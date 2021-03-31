<?php
require_once "traitement.php";


if(!empty($_POST["titre"]) && !empty($_POST["contenu"]) && !empty($_POST["nomCategorie"])){
    try{
        ajouterSujets($_POST["nomCategorie"], $_POST["titre"], $_POST["contenu"], $_SESSION["idUser"]);
        header("location:../user/ajoutSujet.php?success");
    }catch(exception $e){
        header("location:../user/ajoutSujet.php?error");
    }
}else{
    if(isset($_POST["submit"])){
        $erreurs = check_remplissage($_POST["titre"], $_POST["contenu"], $_POST["nomCategorie"]);
        if(count($erreurs) > 0){
            $href = "../user/ajoutSujet.php?err=yes&";
            foreach($erreurs as $erreur){
                $href .= $erreur . "&";
            }
            $href = substr($href, 0, -1);
        }
    
        header("location:" . $href);
    }
}