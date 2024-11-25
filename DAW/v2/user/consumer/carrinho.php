<?php
@session_start();
include_once '../../class/DAO/produtoDAO.class.php';
$objProdutosDAO = new Produto_DAO();

// Placeholder para imagens ausentes
$caminhoImagem = "https://dummyimage.com/600x700/dee2e6/6c757d.jpg";

// Processar ações do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = $_POST['idProduto'];
    $acao = $_POST['acao'];

    if ($acao === 'remover') {
        unset($_SESSION['carrinho'][$idProduto]);
    } elseif ($acao === 'diminuir') {
        if (isset($_SESSION['carrinho'][$idProduto]) && $_SESSION['carrinho'][$idProduto] > 1) {
            $_SESSION['carrinho'][$idProduto]--;
        }
    } elseif ($acao === 'aumentar') {
        $produto = $objProdutosDAO->retornarProduto($idProduto);
        $estoque = $produto['qtd_estoque'] ?? 0;
        if (isset($_SESSION['carrinho'][$idProduto]) && $_SESSION['carrinho'][$idProduto] < $estoque) {
            $_SESSION['carrinho'][$idProduto]++;
        }
    }

    header('Location: carrinho.php');
    exit;
}

// Preencher dados do carrinho
$itensCarrinho = [];
$totalCarrinho = 0;

if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $idProduto => $quantidade) {
        $produto = $objProdutosDAO->retornarProduto($idProduto);
        if ($produto) {
            // Verificar se a imagem existe no caminho fornecido
            $caminhoImagem = "../../img/prod/{$produto['imagem']}";
            if (!file_exists($caminhoImagem)) {
                // Caso a imagem não exista, usa uma imagem padrão
                $caminhoImagem = "https://dummyimage.com/600x700/dee2e6/6c757d.jpg";
            }

            $produto['imagem'] = $caminhoImagem; // Adiciona a imagem ao produto
            $produto['quantidade'] = $quantidade; // Adiciona a quantidade ao produto
            $produto['subtotal'] = $quantidade * $produto['preco']; // Calcula subtotal do item
            $totalCarrinho += $produto['subtotal']; // Soma ao total do carrinho
            $itensCarrinho[] = $produto; // Adiciona o produto ao array de itens
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel Carrinho</title>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <section style="margin-top: 100px">
        <div class="container">
            <div class="card shadow-lg rounded-4 border-0">
            <div class="row g-0">
                    <!-- Carrinho -->
                    <div class="col-md-8 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold">Shopping Cart</h4>
                            <span class="text-muted"><?= count($itensCarrinho) ?> items</span>
                        </div>

                        <?php if (!empty($itensCarrinho)) : ?>
                            <?php foreach ($itensCarrinho as $item) : ?>
                                <div class="border-top py-3 d-flex align-items-center">
                                    <div class="col-2">
                                        <img src="<?= htmlspecialchars($item['imagem']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($item['nome']) ?>">
                                    </div>
                                    <div class="col ms-3">
                                        <p class="mb-1 text-muted"><?= htmlspecialchars($item['categoria']) ?></p>
                                        <p class="mb-0"><?= htmlspecialchars($item['nome']) ?></p>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                        <form method="post" action="" class="d-inline">
                                            <input type="hidden" name="idProduto" value="<?= $item['idProduto'] ?>" required>
                                            <input type="hidden" name="acao" value="diminuir">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">-</button>
                                        </form>
                                        <input type="text" class="form-control text-center mx-2" value="<?= $item['quantidade'] ?>" style="max-width: 50px;" readonly>
                                        <form method="post" action="" class="d-inline">
                                            <input type="hidden" name="idProduto" value="<?= $item['idProduto'] ?>">
                                            <input type="hidden" name="acao" value="aumentar">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>
                                    </div>
                                    <div class="col-auto text-end">
                                        <span>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></span>
                                        <form method="post" action="" class="d-inline ms-3">
                                            <input type="hidden" name="idProduto" value="<?= $item['idProduto'] ?>">
                                            <input type="hidden" name="acao" value="remover">
                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-center text-muted">Seu carrinho está vazio.</p>
                        <?php endif; ?>

                        <a href="index.php" class="ms-3 btn btn-secondary">Voltar</a>
                    </div>

                    <!-- Resumo -->
                    <div class="col-md-4 p-4 bg-body-tertiary">
                        <h5 class="fw-bold">Resumo</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span>ITEMS <?= count($itensCarrinho) ?></span>
                            <span>R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></span>
                        </div>
                        <form action="carrinho_ok.php" method="post">
                            <div class="mb-3">
                                <label for="pagamento" class="form-label fw-semibold">Pagamento</label>
                                <select id="pagamento" class="form-select" name="pagamento">
                                    <option value="PIX">PIX</option>
                                    <option value="Mastercard">Cartão Mastercard</option>
                                    <option value="Visa">Cartão Visa</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="endereco" class="form-label fw-semibold">Local de Entrega</label>
                                <input type="text" id="endereco" class="form-control" placeholder="Rua, n°, complemento" name="endereco" required>
                            </div>
                        
                        <div class="d-flex justify-content-between border-top pt-3">
                            <span class="fw-semibold">VALOR TOTAL</span>
                            <span class="fw-bold">R$ <?= number_format($totalCarrinho, 2, ',', '.') ?></span>
                        </div>
                        <button class="btn btn-dark w-100 mt-3" type="submit">FINALIZAR</button>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </section>
</body>

</html>
