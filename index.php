<?php

require 'vendor/autoload.php';

use App\Modelos\Carro;
use App\Modelos\Moto;
use App\Servicos\Fabrica;
use App\Servicos\PostoGasolina;
use App\Servicos\Relatorio;

$dataCarrosJson = file_get_contents('./data/carros.json');
$carrosJson = json_decode($dataCarrosJson, true);

$dataMotosJson = file_get_contents('./data/motos.json');
$motosJson = json_decode($dataMotosJson, true);

$listaCarros = Fabrica::fabricarCarros($carrosJson);
$listaMotos = Fabrica::fabricarMotos($motosJson);

$katiaLocatelli = new PostoGasolina('Posto Katia Locatelli', 5.50);
$katiaLocatelli1 = new PostoGasolina('Posto Katia Locatelli', 5.50);


/** @var Carro $carro */
foreach ($listaCarros as $carro) {
    $katiaLocatelli->abastecerPorValor($carro, rand(50, 300));
}

/** @var Moto $moto */
foreach ($listaMotos as $moto) {
    $katiaLocatelli1->abastecerPorValor($moto, rand(20, 100));
}

Relatorio::dadosListaCarros($listaCarros);
Relatorio::dadosPostoGasolina($katiaLocatelli);

Relatorio::dadosListaMotos($listaMotos);
Relatorio::dadosPostoGasolina($katiaLocatelli1);
