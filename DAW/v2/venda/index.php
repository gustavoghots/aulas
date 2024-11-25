<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras</title>
    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS do DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
</head>


<body>
    <?php
    include_once '../user/consumer/header.php'; // Alterar para o header específico do cliente
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JS do DataTables -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <div class="container pe-5" style="margin-top:100px">
        <h2>Minhas Compras</h2>
        <table id="example" class="table table-striped table-bordered" style="margin-top: 100px">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Data</th>
                    <th>Pagamento</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir a classe e listar as vendas filtradas por usuário
                include_once '../class/DAO/vendasDAO.class.php';
                $objVendaDAO = new Venda_DAO();

                // Obtendo o ID do usuário da sessão
                @session_start();
                $usuarioId = $_SESSION['idUsuario'];

                // Filtrar vendas pelo ID do usuário
                $vendas = $objVendaDAO->listar("WHERE venda.Usuario_idUsuario = " . intval($usuarioId));

                // Verifica se há vendas para exibir
                if (count($vendas) > 0) {
                    foreach ($vendas as $venda): ?>
                        <tr>
                            <td><?= htmlspecialchars($venda['idVenda']); ?></td>
                            <td><?= date('d/m/Y', strtotime($venda['data'])); ?></td>
                            <td><?= htmlspecialchars($venda['pagamento']); ?></td>
                            <td><?= number_format($venda['valor_Total'], 2, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($venda['status']); ?></td>
                            <td class="text-center">
                                <a href="notaFiscal.php?id=<?= $venda['idVenda']; ?>" class="btn btn-warning me-2">Nota Fiscal</a>
                            </td>
                        </tr>
                    <?php endforeach;
                } else {
                    echo "<tr><td colspan='6'>Nenhuma venda encontrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../user/consumer/index.php" class="ms-3 btn btn-secondary">Voltar</a>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pageLength: 25, // Limitar a 25 linhas por página
                lengthMenu: [10, 25, 50, 100], // Opções de quantidade de registros por página
                order: [
                    [1, 'desc']
                ], // Ordenar pela coluna de índice 1 (Data) em ordem decrescente
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
