<?php
    require_once('conexaoMysql.php');

    require_once('../modulos/config.php');

    if(!$conex = conexaoMysql()){
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."') </script>");
    }

    

$nomeCliente     = (string) null;
$placaCarro      = (string) null;
$modeloCarro     = (string) null;
$checkIn         = (string) null;
$horarioCheckIn  = (string) null;
$checkOut        = (string) null;
$horarioCheckOut = (string) null;


$nomeCliente     = $_POST['txtNomeCliente'           ];
$placaCarro      = $_POST['txtPlacaCarro'            ];
$modeloCarro     = $_POST['txtModeloCarro'           ];
$checkIn         = $_POST['txtDefinirCheckIn'        ];
$horarioCheckIn  = $_POST['txtDefinirHorarioCheckOut'];
$checkOut        = $_POST['txtDefinirCheckOut'       ];
$horarioCheckOut = $_POST['txtDefinirHorarioCheckOut'];


$sql = "insert into tblClientes 
            (
                nomeCliente, 
                placaCarro, 
                modeloCarro, 
                dataEntrada,
                horarioEntrada,
                dataSaida,
                horarioSaida
            )
            values
            (
                '". $nomeCliente     ."',
                '". $placaCarro      ."',
                '". $modeloCarro     ."', 
                '". $checkIn         ."',
                '". $horarioCheckIn  ."',
                '". $checkOut        ."', 
                '". $horarioCheckOut ."'
            )
        ";


//echo($sql);


//Executa no BD o Script SQL

if (mysqli_query($conex, $sql))
{
    echo("
            <script>
                alert('Registro Inserido com sucesso!');
                location.href = '../paginaPrincipal.php';
            </script>
    ");
    
    //Permite redirecionar para uma outra página
    //header('location:../index.php');
}
else
    echo("
            <script>
                alert('Erro ao Inserir os dados no Banco de Dados! Favor verificar a digitação de todos os dados.');
                location.href = '../paginaPrincipal.php';
                window.history.back();
            </script>
    
        ");


?>


















