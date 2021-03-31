<?php
function infosSujetAdmin($limit, $GET){
    $requete = getBdd()->prepare("SELECT * FROM sujets LIMIT :limit OFFSET :offset");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':offset',$GET,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbSujets(){
    $requete = getBdd()->prepare("SELECT COUNT(idSujet) as nbSujets FROM sujets");
    $requete->execute();
    $nbSujets = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbSujets;
}

function infosSujetAdminSL($limit, $GETPages, $GETCategories){
    $requete = getBdd()->prepare("SELECT * FROM sujets WHERE idCategorie = :id LIMIT :limit OFFSET :offset");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':offset',$GETPages,PDO::PARAM_INT);
    $requete->bindValue(':id',$GETCategories,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbSujetsBC($categorie){
    $requete = getBdd()->prepare("SELECT COUNT(idSujet) as nbSujets FROM sujets WHERE idCategorie = ?");
    $requete->execute([$categorie]);
    $nbSujets = $requete->fetch(PDO::FETCH_ASSOC);
}

function infosSujetAdminAL($limit, $GETCategories){
    $requete = getBdd()->prepare("SELECT * FROM sujets WHERE idCategorie = :id LIMIT :limit");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':id',$GETCategories,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function infosSujetAdminASL($limit){
    $requete = getBdd()->prepare("SELECT * FROM sujets LIMIT :limit");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function titreCategorie(){
    $requete = getBdd()->prepare("SELECT idCategorie, titreCat FROM categories");
    $requete->execute();
    $titresCategories = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $titresCategories;
}

function modifSujetAdmin($titreSujet, $contenu, $idSujet){
    $requete = getBdd()->prepare("UPDATE sujets SET titreSujet = ?, contenu = ? WHERE idSujet = ?");
    $requete->execute([$titreSujet, $contenu, $idSujet]);
}

function supSujetAdmin($sup){
    $requete = getBdd()->prepare("DELETE FROM sujets WHERE idSujet = ?");
    $requete->execute([$sup]);
}