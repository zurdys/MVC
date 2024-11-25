<?php

namespace App\Servicos;

use App\Modelos\Carro;
use App\Modelos\Moto;
use App\Modelos\Veiculo;

class PostoGasolina
{
    private float $valorFaturado = 0;
    private float $quantidadeAbastecida = 0;

    public function __construct
    (
        public readonly string $nome,
        private float          $precoGasolina
    )
    {
    }

    public function setPrecoGasolina(float $precoGasolina): void
    {
        $this->precoGasolina = $precoGasolina;
    }

    public function getPrecoGasolina(): float
    {
        return $this->precoGasolina;
    }

    public function getQuantidadeAbastecida(): float|int
    {
        return $this->quantidadeAbastecida;
    }

    public function setQuantidadeAbastecida(float $quantidade): void
    {
        $this->quantidadeAbastecida = round($this->quantidadeAbastecida + $quantidade);
    }

    public function faturar(float $valor): void
    {
        $this->valorFaturado = round($this->valorFaturado + $valor);
    }

    public function getValorFaturado(): float
    {
        return $this->valorFaturado;
    }

    public function abastecerPorValor(Veiculo $veiculo, float $valor): void
    {
        $litros = $valor / $this->precoGasolina;

        try {
            $veiculo->setCombustivelNoTanque($litros);
            $this->faturar($valor);
            $this->setQuantidadeAbastecida($litros);
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            $this->completarTanque($veiculo);
        }
    }

    public function abastecerPorQuantidade(Carro|Moto $veiculo, float $litros): void
    {
        try {
            $veiculo->setCombustivelNoTanque($litros);
            $this->faturar($litros * $this->precoGasolina);
            $this->setQuantidadeAbastecida($litros);
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
            $this->completarTanque($veiculo);
        }
    }

    public function completarTanque(Carro|Moto $veiculo): void
    {
        $litros = $veiculo->getQuantidadeLivreTanque();
        $this->abastecerPorQuantidade($veiculo, $litros);
        $this->faturar($litros * $this->precoGasolina);
        $this->setQuantidadeAbastecida($litros);
    }


}