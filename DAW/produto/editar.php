<?php
session_start();
if (!isset($_SESSION['logadoADM'])) {
    header("Location=../usuario/login.php");
}
include_once '../class/produto.class.php';
include_once '../class/DAO/produtoDAO.class.php';
include_once '../class/DAO/CategoriaDAO.class.php';

$objProdutoDAO = new Produto_DAO();
$idProduto = $_GET['id'];
$retorno = $objProdutoDAO->retornarProduto($idProduto);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
</head>

<body>
    <form action="editar_ok.php" method="POST" enctype="multipart/form-data">

        <label for="nome">Nome:</label><br />
        <input type="text" id="nome" name="nome" value="<?= $retorno['nome'] ?>" required><br /><br />

        <label for="descricao">descricao:</label><br />
        <input type="text" id="descricao" name="descricao" value="<?= $retorno['descricao'] ?>" required><br /><br />

        <label for="preco">Preço:</label><br />
        <input type="text" id="preco" name="preco" value="<?= $retorno['preco'] ?>" required><br /><br />

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" class="form-control" accept="image/*"><br /><br />

        <label for="qtd_estoque">Quantidade estoque:</label><br />
        <input type="text" id="qtd_estoque" name="qtd_estoque" value="<?= $retorno['qtd_estoque'] ?>" required><br /><br />

        <select class="form-select" name="categoria">
            <option value="">-- Selecione --</option>
            <?php
            $objCategoriaDAO = new Categoria_DAO();
            foreach ($objCategoriaDAO->listar() as $categoria) {
                if ($categoria['idCategoria'] == $retorno['Categoria_idCategoria'])
                    echo "<option value='" . $categoria['idCategoria'] . "' selected>" . $categoria['descricao'] . "</option>";
                else
                    echo "<option value='" . $categoria['idCategoria'] . "'>" . $categoria['descricao'] . "</option>";
            }
            ?>
        </select><br /><br />
        <input type="hidden" name="idProduto" value="<?= $retorno['idProduto'] ?>">
        <button type="submit">Enviar</button>
        <a href="listar.php"><button>cancelar</button></a>
    </form>
</body>

</html>