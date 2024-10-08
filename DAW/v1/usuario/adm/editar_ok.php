<?php
session_start();
if (!isset($_SESSION['logadoADM'])) {
    header("Location: ../login.php");
}
include_once '../../class/Usuario.class.php';
include_once '../../class/DAO/UsuarioDAO.class.php';

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$CPF = $_POST["CPF"];
$email = $_POST["email"];
$numero = $_POST["numero"];
$adm = $_POST['adm'];
$idUsuario = $_POST['idUsuario'];

$objUsuario = new Usuario();
$objUsuario->setUsuario($usuario);
$objUsuario->setCPF($CPF);
$objUsuario->setEmail($email);
$objUsuario->setNumero($numero);
$objUsuario->setAdm($adm);
$objUsuario->setIdUsuario($idUsuario);
$objUsuario->setSenha($senha);

$objUsuarioDAO = new Usuario_DAO();
if ($objUsuario->getSenha() != null) {
    if (
        !$objUsuario->SenhaNosParametros() || $_SESSION['idAdm'] != $idUsuario
        || $objUsuarioDAO->retornarADM($idUsuario)['senha'] == $objUsuario->getSenha()
    ) {
        header("Location:listar.php?atualizarNOk");
        exit();
    }
}else{
    $senha = $objUsuarioDAO->retornarADM($idUsuario)['senha'];
}
$objUsuario->setSenha($senha);

$retorno = $objUsuarioDAO->editar($objUsuario);
if ($retorno)
    header("Location:listar.php?atualizarOk");
else
    header("Location:listar.php?atualizarNOk");