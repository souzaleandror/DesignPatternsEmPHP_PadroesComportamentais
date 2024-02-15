<?php

namespace Alura\DesignPattern;

$valorOrcamento = $argv[1];
$numeroDeItens = $argv[2];
$nomeCliente = $argv[3];

$orcamento = new Orcamento();
$orcamento->quantidadeItens = $numeroDeItens;
$orcamento->valor = $valorOrcamento;

$pedido = new Pedido();
$pedido->dataFinalizacao = new \DateTimeImmutable();
$pedido->nomeCliente = $nomeCliente;
$pedido->orcamento = $orcamento;

echo "Cria pedido no banco de dados " . PHP_EOL; 
echo "Envia email para o cliente" . PHP_EOL;

$gerarPedido = GerarPedido(123.12, 12, "Vinicios dias");
$gerarPedido->execute();

$gerarPedidoHandler = new GerarPedidoHandler();
$gerarPedidoHandler->execute($gerarPedido);
