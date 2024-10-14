<?php
    include_once '../class/DAO/CategoriaDAO.class.php';
    include_once '../class/categoria.class.php';

    
    $objCategoria = new Categoria();
    $objCategoria->setDescricao($_POST['nome']);


    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->inserir($objCategoria);

    if($retorno){
        header('Location: adicionar.php?OK');
    }else{
        header('Location: adicionar.php?NOK');
    }
?>