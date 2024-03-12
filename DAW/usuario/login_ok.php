<pre>
<?php
    include_once "../class/usuario.class.php";
    include_once "../class/usuarioDAO.class.php";
    $login = $_POST["login"];
    $senha = $_POST["password"];

    $objUsuario = new usuario();
    $objUsuario->setUsuario($login);
    $objUsuario->setSenha($senha);

    $objUsuarioDAO = new usuario_DAO();
    $retorno = $objUsuarioDAO->login($objUsuario);
    session_start();
    if($retorno){
        $retorno = $objUsuarioDAO->senha($objUsuario);
        if($retorno){
            echo "logado <br>";
            echo password_hash($objUsuario->getSenha(), PASSWORD_BCRYPT)."<br>";
            //print_r($retorno);
        }else{
            $_SESSION['senha_erro'] = TRUE;
            $_SESSION['log_val'] = $_POST['email'];
            header('Location: login.php');
        }
    }else{
        $_SESSION['log_erro'] = TRUE;
        $_SESSION['log_val'] = $_POST['email'];
        header('Location: login.php');
    }
?>