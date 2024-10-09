<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Categorias</title>
    <?php
        session_start();
        include_once '../bin/imports.php';
        if (!$_SESSION['adm']) {
        header("Location: ../user/login.php");
        }
    ?>
</head>
<body>
    <?php
        include_once '../user/ADM/header.php';
        include_once '../class/DAO/CategoriaDAO.class.php';
    ?>
    </main>
</body>
</html>