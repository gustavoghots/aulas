<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location: ../login.php");
    }
    @include_once '../class/produto.class.php';
    @include_once '../class/DAO/produtoDAO.class.php';

    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $oferta = $_POST["oferta"];
    $qtd_estoque = $_POST["qtd_estoque"];
    $Categoria_idCategoria = $_POST["Categoria_idCategoria"];

    $nomeImagem = $_FILES['imagem']['name'];
    $tmpImagem = $_FILES['imagem']['tmp_name'];
    $direcao = "../img/".$nomeImagem;
    if(!move_uploaded_file($tmpImagem,$direcao)) 
        header("Location:cadastar.php?error");

    $objProduto = new Produto();
    $objProduto->setNome($nome);
    $objProduto->setPreco($preco);
    $objProduto->setDescricao($descricao);
    $objProduto->setOferta($oferta);
    $objProduto->setImagem($nomeImagem);
    $objProduto->setQtdEstoque($qtd_estoque);
    $objProduto->setCategoriaIdCategoria($Categoria_idCategoria);

    $objProdutoDAO = new Produto_DAO();
    $retorno = $objProdutoDAO->inserir($objProduto);
    $oferta = $objProdutoDAO->ofertar($objProduto);
    if($retorno && $oferta) header("Location:../usuario/adm/index.php?prodOk");
?>