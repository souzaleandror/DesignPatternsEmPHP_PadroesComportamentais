<?php

use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Orcamento;

require 'vendor/autoload.php';

$calculadora = New CalculadoraDeImpostos();

$orcamento = new Orcamento();
$orcamento->valor = 100;

echo $calculadora->calcula($orcamento, new Icms());
echo $calculadora->calcula($orcamento, new Iss());