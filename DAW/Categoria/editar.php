<?php
    session_start();
    if(!isset($_SESSION['logadoADM'])){
        header("Location=../usuario/login.php");
    }
    include_once '../class/categoria.class.php';
    include_once '../class/DAO/CategoriaDAO.class.php';

    $objCategoriaDAO = new Categoria_DAO();
    $idCategoria = $_GET['id'];
    $retorno = $objCategoriaDAO->retornarCategoria($idCategoria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
</head>
<body>
    <form action="editar_ok.php" method="POST">
                            
        <label for="usuario">Descricao:</label><br />
        <input type="text" id="descricao" name="descricao" value="<?=$retorno['descricao']?>" required><br /><br />

        <input type="hidden" name="idCategoria" value="<?=$retorno['idCategoria']?>">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>