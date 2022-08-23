<?php

require_once __DIR__."../../../../vendor/autoload.php";

use App\Sessions\Sessions;
use App\DbInsercao\DbInsercao;

session_start();

$registro = Sessions::SessionAluno($_SESSION['REGISTRO_ADMIN']);

$dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
    ->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include('includes/head.php') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('includes/sidebar.php') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/nav.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Gestão</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- AQUI -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabela Colaboradores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ra</th>
                                            <th>Curso</th>
                                            <th>Cargo</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ra</th>
                                            <th>Curso</th>
                                            <th>Cargo</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>324324434</td>
                                            <td>Edinburgh</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>324324434</td>
                                            <td>Tokyo</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>324324434</td>
                                            <td>San Francisco</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>324324434</td>
                                            <td>Edinburgh</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Airi Satou</td>
                                            <td>324324434</td>
                                            <td>Tokyo</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Brielle Williamson</td>
                                            <td>324324434</td>
                                            <td>New York</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Herrod Chandler</td>
                                            <td>324324434</td>
                                            <td>San Francisco</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Rhona Davidson</td>
                                            <td>324324434</td>
                                            <td>Tokyo</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Colleen Hurst</td>
                                            <td>324324434</td>
                                            <td>San Francisco</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Sonya Frost</td>
                                            <td>324324434</td>
                                            <td>Edinburgh</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Jena Gaines</td>
                                            <td>324324434</td>
                                            <td>London</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Quinn Flynn</td>
                                            <td>324324434</td>
                                            <td>Edinburgh</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Charde Marshall</td>
                                            <td>324324434</td>
                                            <td>San Francisco</td>
                                            <td>coordenador</td>
                                        </tr>
                                        <tr>
                                            <td>Haley Kennedy</td>
                                            <td>324324434</td>
                                            <td>London</td>
                                            <td>coordenador</td>
                                        </tr>



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
            <?php include('includes/footer.php'); ?>
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
    <?php include('includes/logout-modal.php'); ?>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= $url ?>/views/assets_interno/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $url ?>/views/assets_interno/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $url ?>/views/assets_interno/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $url ?>/views/assets_interno/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= $url ?>/views/assets_interno/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= $url ?>/views/assets_interno/js/demo/chart-area-demo.js"></script>
    <script src="<?= $url ?>/views/assets_interno/js/demo/chart-pie-demo.js"></script>

</body>

</html>