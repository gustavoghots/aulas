<?php
session_start();

if (!isset($_SESSION['logado'])) {
	header("location=../usuario/login.php");
}

if (isset($_GET['remover']))
    unset($_SESSION['carrinho'][$_GET['id']]);

if (empty($_SESSION['carrinho']))
    header("Location:index.php?C_null");


include_once "../class/produto.class.php";
include_once "../class/DAO/produtoDAO.class.php";

$objProdutoDAO = new Produto_DAO();

?>
<html>
<a href="index.php"><button>Voltar</button></a>
<table border>
    <thead>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Valor</th>
        <th>Foto</th>
        <th colspan="3">Ações</th>
    </thead>
    <tbody>
        <form action="carrinho_ok.php" method="post">

</html>
<?php
$objProduto = new Produto();
foreach ($_SESSION['carrinho'] as $idProduto => $quantidade) {
    $retorno = $objProdutoDAO->retornarProduto($idProduto);
    $objProduto->setPreco($retorno['preco']);
    $objProduto->setOferta($retorno['oferta']);
?>
    <html>
    <tr>
        <td><?= $retorno["nome"] ?></td>
        <td><?= $retorno["categoria"] ?></td>
        <td>
            <?php
            if ($objProduto->getPrecoOferta() != $retorno['preco']) {
                echo "<del>" . $retorno['preco'] . "</del><br>" . number_format($objProduto->getPrecoOferta(), 2, '.', '');
            } else {
                echo $retorno['preco'];
            }
            ?>
        </td>
        <td><img width="100" src="../img/<?= $retorno["imagem"] ?>" /></td>
        <td>
            <input type="number" name="quantidade_<?=$idProduto?>" value="<?= $quantidade; ?>"
            min="1" max="<?=$retorno['qtd_estoque']?>"><br>
        </td>
        <td>
            <a href="vermais.php?id=<?= $retorno['idProduto']; ?>">
                Ver mais
            </a>
        </td>
        <td>
            <a href="?id=<?= $retorno['idProduto']; ?>&remover">
                Remover
            </a>
        </td>
    </tr>

    </html>
<?php
}
?>
<html>
    </tbody>
    </table>
<button type="submit">Finalizar</button>
<h2>Pagamento e entrega</h2>
Forma de pagamento:<br><input type="text" name="pagamento"><br>
Endereço de entrega:<br><input type="text" name="entrega">
</html>