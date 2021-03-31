<?php
function titreCategorieAdmin(){
    $requete = getBdd()->prepare("SELECT idCategorie, titreCat FROM categories");
    $requete->execute();
    $titresCategories = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $titresCategories;
}

function infosUserAdmin($limit, $pages){
    $requete = getBdd()->prepare("SELECT idUser, identifiant, idRole, utilisateurs.idModerateur, categories.idModerateur as idModerateurCategorie, titreCat FROM utilisateurs LEFT JOIN categories USING(idModerateur) LIMIT :limit OFFSET :offset");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':offset',$pages,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbUserAdmin(){
    $requete = getBdd()->prepare("SELECT COUNT(idUser) as nbUtilisateur FROM utilisateurs");
    $requete->execute();
    $nbUsers = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbUsers;
}

function infosUserAdminF($filtre, $limit, $pages){
    $sql = "SELECT idUser, identifiant, idRole, idCategorie, titreCat FROM utilisateurs LEFT JOIN moderateurs USING(idUser) LEFT JOIN categories USING(idCategorie) WHERE idmoderateur " . $filtre . " LIMIT :limit OFFSET :offset";

    $requete = getBdd()->prepare($sql);
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->bindValue(':offset',$pages,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbUserAdminF($filtre){
    $sql = "SELECT COUNT(idUser) as nbUtilisateur FROM utilisateurs LEFT JOIN moderateurs USING(idUser) LEFT JOIN categories USING(idCategorie) WHERE idmoderateur " . $filtre;
    $requete = getBdd()->prepare($sql);
    $requete->execute();
    $nbUsers = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbUsers;
}

function infosUserAdminWP($filtre, $limit){
    $sql = "SELECT idUser, identifiant, idRole, idCategorie, titreCat FROM utilisateurs LEFT JOIN moderateurs USING(idUser) LEFT JOIN categories USING(idCategorie) WHERE idmoderateur " . $filtre . " LIMIT :limit";

    $requete = getBdd()->prepare($sql);
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbUserAdminWP($filtre){
    $sql = "SELECT COUNT(idUser) as nbUtilisateur FROM utilisateurs LEFT JOIN moderateurs USING(idUser) LEFT JOIN categories USING(idCategorie) WHERE idmoderateur " . $filtre;
    $requete = getBdd()->prepare($sql);
    $requete->execute();
    $nbUsers = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbUsers;
}

function infosUserAdminA($limit){
    $requete = getBdd()->prepare("SELECT idUser, identifiant, idRole, idCategorie, titreCat FROM utilisateurs LEFT JOIN moderateurs USING(idUser) LEFT JOIN categories USING(idCategorie) LIMIT :limit");
    $requete->bindValue(':limit',$limit,PDO::PARAM_INT);
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}

function nbUserAdminA(){
    $requete = getBdd()->prepare("SELECT COUNT(idUser) as nbUtilisateur FROM utilisateurs");
    $requete->execute();
    $nbUsers = $requete->fetch(PDO::FETCH_ASSOC);
    return $nbUsers;
}

function userCategorie($idCategorie){
    $requete = getBdd()->prepare("SELECT idUser, identifiant FROM utilisateurs LEFT JOIN moderateurs USING(idUser) WHERE idCategorie = ?");
    $requete->execute([$idCategorie]);
    $userCate = $requete->fetch(PDO::FETCH_ASSOC);
    return $userCate;
}

function supModerateur($idCategorie){
    $requete = getBdd()->prepare("DELETE FROM moderateurs WHERE idCategorie = ?");
    $requete->execute([$idCategorie]);
}

function ajoutModerateur($idUser, $idCategorie){
    $requete = getBdd()->prepare("INSERT INTO moderateurs(idUser, idCategorie) VALUES (?, ?)");
    $requete->execute([$idUser, $idCategorie]);
}

function modifModerateur($idCategorie, $idUser){
    $requete = getBdd()->prepare("UPDATE moderateurs SET idCategorie = ? WHERE idUser = ?");
    $requete->execute([$idCategorie, $idUser]);
}

function supModerateurBU($idUser){
    $requete = getBdd()->prepare("DELETE FROM moderateurs WHERE idUser = ?");
    $requete->execute([$idUser]);
}

function modifUserBM($idRole, $idUser){
    $requete = getBdd()->prepare("UPDATE utilisateurs SET idRole = ? WHERE idUser = ?");
    $requete->execute([$idRole, $idUser]);
}

function supUserBA($sup){
    $requete = getBdd()->prepare("DELETE FROM utilisateurs WHERE idUser = ?");
    $requete->execute([$sup]);
}