<?php
session_start();
@include_once '../class/DAO/usuarioDAO.class.php';
@include_once '../class/usuario.class.php';

$usuarioDAO = new Usuario_DAO();
$mensagemErro = '';

function fragmentoCPF($cpf) {
    return substr($cpf, 0, 3) . '.***.***-' . substr($cpf, -2);
}

function fragmentoEmail($email) {
    $pos = strpos($email, '@');
    return substr($email, 0, 3) . '***' . substr($email, $pos);
}

function fragmentoNumero($numero) {
    return substr($numero, 0, 2) . '****' . substr($numero, -2);
}

// Função para gerar valores falsos
function gerarCPFfalso() {
    return substr(str_shuffle("0123456789"), 0, 3) . '.***.***-' . substr(str_shuffle("0123456789"), 0, 2);
}

function gerarEmailFalso() {
    $dominios = ['example.com', 'falso.org', 'testmail.net'];
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3) . '***@' . $dominios[array_rand($dominios)];
}

function gerarNumeroFalso() {
    return substr(str_shuffle("0123456789"), 0, 2) . '****' . substr(str_shuffle("0123456789"), 0, 2);
}


// Se o formulário foi enviado com as opções selecionadas (segunda parte)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cpf_selecionado'], $_POST['email_selecionado'], $_POST['numero_selecionado'])) {
    $login = $_POST['usuario_login'];
    $cpfSelecionado = $_POST['cpf_selecionado'];
    $emailSelecionado = $_POST['email_selecionado'];
    $numeroSelecionado = $_POST['numero_selecionado'];

    // Verifica os dados selecionados
    $usuario = new usuario();
    $usuario->setUsuario($login);
    $dadosUsuario = $usuarioDAO->dados($usuario);

    $cpfCorreto = fragmentoCPF($dadosUsuario['CPF']);
    $emailCorreto = fragmentoEmail($dadosUsuario['email']);
    $numeroCorreto = fragmentoNumero($dadosUsuario['numero']);

    if ($cpfSelecionado == $cpfCorreto && $emailSelecionado == $emailCorreto && $numeroSelecionado == $numeroCorreto) {
        // Redirecionar para a página de redefinição de senha
        header('Location: recuperacao_ok.php');
        exit();
    } else {
        $mensagemErro = "Um ou mais dados incorretos, por favor tente novamente.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario_login'])) {
    // Se o formulário foi enviado com o campo de login
    $login = $_POST['usuario_login'];
    
    // Cria objeto Usuario
    $usuario = new usuario();
    $usuario->setUsuario($login);
    
    // Tenta pegar os dados do usuário
    $dadosUsuario = $usuarioDAO->dados($usuario);
    
    if ($dadosUsuario) {
        // Suprime partes dos dados corretos
        $cpfCorreto = $dadosUsuario['CPF'];
        $emailCorreto = $dadosUsuario['email'];
        $numeroCorreto = $dadosUsuario['numero'];

        // Função para gerar fragmentos de dados corretos
        
        // Gera valores falsos
        $cpfFalso1 = gerarCPFfalso();
        $cpfFalso2 = gerarCPFfalso();
        $emailFalso1 = gerarEmailFalso();
        $emailFalso2 = gerarEmailFalso();
        $numeroFalso1 = gerarNumeroFalso();
        $numeroFalso2 = gerarNumeroFalso();

        // Fragmentos dos dados corretos
        $cpfCorretoFragmento = fragmentoCPF($cpfCorreto);
        $emailCorretoFragmento = fragmentoEmail($emailCorreto);
        $numeroCorretoFragmento = fragmentoNumero($numeroCorreto);

        // Mistura as opções verdadeiras e falsas
        $cpfs = [$cpfCorretoFragmento, $cpfFalso1, $cpfFalso2];
        $emails = [$emailCorretoFragmento, $emailFalso1, $emailFalso2];
        $numeros = [$numeroCorretoFragmento, $numeroFalso1, $numeroFalso2];
        shuffle($cpfs);
        shuffle($emails);
        shuffle($numeros);

        // Exibir segunda parte do formulário com as opções
        echo "
            <form action='recuperacao.php' method='POST'>
                <input type='hidden' name='usuario_login' value='$login'>
                <p>Por favor, selecione o dado correto:</p>

                <label>Escolha o CPF correto:</label><br>
                <input type='radio' name='cpf_selecionado' value='{$cpfs[0]}'> $cpfs[0]<br>
                <input type='radio' name='cpf_selecionado' value='{$cpfs[1]}'> $cpfs[1]<br>
                <input type='radio' name='cpf_selecionado' value='{$cpfs[2]}'> $cpfs[2]<br>

                <label>Escolha o E-mail correto:</label><br>
                <input type='radio' name='email_selecionado' value='{$emails[0]}'> $emails[0]<br>
                <input type='radio' name='email_selecionado' value='{$emails[1]}'> $emails[1]<br>
                <input type='radio' name='email_selecionado' value='{$emails[2]}'> $emails[2]<br>

                <label>Escolha o número de celular correto:</label><br>
                <input type='radio' name='numero_selecionado' value='{$numeros[0]}'> $numeros[0]<br>
                <input type='radio' name='numero_selecionado' value='{$numeros[1]}'> $numeros[1]<br>
                <input type='radio' name='numero_selecionado' value='{$numeros[2]}'> $numeros[2]<br>

                <button type='submit'>Verificar</button>
            </form>
        ";
        exit();
    } else {
        $mensagemErro = "Usuário não encontrado.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
</head>
<body>
    <h2>Recuperação de Senha</h2>

    <?php
    // Exibe mensagem de erro, se houver
    if ($mensagemErro != '') {
        echo "<p style='color: red;'>$mensagemErro</p>";
    }
    ?>

    <!-- Primeira parte do formulário: Solicita login do usuário -->
    <form action="recuperacao.php" method="POST">
        <label for="usuario_login">Informe seu nome de usuário ou e-mail:</label><br>
        <input type="text" id="usuario_login" name="usuario_login" required><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
