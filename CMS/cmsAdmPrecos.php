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
        <title>Administração de Preços e horários</title>
        
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCms.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Roboto:wght@100&display=swap" rel="stylesheet">
    </head>
    <body>
        <form name="frmAdmPrecos" method="get" action="cmsAdmPrecos.php">
            <div class="baseCms centerObject">
                <header>
                    <span>Administração de Preços e horários</span>

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
                <div class="conteudoCms">
                    <form name="frmCadastroPrecos" method="get" action="../bd/admPrecos.php">
                        <div class="linhaDivsCadastro">
                            <div class="cadastrosPrecosHorarios">
                                <h5>Cadastro de preços</h5>

                                <div id="inserirPreco" class="centerObject">
                                    <div id="valorPorHora">
                                        <p>Valor</p>

                                        <input id="inserirValorPorHora" type="text" name="inserirValorPorHora" value="R$" placeholder="Valor" required>
                                    </div>

                                    <div id="tipoCobranca">
                                        <p>Tipo de cobrança</p>

                                        <input id="inserirTipoCobranca" type="text" name="inserirTantoDeHoras" value="" placeholder="Cobrança" required>
                                    </div>
                                </div>

                                <input id="cadastrarValorPorHora" type="submit" name="cadastrarValorPorHora" value="Cadastrar">
                            </div>
                            <div class="consultasPrecosHorarios">
                                <h5>Consulta de preços</h5>

                                <!--Linha dos títulos-->
                                <div class="consultaPreco">
                                    <p>Valor</p>
                                </div>

                                <div class="consultaHoraVal">
                                    <p>Tipo de cobrança</p>
                                </div>

                                <!--Linhas dos resultados-->
                                <div id="containerValor">
                                    <table id="table">
                                        <tr class="colunas">
                                            <td class="rsValor"></td>
                                            <td class="rsTipoCobranca"></td>
                                        </tr>    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--Rodapé-->
                <footer>
                    <figure>
                        <img src="imagens/logoFastParking.gif">
                    </figure>
                </footer>
            </div>
        </form>
        
        <script src="../js/scriptPreco.js"></script>
    </body>
</html>