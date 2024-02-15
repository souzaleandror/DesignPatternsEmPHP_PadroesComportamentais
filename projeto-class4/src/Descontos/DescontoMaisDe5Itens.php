<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Orcamento;

class DescontosMaisDe5Itens extends Desconto {

    public function calculaDesconto(Orcamento $orcamento): float 
    {
        if($orcamento->quantidadeItens > 5) {
            return $orcamento->valor * 0.1;
        }

        return $this->proximoDesconto->calculaDesconto($orcamento);
    }

}