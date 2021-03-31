<?php
require_once "header.php";
require_once "affichageProfil.php";

$createurs = createurs($_GET["idSujet"]);
$reponses = reponses($_GET["idSujet"]);
$problematiques = problematiques($_GET["idSujet"]);
$img = "../avatars/";

if(isset($_GET["error"])){
    ?>
    <div class="alert alert-danger">
        Une erreur s'est produite lors de l'envoie de la réponse
    </div>
    <?php
}

foreach($problematiques as $problematique){
    ?>
    <h1 class="text-center" id="test"><?= $problematique["titreSujet"] ?></h5>
    <?php
}
foreach($createurs as $createur){
    ?>
    <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-header d-flex align-items-center">
                <?php
                if(!file_exists($img.$createur["identifiant"].".png")){
                    ?>
                    <img src="../avatars/User.png" class="card-img-left rounded" style="width: 4rem; height: 4rem">
                    <?php
                }else{
                    ?>
                    <img src="../avatars/<?= $createur["identifiant"] ?>.png" class="card-img-left rounded" style="width: 4rem; height: 4rem">
                    <?php
                }
                ?>
                <div class="card-body pt-1 card-info">
                    <?php
                    if(!empty($_SESSION["identifiant"])){
                        if($_SESSION["identifiant"] == $createur["identifiant"]){
                            ?>
                            <button style="background-color: transparent; border: none" data-bs-toggle="modal" data-bs-target="#exampleModal" id="essai">
                                <h5 class="card-title" style = "<?php if($createur["idRole"] == 2){echo "color: red";}elseif($createur["idModerateur"] != NULL && $createur["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $createur["identifiant"] ?></h5>
                            </button>
                            <figcaption class="blockquote-footer"><?= dateToFrench($createur["dateCreation"], "l j F Y G:i:s") ?></figcaption>
                            <?php
                        }else{
                            ?>
                            <h5 class="card-title" style = "<?php if($createur["idRole"] == 2){echo "color: red";}elseif($createur["idModerateur"] != NULL && $createur["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $createur["identifiant"] ?></h5>
                            <figcaption class="blockquote-footer"><?= dateToFrench($createur["dateCreation"], "l j F Y G:i:s") ?></figcaption>
                            <?php
                        }
                    }else{
                        ?>
                        <h5 class="card-title" style = "<?php if($createur["idRole"] == 2){echo "color: red";}elseif($createur["idModerateur"] != NULL){echo "color: blue";}?>"><?= $createur["identifiant"] ?></h5>
                        <figcaption class="blockquote-footer"><?= dateToFrench($createur["dateCreation"], "l j F Y G:i:s") ?></figcaption>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-body pb-0">
                <p class="card-text pt-2 mb-3"><?= $createur["contenu"] ?></p>
            </div>
            <?php
            if(!empty($_SESSION["identifiant"])){
                if($createur["identifiant"] == $_SESSION["identifiant"]){
                    ?>
                        <p class="mb-0 pb-0 mt-4 pt-4 pr-1 text-right"><a href="modifReponse.php?idSujet=<?= $_GET["idSujet"] ?>&idReponse=NULL">Modifier</a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
}
foreach($reponses as $reponse){
    ?>
    <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-header d-flex align-items-center">
                <?php
                if(!file_exists($img.$reponse["identifiant"].".png")){
                    ?>
                    <img src="../avatars/User.png" class="card-img-left rounded" style="width: 4rem; height: 4rem">
                    <?php
                }else{
                    ?>
                    <img src="../avatars/<?= $reponse["identifiant"] ?>.png" class="card-img-left rounded" style="width: 4rem; height: 4rem">
                    <?php
                }
                ?>
                <div class="card-body pt-1 card-info">
                    <?php
                    if(!empty($_SESSION["identifiant"])){
                        if($_SESSION["identifiant"] == $reponse["identifiant"]){
                            ?>
                            <button style="background-color: transparent; border: none" data-bs-toggle="modal" data-bs-target="#exampleModal" id="essai">
                            <h5 class="card-title" style = "<?php if($reponse["idRole"] == 2){echo "color: red";}elseif($reponse["idModerateur"] != NULL && $reponse["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $reponse["identifiant"] ?></h5>
                            </button>
                            <figcaption class="blockquote-footer"><?= dateToFrench($reponse["dateReponse"], "l j F Y G:i:s") ?></figcaption>
                            <?php
                        }else{
                            ?>
                            <h5 class="card-title" style = "<?php if($reponse["idRole"] == 2){echo "color: red";}elseif($reponse["idModerateur"] != NULL && $reponse["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $reponse["identifiant"] ?></h5>
                            <figcaption class="blockquote-footer"><?= dateToFrench($reponse["dateReponse"], "l j F Y G:i:s") ?></figcaption>
                            <?php
                        }
                    }else{
                        ?>
                        <h5 class="card-title" style = "<?php if($reponse["idRole"] == 2){echo "color: red";}elseif($reponse["idModerateur"] != NULL){echo "color: blue";}?>"><?= $reponse["identifiant"] ?></h5>
                        <figcaption class="blockquote-footer"><?= dateToFrench($reponse["dateReponse"], "l j F Y G:i:s") ?></figcaption>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-body pb-0">
                <p class="card-text pt-2 mb-3"><?= $reponse["contenu"] ?></p>
            </div>
            <?php
            if(!empty($_SESSION["identifiant"])){
                if($reponse["identifiant"] == $_SESSION["identifiant"]){
                    ?>
                        <p class="mb-0 pb-0 mt-4 pt-4 pr-1 text-right"><a href="modifReponse.php?idSujet=<?= $_GET["idSujet"] ?>&idCategorie=<?=$_GET["idCategorie"]?>&idReponse=<?=$reponse["idReponse"]?>">Modifier</a> / <a href="../traitements/supReponse.php?idSujet=<?= $_GET["idSujet"]?>&idReponse=<?=$reponse["idReponse"]?>">Supprimer</a></p>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
}
if(isset($_SESSION["identifiant"])){
    ?>
    <div class="text-center form-group d-flex justify-content-center">
        <button id="button" style="position: fixed; bottom: 10px; left:10px" onclick="myFunction()"><i class="fas fa-pencil-alt"></i></button>
        <div id="snackbar">
            <form method="post" action="../traitements/reponse.php?idSujet=<?= $_GET["idSujet"] ?>">
                <button type="button" class="rounded btn btn-primary" style="position: fixed; bottom: 80px; left:33px" onclick="myFunction2()"><i class="fas fa-times"></i></button>
                <button type="submit" class="rounded btn btn-primary" style="position: fixed; bottom: 25px; left:90px" name="submit" value=1><i class="fas fa-paper-plane"></i></button>
                <textarea id="testbis" name="message" class="form-control" rows="5" placeholder="Écrivez votre réponse"></textarea>
            </form>
        </div>
    </div>
    <?php
}
require_once "../traitements/footer.php";
?>