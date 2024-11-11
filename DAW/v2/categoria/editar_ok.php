<?php
    include_once '../class/DAO/CategoriaDAO.class.php';
    include_once '../class/categoria.class.php';

    
    $objCategoria = new Categoria();
    $objCategoria->setDescricao($_POST['nome']);
    $objCategoria->setIdCategoria($_POST['id']);


    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->editar($objCategoria);

    if($retorno){
        header("Location: index.php?edit_OK");
    }else{
        header("Location: editar.php?NOK&&id=".$_POST['id']);
    }
?>