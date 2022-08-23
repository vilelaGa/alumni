<?php

namespace App\AttCadastro;

use App\DbInsercao\DbInsercao;

class AttCadastro
{


    /**
     * Função para mudar senha
     * @param 4
     * @var int celular
     * @var int telefone
     * @var string email
     * @var int registro
     */
    public static function atualizar($celular, $telefone, $email, $registro)
    {
        (new DbInsercao('ALUMNI_CADASTRO'))->update('REGISTRO = ' . $registro, [
            'TELEFONE1' => $celular,
            'TELEFONE2' => $telefone,
            'EMAIL' => $email
        ]);

        return $htmlAtt = '<div class="alert alert-success" role="alert">
                                Informações atualizadas com sucesso
                            </div>
        ';
    }


    /**
     * Função para mudar senha
     * @param 3
     * @var int celular
     * @var int telefone
     * @var int registro
     */
    public static function atualizarCoorAdm($celular, $telefone, $registro)
    {
        (new DbInsercao('ALUMNI_CADASTRO'))->update('REGISTRO = ' . $registro, [
            'TELEFONE1' => $celular,
            'TELEFONE2' => $telefone
        ]);

        return $htmlAtt = '<div class="alert alert-success" role="alert">
                                Informações atualizadas com sucesso
                            </div>
        ';
    }
}
