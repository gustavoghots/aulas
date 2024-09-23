<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../usuario/login.php");
    }
    include_once '../class/produto.class.php';
    include_once '../class/DAO/produtoDAO.class.php';

    $objProdutoDAO = new Produto_DAO();
    $idProduto = $_GET['id'];
    $retorno = $objProdutoDAO->excluir($idProduto);
    if($retorno) header("Location:listar.php?deleteOk");
    else header("Location:listar.php?deleteNok");
?>