<?php

/* class 1 - Strategy - 12/02/2024 */

use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Orcamento;

require 'vendor/autoload.php';

$calculadora = New CalculadoraDeImpostos();

$orcamento = new Orcamento();
$orcamento->valor = 100;

echo $calculadora->calcula($orcamento, new Icms());
echo $calculadora->calcula($orcamento, new Iss());


/* class 2 - Chain of Responsibility - 13/02/2024 */

$calculadora = new CalculadoraDeDescontos();

$orcamento2 = new Orcamento();
$orcamento2->valor = 200;
$orcamento2->quantidadeItens = 7;

echo $calculadora->calculaDescontos($orcamento2);

$orcamento3 = new Orcamento();
$orcamento3->valor = 600;
$orcamento3->quantidadeItens = 6;

echo $calculadora->calculaDescontos($orcamento3);


$orcamento4 = new Orcamento();
$orcamento4->valor = 600;
$orcamento4->quantidadeItens = 6;

echo $calculadora->calculaDescontos($orcamento4);
