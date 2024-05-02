<!DOCTYPE html>
<html lang="pt-br" class="h-100" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../SASS/style.css" rel="stylesheet">
    <title>Cadastro Produto</title>
    <?php
    session_start();
        if(!isset($_SESSION['logadoADM'])){
            header("Location=../login.php");
        }
        include_once '../class/categoria.class.php';
        include_once '../class/DAO/CategoriaDAO.class.php';
    ?>
</head>
<body class="h-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container h-100">
        <div class="row align-content-center justify-content-center h-100">
            <div class="row justify-content-center shadow-sm">
                <div class="col-12 mt-5">
                    <h1 class="text-center">Cadastrar Produto</h1>
                </div>

                <div class="col-6">
                    <form action="Cadastrar_ok.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="preco">Preço:</label>
                            <input type="number" id="preco" name="preco" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="descricao">Descrição:</label>
                            <input type="text" id="descricao" name="descricao" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="imagem">Imagem:</label>
                            <input type="file" id="imagem" name="imagem" class="form-control" required
                            accept="image/*">
                        </div>
                        <div class="form-group mb-2">
                            <label for="oferta">Oferta:</label>
                            <input type="number" id="oferta" name="oferta" class="form-control" placeholder="colocar em %">
                        </div>
                        <div class="form-group mb-2">
                            <label for="qtd_estoque">Quantidade:</label>
                            <input type="number" id="qtd_estoque" name="qtd_estoque" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="Categoria_idCategoria">Categoria:</label>
                            <select class="form-select" name="Categoria_idCategoria">
                            <option value="">-- Selecione --</option>
                                <?php
                                    $objCategoria = new Categoria_DAO();
                                        foreach($objCategoria->listar() as $categoria){
                                        echo "<option value='".$categoria['idCategoria']."'>".$categoria['descricao']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <a href="../usuario/adm/index.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <?php
                            if(isset($_GET['error'])) echo "Erro ao cadastrar Produto";
                        ?>
                    </form>        
                </div>                   
            </div>
        </div>                
    </div>
</body>
</html>