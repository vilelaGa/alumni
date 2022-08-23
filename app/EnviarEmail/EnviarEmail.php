<?php

namespace App\EnviarEmail;

require __DIR__ . '../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Funcoes\Funcoes;
use App\GeoLocalizacao\GeoLocalizacao;


class EnviarEmail
{
    public static function EnviarCadastroAnalise($email, $nome, $cpf)
    {
        //Formatação do dados
        $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Verificação de existência em arquivos');
            $mail->Body    = utf8_decode("
            
            <html><head>
									<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
									<title>Untitled Document</title>
									<style type=\"text/css\">
										<!--
										.texto10 {
													font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
												}
										.texto12 {
													font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
												}
										-->
									</style>
									</head>
									<body>
									<p>Caro(a) <strong>$nome</strong>,</p>
									<p>Foi solicitada a verificação para existência de aluno no arquivo da instituição <a href='https://ubm.br'>UBM</a>.<br /><br />
									<strong>Dados do solicitante:</strong><br />
									CPF: $cpf <br />
									Nome: $nome  <br />
									Email: $email  <br />
									<br />
                                    Caso n&atilde;o tenha feito o pedido, desconsidere esse e-mail.<br/>
									<p>Atenciosamente,
									</p>
									<table border='0' cellspacing='5' class='texto10'>
									<tr>
									<td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
									 </font></strong><img style='width: 30%;' src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
									<hr noshade='noshade' />
									<font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
									</tr>
									<tr>
									<td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
									NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
									CAMPUS BARRA MANSA</strong><br />
									Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
									</tr>
									</table>
									</body>
									</html>
            
            ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }

    public static function envioTrocarSenha($email, $cpf, $senha, $nome, $ip, $data)
    {

        //GeoLocalizacao
        $cidade = GeoLocalizacao::coleta_ip($ip);

        //Formatação do dados
        $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Alteração de senha');
            $mail->Body    = utf8_decode("
    
            <html><head>
            <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
            <title>Untitled Document</title>
            <style type=\"text/css\">
                <!--
                .texto10 {
                            font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
                        }
                .texto12 {
                            font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
                        }
                -->
            </style>
            </head>
            <body>
            <p>Caro(a) <strong>$nome</strong>,</p>
            <p>Foi solicitada a troca de senha pelo nosso site <a href='http://sistema.ubm.br:8090/alumni/'>UBM Alumni</a>.<br /><br />
            <strong>Dados para acesso ao sistema:</strong><br /><br />
									Login: $cpf <br />
									Senha: $senha <br />
									<br />
            Caso n&atilde;o tenha feito o pedido para trocar a senha, desconsidere esse e-mail.<br/><br/>
            <strong>Informa&ccedil;&atilde;o do solicitante </strong><br/>
            <br>IP.: <b>$ip<br>
            </b>Data e Hora da Solicita&ccedil;&atilde;o.: <b>$data</b>
            </br>Localização.: <b>$cidade</b> </p>
            <p><strong>OBS.:</strong> Este e-mail &eacute; enviado automaticamente pelo sistema, por favor n&atilde;o responda. </p>
            <p>Atenciosamente,
            </p>
            <table border='0' cellspacing='5' class='texto10'>
            <tr>
            <td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
             </font></strong><img src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
            <hr noshade='noshade' />
            <font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
            </tr>
            <tr>
            <td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
            NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
            CAMPUS BARRA MANSA</strong><br />
            Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
            </tr>
            </table>
            </body>
            </html>
    ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }

    public static function envioAttCadastro($email, $nome, $ip, $data)
    {
        //GeoLocalizacao
        $cidade = GeoLocalizacao::coleta_ip($ip);

        //Formatação do dados
        // $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Alteração nas informações do perfil');
            $mail->Body    = utf8_decode("
            
                    <html><head>
                    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
                    <title>Untitled Document</title>
                    <style type=\"text/css\">
                        <!--
                        .texto10 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
                                }
                        .texto12 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
                                }
                        -->
                    </style>
                    </head>
                    <body>
                    <p>Caro(a) <strong>$nome</strong>,</p>
                    <p>Foi efetuada a atualização de dados no seu perfil <a href='http://sistema.ubm.br:8090/alumni/'>UBM Alumni</a>.<br /><br />
                    Caso n&atilde;o tenha feito o pedido, entre em contato com o núcleo de comunicação social.<br/><br/>
                    <strong>Informa&ccedil;&atilde;o do solicitante </strong><br/>
                    <br>IP.: <b>$ip<br>
                    </b>Data e Hora da Solicita&ccedil;&atilde;o.: <b>$data</b>
                    </br>Localização.: <b>$cidade</b> </p>
                    <p><strong>OBS.:</strong> Este e-mail &eacute; enviado automaticamente pelo sistema, por favor n&atilde;o responda. </p>
                    <p>Atenciosamente,
                    </p>
                    <table border='0' cellspacing='5' class='texto10'>
                    <tr>
                    <td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
                     </font></strong><img src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
                    <hr noshade='noshade' />
                    <font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
                    </tr>
                    <tr>
                    <td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
                    NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
                    CAMPUS BARRA MANSA</strong><br />
                    Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
                    </tr>
                    </table>
                    </body>
                    </html>
            ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }

    public static function envioValidacaoCadastro($email, $nome, $data)
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        //GeoLocalizacao
        $cidade = GeoLocalizacao::coleta_ip($ip);

        //Formatação do dados
        // $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Alteração nas informações do perfil');
            $mail->Body    = utf8_decode("
            
                    <html><head>
                    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
                    <title>Untitled Document</title>
                    <style type=\"text/css\">
                        <!--
                        .texto10 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
                                }
                        .texto12 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
                                }
                        -->
                    </style>
                    </head>
                    <body>
                    <p>Caro(a) <strong>$nome</strong>,</p>
                    <p>Sua solicitação de cadastro na base <a href='http://sistema.ubm.br:8090/alumni/'>UBM Alumni</a> foi aceita com sucesso.<br /><br />
                    Caso n&atilde;o tenha feito o pedido, entre em contato com o núcleo de comunicação social.<br/><br/>
                    <strong>Informa&ccedil;&atilde;o do solicitante </strong><br/>
                    <br>IP.: <b>$ip<br>
                    </b>Data e Hora da Solicita&ccedil;&atilde;o.: <b>$data</b>
                    </br>Localização.: <b>$cidade</b> </p>
                    <p><strong>OBS.:</strong> Este e-mail &eacute; enviado automaticamente pelo sistema, por favor n&atilde;o responda. </p>
                    <p>Atenciosamente,
                    </p>
                    <table border='0' cellspacing='5' class='texto10'>
                    <tr>
                    <td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
                     </font></strong><img src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
                    <hr noshade='noshade' />
                    <font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
                    </tr>
                    <tr>
                    <td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
                    NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
                    CAMPUS BARRA MANSA</strong><br />
                    Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
                    </tr>9
                    </table>
                    </body>
                    </html>
            ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }

    public static function envioRevogacaoCadastro($email, $nome, $data)
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        //GeoLocalizacao
        $cidade = GeoLocalizacao::coleta_ip($ip);

        //Formatação do dados
        // $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Alteração nas informações do perfil');
            $mail->Body    = utf8_decode("
            
                    <html><head>
                    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
                    <title>Untitled Document</title>
                    <style type=\"text/css\">
                        <!--
                        .texto10 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
                                }
                        .texto12 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
                                }
                        -->
                    </style>
                    </head>
                    <body>
                    <p>Caro(a) <strong>$nome</strong>,</p>
                    <p>Seu pedido foi revogado, nenhum dado foi encontrado nos arquivos da <a href='https://ubm.br'>UBM</a>.<br /><br />
                    Caso n&atilde;o tenha feito o pedido, entre em contato com o núcleo de comunicação social.<br/><br/>
                    <strong>Informa&ccedil;&atilde;o do solicitante </strong><br/>
                    <br>IP.: <b>$ip<br>
                    </b>Data e Hora da Solicita&ccedil;&atilde;o.: <b>$data</b>
                    </br>Localização.: <b>$cidade</b> </p>
                    <p><strong>OBS.:</strong> Este e-mail &eacute; enviado automaticamente pelo sistema, por favor n&atilde;o responda. </p>
                    <p>Atenciosamente,
                    </p>
                    <table border='0' cellspacing='5' class='texto10'>
                    <tr>
                    <td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
                     </font></strong><img src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
                    <hr noshade='noshade' />
                    <font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
                    </tr>
                    <tr>
                    <td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
                    NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
                    CAMPUS BARRA MANSA</strong><br />
                    Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
                    </tr>
                    </table>
                    </body>
                    </html>
            ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }

    public static function envioRecuperarSenha($email, $nome, $token)
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        //GeoLocalizacao
        $cidade = GeoLocalizacao::coleta_ip($ip);

        //Formatação do dados
        // $cpf = Funcoes::mask($cpf, '###.###.###-##');
        $nome = strtolower($nome);
        $nome = ucwords($nome);


        // Instância da classe
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();        //Devine o uso de SMTP no envio
            $mail->SMTPAuth   = true; //Habilita a autenticação SMTP
            $mail->Username   = EMAIL;
            $mail->Password   = SENHA_EMAIL;
            // Criptografia do envio SSL também é aceito
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Informações específicadas pelo Google
            $mail->Host = 'smtp.office365.com';
            $mail->Port = 587;
            // Define o remetente
            $mail->setFrom(EMAIL, 'Equipe Alumni UBM');
            $mail->addReplyTo(EMAIL, 'Equipe Alumni UBM');
            // Define o destinatário
            $mail->addAddress($email);
            // Conteúdo da mensagem
            $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
            $mail->Subject = utf8_decode('Alteração nas informações do perfil');
            $mail->Body    = utf8_decode("
            
                    <html><head>
                    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1\' />
                    <title>Untitled Document</title>
                    <style type=\"text/css\">
                        <!--
                        .texto10 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;
                                }
                        .texto12 {
                                    font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px;
                                }
                        -->
                    </style>
                    </head>
                    <body>
                    <p>Caro(a) <strong>$nome</strong>,</p>
                    <p>Você solicitou um link para troca de senha.<br /><br />
                    Caso n&atilde;o tenha feito o pedido, entre em contato com o núcleo de comunicação social.<br/><br/>
                    <strong>Link:</strong><br/>
                    
                    <a href='http://sistema.ubm.br:8090/alumni/redefinir-senha-token/$token' target='_blank'>http://sistema.ubm.br:8090/alumni/redefinir-senha-token/$token</a>
                    
                    <p><strong>OBS.:</strong> Este e-mail &eacute; enviado automaticamente pelo sistema, por favor n&atilde;o responda. </p>
                    <p>Atenciosamente,
                    </p>
                    <table border='0' cellspacing='5' class='texto10'>
                    <tr>
                    <td><strong><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><br />
                     </font></strong><img src='http://sistema.ubm.br:8090/alumni/views/assets_interno/img/logo.png'></img>
                    <hr noshade='noshade' />
                    <font size='1'><span class='texto12'><font size='2' face='Verdana, Arial, Helvetica, sans-serif'><strong>UBM Alumni</strong></font></span></font></td>
                    </tr>
                    <tr>
                    <td height='62' nowrap='nowrap'><p><a href='mailto:ouvidoria@ubm.br'><strong><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>ouvidoria@ubm.br</font></strong></a><font size='1' face='Verdana, Arial, Helvetica, sans-serif'><strong><br />
                    NCS - N&uacute;cleo de Comunica&ccedil;&atilde;o Social<br />
                    CAMPUS BARRA MANSA</strong><br />
                    Centro Universit&aacute;rio de Barra Mansa - UBM - <strong><a href='http://www.ubm.br'>www.ubm.br</a>	</strong></font></p></td>
                    </tr>
                    </table>
                    </body>
                    </html>
            ");
            $mail->AltBody = utf8_decode('Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML');
            // Enviar
            $mail->send();
            // echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error";
        }
    }
}
