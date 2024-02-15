<?php

namespace Alura\DesignPattern;

class GerarPedido implements Command
{
    private float $valorOrcamento;
    private int $numeroItens;
    private string $nomeDoCliente;

    public function __contruct(float $valorDoOrcamento, int $numeroItens, string $nomeCliente) 
    {
        $this->valorDoOrcamento = $valorDoOrcamento;
        $this->numeroItens = $numeroItens;
        $this->nomeCliente = $nomeCliente;
    }

    public function execute() {
        $orcamento = new Orcamento();
        $orcamento->quantidadeItens = $this->numeroItens;
        $orcamento->valor = $this->valorDoOrcamento;

        $pedido = new Pedido();
        $pedido->dataFinalizacao = new \DateTimeImmutable();
        $pedido->nomeCliente = $this->nomeCliente;
        $pedido->orcamento = $orcamento;

        echo "Cria pedido no banco de dados " . PHP_EOL; 
        echo "Envia email para o cliente" . PHP_EOL;
    }
}