<?php
function infosCategorie(){
    $requete = getBdd()->prepare("SELECT * FROM categories");
    $requete->execute();
    $infos = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $infos;
}