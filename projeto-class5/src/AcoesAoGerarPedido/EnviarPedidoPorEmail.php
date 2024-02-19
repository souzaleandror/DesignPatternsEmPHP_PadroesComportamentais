<?php

namespace Alura\DesignPattern;

class EnviarPedidoPorEmail implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void 
    {
        echo "Enviando e-mail de pedido gerado";
    }
}