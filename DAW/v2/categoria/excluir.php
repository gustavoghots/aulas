<?php
    include_once '../class/DAO/CategoriaDAO.class.php';

    $objCategoriaDAO = new Categoria_DAO();
    $retorno = $objCategoriaDAO->excluir($_GET['id']);

    if($retorno){
        header('Location: index.php?delete_OK');
    }else{
        header('Location: index.php?delete_NOK');
    }
?>