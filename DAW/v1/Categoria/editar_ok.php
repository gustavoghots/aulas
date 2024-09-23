<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../usuario/login.php");
    }
    include_once '../class/Categoria.class.php';
    include_once '../class/DAO/CategoriaDAO.class.php';

    $descricao = $_POST["descricao"];
    $idCategoria = $_POST['idCategoria'];

    $objCategoria = new Categoria();
    $objCategoria->setDescricao($descricao);
    $objCategoria->setIdCategoria($idCategoria);

    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->editar($objCategoria);
    if($retorno) header("Location:listar.php?atualizarOk");
    else header("Location:listar.php?atualizarNOk");
?>