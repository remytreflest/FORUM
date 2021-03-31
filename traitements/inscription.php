<?php
require_once "traitement.php";

$erreurs = [];
$erreursMdp = [];

if(!empty($_POST["identifiant"]) && 
    !empty($_POST["mdp"]) && 
    !empty($_POST["mdpVerif"]) &&  
    !empty($_POST["age"])
){
    $identifiant = recupInscription($_POST["identifiant"]);
    if(count($identifiant) > 0){
        $erreurs[] = 0;
    }

    $checkMdp = check_mdp_format($_POST["mdp"]);
    if(count($checkMdp) > 0){
        foreach($checkMdp as $erreur){
            $erreursMdp[] = $erreur;
        }
    }

    if($_POST["mdp"] !== $_POST["mdpVerif"]){
        $erreurs[] = 1;
    }

    $_POST["age"] = intval($_POST["age"]);
    if($_POST["age"] > 120 || $_POST["age"] < 1){
        $erreurs[] = 2;
    }

    $newName = $_POST["identifiant"];
        $target_dir = "avatars/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . $newName . "." . "png";

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if($check == false) {
            $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            $erreurs[] = 9;
            $uploadOk = 0;
        }

        if ($_FILES["avatar"]["size"] > 500000) {
            $erreurs[] = 10;
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $erreurs[] = 11;
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            //rip
        }
        else{
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $uploadOk = 1;
            }else {
                $uploadOk = 0;
            }
        }
}else {
    $erreurs[] = 3;
}

if(count($erreurs) === 0 && count($erreursMdp) === 0){

    try {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        inscription($_POST["identifiant"], $mdp, $_POST["age"]);
        header("location:../user/");
    }catch(Exception $e){
        header("location:../user/index.php?error");
    }
}else{
    $href = "../user/inscription.php?err=yes&nb=";
    $erreurs = array_merge($erreurs, $erreursMdp);
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}