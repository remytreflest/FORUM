<?php
require_once "traitement.php";

if(!empty($_POST["message"])){
    try{
        ajoutReponse($_POST["message"], $_GET["idSujet"], $_SESSION["idUser"]);

        $idSujet = $_GET["idSujet"];
        ?>
        <script>
            window.location.href="../user/reponse.php?idSujet=<?=$idSujet?>";
        </script>
        <?php
    }catch(exception $e){
        header("location:../user/reponse.php?error");
   }
}