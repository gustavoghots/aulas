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
    ?>

    <div class="container mt-5 w-75">
        <h2>Adicionar Categoria</h2>

        <!-- Verifica se há uma mensagem de sucesso ou erro -->
        <?php
        if (isset($_GET['OK'])) {
            echo "<p class='text-success'>Categoria adicionada com sucesso!</p>";
        } elseif (isset($_GET['NOK'])) {
            echo "<p class='text-danger'>Erro ao adicionar a categoria.</p>";
        }
        ?>

        <!-- Formulário para adicionar uma categoria -->
        <form action="adicionar_ok.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    </main>
</body>