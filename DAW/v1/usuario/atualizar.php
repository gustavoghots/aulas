<?php
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Troca de Senha</title>
</head>
<body>
    <form action="atualizar_ok.php" method="POST">
        <label for="senha_A">Senha Atual:</label>
        <input type="password" id="senha_A" name="senha_A" required><br><br>

        <label for="senha_N">Nova Senha:</label>
        <input type="password" id="senha_N" name="senha_N" required><br><br>

        <label for="senha_N2">Confirme a Nova Senha:</label>
        <input type="password" id="senha_N2" name="senha_N2" required><br><br>

        <button type="submit">Trocar Senha</button>
    </form>
</body>
</html>
