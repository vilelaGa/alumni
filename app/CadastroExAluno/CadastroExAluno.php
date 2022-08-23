<?php

namespace App\CadastroExAluno;

use App\DbInsercao\DbInsercao;
use PDO;

class CadastroExAluno
{
    public $cpf;
    public $celular;
    public $telefone;
    public $email;
    public $senha;


    /**
     * Função que cadastra o ex aluno do banco
     */
    public function cadastrar()
    {

        $dado = (new DbInsercao())->selectNome($this->cpf)
            ->fetch(PDO::FETCH_ASSOC);

        // echo $dado['nome'];
        // die();

        $obDatabase = new DbInsercao('ALUMNI_CADASTRO');

        $obDatabase->insert([
            'CPF' => $this->cpf,
            'TELEFONE1' => $this->celular,
            'TELEFONE2' => $this->telefone,
            'EMAIL' => $this->email,
            'SENHA' => $this->senha,
            'DATACADASTRO' => date("Y-m-d"),
            'PERFIL' => 1,
            'NOME' => $dado['nome'],
            'PRECADASTRO' => 0,
            'VALIDACAO' => 1
        ]);
    }
}
