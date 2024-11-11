<?php
echo '<pre>';
print_r($_POST);
print_r($_FILES);

include_once '../class/produto.class.php';
include_once '../class/DAO/produtoDAO.class.php';

$nomeImagem = $_FILES['imagem']['name'];
$tmpImagem = $_FILES['imagem']['tmp_name'];
$direcao = "../img/prod/" . $nomeImagem;
if (!move_uploaded_file($tmpImagem, $direcao))
    header("Location:adicionar.php?NOK");

if ($_POST['oferta'] == "")
    $_POST['oferta'] = 0;

$objProduto = new Produto();
$objProduto->setNome($_POST['nome']);
$objProduto->setPreco($_POST['preco']);
$objProduto->setDescricao($_POST['descricao']);
$objProduto->setOferta($_POST['oferta']);
$objProduto->setQtdEstoque($_POST['qtd_estoque']);
$objProduto->setCategoriaIdCategoria($_POST['Categoria_idCategoria']);
$objProduto->setImagem($nomeImagem);

$objProdutoDAO = new Produto_DAO();
$retorno = $objProdutoDAO->inserir($objProduto);
$objProduto->setIdProduto($retorno);
$oferta = $objProdutoDAO->ofertar($objProduto);
if ($retorno && $oferta)
    header("Location:adicionar.php?OK");
