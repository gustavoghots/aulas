<pre>
<?php
    session_start();
    include_once "../class/usuario.class.php";
    include_once "../class/usuarioDAO.class.php";
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
        if($retorno['adm']==true){
            $_SESSION['idAdm']=$retorno['idUsuario'];
            header("Location:adm/index.php");
        }else{
            $_SESSION['idUsuario']=$retorno['idUsuario'];
            header("Location:usuario/index.php");
        }
        $_SESSION["logado"]=true;
    }
?>