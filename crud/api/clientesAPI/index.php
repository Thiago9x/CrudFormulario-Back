<?php // import para o start do slim php 
require_once("vendor/autoload.php");
// import do arquivo de configuração do sistema
require_once("../functions/config.php");
//import o arquivo que solicita das requisições de busca no BD
require_once("../controles/exibeDadosClientes.php");

// Instancia da classe Slim\App é realizado para termos acesso aos metodos da classe 
$app=new \Slim\App();

// EndPoint é um ponto de parada para a API,ou seja, serão as formas de requisição que a API irá responder 

// reuqest sera usado para peegar algo que vai enviado para a API
// responde será utilizado para quando a API irá devolver algo,seja uma mensagem,status,body ,header 
// args serão os argumentos que podem ser encamiinhados para a API

// EndPoint GET retorna todos os dados de clientes
$app->get('/clientes', function($request, $response, $args) {

        //  Chama a função na pasta Controles que vai requisitar os dados no BD
        if($listDados=exibirClientes()) {
            if($listDadosArray=criarArray($listDados)) {
                $listDadosJSON=criarJson($listDadosArray);
            }
        }

        if($listDadosArray) {
            return $response ->withStatus(200) ->withHeader('Content-Type', 'application/json/xml') ->write($listDadosJSON);
        }

        else {
            return $response ->withStatus(204);
        }

    }

);

// EndPoint GET retorna um cliente pelo id
$app->get('/clientes/{id}', function($request, $response, $args) {
        //Recebe o id que sera encaminhado na url
        $id=$args['id'];

        //  Chama a função na pasta Controles que vai requisitar os dados no BD
        if($listDados=buscarClientes($id)) {
            if($listDadosArray=criarArray($listDados)) {
                $listDadosJSON=criarJson($listDadosArray);
            }
        }

        if($listDadosArray) {
            return $response ->withStatus(200) ->withHeader('Content-Type', 'application/json/xml') ->write($listDadosJSON);
        }

        else {
            return $response ->withStatus(204);
        }

    }

);

// EndPoint POST envia um novo cliente para o BD 
$app->post('/clientes', function($request, $response, $args) {
        //recebe o content type do header, para verificar se o padrão do body será json
        $contentType=$request ->getHeaderLine('Content-Type');

        //Valida se o tipo de dados é json
        if($contentType=='application/json') {
            //recebe o conteudo enviado no body da mensagem
            $dadosBodyJSON=$request->getParsedBody();

            //Valida se o corpo do body está vazio
            if ($dadosBodyJSON==""|| $dadosBodyJSON==null) {
                return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Conteúdo enviado pelo body não contém dados"}');
            }

            else {
                //import que vai encaminhar os dados para o BD
                require_once(SRC.'controles/recebeDadosClientesAPI.php');

                //Envia os dados para o BD e valida se foi inserido com sucesso
                if(inserirClienteAPI($dadosBodyJSON)) {
                    return $response ->withStatus(201) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Item criado com sucesso"}');
                }

                else {  
                    return $response ->withStatus(400) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Não foi possível salvar os dados por favor conferir o body da mensagem"}');
                
                }
            }
        }

        else {
            return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":Formato de dados do Header incompátivel com o JSON"}');
        }

    }

);

// EndPoint PUT autaliza um cliente do BD 
$app->put('/clientes/{id}', function($request, $response, $args) {
        //recebe o content type do header, para verificar se o padrão do body será json
        $contentType=$request ->getHeaderLine('Content-Type');
        
        //Recebe o id que será enviado pela URL
        $id = $args['id'];
        //Valida se o tipo de dados é json
        if($contentType=='application/json') {
            //recebe o conteudo enviado no body da mensagem
            $dadosBodyJSON=$request->getParsedBody();

            //Valida se o corpo do body está vazio
            if ($dadosBodyJSON==""|| $dadosBodyJSON==null || !isset($args['id']) || !is_numeric($args['id']) ) {
                return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Conteúdo enviado pelo body não contém dados"}');
            }

            else {
                //import que vai encaminhar os dados para o BD
                require_once(SRC.'controles/recebeDadosClientesAPI.php');

                //Edita os dados para o BD e valida se foi inserido com sucesso
                if(atualizarClienteAPI($dadosBodyJSON, $id)) {
                    return $response ->withStatus(200) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Item atualizado com sucesso"}');
                }

                else {  
                    return $response ->withStatus(400) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Não foi possível salvar os dados por favor conferir o body da mensagem"}');
                
                }
            }
        }

        else {
            return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":Formato de dados do Header incompátivel com o JSON"}');
        }

    }

);

// EndPoint DELETE exclui um cliente do BD 
$app->delete('/clientes/{id}', function($request, $response, $args) {
         //recebe o content type do header, para verificar se o padrão do body será json
         $contentType=$request ->getHeaderLine('Content-Type');

         //Valida se o tipo de dados é json
         if($contentType=='application/json') {
             //Valida se o corpo do body está vazio
             if  (!isset($args['id']) || !is_numeric($args['id'])) {
                 return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Não foi encaminhado um ID válido do registro"}');
             }
 
             else {
                 //import que vai encaminhar os dados para o BD
                require_once(SRC.'controles/excluirDadosClientesAPI.php');
                
                 $id = $args['id'];
                 //Envia os dados para o BD e valida se foi inserido com sucesso
                 if(excluirClienteAPI($id)) {
                     return $response ->withStatus(200) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Item excluido com sucesso"}');
                 }
 
                 else {  
                     return $response ->withStatus(400) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":"Não foi possível excluir os dados por favor conferir o body da mensagem"}');
                 
                 }
             }
         }
 
         else {
             return $response ->withStatus(406) ->withHeader('Content-Type', 'application/json/xml') ->write('{"message":Formato de dados do Header incompátivel com o JSON"}');
         }
 
     }

);

// carrega todos os end points para execução 
$app ->run();
?>