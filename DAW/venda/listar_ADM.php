<?php
session_start();

include_once "../class/venda.class.php";
include_once "../class/DAO/vendasDAO.class.php";

if (!isset($_SESSION['logadoAdm'])) {
    header("location=../login.php");
}
$objVendaDAO = new Venda_DAO();
$retorno = $objVendaDAO->listar("ORDER BY status desc;");
?>
<p><a href="../usuario/adm/index.php">Voltar</a></p>
<table border>
    <thead>
        <th>Data</th>
        <th>Status</th>
        <th>Entrega</th>
        <th>valor Total</th>
        <th>Pagamento</th>
        <th colspan="2">Ações</th>
    </thead>
    <tbody>
        <?php
        foreach ($retorno as $linha) {
        ?>
            <tr>
                <td><?= $linha["data"] ?></td>
                <td><?= $linha["status"] ?></td>
                <td><?= $linha['entrega'] ?></td>
                <td><?= $linha["valor_Total"] ?></td>
                <td><?= $linha["pagamento"] ?></td>
                <td>
                    <a href="compra.php?id=<?= $linha['idVenda']; ?>">
                        Ver mais
                    </a>
                </td>
                <td>
                    <a href="editar.php?id=<?= $linha['idVenda']; ?>">
                        Editar
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>