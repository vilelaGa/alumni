<?php

namespace App\MudarSenha;

use App\DbInsercao\DbInsercao;

class MudarSenha
{


    /**
     * Função para mudar senha
     * @param 2
     * @var string senha
     * @var int registro
     */
    public static function atualizarSenha($senha, $registro)
    {
        (new DbInsercao('ALUMNI_CADASTRO'))->update('REGISTRO = ' . $registro, [
            'SENHA' => $senha
        ]);

        return $htmlSenha = '<div class="alert alert-success" role="alert">
        Senha atualizada com sucesso
    </div>
        ';
    }


    /**
     * Função para mudar senha
     * @param 2
     * @var string senha
     * @var int registro
     */
    public static function atualizarSenhaToken($senha)
    {
        session_start();

        $email = $_SESSION['emailtokenRedefinirSenha'];


        (new DbInsercao('ALUMNI_CADASTRO'))->update('EMAIL = ' . "'" . $email . "'", [
            'SENHA' => $senha
        ]);

        return $htmlSenha = '<div class="alert alert-success" role="alert">
                                    Senha atualizada com sucesso
                            </div>
        ';
    }
}
