<?php
    include_once 'conexão.php';
    $cidade = mysqli_query($con,"
    select c.nome as nome_cidade, e.nome as nome_estado
    from cidade c inner join estado e
        on e.id = c.estado
    where c.estado=23");
    while ($linha = mysqli_fetch_assoc($cidade)) {
        echo $linha['nome_estado']." - ". $linha['nome_cidade']."<br>";
    }
?>