<?php

namespace App\ValidacaoCadastroArquivo;

use App\DbInsercao\DbInsercao;


class ValidacaoCadastroArquivo
{
    public static function validaCadastroArquivo($registro)
    {
        (new DbInsercao('ALUMNI_CADASTRO'))->update("REGISTRO = '$registro'", [
            'PRECADASTRO' => 0,
            'DATAVALIDACAO' => date('Y-m-d'),
            'VALIDACAO' => 1
        ]);

    }


    public static function revogarCadastroArquivo($registro)
    {
        (new DbInsercao('ALUMNI_CADASTRO'))->update("REGISTRO = '$registro'", [
            'PRECADASTRO' => NULL,
            'DATAVALIDACAO' => date('Y-m-d'),
            'VALIDACAO' => 0
        ]);
    }
}
