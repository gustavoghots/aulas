<?php
if (!isset($_SESSION['logado'])) {
    header("location=../usuario/login.php");
}

include_once '../class/DAO/vendasDAO.class.php';

$objVendaDAO = new Venda_DAO();
$retorno = $objVendaDAO->getDetalhes($_GET['id']);
?>
<table border>
    <tbody>
        <tr>
            <td>Data: <?= $retorno[0]['data'] ?></td>
        </tr>
        <tr>
            <td>Comprador: <?= $retorno[0]['usuario'] ?></td>
        </tr>
        <tr>
            <td>Comprador: <?= $retorno[0]['status'] ?></td>
        </tr>
        <tr>
            <td>
                <table border>
                    <thead>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Valor Unitario</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($retorno as $k => $produto) {
                        ?>
                            <tr>
                                <td><img width="100" src="../img/<?= $produto["imagem"] ?>" /></td>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['valor'] ?></td>
                                <td><?= $produto['quantidade'] ?></td>
                                <td><?= $produto['valor'] * $produto['quantidade'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td><?= $retorno[0]['valorTotal'] ?></td>
        </tr>
    </tbody>
</table>