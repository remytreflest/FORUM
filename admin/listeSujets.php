<?php
require_once "headerAdmin.php";
$limit = 10;
if(!empty($_GET["pages"]) && empty($_GET["categories"])){
    $infos = infosSujetAdmin($limit, $_GET["pages"]);

    $nbSujets = nbSujets();

} else if (!empty($_GET["pages"]) && !empty($_GET["categories"])) {

    $infos = infosSujetAdminSL($limit, $_GET["pages"], $_GET["categories"]);

    $nbSujets = nbSujetsBC($_GET["categories"]);

} else if (empty($_GET["pages"]) && !empty($_GET["categories"])){

    $infos = infosSujetAdminAL($limit, $_GET["categories"]);

    $nbSujets = nbSujetsBC($_GET["categories"]);

} else{

    $infos = infosSujetAdminASL($limit);

    $nbSujets = nbSujets();

}

$nbPages = round($nbSujets["nbSujets"] / $limit);
if($nbPages == 1  && $nbSujets["nbSujets"] > $limit || $nbPages == 0){
    $nbPages++;
}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Sujets</h6>
                            <form class="input-group d-flex justify-content-center" action="../traitements/listeSujets.php" method="get">
                                <select class="form-select" name="categories" id="select">
                                    <option disabled selected>Filtre des catégories</option>
                                    <?php
                                    foreach($titresCategories as $titreCategorie){
                                        ?>
                                        <option value="<?=$titreCategorie["idCategorie"];?>" <?=!empty($_GET["categories"]) && $_GET["categories"] == $titreCategorie["idCategorie"] ? "selected" : "";?>><?=$titreCategorie["titreCat"];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Ok</button>
                            </form>

                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?=!isset($_GET["pages"]) || $_GET["pages"] == 0 ? "disabled" : "";?>"><a class="page-link" href="<?php
                                    if(!empty($_GET["categories"])){
                                        $str = "listeSujets.php?categories=" . $_GET["categories"] . "&";
                                    } else {
                                        $str = "listeSujets.php?";
                                    }
                                    if(isset($_GET["pages"])){
                                        $str .= "pages=" . ($_GET["pages"] - $limit);
                                    }
                                    echo $str;
                                    ?>">&laquo</a></li>
                                    <?php
                                    for($i = 1; $i <= $nbPages; $i++){
                                        ?>
                                        <li class="page-item <?=(!isset($_GET["pages"]) && $i == 1) || isset($_GET["pages"]) && $_GET["pages"] == (($i-1)*$limit) ? "active" : "";?>"><a class="page-link" href="<?=!empty($_GET["categories"]) ? "listeSujets.php?categories=" . $_GET["categories"] . "&pages=" . (($i-1)*$limit) : "listeSujets.php?pages=" . (($i-1)*$limit);?>"><?=$i?></a></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item <?=(isset($_GET["pages"]) && $_GET["pages"] == (($nbPages * $limit) - $limit)) || $nbPages == 1 || $nbPages == 0 ? "disabled" : "";?>"><a class="page-link" href="<?php
                                    if(!empty($_GET["categories"])){
                                        $str2 = "listeSujets.php?categories=" . $_GET["categories"] . "&";
                                    } else {
                                        $str2 = "listeSujets.php?";
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
                                            <th>Id</th>
                                            <th>Titre</th>
                                            <th>Contenu</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Titre</th>
                                            <th>Contenu</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        foreach($infos as $info){
                                            ?>
                                            <tr>
                                                <?php
                                                if(!empty($_GET["id"]) && ($_GET["id"] == $info["idSujet"])){
                                                    ?>
                                                        <form method='post' action='<?php
                                                        if(empty($_GET["categories"]) && empty($_GET["pages"])){
                                                            $url1 = "../traitements/listeSujets.php";
                                                        } else if(empty($_GET["categories"]) && !empty($_GET["pages"])){
                                                            $url1 = "../traitements/listeSujets.php?pages=" . $_GET["pages"];
                                                        } else if(!empty($_GET["categories"]) && empty($_GET["pages"])) {
                                                            $url1 = "../traitements/listeSujets.php?categories=" . $_GET["categories"];
                                                        } else if (!empty($_GET["categories"]) && !empty($_GET["pages"])){
                                                            $url1 = "../traitements/listeSujets.php?categories=" . $_GET["categories"] . "&pages=" . $_GET["pages"];
                                                        }
                                                        echo $url1;
                                                        ?>'>
                                                    <?php
                                                    echo $url1;
                                                }
                                                ?>

                                                    <td>
                                                            <span><?=$info["idSujet"];?></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"]){
                                                            ?>
                                                                <input type="text" value="<?=$info["titreSujet"];?>" name="titreSujet">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"] ? "d-none" : "";?>"><?=$info["titreSujet"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"]){
                                                            ?>
                                                                <input type="text" value="<?=$info["contenu"];?>" name="contenu">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"] ? "d-none" : "";?>"><?=$info["contenu"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                if(!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"]){
                                                                    ?>
                                                                    <button type="submit" value="<?=$info["idSujet"];?>" name="validate" class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <a class="btn btn-outline-warning" href="<?php
                                                                        if(empty($_GET["categories"]) && empty($_GET["pages"])){
                                                                            $url2 = "listeSujets.php?id=" . $info["idSujet"];
                                                                            echo $url2;
                                                                        } else if(empty($_GET["categories"]) && !empty($_GET["pages"])){
                                                                            $url2 = "listeSujets.php?pages=" . $_GET["pages"] . "&id=" . $info["idSujet"];
                                                                            echo $url2;
                                                                        } else if(!empty($_GET["categories"]) && empty($_GET["pages"])) {
                                                                            $url2 = "listeSujets.php?categories=" . $_GET["categories"] . "&id=" . $info["idSujet"];
                                                                            echo $url2;
                                                                        } else if (!empty($_GET["categories"]) && !empty($_GET["pages"])){
                                                                            $url2 = "listeSujets.php?categories=" . $_GET["categories"] . "&pages=" . $_GET["pages"] . "&id=" . $info["idSujet"];
                                                                            echo $url2;
                                                                        }
                                                                        ?>">Modifier</a>
                                                                        
                                                                    <?php
                                                                }
                                                            ?>
                                                    </td>
                                                <?=!empty($_GET["id"]) && $_GET["id"] == $info["idSujet"] ? "</form>" : "";?>
                                                <td><form method="post" action="../traitements/listeSujets.php"><button type="submit" name="supprimer" value="<?=$info["idSujet"];?>" class="btn btn-outline-danger">Supprimer</button></form></td>
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
                    
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
<?php
require_once "footerAdmin.php";