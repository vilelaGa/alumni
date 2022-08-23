<?php

namespace App\Controllers;

class Admin
{
    public function home()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/index.php";
    }


    public function cadastrarConteudo()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/cadastrar-conteudo.php";
    }


    public function gestao()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/gestao.php";
    }


    public function perfil()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/perfil.php";
    }

    public function attSenha()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/att-senha.php";
    }


    public function attContato()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/att-contato.php";
    }

    public function validarCadastroExArquivo()
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/admin/validar-cadastro-arquivo.php";
    }
}
