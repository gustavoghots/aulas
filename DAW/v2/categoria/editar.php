<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body class="overflow-hidden">
    <?php
    include_once '../user/ADM/header.php';
    include_once '../class/categoria.class.php';
    include_once '../class/DAO/CategoriaDAO.class.php';

    $objCategoriaDAO = new Categoria_DAO();
    $dadosCategoria = $objCategoriaDAO->retornarCategoria($_GET['id']);
    ?>

    <div class="container mt-5 w-75">
        <h2>Editar Categoria</h2>

        <!-- Verifica se há uma mensagem de sucesso ou erro -->
        <?php
        if (isset($_GET['NOK'])) {
            echo "<p class='text-danger'>Erro ao editar a categoria.</p>";
        }
        ?>

        <!-- Formulário para adicionar uma categoria -->
        <form action="editar_ok.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Novo nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" required
                value="<?=$dadosCategoria['descricao']?>">
                <input type="hidden" name="id" value="<?=$dadosCategoria['idCategoria']?>">
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    </main>
</body>