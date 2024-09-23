<?php
session_start();

include_once "../class/venda.class.php";
include_once "../class/DAO/vendasDAO.class.php";

if (!isset($_SESSION['logadoADM'])) {
    header("Location: ../login.php");
    exit();
}

$objVendaDAO = new Venda_DAO();
$retorno = $objVendaDAO->listar("ORDER BY status DESC;");
?>
<p><a href="../usuario/adm/index.php">Voltar</a></p>

<?php
if ($retorno) {
    $currentStatus = null;

    foreach ($retorno as $linha) {
        if ($linha["status"] !== $currentStatus) {
            if ($currentStatus !== null) {
                // Fecha a tabela anterior, se houver
                echo '</tbody></table><br>';
            }
            // Atualiza o status atual e inicia uma nova tabela
            $currentStatus = $linha["status"];
            echo '<h2>'.htmlspecialchars($currentStatus) . '</h2>';
            echo '<table border>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Entrega</th>
                            <th>Valor Total</th>
                            <th>Pagamento</th>
                            <th colspan="2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>';
        }
        // Exibe a linha atual
        echo '<tr>
                <td>' . htmlspecialchars($linha["data"]) . '</td>
                <td>' . htmlspecialchars($linha["status"]) . '</td>
                <td>' . htmlspecialchars($linha["entrega"]) . '</td>
                <td>' . htmlspecialchars($linha["valor_Total"]) . '</td>
                <td>' . htmlspecialchars($linha["pagamento"]) . '</td>
                <td><a href="compra.php?id=' . htmlspecialchars($linha['idVenda']) . '">Ver mais</a></td>
                <td><a href="editar.php?id=' . htmlspecialchars($linha['idVenda']) . '">Editar</a></td>
              </tr>';
    }
    // Fecha a última tabela
    echo '</tbody></table>';
} else {
    echo '<p>Nenhuma venda encontrada.</p>';
}
?>
