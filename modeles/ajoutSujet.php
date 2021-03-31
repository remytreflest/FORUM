<?php
function recupAjoutSujet(){
    $requete = getBdd()->prepare("SELECT idCategorie, titreCat FROM categories");
    $requete->execute();
    $categories = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $categories;
}

function ajouterSujets($NomCategorie, $titre, $contenu, $idUser){
    $requete = getBdd()->prepare("SELECT idCategorie from categories where titreCat = ?");
    $requete->execute([$NomCategorie]);
    $idCat = $requete->Fetch(PDO::FETCH_ASSOC);
    
    $requete = getBdd() ->prepare("INSERT INTO sujets(titreSujet, contenu, idCategorie, idUser, dateCreation) values(?, ?, ?, ?, NOW())");
    $requete ->execute([$titre, $contenu, $idCat["idCategorie"], $idUser]);
}

function check_remplissage($titre, $contenu, $NomCategorie){

    $erreurs = [];

    if(empty($_POST["titre"])){
        $erreurs[] = 1;
    }
    if(empty($_POST["contenu"])){
        $erreurs[] = 2;
    }
    if(empty($_POST["NomCategorie"])){
        $erreurs[] = 3;
    }

    return $erreurs;
}