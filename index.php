<?php

require 'vendor/autoload.php';

use App\Modelos\Carro;
use App\Servicos\Fabrica;
use App\Servicos\PostoGasolina;
use App\Servicos\Relatorio;

$dataJson = file_get_contents('./data/carros.json');
$carrosJson = json_decode($dataJson, true);

$listaCarros = Fabrica::fabricarCarros($carrosJson);
$katiaLocatelli = new PostoGasolina('Posto Katia Locatelli', 5.50);

/** @var Carro $carro */
foreach ($listaCarros as $carro) {
    $katiaLocatelli->abastecerPorValor($carro, rand(50, 300));
}

Relatorio::dadosListaCarros($listaCarros);
Relatorio::dadosPostoGasolina($katiaLocatelli);
