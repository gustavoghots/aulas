<?php
$relativePath = '/aulas/DAW/v2';
@session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("Location: $relativePath/user/login.php");
}
include_once $_SERVER['DOCUMENT_ROOT'] . "{$relativePath}/bin/imports.php";

$carrinhoCount = isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : 0;
$carrinhoDisplay = $carrinhoCount > 9 ? '+9' : $carrinhoCount;

?>
<header class="d-flex flex-row border-bottom p-3 w-100 position-fixed top-0 bg-body-tertiary" style="height: 70px; z-index: 1000;">
    <!-- Logo e Navegação -->
    <div class="d-flex align-items-center me-auto">
        <!-- Logo -->
        <a href="<?= $relativePath; ?>/user/consumer/index.php" class="link-body-emphasis text-decoration-none me-3">
            <img src="<?= $relativePath; ?>/img/Logo_Completa.svg" height="40px">
        </a>

        <!-- Links de Navegação -->
        <ul class="nav nav-pills flex-row">
            <li class="nav-item">
                <a href="<?= $relativePath ?>/user/consumer/index.php" class="nav-link link-secondary">Início</a>
            </li>
            <?php
                if(isset($_GET['cat'])){
                    echo "<a href='$relativePath/user/consumer/index.php' class='nav-link link-body-emphasis'>Todos</a>";
                }
            ?>
            <li>
                <a href="<?= $relativePath ?>/user/consumer/index.php?cat=Raquete" class="nav-link link-body-emphasis">Raquetes</a>
            </li>
            <li>
                <a href="<?= $relativePath ?>/user/consumer/index.php?cat=Bola" class="nav-link link-body-emphasis">Bolas</a>
            </li>
            <li>
                <a href="<?= $relativePath ?>/user/consumer/index.php?cat=Utilitário" class="nav-link link-body-emphasis">Utilitários</a>
            </li>
            <li>
                <a href="<?= $relativePath ?>/user/consumer/carrinho.php" class="nav-link link-body-emphasis">Carrinho</a>
            </li>
        </ul>
    </div>

    <!-- Ícones de Carrinho e Perfil -->
    <div class="d-flex align-items-center ms-auto">
        <!-- Botão do Carrinho -->
        <a href="<?= $relativePath ?>/user/consumer/carrinho.php" class="btn btn-link text-decoration-none">
        <div class="position-relative">
    <i class="bi bi-cart fs-4 text-warning"></i>
    <?php if ($carrinhoCount > 0): ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= $carrinhoDisplay; ?>
            <span class="visually-hidden">itens no carrinho</span>
        </span>
    <?php endif; ?>
</div>
        </a>


        <!-- Dropdown de Perfil -->
        <div class="dropdown ms-3">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $relativePath; ?>/img/no_profile.png" alt="Profile" width="32" height="32" class="rounded-circle me-2">
                <strong>Perfil</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow">
                <?php
                if (isset($_SESSION['adm'])) {
                    echo "<li><a class='dropdown-item' href='$relativePath/user/ADM/index.php'>Voltar a ADM</a></li>";
                }
                ?>
                <li><a class="dropdown-item" href="<?= $relativePath; ?>/venda/index.php">Minhas Compras</a></li>
                <li><a class="dropdown-item" href="#">Configurações</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="<?= $relativePath; ?>/user/logOut.php">Sair</a></li>
            </ul>
        </div>
    </div>
</header>