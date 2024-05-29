<?php
session_start();

include_once '../class/venda.class.php';
include_once '../class/DAO/vendasDAO.class.php';
include_once '../class/venda_has_produto';
include_once '../class/DAO/produtoDAO.class.php';
include_once '../class/produto.class.php';
include_once '../class/DAO/produtoDAO.class.php';

$objVenda = new Venda();
$objVenda->setEntrega($_POST['entrega']);
$objVenda->setPagamento($_POST['pagamento']);
$objVenda->setUsuarioIdUsuario($_SESSION['idUsuario']);

$objVendaDAO = new Venda_DAO();
$retorno = $objVendaDAO->inserir($objVenda);
if ($retorno > 0)
    echo 'venda inserida';
else
    echo 'venda não inserida';

$objProdutoDAO = new Produto_DAO();
$objProduto = new Produto();

$objVendProd = [];

foreach ($_SESSION['carrinho'] as $idProd => $quantidade) {
    $objVendProd[$idProd] = new Venda_has_produto;
    $preco = $objProdutoDAO->retornarProduto($idProd);
    $objProduto->setPreco($preco['preco']);
    $objProduto->setOferta($preco['oferta']);

    $objVendProd[$idProd]->setProdutoIdProduto($idProd);
    $objVendProd[$idProd]->setQuantidade($_POST["quantidade_$idProd"]);
    $objVendProd[$idProd]->setVendaIdVenda($retorno);
    $objVendProd[$idProd]->setValorUnit($objProduto->getPrecoOferta());
}
$objVendaDAO->inserirItems($objVendProd);
