<?php
require_once "../modeles/affichageProfil.php";
$role = role($_SESSION["idUser"]);
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style ="height: 50vh; width: 80vh">
    <div class="modal-content" style="background-color: transparent">
      <div class="modal-body p-0">
        <div class="page-content page-container" id="page-content">
            <div class="row container d-flex justify-content-center p-0 mx-0">
                <div class="col-xl-12 col-md-12 px-0" style="height:100%; width:100%;">
                    <div class="card user-card-full mb-0">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> 
                                        <img src="../avatars/<?=$_SESSION["identifiant"] ?>.png" class="img-radius">
                                    </div>
                                    <h6 class="f-w-800 mb-5 mt-5"><?=$_SESSION["identifiant"]?></h6>
                                </div>
                            </div>
                            <div class="col-sm-8">
                            <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personelles :</h6>
                                    <div class="text-center">
                                        <div>
                                            <div>
                                                <p class="m-b-10 f-w-600">Rang :</p>
                                                <h6 class="text-muted f-w-400"><?php
                                                    if($_SESSION["Role"] == 1 && $role["idModerateur"] == Null){
                                                        echo "Vous êtes utilisateur";
                                                    }elseif($_SESSION["Role"] == 1 && $role["idModerateur"] !== Null){
                                                        echo "Vous êtes modérateur de la catégorie ".$role["titreCat"];
                                                    }elseif($_SESSION["Role"] == 2){
                                                        echo "Vous êtes administrateur";
                                                    }
                                                    
                                                ?></h6>
                                            </div>
                                        </div>
                                            <div class="mt-5">
                                                <p class="m-b-10 f-w-600">Âge :</p>
                                                <h6 class="text-muted f-w-400"><?=$_SESSION["age"]?> ans</h6>
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
    </div>
    </div>
  </div>
</div>