<?php
require_once "header.php";

if(!empty($_GET["idCategorie"])){
  $informations = reqTropLongue2($_GET["idCategorie"]);
  $nomCategorie = recupSujet($informations);
}

?>
<div class="card-header mb-3 text-center">
  <h3><?=$nomCategorie["titreCat"];?></h3>
</div>

<?php
foreach($informations as $information){

  ?>
  <a href="reponse.php?idSujet=<?= $information["idSujet"] ?>&idCategorie=<?=$_GET["idCategorie"]?>" id="lien-sujets" class="card mb-3">
    <div class="row g-0">
    <div class="col-lg-3 d-flex align-items-center justify-content-center images-categories"  style="background-image: url('../<?=$information["image"];?>')">
      </div>
      <div class="col-md-7 col-lg-4 d-flex align-items-center">
        <div class="card-body">
          <h5 class="card-title"><?=$information["titreSujet"];?></h5>
          <p class="card-text"><?=$information["contenuSujet"];?></p>
        </div>
      </div>
      <div class="col-md-5 d-flex align-items-center">
        <div class="card-body d-flex flex-column">
          <div class="row d-flex align-items-start justify-content-md-center">
              <div class="col-6 col-sm-6 col-md-12 col-lg-4">
                  <h6>Réponses</h6>
                  <div><?=$information["nbDeRemponses"];?></div>
              </div>
              <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block d-lg-none">
              <div class="col-6 col-sm-6 col-md-12 col-lg-4">
                  <h6>Utilisateurs</h6>
                  <div><?=$information["nbUsers"];?></div>
              </div>
              <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block d-lg-none">
              <div class="col-4 col-md-12 col-lg-4 d-none d-md-block">
                  <h6>Activité</h6>
                  <div><?=$information["MAX(r.dateReponse)"];?></div>
              </div>
          </div>
          <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block my-lg-3">
          <div class="d-none d-md-block">
              <h6 class="card-title">Dernière réponse</h6>
              <div><?=coupePhrase($information["contenu"], 120);?></div>
          </div>
        </div>
      </div>
    </div>
  </a>
  <?php
}

require_once "../traitements/footer.php";
?>