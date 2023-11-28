<?php 
declare(strict_types=1);

namespace Cep;

use Exception;

use GuzzleHttp\Client;

class ViaEndereco 
{
    private string $uf;
    private string $localidade;
    private string $rua;
    private string $tipo;

    function __construct(string $uf, string $localidade, string $rua, string $tipo="json")
    {       
        $this->uf = trim(strtoupper($uf));
        $this->localidade = trim(strtolower($localidade));
        $this->rua = trim(strtolower($rua)); 
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

    public function viaEndereco()
    {
        try {
            
            $http = "http://viacep.com.br/ws/{$this->uf}/{$this->localidade}/{$this->rua}/{$this->tipo}/";
        
            $client = new Client();
            $response = $client->get($http);    

            if ($response->getBody() == '[]' or $response->getBody() == "<xmlcep><enderecos/></xmlcep>") {
                throw new Exception("Endereco não existe");
            }

            return $response->getBody();

        } catch(Exception $e) {
            throw new Exception("404 Not Found.");
        }
    }

}