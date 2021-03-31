<?php
require_once "header.php";
$createurs = recupCreateurs($_GET["idSujet"]);
$reponses = recupReponses($_GET["idSujet"]);
$problematiques = recupProblem($_GET["idSujet"]);

$img = "../avatars/";

if(isset($_GET["error"])){
    ?>
    <div class="alert alert-danger">
        Une erreur s'est produite lors de la modification du message
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
                    <h5 class="card-title" style = "<?php if($createur["idRole"] == 2){echo "color: red";}elseif($createur["idModerateur"] != NULL && $createur["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $createur["identifiant"] ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-body pb-0">
                <?php
                    if($_GET["idReponse"] == "NULL"){
                        ?>
                        <form method="post" action="../traitements/modifReponse.php?idSujet=<?= $_GET["idSujet"] ?>&idReponse=<?= $createur["idReponse"] ?>">
                            <textarea id="border" name="newDev"><?= $createur["contenu"] ?></textarea>
                            <p class="pb-0 mt-3 pt-4 pr-1 text-right">
                                <button type="submit" class="btn btn-primary" name="submitbis" value=1>Modifier</button>
                                <a href="../user/reponse.php?idSujet=<?= $_GET["idSujet"] ?>" class="btn btn-dark">Retour</a>
                            </p>
                        </form>
                        <?php
                    }else{
                        ?>
                        <p class="card-text pt-2 mb-0"><?= $createur["contenu"] ?></p>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
}
foreach($reponses as $reponse){
    ?>
    <div class="d-flex justify-content-center mt-4">
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
                <h5 class="card-title" style = "<?php if($reponse["idRole"] == 2){echo "color: red";}elseif($reponse["idModerateur"] != NULL && $reponse["idCategorie"] == $_GET["idCategorie"]){echo "color: blue";}?>"><?= $reponse["identifiant"] ?></h5>
                    <figcaption class="blockquote-footer"><?= $reponse["dateReponse"] ?></figcaption>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center d-flex justify-content-center">
        <div class="card" style="width: 50rem; min-height: 5rem">
            <div class="card-body pb-0">
                <?php
                    if($reponse["idReponse"] == $_GET["idReponse"]){
                        $idReponse = $reponse["idReponse"];
                        ?>
                        <form method="post" action="../traitements/modifReponse.php?idSujet=<?= $_GET["idSujet"] ?>&idReponse=<?= $reponse["idReponse"] ?>">
                            <textarea id="border" name="newContenu"><?= $reponse["contenu"] ?></textarea>
                            <p class="pb-0 mt-4 pt-4 pr-1 text-right">
                                <button type="submit" class="btn btn-primary" name="submit" value=1>Modifier</button>
                                <a href="../user/reponse.php?idSujet=<?= $_GET["idSujet"] ?>" class="btn btn-dark">Retour</a>
                            </p>
                        </form>
                        <?php
                    }else{
                        ?>
                        <p class="card-text pt-2 mb-0"><?= $reponse["contenu"] ?></p>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
}
require_once "footer.php";
?>