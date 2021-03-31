<?php
function recupIdentifiant($identifiant){
    $req = getBdd()->prepare("SELECT identifiant FROM utilisateurs where identifiant = ?");
    $req->execute([$identifiant]);
    return $req;
}

function modifIdentifiant($identifiant, $idUser){
    $req = getBdd()->prepare("UPDATE utilisateurs set identifiant = ? WHERE idUser = ?");
    $req->execute([$identifiant, $idUser]);
    return $req;
}

function recupMdp($idUser){
    $req = getBdd()->prepare("SELECT mdp FROM utilisateurs WHERE idUser = ?");
    $req->execute([$idUser]);
    $userMdp = $req->Fetch(PDO::FETCH_ASSOC);
    return $userMdp;
}

function modifMdp($newMdp, $idUser){
    $req = getBdd()->prepare("UPDATE utilisateurs set mdp = ? WHERE idUser = ?");
    $req->execute([$newMdp, $idUser]);
}

function modifAge($age, $idUSer){
    $req = getBdd()->prepare("UPDATE utilisateurs set age = ? WHERE idUser = ?");
    $req->execute([$age, $idUSer]);
}