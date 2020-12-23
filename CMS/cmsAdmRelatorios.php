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
        <title>Administração de Relatórios</title>
        
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCms.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <form name="frmAdmRelatorios" method="get" action="cmsAdmRelatorios.php">
            <div class="baseCms centerObject">
                <header>
                    <span>Administração de Relatórios</span>

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
                    <!--TABELA DE RENDIMENTO DIÁRIO-->
                    <h2>Diário</h2>
                    <table id="tblRendimentoDiario">
                        <tr>
                            <td class="camposConsulta">Cliente</td>
                            <td class="camposConsulta">Valor</td>
                        </tr>
                        <tr>
                            <td class="camposConsulta2"></td>
                            <td class="camposConsulta2"></td>
                        </tr>
                    </table>
                    
                    <!--TABELA DE RENDIMENTO MENSAL-->
                    <h2>Mensal</h2>
                    <table id="tblRendimentoMensal">
                        <tr>
                            <td class="camposConsulta">Cliente</td>
                            <td class="camposConsulta">Valor</td>
                        </tr>
                        <tr>
                            <td class="camposConsulta2"></td>
                            <td class="camposConsulta2"></td>
                        </tr>
                    </table>
                    
                    <!--TABELA DE RENDIMENTO ANUAL-->
                    <h2>Anual</h2>
                    <table id="tblRendimentoAnual">
                        <tr>
                            <td class="camposConsulta">Cliente</td>
                            <td class="camposConsulta">Valor</td>
                        </tr>
                        <tr>
                            <td class="camposConsulta2"></td>
                            <td class="camposConsulta2"></td>
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