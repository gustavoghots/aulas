<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Produtos</title>
</head>

<body>
    <?php
    include_once '../user/ADM/header.php';
    ?>
    <div class="container pe-5">
        <h2>Produtos</h2>
        <?php
        if (isset($_GET['delete_NOK'])) {
            echo "<p class='text-danger'>Não foi possível excluir o Produto</p>";
        } elseif (isset($_GET['delete_OK'])) {
            echo "<p class='text-success'>Produto excluído com sucesso</p>";
        } elseif (isset($_GET['edit_OK']) || isset($_GET['ofer_OK'])) {
            echo "<p class='text-success'>Produto atualizado com sucesso</p>";
        }
        ?>

        <!-- Botão Adicionar -->
        <div class="d-flex justify-content-between mb-2">
            <a href="adicionar.php" class="btn btn-success">Adicionar</a>
        </div>

        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Oferta</th>
                    <th>Descrição</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../class/DAO/produtoDAO.class.php';
                $objProdutoDAO = new Produto_DAO();
                $retorno = $objProdutoDAO->listar();

                if (count($retorno) > 0) {
                    foreach ($retorno as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['idProduto']); ?></td>
                            <td><?= htmlspecialchars($row['nome']); ?></td>
                            <td><?= htmlspecialchars($row['preco']); ?></td>
                            <td><?= htmlspecialchars($row['oferta']); ?></td>
                            <td><?= htmlspecialchars($row['descricao']); ?></td>
                            <td><?= htmlspecialchars($row['estoque']); ?></td>
                            <td class="text-center">
                                <a href="ofertar.php?id=<?= $row['idProduto']; ?>" class="btn btn-primary me-2">Ofertar</a>
                                <a href="editar.php?id=<?= $row['idProduto']; ?>" class="btn btn-warning me-2">Ver/Editar</a>
                                <a href="excluir.php?id=<?= $row['idProduto']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</a>
                            </td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='7'>Nenhum dado encontrado</td></tr>";
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