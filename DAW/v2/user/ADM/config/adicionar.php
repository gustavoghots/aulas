<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Administrador</title>
</head>

<body>
    <?php
    include_once '../header.php';
    ?>
    <div class="container mt-5 w-50">
        <h2>Adicionar Administrador</h2>

        <!-- Exibe mensagens de sucesso ou erro, se existirem -->
        <?php
        if (isset($_GET['NOK'])) {
            echo "<p class='text-danger'>Erro ao adicionar o administrador.</p>";
        }
        ?>

        <!-- Formulário para adicionar administrador -->
        <form action="adicionar_ok.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" id="usuario" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="CPF" class="form-label">CPF</label>
                <input type="text" id="CPF" name="CPF" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" id="numero" name="numero" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-success">Adicionar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
