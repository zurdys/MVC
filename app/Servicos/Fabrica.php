<?php

namespace App\Servicos;

use App\Modelos\Carro;
use App\Modelos\Moto;

class Fabrica
{
    public static function fabricarCarros(array $dadosCarros): array
    {
        $carros = [];

        foreach ($dadosCarros as $infoCarro) {
            $carros[] = new Carro($infoCarro);
        }

        return $carros;
    }
}