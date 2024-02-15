<?php

namespace Alura\DesignPattern\Impostos;

class Iccp extends ImpostoCom2Aliquotas
{
    protected function deveApliacarTaxaMaxima(Orcamento $orcamento): bool 
    {
        return $orcamento->valor > 500;
    }

    protected function calculaTaxaMaxima(Orcamento $orcamento): float 
    {
        return $orcamento->valor * 0.03;
    }

    protected function calculaTaxaMinima(Orcamento $orcamento): float
    {
        return $orcamento->valor * 0.02;
    }
}
