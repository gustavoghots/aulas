<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Categorias</title>
</head>

<body>
    <?php
    include_once '../user/ADM/header.php';
    ?>
    <div class="container pe-5">
        <h2>Categorias</h2>
        <?php
        if (isset($_GET['delete_NOK'])) {
            echo "<p class='text-danger'>Não foi possível excluir a Categoria</p>";
        }
        elseif (isset($_GET['delete_OK'])) {
            echo "<p class='text-success'>Categoria excluída com sucesso</p>";
        }
        elseif(isset($_GET['edit_OK'])){
            echo "<p class='text-success'>Categoria atualizada com sucesso</p>";
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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../class/DAO/CategoriaDAO.class.php';
                $objCategoriaDAO = new Categoria_DAO();
                $retorno = $objCategoriaDAO->listar();

                if (count($retorno) > 0) {
                    foreach ($retorno as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['idCategoria']); ?></td>
                            <td><?= htmlspecialchars($row['descricao']); ?></td>
                            <td class="text-center">
                                <a href="editar.php?id=<?= $row['idCategoria']; ?>" class="btn btn-warning me-2">Editar</a>
                                <a href="excluir.php?id=<?= $row['idCategoria']; ?>" class="btn btn-danger" 
                                   onclick="return confirm('Tem certeza que deseja excluir este item?');">Excluir</a>
                            </td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='3'>Nenhum dado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

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
