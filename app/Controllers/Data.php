<?php


namespace App\Controllers;

use App\FuncoesBack\FuncoesBack;


class Data
{
    public function dataCadastro($data)
    {
        FuncoesBack::verificaCpfAluno($data['cpf']);
    }


    public function dataColetaAnalise($data)
    {
        FuncoesBack::analiseCadastroExAluno($data);
    }


    public function dataLogin($data)
    {
        FuncoesBack::login($data);
    }


    public function dataRegistro($data)
    {
        FuncoesBack::validaCadastroExAluno($data);
    }


    public function dataAttCadastro($data)
    {
        FuncoesBack::attCadastro($data);
    }

    //Não funciona ainda
    public function dataCadastrarNoticia($data)
    {
        FuncoesBack::cadastrarNoticiaCoordenador($data);
    }


    public function dataAttSenha($data)
    {
        FuncoesBack::attSenha($data);
    }


    public function dataValidaCadastroArquivo($data)
    {
        FuncoesBack::validaCadastroArquivo($data);
    }


    public function dataRedefinirSenhaToken($data)
    {
        FuncoesBack::trocarSenhaToken($data);
    }


    public function dataRedefinirSenha($data)
    {
        FuncoesBack::redefinirSenha($data);
    }

    public function dataCadastrarConteudo($data)
    {
        // var_dump($data);
        //function para validar usuario

        $data['titulo'];
        $data['url'];
        $data['descricao'];


        if (!empty($data['titulo']) && !empty($data['url']) && !empty($data['descricao'])) {
            echo '<div class="alert alert-success" role="alert" id="resposta">
                            correto
            </div>';
            $url = URL_BASE;
            echo "<script>window.location = '$url/admin/'</script>";
        } else {
            echo '<div class="alert alert-danger" role="alert" id="resposta">
                            errado
            </div>';
        }
    }
}
