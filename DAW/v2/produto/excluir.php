<?php
// Inclui o DAO do Produto
include_once '../class/DAO/produtoDAO.class.php';

// Verifica se o ID do produto foi enviado
if (!isset($_GET['id'])) {
    header("Location: index.php?delete_NOK");
    exit;
}

// Obtém o ID do produto
$idProduto = $_GET['id'];

// Instancia o DAO
$objProdutoDAO = new Produto_DAO();

// Exclui o produto do banco de dados
if ($objProdutoDAO->excluir($idProduto)) {
    // Redireciona para a página principal com uma mensagem de sucesso
    header("Location: index.php?delete_OK");
} else {
    // Redireciona para a página principal com uma mensagem de erro
    header("Location: index.php?delete_NOK");
}
?>
