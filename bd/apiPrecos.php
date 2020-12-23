<?php
    function listarCobrancas($id) {
        
        require_once('../modulos/config.php');
        
        require_once('../bd/conexaoMysql.php');

        if(!$conex = conexaoMysql()) {

            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."');</script>");
        }


        $sql = "select tblValores.idValor, tblValores.valor, tblTipoCobranca.tipoDeCobranca
                from tblValores, tblTipoCobranca
                where tblValores.idCobranca = tblTipoCobranca.idCobranca";
        


        /*Validação para filtrar pelo ID*/
        if($id > 0){
            $sql = $sql." and tblValores.idValor = ".$id;
        }

        $select = mysqli_query($conex, $sql);
        

        while($rsCobrancas = mysqli_fetch_assoc($select)) {
            
            /*Os colchetes servem para indicar que será feita uma coleção de arrays, não renovar um único array*/
            $dados[] = array(
                "idValor"          => $rsCobrancas['idValor'],
                "valor"            => $rsCobrancas['valor'],
                "tipoDeCobranca"   => $rsCobrancas['tipoDeCobranca']
            );
        }
        
        if(isset($dados)){
            $listCobrancasJSON = convertJSON($dados);
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
        
        if(isset($listCobrancasJSON)){
            return $listCobrancasJSON;
        }
        else{
            return false;
        }
    }



    function buscarTiposCobrancas ($valor){
        require_once('../modulos/config.php');
        
        require_once('../bd/conexaoMysql.php');

        if(!$conex = conexaoMysql()) {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."');</script>");
        }
        
        $sql = "select tblValores.*
        where tblValores.valor
        and tblTipoCobranca.tipoDeCobranca like '%".$valor."%'";
        /*like --> serve para procurar no banco palavras que sejam parecidas
          like '"%.$variavel.%"' --> serve para procurar no banco qualquer palavra que tenha o mínimo de parecido 
          com a palavra pesquisada*/
        
        $select = mysqli_query($conex, $sql);
        
        while($rsCobrancas = mysqli_fetch_assoc($select)) {
            
            /*Os colchetes servem para indicar que será feita uma coleção de arrays, não renovar um único array*/
            $dados[] = array(
                "idValor"         => $rsCobrancas['idValor'], 
                "valor"           => $rsCobrancas['valor'],
                "tipoDeCobranca"  => $rsCobrancas['tipoDeCobranca']
            );
        }
        
    }



    function inserirTipoCobranca ($dadosPreco){
        /*Abre a conexão com o BD*/

        //Import do arquivo de Variaveis e Constantes
        require_once('../modulos/config.php');

        //Import do arquivo de função para conectar no BD
        require_once('conexaoMysql.php');

        //chama a função que vai estabelecer a conexão com o BD
        if(!$conex = conexaoMysql()) {
            echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            //die; //Finaliza a interpretação da página
        }

        /*Variaveis*/
        $valor = (string) null;
        $idCobranca = (int) null;

        /*Converte o formato JSON para um Array de dados*/
        /*$dadosContato = convertArray($dados);*/

        
        /*Recebe todos os dados da API*/
        $valor = $dadosPreco['valor'];
        $idCobranca = $dadosPreco['idCobranca'];

        /*explode() - localiza um caracter separador do conteudo e dividi os dados em um vetor
        $data = explode("/", $_POST['txtNascimento']);*/

        /*Arrumando a data para ficar no padrão americano
        $dataNascimento = $data[2] . "-" . $data[1] . "-" . $data[0];*/
        
        $sql = "insert into tblValores 
                    (
                        valor,
                        idCobranca
                    )
                    values
                    (
                        '".$valor."',
                        ".$idCobranca."
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
        
    
    function deletarCobranca ($idValor){
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

        $sql = "delete from tblValores where idValor =". $idValor;


        //Executa no BD o Script SQL

        if (mysqli_query($conex, $sql)){
            
            $dados = convertJSON($idValor);
            return $dados;

            //Permite redirecionar para uma outra página
            //header('location:../index.php');
        }
        else{
            return false;
        }
    }

    














































// function atualizarFoto ($file, $id){
        
    //     /*Import do arquivo de funções*/
    //     require_once('upload.php');
        
    //     /*Chama a função para fazer o upload do arquivo*/
    //     $foto = uploadFoto($file);
    
    //     if(is_numeric($foto)){
            
    //         if($foto == 2){
    //             return "Extensão inválida!";
    //         }elseif($foto == 3){
    //             return "Tamanho inválido!";
    //         }
    //     }else{
    //             //Import do arquivo de variáveis e constantes
    //             require_once('../modulo/config.php');

    //             //Import do arquivo de função para conectar no BD
    //             require_once('conexaoMysql.php');

    //             //chama a função que vai estabelecer a conexão com o BD
    //             if(!$conex = conexaoMysql())
    //             {
    //                 echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
    //                 //die; //Finaliza a interpretação da página
    //             }
                
    //             $sql = "update tblcontatos set foto = '".$foto ."'
    //                 where idContato =".$id;
                
    //             if(mysqli_query($conex, $sql)){
    //                 return true;
    //             }
    //             else{
    //                 return false;
    //             }
    //         }
    //     }
    


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