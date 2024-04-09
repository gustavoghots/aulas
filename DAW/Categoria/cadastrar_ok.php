<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../class/categoria.class.php';
    include_once '../class/DAO/categoriaDAO.class.php';

    $nome = $_POST["nome"];

    $objCategoria = new Categoria();
    $objCategoria->setDescricao($nome);

    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->inserir($objCategoria);
    if($retorno) header("Location:../usuario/adm/index.php?catOk");
    else header("Location:cadastar.php?error");
?>