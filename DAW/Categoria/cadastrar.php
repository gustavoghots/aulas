<!DOCTYPE html>
<html lang="pt-br" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../SASS/style.css" rel="stylesheet">
    <title>Cadastro Categoria</title>
    <?php
    session_start();
        if(!isset($_SESSION['logadoADM'])){
            header("Location: ../login.php");
        }
    ?>
</head>
<body class="h-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container h-100">
        <div class="row align-content-center justify-content-center h-100">
            <div class="row justify-content-center block-blox shadow-sm">
                <div class="col-12 mt-5">
                    <h1 class="text-center">Cadastrar Categoria</h1>
                </div>

                <div class="col-6 oi">
                    <form action="Cadastrar_ok.php" method="POST">
                        <div class="form-group mb-2">
                            <label for="senha">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <a href="../usuario/adm/index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <?php
                            if(isset($_GET['error'])) echo "Erro ao cadastrar Categoria";
                        ?>
                    </form>        
                </div>                   
            </div>
        </div>                
    </div>
</body>
</html>