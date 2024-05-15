<!DOCTYPE html>
<html lang="pt-br" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../SASS/style.css" rel="stylesheet">
    <title>Cadastro ADM</title>
    <?php
    session_start();
        if(!isset($_SESSION['logadoADM'])){
            header("Location=../login.php");
        }
    ?>
</head>
<body class="h-100">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).ready(function(){
            $('#senha').on("keyup", function(){
                let senha = $(this).val();
                let valido = validarSenha(senha);
                console.log(valido);
                $('#texto_senha').text(valido);
            });
        });
    </script>
    <div class="container h-100">
        <div class="row align-content-center justify-content-center h-100">
            <div class="row justify-content-center block-blox shadow-sm">
                <div class="col-12 mt-5">
                    <h1 class="text-center">Criar Conta</h1>
                </div>

                <div class="col-6 oi">
                    <form action="Cadastrar_ok.php" method="POST">
                        <div class="form-group">
                            <label for="usuario">Usuário:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" class="form-control" required>
                            <div class="form-text" id="texto_senha"></div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="CPF">CPF:</label>
                            <input type="text" id="CPF" name="CPF" class="form-control" required maxlength="15" minlength="11">
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="numero">Número:</label>
                            <input type="text" id="numero" name="numero" class="form-control" required>
                        </div>
                        <a href="login.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <?php
                            if(isset($_GET['error'])) echo "Erro ao cadastrar usuario";
                        ?>
                    </form>        
                </div>                   
            </div>
        </div>                
    </div>
</body>
</html>
