<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../login.php");
    }
    include_once '../../class/Usuario.class.php';
    include_once '../../class/DAO/UsuarioDAO.class.php';

    if(isset($_GET['deleteOk'])){
        echo "<p style='color: red;'>Administrador excluido com sucesso</p>";
    }elseif(isset($_GET['deleteNOk'])){
        echo "<p style='color: red;'>Não foi possivel deletar o usuario</p>";
    }
    if(isset($_GET['atualizarOk'])) echo "<p style='color: red;'>Administrador atualizado com sucesso</p>";
    elseif(isset($_GET['atualizarNOk'])) echo "<p style='color: red;'>Não foi possivel atualizar os dados ADM</p>";
    

    $objUsuarioDAO = new Usuario_DAO();
    $retorno = $objUsuarioDAO->listar();
    
    foreach ($retorno as $i => $linha) {
        ?>
        <div style="border:1px solid; margin-bottom:2px;">
            <h3><?= $linha['usuario'];?></h3>
            <p><?=$linha['email'];?></p>
            <p><a href="editar.php?id=<?=$linha['idUsuario']?>">Editar</a></p>
            <p><a href="excluir.php?id=<?=$linha['idUsuario']?>">Excluir</a></p>
        </div>
    <?php
    }
?>