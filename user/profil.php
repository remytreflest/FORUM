<?php
require_once "../traitements/traitement.php";
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
                <div class="row container d-flex justify-content-center">
                    <div class="col-xl-6 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-15"> 
                                            <img src="../avatars/<?=$_SESSION["identifiant"] ?>.png" class="img-radius">
                                        </div>
                                        <a href="modifProfil.php?modif=4" style = "color: white"><i class="fas fa-edit mb-5"></i></a>
                                        <h6 class="f-w-800 mb-2"><?=$_SESSION["identifiant"]?></h6>
                                        <a href="modifProfil.php?modif=1" style = "color: white"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personelles :</h6>
                                        <div class="text-center">
                                            <div>
                                                <div>
                                                    <p class="m-b-10 f-w-600">Mot-de-passe :</p>
                                                    <h6 class="text-muted f-w-400">Ne donnez jamais votre mdp !</h6>
                                                    <!-- str_repeat("?,", count($tabIds) -->
                                                </div>
                                                <div class="mt-3">
                                                    <a href="modifProfil.php?modif=2" style = "color: black"><i class="fas fa-edit"></i></a>
                                                </div>
                                            </div>
                                                <div class="mt-5">
                                                    <p class="m-b-10 f-w-600">Âge :</p>
                                                    <h6 class="text-muted f-w-400"><?=$_SESSION["age"]?> ans</h6>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="modifProfil.php?modif=3" style = "color: black"><i class="fas fa-edit"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <?php
            $url = "http://localhost/Exo/Tp%202%20-%20Forum%20-%20MVC/user/modifProfil.php?modif=";
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != $url."1" && $_SERVER['HTTP_REFERER'] != $url."2" && $_SERVER['HTTP_REFERER'] != $url."3" && $_SERVER['HTTP_REFERER'] != $url."4"){
                ?>
                <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class = "btn btn-dark">Retour</a>
                <?php
            }else{
                ?>
                <a href="../index.php" class = "btn btn-dark">Retour</a>
                <?php
            }
            ?>
        </div>