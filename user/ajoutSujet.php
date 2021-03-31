<?php
require_once "header.php";
$categories = recupAjoutSujet();
if(!empty($_GET["success"])){
    ?>
    <div class="alert alert-success">
        Le sujet a bien été créé !
    </div>
    <?php
}elseif(!empty($_GET["error"])){
    ?>
    <div class="alert alert-warning">
        Le sujet n'a pas été créé !
    </div>
    <?php
}

$messagesErreurs = ["Il faut remplir un titre", "Il faut remplir un contenu", "Il faut choisir une catégorie", "Au moins un champ n'a pas été saisi"];

if(!empty($_GET["err"])){
    for($i = 0; $i < count($messagesErreurs); $i++){
        if(isset($_GET[$i])){
            $erreurs[] = $messagesErreurs[$i];
        }
    }
    ?>
    <div class="alert alert-warning">
        <?php
        foreach($erreurs as $erreur){
            echo $erreur . "</br>";
        }
        ?>
    </div>
    <?php
}

if(isset($_GET["error"])){
    ?>
    <div class="alert alert-danger">
        Une erreur s'est produite lors de la création du sujet
    </div>
    <?php
}

if(!empty($_SESSION["idUser"])){
    ?>
    <div class="container">
        <h1>Créer un sujet</h1>
        <form method = "post" action="../traitements/ajoutSujet.php">
            <div class="form-group">
                <label for="titre">Votre problème :</label>
                <input type="text" class ="form-control" name="titre" id="titre" placeholder="Saisissez un titre !" value="<?=(!empty($_POST['titre']) ? $_POST['titre'] : "")?>">
            </div>
            <div class="form-group">
                <label for="contenu">Précision :</label><br>
                <textarea class="form-control" name="contenu" id="contenu" cols="100" rows="5" style ="resize: none" placeholder="Saisissez son contenu !" value="<?=(!empty($_POST['contenu']) ? $_POST['contenu'] : "")?>"></textarea>
            </div>
            <p>
                A quel catégorie appartient-il ?<br>
                <div class="input-group">
                    <select id="categorie" name="nomCategorie" class = "custom-select" value="<?=(!empty($_POST['nomCategorie']) ? $_POST['nomCategorie'] : "");?>">
                        <option <?=isset($_GET["idCategorie"]) ? "" : "selected";?> disabled>Liste des catégories...</option>
                        <?php
                        foreach($categories as $categorie){
                            ?>
                            <option value="<?=$categorie["titreCat"];?>"<?php
                            if((!empty($_GET["idCategorie"]) && $_GET["idCategorie"] == $categorie["idCategorie"])){
                                echo ' selected';
                            }
                            if((!empty($_POST['nomCategorie']) && $_POST['nomCategorie'] == $categorie["titreCat"])){
                                echo ' selected';
                            }
                            ;?>><?=$categorie["titreCat"] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </p>
            <div class="form-group text-center">
            <button name="submit" value="1" type="submit" class="btn btn-primary">Créer le sujet</button>
            </div>
        </form>
    </div>
    <?php
}else{
    ?>
    <p class="text-muted text-center h1 my-4">Il faut être connecté pour pouvoir créer un sujet :(</p>
    <?php
}