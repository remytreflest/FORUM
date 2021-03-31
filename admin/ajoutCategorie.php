<?php
require_once "headerAdmin.php";

if(isset($_GET["success"])){
    ?>
    <div class="alert alert-success">
        La catégorie a bien été créé !
    </div>
    <?php
}elseif(isset($_GET["error"])){
    ?>
    <div class="alert alert-warning">
        La catégorie n'a pas été créé !
    </div>
    <?php
}
?>
<div class="container">
    <h1>Créer une catégorie</h1>
    <form method = "post" action="../traitements/categories.php">
        <div class="form-group">
            <label for="titre">Titre de la catégorie :</label>
            <input type="text" class ="form-control" name="titre" id="titre" placeholder="Saisissez un titre !">
        </div>
        <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Créer la catégorie</button>
        </div>
    </form>
</div>

<?php
require_once "footerAdmin.php";