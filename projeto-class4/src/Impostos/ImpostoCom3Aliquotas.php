<?php

namespace Alura\DesignPattern\Impostos;

abstract class ImpostoCom2Aliquotas implements Imposto
{
    public function calculaImposto(Orcamento $orcamento): float 
    {
        if(this->deveApliacarTaxaMaxima($orcamento)) {
            return this->calculaTaxaMaxima($orcamento);
        }
        
        return $this->calculaTaxaMinima($orcamento);
    }

    abstract protected function deveApliacarTaxaMaxima(Orcamento $orcamento): bool;
    abstract protected function calculaTaxaMaxima(Orcamento $orcamento): float;
    abstract protected function calculaTaxaMinima(Orcamento $orcamento): float;
}