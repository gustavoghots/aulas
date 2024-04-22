<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
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
    if(move_uploaded_file($tmpImagem,$direcao)) echo "Arquivo adicionado";
    else echo "Arquivo não adicionado";

    $objProduto = new Produto();
    $objProduto->setNome($nome);
    $objProduto->setNome($preco);
    $objProduto->setNome($descricao);
    $objProduto->setNome($oferta);
    $objProduto->setNome($nomeImagem);
    $objProduto->setNome($qtd_estoque);
    $objProduto->setNome($Categoria_idCategoria);

    /*$objCategoriaDAO = new Produto_DAO();
    $retorno = $objCategoriaDAO->inserir($objCategoria);
    if($retorno) header("Location:../usuario/adm/index.php?catOk");
    else header("Location:cadastar.php?error");*/
?>