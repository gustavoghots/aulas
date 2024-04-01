<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../../class/Usuario.class.php';
    include_once '../../class/UsuarioDAO.class.php';

    $objUsuarioDAO = new Usuario_DAO();
    $retorno = $objUsuarioDAO->listar();
    
    foreach ($retorno as $i => $linha) {
        ?>
        <div style="border:1px solid; margin-bottom:2px;">
            <h3><?= $linha['usuario'];?></h3>
            <p><?=$linha['email'];?></p>
        </div>
    <?php
    }
?>