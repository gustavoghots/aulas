<?php
session_start();

include_once "../class/produto.class.php";
include_once "../class/DAO/produtoDAO.class.php";

if(!isset($_SESSION['logadoAdm'])){
    header("location=../login.php");
}

$id = $_GET['id'];

$objProdutosDAO = new Produto_DAO();
$retorno = $objProdutosDAO->retornarProduto($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Produto</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .product-image {
            max-width: 200px;
            height: auto;
            float: right;
            margin-left: 20px;
        }
    </style>
</head>
<body>
<p><a href="index.php">Voltar</a></p>
<h1>Detalhes do Produto</h1>

<table>
    <tr>
        <th>Nome</th>
        <td><?php echo $retorno['nome']; ?></td>
    </tr>
    <tr>
        <th>Preço</th>
        <td>R$ <?php echo number_format($retorno['preco'], 2, ',', '.'); ?></td>
    </tr>
    <tr>
        <th>Descrição</th>
        <td><?php echo $retorno['descricao']; ?></td>
    </tr>
    <tr>
        <th>Quantidade em Estoque</th>
        <td><?php echo $retorno['qtd_estoque']; ?></td>
    </tr>
    <tr>
        <th>Imagem</th>
        <td><img src="<?php echo "../img/".$retorno['imagem']; ?>" alt="Imagem do Produto" class="product-image"></td>
    </tr>
</table>

</body>
</html>
