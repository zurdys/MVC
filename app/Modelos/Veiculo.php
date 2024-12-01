<?php

namespace App\Modelos;

use RuntimeException;

abstract class Veiculo
{
    public static float $PORCENTAGEM_TANQUE_VEICULO_NOVO = 30 / 100;
    private float $combustivelNoTanque;
    public readonly string $marca;
    public readonly string $modelo;
    public readonly float $capacidadeTanque;
    public readonly float $consumoMedio;

    public function __construct(array $dadosVeiculo)
    {
        $this->marca = $dadosVeiculo['marca'];
        $this->modelo = $dadosVeiculo['modelo'];
        $this->capacidadeTanque = $dadosVeiculo['capacidadeTanque'];
        $this->consumoMedio = $dadosVeiculo['consumoMedio'];
        $this->combustivelNoTanque = $this->capacidadeTanque * self::$PORCENTAGEM_TANQUE_VEICULO_NOVO;
    }

    public function info(): string
    {
        return "$this->marca/$this->modelo";
    }

    public function quantidadeLivreTanque(): float
    {
        return $this->capacidadeTanque - $this->combustivelNoTanque;
    }

    public function getCombustivelTanque(): float|int
    {
        return $this->combustivelNoTanque;
    }

    public function setCombustivelTanque(int|float $qtdParaAbastecer): void
    {
        if ($qtdParaAbastecer > $this->quantidadeLivreTanque()) {
            throw new RuntimeException("Tentativa de abastecer quantidade superior a disponivel no tanque do carro: " . $this->info());
        } 

        $this->combustivelNoTanque = round($this->combustivelNoTanque + $qtdParaAbastecer);
    }

    public function autonomiaTanqueCompleto(): int
    {
        return round($this->consumoMedio * $this->capacidadeTanque);
    }

    public function autonomiaAtual(): int
    {
        return round($this->consumoMedio * $this->combustivelNoTanque);
    }
}