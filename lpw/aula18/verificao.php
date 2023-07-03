<?php
    include_once 'Login.php';
    $obj_login = new Login($_POST['login'], $_POST['senha']);
    if ($obj_login->getLogin() == NULL || $obj_login->getSenha() == NULL){
        echo "Campo vazio";
    }elseif($obj_login->getLogin() == 'Gustavo' || $obj_login->getSenha() == 'Fiss'){
        echo "<h2>Dados Login</h2>";
        echo "<ul>";
        echo "<li>Login: ".$obj_login->getLogin()."</li>";
        echo "<li>Senha: ".$obj_login->getSenha()."</li>";
        echo "</ul>";
    }else{
        echo "Login Incorreto";
    }
?>