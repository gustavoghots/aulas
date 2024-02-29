<?php
// Conexão com o banco de dados (substitua pelos seus dados)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clientes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

if (isset($_POST['term'])) {
  $term = $_POST['term'];

  // Query para buscar nomes com base no termo digitado
  $sql = "SELECT nome FROM pessoas WHERE nome LIKE '$term%'";
  $result = $conn->query($sql);

  $data = array();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row['nome'];
    }
  }

  // Envia os nomes como JSON
  header('Content-Type: application/json');
  echo json_encode($data);
}

$conn->close();
