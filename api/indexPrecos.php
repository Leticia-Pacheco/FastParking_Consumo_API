<?php
    /*Import do arquivo para iniciar as dependências da API*/
    require_once ("vendor/autoload.php");

    /*Instância da classe App --> Fazemos isso para importar classes no PHP*/
    $app = new \Slim\App();
    
    /*EndPoint para o acesso à raiz da pasta API*/
    /*Sempre que a API devolve algo, é $response. Quando ela envia, é $request*/
    $app->get('/', function($request, $response, $args) {
        return $response->getBody()->write('API de Cobranças do Estacionamento');
    });

    /*EndPoint para o acesso a todos os dados de contatos da API*/
    $app->get('/precos', function($request, $response, $args) {
        
        /*Import dop arquivo que buscará no BD*/
        require_once('../bd/apiPrecos.php');
        
        /*Recebendo dados da QueryString (Essas variáveis podem ou não chegar na requisição)*/
        /*Existem 2 maneiras de receber uma variável pela QueryString: 
        1°$_GET[]
        2°getQueryParams() -> Significa parâmetros da queryString*/

        if(isset($request->getQueryParams()['tipoDeCobranca'])){
                                             /*Aqui colocamos a variável que será enviada na requisição*/
            $tipoDeCobranca = $request->getQueryParams()['tipoDeCobranca'];
            
            /*Função para listar todos os contatos*/
            $listCobrancas = buscarTiposCobrancas($tipoDeCobranca);
        }
        else{
            $listCobrancas = listarCobrancas(0);
            
            echo($listCobrancas);
            die;
        }
        
        /*Função para listar os contatos*/
        if($listCobrancas){
            return $response    ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($listCobrancas);
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
    $app->get('/precos/{id}', function ($request, $response, $args){
        
        $id = $args['id'];
        
        require_once('../bd/apiPrecos.php');
        
        $listCobrancas = listarCobrancas($id);
        
        if($listCobrancas){
            return $response    ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($listCobrancas);
        }
        else{
            return $response    ->withStatus(400);
        }
    });
    
    
    $app->post('/precos', function ($request, $response, $args){
        
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
                                                "message": "Dados enviados não podem se nulos ou vazios."
                                            }
                                        ');
            }
            else{
                require_once('../bd/apiPrecos.php');
                
                
                /*Valida se os dados foram inseridos corretamente no banco*/
                $retornoDados = inserirTipoCobranca($dadosJSON);
                if($retornoDados){
                    return $response ->withStatus (201)
                                     ->withHeader ('Content-Type', 'application/json')
                                     ->write($retornoDados);
                }
                else{
                    return $response ->withStatus (400)
                                     ->withHeader ('Content-Type', 'application/json')
                                     ->write('
                                                {
                                                    "status": "Fail!",
                                                    "message": "Falha ao inserir os dados no BD! Verifique se os
                                                     mesmos estão corretos."
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


    $app->delete('/precos/{id}', function($request, $response, $args){

    $idValor = $args['id'];

    require_once('../bd/apiPrecos.php');


    $deletarCobranca = deletarCobranca($idValor);

    
    if($deletarCobranca){
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
   

    $app->run();
?>