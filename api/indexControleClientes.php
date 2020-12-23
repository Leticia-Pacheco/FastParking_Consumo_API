<?php
    /*Import do arquivo para iniciar as dependências da API*/
    require_once ("vendor/autoload.php");

    /*Instância da classe App --> Fazemos isso para importar classes no PHP*/
    $app = new \Slim\App();
    
    /*EndPoint para o acesso à raiz da pasta API*/
    /*Sempre que a API devolve algo, é $response. Quando ela envia, é $request*/
    $app->get('/', function($request, $response, $args) {
        return $response->getBody()->write('API de Controle de clientes');
    });

    /*EndPoint para o acesso a todos os dados de contatos da API*/
    $app->get('/controleClientes', function($request, $response, $args) {
        
        /*Import dop arquivo que buscará no BD*/
        require_once('../bd/apiControleClientes.php');
        
        /*Recebendo dados da QueryString (Essas variáveis podem ou não chegar na requisição)*/
        /*Existem 2 maneiras de receber uma variável pela QueryString: 
        1°$_GET[]
        2°getQueryParams() -> Significa parâmetros da queryString*/

        if(isset($request->getQueryParams()['nomeCliente'])){
                                             /*Aqui colocamos a variável que será enviada na requisição*/
            $cliente = $request->getQueryParams()['nomeCliente'];
            
            /*Função para listar todos os contatos*/
            $listClientes = buscarClientes($nomeCliente);
        }
        else{
            $listClientes = listarClientes(0);
            
            echo($listClientes);
            die;
        }
        
        /*Função para listar os contatos*/
        if($listClientes){
            return $response    ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($listClientes);
        }
        else{
            return $response    ->withStatus(204);
        }
    });

    
    /*EndPoint para buscar pelo id*/
    /*As chaves {} tornam um parâmetro obrigatório, se colocar os colchetes, não será mais obrigatório
    ex.: [{id}]*/

    /*Tudo que você traz depois da barra, são argumentos*/

    /*O mesmo que você trouxe no endPoint, precisa trazer na variável (ou seja, aqui nós declaramos o id, 
    na variável, trouxemos o id como parâmetro para o $args)*/
    $app->get('/controleClientes/{id}', function ($request, $response, $args){
        
        $id = $args['id'];
        
        require_once('../bd/apiControleClientes.php');
        
        $listClientes = listarClientes($id);
        
        if($listClientes){
            return $response    ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($listClientes);
        }
        else{
            return $response    ->withStatus(400);
        }
    });
    
    
    $app->post('/controleClientes', function ($request, $response, $args){
        
        /*Recebe o ContentType da requisição*/
        $contentType = $request->getHeaderLine('Content-Type');
        
        /*Estrutura de decisão para saber qual formato de content type que está chegando*/
        if($contentType == 'application/json'){
            
            /*Recebe todos os dados enviados para a API no formato JSON*/
            $dadosJSON = $request->getParsedBody();
            
            
            /*count(json_decode($dadosJSON, true)) == 0
            para não passar dados vazios, para fazer um conjunto com os dados dentro desse if, para não passar 
            ABSOLUTAMENTE NADA vazio*/
            
            
            /*Valida se os dados recebidos estão nulos, vazios .*/
            if($dadosJSON == "" || $dadosJSON == null){
                return $response ->withStatus (400)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('
                                            {
                                                "status": "Fail!",
                                                "message": "Dados enviados não podem se nulos 
                                                ou vazios."
                                            }
                                        ');
            }
            else{
                require_once('../bd/apiControleClientes.php');
                
                
                /*Valida se os dados foram inseridos corretamente no banco*/
                $retornoDadosClientes = inserirClientes($dadosJSON);
                if($retornoDadosClientes){
                    return $response ->withStatus (201)
                                     ->withHeader ('Content-Type', 'application/json')
                                     ->write($retornoDadosClientes);
                }
                else{
                    return $response ->withStatus (400)
                                     ->withHeader ('Content-Type', 'application/json')
                                     ->write('
                                                {
                                                    "status": "Fail!",
                                                    "message": "Falha ao inserir os dados no BD!
                                                     Verifique se os mesmos estão corretos."
                                                }
                                            ');
                }
            }
            
        }
        else{
            
            /*Retorna erro de content Type*/
            return $response ->withStatus (400)
                             ->withHeader('Content-Type', 'application/json')
                             ->write('
                                        {
                                            "status": "Fail!",
                                            "message": "Erro no Content Type da requisição."
                                        }
                                    ');
        }
    });


    $app->delete('/controleClientes/{id}', function($request, $response, $args){

        $idCliente = $args['id'];

        require_once('../bd/apiControleClientes.php');


        $deletarCliente = deletarClientes($idCliente);

        
        if($deletarCliente){
            return $response -> withStatus(200)
                            ->withHeader('Content-Type', 'application/json')
                            ->write("Registro excluido");
        }
        else{
            return $response -> withStatus(400)
                            -> withHeader('Content-Type', 'application/json')
                            -> write ("Erro");
        }
    });



    /*EndPoint para atualizar a foto via POST (Para receber elementos file, somente será enviado via POST, mesmo que seja um update)*/
    $app->put('/controleClientes/{id}', function ($request, $response, $args){
        
        
        $contentType = $request->getHeaderLine('Content-Type');
        
        
        /*strstr --- serve para procurar uma parte de uma String*/
        if(strstr($contentType, "multipart/form-data")){
            
            require_once('../bd/apiControleClientes.php');


            $idCliente = $args['id'];
            $clientes = listarClientes($idCliente);
            $functionRetorno = atualizarCliente($idCliente);
            
            
            /*Import do arquivo que buscará no banco*/
            require_once('../bd/apiControleClientes.php');
            
            
            /*Chama a função para fazer o upload e o update no banco*/
            $retornoDados = atualizarDadosCliente($idCliente);
            
                        
            if($retornoDados == "1"){
                return $response ->withStatus(201);
            }
            elseif($retornoDados == "0"){
                return $response ->withStatus(400)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('
                                            {
                                                "status": "Fail!",
                                                "message": "Não foi possível realizar o update."
                                            }
                                        ');
            }
            else{
                return $response ->withStatus(415)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write('
                                            {
                                                "status": "Fail!",
                                                "message": "'.$retornoDados.'"
                                            }
                                        ');
                
                
                
            }
        }
    });
   

    $app->get('/controleClientesPagar/{idCliente}', function($request, $response, $args){
    
        $idCliente = $args['idCliente'];
        
        //Import do arquivo que vai buscar no BD
        require_once('../bd/apiControleClientes.php');
        
        //Função para Listar todos os Contatos
        $listarValor = valorAserPago($idCliente);
        
        //Valida se houve retorno de dados do banco
        if($listarValor)
            return $response    ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($listarValor);
        else
            return $response    ->withStatus(204);
    });




    $app->run();
?>