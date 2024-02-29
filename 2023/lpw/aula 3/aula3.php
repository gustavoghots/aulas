<?php
    include_once 'Hotweels.php';
    include_once 'Pessoa.php';
    $carro[0]= new Hotwheels($_POST['modelo'],$_POST['cor'],$_POST['ano']);
    $carro[1]= new Hotwheels('camaro', 'amarelo', '2013');
    $pessoa[0]= new Pessoa($_POST['nome'],$_POST['idade'],$_POST['endereco']);
    $pessoa[1]= new Pessoa('Gustavo', '17', 'Valirinte Ribeiro');
    for($i=0; $i<2; $i++){
        echo "<h2>Dados do Hotwheels $i:</h2>";
        echo "<ul>";
        echo "<li>Modelo: " . $carro[$i]->getModelo() . "</li>";
        echo "<li>Cor: " . $carro[$i]->getCor() . "</li>";
        echo "<li>Ano: " . $carro[$i]->getAno() . "</li>";
        echo "</ul>";
    }
    for($i=0; $i<2; $i++){
        echo "<h2>Dados da Pessoa $i:</h2>";
        echo "<ul>";
        echo "<li>Nome: " . $pessoa[$i]->getNome() . "</li>";
        echo "<li>Idade: " . $pessoa[$i]->getIdade() . "</li>";
        echo "<li>Endereço: " . $pessoa[$i]->getEndereco() . "</li>";
        echo "</ul>";
    }
?>