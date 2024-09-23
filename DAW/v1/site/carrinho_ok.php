<?php
session_start();

include_once '../class/venda.class.php';
include_once '../class/DAO/vendasDAO.class.php';
include_once '../class/venda_has_produto.php';
include_once '../class/DAO/produtoDAO.class.php';
include_once '../class/produto.class.php';
include_once '../class/DAO/produtoDAO.class.php';

$objVenda = new Venda();
$objVenda->setEntrega($_POST['entrega']);
$objVenda->setPagamento($_POST['pagamento']);
$objVenda->setUsuarioIdUsuario($_SESSION['idUsuario']);

$objProdutoDAO = new Produto_DAO();
$objProduto = new Produto();

foreach ($_SESSION['carrinho'] as $idProd => $quantidade) {
    $objVendProd[$idProd] = new Venda_has_produto;
    $preco = $objProdutoDAO->retornarProduto($idProd);
    $objProduto->setPreco($preco['preco']);
    $objProduto->setOferta($preco['oferta']);

    $objVendProd[$idProd]->setProdutoIdProduto($idProd);
    $objVendProd[$idProd]->setQuantidade($_POST["quantidade_$idProd"]);
    $objVendProd[$idProd]->setValorUnit($objProduto->getPrecoOferta());
}
    $objVendaDAO = new Venda_DAO();
    $retorno = $objVendaDAO->inserirVendaComItens($objVenda,$objVendProd);
if($retorno)
    header("Location:../venda/compra.php?id=$retorno");
else
    header("Location:index.php?C_error");