<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location: ../login.php");
    }
    include_once '../class/produto.class.php';
    include_once '../class/DAO/produtoDAO.class.php';

    $idProduto = $_POST['idProduto'];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $qtd_estoque = $_POST["qtd_estoque"];
    $idCategoria = $_POST['categoria'];

    $objProdutoDAO = new Produto_DAO();
    if($_FILES['imagem']['name']!=null){
        $nomeImagem = $_FILES['imagem']['name'];
        $tmpImagem = $_FILES['imagem']['tmp_name'];
        $direcao = "../img/".$nomeImagem;
        if(!move_uploaded_file($tmpImagem,$direcao)) header("Location:editar.php?error");
    }else{
        $nomeImagem = $objProdutoDAO->retornarProduto($idProduto)['imagem'];        
    }


    $objProduto = new Produto();
    $objProduto->setIdProduto($idProduto);
    $objProduto->setNome($nome);
    $objProduto->setDescricao($descricao);
    $objProduto->setPreco($preco);
    $objProduto->setQtdEstoque($qtd_estoque);
    $objProduto->setImagem($nomeImagem);
    $objProduto->setCategoriaIdCategoria($idCategoria);

    $retorno = $objProdutoDAO->editar($objProduto);
    if($retorno) header("Location:listar.php?atualizarOk");
    else header("Location:listar.php?atualizarNOk");
?>