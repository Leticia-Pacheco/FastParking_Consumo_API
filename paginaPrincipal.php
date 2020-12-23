<?php
    require_once('bd/conexaoMysql.php');

    require_once('modulos/config.php');

    $action = "bd/inserirCadastro.php";

    if(!$conex = conexaoMysql()){
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."') </script>");
        die;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>FastParking</title>
    <link rel="stylesheet" type="text/css" href="css/stylePaginaPrincipal.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <script src="js/jquery.js"></script>
    
    <script>
            $(document).ready(function(){
                
                //Function para carregar a Modal
                $(".login").click(function(){
                   $("#modalContainer").fadeIn(1500);
                });
                
                
                
            });
            
            //Function para carregar o visualizar Contato na modal
            function loginModal(id)
            {

                $.ajax({
                    type: "POST",
                    url: "loginUsuarioModal.php",
                    success: function(dados){
                        $("#modal").html(dados);
                    }
                    
                }); 
                
            }
        
        </script>
</head>
<body>
    <div id="modalContainer">
            <div id="modal">
                
            </div>
        </div>
    <div id="principal">
        <header>
            <div id="containerHeader" class="centerObject">  
                <div class="logoFastParking">
                    <img src="imagens/log_fast.png" alt="Logo" title="Logo" class="logo">
                </div>
                <div class="login">
                    <img src="imagens/login.png" alt="Login" title="Login" class="login" onclick="loginModal(id)">
                </div>
            </div>
        </header>
        <div id="conteudo">
            <div id="containerConteudo" class="centerObject">  
                <div id="calcularPreco">
                    <div id="formularioCalcularPreco">
                        <form name="frmCalcularPreco" method="post" action="">
                            <div id="local">
                                <div class="cadastroInformacoes">
                                    <p> Local: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <select name="sltEstados"> 
                                        <option value=""> - AEROPORTO - </option>
                                    </select>
                                </div>    
                            </div>
                            
                            <div id="editCheckInOut">  
                                <div id="checkIn">
                                    <div class="cadastroInformacoes">
                                        <p> Check-in: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="date" name="txtCheckIn" value="">
                                    </div>   

                                    <div id="horarioCheckIn">
                                        <div class="cadastroInformacoes">
                                            <p> Horário: </p>
                                        </div>
                                        <div class="cadastroEntradaDeDados">
                                            <input class="inputTime"  type="time" name="txtHorarioCheckIn" value="" placeholder="00:00">
                                        </div>    
                                    </div>
                                </div>
                                <div id="checkOut">
                                    <div class="cadastroInformacoes">
                                        <p> Check-out: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                        <input type="date" name="txtCheckOut" value="">
                                    </div>    

                                    <div id="horarioCheckOut">
                                        <div class="cadastroInformacoes">
                                            <p> Horário: </p>
                                        </div>
                                        <div class="cadastroEntradaDeDados">
                                            <input class="inputTime" type="time" name="txtHorarioCheckOut" value="" placeholder="00:00">
                                        </div>    
                                    </div>
                                </div>
                            </div>
                            
                            <input id="botaoCalcularPreco" type="submit" name="botaoCadastro" value="CALCULAR PREÇO">
                        </form>
                    </div>
                </div>
                <div id="cadastroCliente">
                    <div id="formularioCadastroCliente">
                        <form name="frmCadastroCliente" method="post" action="bd/inserirCadastro.php">
                            <div id="nomeCliente">
                                <div class="cadastroInformacoes">
                                    <p> Nome do Cliente: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="cliente" class="inputCadastroCliente" type="text" name="txtNomeCliente" value="">
                                </div>    
                            </div>
                            <div id="placaCarro">
                                <div class="cadastroInformacoes">
                                    <p> Placa do carro: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="placa" class="inputCadastroCliente" type="text" name="txtPlacaCarro" value="">
                                </div>    
                            </div>
                            <div id="modeloCarro">
                                <div class="cadastroInformacoes">
                                    <p> Modelo do carro: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="modelo" class="inputCadastroCliente" type="text" name="txtModeloCarro" value="">
                                </div>    
                            </div>
                            <div id="cadastroCheckIn">
                                <div class="cadastroInformacoes">
                                    <p> Check-in: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="definirCheckIn" class="inputCadastroCliente" type="date" name="txtDefinirCheckIn" value="">
                                </div>    
                                
                                <div id="cadastroHorarioCheckIn">
                                    <div class="cadastroInformacoes">
                                        <p> Horário: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                         <input class="definirHorarioCheckIn" type="time" name="txtDefinirHorarioCheckOut" value="" placeholder="00:00">
                                    </div>    
                                </div>
                            </div>

                            <div id="cadastroCheckOut">
                                <div class="cadastroInformacoes">
                                    <p> Check-out: </p>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="definirCheckOut" class="inputCadastroCliente" type="date" name="txtDefinirCheckOut" value="">
                                </div>   
                                
                                <div id="cadastroHorarioCheckOut">
                                    <div class="cadastroInformacoes">
                                        <p> Horário: </p>
                                    </div>
                                    <div class="cadastroEntradaDeDados">
                                         <input class="definirHorarioCheckOut"  type="time" name="txtDefinirHorarioCheckOut" value="" placeholder="00:00">
                                    </div>    
                                </div>
                            </div>
                            
                            <input id="botaoCadastro" type="submit" name="botaoCadastro" value="SALVAR">
                        </form>
                    </div>    
                </div>
            </div>
        </div>
        <footer>
            <div id="textoFooter">
                <p>
                    Termos e condições de privacidade
                </p>
                <p>
                    © 2020 - Fast Parking - É uma marca do ParkinGO Group Srl - Todos os logotipos pertencem aos seus respectivos proprietários - VAT / CF 09276010965
                </p>
            </div>
        </footer>
    </div>
</body>
</html>







