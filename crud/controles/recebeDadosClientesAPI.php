<?php
/***********************************************************************************
 * Objetivo: Arquivo responsável por receber dados da API (POST ou PUT)
 * Data: 24/11/2021
 * Autor:Thiago Trentin
 */
//import do arquivo de configuração
require_once('../functions/config.php');
//import do arquivo que vai inserir no BD
require_once(SRC.'bd/inserirCliente.php');
//import do arquivo que vai editar o BD
require_once(SRC.'bd/atualizarCliente.php');


//função para inserir dados no BD via POST da API
function inserirClienteAPI($arrayDados) {
    //Fazer tratamento de dados para consistencia
    //...

    if (inserir($arrayDados)) {
        return true;
    }

    else {
        return false;
    }
}

//função para atualizar dados no BD via PUT da API
function atualizarClienteAPI($arrayDados, $id) {
    //cria um novo array apenas com o id
    $novoItem = array("id" => $id);

    //acresenta o array do novo item no arrayDados, fazendo uma mescra de chaves
    $arrayCliente = $arrayDados + $novoItem;
    
    
    //Fazer tratamento de dados para consistencia
    //...

    if (editar($arrayCliente)) {
        return true;
    }

    else {
        return false;
    }
}
?>