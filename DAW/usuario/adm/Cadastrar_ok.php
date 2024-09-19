<?php
session_start();
if (!isset($_SESSION['logadoADM'])) {
    header("Location: ../login.php");
    exit(); // Adicionado para garantir que o código pare de executar após o redirecionamento
}

include_once '../../class/usuario.class.php';
include_once '../../class/DAO/UsuarioDAO.class.php';

// Recupera os dados do formulário
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];
$CPF = $_POST["CPF"];
$email = $_POST["email"];
$numero = $_POST["numero"];

// Cria uma instância de Usuario e define os dados
$objUsuario = new Usuario();
$objUsuario->setUsuario(htmlspecialchars($usuario)); // Sanitiza a entrada
$objUsuario->setCPF(htmlspecialchars($CPF));         // Sanitiza a entrada
$objUsuario->setEmail(htmlspecialchars($email));     // Sanitiza a entrada
$objUsuario->setNumero(htmlspecialchars($numero));   // Sanitiza a entrada
$objUsuario->setAdm(true);

// Verifica se a senha foi passada
if ($senha != null && $senha != "") {
    $objUsuario->setSenha($senha); // A função inserir cuidará do hash e do salt

    // Insere o usuário no banco de dados
    $objUsuarioDAO = new Usuario_DAO();
    $retorno = $objUsuarioDAO->inserir($objUsuario);
    
    // Verifica o retorno da inserção e redireciona com base nisso
    if ($retorno) {
        header("Location: index.php?admOK");
    } else {
        header("Location: Cadastrar.php?error");
    }
} else {
    header("Location: Cadastrar.php?error=missing_password"); // Senha não fornecida
}
exit(); // Para garantir que o script pare após o redirecionamento
