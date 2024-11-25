<?php

namespace App\Modelos;

use RuntimeException;

class Carro
{
    public static float $PORCENTAGEM_TANQUE_CARRO_NOVO = 30 / 100;
    private float $combustivelNoTanque;
    public readonly string $marca;
    public readonly string $modelo;
    public readonly float $capacidadeTanque;
    public readonly float $consumoMedio;

    public function __construct(array $dadosCarro)
    {
        $this->marca = $dadosCarro['marca'];
        $this->modelo = $dadosCarro['modelo'];
        $this->consumoMedio = $dadosCarro['consumoMedio'];
        $this->capacidadeTanque = $dadosCarro['capacidadeTanque'];
        $this->combustivelNoTanque = $this->capacidadeTanque * self::$PORCENTAGEM_TANQUE_CARRO_NOVO;
    }

    public function getInfo(): string
    {
        return "$this->marca/$this->modelo";
    }

    public function getQuantidadeLivreTanque(): float
    {
        return $this->capacidadeTanque - $this->combustivelNoTanque;
    }

    public function getCombustivelTanque(): float|int
    {
        return $this->combustivelNoTanque;
    }

    public function setCombustivelNoTanque(int|float $qntParaAbastecer): void
    {
        if ($qntParaAbastecer > $this->getQuantidadeLivreTanque()) {
            throw new RuntimeException('Tentativa de abastecer quantidade superior a disponível no carro: ' . $this->getInfo());
        }

        $this->combustivelNoTanque = round($this->combustivelNoTanque + $qntParaAbastecer);
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
