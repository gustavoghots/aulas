<?php
// Inclui o DAO do Produto e a classe Produto
include_once '../class/DAO/produtoDAO.class.php';
include_once '../class/Produto.class.php';

// Verifica se o ID do produto e a oferta foram enviados pelo formulário
if (!isset($_POST['idProduto']) || !isset($_POST['oferta'])) {
    header("Location: oferta.php?NOK");
    exit;
}

// Obtém os dados do formulário
$idProduto = $_POST['idProduto'];
$oferta = $_POST['oferta'];

// Cria uma nova instância de Produto e define os valores
$produto = new Produto();
$produto->setIdProduto($idProduto);
$produto->setOferta($oferta);

// Cria uma instância do DAO e chama o método ofertar
$objProdutoDAO = new Produto_DAO();
if ($objProdutoDAO->ofertar($produto)) {
    // Redireciona para a página principal com uma mensagem de sucesso
    header("Location: index.php?ofer_OK");
} else {
    // Redireciona para a página principal com uma mensagem de erro
    header("Location: ofertar.php?NOK");
}
?>
