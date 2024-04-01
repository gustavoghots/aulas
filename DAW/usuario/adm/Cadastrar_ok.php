<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../../class/Usuario.class.php';
    include_once '../../class/UsuarioDAO.class.php';

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $CPF = $_POST["CPF"];
    $email = $_POST["email"];
    $numero = $_POST["numero"];

    $objUsuario = new Usuario();
    $objUsuario->setUsuario($usuario);
    $objUsuario->setSenha($senha);
    $objUsuario->setCPF($CPF);
    $objUsuario->setEmail($email);
    $objUsuario->setNumero($numero);
    $objUsuario->setAdm(true);

    $objUsuarioDAO = new Usuario_DAO();
    $retorno = $objUsuarioDAO->inserir($objUsuario);
    if($retorno) header("Location:index.php?admOK");
    else header("Location:cadastar.php?error");
?>