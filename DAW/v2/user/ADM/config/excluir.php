<?php
// Inclui a classe necessária
include_once '../../../class/DAO/usuarioDAO.class.php';

// Verifica se o ID do usuário a ser excluído foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $objUsuarioDAO = new Usuario_DAO();

    // Tenta excluir o usuário com o ID especificado
    if ($objUsuarioDAO->excluir($id)) {
        // Redireciona para index.php com uma mensagem de sucesso
        header("Location: index.php?delete_OK");
    } else {
        // Redireciona para index.php com uma mensagem de erro
        header("Location: index.php?delete_NOK");
    }
} else {
    // Redireciona para index.php caso o ID não tenha sido passado
    header("Location: index.php?delete_NOK");
}
?>
