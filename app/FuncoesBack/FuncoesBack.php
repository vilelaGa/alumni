<?php

namespace App\FuncoesBack;

use App\DbInsercao\DbInsercao;
use App\CadastroExAluno\CadastroExAluno;
use App\CadastrarAnalise\CadastrarAnalise;
use App\EnviarEmail\EnviarEmail;
use App\MudarSenha\MudarSenha;
use App\AttCadastro\AttCadastro;
use App\Funcoes\Funcoes;
use App\ValidacaoCadastroArquivo\ValidacaoCadastroArquivo;
use PDO;

class FuncoesBack
{

    /**
     * Função criada para verificar se o cpf digitado no cadastro existe na base de dados da ubm
     * @param 1
     * @var int $cpf
     */
    public static function verificaCpfAluno($cpf)
    {

        $value = filter_var($cpf, FILTER_SANITIZE_ADD_SLASHES);

        $replace = str_replace(array('.', '-'), '', $value);

        $html = '<div class="alert alert-danger" role="alert">
                    CPF invalido
                </div>';

        $replace = strlen($replace) < 11 ? die($html) : $replace;

        //Verifica se o cpf ja foi cadastrado na plataforma alumni
        $consulta_ = (new DbInsercao('ALUMNI_CADASTRO'))->select("CPF = '$replace'");

        //Verifica se o cpf ja foi de algum aluno da ubm
        $consulta = (new DbInsercao())->selectValidaCpf($replace);


        if ($consulta_->rowCount() != -1) {

            if ($consulta->rowCount() != 0) {
                session_start();
                $_SESSION['cpf_valido'] = $replace;
                $url = URL_BASE;
                echo "<script>window.location = '$url/registro'</script>";
            } else {
                session_start();
                $_SESSION['cpf_analise'] = $replace;
                $url = URL_BASE;
                echo "<script>window.location = '$url/coleta-analise'</script>";
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                        CPF já cadastrado
                    </div>';
        }
    }


    /**
     * Função criada para verificar se os dados estão corretos para o insert
     * @param 1
     * @var array $data
     */
    public static function validaCadastroExAluno($data)
    {

        $celular = filter_var($data['celular'], FILTER_SANITIZE_ADD_SLASHES);
        $telefone =  filter_var($data['telefone'], FILTER_SANITIZE_ADD_SLASHES);
        $senha = filter_var($data['senha'], FILTER_SANITIZE_ADD_SLASHES);


        // VALIDAÇÃO CELULAR

        $celular = empty($celular) ? null : $celular;

        // VALIDAÇÃO CELULAR


        // VALIDAÇÃO TELEFONE

        $telefone = empty($telefone) ? null : $telefone;

        // VALIDAÇÃO TELEFONE


        // VALIDAÇÃO EMAIL

        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                           Email invalido
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $data['email'] : die($htmlteEmail);

        $emailDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("EMAIL = '$email'");


        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                            Email já cadastrado
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $email = $emailDb->rowCount() != 0 ? die($htmlteEmail) : $email;

        // VALIDAÇÃO EMAIL


        // VALIDAÇÃO SENHA

        $htmlSenha = '<div class="alert alert-danger" role="alert">
                            Minimo 8 caracteres
                        </div>

                        <style>
                            #senha{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $senha = strlen($senha) < 8 ? die($htmlSenha) : $senha;

        //SALTH
        $md5 = md5($senha . 'EKBALLO_UBM_3090*');
        // echo $md5;
        // die();
        // VALIDAÇÃO SENHA


        session_start();
        $cpf = $_SESSION['cpf_valido'];


        //VALIDAÇÃO CPF

        $cpfDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("CPF = '$cpf'");


        $htmlCpf = '<div class="alert alert-danger" role="alert">
                            CPF já cadastrado
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        if ($cpfDb->rowCount() != 0) { // FIM VALIDAÇÃO CPF
            echo $htmlCpf;
            $url = URL_BASE;
            echo "<script>window.location = '$url/'</script>";
            session_destroy();
        } else {

            //EFETUANDO O CADASTRO

            $cadastrar = new CadastroExAluno;
            $cadastrar->cpf = $cpf;
            $cadastrar->celular = $celular;
            $cadastrar->telefone = $telefone;
            $cadastrar->email = $email;
            $cadastrar->senha = $md5;
            $cadastrar->cadastrar();

            $url = URL_BASE;
            echo "
            <style>
            .cem{
                display: none;
            }
            </style>

            <script>window.location = '$url/login'</script>";
            //EFETUANDO O CADASTRO

            session_destroy();
        }
    }

    public static function analiseCadastroExAluno($data)
    {
        $nome = filter_var($data['nome'], FILTER_SANITIZE_ADD_SLASHES);
        $ano =  filter_var($data['ano'], FILTER_SANITIZE_ADD_SLASHES);
        $curso = filter_var($data['curso'], FILTER_SANITIZE_ADD_SLASHES);
        $senha = filter_var($data['senha'], FILTER_SANITIZE_ADD_SLASHES);

        //VALIDAÇÃO SENHA

        $htmlSenha = '<div class="alert alert-danger" role="alert">
                            Minimo 8 caracteres
                        </div>

                        <style>
                            #senha{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $senha = strlen($senha) < 8 ? die($htmlSenha) : $senha;

        //SALTH
        $md5 = md5($senha . 'EKBALLO_UBM_3090*');

        // VALIDAÇÃO SENHA

        //VALIDAÇÃO NOME

        $nome = strtoupper($nome);

        $htmlNome = '<div class="alert alert-danger" role="alert">
                        Nome obrigarotio
                    </div>

                    <style>
                        #nome{
                            border-color: #ff0909; 
                            color: #ff0909;
                        }
                    </style>
                    ';

        $nome = empty($nome) ? die($htmlNome) : $nome;

        //VALIDAÇÃO NOME


        //VALIDAÇÃO ANO

        $htmlAno = '<div class="alert alert-danger" role="alert">
                        Ano invalido
                    </div>

                    <style>
                        #ano{
                            border-color: #ff0909; 
                            color: #ff0909;
                        }
                    </style>
                    ';

        $ano = (strlen($ano) > 4) || ($ano < 1961) || ($ano > date('Y')) ? die($htmlAno) : $ano;

        //VALIDAÇÃO ANO


        //VALIDAÇÃO CURSO

        $htmlCurso = '<div class="alert alert-danger" role="alert">
                        Campo obrigatorio
                    </div>

                    <style>
                        #curso{
                            border-color: #ff0909; 
                            color: #ff0909;
                        }
                    </style>
                    ';

        $curso = empty($curso) ? die($htmlCurso) : $curso;

        //VALIDAÇÃO CURSO


        //VALIDAÇÃO EMAIL

        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                            Email invalido
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $data['email'] : die($htmlteEmail);

        $emailDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("EMAIL = '$email'");


        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                            Email já cadastrado
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $email = $emailDb->rowCount() != 0 ? die($htmlteEmail) : $email;

        //VALIDAÇÃO EMAIL


        session_start();
        $cpf = $_SESSION['cpf_analise'];

        //VALIDAÇÃO CPF

        $cpfDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("CPF = '$cpf'");


        $htmlCpf = '<div class="alert alert-danger" role="alert">
                            CPF já cadastrado
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        if ($cpfDb->rowCount() != 0) { // FIM VALIDAÇÃO CPF
            echo $htmlCpf;
            $url = URL_BASE;
            echo "<script>window.location = '$url/'</script>";
            session_destroy();
        } else {

            //EFETUANDO O CADASTRO

            $cadastrarAnalise = new CadastrarAnalise;
            $cadastrarAnalise->cpf = $cpf;
            $cadastrarAnalise->nome = $nome;
            $cadastrarAnalise->ano = $ano;
            $cadastrarAnalise->curso = $curso;
            $cadastrarAnalise->email = $email;
            $cadastrarAnalise->senha = $md5;
            $cadastrarAnalise->cadastrar();

            EnviarEmail::EnviarCadastroAnalise($email, $nome, $cpf);

            $url = URL_BASE;
            echo "
            <style>
            .cem{
                display: none;
            }
            </style>
            
            <script>window.location = '$url/'</script>
            
            
            ";

            session_destroy();

            //EFETUANDO O CADASTRO
        }
    }


    public static function login($data)
    {
        $cpf =  filter_var($data['cpf'], FILTER_SANITIZE_ADD_SLASHES);
        $replace = str_replace(array('.', '-'), '', $cpf);

        $senha = filter_var($data['senha'], FILTER_SANITIZE_ADD_SLASHES);

        //SALTH
        $md5 = md5($senha . 'EKBALLO_UBM_3090*');

        $login = (new DbInsercao('ALUMNI_CADASTRO'))->select("CPF = '$replace' AND SENHA = '$md5' AND PRECADASTRO = 0");

        if ($login->rowCount() != 0) {

            $dados = $login->fetch(PDO::FETCH_ASSOC);

            switch ($dados['PERFIL']) {
                case (1):
                    session_start();
                    $_SESSION['REGISTRO_ALUNO'] = $dados['REGISTRO'];
                    $url = URL_BASE;
                    echo "<script>window.location = '$url/aluno'</script>";
                    die();
                case (2):
                    session_start();
                    $_SESSION['REGISTRO_COORDENADOR'] = $dados['REGISTRO'];
                    $url = URL_BASE;
                    echo "<script>window.location = '$url/coordenador'</script>";
                    die();
                case (3):
                    session_start();
                    $_SESSION['REGISTRO_ADMIN'] = $dados['REGISTRO'];
                    $url = URL_BASE;
                    echo "<script>window.location = '$url/admin'</script>";
                    die();
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">
                        Credenciais incorretas
                    </div>
        ';
        }
    }

    //Não funciona ainda
    public static function cadastrarNoticiaCoordenador($data)
    {
        var_dump($data);
    }


    public static function attCadastro($data)
    {
        session_start();

        if (isset($_SESSION['REGISTRO_ALUNO'])) {
            $registro = $_SESSION['REGISTRO_ALUNO'];
        } else if (isset($_SESSION['REGISTRO_COORDENADOR'])) {
            $registro = $_SESSION['REGISTRO_COORDENADOR'];
        } else if (isset($_SESSION['REGISTRO_ADMIN'])) {
            $registro = $_SESSION['REGISTRO_ADMIN'];
        }

        $dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
            ->fetch(PDO::FETCH_ASSOC);

        $ip = filter_var($data['ip'], FILTER_VALIDATE_IP) ? $data['ip'] : $_SERVER['REMOTE_ADDR'];
        $celular = filter_var($data['celular'], FILTER_SANITIZE_ADD_SLASHES);
        $telefone = filter_var($data['telefone'], FILTER_SANITIZE_ADD_SLASHES);
        @$email = $data['email'];


        $celular = empty($celular) ? $dados['TELEFONE1'] : $celular;
        $telefone = empty($telefone) ? $dados['TELEFONE2'] : $telefone;
        // echo $dados['PERFIL'];
        // die();

        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                                         Email invalido aqui
                                     </div>
            
                                     <style>
                                         #email{
                                             border-color: #ff0909; 
                                             color: #ff0909;
                                         }
                                     </style>
                                     ';
        switch ($dados['PERFIL']) {
            case (1):
                $emailDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("EMAIL = '$email'");

                if (
                    $emailDb->rowCount() != 0
                ) {
                    echo $htmlteEmail;
                    die();
                } else {
                    $email = empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ? $dados['EMAIL'] : $email;

                    //EXECULTAR UP
                    $resposta = AttCadastro::atualizar($celular, $telefone, $email, $registro);

                    date_default_timezone_set('America/Sao_Paulo');

                    $date =  date('d/m/Y H:i:s', time());

                    EnviarEmail::envioAttCadastro($dados['EMAIL'], $dados['NOME'], $ip, $date);

                    echo $resposta;
                }
                die();
            case (2) || (3):
                //EXECULTAR UP
                $resposta = AttCadastro::atualizarCoorAdm($celular, $telefone, $registro);

                date_default_timezone_set('America/Sao_Paulo');

                $date =  date('d/m/Y H:i:s', time());

                EnviarEmail::envioAttCadastro($dados['EMAIL'], $dados['NOME'], $ip, $date);

                echo $resposta;
                die();
        }
    }


    public static function attSenha($data)
    {
        session_start();

        if (isset($_SESSION['REGISTRO_ALUNO'])) {
            $registro = $_SESSION['REGISTRO_ALUNO'];
        } else if (isset($_SESSION['REGISTRO_COORDENADOR'])) {
            $registro = $_SESSION['REGISTRO_COORDENADOR'];
        } else if (isset($_SESSION['REGISTRO_ADMIN'])) {
            $registro = $_SESSION['REGISTRO_ADMIN'];
        }


        $senha = filter_var($data['senha'], FILTER_SANITIZE_ADD_SLASHES);
        $ip = filter_var($data['ip'], FILTER_VALIDATE_IP) ? $data['ip'] : $_SERVER['REMOTE_ADDR'];


        $htmlSenha = '<div class="alert alert-danger" role="alert">
                        Minimo 8 caracteres
                    </div>

                    <style>
                        #senha{
                            border-color: #ff0909; 
                            color: #ff0909;
                        }
                    </style>
                        ';

        $senha = strlen($senha) < 8 ? die($htmlSenha) : $senha;

        //SALTH
        $md5 = md5($senha . 'EKBALLO_UBM_3090*');

        $dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
            ->fetch(PDO::FETCH_ASSOC);


        $att_senha = MudarSenha::atualizarSenha($md5, $registro);

        date_default_timezone_set('America/Sao_Paulo');

        $date =  date('d/m/Y H:i:s', time());

        EnviarEmail::envioTrocarSenha($dados['EMAIL'], $dados['CPF'], $senha, $dados['NOME'], $ip, $date);

        echo $att_senha;
    }


    public static function validaCadastroArquivo($data)
    {
        $url = URL_BASE;

        $registro = filter_var(base64_decode($data['REGISTRO']), FILTER_SANITIZE_ADD_SLASHES);

        $registro = empty($registro) ? header('Location:' . $url . '/admin/valida-arquivo') : $registro;

        $num_valida = filter_var(base64_decode($data['valida']), FILTER_SANITIZE_ADD_SLASHES);

        $num_valida = ($num_valida != 1) && ($num_valida != 2) ? header('Location:' . $url . '/admin/valida-arquivo') : $num_valida;


        switch ($num_valida) {
            case (1):
                ValidacaoCadastroArquivo::validaCadastroArquivo($registro);

                date_default_timezone_set('America/Sao_Paulo');

                $date =  date('d/m/Y H:i:s', time());

                $dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
                    ->fetch(PDO::FETCH_ASSOC);

                EnviarEmail::envioValidacaoCadastro($dados['EMAIL'], $dados['NOME'], $date);

                header('Location:' . $url . '/admin/valida-arquivo');
                die();
            case (2):
                ValidacaoCadastroArquivo::revogarCadastroArquivo($registro);


                date_default_timezone_set('America/Sao_Paulo');

                $date =  date('d/m/Y H:i:s', time());

                $dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("REGISTRO = '$registro'")
                    ->fetch(PDO::FETCH_ASSOC);

                EnviarEmail::envioRevogacaoCadastro($dados['EMAIL'], $dados['NOME'], $date);

                header('Location:' . $url . '/admin/valida-arquivo');
                die();
        }
    }


    public static function redefinirSenha($data)
    {
        // VALIDAÇÃO EMAIL

        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                            Email invalido
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $data['email'] : die($htmlteEmail);

        $emailDb = (new DbInsercao('ALUMNI_CADASTRO'))->select("EMAIL = '$email'");


        $htmlteEmail = '<div class="alert alert-danger" role="alert">
                            Este email não foi cadastrado
                        </div>

                        <style>
                            #email{
                                border-color: #ff0909; 
                                color: #ff0909;
                            }
                        </style>
                        ';

        $htmlteEmailVerde = '<div class="alert alert-success" role="alert">
                            Um link foi enviado no email
                            </div>

                            <style>
                                #email{
                                    border-color: #0f6848; 
                                    color: #0f6848;
                                }
                            </style>
                            ';



        if ($emailDb->rowCount() != -1) {
            die($htmlteEmail);
        } else {
            echo $htmlteEmailVerde;
            $dados = (new DbInsercao('ALUMNI_CADASTRO'))->select("EMAIL = '$email'")
                ->fetch(PDO::FETCH_ASSOC);

            $token = Funcoes::token();

            session_start();
            $_SESSION['tokenRedefinirSenha'] = $token;
            $_SESSION['emailtokenRedefinirSenha'] = $email;
            $_SESSION['horaCriacaoToken'] = time();

            // $hora_atual = time();

            // $tempo_online = $hora_atual - $_SESSION['hora_acesso'];

            // $tempo_online < 1200 ?: include("logout.php");

            EnviarEmail::envioRecuperarSenha($email, $dados['NOME'], $token);
        }


        // VALIDAÇÃO EMAIL


    }


    public static function trocarSenhaToken($data)
    {
        $senha = filter_var($data['senha'], FILTER_SANITIZE_ADD_SLASHES);


        $htmlSenha = '<div class="alert alert-danger" role="alert">
                        Minimo 8 caracteres
                    </div>

                    <style>
                        #senha{
                            border-color: #ff0909; 
                            color: #ff0909;
                        }
                    </style>
                        ';

        $senha = strlen($senha) < 8 ? die($htmlSenha) : $senha;

        //SALTH
        $md5 = md5($senha . 'EKBALLO_UBM_3090*');

        // echo $md5;

        $att_senha = MudarSenha::atualizarSenhaToken($md5);

        echo $att_senha;

        session_destroy();

        $url = URL_BASE;
        echo "<script>window.location = '$url/login'</script>";
    }
}
