<?php
    /*********************************************
    Objetivo: Arquivo para fazer upload de imagens
    Data: 03/11/2021
    Autor: Marcel
*********************************************/
    // Função para fazer upload de arquivos
    function uploadFile($arrayFile)
    {
        $fotoFile = $arrayFile;
        $tamanhoOriginal = (int) 0;
        $tamanhoKB = (int) 0;
        $extensao = (string) null;
        $tipoArquivo = (string) null; 
        $nomeArquivo = (string) null;
        $nomeArquivoCript = (string) null;
        // Valida se o arquivo existe no array 
        IF($fotoFile['size'] >0 && $fotoFile['type'] != "")
        {
            // recebe o tamanho original do arquivo em byte 
            $tamanhoOriginal = $fotoFile['size'];

            // converte o tamanho original em KBytes
            $tamanhoKB = $tamanhoOriginal/1024;

            // recebe a extensao original do arquivo 
            $tipoArquivo = $fotoFile['type'];

            // VALIDA SE O TAMANHO DO ARQUIVO É MENOR DO QUE O PERMITIDO
            if($tamanhoKB <= TAMANHO_FILE){
                // Validação para percorrer o array de extensoes permitidas buscando a extensao do arquivo atua se encontra retorna true 
                if(in_array($tipoArquivo, EXTENSOES_PERMITIDAS)){
                        // PERMITE EXTRAIR APENAS O NOME DE UM ARQUIVO SEM A EXTENSAO
                        $nomeArquivo = pathinfo($fotoFile['name'],PATHINFO_FILENAME);
                        // PERMITE EXTRAIR APENAS A EXTENSAO DE UM ARQUIVO SEM O NOME
                        $extensao = pathinfo($fotoFile['name'],PATHINFO_EXTENSION);

                        $nomeArquivoCript = sha1($nomeArquivo);
                        echo ($nomeArquivoCript);
                        die;
                        
                        // die;
                }
                else
                    echo('Erro tipo de arquivo');
            }
            else{
                echo('Erro tamanho do arquivo');
            }
        }
        die;//serve para parar a execução do código do apache
    }

?>