<?php
require_once "traitement.php";

$erreurs = [];
$erreursMdp = [];

if(!empty($_POST["identifiant"]) && 
   !empty($_POST["mdp"]) && 
   !empty($_POST["mdpVerif"]) &&  
   !empty($_POST["age"]) &&
   !empty($_POST["idRole"])
){

    if($_POST["idRole"] != 1 && $_POST["idRole"] != 2){
        $erreurs[] = 0;
    }

    $requete = recupIdentifiantAdmin($_POST["identifiant"]);
    if($requete->rowCount() > 0){
        $erreurs[] = 1;
    }

    if($_POST["mdp"] !== $_POST["mdpVerif"]){
        $erreurs[] = 2;
    }

    $_POST["age"] = intval($_POST["age"]);
    if($_POST["age"] > 120 || $_POST["age"] < 1){
        $erreurs[] = 3;
    }

} else {
    $erreurs[] = 4;
}

if(count($erreurs) === 0){

    $newName = $_POST["identifiant"];
    $target_dir = "../avatars/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION));
    $target_file = $target_dir . $newName . "." . "png";
    
    if(isset($_POST["avatar"])) {
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check == false) {
        $erreurs[] = 5;
        $uploadOk = 0;
        }
    
        if (file_exists($target_file)) {
            $erreurs[] = 6;
            $uploadOk = 0;
        }
        
        if ($_FILES["avatar"]["size"] > 500000) {
            $erreurs[] = 7;
            $uploadOk = 0;
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $erreurs[] = 8;
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            $erreurs[] = 9;
        }
        else{
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $uploadOk = 0;
            }else {
            $erreurs[] = 10;
            }
        }
    }
    extract($_POST);
    try {
        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        ajoutUserAdmin($identifiant, $mdp, $age);

    }catch(Exception $e){
        header("location:../admin/ajoutUtilisateurs.php?error");
    }
    unset($_POST["submit"]);
    ?>
    <script>
        window.location.href="ajoutUtilisateurs.php";
    </script>
    <?php
}else{
    $href = "../admin/ajoutUtilisateurs.php?err=yes&nb=";
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}