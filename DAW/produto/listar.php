<?php
session_start();

include_once "../class/produto.class.php";
include_once "../class/DAO/produtoDAO.class.php";

if (!isset($_SESSION['logadoAdm'])) {
	header("Location: ../login.php");
}
$objProdutoDAO = new Produto_DAO();
$retorno = $objProdutoDAO->listar();
?>
<p><a href="../usuario/adm/index.php">Voltar</a></p>
<table border>
	<thead>
		<th>Nome</th>
		<th>Categoria</th>
		<th>Valor</th>
		<th>Foto</th>
		<th colspan="4">Ações</th>
	</thead>
	<tbody>
		<?php
		foreach ($retorno as $linha) {
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
				<td><a href="ofertar.php?id=<?= $linha['idProduto']; ?>">Ofertar</a></td>
				<td>
					<a href="vermais.php?id=<?= $linha['idProduto']; ?>">
						Ver mais
					</a>
				</td>
				<td>
					<a href="editar.php?id=<?= $linha['idProduto']; ?>">
						Editar
					</a>
				</td>
				<td>
					<a href="excluir.php?id=<?= $linha['idProduto']; ?>">
						Excluir
					</a>
				</td>

			</tr>
		<?php
		}
		if (isset($_GET['InserirOk']))
			echo "Inserido com sucesso";
		if (isset($_GET['editarOk']))
			echo "Editado com sucesso";
		if (isset($_GET['editarNok']))
			echo "Editado sem sucesso";
		if (isset($_GET['deleteOk']))
			echo "Deletado com sucesso";
		if (isset($_GET['deleteNok']))
			echo "Deletado sem sucesso";
		?>