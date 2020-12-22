<?php
    require_once('conexaoMysql.php');
    require_once('../modulos/config.php');

    if(!$conex = conexaoMysql()){
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    }
    
    /*CRIANDO AS VARIÁVEIS*/
    $inserirValorPorHora = (string) null;
    $idCobranca = (string) null;

    
    /*RECEBENDO OS DADOS DO FORMULÁRIO*/
    $inserirValorPorHora = $_GET['inserirValorPorHora'];
    $idCobranca = $_GET['tipoDeCobranca'];

    $sql = "insert into tblValores(
            inserirValorPorHora,
            idCobranca)

            values(
            '".$inserirValorPorHora."',
            '".$idCobranca."'
            );
    ";

    if(mysqli_query($conex, $sql)){
        echo("
               <script>
                   alert('Usuário cadastrado com sucesso!');
                   location.href = '../CMS/cmsAdmUsuarios.php';
               </script>
       ");
    }
    else{        
       
       echo("
               <script>
                   alert('Erro ao executar o Script no Banco de dados!');
                   location.href = '../CMS/cmsAdmUsuarios.php';
                   window.history.back();
               </script>
       ");
   }
?>