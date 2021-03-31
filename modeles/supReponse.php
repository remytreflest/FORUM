<?php
function supReponse(){
    $requete = getBdd()->prepare("DELETE FROM reponses where idReponse = ?");
    $requete->execute([$_GET["idReponse"]]);
}