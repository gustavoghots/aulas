<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../usuario/login.php");
    }
    include_once '../class/Categoria.class.php';
    include_once '../class/DAO/CategoriaDAO.class.php';

    $objCategoriaDAO = new Categoria_DAO();
    $idCategoria = $_GET['id'];
    $retorno = $objCategoriaDAO->excluir($idCategoria);
    if($retorno) header("Location:listar.php?deleteOk");
    else header("Location:listar.php?deleteNOk");
?>