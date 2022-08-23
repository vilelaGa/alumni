<?php

require_once __DIR__."../../../../vendor/autoload.php";

use App\Sessions\Sessions;
use App\DbInsercao\DbInsercao;
use App\Funcoes\Funcoes;

session_start();

$registro = Sessions::SessionAluno($_SESSION['REGISTRO_COORDENADOR']);

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
                        <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- AQUI -->
                    <div class="p-5">

                        <form class="user">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>CPF:</label>
                                    <input type="text" class="form-control form-control-user" disabled placeholder="<?= Funcoes::mask($dados['CPF'], '###.###.###-##'); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label>CHAPA:</label>
                                    <input type="text" class="form-control form-control-user" placeholder="004523" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>NOME:</label>
                                <input type="text" class="form-control form-control-user" placeholder="<?= $dados['NOME'] ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>CURSO:</label>
                                <input type="text" class="form-control form-control-user" placeholder="SISTEMAS DE INFORMAÇÃO" disabled>
                            </div>

                        </form>

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