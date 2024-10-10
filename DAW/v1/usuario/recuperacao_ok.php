<?php
session_start();
@include_once '../class/DAO/usuarioDAO.class.php';
@include_once '../class/usuario.class.php';

$usuarioDAO = new Usuario_DAO();
$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['senha_nova'], $_POST['confirmar_senha'])) {
    $senhaNova = $_POST['senha_nova'];
    $confirmarSenha = $_POST['confirmar_senha'];
    $idUsuario = $_SESSION['idUsuario']; // Assumindo que o ID do usuário está salvo na sessão após a verificação

    // Verifica se as senhas coincidem
    if ($senhaNova === $confirmarSenha) {
        // Cria o objeto Usuario e define a nova senha
        $usuario = new Usuario();
        $usuario->setIdUsuario($idUsuario);
        $usuario->setSenha($senhaNova);

        // Chama a função para atualizar a senha
        try {
            $usuarioDAO->recuperar($usuario);
            // Redireciona para a página inicial
            header('Location: login.php');
            exit();
        } catch (Exception $e) {
            $mensagemErro = "Erro ao atualizar a senha. Tente novamente.";
        }
    } else {
        $mensagemErro = "As senhas não coincidem. Por favor, tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>
<body>
    <h2>Recuperação de Senha</h2>

    <?php
    // Exibe mensagem de erro, se houver
    if ($mensagemErro != '') {
        echo "<p style='color: red;'>$mensagemErro</p>";
    }
    ?>

    <!-- Formulário para inserir a nova senha -->
    <form action="recuperacao_ok.php" method="POST">
        <label for="senha_nova">Digite a nova senha:</label><br>
        <input type="password" id="senha_nova" name="senha_nova" required><br><br>

        <label for="confirmar_senha">Confirme a nova senha:</label><br>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required><br><br>

        <button type="submit">Atualizar Senha</button>
    </form>
</body>
</html>
