<?php
function role($idUser){
    $req = getBdd()->prepare("SELECT idModerateur, titreCat FROM moderateurs inner join categories using(idCategorie) where idUser = ?");
    $req->execute([$idUser]);
    $role = $req->Fetch(PDO::FETCH_ASSOC);
    return $role;
}