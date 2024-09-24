<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="form-signin w-100 vh-100 m-auto align-items-center justify-content-center d-flex">
        <form class="w-25" action="login_ok.php" method="post">
            <img class="mb-4" src="../img/Padel.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Faça seu login</h1>
            <?php
            if (isset($_GET['login'])) {
                echo "<label class='text-danger'>Credenciais incorretas</label>";
            }
            ?>
            <div class="form-floating">
                <input name="login" type="text" id="floatingInput" placeholder="nome@exemplo@email.com"
                    class="form-control">
                <label for="floatingInput">Usuario / email</label>
            </div>
            <div class="form-floating">
                <input name="senha" type="password" id="floatingPassword" placeholder="Password"
                    class="form-control">
                <label for="floatingPassword">Senha</label>
            </div>

            <div class="form-check text-start my-3">
                <input name="lembrar" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    lembrar usuario
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Confirmar</button>
        </form>
    </main>
</body>

</html>