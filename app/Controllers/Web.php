<?php

namespace App\Controllers;


class Web
{
    public function home($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/externo/home.php";
    }


    public function contato($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/externo/contato.php";
    }


    public function coletaAnalise($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/cadastro-centenarios.php";
    }


    public function login($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/login.php";
    }


    public function cadastro($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/cadastro.php";
    }


    public function registro($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/registrar.php";
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $url = URL_BASE;
        header("Location: $url/");
        die();
    }

    public function redefinir_senha()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/esqueceu-senha.php";
    }

    public function redefinir_senha_token($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/pagina-token.php";
    }


    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
    }
}
