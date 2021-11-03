<?php
    //Import do arquivo para buscar os dados do cliente
    require_once('controles/visualizarDadosClientes.php');
    
    //Recebe o id enviado pelo AJAX na pagina da index
    $id = $_GET['id'];
    
    //Chama a função para buscar no BD
    $dadosCliente = visualizarCliente($id);

    

?>

<html>
    <head>
        <title>Visualizar</title>
    </head>
    <body>
        <table>
            <tr>
                <td>Nome:</td>
                <td><?=$dadosCliente['nome']?></td>
            </tr>
            <tr>
                <td>Celular:</td>
                <td><?=$dadosCliente['celular']?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?=$dadosCliente['email']?></td>
            </tr>
        </table>
    </body>
</html>