<?php

namespace Alura\DesignPattern;

class GerarPedidoHandler
{

    private array $acoesAposGerarPedido = [];

    public function __contruct() 
    {
    }

    public function adicionarAcaoAoGerarPedido(AcaoAposGerarPedido $acoesAposGerarPedido) 
    {
        $this-> acoesAposGerarPedido = $acoesAposGerarPedido;
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

        $pedidoRepositorty = new CriarPedidoNoBanco();
        $logGerarPedido = new LogGerarPedido();
        $enviarPedidoPorEmail = new EnviarPedidoPorEmail();

        // $pedidoRepositorty->executaAcao($pedido);
        // $logGerarPedido->executaAcao($pedido);
        // $enviarPedidoPorEmail->executaAcao($pedido);

        foreach($this->acoesAposGerarPedido as $acao) {
            $acao->executaAcao($pedido);
        }

        echo "Cria pedido no banco de dados " . PHP_EOL; 
        echo "Envia email para o cliente" . PHP_EOL;
    }
}