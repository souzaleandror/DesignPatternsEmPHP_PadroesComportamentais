<?php 

namespace Alura\DesignPattern\Impostos;

interface Imposto {
    public function calculaImposto(Orcamento $orcamento): float;
}