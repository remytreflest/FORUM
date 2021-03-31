<?php
function modifCategorieAdmin($titreCat, $contenu, $validate){
    $requete = getBdd()->prepare("UPDATE categories SET titreCat = ?, contenu = ? WHERE idCategorie = ?");
    $requete->execute([$titreCat, $contenu, $validate]);
}

function supCategorieAdmin($sup){
    $requete = getBdd()->prepare("DELETE FROM categories WHERE idCategorie = ?");
    $requete->execute([$sup]);
}

function infosCategorieAdmin(){
    $requete = getBdd()->prepare("SELECT * FROM categories LIMIT :limit OFFSET :offset");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':offset',$_GET["pages"],PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function infosCategorieAdminSL($limit){
    $requete = getBdd()->prepare("SELECT * FROM categories LIMIT :limit");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbCategorie(){
    $requete = getBdd()->prepare("SELECT COUNT(idCategorie) as nbCategorie FROM categories");
    $requete->execute();
    $nbCategories = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbCategories;
}