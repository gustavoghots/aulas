<?php
// Inclui as classes necessárias
include_once '../../../class/DAO/usuarioDAO.class.php';
include_once '../../../class/usuario.class.php';

// Cria uma instância de Usuario_DAO e Usuario
$objUsuarioDAO = new Usuario_DAO();
$usuario = new Usuario();

try {
    // Define os valores dos campos com base nos dados do formulário
    $usuario->setUsuario($_POST['usuario']);
    $usuario->setSenha($_POST['senha']); // A senha será hasheada na função inserir
    $usuario->setCPF($_POST['CPF']);
    $usuario->setEmail($_POST['email']);
    $usuario->setNumero($_POST['numero']);
    $usuario->setAdm(true); // Define que é um administrador

    // Tenta inserir o novo administrador
    if ($objUsuarioDAO->inserir($usuario)) {
        header("Location: index.php?add_OK"); // Redireciona em caso de sucesso
    } else {
        header("Location: adicionar.php?NOK"); // Redireciona em caso de erro
    }
} catch (Exception $e) {
    // Redireciona com mensagem de erro em caso de exceção
    header("Location: adicionar.php?NOK");
}
?>
