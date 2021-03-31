<?php
require_once "header.php";

$messagesErreurs = ["L'un des champs est vide", "Le mot de passe saisi est incorrect", "L'identifiant n'existe pas"];

if(!empty($_GET["err"])){
    ?>
    <div class="alert alert-warning">
        <?php
        for($i = 0; $i < count($messagesErreurs); $i++){
            if(isset($_GET[$i])){
                echo $messagesErreurs[$i];
            }
        }
        ?>
    </div>
    <?php
}

?>
<h1>Formulaire de connexion</h1>
<form method="POST" action="../traitements/connexion.php">

    <div class="form-group">
            <label for="identifiant">Identifiant : </label>
            <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant" value="<?=(isset($_POST['identifiant']) ? $_POST['identifiant'] : "")?>" >
    </div>

    <div class="form-group">
            <label for="mdp">Mot de passe : </label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Entrez votre mot de passe" value="<?=(isset($_POST['mdp']) ? $_POST['mdp'] : "")?>" >
    </div>

    <div class="form-group text-center btn-group d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" name="submit" value="ON">Connexion</button>
        <a href="index.php" class="btn btn-warning">Retour</a>
    </div>

</form>

<?php
require_once "../traitements/footer.php";
?>