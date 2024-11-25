<?php
session_start();
include_once '../class/DAO/usuarioDAO.class.php';
include_once '../class/usuario.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario();
    $usuario->setUsuario($_POST['usuario']);
    $usuario->setCPF($_POST['CPF']);
    $usuario->setEmail($_POST['email']);
    $usuario->setNumero($_POST['numero']);
    $usuario->setSenha($_POST['senha']);
    $usuario->setAdm(0); // Se não for admin, define como 0

    // Verifique se as senhas coincidem
    if ($_POST['senha'] !== $_POST['senha_confirm']) {
        header('Location: cadastro.php?senha_confirm=erro');
        exit();
    }

    $usuarioDAO = new Usuario_DAO();
    $idUsuario = $usuarioDAO->inserir($usuario);
    if ($idUsuario) {
        $_SESSION['idUsuario']=$idUsuario;
        $_SESSION['usuario']=$_POST['usuario'];
        unset($_SESSION['adm']);

        header('Location: consumer/index.php');
    } else {
        header('Location: login.php?erro=1');
    }
}
?>
