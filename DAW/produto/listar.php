<?php
	session_start();
	
	include_once "../class/produto.class.php";
	include_once "../class/DAO/produtoDAO.class.php";
	
	if(!isset($_SESSION['logadoAdm'])){
		header("location=../login.php");
	}
	$objProdutosDAO = new Produto_DAO();
	$retorno = $objProdutosDAO->listar();
	?>
	<p><a href="../usuario/adm/index.php">Voltar</a></p>
	<table border>
		<thead>
			<th>Nome</th>
			<th>Categoria</th>
			<th>Foto</th>
			<th colspan="3">Ações</th>
		</thead>
		<tbody>
	<?php
	foreach($retorno as $linha){
		?>
		<tr>
			<td><?=$linha["nome"]?></td>
			<td><?=$linha["categoria"]?></td>
			<td><img width="100" src="../img/<?=$linha["imagem"]?>" /></td>
			<td>
				<a href="vermais.php?id=<?=$linha['idProduto'];?>">
					Ver mais
				</a>
			</td>
			<td>
				<a href="editar.php?id=<?=$linha['idProduto'];?>">
					Editar
				</a>
			</td>
			<td>
				<a href="excluir.php?id=<?=$linha['idProduto'];?>">
					Excluir
				</a>
			</td>

		</tr>
		<?php
	}
	if(isset($_GET['InserirOk']))
		echo "Inserido com sucesso";
	if(isset($_GET['editarOk']))
		echo "Editado com sucesso";
	if(isset($_GET['editarNok']))
		echo "Editado sem sucesso";
	if(isset($_GET['deleteOk']))
		echo "Deletado com sucesso";
	if(isset($_GET['deleteNok']))
		echo "Deletado sem sucesso";
?>