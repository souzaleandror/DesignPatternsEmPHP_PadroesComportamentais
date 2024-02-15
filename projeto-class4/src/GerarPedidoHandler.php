<?php

namespace Alura\DesignPattern;

class GerarPedidoHandler
{
    public function __contruct() 
    {
    }

    public function execute(GerarPedido $gerarPedido) 
    {
        $orcamento = new Orcamento();
        $orcamento->quantidadeItens = $gerarPedido->numeroItens;
        $orcamento->valor = $gerarPedido->valorDoOrcamento;

        $pedido = new Pedido();
        $pedido->dataFinalizacao = new \DateTimeImmutable();
        $pedido->nomeCliente = $gerarPedido->nomeCliente;
        $pedido->orcamento = $orcamento;

        echo "Cria pedido no banco de dados " . PHP_EOL; 
        echo "Envia email para o cliente" . PHP_EOL;
    }
}