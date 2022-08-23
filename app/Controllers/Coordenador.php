<?php

namespace App\Controllers;


class Coordenador
{

    public function home($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/coordenador/index.php";
    }


    public function cadastrarNoticia($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/coordenador/cadastrar-noticia.php";
    }


    public function perfil($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/coordenador/perfil.php";
    }

    public function attSenha($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/coordenador/att-senha.php";
    }

    public function attContato($data)
    {
        $url = URL_BASE;
        require __DIR__ . "/../../views/interno/coordenador/att-contato.php";
    }
}
