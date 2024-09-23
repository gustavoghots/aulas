<?php
session_start();
if (!isset($_SESSION['logadoADM'])) {
    header("Location: ../login.php");
}
include_once '../../class/Usuario.class.php';
include_once '../../class/DAO/UsuarioDAO.class.php';

$objUsuarioDAO = new Usuario_DAO();
$idUsuario = $_GET['id'];
$retorno = $objUsuarioDAO->retornarADM($idUsuario);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar dados ADM</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="../script.js"></script>
    <script>
        $(document).ready(function() {
            $('#senha').on("keyup", function() {
                let senha = $(this).val();
                let valido = validarSenha(senha);
                console.log(valido);
                $('#texto_senha').text(valido);
            });
        });
    </script>
    <form action="editar_ok.php" method="POST">

        <label for="usuario">Usuário:</label><br />
        <input type="text" id="usuario" name="usuario" value="<?= $retorno['usuario'] ?>" required><br /><br />

        <label for="senha">Trocar senha:</label><br />
        <input type="password" id="senha" name="senha" value=""><br /><br />
        <div id="texto_senha"></div>

        <label for="CPF">CPF:</label><br />
        <input type="text" id="CPF" name="CPF" value="<?= $retorno['CPF'] ?>" required><br /><br />

        <label for="email">E-mail:</label><br />
        <input type="email" id="email" name="email" value="<?= $retorno['email'] ?>" required><br /><br />

        <label for="numero">Número:</label><br />
        <input type="text" id="numero" name="numero" value="<?= $retorno['numero'] ?>" required><br /><br />

        <label for="numero">ADM:</label><br />
        <input type="radio" id="adm" name="adm" value="1" checked required>Sim<br />
        <input type="radio" id="adm" name="adm" value="0" required>Não<br />

        <input type="hidden" name="idUsuario" value="<?= $retorno['idUsuario'] ?>">

        <button type="submit">Enviar</button>
        <a href="listar.php"><button type="button">cancelar</button></a>
    </form>
</body>

</html>