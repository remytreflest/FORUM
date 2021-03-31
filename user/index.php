<?php
require_once "header.php";
$informations = reqTropLongue();
?>

<?php
foreach($informations as $information){
  ?>
  <a href="sujets.php?idCategorie=<?=$information["idCategorie"];?>" id="lien-categories" class="card mb-3">
    <div class="row g-0">
      <div class="col-lg-3 d-flex align-items-center justify-content-center images-categories" style="background-image: url('../<?=$information["image"];?>')">
      </div>
      <div class="col-md-7 col-lg-4 d-flex align-items-center">
        <div class="card-body">
          <h5 class="card-title"><?=$information["titreCat"];?></h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
      <div class="col-md-5 d-flex align-items-center">
        <div class="card-body d-flex flex-column">
          <div class="row d-flex align-items-start justify-content-md-center">
              <div class="col-6 col-sm-6 col-md-12 col-lg-4">
                  <h6>Sujets</h6>
                  <div><?=$information["COUNT(s.idSujet)"];?></div>
              </div>
              <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block d-lg-none">
              <div class="col-6 col-sm-6 col-md-12 col-lg-4">
                  <h6>Utilisateurs</h6>
                  <div><?=$information["COUNT(DISTINCT r.idUser)"];?></div>
              </div>
              <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block d-lg-none">
              <div class="col-4 col-md-12 col-lg-4 d-none d-md-block">
                  <h6>Activité</h6>
                  <div><?=$information["MAX(r.dateReponse)"];?></div>
              </div>
          </div>
          <hr class="dropdown-divider col-8 col-md-8 align-self-center d-none d-md-block my-lg-3">
          <div class="d-none d-md-block">
              <h6 class="card-title">Dernier sujet</h6>
              <div><?=$information["titreSujet"];?></div>
          </div>
        </div>
      </div>
    </div>
  </a>
  <?php
}

require_once "../traitements/footer.php";
?>