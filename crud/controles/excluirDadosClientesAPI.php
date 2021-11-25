<?php
/***********************************************************************************
 * Objetivo: Arquivo responsável por receber o id do Cliente e excluir do BD
 * Data: 25/11/2021
 * Autor:Thiago Trentin
 */
//import do arquivo que vai excluir o BD
require_once(SRC.'bd/excluirCliente.php');

//função para excluir dados no BD via DELETE da API
function excluirClienteAPI($id) {
    //Fazer tratamento de dados para consistencia
    //...

    if (excluir($id)) {
        return true;
    }

    else {
        return false;
    }
}

?>