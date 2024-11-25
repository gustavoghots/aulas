<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel E-commerce</title>
</head>

<body>
    <?php
    include_once 'header.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['qtd'])) {
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        $id = intval($_POST['id']);
        $qtd = intval($_POST['qtd']);
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 0;
        }
        $_SESSION['carrinho'][$id] += $qtd;

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }

    include_once '../../class/DAO/produtoDAO.class.php';
    $objProdutoDAO = new Produto_DAO();

    // Função para validar imagens
    function validarImagem($caminhoImagem)
    {
        if (filter_var($caminhoImagem, FILTER_VALIDATE_URL)) {
            $headers = @get_headers($caminhoImagem);
            return $headers && strpos($headers[0], '200') !== false;
        } else {
            return file_exists($caminhoImagem);
        }
    }

    // Função para renderizar os cards de produtos
    function renderizarCardProduto($produto)
    {
        $caminhoImagem = "../../img/prod/" . $produto['imagem'];

        if (!validarImagem($caminhoImagem) || $produto['imagem'] == '') {
            $caminhoImagem = "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
        }

        $precoOferta = '';
        if ($produto['oferta'] > 0) {
            $precoComDesconto = $produto['preco'] * ((100 - $produto['oferta']) / 100);
            $precoOferta = '
                <span class="text-muted text-decoration-line-through">$' . number_format($produto['preco'], 2, '.', ',') . '</span>
                $' . number_format($precoComDesconto, 2, '.', ',');
        } else {
            $precoOferta = '$' . number_format($produto['preco'], 2, '.', ',');
        }

        echo '
            <div class="col mb-5">
                <div class="card h-100 border-warning-subtle">
                    ' . ($produto['oferta'] > 0 ? '<div class="badge bg-warning text-white position-absolute z-1" style="top: 0.5rem; right: 0.5rem">' . $produto['oferta'] . '%</div>' : '') . '
                    <div class="ratio ratio-4x3">
                        <img class="card-img-top" src="' . $caminhoImagem . '" alt="Produto: ' . $produto['nome'] . '" style="object-fit: cover;">
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">' . $produto['nome'] . '</h5>
                            ' . $precoOferta . '
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-light mt-auto" href="../../produto/verMais.php?id=' . $produto['idProduto'] . '">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            </div>';
    }
    ?>

    <!-- Barra de Pesquisa -->
    <section class="py-3 bg-dark" style="margin-top: 100px;">
        <div class="container">
            <form class="d-flex" method="get" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Buscar produtos..." aria-label="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
        </div>
    </section>

    <?php if (empty($_GET)): ?>
        <!-- Seção de Lançamentos -->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="text-center mb-4">Lançamentos</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    $complementoLancamentos = '1=1 ORDER BY idProduto DESC LIMIT 4';
                    $produtosLancamentos = $objProdutoDAO->listar($complementoLancamentos);

                    foreach ($produtosLancamentos as $produto) {
                        renderizarCardProduto($produto);
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- Seção de Ofertas -->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="text-center mb-4">Ofertas</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    $complementoOfertas = 'oferta > 0 ORDER BY oferta DESC LIMIT 4';
                    $produtosOfertas = $objProdutoDAO->listar($complementoOfertas);

                    foreach ($produtosOfertas as $produto) {
                        renderizarCardProduto($produto);
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Listagem Geral de Produtos -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $complemento = '1=1';
                if (isset($_GET['cat'])) {
                    $complemento = "c.descricao = '" . $_GET['cat'] . "'";
                }
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $complemento .= " AND (p.nome LIKE '%" . $searchTerm . "%' OR p.descricao LIKE '%" . $searchTerm . "%')";
                }

                foreach ($objProdutoDAO->listar($complemento) as $produto) {
                    renderizarCardProduto($produto);
                }
                ?>
            </div>
        </div>
    </section>
</body>

</html>
