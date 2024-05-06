<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../../class/usuario.class.php';
    include_once '../../class/DAO/UsuarioDAO.class.php';

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
    $objUsuario->setAdm(false);

    if($objUsuario->SenhaNosParametros()){
        $objUsuarioDAO = new Usuario_DAO();
        $retorno = $objUsuarioDAO->inserir($objUsuario);
    }
    if($retorno) header("Location:index.php");
    else header("Location:Cadastrar.php?error");
