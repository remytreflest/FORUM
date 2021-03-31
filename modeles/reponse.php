<?php
function createurs($idSujet){
    $req = getBdd()->prepare("SELECT * FROM sujets INNER JOIN utilisateurs using(idUser) LEFT JOIN moderateurs using(idUser) where idSujet = ?");
    $req->execute([$idSujet]);
    $createurs = $req->FetchALL(PDO::FETCH_ASSOC);
    return $createurs;
}

function reponses($idSujet){
    $requete = getBdd()->prepare("SELECT * FROM reponses INNER JOIN utilisateurs USING(idUser) LEFT JOIN moderateurs using(idUser) where idSujet = ?");
    $requete->execute([$idSujet]);
    $reponses = $requete->FetchALL(PDO::FETCH_ASSOC);
    return $reponses;
}

function problematiques($idSujet){
    $req = getBdd()->prepare("SELECT * FROM sujets where idSujet = ?");
    $req->execute([$idSujet]);
    $problematiques = $req->FetchALL(PDO::FETCH_ASSOC);
    return $problematiques;
}

function ajoutReponse($message, $idSujet, $idUser){
    $requete = getBdd()->prepare("INSERT INTO reponses(contenu, dateReponse, idSujet, idUser) values(?, Now(), ?, ?)");
    $requete->execute([$message, $idSujet, $idUser]);
}

function dateToFrench($date, $format){
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}