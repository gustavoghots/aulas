<?php
	session_start();
	
	include_once "../class/produto.class.php";
	include_once "../class/DAO/produtoDAO.class.php";
	
	if(!isset($_SESSION['logadoAdm'])){
		header("location=../login.php");
	}
    $oferta = $_POST['oferta'];
    $idProduto = $_POST['idProduto'];

    $objProduto = new Produto();
    $objProduto->setIdProduto($idProduto);
    $objProduto->setOferta($oferta);

    $objProdutoDAO = new Produto_DAO();
    $retorno = $objProdutoDAO->ofertar($objProduto);
    if($retorno) 
        header("Location:listar.php?atualizarOk");
    else 
        header("Location:listar.php?atualizarNOk");
        
