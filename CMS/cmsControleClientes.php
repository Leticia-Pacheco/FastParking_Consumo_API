<?php
    require_once('../bd/conexaoMysql.php');

    require_once('../modulos/config.php');

    if(!$conex = conexaoMysql()){
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Controle de Clientes</title>
        
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCms.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <form name="frmControleClientes" method="get" action="cmsControleClientes">
            <div class="baseCms centerObject">
                <header>
                    <span>Controle de Clientes</span>

                    <a href="cms.php">
                        <figure>
                            <img src="imagens/inicio.png">
                        </figure>
                    </a>
                </header>

                <div class="menuCmsLateral">
                    <!--Menu ADM Preços-->
                    <a href="cmsAdmPrecos.php" target="chrome_blank">
                        <div class="submenusLaterais">
                            <figure>
                                <img src="imagens/admPrecos.png">
                            </figure>
                            <p>
                                Adm Preços
                            </p>
                        </div>
                    </a>

                    <!--Menu ADM Relatórios-->
                    <a href="cmsAdmRelatorios.php" target="chrome_blank">
                        <div class="submenusLaterais">
                            <figure>
                                <img src="imagens/admRelatorios.png">
                            </figure>
                            <p>
                                Adm Relatórios
                            </p>
                        </div>
                    </a>

                    <!--Menu Controle de Clientes-->
                    <a href="cmsControleClientes.php" target="chrome_blank">
                        <div class="submenusLaterais">
                            <figure>
                                <img src="imagens/controleClientes.png">
                            </figure>
                            <p>
                                Controle de clientes
                            </p>
                        </div>
                    </a>
                </div>

                <!--CONTEÚDO-->
                <div id="conteudoCmsPrincipal">
                    <table id="tblControleClientes">
                        <!--LINHA DOS TÍTULOS-->
                        <tr>
                            <td class="tituloControleClienteAzul">Nome do cliente</td>
                            <td class="tituloControleClienteAmarelo">Data de entrada</td>
                            <td class="tituloControleClienteAzul">Horário de entrada</td>
                            <td class="tituloControleClienteAmarelo">Data de saída</td>
                            <td class="tituloControleClienteAzul">Horário de saída</td>
                            <td class="tituloControleClienteAmarelo">Valor total</td>
                            <td class="tituloControleClienteAzul">Ações</td>
                        </tr>
                        
                        <!--LINHA DA CONSULTA-->
                        <tr id="consultaClientes">
                            <td class="conteudoAzul"></td>
                            <td class="conteudoAmarelo"></td>
                            <td class="conteudoAzul"></td>
                            <td class="conteudoAmarelo"></td>
                            <td class="conteudoAzul"></td>
                            <td class="conteudoAmarelo"></td>
                            <td class="conteudoAzul"></td>
                        </tr>
                    </table>
                </div>

                <!--Rodapé-->
                <footer>
                    <figure>
                        <img src="imagens/logoFastParking.gif">
                    </figure>
                </footer>
            </div>
        </form>
    </body>
</html>