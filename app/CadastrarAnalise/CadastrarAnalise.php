<?php

namespace App\CadastrarAnalise;

use App\DbInsercao\DbInsercao;
use PDO;

class CadastrarAnalise
{
    public $cpf;
    public $nome;
    public $ano;
    public $curso;
    public $email;
    public $senha;


    /**
     * Função que cadastra o ex aluno do banco
     */
    public function cadastrar()
    {

        // $dado = (new DbInsercao('ALUMNI_CADASTRO'))->select("CPF = '$this->cpf'")
        //     ->fetch(PDO::FETCH_ASSOC);

        // echo $dado['NOME'];
        // die();

        $obDatabase = new DbInsercao('ALUMNI_CADASTRO');

        $obDatabase->insert([
            'CPF' => $this->cpf,
            'NOME' => $this->nome,
            'ANO' => $this->ano,
            'CURSO' => $this->curso,
            'SENHA' => $this->senha,
            'EMAIL' => $this->email,
            'DATACADASTRO' => date("Y-m-d"),
            'PRECADASTRO' => 1,
            'PERFIL' => 1
        ]);
    }
}
