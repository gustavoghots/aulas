<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel</title>
    <?php include '../bin/imports.html';?>
</head>

<body>
    <main class="form-signin w-100 vh-100 m-auto align-items-center justify-content-center d-flex">
        <form class="w-25" action="login_ok.php" method="post">
            <img class="mb-4" src="../img/Padel.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Faça seu login</h1>
            <div class="form-floating">
                <input name="login" type="text" id="floatingInput" placeholder="nome@exemplo@email.com"
                    class="form-control <?php if(!isset($_GET['senha'])&&isset($_GET['login'])){echo 'border border-danger';}?>"
                    value="<?=@$_GET['login']?>">
                <?php
                    if(!isset($_GET['senha'])&&isset($_GET['login'])){
                        echo '<label for="floatingInput" class="text-danger">login incorreto</label>';
                    }else{
                        echo '<label for="floatingInput">Usuario / email</label>';
                    }
                ?>
            </div>
            <div class="form-floating">
                <input name="senha" type="password" id="floatingPassword" placeholder="Password"
                    class="form-control <?php if(isset($_GET['senha'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['senha'])){
                        echo '<label for="floatingPassword" class="text-danger">senha incorreta</label>';
                    }else{
                        echo '<label for="floatingPassword">senha</label>';
                    }
                ?>
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