<?php
require_once "headerAdmin.php";
$limit = 10;
$nbCategories = nbCategorie();
$nbPages = round($nbCategories["nbCategorie"] / $limit);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item <?=!isset($_GET["pages"]) || $_GET["pages"] == 0 ? "disabled" : "";?>"><a class="page-link" href="listeCategories.php?pages=<?=isset($_GET["pages"]) ? $_GET["pages"] - $limit : 0;?>">&laquo</a></li>
                                    <?php
                                    for($i = 1; $i <= $nbPages; $i++){
                                        ?>
                                        <li class="page-item <?=(!isset($_GET["pages"]) && $i == 1) || isset($_GET["pages"]) && $_GET["pages"] == (($i-1)*$limit) ? "active" : "";?>"><a class="page-link" href="listeCategories.php?pages=<?=($i-1)*$limit;?>"><?=$i;?></a></li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item <?=(isset($_GET["pages"]) && $_GET["pages"] == (($nbPages * $limit) - $limit)) || $nbPages == 1 ? "disabled" : "";?>"><a class="page-link" href="listeCategories.php?pages=<?=!isset($_GET["pages"]) ? $limit : $_GET["pages"] + $limit;?>">&raquo</a></li>
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
                                                <?=!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"] ? "<form method='post' action='../traitements/listeCategories.php'>" : "";?>
                                                    <td>
                                                            <span><?=$info["idCategorie"];?></span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"]){
                                                            ?>
                                                                <input type="text" value="<?=$info["titreCat"];?>" name="titreCat">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"] ? "d-none" : "";?>"><?=$info["titreCat"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if(!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"]){
                                                            ?>
                                                                <input class="inputWidth" type="text" value="<?=$info["contenu"];?>" name="contenu">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="<?=!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"] ? "d-none" : "";?>"><?=$info["contenu"];?></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                            <?php
                                                                if(!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"]){
                                                                    ?>
                                                                    <button type="submit" value="<?=$info["idCategorie"];?>" name="validate" class="btn btn-outline-success"><i class="fas fa-check"></i></button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <form method="get">
                                                                        <button type="submit" value="<?=$info["idCategorie"];?>" name="id" class="btn btn-outline-warning">Modifier</button>
                                                                    </form>
                                                                    <?php
                                                                }
                                                            ?>
                                                    </td>
                                                <?=!empty($_GET["id"]) && $_GET["id"] == $info["idCategorie"] ? "</form>" : "";?>
                                                    <td><form method="post" action="../traitements/listeCategories.php"><button type="submit" name="supprimer" value="<?=$info["idCategorie"];?>" class="btn btn-outline-danger">Supprimer</button></form></td>
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

<?php
require_once "footerAdmin.php";