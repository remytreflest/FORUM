<?php
require_once "traitement.php";

if(!empty($_POST["titre"])) {
    try{
        ajoutCategorie($_POST["titre"]);
        header("location:../admin/ajoutCategorie.php?success");
    }catch(exception $e){
        header("location:../admin/ajoutCategorie.php?error");
    }
}else{
    header("location:../admin/ajoutCategorie.php?error");
}