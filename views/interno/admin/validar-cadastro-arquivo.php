<?php

require_once __DIR__ . "../../../../vendor/autoload.php";

use App\Sessions\Sessions;
use App\DbInsercao\DbInsercao;
use App\Funcoes\Funcoes;

session_start();

$registro = Sessions::SessionAluno($_SESSION['REGISTRO_ADMIN']);

$dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
    ->fetch(PDO::FETCH_ASSOC);


$pedidos = (new DbInsercao('ALUMNI_CADASTRO'))->select("PRECADASTRO = 1")
    ->fetchAll(PDO::FETCH_ASSOC);

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
                        <h1 class="h3 mb-0 text-gray-800">Pedidos de validação</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <div id="resposta"></div>

                    <!-- AQUI -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pedidos de validação</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Curso</th>
                                            <th>Ano</th>
                                            <th>VALIDAÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Curso</th>
                                            <th>Ano</th>
                                            <th>VALIDAÇÃO</th>
                                        </tr>
                                    </tfoot>
                                    <?php foreach ($pedidos as $linha) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $linha['NOME'] ?></td>
                                                <td><?= Funcoes::mask($linha['CPF'], '###.###.###-##') ?></td>
                                                <td><?= $linha['CURSO'] ?></td>
                                                <td><?= $linha['ANO'] ?></td>
                                                <td>
                                                    <span>
                                                        <form action="<?= $url ?>/data/valida-arquivo" method="POST">
                                                            <input type="hidden" value="<?= base64_encode($linha['REGISTRO']) ?>" name="REGISTRO">
                                                            <button class="btn btn-success btn-circle" value="MQ==" name='valida'>
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                            <button class="btn btn-warning btn-circle" value="Mg==" name='valida'>
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php } ?>
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