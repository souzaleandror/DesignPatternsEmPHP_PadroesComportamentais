<?php

namespace Alura\DesignPattern;

class CriarPedidoNoBanco implements AcaoAposGerarPedido
{
    public function executaAcao(Pedido $pedido): void 
    {
        echo "Salvando pedido no banco de dados";
    }
}