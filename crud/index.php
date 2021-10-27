<?php 
//verifica a existencia da variavel sessão que usamos para trazer os dados pqra o editar
session_start();

    $nome = (string) null;

    $telefone = (string) null;
    $celular = (string) null;
    $rg = (string) null;
    $cpf = (string) null;
    $email = (string) null;
    $obs = (string) null;
    $idEstado = (int) null;
    $sigla = (string)"Selecione um item";
    $id = (int) 0;
    //essa variavel será utilizada para definir o modo de manipulação com BD
    
    $modo = (string) "Salvar";
    
    //import do arquivo de configuração de variaveis e constantes
    require_once('functions/config.php');

    require_once(SRC."controles/exibirDadosClientes.php");
    // import do arquivo que lista todos os estados do BD 
    require_once(SRC."controles/listarDadosEstados.php");

    // require_once(SRC.'bd/conexaoMysql.php');
    // conexaoMysql();

    
    // var_dump($_SESSION["cliente"]);
    
    if(isset($_SESSION['cliente']))
    {

        $id = $_SESSION['cliente']['idclient'];
        $nome = $_SESSION['cliente']['nome'];
        $idEstado = $_SESSION['cliente']['idEstado'];
        $sigla = $_SESSION['cliente']['sigla'];
        $telefone = $_SESSION['cliente']['telefone'];
        $celular = $_SESSION['cliente']['celular'];
        $email = $_SESSION['cliente']['email'];
        $cpf = $_SESSION['cliente']['cpf'];
        $rg = $_SESSION['cliente']['rg'];
        $obs = $_SESSION['cliente']['obs'];
        $modo = (string) "Atualizar";

        unset($_SESSION['cliente']);
    }

?>

<!DOCTYPE>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title> Cadastro </title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $('#containerModal').css('display', 'none');
            // abre a modals 
            $('.pesquisar').click(function () {
                $('#containerModal').slideToggle(1000);
                // Recebe id do cliente 
                let idCliente = $(this).data('id');
                // Realiza uma requisição para consumir dados de outra pagina 
                $.ajax({
                    type: "GET", // Tipo de requisição (GET,POST,PUT, etc)
                    url: "visualizarDados.php", //URL da pagina que será consumido
                    data: {
                        id: idCliente
                    },
                    success: function (
                    dados) { //Se a requisição der certo iremos receb o conteudo na vairavel dados
                        $('#modal').html(dados); //exibi dentro da div modal
                    }
                });
            });
            $('#fecharModal').click(function () {
                $('#containerModal').fadeOut();
            });
        });
    </script>
</head>

<body>
    <div id="containerModal">
        <span id="fecharModal">Fechar</span>
        <div id="modal">

        </div>
    </div>
    <div id="cadastro">
        <div id="cadastroTitulo">
            <h1> Cadastro de Contatos </h1>
        </div>
        <div id="cadastroInformacoes">
            <!-- 
                    Principais elementos de formulário para HTML5
                    <input type = "tel"> indica que a caixa recebe um telefone
                    <input type = "email"> indica que a caixa recebe um email com o minimo necessário para ser um email (@)
                    <input type = "url"> indica que a caixa recebe uma URL válida (http://)
                    <input type = "number"> indica que a caixa recebe apenas numeros inteiros
                    <input type = "range"> cria um elemento tipo barra de rolagem horizontal
                    <input type = "color"> cria uma paleta de cor para escolha do usuário
                    <input type = "date"> Cria um calendário para escolha da data
                    <input type = "month"> Cria um calendário para escolha somente do mes e ano
                    <input type = "week"> Cria um calendário que retorna o numero da semana do ano

                -->

            <!-- as variaveis modo e id que foram utilizadas no action form, são responsssaveis por encaminha para a pagina recebedados.php duas informações: modo que é reponsavel por definir se é par inserir ou atualizar e o id que é reponsavel por identifica um regitro que vai atualizar no BD -->
            <form action="controles/recebeDadosClientes.php?modo=<?=$modo?>&id=<?=$id?>" name="frmCadastro"
                method="post">

                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Nome: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Digite seu Nome"
                            maxlength="100">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Estado: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <select name="sltEstado" id="">
                        <option value="<?=$idEstado?>">
                            <?=$sigla?>
                        </option>
                            <?php
                            // chama a função que vai buscar todos os estados do banco 
                                $listarEstados = exibirEstados();
                                // repetição para exibir os dados do BD 
                                while ($rsEstados = mysqli_fetch_assoc($listarEstados))
                                {
                                    ?>
                            <option value="<?=$rsEstados['idEstado']?>"><?=$rsEstados['sigla']?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Telefone: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="tel" name="txtTelefone" value="<?=$telefone?>">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Celular: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="tel" name="txtCelular" value="<?=$celular?>">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> RG: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="text" name="txtRg" value="<?=$rg?>" maxlength="20">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> CPF: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="text" name="txtCpf" value="<?=$cpf?>" maxlength="20">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Email: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="email" name="txtEmail" value="<?=$email?>">
                    </div>
                </div>
                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Observações: </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <textarea name="txtObs" cols="50" rows="7"><?=$obs?></textarea>
                    </div>
                </div>
                <div class="enviar">
                    <div class="enviar">
                        <input type="submit" name="btnEnviar" value="<?=$modo?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="consultaDeDados">
        <table id="tblConsulta">
            <tr>
                <td id="tblTitulo" colspan="5">
                    <h1> Consulta de Dados.</h1>
                </td>
            </tr>
            <tr id="tblLinhas">
                <td class="tblColunas destaque"> Nome </td>
                <td class="tblColunas destaque"> Celular </td>
                <td class="tblColunas destaque"> Email </td>
                <td class="tblColunas destaque"> Opções </td>
            </tr>

            <?php 

                    $dadosClientes = exibirClientes();
                    
                    while($rsClientes = mysqli_fetch_assoc($dadosClientes))
                    {
                    

                ?>
            <tr id="tblLinhas">
                <td class="tblColunas registros"><?=$rsClientes['nome']?></td>
                <td class="tblColunas registros"><?=$rsClientes['telefone']?></td>
                <td class="tblColunas registros"><?=$rsClientes['email']?></td>
                <td class="tblColunas registros">
                    <a href="controles/editarDadosClientes.php?id=<?=$rsClientes['idclient']?>"><img src="img/edit.png"
                            alt="Editar" title="Editar" class="editar"></a>


                    <a onclick="return confirm('Tem certeza que deseja excluir o registro?');"
                        href="controles/excluirDadosClientes.php?id=<?=$rsClientes['idclient']?>">
                        <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                    </a>

                    <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar"
                        data-id='<?=$rsClientes['idclient']?>'>
                </td>
            </tr>
            <?php 
                    }
                ?>
        </table>
    </div>
</body>

</html>