<?php
session_start();
@include_once '../class/DAO/usuarioDAO.class.php';
@include_once '../class/usuario.class.php';


// Verifica se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header('Location: login.php');
    exit();
}

// Instancia o objeto Usuario_DAO
$usuarioDAO = new Usuario_DAO(); // $pdo é a conexão com o banco de dados

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém a senha atual, nova senha e confirmação da nova senha
    $senhaAntiga = $_POST['senha_A'];
    $senhaNova = $_POST['senha_N'];
    $senhaNova2 = $_POST['senha_N2'];

    // Validação: as novas senhas devem ser iguais
    if ($senhaNova !== $senhaNova2) {
        echo "As novas senhas não são compatíveis.";
        exit();
    }

    // Cria um objeto usuario e define os valores necessários
    $usuario = new usuario();
    $usuario->setIdUsuario($_SESSION['idUsuario']);
    $usuario->setSenha("$senhaAntiga $senhaNova"); // Concatenando para passar para a função

    // Chama a função para trocar a senha
    $resultado = $usuarioDAO->trocarSenha($usuario);

    // Exibe o resultado
    echo $resultado;
}
?>
