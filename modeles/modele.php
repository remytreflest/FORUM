<?php

function getBdd() {
    return new PDO('mysql:host=localhost;dbname=forum;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}



require_once "../modeles/categories.php";
require_once "../modeles/sujets.php";
require_once "../modeles/connexion.php";
require_once "../modeles/supReponse.php";
require_once "../modeles/index.php";
require_once "../modeles/ajoutSujet.php";
require_once "../modeles/inscription.php";
require_once "../modeles/reponse.php";
require_once "../modeles/modifReponse.php";
require_once "../modeles/affichageProfil.php";
require_once "../modeles/modifProfil.php";
require_once "../modeles/indexAdmin.php";
require_once "../modeles/headerAdmin.php";
require_once "../modeles/ajoutUtilisateurs.php";
require_once "../modeles/listeCategories.php";
require_once "../modeles/listeSujets.php";
require_once "../modeles/listeUtilisateurs.php";