<?php
    include_once 'conexão.php';
    $pesquisa=mysqli_query($con, "select* from usuario where login='".$_POST['login']."'and senha='".$_POST['senha']."'");
    if(mysqli_num_rows($pesquisa)){
        echo 'Login efetuado';
    }else{
        echo 'Login Invalido';
    }
?>