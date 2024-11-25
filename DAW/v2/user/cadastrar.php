<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <?php include '../bin/imports.php';?>
</head>

<body>
    <main class="form-signin w-100 vh-100 m-auto align-items-center justify-content-center d-flex">
        <form class="w-25" action="cadastrar_ok.php" method="post">
            <img class="mb-4" src="../img/Padel.svg" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Cadastrar usuário</h1>

            <!-- Campo para o nome de usuário -->
            <div class="form-floating">
                <input name="usuario" type="text" id="floatingUsuario" placeholder="nome de usuário"
                    class="form-control <?php if(isset($_GET['usuario'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['usuario'])){
                        echo '<label for="floatingUsuario" class="text-danger">Nome de usuário já existe</label>';
                    } else {
                        echo '<label for="floatingUsuario">Nome de usuário</label>';
                    }
                ?>
            </div>

            <!-- Campo para o CPF -->
            <div class="form-floating">
                <input name="CPF" type="text" id="floatingCPF" placeholder="CPF"
                    class="form-control <?php if(isset($_GET['CPF'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['CPF'])){
                        echo '<label for="floatingCPF" class="text-danger">CPF inválido</label>';
                    } else {
                        echo '<label for="floatingCPF">CPF</label>';
                    }
                ?>
            </div>

            <!-- Campo para o email -->
            <div class="form-floating">
                <input name="email" type="email" id="floatingEmail" placeholder="email@example.com"
                    class="form-control <?php if(isset($_GET['email'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['email'])){
                        echo '<label for="floatingEmail" class="text-danger">Email já cadastrado</label>';
                    } else {
                        echo '<label for="floatingEmail">Email</label>';
                    }
                ?>
            </div>

            <!-- Campo para o número -->
            <div class="form-floating">
                <input name="numero" type="text" id="floatingNumero" placeholder="Número de telefone"
                    class="form-control <?php if(isset($_GET['numero'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['numero'])){
                        echo '<label for="floatingNumero" class="text-danger">Número inválido</label>';
                    } else {
                        echo '<label for="floatingNumero">Número de telefone</label>';
                    }
                ?>
            </div>

            <!-- Campo para a senha -->
            <div class="form-floating">
                <input name="senha" type="password" id="floatingSenha" placeholder="Senha"
                    class="form-control <?php if(isset($_GET['senha'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['senha'])){
                        echo '<label for="floatingSenha" class="text-danger">Senha inválida</label>';
                    } else {
                        echo '<label for="floatingSenha">Senha</label>';
                    }
                ?>
            </div>

            <!-- Confirmar senha -->
            <div class="form-floating">
                <input name="senha_confirm" type="password" id="floatingSenhaConfirm" placeholder="Confirmar senha"
                    class="form-control <?php if(isset($_GET['senha_confirm'])){echo 'border border-danger';}?>">
                <?php
                    if(isset($_GET['senha_confirm'])){
                        echo '<label for="floatingSenhaConfirm" class="text-danger">As senhas não coincidem</label>';
                    } else {
                        echo '<label for="floatingSenhaConfirm">Confirmar senha</label>';
                    }
                ?>
            </div>

            <!-- Checkbox de aceitar termos -->
            <div class="form-check text-start my-3">
                <input name="aceito" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Aceito os termos e condições
                </label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
            <a href="login.php" class="mt-2 btn btn-secondary">Voltar</a>
        </form>
    </main>
</body>

</html>
