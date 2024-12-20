<?php
// Caminho relativo para a imagem
$relativePath = '/aulas/DAW/v2';

session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "{$relativePath}/bin/imports.php";
if (!isset($_SESSION['adm'])) {
  header("Location: $relativePath/user/login.php");
}
?>
<!-- CSS do Bootstrap e DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- JS do Bootstrap e DataTables -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>



<header class="d-flex flex-column border-end p-3 vh-100 position-fixed" style="width: 200px;">
  <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <a href="<?= $relativePath; ?>/user/ADM/index.php">
      <img src="<?= $relativePath; ?>/img/Logo_Completa.svg" height="40px">
    </a>
  </div>

  <ul class="nav nav-pills flex-column mb-auto mt-2">
    <li class="nav-item">
      <a href="index.php" class="nav-link link-secondary">Inicio</a>
    </li>
    <li>
      <a href="<?= $relativePath ?>/user/ADM/config/index.php" class="nav-link link-body-emphasis">Administrador</a>
    </li>
    <li>
      <a href="<?= $relativePath ?>/categoria/index.php" class="nav-link link-body-emphasis">Categoria</a>
    </li>
    <li>
      <a href="<?= $relativePath ?>/produto/index.php" class="nav-link link-body-emphasis">Produto</a>
    </li>
    <li></li>
    <a href="<?= $relativePath ?>/venda/ADM/index.php" class="nav-link link-body-emphasis">venda</a>
    </li>
  </ul>

  <hr>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?= $relativePath; ?>/img/no_profile.png" alt="mdo" width="32" height="32" class="rounded-circle me-2">
      <strong>Conta</strong>
    </a>
    <ul class="dropdown-menu text-small">
      <li><a class="dropdown-item" href="<?= $relativePath; ?>/user/consumer/index.php">Visão do Usuario</a></li>
      <li><a class="dropdown-item" href="#">Configurações</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item text-danger" href="<?= $relativePath; ?>/user/logOut.php">Sair</a></li>
    </ul>
  </div>
</header>

<main class="container d-flex justify-content-center align-items-center" style="margin-left: 200px; min-height: 100vh;">
<div class="content-wrapper w-100 justify-content-center d-flex">
