<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
</head>

<body>
    <?php
    include_once '../../user/ADM/header.php';
    ?>
    <div class="container pe-5">
        <h2>Vendas</h2>
        <?php
        if (isset($_GET['delete_NOK'])) {
            echo "<p class='text-danger'>Não foi possível excluir a venda</p>";
        } elseif (isset($_GET['delete_OK'])) {
            echo "<p class='text-success'>Venda excluída com sucesso</p>";
        } elseif (isset($_GET['edit_OK'])) {
            echo "<p class='text-success'>Venda atualizada com sucesso</p>";
        }
        ?>

        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Pagamento</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir a classe e listar as vendas
                include_once '../../class/DAO/vendasDAO.class.php';
                $objVendaDAO = new Venda_DAO();
                $vendas = $objVendaDAO->listar();

                // Verifica se há vendas para exibir
                if (count($vendas) > 0) {
                    foreach ($vendas as $venda): ?>
                        <tr>
                            <td><?= htmlspecialchars($venda['idVenda']); ?></td>
                            <td><?= date('d/m/Y', strtotime($venda['data'])); ?></td>
                            <td><?= htmlspecialchars($venda['pagamento']); ?></td>
                            <td><?= htmlspecialchars($venda['valor_Total']); ?></td>
                            <td><?= htmlspecialchars($venda['status']); ?></td>
                            <td><?= htmlspecialchars($venda['usuario']); ?></td>
                            <td class="text-center">
                                <a href="notaFiscal.php?id=<?= $venda['idVenda']; ?>" class="btn btn-warning me-2">Nota Fiscal</a>
                            </td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='7'>Nenhuma venda encontrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pageLength: 25, // Limitar a 25 linhas por página
                lengthMenu: [10, 25, 50, 100], // Opções de quantidade de registros por página
                language: {
                    search: "Pesquisar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoFiltered: "(filtrado de _MAX_ no total)",
                    paginate: {
                        first: "Primeiro",
                        last: "Último",
                        next: "Próximo",
                        previous: "Anterior"
                    }
                },
                ordering: true,
            });
        });
    </script>
</body>

</html>
