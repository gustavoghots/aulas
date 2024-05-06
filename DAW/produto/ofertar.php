<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertar</title>
</head>

<body>
    <?php
    session_start();

    include_once "../class/produto.class.php";
    include_once "../class/DAO/produtoDAO.class.php";

    if (!isset($_SESSION['logadoAdm'])) {
        header("location=../login.php");
    }
    ?>
    <form action="ofertar_ok.php" method="post">
        <label>Porcentagem da oferta:</label><br>
        <input type="number" name="oferta" min="0" max="100">
        <input type="hidden" name="idProduto" value="<?=$_GET['id'];?>">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>