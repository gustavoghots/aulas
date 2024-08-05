<?php
session_start();

include_once "../class/produto.class.php";
include_once "../class/DAO/produtoDAO.class.php";
include_once "../class/DAO/categoriaDAO.class.php"; // Supondo que haja um DAO para categorias

if (isset($_GET['carrinho'])) {
    $_SESSION['carrinho'][$_GET['id']] = 1;
    echo "Inserido ao carrinho com sucesso";
}
if (isset($_GET['C_null'])) {
    echo "carrinho vazio";
}

// Captura os filtros de categoria e pesquisa
$categoriaId = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$termoPesquisa = isset($_GET['termo']) ? $_GET['termo'] : '';

$objProdutoDAO = new Produto_DAO();
$objCategoriaDAO = new Categoria_DAO(); // Supondo que haja um DAO para categorias

// Monta o complemento para a consulta SQL
$complemento = '1=1';
if ($categoriaId) {
    $complemento .= " AND p.Categoria_idCategoria = " . $categoriaId;
}
if ($termoPesquisa) {
    $complemento .= " AND p.nome LIKE '%" . $termoPesquisa . "%'";
}

$retorno = $objProdutoDAO->listar($complemento);
$categorias = $objCategoriaDAO->listar(); // Supondo que haja um método listar() para categorias
?>
<p><a href="carrinho.php">Carrinho</a></p>
<p><a href="../venda/listar.php">Minhas compras</a></p>

<!-- Links de categorias -->
<p>Filtrar por categoria:</p>
<ul>
    <li><a href="?<?= http_build_query(array_merge($_GET, ['categoria' => ''])) ?>">Todas</a></li>
    <?php
    foreach ($categorias as $categoria) {
        echo '<li><a href="?' . http_build_query(array_merge($_GET, ['categoria' => $categoria['idCategoria']])) . '">' . $categoria['descricao'] . '</a></li>';
    }
    ?>
</ul>

<!-- Formulário de pesquisa -->
<form method="GET" action="">
    <!-- Preserve o filtro de categoria no formulário de pesquisa -->
    <input type="hidden" name="categoria" value="<?= htmlspecialchars($categoriaId) ?>">
    <label for="termo">Pesquisar:</label>
    <input type="text" name="termo" id="termo" value="<?= htmlspecialchars($termoPesquisa) ?>">
    <button type="submit">Pesquisar</button>
</form>

<table border>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Valor</th>
            <th>Foto</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($retorno as $linha) {
            if ($linha['qtd_estoque'] > 0) {
                $objProduto = new Produto();
                $objProduto->setPreco($linha['preco']);
                $objProduto->setOferta($linha['oferta']);
        ?>
                <tr>
                    <td><?= htmlspecialchars($linha["nome"]) ?></td>
                    <td><?= htmlspecialchars($linha["categoria"]) ?></td>
                    <td>
                        <?php
                        if ($objProduto->getPrecoOferta() != $linha['preco']) {
                            echo "<del>" . htmlspecialchars($linha['preco']) . "</del><br>" . number_format($objProduto->getPrecoOferta(), 2, '.', '');
                        } else {
                            echo htmlspecialchars($linha['preco']);
                        }
                        ?>
                    </td>
                    <td><img width="100" src="../img/<?= htmlspecialchars($linha["imagem"]) ?>" /></td>
                    <td>
                        <a href="vermais.php?id=<?= htmlspecialchars($linha['idProduto']) ?>">
                            Ver mais
                        </a>
                    </td>
                    <td>
                        <a href="?id=<?= htmlspecialchars($linha['idProduto']) ?>&carrinho">
                            Adicionar
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
