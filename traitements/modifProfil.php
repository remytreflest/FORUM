<?php
require_once "traitement.php";

if($_GET["modif"] == 1){
    $req = recupIdentifiant($_POST["identifiant"]);
    if($req->rowCount() > 0){
        header("location:../user/modifProfil.php?modif=1&exist=true");
    }elseif(empty($_POST["identifiant"])){
        header("location:../user/profil.php");
    }else{
        $req = modifIdentifiant($_POST["identifiant"], $_SESSION["idUser"]);
        rename("../avatars/".$_SESSION["identifiant"].".png", "../avatars/".$_POST["identifiant"].".png");
        $_SESSION["identifiant"] = $_POST["identifiant"];
    }
}elseif($_GET["modif"] == 2){
    if(!empty($_POST["newMdp"])){
        $userMdp = recupMdp($_SESSION["idUser"]);
        if(password_verify($_POST["oldMdp"], $userMdp["mdp"])){
            $_POST["newMdp"] = password_hash($_POST["newMdp"], PASSWORD_BCRYPT);
            modifMdp($_POST["newMdp"], $_SESSION["idUser"]);
            header("location:../user/profil.php");
        }
    }else{
        header("location:../user/profil.php");
    }

}elseif($_GET["modif"] == 3){
    if(!empty($_POST["age"])){
        modifAge($_POST["age"], $_SESSION["idUser"]);
        $_SESSION["age"] = $_POST["age"];
        header("location:../user/profil.php");
    }else{
        header("location:../user/profil.php");
    }
    
}elseif($_GET["modif"] == 4){
    $newName = $_SESSION["identifiant"];
    $target_dir = "../avatars/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION));
    $target_file = $target_dir . $newName . "." . "png";
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);

    if($check == false) {
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        unlink($target_dir . $newName . "." . "png");
    }
    
    if ($_FILES["avatar"]["size"] > 500000) {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        
    }else{
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            header("location:../user/profil.php");
        }else {
        //Rip
        }
    } 
}