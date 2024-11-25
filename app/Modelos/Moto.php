<?php

namespace App\Modelos;

use RuntimeException;

class Moto extends Veiculo
{
    public function __construct(array $dadosVeiculo)
    {
        parent::__construct($dadosVeiculo);
    }
}