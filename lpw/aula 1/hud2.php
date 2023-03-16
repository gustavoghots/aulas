<?php
require_once 'Pessoa.php';

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // cria um objeto Pessoa com os dados enviados pelo formulário
    $pessoa = new Pessoa($_POST['id'], $_POST['nome'], $_POST['endereco'], $_POST['idade']);
} else {
    // cria um objeto Pessoa com valores padrão vazios
    $pessoa = new Pessoa('', '', '', '');
}

?>

<form method="post">
    <label>ID:</label><br>
    <input type="text" name="id" value="<?= $pessoa->getId() ?>"><br><br>
    
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= $pessoa->getNome() ?>"><br><br>
    
    <label>Endereço:</label><br>
    <input type="text" name="endereco" value="<?= $pessoa->getEndereco() ?>"><br><br>
    
    <label>Idade:</label><br>
    <input type="text" name="idade" value="<?= $pessoa->getIdade() ?>"><br><br>
    
    <input type="submit" value="Enviar">
</form>

<?php
// verifica se o objeto Pessoa foi criado antes de exibir os dados
if ($pessoa->getId() !== '') {
    echo "<h2>Dados da Pessoa:</h2>";
    echo "<ul>";
    echo "<li>ID: " . $pessoa->getId() . "</li>";
    echo "<li>Nome: " . $pessoa->getNome() . "</li>";
    echo "<li>Endereço: " . $pessoa->getEndereco() . "</li>";
    echo "<li>Idade: " . $pessoa->getIdade() . "</li>";
    echo "</ul>";
}
?>