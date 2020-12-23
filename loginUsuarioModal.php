<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/stylePaginaPrincipal.css">
        <script>
            $(document).ready(function(){
                //fadeIn
                //toggle
                //slideDown
                //slideToggle
                $("#fecharModal").click(function(){
                    $("#modalContainer").fadeOut();
                });
            });
        
        </script>
    </head>
    <body>
        
        <div id="login">
            <div class="visualizarTitulo"> Login Usuário </div>
            <div id="fecharModal">
            <img src="imagens/fechar.png">
        </div>
            <div id="loginModal" class="centerObject">
                <form id="formLogin" class="centerObject" name="frmLogin" method="get" action="">
                    <div id="loginUsuario">
                        <div id="usuario">
                            <p class="editSubTituloFormLogin"> Usuário </p>
                        </div>
                        <div class="cadastroUsuario">
                            <input class="editInputCadastroUsuario" type="text" name="txtUsuario" value="">
                        </div>
                    </div>
                    <div id="senhaUsuario">
                        <div id="senha">
                            <p class="editSubTituloFormLogin"> Senha </p>
                        </div>
                        <div class="cadastroUsuario">
                            <input class="editInputCadastroUsuario" type="password" name="txtUsuario" value="">
                        </div>
                    </div>
                    <input id="botaoLogin" type="submit" name="botaoLogin" value="LOGAR">
                </form>
            </div>                
        </div>
    </body>
</html>