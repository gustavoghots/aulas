<pre>
<?php
    session_start();
    include_once "../class/usuario.class.php";
    include_once "../class/DAO/usuarioDAO.class.php";
    $login = $_POST["login"];
    $senha = $_POST["password"];

    $objUsuario = new usuario();
    $objUsuario->setUsuario($login);
    $objUsuario->setSenha($senha);

    $objUsuarioDAO = new usuario_DAO();
    $retorno = $objUsuarioDAO->login($objUsuario);
    
    if($retorno==0){
        header('Location:login.php?login='.$login);
    }else if($retorno==1){
        header('Location:login.php?senha&login='.$login);
    }else{
        $_SESSION['idUsuario']=$retorno['idUsuario'];
        $_SESSION['usuario']=$retorno['usuario'];
        if($retorno['adm']==true){
            $_SESSION['adm']=true;
            header("Location:adm/index.php");
        }else{
            header("Location:../site/index.php");
        }
    }
?>
