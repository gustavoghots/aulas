<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        /* Estilos para o menu */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_GET['admOk'])) 
        echo "Novo administrador cadastrado com sucesso!"
    ?>
<h2>Administração</h2>
<a href="cadastrar.php">Cadastrar Administrador</a><br/><br/>
<a href="listar.php">Listar Administrador</a><br/><br/>

<h2>Categorias</h2>
<a href="../../Categoria/cadastrar.php">Cadastrar Categoria</a><br/><br/>
<a href="../../Categoria/listar.php">Listar Categoria</a><br/><br/>

<h2>Produtos</h2>
<a href="../../produto/cadastrar.php">Cadastrar Produto</a><br/><br/>
<a href="../../produto/listar.php">Listar Produto</a><br/><br/>

</body>
</html>
