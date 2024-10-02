<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include '../../bin/imports.html'; ?>
</head>

<body class="overflow-hidden">
    <?php
    include 'header.html';
    ?>
    <div class="w-75 p-3 rounded border">
    <h2 class="text-center">Dashboard</h2>
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col" class="text-center" colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Administrador</td>
                    <td colspan="2" class="text-center">
                        <a href=""><button class="btn btn-success me-1">Cadastrar</button></a>
                        <a href=""><button class="btn btn-primary ms-1">Listar/Editar</button></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Categoria</td>
                    <td colspan="2" class="text-center">
                        <a href=""><button class="btn btn-success me-1">Cadastrar</button></a>
                        <a href=""><button class="btn btn-primary ms-1">Listar/Editar</button></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Produto</td>
                    <td colspan="2" class="text-center">
                        <a href=""><button class="btn btn-success me-1">Cadastrar</button></a>
                        <a href=""><button class="btn btn-primary ms-1">Listar/Editar</button></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Venda</td>
                    <td colspan="2" class="text-center">
                        <a href=""><button class="btn btn-primary me-1">Listar</button></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    </main>
</body>

</html>