<?php 

declare(strict_types=1);

namespace Cep;

use Exception;
use GuzzleHttp\Client;

class ViaCep
{    
    private string $cep; //01001000
    private string $tipo;

    public function __construct(string $cep, string $tipo) {
        $this->cep = $cep;
        $this->setTipo($tipo);
    }

    private function setTipo(string $tipo)
    {
        $arrTipo = ['json','xml'];
        $tipo = trim(strtolower($tipo));
        
        if (!in_array($tipo, $arrTipo)){
            throw new Exception("Tipo invalido.");
        }

        $this->tipo=$tipo;
    }

    public function viaCep()
    {   
        try { 

            $http = "https://viacep.com.br/ws/{$this->cep}/{$this->tipo}/";
            
            $client = new Client;
            $response = $client->get($http);    
                 
            if ($response->getStatusCode() !== 200)  {
               throw new Exception('Cep nao encontrado');
            }

            if ($response->getBody()->getSize() === 0){
                throw new Exception("Cep nao inexistente");
            }

            return $response->getBody();
        
        } catch(Exception $e) {
            throw new Exception("{$e->getMessage()}");
        }
    }
}