<?php

namespace Alura\DesignPattern;

class LogGerarPedido implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void 
    {
        echo "Gerando log de geracao de pedido";
    }
}