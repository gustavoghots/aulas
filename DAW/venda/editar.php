<?php
session_start();

include_once "../class/venda.class.php";
include_once "../class/DAO/vendasDAO.class.php";

if (!isset($_SESSION['logadoAdm'])) {
    header("location=../login.php");
}

$objVendaDAO = new Venda_DAO();
$venda = $objVendaDAO->retornarUnico($_GET['id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Venda</title>
</head>
<body>
    <h1>Editar Venda</h1>
    <form action="editar_ok.php" method="post">
        <input type="hidden" name="idVenda" value="<?=$_GET['id'] ?>">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="pendente" <?php if ($venda['status'] == 'pendente') echo 'selected'; ?>>Pendente</option>
            <option value="aprovado" <?php if ($venda['status'] == 'aprovado') echo 'selected'; ?>>Aprovado</option>
            <option value="cancelado" <?php if ($venda['status'] == 'cancelado') echo 'selected'; ?>>Cancelado</option>
            <option value="entregue" <?php if ($venda['status'] == 'entregue') echo 'selected'; ?>>Entregue</option>
        </select>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
