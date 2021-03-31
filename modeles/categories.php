<?php
function ajoutCategorie($titre){
    $requete = getBdd() ->prepare("insert into categories(titreCat) values(?)");
    $requete ->execute([$titre]);
}