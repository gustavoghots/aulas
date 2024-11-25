<?php
session_start();

// Inclusão das classes necessárias
include_once '../../class/venda.class.php';
include_once '../../class/DAO/vendasDAO.class.php';
include_once '../../class/venda_has_produto.php';
include_once '../../class/DAO/produtoDAO.class.php';
include_once '../../class/produto.class.php';

// Verificar se o carrinho está preenchido e se os dados necessários foram enviados
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho']) || !isset($_POST['pagamento']) || !isset($_POST['endereco'])) {
    header("Location: index.php?C_error"); // Redirecionar caso falte algum dado
    exit;
}

// Dados do POST
$pagamento = $_POST['pagamento'];
$entrega = $_POST['endereco'];

// Instanciar os objetos necessários
$objVenda = new Venda();
$objVenda->setEntrega($entrega);
$objVenda->setPagamento($pagamento);
$objVenda->setUsuarioIdUsuario($_SESSION['idUsuario']); // ID do usuário autenticado (assumindo que está na sessão)

$objProdutoDAO = new Produto_DAO();
$itensVenda = [];

// Loop pelos itens no carrinho
foreach ($_SESSION['carrinho'] as $idProd => $quantidade) {
    $produto = $objProdutoDAO->retornarProduto($idProd); // Obter dados do produto

    // Verificar se o produto existe e se há estoque suficiente
    if (!$produto || $produto['qtd_estoque'] < $quantidade) {
        header("Location: index.php?C_error=estoque_insuficiente");
        exit;
    }

    // Criar o objeto Venda_has_produto para cada item no carrinho
    $itemVenda = new Venda_has_produto();
    $itemVenda->setProdutoIdProduto($idProd);
    $itemVenda->setQuantidade($quantidade);
    $itemVenda->setValorUnit($produto['preco']); // Preço unitário do produto
    $itensVenda[] = $itemVenda;
}

// Inserir a venda no banco de dados com os itens
$objVendaDAO = new Venda_DAO();
$retorno = $objVendaDAO->inserirVendaComItens($objVenda, $itensVenda);

if ($retorno) {
    // Limpar o carrinho e redirecionar para a página de sucesso
    unset($_SESSION['carrinho']);
    header("Location: ....//venda/notaFiscal.php?id=$retorno");
    exit;
} else {
    // Caso a inserção falhe, redirecionar com mensagem de erro
    header("Location: index.php?C_error=insercao_falhou");
    exit;
}
