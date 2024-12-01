<?php

require 'vendor/autoload.php';

use App\Modelos\Carro;
use App\Modelos\Moto;
use App\Servicos\Fabrica;
use App\Servicos\PostoGasolina;
use App\Servicos\Relatorio;

$dataCarrosJson = file_get_contents('./data/carros.json');
$carrosJson = json_decode($dataCarrosJson, true);

$listaCarros = Fabrica::fabricarCarros($carrosJson);

$katiaLocatelli = new PostoGasolina('Posto Katia Locatelli', 5.50);

foreach ($listaCarros as $carro) {
    $katiaLocatelli->abastecerPorValor($carro, rand(50, 300));
}

Relatorio::dadosListaCarros($listaCarros);
