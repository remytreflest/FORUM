<?php
require_once "traitement.php";

supReponse();

$idSujet = $_GET["idSujet"];
header("location:../user/reponse.php?idSujet=$idSujet");