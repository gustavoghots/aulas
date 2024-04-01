<?php
    session_start();
    if(!isset($_SESSION['logado'])){
        header("Location:../login.php");
    }
    if(isset($_GET['admOk'])) echo "Novo administrador cadastrado com sucesso!"
?>
<h2>Menu</h2>
<a href="cadastrar.php">Cadastrar Administrador</a><br/><br/>
<a href="listar.php">Listar Administrador</a>