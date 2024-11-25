<?php
include_once '../class/DAO/produtoDAO.class.php';
$objProdutoDAO = new Produto_DAO();
$produto = $objProdutoDAO->retornarProduto($_GET['id']);
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe Produto</title>
</head>
<?php include_once '../user/consumer/header.php'; ?>

<body>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <?php
                    // Verifica se a imagem existe
                    $caminhoImagem = "../img/prod/{$produto['imagem']}";
                    if (!file_exists($caminhoImagem)) {
                        // Caso a imagem não exista, usa uma imagem padrão
                        $caminhoImagem = "https://dummyimage.com/600x700/dee2e6/6c757d.jpg";
                    }
                    ?>
                    <img class="card-img-top img-fluid" src="<?php echo $caminhoImagem; ?>" alt="Produto: <?php echo $produto['nome']; ?>" />
                </div>

                <div class="col-md-6">
                    <!-- Category -->
                    <div class="small mb-1">Categoria: <?php echo $produto['categoria']; ?></div>

                    <!-- Product Name -->
                    <h1 class="display-5 fw-bolder text-warning"><?php echo $produto['nome']; ?></h1>

                    <!-- Product Price (With/Without Discount) -->
                    <div class="fs-5 mb-5">
                        <?php if ($produto['oferta'] > 0) : ?>
                            <span class="text-decoration-line-through">$<?php echo number_format($produto['preco'], 2, '.', ','); ?></span>
                            <span class="text-warning-emphasis">$<?php echo number_format($produto['preco'] * (1 - $produto['oferta'] / 100), 2, '.', ','); ?></span>
                        <?php else: ?>
                            <span class="text-warning-emphasis">$<?php echo number_format($produto['preco'], 2, '.', ','); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Product Description -->
                    <p class="lead"><?php echo $produto['descricao']; ?></p>

                    <!-- Quantity Input and Add to Cart Button -->
                    <div class="d-flex">
                        <form action="../user/consumer/index.php" method="post">
                            <input name="qtd" class="form-control text-center me-3" id="inputQuantity"
                                type="number" value="1" 
                                min="1" 
                                max="<?= intval($produto['qtd_estoque']); ?>" 
                                style="max-width: 4rem" />
                            <input name="id" type="hidden" value="<?=$produto['idProduto']?>">
                            <button class="btn btn-outline-warning flex-shrink-0" type="submit">
                                <i class="bi bi-cart fs-4 text-warning"></i>
                                <span class="text-warning">Adicionar</span>
                            </button>
                            <a href="../user/consumer/index.php" class="ms-3 btn btn-secondary">Voltar</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>