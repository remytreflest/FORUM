<?php
function infos(){
    $requete = getBdd()->prepare("SELECT COUNT(u.idUser) as nbUtilisateurs, COUNT(idReponse) as nbReponses, COUNT(sujets.idSujet) as nbSujets, COUNT(DISTINCT categories.idCategorie) as nbCategories FROM utilisateurs u
    LEFT JOIN reponses USING(idUser)
    RIGHT JOIN sujets USING(idSujet)
    RIGHT JOIN categories USING(idCategorie)");
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}