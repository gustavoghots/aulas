<?php
session_start();

include_once "../class/produto.class.php";
include_once "../class/DAO/produtoDAO.class.php";

if (isset($_GET['carrinho'])) {
	$_SESSION['carrinho'][$_GET['id']] = 1;
	echo "Inserido ao carrinho com sucesso";

	echo "<pre>";
	print_r($_SESSION['carrinho']);
	echo "</pre>";
}
if (isset($_GET['C_null']))
	echo "carrinho vazio";

$objProdutoDAO = new Produto_DAO();
$retorno = $objProdutoDAO->listar();
?>
<p><a href="carrinho.php">Carrinho</a></p>
<table border>
	<thead>
		<th>Nome</th>
		<th>Categoria</th>
		<th>Valor</th>
		<th>Foto</th>
		<th colspan="2">Ações</th>
	</thead>
	<tbody>
		<?php
		foreach ($retorno as $linha) {
			if ($linha['qtd_estoque'] > 0) {
				$objProduto = new Produto();
				$objProduto->setPreco($linha['preco']);
				$objProduto->setOferta($linha['oferta']);
		?>
				<tr>
					<td><?= $linha["nome"] ?></td>
					<td><?= $linha["categoria"] ?></td>
					<td>
						<?php
						if ($objProduto->getPrecoOferta() != $linha['preco']) {
							echo "<del>" . $linha['preco'] . "</del><br>" . number_format($objProduto->getPrecoOferta(), 2, '.', '');
						} else {
							echo $linha['preco'];
						}
						?>
					</td>
					<td><img width="100" src="../img/<?= $linha["imagem"] ?>" /></td>
					<td>
						<a href="vermais.php?id=<?= $linha['idProduto']; ?>">
							Ver mais
						</a>
					</td>
					<td>
						<a href="?id=<?= $linha['idProduto']; ?>&carrinho">
							Adicionar
						</a>
					</td>
				</tr>
		<?php
			}
		}
		?>