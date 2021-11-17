<?php
// import para o start do slim php 
    require_once("vendor/autoload.php");
// import do arquivo de configuração do sistema
    require_once("../functions/config.php");
    
    // Instancia da classe Slim\App é realizado para termos acesso aos metodos da classe 
    $app = new \Slim\App();

    // EndPoint é um ponto de parada para a API,ou seja, serão as formas de requisição que a API irá responder 
    
    // reuqest sera usado para peegar algo que vai enviado para a API
    // responde será utilizado para quando a API irá devolver algo,seja uma mensagem,status,body ,header 
    // args serão os argumentos que podem ser encamiinhados para a API

    // EndPoint GET retorna todos os dados de clientes
    $app->get('/clientes',function($request,$response,$args){
    return $response    ->withStatus(200)
                        ->withHeader('Content-Type','application/json/xml')
                        ->write('{"message":"Requisição com sucesso"}');
    });
    // EndPoint POST envia um novo cliente para o BD 
    $app->post('/clientes',function($request,$response,$args){
    return $response    ->withStatus(201)
                        ->withHeader('Content-Type','application/json/xml')
                        ->write('{"message":"Item criado com sucesso"}');
    });
    // EndPoint PUT autaliza um cliente do BD 
    $app->put('/clientes',function($request,$response,$args){
    return $response    ->withStatus(201)
                        ->withHeader('Content-Type','application/json/xml')
                        ->write('{"message":"Atualizado com sucesso"}');
    });
    // EndPoint DELETE exclui um cliente do BD 
    $app->delete('/clientes',function($request,$response,$args){
    return $response    ->withStatus(200)
                        ->withHeader('Content-Type','application/json/xml')
                        ->write('{"message":"Item excluido com sucesso"}');
    });

    // carrega todos os end points para execução 
    $app -> run();
?>