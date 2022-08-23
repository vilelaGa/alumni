<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="<?= $url ?>/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">UBM | Alumni</h2>
        <!-- <h2 class="m-0 text-primary">
            <div class="logo">
                <img src="https://www.ubm.br/ubmalumni/images/seloalumni.png">
            </div>
        </h2> -->
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="<?= $url ?>/contato" class="nav-item nav-link">Contato</a>
            <a href="<?= $url ?>/login" class="nav-item nav-link">Login</a>
            <!-- <a href="<?= $url ?>/login-coordenador" class="nav-item nav-link">Área do Coordenador</a> -->
        </div>
        <a href="<?= $url ?>/cadastro" class="btn btn-primary">Cadastro<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>