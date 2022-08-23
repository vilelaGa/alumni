<?php

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/app/Config.php";

$router = new Router(URL_BASE);

/**
 * Controllers
 */
$router->namespace("App\Controllers");


$router->group(null);

/**
 * Web
 * home
 */
$router->get("/", "Web:home");
$router->get("/contato", "Web:contato");
$router->get("/login", "Web:login");
$router->get("/cadastro", "Web:cadastro");
$router->get("/registro", "Web:registro");
$router->get("/coleta-analise", "Web:coletaAnalise");
$router->get("/logout", "Web:logout");
$router->get("/redefinir-senha", "Web:redefinir_senha");
$router->get("/redefinir-senha-token/{token}", "Web:redefinir_senha_token");


/**
 * Posts login/cadastro/registro 
 */
$router->post('/data/cadastro', 'Data:dataCadastro');
$router->post('/data/login', 'Data:dataLogin');
$router->post('/data/registro', 'Data:dataRegistro');
$router->post('/data/coleta-analise', 'Data:dataColetaAnalise');
$router->post('/data/att-cadastro', 'Data:dataAttCadastro');
$router->post('/data/cadastrar-noticia', 'Data:dataCadastrarNoticia');
$router->post('/data/cadastrar-conteudo', 'Data:dataCadastrarConteudo');
$router->post('/data/att-senha', 'Data:dataAttSenha');
$router->post('/data/valida-arquivo', 'Data:dataValidaCadastroArquivo');
$router->post('/data/redefinir-senha', 'Data:dataRedefinirSenha');
$router->post('/data/redefinir-senha-token', 'Data:dataRedefinirSenhaToken');


/**
 * Aluno
 * home
 */
$router->group("aluno");
$router->get("/", 'Aluno:home');
$router->get("/att-cadastro", 'Aluno:attCadastro');
$router->get("/perfil", 'Aluno:perfil');
$router->get("/att-senha", 'Aluno:attSenha');


/**
 * Coordenador
 * home
 */
$router->group("coordenador");
$router->get("/", 'Coordenador:home');
$router->get("/cadastrar-noticia", 'Coordenador:cadastrarNoticia');
$router->get("/perfil", 'Coordenador:perfil');
$router->get("/att-senha", 'Coordenador:attSenha');
$router->get("/att-contato", 'Coordenador:attContato');



/**
 * Admin
 * home
 */
$router->group("admin");
$router->get("/", 'Admin:home');
$router->get("/cadastrar-conteudo", 'Admin:cadastrarConteudo');
$router->get("/gestao", 'Admin:gestao');
$router->get("/perfil", 'Admin:perfil');
$router->get("/att-senha", 'Admin:attSenha');
$router->get("/att-contato", 'Admin:attContato');
$router->get("/valida-arquivo", 'Admin:validarCadastroExArquivo');



/**
 * Web
 * error
 */
$router->group("ops");
$router->get('/{errcode}', "Web:error");


//Execulta as rotas
$router->dispatch();


//Check erro na rota
if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
