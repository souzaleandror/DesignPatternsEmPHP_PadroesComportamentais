<?php

namespace Alura\DesignPattern;

interface AcaoAposGerarPedido 
{
    public function executaAcao(Pedido $pedido): void;
}