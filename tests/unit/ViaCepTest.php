<?php 

namespace Test\unit;

use Cep\ViaCep;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class ViaCepTest extends TestCase 
{
    private $json;
    private $xml;
    public function setUp(): void
    {
        $this->json = '{"cep": "26087-030","logradouro":"Rua Doutor Renato","complemento": "",
            "bairro": "Austin","localidade": "Nova Iguaçu","uf": "RJ","ibge": "3303500","gia": "",
            "ddd": "21","siafi": "5869"}';

        $this->xml = '<?xml version="1.0" encoding="UTF-8"?>
            <xmlcep><cep>26087-030</cep><logradouro>Rua Doutor Renato</logradouro>
            <complemento></complemento><bairro>Austin</bairro>
            <localidade>Nova Iguaçu</localidade><uf>RJ</uf><ibge>3303500</ibge>
            <gia></gia><ddd>21</ddd><siafi>5869</siafi></xmlcep>';
    }

    function test_viacep_cep_json()
    {
        $arrayJson = json_decode($this->json, true);
        
        $viacep = new ViaCep("26087030");
        $responseJson = json_decode($viacep->viaCepJson(),true);
        
        $this->assertEquals($arrayJson, $responseJson);
    }

    function test_viacep_cep_xml ()
    {
        $viacep = new ViaCep("26087030");
        $responseXml = $viacep->viaCepXML();
        
        $this->assertXmlStringEqualsXmlString($this->xml, $responseXml);
    }
}