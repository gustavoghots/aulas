<!DOCTYPE html>
<?php session_start(); ?>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>

<body class="h-100">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <section class="h-100">
        <div class="container-fluid h-100 align-content-center justify-content-center d-flex flex-wrap">
            <div class="row h-100">
                <form method="POST" action="login_ok.php">
                    <label>Email</label><br>
                    <input type="text" id="email" name="login" value="<?php echo @$_GET['login']; ?>" required class="form-control">
                    <?php
                    if (isset($_GET['login'])) {
                        echo "<p id='log_erro'>Usuário Incorreto</p>";
                    } else {
                        echo "<br>";
                    }
                    ?>
                    <br>
                    <label>Senha</label><br>
                    <input type="password" id="password" name="password" required class="form-control"><br>
                    <?php
                    if (isset($_GET['senha'])) {
                        echo "<p id='log_erro'>Senha Incorreta</p>";
                    } else {
                        echo "<br>";
                    }
                    ?>
                    <button type="submit" id="submit" class="btn btn-primary">Enviar</button>
                    <a href="cadastrar.php"><button type="button" class="btn btn-secundary">Cadastrar-se</button></a>
                </form>
            </div>
        </div>
    </section>
</body>

</html>