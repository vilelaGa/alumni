<?php

namespace App\DbInsercao;

use PDOException;
use PDO;


class DbInsercao
{
    //Constantes de conexão com Db
    const SERVER = "";
    const DATABASE_NAME = "";
    const USER = "";
    const PASSWORD = "";

    //Variavel tabela
    private $tabela;


    /**
     * Conexão db
     * @var PDO
     */
    private $conexao;


    /**
     * Função define a tabela e instancia de conexão
     * 1 Parametro
     * @var string tabela
     */
    public function __construct($tabela = null)
    {
        $this->tabela = $tabela;
        $this->setConnection();
    }


    /**
     * Função que efetua a conexão com Db
     * OBS: CONEXÃO COM SQLSERVER Necessita de drives pdo_sqlsrv
     * Link donwload: https://docs.microsoft.com/pt-br/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver16
     * Link video instalação: https://www.youtube.com/watch?v=7spsRgc6AtE 
     */
    private function setConnection()
    {
        try {
            $this->conexao = new PDO('sqlsrv:Server=' . self::SERVER . '; Database=' . self::DATABASE_NAME,  self::USER, self::PASSWORD);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERRO DE CONEXÃO {$e->getMessage()}");
        }
    }


    /**
     * Função para execultar a query no Db
     * 2 Parametro 
     * @var string query
     * @var array parametros
     */
    public function exculte($values, $parametros = [])
    {
        try {
            $excQuery = $this->conexao->prepare($values);
            $excQuery->execute($parametros);
            return $excQuery;
        } catch (PDOException $e) {
            die("ERRO NA QUERY {$e->getMessage()}");
        }
    }


    /**
     * Função Insert no Db
     * 1 Parametro 
     * @var array values insert
     */
    public function insert($values)
    {
        $fields = array_keys($values);
        $binds =  array_pad([], count($fields), '?');

        $query = 'INSERT INTO ' . $this->tabela . '(' . implode(',', $fields) . ') VALUES(' . implode(',', $binds) . ')';

        // var_dump($query);
        // die();

        $this->exculte($query, array_values($values));

        // return $this->connection->lastInsertId();
    }


    /**
     * Função Select no Db
     * 1 Parametro 
     * @var string where
     */
    public function select($where = null)
    {
        $query = 'SELECT * FROM ' . $this->tabela . ' WHERE ' . $where;
        // var_dump($query);
        return $this->exculte($query);
    }

    /**
     * Função delete no Db
     * 1 Parametro 
     * @var string where
     */
    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->tabela . ' WHERE ' . $where;
        // var_dump($query);
        // die();
        return $this->exculte($query);
    }


    /**
     * Função Select no Db
     * 2 Parametro 
     * @var array values @var string where
     */
    public function update($where = null, $values)
    {
        $binds = array_keys($values);

        $query = 'UPDATE ' . $this->tabela . ' SET ' . implode('=?,', $binds) . '=? WHERE ' . $where;
        $this->exculte($query, array_values($values));
        // var_dump($query);
        // die();
        return true;
        // echo $query;
    }


    /**
     * Função Select que valida cpf
     * @param 1
     * @var int cpf
     */
    public function selectValidaCpf($cpf)
    {
        $query = "SELECT Aluno.CPF, Aluno.nome, ALuno.es_codigo, Aluno.cr_codigo, 'TerminalBM' Origem
        FROM ( SELECT codigo, nome, cr_codigo, CPF, sitcli, aass, es_codigo, sitfase FROM TerminalUBM_BM.dbo.Aluno (NOLOCK))Aluno INNER JOIN
             ( SELECT codigo, nome, '01' es_codigo  FROM TerminalUBM_BM.dbo.Curso (NOLOCK) )Curso ON Aluno.cr_codigo = Curso.codigo AND Aluno.es_codigo = Curso.es_codigo INNER JOIN
             ( SELECT *, '01' es_codigo FROM TerminalUBM_BM.DBO.rel_curxtipo) R ON ALUNO.cr_codigo = R.cur_codigo AND ALUNO.es_codigo = r.es_codigo
        WHERE Aluno.sitfase = 'Formando' AND Aluno.nome NOT LIKE 'FULANO%' AND Aluno.CPF ='" . $cpf . "' AND R.cur_tipo LIKE 'GRAD' /*AND Aluno.aass <= '20151'(Não utilizar)*/
               UNION ALL
        SELECT Aluno.CPF, Aluno.nome, Aluno.es_codigo, Aluno.cr_codigo, 'TerminalCIC' Origem
        FROM ( SELECT codigo, nome, cr_codigo, CPF, sitcli, aass, es_codigo, sitfase FROM TerminalUBM_CIC.dbo.Aluno (NOLOCK) )Aluno INNER JOIN
             ( SELECT codigo, nome, '02' es_codigo  FROM TerminalUBM_CIC.dbo.Curso (NOLOCK) )Curso ON Aluno.cr_codigo = Curso.codigo AND Aluno.es_codigo = Curso.es_codigo INNER JOIN
             ( SELECT *, '02' es_codigo FROM TerminalUBM_BM.DBO.rel_curxtipo) R ON ALUNO.cr_codigo = R.cur_codigo AND ALUNO.es_codigo =R.es_codigo
        WHERE Aluno.sitfase = 'Formando' AND Aluno.nome NOT LIKE 'FULANO%'  AND Aluno.CPF ='" . $cpf . "' AND R.cur_tipo LIKE 'GRAD' /*AND Aluno.aass <= '20151' (não utilizar)*/
               UNION ALL
        SELECT PPE.CPF COLLATE SQL_Latin1_General_CP850_CI_AI, PPE.NOME COLLATE SQL_Latin1_General_CP850_CI_AI, SHF.CODFILIAL,
                  SHF.CODCURSO COLLATE SQL_Latin1_General_CP850_CI_AI AS cr_codigo, 'RM' Origem
        FROM RM.CORPORERM.DBO.SMATRICPL          SMA INNER JOIN
             RM.CORPORERM.DBO.SALUNO             SAL ON SMA.CODCOLIGADA = SAL.CODCOLIGADA AND SMA.RA = SAL.RA INNER JOIN
             RM.CORPORERM.DBO.PPESSOA            PPE ON SAL.CODPESSOA = PPE.CODIGO INNER JOIN
             RM.CORPORERM.DBO.SHABILITACAOFILIAL SHF ON SMA.CODCOLIGADA = SHF.CODCOLIGADA AND SMA.IDHABILITACAOFILIAL = SHF.IDHABILITACAOFILIAL INNER JOIN
             RM.CORPORERM.DBO.SCURSO             SCU ON SHF.CODCOLIGADA = SCU.CODCOLIGADA AND SHF.CODCURSO = SCU.CODCURSO INNER JOIN
             RM.CORPORERM.DBO.SPLETIVO           SPL ON SMA.CODCOLIGADA = SPL.CODCOLIGADA AND SMA.IDPERLET = SPL.IDPERLET INNER JOIN
             (
                     SELECT SGR.CODCOLIGADA, SGR.CODCURSO, SGR.CODHABILITACAO, SGR.CODGRADE, SPE.CODPERIODO DURACAO
                FROM RM.CORPORERM.DBO.SGRADE SGR (NOLOCK) CROSS APPLY
                     (
                                   SELECT TOP 1 CODPERIODO
                        FROM RM.CORPORERM.DBO.SPERIODO SPE (NOLOCK)
                        WHERE SGR.CODCOLIGADA = SPE.CODCOLIGADA AND SGR.CODCURSO = SPE.CODCURSO AND SGR.CODHABILITACAO = SPE.CODHABILITACAO AND SGR.CODGRADE = SPE.CODGRADE
                        ORDER BY CODPERIODO DESC
                     )SPE
             )SGR ON SHF.CODCOLIGADA = SGR.CODCOLIGADA AND SHF.CODCURSO = SGR.CODCURSO AND SHF.CODHABILITACAO = SGR.CODHABILITACAO AND SHF.CODGRADE = SGR.CODGRADE
        WHERE PPE.nome NOT LIKE 'FULANO%' AND
             (SMA.CODSTATUS IN (18/*Graduação*/, 95 /*Pós-Graduação*/) OR
             (SPL.CODPERLET = '20182' AND SPL.CODTIPOCURSO = 1 AND SMA.PERIODO = SGR.DURACAO AND
              SMA.CODSTATUS IN (1, 8, 11, 12, 14, 15, 16, 54) AND CAST(CAST(GETDATE() AS DATE) AS DATETIME) <= CONVERT(DATETIME, '23/08/2018'/*Data Limite*/, 103)))
              AND PPE.CPF = '" . $cpf . "'  AND SHF.CODTIPOCURSO = 1 AND SPL.CODPERLET >= '20152'";
        return $this->exculte($query);
    }


    /**
     * Função Select nome nos Db tiat e tiatcic
     * 1 Parametro 
     * @var string cpf
     */
    public function selectNome($cpf)
    {
        $query = "
        SELECT * FROM (

            SELECT nome, CPF FROM TIAT.dbo.aluno 
        
        UNION ALL 
        
            SELECT nome, CPF FROM TIATCIC.dbo.aluno
        
        ) nomeAlunos 
        
        WHERE 
            CPF = '$cpf'";
        // var_dump($query);
        return $this->exculte($query);
    }


    /**
     * Função nome curso nos Db tiat e tiatcic
     * 1 Parametro 
     * @var string codigo
     */
    public function selectNomeCurso($codigo)
    {
        $query = "
        SELECT * FROM 
	
	    (

	    SELECT nome, codigo FROM TIAT.dbo.Curso 
		    UNION ALL 
	    SELECT nome, codigo FROM TIATCIC.dbo.Curso

	    ) codigo
	
	    WHERE codigo = '$codigo'";
        
        return $this->exculte($query);
    }
}
