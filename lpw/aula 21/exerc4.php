<?php
    include_once 'conexão.php';
    include_once 'cidade.php';
    $cidade = mysqli_query($con,"select * from cidade");
    while ($linha = mysqli_fetch_assoc($cidade)) {
        $obj_cidade = new Cidade($linha['id'],$linha['nome'],$linha['estado']);
        $lista[] = $obj_cidade;
    }
    foreach ($lista as $lista){
        echo $lista->getId()." - ".$lista->getnome()." - ".$lista->getestado()."<br>";
    }
?>