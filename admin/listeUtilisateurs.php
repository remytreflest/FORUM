<?php
require_once "headerAdmin.php";

// requete pour remplir le select afin de pouvoir trier par catégorie
$titresCategories = titreCategorieAdmin();

if(isset($_GET["userRemoved"])){
    $userRemoved = preg_split("#[\\ ]#", $_GET["userRemoved"], -1);
    ?>
    <div class="alert alert-warning">L'utilisateur : <?=$userRemoved[0];?>, idUser : <?=$userRemoved[1];?>, n'est plus modérateur de la catégorie n°<?=$userRemoved[2];?></div>
    <?php
}

$limit = 10;

if(!empty($_GET["pages"]) && empty($_GET["filtre"])){

    $infos = infosUserAdmin($limit, $_GET["pages"]);
    $nbUsers = nbUserAdmin();

} else if (!empty($_GET["pages"]) && !empty($_GET["filtre"])) {

    $_GET["filtre"] = str_replace(".", " ", $_GET["filtre"]);
    $infos = infosUserAdminF($_GET["filtre"], $limit, $_GET["pages"]);
    $nbUsers = nbUserAdminF($_GET["filtre"]);
    

} else if (empty($_GET["pages"]) && !empty($_GET["filtre"])){

    $_GET["filtre"] = str_replace(".", " ", $_GET["filtre"]);
    $infos = infosUserAdminWP($_GET["filtre"], $limit);

    $nbUsers = nbUserAdminWP($_GET["filtre"]);

} else {
    // la requete basique si aucun GET n'est présent dans l'URL
    $infos = infosUserAdminA($limit);
    $nbUsers = nbUserAdminA();

}

$nbPages = round($nbUsers["nbUtilisateur"] / $limit);
if($nbPages == 1  && $nbUsers["nbUtilisateur"] > $limit || $nbPages == 0){
    $nbPages++;
}


?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Sujets</h6>
                            <form class="input-group d-flex justify-content-center" action="" method="get">
                                <select class="form-select" name="filtre" id="select">
                                    <option value="" selected>Filtre général </option>
                                        <option value="IS.NULL" <?=!empty($_GET["filtre"]) && $_GET["filtre"] == "IS NULL" ? "selected" : "";?>>Utilisateurs</option>
                                        <option value="IS.NOT.NULL" <?=!empty($_GET["filtre"]) && $_GET["filtre"] == "IS NOT NULL" ? "selected" : "";?>>Modérateurs</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Ok</button>
                            </form>

                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?=!isset($_GET["pages"]) || $_GET["pages"] == 0 ? "disabled" : "";?>"><a class="page-link" href="<?php
                                    if(!empty($_GET["filtre"])){
                                        $str = "listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&";
                                    } else {
                                        $str = "listeUtilisateurs.php?";
                                    }
                                    if(isset($_GET["pages"])){
                                        $str .= "pages=" . ($_GET["pages"] - $limit);
                                    }
                                    echo $str;
                                    ?>">&laquo</a></li>
                                    <?php
                                    for($i = 1; $i <= $nbPages; $i++){
                                        ?>
                                        <li class="page-item <?=(!isset($_GET["pages"]) && $i == 1) || isset($_GET["pages"]) && $_GET["pages"] == (($i-1)*$limit) ? "active" : "";?>"><a class="page-link" href="<?=!empty($_GET["filtre"]) ? "listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&pages=" . (($i-1)*$limit) : "listeUtilisateurs.php?pages=" . (($i-1)*$limit);?>"><?=$i?></a></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item <?=(isset($_GET["pages"]) && $_GET["pages"] == (($nbPages * $limit) - $limit)) || $nbPages == 1 || $nbPages == 0 ? "disabled" : "";?>"><a class="page-link" href="<?php
                                    if(!empty($_GET["filtre"])){
                                        $str2 = "listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&";
                                    } else {
                                        $str2 = "listeUtilisateurs.php?";
                                    }
                                    if(isset($_GET["pages"])){
                                        $str2 .= "pages=" . ($_GET["pages"] + $limit);
                                    } else {
                                        $str2 .= "pages=" . $limit;
                                    }
                                    echo $str2;
                                    ?>">&raquo</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Identifiant</th>
                                            <th>Id Role</th>
                                            <th>Catégorie modérée</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Identifiant</th>
                                            <th>Id Role</th>
                                            <th>Catégorie modérée</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        foreach($infos as $info){
                                            ?>
                                            <tr>
                                                <?php
                                                if(!empty($_GET["id"]) && ($_GET["id"] == $info["idUser"])){
                                                    ?>
                                                        <form method='post' action='<?php
                                                        if(empty($_GET["filtre"]) && empty($_GET["pages"])){
                                                            $url1 = "../traitements/listeUtilisateurs.php";
                                                        } else if(empty($_GET["filtre"]) && !empty($_GET["pages"])){
                                                            $url1 = "../taitements/listeUtilisateurs.php?pages=" . $_GET["pages"];
                                                        } else if(!empty($_GET["filtre"]) && empty($_GET["pages"])) {
                                                            $url1 = "../taitements/listeUtilisateurs.php?filtre=" . $_GET["filtre"];
                                                        } else if (!empty($_GET["filtre"]) && !empty($_GET["pages"])){
                                                            $url1 = "../taitements/listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&pages=" . $_GET["pages"];
                                                        }
                                                        echo $url1;
                                                        ?>'>
                                                    <?php
                                                }
                                                ?>

                                                    <td>
                                                            <span><?=$info["identifiant"];?></span>
                                                            <input type="hidden" name="idUser" value="<?=$info["idUser"];?>">
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idUser"]){
                                                            ?>
                                                                <input type="text" value="<?=$info["idRole"];?>" name="idRole">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idUser"] ? "d-none" : "";?>"><?=$info["idRole"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idUser"]){
                                                            ?>
                                                            <div class="input-group mb-3">
                                                                <select class="form-select" id="inputGroupSelect02" name="idCategorie">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach($titresCategories as $titreCategorie){
                                                                    ?>
                                                                            <option value="<?=$titreCategorie["idCategorie"];?>"><?=$titreCategorie["titreCat"];?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idUser"] ? "d-none" : "";?>"><?=$info["titreCat"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                if(!empty($_GET["id"]) && $_GET["id"] == $info["idUser"]){
                                                                    ?>
                                                                    <button type="submit" value="<?=$info["idUser"];?>" name="validate" class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <a class="btn btn-outline-warning" href="<?php
                                                                        if(empty($_GET["filtre"]) && empty($_GET["pages"])){
                                                                            $url2 = "listeUtilisateurs.php?id=" . $info["idUser"];
                                                                            echo $url2;
                                                                        } else if(empty($_GET["filtre"]) && !empty($_GET["pages"])){
                                                                            $url2 = "listeUtilisateurs.php?pages=" . $_GET["pages"] . "&id=" . $info["idUser"];
                                                                            echo $url2;
                                                                        } else if(!empty($_GET["filtre"]) && empty($_GET["pages"])) {
                                                                            $url2 = "listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&id=" . $info["idUser"];
                                                                            echo $url2;
                                                                        } else if (!empty($_GET["filtre"]) && !empty($_GET["pages"])){
                                                                            $url2 = "listeUtilisateurs.php?filtre=" . $_GET["filtre"] . "&pages=" . $_GET["pages"] . "&id=" . $info["idUser"];
                                                                            echo $url2;
                                                                        }
                                                                        ?>">Modifier</a>
                                                                        
                                                                    <?php
                                                                }
                                                            ?>
                                                    </td>
                                                <?=!empty($_GET["id"]) && $_GET["id"] == $info["idUser"] ? "</form>" : "";?>
                                                <td><form method="post" action="../traitement/listeUtilisateurs.php"><button type="submit" name="supprimer" value="<?=$info["idUser"];?>" class="btn btn-outline-danger">Supprimer</button></form></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php
require_once "footerAdmin.php";
?>