<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location: ../login.php");
    }
    include_once '../../class/Usuario.class.php';
    include_once '../../class/DAO/UsuarioDAO.class.php';

    $objUsuarioDAO = new Usuario_DAO();
    $idUsuario = $_GET['id'];
    $retorno = $objUsuarioDAO->excluir($idUsuario);
    if($retorno) header("Location:listar.php?deleteOk");
    else header("Location:listar.php?deleteNOk");
?>