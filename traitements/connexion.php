<?php
require_once "traitement.php";
$erreurs = [];

if(empty($_POST["identifiant"]) || empty($_POST["mdp"])){
    $erreurs[] = 0;
}

if(count($erreurs) == 0){
    $utilisateur = verifConnexion($_POST["identifiant"]);
    if(count($utilisateur) > 0){
        if(!password_verify($_POST["mdp"], $utilisateur["mdp"])){
            $erreurs[] = 1;
        }
    }else {
        $erreurs[] = 2;
    }
}

if(count($erreurs) == 0){
    $_SESSION["idUser"] = $utilisateur["idUser"];
    $_SESSION["identifiant"] = $utilisateur["identifiant"];
    $_SESSION["Role"] = $utilisateur["idRole"];
    $_SESSION["age"] = $utilisateur["age"];
    
    if($_SESSION["Role"] == 1){
        header("refresh:0;../user/");
    }else {
        header("refresh:0;../admin/indexAdmin.php");
    }
}else {
    $href = "../user/connexion.php?err=yes&";
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}