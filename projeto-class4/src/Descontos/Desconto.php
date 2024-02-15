<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Orcamento;

abstract class Desconto 
{

    protected ?Desconto $proximoDesconto;

    public function __contruct(?Desconto $proximoDesconto) 
    {
        $this->proximoDesconto = $proximoDesconto;
    }

    abstract public function calculaDesconto(Orcamento $orcamento): float;
}