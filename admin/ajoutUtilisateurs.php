<?php
require_once "headerAdmin.php";

$erreurs = ["L'id Rôle doit être de 1 pour un membre et de 2 pour un admin.", "L'identifiant saisi existe déjà", "Les deux mots de passe ne sont pas identiques", "L'âge doit être compris entre 0 et 120 ans", "Au moins un des champs n'a pas été saisi", "Votre fichier n'est pas une image", "L'image existe déjà", "L'image est trop large (> 500ko)", "Seulement les fichiers de types JPG, JPEG, PNG sont autorisés", "Désolé, votre fichier n'a pas été téléchargé...", "Une erreur s'est produite lors du téléchargement de votre fichier"];

if(!empty($_GET["err"])){
    ?>
    <div class="alert alert-warning">
        <?php
        $tableau = preg_split("#[,]#", $_GET["nb"]);
        for($i = 0; $i < count($erreurs); $i++){
            if(isset($tableau[$i])){
                echo $erreurs[$tableau[$i]] . "<br>";
            }
        }
        ?>
    </div>
    <?php
}

if(isset($_GET["error"])){
    ?>
    <div class="alert alert-warning">
        L'utilisateur n'a pas pu être créé !
    </div>
    <?php
}

?>
<div class="container">
    <h1>Ajout utilisateur :</h1>
    <form method="POST" action="../traitements/ajoutUtilisateurs.php" enctype="multipart/form-data">

        <div class="form-group">
                <label for="identifiant">Identifiant : </label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant" value="<?=(isset($_POST['identifiant']) ? $_POST['identifiant'] : "")?>" required>
        </div>

        <div class="form-group">
                <label for="mdp">Mot de passe : </label>
                <input type="password" class="form-control" name="mdp" id="mpd" placeholder="Entrez votre mot de passe" value="<?=(isset($_POST['mdp']) ? $_POST['mdp'] : "")?>" required>
        </div>

        <div class="form-group">
                <label for="mdpVerif">Vérification du mot de passe : </label>
                <input type="password" class="form-control" name="mdpVerif" id="mdpVerif" placeholder="Vérifier votre mot de passe" value="<?=(isset($_POST['mdpVerif']) ? $_POST['mdpVerif'] : "")?>" required>
        </div>

        <div class="form-group">
                <label for="age">Âge : </label>
                <input type="number" class="form-control" name="age" id="age" placeholder="Votre âge" min="0" max="120" value="<?=(isset($_POST['age']) ? $_POST['age'] : "")?>">
        </div>

        <div class="form-group">
            <label for="idRole">Rôle : </label>
            <select name="idRole" class="form-control">
                    <option value="1">Utilisateur</option>
                    <option value="2">Admin</option>
            </select>
        </div>

        <!-- <form enctype="multipart/form-data" method="post"> -->
            <label>Choisissez votre avatar : </label><br>
            <input type="file" name="avatar"><br>
        <!-- </form> -->

        <div class="form-group text-center btn-group d-flex justify-content-center my-3">
            <button type="submit" class="btn btn-primary" name="submit" value="ON">Créer</button>
        </div>

    </form>
</div>
<?php
    

require_once "footerAdmin.php";