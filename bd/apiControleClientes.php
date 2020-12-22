<?php
    function listarClientes($id) {
        
        require_once('../modulos/config.php');
        
        require_once('../bd/conexaoMysql.php');

        if(!$conex = conexaoMysql()) {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."');</script>");
        }
        
        $sql = "select tblClientes.*, tblValores.valor
                from tblClientes, tblValores
                where tblClientes.idValor = tblValores.idValor";
        
        /*Validação para filtrar pelo ID*/
        if($id > 0){
            $sql = $sql . " where tblClientes.idCliente = ".$id;
            
        }
        

        $select = mysqli_query($conex, $sql);
        
        while($rsClientes = mysqli_fetch_assoc($select)) {
            
            /*Os colchetes servem para indicar que será feita uma coleção de arrays, não renovar um único array*/
            $dados[] = array(
                "idCliente"            => $rsClientes['idCliente'], 
                "idValor"              => $rsClientes['idValor'],
                "valor"                => $rsClientes['valor'],
                "nomeCliente"          => $rsClientes['nomeCliente'],
                "placaVeiculo"         => $rsClientes['placaVeiculo'],
                "modeloVeiculo"        => $rsClientes['modeloVeiculo'],
                "corVeiculo"           => $rsClientes['corVeiculo'],
                "tipoVeiculo"          => $rsClientes['tipoVeiculo']
            );
        }
        
        if(isset($dados)){
            $listClientesJSON = convertJSON($dados);
        }
        else{
            return false;
        }
        /*$headerDados = array(
            "status"   => "sucess",
            "data"     => "2020-11-25",
            "contatos" => $dados
        );
        */ 
        
        if(isset($listClientesJSON)){
            return $listClientesJSON;
        }
        else{
            return false;
        }
    }



    function buscarClientes ($nomeCliente){
        require_once('../modulos/config.php');
        
        require_once('../bd/conexaoMysql.php');

        if(!$conex = conexaoMysql()) {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."');</script>");
        }
        
        $sql = "select tblClientes.*, tblValores.valor
                from tblClientes, tblValores
                where tblClientes.idValor = tblValores.idValor
                and tblClientes.nomeCliente like '%".$nomeCliente."%'";
        /*like --> serve para procurar no banco palavras que sejam parecidas
          like '"%.$variavel.%"' --> serve para procurar no banco qualquer palavra que tenha o mínimo de parecido com a palavra pesquisada*/
        
        $select = mysqli_query($conex, $sql);
        
        while($rsClientes = mysqli_fetch_assoc($select)) {
            
            /*Os colchetes servem para indicar que será feita uma coleção de arrays, não renovar um único array*/
            $dados[] = array(
                "idCliente"            => $rsClientes['idCliente'], 
                "idValor"              => $rsClientes['idValor'],
                "valor"                => $rsClientes['valor'],
                "nomeCliente"          => $rsClientes['nomeCliente'],
                "placaVeiculo"         => $rsClientes['placaVeiculo'],
                "modeloVeiculo"        => $rsClientes['modeloVeiculo'],
                "corVeiculo"           => $rsClientes['corVeiculo'],
                "tipoVeiculo"          => $rsClientes['tipoVeiculo']
            );
        }
        
    }



    function inserirClientes ($dadosCliente){
    /*Abre a conexão com o BD*/

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulos/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');


        if(!$conex = conexaoMysql()) {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        }


        /*Variaveis*/
        $idValor = (string) null;
        $nomeCliente = (string) null;
        $placaVeiculo = (int) null;
        $modeloVeiculo = (string) null;
        $corVeiculo = (string) null;
        $tipoVeiculo = (string) null;

        /*Converte o formato JSON para um Array de dados*/
        /*$dadosContato = convertArray($dados);*/
        
        
        
        /*Recebe todos os dados da API*/
        $idValor = $dadosCliente['idValor'];
        $nomeCliente = $dadosCliente['nomeCliente'];
        $placaVeiculo = $dadosCliente['placaVeiculo'];
        $modeloVeiculo = $dadosCliente['modeloVeiculo'];
        $corVeiculo = $dadosCliente['corVeiculo'];
        $tipoVeiculo = $dadosCliente['tipoVeiculo'];
        
        /*explode() - localiza um caracter separador do conteudo e dividi os dados em um vetor
        $data = explode("/", $_POST['txtNascimento']);*/

        /*Arrumando a data para ficar no padrão americano
        $dataNascimento = $data[2] . "-" . $data[1] . "-" . $data[0];*/
        
        
        
        $sql = "insert into tblClientes 
                    (
                        idValor,
                        nomeCliente,
                        placaVeiculo,
                        modeloVeiculo,
                        corVeiculo,
                        tipoVeiculo
                    )
                    values
                    (
                        ".$idValor.",
                        '". $nomeCliente ."',
                        '". $placaVeiculo ."',
                        '". $modeloVeiculo ."', 
                        '".$corVeiculo."',
                        '". $tipoVeiculo ."'
                    );
                ";



        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql)){
            
            return true;

            //Permite redirecionar para uma outra página
            //header('location:../index.php');
        }
        else{
            return false;
        }
    }
                
        
    function deletarClientes ($idCliente){
    /*Abre a conexão com o BD*/

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulos/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');

        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql())
        {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }

        $sql = "delete from tblClientes where idCliente =".$idCliente;

        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql)){
            
            $dados = convertJSON($idCliente);
            return $dados;

            //Permite redirecionar para uma outra página
            //header('location:../index.php');
        }
        else{
            return false;
        }
    }


    function atualizarCliente ($idCliente){
            //Import do arquivo de variáveis e constantes
            require_once('../modulos/config.php');

            //Import do arquivo de função para conectar no BD
            require_once('conexaoMysql.php');

            //chama a função que vai estabelecer a conexão com o BD
            if(!$conex = conexaoMysql())
            {
                echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
                //die; //Finaliza a interpretação da página
            }
            
            $sql = "update tblClientes
                    where idCliente = ".$idCliente;
            
            if(mysqli_query($conex, $sql)){
                return true;
            }
            else{
                return false;
            }
        }
    


    /*Converte array em JSON*/
    function convertJSON ($objeto){
        /*forçamos o cabeçalho a ser aplicação do tipo JSON*/
        header("content-type:application/json");        
            
        /*converte o array de dados em JSON*/
        $listJSON = json_encode($objeto);
             
        return $listJSON;
    }
    


    /*Converte JSON em array*/
    /*function convertArray ($objeto){
        forçamos o cabeçalho a ser aplicação do tipo JSON
        header("content-type:application/json");        
            
        converte o JSON de dados em array
        $listArray = json_decode($objeto);
             
        return $listArray;
    }*/

    /*mysqli_fetch_assoc serve para criar arrays*/
    /*var_dump () é como se fosse um echo*/
    /*header("Content-type:application/json"); --- forçamos o cabeçalho a ser aplicação do tipo JSON*/
    /*$listContatosJSON = json_encode($dados); --- converte o array de dados em JSON*/
?>