<html>
	<body>
		<form method="GET" action="">
      <h1>Pessoa</h1>
      <label>Nome:</label><br>
      <input type="text" name="nome" required><br><br>
      <label>Idade:</label><br>
      <input type="text" name="idade" required><br><br>
      <label>Cnpj:</label><br>
      <input type="text" name="cnpj" required><br><br>
      <input type="submit" value="Enviar"><br><br><br>
		</form>
	</body>
</html>
<?php
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include_once 'fisica.php';
    include_once 'juridica.php';
    include_once 'pessoa.php';
    $j[0] = new Juridica();
    @$j[0]->SetNome($_GET["nome"]);
    @$j[0]->SetIdade($_GET['idade']);
    @$j[0]->SetCnpj($_GET['cnpj']);
    if($j[0]->GetIdade()!=100){
        echo "<h2>Dados da Pessoa:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $j[0]->GetNome() . "</li>";    
        echo "<li>Idade: " . $j[0]->GetIdade() . "</li>";
        echo "<li>Cnpj: " . $j[0]->GetCnpj() . "</li>";
        echo "</ul>";
    }
  }
?>