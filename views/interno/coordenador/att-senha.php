<?php

require_once __DIR__."../../../../vendor/autoload.php";

use App\Sessions\Sessions;
use App\DbInsercao\DbInsercao;

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
                        <h1 class="h3 mb-0 text-gray-800">Atualizar Senha</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- AQUI -->

                    <div class="p-5">

                        <div id="resposta">

                        </div>

                        <form class="user needs-validation">
                            <div class="form-group">
                                <input type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" id="ip">
                                <input type="password" class="form-control form-control-user" id="senha" placeholder="Nova Senha">
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-sm-12 mb-3">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" id="validationCustom01" placeholder="Senha" required>
                                    <div class="invalid-feedback">
                                        Campo n??o preenchido!
                                    </div>
                                    <div class="valid-feedback">
                                        Campo preenchido!
                                    </div>
                                </div>
                            </div> -->
                            <button type="button" onclick="enviar()" class="btn btn-primary btn-user btn-block">
                                Atualizar
                            </button>

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

    <script>
        function enviar() {

            var senha = document.getElementById('senha').value;
            var ip = document.getElementById('ip').value;


            $.ajax({

                type: 'POST',
                dataType: 'html',
                url: '<?= $url ?>/data/att-senha',

                //Dados para envio
                data: {
                    senha: senha,
                    ip: ip
                },

                //fun????o que ser?? executada quando a solicita????o for finalizada.
                success: function(msg) {
                    $("#resposta").html(msg);
                }
            });

        }
    </script>
</body>

</html>