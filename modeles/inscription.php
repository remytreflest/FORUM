<?php
function recupInscription($identifiant){
    $requete = getBdd()->prepare("SELECT identifiant FROM utilisateurs WHERE identifiant = ?");
    $requete->execute([$identifiant]);
    $identifiant = $requete->FetchAll(PDO::FETCH_ASSOC);
    return $identifiant;
}

function check_mdp_format($mdp){

    $erreursMdp = [];
    $minuscule = preg_match("/[a-z]/", $mdp);
    $majuscule = preg_match("/[A-Z]/", $mdp);
    $chiffre = preg_match("/[0-9]/", $mdp);
    $caractereSpecial = preg_match("/[^a-zA-Z0-9]/", $mdp);
    $str = strlen($mdp);

    if(!$minuscule){
        $erreursMdp[] = 4;
    }
    if(!$majuscule){
        $erreursMdp[] = 5;
    }
    if(!$chiffre){
        $erreursMdp[] = 6;
    }
    if(!$caractereSpecial){
        $erreursMdp[] = 7;
    }
    if($str < 8){
        $erreursMdp[] = 8;
    }

    return $erreursMdp;
}

function inscription($identifiant, $mdp, $age){
    $requete = getBdd()->prepare("INSERT INTO utilisateurs(identifiant, mdp, age, idRole) VALUES (?, ?, ?, ?);");
    $requete->execute([$identifiant, $mdp, $age, 1]);
}