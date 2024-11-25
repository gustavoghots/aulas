<?php
include_once '../../class/DAO/vendasDAO.class.php';
include_once '../../class/venda.class.php';

@session_start();

// Certifique-se de que todos os dados necessários foram recebidos
if (isset($_POST['idVenda']) && isset($_POST['status'])) {
    $idVenda = intval($_POST['idVenda']);
    $status = trim($_POST['status']); // Remova espaços extras para evitar inconsistências

    // Instanciar objetos necessários
    $objVendaDAO = new Venda_DAO();
    $venda = new Venda();
    $venda->setIdVenda($idVenda);
    $venda->setStatus($status);

    try {
        // Atualizar status no banco de dados
        $objVendaDAO->editarStatus($venda);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Dados inválidos.']);
}
?>
