<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\CalculadoraDeImpostos;
use Alura\DesignPattern\Orcamento;
use Alura\DesignPattern\DescontosMaisDe5Itens;
use Alura\DesignPattern\DescontosMaisDe500Reais;


class CalculadoraDeDescontos {

    public function calculaDescontos(Orcamento $orcamento): float 
    {
        $cadeiaDeDescontos = new DescontosMaisDe5Itens(new DescontosMaisDe500Reais(new SemDesconto())));

        return $cadeiaDeDescontos->calculaDesconto($orcamento);

        // $descontos5Itens = new DescontosMaisDe5Itens;
        // $desconto = $descontos5Itens->calculaDesconto($orcamento);

        // if($desconto === 0){
        //     $descontos500reais = new descontos500reais();
        //     $desconto = $descontos500reais->calculaDesconto($orcamento);
        // }

        // return $desconto;

        // if($orcamento->quantidadeItens > 5) {
        //     return $orcamento->valor * 0.1;
        // }

        // if($orcamento->valor > 500) {
        //     return $orcamento->valor * 0.05;
        // }
        
        // return 0;
    }
}