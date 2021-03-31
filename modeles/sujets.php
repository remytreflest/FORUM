<?php
function reqTropLongue2($param){
    $requete = getBdd()->prepare("SELECT s.idCategorie, s.idSujet, s.titreSujet, s.contenu as contenuSujet, COUNT(r.idReponse) as nbDeRemponses, COUNT(DISTINCT r.idUser) as nbUsers, MAX(r.dateReponse), ru.contenu, s.image FROM sujets s 
    LEFT JOIN reponses r USING(idSujet) 
    LEFT JOIN reponses ru ON ru.idSujet = s.idSujet AND ru.idReponse = (SELECT MAX(idReponse) FROM reponses WHERE idSujet = r.idSujet) 
    WHERE s.idCategorie = ?
    GROUP BY s.idSujet");
    $requete->execute([$param]);
    $informations = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $informations;
}

function recupSujet($informations){
    $requete = getBdd()->prepare("SELECT titreCat FROM categories WHERE idCategorie = ?");
    $requete->execute([$informations[0]["idCategorie"]]);
    $nomCategorie = $requete->fetch(PDO::FETCH_ASSOC);
    return $nomCategorie;
}

function coupePhrase($txt, $long = 106){
    if(strlen($txt) <= $long)
     return $txt;
    $txt = substr($txt, 0, $long);
    return substr($txt, 0, strrpos($txt, ' ')).'...';
}