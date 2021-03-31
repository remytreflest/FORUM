<?php
require_once "../traitements/traitement.php";

if(!empty($_GET["exist"])){
    ?>
    <div class="alert alert-danger">
        Ce pseudo existe déjà !
    </div>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/styleProfil.css">
  <script src="https://kit.fontawesome.com/f3f16a7b72.js" crossorigin="anonymous"></script>
  <title>Profil</title>
</head>
    <body>
    <div class="container mt-5">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <?php
                                    if($_GET["modif"] == 4){
                                        ?>
                                        <div class="m-b-25">
                                            <form method="post" action="../traitements/modifProfil.php?modif=<?=$_GET["modif"]?>" enctype="multipart/form-data">
                                                <div>
                                                    <img src="../avatars/<?=$_SESSION["identifiant"] ?>.png" class="img-radius">
                                                    <i class="far fa-file-image fa-lg" style="position: absolute; top:85px; right:75px"></i>
                                                </div>
                                                <p>Changer l'avatar</p>
                                                <input class="fileInput-23-d-3" type="file" tabindex="0" multiple="" accept=".jpg,.jpeg,.png" aria-label="Changer l'avatar" style="position: absolute; top: 13%; left: 22%; width: 56%; height: 32%; opacity: 0; cursor: pointer;" name ="avatar">
                                                <button value="1" type="submit" name="submit" style="border:none; background-color:transparent"><i class="fas fa-clipboard-check mb-3" style="color: white"></i></button>
                                            </form>
                                        </div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="m-b-25"> 
                                            <img src="../avatars/<?=$_SESSION["identifiant"] ?>.png" class="img-radius">
                                        </div>
                                        <?php
                                    }
                                    if($_GET["modif"] == 1){
                                        ?>
                                        <form method="post" action="../traitements/modifProfil.php?modif=<?=$_GET["modif"]?>" enctype="multipart/form-data">
                                            <input type="text" name="identifiant" class="f-w-600 form-control mb-2" placeholder="<?=$_SESSION["identifiant"]?>">
                                            <br>
                                            <button value="1" type="submit" name="submit" style="border:none; background-color:transparent"><i class="fas fa-clipboard-check" style="color: white"></i></button>
                                        </form>
                                        <?php
                                    }else{
                                        ?>
                                        <h6 class="f-w-800 mb-2"><?=$_SESSION["identifiant"]?></h6>
                                        <a href="modifProfil.php?modif=1" style = "color: white"><i class="fas fa-edit"></i></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personelles :</h6>
                                    <div class="text-center">
                                    <?php
                                    if($_GET["modif"] == 2){
                                        ?>
                                        <form method="post" action="../traitements/modifProfil.php?modif=<?=$_GET["modif"]?>">
                                            <div>
                                                <div>
                                                    <p class="m-b-10 f-w-600">Ancien mot-de-passe :</p>
                                                    <input type="password" name="oldMdp" class="text-muted f-w-400 form-control" placeholder="Ancien mdp">
                                                </div>
                                            </div>
                                            <div class ="mt-3">
                                                <div>
                                                    <p class="m-b-10 f-w-600">Nouveau mot-de-passe :</p>
                                                    <input type="password" name="newMdp" class="text-muted f-w-400 form-control" placeholder="New mdp">
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                            <button value="1" type="submit" name="submit" style="border:none; background-color:transparent"><i class="fas fa-clipboard-check"></i></button>
                                            </div>
                                        </form>
                                        <?php
                                    }else{
                                        ?>
                                        <div>
                                            <div>
                                                <p class="m-b-10 f-w-600">Mot-de-passe :</p>
                                                <h6 class="text-muted f-w-400">Ne donnez jamais votre mdp !</h6>
                                                <!-- str_repeat("?,", count($tabIds) -->
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="modifProfil.php?modif=2" style = "color: black"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <?php
                                        if($_GET["modif"] == 3){
                                            ?>
                                            <div>
                                                <div class="mt-5">
                                                <form method="post" action="../traitements/modifProfil.php?modif=<?=$_GET["modif"]?>">
                                                    <p class="m-b-10 f-w-600">Âge :</p>
                                                    <input type="text" name="age" class="text-muted f-w-400 form-control" placeholder="<?=$_SESSION["age"]?>">
                                                    <div class="mt-3">
                                                        <button value="1" type="submit" name="submit" style="border:none; background-color:transparent"><i class="fas fa-clipboard-check"></i></button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                            <div>
                                                <div class="mt-5">
                                                    <p class="m-b-10 f-w-600">Âge :</p>
                                                    <h6 class="text-muted f-w-400"><?=$_SESSION["age"]?> ans</h6>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="modifProfil.php?modif=3" style = "color: black"><i class="fas fa-edit"></i></a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>