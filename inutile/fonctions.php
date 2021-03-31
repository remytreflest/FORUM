<?php
session_start();

function getBdd() {
    return new PDO('mysql:host=localhost;dbname=forum;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

// function gererGuillemets($string){
//     return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
// }

function coupePhrase($txt, $long = 106){
    if(strlen($txt) <= $long)
     return $txt;
    $txt = substr($txt, 0, $long);
    return substr($txt, 0, strrpos($txt, ' ')).'...';
}

function check_mdp_format($mdp){

    $erreursMdp = [];
    $minuscule = preg_match("/[a-z]/", $mdp);
    $majuscule = preg_match("/[A-Z]/", $mdp);
    $chiffre = preg_match("/[0-9]/", $mdp);
    $caractereSpecial = preg_match("/[^a-zA-Z0-9]/", $mdp);
    $str = strlen($mdp);

    if(!$minuscule){
        $erreursMdp[] = "Le mot de passe doit contenir au moins 1 minuscule.";
    }
    if(!$majuscule){
        $erreursMdp[] = "Le mot de passe doit contenir au moins 1 majuscule.";
    }
    if(!$chiffre){
        $erreursMdp[] = "Le mot de passe doit contenir au moins 1 chiffre.";
    }
    if(!$caractereSpecial){
        $erreursMdp[] = "Le mot de passe doit contenir au moins 1 caractère spécial.";
    }
    if($str < 8){
        $erreursMdp[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    return $erreursMdp;

}

function check_remplissage($titre, $contenu, $NomContenu){

    $erreurs = [];

    if(empty($_POST["titre"])){
        $erreurs[] = "Il faut remplir un titre";
    }
    if(empty($_POST["contenu"])){
        $erreurs[] = "Il faut remplir un contenu";
    }
    if(empty($_POST["NomCategorie"])){
        $erreurs[] = "Il faut choisir une catégorie";
    }

    return $erreurs;
}

function erreur($erreur){
    ?>
        <div class="alert alert-warning mt-3">
            Erreur<?=($erreur > 10) ? "s" : ""?> : <br> <br>
    <?php

    if($erreur == 1){
        ?>
        <p>L'identifiant saisi existe déjà</p>
        <?php
    }

    if($erreur == 2){
        ?>
        <p>Les deux mots de passe ne sont pas identiques</p>
        <?php
    }

    if($erreur == 3){
        ?>
        <p>L'âge doit être compris entre 0 et 120 ans</p>
        <?php
    }

    if($erreur == 4){
        ?>
        <p>Au moins un des champs n'a pas été saisi</p>
        <?php
    }

    if($erreur == 12){
        ?>
        <p>L'identifiant saisi existe déjà</p>
        <p>Les deux mots de passe ne sont pas identiques</p>
        <?php
    }

    if($erreur == 13){
        ?>
        <p>L'identifiant saisi existe déjà</p>
        <p>L'âge doit être compris entre 0 et 120 ans</p>
        <?php
    }

    if($erreur == 14){
        ?>
        <p>Au moins un des champs n'a pas été saisi</p>
        <?php
    }

    if($erreur == 23){
        ?>
        <p>Les deux mots de passe ne sont pas identiques</p>
        <p>L'âge doit être compris entre 0 et 120 ans</p>
        <?php
    }

    if($erreur == 24){
        ?>
        <p>Au moins un des champs n'a pas été saisi</p>
        <?php
    }

    ?>
    </div>
    <?php
}

function dateToFrench($date, $format){
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
?>