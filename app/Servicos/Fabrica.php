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

    public static function fabricarMotos(array $dadosMotos): array
    {
        $motos = [];

        foreach ($dadosMotos as $infoMoto) {
            $motos[] = new Moto($infoMoto);
        }

        return $motos;
    }
}