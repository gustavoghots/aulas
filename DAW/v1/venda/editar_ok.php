<?php
session_start();

include_once "../class/venda.class.php";
include_once "../class/DAO/vendasDAO.class.php";

if (!isset($_SESSION['logadoAdm'])) {
    header("Location: ../login.php");
}
$objVendaDAO = new Venda_DAO();
$objVenda = new Venda();
$objVenda->setIdVenda($_POST['idVenda']);
$objVenda->setStatus($_POST['status']);

$objVendaDAO->editarStatus($objVenda);
header("Location: listar_ADM.php");