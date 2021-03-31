<?php
function reqTropLongue(){
    $requete = getBdd()->prepare("SELECT c.idCategorie, c.titreCat, COUNT(s.idSujet), su.titreSujet, COUNT(DISTINCT r.idUser), MAX(r.dateReponse), c.image
    FROM categories c
    LEFT JOIN sujets s USING(idCategorie)
    LEFT JOIN sujets su ON su.idCategorie = c.idCategorie AND su.idSujet = (SELECT MAX(idSujet) FROM sujets WHERE idCategorie = c.idCategorie)
    LEFT JOIN reponses r ON r.idSujet = s.idSujet
    GROUP BY c.idCategorie");
    $requete->execute();
    $informations = $requete->fetchALL(PDO::FETCH_ASSOC);
    return $informations;
}