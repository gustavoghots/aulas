<?php
    include_once 'conexão.php';
    include_once 'cidade.php';
    include_once 'estado.php';
    $cidade = mysqli_query($con,"select * from cidade");
    $estado = mysqli_query($con,"select * from estado where id=23");
    while ($linha = mysqli_fetch_assoc($cidade)) {
        $obj_cidade[] = new Cidade($linha['id'],$linha['nome'],$linha['estado']);
    }
    while ($linha = mysqli_fetch_assoc($estado)) {
        $obj_estado[] = new Estado($linha['id'],$linha['nome'],$linha['uf'],$linha['pais']);
    }

    foreach ($obj_cidade as $obj_cidade){
        echo $obj_cidade->getId()." - ".$obj_cidade->getNome()." - ".$obj_estado[0]->getNome()."<br>";
    }
?>