<?php
    //Permisões e configurações para a API responder Em um srvidor real
    header('Acecess-Control-Allow-Origin: *');
    header('Acecess-Control-Allow-Method: GET,POST,PUT,DELETE,OPTIONS');
    header('Acecess-Control-Allow-Header: Content-Type');
    header('Content-Type: application/json');


    $url = (string) null;
    //cria um array na url com base na url até a pasta API guarda no indice 0 a primeira palavra após "/"
    $url = explode('/',$_GET['url']);
    //estrutura condicional para encaminhar a api conforme a escolha [clientes ou etsados]
    switch ($url[0]){
        
        case 'clientes';
        //import do arquivo de api de cliente
        require_once('clientesAPI/index.php');
        break;
        case 'estados';
        //import do arquivo de api de cliente
        require_once('clientesAPI/index.php');
        break;
    }
?>