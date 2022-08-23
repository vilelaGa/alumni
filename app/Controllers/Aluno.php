<?php

namespace App\Controllers;

class Aluno
{
    public function home($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/aluno/index.php";
    }

    public function attCadastro($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/aluno/att-cadastro.php";
    }


    public function perfil($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/aluno/perfil.php";
    }


    public function attSenha($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/aluno/trocar-senha.php";
    }
}
