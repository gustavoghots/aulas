<?php
require_once 'Pessoa.php';

// define os valores padrão para o formulário
$id = '';
$nome = '';
$endereco = '';
$idade = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // atualiza os valores com os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $idade = $_POST['idade'];
    
    $pessoa = new Pessoa($id, $nome, $endereco, $idade);
}

?>

<form method="post">
    <label>ID:</label><br>
    <input type="text" name="id" value="<?php echo isset($pessoa) ? $pessoa->getId() : $id ?>"><br><br>
    
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo isset($pessoa) ? $pessoa->getNome() : $nome ?>"><br><br>
    
    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?php echo isset($pessoa) ? $pessoa->getEndereco() : $endereco ?>"><br><br>
    
    <label>Idade:</label><br>
    <input type="text" name="idade" value="<?php echo isset($pessoa) ? $pessoa->getIdade() : $idade ?>"><br><br>
    
    <input type="submit" value="Enviar">
</form>

<?php
// verifica se o objeto Pessoa foi criado antes de exibir os dados
if (isset($pessoa)) {
    echo "<h2>Dados da Pessoa:</h2>";
    echo "<ul>";
    echo "<li>ID: " . $pessoa->getId() . "</li>";
    echo "<li>Nome: " . $pessoa->getNome() . "</li>";
    echo "<li>Endereço: " . $pessoa->getEndereco() . "</li>";
    echo "<li>Idade: " . $pessoa->getIdade() . "</li>";
    echo "</ul>";
}
?>