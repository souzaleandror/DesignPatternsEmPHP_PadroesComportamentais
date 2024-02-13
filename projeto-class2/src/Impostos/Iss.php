<?php

namespace Alura\DesignPattern\Impostos;

class Iss implements Imposto
{
    public function calculaImposto(Orcamento $orcamento): float 
    {
        return $orcamento->valor * 0.06;
    }
}
