<?php

declare(strict_types=1);

namespace Test\unit;

use Cep\ViaEndereco;
use PHPUnit\Framework\TestCase;

class ViaEnderecoTest extends TestCase 
{
    public static function enderecoProvider()
    {
        return [
            ['rj', 'novaiguaçu', 'doutor%20renato', 'json'],
            ['rj', 'nova iguaçu', 'doutor renato', 'xml']
        ];
    }

    /**
     * @dataProvider enderecoProvider
     */
    public function testBuscaEnderecoRetornandoFormato($estado, $cidade, $logradouro, $formato)
    {
        $viaEndereco = new ViaEndereco($estado, $cidade, $logradouro, $formato);
        $response = $viaEndereco->viaEndereco();
        
        $this->assertNotEmpty($response, sprintf('A resposta no formato %s não deve estar vazia.', $formato));
    }
}
