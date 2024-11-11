<?php
// Inclui o DAO e a classe Produto
include_once '../class/DAO/produtoDAO.class.php';
include_once '../class/Produto.class.php';

// Verifica se o ID do produto foi enviado
if (!isset($_POST['idProduto'])) {
    header("Location: editar.php?NOK");
    exit;
}

// Instancia o DAO
$objProdutoDAO = new Produto_DAO();

// Cria um novo objeto Produto e define seus valores com os dados do formulário
$produto = new Produto();
$produto->setIdProduto($_POST['idProduto']);
$produto->setNome($_POST['nome']);
$produto->setPreco($_POST['preco']);
$produto->setDescricao($_POST['descricao']);
$produto->setOferta($_POST['oferta']);
$produto->setQtdEstoque($_POST['qtd_estoque']);
$produto->setCategoriaIdCategoria($_POST['Categoria_idCategoria']);

// Verifica se uma nova imagem foi enviada
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    // Caminho para salvar a imagem (pasta 'uploads')
    $caminhoImagem = '../img/prod/' . basename($_FILES['imagem']['name']);
    
    // Move a imagem para o diretório desejado
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
        // Define o caminho da imagem no objeto Produto
        $produto->setImagem(basename($_FILES['imagem']['name']));
    } else {
        // Se o upload falhar, redireciona com uma mensagem de erro
        header("Location: editar.php?NOK=true");
        exit;
    }
} else {
    // Caso nenhuma imagem nova tenha sido enviada, mantém a imagem atual
    $produtoExistente = $objProdutoDAO->retornarProduto($_POST['idProduto']);
    $produto->setImagem($produtoExistente['imagem']);
}

// Atualiza o produto no banco de dados
if ($objProdutoDAO->editar($produto)) {
    // Redireciona para a página inicial com uma mensagem de sucesso
    header("Location: index.php?edit_OK");
} else {
    // Redireciona para a página de edição com uma mensagem de erro
    header("Location: editar.php?NOK");
}
?>
