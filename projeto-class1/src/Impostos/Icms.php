<?php

namespace Alura\DesignPattern\Impostos;

class Icms implements Imposto
{
    public function calculaImposto(Orcamento $orcamento): float 
    {
        return $orcamento->valor * 0.1;
    }
}
