<html>
	<body>
		<form method="POST" action="">
      <h1>Pessoa</h1>
      <label>Nome:</label><br>
      <input type="text" name="nome" required><br><br>
      <label>Idade:</label><br>
      <input type="text" name="idade" required><br><br>
      <label>Cpf:</label><br>
      <input type="text" name="cpf" required><br><br>
      <input type="submit" value="Enviar"><br><br><br>
		</form>
	</body>
</html>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once 'fisica.php';
    include_once 'juridica.php';
    include_once 'pessoa.php';
    $f[0] = new Fisica($_POST['nome'],$_POST['idade']);
    $f[0]->SetCpf($_POST['cpf']);
    echo "<h2>Dados da Pessoa:</h2>";
            echo "<ul>";
            echo "<li>Nome: " . $f[0]->getNome() . "</li>";
            echo "<li>Idade: " . $f[0]->getIdade() . "</li>";
            echo "<li>Cpf: " . $f[0]->getCPF() . "</li>";
            echo "</ul>";
  }
?>