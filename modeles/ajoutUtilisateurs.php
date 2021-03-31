<?php
function recupIdentifiantAdmin($identifiant){
    $requete = getBdd()->prepare("SELECT identifiant FROM utilisateurs WHERE identifiant = ?");
    $requete->execute([$identifiant]);
    return $requete;
}

function ajoutUserAdmin($identifiant, $mdp, $age){
    $requete = getBdd()->prepare("INSERT INTO utilisateurs(identifiant, mdp, age, idRole) VALUES (?, ?, ?, ?);");
    $requete->execute([$identifiant, $mdp, $age, 1]);
}