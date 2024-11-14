<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Administradores</title>
</head>

<body>
    <?php
    include_once '../header.php';
    ?>
    <div class="container pe-5">
        <h2>Administradores</h2>
        <?php
        if (isset($_GET['delete_NOK'])) {
            echo "<p class='text-danger'>Não foi possível excluir o administrador</p>";
        } elseif (isset($_GET['delete_OK'])) {
            echo "<p class='text-success'>Administrador excluído com sucesso</p>";
        } elseif (isset($_GET['add_OK'])) {
            echo "<p class='text-success'>Administrador Adicionado com sucesso</p>";
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
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Número</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../../class/DAO/usuarioDAO.class.php';
                $objUsuarioDAO = new Usuario_DAO();
                $retorno = $objUsuarioDAO->listar('adm = 1');

                if (count($retorno) > 0) {
                    foreach ($retorno as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['idUsuario']); ?></td>
                            <td><?= htmlspecialchars($row['usuario']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['CPF']); ?></td>
                            <td><?= htmlspecialchars($row['numero']); ?></td>
                            <td class="text-center">
                                <a href="excluir.php?id=<?= $row['idUsuario']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este administrador?');">Excluir</a>
                            </td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='6'>Nenhum administrador encontrado</td></tr>";
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
