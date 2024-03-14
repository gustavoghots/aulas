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
            //echo "logado <br>";
            //echo password_hash($objUsuario->getSenha(), PASSWORD_BCRYPT)."<br>";
            $usuario=$objUsuarioDAO->dados($objUsuario);
            $objUsuario->setIdUsuario($usuario[0]);
            $objUsuario->setUsuario($usuario[1]);
            $objUsuario->setsenha($usuario[2]);
            $objUsuario->setCPF($usuario[3]);
            $objUsuario->setEmail($usuario[4]);
            $objUsuario->setNumero($usuario[5]);
            $objUsuario->setAdm($usuario[6]);
            print_r($objUsuario);
            
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