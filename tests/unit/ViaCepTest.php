<?php 

namespace Test\unit;

use Cep\ViaCep;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class ViaCepTest extends TestCase 
{
    private const CEP = '26087030';
    private const JSON_RESPONSE = '{"cep": "26087-030","logradouro":"Rua Doutor Renato","complemento": "","bairro": "Austin","localidade": "Nova Iguaçu","uf": "RJ","ibge": "3303500","gia": "","ddd": "21","siafi": "5869"}';

    private const XML_RESPONSE = '<?xml version="1.0" encoding="UTF-8"?>
        <xmlcep><cep>26087-030</cep><logradouro>Rua Doutor Renato</logradouro>
        <complemento></complemento><bairro>Austin</bairro>
        <localidade>Nova Iguaçu</localidade><uf>RJ</uf><ibge>3303500</ibge>
        <gia></gia><ddd>21</ddd><siafi>5869</siafi></xmlcep>';
    
    public function test_viacep_json()
    {
        $viacep = new ViaCep(self::CEP, 'json');
        $response = $viacep->viaCep();
        $this->assertJsonStringEqualsJsonString(self::JSON_RESPONSE, $response);
    }

    public function test_viacep_xml()
    {
        $viacep = new ViaCep(self::CEP, 'xml');
        $response = $viacep->viaCep();
        $this->assertXmlStringEqualsXmlString(self::XML_RESPONSE, $response);
    }
}
