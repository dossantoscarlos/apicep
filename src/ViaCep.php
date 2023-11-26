<?php 

declare(strict_types=1);

namespace Cep;

use Exception;
use GuzzleHttp\Client;

class ViaCep
{    
    private string $cep; //01001000

    public function __construct(string $cep) {
        $this->cep = $cep;
    }

    private function viaCep(string $http) 
    {   
        try { 
            $client = new Client();
            $response = $client->get($http);    
           
            $body = json_encode($response->getBody());

            if($response->getStatusCode() !== 200)  {
               throw new Exception('Cep nao encontrado');
            }

            if (strlen(trim($body)) === 0){
                throw new Exception("Cep nao inexistente");
            }
            return $response->getBody();
        } catch(Exception $e) {
            throw new Exception("{$e->getMessage()}");
        }
    }

    public function viaCepJson() 
    {
        return $this->viaCep("https://viacep.com.br/ws/{$this->cep}/json/");
    }

    public function viaCepXML() 
    {
        return $this->viaCep("https://viacep.com.br/ws/{$this->cep}/xml/");
    }

}