<?php

namespace App\Servicos;

use App\Modelos\Carro;

class Relatorio
{

    public static function dadosCarro(Carro $carro): void
    {
        echo "Informações do carro: " . $carro->getInfo() . PHP_EOL;
        echo "Capacidade do tanque:  $carro->capacidadeTanque litros" . PHP_EOL;
        echo "Combusitvel Atual: " . $carro->getCombustivelTanque() . " litros" . PHP_EOL;
        echo "Consumo médio por km/h: $carro->consumoMedio" . PHP_EOL;
        echo "Autonomia com o tanque atual: " . $carro->autonomiaAtual() . " Km" . PHP_EOL;
        echo "Autonomia com tanque cheio: " . $carro->autonomiaTanqueCompleto() . " Km" . PHP_EOL;
        echo "------------------------------" . PHP_EOL;
    }

    public static function dadosListaCarros(array $carros): void
    {
        foreach ($carros as $carro) {
            self::dadosCarro($carro);
        }
    }

    public static function dadosPostoGasolina(PostoGasolina $postoGasolina): void
    {
        echo "Informações do Posto: $postoGasolina->nome:" . PHP_EOL;
        echo "Preço da Gasolina: " . $postoGasolina->getPrecoGasolina() . PHP_EOL;
        echo "Quantidade Abastecida: " . $postoGasolina->getQuantidadeAbastecida() . " litros" . PHP_EOL;
        echo "Valor Faturado: R$" . number_format($postoGasolina->getValorFaturado(), 2, ',', '.') . PHP_EOL;
    }

}