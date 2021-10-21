<?php
    // import do arquivo para buscar os dados do cliente 
    require_once('controles/visualizarDadosClientes.php');
//    Recebe o id enviado pelo ajax na pagina da index.php 
    $id = $_GET['id'];
    // Chama a função para buscar no BD 
    $dadosClientes = visualizarCliente($id);
    // var_dump($dadosClientes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar</title>
</head>
<body>
    <table>
        <tr>
            <td>Nome:</td>
            <td><?=$dadosClientes['nome']?></td>
        </tr>
        <tr>
            <td>Celular:</td>
            <td><?=$dadosClientes['celular']?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?=$dadosClientes['email']?></td>
        </tr>
    </table>
</body>
</html>
