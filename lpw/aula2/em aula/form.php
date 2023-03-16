<?php
	require_once 'Termica.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// cria um objeto$termica com os dados enviados pelo formulário
		$termica = new Termica($_POST['cor'], $_POST['marca'], $_POST['modelo'], $_POST['agua']);
		if($termica->getagua()==1){
			$termica->setagua(100);
		}elseif($termica->getagua()==0){
			$temp = $termica->getagua()-5;
			$termica->setagua($temp);
		}
	} else {
		// cria um objeto$termica com valores padrão vazios
		$termica = new Termica('', '', '', '', '');
		$_POST['agua']=0;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Formulário Termica</title>
		<link rel="stylesheet" href="estilo.css">
	</head>
	<body>
		<h1>Termica</h1>
		<div class="container"></div>
		<form method="POST" class="box">
			<label>Cor:</label><br>
			<input type="text" name="cor" value="<?= $termica->getCor() ?>" required><br><br>
			<label>Marca:</label><br>
			<input type="text" name="marca" value="<?= $termica->getMarca() ?>" required><br><br>
			<label>Modelo:</label><br>
			<input type="text" name="modelo" value="<?= $termica->getModelo() ?>" required><br><br>
			<input type="radio" value="1">
			<label>Encher</label><br>
			<input type="radio" name="mudar" value="0">
			<label>Esvaziar</label></label><br><br>
			<input type="hidden" name="agua">
			<input type="submit" name="mudar" value="Enviar"><br>
		</form>
		<div class="box"><h1></h1></div>
	</body>
</html>
