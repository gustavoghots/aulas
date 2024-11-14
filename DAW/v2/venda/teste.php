<pre>
<?php
    include_once '../class/DAO/vendasDAO.class.php';
    $objVendaDAO = new Venda_DAO();
    print_r($objVendaDAO->getDetalhes($_GET['id']))
?>