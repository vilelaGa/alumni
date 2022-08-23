<?php

session_start();

if (@!$_SESSION['cpf_valido']) {
    echo "<script>window.location = '$url/cadastro'</script>";
    die();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alumni - Registrar</title>

    <!-- Custom fonts for this template-->
    <link href="<?= $url ?>/views/assets_interno/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $url ?>/views/assets_interno/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-success">Cpf existe na base de dados!</h1>
                                <p class="mb-3">
                                    Atualize suas informações para continuar!
                                </p>
                            </div>
                            <div id="resposta">

                            </div>
                            <form class="user needs-validation">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="celular" placeholder="Celular">

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="telefone" placeholder="Telefone">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" id="exampleInputEmail" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3">
                                        <input type="password" class="form-control form-control-user" id="senha" id="exampleInputPassword" placeholder="Nova senha">

                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div> -->
                                </div>
                                <button type="button" onclick="enviar()" class="btn btn-primary btn-user btn-block cem">
                                    Atualizar
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <!-- <a class="small" href="forgot-password.html">
                                    Já tem uma conta? Conecte-se!</a> -->
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= $url ?>/cadastro">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= $url ?>/views/assets_interno/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $url ?>/views/assets_interno/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= $url ?>/views/assets_interno/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= $url ?>/views/assets_interno/js/sb-admin-2.min.js"></script>

    <!-- Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#celular').mask('(00) 00000-0000');
            $('#telefone').mask('(00) 00000-000');
        });
    </script>

    <script>
        function enviar() {

            var celular = document.getElementById('celular').value;
            var telefone = document.getElementById('telefone').value;
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;

            $.ajax({

                type: 'POST',
                dataType: 'html',
                url: '<?= $url ?>/data/registro',

                //Dados para envio
                data: {
                    celular: celular,
                    telefone: telefone,
                    email: email,
                    senha: senha
                },

                //função que será executada quando a solicitação for finalizada.
                success: function(msg) {
                    $("#resposta").html(msg);
                }
            });

        }
    </script>

</body>

</html>