<?php

namespace App\Servicos;

use App\Modelos\Carro;
use App\Modelos\Moto;

class Relatorio
{
    public static function dadosCarro(Carro $carro): void
    {
        echo "Informações do carro: " . $carro->info() . PHP_EOL;
        echo "Capacidade do tanque: " . $carro->capacidadeTanque . " litros" . PHP_EOL;
        echo "Combustivel atual: " . $carro->getCombustivelTanque() . "". PHP_EOL;
        echo "Consumo médio por km/h: " . $carro->consumoMedio . PHP_EOL;
        echo "Autonomia com o tanque atual: " . $carro->autonomiaAtual() . " Km". PHP_EOL;
        echo "Autonomia com o tanque cheio: " . $carro->autonomiaTanqueCompleto() . " Km" . PHP_EOL;
        echo "--------------------------------" . PHP_EOL;
    }

    public static function dadosListaCarros(array $carros): void
    {
        foreach ($carros as $carro) {
            self::dadosCarro($carro);
        }
    }
}
