<?php

namespace App\Modelos;

use RuntimeException;

class Barco extends Veiculo
{
    public function __construct(array $dadosVeiculo)
    {
        parent::__construct($dadosVeiculo);
    }
}