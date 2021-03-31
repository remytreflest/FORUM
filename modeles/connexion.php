<?php
function verifConnexion($identifiant){
    $requete = getBdd()->prepare("SELECT idUser, identifiant, mdp, age, idRole FROM utilisateurs WHERE identifiant = ?");
    $requete->execute([$identifiant]);
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
    return $utilisateur;
}