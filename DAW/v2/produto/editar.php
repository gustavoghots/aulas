<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php
    include_once '../user/ADM/header.php';
    include_once '../class/DAO/produtoDAO.class.php';
    include_once '../class/DAO/CategoriaDAO.class.php';

    // Obter o ID do produto a ser editado
    $idProduto = $_GET['id'];

    // Obter os dados do produto para edição
    $objProdutoDAO = new Produto_DAO();
    $produto = $objProdutoDAO->retornarProduto($idProduto);
    ?>

    <div class="container mt-5 w-75">
        <h2>Editar Produto</h2>

        <!-- Verifica se há uma mensagem de sucesso ou erro -->
        <?php
        if (isset($_GET['OK'])) {
            echo "<p class='text-success'>Produto atualizado com sucesso!</p>";
        } elseif (isset($_GET['NOK'])) {
            echo "<p class='text-danger'>Erro ao atualizar o Produto.</p>";
        }
        ?>

        <!-- Formulário para editar o produto -->
        <form action="editar_ok.php" method="POST" enctype="multipart/form-data" class="mb-3">
            <!-- Campo oculto para ID do produto -->
            <input type="hidden" name="idProduto" value="<?= htmlspecialchars($produto['idProduto']); ?>">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" id="preco" name="preco" class="form-control" value="<?= htmlspecialchars($produto['preco']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" id="descricao" name="descricao" class="form-control" value="<?= htmlspecialchars($produto['descricao']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" id="imagem" name="imagem" class="form-control" accept="image/*">
                <p class="form-text">Imagem atual: <?= htmlspecialchars($produto['imagem']); ?></p>
            </div>
            <div class="mb-3">
                <label for="oferta" class="form-label">Oferta</label>
                <input type="number" id="oferta" name="oferta" class="form-control" placeholder="colocar em %" value="<?= htmlspecialchars($produto['oferta']); ?>">
            </div>
            <div class="mb-3">
                <label for="qtd_estoque" class="form-label">Quantidade</label>
                <input type="number" id="qtd_estoque" name="qtd_estoque" class="form-control" value="<?= htmlspecialchars($produto['qtd_estoque']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Categoria_idCategoria" class="form-label">Categoria</label>
                <select class="form-select" id="Categoria_idCategoria" name="Categoria_idCategoria" required>
                    <option value="">-- Selecione --</option>
                    <?php
                    $objCategoria = new Categoria_DAO();
                    foreach ($objCategoria->listar() as $categoria) {
                        $selected = ($categoria['idCategoria'] == $produto['Categoria_idCategoria']) ? "selected" : "";
                        echo "<option value='" . htmlspecialchars($categoria['idCategoria']) . "' $selected>" . htmlspecialchars($categoria['descricao']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
