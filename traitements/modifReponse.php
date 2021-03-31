<?php
require_once "traitement.php";

try{
    modifReponse($_POST["newContenu"], $_GET["idReponse"]);

    $idSujet = $_GET["idSujet"];
    header("location:../user/reponse.php?idSujet=$idSujet");
}catch(exception $e){
    header("location:../user/reponse.php?idSujet=$idSujet&error");
}