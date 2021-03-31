<?php
function recupCreateurs($idSujet){
    $req = getBdd()->prepare("SELECT * FROM sujets INNER JOIN utilisateurs using(idUser) LEFT JOIN moderateurs using(idUser) where idSujet = ?");
    $req->execute([$idSujet]);
    $createurs = $req->FetchALL(PDO::FETCH_ASSOC);
    return $createurs;
}

function recupReponses($idSujet){
    $requete = getBdd()->prepare("SELECT * FROM reponses INNER JOIN utilisateurs USING(idUser) LEFT JOIN moderateurs using(idUser) where idSujet = ?");
    $requete->execute([$idSujet]);
    $reponses = $requete->FetchALL(PDO::FETCH_ASSOC);
    return $reponses;
}

function recupProblem($idSujet){
    $req = getBdd()->prepare("SELECT * FROM sujets where idSujet = ?");
    $req->execute([$idSujet]);
    $problematiques = $req->FetchALL(PDO::FETCH_ASSOC);
    return $problematiques;
}

function modifReponse($contenu, $idReponse){
    $requete = getBdd()->prepare("UPDATE reponses set contenu = ? where idReponse = ?");
    $requete->execute([$contenu, $idReponse]);
}