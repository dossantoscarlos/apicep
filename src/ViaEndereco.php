<?php 
declare(strict_types=1);

namespace ApiCep\models;

class ViaEndereco 
{
    private string $uf;
    private string $localidade;
    private string $rua;

    function __construct(string $uf, string $localidade, string $rua)
    {
        $this->uf = $uf;
        $this->localidade = $localidade;
        $this->rua = $rua;
    }
}