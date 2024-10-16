<?php
// Caminho relativo para a imagem
$relativePath = '/aulas/DAW/v2';

  session_start();
  include_once $_SERVER['DOCUMENT_ROOT']."{$relativePath}/bin/imports.php";
  if (!isset($_SESSION['adm'])) {
  header("Location: $relativePath/user/login.php");
  }
?>

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
      <a href="#" class="nav-link link-body-emphasis">Administrador</a>
    </li>
    <li>
      <a href="<?=$relativePath?>/categoria/index.php" class="nav-link link-body-emphasis">Categoria</a>
    </li>
    <li>
      <a href="#" class="nav-link link-body-emphasis">Produto</a>
    </li>
    <li></li>
    <a href="#" class="nav-link link-body-emphasis">venda</a>
    </li>
  </ul>

  <hr>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?=$relativePath;?>/img/no profile.png" alt="mdo" width="32" height="32" class="rounded-circle me-2">
      <strong>Profile</strong>
    </a>
    <ul class="dropdown-menu text-small">
      <li><a class="dropdown-item" href="#">New project...</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item text-danger" href="<?=$relativePath;?>/user/logOut.php">Sair</a></li>
    </ul>
  </div>
</header>

<main class="container d-flex align-items-center justify-content-center vh-100" style="margin-left: 200px;">