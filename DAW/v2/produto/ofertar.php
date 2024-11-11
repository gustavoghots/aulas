<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertar Produto</title>
</head>

<body>
    <?php
    // Inclui o cabeçalho e o DAO do Produto
    include_once '../user/ADM/header.php';
    include_once '../class/DAO/produtoDAO.class.php';

    // Verifica se o ID do produto foi passado via GET
    if (!isset($_GET['id'])) {
        echo "<p>Produto não encontrado.</p>";
        exit;
    }

    // Obtém o ID do produto e carrega os dados do produto
    $idProduto = $_GET['id'];
    $objProdutoDAO = new Produto_DAO();
    $produto = $objProdutoDAO->retornarProduto($idProduto);

    if (!$produto) {
        echo "<p>Produto não encontrado.</p>";
        exit;
    }
    ?>

    <div class="container mt-5 w-50">
        <h2>Definir Oferta para: <?= htmlspecialchars($produto['nome']); ?></h2>

        <?php
        if (isset($_GET['NOK'])) {
            echo "<p class='text-danger'>Erro ao atualizar o Produto.</p>";
        }
        ?>
        <!-- Formulário para definir a oferta -->
        <form action="ofertar_ok.php" method="POST" class="mb-3">
            <input type="hidden" name="idProduto" value="<?= htmlspecialchars($idProduto); ?>">

            <div class="mb-3">
                <label for="oferta" class="form-label">Valor da Oferta (%)</label>
                <input type="number" id="oferta" name="oferta" class="form-control" placeholder="Digite a oferta em %" required>
            </div>

            <button type="submit" class="btn btn-success">Salvar Oferta</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>